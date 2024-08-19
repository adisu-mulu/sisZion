<?php
include 'classes/adminqueries.php';
session_start();
$password= $_SESSION['password'];
$username= $_GET['id'];
$role= $_SESSION['role'];
$picname= $_SESSION['picname'];
$status="activated";
$name= $_SESSION['fname'].' '.$_SESSION['lname'];

echo $username;
echo $password;
echo $role;
echo $picname;


$cmd="UPDATE account SET status ='deactivated' WHERE username= '".$username."'";
$obj = new AdminQueries;
$obj->deactivateAccount($cmd);
header('Location: manageaccount2.php?value=deactivated');

?>