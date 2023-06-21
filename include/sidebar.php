<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeSide()">&times;</a>
  <a  href="<?php echo $up.'dashLayout.php';?>">All Users</a>
  <a href="<?php echo $up.'posts/homeLayout.php';?>">All Posts</a>
  <a href="<?php echo $up.'posts/add.php';?>"> New Post</a>
  <a href="<?php echo $up.'users/addUser.php';?>"> New User</a>
</div>


<script>
function openSide() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeSide() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>