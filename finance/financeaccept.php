<?php

include '../database.php';

class queries extends db{
    
    public function acceptedByFinance(){
        
          $fname;$lname;$email; $age; $studid;$dob;$sex;
        $maritalstatus;$region;$zone;$woreda;$dept;$section;
        $picname;

        $stmnt= $this->connect()->prepare("SELECT * FROM pendingrequest where studid='".$_GET['id']."'");
             $stmnt->execute();
             $result=$stmnt->fetchAll();
             
             foreach($result as $row){
                 $batch= substr( date('Y', strtotime($row['date'])),0);
                $this->fname= $row['fname']; $this->lname= $row['lname']; $this->email= $row['email'];
                $this->age= $row['age']; $this->dob= $row['dob']; $this->sex= $row['sex']; $this->maritalstatus= $row['maritalstatus']; $this->region= $row['region']; $this->zone= $row['zone']; $this->woreda= $row['woreda']; $this->dept= $row['studdept']; $this->section= $row['studsec']; $this->picname= $row['picname']; $this->studid=$row['studid'];
             }
             $cmd="insert into registeredstudents(username,fname,lname,email,age,dob,sex,maritalstatus,region,zone,woreda,dept,section,picname, batch) values('$this->studid','$this->fname','$this->lname','$this->email','$this->age', '$this->dob', '$this->sex', '$this->maritalstatus', '$this->region', '$this->zone', '$this->woreda','$this->dept', '$this->section', '$this->picname','$batch');";
             if($this->connect()->exec($cmd)){
                
                $stmnt="DELETE FROM `pendingrequest` WHERE studid='".$_GET['id']."'";
                if($this->connect()->exec($stmnt)){
                    
                header('Location: index.php?report="'.$_GET['id'].'"');

                }

             }
            
        }

}

$obj=new queries;
$obj->acceptedByFinance();

?>