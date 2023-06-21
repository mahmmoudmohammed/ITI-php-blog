<?php 
include_once '../../include/connection.php';
include_once '../../controller/userController.php';
  
// instantiate database and user Contrller object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$user = new userController($db);
  
$id = $_GET['idd']; 
// query products
$user->delete($id);
?>