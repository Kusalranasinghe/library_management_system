<?php
require_once("config.php");
requireLogin();
$user = getCurrentUser();
$user_id = $_SESSION['user_id'];

// Get borrowed books for current user
$sql = "SELECT bb.*, b.title, b.author, b.isbn 
        FROM borrowed_books bb 
        JOIN books b ON bb.book_id = b.id 
        WHERE bb.user_id = ? AND bb.status = 'borrowed'
        ORDER BY bb.borrow_date DESC";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>My Borrowed Books - Library Management System</title>
    <style>
        table {
            width: 100%;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .overdue {
            color: #c62828;
            font-weight: 600;
        }
        .return-btn {
            background: #4caf50;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .return-btn:hover {
            background: #45a049;
        }
        .no-books {
            text-align: center;
            padding: 40px;
            color: #666;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <h1>Sarasavi Library</h1>
            <div class="nav-links">
                <a href="dashboard.php">Dashboard</a>
                <a href="books.php">Books</a>
                <a href="myborrowed.php" class="active">My Borrowed Books</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="welcome-card">
            <h2>📖 My Borrowed Books</h2>
            <p>View and manage your borrowed books</p>
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="success-message"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
            <?php endif; ?>
        </div>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Author</th>
                        <th>Borrow Date</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($borrow = mysqli_fetch_assoc($result)): 
                        $today = date('Y-m-d');
                        $is_overdue = $today > $borrow['due_date'];
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($borrow['title']); ?></td>
                            <td><?php echo htmlspecialchars($borrow['author']); ?></td>
                            <td><?php echo date('M j, Y', strtotime($borrow['borrow_date'])); ?></td>
                            <td class="<?php echo $is_overdue ? 'overdue' : ''; ?>">
                                <?php echo date('M j, Y', strtotime($borrow['due_date'])); ?>
                                <?php if($is_overdue): ?>
                                    <br><small>(OVERDUE)</small>
                                <?php endif; ?>
                            </td>
                            <td>Borrowed</td>
                            <td>
                                <form action="return_book.php" method="POST" style="margin: 0;">
                                    <input type="hidden" name="borrow_id" value="<?php echo $borrow['id']; ?>">
                                    <button type="submit" class="return-btn">Return Book</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-books">
                <h3>You haven't borrowed any books yet.</h3>
                <p><a href="books.php" class="btn">Browse Books</a></p>
            </div>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2025 Sarasavi Library Management System</p>
    </footer>
</body>
</html>

<?php 
mysqli_stmt_close($stmt);
mysqli_close($conn); 
?>
