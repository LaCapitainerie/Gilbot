<?php include("../php/head.php"); ?>
  <body>
    
  <?php include("../php/sidebar.php"); ?>

  <section id="main-section">
    <?php include("../php/entete.php"); ?>

    <section id="content">
      <!--<button onclick="plwindow();">Nouvelle playlist +</button>-->
      <div class="grid" id="containerplaylist">
          <?php 
          
          $bdd = include('../php/bdd.php');

          $sql = "SELECT id_user FROM users WHERE secure = :secure;";
          $stmt = $bdd->prepare($sql);
          $stmt->execute(array(":secure" => $_SESSION['secure']));
          $user = $stmt->fetch();

          $sql = "SELECT img, nom, username, id_playlist, fav FROM playlist LEFT JOIN users USING(id_user) JOIN (SELECT COUNT(id_user) as fav FROM fav WHERE id_playlist = id_playlist AND id_user = :id) as favori WHERE id_user = :id OR tlm = 1 ORDER BY tlm;";
          $stmt = $bdd->prepare($sql);
          $stmt->execute(array(":id" => $user['id_user']));
          $playlists = $stmt->fetchAll();

          $tmp = $_GET;
          
          foreach ($playlists as $key => $playlist) {
            echo "<div onclick='window.location = `./view.php?v=".htmlspecialchars(strval($playlist["id_playlist"]))."`;'>";
            $_GET = $playlist;
            include('../php/card.php');
            echo "</div>";
          };
          
          $_GET = $tmp;
          
          ?>
      </div>
    </section>

    <script type="text/javascript">median()</script>

    <?php if(isset($_GET['np'])){include('../php/newplaylist.php');}; ?>

    <?php echo isset($_GET['ex'])?"<script>plwindow(1);</script>":""?>
  </section>
        
  

</body>
</html>
