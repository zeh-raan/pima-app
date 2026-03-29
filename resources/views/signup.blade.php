{{-- Does not extend main layout so as to not have sidebar --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign up</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>

<body>
    <div class="auth-container">
        <h2>Sign up</h2>

        <form method="POST" action="/signup">
            @csrf

            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit">Sign Up</button>
        </form>

        <p>Already have an account? <a href="/login">Log in</a></p>

        @if ($errors->any())
            <div class="error-box">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>