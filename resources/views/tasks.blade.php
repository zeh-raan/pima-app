@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Tasks</h2>

    <div id="taskList" class="space-y-2">
        @foreach($tasks as $task)
            @include('components.task-card', ['task' => $task])
        @endforeach
    </div>
@endsection
