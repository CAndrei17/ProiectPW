<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/Proiect1/core/init.php';
    include 'includes/head.php';
    include 'includes/navigation.php';
    include 'includes/headerfull.php';
?>

<div class="w3-row ">
    <h1 class="text-center">Signup</h1>

    <?php
      if(isset($_GET['error'])){
        if($_GET['error'] == "emptyfields"){
          echo '<p class="signuperror text-center bg-danger text-warning">Fill in all fields!</p>';
        }
        else if($_GET["error"] == "invaliduidmail"){
          echo '<p class="signuperror text-center bg-danger text-warning">Invalid username and e-mail!</p>';
        }
        else if($_GET["error"] == "invaliduid"){
          echo '<p class="signuperror text-center bg-danger text-warning">Invalid username!</p>';
        }
        else if($_GET["error"] == "invalidmail"){
          echo '<p class="signuperror text-center bg-danger text-warning">Invalid e-mail!</p>';
        }
        else if($_GET["error"] == "passwordcheck"){
          echo '<p class="signuperror text-center bg-danger text-warning">Your passwords do not match!</p>';
        }
        else if($_GET["error"] == "usertaken"){
          echo '<p class="signuperror text-center bg-danger text-warning">Username is already taken!</p>';
        }
      }
      else if($_GET["signup"] == "success"){
        echo '<p class="signupsuccess text-center text-success">Signup successful!</p>';
      }

    ?>

    <form class="form-signup text-center" action="includes/signup.inc.php" method="post">
      <div class="form-group">
        <input type="text" name="uid" placeholder="Username">
      </div>

      <div class="form-group">
        <input type="text" name="mail" placeholder="E-mail">
      </div>

      <div class="form-group">
        <input type="password" name="pwd" placeholder="Password">
      </div>

      <div class="form-group">
        <input type="password" name="pwd-repeat" placeholder="Repeat password">
      </div>
      <button type="submit" name="signup-submit" class="btn btn-dark">Signup</button>
    </form>
</div>




<?php include 'includes/footer.php'; ?>
