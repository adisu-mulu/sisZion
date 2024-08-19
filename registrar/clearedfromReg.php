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
        $assigned=$this->connect()->prepare("UPDATE clearancewithdraw SET registrar='cleared' where username='".$username."' and period= '".$period."'");
        $assigned->execute();

        if($assigned){

            header('location: clearancewithdraw.php?id=cleared');
        }

    }

}

$obj=new queries;
$obj->clearedFromFinance();

?><?php
/**
 * Created by PhpStorm.
 * User: kul_Hab
 * Date: 6/8/2019
 * Time: 8:07 AM
 */