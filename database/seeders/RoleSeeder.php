<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
    /**
     * Run the database seeds.
     */use App\Models\Role;
class RoleSeeder extends Seeder
{


public function run()
{
    Role::insert([
        ['name' => 'admin'],
        ['name' => 'moderateur'],
        ['name' => 'utilisateur'],
    ]);
}

}
