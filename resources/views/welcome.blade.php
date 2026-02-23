<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hospital Management System</title>

    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: white;
            flex-direction: column;
        }

        .landing-container {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 50px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            max-width: 450px;
        }

        .landing-container h1 {
            font-size: 36px;
            margin-bottom: 15px;
            color: #ffffff;
        }

        .tagline {
            font-size: 18px;
            color: #e0e0e0;
            margin-bottom: 25px;
            min-height: 24px;
            overflow: hidden;
        }

        /* Animation */
        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }
        .animated-text {
            display: inline-block;
            border-right: 2px solid #fff;
            white-space: nowrap;
            overflow: hidden;
            animation: typing 3s steps(30, end) forwards;
        }

        .icons {
            margin: 20px 0;
        }

        .icons i {
            font-size: 36px;
            margin: 0 15px;
            color: #ffffff;
            transition: 0.3s;
        }

        .icons i:hover {
            color: #a0c4ff;
            transform: scale(1.2);
        }

        .landing-container a {
            display: inline-block;
            margin: 10px;
            padding: 12px 25px;
            font-size: 16px;
            color: #ffffff;
            background-color: #1e3c72;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }

        .landing-container a:hover {
            background-color: #16345a;
        }

        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 13px;
            color: #d0d0d0;
        }

        footer p {
            margin: 5px 0;
        }

        @media (max-width: 500px) {
            .landing-container { width: 90%; padding: 30px; }
            .landing-container h1 { font-size: 28px; }
            .tagline { font-size: 16px; }
        }
    </style>
</head>
<body>

<div class="landing-container">
    <h1>Welcome to Hospital Management</h1>

    <div class="tagline">
        <span class="animated-text">Efficiently manage patients, doctors & appointments</span>
    </div>

    <!-- Icons -->
    <div class="icons">
        <i class="fas fa-user-md" title="Doctors"></i>
        <i class="fas fa-procedures" title="Patients"></i>
        <i class="fas fa-briefcase-medical" title="Appointments"></i>
        <i class="fas fa-hospital" title="Hospital"></i>
    </div>

    <!-- Buttons -->
    <a href="{{ route('login') }}">Sign In</a>
    <a href="{{ route('register') }}">Sign Up</a>
</div>

<!-- Footer -->
<footer>
    <p>© {{ date('Y') }} Hospital Management System</p>
    <p>Welcome! We provide a modern system to manage all hospital operations efficiently.</p>
    <p>Track patients, appointments, doctors, and hospital resources with ease.</p>
</footer>

</body>
</html>
