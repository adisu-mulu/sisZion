<?php
error_reporting(0);

include_once '..//database.php';
include_once '..//profile.php';

class Queries extends db {

public function insert($query){
    
    
    if($this->connect()->exec($query)){}
    else print("something is wrong");   
}
public function update($query){

}
public function delete ($query){

}

public function requestcount(){
    
    $stmnt= "SELECT * FROM pendingrequest where sent=''";
    $sql =$this->connect()->query($stmnt);
    $count= $sql->rowCount();
   
    ?>
<sup style="color: red" ;><?php echo $count;?></sup>
<?php

}


//function fetches admission requests that have been sent to the registrar
public function fetchrequest(){
        ?>
<br><br>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../layout.css">
<table style="border: 1px solid #dddddd;">
    <tr>
        <th style="background-color: gray;">First Name</th>
        <th style="background-color: gray;">Last Name</th>
        <th style="background-color: gray;">Email</th>
        <th style="background-color: gray;">Gender</th>
        <th style="background-color: gray;">First Choice</th>
        <th style="background-color: gray;">Second Choice</th>
        <th style="background-color: gray;">Third Choice</th>
        <th style="background-color: gray;">Assigned Department</th>

        <th style="background-color: gray;">Profile</th>
        <th style="background-color: gray; text-align: center;" colspan="2">Action</th>

    </tr>

    <?php 
             $stmnt= $this->connect()->prepare("SELECT * FROM pendingrequest where sent='' ORDER BY date ASC");
             $stmnt->execute();
             $result=$stmnt->fetchAll();
            
             foreach($result as $row){
               if($row['studdept']==' '){
            ?>

    <tr>
        <td><i><?php echo $row['fname'];?></i></td>
        <td><i><?php echo $row['lname'];?></i></td>
        <td><i><?php echo $row['email'];?></i></td>
        <td><i><?php echo $row['sex'];?></i></td>
        <td><i><?php echo $row['fchoice'];?></i></td>
        <td><i><?php echo $row['schoice'];?></i></td>
        <td><i><?php echo $row['tchoice'];?></i></td>
        <td><i><?php echo $row['studdept'];?></i></td>
        <td>
            <?php 
                $path="..//uploads/";
                $con= new Profile;
                $con->displayshortForPendingRequest($path,"pendingrequest", $row['id']);
                ?>
        </td>
        <td><a href="pendingrequests/viewdoc.php?id=<?php echo $row['id'];?>"><i>Detail</i></a></td>
        <td><a href="pendingrequests/reject.php?id=<?php echo $row['id']?>"><i>Reject</i></a></td>
    </tr>
    <?php
} 
             
             else {
                 
                 ?>

    <tr>
        <td><i><?php echo $row['fname'];?></i></td>
        <td><i><?php echo $row['lname'];?></i></td>
        <td><i><?php echo $row['email'];?></i></td>
        <td><i><?php echo $row['sex'];?></i></td>
        <td><i><?php echo $row['fchoice'];?></i></td>
        <td><i><?php echo $row['schoice'];?></i></td>
        <td><i><?php echo $row['tchoice'];?></i></td>
        <td><i><?php echo $row['studdept'];?></i></td>
        <td>
            <?php 
                $path="..//uploads/";
                $con= new Profile;
                $con->displayshortForPendingRequest($path,"pendingrequest", $row['id']);
                ?>
        </td>
        <td><a href="pendingrequests/viewdoc.php?id=<?php echo $row['id'];?>"><i>Detail</i></a></td>
        <td><a href="pendingrequests/reject.php?id=<?php echo $row['id']?>"><i>Reject</i></a></td>
    </tr>
    <?php 
             }
             
             }?>
</table>
<?php       
}
  
    public function allocateDepartment(){
       
            
               $check= "SELECT * FROM pendingrequest where studdept=''";
    $results =$this->connect()->query($check);
   
            if($results->rowCount()==0){
                echo "<script> alert('department allocation already done');</script>";
                
            }
        else
        {
            
             $stmnt= $this->connect()->prepare("SELECT * FROM pendingrequest where sent='' ORDER BY date ASC");
             $stmnt->execute();
             $result=$stmnt->fetchAll();
            
            
             foreach($result as $row){
                //first choice
                $sqlfirst="select count from seat where dept='".$row['fchoice']."'";
                $queryfirst=$this->connect()->query($sqlfirst);
                $resfirst=$queryfirst->fetch(PDO::FETCH_ASSOC);
                $firstcount=$resfirst['count'];
                 
                 //second choice
                 $sqlsecond="select count from seat where dept='".$row['schoice']."'";
                $querysecond=$this->connect()->query($sqlsecond);
                $ressecond=$querysecond->fetch(PDO::FETCH_ASSOC);
                $secondcount=$ressecond['count'];
                 //third choice
                  $sqlthird="select count from seat where dept='".$row['tchoice']."'";
                $querythird=$this->connect()->query($sqlthird);
                $resthird=$querythird->fetch(PDO::FETCH_ASSOC);
                $thirdcount=$resthird['count'];
                 //conditions
                 
                 if($firstcount < 2){
        $cmd=$this->connect()->prepare("UPDATE pendingrequest SET studdept='".$row['fchoice']."' where id='".$row['id']."'");
		$cmd->execute();
           if($cmd){ 
               ++$firstcount;
		$cmd2=$this->connect()->prepare("UPDATE seat SET count='".$firstcount."' where dept='".$row['fchoice']."'");
		$cmd2->execute();
               if($cmd2){
                    
               }
           }
                 }
                
                 else if($secondcount < 2){
        $cmd=$this->connect()->prepare("UPDATE pendingrequest SET studdept='".$row['schoice']."' where id='".$row['id']."'");
		$cmd->execute();
           if($cmd){ 
               ++$secondcount;
		$cmd2=$this->connect()->prepare("UPDATE seat SET count='".$secondcount."' where dept='".$row['schoice']."'");
		$cmd2->execute();
               if($cmd2){
                     
               }
           }
                 }
               
                 else if($thirdcount < 2){
        $cmd=$this->connect()->prepare("UPDATE pendingrequest SET studdept='".$row['tchoice']."' where id='".$row['id']."'");
		$cmd->execute();
           if($cmd){ 
               ++$thirdcount;
		$cmd2=$this->connect()->prepare("UPDATE seat SET count='".$thirdcount."' where dept='".$row['tchoice']."'");
		$cmd2->execute();
               if($cmd2){
                     
               }
           }
                 }
                
                 else 
                 {
                     echo "not allocated";
                 }
             }
        }
       
    }
    
