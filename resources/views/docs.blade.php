@extends('layouts.main')
@section('title', 'RESTfull API Documentation')

@section('head')
<link rel="stylesheet" href="{{ asset('css/docs.css') }}">
@endsection

@section('content')
<div class="docs-container">
    <div class="docs-section">
        <h1 class="outfit">RESTfull API Documentation</h1>
        <p>This page outlines how to make use of the RESTfull API we provide.</p>
    </div>

    <div id="get-started" class="docs-section">
        <h2>Get started</h2>
        <p>Follow these steps to get started with using our API.</p>
        <br />

        <h4>Generate an API key.</h4>
        <p>An API key unique to your account is needed to be able to use the API. If you do not already have an API key, click the button below to generate one.</p>
        <br />

        <!-- Show existing key -->
        <div id="api-key-container">
            @if(auth()->user()->api_key)
                <div class="codebox-wrapper">
                    <code id="api-key-box" class="codebox">{{ auth()->user()->api_key }}</code>
                    <button class="copy-btn" onclick="copyAPIKey();">Copy</button>
                </div>

            <!-- API Key Generation button -->
            @else
                <button class="api-key-btn" onclick="generateKey()">
                    Generate API Key
                </button>
            @endif
        </div>
    </div>

    <div id="making-a-request" class="docs-section">
        <h2>Making a request</h2>
        <p>When making a request, you should pass your API Key along as value for <code>X-API-KEY</code>.</p>
        <br />

        <h4>Example using <code>CURL</code>:</h4>
        <pre class="codeblock">
curl -X GET http://127.0.0.1:8000/api/projects \
-H "X-API-KEY: your-key-here" \
-H "Accept: application/json"</pre>
    </div>

    <div id="projects-endpoint" class="docs-section">
        <h2>Project-related API endpoints</h2>
        <p>These endpoints provide CRUD operations for projects through the API. The provided endpoints are:</p>
        <br />

        <ul class="endpoints-list">
            <li>
                <code><code class="method-get">GET</code> /api/projects</code>
                <p>Returns all the projects.</p>

                <pre class="codeblock">
curl -X GET http://127.0.0.1:8000/api/projects \
-H "X-API-KEY: your-key-here" \
-H "Accept: application/json"</pre>
                
                <br />
                <br />
                <h4>Example results:</h4>
                <pre class="codeblock">
