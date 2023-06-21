<!DOCTYPE html>
<html>
<head>
  <title>Add New Post</title>
   <?php $up = "../"; require'../../include/head.php';?>
</head>

<body>
  <!-- start nav bar -->
  <?php include $up.'../include/nave.php';?>
   
   <!-- start sidebar -->
  <?php include $up.'../include/sidebar.php';
  if(!$_SESSION['username'] &&  !$_SESSION['userid']){
     header("Location:../login.php");
    }?>
  <!-- ----------------------------- -->
  
  <div class="container">
     <div class="row">
      <!-- Blog Entries Column -->
      <div class="col-md-10">
        <h3 class="h1 text-center"> Add New Blog </h3>
        <?php
          include_once '../../include/connection.php';
          include_once '../../controller/postController.php';
          if (isset($_POST['Add'])) {
            $database =new Database();
            $db = $database->getConnection();
            $post = new postController($db);
            $post->setData();
            $post->insert();
          // return;
          }
          if(!empty($_GET['message'])) {
          echo'<div class="alert alert-success">
                  <strong>'.$_GET['message'].' !</strong> 
              </div>';
            } else if(!empty($_GET['error'])) {
          echo'<div class="alert alert-danger">
                  <strong>'.$_GET['error'].' !</strong> 
              </div>';
            }
       ?>
       <hr>
          <form  action="<?php echo($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data" >
            <div class="form-group row">
              <label for="text" class="col-12 col-form-label">Enter Title here</label> 
              <div class="col-12">
                <input id="text" name="title" placeholder="Enter Title here" class="form-control here" required="required" type="text">
              </div>
            </div>
            
            <div class="form-group row">
              <label for="textarea" class="col-12 col-form-label">Enter Content</label> 
              <div class="col-12">
                <textarea id="textarea" name="content" cols="40" rows="12" class="form-control"></textarea>
              </div>
            </div> 
            <div class="form-group row">
              <label for="file" class="col-12 col-form-label">Selecct image</label> 
              <div class="col-12">
                <input id="file" name="image" class="form-control here" type="file">
              </div>
            </div>
            <div class="form-group">
          <input type="submit"  style=" padding: 5px 30px; background-color:#001a33; color:lightblue" name="Add" value="POST">
        </div>
          </form>
        </div>
  </div>
</div>
</div>
<!-- --------------------------- -->
<?php include'../../include/footer.php';?>
</body>
</html> 