    public function assignedDepartment(){
        ?>
<br><br>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../layout.css">
<table style="border: 1px solid #dddddd; width: 90%;">
    <tr>
        <th style="background-color: gray;">First Name</th>
        <th style="background-color: gray;">Last Name</th>
        <th style="background-color: gray;">Email</th>
        <th style="background-color: gray;">Gender</th>
        <th style="background-color: gray;">Assigned Department</th>
        <th style="background-color: gray;">Profile</th>
        <th style="background-color: gray; text-align: center;" colspan="2">Action</th>

    </tr>

    <?php 
             $stmnt= $this->connect()->prepare("SELECT * FROM pendingrequest where sent=''");
             $stmnt->execute();
             $result=$stmnt->fetchAll();
             foreach($result as $row){
               
            ?>

    <tr>
        <td><i><?php echo $row['fname'];?></i></td>
        <td><i><?php echo $row['lname'];?></i></td>
        <td><i><?php echo $row['email'];?></i></td>
        <td><i><?php echo $row['sex'];?></i></td>
        <td><i><?php echo $row['studdept'];?></i></td>

        <td>
            <?php 
                $path="..//uploads/";
                $con= new Profile;
                $con->displayshortForPendingRequest($path,"pendingrequest", $row['id']);
                ?>
        </td>
        <td><a href="pendingrequests/viewdoc.php?id=<?php echo $row['id'];?>"><i>Detail</i></a></td>
        <td><a href="pendingrequests/reject.php?id=<?php echo $row['id']?>"><i>Reject</i></a></td>
    </tr>
    <?php
}?>
</table>
<?php       
}
    
    
        public function selectedDepartment($dept){
        ?>
<br><br>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../layout.css">
<table style="border: 1px solid #dddddd; width: 90%;">
    <tr>
        <th style="background-color: gray;">First Name</th>
        <th style="background-color: gray;">Last Name</th>
        <th style="background-color: gray;">Email</th>
        <th style="background-color: gray;">Gender</th>
        <th style="background-color: gray;">Assigned Department</th>
        <th style="background-color: gray;">Profile</th>
        <th style="background-color: gray; text-align: center;" colspan="2">Action</th>

    </tr>

    <?php 
             $stmnt= $this->connect()->prepare("SELECT * FROM pendingrequest where studdept='".$dept."'");
             $stmnt->execute();
             $result=$stmnt->fetchAll();
             foreach($result as $row){
               
            ?>

    <tr>
        <td><i><?php echo $row['fname'];?></i></td>
        <td><i><?php echo $row['lname'];?></i></td>
        <td><i><?php echo $row['email'];?></i></td>
        <td><i><?php echo $row['sex'];?></i></td>
        <td><i><?php echo $row['studdept'];?></i></td>

        <td>
            <?php 
                $path="..//uploads/";
                $con= new Profile;
                $con->displayshortForPendingRequest($path,"pendingrequest", $row['id']);
                ?>
        </td>
        <td><a href="pendingrequests/viewdoc.php?id=<?php echo $row['id'];?>"><i>Detail</i></a></td>
        <td><a href="pendingrequests/reject.php?id=<?php echo $row['id']?>"><i>Reject</i></a></td>
    </tr>
    <?php
}?>
</table>
<?php       
}
    

    public function generateId(){
        
       
        $stmnt= $this->connect()->prepare("SELECT * FROM department");
           $stmnt->execute();
           $result=$stmnt->fetchAll();
        foreach($result as $row){
            $selectdept= $this->connect()->prepare("SELECT * FROM pendingrequest where studdept='".$row['name']."' order by fname");
            $selectdept->execute();
            $selectdeptresult=$selectdept->fetchAll();
            $count=1;
           
            foreach($selectdeptresult as $selectdeptrow){
                
                
              $batch= substr( date('Y', strtotime($selectdeptrow['date'])),2);
                if($count<10){
                $id=$row['prefix']."/00".$count++."/".$batch;  
                $cmd=$this->connect()->prepare("UPDATE pendingrequest SET studid='".$id."' where id='".$selectdeptrow['id']."'");
		        $cmd->execute();
                 
              }  
                else if($count>9 && $count<100){
                $id=$row['prefix']."/0".$count++."/".$batch;  
                $cmd=$this->connect()->prepare("UPDATE pendingrequest SET studid='".$id."' where id='".$selectdeptrow['id']."'");
		        $cmd->execute();
            }
            
            else{
                $id=$row['prefix']."/".$count++."/".$batch;  
                $cmd=$this->connect()->prepare("UPDATE pendingrequest SET studid='".$id."' where id='".$selectdeptrow['id']."'");
		        $cmd->execute();
                    
                 } 
                
            }
    }
        $obj=new queries;
        $obj->displayStudentId();

    }
    
    public function noOfAssignedStudents($name){
    
    $stmnt= "SELECT * FROM pendingrequest where studdept='".$name."'";
    $sql =$this->connect()->query($stmnt);
    $count= $sql->rowCount();
    
      return $count; 
}
    
   public function displayStudentId(){
       
        ?>
<br><br>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../layout.css">
<table style="border: 1px solid #dddddd; width: 90%;">
    <tr>
        <th style="background-color: gray;">Student ID</th>
        <th style="background-color: gray;">First Name</th>
        <th style="background-color: gray;">Last Name</th>
        <th style="background-color: gray;">Email</th>
        <th style="background-color: gray;">Gender</th>
        <th style="background-color: gray;">Assigned Department</th>
        <th style="background-color: gray;">Profile</th>
        <th style="background-color: gray; text-align: center;" colspan="2">Action</th>

    </tr>

    <?php 
             $stmnt= $this->connect()->prepare("SELECT * FROM pendingrequest where sent=''");
             $stmnt->execute();
             $result=$stmnt->fetchAll();
             foreach($result as $row){
               
            ?>

    <tr>
        <td><i><?php echo $row['studid'];?></i></td>
        <td><i><?php echo $row['fname'];?></i></td>
        <td><i><?php echo $row['lname'];?></i></td>
        <td><i><?php echo $row['email'];?></i></td>
        <td><i><?php echo $row['sex'];?></i></td>
        <td><i><?php echo $row['studdept'];?></i></td>

        <td>
            <?php 
                $path="..//uploads/";
                $con= new Profile;
                $con->displayshortForPendingRequest($path,"pendingrequest", $row['id']);
                ?>
        </td>
        <td><a href="pendingrequests/viewdoc.php?id=<?php echo $row['id'];?>"><i>Detail</i></a></td>
        <td><a href="pendingrequests/reject.php?id=<?php echo $row['id']?>"><i>Reject</i></a></td>
    </tr>
    <?php
}?>
</table>
<?php
       
   }
     public function displayStudentsWithId($dept){
       
        ?>
<br><br>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../layout.css">
<table style="border: 1px solid #dddddd; width: 90%;">
    <tr>
        <th style="background-color: gray;">Student ID</th>
        <th style="background-color: gray;">First Name</th>
        <th style="background-color: gray;">Last Name</th>
        <th style="background-color: gray;">Email</th>
        <th style="background-color: gray;">Gender</th>
        <th style="background-color: gray;">Assigned Department</th>
        <th style="background-color: gray;">Profile</th>
        <th style="background-color: gray; text-align: center;" colspan="2">Action</th>

    </tr>

    <?php 
             $stmnt= $this->connect()->prepare("SELECT * FROM pendingrequest where studdept='".$dept."'");
             $stmnt->execute();
             $result=$stmnt->fetchAll();
             foreach($result as $row){
               
            ?>

    <tr>
        <td><i><?php echo $row['studid'];?></i></td>
        <td><i><?php echo $row['fname'];?></i></td>
        <td><i><?php echo $row['lname'];?></i></td>
        <td><i><?php echo $row['email'];?></i></td>
        <td><i><?php echo $row['sex'];?></i></td>
        <td><i><?php echo $row['studdept'];?></i></td>

        <td>
            <?php 
                $path="..//uploads/";
                $con= new Profile;
                $con->displayshortForPendingRequest($path,"pendingrequest", $row['id']);
                ?>
        </td>
        <td><a href="pendingrequests/viewdoc.php?id=<?php echo $row['id'];?>"><i>Detail</i></a></td>
        <td><a href="pendingrequests/reject.php?id=<?php echo $row['id']?>"><i>Reject</i></a></td>
    </tr>
    <?php
}?>
</table>
<?php
       
   }
    
