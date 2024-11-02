<?php
require_once 'dbConfig.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['RegisterUser'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $address = $_POST['address'];
    $age = $_POST['age'];


    $query = "INSERT INTO users (first_name, last_name, email, password, address, age) 
              VALUES (:first_name, :last_name, :email, :password, :address, :age)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'password' => $password,
        'address' => $address,
        'age' => $age
    ]);


    header("Location: ../login.php");
    exit();
}



if (isset($_POST['DeleteArtist'])) {
    $artist_id = $_POST['artist_id'];
    

    $checkStmt = $pdo->prepare("SELECT * FROM artists WHERE id = :id");
    $checkStmt->bindParam(':id', $artist_id);
    $checkStmt->execute();

    if ($checkStmt->rowCount() == 0) {
        echo "No artist found with ID: " . $artist_id;
    } else {

        $deleteStmt = $pdo->prepare("DELETE FROM artists WHERE id = :id");
        $deleteStmt->bindParam(':id', $artist_id);

        if ($deleteStmt->execute()) {
            header("Location: ../index.php");
            exit;
        } else {
            echo "Failed to delete artist: " . implode(", ", $deleteStmt->errorInfo());
        }
    }
}

if (isset($_POST['InsertArtist'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $country = $_POST['country'];
    $genresigned = $_POST['genresigned'];
    $signingdate = $_POST['signingdate'];

    $query = "INSERT INTO artists (firstname, lastname, email, phone_number, country, genresigned, signingdate) 
              VALUES (:firstname, :lastname, :email, :phone_number, :country, :genresigned, :signingdate)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'phone_number' => $phone_number,
        'country' => $country,
        'genresigned' => $genresigned,
        'signingdate' => $signingdate
    ]);

    header("Location: ../index.php");
    exit();
}

if (isset($_POST['UpdateArtist'])) {
    $artist_id = $_POST['artist_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $country = $_POST['country'];
    $genresigned = $_POST['genresigned'];
    $signingdate = $_POST['signingdate'];

    $query = "UPDATE artists 
              SET firstname = :firstname, lastname = :lastname, email = :email, phone_number = :phone_number, 
                  country = :country, genresigned = :genresigned, signingdate = :signingdate 
              WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'phone_number' => $phone_number,
        'country' => $country,
        'genresigned' => $genresigned,
        'signingdate' => $signingdate,
        'id' => $artist_id
    ]);

    header("Location: ../index.php");
    exit();
}
?>
