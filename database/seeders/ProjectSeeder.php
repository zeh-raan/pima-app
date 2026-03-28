<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Project;
use App\Models\Task;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Populates database with projects
        
        // Tasks will be populated here itself instead of a seperate seeder
        // because it is cleaner

        $user = User::first(); // Gets first user

        // Create project linked to user
        $project = $user->projects()->create([
            'title' => 'Kebab Recipe',
            'description' => 'Steps in making a kebab!',
        ]);

        // Create tasks linked to project and user
        $project->tasks()->createMany([
            [
                'title' => 'Make kebab',
                'status' => 'todo',
                'due_date' => now()->subDays(3),
                'user_id' => $user->id,
            ],
            [
                'title' => 'Meter pima?',
                'status' => 'todo',
                'due_date' => now()->subDays(7),
                'user_id' => $user->id,
            ],
        ]);
    }
}
