<?php
  require_once '../core/init.php';
  include 'includes/head.php';
  include 'includes/navigation.php';
  //get type from database
  $sql="SELECT * FROM type ORDER BY type";
  $results = $db->query($sql);
  $errors = array();

  //Edit type
  if(isset($_GET['edit']) && !empty($_GET['edit'])){
    $edit_id = (int)$_GET['edit'];
    $edit_id = sanitize($edit_id);
    $sql2 = "SELECT * FROM type WHERE id = '$edit_id'";
    $edit_result = $db->query($sql2);
    $eType = mysqli_fetch_assoc($edit_result);
  }

  //Delete Type
  if(isset($_GET['delete']) && !empty($_GET['delete'])){
    $delete_id = (int)$_GET['delete'];
    $delete_id = sanitize($delete_id);
    $sql = "DELETE FROM type WHERE id = '$delete_id'";
    $db->query($sql);
    header('Location: type.php');
  }

  //If add form is submitted
  if(isset($_POST['add_submit'])){
    $type = sanitize($_POST['type']);
    //check if type is blank
    if($_POST['type'] == ''){
      $errors[] .= 'Yout must enter a type!';
    }
    // check if type exist in database
    $sql = "SELECT * FROM type WHERE type = '$type'";
    if(isset($_GET['edit'])){
      $sql = "SELECT * FROM type WHERE type = '$type' AND id != '$edit_id'";
    }
    $result = $db->query($sql);
    $count = mysqli_num_rows($result);
    if($count > 0){
      $errors[] .= $type.' already exists. Please chose another type...';
    }

    //display errors
    if(!empty($errors)){
      echo display_errors($errors);
    }else{
      //Add type to database
      $sql = "INSERT INTO type (type) VALUES ('$type')";
      if(isset($_GET['edit'])){
        $sql = "UPDATE type SET type ='$type' WHERE id = $edit_id";
      }
      $db->query($sql);
      header('Location: type.php');
    }
  }

?>
<h2 class="text-center">Type</h2><hr>
<!-- Type form -->
<div class="text-center">
  <form class="form-inline" action="type.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="post">
    <div class="form-group mx-auto">
      <?php
      $type_value = '';
      if(isset($_GET['edit'])){
        $type_value = $eType['type'];
      }else{
        if(isset($_POST['type'])){
          $type_value = sanitize($_POST['type']);
        }
      } ?>
      <label class="d-inline" for="type"><?=((isset($_GET['edit']))?'Edit':'Add a'); ?> Type: </label>
      <input class="mx-2" type="text" name="type" id="type" class="form-control" value="<?=$type_value; ?>">
      <?php if(isset($_GET['edit'])): ?>
        <a href="type.php" class="btn btn-default">Cancel</a>

        <?php endif; ?>
      <input type="submit" name="add_submit" value="<?=((isset($_GET['edit']))?'Edit':'Add'); ?> type" class="btn btn-success">
    </div>
  </form>
</div><hr>

<table class="table table-bordered table-striped table-auto table-condensed">
  <thead>
    <th></th><th>Type</th><th></th>
  </thead>
  <tbody>
    <?php while($type = mysqli_fetch_assoc($results)): ?>
      <tr>
        <td><a href="type.php?edit=<?=$type['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"</span></a></td>
        <td><?=$type['type'];?></td>
        <td><a href="type.php?delete=<?=$type['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a></td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php
  include 'includes/footer.php';
?>
