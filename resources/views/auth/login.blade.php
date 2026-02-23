<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hospital Login</title>

    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .auth-container {
            background-color: #ffffff;
            width: 360px;
            padding: 40px 35px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
        }
        h1 { color: #1e3c72; font-size: 28px; margin-bottom: 10px; }
        p { color: #555; font-size: 14px; margin-bottom: 25px; }
        form input[type="email"], form input[type="password"] {
            width: 100%; padding: 12px 40px 12px 12px; margin-bottom: 20px;
            border-radius: 8px; border: 1px solid #ccc; outline: none; font-size: 14px;
            transition: 0.3s;
        }
        form input:focus { border-color: #1e3c72; box-shadow: 0 0 5px rgba(30,60,114,0.5); }
        .input-icon { position: relative; }
        .input-icon i { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #999; }
        button {
            width: 100%; padding: 12px; background-color: #1e3c72; color: #fff;
            font-size: 16px; border: none; border-radius: 8px; cursor: pointer;
            transition: 0.3s;
        }
        button:hover { background-color: #16345a; }
        a { display: block; margin-top: 15px; color: #1e3c72; font-size: 13px; text-decoration: none; transition: 0.3s; }
        a:hover { text-decoration: underline; }
        @media (max-width: 400px) { .auth-container { width: 90%; padding: 30px; } }
    </style>
</head>
<body>

<div class="auth-container">
    <h1>Hospital Login</h1>
    <p>Enter your credentials to access the system</p>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-icon">
            <input type="email" name="email" placeholder="Email" required autofocus>
            <i class="fas fa-envelope"></i>
        </div>

        <div class="input-icon">
            <input type="password" name="password" placeholder="Password" required>
            <i class="fas fa-lock"></i>
        </div>

        <button type="submit">Login</button>

        <a href="{{ route('password.request') }}">Forgot your password?</a>
        <a href="{{ route('register') }}">Don't have an account? Register</a>
    </form>
</div>

</body>
</html>
