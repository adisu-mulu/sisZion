<?php
/**
 * Created by PhpStorm.
 * User: kul_Hab
 * Date: 6/8/2019
 * Time: 6:59 AM
 */
include_once '..//database.php';
include_once '..//profile.php';
class Queries extends db {


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
                    <td><a href="../payment.php?id=<?php echo $row['username']; ?> && prd=<?php echo $period;?>"><i>Paid</i></a></td>

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
                    <td><i><?php echo $period;?></i></td>

                    <td>
                        <?php
                        $path="../uploads/";

                        $con= new Profile;
                        $con->displayshortForPendingRequest($path,"pendingrequest", $row['picname']);
                        ?>
                    </td>
                    <td><a href="clearedFromLibrary.php?id=<?php echo $row['username']; ?> && prd=<?php echo $period;?>"><i>Clear</i></a></td>

                </tr>
                <?php
            }?>
        </table>
        <?php
    }
}

?>