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
        @else
            <div class="projects-grid">

                @foreach(auth()->user()->projects as $p)
                    <a class="project-card" href="/projects/{{ $p->id }}">

                        <h3 class="outfit">{{ $p->title }}</h3>
                        <p class="desc inter">
                            {{ $p->description ?? 'No description' }}
                        </p>
                        <br />

                        <p class="inter" style="width: 100%; text-align: center; font-size: 32px;">→</p>
                    </a>
                @endforeach

            </div>
        @endif
        
        <!-- Projects FORM GOES HERE ******************************-->

        <button onclick="CRUD.showForm('new-project-form')">+ New Project</button>
    </div>

</div>
@endsection