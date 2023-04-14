<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Work>
 */
class WorkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'membros' => 'Joao;Gabi;Maycon;Duque;Yan',
            'data_entrega' => fake()->date,
            'subject_id' => Subject::inRandomOrder()->first()->id
        ];
    }
}
