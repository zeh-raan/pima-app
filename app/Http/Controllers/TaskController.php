<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

use Carbon\Carbon;

class TaskController extends Controller
{
    // API endpoint: GET /tasks - returns all tasks
    public function index(Request $req)
    {
        $tasks = auth()->user()->tasks();

        // Handle GET params

        // ?project_id parameter passed
        if ($req->has('project_id')) {
            $tasks->where('project_id', '=', $req->project_id);
        } 
        // ?title parameter passed
        if ($req->has('title')) {
            $tasks->where('title', '=', $req->title);
        }
        // ?status parameter passed
        if ($req->has('status')) {
            $tasks->where('status', '=', $req->status);
        }
        // ?due_date parameter passed
        if ($req->has('year')) { // Filter by year
            $tasks->whereYear('due_date', '=', $req->year);
        }
        if ($req->has('month')) { // Filter by month
            $tasks->whereMonth('due_date', '=', $req->month);
        }

        // Task is due within specified hours
        if ($req->has('due')) {
            $hours = (int) $req->due;

            $now = Carbon::now();
            $deadline = $now->copy()->addHours($hours);

            $tasks->whereBetween('due_date', [$now, $deadline]);
        }

        // Default returns all
        return $tasks->get();
    }

    // API Endpoint: POST /tasks. Creates a new task for authed user given a project id
    // Data received from JSON body
    public function store(Request $req) {
        $data = $req->validate([
            'project_id' => 'required | exists:projects,id',
            'title'      => 'required | string | max:255',
            'status'     => 'required | string | in:pending,done',
            'due_date'   => 'nullable | date'
        ]);

        // Creates task
        $task = auth()->user()->tasks()->create($data);
        return response()->json($task->id, 201);
    }

    // API Endpoint: GET /tasks/{id}. Returns the task with that ID
    public function show($id) {
        return auth()->user()->tasks()->findOrFail($id);
    }

    // API Endpoint: PUT /tasks/{id}. Updates the task with that ID
    // Data for update received from JSON body
    public function update(Request $req, $id) {
        $task = auth()->user()->tasks()->findOrFail($id);

        // Validate inputs
        $data = $req->validate([
            'title'    => 'required | string | max:255',
            'status'   => 'required | string | in:pending,done',
            'due_date' => 'nullable | date'
        ]);

        // Updates task
        $task -> update($data);
        return $task;
    }


    // API Endpoint: DELETE /tasks/{id}. Deletes the task with that ID
    public function destroy($id) {
        try {
            $task = auth()->user()->tasks()->findOrFail($id);

            // Delete the task
            $task->delete();

            return response()->json(
                ['message' => 'Task deleted successfully'], 
                200
            );

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Task not found
            return response()->json(
                ['error' => 'Task not found'], 
                404
            );
        }
    }
}
