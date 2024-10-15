<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class Setting extends Component
{
    public $name;
    public $start;
    public $end;
    public $status=1;
    public $description;

    public function save()
    {
        $this->validate([
            'name' => ['required'],
            'start' => ['required','date_format:Y-m-d H:i:s'],
            'end' => ['required','date_format:Y-m-d H:i:s' ],
            'status' => ['required' ],

        ], [
            'name.required' => 'لطفا نام را وارد کنید.',
            'start.required' => 'لطفا تاریخ شروع را وارد کنید.',
            'start.date_format' => 'فرمت تاریخ شروع باید به صورت Y-m-d H:i:s باشد.',
            'end.required' => 'لطفا تاریخ پایان را وارد کنید.',
            'end.date_format' => 'فرمت تاریخ پایان باید به صورت Y-m-d H:i:s باشد.',
            'status.required' => 'لطفا وضعیت را مشخص کنید.',

        ]);
        \App\Models\Setting::updateOrCreate(
            [
                'id' => 1
            ],
            [
                'name' => $this->name ,
                'sales_date_start' => $this->start,
                'sales_date_end' => $this->end,
                'about' => $this->description,
                'status' => $this->status
            ]
        );
        create_log(2,auth()->user()->id,'تنظیمات سایت','[  ]');

        return $this->dispatch('alert',icon:'success',message:'تنظیمات فروشگاه با موفقیت ثبت شد');

    }

    public function mount()
    {
        $setting=\App\Models\Setting::find(1);
        if ($setting){
            $this->name = $setting->name;
            $this->start = $setting->sales_date_start;
            $this->end = $setting->sales_date_end;
            $this->status = $setting->status;
            $this->description = $setting->about;
        }

    }
    public function render()
    {
        return view('livewire.dashboard.setting');
    }
}
