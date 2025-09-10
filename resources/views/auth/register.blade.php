<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-lg p-4 rounded-4" style="width: 450px;">
        <h3 class="text-center mb-4">Create Account</h3>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name"
                    required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email"
                    required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control"
                    placeholder="Enter your password" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                    placeholder="Confirm your password" required>
            </div>
            <button type="submit" class="btn btn-success w-100 rounded-pill">Register</button>
        </form>
        <p class="text-center mt-3 mb-0">
            Already have an account? <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
        </p>
    </div>

</body>

</html>
