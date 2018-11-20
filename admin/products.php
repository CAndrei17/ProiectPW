<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/Proiect1/core/init.php';
  include 'includes/head.php';
  include 'includes/navigation.php';

  //Delete Product
  if(isset($_GET['delete'])){
    $id = sanitize($_GET['delete']);
    $db->query("UPDATE products SET deleted = 1 WHERE id = '$id'");
    header('Location: products.php');
  }

  $dbpath = '';
  if(isset($_GET['add']) || isset($_GET['edit'])){
  $typeQuery = $db->query("SELECT * FROM type ORDER BY type");
  $parentQuery = $db->query("SELECT * FROM categories WHERE parent = 0 ORDER BY category");
  $title = ((isset($_POST['title']) && $_POST['title'] != ' ')?sanitize($_POST['title']):'');
  $type = ((isset($_POST['type']) && !empty($_POST['type']))? sanitize($_POST['type']):'');
  $parent = ((isset($_POST['parent']) && !empty($_POST['parent']))? sanitize($_POST['parent']):'');
  $category = ((isset($_POST['child'])) && !empty($_POST['child'])?sanitize($_POST['child']): '');
  $price = ((isset($_POST['price']) && $_POST['price'] != ' ')?sanitize($_POST['price']):'');
  $list_price = ((isset($_POST['list_price']) && $_POST['list_price'] != ' ')?sanitize($_POST['list_price']):'');
  $description = ((isset($_POST['description']) && $_POST['description'] != ' ')?sanitize($_POST['description']):'');
  $saved_image = '';
    if(isset($_GET['edit'])){
      $edit_id = (int)$_GET['edit'];
      $productResults = $db->query("SELECT * FROM products WHERE id = '$edit_id'");
      $product = mysqli_fetch_assoc($productResults);
      if(isset($_GET['delete_image'])){
        $image_url = $_SERVER['DOCUMENT_ROOT'].$product['image'];echo $image_url;
        unlink($image_url);
        $db->query("UPDATE products SET image = '' WHERE id = '$edit_id'");
        header('Location: products.php?edit='.$edit_id);
      }
      $category = ((isset($_POST['child']) && $_POST['child'] != '')?sanitize($_POST['child']):$product['categories']);
      $title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):$product['title']);
      $type = ((isset($_POST['type']) && $_POST['type'] != '')?sanitize($_POST['type']):$product['type']);
      $parentQ = $db->query("SELECT * FROM categories WHERE id = '$category'");
      $parentResult = mysqli_fetch_assoc($parentQ);
      $parent = ((isset($_POST['parent']) && $_POST['parent'] != '')?sanitize($_POST['parent']):$parentResult['parent']);
      $price = ((isset($_POST['price']) && $_POST['price'] != '')?sanitize($_POST['price']):$product['price']);
      $list_price = ((isset($_POST['list_price']) && $_POST['list_price'] != '')?sanitize($_POST['list_price']):$product['list_price']);
      $description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):$product['description']);
      $saved_image = (($product['image'] != '')?$product['image']:'');
      $dbpath = $saved_image;
      //$db->query("UPDATE cart SET items = '{$items_json}', expire_date = '{$cart_expire}' WHERE id = '{$cart_id}'");
      /*$db->query("UPDATE products SET price = '{$price}' ,title = '{$title}',
        list_price = '{$list_price}', type = '$type', categoriest = '$category',
        description = '$description', image = '$dbpath' WHERE id='$edit_id'");*/
    }
  if($_POST){
    $errors = array();
    $required = array('title', 'type', 'price', 'parent', 'child');
    foreach($required as $field){
      if($_POST[$field] == ''){
        $errors[] = 'All Fields With an Astrisk are requirlist_ed.';
        break;
      }
    }
    if(!empty($_FILES)){
      var_dump($_FILES);
      $photo = $_FILES['photo'];
      $name = $photo['name'];
      $nameArray = explode('.',$name);
      $fileName = $nameArray[0];
      $fileExt = $nameArray[1];
      $mime = explode('/',$photo['type']);
      $mimeType = $mime[0];
      $mimeExt = $mime[1];
      $tmpLoc = $photo['tmp_name'];
      $fileSize = $photo['size'];
      $allowed = array('png','jpg','jpeg','gif');
      $uploadName = md5(microtime()).'.'.$fileExt;
      $uploadPath = BASEURL.'images/'.$uploadName;
      $dbpath = '/Proiect1/images/'.$uploadName;
      if($mimeType != 'image'){
        $errors[] = 'The file must be an image.';
      }
      if(!in_array($fileExt, $allowed)){
        $errors[] = 'The file extension must be a png, jpg, jpeg or gif.';
      }
      if($fileSize > 25000000){
        $errors[] = 'The file size must be under 25MB.';
      }

    }

    if(!empty($errors)){
      echo display_errors($errors);
    }else{
      //upload file and insert into database
      if(!empty($_FILES)){
        move_uploaded_file($tmpLoc,$uploadPath);
      }
      $insertSql = "INSERT INTO products(`title`,`price`,`list_price`,`type`,`categories`,`description`,`image`)
        VALUES('$title', '$price', '$list_price', '$type', '$category', '$description', '$dbpath')";
        if(isset($_GET['edit'])){
          $insertSql = "UPDATE products SET title = '$title', price = '$price',
          list_price = '$list_price', type = '$type', categories = '$category',
          description = '$description', image = '$dbpath' WHERE id = '$edit_id'";
        }
        $db->query($insertSql);
        header('Location: products.php');
    }
  }
