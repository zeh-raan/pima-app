@extends('layouts.main')
@section('title', 'Project - ' . $p->title)

@section('head')
<link rel="stylesheet" href="{{ asset('css/projects.css') }}">
<script src="{{ asset('js/crud.js') }}" defer></script>
<meta name="api-key" content="{{ auth()->user()->api_key }}">
@endsection

@section('content')
<a id="go-back" class="outfit" href="/">< Back</a>

<div id="project-container">
    <div class="project-header card">
        <h1 class="outfit">{{ $p->title }}</h1>
        <p class="description inter">
            {{ $p->description ?? 'No description provided.' }}
        </p>
    </div>

    <div id="tasks-section">
        <div id="tasks-header">
            <h2 class="outfit">Tasks</h2>
            <span class="outfit" id="tasks-count">{{ $p->tasks->count() }} total</span>
        </div>

        <div id="tasks-list">
            @foreach($p->tasks as $task)
                @include('components.task-card', ['task' => $task])
            @endforeach
        </div>
    </div>

    <!-- New / Edit Task Form -->
    <div id="new-task-form" style="margin-top: 12px; display:none;" data-project-id="{{ $p->id }}">
        <input type="text" id="task-title" placeholder="Task title" />
        <input type="date" id="task-due" />
        <select id="task-status">
            <option value="pending" selected>Pending</option>
            <option value="done">Done</option>
        </select>
        <button id="task-submit-btn" onclick="CRUD.saveForm('new-task-form', 'task', {{ $p->id }})">
            Add Task
        </button>
    </div>

    <button onclick="CRUD.showForm('new-task-form')">+ New Task</button>
</div>
@endsection