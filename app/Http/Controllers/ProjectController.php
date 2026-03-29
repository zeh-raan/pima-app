<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller {

    // API Endpoint: GET /projects. Returns all the projects 
    public function index(Request $req) {
        $projects = auth()->user()->projects()->with('tasks');

        // Handle GET params

        // ?title parameter passed
        if ($req->has('title')) {
            $projects->where('title', '=', $req->title);
        }

        // ?desc parameter passed
        if ($req->has('desc')) {
            $projects->where('description', '=', $req->desc);
        }

        // Default returns all
        return $projects->get()->makeHidden('user_id');
    }

    // API Endpoint: POST /projects. Creates a new project for authed user
    // Data received from JSON body
    public function store(Request $req) {
        $data = $req->validate([
            'title'       => 'required | string | max:255',
            'description' => 'nullable | string'
        ]);

        // Creates project
        $p = auth()->user()->projects()->create($data);
        return response()->json($p->makeHidden('user_id'), 201);
    }

    // API Endpoint: GET /projects/{id}. Returns the project with that ID
    public function show($id) {
        $p = auth()->user()->projects()->with('tasks')->findOrFail($id);
        return $p->makeHidden('user_id');
    }

    // API Endpoint: PUT /projects/{id}. Updates the project with that ID
    // // Data for update received from JSON body
    public function update(Request $req, $id) {
        $p = auth()->user()->projects()->with('tasks')->findOrFail($id);

        // Validate inputs
        $data = $req->validate([
            'title'       => 'required |string | max:255',
            'descriprion' => 'nullable | string'
        ]);

        // Updates project
        $p -> update($data);
        return $p->makeHidden('user_id');
    }

    // API Endpoint: DELETE /projects/{id}. Deletes the project with that ID
    public function destroy($id) {
        $p = auth()->user()->projects()->with('tasks')->findOrFail($id);
        $p->delete();

        // TODO: Add error handling??
        return response()->json(['message' => 'Project deleted successfully']);
    }
}
