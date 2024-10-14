<?php

namespace App\Livewire\Home\Auth;

use App\Models\Code;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class Login extends Component
{
    use WithFileUploads;
    public $phone,$status,$code,$submit_information,$name,$email,$code_meli,$avatar,$user,$father,
        $day,$month,$years,$license_day,$license_month,$license_years,$address,$type,$license_number,$license_image;
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
            'name' => ['required'],
            'code_meli' => ['required','size:10','unique:users,code_meli'],
            'father' => ['required'],
            'day' => ['required','not_in:0' ],
            'month' => ['required','not_in:0' ],
            'years' => ['required','not_in:0' ],
            'license_day' => ['required','not_in:0' ],
            'license_month' => ['required','not_in:0' ],
            'license_years' => ['required','not_in:0' ],
            'address' => ['required'],
            'type' => ['required'],
            'license_number' => ['required'],
            'license_image' => ['required'],
            'phone' => ['required', 'regex:/^0[0-9]{10}$/','unique:users,phone'],
        ], [
            'name.required' => 'این فیلد الزامی می باشد',
            'license_number.required' => 'این فیلد الزامی می باشد',
            'day.required' => 'این فیلد الزامی می باشد',
            'month.required' => 'این فیلد الزامی می باشد',
            'type.required' => 'این فیلد الزامی می باشد',
            'license_image.required' => 'این فیلد الزامی می باشد',
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
        ]);
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
            'name' => ['required'],
            'code_meli' => ['required','size:10','unique:users,code_meli,'.$this->user->id],
            'father' => ['required'],
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
        ]);
        $this->user->update([
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
            'phone'=>$this->phone,
        ]);
        $this->dispatch('alert',icon:'success',message:'اطالاعات شما با موفقیت برروزرسانی شد');

    }
    public function UpdatedAvatar()
    {
        $this->avatar=upload_file($this->avatar,'auth');

    }
    public function UpdatedLicenseImage()
    {

        $this->license_image=upload_file($this->license_image,'auth');
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
