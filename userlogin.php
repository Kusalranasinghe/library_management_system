<?php
<<<<<<< Updated upstream
require_once("config.php");

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (empty($email)) {
        $error = "Please enter your email!";
    } elseif (empty($password)) {
        $error = "Please enter your password!";
    } else {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                // Start session and redirect to dashboard
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Invalid password!";
            }
        } else {
            $error = "No user found with this email!";
        }
        mysqli_stmt_close($stmt);
    }
}
mysqli_close($conn);
?>

=======
include("database.php");
session_start();
?>
>>>>>>> Stashed changes
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<<<<<<< Updated upstream
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">

        <h2 style="text-align: center;">User Login</h2> <br>
        
        <?php if (!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if (!empty($success)): ?>
            <div class="success-message"><?php echo $success; ?></div>
        <?php endif; ?>
=======

<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2 style="margin: 10px;">Login</h2>
>>>>>>> Stashed changes

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email :" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password :" required>

        <input type="submit" value="Login">
<<<<<<< Updated upstream

        <p>Don't have an account yet?</p>
        <a href="userregister.php">Register Here !</a>

    </form>

    <script>
        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            
            if (!email) {
                alert('Please enter your email!');
                e.preventDefault();
                return false;
            }
            
            if (!password) {
                alert('Please enter your password!');
                e.preventDefault();
                return false;
            }
            
            if (password.length < 6) {
                alert('Password must be at least 6 characters long!');
                e.preventDefault();
                return false;
            }
        });
    </script>
=======
    </form>

>>>>>>> Stashed changes
</body>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    echo "hareee";

    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $password = $_POST["password"];

    if (empty($email && $password)) {
        echo "All fields are required";
    } else {


        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);


            if (password_verify($password, $user["password"])) {


                $_SESSION["user"] = $user["name"];

                header("Location: dashboard.php");
                exit();

            } else {
                echo "Invalid password";
            }

        } else {
            echo "No user found with this email";
        }
    }
}

mysqli_close($conn);
?>