<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeed extends Seeder
{
    public function run()
    {
        $admin = new \App\Models\User();
        $admin->name = 'مهدی مجیدزاده';
        $admin->mobile = '09124531800';
        $admin->password = \Illuminate\Support\Facades\Hash::make('123456');
        $admin->role_id = 10;
        $admin->save();
    }
}
