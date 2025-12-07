<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>User Login</title>
</head>
<body>
    <form action="/action_page.php" >

        <h2 style="text-align: center;">User Login</h2> <br>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email :">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password :">

        <input type="submit" value="Login">

        <p>Already haven't you an account ?</p>
        <a href="userregister.php">Register Here !</a>

    </form>
</body>
</html>