[
    {
        "id":1,
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
                <code><code class="method-get">GET</code> /api/projects/{id}</code>
                <p>Returns the project with that respective ID.</p>

                <pre class="codeblock">
curl -X GET http://127.0.0.1:8000/api/projects/1 \
-H "X-API-KEY: your-key-here" \
-H "Accept: application/json"</pre>

                <br />
                <br />
                <h4>Example results:</h4>
                <pre class="codeblock">
{
    "id":1,
    "title":"Kebab Recipe",
    "description":"Steps in making a kebab!",
    "created_at":"2026-03-28T08:07:43.000000Z",
    "updated_at":"2026-03-28T08:07:43.000000Z",
    "tasks":[...]
}</pre>
            </li>

            <li>
                <code><code class="method-get">GET</code> /api/projects?title=...</code>
                <p>Returns the project with the respective title.</p>

                <pre class="codeblock">
curl -X GET http://127.0.0.1:8000/api/projects?title=Kebab%20Recipe \
-H "X-API-KEY: your-key-here" \
-H "Accept: application/json"</pre>
                <p class="hint">Note that <code>" "</code> has been replaced with <code>%20</code><p>

                <br />
                <br />
                <h4>Example results:</h4>
                <pre class="codeblock">
[
    {
        "id":1,
        "title":"Kebab Recipe",
        "description":"Steps in making a kebab!",
        "created_at":"2026-03-29T10:35:07.000000Z",
        "updated_at":"2026-03-29T10:35:07.000000Z",
        "tasks":[ ... ]
    }
]</pre>
            </li>

            <li>
                <code><code class="method-get">GET</code> /api/projects?desc=...</code>
                <p>Returns the project with the respective description.</p>

                <pre class="codeblock">
curl -X GET http://127.0.0.1:8000/api/projects?desc=Steps%20in%20making%20a%20kebab\! \ 
-H "X-API-KEY: your-key-here" \
-H "Accept: application/json"</pre>

                <br />
                <br />
                <h4>Example results:</h4>
                <pre class="codeblock">
[
    {
        "id":1,
        "title":"Kebab Recipe",
        "description":"Steps in making a kebab!",
        "created_at":"2026-03-29T10:35:07.000000Z",
        "updated_at":"2026-03-29T10:35:07.000000Z",
        "tasks":[ ... ]
    }
]</pre>
            </li>

            <li>
                <code><code class="method-post">POST</code> /api/projects</code>
                <p>Creates a project for the user and returns the new project's data.</p>

                <pre class="codeblock">
curl -X POST http://127.0.0.1:8000/api/projects \
-H "X-API-KEY: your-key-here" \ 
-H "Content-Type: application/json" \ 
-H "Accept: application/json" \
-d '{"title": "CURL Test", "description": "Created through CURL"}'</pre>

                <br />
                <br />
                <h4>Example results:</h4>
                <pre class="codeblock">
{
    "title":"CURL Test",
    "description":"Created through CURL",
    "updated_at":"2026-03-29T13:30:50.000000Z",
    "created_at":"2026-03-29T13:30:50.000000Z",
    "id":2
}</pre>
            </li>

            <li>
                <code><code class="method-put">PUT</code> /api/projects/{id}</code>
                <p>Updates the project with that respective ID.</p>

                <pre class="codeblock">
curl -X PUT http://127.0.0.1:8000/api/projects/2 \
-H "X-API-KEY: your-key-here" \
-H "Content-Type: application/json" \
-H "Accept: application/json" \
-d '{"title": "CURL Test (Updated)", "description": "Created through CURL (Updated)"}'</pre>

                <br />
                <br />
                <h4>Example results:</h4>
                <pre class="codeblock">
{
    "title":"CURL Test",
    "description":"Created through CURL",
    "updated_at":"2026-03-29T13:30:50.000000Z",
    "created_at":"2026-03-29T13:30:50.000000Z",
    "id":2
}</pre>
            </li>

            <li>
                <code><code class="method-del">DELETE</code> /api/projects/{id}</code>
                <p>Deletes the project with that respective ID.</p>

                <pre class="codeblock">
curl -X DELETE http://127.0.0.1:8000/api/projects/2 \
-H "X-API-KEY: your-key-here" \ 
-H "Accept: application/json"</pre>

                <br />
                <br />
                <h4>Example results:</h4>
                <pre class="codeblock">
{
    "message":"Project deleted successfully"
}</pre>
            </li>
        </ul>
    </div>

    <div id="tasks-endpoint" class="docs-section">
        <h2>Task-related API endpoints</h2>
        <p>These endpoints provide CRUD operations for tasks through the API.</p>
        <br />

        <ul class="endpoints-list">
            <li>
                <code><code class="method-get">GET</code> /api/tasks</code>
                <p>Returns all the tasks.</p>

                <pre class="codeblock">
curl -X GET http://127.0.0.1:8000/api/tasks \
-H "X-API-KEY: your-key-here" \
-H "Accept: application/json"</pre>
                
                <br />
                <br />
                <h4>Example results:</h4>
                <pre class="codeblock">
[
    {
        "id":1,
        "project_id":1,
        "title":"Make kebab",
        "status":"pending",
        "due_date":"2026-03-25",
        "created_at":"2026-03-28T08:07:43.000000Z",
        "updated_at":"2026-03-28T08:07:43.000000Z"
    },
    {
        "id":2,
        "project_id":1,
        "title":"Meter pima?",
        "status":"pending",
        "due_date":"2026-03-21",
        "created_at":"2026-03-28T08:07:43.000000Z",
        "updated_at":"2026-03-28T08:07:43.000000Z"
    },
    ...
]</pre>
            </li>

            <li>
                <code><code class="method-get">GET</code> /api/tasks/{id}</code>
                <p>Returns the task with that respective ID.</p>
                
                <pre class="codeblock">
curl -X GET http://127.0.0.1:8000/api/tasks/2 \
-H "X-API-KEY: your-key-here" \
-H "Accept: application/json"</pre>
 
                <br />
                <br />
                <h4>Example results:</h4>
                <pre class="codeblock">
{
    "id":2,
    "user_id":1,
    "project_id":1,
    "title":"Meter pima?",
    "status":"pending",
    "due_date":"2026-03-23",
    "created_at":"2026-03-30T09:52:42.000000Z",
    "updated_at":"2026-03-30T09:52:42.000000Z"
}</pre>
            </li>

            <li>
                <code><code class="method-get">GET</code> /api/tasks?project_id=...</code>
                <p>Returns all the tasks linked to a project ID.</p>

<pre class="codeblock">
curl -X GET http://127.0.0.1:8000/api/tasks?project_id=1 \
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
        "status":"pending",
        "due_date":"2026-03-27",
        "created_at":"2026-03-30T09:52:42.000000Z",
        "updated_at":"2026-03-30T09:52:42.000000Z"
    },
    {
        "id":2,
        "user_id":1,
        "project_id":1,
        "title":"Meter pima?",
        "status":"pending",
        "due_date":"2026-03-23",
        "created_at":"2026-03-30T09:52:42.000000Z",
        "updated_at":"2026-03-30T09:52:42.000000Z"
    }
    ...
]</pre>
            </li>

            <li>
                <code><code class="method-get">GET</code> /api/tasks?title=...</code>
                <p>Returns all the tasks with the respective title.</p>

