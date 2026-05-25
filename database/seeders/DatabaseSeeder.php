<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Creating super admin user
        $superAdmin = User::create([
            'fname' => 'Super',
            'lname' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '00000000000',
            'password' => bcrypt('admin'),
        ]);

        // Creating developer user
        $developer = User::create([
            'fname' => 'Developer',
            'lname' => 'OP',
            'email' => 'limon@shunno.com',
            'phone' => '01781342259',
            'password' => bcrypt('developer'),
        ]);


        // Creating roles
        Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        Role::create(['name' => 'Operator', 'guard_name' => 'web']);

        // Creating settings
        Setting::create([
            'site_name' => 'Demo',
            'site_title' => 'Demo',
            'logo' => 'logo.png',
            'favicon' => 'favicon.png',
            'email' => 'info@demo.com',
            'phone' => '00000000000',
            'address' => 'Italy',
            'footer_text' => '© 2025 Demo. All rights reserved.',
            'newslatter_text' => 'Subscribe to our newsletter',
            'facebook' => 'https://www.facebook.com/',
        ]);

        // Assigning roles to users
        $superAdmin->assignRole('Admin');
        $developer->assignRole('Admin');

        // Call Permission Seeder
        $this->call(RolePermissionSeeder::class);
    }
}
