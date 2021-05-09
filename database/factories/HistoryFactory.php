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
            'activity_id' => mt_rand(0,3),
            'date' => Carbon::now()->format('d-M-Y'),
            'time' => Carbon::now()->format('H:i:s'),
            'value' => mt_rand(50,100)
        ];
    }
}
