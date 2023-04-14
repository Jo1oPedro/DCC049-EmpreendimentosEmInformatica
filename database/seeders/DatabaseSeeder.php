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

        User::factory(10)->create();
        var_dump('dale');
        Period::factory(10)->create();
        var_dump('dale');
        Subject::factory(10)->create();
        var_dump('dale');
        Exam::factory(10)->create();
        var_dump('dale');
        Annotation::factory(10)->create();
        var_dump('dale');
        Type::factory(10)->create();
        var_dump('dale');
        Task::factory(10)->create();
        var_dump('dale');
        Work::factory(10)->create();
    }
}
