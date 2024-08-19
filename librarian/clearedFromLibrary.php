<?php
/**
 * Created by PhpStorm.
 * User: kul_Hab
 * Date: 6/7/2019
 * Time: 11:07 PM
 */


include '../database.php';

class queries extends db{

    public function clearLibrary(){
        $username= $_GET['id'];
        $period= $_GET['prd'];

        $cmd="insert into clearancewithdraw(username,period, library, finance, registrar) values('$username','$period','cleared', '','');";
        if($this->connect()->exec($cmd)){
            echo "<script>alert('Cleared from library');</script>";
            header('location: index.php?id=cleared');

        }

    }

}

$obj=new queries;
$obj->clearLibrary();

?>