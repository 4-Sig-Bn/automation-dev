<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;
use App\Models\Role;

class UserTableSeeder extends Seeder
{

    public function run(): void
    {
        $admin= new User();
        $admin->name =  'সিস্টেম অ্যাডমিন';
        $admin->email = 'admin@4sig.com';
        $admin->password = Hash::make('admin');
        $admin->save();
        $admin->roles()->attach(Role::where('name', 'admin')->first());

        $user= new User();
        $user->name = "ইউজার";
        $user->email = 'user@4sig.com';
        $user->password = Hash::make('user');
        $user->save();
        $user->roles()->attach(Role::where('name', 'general')->first());

    }
}
