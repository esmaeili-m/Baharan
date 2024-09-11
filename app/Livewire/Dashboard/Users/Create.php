<?php

namespace App\Livewire\Dashboard\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $name,$password,$phone,$email,$role_id,$description,$avatar,$code_meli,$status;
    protected $rules=[
        'name'=>'required',
        'email' => 'required|unique:users,email',
        'phone' => 'required|unique:users,phone|size:11',
        'password' => 'required',
        'role_id' => 'required',
        'status' => 'required',
        'description' => 'nullable',
        'avatar' => 'nullable',
        'code_meli' => 'required|unique:users,code_meli|size:10',
    ];
    protected $messages=[
        'name.required'=>' این فیلد الزامی می باشد',
        'email.required'=>'این فیلد الزامی می باشد',
        'password.required'=>'این فیلد الزامی می باشد',
        'phone.required'=>'این فیلد الزامی می باشد',
        'code_meli.required'=>'این فیلد الزامی می باشد',
        'phone.unique'=>'این شماره همراه استفاده شده است لطفا شماره همراه دیگری را وارد کنید',
        'code_meli.unique'=>'این کد ملی استفاده شده است',
        'email.unique'=>'این ایمیل استفاده شده است لطفا ایمیل دیگری را وارد کنید',
        'code_meli.size'=>'کد ملی نامعتبر می باشد',
        'phone.size'=>'شماره همراه نامعتبر می باشد',
    ];

    public function save()
    {
        $data = $this->validate();
        $data['password']=Hash::make($data['password']);
        User::create($data);
        session()->flash('message', 'کاربر با موفقیت ایجاد شد');
        return redirect()->route('user.list');
    }
    public function UpdatedAvatar()
    {
        $this->avatar=upload_file($this->avatar,'users');
    }
    public function mount()
    {
        $this->role_id=1;
        $this->status=0;
    }
    public function render()
    {
        return view('livewire.dashboard.users.create');
    }
}
