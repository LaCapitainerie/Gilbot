<?php 
$randomFileName = bin2hex(random_bytes(4));

$bdd = include("./../../bdd.php");


// Ajout de la partie dans la table Partie
$sql = "INSERT INTO `partie`(`tag`, `tour`, `nombre_carte`, `carte_equipe`) VALUES (:tag, 'orange', :nc, :ce)";
$stmt = $bdd->prepare($sql);
$stmt->execute(array(":tag" => $randomFileName, ":nc" => $_GET['nc'], ":ce" => $_GET['ce']));

// Ajout des Cartes dans la partie
$sql = "SELECT nt.id_carte FROM (SELECT id_carte FROM carte ORDER BY RAND()) as nt LIMIT 20";
$stmt = $bdd->prepare($sql);
$stmt->execute();
$cartes = $stmt->fetchAll();


$total = intval($_GET['nc']);
$teamsize = intval($_GET['ce']);


$team = array_merge(array_fill(0, $teamsize, "blue"), array_fill(0, $teamsize, "orange"), array_fill(0, $total - 2*$teamsize - 1, "white"), ["black"]);
shuffle($team);


for ($i=0; $i < count($team); $i++) {
    $sql = "INSERT INTO `carte_partie`(`tag`, `id_carte`, `couleur`) VALUES (:tag, :id, :e)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(":tag" => $randomFileName, ":id" => $cartes[$i]['id_carte'], ":e" => $team[$i]));
};


/*

Fetch ce retour pour l'afficher
Changer tout les liens pour concorder à la bonne bdd file
+ Pour fetch et par redirect

*/
echo $randomFileName;
?>