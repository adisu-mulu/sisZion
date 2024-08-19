<?php 
class DB {

private $conn;
private $servername = "127.0.0.1";
private $username = "root";
private $password = "";


public function connect(){
        try {
    $this->conn = new PDO("mysql:host=$this->servername;dbname=siszion", $this->username, $this->password);
    // set the PDO error mode to exception
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->conn;    
    print("Connected successfully") ; 
    }
        catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
 }
    

}
    
?>
