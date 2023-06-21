<!DOCTYPE html>
<html>
<head>
<title>Add New User</title>
   <?php $up = '../';  require'../../include/head.php';?>
</head>

<body>
 <!-- start nav bar -->
 <?php include $up.'../include/nave.php';

   ?>
<!-- // ../../controller/userController.php  -->
 
  
<!-- ----------------------------- -->
  
  <div class="container">

     <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-10">
        <h3 class="h1 text-center">REGISTER </h3>

        <?php

          include_once '../../include/connection.php';
          include_once '../../controller/userController.php';
          if (isset($_POST['Add'])) {
            $database =new Database();
            $db = $database->getConnection();
            $user = new userController($db);
            $user->setData();
            $user->insert();
          // return;
          }

          if(!empty($_GET['message'])) {
          echo'<div class="alert alert-success">
                  <strong>'.$_GET['message'].' !</strong> 
              </div>';
            } else if(!empty($_GET['error'])) {
          echo'<div class="alert alert-danger">
                  <strong>'.$_GET['message'].' !</strong> 
              </div>';}
       ?>
      <form  action="<?php echo($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data" >
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" required>
        </div>
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" >
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" id="password" 
          placeholder="Enter password" name="password" required>
        </div>
        <div class="form-group">
             <label for="gender"> Gender:</label>
          <select name="gender" class="form-control" >
            <option>Male</option>
            <option>Female</option>
          </select> 
        </div>
        <br>
        <!-- <div class="form-group">
             <label for="role"> User Role:</label>
          <select name="role" class="form-control" >
            <option>Admin</option>
            <option>User</option>
          </select> 
        </div> -->
        <div class="form-group">
          <input type="submit"  style=" padding: 5px 30px; background-color:#001a33; color:lightblue" name="Add" value="ADD">
        </div>
      </form>
  </div>
</div>
</div>

<!-- --------------------------- -->
<?php include'../../include/footer.php';?>
</body>
</html> 