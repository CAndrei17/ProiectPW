<?php
  require_once 'core/init.php';
  include 'includes/head.php';
  include 'includes/navigation.php';
  include 'includes/headerfull.php';

  $sql = "SELECT * FROM products WHERE featured = 1";
  $featured = $db->query($sql);
?>
  <!-- Product grid -->
  <div class="w3-row w3-grayscale">
    <?php while($product = mysqli_fetch_assoc($featured)) : ?>
      <div class="w3-col l3 s6">
        <div class="w3-container">
        </div>
      </div>
    <?php endwhile; ?>

  </div>

  <div class="w3-display-container text-center">
    <div class="jumbotron">
      <p class="lead"><strong><h1> Welcome to eBook </h1></strong></p>
    </div>
  </div>

  <?php
    include 'includes/subscribe.php';
    include 'includes/footer.php';
?>

<!--<div class="w3-col l3 s6">
  <div class="w3-container">
    <div class="w3-display-container">
      <img src="images/science33.jpg"  class="img-thumb">
      <br><p class="w3-list-price w3-text-danger"> Undra Stormur<br><b><class="w3-price">New Price: $29.99</b></br></p></br>
      <span class="w3-tag w3-display-topleft">New</span>
      <div class="w3-display-middle w3-display-hover">
        <button class="w3-button w3-black" class="btn btn-sm btn-success btn-details" data-toggle="modal" data-target="#details-1" >Buy now <i class="fa fa-shopping-cart" ></i></button>
      </div>
    </div>
  </div>
  <div class="w3-container">
    <div class="w3-display-container">
      <img src="images/adventure11.jpg"  class="img-thumb">
      <p class="w3-list-price w3-text-danger"> The Island <br><b class="w3-text-red">Old Price: <s>$69.99</s></b></br><b><class="w3-price">New Price: $15.99</b></p>
      <span class="w3-tag w3-display-topleft">Sale</span>
      <div class="w3-display-middle w3-display-hover">
        <button class="w3-button w3-black" class="btn btn-sm btn-success btn-details" data-toggle="modal" data-target="#details-1" >Buy now <i class="fa fa-shopping-cart" ></i></button>
      </div>
    </div>
  </div>
</div>

<div class="w3-col l3 s6">
  <div class="w3-container">
    <div class="w3-display-container">
      <img src="images/adventure22.jpg"  class="img-thumb">
      <br><p class="w3-list-price w3-text-danger"> The Lost Patrol <br><b><class="w3-price">New Price: $54.99</b></br></p></br>
      <span class="w3-tag w3-display-topleft">New</span>
      <div class="w3-display-middle w3-display-hover">
        <button class="w3-button w3-black" class="btn btn-sm btn-success btn-details" data-toggle="modal" data-target="#details-1" >Buy now <i class="fa fa-shopping-cart" ></i></button>
        <button type="button" class="btn btn-sm btn-success btn-details" data-toggle="modal" data-target="#details-1">
      Details</button>
      </div>
    </div>
  </div>
  <div class="w3-container">
    <div class="w3-display-container">
      <img src="images/thriller22.jpg"  class="img-thumb">
      <p class="w3-list-price w3-text-danger"> Snake Skin <br><b class="w3-text-red">Old Price: <s>$29.99</s></b></br><b><class="w3-price">New Price: $14.99</b></p>
      <span class="w3-tag w3-display-topleft">Sale</span>
      <div class="w3-display-middle w3-display-hover">
        <button class="w3-button w3-black" class="btn btn-sm btn-success btn-details" data-toggle="modal" data-target="#details-1" >Buy now <i class="fa fa-shopping-cart" ></i></button>
        <button type="button" class="btn btn-sm btn-success btn-details" data-toggle="modal" data-target="#details-1">
      Details</button>
      </div>
    </div>
  </div>
</div>

<div class="w3-col l3 s6">
  <div class="w3-container">
    <div class="w3-display-container">
      <img src="images/thriller11.jpg"  class="img-thumb">
      <br><p class="w3-list-price w3-text-danger"> Before Sunrise <br><b><class="w3-price">New Price: $55.99</b></br></p></br>
      <span class="w3-tag w3-display-topleft"></span>
      <div class="w3-display-middle w3-display-hover">
        <button class="w3-button w3-black" class="btn btn-sm btn-success btn-details" data-toggle="modal" data-target="#details-1" >Buy now <i class="fa fa-shopping-cart" ></i></button>
        <button type="button" class="btn btn-sm btn-success btn-details" data-toggle="modal" data-target="#details-1">
      Details</button>
      </div>
    </div>
  </div>

  <div class="w3-container">
    <div class="w3-display-container">
      <img src="images/thriller33.jpg"  class="img-thumb">
      <br><p class="w3-list-price w3-text-danger"> Blood Stained <br><b><class="w3-price">New Price: $21.99</b></br></p></br>
      <span class="w3-tag w3-display-topleft"></span>
      <div class="w3-display-middle w3-display-hover">
        <button class="w3-button w3-black" class="btn btn-sm btn-success btn-details" data-toggle="modal" data-target="#details-1" >Buy now <i class="fa fa-shopping-cart" ></i></button>
        <button type="button" class="btn btn-sm btn-success btn-details" data-toggle="modal" data-target="#details-1">
      Details</button>
      </div>
    </div>
  </div>

  <img src="<?= $product['image']; ?>"  class="img-thumb">
  <p class="w3-list-price w3-text-danger"> <?= $product['title']; ?> <br><b class="w3-text-red">Old Price: <s><?= $product['list_price']; ?></s></b></br><b><class="w3-price">New Price: <?= $product['price']; ?></b></p>
  <span class="w3-tag w3-display-topleft">Sale</span>
  <div class="w3-display-middle w3-display-hover">
    <button class="w3-button w3-black" class="btn btn-sm btn-success btn-details" onclick="detailsmodal(<?= $product['id'];?>)" >Buy now <i class="fa fa-shopping-cart" ></i></button>
    <button type="button" class="btn btn-sm btn-success btn-details" data-toggle="modal" data-target="#details-1">
  Details</button>
  </div>






</div> -->
