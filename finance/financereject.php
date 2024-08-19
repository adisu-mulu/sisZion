<?php
//include_once ('classes/queries.php');
include_once '../database.php';

class reject extends db{
    
    
    public function removeFromFinance(){
	print("am in remove function");

	$stmnt="DELETE FROM pendingrequest WHERE studid='".$_GET['id']."'";
	if($this->connect()->exec($stmnt)){
//		header('Location: ../index.php');
        header('Location: index.php');
	}
	else print("something went wrong");	
}
}

$obj=new reject;
$obj->removeFromFinance();

?>