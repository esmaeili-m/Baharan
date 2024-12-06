<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Gate;

class GeneralPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {

    }

    public function usersList(User $user)
    {
        return $user->hasPermission('list-user');
    }
    public function usersTrash(User $user)
    {
        return $user->hasPermission('trash-user');
    }
    public function usersCreate(User $user)
    {
        return $user->hasPermission('create-user');
    }
    public function usersUpdate(User $user)
    {
        return $user->hasPermission('update-user');
    }
    public function usersDelete(User $user)
    {
        return $user->hasPermission('delete-user');
    }

    public function categoriesList(User $user)
    {
        return $user->hasPermission('list-category');
    }
    public function categoriesTrash(User $user)
    {
        return $user->hasPermission('trash-category');
    }
    public function categoriesCreate(User $user)
    {
        return $user->hasPermission('create-category');
    }
    public function categoriesUpdate(User $user)
    {
        return $user->hasPermission('update-category');
    }
    public function categoriesDelete(User $user)
    {
        return $user->hasPermission('delete-category');
    }

    public function productsList(User $user)
    {
        return $user->hasPermission('list-product');
    }
    public function productsTrash(User $user)
    {
        return $user->hasPermission('trash-product');
    }
    public function productsCreate(User $user)
    {
        return $user->hasPermission('create-product');
    }
    public function productsUpdate(User $user)
    {
        return $user->hasPermission('update-product');
    }
    public function productsDelete(User $user)
    {
        return $user->hasPermission('delete-product');
    }

    public function invoicesList(User $user)
    {
        return $user->hasPermission('list-invoice');
    }

    public function invoicesCreate(User $user)
    {
        return $user->hasPermission('create-invoice');
    }
    public function invoicesUpdate(User $user)
    {
        return $user->hasPermission('update-invoice');
    }
    public function roleList(User $user)
    {
        return $user->hasPermission('list-role');
    }

    public function permissions(User $user)
    {
        return $user->hasPermission('permissions-role');
    }

    public function roleCreate(User $user)
    {
        return $user->hasPermission('create-role');
    }
    public function roleUpdate(User $user)
    {
        return $user->hasPermission('update-role');
    }
    public function chat(User $user)
    {
        return $user->hasPermission('chat');
    }

    public function setting(User $user)
    {
        return $user->hasPermission('setting');
    }
    public function logs(User $user)
    {
        return $user->hasPermission('logs');
    }

}
