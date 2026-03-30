@extends('layouts.main')
@section('title', 'Project - ' . $p->title)

@section('head')
<link rel="stylesheet" href="{{ asset('css/projects.css') }}">
@endsection

@section('content')
<!-- 
    Display project details and task details here. 
    Maybe make use of custom components like taskcard.blade.php
-->

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

        @if($p->tasks->isEmpty())
            <p class="empty">No tasks for this project yet.</p>
        
        @else
            <div id="tasks-list">
                @foreach($p->tasks as $task)
                    @include('components.task-card', ['task' => $task])
                @endforeach
            </div>
        @endif
    </div>

    <button 
        class="outfit"
        onclick="window.location.href='/projects/{{ $p->id }}/newtask';">New Task</button>
</div>
@endsection
