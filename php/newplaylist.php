<div id="newpl-overlay">
  <div style="display: flex;justify-content: center;">
    <div onclick="plwindow()" style="width: fit-content;">X</div>
  </div>
  <div class="login-box" id="login-box">
    <h2>New Playlist</h2>
    <form method="post" action="../php/npl.php">
      <div class="user-box">
        <input type="text" id="name" name="name" required>
        <label>Playlist's name</label>
      </div>

      <div class="user-box">
        <input type="text" id="desc" name="desc" required>
        <label>Playlist's Description</label>
      </div>

      <div class="user-box">
        <input type="text" id="img" name="img" required>
        <label>Playlist's Cover</label>
      </div>

      <?php echo isset($_GET['ex'])?"<a>Erreur : Playlist déjà existante</a>":"" ?>

      <input type="submit" value="Nouvelle Playlist">
    </form>
</div>
</div>