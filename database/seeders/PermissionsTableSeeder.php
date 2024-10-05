<?php

namespace Database\Seeders;

use App\Models\Permissions;
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
        Permissions::create(['name' => 'list user']);
        Permissions::create(['name' => 'trash user']);
        Permissions::create(['name' => 'create user']);
        Permissions::create(['name' => 'update user']);
        Permissions::create(['name' => 'list category']);
        Permissions::create(['name' => 'trash category']);
        Permissions::create(['name' => 'create category']);
        Permissions::create(['name' => 'update category']);
        Permissions::create(['name' => 'list product']);
        Permissions::create(['name' => 'trash product']);
        Permissions::create(['name' => 'create product']);
        Permissions::create(['name' => 'update product']);
        Permissions::create(['name' => 'list driver']);
        Permissions::create(['name' => 'trash driver']);
        Permissions::create(['name' => 'create driver']);
        Permissions::create(['name' => 'update driver']);
        Permissions::create(['name' => 'list invoice']);
        Permissions::create(['name' => 'trash invoice']);
        Permissions::create(['name' => 'create invoice']);
        Permissions::create(['name' => 'update invoice']);
        Permissions::create(['name' => 'chat']);
        Permissions::create(['name' => 'setting']);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
