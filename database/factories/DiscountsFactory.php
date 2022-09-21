<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'orderId' => $this->faker->unique()->numberBetween(),
            'discountReason' => $this->faker->text(100),
            'discountAmount' => $this->faker->randomFloat(null, 2, 4),
            'subtotal' => $this->faker->randomFloat(null, 2, 4),
            'totalDiscount' => $this->faker->randomFloat(null, 2, 4),
            'discountedTotal' => $this->faker->randomFloat(null, 2, 4)
        ];
    }
}
