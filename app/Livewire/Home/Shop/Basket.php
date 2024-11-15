<?php

namespace App\Livewire\Home\Shop;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;
use Hekmatinasser\Verta\Facades\Verta;

class Basket extends Component
{
    public $openingTime;
    public $total=0;
    public $type=['1'=>'عدد','2'=>'کیلو گرم'];
    // ساعت باز شدن
    public $products;  // ساعت باز شدن
    public $closingTime;  // ساعت بسته شدن
    public $remainingTime;
    public $invoice=[];
    public $price=[];
    public $has_invoice;

    #[On('add_basket')]
    public function add_basket()
    {
        $products=\App\Models\Basket::whereDate('created_at', Carbon::today())->where('user_id',auth()->user()->id)->pluck('product_id');
        $this->products=\App\Models\Product::whereIn('id',$products ?? [])->get();
    }

    public function remove_from_basket($id)
    {
        $products=\App\Models\Basket::whereDate('created_at', Carbon::today())->where('user_id',auth()->user()->id)
            ->where('product_id',$id)->delete();
        $this->products = $this->products->reject(function ($item) use ($id){
            return $item['id'] === $id;
        });
        unset($this->invoice[$id]);
        unset($this->price[$id]);
    }
    public function mount()
    {

        $products=\App\Models\Invoice::where('status',1)->whereDate('created_at', Carbon::today())->where('user_id',auth()->user()->id)->value('products');
        if ($products){
            $this->has_invoice=1;
            $products_id=[];
            foreach ($products as $product){
                $products_id[]=$product['id'];
                $this->invoice[$product['id']]=$product['order'];
                $this->price[$product['id']]=$product['price'];
            }
            $this->products=\App\Models\Product::whereIn('id',$products_id ?? [])->get();
        }
        $shop=Setting::find(1);
        $startDate = Verta::parse($shop->sales_date_start);
        $endDate = Verta::parse($shop->sales_date_end);
        $diff = $startDate->diff($endDate);
        $hours = $diff->h;
        $minutes = $diff->i;
        $formattedDiff = sprintf('%02d:%02d', $hours, $minutes);
        $this->remainingTime=$formattedDiff;
    }
    public function updatedInvoice($value, $key)
    {
        if ($value){
            $product=\App\Models\Product::find($key);
            if (($product->stock + $this->invoice[$key] ?? 0) < $value ){
                unset($this->invoice[$key]);
                unset($this->price[$key]);
                return session()->flash('invoice-'.$key,'موجودی انبار: '.$product->stock);

            }
            if ($product->max < $value ){
                unset($this->invoice[$key]);
                unset($this->price[$key]);
                return session()->flash('invoice-'.$key,'حداکثر سفارش: '.$product->max);

            }
            if ($product->min > $value ){
                unset($this->invoice[$key]);
                unset($this->price[$key]);
                return session()->flash('invoice-'.$key,'حداقل سفارش: '.$product->min);
            }
            array_filter($this->invoice);
            $this->price[$product->id]=$value * $product->price;
        }else{
            unset($this->price[$key]);
            unset($this->invoice[$key]);
        }
    }

    public function save()
    {
        $shop=Setting::find(1);
        if ($shop && $shop->status == 2) {
            $startDate = Verta::parse($shop->sales_date_start);
            $endDate = Verta::parse($shop->sales_date_end);
            $now = Verta::now();
            if (!($now->between($startDate, $endDate))) {
                abort(403, 'زمان سفارش‌گیری به پایان رسیده است.');
            }
        }else{
            abort(403,'فروشگاه بسته می باشد');
        }
        DB::beginTransaction();
        $check=1;
        try {
            $bakset = \App\Models\Basket::whereDate('created_at', Carbon::today())->where('status',0)
                ->where('user_id', auth()->user()->id)
                ->pluck('product_id');

            $products = \App\Models\Product::whereIn('id', $bakset ?? [])->get();
            $invoice = Invoice::whereDate('created_at', Carbon::today())
                ->where('status',1)
                ->where('user_id', auth()->user()->id)
                ->first();
            $product_invoice = [];

            foreach ($products as $key => $product) {
                if (!isset($this->invoice[$product->id])) {
                    session()->flash('invoice-' . $key, 'محصول یافت نشد');
                    DB::rollBack();
                    $check=0;
                    break;
                } else {
                    if ($product->stock < $this->invoice[$product->id] ?? 0) {
                        session()->flash('invoice-' . $key, 'تمام شده است');
                        DB::rollBack();
                        $check=0;// تراکنش را لغو می‌کند
                        break; // از حلقه خارج می‌شود
                    } else {
                        $product->update([
                            'stock' => $product->stock - $this->invoice[$product->id],
                        ]);
                        $product_invoice[$key]['name'] = $product->name;
                        $product_invoice[$key]['id'] = $product->id;
                        $product_invoice[$key]['type'] = $product->type;
                        $product_invoice[$key]['image'] = $product->image;
                        $product_invoice[$key]['barcode'] = $product->barcode;
                        $product_invoice[$key]['price'] = $product->price;
                        $product_invoice[$key]['stock'] = $product->stock;
                        $product_invoice[$key]['order'] = $this->invoice[$product->id];
                    }
                }
            }

            if ($check) {
                $invoice=Invoice::create([
                    'user_id' => auth()->user()->id,
                    'barcode' => $this->get_barcode(),
                    'created_by' => auth()->user()->id,
                    'products' => $product_invoice,
                    'status'=>1,
                    'price' => array_sum($this->price)
                ]);
                \App\Models\Basket::whereDate('created_at', Carbon::today())
                    ->where('user_id', auth()->user()->id)
                    ->update(['status'=>1]);
                DB::commit(); // اتمام تراکنش و ذخیره‌سازی تغییرات
            }
            $products=\App\Models\Basket::where('user_id',auth()->user()->id)->update(['status'=>1]);
            return redirect()->route('profile.index',['status'=>3,'code'=>$invoice->barcode]);
        } catch (\Exception $e) {
            DB::rollBack(); // در صورت بروز خطا بازگشت به حالت قبلی
            throw $e; // ارسال خطا به سیستم یا نمایش پیغام
        }
    }

