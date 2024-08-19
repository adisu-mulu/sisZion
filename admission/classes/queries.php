<?php
error_reporting();
session_start();
include_once '..//database.php';

class Queries extends db {

    public function insert($query, $cmd2){


        if($this->connect()->exec($query)){
            if($this->connect()->exec($cmd2))
                echo "a have executed";

        }
        else print("something is wrong");
    }
    
public function availableSeat($name){
    
    $stmnt= "SELECT * FROM pendingrequest where fchoice='".$name."'";
    $sql =$this->connect()->query($stmnt);
    $count= $sql->rowCount();
    if($count!==0){
    ?>
(<sup style="color: red" ;><?php echo $count;?>/250</sup>)
<?php
}
    else{
        ?>
(<i>0/250</i>)
<?php
    }
} 
}
	
?>
