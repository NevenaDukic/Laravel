<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Theatre;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Performance>
 */
class PerformanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->name(),
            'genre' =>$this->faker->randomElement(['musical', 'drama','romantic','thriler']),
            'number_of_roles'=>$this->faker->numberBetween(0, 20),
            'theatre_id'=>Theatre::factory(),
        ];
    }
}
