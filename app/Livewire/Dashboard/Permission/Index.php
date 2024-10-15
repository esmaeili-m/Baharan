<?php

namespace App\Livewire\Dashboard\Permission;

use App\Models\Permissions;
use App\Models\Role;
use App\Models\RolesPermissions;
use Livewire\Component;

class Index extends Component
{
    public $role, $permission,$permission_all,$permissions_allow=[];
    public function mount($id)
    {
        $this->permission_all=$permissions = [
            'مشاهده کاربران',
            'حذف کاربران',
            'ایجاد کاربر',
            'ویرایش کاربر',
            'مشاهده دسته‌بندی‌ها',
            'حذف دسته‌بندی‌ها',
            'ایجاد دسته‌بندی',
            'ویرایش دسته‌بندی',
            'مشاهده محصولات',
            'حذف محصولات',
            'ایجاد محصول',
            'ویرایش محصول',
            'مشاهده رانندگان',
            'حذف رانندگان',
            'ایجاد راننده',
            'ویرایش راننده',
            'مشاهده فاکتورها',
            'حذف فاکتورها',
            'ایجاد فاکتور',
            'ویرایش فاکتور',
            'لیست نقش ها',
            'دسترسی ها',
            'افزودن نقش',
            'حذف نقش',
            'چت',
            'تنظیمات'
        ];
        $this->role=Role::with('permissions')->find($id);
        $permission=RolesPermissions::where('role_id',$this->role->id)->pluck('permission_id')->toArray();
        foreach ($permission as $item) {
            $this->permissions_allow[$item]=true;
        }
        $this->permissions=$this->role->permissions->pluck('id')->toArray();
    }

    public function save()
    {
        RolesPermissions::where('role_id',$this->role->id)->delete();
        $permission=array_keys(array_filter($this->permissions_allow));
        foreach ($permission as  $item) {
            RolesPermissions::create([
                'permission_id'=>$item,
                'role_id'=>$this->role->id
            ]);
        }
        create_log(2,auth()->user()->id,'دسترسی ها','[ '.$this->role->id.' => '.$this->role->title.' ]');
        $this->dispatch('alert',icon:'success',message:'دسترسی ها با موفقیت ثبت شد');
    }
    public function render()
    {
        return view('livewire.dashboard.permission.index');
    }
}
