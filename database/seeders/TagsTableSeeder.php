<?php

namespace Database\Seeders;

use App\Models\Tags;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Tags::truncate();
        $tags = [
            'فناوری',
            'سلامت',
            'مد و زیبایی',
            'غذا و نوشیدنی',
            'ورزش',
            'سینما و تلویزیون',
            'سفر',
            'بازی‌های ویدیویی',
            'علم و تکنولوژی',
            'خانه و دکوراسیون',
            'لوازم جانبی',
            'فرهنگ و هنر',
            'اخبار',
            'تکنیک‌های کسب و کار',
            'خودرو',
            'آموزش',
            'دیجیتال مارکتینگ',
            'شبکه‌های اجتماعی',
            'عکاسی',
            'موسیقی',
            'کتاب و ادبیات',
            'محیط زیست',
            'اقتصاد',
            'تکنولوژی‌های نوین',
            'بازی‌های رومیزی',
            'تجربیات شخصی',
            'شعر و داستان',
            'مهندسی',
            'مدیریت',
            'استارتاپ‌ها',
            'علوم انسانی',
            'ساخت و ساز',
            'طراحی',
            'برنامه‌نویسی',
            'استایل زندگی',
            'عید و جشن‌ها',
            'گردشگری',
            'پخت و پز',
            'روانشناسی',
            'مدلینگ',
            'سفرهای خارج از کشور',
            'پزشکی',
            'علم روانشناسی',
            'فناوری‌های پیشرفته',
            'استفاده از ابزارها',
            'مشاوره شغلی',
            'زندگی روزمره',
            'فلسفه',
            'سبک زندگی',
            'تربیت کودک'
        ];
        foreach ($tags ?? [] as $item) {
            Tags::create([
                'title'=> $item,
                'link'=>'link',
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
