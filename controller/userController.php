<?php
class userController 
{

    // databse info
    private $conn;
    private $table_name = "users";
    
    // object properties
    private $id;
    private $name;
    private $username;
    private $password;
    private $email;
    private $gender;
    private $role;
    private $created_at ;
     private $updated_at ;
    function setData()
    {
      $this->name = $_POST['name'];
      $this->username = $_POST['username'];
      $this->email = $_POST['email'];
      $this->password = $_POST['password'];
      $this->gender = $_POST['gender'];
      $this->created_at = date('Y-m-d H:i:s');
      $this->updated_at = date('Y-m-d H:i:s');
    }

    public function __construct($db)
    {
        $this->conn = $db;
       
    }
    function logIn()
    { session_start();
       $this->username = $_POST['username'];
       $this->password = $_POST['password'];
      
      $sql = "SELECT*FROM users WHERE username ='$this->username' AND password ='$this->password'";
      $result = mysqli_query($this->conn, $sql);
      if(! $result ) {
            die('<div class="alert alert-danger">
                    <strong>'.mysqli_error($this->conn).' !</strong> 
                </div>');
        } 
      if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

         $_SESSION['userid']= $user['id'];
         $_SESSION['username']= $user['username'];
         $_SESSION['email']= $user['email'];
         header("Location: posts/homeLayout.php?message= Welcom on our Blog: ".$_SESSION['username']);
      }else{
      header("Location: #?error= Username Or Password is Incorrect!");
      }
    }
   
    function index()
    {
      $sql = "SELECT * FROM " . $this->table_name;
      $result = mysqli_query($this->conn, $sql);
      return $result;
    }

    function insert()
    {
      $location = "../users/addUser.php";
      if(
        !empty($this->name) &&
        !empty($this->username) &&
        !empty($this->email) &&
        !empty($this->password) &&
        !empty($this->gender))
      {  
         $sql = "INSERT INTO " . $this->table_name . " (name,username,email,password,gender,created_at) VALUES
          ('$this->name','$this->username','$this->email','$this->password','$this->gender','$this->created_at=created_at')";
          $request = mysqli_query($this->conn, $sql);
        if(! $request ) {
            die('<div class="alert alert-danger">
                    <strong>'.mysqli_error($this->conn).' !</strong> 
                </div>');
        } 
        header("Location: $location?message= Success To Add User");
      } else {
        // tell the user
        header("Location: $location?error=Unable to insert item. Data is incomplete."); 
      }  
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
       $sql = "UPDATE " . $this->table_name . " SET
                name = '" . $this->name . "',
                username = '" . $this->username . "',
                email = '". $this->email . "',
                password = '". $this->password . "',
                gender = '". $this->gender . "',
                updated_at = '". $this->updated_at . "'
            WHERE id=$id";
      $request = mysqli_query($this->conn, $sql);
      if(! $request ) {
          die('<div class="alert alert-danger">
                  <strong>'.mysqli_error($this->conn).' !</strong> 
              </div>');
      } 
       header("Location:../dashLayout.php?message= Updated User Successfully");
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
      header("Location:../dashLayout.php?message= Delete User Successfully");
    }
}



    

