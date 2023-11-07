<?php include("../php/head.php"); ?>
  <body>
    
  <?php include("../php/sidebar.php"); ?>

  <section id="main-section">
    <?php include("../php/entete.php"); ?>

    <section id="content">
      <div class="grid" id="containerplaylist" style="padding: 2%">
          <?php 
          
          $bdd = include('../php/bdd.php');

          $sql = "SELECT * FROM musique WHERE ispublic = 1;";
          $stmt = $bdd->prepare($sql);
          $stmt->execute();
          $musiques = $stmt->fetchAll();

          $tmp = $_GET;
          
          foreach ($musiques as $key => $musique) {
            // `$musique['Name'] - $musique['authors'].mp3`
            echo `<div onclick='playnow("`.htmlspecialchars($musique['Name'])." - ".htmlspecialchars($musique['authors']).`.mp3");'>`;
            $_GET = $musique;
            $_GET["type"] = "musique";
            include('../php/card.php');
            echo "</div>";
          };
          
          $_GET = $tmp;
          
          ?>
      </div>
    </section>

    <script type="text/javascript">median()</script>

    <?php if(isset($_GET['np'])){include('../php/newplaylist.php');}; ?>

    <?php echo isset($_GET['ex'])?"<script>plwindow(1);</script>":"test - musiclist - line41"?>
  </section>
        
  

</body>
</html>
