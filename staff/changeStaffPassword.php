<?php
/**
 * Created by PhpStorm.
 * User: kul_Hab
 * Date: 6/11/2019
 * Time: 12:39 PM
 */
error_reporting();

include_once '../database.php';
include_once '../profile.php';

class Queries extends db{
public function changeStaffPassword(){

    $username= $_SESSION['uname'];
    $oldPass= $_POST['oldPassword'];
    $newPassword=$_POST['newPassword'];
    $confirmPassword=$_POST['confirmPassword'];
    $hashedPassword= md5($newPassword);

    $stmnt= $this->connect()->prepare("SELECT * FROM account where username='".$username."' and password='".$oldPass."'");
    $stmnt->execute();
    if($stmnt->rowCount()>0){
        if($confirmPassword==$newPassword) {
            $insertNewPassword = $this->connect()->prepare("UPDATE account SET password='" . $hashedPassword . "' where username='" . $username . "'");
            $insertNewPassword->execute();
            echo "<script>alert('Password changed successfully');</script>";
        }else   echo "<script>alert('Passwords don\'t match');</script>";
    }
    else  echo "<script>alert('Your old password is not correct');</script>";
}}