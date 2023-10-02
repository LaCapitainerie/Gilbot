<div id="sidebar" class="sidebar close">
  <div class="logo-details">
    <i class='bx bxl-c-plus-plus'></i>
    <span class="logo_name">Gilbert</span>
  </div>
  <ul class="nav-links">
    <?php
    
    function toelem($e){
      return "<li><a>$e</a></li>";
    };

    $bdd = include('bdd.php');

    $sql = "SELECT * FROM users WHERE secure=:secure;";
    $stmt = $bdd->prepare($sql);
    $stmt->execute(array(":secure" => $_SESSION['secure']));
    $user = $stmt->fetch();

    $sql = "SELECT * FROM sidebar;";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    $sidebar = $stmt->fetchAll();

    foreach ($sidebar as $key => $value) {
      $sql = "SELECT * FROM sub_sidebar WHERE id_sidebar = :id AND ispublic = 1 ORDER BY ispublic;";
      $stmt = $bdd->prepare($sql);
      $stmt->execute(array(":id" => $value['id_sidebar']));
      $subs = $stmt->fetchAll();
      
      echo "
        <li>
          <div class='iocn-link'>
            <a onclick='get(`".htmlspecialchars($value['redirect'])."`, `".htmlspecialchars($value['name'])."`)'>
            <i class='bx bx-".htmlspecialchars($value['icon'])."'></i>
            <span class='link_name'>".htmlspecialchars($value['name'])."</span>
            </a>".
            ((count($subs)!=0)?("<i class='bx bxs-chevron-down arrow'></i>"):"")
          ."</div>";

      if(count($subs)!=0){//$value['is_list']){
        echo "<ul class='sous-menu'>";


        foreach ($subs as $key => $sub) {
            echo "<li><a href='".htmlspecialchars($sub['redirect'])."'>".htmlspecialchars($sub['name'])."</a></li>";
        };


        echo "</ul>";
      };

      echo "</li>";
    };

    echo "<audio volume='0.05'></audio>";
    
    echo "
    <li>
      <div>
        <div class='profile-details'>
          <div class='profile-content'>
            <img class='UserIcon' src='".htmlspecialchars($user['pp'])."' id='PP'>
          </div>
          <div class='name-job'>
            <div id='pn'>".htmlspecialchars($user['username'])."</div>".(
              $user['discord_id']==""?"":

            "<div class='tooltip'>
              <div class='job' onclick='myFunction()' onmouseout='outFunc()'>
                <span class='tooltiptext' id='myTooltip'>Copy to clipboard</span>
                <div id='discordname'>
                  <a>Username#6942</a>
                </div>
              </div>
            </div>"

            
          )."</div>
          <div class='cog'>
            <a href='#'>
              <i class='bx bx-cog'></i>
            </a>
          </div>
        </div>


        <div class='profile-details no-music' id='music-sidebar'>
          <div class='profile-content'>
            <img class='UserIcon' src='../Img/disc.gif'>
          </div>
          <div class='name-job'>
            <div id='pn' class='music-name'>{music.name}</div>
            <div class='timer'>
              <div  onclick='myFunction()' onmouseout='outFunc()'>
                <span class='tooltiptext' id='myTooltip'>0:00 - 2:27</span>
                <div id='loader-progress-bar' class='barre'>
                  <div style='display:none' class='progress-time-current milli'></div>
                  <div style='display:none' class='progress-time-total milli'></div>
                </div>
              </div>
            </div>
          </div>
          <div class='cog'>
            <a href='#'>
            <i class='bx bx-pause-circle' onclick='pause()'></i>
            </a>
          </div>
        </div>
      </div>
    </li>";





    ?>

  </ul>
  <script>
    let arrow = document.querySelectorAll(".arrow");
    for (var i = arrow.length-1; i > -1 ; --i) {
      arrow[i].addEventListener("click", (e) => {
        e.target.parentElement.parentElement.classList.toggle("showMenu");
      });
    };
    let sidebar = document.getElementById("sidebar");
    sidebar.addEventListener('mouseover', (e) => {
      if(!sidebar.classList.contains('temp') && sidebar.classList.contains('close')){
        sidebar.classList.toggle('temp');
        sidebar.classList.toggle('close');
      };
    });
    sidebar.addEventListener('mouseout', (e) => {
      if(sidebar.classList.contains('temp') && !sidebar.classList.contains('close')){
        sidebar.classList.toggle('temp');
        sidebar.classList.toggle('close');
      };
    });
  </script>
</div>