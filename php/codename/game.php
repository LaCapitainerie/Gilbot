<body>
    <section id="main-section">
        <section id="content" style="display:flex;justify-content:center;flex-direction: column;align-items: center;">
        <?php

        $bdd = include("./../bdd.php");

        $sql = "SELECT id_user FROM users WHERE secure=:secure;";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(array(":secure" => $_SESSION['secure']));
        $user = $stmt->fetch();

        $sql = "SELECT partie.tour, joueur.tag, couleur, role FROM joueur JOIN partie USING(tag) WHERE id_user =:id;";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(array(":id" => $user['id_user']));
        $joueur = $stmt->fetch();

        echo "
        <style>
            #content { background: radial-gradient(circle, ".($joueur["couleur"]=="blue"?'#2da2ff':'#ffc42d')." 0%, rgba(228,233,247,1) 42%); }
        </style>";
        ?>
        
        <div>
            <div style="outline-offset: -1px;outline: 1px solid;border-radius: 16px;padding: 0 0 0 5px;">
                <a><?php echo "localhost/php/codename/request/joingame.php?tag=".htmlspecialchars($joueur["tag"]); ?></a>
                <?php echo '<button style="padding: 5px;border-radius: 0 16px 16px 0;" onclick="navigator.clipboard.writeText(`localhost/php/codename/request/joingame.php?tag='.htmlspecialchars($joueur["tag"]).'`);">Copier</button>'; ?>
            </div>
            
            <div>
                <?php echo "<button onclick='fetch(`localhost/php/codename/request/deletegame.php?tag=".htmlspecialchars($joueur["tag"])."`);allgames()'>Supprimer la partie</button>"; ?>
            </div>
        </div>
        <?php

        echo "<a style='color:".htmlspecialchars($joueur["tour"]).";'>
                <strong>Au ".htmlspecialchars($joueur["tour"])." de jouer !</strong>
            </a>";




        echo "<title> Room - ".htmlspecialchars($joueur['tag'])."</title>";

        echo "<div id='grid-codename'>";

        $sql = "SELECT carte.id_carte, carte.Name, carte_partie.couleur, carte_partie.discovers FROM `carte_partie` JOIN carte ON carte_partie.id_carte = carte.id_carte WHERE tag = :idg;";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(array(":idg" => $joueur['tag']));
        $cartes = $stmt->fetchAll();

        foreach ($cartes as $key => $carte) {
            echo '
            <div id="contour" class="'.(($joueur["role"]=="espion" || $carte['discovers'])?htmlspecialchars($carte['couleur']):"").'">
                <div id="interrior">
                    <div id="text">
                        <a>'.htmlspecialchars($carte['Name']).'</a>
                    </div>
                    <div id="rectangle">

                    </div>
                </div>
            </div>';
        };

        echo "</div>";
        ?>
        <script type='text/javascript' src="../php/codename/partie.js"></script>

        </section>
    </section>
</body>
</html>