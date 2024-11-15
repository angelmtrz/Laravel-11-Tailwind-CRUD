<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['natural', 'juridica']);
        return [
            'user_id' => fake()->numberBetween(2, 6),
            'type' => $type,
            'document' => $this->generarDocumento($type),
            'company_name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber()
        ];
    }

    private function generarDocumento($type) {
        if ($type === 'natural') {
            return '10' . $this->faker->numerify('#########'); //10
        } else {
            return '20' . $this->faker->numerify('#########'); //20
        }
    }
}
