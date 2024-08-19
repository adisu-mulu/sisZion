<?php
//include_once ('classes/queries.php');
include_once '../database.php';

class reject extends db{


    public function removeCourse($prefix){

        $cmd=$this->connect()->prepare("UPDATE coursebank SET status=0 where coursecode='".$prefix."'");
        $cmd->execute();
    header('location: curriculum.php');
    }
}
$prefix= $_GET['id'];
$obj=new reject;
$obj->removeCourse($prefix);

?>