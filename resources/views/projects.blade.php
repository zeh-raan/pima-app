@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Projects</h2>

    <div id="projectList" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($projects as $project)
            @include('components.project-card', ['project' => $project])
        @endforeach
    </div>
@endsection
