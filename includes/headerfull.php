<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
  <div class="w3-bar-item w3-padding-24 w3-wide"></div>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:250px">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:83px"></div>

  <!-- Top header -->
  <header class="w3-container w3-xlarge">
    <?php
      if(isset($_SESSION['userId'])){
        echo '  <form action="includes/logout.inc.php" method="post" class="w3-right">
            <button type="submit" name="logout-submit" class="w3-button w3-black w3-large">Logout</button>
          </form>
          <a href="cart.php"><span  class="fa fa-shopping-cart w3-button w3-black"> My Cart</span></a>
          <p class="login-status text-center ">You are logged in!</p>';

      }
      else{
        echo '<form action="includes/login.inc.php" method="post" class="w3-right">
          <input type="text" name="mailuid" placeholder="E-mail/Username">
          <input type="password" name="pwd" placeholder="Password">
          <button type="submit" name="login-submit" class="w3-button w3-black w3-large">Login</button>
        </form>
        <a href="signup.php"><span class="fa fa-user w3-button w3-black"> Signup</span></a>
        <br></br>
        <p class="login-status text-center ">You are logged out!</p>';
      }
    ?>

    <div class="w3-left">
    </div>

  </header>

  <!-- Image header -->
  <div class="w3-display-container w3-container">
    <img src="images/abc.jpg" alt="Jeans" style="width:100%">
    <div class="w3-display-topleft w3-text-white" style="padding:24px 48px">
      <h1 class="w3-jumbo w3-hide-small">eBook</h1>
    </div>
  </div>

  <div class="w3-container w3-text-grey text-center">
  </div>
