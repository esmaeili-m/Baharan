<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        $faker = Faker::create('fa_IR');
        $categories = [
            ['name' => 'وسایل الکترونیک', 'description' => 'دسته‌بندی شامل انواع وسایل الکترونیکی مانند تلویزیون، گوشی موبایل، و لپ‌تاپ.'],
            ['name' => 'پوشاک', 'description' => 'دسته‌بندی شامل انواع پوشاک مردانه، زنانه و کودکانه.'],
            ['name' => 'غذا و نوشیدنی', 'description' => 'دسته‌بندی شامل مواد غذایی و نوشیدنی‌های مختلف.'],
            ['name' => 'خانگی و دکوری', 'description' => 'دسته‌بندی شامل لوازم خانگی و دکوراتیو.'],
            ['name' => 'کتاب و لوازم التحریر', 'description' => 'دسته‌بندی شامل انواع کتاب و لوازم‌التحریر.'],
            ['name' => 'آرایشی و بهداشتی', 'description' => 'دسته‌بندی شامل محصولات آرایشی و بهداشتی.'],
            ['name' => 'ورزشی و تفریحی', 'description' => 'دسته‌بندی شامل لوازم ورزشی و تفریحی.'],
            ['name' => 'محصولات دیجیتال', 'description' => 'دسته‌بندی شامل انواع محصولات دیجیتال مانند دوربین و لپ‌تاپ.'],
            ['name' => 'لوازم جانبی', 'description' => 'دسته‌بندی شامل لوازم جانبی مختلف برای دستگاه‌ها و تجهیزات.'],
            ['name' => 'اسباب بازی', 'description' => 'دسته‌بندی شامل انواع اسباب بازی برای کودکان.'],
            ['name' => 'مبلمان', 'description' => 'دسته‌بندی شامل انواع مبلمان خانگی و اداری.'],
            ['name' => 'صوتی و تصویری', 'description' => 'دسته‌بندی شامل تجهیزات صوتی و تصویری.'],
            ['name' => 'تجهیزات عکاسی', 'description' => 'دسته‌بندی شامل انواع تجهیزات عکاسی و فیلمبرداری.'],
            ['name' => 'سلامت و تناسب اندام', 'description' => 'دسته‌بندی شامل محصولات مرتبط با سلامت و تناسب اندام.'],
            ['name' => 'کیف و کفش', 'description' => 'دسته‌بندی شامل انواع کیف و کفش برای مردان، زنان و کودکان.'],
            ['name' => 'مواد غذایی ارگانیک', 'description' => 'دسته‌بندی شامل مواد غذایی ارگانیک و طبیعی.'],
            ['name' => 'ابزارآلات', 'description' => 'دسته‌بندی شامل ابزارآلات مختلف برای کارگاه‌ها و خانه.'],
            ['name' => 'لوازم کشاورزی', 'description' => 'دسته‌بندی شامل لوازم و تجهیزات کشاورزی.'],
            ['name' => 'محصولات هنری', 'description' => 'دسته‌بندی شامل محصولات هنری و صنایع دستی.'],
            ['name' => 'زیورآلات و ساعت', 'description' => 'دسته‌بندی شامل انواع زیورآلات و ساعت‌های مچی.'],
            ['name' => 'خودرو و لوازم جانبی', 'description' => 'دسته‌بندی شامل انواع خودرو و لوازم جانبی مربوط به خودرو.'],
            ['name' => 'لوازم جانبی موبایل', 'description' => 'دسته‌بندی شامل لوازم جانبی مختلف برای موبایل.'],
            ['name' => 'پزشکی و دارو', 'description' => 'دسته‌بندی شامل محصولات پزشکی و داروهای مختلف.']
        ];
        $i=1;
        foreach ($categories ?? [] as $item){
            Category::create([
               'title'=> $item['name'],
                'slug'=>$this->create_slug($faker->slug(5)),
                'description'=>$item['description'],
                'image'=>'uploads/defualt.png',
                'order'=>$i
            ]);
            $i++;
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function create_slug($text)
    {
        return str_replace(' ','-',$text);
    }
}
