<?php
require_once 'core/dbConfig.php'; 
require_once 'core/models.php'; 


if (!isset($_GET['id'])) {
    die("Artist ID not provided.");
}


$artistId = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM artists WHERE id = :id");
$stmt->bindParam(':id', $artistId);
$stmt->execute();
$artist = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$artist) {
    die("Artist not found.");
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $country = $_POST['country'];
    $genresigned = $_POST['genresigned'];
    $signingdate = $_POST['signingdate'];

   
    $updateStmt = $pdo->prepare("UPDATE artists SET firstname = :firstname, lastname = :lastname, email = :email, phone_number = :phone_number, country = :country, genresigned = :genresigned, signingdate = :signingdate WHERE id = :id");
    $updateStmt->bindParam(':firstname', $firstname);
    $updateStmt->bindParam(':lastname', $lastname);
    $updateStmt->bindParam(':email', $email);
    $updateStmt->bindParam(':phone_number', $phone_number);
    $updateStmt->bindParam(':country', $country);
    $updateStmt->bindParam(':genresigned', $genresigned);
    $updateStmt->bindParam(':signingdate', $signingdate);
    $updateStmt->bindParam(':id', $artistId);

    if ($updateStmt->execute()) {
        header("Location: index.php"); 
        exit;
    } else {
        echo "Failed to update artist.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artist</title>
</head>
<body>

<h3>Edit Artist</h3>

<form action="" method="POST">
    <p><label for="firstname">First Name: </label><input type="text" name="firstname" value="<?= $artist['firstname'] ?>" required></p>
    <p><label for="lastname">Last Name: </label><input type="text" name="lastname" value="<?= $artist['lastname'] ?>" required></p>
    <p><label for="email">Email: </label><input type="email" name="email" value="<?= $artist['email'] ?>" required></p>
    <p><label for="phone_number">Phone Number: </label><input type="text" name="phone_number" value="<?= $artist['phone_number'] ?>" required></p>
    <p><label for="country">Country: </label><input type="text" name="country" value="<?= $artist['country'] ?>" required></p>
    <p><label for="genresigned">Genre Signed: </label><input type="text" name="genresigned" value="<?= $artist['genresigned'] ?>" required></p>
    <p><label for="signingdate">Date of Signing: </label><input type="date" name="signingdate" value="<?= $artist['signingdate'] ?>" required></p>
    <p><input type="submit" value="Update Artist"></p>
</form>

</body>
</html>
