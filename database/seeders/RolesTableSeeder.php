<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        Role::create(['title'=>'کاربر عادی']);
        Role::create(['title'=>'مدیر']);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
