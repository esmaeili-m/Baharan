<?php

namespace App\Livewire\Dashboard\Permission;

use App\Models\Permissions;
use App\Models\Role;
use Livewire\Component;

class Index extends Component
{
    public $role, $permission,$permission_all;
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
            'چت',
            'تنظیمات'
        ];
        $this->role=Role::with('permissions')->find($id);
        $this->permissions=$this->role->permissions->pluck('id')->toArray();
    }
    public function render()
    {
        return view('livewire.dashboard.permission.index');
    }
}
