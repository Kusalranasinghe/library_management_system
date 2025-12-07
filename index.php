<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Sarasavi Library - Home</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .home-container {
            background: white;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 500px;
        }
        .home-container h1 {
            color: #667eea;
            margin-bottom: 20px;
            font-size: 32px;
        }
        .home-container p {
            color: #666;
            margin-bottom: 30px;
            font-size: 16px;
        }
        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .button-group .btn {
            width: auto;
            padding: 12px 30px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="home-container">
        <h1>📚 Sarasavi Library</h1>
        <p>Welcome to our Library Management System. Please login or register to continue.</p>
        <div class="button-group">
            <a href="userlogin.php" class="btn">Login</a>
            <a href="userregister.php" class="btn">Register</a>
        </div>
    </div>
</body>
</html>