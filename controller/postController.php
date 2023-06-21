<?php

class postController 
{
    // databse info
    private $conn;
    private $table_name = "posts";
    // object properties
    private $id;
    private $title;
    private $image;
    private $content;
    private $user_id;
    private $created_at ;
    private $updated_at ;
    function setData()
    {
      session_start();
       if (isset($_SESSION['userid'])) {
      $this->user_id =$_SESSION['userid'];}
      $this->title = $_POST['title'];
      $this->content = $_POST['content'];
      $this->created_at = date('Y-m-d H:i:s');
      $this->updated_at = date('Y-m-d H:i:s');
    }

    public function __construct($db)
    {
        $this->conn = $db;
    }
   
    function index()
    {
      $sql = "SELECT  posts.* , users.username from posts left join users on users.id = posts.user_id";
      $result = mysqli_query($this->conn, $sql);
      return $result;
    }

    function Show($id)
    {
      $sql = "SELECT  posts.* , users.username from posts left join users on posts.id=$id";
      $result = mysqli_query($this->conn, $sql);
      return $result;
    }

    function insert()
    {
      $location = "homeLayout.php";
      if(
        !empty($this->title) &&
        !empty($this->user_id) &&
        !empty($this->content))
      {
         $sql = "INSERT INTO " . $this->table_name . " (title,content,image,user_id,created_at) VALUES ('$this->title','$this->content','$this->image','$this->user_id','$this->created_at')";
        $request = mysqli_query($this->conn, $sql);
        if(! $request ) {
            die('<div class="alert alert-danger">
                    <strong>'.mysqli_error($this->conn).' !</strong> 
                </div>');
        } 
      
        header("Location: $location?message= Posted Successfully ");
      } else {
        // tell the user
        header("Location: #?error=Unable to Post Blog. Data is incomplete."); 
      }  
    }

    function delete($id)
    {
       $sql = "DELETE FROM " . $this->table_name . " WHERE id=$id";
      $result = mysqli_query($this->conn, $sql);
      $request = mysqli_query($this->conn, $sql);
      if(! $request ) {
          die('<div class="alert alert-danger">
                  <strong>'.mysqli_error($this->conn).' !</strong> 
              </div>');
      } 
      header("Location:homeLayout.php?message= Delete User Successfully");
    }
    
     function edit($id)
    {
      $sql = "SELECT * FROM " . $this->table_name . " WHERE id = $id";
      $result = mysqli_query($this->conn, $sql);
      // print_r($result);
      return $result;
    }

    function update($id)
    {
       $sql = "UPDATE " . $this->table_name . " SET title = '" . $this->title ."',content = '" . $this->content . "', updated_at = '". $this->updated_at . "' WHERE id=$id";
      $request = mysqli_query($this->conn, $sql);
      if(! $request ) {
          die('<div class="alert alert-danger">
                  <strong>'.mysqli_error($this->conn).' !</strong> 
              </div>');
      } 
       header("Location:homeLayout.php?message= Updated Post Successfully");
    }
}