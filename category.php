<?php
  require_once 'core/init.php';
  include 'includes/head.php';
  include 'includes/navigation.php';
  include 'includes/headerfull.php';

  if(isset($_GET['cat'])){
    $cat_id = sanitize($_GET['cat']);
  }else{
    $cat_id = '';
  }


  $sql = "SELECT * FROM products WHERE categories = '$cat_id'";
  $productQ = $db->query($sql);
  $category = get_category($cat_id);
?>
  <!-- Product grid -->
  <div class="w3-row w3-grayscale">
    <h2 class="text-center"><strong><?=$category['parent'].' '.$category['child'];?></strong></h2>
      <br></br>
    <?php while($product = mysqli_fetch_assoc($productQ)) : ?>
      <div class="w3-col l3 s6">
        <div class="w3-container">
          <div class="w3-display-container">
            <img src="<?= $product['image']; ?>"  class="img-thumb">
            <p class="w3-list-price w3-text-danger"> <?= $product['title']; ?> <br><b class="w3-text-red">Old Price: <s><?= $product['list_price']; ?></s></b></br><b><class="w3-price">New Price: <?= $product['price']; ?></b></p>
            <span class="w3-tag w3-display-topleft">Sale</span>
            <div class="w3-display-middle w3-display-hover">
              <button class="w3-button w3-black" class="btn btn-sm btn-success btn-details" onclick="detailsmodal(<?= $product['id'];?>)" >Buy now <i class="fa fa-shopping-cart" ></i></button>
              <!--<button type="button" class="btn btn-sm btn-success btn-details" data-toggle="modal" data-target="#details-1">
            Details</button>-->
            </div>
          </div>

        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <?php
    include 'includes/subscribe.php';
    include 'includes/footer.php';
?>
