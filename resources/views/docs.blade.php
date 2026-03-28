@extends('layouts.main')
@section('title', 'RESTfull API Documentation')
@section('content')
<div class="docs-container">
    <div class="docs-section">
        <h1>RESTfull API Documentation</h1>
        <p>This page outlines how to make use of the RESTfull API we provide.</p>
    </div>

    <div id="get-started" class="docs-section">
        <h2>Get started</h2>
        <p>An API key unique to your account is needed to be able to use the API. If you do not already have an API key, click the button below to generate one.</p>
        <br />

        <!-- Show existing key -->
        @if(auth()->user()->api_key)
            <div class="codebox-wrapper">
                <code id="api-key-box" class="codebox">{{ auth()->user()->api_key }}</code>
                <button class="copy-btn" onclick="copyAPIKey();">Copy</button>
            </div>

        <!-- API Key Generation button -->
        @else
            <form method="POST" action="{{ route('generate.key') }}">
                @csrf
                <button class="api-key-btn" type="submit">Generate API Key</button>
            </form>
        @endif
    </div>

    <div id="making-a-request" class="docs-section">
        <h2>Making a request</h2>
        <p>When making a request, you should pass your API Key along as value for <code>X-API-KEY</code>.</p>
        <br />

        <h4>Example using <code>CURL</code>:</h4>
        <pre class="codeblock">
curl -X GET http://127.0.0.1:8000/projects \
-H "X-API-KEY: your-key-here" \
-H "Accept: application/json"</pre>
    </div>

    <div id="projects-endpoint" class="docs-section">
        <h2>Project-related API endpoints</h2>
        <p>These endpoints provide CRUD operations for projects through the API. The provided endpoints are:</p>
        <br />

        <ul class="endpoints-list">
            <li>
                <code><code class="method-get">GET</code> /projects</code>
                <p>Returns all the projects.</p>

                <pre class="codeblock">
curl -X GET http://127.0.0.1:8000/projects \
-H "X-API-KEY: your-key-here" \
-H "Accept: application/json"</pre>
                
                <br />
                <br />
                <h4>Example results:</h4>
                <pre class="codeblock">
[
    {
        "id":1,
        "user_id":1, <!-- TODO: Maybe hide this -->
        "title":"Kebab Recipe",
        "description":"Steps in making a kebab!",
        "created_at":"2026-03-28T08:07:43.000000Z",
        "updated_at":"2026-03-28T08:07:43.000000Z",
        "tasks":[...]
    },
    ...
]</pre>
            </li>
            <li>
                <code><code class="method-get">GET</code> /projects/{id}</code>
                <p>Returns the project with that respective ID.</p>

                <pre class="codeblock">
curl -X GET http://127.0.0.1:8000/projects/1 \
-H "X-API-KEY: your-key-here" \
-H "Accept: application/json"</pre>

                <br />
                <br />
                <h4>Example results:</h4>
                <pre class="codeblock">
{
    "id":1,
    "user_id":1, <!-- TODO: Maybe hide this -->
    "title":"Kebab Recipe",
    "description":"Steps in making a kebab!",
    "created_at":"2026-03-28T08:07:43.000000Z",
    "updated_at":"2026-03-28T08:07:43.000000Z",
    "tasks":[...]
}</pre>
            </li>

            <li>
                <code><code class="method-post">POST</code> /projects</code>
                <p>Creates a project for the user and returns the new project's ID.</p>
            </li>

            <li>
                <code><code class="method-put">PUT</code> /projects/{id}</code>
                <p>Updates the project with that respective ID.</p>
            </li>

            <li>
                <code><code class="method-del">DELETE</code> /projects/{id}</code>
                <p>Deletes the project with that respective ID.</p>
            </li>
        </ul>
    </div>

    <div id="tasks-endpoint" class="docs-section">
        <h2>Task-related API endpoints</h2>
        <p>These endpoints provide CRUD operations for tasks through the API.</p>
        <br />

        <ul class="endpoints-list">
            <li>
                <code><code class="method-get">GET</code> /tasks</code>
                <p>Returns all the tasks.</p>

                <pre class="codeblock">
curl -X GET http://127.0.0.1:8000/tasks \
-H "X-API-KEY: your-key-here" \
-H "Accept: application/json"</pre>
                
                <br />
                <br />
                <h4>Example results:</h4>
                <pre class="codeblock">
[
    {
        "id":1,
        "user_id":1,
        "project_id":1,
        "title":"Make kebab",
        "status":"todo",
        "due_date":"2026-03-25",
        "created_at":"2026-03-28T08:07:43.000000Z",
        "updated_at":"2026-03-28T08:07:43.000000Z"
    },
    {
        "id":2,
        "user_id":1,
        "project_id":1,
        "title":"Meter pima?",
        "status":"todo",
        "due_date":"2026-03-21",
        "created_at":"2026-03-28T08:07:43.000000Z",
        "updated_at":"2026-03-28T08:07:43.000000Z"
    },
    ...
]</pre>
            </li>

            <li>
                <code><code class="method-get">GET</code> /tasks/{id}</code>
                <p>Returns the task with that respective ID.</p>
                
                <pre class="codeblock">
curl -X GET http://127.0.0.1:8000/tasks/2 \
-H "X-API-KEY: your-key-here" \
-H "Accept: application/json"</pre>
            </li>

            <li>
                <code><code class="method-get">GET</code> /tasks/??????</code>
                <p>Returns all the tasks linked to a project ID.</p>
            </li>

            <li>
                <code><code class="method-post">POST</code> /tasks</code>
                <p>Creates a new task (given that <code class="api-reqs">project_id</code> is provided) and returns its ID.</p>
            </li>

            <li>
                <code><code class="method-put">PUT</code> /tasks/{id}</code>
                <p>Updates the task with that respective ID.</p>
            </li>

            <li>
                <code><code class="method-del">DELETE</code> /tasks/{id}</code>
                <p>Deletes the task with that respective ID.</p>
            </li>
        </ul>
    </div>
</div>

<script defer>
    function copyAPIKey() {
        const key = document.getElementById("api-key-box").innerText;
        navigator.clipboard.writeText(key)
            .then(() => { alert("API Key copied!"); })
            .catch(() => { alert("Failed to copy API Key"); });
    }
</script>
@endsection
