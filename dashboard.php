<<<<<<< Updated upstream
<?php
require_once("config.php");
requireLogin();
$user = getCurrentUser();
?>

=======
>>>>>>> Stashed changes
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< Updated upstream
    <link rel="stylesheet" href="styles.css">
    <title>Dashboard - Library Management System</title>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <h1>Sarasavi Library</h1>
            <div class="nav-links">
                <a href="dashboard.php" class="active">Dashboard</a>
                <a href="books.php">Books</a>
                <a href="myborrowed.php">My Borrowed Books</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="welcome-card">
            <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?>! 👋</h2>
            <p>You are successfully logged in to the Library Management System</p>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <h3>📚 Browse Books</h3>
                <p>Explore our collection of books</p>
                <a href="books.php" class="btn">View Books</a>
            </div>

            <div class="dashboard-card">
                <h3>📖 My Borrowed Books</h3>
                <p>Check your currently borrowed books</p>
                <a href="myborrowed.php" class="btn">View My Books</a>
            </div>

            <div class="dashboard-card">
                <h3>👤 My Profile</h3>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?><br>
                <strong>NIC:</strong> <?php echo htmlspecialchars($user['nic']); ?><br>
                <strong>Phone:</strong> <?php echo htmlspecialchars($user['telephone']); ?></p>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Sarasavi Library Management System</p>
    </footer>
</body>
</html>
=======
    <title>Document</title>
</head>
<body>
    <h1>Correct</h1>
</body>
</html>
>>>>>>> Stashed changes
