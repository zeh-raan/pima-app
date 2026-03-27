<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>Welcome</h1>

    <p>You are logged in as:</p>
    <h3>{{ auth()->user()->email }}</h3>

    <hr>

    <h2>API Key</h2>

    <!-- Show existing key -->
    @if(auth()->user()->api_key)
        <p><strong>Current Key:</strong></p>
        <code>{{ auth()->user()->api_key }}</code>
    @endif

    <!-- Show newly generated key (flash) -->
    {{-- @if(session('api_key'))
        <p style="color:green;"><strong>New API Key generated:</strong></p>
        <code>{{ session('api_key') }}</code>
    @endif --}}

    <br>

    <!-- Generate button -->
    <form method="POST" action="{{ route('generate.key') }}">
        @csrf
        <button type="submit">
            Generate / Regenerate API Key
        </button>
    </form>

    <hr>

    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>