<!DOCTYPE html>
<html>
<head>
<title>HOME</title>
  <?php $up=''; require '../include/head.php'; 
    
  ?>
</head>

<body>
 <!-- start nav bar -->
 <?php include '../include/nave.php'; 
  if(!$_SESSION['username'] &&  !$_SESSION['userid']){
     header("Location:$up login.php");
    }
  ?>
  

<!--  start sidbar -->
  <?php include '../include/sidebar.php';?>

<!-- start content -->
<div class="container">
  <?php if(!empty($_GET['message'])) {
          echo'<div class="alert alert-success">
                  <strong>'.$_GET['message'].' !</strong> 
              </div>';
            } else if(!empty($_GET['error'])) {
          echo'<div class="alert alert-danger">
                  <strong>'.$_GET['message'].' !</strong> 
              </div>';}
  ?>
<h1 class=" h2 text-center ">
  Users 
</h1>
<hr/>
<a href="users/addUser.php" class="btn btn-primary btn-block" role="button">Adduser</a>
<br>
<table class="table">
  <thead class="thead-dark">
    <th>Name </th>
    <th>Username </th>
    <th>Email </th>
    <th>Gender </th>
    <th>Role </th>
    <th>Joined At</th>
     <th>Last Update</th>
    <th colspan="2" style="text-align: center;"> Operations</th>
  </thead>

  <tbody>
    <?php 
    include_once '../include/connection.php';
    include_once '../controller/userController.php';
      
    // instantiate database and user Contrller object
    $database = new Database();
    $db = $database->getConnection();
      
    // initialize object
    $user = new userController($db);
      
    // query users
    $result = $user->index();
     if (mysqli_num_rows($result) > 0) {
       // output data of each user
      while($row = mysqli_fetch_assoc($result))
        {
       // output data of only one user
          echo"
              <tr>
                <td>".$row['name']."</td>
                <td>".$row['username']."</td>
                <td>".$row['email']."</td>
                <td>".$row['gender']."</td>
                <td>".$row['role']."</td>
                <td>".$row['created_at']."</td>
                <td>".$row['updated_at']."</td>
                <td><a class='btn btn-primary' href='../views/users/edite.php?idd=$row[id]'>EDITE</td>
                <td><a class='btn btn-danger' href='../views/users/delete.php?idd=$row[id]'>DELETE</a></td>
              </tr>";
            }
       }
    ?>
  </tbody>
  <tfoot class="thead-light">
    <th>Name </th>
    <th>Username </th>
    <th>Email </th>
    <th>Gender </th>
    <th>Role </th>
    <th>Joined At </th>
    <th>Last Update</th>
    <th colspan="2" style="text-align: center;"> Operations</th>
  </tfoot>
</table>
</div>
<!-- end content -->
<?php include'../include/footer.php';?>
</body>
</html> 