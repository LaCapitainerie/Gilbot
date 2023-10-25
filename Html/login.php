<?php include("../php/head.php"); ?>
<body>
  <div class="login-box" id="login-box">
    <h2>Log In</h2>
    <form method="post" action="../php/register.php">
      <div class="user-box">
        <input type="text" id="Username" name="user">
        <label>Discord Id</label>
      </div>

      <div class="user-box">
        <input type="text" id="Pp" name="pp">
        <label>Profile Picture</label>
      </div>

      <div class="user-box">
        <input type="password" id="Password" name="pwd">
        <label>Make a Password</label>
      </div>

      <div class="user-box-discord">
        <input type="text" id="discord" name="discord_id">
        <label>Connection with discord</label>
        <a href="discord.php"></a>
      </div>

      <div>
        <button onclick="signup()">Login</button>
        <i class='bx bxl-discord-alt'></i>
      </div>
    </form>
  </div>
</body>
