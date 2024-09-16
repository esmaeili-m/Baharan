<?php

namespace App\Livewire\Home\Auth;

use App\Models\Code;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class Login extends Component
{
    use WithFileUploads;
    public $phone,$status,$code,$submit_information,$name,$email,$code_meli,$avatar,$user;
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
             return $this->dispatch('alert',icon:'error',message:'کد احراز هویت برای شما ارسال شده است لطفا چند دقیقه دیگر امتحان کنید');
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
                $this->email=$this->user->email;
            }
            \session()->put('register',$this->phone);
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
    public function register_user()
    {
        $this->validate([
            'name' => ['required'],
            'code_meli' => ['required','size:10','unique:users,code_meli'],
            'email' => ['required ','unique:users,email'],
            'phone' => ['required', 'regex:/^0[0-9]{10}$/','unique:users,phone'],
        ], [
            'name.required' => 'این فیلد الزامی می باشد',
            'code_meli.required' => 'این فیلد الزامی می باشد',
            'email.required' => 'این فیلد الزامی می باشد',
            'phone.required' => 'این فیلد الزامی می باشد',
            'phone.regex' => 'شماره همراه نامعتبر می باشد.',
            'phone.unique'=>'این شماره همراه استفاده شده است لطفا شماره همراه دیگری را وارد کنید',
            'code_meli.unique'=>'این کد ملی استفاده شده است',
            'email.unique'=>'این ایمیل استفاده شده است لطفا ایمیل دیگری را وارد کنید',
            'code_meli.size'=>'کد ملی نامعتبر می باشد',
        ]);
            User::create([
                'name'=>$this->name,
                'email'=>$this->email,
                'phone'=>$this->phone,
                'role_id'=>1,
                'code_meli'=>$this->code_meli
            ]);
        $this->dispatch('alert',icon:'success',message:'اطالاعات شما با موفقیت ثبت شد');
    }

    public function user_update()
    {
        $this->validate([
            'name' => ['required'],
            'code_meli' => ['required','size:10','unique:users,code_meli,'.$this->user->id],
            'email' => ['required ','unique:users,email,'.$this->user->id],
        ], [
            'name.required' => 'این فیلد الزامی می باشد',
            'code_meli.required' => 'این فیلد الزامی می باشد',
            'email.required' => 'این فیلد الزامی می باشد',
            'code_meli.unique'=>'این کد ملی استفاده شده است',
            'email.unique'=>'این ایمیل استفاده شده است لطفا ایمیل دیگری را وارد کنید',
            'code_meli.size'=>'کد ملی نامعتبر می باشد',
        ]);
        $this->user->update([
            'name'=>$this->name,
            'email'=>$this->email,
            'status'=>1,
            'code_meli'=>$this->code_meli
        ]);
        $this->dispatch('alert',icon:'success',message:'اطالاعات شما با موفقیت برروزرسانی شد');

    }
    public function UpdatedAvatar()
    {
        $this->avatar=upload_file($this->avatar,'auth');
    }

    public function mount()
    {
        if (\session()->has('register')){
            $this->submit_information=1;
            $this->user=User::where('phone',session()->get('register'))->first();
            if ($this->user){
                $this->name=$this->user->name;
                $this->phone=$this->user->phone;
                $this->code_meli=$this->user->code_meli;
                $this->email=$this->user->email;
            }
        }
    }
    public function render()
    {
        return view('livewire.home.auth.login')->layout('layouts.auth');
    }
}