    public function assignSection($dept, $NoOfSection){
         $obj=new queries;
        $NoOfStudents=$obj->noOfAssignedStudents($dept);
        $interim=$NoOfStudents/$NoOfSection;
        $perSection = ceil($interim); 
        $section=1;
        $NoOfStud=1;
       // echo "students per section "; echo $perSection;
         $stmnt= $this->connect()->prepare("SELECT * FROM pendingrequest where studdept='".$dept."'");
            $stmnt->execute();
            $result=$stmnt->fetchAll();
        foreach($result as $row){
            
            if($section<=$NoOfSection){
                
                 $cmd=$this->connect()->prepare("UPDATE pendingrequest SET studsec='".$section."', sent='sent' where id='".$row['id']."'");
                 $cmd->execute();
                $section++;
            }
            else {
                $section=1;
                 $cmd=$this->connect()->prepare("UPDATE pendingrequest SET studsec='".$section."', sent='sent' where id='".$row['id']."'");
                 $cmd->execute();
                $section++;
                
            }

    }
        $assigned=$this->connect()->prepare("UPDATE seat SET section='assigned' where dept='".$dept."'");
        $assigned->execute();
     
}
    
    public function displayStudentsSection($dept){
        
                ?>
<br><br>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../layout.css">
<table style="border: 1px solid #dddddd; width: 90%;">
    <tr>
        <th style="background-color: gray;">Student ID</th>
        <th style="background-color: gray;">First Name</th>
        <th style="background-color: gray;">Last Name</th>
        <th style="background-color: gray;">Email</th>
        <th style="background-color: gray;">Gender</th>
        <th style="background-color: gray;">Assigned Department</th>
        <th style="background-color: gray;">Assigned Section</th>

        <th style="background-color: gray;">Profile</th>
        <th style="background-color: gray; text-align: center;" colspan="2">Action</th>

    </tr>

    <?php 
             $stmnt= $this->connect()->prepare("SELECT * FROM pendingrequest where studdept='".$dept."'");
             $stmnt->execute();
             $result=$stmnt->fetchAll();
             foreach($result as $row){
               
            ?>
    <tr>
        <td><i><?php echo $row['studid'];?></i></td>
        <td><i><?php echo $row['fname'];?></i></td>
        <td><i><?php echo $row['lname'];?></i></td>
        <td><i><?php echo $row['email'];?></i></td>
        <td><i><?php echo $row['sex'];?></i></td>
        <td><i><?php echo $row['studdept'];?></i></td>
        <td><i><?php echo $row['studsec'];?></i></td>
        <td>
            <?php 
                $path="..//uploads/";
                $con= new Profile;
                $con->displayshortForPendingRequest($path,"pendingrequest", $row['id']);
                ?>
        </td>
        <td><a href="pendingrequests/viewdoc.php?id=<?php echo $row['id'];?>"><i>Detail</i></a></td>
        <td><a href="pendingrequests/reject.php?id=<?php echo $row['id']?>"><i>Reject</i></a></td>
    </tr>
    <?php
}?>
</table>
<?php
    }
    
    // changes the department of a particular student
    public function changeStudDept($id)
    {
        
     ?>
<br><br>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../layout.css">
<table style="border: 1px solid #dddddd; width: 90%;">
    <tr>
        <th style="background-color: gray;">Student ID</th>
        <th style="background-color: gray;">First Name</th>
        <th style="background-color: gray;">Last Name</th>
        <th style="background-color: gray;">Email</th>
        <th style="background-color: gray;">Gender</th>
        <th style="background-color: gray;">Assigned Department</th>
        <th style="background-color: gray;">Section</th>
        <th style="background-color: gray;">Profile</th>
        <th style="background-color: gray; text-align: center;" colspan="2">Action</th>

    </tr>

    <?php 
             $stmnt= $this->connect()->prepare("SELECT * FROM registeredstudents where username like '%".$id."%' or fname like '%".$id."%'");
             $stmnt->execute();
             $result=$stmnt->fetchAll();
             foreach($result as $row){
               
            ?>

    <tr>
        <td><i><?php echo $row['username'];?></i></td>
        <td><i><?php echo $row['fname'];?></i></td>
        <td><i><?php echo $row['lname'];?></i></td>
        <td><i><?php echo $row['email'];?></i></td>
        <td><i><?php echo $row['sex'];?></i></td>
        <td><i><?php echo $row['dept'];?></i></td>
        <td><i><?php echo $row['section'];?></i></td>

        <td>
            <?php 
                $path="..//uploads/";
                $con= new Profile;
                $con->displayshort($path,"registeredstudents", $row['username']);
                ?>
        </td>
        <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModals" style="padding: 5px 10px 5px 10px; border: 1px solid white;">Edit</button></td>
        <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModals" style="padding: 5px 10px 5px 10px; background-color: red; border: none;">Remove</button></td>
    </tr>

    <?php                
}
    ?>
</table>
<!-- pop up model-->
<div id="myModals" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4><i>Change department</i></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <form method="post" action="#">
                    <div class="form-group">
                        <input type="text" hidden name="id" value="<?php echo $row['username'] ?>">
                        <label for="exampleFormControlSelect1">Select department</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="dept">
                            <option></option>
                            <?php
             $stmnt= $this->connect()->prepare("SELECT * from department");
             $stmnt->execute();
             $result=$stmnt->fetchAll();
             foreach($result as $row){
            ?>
                            <option><?php echo $row['name']; ?></option>
                            <?php
}
    ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Select Section</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" name="section">
                    </div>
                    <button type="submit" class="btn btn-primary" name="updateDept">submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php  
        
    }

