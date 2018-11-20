<?php
  $sql = "SELECT * FROM categories WHERE parent = 0";
  $pquery = $db->query($sql);

  $sql2 = "SELECT * FROM footercategories WHERE parent = 0";
  $cquery = $db->query($sql2);
?>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-white w3-collapse" style="z-index:3;width:250px" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16" style="margin-left: -75px">
    <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
      <a href="index.php" class="w3-wide" ><b> <img src="images/logo1.png"> </b></a>
  </div>
  <?php while($parent = mysqli_fetch_assoc($pquery)) : ?>
    <?php $parent_id = $parent['id'];
      $sql3 = "SELECT * FROM categories WHERE parent = '$parent_id'";
      $bquery = $db->query($sql3);
    ?>
  <div class="w3-padding-20 w3-large w3-text-grey">
    <!--<a href="#" class="w3-bar-item w3-button"><?php echo $parent['category'];?></a>-->
    <a onclick="myAccFunc('<?php echo $parent['category'];?>')"  class="w3-button w3-block w3-white w3-left-align" >
      <?php echo $parent['category'];?> <i class="fa fa-caret-down"></i>
    </a>
    <div id="demoAcc<?php echo $parent['category'];?>" class="w3-bar-block w3-hide w3-padding-large w3-medium">
      <?php while($child = mysqli_fetch_assoc($bquery)) : ?>
        <li><a href="category.php?cat=<?=$child['id'];?>"><?php echo $child['category'];?></a></li>
      <?php endwhile; ?>
    </div>
  </div>
<?php endwhile; ?>



    <br></br>



  <?php while($parent = mysqli_fetch_assoc($cquery)) : ?>
    <a href="#footer" class="w3-bar-item w3-button w3-padding"><?php echo $parent['category'];?></a>

  <?php endwhile; ?>



</nav>


<!--<a onclick="myAccFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align" id="myBtn">
  Jeans
</a>
<a href="#" class="w3-bar-item w3-button">Jackets</a>
<a href="#" class="w3-bar-item w3-button">Gymwear</a>
<a href="#" class="w3-bar-item w3-button">Blazers</a>
<a href="#" class="w3-bar-item w3-button">Shoes</a>

<a href="#footer" class="w3-bar-item w3-button w3-padding">Contact</a>
<a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding" onclick="document.getElementById('newsletter').style.display='block'">Newsletter</a>
<a href="#footer"  class="w3-bar-item w3-button w3-padding">Subscribe</a>
-->
