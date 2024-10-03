<?php

namespace App\Livewire\Dashboard\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $name,$avatar,$description,$role_id,$status,$code_meli,$father,$day,$month,$years,$license_day,$license_month,$license_years,$address,$type,$license_number,$license_image,$phone;


    public function save()
    {
        if ($this->role_id == 1){
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
                'day.required' => 'این فیلد الزامی می باشد',
                'month.required' => 'این فیلد الزامی می باشد',
                'type.required' => 'این فیلد الزامی می باشد',
                'license_image.required' => 'این فیلد الزامی می باشد',
                'license_number.required' => 'این فیلد الزامی می باشد',
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
        }else{
            $this->validate([
                'name' => ['required'],
                'phone' => ['required', 'regex:/^0[0-9]{10}$/','unique:users,phone'],
            ], [
                'name.required' => 'این فیلد الزامی می باشد',
                'phone.required' => 'این فیلد الزامی می باشد',
                'phone.regex' => 'شماره همراه نامعتبر می باشد.',
                'phone.unique'=>'این شماره همراه استفاده شده است لطفا شماره همراه دیگری را وارد کنید',
            ]);
        }

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
            'status'=>$this->status,
            'avatar'=>$this->avatar,
            'description'=>$this->description,
            'role_id'=>$this->role_id ?? 1,
            'phone'=>$this->phone,
        ]);
        session()->flash('message', 'کاربر با موفقیت ایجاد شد');
        return redirect()->route('user.list');
    }
    public function UpdatedAvatar()
    {
        $this->avatar=upload_file($this->avatar,'users');
    }
    public function UpdatedLicenseImage()
    {

        $this->license_image=upload_file($this->license_image,'auth');
    }
    public function mount()
    {
        $this->role_id=1;
        $this->status=1;
        $this->type='مالک';
    }
    public function render()
    {
        return view('livewire.dashboard.users.create');
    }
}
