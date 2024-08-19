<?php
/**
 * Created by PhpStorm.
 * User: kul_Hab
 * Date: 6/7/2019
 * Time: 11:07 PM
 */


include '../database.php';

class queries extends db{

    public function clearedFromFinance(){
        $username= $_GET['id'];
        $period= $_GET['prd'];
        $assigned=$this->connect()->prepare("UPDATE clearancewithdraw SET finance='cleared' where username='".$username."' and period= '".$period."'");
        $assigned->execute();

        if($assigned){

            header('location: clearanceWithdraw.php?id=cleared');
        }

    }

}

$obj=new queries;
$obj->clearedFromFinance();

?>