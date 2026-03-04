<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TODO: Make a form first
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   

        // Should normally return one
        // Reusing logic as index because it's pretty much the same thing
        $tasks = Task::find($id); 
        return view('tasks', compact('tasks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) // NOTE: Shouldn't this be an Integer?
    {
        $task = Task::find($id);
        $task::destroy();
    }
}
