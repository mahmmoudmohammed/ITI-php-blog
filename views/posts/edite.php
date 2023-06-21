<!DOCTYPE html>
<html>
<head>
  <title>Edite Post</title>
  <?php $up = '../'; require $up.'../include/head.php';?>
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
  include_once '../../controller/postController.php';
  $database =new Database();
  $db = $database->getConnection();
  $post = new postController($db);
  if (isset($_POST['Update'])) {
    $post->setData();
    $post->update($_POST['id']);
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
    $row  = $post->edit($id);
    $result = mysqli_fetch_assoc($row);
// <!-- ----------------------------- -->
  echo '
    <form  action="'.$_SERVER['PHP_SELF'].'" method="POST">
    	<div class="form-group row">
            <label for="text" class="col-12 col-form-label">Enter Title here</label> 
            <div class="col-12">
              <input id="text" name="title" placeholder="Enter Title here" class="form-control here" required="required" type="text" value="'.$result["title"].'">
            </div>
          </div>
          
          <div class="form-group row">
            <label for="textarea" class="col-12 col-form-label">Enter Content</label> 
            <div class="col-12">
              <textarea id="textarea" name="content" cols="40" rows="12" class="form-control">'.$result["content"].'</textarea>
            </div>
          </div> 
          
          <div class="form-group">
          <input type="hidden" name="id" value="'.$result["id"].'"> 
        <input type="submit"  style=" padding: 5px 30px; background-color:#001a33; color:lightblue" name="Update" value="UPDATE">
      </div>
    </form>';
    }
  ?>
  </div>
  <!-- --------------------------- -->
  <?php include $up.'../include/footer.php';
  ?>
</body>
</html> 