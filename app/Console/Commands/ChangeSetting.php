<?php

namespace App\Console\Commands;

use App\Models\Setting;
use Hekmatinasser\Verta\Verta;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ChangeSetting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:change-setting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $setting=Setting::first();
        $start=Verta::parse($setting->sales_date_start)->addDay(1);
        $end=Verta::parse($setting->sales_date_end)->addDay(1);
        $setting->update([
           'sales_date_start' => $start,
           'sales_date_end' => $end,
        ]);
    }
}
