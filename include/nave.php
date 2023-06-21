<?php session_start();?>
<div class="navbar">
  <a id="prand" href="<?php echo $up.'posts/homeLayout.php'?>">BLOG</a>
  <a class="active" href="<?php echo $up.'dashLayout.php'?>"><i class="fa fa-fw fa-home"></i> Home</a> 
  <a href="<?php echo $up.'posts/add.php'?>"><i class="fa fa-fw fa-plus-square"></i> New Post</a> 
  <a href="<?php echo $up.'users/adduser.php'?>"><i class="fa fa-fw fa-plus-square"></i> New User</a> 
  <a href=""><i class="fa fa-fw fa-envelope"></i> Contact</a> 
  
<?php 
    if (!isset($_SESSION['username'])) {
        echo '
  <a href="'.$up.'users/adduser.php"><i class="fa fa-fw fa-sign-in"></i> Register</a>
  <a href="'.$up.'login.php"><i class="fa fa-fw fa-user"></i> Login</a>
  <span style="font-size:30px;cursor:pointer" onclick="openSide()">&#9776;</span>
';
    }else{
        echo '
  <a href="'.$up.'logout.php"><i class="fa fa-fw fa-user"></i> '.$_SESSION['username'].' </a>
  <span style="font-size:30px;cursor:pointer" onclick="openSide()">&#9776;</span>';
}
  ?>




</div>

	