<?php
include_once '../../include/connection.php';
include_once '../../controller/commentController.php';
  
// instantiate database and user Contrller object
$database = new Database();
$db = $database->getConnection();

// initialize object
$objectComment = new commentController($db);
 if (isset($_POST['Add'])) {
            $objectComment->setData();
            $objectComment->insert();

          }

?>