    public function gradeSetting(){
        $deleteActive = $this->connect()->prepare("delete from grade_settings where 1");
        $deleteActive->execute();
        $Ap= $_POST['A+']; $A= $_POST['A']; $Am= $_POST['A-']; $Bp= $_POST['B+']; $B= $_POST['B']; $Bm= $_POST['B-']; $Cp= $_POST['C+']; $C= $_POST['C'];
        $Cm= $_POST['C-']; $Dp= $_POST['D+']; $D= $_POST['D']; $Fx= $_POST['Fx'];$F= $_POST['F'];

        $cmd1 ="insert into grade_settings (grade, point) values ('A+','$Ap')";
        $cmd2 ="insert into grade_settings (grade, point) values ('A','$A')";
        $cmd3 ="insert into grade_settings (grade, point) values ('A-','$Am')";
        $cmd4 ="insert into grade_settings (grade, point) values ('B+','$Bp')";
        $cmd5 ="insert into grade_settings (grade, point) values ('B','$B')";
        $cmd6 ="insert into grade_settings (grade, point) values ('B-','$Bm')";
        $cmd7 ="insert into grade_settings (grade, point) values ('C+','$Cp')";
        $cmd8 ="insert into grade_settings (grade, point) values ('C','$C')";
        $cmd9 ="insert into grade_settings (grade, point) values ('C-','$Cm')";
        $cmd10 ="insert into grade_settings (grade, point) values ('D+','$Dp')";
        $cmd11 ="insert into grade_settings (grade, point) values ('D','$D')";
        $cmd12 ="insert into grade_settings (grade, point) values ('Fx','$Fx')";
        $cmd13 ="insert into grade_settings (grade, point) values ('F','$F')";

        $this->connect()->exec($cmd1);
        $this->connect()->exec($cmd2);
        $this->connect()->exec($cmd3);
        $this->connect()->exec($cmd4);
        $this->connect()->exec($cmd5);
        $this->connect()->exec($cmd6);
        $this->connect()->exec($cmd7);
        $this->connect()->exec($cmd8);
        $this->connect()->exec($cmd9);
        $this->connect()->exec($cmd10);
        $this->connect()->exec($cmd11);
        $this->connect()->exec($cmd12);
        $this->connect()->exec($cmd13);



        if($cmd1 and $cmd2 and $cmd3 and $cmd4 and $cmd5 and $cmd6 and $cmd7 and $cmd8 and $cmd9 and $cmd10 and $cmd11 and $cmd12 and $cmd13){
            echo "<script> alert('Grade settings applied');</script>";
        }
    }
    public function passingCGPASetting(){
        $deleteActive = $this->connect()->prepare("delete from passing_points where 1");
        $deleteActive->execute();
        $y1s2= $_POST['y1s2']; $y2s1= $_POST['y2s1']; $y2s2= $_POST['y2s2']; $y3s1= $_POST['y3s1'];
        $y3s2= $_POST['y3s2']; $y4s1= $_POST['y4s1']; $y4s2= $_POST['y4s2'];
        $cmd1="insert into passing_points(period,cgpa) values ('Yar1:Sem2', '$y1s2')";
        $cmd2="insert into passing_points(period,cgpa) values ('Yar2:Sem1', '$y2s1')";
        $cmd3="insert into passing_points(period,cgpa) values ('Year2:Sem2', '$y2s2')";
        $cmd4="insert into passing_points(period,cgpa) values ('Yar3:Sem1', '$y3s1')";
        $cmd5="insert into passing_points(period,cgpa) values ('Yar3:Sem2', '$y3s2')";
        $cmd6="insert into passing_points(period,cgpa) values ('Yar4:Sem1', '$y4s1')";
        $cmd7="insert into passing_points(period,cgpa) values ('Yar1:Sem2', '$y4s2')";
        $this->connect()->exec($cmd1);
        $this->connect()->exec($cmd2);
        $this->connect()->exec($cmd3);
        $this->connect()->exec($cmd4);
        $this->connect()->exec($cmd5);
        $this->connect()->exec($cmd6);
        $this->connect()->exec($cmd7);


        //$cmd = "insert into passing_points (`Year1_Sem2`, `Year2_Sem1`, `Year2_Sem2`, `Year3_Sem1`, `Year3_Sem2`, `Year4_Sem1`, Year4_Sem2) values('$y1s2','$y2s1','$y2s2','$y3s1','$y3s2','$y4s1','$y4s2');";
        if($cmd1 and $cmd2 and $cmd3 and $cmd4 and $cmd5 and $cmd6 and $cmd7){
            echo "<script> alert('Passing CGPAs updated');</script>";
        }

    }
    public function gradeStatusSetting(){
        $deleteActive = $this->connect()->prepare("delete from cgpa_status where 1");
        $deleteActive->execute();
        $grtDstMin= $_POST['greatDistinctionMin']; $grtDstMax=$_POST['greatDistinctionMax'];
        $dstMin= $_POST['distinctionMin']; $dstMax=$_POST['distinctionMax'];
        $firstCMin= $_POST['firstClassMin']; $firstCMax=$_POST['firstClassMax'];
        $secondCMin= $_POST['secondClassMin']; $secondCMax=$_POST['secondClassMax'];


        $cmd1 ="insert into cgpa_status (status, min_cgpa, max_cgpa) values ('Great Distinction','$grtDstMin','$grtDstMax')";
        $cmd2 ="insert into cgpa_status (status, min_cgpa, max_cgpa) values ('Distinction','$dstMin','$dstMax')";
        $cmd3 ="insert into cgpa_status (status, min_cgpa, max_cgpa) values ('First Class','$firstCMin','$firstCMax')";
        $cmd4 ="insert into cgpa_status (status, min_cgpa, max_cgpa) values ('Second Class','$secondCMin','$secondCMax')";

        $this->connect()->exec($cmd1);
        $this->connect()->exec($cmd2);
        $this->connect()->exec($cmd3);
        $this->connect()->exec($cmd4);
        if($cmd1 and $cmd2 and $cmd3 and $cmd4){
            echo "<script> alert('Grade status updated');</script>";
        }
    }

    public function calculateGrade(){

        $dept= $_POST['department'];
        $batch=$_POST['batch'];
        $period=$_POST['period'];
        $obj=new Queries;
        $stmnt= $this->connect()->prepare("SELECT * FROM registeredstudents where dept='".$dept."' and batch='".$batch."'");
        $stmnt->execute();
        $result=$stmnt->fetchAll();
        foreach($result as $row){
            $studUsername=$row['username'];
            $fetchAssessment= $this->connect()->prepare("SELECT * FROM student_mark where username='".$studUsername."' and period='".$period."'");
            $fetchAssessment->execute();
            $assessment=$fetchAssessment->fetchAll();
            foreach ($assessment as $mark){
                $course=$mark['course'];
                $markPeriod=$mark['period'];
                 $total= $mark['assessment1']+$mark['assessment2']+$mark['assessment3']+$mark['assessment4']+$mark['assessment5']+$mark['assessment6']+$mark['assessment7']+$mark['assessment8'];

                 $grade=$obj->fetchGradeRange($total);
               $mark=$obj->fetchGradePoint($grade);
                $obj->insertGrade($studUsername, $course, $markPeriod, $grade, $mark, $total);

            }

        }
        $obj->viewStudentGrade($dept, $batch, $period);
    }

    public function fetchGradeRange($total){
        $stmnt= $this->connect()->prepare("SELECT grade FROM grade_scale where min_point<='".$total."' and max_point>='".$total."'");
        $stmnt->execute();
        $result=$stmnt->fetchAll();
        foreach ($result as $grade) {
            return $grade['grade'];
        }
    }

    public function fetchGradePoint($grade){
        $stmnt= $this->connect()->prepare("SELECT point FROM grade_settings where grade='".$grade."'");
        $stmnt->execute();
        $result=$stmnt->fetchAll();
        foreach ($result as $grade) {
            return $grade['point'];
        }
    }

    public function insertGrade($studUsername,$course, $period, $grade, $mark, $total){
        $cmd1 ="insert into student_grade (username,course, period, grade, mark, total_points) values ('$studUsername','$course', '$period','$grade','$mark','$total')";
        if($this->connect()->exec($cmd1)){
            echo "<script> alert('Grade calculated successfully');</script>";
        }
}

    public function viewStudentGrade($dept, $batch, $period){
        $stmnt= $this->connect()->prepare("SELECT username FROM registeredstudents where dept='".$dept."' and batch='".$batch."'");
        $stmnt->execute();
        $result=$stmnt->fetchAll();

?>
<table style="border: 1px solid #dddddd; width: 90%;"><br>
    <tr>
        <th style="background-color: gray;">Student ID</th>
        <th style="background-color: gray;">Course</th>
        <th style="background-color: gray;">Period</th>
        <th style="background-color: gray;">Grade</th>
        <th style="background-color: gray;">Mark</th>
        <th style="background-color: gray;">Total</th>
    </tr>
    <?php
            foreach($result as $row){
            $studUname= $row['username'];
            $fetchGrade=$this->connect()->prepare("SELECT * FROM student_grade where username='".$studUname."' and period='".$period."'");
            $fetchGrade->execute();
            $studGrade= $fetchGrade->fetchAll();

            foreach($studGrade as $grade){
                ?>
    <tr>
        <td><i><?php echo $grade['username'];?></i></td>
        <td><i><?php echo $grade['course'];?></i></td>
        <td><i><?php echo $grade['period'];?></i></td>
        <td><i><?php echo $grade['grade'];?></i></td>
        <td><i><?php echo $grade['mark'];?></i></td>
        <td><i><?php echo $grade['total_points'];?></i></td>

    <?php
            }
        }

    }

    public function calculateGPA($dept, $period){

        $stmnt= $this->connect()->prepare("SELECT * FROM registeredstudents where dept='".$dept."'");
        $stmnt->execute();
        $result=$stmnt->fetchAll();
        foreach($result as $row) {
           $username=$row['username']; echo "<br>";
            $obj = new Queries;
             $total_crthrs=$obj->fetchTotalCrtHr($username, $period); echo "<br>";
            $total_crtpts=$obj->fetchTotalCrtPts($username,$period); echo "<br>";
            $GPA=$total_crtpts/$total_crthrs; echo "<br>";
            $insert="insert into student_gpa (username,  period, gpa,total_crhr, total_crpts) VALUES ('$username','$period','$GPA','$total_crthrs','$total_crtpts')";
            if($this->connect()->exec($insert)){
                echo "<script>alert('gpa done');</script>";
            }
        }
    }

