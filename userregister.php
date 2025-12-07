<?php

include("database.php");

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
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">

        <h2 style="text-align: center;">User Registration</h2> <br>

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
        echo "Please Enter your name !";
    } elseif (empty($nic)) {
        echo "Please Enter your NIC number !";
    } elseif (empty($telephone)) {
        echo "Please Enter your phone number !";
    } elseif (empty($email)) {
        echo "Please Enter your email !";
    } elseif (empty($password)) {
        echo "Please Enter your password !";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name,nic,telephone,email,password) VALUES ($name, $nic, $telephone, $email, $password)";

        mysqli_query($conn, $sql);
        echo "Registered !!!";
    }

}
mysqli_close($conn);
?>