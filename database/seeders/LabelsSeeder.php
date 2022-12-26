<?php

namespace Database\Seeders;

use App\Models\Label;
use Illuminate\Database\Seeder;

class LabelsSeeder extends Seeder
{
    public function run()
    {
        $arr = [
            ['name' => '123'],
            ['name' => '234'],
            ['name' => '345'],
            ['name' => '456'],
        ];

        Label::insert($arr);
    }
}
