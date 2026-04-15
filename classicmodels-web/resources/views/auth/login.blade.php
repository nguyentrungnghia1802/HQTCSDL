<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ClassicModels</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); min-height: 100vh; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center">
    <div class="card shadow-lg" style="width: 420px; border-radius: 16px; overflow: hidden;">
        <div class="card-header text-center py-4" style="background: #1a1a2e;">
            <h3 class="text-white mb-1"><i class="bi bi-car-front-fill"></i> ClassicModels</h3>
            <p class="text-secondary mb-0">Sign in to your account</p>
        </div>
        <div class="card-body p-4">
            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                           placeholder="admin@classicmodels.com" required autofocus>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                    Sign In
                </button>
            </form>
            <hr class="my-3">
            <div class="text-center text-muted small">
                <div>Demo — Admin: <code>admin@classicmodels.com</code> / <code>password</code></div>
                <div>Demo — User: <code>user@classicmodels.com</code> / <code>password</code></div>
            </div>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
