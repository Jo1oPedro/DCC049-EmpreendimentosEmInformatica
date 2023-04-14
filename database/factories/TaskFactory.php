<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tempo_execucao' => fake()->time(),
            'realizado' => fake()->boolean(70),
            'titulo' => fake('pt_br')->title,
            'subject_id' => optional(Subject::inRandomOrder()->first())->id,
            'type_id' => optional(Type::inRandomOrder()->first())->id,
            'user_id' => User::inRandomOrder()->first()->id
        ];
    }
}