<pre class="codeblock">
curl -X GET http://127.0.0.1:8000/api/tasks?title=Make%20kebab \
-H "X-API-KEY: your-key-here" \
-H "Accept: application/json"</pre>
 
                <br />
                <br />
                <h4>Example results:</h4>
                <pre class="codeblock">
{
    "id":1,
    "user_id":1,
    "project_id":1,
    "title":"Make kebab",
    "status":"pending",
    "due_date":"2026-03-27",
    "created_at":"2026-03-30T09:52:42.000000Z",
    "updated_at":"2026-03-30T09:52:42.000000Z"
}</pre>
            </li>

            <li>
                <code><code class="method-get">GET</code> /api/tasks?status=...</code>
                <p>Returns all the tasks with the respective status.</p>

<pre class="codeblock">
curl -X GET http://127.0.0.1:8000/api/tasks?status=pending \
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
        "status":"pending",
        "due_date":"2026-03-27",
        "created_at":"2026-03-30T09:52:42.000000Z",
        "updated_at":"2026-03-30T09:52:42.000000Z"
    },
    {
        "id":2,
        "user_id":1,
        "project_id":1,
        "title":"Meter pima?",
        "status":"pending",
        "due_date":"2026-03-23",
        "created_at":"2026-03-30T09:52:42.000000Z",
        "updated_at":"2026-03-30T09:52:42.000000Z"
    }
    ...
]</pre>
            </li>

            <li>
                <code><code class="method-get">GET</code> /api/tasks?year=...</code>
                <p>Returns all the tasks in a specific year.</p>

                <pre class="codeblock">
curl -X GET http://127.0.0.1:8000/api/tasks?year=2026 \
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
        "status":"pending",
        "due_date":"2026-03-26",
        "created_at":"2026-03-29T10:35:07.000000Z",
        "updated_at":"2026-03-29T10:35:07.000000Z"
    },
    {
        "id":2,
        "user_id":1,
        "project_id":1,
        "title":"Meter pima?",
        "status":"pending",
        "due_date":"2026-03-22",
        "created_at":"2026-03-29T10:35:07.000000Z",
        "updated_at":"2026-03-29T10:35:07.000000Z"
    },
    ...
]
</pre>
            </li>

            <li>
                <code><code class="method-get">GET</code> /api/tasks?month=...</code>
                <p>Returns all the tasks in a specific month.</p>

<pre class="codeblock">
curl -X GET http://127.0.0.1:8000/api/tasks?month=1 \
-H "X-API-KEY: your-key-here" \
-H "Accept: application/json"</pre>
 
                <br />
                <br />
                <h4>Example results:</h4>
                <pre class="codeblock">
{
    "id":3,
    "user_id":1,
    "project_id":1,
    "title":"Meter tous!",
    "status":"done",
    "due_date":"2026-01-30",
    "created_at":"2026-03-30T11:53:59.000000Z",
    "updated_at":"2026-03-30T11:53:59.000000Z"
}</pre>
            </li>

            <li>
                <code><code class="method-get">GET</code> /api/tasks?due=...</code>
                <p>Returns all the tasks that are due within a specified number of hours.</p>

                <pre class="codeblock">
