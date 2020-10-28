<?php

use App\Model\Permission;
use App\Traits\SeederTrait;
use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    use SeederTrait;

    protected function classModel()
    {
        return Permission::class;
    }

    public function run()
    {
        $items = [
            [
                'id' => 1,
                'name' => 'ادمین',
                'slug' => 'admin',
            ],
            [
                'id' => 2,
                'name' => 'مدیریت کاربران',
                'slug' => 'user_management',
            ],
            [
                'id' => 3,
                'name' => 'مشاهده لیست کاربران',
                'slug' => 'user_view',
            ],
            [
                'id' => 4,
                'name' => 'مدیریت غذا',
                'slug' => 'food_management',
            ],
            [
                'id' => 5,
                'name' => 'مشاهده لیست غذا',
                'slug' => 'food_view',
            ],
            [
                'id' => 6,
                'name' => 'مدیریت رزرو',
                'slug' => 'reservation_management',
            ],
            [
                'id' => 7,
                'name' => 'مشاهده لیست رزرو',
                'slug' => 'reservation_view',
            ],
            [
                'id' => 8,
                'name' => 'مشاهده مالی',
                'slug' => 'billing_view',
            ],
        ];

        $this->save($items);
    }
}