    public function fetchTotalCrtHr($username, $period){
        $stmnt= $this->connect()->prepare("SELECT * FROM student_grade where username='".$username."' and period='".$period."'");
        $stmnt->execute();
        $result=$stmnt->fetchAll();
        $total_hrs=0;

        foreach ($result as $courseName) {
            $course=$courseName['course'];
            $period=$courseName['period'];
            $fetchCourse=$this->connect()->prepare("SELECT * FROM coursebank where coursename='".$course."' and period='".$period."'");
            $fetchCourse->execute();
            $fetchResult=$fetchCourse->fetchAll();
            foreach($fetchResult as $course){
                $total_hrs= $total_hrs + $course['credithour'];
            }
        }
        return $total_hrs;
    }

    public function fetchTotalCrtPts($username, $period){
        $stmnt= $this->connect()->prepare("SELECT * FROM student_grade where username='".$username."' and period='".$period."'");
        $stmnt->execute();
        $result=$stmnt->fetchAll();

        $total_crtpts=0;
        foreach ($result as $courseName) {
            $course=$courseName['course'];
            $period=$courseName['period'];
            $fetchCourse=$this->connect()->prepare("SELECT * FROM coursebank where coursename='".$course."' and period='".$period."'");
            $fetchCourse->execute();
            $fetchResult=$fetchCourse->fetchAll();
            foreach($fetchResult as $course){

                $product=$course['credithour']* $courseName['mark'];
                $total_crtpts=$total_crtpts + $product;
            }
        }
        return $total_crtpts;
    }

    public function calculateCGPA($dept, $period){

        $stmnt= $this->connect()->prepare("SELECT * FROM registeredstudents where dept='".$dept."'");
        $stmnt->execute();
        $result=$stmnt->fetchAll();
        foreach($result as $row) {
            $username=$row['username']; echo "<br>";
            $obj = new Queries;
              $CGPAcrthrs=$obj->fetchTotalCGPACrtHr($username, $period); echo "<br>";
              $CGPA_crtpts=$obj->fetchTotalCGPACrtPts($username,$period); echo"<br>";
               $CGPA=$CGPA_crtpts/$CGPAcrthrs; echo "<br>";

            $insert="insert into student_cgpa (username,  period, cgpa,total_crhr, total_crpts) VALUES ('$username','$period','$CGPA','$CGPAcrthrs','$CGPA_crtpts')";
           if($this->connect()->exec($insert)){
                echo "<script>alert('cgpa done');</script>";
            }
        }

    }

