<?php

namespace App\Exports;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class InvoicesExport implements  FromCollection, WithHeadings, WithStyles,WithEvents
{
    use Exportable;

    public function __construct(array $invoices,$products=null)
    {
        $this->invoices = $invoices;
        $this->products_id = $products;
    }

    public function collection()
    {
        $type=['1'=>'عدد','2'=>'کیلو گرم'];

        if (count($this->invoices) > 0){
            $invoices=Invoice::whereIn('id',$this->invoices)->with('user')->get();
        }else{
            $invoices=Invoice::with('user')->get();

        }
        $result=collect();
        foreach ($invoices as $invoice){
            $user = $invoice->user;
            foreach ($invoice->products ?? [] as $products){
                if (count($this->products_id ?? [])){
                    if (in_array($products['id'] ?? 0,$this->products_id ?? [])){
                        $result[]=[
                            'invoice_id' => $invoice->barcode,
                            'user_name' => $user->name,
                            'code_meli' => $user->code_meli,
                            'phone' => $user->phone,
                            'product' => $products['name'],
                            'order' => $products['order'],
                            'type' => $type[$products['type'] ?? 1],
                            'price' => $invoice->price,
                            'status' => $this->getStatusText($invoice->status),
                            'order_date' => verta($invoice->created_at)->format('Y-m-d H:i:s'),
                        ];

                    }
                }else{
                        $result[]=[
                            'invoice_id' => $invoice->barcode,
                            'user_name' => $user->name,
                            'code_meli' => $user->code_meli,
                            'phone' => $user->phone,
                            'product' => $products['name'],
                            'order' => $products['order'],
                            'type' => $type[$products['type'] ?? 1],
                            'price' => $invoice->price,
                            'status' => $this->getStatusText($invoice->status),
                            'order_date' => verta($invoice->created_at)->format('Y-m-d H:i:s'),
                            'address' => $user->address,
                            'license_number' => $user->license_number,
                        ];
                }

            }
        }
        return $result;
    }

    private function getStatusText($status)
    {
        switch ($status) {
            case 1:
                return 'ثبت شده';
            case 2:
                return 'تایید شده';
            case 3:
                return 'نحویل داده شده';
           case 4:
                return 'لغو شده';
            default:
                return 'نا مشخص';
        }
    }


    public function headings(): array
    {
        return [
            'شماره فاکتور',
            'نام کاربر',
            'کد ملی',
            'شماره تلفن',
            'محصول',
            'مقدار',
            'برحسب',
            'قیمت',
            'وضعیت سفارش',
            'تاریخ سفارش',
            'آدرس',
            'شماره پروانه',
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $highestColumn = $sheet->getHighestColumn(); // دریافت آخرین ستون
                foreach (range('A', $highestColumn) as $column) {
                    $sheet->getColumnDimension($column)->setWidth(20);
                }
            },
        ];
    }
    public function styles($sheet)
    {
        $sheet->getStyle('A1:D1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->setRightToLeft(true);
    }
}
