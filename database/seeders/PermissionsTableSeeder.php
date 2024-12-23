<?php

namespace Database\Seeders;

use App\Models\Permissions;
use App\Models\RolesPermissions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Permissions::truncate();
//        ---->User
        Permissions::create(['name' => 'list-user']);
        Permissions::create(['name' => 'trash-user']);
        Permissions::create(['name' => 'create-user']);
        Permissions::create(['name' => 'update-user']);
        Permissions::create(['name' => 'delete-user']);
//        ---->category

        Permissions::create(['name' => 'list-category']);
        Permissions::create(['name' => 'trash-category']);
        Permissions::create(['name' => 'create-category']);
        Permissions::create(['name' => 'update-category']);
        Permissions::create(['name' => 'delete-category']);
//        ---->product

        Permissions::create(['name' => 'list-product']);
        Permissions::create(['name' => 'trash-product']);
        Permissions::create(['name' => 'create-product']);
        Permissions::create(['name' => 'update-product']);
        Permissions::create(['name' => 'delete-product']);
//        ---->driver

        Permissions::create(['name' => 'list-driver']);
        Permissions::create(['name' => 'trash-driver']);
        Permissions::create(['name' => 'create-driver']);
        Permissions::create(['name' => 'update-driver']);
        Permissions::create(['name' => 'delete-driver']);
//        ---->invoice

        Permissions::create(['name' => 'list-invoice']);
        Permissions::create(['name' => 'create-invoice']);
        Permissions::create(['name' => 'update-invoice']);
//        ---->role

        Permissions::create(['name' => 'list-role']);
        Permissions::create(['name' => 'permissions-role']);
        Permissions::create(['name' => 'create-role']);
        Permissions::create(['name' => 'update-role']);
//        ---->chat

        Permissions::create(['name' => 'chat']);
//        ---->setting

        Permissions::create(['name' => 'setting']);
//        ---->logs

        Permissions::create(['name' => 'logs']);
        RolesPermissions::where('role_id',1)->delete();
        for ($counter=1;$counter<31;$counter++){
            RolesPermissions::create([
                'role_id' => 2,
                'permission_id' => $counter,
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
