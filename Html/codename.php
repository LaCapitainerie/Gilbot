<html>
<head>
    <script type="text/javascript" src="../javascript/Sidebar.js"></script>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Parametrage</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
    <section id="main-section">
        <section id="content">
            <?php
                session_start();

                $bdd = include("./../php/bdd.php");

                
                $sql = "SELECT id_user FROM users WHERE users.secure= :secure;";
                $stmt = $bdd->prepare($sql);
                $stmt->execute(array(":secure" => $_SESSION['secure']));
                $user = $stmt->fetch();

                var_dump($user);

                $sql = "SELECT id_user, joueur.tag FROM partie JOIN joueur on partie.tag = joueur.tag WHERE joueur.id_user= :id;";
                $stmt = $bdd->prepare($sql);
                $stmt->execute(array(":id" => $user['id_user']));
                $joueur = $stmt->fetch();

                if($joueur == FALSE){
                    unset($_SESSION['tag']);

                    $sql = "UPDATE `joueur` SET `tag`= :tag WHERE joueur.id_user = :id";
                    $stmt = $bdd->prepare($sql);
                    $stmt->execute(array(":tag" => "", ":id" => $user['id_user']));
                } else {
                    $_SESSION['tag'] = $joueur['tag'];
                };

                if (isset($_SESSION['tag'])) {
                    $gameFilePath = "../php/codename/game.php";
                    
                    if (file_exists($gameFilePath)) {
                        echo "<script type='text/javascript'>get(`../php/codename/game.php`, `Room - ".$_SESSION['tag']."`);</script>";
                    } else {
                        echo "The 'game.php' file does not exist.";
                    }
                } else {
                    // Your else code
                    echo "<div onclick='make_game();'>
                              <input type='number' name='nombre_carte' id='nombre_carte' placeholder='nombres de cartes totales' value='15'>
                              <input type='number' name='carte_equipe' id='carte_equipe' placeholder='nombres de cartes par équipe' value='5'>
                              <input type='submit' value='Créer la room'>
                          </div>
                          <script type='text/javascript' src=''></script>";
                };
                
            ?>
            
        </section>
    </section>
</body>
</html>