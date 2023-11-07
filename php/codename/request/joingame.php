<?php
session_start();
$bdd = include('../../bdd.php');

$sql = "SELECT id_user FROM users WHERE secure=:secure;";
$stmt = $bdd->prepare($sql);
$stmt->execute(array(":secure" => $_SESSION['secure']));
$user = $stmt->fetch();


$sql = "INSERT INTO `joueur`(`id_user`, `tag`, `couleur`, `role`) VALUES (:id, :tag, 'orange', 'espion')";
$stmt = $bdd->prepare($sql);
$stmt->execute(array(":id" => $user['id_user'], ":tag" => $_GET['tag']));

$_SESSION['tag'] = $_GET['tag'];
?>