<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Policies\GeneralPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
//        ->Users
            Gate::define('list-users', [GeneralPolicy::class, 'usersList']);
            Gate::define('trash-users', [GeneralPolicy::class, 'usersTrash']);
            Gate::define('create-users', [GeneralPolicy::class, 'usersCreate']);
            Gate::define('update-users', [GeneralPolicy::class, 'usersUpdate']);
            Gate::define('delete-users', [GeneralPolicy::class, 'usersDelete']);
//        ->Category
        Gate::define('list-categories', [GeneralPolicy::class, 'categoriesList']);
        Gate::define('trash-categories', [GeneralPolicy::class, 'categoriesTrash']);
        Gate::define('create-categories', [GeneralPolicy::class, 'categoriesCreate']);
        Gate::define('update-categories', [GeneralPolicy::class, 'categoriesUpdate']);
        Gate::define('delete-categories', [GeneralPolicy::class, 'categoriesDelete']);
        //        ->Products
        Gate::define('list-products', [GeneralPolicy::class, 'productsList']);
        Gate::define('trash-products', [GeneralPolicy::class, 'productsTrash']);
        Gate::define('create-products', [GeneralPolicy::class, 'productsCreate']);
        Gate::define('update-products', [GeneralPolicy::class, 'productsUpdate']);
        Gate::define('delete-products', [GeneralPolicy::class, 'productsDelete']);
        //        ->invoices
        Gate::define('list-invoices', [GeneralPolicy::class, 'invoicesList']);
        Gate::define('trash-invoices', [GeneralPolicy::class, 'invoicesTrash']);
        Gate::define('create-invoices', [GeneralPolicy::class, 'invoicesCreate']);
        Gate::define('update-invoices', [GeneralPolicy::class, 'invoicesUpdate']);
        //        ->roles

        Gate::define('list-roles', [GeneralPolicy::class, 'roleList']);
        Gate::define('permissions', [GeneralPolicy::class, 'permissions']);
        Gate::define('create-roles', [GeneralPolicy::class, 'roleCreate']);
        Gate::define('update-roles', [GeneralPolicy::class, 'roleUpdate']);

        Gate::define('chat', [GeneralPolicy::class, 'chat']);
        Gate::define('setting', [GeneralPolicy::class, 'setting']);
        Gate::define('logs', [GeneralPolicy::class, 'logs']);

    }
}
