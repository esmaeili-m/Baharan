<?php

namespace App\Livewire\Dashboard;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Livewire\Attributes\Url;
use Livewire\Component;

class Index extends Component
{
    #[Url]
    public $status=1;
    public $users;
    public $from;
    public $from_date;
    public $to_date;
    public $to;
    public $invoice;
    public $invoice_filter;
    public $fillter_user;
    public $selectedUser=[];
    public $selectedProduct=[];
    public function set_status($status)
    {
        $this->status=$status;
    }

    public function fillter()
    {
        $invoice = Invoice::query();

        if ($this->from  || $this->to){
            $this->from_date = $this->from
                ? Verta::parse($this->from)->datetime()
                : Verta::now()->datetime();

            $this->to_date = $this->to
                ? Verta::parse($this->to)->datetime()
                : Verta::now()->datetime();
            $invoice = $invoice->whereBetween('created_at', [$this->from_date, $this->to_date]);
        }
        if ($this->status == 4){
            $invoice = $invoice->where('status', 2);
            if ($this->selectedUser && !($this->selectedUser['all'] ?? 'false') == 'all'){
                $this->invoice=$invoice->whereIn('user_id', array_keys(array_filter($this->selectedUser)))->get();
            }else{
                $this->invoice=$invoice->get();
            }
            $sales = [];
            $products=$this->invoice->pluck('products')->toArray();
            foreach ($products as $productGroup) {
                foreach ($productGroup as $product) {
                    $id = $product['id'];
                    if (isset($sales[$id])) {
                        $sales[$id]['total_orders'] += (int)$product['order'];
                    } else {
                        $sales[$id] = [
                            'name' => $product['name'],
                            'total_orders' => (int)$product['order']
                        ];
                    }
                }
            }
            $productSales = [
                'names' => array_column($sales, 'name'),
                'totals' => array_column($sales, 'total_orders')
            ];
            $this->dispatch('created-chart',products:$productSales);
        }elseif ($this->status == 1){
            $this->invoice=$invoice->get();
        }elseif($this->status == 2){
            if ($this->selectedProduct && !($this->selectedProduct['all'] ?? 'false') == 'all'){
                $products=Product::whereIn('id', array_keys(array_filter($this->selectedProduct)))->pluck('id')->toArray();
            }else{
                $products=Product::withTrashed()->pluck('id')->toArray();
            }
            $price=[];
            foreach ($invoice->whereIn('status',[2,3])->get() as $item) {
                foreach ($item->products ?? [] as $product) {
                    if (in_array($product['id'],$products)) {
                        $price[$product['id']]['price']=($price[$product['id']]['price'] ?? 0)+($product['price']* $product['order']);
                        $price[$product['id']]['name']=$product['name'];
                    }

                }

            }
            $productSales = [
                'names' => array_column($price, 'name'),
                'totals' => array_column($price, 'price')
            ];
            $this->dispatch('created-chart',products:$productSales);
        }


    }
    public function mount()
    {
        if (request()->has('status')) {
            $this->status = request()->status;
        }
        $this->fillter();

    }

    public function get_users($check)
    {
        if ($check == 'select'){
            $this->users=User::where('status',3)->where('role_id',1)->pluck('name','id');
        }else{
            $this->users=0;
            $this->selectedUser=[];
        }
    }
    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