    public function fetchTotalCGPACrtHr($username, $period){

        $stmnt= $this->connect()->prepare("SELECT * FROM student_gpa where username='".$username."'");
        $stmnt->execute();
        $result=$stmnt->fetchAll();
        foreach($result as $gpa){
            if($period=='Year1:Sem1'){
                return $gpa['total_crhr'];
            }
            else if($period=='Year1:Sem2'){
                $query1=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year1:Sem1'");
                $query1->execute();
                $crhr= $query1->fetchAll();
                foreach( $crhr as $value){
                    $y1s1=$value['total_crhr'];
                }
                $query2=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year1:Sem2'");
                $query2->execute();
                $crhr= $query2->fetchAll();
                foreach($crhr as $value){
                     $y1s2= $value['total_crhr']; echo "<br>";
                }
              return $y1s1 + $y1s2;
            }
            else if($period=='Year2:Sem1'){
                $query1=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year1:Sem1'");
                $query1->execute();
                $crhr=$query1->fetchAll();
                foreach($crhr as $value){
                    $y1s1= $value['total_crhr'];
                }
                $query2=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year1:Sem2'");
                $query2->execute();
                $crhr=$query2->fetchAll();
                foreach($crhr as $value){
                    $y1s2= $value['total_crhr'];
                }
                $query3=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year2:Sem1'");
                $query3->execute();
                $crhr=$query3->fetchAll();
                foreach($crhr as $value){
                    $y2s1= $value['total_crhr'];
                }
                return $y1s1+$y1s2+$y2s1;
            }
            else if($period=='Year2:Sem2'){
                $query1= $this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year1:Sem1'");
                $query1->execute();
                $crhr=$query1->fetchAll();
                foreach($crhr as $value){
                    $y1s1=$value['total_crhr'];
                }
                $query2=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year1:Sem2'");
                $query2->execute();
                $crhr=$query2->fetchAll();
                foreach ( $crhr as $value) {
                    $y1s2= $value['total_crhr'];
                }
                $query3=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year2:Sem1'");
                $query3->execute();
                $crhr=$query3->fetchAll();
                foreach($crhr as $value){
                    $y2s1=$value['total_crhr'];
                }
                $query4=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year2:Sem2'");
                $query4->execute();
                $crhr= $query4->fetchAll();
                foreach ($crhr as $value){
                    $y2s2= $value['total_crhr'];
                }

                return $y1s1+$y1s2+$y2s1+$y2s2;
            }
            else if($period=='Year3:Sem1'){
                $query1= $this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year1:Sem1'");
                $query1->execute();
                $crhr=$query1->fetchAll();
                foreach($crhr as $value){
                    $y1s1=$value['total_crhr'];
                }
                $query2=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year1:Sem2'");
                $query2->execute();
                $crhr=$query2->fetchAll();
                foreach ( $crhr as $value) {
                    $y1s2= $value['total_crhr'];
                }
                $query3=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year2:Sem1'");
                $query3->execute();
                $crhr=$query3->fetchAll();
                foreach($crhr as $value){
                    $y2s1=$value['total_crhr'];
                }
                $query4=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year2:Sem2'");
                $query4->execute();
                $crhr= $query4->fetchAll();
                foreach ($crhr as $value){
                    $y2s2= $value['total_crhr'];
                }
                $query5=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year3:Sem1'");
                $query5->execute();
                $crhr= $query5->fetchAll();
                foreach ($crhr as $value){
                    $y3s1= $value['total_crhr'];
                }

                return $y1s1+$y1s2+$y2s1+$y2s2+$y3s1;
            }
            else if($period=='Year3:Sem2'){
                $query1= $this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year1:Sem1'");
                $query1->execute();
                $crhr=$query1->fetchAll();
                foreach($crhr as $value){
                    $y1s1=$value['total_crhr'];
                }
                $query2=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year1:Sem2'");
                $query2->execute();
                $crhr=$query2->fetchAll();
                foreach ( $crhr as $value) {
                    $y1s2= $value['total_crhr'];
                }
                $query3=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year2:Sem1'");
                $query3->execute();
                $crhr=$query3->fetchAll();
                foreach($crhr as $value){
                    $y2s1=$value['total_crhr'];
                }
                $query4=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year2:Sem2'");
                $query4->execute();
                $crhr= $query4->fetchAll();
                foreach ($crhr as $value){
                    $y2s2= $value['total_crhr'];
                }
                $query5=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year3:Sem1'");
                $query5->execute();
                $crhr= $query5->fetchAll();
                foreach ($crhr as $value){
                    $y3s1= $value['total_crhr'];
                }
                $query6=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year3:Sem2'");
                $query6->execute();
                $crhr= $query6->fetchAll();
                foreach ($crhr as $value){
                    $y3s2= $value['total_crhr'];
                }

                return $y1s1+$y1s2+$y2s1+$y2s2+$y3s1+$y3s2;
            }
            else if($period=='Year4:Sem1'){
                $query1= $this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year1:Sem1'");
                $query1->execute();
                $crhr=$query1->fetchAll();
                foreach($crhr as $value){
                    $y1s1=$value['total_crhr'];
                }
                $query2=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year1:Sem2'");
                $query2->execute();
                $crhr=$query2->fetchAll();
                foreach ( $crhr as $value) {
                    $y1s2= $value['total_crhr'];
                }
                $query3=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year2:Sem1'");
                $query3->execute();
                $crhr=$query3->fetchAll();
                foreach($crhr as $value){
                    $y2s1=$value['total_crhr'];
                }
                $query4=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year2:Sem2'");
                $query4->execute();
                $crhr= $query4->fetchAll();
                foreach ($crhr as $value){
                    $y2s2= $value['total_crhr'];
                }
                $query5=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year3:Sem1'");
                $query5->execute();
                $crhr= $query5->fetchAll();
                foreach ($crhr as $value){
                    $y3s1= $value['total_crhr'];
                }
                $query6=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year3:Sem2'");
                $query6->execute();
                $crhr= $query6->fetchAll();
                foreach ($crhr as $value){
                    $y3s2= $value['total_crhr'];
                }
                $query7=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year4:Sem1'");
                $query7->execute();
                $crhr= $query7->fetchAll();
                foreach ($crhr as $value){
                    $y4s1= $value['total_crhr'];
                }


                return $y1s1+$y1s2+$y2s1+$y2s2+$y3s1+$y3s2+$y4s1;
            }
            else {
                $query1= $this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year1:Sem1'");
                $query1->execute();
                $crhr=$query1->fetchAll();
                foreach($crhr as $value){
                    $y1s1=$value['total_crhr'];
                }
                $query2=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year1:Sem2'");
                $query2->execute();
                $crhr=$query2->fetchAll();
                foreach ( $crhr as $value) {
                    $y1s2= $value['total_crhr'];
                }
                $query3=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year2:Sem1'");
                $query3->execute();
                $crhr=$query3->fetchAll();
                foreach($crhr as $value){
                    $y2s1=$value['total_crhr'];
                }
                $query4=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year2:Sem2'");
                $query4->execute();
                $crhr= $query4->fetchAll();
                foreach ($crhr as $value){
                    $y2s2= $value['total_crhr'];
                }
                $query5=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year3:Sem1'");
                $query5->execute();
                $crhr= $query5->fetchAll();
                foreach ($crhr as $value){
                    $y3s1= $value['total_crhr'];
                }
                $query6=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year3:Sem2'");
                $query6->execute();
                $crhr= $query6->fetchAll();
                foreach ($crhr as $value){
                    $y3s2= $value['total_crhr'];
                }

                $query7=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year4:Sem1'");
                $query7->execute();
                $crhr= $query7->fetchAll();
                foreach ($crhr as $value){
                    $y4s1= $value['total_crhr'];
                }
                $query8=$this->connect()->prepare("select total_crhr from student_gpa where username='".$username."' and period='Year4:Sem2'");
                $query8->execute();
                $crhr= $query8->fetchAll();
                foreach ($crhr as $value){
                    $y4s2= $value['total_crhr'];
                }
                return $y1s1+$y1s2+$y2s1+$y2s2+$y3s1+$y3s2+$y4s1+$y4s2;
            }
        }

    }
    public function fetchTotalCGPACrtPts($username,$period){

        $stmnt= $this->connect()->prepare("SELECT * FROM student_gpa where username='".$username."'");
        $stmnt->execute();
        $result=$stmnt->fetchAll();
        foreach($result as $gpa){
            if($period=='Year1:Sem1'){
                return $gpa['total_crpts'];
            }
            else if($period=='Year1:Sem2'){
                $query1=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year1:Sem1'");
                $query1->execute();
                $crhr= $query1->fetchAll();
                foreach( $crhr as $value){
                    $y1s1=$value['total_crpts'];
                }

                $query2=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year1:Sem2'");
                $query2->execute();
                $crhr= $query2->fetchAll();
                foreach($crhr as $value){
                    $y1s2= $value['total_crpts']; echo "<br>";
                }
                return $y1s1 + $y1s2;
            }
            else if($period=='Year2:Sem1'){
                $query1=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year1:Sem1'");
                $query1->execute();
                $crhr=$query1->fetchAll();
                foreach($crhr as $value){
                    $y1s1= $value['total_crpts'];
                }
                $query2=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year1:Sem2'");
                $query2->execute();
                $crhr=$query2->fetchAll();
                foreach($crhr as $value){
                    $y1s2= $value['total_crpts'];
                }
                $query3=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year2:Sem1'");
                $query3->execute();
                $crhr=$query3->fetchAll();
                foreach($crhr as $value){
                    $y2s1= $value['total_crpts'];
                }
                return $y1s1+$y1s2+$y2s1;
            }
            else if($period=='Year2:Sem2'){
                $query1= $this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year1:Sem1'");
                $query1->execute();
                $crhr=$query1->fetchAll();
                foreach($crhr as $value){
                    $y1s1=$value['total_crpts'];
                }
                $query2=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year1:Sem2'");
                $query2->execute();
                $crhr=$query2->fetchAll();
                foreach ( $crhr as $value) {
                    $y1s2= $value['total_crpts'];
                }
                $query3=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year2:Sem1'");
                $query3->execute();
                $crhr=$query3->fetchAll();
                foreach($crhr as $value){
                    $y2s1=$value['total_crpts'];
                }
                $query4=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year2:Sem2'");
                $query4->execute();
                $crhr= $query4->fetchAll();
                foreach ($crhr as $value){
                    $y2s2= $value['total_crpts'];
                }

                return $y1s1+$y1s2+$y2s1+$y2s2;
            }
            else if($period=='Year3:Sem1'){
                $query1= $this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year1:Sem1'");
                $query1->execute();
                $crhr=$query1->fetchAll();
                foreach($crhr as $value){
                    $y1s1=$value['total_crpts'];
                }
                $query2=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year1:Sem2'");
                $query2->execute();
                $crhr=$query2->fetchAll();
                foreach ( $crhr as $value) {
                    $y1s2= $value['total_crpts'];
                }
                $query3=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year2:Sem1'");
                $query3->execute();
                $crhr=$query3->fetchAll();
                foreach($crhr as $value){
                    $y2s1=$value['total_crpts'];
                }
                $query4=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year2:Sem2'");
                $query4->execute();
                $crhr= $query4->fetchAll();
                foreach ($crhr as $value){
                    $y2s2= $value['total_crpts'];
                }
                $query5=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year3:Sem1'");
                $query5->execute();
                $crhr= $query5->fetchAll();
                foreach ($crhr as $value){
                    $y3s1= $value['total_crpts'];
                }

                return $y1s1+$y1s2+$y2s1+$y2s2+$y3s1;
            }
            else if($period=='Year3:Sem2'){
                $query1= $this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year1:Sem1'");
                $query1->execute();
                $crhr=$query1->fetchAll();
                foreach($crhr as $value){
                    $y1s1=$value['total_crpts'];
                }
                $query2=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year1:Sem2'");
                $query2->execute();
                $crhr=$query2->fetchAll();
                foreach ( $crhr as $value) {
                    $y1s2= $value['total_crpts'];
                }
                $query3=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year2:Sem1'");
                $query3->execute();
                $crhr=$query3->fetchAll();
                foreach($crhr as $value){
                    $y2s1=$value['total_crpts'];
                }
                $query4=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year2:Sem2'");
                $query4->execute();
                $crhr= $query4->fetchAll();
                foreach ($crhr as $value){
                    $y2s2= $value['total_crpts'];
                }
                $query5=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year3:Sem1'");
                $query5->execute();
                $crhr= $query5->fetchAll();
                foreach ($crhr as $value){
                    $y3s1= $value['total_crpts'];
                }
                $query6=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year3:Sem2'");
                $query6->execute();
                $crhr= $query6->fetchAll();
                foreach ($crhr as $value){
                    $y3s2= $value['total_crpts'];
                }

                return $y1s1+$y1s2+$y2s1+$y2s2+$y3s1+$y3s2;
            }
            else if($period=='Year4:Sem1'){
                $query1= $this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year1:Sem1'");
                $query1->execute();
                $crhr=$query1->fetchAll();
                foreach($crhr as $value){
                    $y1s1=$value['total_crpts'];
                }
                $query2=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year1:Sem2'");
                $query2->execute();
                $crhr=$query2->fetchAll();
                foreach ( $crhr as $value) {
                    $y1s2= $value['total_crpts'];
                }
                $query3=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year2:Sem1'");
                $query3->execute();
                $crhr=$query3->fetchAll();
                foreach($crhr as $value){
                    $y2s1=$value['total_crpts'];
                }
                $query4=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year2:Sem2'");
                $query4->execute();
                $crhr= $query4->fetchAll();
                foreach ($crhr as $value){
                    $y2s2= $value['total_crpts'];
                }
                $query5=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year3:Sem1'");
                $query5->execute();
                $crhr= $query5->fetchAll();
                foreach ($crhr as $value){
                    $y3s1= $value['total_crpts'];
                }
                $query6=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year3:Sem2'");
                $query6->execute();
                $crhr= $query6->fetchAll();
                foreach ($crhr as $value){
                    $y3s2= $value['total_crpts'];
                }
                $query7=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year4:Sem1'");
                $query7->execute();
                $crhr= $query7->fetchAll();
                foreach ($crhr as $value){
                    $y4s1= $value['total_crpts'];
                }


                return $y1s1+$y1s2+$y2s1+$y2s2+$y3s1+$y3s2+$y4s1;
            }
            else {
                $query1= $this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year1:Sem1'");
                $query1->execute();
                $crhr=$query1->fetchAll();
                foreach($crhr as $value){
                    $y1s1=$value['total_crpts'];
                }
                $query2=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year1:Sem2'");
                $query2->execute();
                $crhr=$query2->fetchAll();
                foreach ( $crhr as $value) {
                    $y1s2= $value['total_crpts'];
                }
                $query3=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year2:Sem1'");
                $query3->execute();
                $crhr=$query3->fetchAll();
                foreach($crhr as $value){
                    $y2s1=$value['total_crpts'];
                }
                $query4=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year2:Sem2'");
                $query4->execute();
                $crhr= $query4->fetchAll();
                foreach ($crhr as $value){
                    $y2s2= $value['total_crpts'];
                }
                $query5=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year3:Sem1'");
                $query5->execute();
                $crhr= $query5->fetchAll();
                foreach ($crhr as $value){
                    $y3s1= $value['total_crpts'];
                }
                $query6=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year3:Sem2'");
                $query6->execute();
                $crhr= $query6->fetchAll();
                foreach ($crhr as $value){
                    $y3s2= $value['total_crpts'];
                }

                $query7=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year4:Sem1'");
                $query7->execute();
                $crhr= $query7->fetchAll();
                foreach ($crhr as $value){
                    $y4s1= $value['total_crpts'];
                }
                $query8=$this->connect()->prepare("select * from student_gpa where username='".$username."' and period='Year4:Sem2'");
                $query8->execute();
                $crhr= $query8->fetchAll();
                foreach ($crhr as $value){
                    $y4s2= $value['total_crpts'];
                }
                return $y1s1+$y1s2+$y2s1+$y2s2+$y3s1+$y3s2+$y4s1+$y4s2;
            }
        }
}

