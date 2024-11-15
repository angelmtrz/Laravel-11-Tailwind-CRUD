<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $items = $this->generarItems();
        $total = $this->calcularTotal($items);

        return [
            'emission_date' => fake()->date(),
            'customer_id' => fake()->numberBetween(1, 5),
            'items' => json_encode($items),
            'total' => $total
        ];
    }

    private function generarItems() {
        $items = [];
        $itemCount = rand(1, 5);

        $products = Product::all();

        for ($i = 0; $i < $itemCount; $i++) {
            $product = $products->random();

            $cant = $this->faker->numberBetween(1, 10);

            $items[] = [
                'code' => $product->code,
                'name' => $product->name,
                'quantity' => $cant,
                'price' => $product->price,
                'total_item' => $product->price * $cant
            ];
        }

        return $items;
    }

    private function calcularTotal($items) {
        $total = 0;

        foreach ($items as $item) {
            $total += $item['total_item'];
        }

        return $total;
    }
}
