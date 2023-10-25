<?php 

$r = shell_exec('node /Users/hugoa/Desktop/ytdl/index.js -t:'.$_GET['track']);

$r = json_decode($r, true);

// Check if decoding was successful
if (json_last_error() === JSON_ERROR_NONE) {
    print_r($r);
} else {
    echo 'JSON decoding error: ' . json_last_error_msg();
};

$bdd = include('./../php/bdd.php');

$sql = "SELECT COUNT(id_musique) FROM `musique` WHERE name = :n;";
$stmt = $bdd->prepare($sql);
$stmt->execute(array(":n" => $r["name"]));
$musiques = $stmt->fetch();


if($musiques[0] == 0){
    
    $sql = "INSERT INTO `musique`(`Name`, `Album`, `Cover`, `authors`, `Duration`, `ispublic`) VALUES (:n, :an, :img, :author, '00:00', 1)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(":n" => $r["name"], ":an" => $r["album_name"], ":img" => $r["cover_url"], ":author" => $r["artists"]));

};

return $r;

?>