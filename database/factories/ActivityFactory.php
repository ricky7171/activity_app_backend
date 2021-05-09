<?php

namespace Database\Factories;

use App\Models\activity;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = activity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $use_textfield = rand(0,1) == 1;
        $default_value = 0
        $target = 0;
        $can_change = true;
        if($use_textfield == false) { //if not use textfield
            $default_value = 50;
            $target = 1000;
        } else { //if use textfield, then meaning of target is target count NOT target total value
            $target = 10; //this is target count
        }
        return [
            'title' => $this->faker->title;
            'default_value' => $default_value;
            'target' => $target;
            'can_change' => $can_change;
            'use_textfield' => $use_textfield;
        ];
    }
}
