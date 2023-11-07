<?php
$bdd = include("../../bdd.php");

$sql = "SELECT * FROM partie";
$stmt = $bdd->prepare($sql);
$stmt->execute();
$parties = $stmt->fetchAll();

foreach ($parties as $key => $partie) {
    echo "
    <div>
        <a href='parties/game.php?tag=".htmlspecialchars($partie["tag"])."'>".htmlspecialchars($partie["tag"])."</a>
        <button onclick='fetch(`request/deletegame.php?tag=".htmlspecialchars($partie["tag"])."`);allgames()'>Delete</button>
    </div>";
};

?>