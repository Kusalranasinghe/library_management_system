<?php
require_once("config.php");

$error = "";
$success = "";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>User Registration</title>
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">

        <h2 style="text-align: center;">User Registration</h2> <br>
        
        <?php if (!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if (!empty($success)): ?>
            <div class="success-message"><?php echo $success; ?></div>
        <?php endif; ?>

        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Enter your name :">

        <label for="nic">NIC</label>
        <input type="text" id="nic" name="nic" placeholder="Enter NIC number :">

        <label for="telephone">Phone Number</label>
        <input type="text" id="telephone" name="telephone" placeholder="Enter phone number :">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email :">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password :">

        <input type="submit" value="Register">

        <p>Already have you an account ?</p>
        <a href="userlogin.php">Login Here !</a>

    </form>

    <script>
        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const nic = document.getElementById('nic').value.trim();
            const telephone = document.getElementById('telephone').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            
            if (!name) {
                alert('Please enter your name!');
                e.preventDefault();
                return false;
            }
            
            if (!nic) {
                alert('Please enter your NIC number!');
                e.preventDefault();
                return false;
            }
            
            if (nic.length < 9 || nic.length > 12) {
                alert('NIC must be between 9 and 12 characters!');
                e.preventDefault();
                return false;
            }
            
            if (!telephone) {
                alert('Please enter your phone number!');
                e.preventDefault();
                return false;
            }
            
            if (telephone.length < 10) {
                alert('Phone number must be at least 10 digits!');
                e.preventDefault();
                return false;
            }
            
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
            
            if (password.length < 8) {
                alert('Password must be at least 8 characters long!');
                e.preventDefault();
                return false;
            }
        });
    </script>
</body>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nic = filter_input(INPUT_POST, "nic", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $telephone = filter_input(INPUT_POST, "telephone", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (empty($name)) {
        $error = "Please Enter your name!";
    } elseif (empty($nic)) {
        $error = "Please Enter your NIC number!";
    } elseif (empty($telephone)) {
        $error = "Please Enter your phone number!";
    } elseif (empty($email)) {
        $error = "Please Enter your email!";
    } elseif (empty($password)) {
        $error = "Please Enter your password!";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
<<<<<<< Updated upstream
        $sql = "INSERT INTO users (name,nic,telephone,email,password) VALUES (?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $name, $nic, $telephone, $email, $hash);
        
        try {
            if(mysqli_stmt_execute($stmt)) {
                $success = "Registration Successful! Redirecting to login...";
                header("refresh:2;url=userlogin.php");
            } else {
                $error = "Registration failed. Please try again.";
            }
        } catch (mysqli_sql_exception $e) {
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                if (strpos($e->getMessage(), 'email') !== false) {
                    $error = "This email is already registered!";
                } elseif (strpos($e->getMessage(), 'nic') !== false) {
                    $error = "This NIC is already registered!";
                } else {
                    $error = "This information is already registered!";
                }
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
        mysqli_stmt_close($stmt);
=======
        $sql = "INSERT INTO users (name,nic,telephone,email,password) VALUES ($name, $nic, $telephone, $email, $password)";

        mysqli_query($conn, $sql);
        header("Location:userlogin.php");
>>>>>>> Stashed changes
    }

}
mysqli_close($conn);
?>