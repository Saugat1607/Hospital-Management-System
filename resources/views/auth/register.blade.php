<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hospital Register</title>

    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            display:flex; justify-content:center; align-items:center; min-height:100vh;
        }

        .auth-container {
            background-color: #fff;
            width: 360px; 
            padding:40px 35px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
        }

        h1 { color: #1e3c72; font-size:28px; margin-bottom:5px; }
        p { color: #555; font-size:14px; margin-bottom:25px; }

        .input-icon { position: relative; margin-bottom: 15px; }
        .input-icon input, .input-icon select {
            width: 100%; padding: 12px 40px 12px 12px;
            border-radius: 8px; border: 1px solid #ccc; outline: none;
            font-size: 14px; transition: 0.3s;
        }
        .input-icon input:focus, .input-icon select:focus { 
            border-color: #1e3c72; 
            box-shadow: 0 0 5px rgba(30,60,114,0.5); 
        }
        .input-icon i {
            position: absolute; right: 12px; top:50%;
            transform: translateY(-50%); color: #999;
        }

        button {
            width: 100%; padding:12px;
            background-color: #1e3c72; color:#fff; font-size:16px;
            border:none; border-radius:8px; cursor:pointer;
            transition:0.3s;
        }
        button:hover { background-color: #16345a; }

        a { display:block; margin-top:15px; color:#1e3c72; font-size:13px; text-decoration:none; transition:0.3s; }
        a:hover { text-decoration:underline; }

        .error { color:red; font-size:14px; margin-bottom:15px; text-align:left; }

        /* Styled checkbox and label */
        .checkbox-container {
            display: flex;
            align-items: center;
            font-size: 13px;
            color: #555;
            margin-bottom: 20px;
            gap:5px;
        }
        .checkbox-container input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #1e3c72;
        }

        @media (max-width:400px){ .auth-container{ width:90%; padding:30px; } }
    </style>
</head>
<body>

<div class="auth-container">
    <h1>Create Account</h1>
    <p>Sign up to access the hospital system</p>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Registration Form -->
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="input-icon">
            <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required autofocus>
            <i class="fas fa-user"></i>
        </div>

        <div class="input-icon">
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <i class="fas fa-envelope"></i>
        </div>

        <div class="input-icon">
            <input type="password" name="password" placeholder="Password" required>
            <i class="fas fa-lock"></i>
        </div>

        <div class="input-icon">
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            <i class="fas fa-lock"></i>
        </div>

        <div class="input-icon">
            <select name="role" required>
                <option value="" disabled selected>Select Role</option>
                <option value="patient">Patient</option>
                <option value="doctor">Doctor</option>
                <option value="admin">Admin</option>
            </select>
            <i class="fas fa-user-md"></i>
        </div>

        <label class="checkbox-container">
            <input type="checkbox" name="terms" required>
            I agree to the <a href="#">Terms and Conditions</a>
        </label>

        <button type="submit">Register</button>

        <a href="{{ route('login') }}">Already have an account? Login</a>
    </form>
</div>

</body>
</html>