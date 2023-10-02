<?php include("../php/head.php"); ?>
<?php
  $bdd = include('../php/bdd.php');

  $sql = "SELECT username, id_user FROM users WHERE secure = :secure;";
  $stmt = $bdd->prepare($sql);
  $stmt->execute(array(":secure" => $_SESSION['secure']));
  $user = $stmt->fetch();

  $sql = "SELECT * FROM playlist WHERE id_playlist = :pl and (id_user = :id or tlm = 1);";
  $stmt = $bdd->prepare($sql);
  $stmt->execute(array(":pl" => $_GET['v'], ":id" => $user["id_user"]));
  $playlist = $stmt->fetch();
?>
<meta property="og:site_name" content="Gilbot"/>
<meta property="og:type" content="article" data-rh="true">
<meta property="og:url" content="<?php $path ?>" data-rh="true">
<meta property="og:title" content="Partage de playlist : <?php echo $playlist["nom"] ?>" data-rh="true">
<meta property="og:description" content="<?php echo $playlist["description"] ?>" data-rh="true">
<meta property="og:image" content="<?php echo $playlist["img"] ?>" data-rh="true">



<body>
    
  <?php include("../php/sidebar.php"); ?>
  
  <section id="main-section">
    <?php include("../php/entete.php"); ?>

    <section id="content">
      

        <div id="upper">
          <div class="view-horizontal-box">
            <div class="img-pl">
            <img src="/Img/<?php echo htmlspecialchars($playlist["img"]) ?>">
            </div>
            <div class="view-vertical-box">
              <div id="title">
                <p style="font-size: 64px;"><?php echo htmlspecialchars($playlist["nom"]) ?></p>
              </div>
              <div id="others">
              <p style="font-size: 32px;"><?php echo htmlspecialchars($playlist["description"]) ?></p>
              <p>Créée par <?php echo htmlspecialchars($user["username"]) ?> · <?php echo $playlist["tlm"]=="1"?"publique":"privée" ?></p>
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
            // print_r($musiques);
            foreach ($musiques as $key => $musique) {
              echo "<div><div class='img-pl'><img src='/Img/".htmlspecialchars($musique["img"])."'></div><p>".htmlspecialchars(ucfirst($musique["name"]))."</p></div>";
            };
            ?>
          </div>
        </div>

    </section>


    <style>.entete > div {background-color: var(--upper);} *{--upper: #B8CBD0}</style>
  </section>
    
  </body>
</html>
