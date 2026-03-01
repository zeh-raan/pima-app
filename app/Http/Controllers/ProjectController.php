<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Return all projects with their tasks
        return Project::with('tasks')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate inputs
        $data = $request->validate([
           'title'        => 'required[string] | max:255',
            'descriprion' => 'nullable | string'
        ]);
        // Create project
        return Project::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        // Return a single project with tasks
        return $project -> load('tasks');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        // Validate inputs
        $data = $request->validate([
            'name'        => 'required[string] | max:255',
            'descriprion' => 'nullable | string '
        ]);

        // Update project
        $project -> update($data);
        return $project;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
