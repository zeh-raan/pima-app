@extends('layouts.main')
@section('title', 'RESTfull API Documentation')

@section('head')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<script src="{{ asset('js/crud.js') }}" defer></script>
<meta name="api-key" content="{{ auth()->user()->api_key }}">
@endsection

@section('content')
<div id="home-wrapper">
    <div id="user-wrapper">
        <h3 class="outfit">Welcome,</h3>
        <h1 class="inter">{{ auth()->user()->email }}</h1>
    </div>

    <!-- Projects -->
    <div id="projects-section">
        <h2 class="outfit">Your Projects</h2>
        <hr />

        @if(auth()->user()->projects->isEmpty())
            <p id="no-projects">No projects yet.</p>
        @endif

        <div class="projects-grid" id="projects-list">
            @foreach(auth()->user()->projects as $p)
                <a class="project-card" id="project-{{ $p->id }}" href="/projects/{{ $p->id }}">

                    <h3 class="outfit">{{ $p->title }}</h3>
                    <p class="desc inter">
                        {{ $p->description ?? 'No description' }}
                    </p>

                    <br />
                    <p class="inter" style="text-align:center;font-size:32px;">→</p>

                    <div class="task-actions">
                        <button onclick="event.preventDefault(); CRUD.edit({{ $p->id }}, '{{ $p->title }}', '{{ $p->description }}', '', 'project')">
                            Edit
                        </button>

                        <button onclick="event.preventDefault(); CRUD.delete({{ $p->id }}, 'project')">
                            Delete
                        </button>
                    </div>

                </a>
            @endforeach
        </div>

        <!-- PROJECT FORM -->
        <div id="new-project-form" style="margin-top: 12px; display:none;">
            <input type="text" id="project-title" placeholder="Project title" />
            <input type="text" id="project-description" placeholder="Project description" />

            <button onclick="CRUD.saveForm('new-project-form', 'project')">
                Add Project
            </button>
        </div>

        <button onclick="CRUD.showForm('new-project-form')">+ New Project</button>
    </div>

</div>
@endsection