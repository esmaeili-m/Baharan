<?php

namespace App\Livewire\Dashboard;

use App\Models\Invoice;
use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;

class Index extends Component
{
    #[Url]
    public $status=1;
    public $users;
    public $fillter_user;
    public $selectedUser=[];
    public function set_status($status)
    {
        $this->status=$status;
    }

    public function fillter()
    {
        if ($this->status == 4){
            $invoice=Invoice::query();
            if ($this->users){
                $invoice=$invoice->whereIn('user_id', $this->users)->get();
            }else{
                $invoice=$invoice->get();
            }
            $sales = [];
            $products=$invoice->pluck('products')->toArray();
            foreach ($products as $productGroup) {
                foreach ($productGroup as $product) {
                    $id = $product['id'];

                    // اگر محصول قبلاً در آرایه $sales وجود داشته باشد، مجموع سفارشات آن را اضافه می‌کنیم
                    if (isset($sales[$id])) {
                        $sales[$id]['total_orders'] += (int)$product['order'];
                    } else {
                        // در غیر این صورت، محصول جدید را اضافه می‌کنیم
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
        }
    }
    public function mount()
    {
        if (request()->has('status')) {
            $this->status = request()->status;
        }

    }

    public function get_users($check)
    {
        if ($check == 'select'){
            $this->users=User::where('status',3)->where('role_id',1)->pluck('name','id');
        }else{
            $this->users=0;
        }
    }
    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
