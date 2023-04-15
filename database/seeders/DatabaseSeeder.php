<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Annotation;
use App\Models\Exam;
use App\Models\Period;
use App\Models\Subject;
use App\Models\Task;
use App\Models\Type;
use App\Models\User;
use App\Models\Work;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory(20)->create();
        Period::factory(20)->create();
        Subject::factory(20)->create();
        Exam::factory(20)->create();
        Annotation::factory(20)->create();
        Type::factory(20)->create();
        Task::factory(20)->create();
        Work::factory(20)->create();
    }
}
