<?php
session_start();

if(empty($_SESSION['uname'])){
    header('location: ../index.php');
}
include '../profile.php';
require_once 'classes/queries.php';
include_once '../database.php';
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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../layout.css">
    <script src="../js/jquery.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
        function checkAllCourses(e) {
            var checkboxes = document.getElementsByName('courselists[]');

            if (e.checked) {
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = true;
                }
            } else {
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = false;
                }
            }
        }

        function checkAllActiveCourses(e) {
            var checkboxes = document.getElementsByName('activeCourses[]');

            if (e.checked) {
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = true;
                }
            } else {
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = false;
                }
            }
        }

    </script>
    <title>sisZion</title>
</head>

<body>
    <?php include '../design/navbar.php';?>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="" id="sidebar-wrapper" style="background-color: #34495E;">
            <div class="sidebar-heading">
                <?php
     $path= "../uploads/";
      $obj = new Profile;
      echo $obj->displaylong($path,"account",$_SESSION['uname']);
      ?> </div><br>

            <div class="list-group list-group-flush">
                <a href="pendingadmission.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Admissions
                    <?php $obj= new Queries;
        	 $obj->requestcount();
        	 ?></a>

                <a href="courseregistration.php" class="list-group-item list-group-item-action text-white" style="background-color: black;">Registration</a>
                <div class="dropdown">
                    <button class="btn btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background: none; color: white;">
                        &nbsp Student
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="studgradereport.php">Grade report</a>
                        <a class="dropdown-item" href="registrationslip.php">Registration slip</a>
                        <a class="dropdown-item" href="calculategrade.php">Calculate grade</a>
                    </div>
                </div>
                <a href="clearancewithdraw.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Clearance and withdraw</a>
                <a href="gradesetting.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Grade settings</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->
        <div id="page-content-wrapper">
            <?php include '../design/contentwrapper.php';?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <h2><i>Course Registration</i></h2>
                    </div>

                </div>
                <div class="dropdown-divider"></div>
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <?php
                        if(isset($_POST['manualreg']) || isset($_GET['id'])){
                            $username= $_POST['studId'];
                        $mydb= new db;
                        $conn=$mydb->connect();
                          $stmnt= $conn->prepare("SELECT * FROM registeredstudents where username='".$username."' or username='".$_GET[id]."'");
             $stmnt->execute();
             $result=$stmnt->fetchAll();
             foreach($result as $row){
                 $studdep=$row['dept'];
                 echo $row['fname'].' '.$row['lname'];
             }
                       
            }
                        ?>
                        <br><br>
                        <i>Currently active courses:</i><br><br>
                        <?php 
                        $stmnts= $conn->prepare("SELECT * FROM active_course where username='".$username."' or username='".$_GET[id]."'");
             $stmnts->execute();
             $results=$stmnts->fetchAll();
                        ?>
                        <form method="post" action="">
                            <?php   
            
             if($stmnts->rowCount()>0){
                 echo "<input type='checkbox' onchange='checkAllActiveCourses(this)'> Check/Uncheck All<br>";
             foreach($results as $rows){
                    $activeperiod= $rows['period'];
                     ?> <input type="checkbox" value="<?php echo $rows['course'];?>" name="activeCourses[]" class="checkbox" checked="checked"> <?php echo $rows['course'];
                     echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
                
             }
             }
        else {
            echo "No active course";
    echo "<br>"; echo "<hr>";
        }   
