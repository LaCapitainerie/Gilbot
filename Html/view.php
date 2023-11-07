<?php include("../php/head.php"); ?>




<body>
    
  <?php include("../php/sidebar.php"); ?>
  
  <section id="main-section">
    <?php include("../php/entete.php"); ?>

    <section id="content">

        <?php
          $bdd = include('../php/bdd.php');

          $sql = "SELECT username, id_user FROM users WHERE secure = :secure;";
          $stmt = $bdd->prepare($sql);
          $stmt->execute(array(":secure" => $_SESSION['secure']));
          $user = $stmt->fetch();

          $sql = "SELECT * FROM playlist WHERE id_playlist = :pl and (id_user = :id or ispublic = 1);";
          $stmt = $bdd->prepare($sql);
          $stmt->execute(array(":pl" => $_GET['v'], ":id" => $user["id_user"]));
          $playlist = $stmt->fetch();
          echo "<script>document.querySelector('#main-section > section.entete > div > span').textContent = '".htmlspecialchars($playlist["Name"])."';</script>";
        ?>
        <meta property="og:site_name" content="Gilbot"/>
        <meta property="og:type" content="article" data-rh="true">
        <meta property="og:url" content="<?php $path ?>" data-rh="true">
        <meta property="og:title" content="Partage de playlist : <?php echo htmlspecialchars($playlist["Name"]) ?>" data-rh="true">
        <meta property="og:description" content="<?php echo htmlspecialchars($playlist["Description"]) ?>" data-rh="true">
        <meta property="og:image" content="<?php echo htmlspecialchars($playlist["Cover"]) ?>" data-rh="true">
      

        <div id="upper">
          <div class="view-horizontal-box">
            <div class="img-pl">
            <img src="../Img/<?php echo htmlspecialchars($playlist["Cover"]) ?>">
            </div>
            <div class="view-vertical-box">
              <div id="title">
                <p style="font-size: 64px;"><?php echo htmlspecialchars($playlist["Name"]) ?></p>
              </div>
              <div id="others">
              <p style="font-size: 32px;"><?php echo htmlspecialchars($playlist["Description"]) ?></p>
              <p>Créée par <?php echo htmlspecialchars($user["username"]) ?> · <?php echo $playlist["ispublic"]=="1"?"publique":"privée" ?></p>
              </div>
            </div>
          </div>
        </div>
        <div id="lower">
          <div id="view-grid">
            <?php 
            $sql = "SELECT * FROM musique JOIN est_dans USING(id_musique) WHERE id_playlist = :pl"; //and (id_user = :id or tlm = 1);"; // pour mettre en privé
            $stmt = $bdd->prepare($sql);
            $stmt->execute(array(":pl" => $_GET['v'])); //, ":id" => $user["id_user"]));
            $musiques = $stmt->fetchAll();
            
            foreach ($musiques as $key => $musique) {
              echo "<div>
                      <div class='img-pl'>
                        <img src='".htmlspecialchars($musique["Cover"])."'>
                      </div>
                      <p>".htmlspecialchars(ucfirst($musique["Name"]))."</p>
                    </div>";
            };
            
            ?>
          </div>
        </div>

    </section>


    <style>.entete > div {background-color: var(--upper);} *{--upper: #B8CBD0}</style>
  </section>
    
  </body>
</html>
