<?php

namespace App\Traits;

trait SeederTrait
{
    /**
     * Returns the class of model for saving items.
     *
     * @return String
     */
    abstract protected function classModel();

    /**
     * If the item does not exist with the defined ID
     * or the item not define the ID, save it in the model.
     *
     * @param $items
     *
     * @throws \Exception
     */
    public function save($items)
    {
        $class = $this->classModel();
        if (!class_exists($class)) {
            throw new \Exception(
                $class . ' Model class is not exists!'
            );
        }

        $model = new $class;

        foreach ($items as $item) {
            if (array_key_exists('id', $item)) {
                $result = $model::find($item['id']);

                if (! $result) {
                    $model::create($item);
                }
            } else {
                $model::create($item);
            }
        }
    }
}
