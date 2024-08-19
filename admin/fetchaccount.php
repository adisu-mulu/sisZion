<?php
session_start();
class manageAccount{

private $conn;
private $servername = "127.0.0.1";
private $username = "root";
private $password = "";

public function __construct(){
	 try {
    $this->conn = new PDO("mysql:host=$this->servername;dbname=siszion", $this->username, $this->password);
    // set the PDO error mode to exception
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //print("Connected successfully") ; 
    }
        catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
}

public function activateAccount($staffuname, $studid){
	$this->staffuname= $staffuname; $this->studid= $studid;
// when both account is selected
	if($staffuname !='' && $studid!=''){
        echo "<h3><i style='color: red;'>Please choose one account</i></h3>";
	}
	//when no account is selected

	else if($staffuname =='' && $studid==''){

        $stmnt= $this->conn->prepare("SELECT * FROM registeredstudents where username not in (select username from account)");
        $_SESSION['role']="student";

    }
	// when staff account is selected
	else if($staffuname!='' && $studid=='') {
        $stmnt= $this->conn->prepare("SELECT * FROM staff where username='".$staffuname."'");
        $stmnt->execute();
        $result=$stmnt->fetchAll();
        foreach($result as $row) {
            $_SESSION['role'] = $row['role'];
        }
    }
    else{
        $stmnt= $this->conn->prepare("SELECT * FROM registeredstudents where username='".$studid."'");
        $_SESSION['role']='student';

    }
		?>

<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../layout.css">
<table style="border: 1px solid #dddddd;">
    <tr>
        <th style="background-color: gray;">Username</th>
        <th style="background-color: gray;">Password</th>
        <th style="background-color: gray;">Email</th>
        <th style="background-color: gray;">Role</th>
        <th style="background-color: gray;">Profile</th>
        <th style="background-color: gray;">Action</th>

    </tr>
    <?php
             $stmnt->execute();
             if($stmnt->rowCount()==0)
             	echo "<h3><i style='color: red;'>No account found</i></h3>";

             $result=$stmnt->fetchAll();
             foreach($result as $row){

             	$_SESSION['picname']=$row['picname'];
                $_SESSION['fname']=$row['fname'];
                $_SESSION['lname']=$row['lname'];
            ?>

    <tr>
        <td><i><?php echo $row['username'];?></i></td>
        <td><i><?php 
       $pass=new manageAccount;
       echo $pass->randomPassword();
       ?></i></td>
        <td><i><?php echo $row['email'];?></i></td>
        <td><i><?php echo $_SESSION['role'];?></i></td>
        <td>
            <?php 
                $path="../uploads/";
              
                $con= new Profile;
                $con->displayshort($path,"staff", $row['username']);
           ?>
        </td>
        <td><a href="activateaccountform.php?id=<?php echo $row['username'];?>"><i>Activate</i></a></td>

    </tr>
    <?php
}?>
</table>
<?php

	}


// function to update a password
    public function updatePassword($staffuname, $studid){
    $this->staffuname= $staffuname; $this->studid= $studid;
// when both account is selected
    if($staffuname !='' && $studid!=''){
        echo "<h3><i style='color: red;'>Please choose only one account</i></h3>";
    }
    //when no account is selected

    else if($staffuname =='' && $studid==''){
        echo "<h3><i style='color: red;'>Please choose one account</i></h3>";
    }
    // when staff account is selected
    else if($staffuname!='' && $studid==''){
        ?>

<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../layout.css">
<table style="border: 1px solid #dddddd;">
    <tr>
        <th style="background-color: gray;">Username</th>
        <th style="background-color: gray;">Password</th>
        <th style="background-color: gray;">Email</th>
        <th style="background-color: gray;">Role</th>
        <th style="background-color: gray;">Profile</th>
        <th style="background-color: gray;">Action</th>

    </tr>
    <?php 
             $stmnt= $this->conn->prepare("SELECT * FROM staff where username='".$staffuname."'");
             $stmnt->execute();
             if($stmnt->rowCount()==0)
                echo "<h3><i style='color: red;'>No account found</i></h3>";

             $result=$stmnt->fetchAll();
             foreach($result as $row){
                $_SESSION['role']= $row['role'];
                $_SESSION['picname']=$row['picname'];
                $_SESSION['fname']=$row['fname'];
                $_SESSION['lname']=$row['lname'];
            ?>

    <tr>
        <td><i><?php echo $row['username'];?></i></td>
        <td><i><?php 
       $pass=new manageAccount;
       echo $pass->randomPassword();
       ?></i></td>
        <td><i><?php echo $row['email'];?></i></td>
        <td><i><?php echo $row['role'];?></i></td>
        <td>
            <?php 
                $path="../uploads/";
              
                $con= new queries;
                $con->displayshort($path,"staff", $row['username']);
           ?>
        </td>
        <td><a href="updatepasswordform.php?id=<?php echo $row['username'];?>"><i>Update</i></a></td>

    </tr>
    <?php
}?>
</table>
<?php       
    }


    //when student account has been selected
    else if($studid!='' && $username==''){
        ?>

<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../layout.css">
<table style="border: 1px solid #dddddd;">
    <tr>
        <th style="background-color: gray;">Student ID</th>
        <th style="background-color: gray;">Password</th>
        <th style="background-color: gray;">Email</th>
        <th style="background-color: gray;">Department</th>
        <th style="background-color: gray;">Section</th>
        <th style="background-color: gray;">Profile</th>
        <th style="background-color: gray;">Action</th>

    </tr>
    <?php 
             $stmnt= $this->conn->prepare("SELECT * FROM registeredstudents where username='".$studid."'");
             $stmnt->execute();
             if($stmnt->rowCount()==0)
                echo "<h3><i style='color: red;'>No account found</i></h3>";
             $result=$stmnt->fetchAll();

             foreach($result as $row){
                $_SESSION['role']="student";
             $_SESSION['picname']= $row['picname'];
             $_SESSION['fname']=$row['fname'];
             $_SESSION['lname']=$row['lname'];
               
            ?>

    <tr>
        <td><i><?php echo $row['username'];?></i></td>
        <td><i><?php 
       $pass=new manageAccount;
       echo $pass->randomPassword();
       ?></i></td>
        <td><i><?php echo $row['email'];?></i></td>
        <td><i><?php echo $row['dept'];?></i></td>
        <td><i><?php echo $row['section'];?></i></td>
        <td>
            <?php 
                $path="../uploads/";
              
                $con= new Profile;
                $con->displayshort($path,"staff", $row['username']);
           ?>
        </td>
        <td><a href="updatepasswordform.php?id=<?php echo $row['username'];?>"><i>Update</i></a></td>

    </tr>
    <?php
}?>
</table>
<?php       
    }
}
// function to deactivate account

public function deactivateaccount($staffuname, $studid){
    $this->staffuname= $staffuname; $this->studid= $studid;
// when both account is selected
    if($staffuname !='' && $studid!=''){
        echo "<h3><i style='color: red;'>Please choose only one account</i></h3>";
    }
    //when no account is selected

    else if($staffuname =='' && $studid==''){
        echo "<h3><i style='color: red;'>Please choose one account</i></h3>";
    }
    // when staff account is selected
    else if($staffuname!='' && $studid==''){
        ?>

<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../layout.css">
<table style="border: 1px solid #dddddd;">
    <tr>
        <th style="background-color: gray;">Username</th>
        <th style="background-color: gray;">Password</th>
        <th style="background-color: gray;">Email</th>
        <th style="background-color: gray;">Role</th>
        <th style="background-color: gray;">Profile</th>
        <th style="background-color: gray;">Action</th>

    </tr>
    <?php 
             $stmnt= $this->conn->prepare("SELECT * FROM staff where username='".$staffuname."'");
             $stmnt->execute();
             if($stmnt->rowCount()==0)
                echo "<h3><i style='color: red;'>No account found</i></h3>";

             $result=$stmnt->fetchAll();
             foreach($result as $row){
                $_SESSION['role']= $row['role'];
                $_SESSION['picname']=$row['picname'];
                $_SESSION['fname']=$row['fname'];
                $_SESSION['lname']=$row['lname'];
            ?>

    <tr>
        <td><i><?php echo $row['username'];?></i></td>
        <td><i><?php 
       $pass=new manageAccount;
       echo $pass->randomPassword();
       ?></i></td>
        <td><i><?php echo $row['email'];?></i></td>
        <td><i><?php echo $row['role'];?></i></td>
        <td>
            <?php 
                $path="../uploads/";
              
                $con= new Profile;
                $con->displayshort($path,"staff", $row['username']);
           ?>
        </td>
        <td><a href="deactivateaccountform.php?id=<?php echo $row['username'];?>"><i>Deactivate</i></a></td>

    </tr>
    <?php
}?>
</table>
<?php       
    }


    //when student account has been selected
    else if($studid!='' && $username==''){
        ?>

<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../layout.css">
<table style="border: 1px solid #dddddd;">
    <tr>
        <th style="background-color: gray;">Student ID</th>
        <th style="background-color: gray;">Password</th>
        <th style="background-color: gray;">Email</th>
        <th style="background-color: gray;">Department</th>
        <th style="background-color: gray;">Section</th>
        <th style="background-color: gray;">Profile</th>
        <th style="background-color: gray;">Action</th>

    </tr>
    <?php 
             $stmnt= $this->conn->prepare("SELECT * FROM registeredstudents where username='".$studid."'");
             $stmnt->execute();
             if($stmnt->rowCount()==0)
                echo "<h3><i style='color: red;'>No account found</i></h3>";
             $result=$stmnt->fetchAll();

             foreach($result as $row){
                $_SESSION['role']="student";
             $_SESSION['picname']= $row['picname'];
             $_SESSION['fname']=$row['fname'];
             $_SESSION['lname']=$row['lname'];
               
            ?>

    <tr>
        <td><i><?php echo $row['username'];?></i></td>
        <td><i><?php 
       $pass=new manageAccount;
       echo $pass->randomPassword();
       ?></i></td>
        <td><i><?php echo $row['email'];?></i></td>
        <td><i><?php echo $row['dept'];?></i></td>
        <td><i><?php echo $row['section'];?></i></td>
        <td>
            <?php 
                $path="../uploads/";
              
                $con= new Profile;
                $con->displayshort($path,"registeredstudents", $row['username']);
           ?>
        </td>
        <td><a href="deactivateaccountform.php?id=<?php echo $row['username'];?>"><i>Deactivate</i></a></td>

    </tr>
    <?php
}?>
</table>
<?php       
    }

}

public function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 15; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    $_SESSION['password']= implode($pass);

    return implode($pass); //turn the array into a string
}
}
?>
