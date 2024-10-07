<?php

namespace App\Livewire\Home\Shop;

use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

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

        $products=\App\Models\Basket::whereDate('created_at', Carbon::today())->where('user_id',auth()->user()->id)->pluck('product_id');
        $this->products=\App\Models\Product::whereIn('id',$products ?? [])->get();
        $this->remainingTime='00:01';
    }
    public function updatedInvoice($value, $key)
    {
        if ($value){
            $product=\App\Models\Product::find($key);
            if ($product->stock < $value ){
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
        DB::beginTransaction(); // شروع تراکنش
        $check=1;
        try {
            $bakset = \App\Models\Basket::whereDate('created_at', Carbon::today())
                ->where('user_id', auth()->user()->id)
                ->pluck('product_id');
            $products = \App\Models\Product::whereIn('id', $bakset ?? [])->get();
            $invoice = Invoice::whereDate('created_at', Carbon::today())
                ->where('user_id', auth()->user()->id)
                ->first();
            $product_invoice = [];

            foreach ($products as $key => $product) {
                if (!isset($this->invoice[$product->id])) {
                    session()->flash('invoice-' . $key, 'محصول یافت نشد');
                    DB::rollBack();
                    $check=0;// تراکنش را لغو می‌کند
                    break; // از حلقه خارج می‌شود
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
                        $product_invoice[$key]['type'] = $product->type;
                        $product_invoice[$key]['image'] = $product->image;
                        $product_invoice[$key]['barcode'] = $product->barcode;
                        $product_invoice[$key]['price'] = $product->price;
                        $product_invoice[$key]['stock'] = $product->stock;
                        $product_invoice[$key]['order'] = $this->invoice[$product->id];
                    }
                }
            }

            // اگر هیچ خطایی وجود نداشت، عملیات ادامه پیدا می‌کند
            if ($check) {
                Invoice::create([
                    'user_id' => auth()->user()->id,
                    'barcode' => $this->get_barcode(),
                    'created_by' => auth()->user()->id,
                    'products' => $product_invoice,
                    'price' => array_sum($this->price)
                ]);
                \App\Models\Basket::whereDate('created_at', Carbon::today())
                    ->where('user_id', auth()->user()->id)
                    ->update(['status'=>1]);
                DB::commit(); // اتمام تراکنش و ذخیره‌سازی تغییرات
            }

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