?>
  <h2 class="text-center"><?=((isset($_GET['edit']))?'Edit' : 'Add a new');?> Product</h2><hr>
  <form action="products.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="POST" enctype="multipart/form-data">
    <div class="form-group col-md-3">
      <label for="title">Title*:</label>
      <input type="text" name="title" class="form-control" id="title" value="<?=$title;?>">
    </div>
    <div class="form-group col-md-3">
      <label for="type">Type*:</label>
      <select class="form-control" id="type" name="type">
        <option value=""<?=(($type == '')?' selected':'');?>></option>
        <?php while($t = mysqli_fetch_assoc($typeQuery)): ?>
          <option value="<?=$t['id'];?>"<?=(($type == $t['id'])?' selected':'');?>><?=$t['type'];?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="parent">Parent Category*:</label>
      <select class="form-control" id="parent" name="parent">
        <option value=""<?=(($parent == '')?' selected':'');?>></option>
        <?php while($p = mysqli_fetch_assoc($parentQuery)): ?>
          <option value="<?=$p['id'];?>"<?=(($parent == $p['id'])?' selected':'');?>><?=$p['category'];?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="child">Child Category*:</label>
      <select id="child" name="child" class="form-control">
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="price">Price*:</label>
      <input type="text" id="price" name="price" class="form-control" value="<?=$price;?>">
    </div>
    <div class="form-group col-md-3">
      <label for="list_price">List Price*:</label>
      <input type="text" id="list_price" name="list_price" class="form-control" value="<?=$list_price;?>">
    </div>
    <div class="form-group col-md-6">
      <?php if($saved_image != ''): ?>
        <div class="$saved-image">
          <img src="<?=$saved_image;?>" alt="$saved image"><br>
          <a href="products.php?delete_image=1&edit=<?=$edit_id;?>" class="text-danger">Delete Image</a>

        </div>
      <?php else: ?>
        <label for="photo">Product Photo:</label>
        <input type="file" name="photo" id="photo" class="form-control">
    <?php endif; ?>
    </div>
    <div class="form-group col-md-6">
      <label for="description">Description:</label>
      <textarea id="description" name="description" class="form-control" rows="6"><?=$description;?></textarea>
    </div>
    <div class="form-group pull-right col-md-3">
      <a href="products.php" class="btn btn-default">Cancel</a>
      <input type="submit" value="<?=((isset($_GET['edit']))?'Edit':'Add');?> Product" class=" btn btn-success">
    </div><div class="clearfix"></div>
  </form>
  <?php }else{
  $sql = "SELECT * FROM products WHERE deleted = 0";
  $presults = $db->query($sql);
  if(isset($_GET['featured'])){
    $id = (int)$_GET['id'];
    $featured = (int)$_GET['featured'];
    $featuredSql = "UPDATE products SET featured = '$featured' WHERE id = '$id'";
    $db->query($featuredSql);
    header('Location: products.php');
  }
?>
<h2 class="text-center">Products</h2>
<a href="products.php?add=1" class="btn btn-success pull-right" id="add-product-btn">Add Product</a><div class="clearfix"></div>
<hr>
<table class="table table-bordered table-condensed table-striped">
  <thead><th></th><th>Product</th><th>Price</th><th>Category</th><th>Featured</th><th>Sold</th></thead>
  <tbody>
    <?php while($product = mysqli_fetch_assoc($presults)):
      $childID = $product['categories'];
      $catSql = "SELECT * FROM categories WHERE id = '$childID'";
      $result = $db->query($catSql);
      $child = mysqli_fetch_assoc($result);
      $parentID = $child['parent'];
      $pSql = "SELECT * FROM categories WHERE id = '$parentID'";
      $presult = $db->query($pSql);
      $parent = mysqli_fetch_assoc($presult);
      $category = $parent['category'].'~'.$child['category'];
    ?>
      <tr>
        <td>
          <a href="products.php?edit=<?=$product['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
          <a href="products.php?delete=<?=$product['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
        </td>
        <td><?=$product['title'];?></td>
        <td><?=money($product['price']);?></td>
        <td><?=$category;?></td>
        <td><a href="products.php?featured=<?=(($product['featured'] == 0)?'1':'0');?>&id=<?=$product['id'];?>" class="btn btn-xs btn-default">
          <span class="glyphicon glyphicon-<?=(($product['featured'] == 1)?'minus':'plus');?>"></span>
        </a>&nbsp <?=(($product['featured'] == 1)?'Featured Product':'');?></td>
        <td>0</td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php } include 'includes/footer.php';
?>
<script>
  jQuery('document').ready(function(){
    get_child_options('<?=$category;?>');
  });
</script>
