<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alarm_category = [
            'Important',
            'Paying',
            'Income',
            'Medical',
            'Subscription',
            'Sports'
        ];

        foreach($alarm_category as $category) {
            Category::updateOrCreate([
                'type' => 'alarm',
                'name' => $category
            ]);
        }
    }
}
