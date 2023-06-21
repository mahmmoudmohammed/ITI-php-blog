<!DOCTYPE html>
<html>
<head>
<title>Edite User</title>
   
   <?php  $up = '../'; require'../../include/head.php';?>

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
  <h3 class="h1 text-center"> Update User </h3>

  <div class="container">
        <?php

          include_once '../../include/connection.php';
          include_once '../../controller/userController.php';
          $database =new Database();
          $db = $database->getConnection();
          $user = new userController($db);
          if (isset($_POST['Update'])) {
            $user->setData();
            $user->update($_POST['id']);
          }
         
          if(!empty($_GET['message'])) {
          echo'<div class="alert alert-success">
                  <strong>'.$_GET['message'].' !</strong> 
              </div>';
            } else if(!empty($_GET['error'])) {
          echo'<div class="alert alert-danger">
                  <strong>'.$_GET['message'].' !</strong> 
              </div>';}
               if (isset($_GET['idd'])){
            $id = $_GET['idd']; 
            $row  = $user->edit($id);
            $result = mysqli_fetch_assoc($row);
            // print_r($result);
// <!-- ----------------------------- -->
    echo '
      <form  action="'.$_SERVER['PHP_SELF'].'" method="POST" >
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="'.$result["name"].'" required>
        </div>
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" value="'.$result["username"].'" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="'.$result["email"].'" required>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" id="password" 
          placeholder="Enter password" name="password" value="'.$result["password"].'" required>
        </div>
        <div class="form-group">
             <label for="gender"> Gender:</label>
          <select name="gender" class="form-control" >
            <option>Male</option>
            <option>Female</option>
          </select> 
        </div>
        <br>
        <input type="hidden" name="id" value="'.$result["id"].'"> 
        <div class="form-group">
            <input type="submit"  style=" padding: 5px 30px; background-color:#001a33; color:lightblue" name="Update" value="UPDATE">
        </div>
      </form>
      ';
    }
  ?>
  </div>
 <!-- --------------------------- -->
  <?php include'../../include/footer.php';
  ?>
</body>
</html> 