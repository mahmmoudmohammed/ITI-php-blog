<?php 
include_once '../../include/connection.php';
include_once '../../controller/commentController.php';
  
// instantiate database
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$comment = new commentController($db);
  
$id = $_GET['idd']; 
$post_id = $_GET['id']; 
// query products
$comment->delete($id,$post_id);
?>