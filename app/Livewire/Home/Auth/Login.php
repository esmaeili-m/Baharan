<?php

namespace App\Livewire\Home\Auth;

use App\Models\Code;
use App\Models\Transaction;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Login extends Component
{
    use WithFileUploads;
    public $phone,$status,$code,$submit_information,$name,$email,$code_meli,$avatar,$user,$father,
        $day,$month,$years,$license_day,$license_month,$license_years,$address,$type,$license_number,$license_image;
//href="{{route('profile.index')}}"
    public function cost()
    {
        $tr_code=$this->generate_tr_code();
        Transaction::create([
            'user_id'=>\auth()->user()->id,
            'tr_code'=>$tr_code,
        ]);
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Cookie' => 'ASP.NET_SessionId=2qmo5itwkocpuw2i2utadqd0; SEP01edab9f=017cb00b00b7a5f03d97258d4208398b390c9d35ec9afc833b40fcdc2e4cba452a7b91e00d1ad5fae10351182ef0a3b612954ece596d96ac0313fb333a80af0416520c4320'
        ];
        $dynamicResNum =$tr_code; // مقدار پویا برای ResNum
        $dynamicCellNumber = \auth()->user()->phone; // مقدار پویا برای CellNumber
        $body = json_encode([
            "action" => "token",
            "TerminalId" => "14615539",
            "Amount" => 12000,
            "ResNum" => $dynamicResNum,
            "RedirectUrl" => "https://mottahedzarrin.ir/home/receipt",
            "CellNumber" => $dynamicCellNumber
        ]);
        $request = new Request('POST', 'https://sep.shaparak.ir/onlinepg/onlinepg', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        $response = json_decode($res->getBody()->getContents(), true);
        $token = $response['token'];
        $getMethod = '';
        return view('livewire.home.redirect', compact('token', 'getMethod'));    }
    public function generate_tr_code()
    {
        do {
            $trCode = rand(10000, 99999).Str::random(6);
            $exists = Transaction::where('tr_code', $trCode)->exists();
        } while ($exists);
        return $trCode;
    }
    public function get_code()
    {
        $this->validate([
            'phone' => ['required', 'regex:/^0[0-9]{10}$/'],
        ], [
            'phone.required' => 'وارد کردن شماره تلفن الزامی است.',
            'phone.regex' => 'شماره تلفن نامعتبر می باشد.',
        ]);
        $check=Code::where('phone',$this->phone)->where('created_at', '>=', now()->subMinutes(2))->exists();
        $this->status=1;
        if ($check){
            return $this->dispatch('alert',icon:'success',message:'کد احراز هویت برای شما ارسال گردید');
        }else{
            Code::where('phone',$this->phone)->delete();
            $code=$this->generate_code();
            $wsdlUrl = 'http://webservice.0098sms.com/service.asmx?wsdl';
            ini_set("soap.wsdl_cache_enabled", "0");
            try {
                $smsClient = new \SoapClient($wsdlUrl, [
                    'encoding' => 'UTF-8',
                    'exceptions' => true, // فعال کردن پرتاب خطاهای SOAP
                    'trace' => 1, // فعال کردن trace برای دیباگینگ
                ]);

                $parameters = [
                    'username' => 'smsn5232',
                    'password' => '*Nf(Dc8Ptq77',
                    'mobileno' => $this->phone,
                    'pnlno'    => '30005367676767',
                    'text'     => " به بهاران خوش آمدید.\nکد ورود شما: $code",
                    'isflash'  => false,
                ];
                $result = $smsClient->SendSMS($parameters)->SendSMSResult;

            } catch (\Exception $e) {
                Log::info($e);
            }
            Code::create([
                'code'=>$code,
                'phone'=>$this->phone
            ]);



            return $this->dispatch('alert',icon:'success',message:'کد احراز هویت برای شما ارسال گردید');
        }
    }

    public function check_code()
    {
        $this->validate([
            'code' => ['required', 'size:5'],
        ], [
            'code.required' => 'این فیلد الزامی می باشد',
            'code.size' => 'کد نامعتبر می باشد',
        ]);
        $check=Code::where('phone',$this->phone)->where('code',$this->code)->exists();
        if ($check){
            $this->submit_information=1;
            $this->user=User::where('phone',$this->phone)->first();
            if ($this->user){
                $this->name=$this->user->name;
                $this->phone=$this->user->phone;
                $this->code_meli=$this->user->code_meli;
                $this->father=$this->user->father;
                $this->address=$this->user->address;
                $this->type=$this->user->type;
                $this->license_number=$this->user->license_number;
                $this->license_image=$this->user->license_image;
                $this->avatar=$this->user->avatar;
                list($this->years,$this->month,$this->day)=explode('-',$this->user->birthday);
                list($this->license_years,$this->license_month,$this->license_day)=explode('-',$this->user->license_date);
                \session()->put('register',$this->phone);
                Auth::login($this->user);
                if ($this->user->status == 3){
                    return redirect()->route('profile.index');
                }
            }
        }else{
            Session::flash('code', 'کد نامعتبر می باشد');
        }
    }
    public function generate_code()
    {
        do {
            $otpCode = rand(10000, 99999);
            $exists = Code::where('code', $otpCode)->exists();
        } while ($exists);
        return $otpCode;
    }

    public function set_type($type)
    {
        $this->type=$type;
    }
    public function register_user()
    {
        $this->validate([
            'name' => ['required','regex:/^[\pL\s]+$/u'],
            'code_meli' => ['required', 'size:10', 'unique:users,code_meli', 'regex:/^\d{10}$/'],
            'father' => ['required','regex:/^[\pL\s]+$/u'],
            'day' => ['required','not_in:0' ],
            'month' => ['required','not_in:0' ],
            'years' => ['required','not_in:0' ],
            'license_day' => ['required','not_in:0' ],
            'license_month' => ['required','not_in:0' ],
            'license_years' => ['required','not_in:0' ],
            'address' => ['required'],
            'type' => ['required'],
            'license_number' => ['required'],
            'avatar' => [ 'nullable','image', 'mimes:jpg,jpeg,png', 'max:2048'], // حداکثر حجم 2MB
            'license_image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // حداکثر حجم 2MB
            'phone' => ['required', 'regex:/^0[0-9]{10}$/','unique:users,phone'],
        ], [
            'name.required' => 'این فیلد الزامی می باشد',
            'name.regex' => 'فقط از حروف می توانید استفاده کنید',
            'father.regex' => 'فقط از حروف می توانید استفاده کنید',
            'license_number.required' => 'این فیلد الزامی می باشد',
            'day.required' => 'این فیلد الزامی می باشد',
            'month.required' => 'این فیلد الزامی می باشد',
            'type.required' => 'این فیلد الزامی می باشد',
            'years.required' => 'این فیلد الزامی می باشد',
            'license_day.required' => 'این فیلد الزامی می باشد',
            'license_month.required' => 'این فیلد الزامی می باشد',
            'license_years.required' => 'این فیلد الزامی می باشد',
            'day.not_in' => 'این فیلد الزامی می باشد',
            'month.not_in' => 'این فیلد الزامی می باشد',
            'years.not_in' => 'این فیلد الزامی می باشد',
            'license_day.not_in' => 'این فیلد الزامی می باشد',
            'license_month.not_in' => 'این فیلد الزامی می باشد',
            'license_years.not_in' => 'این فیلد الزامی می باشد',
            'father.required' => 'این فیلد الزامی می باشد',
            'address.required' => 'این فیلد الزامی می باشد',
            'code_meli.required' => 'این فیلد الزامی می باشد',
            'phone.required' => 'این فیلد الزامی می باشد',
            'phone.regex' => 'شماره همراه نامعتبر می باشد.',
            'phone.unique'=>'این شماره همراه استفاده شده است لطفا شماره همراه دیگری را وارد کنید',
            'code_meli.unique'=>'این کد ملی استفاده شده است',
            'code_meli.size'=>'کد ملی نامعتبر می باشد',
            'code_meli.regex'=>'کد ملی نامعتبر می باشد',
            'avatar.image' => 'فایل بارگذاری شده باید یک تصویر باشد.',
            'avatar.mimes' => 'فایل باید یکی از فرمت‌های jpg, jpeg, png باشد.',
            'avatar.max' => 'حداکثر حجم تصویر 2MB است.',
            'license_image.required' => 'لطفاً تصویر پروفایل را بارگذاری کنید.',
            'license_image.image' => 'فایل بارگذاری شده باید یک تصویر باشد.',
            'license_image.mimes' => 'فایل باید یکی از فرمت‌های jpg, jpeg, png باشد.',
            'license_image.max' => 'حداکثر حجم تصویر 2MB است.',
        ]);
        if ($this->avatar){
            $this->avatar=upload_file($this->avatar,'auth');
        }
        $this->license_image=upload_file($this->license_image,'auth');
        $this->user=User::create([
                'name'=>$this->name,
                'code_meli'=>$this->code_meli,
                'father'=>$this->father,
                'birthday'=>$this->years.'-'.$this->month.'-'.$this->day,
                'address'=>$this->address,
                'type'=>$this->type,
                'license_number'=>$this->license_number,
                'license_date'=>$this->license_years.'-'.$this->license_month.'-'.$this->license_day,
                'license_image'=>$this->license_image,
                'status'=>1,
                'avatar'=>$this->avatar,
                'role_id'=>1,
                'phone'=>$this->phone,
            ]);
        Auth::login($this->user, true);
        $cookie = cookie('user_token', $this->user->id, 60 * 24 * 30);
        $this->dispatch('alert',icon:'success',message:'اطالاعات شما با موفقیت ثبت شد');
    }

    public function user_update()
    {
        $this->validate([
            'name' => ['required','regex:/^[\pL\s]+$/u'],
            'code_meli' => ['required','size:10', 'regex:/^\d{10}$/','unique:users,code_meli,'.$this->user->id],
            'father' => ['required','regex:/^[\pL\s]+$/u'],
            'day' => ['required','not_in:0' ],
            'month' => ['required','not_in:0' ],
            'years' => ['required','not_in:0' ],
            'license_day' => ['required','not_in:0' ],
            'license_month' => ['required','not_in:0' ],
            'license_years' => ['required','not_in:0' ],
            'address' => ['required'],
            'type' => ['required'],
            'license_number' => ['required'],
            'phone' => ['required', 'regex:/^0[0-9]{10}$/','unique:users,phone,'.$this->user->id],
        ], [
            'name.required' => 'این فیلد الزامی می باشد',
            'name.regex' => 'فقط از حروف می توانید استفاده کنید',
            'father.regex' => 'فقط از حروف می توانید استفاده کنید',
            'day.required' => 'این فیلد الزامی می باشد',
            'month.required' => 'این فیلد الزامی می باشد',
            'type.required' => 'این فیلد الزامی می باشد',
            'years.required' => 'این فیلد الزامی می باشد',
            'license_day.required' => 'این فیلد الزامی می باشد',
            'license_month.required' => 'این فیلد الزامی می باشد',
            'license_years.required' => 'این فیلد الزامی می باشد',
            'day.not_in' => 'این فیلد الزامی می باشد',
            'month.not_in' => 'این فیلد الزامی می باشد',
            'years.not_in' => 'این فیلد الزامی می باشد',
            'license_day.not_in' => 'این فیلد الزامی می باشد',
            'license_month.not_in' => 'این فیلد الزامی می باشد',
            'license_years.not_in' => 'این فیلد الزامی می باشد',
            'father.required' => 'این فیلد الزامی می باشد',
            'address.required' => 'این فیلد الزامی می باشد',
            'code_meli.required' => 'این فیلد الزامی می باشد',
            'phone.required' => 'این فیلد الزامی می باشد',
            'phone.regex' => 'شماره همراه نامعتبر می باشد.',
            'phone.unique'=>'این شماره همراه استفاده شده است لطفا شماره همراه دیگری را وارد کنید',
            'code_meli.unique'=>'این کد ملی استفاده شده است',
            'code_meli.size'=>'کد ملی نامعتبر می باشد',
            'code_meli.regex'=>'کد ملی نامعتبر می باشد',
            'avatar.image' => 'فایل بارگذاری شده باید یک تصویر باشد.',
            'avatar.mimes' => 'فایل باید یکی از فرمت‌های jpg, jpeg, png باشد.',
            'avatar.max' => 'حداکثر حجم تصویر 2MB است.',
            'license_image.required' => 'لطفاً تصویر پروفایل را بارگذاری کنید.',
            'license_image.image' => 'فایل بارگذاری شده باید یک تصویر باشد.',
            'license_image.mimes' => 'فایل باید یکی از فرمت‌های jpg, jpeg, png باشد.',
            'license_image.max' => 'حداکثر حجم تصویر 2MB است.',
        ]);
        $messages = [
            'avatar.mimes' => 'فرمت تصویر پروفایل باید jpg، jpeg یا png باشد.',
            'avatar.max' => 'حجم تصویر پروفایل نباید بیشتر از 2MB باشد.',
            'license_image.mimes' => 'فرمت تصویر مجوز باید jpg، jpeg یا png باشد.',
            'license_image.max' => 'حجم تصویر مجوز نباید بیشتر از 2MB باشد.',
        ];
        if ($this->avatar && $this->avatar instanceof \Illuminate\Http\UploadedFile) {
            $this->validate([
                'avatar' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2048'],
            ], $messages);
            $avatar = upload_file($this->avatar, 'auth');
        }

        if ($this->license_image && $this->license_image instanceof \Illuminate\Http\UploadedFile) {
            $this->validate([
                'license_image' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2048'],
            ], $messages);
            $license_image = upload_file($this->license_image, 'auth');
        }
        $this->user->update([
            'name'=>$this->name,
            'code_meli'=>$this->code_meli,
            'father'=>$this->father,
            'birthday'=>$this->years.'-'.$this->month.'-'.$this->day,
            'address'=>$this->address,
            'type'=>$this->type,
            'license_number'=>$this->license_number,
            'license_date'=>$this->license_years.'-'.$this->license_month.'-'.$this->license_day,
            'license_image'=>$license_image ?? $this->license_image,
            'status'=>1,
            'avatar'=>$avatar ?? $this->avatar,
            'phone'=>$this->phone,
        ]);
        $this->dispatch('alert',icon:'success',message:'اطالاعات شما با موفقیت برروزرسانی شد');

    }

    public function checkFile()
    {
        function isImageFile($filePath) {
            // بررسی کنید که فایل وجود داشته باشد
            if (!file_exists($filePath)) {
                return false;
            }else{
                return true;
            }

        }
    }
    public function mount()
    {
        if (\session()->has('register')){
            $this->submit_information=1;
            if (auth()->check()){
                $this->user=User::where('phone',session()->get('register'))->first();
                if ($this->user){
                    if ($this->user->status == 3){
                        return redirect()->route('profile.index');
                    }
                    $this->name=$this->user->name;
                    $this->phone=$this->user->phone;
                    $this->code_meli=$this->user->code_meli;
                    $this->father=$this->user->father;
                    $this->address=$this->user->address;
                    $this->type=$this->user->type;
                    $this->license_number=$this->user->license_number;
                    $this->license_image=$this->user->license_image;
                    $this->avatar=$this->user->avatar;
                    list($this->years,$this->month,$this->day)=explode('-',$this->user->birthday);
                    list($this->license_years,$this->license_month,$this->license_day)=explode('-',$this->user->license_date);
                }
            }

        }
    }
    public function render()
    {
        return view('livewire.home.auth.login')->layout('layouts.auth');
    }
}
