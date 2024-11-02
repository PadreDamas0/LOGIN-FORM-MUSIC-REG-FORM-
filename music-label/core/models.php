<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'dbConfig.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



function getAllArtists($pdo) {
    $stmt = $pdo->query("SELECT * FROM artists ORDER BY date_added DESC");
    return $stmt->fetchAll();
}


function getArtistById($pdo, $id) {
    $stmt = $pdo->prepare("SELECT * FROM artists WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}


function getArtists($pdo) {
    $query = "SELECT * FROM artists";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function addArtist($pdo, $firstname, $lastname, $email, $phone_number, $country, $genresigned, $signingdate) {
    $added_by = $_SESSION['user_id'];
    $query = "INSERT INTO artists (firstname, lastname, email, phone_number, country, genresigned, signingdate, added_by) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    return $stmt->execute([$firstname, $lastname, $email, $phone_number, $country, $genresigned, $signingdate, $added_by]);
}


function updateArtist($pdo, $id, $firstname, $lastname, $email, $phone_number, $country, $genresigned, $signingdate) {
    $updated_by = $_SESSION['user_id'];
    $query = "UPDATE artists 
              SET firstname = ?, lastname = ?, email = ?, phone_number = ?, country = ?, genresigned = ?, signingdate = ?, last_updated = NOW(), added_by = ? 
              WHERE id = ?";
    $stmt = $pdo->prepare($query);
    return $stmt->execute([$firstname, $lastname, $email, $phone_number, $country, $genresigned, $signingdate, $updated_by, $id]);
}


function deleteArtist($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM artists WHERE id = ?");
    return $stmt->execute([$id]);

}
 function addUser($pdo, $first_name, $last_name, $email, $password) {
    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
     return $stmt->execute([$first_name, $last_name, $email, $password]);
    }


    function getUserByEmail($pdo, $email) {
        $query = "SELECT user_id, first_name, last_name, email, password FROM users WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    
    
    
    
    
    
?>
