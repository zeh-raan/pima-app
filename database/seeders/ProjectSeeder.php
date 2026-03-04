<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        $proj = Project::create([
            'title' => 'Kebab Recipe',
            'description' => 'Steps in making a kebab!',
        ]);

        // Uses relationship
        $proj->tasks()->createMany([
            
            // Task 1
            [
                'title' => 'Make kebab',
                'status' => 'todo',
                'due_date' => now()->subDays(3),
            ],

            // Task 2
            [
                'title' => 'Meter pima?',
                'status' => 'todo',
                'due_date' => now()->subDays(7),
            ],
        ]);
    }
}
