<?php
include_once '../../database.php';


class reject extends db{

public function removeFromFinance(){
	//print("am in remove function");

	$stmnt="DELETE FROM `pendingrequest` WHERE fname='".$_GET["id"]."'";
	if($this->connect()->exec($stmnt)){
		header('Location: ../pendingadmission.php');
	}
	else print("something went wrong");	
}
    
public function remove(){
	//print("am in remove function");

	$stmnt="DELETE FROM `pendingrequest` WHERE id='".$_GET["id"]."'";
	if($this->connect()->exec($stmnt)){
		header('Location: ../pendingadmission.php');
	}
	else print("something went wrong");	
}

}
$obj=new reject;
$obj->remove();
?>
