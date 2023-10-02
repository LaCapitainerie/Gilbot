<?php include("../php/head.php"); ?>
  <body>
    
  <?php include("../php/sidebar.php"); ?>
  
  <section id="main-section">
    <?php include("../php/entete.php"); ?>



    <section id="content" style="display:flex;gap:5%;height:100%;">

      <input id="search" type="text" >
      <div id="loader-dl"></div>
      <div id="result"></div>

      
      
      <div id='dl-music-loader'>
        <button id='dl-music' onclick="download((search(document.querySelector(`#search`).value)));" style="border-radius: 10px;background: #98e3e5;">Download</button>
        <div style="display:none" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
      
      </div>

      </section>

  </section>
    
  </body>
</html>
