<?php
require_once("config.php");
requireLogin();
$user = getCurrentUser();

// Get all books
$sql = "SELECT * FROM books ORDER BY title ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Books - Library Management System</title>
    <style>
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .book-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .book-card:hover {
            transform: translateY(-5px);
        }
        .book-card h3 {
            color: #333;
            margin-bottom: 10px;
        }
        .book-info {
            color: #666;
            margin: 5px 0;
            font-size: 14px;
        }
        .book-status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 10px;
        }
        .available {
            background-color: #e8f5e9;
            color: #2e7d32;
        }
        .unavailable {
            background-color: #ffebee;
            color: #c62828;
        }
        .borrow-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 15px;
            width: 100%;
            font-weight: 600;
        }
        .borrow-btn:hover {
            opacity: 0.9;
        }
        .borrow-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <h1>Sarasavi Library</h1>
            <div class="nav-links">
                <a href="dashboard.php">Dashboard</a>
                <a href="books.php" class="active">Books</a>
                <a href="myborrowed.php">My Borrowed Books</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="welcome-card">
            <h2>📚 Available Books</h2>
            <p>Browse and borrow books from our collection</p>
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="success-message"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
            <?php endif; ?>
        </div>

        <div class="books-grid">
            <?php while($book = mysqli_fetch_assoc($result)): ?>
                <div class="book-card">
                    <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                    <div class="book-info">
                        <strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?>
                    </div>
                    <div class="book-info">
                        <strong>Category:</strong> <?php echo htmlspecialchars($book['category']); ?>
                    </div>
                    <div class="book-info">
                        <strong>ISBN:</strong> <?php echo htmlspecialchars($book['isbn']); ?>
                    </div>
                    <div class="book-info">
                        <strong>Available:</strong> <?php echo $book['available_quantity']; ?> / <?php echo $book['quantity']; ?>
                    </div>
                    
                    <?php if($book['available_quantity'] > 0): ?>
                        <span class="book-status available">✓ Available</span>
                        <form action="borrow_book.php" method="POST">
                            <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                            <button type="submit" class="borrow-btn">Borrow This Book</button>
                        </form>
                    <?php else: ?>
                        <span class="book-status unavailable">✗ Not Available</span>
                        <button class="borrow-btn" disabled>Out of Stock</button>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Sarasavi Library Management System</p>
    </footer>
</body>
</html>

<?php mysqli_close($conn); ?>
