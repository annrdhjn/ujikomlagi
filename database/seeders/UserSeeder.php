<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users= [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('Adminkasir1'),
                'level'=>1

            ],
            [
                'name' => 'Kasir',
                'email' => 'kasir@gmail.com',
                'password' => bcrypt('Kasiradmin2'),
                'level'=>2
            ],
            [
                'name' => 'Owner',
                'email' => 'owner@gmail.com',
                'password' => bcrypt('Owneradmin3'),
                'level'=>3
            ],
        ];

        foreach($users as $key => $val){
            User::create($val);
        }
    }
}
