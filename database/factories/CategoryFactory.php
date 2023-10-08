<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

//(1) - use category model file  
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{

    //(2) - define the model
    protected $model = Category::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word,
            'logo' => $this->faker->imageUrl(200, 200, 'categories', true),
        ];
    }
}