    public function fetchClearanceWithdraw(){

        $username=$_POST['username'];
        $period= $_POST['period'];
        ?>
        <br><br>
        <script src="../../js/jquery.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../layout.css">
        <table style="border: 1px solid #dddddd;">
            <tr>
                <th style="background-color: gray;">Student ID</th>
                <th style="background-color: gray;">First Name</th>
                <th style="background-color: gray;">Last Name</th>
                <th style="background-color: gray;">Period</th>
                <th style="background-color: gray;">Library</th>
                <th style="background-color: gray;">Finance</th>
                <th style="background-color: gray; text-align: center;">Action</th>

            </tr>

            <?php
            $stmnt= $this->connect()->prepare("SELECT  registeredstudents.username, fname, lname, library, finance, picname from clearancewithdraw, registeredstudents where clearancewithdraw.username='".$username."' and registeredstudents.username='".$username."' and clearancewithdraw.period='".$period."'");
            $stmnt->execute();
            $result=$stmnt->fetchAll();
            foreach($result as $row){

                ?>

                <tr>
                    <td><i><?php echo $row['username'];?></i></td>
                    <td><i><?php echo $row['fname'];?></i></td>
                    <td><i><?php echo $row['lname'];?></i></td>
                    <td><i><?php echo $period;?></i></td>
                    <td><i><?php echo $row['library'];?></i></td>
                    <td><i><?php echo $row['finance'];?></i></td>

                    <td><a href="clearedFromReg.php?id=<?php echo $row['username']; ?> && prd=<?php echo $period;?>"><i>Clear</i></a></td>

                </tr>
                <?php
            }?>
        </table>
        <?php
    }

