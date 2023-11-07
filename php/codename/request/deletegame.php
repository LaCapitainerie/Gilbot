<?php

$bdd = include("./../bdd.php");

$sql = "DELETE FROM `partie` WHERE tag = :tag";
$stmt = $bdd->prepare($sql);
$stmt->execute(array(":tag" => $_GET['tag']));

$sql = "DELETE FROM `carte_partie` WHERE tag = :tag";
$stmt = $bdd->prepare($sql);
$stmt->execute(array(":tag" => $_GET['tag']));

$sql = "DELETE FROM `joueur` WHERE tag = :tag";
$stmt = $bdd->prepare($sql);
$stmt->execute(array(":tag" => $_GET['tag']));

?>