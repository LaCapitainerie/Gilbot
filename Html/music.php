<?php include("../php/head.php"); ?>
  <body>
    
  <?php include("../php/sidebar.php"); ?>
  
  <section id="main-section">
    <?php include("../php/entete.php"); ?>



    <section id="content" style="height:100%;">

      <input id="search" type="text" >
      <div id="loader-dl"></div>
      <div id="result"></div>

      
      
      <div id='dl-music-loader'>
        <button id='dl-music' onclick="download((search(document.querySelector(`#search`).value)));" style="border-radius: 10px;background: #98e3e5;">Download</button>
        <div style="display:none" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
      
      </div>


      <div class="grid" id="containerplaylist" style="padding: 2%">
          <?php 
          
          $bdd = include('../php/bdd.php');
          
          $sql = "SELECT * FROM musique WHERE ispublic = 1 AND (INSTR(Name, '') OR INSTR(authors, '') );";
          $stmt = $bdd->prepare($sql);
          $stmt->execute();
          $musiques = $stmt->fetchAll();

          $tmp = $_GET;
          
          foreach ($musiques as $key => $musique) {
            echo '<div onclick="playnow(`'.htmlspecialchars($musique['Name'])." - ".htmlspecialchars($musique['authors']).'.mp3`);">';
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

  </section>
    
  </body>
</html>
