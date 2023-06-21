<!DOCTYPE html>
<html>
<head>
  <title>Blogs</title>
  <?php  $up = "../";  require $up.'../include/head.php';?>
  </head>
<body>
  
<!--  start sidbar -->
  <?php include '../../include/sidebar.php';?>

<!-- start nav bar -->
<?php include '../../include/nave.php'; 
    
  ?>
<!-- start content -->
<div class="container">
  <?php
  if(!empty($_GET['message'])) {
      echo'<div class="alert alert-success">
              <strong>'.$_GET['message'].' !</strong> 
          </div>';
        } else if(!empty($_GET['error'])) {
      echo'<div class="alert alert-danger">
              <strong>'.$_GET['error'].' !</strong> 
          </div>';}
          ?>
 <div class="row">
  <!-- Blog Entries Column -->
  <div class="col-md-10">
    <h1 class="my-4"> Popular Blogs:
      <small style="font: oblique 18px lightgray; "> read right and enjoy</small>
    </h1>
    <hr/>
	<a href="add.php" class="btn btn-primary btn-block" role="button">Write New POST </a>
	<br>

<?php 
include_once '../../include/connection.php';
include_once '../../controller/postController.php';
  
// instantiate database and user Contrller object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$controller = new postController($db);
  
// query users
$posts = $controller->index();
     if (mysqli_num_rows($posts) > 0) {
         // output data of each user
        while($post = mysqli_fetch_assoc($posts))
          {

          	echo'<div class="card mb-4">
			      <img class="card-img-top" src="../../images/'.$post['image'].'" alt="Card image cap">
			      <div class="card-body">
			        <h2 class="card-title ">'.$post['title'].'</h2>
			        <p class="card-text text-muted">'.$post['content'].'</p>
			        <a href="post.php?id='.$post['id'].'" class=" btn btn-primary">Read More &rarr;</a>
			      </div>
			      <div class="card-footer text-muted"><b>
			        Posted on </b>'.$post['created_at'].' by
			        <a href="#">'.$post['username'].'</a>
			      </div>
			  	 </div>';
          }
  }
?>
    <!-- Blog Post -->
      <ul class="pagination justify-content-center mb-4">
    	  <li class="page-item">
    	    <a class="page-link" href="#">&larr; Older</a>
    	  </li>
    	  <li class="page-item disabled">
    	    <a class="page-link" href="#">Newer &rarr;</a>
          </li>
       </ul>
		</div>
	</div>

</div>
<!-- end content -->

<!-- start footer -->
<?php include $up.'../include/footer.php';?>
<!-- end footer -->


</body>
</html> 
