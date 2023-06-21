<!DOCTYPE html>
<html>
<head>
  <title>Blogs</title>
  <?php $up='../';  
    require $up.'../include/head.php';?>
</head>

<body>
<!--  start sidbar -->
  <?php include $up.'../include/sidebar.php';?>

<!-- start nav bar -->
<?php include $up.'../include/nave.php';
if(!$_SESSION['username'] &&  !$_SESSION['userid']){
     header("Location:../login.php");
    }
  ?>
<!-- start content -->
<div class="container">

 <div class="row">
  <!-- Blog Entries Column -->
  <div class="col-md-10">
    
<?php 
include_once '../../include/connection.php';
include_once '../../controller/postController.php';
include_once '../../controller/commentController.php';
  
// instantiate database and user Contrller object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$objectComment = new commentController($db);
$objectPost = new postController($db);
$id = $_GET['id']; 
          if(!empty($_GET['message'])) {
          echo'<div class="alert alert-success">
                  <strong>'.$_GET['message'].' !</strong> 
              </div>';
            } else if(!empty($_GET['error'])) {
          echo'<div class="alert alert-danger">
                  <strong>'.$_GET['error'].' !</strong> 
              </div>';
            }


//query post
$result = $objectPost->show($id);
$post = mysqli_fetch_assoc($result);

//<!-- --------- PostBody ---------------------- -->
          	echo' 
            <h1 class="my-4">'.$post['title'].'</h1><hr/>
            <div class="card mb-4"style="font-style: oblique;">
			          <img class="card-img-top" src="'.$post['image'].'" alt="Card image cap">
			      <div class="card-body">
			        <h2 class="card-title ">'.$post['title'].'</h2>
			        <p class="card-text text-muted">'.$post['content'].'</p>
			      </div>
			      <div class="card-footer text-muted"><b>
			        Posted on </b>'.$post['created_at'].' by
			        <a href="#">'.$post['username'].'</a>
			      </div>
             <div class="btn-group">
              <a type="button" class="btn btn-info" href="edite.php?idd='.$post["id"].'">Update</a>
              <a type="button" class="btn btn-danger"  href="delete.php?idd='.$post["id"].'">Delete</a>
              </div>
			  	 </div>';
?>
    <hr/>

    </div>

  </div>
  <h3 style="font-style: oblique;">Comments:</h3>
 <!-- ----------------------------------------- -->
              

<!-- --------- Post Comments ---------------------- -->
    <div class="row">

     <?php
//query comments
$comments = $objectComment->show($id);
// $post = mysqli_fetch_assoc($comments);

       echo '<div class="card col-lg-10 mt-100" style="margin:2% 0 0 0;">
              <div class="card-content">
                <div class="card-body p-0">
                  <div class="card-title text-center"><b>Put Your Opinion</b>
                    </div>
                    <div class="profile "> <img class="rounded-circle" src="../../images/menAvatar.jpg" width="70" height="70" alt="profile image"></div>
                    <div class="card-title"><small>'.$_SESSION['username'].'</small> 
                    </div>
                    <div class="card-subtitle">
                      <form  action="addComment.php" method="post" enctype="multipart/form-data" >
                      <div class="form-group row">
                        <label for="textarea" class="col-12 col-form-label">Enter Your Comment</label> 
                        <div class="col-12">
                          <textarea id="textarea" name="content" cols="40" rows="3" class="form-control"></textarea>
                        </div>
                      </div> 
                      <input type="hidden" name="post_id" value="'.$_GET["id"].'"> 
                      <div class="form-group">
                        <input type="submit"  style=" padding: 5px 30px; background-color:#001a33; color:lightblue" name="Add" value="POST">
                      </div>
                      </form> 
                  </div>
              </div>
            </div>
          </div>';

if (mysqli_num_rows($comments) > 0) {
         // output data of each comment
        while($comment = mysqli_fetch_assoc($comments))
          {
   
        echo'<div class="card col-lg-10 mt-100" style="margin:1% 0 0 0;">
              <div class="card-content">
                <div class="card-body p-0">

                <div class="dropdown text-right">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                    <a class="dropdown-item " type="button"   href="deleteComment.php?idd='.$comment["id"].'&id='.$comment["post_id"].'"> DELETE </a>
                    <a class="dropdown-item active" type="button" href="editeComment.php?idd='.$comment["id"].'&id='.$comment["post_id"].'"> Edite </a>
                  </div>
                </div>
<!----------------->
                    <div class="profile "> <img class="rounded-circle" src="../../images/menAvatar.jpg" width="70" height="70" alt="profile image"></div>
                    <div class="card-title"> '.$comment['username'].'<br /> <small>'.$comment['email'].'</small> </div>
                    <div class="card-subtitle">
                        <p> <small class="text-muted" style="font-style: oblique;"> '.$comment['content'].'</small> </p>
                </div>
              </div>
            </div>
          </div>
          ';
        }
      }
 ?>

      </div>
</div>   
 <!-- --------------------------- -->

<!-- start footer -->
<?php include $up.'../include/footer.php'; ?>
</body>
</html> 
