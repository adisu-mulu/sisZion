<?php
session_start();

if(empty($_SESSION['uname'])){
    header('location: ../index.php');
}
include '../profile.php';
require_once 'classes/queries.php';
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
        function checkAllStudents(e) {
            var checkboxes = document.getElementsByName('selectedStudent[]');

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

        function checkAllCourses(e) {
            var checkboxes = document.getElementsByName('selectedCourse[]');

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
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <form class="form-inline my-2 my-lg-0" style="padding-top: 8px;" method="post" action="manualreg.php">
                            <input class="form-control mr-sm-2" type="search" placeholder="Enter student id" aria-label="Search" name="studId" required>
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="manualreg">Search</button>
                        </form>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="dropdown-divider" style="border-radius: 5px;"></div>

                        <form method="post" action="">
                            <div class="form-row">
                                <div class="col-md-3 mb-3" style="padding-right: 10px;">
                                    <label for="validationCustom03">Select department</label>
                                    <select style="border-radius: 5px; height: 37px; width: 305px; position: relative; top: 0px;" name="department" onchange="location = this.value;">
                                        <option><?php echo $_GET['sdept'];?></option>
                                        <?php
                        $mydb= new db;
                        $conn=$mydb->connect();
                         $stmnt= $conn->prepare("SELECT * from department");
                         $stmnt->execute();
                         $result=$stmnt->fetchAll();
                         foreach($result as $row){
                        ?>

                                        <option value="courseregistration.php?sdept=<?php echo $row['name'];?>">
                                            <tr>
                                                <td><?php echo $row['name'];
                                           ?></td><br>
                                            </tr>
                                        </option>
                                        <?php
}
    ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom03">Batch</label>

                                    <select style="border-radius: 5px; height: 37px; width: 305px; position: relative; top: 0px;" name="batch">
                                        <option></option>
                                        <?php
                                        $mydb= new db;
                                        $conn=$mydb->connect();
                                        $stmnt= $conn->prepare("SELECT distinct batch from registeredstudents");
                                        $stmnt->execute();
                                        $result=$stmnt->fetchAll();
                                        foreach($result as $row){

                                            ?>

                                            <option>
                                                <tr>
                                                    <td><?php echo $row['batch'];
                                                        ?></td><br>
                                                </tr>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputState">Period</label>
                                    <select id="inputState" class="form-control" name="period" required>
                                        <option selected>Year1:Sem1</option>
                                        <option>Year1:Sem2</option>
                                        <option>Year2:Sem1</option>
                                        <option>Year2:Sem2</option>
                                        <option>Year3:Sem1</option>
                                        <option>Year3:Sem2</option>
                                        <option>Year4:Sem1</option>
                                        <option>Year4:Sem2</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom03">Section (optional)</label>

                                    <input type="number" class="form-control" name="section" placeholder="" min="1" style="border-radius: 5px; height: 37px; width: 305px;">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" name="select">Select</button>

                        </form>
                        <?php
                        if(isset($_POST['select'])){
                            
                           $dept= $_POST['department'];
                            $section=$_POST['section'];
                            $period=$_POST['period'];
                            $_SESSION['period']=$period;
                           
       
       echo "<br>";
        echo "<h4><i>Courses to be assigned</i></h4>";
        $stmnt= $conn->prepare("SELECT * FROM coursebank where department='".$dept."' and period = '".$period."'");
             $stmnt->execute();
             $result=$stmnt->fetchAll();
//       if($section!=""){
//       $stud= $conn->prepare("select * from registeredstudents where dept='".$dept."' and section='".$section."'");
//       $stud->execute();
//       $studres= $stud->fetchAll();
//
//       } else
                if($period=='Year1:Sem1') {

                    $stud = $conn->prepare("select * from registeredstudents where dept='" . $dept . "'");
                    $stud->execute();
                    $studres = $stud->fetchAll();
                }
                else if($period=='Year1:Sem2') {
                    $passPt=$conn->prepare("select * from passing_points where period='Year1:Sem2'");
                    $passPt->execute();
                    $currFetch=$passPt->fetchAll();
                    foreach($currFetch as $cgpa){
                        echo $cgpa=$cgpa['cgpa'];
                    }
                    $stud = $conn->prepare("select * from student_cgpa, registeredstudents where registeredstudents.username=student_cgpa.username and period='Year1:Sem1' and cgpa>='$cgpa'");
                    $stud->execute();
                    $studres = $stud->fetchAll();
                    foreach($studres as $name){
                        $name['fname'];
                    }
                }
                else if($period=='Year2:Sem1') {
                    $curr=$conn->prepare("select *from passing_points where period='Year2:Sem1'");
                    $curr->execute();
                    $currFetch=$curr->fetchAll();
                    foreach($currFetch as $cgpa){
                        $cgpa=$cgpa['cgpa'];
                    }
                    $stud = $conn->prepare("select * from student_cgpa, registeredstudents where registeredstudents.username=student_cgpa.username and period='Year1:Sem2' and cgpa>='$cgpa'");
                    $stud->execute();
                    $studres = $stud->fetchAll();
                }
                else if($period=='Year2:Sem2') {
                    $curr=$conn->prepare("select *from passing_points where period='Year2:Sem2'");
                    $curr->execute();
                    $currFetch=$curr->fetchAll();
                    foreach($currFetch as $cgpa){
                        $cgpa=$cgpa['cgpa'];
                    }
                    $stud = $conn->prepare("select * from student_cgpa, registeredstudents where registeredstudents.username=student_cgpa.username and period='Year2:Sem1' and cgpa>='$cgpa'");
                    $stud->execute();
                    $studres = $stud->fetchAll();
                }
                else if($period=='Year3:Sem1') {
                    $curr=$conn->prepare("select *from passing_points where period='Year3:Sem1'");
                    $curr->execute();
                    $currFetch=$curr->fetchAll();
                    foreach($currFetch as $cgpa){
                        $cgpa=$cgpa['cgpa'];
                    }
                    $stud = $conn->prepare("select * from student_cgpa, registeredstudents where registeredstudents.username=student_cgpa.username and period='Year2:Sem2' and cgpa>='$cgpa'");
                    $stud->execute();
                    $studres = $stud->fetchAll();
                }
                else if($period=='Year3:Sem2') {
                    $curr=$conn->prepare("select *from passing_points where period='Year3:Sem2'");
                    $curr->execute();
                    $currFetch=$curr->fetchAll();
                    foreach($currFetch as $cgpa){
                        $cgpa=$cgpa['cgpa'];

                    }
                    $stud = $conn->prepare("select * from student_cgpa, registeredstudents where registeredstudents.username=student_cgpa.username and period='Year3:Sem1' and cgpa>='$cgpa'");
                    $stud->execute();
                    $studres = $stud->fetchAll();
                }
                else if($period=='Year4:Sem1') {
                    $curr=$conn->prepare("select *from passing_points where period='Year2:Sem2'");
                    $curr->execute();
                    $currFetch=$curr->fetchAll();
                    foreach($currFetch as $cgpa){
                        $cgpa=$cgpa['cgpa'];
                    }
                    $stud = $conn->prepare("select * from student_cgpa, registeredstudents where registeredstudents.username=student_cgpa.username and period='Year3:Sem2' and cgpa>='$cgpa'");
                    $stud->execute();
                    $studres = $stud->fetchAll();
                }
                else  {
                    $curr=$conn->prepare("select *from passing_points where period='Year4:Sem2'");
                    $curr->execute();
                    $currFetch=$curr->fetchAll();
                    foreach($currFetch as $cgpa){
                        $cgpa=$cgpa['cgpa'];
                    }
                    $stud = $conn->prepare("select * from student_cgpa, registeredstudents where registeredstudents.username=student_cgpa.username and period='Year4:Sem1' and cgpa>='$cgpa'");
                    $stud->execute();
                    $studres = $stud->fetchAll();
                }
       //}
      
        // creating form
       ?> <form method="post" action="">
                            <?php   
            
             if($stmnt->rowCount()>0){
                 echo "<input type='checkbox' onchange='checkAllCourses(this)'> Check/Uncheck All<br><br>";
             foreach($result as $row){
                 
                 if($row['prerequisite']!=""){
                     ?> <input type="checkbox" value="<?php echo $row['coursename'];?>" name="selectedCourse[]" class="checkbox"> <?php echo $row['coursename'].' (prerequisite: '.$row['prerequisite'].')';
                     echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
                 } 
                 else {
    ?><input type="checkbox" value="<?php echo $row['coursename'];?>" name="selectedCourse[]"> <?php echo $row['coursename']; echo " ";
                      echo "&nbsp&nbsp&nbsp&nbsp&nbsp"; 
                      }
             }
             }
        else {
            echo "No courses available";
    echo "<br>"; echo "<hr>";
        }
       echo "<script src='../js/jquery-3.4.1.min.js'></script>";echo "<br><br>";
       echo "<h4><i>Students list</i></h4>";
        echo "<div  style='display: block;'><input type='checkbox' onchange='checkAllStudents(this)' id='checkstuds'> Check/Uncheck All<br><br></div>";
      
            $count=0;
           foreach($studres as $studlist){
                $digit= strlen($studlist['username'])-2;
            $batch= substr ($studlist['username'], $digit);
              
               if($batch== substr($_POST['batch'],2)){
                   ?> <input type="checkbox" value="<?php echo $studlist['username'];?>" name="selectedStudent[]"> <?php echo $studlist['fname'].' '.$studlist['lname'].' (Id: '.$studlist['username'].' '.' Section: '.$studlist['section'].')';
                     echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
                   $count++;
               }
           }
       if($count==0){
           echo "No students available";
           echo "<script> document.getElementById('checkstuds').style.display=none;</script>";
       }
       
?>
                            <hr><br><button type="submit" class="btn btn-primary" name="assigncourse">Assign Course</button>

                        </form>

                        <?php
                        }
                                               
                        
                        if(isset($_POST['assigncourse'])){
                           $selectedcourse= $_POST['selectedCourse'];
                            $studlist= $_POST['selectedStudent'];
                            $cperiod= $_SESSION['period'];
                           if($selectedcourse==''){
                               echo "<script>alert ('No course selected to assign');</script>";
                                  exit();
                           }
                             if($studlist==''){
                                echo "<script>alert ('No student selected to assign');</script>";
                                  exit();
                            }
                            foreach($studlist as $studid){
                                 $mydb= new db;
                                $conn=$mydb->connect();
                                
                                $deleteActive=$conn->prepare("delete from active_course where username='".$studid."'");
                                $deleteActive->execute();
                                if($deleteActive){
                                  
                                foreach ($selectedcourse as $coursename){
                                  
                                    $cmd="insert into student_course(username, course, period) values('$studid','$coursename','$cperiod');";
                                      if($conn->exec($cmd)){
                                            $insertActive="insert into active_course(username, course, period) values('$studid','$coursename','$cperiod');";
                                          $conn->exec($insertActive);
                                        }
                                }}
                                else echo "delete did not work";
                               
                            }
                               echo "<script>alert('course assigned')</script>";  
                        }
                      ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

</script>

</html>
