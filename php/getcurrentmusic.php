<?php
$bdd = include('bdd.php');
$sql = "SELECT * FROM est_dans WHERE id_playlist = :id;";
$stmt = $bdd->prepare($sql);
$stmt->execute(array(":id" => $_GET['id']));
$musiques = $stmt->fetchAll();

$index = (isset($_GET['index'])?$_GET['index']:0)%count($musiques);
$music = $musiques[$index];

print_r(json_encode([$music,$index,count($musiques)]));
?>