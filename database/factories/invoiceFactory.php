<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\invoice>
 */
class invoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'number'=>$this->faker->numberBetween(10,1000),
            'customer_id'=>$this->faker->numberBetween(1,20),
            'date'=>$this->faker->date,
            'due_date'=>$this->faker->date,
            'reference'=>'REF-'.rand(10,1000),
            'terms_and_conditions'=>$this->faker->paragraph(2),
            'sub_total' => $this->faker->numberBetween(10, 100),
            'discount' => $this->faker->numberBetween(10, 100),
            'total' => $this->faker->numberBetween(20, 2000),

        ];
    }
}
