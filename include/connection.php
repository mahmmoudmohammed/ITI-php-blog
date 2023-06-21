<?php
class Database
{
    // specify your own database credentials
    private $dbhost = 'localhost';
    private $dbuser = 'root';
    private $dbpass = '';
    private $dbname = 'blog';
    public $conn;
  
    // get the database connection
    public function getConnection()
    {
            $this->conn = null;
        try{
            $this->conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
         }
        catch(Exception $e)
        {
            echo " failed: " . $e->getMessage();
        }
        return $this->conn;
    }
} 
        
    ?>