    public function update()
    {
        $shop=Setting::find(1);
        if ($shop && $shop->status == 2) {
            $startDate = Verta::parse($shop->sales_date_start);
            $endDate = Verta::parse($shop->sales_date_end);
            $now = Verta::now();
            if (!($now->between($startDate, $endDate))) {
                abort(403, 'زمان سفارش‌گیری به پایان رسیده است.');
            }
        }else{
            abort(403,'فروشگاه بسته می باشد');
        }
        DB::beginTransaction();
        $check=1;

        $has_invoice=\App\Models\Invoice::where('status',1)->whereDate('created_at', Carbon::today())->where('user_id',auth()->user()->id)->first();
        foreach ($has_invoice->products as $key => $item ) {
            $pr=Product::find($item['id']);
            $pr->update([
                'stock' => $pr->stock + $item['order'],
            ]);
        }
        try {
            $bakset = \App\Models\Basket::whereDate('created_at', Carbon::today())
                ->where('user_id', auth()->user()->id)
                ->pluck('product_id');
            $invoice = \App\Models\Invoice::whereDate('created_at', Carbon::today())
                ->where('user_id', auth()->user()->id)->first();
            $products = \App\Models\Product::whereIn('id', $bakset ?? [])->get();
            $product_invoice = [];

            foreach ($products as $key => $product) {
                if (!isset($this->invoice[$product->id])) {
                    session()->flash('invoice-' . $key, 'محصول یافت نشد');
                    DB::rollBack();
                    $check=0;
                    break;
                } else {
                    if ($product->stock < $this->invoice[$product->id] ?? 0) {
                        session()->flash('invoice-' . $key, 'تمام شده است');
                        DB::rollBack();
                        $check=0;// تراکنش را لغو می‌کند
                        break; // از حلقه خارج می‌شود
                    } else {
                        $product->update([
                            'stock' => $product->stock - $this->invoice[$product->id],
                        ]);
                        $product_invoice[$key]['name'] = $product->name;
                        $product_invoice[$key]['id'] = $product->id;
                        $product_invoice[$key]['type'] = $product->type;
                        $product_invoice[$key]['image'] = $product->image;
                        $product_invoice[$key]['barcode'] = $product->barcode;
                        $product_invoice[$key]['price'] = $product->price;
                        $product_invoice[$key]['stock'] = $product->stock;
                        $product_invoice[$key]['order'] = $this->invoice[$product->id];
                    }
                }
            }

            if ($check) {
                $invoice->update([
                    'products' => $product_invoice,
                    'status'=>1,
                    'price' => array_sum($this->price)
                ]);
                \App\Models\Basket::whereDate('created_at', Carbon::today())
                    ->where('user_id', auth()->user()->id)
                    ->update(['status'=>1]);
                DB::commit(); // اتمام تراکنش و ذخیره‌سازی تغییرات
            }
            $products=\App\Models\Basket::where('user_id',auth()->user()->id)->update(['status'=>1]);
            return redirect()->route('profile.index',['status'=>3,'code'=>$invoice->barcode]);
        } catch (\Exception $e) {
            DB::rollBack(); // در صورت بروز خطا بازگشت به حالت قبلی
            throw $e; // ارسال خطا به سیستم یا نمایش پیغام
        }


    }
    public function get_barcode()
    {
        $max=Invoice::max('barcode');
        return $max == 0 ? $max=10000 : $max+1;
    }
    public function render()
    {
        return view('livewire.home.shop.basket');
    }
}
