<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name'=>'Mehadi Hasan',
                'phone'=>'01714797978',
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('12345'),
                'role'=>'admin'
            ]
        );


    }
}