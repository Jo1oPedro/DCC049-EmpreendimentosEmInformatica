<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'data_prova' => fake()->dateTime()->format('Y-m-d H:i:s'),
            'prova' => 'aaa.jpg',
            'nota' => fake()->numberBetween(0, 10),
            'subject_id' => Subject::inRandomOrder()->first()->id
        ];
    }
}
