<?php
include_once '..//database.php';
include_once '..//profile.php';
class Queries extends db {


//	public function acceptedByFinance($studid){
//        
//         $fname;$lname;$email; $age; $studid;$dob;$sex;
//        $maritalstatus;$region;$zone;$woreda;$dept;$section;
//        $picname;
//
//        $stmnt= $this->connect()->prepare("SELECT * FROM pendingrequest where studid='".$studid."'");
//             $stmnt->execute();
//             $result=$stmnt->fetchAll();
//             
//             foreach($result as $row){
//
//                $this->fname= $row['fname']; $this->lname= $row['lname']; $this->email= $row['email'];
//                $this->age= $row['age']; $this->dob= $row['dob']; $this->sex= $row['sex']; $this->maritalstatus= $row['maritalstatus']; $this->region= $row['region']; $this->zone= $row['zone']; $this->woreda= $row['woreda']; $this->dept= $row['studdept']; $this->section= $row['studsec']; $this->picname= $row['picname']; $this->studid=$row['studid'];
//             }
//             $cmd="insert into registeredstudents(username,fname,lname,email,age,dob,sex,maritalstatus,region,zone,woreda,dept,section,picname) values('$this->studid','$this->fname','$this->lname','$this->email','$this->age', '$this->dob', '$this->sex', '$this->maritalstatus', '$this->region', '$this->zone', '$this->woreda','$this->dept', '$this->section', '$this->picname');";
//             if($this->connect()->exec($cmd)){
//                
//                $stmnt="DELETE FROM `pendingrequest` WHERE studid='".$studid."'";
//                $this->connect()->exec($stmnt);
//             }
//        }


//    public function removeFromFinance(){
//	print("am in remove function");
//
//	$stmnt="DELETE FROM `pendingrequest` WHERE id='".$_GET["id"]."'";
//	if($this->connect()->exec($stmnt)){
////		header('Location: ../index.php');
//	}
//	else print("something went wrong");	
//}

public function passedToFinanceRequestCount(){
    
    $stmnt= "SELECT * FROM pendingrequest where sent='sent'";
    $sql =$this->connect()->query($stmnt);
    $count= $sql->rowCount();
    if($count!==0){
    ?>
<sup style="color: red" ;><?php echo $count;?></sup>
<?php
}
}

public function fetchRequestsentToFinance(){
        ?>
<br><br>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../layout.css">
<table style="border: 1px solid #dddddd;">
    <tr>
        <th style="background-color: gray;">Student ID</th>
        <th style="background-color: gray;">First Name</th>
        <th style="background-color: gray;">Last Name</th>
        <th style="background-color: gray;">Email</th>
        <th style="background-color: gray;">Department</th>
        <th style="background-color: gray;">Section</th>
        <th style="background-color: gray;">Profile</th>
        <th style="background-color: gray; text-align: center;" colspan="2">Action</th>

    </tr>

    <?php 
             $stmnt= $this->connect()->prepare("SELECT * FROM pendingrequest where sent='sent'");
             $stmnt->execute();
             $result=$stmnt->fetchAll();
             foreach($result as $row){
               
            ?>

    <tr>
        <td><i><?php echo $row['studid'];?></i></td>
        <td><i><?php echo $row['fname'];?></i></td>
        <td><i><?php echo $row['lname'];?></i></td>
        <td><i><?php echo $row['email'];?></i></td>
        <td><i><?php echo $row['studdept'];?></i></td>
        <td><i><?php echo $row['studsec'];?></i></td>
        <td>
            <?php 
                $path="../uploads/";
                
                $con= new Profile;
                $con->displayshortForPendingRequest($path,"pendingrequest", $row['id']);
                ?>
        </td>
        <td><a href="financeaccept.php?id=<?php echo $row['studid'];?>"><i>Approve</i></a></td>
        <td><a href="financereject.php?id=<?php echo $row['studid'];?>"><i>Reject</i></a></td>
    </tr>
    <?php
}?>
</table>
<?php       
}

    public function fetchForAcademicPayment(){
        $username=$_POST['username'];
        $period= $_POST['period'];
        ?>
        <br><br>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../layout.css">
        <table style="border: 1px solid #dddddd;">
            <tr>
                <th style="background-color: gray;">Student ID</th>
                <th style="background-color: gray;">First Name</th>
                <th style="background-color: gray;">Last Name</th>
                <th style="background-color: gray;">Period</th>
                <th style="background-color: gray;">Status</th>

                <th style="background-color: gray;">Profile</th>
                <th style="background-color: gray; text-align: center;" colspan="2">Action</th>

            </tr>

            <?php
            $stmnt= $this->connect()->prepare("SELECT *from registeredstudents where username='".$username."'");
            $stmnt->execute();
            $result=$stmnt->fetchAll();
            foreach($result as $row){

                ?>

                <tr>
                    <td><i><?php echo $row['username'];?></i></td>
                    <td><i><?php echo $row['fname'];?></i></td>
                    <td><i><?php echo $row['lname'];?></i></td>
                    <td><i><?php echo $row['email'];?></i></td>
                    <td><i><?php echo $row['dept'];?></i></td>
                    <td><i><?php echo $row['section'];?></i></td>
                    <td>
                        <?php
                        $path="../uploads/";

                        $con= new Profile;
                        $con->displayshortForPendingRequest($path,"pendingrequest", $row['picname']);
                        ?>
                    </td>
                    <td><a href="payment.php?id=<?php echo $row['username']; ?> && prd=<?php echo $period;?>"><i>Paid</i></a></td>

                </tr>
                <?php
            }?>
        </table>
        <?php
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
                <th style="background-color: gray;">Email</th>
                <th style="background-color: gray;">Department</th>
                <th style="background-color: gray;">Period</th>

                <th style="background-color: gray;">Profile</th>
                <th style="background-color: gray; text-align: center;" colspan="2">Action</th>

            </tr>

            <?php
            $stmnt= $this->connect()->prepare("SELECT  registeredstudents.username, fname, lname, email, dept, section, period, status, picname from academic_payment, registeredstudents where academic_payment.username='".$username."' and registeredstudents.username='".$username."' and academic_payment.period='".$period."'");
            $stmnt->execute();
            $result=$stmnt->fetchAll();
            foreach($result as $row){

                ?>

                <tr>
                    <td><i><?php echo $row['username'];?></i></td>
                    <td><i><?php echo $row['fname'];?></i></td>
                    <td><i><?php echo $row['lname'];?></i></td>
                    <td><i><?php echo $row['email'];?></i></td>
                    <td><i><?php echo $row['dept'];?></i></td>

                    <td><i><?php echo $row['status'];?></i></td>
                    <td>
                        <?php
                        $path="../uploads/";

                        $con= new Profile;
                        $con->displayshortForPendingRequest($path,"pendingrequest", $row['picname']);
                        ?>
                    </td>
                    <td><a href="clearedFromFinance.php?id=<?php echo $row['username']; ?> && prd=<?php echo $period;?>"><i>Clear</i></a></td>

                </tr>
                <?php
            }?>
        </table>
        <?php
    }
}

?>