<?php
session_start();

$bdd = include('bdd.php');

$sql = "SELECT id_user FROM users WHERE secure = :secure;";
$stmt = $bdd->prepare($sql);
$stmt->execute(array(":secure" => $_SESSION['secure']));
$user = $stmt->fetch();

$sql = "SELECT COUNT(id_user) FROM fav WHERE id_playlist = :id_playlist AND id_user = :id_user;";
$stmt = $bdd->prepare($sql);
$stmt->execute(array(":id_playlist" => $_GET['pl'], ":id_user" => $user['id_user']));
$c = $stmt->fetch();


print_r($c[0]);
if($c[0] == 0){
    $sql = "INSERT INTO fav(id_playlist, id_user) VALUES (:id_playlist, :id_user);";
} else {
    $sql = "DELETE FROM fav WHERE id_playlist = :id_playlist AND id_user = :id_user;";
};

$stmt = $bdd->prepare($sql);
$stmt->execute(array(":id_playlist" => $_GET['pl'], ":id_user" => $user['id_user']));

return $c[0];
?>