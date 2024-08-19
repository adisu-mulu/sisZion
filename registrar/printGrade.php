<?php
/**
 * Created by PhpStorm.
 * User: kul_Hab
 * Date: 6/12/2019
 * Time: 7:45 AM
 */
include_once '../database.php';
session_start();
if(isset($_POST['printGrade'])){
    $mydb= new db;
    $conn=$mydb->connect();
    ?>
<br>
<div style="border: 1px solid black; border-radius: 5px; padding: 20px; width: 80%; margin-left: 5%;">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h3>Zion College of Technology and Business Student Grade Report</h3>
            <table style="width: 100%;">
                <tr style="width: 100%;">
                    <th style="">Name</th>
                    <th>Deparment</th>
                </tr>

                <?php
                $prd=$_SESSION['printPeriod'];
                $username=$_SESSION['printUser'];
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
                    <th>Section &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Semester</th>

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

        $stmnts= $conn->prepare("SELECT *from student_course where username='".$username."' and period= '".$prd."'");
        $stmnts->execute();
        $results=$stmnts->fetchAll();
        foreach($results as $rows){
            $cname= $rows['course'];
            $coursedetail= $conn->prepare("SELECT *from coursebank where coursename='".$cname."'");
            $coursedetail->execute();
            $courselist=$coursedetail->fetchAll();
            foreach($courselist as $list){
                $courseName=$list['coursename'];
                $coursePoints=$conn->prepare("select *from student_grade where course='".$courseName."' and username='".$username."' and period='".$prd."'");
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



        $query1 = $conn->prepare("select * from student_gpa where username='" .$username. "' and period='" .$prd . "'");
        $query1->execute();
        $fetchGPA= $query1->fetchAll();
        foreach($fetchGPA as $value){
            $gpa= $value['gpa'];
        }
        $query2 = $conn->prepare("select * from student_cgpa where username='" . $username . "' and period='" . $prd . "'");
        $query2->execute();
        $fetchCGPA= $query2->fetchAll();
        foreach($fetchCGPA as $value) {
            $cgpa = $value['cgpa'];
        }
        $status = $conn->prepare("select * from cgpa_status where min_cgpa<='" . $cgpa . "' and max_cgpa>='" . $cgpa . "'");
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
    <button type="submit" class="btn btn-primary mb-2" name="search" onclick="window.print();" style="margin-left: 80%;">Print Grade Report</button>
</div>
<?php }