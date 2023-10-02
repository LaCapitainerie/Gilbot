<?php

$bdd = include('bdd.php');

$sql = "SELECT id_user FROM users WHERE secure = :secure;";
$stmt = $bdd->prepare($sql);
$stmt->execute(array(":secure" => $_SESSION['secure']));
$user = $stmt->fetch();

$sql = "SELECT COUNT(id_playlist) FROM playlist JOIN users USING(id_user) WHERE playlist.nom = :id;";
$stmt = $bdd->prepare($sql);
$stmt->execute(array(":id" => $_POST['name']));
$verif = intval($stmt->fetch()[0])==0;


if($verif){

    var_dump($_POST);

    $sql = "INSERT INTO `playlist`(`id_user`, `nom`, `description`, `img`) VALUES (:id, :nom , :desc, :img);";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(":id" => $user['id_user'], ":nom" => $_POST['name'], ":desc" => $_POST['desc'], ':img' => $_POST['img']));

    $sql = "INSERT INTO `sub_sidebar`(`id_list`, `name`, `id_user`, `tlm`) VALUES (4, :nom, :id,  false);";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(":id" => $user['id_user'], ":nom" => $_POST['name']));

    header('location: ../html/playlist.php');
    exit;

};

header('location: ../html/playlist.php?ex=1');
exit;

?>