curl -X GET http://127.0.0.1:8000/api/tasks?due=148 \
-H "X-API-KEY: your-key-here" \
-H "Accept: application/json"</pre>

                <br />
                <br />
                <h4>Example results:</h4>
                <pre class="codeblock">
{
    "id":3,
    "user_id":1,
    "project_id":1,
    "title":"Meter tous!",
    "status":"done",
    "due_date":"2026-01-30",
    "created_at":"2026-03-30T11:53:59.000000Z",
    "updated_at":"2026-03-30T11:53:59.000000Z"
}</pre>
            </li>

            <li>
                <code><code class="method-post">POST</code> /api/tasks</code>
                <p>Creates a new task (given that <code class="api-reqs">project_id</code> is provided) and returns its ID.</p>

<pre class="codeblock">
curl -X POST "http://127.0.0.1:8000/api/tasks" \
-H "X-API-KEY: your-key-here" \
-H "Accept: application/json" \
-H "Content-Type: application/json" \
-d '{
    "project_id": 1,
    "title": "Wrap Crispy! Ena",
    "status": "done",
    "due_date": "2026-04-05 14:00:00"
}'</pre>
 
                <br />
                <br />
                <h4>Example results:</h4>
                <pre class="codeblock">4</pre>
            </li>

            <li>
                <code><code class="method-put">PUT</code> /api/tasks/{id}</code>
                <p>Updates the task with that respective ID.</p>

<pre class="codeblock">
curl -X PUT "http://127.0.0.1:8000/api/tasks" \
-H "X-API-KEY: your-key-here" \
-H "Accept: application/json" \
-H "Content-Type: application/json" \
-d '{
    "title":"Meter pima? (Updated)",
    "status": "done",
    "due_date": "2026-04-05 15:00:00"
}'</pre>
 
                <br />
                <br />
                <h4>Example results:</h4>
                <pre class="codeblock">
{
    "id":2,
    "user_id":1,
    "project_id":1,
    "title":"Meter pima? (Updated)",
    "status":"done",
    "due_date":"2026-04-05 15:00:00",
    "created_at":"2026-03-30T11:53:59.000000Z",
    "updated_at":"2026-03-30T13:49:18.000000Z"
}</pre>
            </li>

            <li>
                <code><code class="method-del">DELETE</code> /api/tasks/{id}</code>
                <p>Deletes the task with that respective ID.</p>

<pre class="codeblock">
curl -X PUT "http://127.0.0.1:8000/api/tasks/3" \
-H "X-API-KEY: your-key-here" \
-H "Accept: application/json" \
-H "Content-Type: application/json"</pre>
 
                <br />
                <br />
                <h4>Example results:</h4>
                <pre class="codeblock">
{
    "message":"Task deleted successfully"
}</pre>
            </li>
        </ul>
    </div>

    <div id="advanced-query" class="docs-section">
        <h2>Advanced querying</h2>
        <p>More specific data can be queried by chaining <code class="method-get">GET</code> parameters.</p>
        <br />

        <h4>Example:</h4>
        <p>Searching for pending tasks with a deadline within the upcoming week.</p>
        <pre class="codeblock">
curl -X GET http://127.0.0.1:8000/api/tasks?status=pending&due=148 \
-H "X-API-KEY: your-key-here" \
-H "Accept: application/json"</pre>

        <br />
        <br />
        <h4>Example results:</h4>
        <pre class="codeblock">
[
    {
        "id":3,
        "user_id":1,
        "project_id":1,
        "title":"Wrap Crispy! Ena",
        "status":"pending",
        "due_date":"2026-04-05",
        "created_at":"2026-03-30T15:41:08.000000Z",
        "updated_at":"2026-03-30T15:41:08.000000Z"
    }
]</pre>
    </div>
</div>

<script defer>
    async function generateKey() {
        try {
            const response = await fetch("{{ route('generate.key') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}", // Escaping JS to feed PHP data
                    "Accept": "application/json"
                }
            });

            const data = await response.json();

            // Update UI with new key
            const container = document.getElementById("api-key-container");
            container.innerHTML = `
                <div class="codebox-wrapper">
                    <code id="api-key-box" class="codebox">
                        ${data.api_key}
                    </code>
                    <button class="copy-btn" onclick="copyAPIKey()">Copy</button>
                </div>
            `;

        } catch (err) {
            alert("Error when generating API key");
            console.error(err);
        }
    }

    function copyAPIKey() {
        const key = document.getElementById("api-key-box").innerText;
        navigator.clipboard.writeText(key)
            .then(() => { alert("API Key copied!"); })
            .catch(() => { alert("Failed to copy API Key"); });
    }
</script>
@endsection
