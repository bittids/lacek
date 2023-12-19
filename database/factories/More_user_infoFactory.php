<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\More_user_info>
 */
class More_user_infoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                    //   'user_id' => $this->faker->name(),
                    'int_salutation_id' => $this->faker->numberBetween($min = 1, $max = 2),
                    'str_first_name' => $this->faker->firstName(),
                    'str_last_name' => $this->faker->lastName(),
                    'created_at' => $this->faker->dateTime($max = 'now', $timezone = null),
                    'updated_at' => $this->faker->dateTime($max = 'now', $timezone = null),
        
        
        ];
    }
}
