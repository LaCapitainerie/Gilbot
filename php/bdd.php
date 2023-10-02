<?php 

session_start();

$host = 'localhost';
$dbname = 'Gilbert';
$username = 'root';
$password = 'root';

try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // echo "Erreur de connexion : " . $e->getMessage();
    return "error";
};

return $bdd;

?>