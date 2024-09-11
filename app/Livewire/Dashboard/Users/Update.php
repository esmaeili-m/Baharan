<?php

namespace App\Livewire\Dashboard\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    public $name,$password,$phone,$email,$role_id,$description,$avatar,$code_meli,$status,$user;
    public function rules()
    {
        return [
            'name'=>'required',
            'email' => 'required|unique:users,email,'.$this->user->id,
            'phone' => 'required|unique:users,phone,'.$this->user->id.'|size:11',
            'role_id' => 'required',
            'status' => 'required',
            'description' => 'nullable',
            'avatar' => 'nullable',
            'code_meli' => 'required|unique:users,code_meli,'.$this->user->id.'|size:10',
        ];
    }
    protected $messages=[
        'name.required'=>' این فیلد الزامی می باشد',
        'email.required'=>'این فیلد الزامی می باشد',
        'phone.required'=>'این فیلد الزامی می باشد',
        'code_meli.required'=>'این فیلد الزامی می باشد',
        'phone.unique'=>'این شماره همراه استفاده شده است لطفا شماره همراه دیگری را وارد کنید',
        'code_meli.unique'=>'این کد ملی استفاده شده است',
        'email.unique'=>'این ایمیل استفاده شده است لطفا ایمیل دیگری را وارد کنید',
        'code_meli.size'=>'کد ملی نامعتبر می باشد',
        'phone.size'=>'شماره همراه نامعتبر می باشد',
    ];
    public function mount($id)
    {
       $this->user=User::find($id);
       $this->fill([
           'name'=>$this->user->name,
           'phone'=>$this->user->phone,
           'description'=>$this->user->description,
           'code_meli'=>$this->user->code_meli,
           'status'=>$this->user->status,
           'role_id'=>$this->user->role_id,
           'email'=>$this->user->email,
           'avatar'=>$this->user->avatar,
       ]);
    }
    public function save()
    {
        $data = $this->validate();
        if ($this->password){
            $data['password']=Hash::make($data['password']);
        }
        $this->user->update($data);
        session()->flash('message', 'کاربر با موفقیت ویرایش شد');
        return redirect()->route('user.list');
    }
    public function UpdatedAvatar()
    {
        $this->avatar=upload_file($this->avatar,'users');
    }

    public function render()
    {
        return view('livewire.dashboard.users.update');
    }
}
