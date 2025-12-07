<?php
require_once("config.php");
requireLogin();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['borrow_id'])) {
    $borrow_id = filter_input(INPUT_POST, 'borrow_id', FILTER_VALIDATE_INT);
    $user_id = $_SESSION['user_id'];
    
    // Verify this borrow record belongs to the current user
    $sql = "SELECT * FROM borrowed_books WHERE id = ? AND user_id = ? AND status = 'borrowed'";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $borrow_id, $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $borrow = mysqli_fetch_assoc($result);
    
    if ($borrow) {
        // Update borrow record
        $return_date = date('Y-m-d');
        $update_sql = "UPDATE borrowed_books SET status = 'returned', return_date = ? WHERE id = ?";
        $update_stmt = mysqli_prepare($conn, $update_sql);
        mysqli_stmt_bind_param($update_stmt, "si", $return_date, $borrow_id);
        
        if (mysqli_stmt_execute($update_stmt)) {
            // Increase available quantity
            $book_sql = "UPDATE books SET available_quantity = available_quantity + 1 WHERE id = ?";
            $book_stmt = mysqli_prepare($conn, $book_sql);
            mysqli_stmt_bind_param($book_stmt, "i", $borrow['book_id']);
            mysqli_stmt_execute($book_stmt);
            
            $_SESSION['success'] = "Book returned successfully!";
        } else {
            $_SESSION['error'] = "Failed to return book. Please try again.";
        }
    } else {
        $_SESSION['error'] = "Invalid request!";
    }
}

mysqli_close($conn);
header("Location: myborrowed.php");
exit();
?>
