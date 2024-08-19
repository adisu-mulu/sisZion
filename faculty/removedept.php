<?php
//include_once ('classes/queries.php');
include_once '../database.php';

class reject extends db{


    public function removeDept($prefix){
        print("am in remove function");

        $cmd=$this->connect()->prepare("UPDATE department SET status=0 where prefix='".$prefix."'");
        $cmd->execute();
        if($cmd){
//		header('Location: ../index.php');
            header('Location: index.php');
        }
        else print("something went wrong");
    }
}
$prefix= $_GET['id'];
$obj=new reject;
$obj->removeDept($prefix);

?>