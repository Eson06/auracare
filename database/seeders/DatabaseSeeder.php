<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use App\Models\role;
use App\Models\User;
use App\Models\user_role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'user_name' => 'superadmin',
            'first_name' => 'Jason',
            'last_name' => 'Garab',
            'password' => bcrypt('Admin123'),
        ]);

            User::create([
            'user_name' => 'admin',
            'first_name' => 'Juan',
            'last_name' => 'Dela Cruz',
            'password' => bcrypt('Admin123'),
        ]);

           user_role::create([
            'user_id' => 1,
            'role_id' => '1',
        ]);

             user_role::create([
            'user_id' => 2,
            'role_id' => 2,
        ]);

             user_role::create([
            'user_id' => 3,
            'role_id' => 3,
        ]);

             user_role::create([
            'user_id' => 4,
            'role_id' => 4,
        ]);



        role::create([            
            'id' => 1,
            'role_name' => 'SUPER ADMINISTRATOR',
        ]);

          role::create([            
            'id' => 2,
            'role_name' => 'ADMIN',
        ]);

          role::create([            
            'id' => 3,
            'role_name' => 'BUSINESS',
        ]);

         role::create([            
            'id' => 4,
            'role_name' => 'CUSTOMER',
        ]);

       
    }
}
