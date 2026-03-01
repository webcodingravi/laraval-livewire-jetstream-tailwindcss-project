<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DirectoryTree\Authorization\Role;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin= User::create([
          'first_name' => 'Super',
          'last_name' => 'Admin',
          'fullname' => 'Super Admin',
          'email' => 'admin@gmail.com',
          'phone_number' => '9623648747',
          'password' => Hash::make('password'),
          'role' => 'super_admin'
        ]);

        // Assign Role to Admin User
        $role = Role::where('name','super_admin')->firstOrFail();
        $admin->roles()->save($role);


        // assign permission to admin user
     $permissions = $role->permissions; // plural
     $admin->permissions()->saveMany($permissions);
    }
}
