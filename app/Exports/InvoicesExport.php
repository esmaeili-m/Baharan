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

    public function __construct(array $invoices)
    {
        $this->invoices = $invoices;
    }

    public function collection()
    {
        $type=['1'=>'عدد','2'=>'کیلو گرم'];

        if (count($this->invoices) > 0){
            $invoices=Invoice::whereIn('id',$this->invoices)->with('user')->get();
        }else{
            $invoices=Invoice::with('user')->get();

        }
        return $invoices->map(function ($invoice) use ($type) {
            $user = $invoice->user;
            $products_invoice=null;
            foreach ($invoice->products ?? [] as $products){
                $products_invoice=$products_invoice.' | '.$products['name'].' -> '.$products['order'] .' '. $type[$products['type']];
            }
            return [
                'invoice_id' => $invoice->id,
                'user_name' => $user->name.'( '.$user->code_meli.' )',
                'products' => $products_invoice,
                'price' => $invoice->price,
                'status' => $this->getStatusText($invoice->status),
                'order_date' => $invoice->created_at,
            ];
        });
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
            'محصولات',
            'قیمت',
            'وضعیت سفارش',
            'تاریخ سفارش',
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
