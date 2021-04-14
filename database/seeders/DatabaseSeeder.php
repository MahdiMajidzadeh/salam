<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
//        $this->call(AdminSeed::class);
        $this->call(MealSeed::class);
        $this->call(PermissionSeed::class);
    }
}
