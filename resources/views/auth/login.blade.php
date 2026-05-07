<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — Husein Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #0a0a0f;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .bg-glow {
            position: fixed;
            width: 500px; height: 500px;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.15;
            pointer-events: none;
        }
        .bg-glow-1 { background: #3b4fdf; top: -200px; left: -100px; }
        .bg-glow-2 { background: #7c3aed; bottom: -200px; right: -100px; }

        .login-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 24px;
            padding: 3rem;
            width: 100%;
            max-width: 420px;
            backdrop-filter: blur(20px);
            position: relative;
            z-index: 2;
        }
        .login-card h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.5rem;
        }
        .login-card p {
            font-size: 0.88rem;
            color: rgba(255,255,255,0.4);
            margin-bottom: 2rem;
        }
        .form-group {
            margin-bottom: 1.2rem;
        }
        .form-group label {
            display: block;
            font-size: 0.78rem;
            font-weight: 600;
            color: rgba(255,255,255,0.5);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }
        .form-group input {
            width: 100%;
            padding: 0.85rem 1rem;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            color: #fff;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.3s ease;
            outline: none;
        }
        .form-group input:focus {
            border-color: #3b4fdf;
            box-shadow: 0 0 0 3px rgba(59, 79, 223, 0.15);
        }
        .remember-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .remember-row input[type="checkbox"] {
            accent-color: #3b4fdf;
        }
        .remember-row label {
            font-size: 0.82rem;
            color: rgba(255,255,255,0.4);
        }
        .btn-login {
            width: 100%;
            padding: 0.9rem;
            background: linear-gradient(135deg, #3b4fdf, #7c3aed);
            border: none;
            border-radius: 12px;
            color: #fff;
            font-size: 0.9rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(59, 79, 223, 0.3);
        }
        .error-msg {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #f87171;
            padding: 0.7rem 1rem;
            border-radius: 10px;
            font-size: 0.82rem;
            margin-bottom: 1rem;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: rgba(255,255,255,0.3);
            text-decoration: none;
            font-size: 0.82rem;
            transition: color 0.3s;
        }
        .back-link:hover { color: #3b4fdf; }
    </style>
</head>
<body>
    <div class="bg-glow bg-glow-1"></div>
    <div class="bg-glow bg-glow-2"></div>

    <div class="login-card">
        <h1>Welcome Back</h1>
        <p>Login to manage your portfolio</p>

        @if ($errors->any())
            <div class="error-msg">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@husein.dev">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
            </div>
            <div class="remember-row">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember me</label>
            </div>
            <button type="submit" class="btn-login">Sign In</button>
        </form>
        <a href="/" class="back-link">← Back to Portfolio</a>
    </div>
</body>
</html>
