<?php

namespace Database\Seeders;

use App\Models\Meal;
use App\Traits\SeederTrait;
use Illuminate\Database\Seeder;

class MealSeed extends Seeder
{
    use SeederTrait;

    protected function classModel()
    {
        return Meal::class;
    }

    public function run()
    {
        $items = [
            [
                'id' => 1,
                'name' => 'صبحانه',
            ],
            [
                'id' => 2,
                'name' => 'ناهار',
            ],
            [
                'id' => 3,
                'name' => 'شام',
            ],
            [
                'id' => 4,
                'name' => 'سحر',
            ],
            [
                'id' => 5,
                'name' => 'افطار',
            ],
            [
                'id' => 6,
                'name' => 'دسر',
            ],
        ];

        $this->save($items);
    }
}
