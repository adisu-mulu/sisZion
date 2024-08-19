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



$cmd="insert into account(username,password,role,status,picname, name) values('$username','$password','$role','$status', '$picname','$name');";
$obj = new AdminQueries;
$obj->activateAccount($cmd);
header('Location: manageaccount2.php?value=activated');

?>