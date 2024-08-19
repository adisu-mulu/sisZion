<?php
session_start();
error_reporting(0);
include '../profile.php';
//include 'classes/queries.php';
$mydb= new db;
$conn=$mydb->connect();
$drole= $conn->prepare("SELECT * from user_mgmnt where username='".$_SESSION['uname']."'");
$drole->execute();
$result=$drole->fetchAll();
foreach($result as $row){
    $_SESSION['user_role'] = $row['user_role'];
    $user_role=$row['user_role'];
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <link rel="stylesheet" href="../layout.css">
    <!--######### js scripts$$$$$ -->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-1.10.2.js"></script>

    <script>
        function checkAllInstructors(e) {
            var checkboxes = document.getElementsByName('selectedInstructors[]');

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
            var checkboxes = document.getElementsByName('selectedCourses[]');

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
            <a href="index.php" class="list-group-item list-group-item-action text-white" style="background-color: black;">Assign Instructor
            </a>
            <a href="gradeSettings.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Grade Settings</a>

            <a href="approveGrade.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Approve Grade</a>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <?php include '../design/contentwrapper.php';?>

        <div class="container-fluid">
            <div class="row">

                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="dropdown-divider" style="border-radius: 5px;"></div>

                    <form method="post" action="">
                        <div class="form-row">
                            <div class="col-md-3 mb-3" style="padding-right: 15px;">
                                <label for="validationCustom03">Department</label>
                                <input type="text" class="form-control" name="defined_dept" value="<?php $_SESSION['user_role']?>" placeholder="<?php echo $_SESSION['user_role'];?>" readonly>

                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputState">Section</label>
                                <select style="border-radius: 5px; height: 37px; width: 305px; position: relative; top: 0px;" name="section">
                                    <option>1</option>
                                    <?php

                                    $stmnt= $conn->prepare("SELECT distinct section from registeredstudents");
                                    $stmnt->execute();
                                    $result=$stmnt->fetchAll();
                                    foreach($result as $row){

                                        ?>

                                        <option>
                                            <tr>
                                                <td><?php echo $row['section'];
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

                        </div>

                        <button type="submit" class="btn btn-primary" name="select">Select</button>

                    </form>

                    <?php
                        if(isset($_POST['select'])){

                           $dept= $_POST['defined_dept'];

                            $_SESSION['section']=$_POST['section'];
                            $period=$_POST['period'];
                            $_SESSION['period']=$period;

       echo "<br>";
        echo "<h4><i>Available Instructors</i></h4>";
                            $staffFetch= $conn->prepare("SELECT staff.username, staff.fname, staff.lname, user_mgmnt.user_role from staff, user_mgmnt where staff.username=user_mgmnt.username and staff.role='Instructor' and user_mgmnt.user_role='".$user_role."' ");
                            $staffFetch->execute();
                            $Staffresult=$staffFetch->fetchAll();

                            //course fetch query
                            $courseFetch= $conn->prepare("SELECT *from coursebank where department='".$user_role."' and period='".$period."' ");
                            $courseFetch->execute();
                            $Courseresult=$courseFetch->fetchAll();


        // creating form
       ?> <form method="post" action="">
                            <?php

             if($staffFetch->rowCount()>0){
                 echo "<input type='checkbox' onchange='checkAllInstructors(this)'> Check/Uncheck All<br><br>";
             foreach($Staffresult as $row){

    ?><input type="checkbox" value="<?php echo $row['username'];?>" name="selectedInstructors[]"> <?php echo $row['fname'].' '.$row['lname']; echo " ";
                      echo "&nbsp&nbsp&nbsp&nbsp&nbsp";

             }
             }
        else {
            echo "No Instructor available";
    echo "<br>"; echo "<hr>";
        }
       echo "<script src='../js/jquery-3.4.1.min.js'></script>";echo "<br><br>";
       echo "<h4><i>Courses</i></h4>";
        echo "<div  style='display: block;'><input type='checkbox' onchange='checkAllCourses(this)' id='checkstuds'> Check/Uncheck All<br><br></div>";

            $count=0;
           foreach($Courseresult as $course){



                   ?> <input type="checkbox" value="<?php echo $course['coursename'];?>" name="selectedCourses[]"> <?php echo $course['coursename'];
                     echo "&nbsp&nbsp&nbsp&nbsp&nbsp";
                   $count++;

           }
       if($count==0){
           echo "No course available";
           echo "<script> document.getElementById('checkstuds').style.display=none;</script>";
       }

?>
                            <hr><br><button type="submit" class="btn btn-primary" name="assigncourse">Assign Course</button>

                        </form>

                        <?php
                        }

                    if(isset($_POST['assigncourse'])){
                        $selectedcourse= $_POST['selectedCourses'];
                        $instlist= $_POST['selectedInstructors'];
                        $cperiod= $_SESSION['period'];
                        $section=$_SESSION['section'];
                        if($selectedcourse==''){
                            echo "<script>alert ('No course selected to assign');</script>";
                            exit();
                        }
                        if($instlist==''){
                            echo "<script>alert ('No Instructor selected to assign');</script>";
                            exit();
                        }
                        foreach($instlist as $list){

                            $prvP= $conn->prepare("SELECT * from active_teachers where username='".$list."'");
                            $prvP->execute();
                            $prvPresult=$prvP->fetchAll();
                            foreach($prvPresult as $row){
                               $prevP= $row['period'];
                            }
                            if($prevP!= $cperiod) {
                                $deleteActive = $conn->prepare("delete from active_teachers where username='" . $list . "'");
                                $deleteActive->execute();
                            }


                                foreach ($selectedcourse as $coursename){

                                    $cmd="insert into teacher_course(username, course,department, section, period) values('$list','$coursename','$user_role','$section','$cperiod');";
                                    if($conn->exec($cmd)){
                                        $insertActive="insert into active_teachers(username, course,department, section, period) values('$list','$coursename','$user_role','$section','$cperiod');";
                                        $conn->exec($insertActive);
                                    }
                                }


                        }
                        echo "<script>alert('course assigned')</script>";
                    }

                    ?>
                </div></div>



        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->
<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

</script>



<!-- $$$$$ page contents start here $$$$-->

<!-- $$$$$ page contents end here$$$$-->

</body>

</html>
