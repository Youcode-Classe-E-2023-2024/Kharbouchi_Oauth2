<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

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
