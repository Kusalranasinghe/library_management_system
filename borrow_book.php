<?php
require_once("config.php");
requireLogin();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['book_id'])) {
    $book_id = filter_input(INPUT_POST, 'book_id', FILTER_VALIDATE_INT);
    $user_id = $_SESSION['user_id'];
    
    // Check if book is available
    $sql = "SELECT available_quantity FROM books WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $book_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $book = mysqli_fetch_assoc($result);
    
    if ($book && $book['available_quantity'] > 0) {
        // Check if user already borrowed this book
        $check_sql = "SELECT * FROM borrowed_books WHERE user_id = ? AND book_id = ? AND status = 'borrowed'";
        $check_stmt = mysqli_prepare($conn, $check_sql);
        mysqli_stmt_bind_param($check_stmt, "ii", $user_id, $book_id);
        mysqli_stmt_execute($check_stmt);
        $check_result = mysqli_stmt_get_result($check_stmt);
        
        if (mysqli_num_rows($check_result) > 0) {
            $_SESSION['error'] = "You have already borrowed this book!";
        } else {
            // Borrow the book
            $borrow_date = date('Y-m-d');
            $due_date = date('Y-m-d', strtotime('+14 days')); // 2 weeks borrowing period
            
            $insert_sql = "INSERT INTO borrowed_books (user_id, book_id, borrow_date, due_date, status) VALUES (?, ?, ?, ?, 'borrowed')";
            $insert_stmt = mysqli_prepare($conn, $insert_sql);
            mysqli_stmt_bind_param($insert_stmt, "iiss", $user_id, $book_id, $borrow_date, $due_date);
            
            if (mysqli_stmt_execute($insert_stmt)) {
                // Update available quantity
                $update_sql = "UPDATE books SET available_quantity = available_quantity - 1 WHERE id = ?";
                $update_stmt = mysqli_prepare($conn, $update_sql);
                mysqli_stmt_bind_param($update_stmt, "i", $book_id);
                mysqli_stmt_execute($update_stmt);
                
                $_SESSION['success'] = "Book borrowed successfully! Due date: " . date('F j, Y', strtotime($due_date));
            } else {
                $_SESSION['error'] = "Failed to borrow book. Please try again.";
            }
        }
    } else {
        $_SESSION['error'] = "This book is not available!";
    }
}

mysqli_close($conn);
header("Location: books.php");
exit();
?>
