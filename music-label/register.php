<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (addUser($pdo, $first_name, $last_name, $email, $password)) {
        header("Location: login.php");
        exit;
    } else {
        echo "Error: Registration failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="POST">
        <p><label for="first_name">First Name: </label><input type="text" name="first_name" required></p>
        <p><label for="last_name">Last Name: </label><input type="text" name="last_name" required></p>
        <p><label for="email">Email: </label><input type="email" name="email" required></p>
        <p><label for="password">Password: </label><input type="password" name="password" required></p>
        <p><input type="submit" value="Register"></p>
    </form>
</body>
</html>
