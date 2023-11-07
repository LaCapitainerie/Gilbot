<div id="rightclick-menu">
    <div id="rightclick-menu-container">
        <?php
        $bdd = include('bdd.php');
        
        $sql = "SELECT `Name`, `Content`, Effect FROM `rightclickmenu` WHERE cat = :cat OR cat = 'all'";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(array(":cat" => $_GET['cat']));
        $rcmis = $stmt->fetchAll();

        foreach ($rcmis as $key => $rcmi) {
            
            echo '<div class="rightclick-menu-item" onclick="' . htmlspecialchars($rcmi['Effect'], ENT_QUOTES, 'UTF-8') . '">
                <a class="rcml" >' . htmlspecialchars($rcmi['Name'], ENT_QUOTES, 'UTF-8') . '</a>
                ' . ($rcmi['Content']) . '
            </div>';
        };
        ?>
    </div>
</div>