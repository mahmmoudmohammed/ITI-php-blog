<!DOCTYPE html>
<html>
<head>
<title>Edite Comment</title>
   
   <?php $up = '../'; require'../../include/head.php';?>

</head>

<body>
 <!-- start nav bar -->
 <?php
    
    include $up.'../include/nave.php';
     if(!$_SESSION['username'] &&  !$_SESSION['userid']){
     header("Location:../login.php");
    }
     // start sidebar 
    include $up.'../include/sidebar.php';
  ?>
  
<!-- ----------------------------- -->
  <h3 class="h1 text-center"> Update Post </h3>

  <div class="container">
  <?php

    include_once '../../include/connection.php';
    include_once '../../controller/commentController.php';
    $database =new Database();
    $db = $database->getConnection();
    $comment = new commentController($db);
    if (isset($_POST['Update'])) {
      $comment->setData();
      $comment->update($_POST['id'],$_POST['post_id']);
    }
   
    if(!empty($_GET['message'])) {
    echo'<div class="alert alert-success">
            <strong>'.$_GET['message'].' !</strong> 
        </div>';
      } else if(!empty($_GET['error'])) {
    echo'<div class="alert alert-danger">
            <strong>'.$_GET['message'].' !</strong> 
        </div>';
    }
         if (isset($_GET['idd'])){
      $id = $_GET['idd']; 
      $post_id = $_GET['id'];
      $row  = $comment->edit($id);
      $result = mysqli_fetch_assoc($row);
// <!-- ----------------------------- -->
  echo '
    <form  action="'.$_SERVER['PHP_SELF'].'" method="POST">
      <div class="form-group row">
        <label for="textarea" class="col-12 col-form-label">Enter Content</label> 
        <div class="col-12">
          <textarea id="textarea" name="content" cols="40" rows="12" class="form-control">'.$result["content"].'</textarea>
        </div>
      </div> 
      
      <div class="form-group">
        <input type="hidden" name="id" value="'.$result["id"].'"> 
        <input type="hidden" name="post_id" value="'.$post_id.'"> 
        <input type="submit"  style=" padding: 5px 30px; background-color:#001a33; color:lightblue" name="Update" value="UPDATE">
      </div>
    </form>';
    }
  ?>
  </div>
  <!-- --------------------------- -->
  <?php include'../../include/footer.php';
  ?>
</body>
</html> 