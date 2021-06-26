<?php

namespace Database\Factories;

use App\Models\history;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class HistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = history::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'activity_id' => mt_rand(1,3),
            'date' => $this->faker->date("Y-m-d", 'now'),
            'time' => $this->faker->date("H:i:s", 'now'),
            'value' => mt_rand(50,100)
        ];
    }
}
