<?php 
$r = shell_exec('node /Users/Megaport/Desktop/ytdl/index.js -t:'.$_GET['track']);

$bdd = include('./../php/bdd.php');

$sql = "SELECT * FROM musique WHERE name = :n AND img = :img;";
$stmt = $bdd->prepare($sql);
$stmt->execute(array(":n" => $r["name"], ":img" => $r["cover_url"]));
$musiques = $stmt->fetchAll();

if(count($musiques) == 0){
    $sql = "INSERT INTO `musique`(`name`, `img`) VALUES (:n, :img);";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(":n" => $r["name"], ":img" => $r["cover_url"]));
};

return $r;

?>