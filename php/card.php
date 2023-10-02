<link rel="stylesheet" href="/css/playlist.css">
<div class="pl-back">
    <div class="pl-card">
        <img class="pl-img" src="/Img/<?php echo $_GET['img']; ?>">
    </div>
    
    <div class="pl-content">
        <div class="pl-list">
            <div>
                <a>Author : <?php echo $_GET['username']; ?></a>
                <a>Tracks : <?php echo $_GET['tracks']; ?></a>
                <a>Time : <?php echo 0; ?></a>
            </div>
            
        </div>
    </div>

    <div class="pl-name">
        <div>
            <a onclick="popup(<?php echo htmlspecialchars($_GET['id_playlist']); ?>)">
                ►
            </a>
        </div>
        <div class="name-pl">
            <a><?php echo $_GET['nom']; ?></a>
        </div>
        <div id="fav">
            <a onclick="fav(<?php echo htmlspecialchars($_GET['id_playlist']); ?>);" style="color: <?php echo ($_GET['fav']==1?"#FF0000":"#FFFFFF"); ?>">F</a>
        </div>
    </div>
</div>