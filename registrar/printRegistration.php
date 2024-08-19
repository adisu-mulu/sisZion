<?php
/**
 * Created by PhpStorm.
 * User: kul_Hab
 * Date: 6/12/2019
 * Time: 7:05 AM
 */
include_once '../database.php';
session_start();
if(isset($_POST['printReg'])){
    $mydb= new db;
    $conn=$mydb->connect();
    ?>

        <div style="border: 1px solid black; border-radius: 5px; padding: 20px; width: 80%; margin-left: 5%;">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h3>Zion College of Business and Technology student Registration Slip</h3>
                    <table style="width: 100%;">
                        <tr style="width: 100%;">
                            <th style="">Name</th>
                            <th style="">Deparment</th>
                        </tr>
                        <?php
                        $prd=$_SESSION['printPeriod'];
                        $username= $_SESSION['printUser'];
                        $studInfo= $conn->prepare("select *from registeredstudents where username='".$username."'");
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
                $prd=$_SESSION['printPeriod'];

                $username=$_SESSION['printUser'];
                $studInfo= $conn->prepare("select *from registeredstudents where username='".$username."'");
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
        $stmnts= $conn->prepare("SELECT *from student_course where username='".$username."' and period= '".$prd."'");
        $stmnts->execute();
        $results=$stmnts->fetchAll();
        foreach($results as $rows){
            $cname= $rows['course'];
            $coursedetail= $conn->prepare("SELECT *from coursebank where coursename='".$cname."'");
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
        <button type="submit" class="btn btn-primary mb-2"  style="margin-left: 80%;" onclick="window.print();" name="printReg">Print Registration Slip</button>
    </form>

    </div>
    <?php
    }


