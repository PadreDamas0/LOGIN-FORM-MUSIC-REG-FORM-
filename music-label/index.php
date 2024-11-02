<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$artists = getArtists($pdo); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artist Registration</title>
    <style>
        body { font-family: Arial; }
        input { font-size: 1.5em; height: 50px; width: 200px; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
    </style>
</head>
<body>

<h3>CASIL PRODUCTIONS MUSIC LABEL REGISTRATION FORM. Input your details here to register.</h3>

<form action="core/handleForms.php" method="POST">
    <p><label for="firstname">First Name: </label><input type="text" name="firstname" required></p>
    <p><label for="lastname">Last Name: </label><input type="text" name="lastname" required></p>
    <p><label for="email">Email: </label><input type="email" name="email" required></p>
    <p><label for="phone_number">Phone Number: </label><input type="text" name="phone_number" required></p>
    <p><label for="country">Country: </label><input type="text" name="country" required></p>
    <p><label for="genresigned">Genre Signed: </label><input type="text" name="genresigned" required></p>
    <p><label for="signingdate">Date of Signing: </label><input type="date" name="signingdate" required></p>
    <p><input type="submit" name="InsertArtist" value="Register"></p>
</form>

<hr>

<h3>Artist List</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Country</th>
            <th>Genre Signed</th>
            <th>Date of Signing</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($artists as $artist): ?>
        <tr>
            <td><?= $artist['id'] ?></td>
            <td><?= $artist['firstname'] ?></td>
            <td><?= $artist['lastname'] ?></td>
            <td><?= $artist['email'] ?></td>
            <td><?= $artist['phone_number'] ?></td>
            <td><?= $artist['country'] ?></td>
            <td><?= $artist['genresigned'] ?></td>
            <td><?= $artist['signingdate'] ?></td>
            <td>
                <a href="update.php?id=<?= $artist['id'] ?>">Edit</a>
                <form action="core/handleForms.php" method="POST" style="display:inline;">
                    <input type="hidden" name="artist_id" value="<?= $artist['id'] ?>">
                    <input type="submit" name="DeleteArtist" value="Delete" style="font-size: 0.8em; height: 30px;">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Logout Button -->
<form action="logout.php" method="POST">
    <button type="submit">Logout</button>
</form>

</body>
</html>
