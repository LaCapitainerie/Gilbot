<?php
session_start();
$bdd = include("../../bdd.php");


$sql = "SELECT partie.tour, joueur.role FROM `partie` JOIN joueur USING(tag) JOIN users USING(id_user) WHERE users.secure = :secure;";
$stmt = $bdd->prepare($sql);
$stmt->execute(array(":secure" => $_SESSION['secure']));
$joueur = $stmt->fetch();

$sql = "SELECT carte.id_carte, carte.Name, carte_partie.couleur, carte_partie.discovers FROM `carte_partie` JOIN carte ON carte_partie.id_carte = carte.id_carte WHERE tag = :idg;";
$stmt = $bdd->prepare($sql);
$stmt->execute(array(":idg" => $_SESSION['tag']));
$cartes = $stmt->fetchAll();

function show($item){
    return $item['couleur'];
};

function lambda($item) {
    return $item['discovers']?$item['couleur']:"";
};

echo str_replace(":", ":", json_encode(array_merge(["tour" => $joueur['tour']], ["cartes" => array_map((($joueur['role'] == "agent")?'lambda':'show'), $cartes)])));

?>