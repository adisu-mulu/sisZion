<?php
include '../database.php';

$mydb= new db;
$conn=$mydb->connect();
$material= $conn->prepare("SELECT * from materials where path='".$_GET['id']."'");
$material->execute();
$result=$material->fetchAll();
foreach($result as $row){
    $materialPath= $_GET['id'];
   $path= "../materials/.$materialPath";
   header('content-Disposition: attachment; filename='.$path.'');
   header('content-type: application/octent-strem');
   header('content-length='.filesize($path));
   readfile($path);

}