?>
                            <!--<hr><br><button type="submit" class="btn btn-primary" name="assigncourse">Assign Course</button>-->

                            <div class="form-row">

                                <div class="form-group col-md-5"><br>
                                    <label for="inputState"> Choose Period</label>
                                    <select id="inputState" class="form-control" required onchange="location= this.value;">
                                        <option selected>choose period</option>
                                        <option value="manualreg.php?prd=Year1:Sem1&id=<?php echo $rows['username']?>&dept=<?php echo $row['dept']?>">Year1:Sem1</option>
                                        <option value="manualreg.php?prd=Year1:Sem2&id=<?php echo $rows['username']?>&dept=<?php echo $row['dept']?>">Year1:Sem2</option>
                                        <option value="manualreg.php?prd=Year2:Sem1&id=<?php echo $rows['username']?>&dept=<?php echo $row['dept']?>">Year2:Sem1</option>
                                        <option value="manualreg.php?prd=Year2:Sem2&id=<?php echo $rows['username']?>&dept=<?php echo $row['dept']?>">Year2:Sem2</option>
                                        <option value="manualreg.php?prd=Year3:Sem1&id=<?php echo $rows['username']?>&dept=<?php echo $row['dept']?>">Year3:Sem1</option>
                                        <option value="manualreg.php?prd=Year3:Sem2&id=<?php echo $rows['username']?>&dept=<?php echo $row['dept']?>">Year3:Sem2</option>
                                        <option value="manualreg.php?prd=Year4:Sem1&id=<?php echo $rows['username']?>&dept=<?php echo $row['dept']?>">Year4:Sem1</option>
                                        <option value="manualreg.php?prd=Year4:Sem2&id=<?php echo $rows['username']?>&dept=<?php echo $row['dept']?>">Year4:Sem2</option>
                                    </select>
                                </div>

                            </div>
                            <?php 
                        if(isset($_GET['prd'])){
                                $dept= $_GET['dept'];
                             $prd =$_GET['prd'];
                                $courses=$conn->prepare("SELECT * FROM coursebank where department='".$dept."' AND period='".$prd."'");
             $courses->execute();
                            
             $fetchedcourses=$courses->fetchAll();
            if($courses->rowCount()>0){
                
                 echo "<input type='checkbox' onchange='checkAllCourses(this)'> Check/Uncheck All<br>";
             foreach($fetchedcourses as $courselists){
                     ?> <input type="checkbox" value="<?php echo $courselists['coursename'];?>" name="courselists[]" class="checkbox"> <?php echo $courselists['coursename'];
                     echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
                
             }
             }
        else {
            echo "No course for this period";
    echo "<br>"; echo "<hr>";
        }   
    
    
                                    }
                                ?>
                            <br><br>
                            <button type="submit" class="btn btn-primary" name="manualAssign">Assign course</button>
                        </form>
                    </div>


                </div>

            </div>
        </div>

    </div>
</body>
<?php
                        
                        if(isset($_POST['manualAssign'])){
                           $activecourses= $_POST['activeCourses'];
                            $assignedcourses= $_POST['courselists'];
                            $cperiod= $_GET['period'];
                            $username= $_GET['id'];
                           if($assignedcourses==''){
                               echo "<script>alert ('No course selected to assign');</script>";
                                  exit();
                           }
                           
                             $mydb= new db;
                                $conn=$mydb->connect();
                                
                                $deleteActive=$conn->prepare("delete from active_course where username='".$username."'");
                                $deleteActive->execute();
                            $deleteAssigned=$conn->prepare("delete from student_course where username='".$username."' and period='".$activeperiod."'");
                                $deleteAssigned->execute();
                            if($deleteActive && $deleteAssigned){
                              
                                foreach ($activecourses as $coursename){
                                  
                                    $cmd="insert into student_course(username, course, period) values('$username','$coursename','$activeperiod');";
                                      if($conn->exec($cmd)){
                                            $insertActive="insert into active_course(username, course, period) values('$username','$coursename','$activeperiod');";
                                          $conn->exec($insertActive);
                                        }
                                }
                            
                            foreach ($assignedcourses as $assignedcrs){
                                  
                                    $cmd2="insert into student_course(username, course, period) values('$username','$assignedcrs','$activeperiod');";
                                      if($conn->exec($cmd2)){
                                            $insertAssigned="insert into active_course(username, course, period) values('$username','$assignedcrs','$activeperiod');";
                                          $conn->exec($insertAssigned);
                                        }
                                }
                                 echo "<script>alert('assigned manually');</script>";

                            
                            }
                                else  echo "<script>alert('delete did not work');</script>";

                               
                            }
                              
                      ?>
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

</script>


</html>
