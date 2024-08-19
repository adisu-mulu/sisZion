<?php


if(isset($_POST['submit'])){
$id=$_POST['assignID'];
$dept=$_POST['assignDept'];
$section=$_POST['assignSec'];
$studname= $_GET['id'];
$sent='sent';
$obj= new approve;
$obj->approved($id, $dept, $section,$sent);
}


class approve{

	private $conn;
private $servername = "localhost";
private $username = "root";
private $password = "";
	
	

	private $id; private $dept; private $section; private $studname; private $sent;

	public function approved($id, $dept, $section, $sent)
	{
		

		try {
    $this->conn = new PDO("mysql:host=$this->servername;dbname=siszion", $this->username, $this->password);
    // set the PDO error mode to exception
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    print("Connected successfully") ; 
    }
        catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    	$this->sent=$sent;

		$this->id= $id; $this->dept= $dept; $this->section= $section;  
		$cmd="UPDATE `pendingrequest` SET `studid`=:id,`studdept`=:dept,`studsec`=:section, `sent`=:sent  WHERE fname=:studname";
		$res=$this->conn->prepare($cmd);
		$result=$res->execute(array(":id"=>$id,":dept"=>$dept,":section"=>$section, ":sent"=>$sent, ":studname"=>$_GET['id']));
    
    
    if($result){
      //print("updated");
    header("Location: ../registrar/pendingrequests/accept.php?id=Sent to finance for registration payment");
    }
    else{   
        
        print("unsuccessfulll");
    }
}
}
			


?>