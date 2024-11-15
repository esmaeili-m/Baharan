<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class UsersExport implements FromQuery, WithHeadings, WithStyles,WithEvents
{
    use Exportable;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function query()
    {
        if (count($this->users) > 0){
            $usersQuery = User::query()
                ->whereIn('id', $this->users)
                ->select('name', 'phone', 'code_meli','father','birthday','address','type','license_number','license_date',
                    DB::raw('CASE
                            WHEN status = 1 THEN "ثبت شده"
                            WHEN status = 2 THEN "در انتظار تایید"
                            WHEN status = 3 THEN "تایید شده"
                            ELSE "نا مشخص"
                        END as status')
                );
        }else{
            $usersQuery = User::select('name', 'phone', 'code_meli','father','birthday','address','type','license_number','license_date',
                DB::raw('CASE
                        WHEN status = 1 THEN "ثبت شده"
                        WHEN status = 2 THEN "در انتظار تایید"
                        WHEN status = 3 THEN "تایید شده"
                        ELSE "نا مشخص"
                    END as status')
            );
        }

        return $usersQuery;
    }
    public function headings(): array
    {
        return [
            'نام',
            'تلفن',
            'کد ملی',
            'نام پدر',
            'تاریخ تولد',
            'آدرس',
            'نوع مالکیت',
            'شماره مجوز',
            'تاریخ مجوز',
            'وضعیت',
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
