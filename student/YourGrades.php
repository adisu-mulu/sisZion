<?php
error_reporting(0);
session_start();
if(empty($_SESSION['uname'])){
    header('location: ../index.php');
}

include '../profile.php';
include 'classes/queries.php';

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="layout.css">
    <script src="../js/jquery.js"></script>
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/w3.css">
    <title>sisZion</title>
</head>

<body>
    <?php include '../design/navbar.php';
      include 'navbar.php';
      ?>
    <!-- Navigation bar -->

    <div class="dropdown-divider"></div>

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12 col-md-5 col-lg-5"><br><br>
                <h4><i>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Semesters</i></h4><br>
                <?php
                   $username = $_SESSION['uname'];
                 $mydb= new db;
                        $conn=$mydb->connect();
        $stmnt= $conn->prepare("SELECT distinct period from student_course where username='".$username."'");
             $stmnt->execute();
             $result=$stmnt->fetchAll();
        foreach($result as $row){
            $prd=$row['period'];
                 ?>
                <div class="w3-container">

                    <a href="YourGrades.php?prd=<?php echo $prd; ?>"><button class="w3-btn w3-block w3-gray w3-left-align"><?php echo $row['period']; ?></button></a>
                    <div class="dropdown-divider"></div>
                </div>
                <?php
    }
       
                ?>
            </div>
            <div class="col-sm-12 col-md-2 col-lg-2"><br><br>

            </div>
            <div class="col-sm-12 col-md-5 col-lg-5"><br><br>
                <h4><i>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Performance</i></h4><br>
                <div style="border: 1px solid black; border-radius: 5px; padding-left: 20px;">
                    <table style="width: 100%;">
                        <tr>
                            <td style="">Course</td>
                            <td style="">Credit Hour</td>
                            <td style="">Grade</td>
                            <td style="">Mark</td>
                            <td style="">Total Points</td>
                        </tr>
                        <?php 
                      $prd=$_GET['prd'];
                      $username=$_SESSION['uname'];
             $stmnts= $conn->prepare("SELECT *from student_course where username='".$username."' and period= '".$prd."'");
             $stmnts->execute();
             $results=$stmnts->fetchAll();
             foreach($results as $rows){
                 $cname= $rows['course'];
                 $coursedetail= $conn->prepare("SELECT *from coursebank where coursename='".$cname."'");
             $coursedetail->execute();
             $courselist=$coursedetail->fetchAll();
             foreach($courselist as $courseName){
                 $courseInstructor= $courseName['coursename'];

                 $dept=$_SESSION['dept'];
                 $sect=$_SESSION['section'];
                                      $instFetch= $conn->prepare("select * from active_teachers where course='".$courseInstructor."' and department='".$dept."' and section='".$sect."' and period='".$prd."'");
                                       $instFetch->execute();
                                      $instInfo=$instFetch->fetchAll();
                                      foreach($instInfo as $Iname){
                                         $InstructorUsername= $Iname['username'];
                                      }
                 ?>
                        <tr>
                        <td><i><a href="continousAssessment.php?Iuname=<?php echo $InstructorUsername;?> && cname=<?php echo $courseName['coursename'];?> && period=<?php echo $prd;?>" style="color: blue;"><?php echo $courseName['coursename'].' ('.$courseName['coursecode'].')';?></a></i></td>
                        <td><i><?php echo $courseName['credithour'];?></i></td>



                                <?php
                                }
                                ?>

                    <?php
                foreach($courselist as $list){
                    $courseName=$list['coursename'];
                    $coursePoints=$conn->prepare("select *from student_grade where course='".$courseName."' and username='".$username."' and period='".$prd."'");
                    $coursePoints->execute();
                     $fetchCoursePoints=$coursePoints->fetchAll();
                     foreach($fetchCoursePoints as $points){
                         $grade= $points['grade'];
                         $mark=$points['mark'];
                         $total=$points['total_points'];

                     $dept=$_SESSION['dept'];
                     $sect=$_SESSION['section'];
//                     $instFetch= $conn->prepare("select username from active_teachers where course='".$courseName."' and department='".$dept."' and section='".$sect."' and period='".$prd."'");
//                      $instFetch->execute();
//                     $instInfo=$instFetch->fetchAll();
//                     foreach($instInfo as $Iname){
//                         $InstructorUsername= $Iname['username'];
//                     }
//
//            ?>

                            <td><i><?php echo $grade;?></i></td>
                            <td><i><?php echo $mark;?></i></td>
                            <td><i><?php echo $total?></i></td>
                        </tr>

                         <?php
                    }
                        }
                        ?>
                    </table>
                    <?php
}

                        if(isset($_GET['prd'])) {
                    $prd=$_GET['prd'];
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
                        }
                        else {
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
                                    <td> <?php echo "Not calculated" ?></td>
                                    <td> <?php echo "Not calculated"; ?></td>
                                    <td> <?php echo "Not calculated"; ?></td>
                                </tr>
                            </table>
                    <?php

                        }?>
                    <div class="dropdown-divider"></div>
                </div>
            </div>
        </div>

    </div>
    <!-- script for the accordion-->

    <script>
        function myFunction(id) {
            var x = document.getElementById(id);
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }

    </script>


</body>


</html>
