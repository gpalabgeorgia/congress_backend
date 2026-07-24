<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Admin::create([
            'first_name' => 'Admin',
            'last_name'  => 'User',
            'country'    => 'Georgia',
            'city'       => 'Tbilisi',
            'address'    => 'Rustaveli Ave 1',
            'phone'      => '+995555000000',
            'email'      => 'admin@admin.com',
            'password'   => Hash::make('password'),
        ]);
    }
}
