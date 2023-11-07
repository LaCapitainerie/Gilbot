<?php include("../php/head.php"); ?>
  <body>
    
  <?php include("../php/sidebar.php"); ?>

  <section id="main-section">
    <?php include("../php/entete.php"); ?>

    <section id="content">
      <div class="grid" id="containerplaylist" style="padding: 2%">
          <?php 
          
          $bdd = include('../php/bdd.php');

          $sql = "SELECT id_user FROM users WHERE secure = :secure;";
          $stmt = $bdd->prepare($sql);
          $stmt->execute(array(":secure" => $_SESSION['secure']));
          $user = $stmt->fetch();

          $sql = "SELECT * FROM playlist JOIN users on playlist.id_user = users.id_user WHERE (ispublic = 1 OR playlist.id_user = :id) ORDER BY ispublic;";
          $stmt = $bdd->prepare($sql);
          $stmt->execute(array(":id" => $user['id_user']));
          $playlists = $stmt->fetchAll();

          $tmp = $_GET;
          
          foreach ($playlists as $key => $playlist) {
            echo "<div onclick='window.location = `./view.php?v=".htmlspecialchars(strval($playlist["id_playlist"]))."`;'>";
            $_GET = $playlist;
            $_GET["type"] = "playlist";
            include('../php/card.php');
            echo "</div>";
          };
          
          $_GET = $tmp;
          
          ?>
      </div>
    </section>

    <script type="text/javascript">median()</script>

    <?php if(isset($_GET['np'])){include('../php/newplaylist.php');}; ?>

    <?php echo isset($_GET['ex'])?"<script>plwindow(1);</script>":"test - playlist - line 45"?>
  </section>
        
  

</body>
</html>
