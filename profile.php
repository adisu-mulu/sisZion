<?php
include_once 'database.php';
class Profile extends db{


 public function displayshort($path, $tbname, $username){

 	$query = "SELECT `picname` FROM `".$tbname."` WHERE `username`='$username'";
 	$sql =$this->connect()->query($query);
 	$this->path= $path;
 	$result=$sql->fetch(PDO::FETCH_ASSOC);
 		//echo $result['picname']; echo"<br>";
     
 		?>
<img height="50" width="50" class="img-circle" src="<?php echo $path.$result['picname']?>" style="border-radius: 15px;">
<?php
 }
  public function displayshortForPendingRequest($path, $tbname, $username){

 	$query = "SELECT `picname` FROM `".$tbname."` WHERE `id`='$username'";
 	$sql =$this->connect()->query($query);
 	$this->path= $path;
 	$result=$sql->fetch(PDO::FETCH_ASSOC);
 		//echo $result['picname']; echo"<br>";
     
 		?>
<img height="50" width="50" class="img-circle" src="<?php echo $path.$result['picname']?>" style="border-radius: 15px;">
<?php
 }

public function displaylong($path, $tbname, $username){

    $query = "SELECT * FROM `".$tbname."` WHERE `username`='$username'";
    $sql =$this->connect()->query($query);
    $this->path= $path;
    $result=$sql->fetch(PDO::FETCH_ASSOC);
        
        ?>
<img height="150" width="180" src="<?php echo $path.$result['picname']?>"><br>
<i style='color: white;'><?php echo $result['name']?></i>
<?php         
 }
// function displays username
 public function profileImageName($path, $tbname, $username){

    $query = "SELECT * FROM `".$tbname."` WHERE `username`='$username'";
    $sql =$this->connect()->query($query);
    $this->path= $path;
    $result=$sql->fetch(PDO::FETCH_ASSOC);
        
        ?>

<i style='color: black;'><?php echo $result['name']?></i>
<?php         
 }


public function retrieveStaffUname(){

    $query = "SELECT * FROM staff WHERE username ='$username'";
    $sql =$this->connect()->query($query);
    $this->path= $path;
    $result=$sql->fetch(PDO::FETCH_ASSOC);
        
        ?>

<i style='color: black;'><?php echo $result['name']?></i>
<?php         
 }

}

?>
