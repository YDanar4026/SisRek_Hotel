<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | JogjaHotels</title>
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

        .signup-btn {
            background: #4FC3F7;
            color: white;
        }

        .brand {
            color: #00B0FF;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="image-section">
            <img src="{{ asset('images/hotel-room.jpg') }}" alt="Hotel Room">
        </div>
        <div class="form-section">
            <h2>Let's Set Up</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="New password" required>
                <input type="text" name="fullname" placeholder="Fullname" required>
                <input type="date" name="birthdate" placeholder="Birth date" required>
                
                <div class="button-group">
                    <button type="reset" class="cancel-btn">Cancel</button>
                    <button type="submit" class="signup-btn">Sign Up</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
