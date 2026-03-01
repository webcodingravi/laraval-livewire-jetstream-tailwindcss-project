<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DirectoryTree\Authorization\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a User
        $user = User::create([
            'first_name' => 'Krish',
            'last_name' => 'Kumar',
            'fullname' => 'Krish Kumar',
            'email' => 'user@gmail.com',
             'phone_number' => '9623648748',
            'password' => Hash::make('password'),
        ]);

        // Assign Role to User
        $role = Role::where('name','user')->firstOrFail();
        $user->roles()->save($role);


        //assign permissions to user
        $permissions = $role->permissions;
        $user->permissions()->saveMany($permissions);

          }
}
