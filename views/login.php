<!DOCTYPE html>
<html>
<head>
<title>Add New Post</title>
  <?php $up=''; require'../include/head.php';
  require'../include/nave.php';


  ?>
</head>
<body>
<div class="container">
	 <?php
      include_once '../include/connection.php';
      include_once '../controller/userController.php';
      $database =new Database();
      $db = $database->getConnection();
      $user = new userController($db);
      if (isset($_POST['signin'])) {
        $user->logIn();
      }
      if(!empty($_GET['message'])) {
      echo'<div class="alert alert-success">
              <strong>'.$_GET['message'].' !</strong> 
          </div>';
        } else if(!empty($_GET['error'])) {
      echo'<div class="alert alert-danger">
              <strong>'.$_GET['error'].'!</strong> 
          </div>';
      }
  ?>
  <div class="row">
    <div class="col-sm-9 col-md-8 mx-auto">
      <div class="card card-signin my-5">
        <div class="card-body">
          <h5 class="card-title text-center">Sign In</h5>
          
          <form class="form-signin"action="<?php echo($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data" >
            <div class="form-label-group">
              <label for="username">Username </label>
              <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
            </div>

            <div class="form-label-group">
              <label for="Password">Password</label>
              <input type="password" id="Password" class="form-control" placeholder="Password" required name="password" >
            </div>

            <div class="custom-control custom-checkbox mb-3">
              <input type="checkbox" class="custom-control-input" id="customCheck1">
              <label class="custom-control-label" for="customCheck1">Remember password</label>
            </div>

            <input type="submit"  class="btn btn-lg btn-primary btn-block text-uppercase" name="signin" value="sign in">
            <hr class="my-4">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include'../include/footer.php';?>
<script src="../../include/bootstrap.bundle.min.js"></script>
</body>
</html> 