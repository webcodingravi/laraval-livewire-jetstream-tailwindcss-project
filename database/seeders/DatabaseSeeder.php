<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Ravi kumar',
        //     'email' => 'ravi@gmail.com',
        //     'password' => Hash::make('12345678'),
        //     'role' => 'admin'
        // ]);

        // Call Role Seeder
        $this->call(RoleSeeder::class);

        //Call Admin Seeder
        $this->call(AdminSeeder::class);

        //Call User Seeder
        $this->call(UserSeeder::class);

        //Category Seeder
        $this->call(CategorySeeder::class);

        //Brand Seeder
        $this->call(BrandSeeder::class);

         //Product Seeder
        $this->call(ProductSeeder::class);


       // ShippingMethod Seeder
       $this->call(ShippingMethodSeeder::class);


    }
}