    public function fetchGradeReport(){
    ?>
        <br>
        <div style="border: 1px solid black; border-radius: 5px; padding: 20px; width: 80%; margin-left: 5%;">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
            <table style="width: 100%;">
                <tr style="width: 100%;">
                    <th style="">Name</th>
                    <th style="margin-left: 20%;">Deparment</th>
                </tr>

            <?php
            $prd=$_POST['period'];
            $_SESSION['printPeriod']=$prd;
            $username=$_POST['username'];
            $_SESSION['printUser']= $username;
            $studInfo= $this->connect()->prepare("select *from registeredstudents where username='".$username."'");
            $studInfo->execute();
            $studData=$studInfo->fetchAll();
            foreach($studData as $studDatum){
                ?>

               <tr style="width: 100%;">
                   <td><?php echo $studDatum['fname'].' '.$studDatum['lname'];?></td>
                    <td><?php echo $studDatum['dept'];?></td>
               </tr>

                <?php
            }

            ?></table>
            </div>
            </div>
           <br>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
            <table style="width: 100%;">

                <tr>
                    <th style="">ID</th>
                    <th>Section &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Semester</th>

                </tr>
                <?php
                $prd=$_POST['period'];
                $username=$_POST['username'];
                $_SESSION['printPeriod']=$prd;

                $_SESSION['printUser']= $username;
                $studInfo= $this->connect()->prepare("select *from registeredstudents where username='".$username."'");
                $studInfo->execute();
                $studData=$studInfo->fetchAll();
                foreach($studData as $studDatum){
                    ?>

                    <tr><td><?php echo $studDatum['username'];?></td>
                        <td><?php echo $studDatum['section']; echo"&nbsp&nbsp&nbsp&nbsp&nbsp";  echo $prd;?></td>

                    </tr>
                    <?php
                }

                ?></table>
            </div></div>
            <br>
        <table style="width: 100%;">
            <div class="dropdown-divider"></div>
        <tr>
            <td style="">Course</td>
            <td style="">Credit Hour</td>
            <td style="">Grade</td>
            <td style="">Mark</td>
            <td style="">Total Points</td>
        </tr>
        <?php

             $stmnts= $this->connect()->prepare("SELECT *from student_course where username='".$username."' and period= '".$prd."'");
             $stmnts->execute();
             $results=$stmnts->fetchAll();
             foreach($results as $rows){
                 $cname= $rows['course'];
                 $coursedetail= $this->connect()->prepare("SELECT *from coursebank where coursename='".$cname."'");
             $coursedetail->execute();
             $courselist=$coursedetail->fetchAll();
                 foreach($courselist as $list){
                     $courseName=$list['coursename'];
                     $coursePoints=$this->connect()->prepare("select *from student_grade where course='".$courseName."' and username='".$username."' and period='".$prd."'");
                     $coursePoints->execute();
                     $fetchCoursePoints=$coursePoints->fetchAll();
                     foreach($fetchCoursePoints as $points){
                         $grade= $points['grade'];
                         $mark=$points['mark'];
                         $total=$points['total_points'];
            ?>
    <tr>
        <td><i><?php echo $list['coursename'];?></i></td>
        <td><i><?php echo $list['credithour'];?></i></td>
        <td><i><?php echo $grade;?></i></td>
        <td><i><?php echo $mark;?></i></td>
        <td><i><?php echo $total?></i></td>
    </tr>

<?php
}}}



$query1 = $this->connect()->prepare("select * from student_gpa where username='" .$username. "' and period='" .$prd . "'");
$query1->execute();
$fetchGPA= $query1->fetchAll();
foreach($fetchGPA as $value){
    $gpa= $value['gpa'];
}
$query2 = $this->connect()->prepare("select * from student_cgpa where username='" . $username . "' and period='" . $prd . "'");
$query2->execute();
$fetchCGPA= $query2->fetchAll();
foreach($fetchCGPA as $value) {
    $cgpa = $value['cgpa'];
}
$status = $this->connect()->prepare("select * from cgpa_status where min_cgpa<='" . $cgpa . "' and max_cgpa>='" . $cgpa . "'");
$status->execute();
$CGPAstatus= $status->fetchAll();
foreach($CGPAstatus as $state){
    $status=$state['status'];
}

?>
</table><br>
    <div class="dropdown-divider"></div>
    <table style="width:100%;">
        <tr>
            <th>Status</th>
            <th>Semester GPA</th>
            <th>Cumulative GPA</th>
        </tr>
        <tr>
            <td> <?php echo $status; ?></td>
            <td> <?php echo $gpa; ?></td>
            <td> <?php echo $cgpa; ?></td>
        </tr>
    </table>
<?php
?>
<div class="dropdown-divider"></div>
            <form action="printGrade.php" method="post">
            <button type="submit" class="btn btn-primary mb-2" name="printGrade" style="margin-left: 80%;">Print Grade Report</button>
            </form>
</div>
<?php
    }

    public function fetchRegistrationSlip(){
        ?>
        <br>
        <div style="border: 1px solid black; border-radius: 5px; padding: 20px; width: 80%; margin-left: 5%;">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <table style="width: 100%;">
                        <tr style="width: 100%;">
                            <th style="">Name</th>
                            <th style="">Deparment</th>
                        </tr>
                        <?php
                        $prd=$_POST['period'];
                        $username=$_POST['username'];
                        $_SESSION['printUser']= $username;
                        $studInfo= $this->connect()->prepare("select *from registeredstudents where username='".$username."'");
                        $studInfo->execute();
                        $studData=$studInfo->fetchAll();
                        foreach($studData as $studDatum){
                            ?>

                            <tr style="width: 100%;">
                                <td><?php echo $studDatum['fname'].' '.$studDatum['lname'];?></td>

                                <td><?php echo $studDatum['dept'];?></td>
                            </tr>

                            <?php
                        }

                        ?></table>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <table style="width: 100%;">

                        <tr>
                            <th style="">ID</th>
                            <th>Section</th>
                            <th>Semester</th>

                        </tr>
                        <?php
                        $prd=$_POST['period'];
                        $_SESSION['printPeriod']=$prd;
                        $username=$_POST['username'];
                        $username= $_SESSION['printUser'];
                        $studInfo= $this->connect()->prepare("select *from registeredstudents where username='".$username."'");
                        $studInfo->execute();
                        $studData=$studInfo->fetchAll();
                        foreach($studData as $studDatum){
                            ?>

                            <tr><td><?php echo $studDatum['username'];?></td>
                                <td><?php echo $studDatum['section'];?></td>
                                <td><?php echo $prd;?></td>
                            </tr>
                            <?php
                        }
                        ?></table>
                </div></div>
            <br>
            <table style="width: 100%;">
                <div class="dropdown-divider"></div>
                <tr>
                    <td style="">Course Code</td>
                    <td style="">Course Name</td>
                    <td style="">Credit Hour</td>
                </tr>
                <?php
                $stmnts= $this->connect()->prepare("SELECT *from student_course where username='".$username."' and period= '".$prd."'");
                $stmnts->execute();
                $results=$stmnts->fetchAll();
                foreach($results as $rows){
                    $cname= $rows['course'];
                    $coursedetail= $this->connect()->prepare("SELECT *from coursebank where coursename='".$cname."'");
                    $coursedetail->execute();
                    $courselist=$coursedetail->fetchAll();
                    foreach($courselist as $list){
                            ?>
                            <tr>
                                <td><i><?php echo $list['coursecode'];?></i></td>
                                <td><i><?php echo $list['coursename'];?></i></td>
                                <td><i><?php echo $list['credithour'];?></i></td>
                            </tr>
                            <?php
                        }}
                ?>
            </table><br>
        <div class="dropdown-divider"></div>
            <?php
            ?>
            <form method="post" action="printRegistration.php">
            <button type="submit" class="btn btn-primary mb-2"  style="margin-left: 80%;"  name="printReg">Print Registration Slip</button>
            </form>

        </div>
        <?php
    }
}
?>


<!-- out of class queries
<?php
// updating the department along with id
if(isset($_POST['updateDept'])){
                       
                             $mydb= new db;
                        $conn=$mydb->connect();
                         // number of students already in the department
                            $studCount= "SELECT * FROM registeredstudents where dept='".$_POST['dept']."'";
                            $results =$conn->query($studCount);
                            $count= $results->rowCount();
                            $batch=date('y');
                        $updateDept=$conn->prepare("UPDATE registeredstudents SET section='".$_POST['section']."', dept='".$_POST['dept']."' where username='".$_POST['id']."'");
		        
                        if($updateDept->execute()){
                            $selectdep="select  prefix from department where name= '".$_POST['dept']."'";
                            $res=$conn->query($selectdep);
                            $selecteddep=$res->fetch(PDO::FETCH_ASSOC);
                            $dep= $selecteddep['prefix'];
                                
                           
                             // update the id       
                           
                if($count<9){
                $id=$dep."/00".++$count."/".$batch;
                    echo $id;
                $cmd=$conn->prepare("UPDATE registeredstudents SET username='".$id."' where username='".$_POST['id']."'");
		        $cmd->execute();
                    
                    $_SESSION['deptChanged']=1;
              }  
                else if($count>8 && $count<99){
                $id=$dep."/0".++$count."/".$batch;  
                $cmd=$conn->prepare("UPDATE registeredstudents SET username='".$id."' where username='".$_POST['id']."'");
		        $cmd->execute();
                        
                    $_SESSION['deptChanged']=1;
                }
            
            else{
                $id=$dep."/".++$count."/".$batch;  
                $cmd=$conn->prepare("UPDATE registeredstudents SET username='".$id."' where username='".$_POST['id']."'");
		        $cmd->execute();
                
                    $_SESSION['deptChanged']=1;
                    
                 } 
                        
                       
                        }
                        else  $_SESSION['deptChanged']=0;

    
                    }
                          
?>
