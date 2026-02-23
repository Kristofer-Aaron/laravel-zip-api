<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - City & County Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

        .welcome-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 60px 40px;
            max-width: 600px;
            width: 100%;
        }
        .welcome-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .logo {
            font-size: 60px;
            margin-bottom: 20px;
        }
        .welcome-header h1 {
            font-size: 36px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        .welcome-header p {
            font-size: 16px;
            color: #666;
            margin-bottom: 0;
        }
        .welcome-content {
            margin-bottom: 40px;
        }
        .welcome-content h2 {
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .welcome-content p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .features {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }
        .features li {
            padding: 10px 0;
            padding-left: 30px;
            position: relative;
            color: #666;
        }
        .features li:before {
            content: "";
            position: absolute;
            left: 0;
            color: #667eea;
            font-weight: bold;
            font-size: 18px;
        }
        .cta-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 30px;
        }
        .btn-lg-custom {
            padding: 12px 40px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }
        .btn-secondary-custom {
            background: white;
        }
        .btn-secondary-custom:hover {
            background: #f8f9ff;
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="bg-success d-flex align-items-center justify-content-center min-vh-100">
    <div class="container mt-3">
        <div class="welcome-container">
            <div class="welcome-header">
                <div class="logo"></div>
                <h1>City & County Manager</h1>
                <p>By Kristóf Áron</p>
            </div>

            <div class="welcome-content">
                <h2 class="text-center">Welcome!</h2>
                <p class="text-center">This is a Laravel-based application for managing Hungarian cities and counties.</p>
            </div>

            <div class="cta-buttons">
                <a href="{{ route('login') }}" class="btn btn-lg btn-success">Login</a>
                <a href="{{ route('register') }}" class="btn btn-lg btn-outline-success">Register</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
