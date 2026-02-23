<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hospital Management System</title>

    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background-color: #ffffff;
            width: 350px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
        }

        .login-container h1 {
            color: #1e3c72;
            margin-bottom: 10px;
            font-size: 28px;
        }

        .login-container p {
            color: #555;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
            outline: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .login-container input[type="email"]:focus,
        .login-container input[type="password"]:focus {
            border-color: #1e3c72;
            box-shadow: 0 0 5px rgba(30,60,114,0.5);
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            background-color: #1e3c72;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-container button:hover {
            background-color: #16345a;
        }

        .login-container a {
            display: block;
            margin-top: 15px;
            color: #1e3c72;
            font-size: 13px;
            text-decoration: none;
            transition: 0.3s;
        }

        .login-container a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 400px) {
            .login-container {
                width: 90%;
                padding: 30px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h1>Hospital Login</h1>
        <p>Enter your credentials to access the system</p>

        <!-- Blade slot for login form -->
        {{ $slot }}

    </div>

</body>
</html>
