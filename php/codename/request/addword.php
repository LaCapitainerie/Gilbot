<?php

$bdd = include("../../bdd.php");

$topics = array(
    "Blockchain",
    "Censure",
    "Immigration",
    "Identité de genre",
    "Avortement",
    "Liberté d'expression",
    "Sexe virtuel",
    "Terrorisme",
    "Religion",
    "Droits LGBTQ+",
    "Économie mondiale",
    "Éducation",
    "Dieudonné",
    "Eli Semoun",
    "Israël",
    "Palestine"
);


foreach ($topics as $key => $word) {
    
    $sql = "INSERT INTO `carte`(`Name`) VALUES (:n)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(":n" => $word));

};
?>