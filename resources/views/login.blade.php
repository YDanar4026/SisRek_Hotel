<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | JakartaHotels</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            background: white;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
            width: 800px;
        }

        .image-section {
            flex: 1;
        }

        .image-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .form-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h2 {
            margin-bottom: 20px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-bottom: 1px solid #ccc;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .button-group button {
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }

        .cancel-btn {
            background: #eee;
        }

        .login-btn {
            background: #4FC3F7;
            color: white;
        }

        .no-account {
            margin-top: 20px;
            font-size: 14px;
            text-align: center;
        }

        .no-account a {
            color: #00B0FF;
            text-decoration: none;
            font-weight: bold;
        }

        .no-account a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="image-section">
            <img src="{{ asset('images/hotel.jpg') }}" alt="Hotel Lobby">
        </div>
        <div class="form-section">
            <h2>Welcome Back</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>

                <div class="button-group">
                    <button type="reset" class="cancel-btn">Cancel</button>
                    <button type="submit" class="login-btn">Login</button>
                </div>
            </form>

            <p class="no-account">
                Don't have an account? <a href="{{ route('register') }}">Register here</a>
            </p>
        </div>
    </div>
</body>
</html>
