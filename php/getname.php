<?php

$bdd = include('bdd.php');
$sql = "SELECT * FROM musique WHERE id_musique = :id;";
$stmt = $bdd->prepare($sql);
$stmt->execute(array(":id" => $_GET['id']));
$musique = $stmt->fetch();

print_r(json_encode($musique));

?>