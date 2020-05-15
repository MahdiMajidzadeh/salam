<?php

use Illuminate\Database\Seeder;

class FoodTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $foodType1 = new \App\Model\FoodType();
        $foodType1->name = 'غذای پایه';
        $foodType1->save();

        $foodType2 = new \App\Model\FoodType();
        $foodType2->name = 'غذای غیرپایه';
        $foodType2->save();
    }
}
