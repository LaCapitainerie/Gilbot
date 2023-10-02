<?php include("../php/head.php"); ?>
<body>
  <div class="login-box" id="login-box">
    <h2>Sign Up</h2>
    <form method="post" action="../php/register.php">
      <div class="user-box">
        <input type="text" id="Username" name="user" required>
        <label>Discord Username</label>
      </div>

      <div class="user-box">
        <input type="password" id="Password" name="pwd" required>
        <label>Make a Password</label>
      </div>

      <button onclick="signup()">SignUp</button>
    </form>
  </div>
</body>
