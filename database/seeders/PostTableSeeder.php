<?php

namespace Database\Seeders;

use App\Models\Posts;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Posts::truncate();
        $faker = Faker::create('fa_IR');
        $products = [
            ['title' => 'گوشی آیفون 13', 'description' => 'آیفون 13 با طراحی جدید و قدرت بالا.', 'image_url' => 'https://example.com/images/iphone13.jpg', 'link' => 'https://example.com/iphone13'],
            ['title' => 'لپ‌تاپ دل XPS 13', 'description' => 'لپ‌تاپ سبک و قدرتمند دل XPS 13.', 'image_url' => 'https://example.com/images/dellxps13.jpg', 'link' => 'https://example.com/dellxps13'],
            ['title' => 'تلویزیون سونی 4K', 'description' => 'تلویزیون 4K با کیفیت تصویر بالا.', 'image_url' => 'https://example.com/images/sonytv.jpg', 'link' => 'https://example.com/sonytv'],
            ['title' => 'گوشی سامسونگ گلکسی S21', 'description' => 'گوشی هوشمند سامسونگ با دوربین پیشرفته.', 'image_url' => 'https://example.com/images/samsungs21.jpg', 'link' => 'https://example.com/samsungs21'],
            ['title' => 'ساعت هوشمند اپل', 'description' => 'ساعت هوشمند اپل با قابلیت‌های سلامت و تناسب اندام.', 'image_url' => 'https://example.com/images/applewatch.jpg', 'link' => 'https://example.com/applewatch'],
            ['title' => 'تبلت آیپد پرو', 'description' => 'تبلت حرفه‌ای اپل با نمایشگر بزرگ.', 'image_url' => 'https://example.com/images/ipadpro.jpg', 'link' => 'https://example.com/ipadpro'],
            ['title' => 'دوربین کانن EOS R5', 'description' => 'دوربین دیجیتال حرفه‌ای با کیفیت تصویر عالی.', 'image_url' => 'https://example.com/images/cannoneosr5.jpg', 'link' => 'https://example.com/cannoneosr5'],
            ['title' => 'کیبورد مکانیکی Razer', 'description' => 'کیبورد مکانیکی با نور پس‌زمینه RGB.', 'image_url' => 'https://example.com/images/razerkeyboard.jpg', 'link' => 'https://example.com/razerkeyboard'],
            ['title' => 'هدفون بی‌سیم Bose', 'description' => 'هدفون بی‌سیم با کیفیت صدا بالا و نویز کنسلینگ.', 'image_url' => 'https://example.com/images/boseheadphones.jpg', 'link' => 'https://example.com/boseheadphones'],
            ['title' => 'مودم TP-Link', 'description' => 'مودم با سرعت بالا و پوشش وسیع.', 'image_url' => 'https://example.com/images/tplinkmodem.jpg', 'link' => 'https://example.com/tplinkmodem'],
            ['title' => 'پرینتر لیزری HP', 'description' => 'پرینتر لیزری با کیفیت چاپ بالا و سرعت مناسب.', 'image_url' => 'https://example.com/images/hpprinter.jpg', 'link' => 'https://example.com/hpprinter'],
            ['title' => 'پروژکتور Epson', 'description' => 'پروژکتور با کیفیت تصویر عالی برای سینما خانگی.', 'image_url' => 'https://example.com/images/epsonprojector.jpg', 'link' => 'https://example.com/epsonprojector'],
            ['title' => 'روتر نت‌گیر', 'description' => 'روتر با قابلیت‌های پیشرفته و سرعت بالا.', 'image_url' => 'https://example.com/images/netgearrouter.jpg', 'link' => 'https://example.com/netgearrouter'],
            ['title' => 'خرید ابزارآلات کارگاهی', 'description' => 'ابزارآلات مختلف برای کارگاه‌ها و پروژه‌های DIY.', 'image_url' => 'https://example.com/images/workshoptools.jpg', 'link' => 'https://example.com/workshoptools'],
            ['title' => 'پایه لپ‌تاپ قابل تنظیم', 'description' => 'پایه‌ای با قابلیت تنظیم ارتفاع و زاویه.', 'image_url' => 'https://example.com/images/laptopstand.jpg', 'link' => 'https://example.com/laptopstand'],
            ['title' => 'دوربین مدار بسته', 'description' => 'دوربین نظارتی با قابلیت ضبط و پخش تصاویر.', 'image_url' => 'https://example.com/images/securitycamera.jpg', 'link' => 'https://example.com/securitycamera'],
            ['title' => 'اسپیکر بلوتوث JBL', 'description' => 'اسپیکر بلوتوث با صدای با کیفیت و قابل حمل.', 'image_url' => 'https://example.com/images/jblspeaker.jpg', 'link' => 'https://example.com/jblspeaker'],
            ['title' => 'کارت گرافیک NVIDIA', 'description' => 'کارت گرافیک با قدرت بالا برای بازی و طراحی.', 'image_url' => 'https://example.com/images/nvidiagpu.jpg', 'link' => 'https://example.com/nvidiagpu'],
            ['title' => 'میز کامپیوتر چوبی', 'description' => 'میز کامپیوتر با طراحی مدرن و کیفیت بالا.', 'image_url' => 'https://example.com/images/computerdesk.jpg', 'link' => 'https://example.com/computerdesk'],
            ['title' => 'گوشی هوشمند نوکیا', 'description' => 'گوشی نوکیا با طراحی زیبا و قابلیت‌های مناسب.', 'image_url' => 'https://example.com/images/nokiaphone.jpg', 'link' => 'https://example.com/nokiaphone'],
            ['title' => 'هارد اکسترنال WD', 'description' => 'هارد دیسک خارجی با ظرفیت بالا و سرعت مناسب.', 'image_url' => 'https://example.com/images/wdexternalharddrive.jpg', 'link' => 'https://example.com/wdexternalharddrive'],
            ['title' => 'دستگاه تصفیه هوا', 'description' => 'تصفیه‌کننده هوای با قابلیت حذف آلاینده‌ها.', 'image_url' => 'https://example.com/images/airpurifier.jpg', 'link' => 'https://example.com/airpurifier'],
            ['title' => 'چراغ مطالعه LED', 'description' => 'چراغ مطالعه با نور LED و تنظیمات مختلف.', 'image_url' => 'https://example.com/images/ledlamp.jpg', 'link' => 'https://example.com/ledlamp'],
            ['title' => 'موزیک پلیر Sony', 'description' => 'پخش‌کننده موسیقی با کیفیت صدای بالا.', 'image_url' => 'https://example.com/images/sonymusicplayer.jpg', 'link' => 'https://example.com/sonymusicplayer'],
            ['title' => 'کیف لپ‌تاپ با کیفیت', 'description' => 'کیف با طراحی زیبا و مناسب برای لپ‌تاپ.', 'image_url' => 'https://example.com/images/laptopbag.jpg', 'link' => 'https://example.com/laptopbag'],
            ['title' => 'ترازو دیجیتال', 'description' => 'ترازوی دیجیتال با دقت بالا برای اندازه‌گیری وزن.', 'image_url' => 'https://example.com/images/digitalscale.jpg', 'link' => 'https://example.com/digitalscale'],
            ['title' => 'دستگاه بخور سرد', 'description' => 'بخور سرد با عملکرد آرام و مؤثر.', 'image_url' => 'https://example.com/images/coolmistmaker.jpg', 'link' => 'https://example.com/coolmistmaker'],
            ['title' => 'پایه نگهدارنده موبایل', 'description' => 'پایه‌ای با قابلیت نگهداری موبایل در موقعیت‌های مختلف.', 'image_url' => 'https://example.com/images/phoneholder.jpg', 'link' => 'https://example.com/phoneholder'],
            ['title' => 'پایه شارژ بی‌سیم', 'description' => 'پایه شارژ بی‌سیم با قابلیت شارژ سریع.', 'image_url' => 'https://example.com/images/wirelesscharger.jpg', 'link' => 'https://example.com/wirelesscharger'],
            ['title' => 'موزر ماشین اصلاح', 'description' => 'ماشین اصلاح با تیغه‌های دقیق و کیفیت بالا.', 'image_url' => 'https://example.com/images/hairclippers.jpg', 'link' => 'https://example.com/hairclippers'],
            ['title' => 'قهوه‌ساز برقی', 'description' => 'قهوه‌ساز با قابلیت تنظیم درجه حرارت و زمان.', 'image_url' => 'https://example.com/images/coffeemaker.jpg', 'link' => 'https://example.com/coffeemaker'],
            ['title' => 'کیف دوربین عکاسی', 'description' => 'کیف محافظ برای دوربین‌های عکاسی.', 'image_url' => 'https://example.com/images/camerabag.jpg', 'link' => 'https://example.com/camerabag'],
            ['title' => 'اسکنر مستند', 'description' => 'اسکنر با قابلیت اسکن با کیفیت و سرعت بالا.', 'image_url' => 'https://example.com/images/docscanner.jpg', 'link' => 'https://example.com/docscanner'],
            ['title' => 'پروژکتور سینما خانگی', 'description' => 'پروژکتور با کیفیت تصویر بالا برای تماشای فیلم.', 'image_url' => 'https://example.com/images/homeprojector.jpg', 'link' => 'https://example.com/homeprojector'],
            ['title' => 'چراغ خواب LED', 'description' => 'چراغ خواب با نور ملایم و قابلیت تنظیم.', 'image_url' => 'https://example.com/images/lednightlight.jpg', 'link' => 'https://example.com/lednightlight'],
            ['title' => 'گوشی هوشمند شیائومی', 'description' => 'گوشی شیائومی با امکانات پیشرفته و قیمت مناسب.', 'image_url' => 'https://example.com/images/xiaomiphone.jpg', 'link' => 'https://example.com/xiaomiphone'],
            ['title' => 'گیم‌پد بی‌سیم', 'description' => 'گیم‌پد بی‌سیم با قابلیت‌های کامل برای بازی.', 'image_url' => 'https://example.com/images/wirelessgamepad.jpg', 'link' => 'https://example.com/wirelessgamepad'],
            ['title' => 'پخش‌کننده Blu-ray', 'description' => 'پخش‌کننده Blu-ray با کیفیت تصویر بالا.', 'image_url' => 'https://example.com/images/blu-rayplayer.jpg', 'link' => 'https://example.com/blu-rayplayer'],
            ['title' => 'ساعت دیواری دیجیتال', 'description' => 'ساعت دیواری با نمایش دیجیتال و امکانات متنوع.', 'image_url' => 'https://example.com/images/digitalclock.jpg', 'link' => 'https://example.com/digitalclock'],
            ['title' => 'پایه لپ‌تاپ قابل حمل', 'description' => 'پایه لپ‌تاپ با قابلیت حمل و تنظیم آسان.', 'image_url' => 'https://example.com/images/portablelaptopstand.jpg', 'link' => 'https://example.com/portablelaptopstand'],
            ['title' => 'هندزفری بی‌سیم', 'description' => 'هندزفری بی‌سیم با کیفیت صدا و اتصال پایدار.', 'image_url' => 'https://example.com/images/wirelessheadphones.jpg', 'link' => 'https://example.com/wirelessheadphones'],
            ['title' => 'میکروفون استودیویی', 'description' => 'میکروفون با کیفیت بالا برای ضبط صدا.', 'image_url' => 'https://example.com/images/studiomicrophone.jpg', 'link' => 'https://example.com/studiomicrophone'],
            ['title' => 'اسپیکر بلوتوث کوچک', 'description' => 'اسپیکر بلوتوثی کوچک و قابل حمل.', 'image_url' => 'https://example.com/images/portablebluetoothspeaker.jpg', 'link' => 'https://example.com/portablebluetoothspeaker'],
            ['title' => 'هدست گیمینگ', 'description' => 'هدست گیمینگ با کیفیت صدا و میکروفون مناسب.', 'image_url' => 'https://example.com/images/gamingheadset.jpg', 'link' => 'https://example.com/gamingheadset'],
            ['title' => 'بخارشوی خانگی', 'description' => 'بخارشوی با قدرت بخار بالا و طراحی ارگونومیک.', 'image_url' => 'https://example.com/images/steamcleaner.jpg', 'link' => 'https://example.com/steamcleaner'],
            ['title' => 'پاوربانک بزرگ', 'description' => 'پاوربانک با ظرفیت بالا برای شارژ سریع.', 'image_url' => 'https://example.com/images/largepowerbank.jpg', 'link' => 'https://example.com/largepowerbank'],
            ['title' => 'تلویزیون هوشمند سامسونگ', 'description' => 'تلویزیون هوشمند با امکانات گسترده و کیفیت بالا.', 'image_url' => 'https://example.com/images/samsungsmarttv.jpg', 'link' => 'https://example.com/samsungsmarttv'],
            ['title' => 'کابل HDMI با کیفیت', 'description' => 'کابل HDMI با کیفیت بالا برای انتقال تصویر.', 'image_url' => 'https://example.com/images/highqualityhdmicable.jpg', 'link' => 'https://example.com/highqualityhdmicable'],
            ['title' => 'مینی پروژکتور', 'description' => 'پروژکتور کوچک و قابل حمل با کیفیت تصویر مناسب.', 'image_url' => 'https://example.com/images/miniprojector.jpg', 'link' => 'https://example.com/miniprojector'],
            ['title' => 'شارژر فندکی خودرو', 'description' => 'شارژر فندکی خودرو با قابلیت شارژ سریع.', 'image_url' => 'https://example.com/images/carcharger.jpg', 'link' => 'https://example.com/carcharger'],
            ['title' => 'جاروبرقی رباتیک', 'description' => 'جاروبرقی رباتیک با قابلیت برنامه‌ریزی و نظافت خودکار.', 'image_url' => 'https://example.com/images/robotvacuum.jpg', 'link' => 'https://example.com/robotvacuum'],
            ['title' => 'سینمای خانگی', 'description' => 'سیستم سینمای خانگی با کیفیت صدای بالا و امکانات مدرن.', 'image_url' => 'https://example.com/images/homecinema.jpg', 'link' => 'https://example.com/homecinema'],
            ['title' => 'دوربین اکشن', 'description' => 'دوربین اکشن برای ثبت تصاویر و فیلم‌های هیجان‌انگیز.', 'image_url' => 'https://example.com/images/actioncamera.jpg', 'link' => 'https://example.com/actioncamera'],
            ['title' => 'موس گیمینگ', 'description' => 'موس گیمینگ با دقت بالا و طراحی ارگونومیک.', 'image_url' => 'https://example.com/images/gamingmouse.jpg', 'link' => 'https://example.com/gamingmouse'],
            ['title' => 'کیف لپ‌تاپ ضدآب', 'description' => 'کیف لپ‌تاپ با قابلیت ضدآب و طراحی مقاوم.', 'image_url' => 'https://example.com/images/waterprooflaptopbag.jpg', 'link' => 'https://example.com/waterprooflaptopbag'],
            ['title' => 'گوشی موبایل نوکیا', 'description' => 'گوشی نوکیا با طراحی ساده و کاربردی.', 'image_url' => 'https://example.com/images/nokiaphone2.jpg', 'link' => 'https://example.com/nokiaphone2'],
            ['title' => 'لوازم جانبی دوربین', 'description' => 'لوازم جانبی مختلف برای دوربین‌های عکاسی.', 'image_url' => 'https://example.com/images/cameraaccessories.jpg', 'link' => 'https://example.com/cameraaccessories'],
            ['title' => 'پایه نگهدارنده تبلت', 'description' => 'پایه‌ای برای نگهداری تبلت در موقعیت‌های مختلف.', 'image_url' => 'https://example.com/images/tabletholder.jpg', 'link' => 'https://example.com/tabletholder'],
            ['title' => 'دستگاه رطوبت‌ساز', 'description' => 'دستگاه رطوبت‌ساز با قابلیت تنظیم رطوبت.', 'image_url' => 'https://example.com/images/humidifier.jpg', 'link' => 'https://example.com/humidifier'],
            ['title' => 'پورت شارژر چندگانه', 'description' => 'پورت شارژر با قابلیت شارژ چندین دستگاه به طور همزمان.', 'image_url' => 'https://example.com/images/multiportcharger.jpg', 'link' => 'https://example.com/multiportcharger'],
            ['title' => 'فلاش دوربین', 'description' => 'فلاش دوربین با قدرت بالا و قابلیت تنظیم.', 'image_url' => 'https://example.com/images/cameraflash.jpg', 'link' => 'https://example.com/cameraflash'],
            ['title' => 'کیف دوربین با طراحی شیک', 'description' => 'کیف دوربین با طراحی زیبا و کیفیت بالا.', 'image_url' => 'https://example.com/images/stylishcamerabag.jpg', 'link' => 'https://example.com/stylishcamerabag'],
        ];
        $i=1;
        foreach ($products ?? [] as $item){
            Posts::create([
                'title'=> $item['title'],
                'slug'=>$this->create_slug($faker->slug(5)),
                'description'=>$item['description'],
                'image'=>'uploads/defualt.png',
                'order'=>$i,
                'category_id'=>rand(1,25)
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
