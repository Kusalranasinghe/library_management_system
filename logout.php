<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Logged Out</title>
    <meta http-equiv="refresh" content="2;url=index.php">
</head>
<body>
    <div class="container" style="text-align: center; margin-top: 100px;">
        <h2>✅ You have been logged out successfully!</h2>
        <p>Redirecting to home page...</p>
        <a href="index.php" class="btn">Go to Home</a>
    </div>
</body>
</html>
