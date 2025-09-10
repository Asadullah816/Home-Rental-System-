<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-lg p-4 rounded-4" style="width: 400px;">
        <h3 class="text-center mb-4">Login</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf
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
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="remember">
                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>
                </div>
                <a href="#" class="text-decoration-none">Forgot Password?</a>
            </div>
            <button type="submit" class="btn btn-primary w-100 rounded-pill">Login</button>
        </form>
        <p class="text-center mt-3 mb-0">
            Don’t have an account? <a href="{{ route('register') }}" class="text-decoration-none">Register</a>
        </p>
    </div>

</body>

</html>
