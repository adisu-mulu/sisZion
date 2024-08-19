<?php
include '..//database.php';

class AdminQueries extends db{
    
   public function activateAccount($stmt){
       
        if($this->connect()->exec($stmt)){
          echo "query successful";
      }
    else print("something is wrong");     
   } 

   public function deactivateAccount($stmt){
       
        if($this->connect()->exec($stmt)){
          echo "query successful";
      }
    else print("something is wrong"); 
       
   } 
public function updateAccount($stmt){
       
        if($this->connect()->exec($stmt)){
          echo "query successful";
      }
    else print("something is wrong"); 
       
   } 
    
}
?>