<?php
session_start();
require_once 'core/dbConfig.php';
require_once 'core/models.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];


    if (empty($email) || empty($password)) {
        die("Email or password is empty."); // Debug
    }

    $user = getUserByEmail($pdo, $email);

    // Debug again
    if ($user) {

        echo "<pre>";
        print_r($user);
        echo "</pre>";

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_name'] = $user['first_name'] . ' ' . $user['last_name'];

            var_dump($_SESSION);



            if (!isset($_SESSION['user_id'])) {
                die("Session not set.");
            }


            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password."; // error mesg
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>

    <form action="login.php" method="POST">
        <p><label for="email">Email: </label><input type="email" name="email" required></p>
        <p><label for="password">Password: </label><input type="password" name="password" required></p>
        <p><input type="submit" value="Login"></p>
    </form>

    <p>Don’t have an account? <a href="register.php">Register here</a></p>
</body>
</html>
