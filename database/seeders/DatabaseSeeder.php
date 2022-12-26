<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->runLabelsSeeder();
        $this->runUsersSeeder();
    }

    public function runLabelsSeeder()
    {
        $labels = new LabelsSeeder();
        $labels->run();
    }

    public function runUsersSeeder()
    {
        $users = new UsersSeeder();
        $users->run();
    }

}
