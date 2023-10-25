<div id="rightclick-menu">
    <div id="rightclick-menu-container">
        <?php
        $bdd = include('bdd.php');
        
        $sql = "SELECT `Name`, `Content` FROM `rightclickmenu` WHERE cat = :cat";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(array(":cat" => $_GET['cat']));
        $rcmis = $stmt->fetchAll();

        foreach ($rcmis as $key => $rcmi) {
            echo '<div class="rightclick-menu-item">
                    <a class="rcml">'.htmlspecialchars($rcmi['Name']).'</a>
                    '.($rcmi['Content']).'
                    </div>';
        };
        ?>
    </div>
</div>