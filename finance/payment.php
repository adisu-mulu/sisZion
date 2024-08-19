<?php
/**
 * Created by PhpStorm.
 * User: kul_Hab
 * Date: 6/7/2019
 * Time: 11:07 PM
 */


include '../database.php';

class queries extends db{

    public function insertPayment(){
        $username= $_GET['id'];
        $period= $_GET['prd'];

        $cmd="insert into academic_payment(username,period, status) values('$username','$period','Paid');";
        if($this->connect()->exec($cmd)){
          header('location: academic_payments.php?id=paid');

        }

    }

}

$obj=new queries;
$obj->insertPayment();

?>