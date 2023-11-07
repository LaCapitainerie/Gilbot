<?php

session_start();
$bdd = include("../../bdd.php");

$sql = "SELECT joueur.role, joueur.couleur FROM `joueur` JOIN users USING(id_user) WHERE users.secure = :secure;";
$stmt = $bdd->prepare($sql);
$stmt->execute(array(":secure" => $_SESSION['secure']));
$user = $stmt->fetch();


if($user["role"] == "agent"){

    $sql = "SELECT partie.tour, id_carte_partie FROM `carte_partie` JOIN carte USING(id_carte) JOIN partie USING(tag) WHERE tag = :idg AND Name = :n";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(":idg" => $_SESSION['tag'], ":n" => $_GET['n']));
    $carte = $stmt->fetch();

    var_dump($carte['tour'], ($carte["tour"]=="orange"?"blue":"orange"));


    if($user["couleur"] == $carte["tour"]){

        $sql = "UPDATE `carte_partie` SET `discovers`= 1 WHERE id_carte_partie = :idg";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(array(":idg" => $carte['id_carte_partie']));


        $sql = "UPDATE `partie` SET `tour`=:tour WHERE tag = :tag;";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(array(":tag" => $_SESSION['tag'], ":tour" => ($carte["tour"]=="orange"?"blue":"orange")));

    };
    
};

?>