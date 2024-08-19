<?php
include 'classes/adminqueries.php';
session_start();
$Unhashedpassword= $_SESSION["password"];
$password=md5($Unhashedpassword);
$username= $_GET['id'];
$role= $_SESSION['role'];
$picname= $_SESSION['picname'];
$status="activated";
$name= $_SESSION['fname'].' '.$_SESSION['lname'];

echo $username;
echo $password;
echo $role;
echo $picname;


$cmd="UPDATE account SET password ='".$password."', status='activated' WHERE username= '".$username."'";
$obj = new AdminQueries;
$obj->updateAccount($cmd);
header('Location: manageaccount2.php?value=updated');

?>