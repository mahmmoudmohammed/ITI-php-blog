<?php 
include_once '../../include/connection.php';
include_once '../../controller/postController.php';
  
// instantiate database and post Contrller object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$post = new postController($db);
  
$id = $_GET['idd']; 
// query products
$post->delete($id);
?>