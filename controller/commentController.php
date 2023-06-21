<?php
class commentController 
{
    // databse info
    private $conn;
    private $table_name = "comments";
    // object properties
    private $id;
    private $content;
    private $user_id;
    private $post_id;
    private $created_at ;
    private $updated_at ;
    function setData()
    {
       session_start();
       if (isset($_SESSION['userid'])) {
        $this->user_id = $_SESSION['userid'];
        }
      $this->content = $_POST['content'];
      $this->post_id = $_POST['post_id'];
      $this->created_at = date('Y-m-d H:i:s');
      $this->updated_at = date('Y-m-d H:i:s');
    }

    public function __construct($db)
    {
        $this->conn = $db;
    }
   
    function Show($id)
    {
      $sql = "SELECT c.id,c.post_id, c.content,u.username ,u.email FROM posts p JOIN comments c ON c.post_id = p.id JOIN users u ON c.user_id=u.id AND p.id=$id";
      $result = mysqli_query($this->conn, $sql);
      return $result;
    }

    function insert()
    {
      $location = "post.php";
      if(
        !empty($this->content) &&
        !empty($this->user_id) &&
        !empty($this->post_id))
      {  
         $sql = "INSERT INTO " . $this->table_name . " (content,post_id,user_id,created_at) VALUES
          ('$this->content','$this->post_id','$this->user_id','$this->created_at')";
        $request = mysqli_query($this->conn, $sql);
        if(! $request ) {
            die('<div class="alert alert-danger">
                    <strong>'.mysqli_error($this->conn).' !</strong> 
                </div>');
        } 
      
        header("Location: $location?id=$this->post_id&message=Posted comment Successfully.");
      } else {
        // tell the user
        header("Location: $location?id=$this->post_id&message= can't post Comment. data is incomplete"); 
      }  
    }

    function delete($id,$post_id)
    {
         $location = "post.php";
       $sql = "DELETE FROM " . $this->table_name . " WHERE id=$id";
      $result = mysqli_query($this->conn, $sql);
      $request = mysqli_query($this->conn, $sql);
      if(! $request ) {
          die('<div class="alert alert-danger">
                  <strong>'.mysqli_error($this->conn).' !</strong> 
              </div>');
      } 
     header("Location: $location?id=$post_id&message=deleted Comment Successfully");
    }

     function edit($id)
    {
      $sql = "SELECT * FROM " . $this->table_name . " WHERE id = $id";
      $result = mysqli_query($this->conn, $sql);
      // print_r($result);
      return $result;
    }

    function update($id,$post_id)
    {
       $sql = "UPDATE " . $this->table_name . " SET content = '" . $this->content . "', updated_at = '". $this->updated_at . "' WHERE id=$id";
      $request = mysqli_query($this->conn, $sql);
      if(! $request ) {
          die('<div class="alert alert-danger">
                  <strong>'.mysqli_error($this->conn).' !</strong> 
              </div>');
      } 
       header("Location:post.php?id=$post_id&message= Updated Post Successfully");
    }


    


}



    

