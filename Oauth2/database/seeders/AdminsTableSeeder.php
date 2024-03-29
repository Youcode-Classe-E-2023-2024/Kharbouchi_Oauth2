<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin; 
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'name' => 'Khawla_kha',
            'email' => 'Kharbouchikhawla603@gmail.com', 
            'password' => Hash::make('Khawla_kha') 
        ]);
    }
}
