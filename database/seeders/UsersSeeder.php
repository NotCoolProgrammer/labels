<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $arr = [
            ['name' => '1', 'surname' => '5'],
            ['name' => '2', 'surname' => '6'],
            ['name' => '3', 'surname' => '7'],
            ['name' => '4', 'surname' => '8'],
        ];

        User::insert($arr);
    }
}
