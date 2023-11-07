<link rel="stylesheet" href="/css/playlist.css">
<div class="pl-back">
    <div class="pl-card">
        <img class="pl-img" src="<?php echo ($_GET["type"]=="playlist"?'../Img/':"").htmlspecialchars($_GET['Cover']); ?>">
    </div>
    
    <div class="pl-content">
        <div class="pl-list">
            <div>
                <a>Author : <?php echo htmlspecialchars($_GET[($_GET["type"]=="playlist"?'username':"authors")]); ?></a>
                <?php
                $bdd = include("bdd.php");
                if($_GET["type"]=="playlist"){
                    

                    $sql = "SELECT COUNT(id_musique) FROM musique JOIN est_dans USING(id_musique) WHERE id_playlist = :pl"; //and (id_user = :id or tlm = 1);"; // pour mettre en privé
                    $stmt = $bdd->prepare($sql);
                    $stmt->execute(array(":pl" => $_GET['id_'.$_GET['type']])); //, ":id" => $user["id_user"]));
                    $musique = $stmt->fetch();
                    
                    echo "<a>Tracks : ".$musique[0]."</a>";
                };
                ?>
                <?php 
                if($_GET["type"]=="playlist"){
                    
                    $sql = "SELECT SUM(Duration) FROM musique JOIN est_dans USING(id_musique) WHERE id_playlist = :pl"; //and (id_user = :id or tlm = 1);"; // pour mettre en privé
                    $stmt = $bdd->prepare($sql);
                    $stmt->execute(array(":pl" => $_GET['id_'.$_GET['type']])); //, ":id" => $user["id_user"]));
                    $musique = $stmt->fetch();
                    
                    echo "<a>Time : ".$musique[0]."</a>";
                } else {
                    echo "<a>Time : ".$_GET["Duration"]."</a>";
                };
                ?></a>
            </div>
            
        </div>
    </div>

    <div class="pl-name">
        <div>
            <a onclick="popup(<?php echo htmlspecialchars($_GET['id_'.$_GET['type']]); ?>)">
                ►
            </a>
        </div>
        <div class="name-pl">
            <a><?php echo htmlspecialchars($_GET['Name']); ?></a>
        </div>
        <div id="fav">
            
        </div>
    </div>
</div>