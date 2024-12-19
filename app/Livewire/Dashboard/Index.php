<?php

namespace App\Livewire\Dashboard;

use App\Models\Invoice;
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
    public $to;
    public $invoice;
    public $invoice_filter;
    public $fillter_user;
    public $selectedUser=[];
    public function set_status($status)
    {
        $this->status=$status;
    }

    public function fillter()
    {
        if ($this->status == 4){

            $this->from_date = $this->from
                ? Verta::parse($this->from)->datetime()
                : Verta::now()->datetime();

            $this->to_date = $this->to
                ? Verta::parse($this->to)->datetime()
                : Verta::now()->datetime();
            $invoice = Invoice::where('status', 2)
                ->whereBetween('created_at', [$this->from_date, $this->to_date]);
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
            $this->selectedUser=[];
        }
    }
    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
