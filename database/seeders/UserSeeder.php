<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run():void
    {
    User::create([
        'name' => "Administrator",
        'email' => "admin@gmail.com",
        'role' => "admin",
        "password" => Hash::make("admin"),
    ]);
    
    User::create([
        'name' => "ps",
        'email' => "ps@gmail.com",
        'role' => "ps",
        "password" => Hash::make("ps"),
    ]);
}
};
