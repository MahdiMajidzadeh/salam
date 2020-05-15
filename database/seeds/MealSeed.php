<?php

use Illuminate\Database\Seeder;

class MealSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meal1 = new \App\Model\Meal();
        $meal1->name = 'صبحانه';
        $meal1->save();

        $meal2 = new \App\Model\Meal();
        $meal2->name = 'ناهار';
        $meal2->save();

        $meal3 = new \App\Model\Meal();
        $meal3->name = 'شام';
        $meal3->save();

        $meal4 = new \App\Model\Meal();
        $meal4->name = 'سحر';
        $meal4->save();

        $meal5 = new \App\Model\Meal();
        $meal5->name = 'افطار';
        $meal5->save();
    }
}
