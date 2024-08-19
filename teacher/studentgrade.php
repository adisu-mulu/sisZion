<?php
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../layout.css">
    <!--######### js scripts$$$$$ -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <script src="../js/jquery.js"></script>

    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <title>sisZion</title>
</head>
<body>
<nav class="navbar navbar-expand-lg" style="background: #27408B"">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        </i><span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="#" style="color: white;">siszion</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <?php
                $path= "../uploads/";
                $obj = new Profile;
                echo $obj->displayshort($path,"account",$_SESSION['uname']);
                ?>
            </li>
        </ul>
    </div>
</nav>

<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="" id="sidebar-wrapper" style="background-color: #34495E;">
        <div class="sidebar-heading">
            <?php
            $path= "../uploads/";
            $obj = new Profile;
            echo $obj->displaylong($path,"account", $_SESSION['uname']);
            ?> </div><br>
        <div class="list-group list-group-flush">
            <a href="studentgrade.php" class="list-group-item list-group-item-action text-white" style="background-color: black;">Student grade</a>
            <a href="uploadmaterial.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Upload Material</a>
            <a href="sendnotice.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Send Notice</a>
            <a href="fillattendance.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Fill Attendance</a>
            <a href="gradechangereq.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Request Grade Change</a>
        </div>
    </div>

    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <?php include '../design/contentwrapper.php';?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5 col-md-5 col-lg-5"></div>
                <div class="col-sm-2 col-md-2 col-lg-2"></div>
                <div class="col-sm-12 col-md-12 col-lg-12">

                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="col-md-3 mb-3" style="padding-right: 15px;">
                                <label for="validationCustom03">Select department</label>

                                <select style="border-radius: 5px; height: 37px; width: 305px; position: relative; top: 0px;" name="dept">

                                    <?php
                                    $mydb= new db;
                                    $conn=$mydb->connect();
                                    $stmnt= $conn->prepare("SELECT DISTINCT department from active_teachers where username='".$_SESSION['uname']."'");
                                    $stmnt->execute();
                                    $result=$stmnt->fetchAll();
                                    foreach($result as $row){
                                        ?>

                                        <option>
                                            <tr>
                                                <td><?php echo $row['department'];
                                                    ?></td><br>
                                            </tr>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
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
                            </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                            <div class="form-group col-md-3">
                                <label for="inputState">Section</label>
                                <select style="border-radius: 5px; height: 37px; width: 305px; position: relative; top: 0px;" name="section">
                                    <?php
                                    $stmnt= $conn->prepare("SELECT DISTINCT section from active_teachers where username='".$_SESSION['uname']."'");
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
                                <label for="inputState">Course</label>
                                <select style="border-radius: 5px; height: 37px; width: 305px; position: relative; top: 0px;" name="course">
                                    <?php
                                    $stmnt= $conn->prepare("SELECT DISTINCT course from active_teachers where username='".$_SESSION['uname']."'");
                                    $stmnt->execute();
                                    $result=$stmnt->fetchAll();
                                    foreach($result as $row){
                                        ?>
                                        <option>
                                            <tr>
                                                <td><?php echo $row['course'];
                                                    ?></td><br>
                                            </tr>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                <label for="inputState">Browse Grade from excel</label>
                              <input type="file" class="form-control" name="excelGrade" onchange="showDoc.call(this)" id="doc" style="margin-left: 13%;" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="fetchGradeExcel" >Submit Grade</button>

                    </form>
                    <script type="text/JavaScript">

                        function showDoc(){
                            var fileinput= document.getElementById("doc");
                            var filepath=fileinput.value;
                            var allowedext=/(\.csv)$/i;

                            if(!allowedext.exec(filepath)){
                                alert("please choose a csv file");
                                fileinput.value='';
                                return false;
                            }
                            else {

                                if(this.files && this.files[0])
                                {
                                    var obj= new FileReader();
                                    obj.readAsDataURL(this.files[0]);
                                }
                            }
                        }
                    </script>
                    <?php
                    if(isset($_POST['fetchGradeExcel'])){
                        $obj= new Student;
                        $obj->fetchGradeExcel();
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <br>
                    <h5><i>Active Course<i></i></h5>
                    <div class="dropdown-divider"></div>
                    <?php
                    $obj = new Student;
                    $activeCourse=$obj->fetchActiveCourse();
                    $result=$activeCourse->fetchAll();
                            ?>
                   <br>
                    <table style="width: 132%;">
                        <tr>
                            <td style="">Course Name</td>
                            <td style="">Action</td>
                        </tr>
                        <?php
                        foreach($result as $rows){
                            ?>
                            <tr>
                                <td><a href="studentgrade.php?course=<?php echo $rows['course'];?> && dept=<?php echo $rows['department'];?> && sec=<?php echo $rows['section'];?> && prd=<?php echo $rows['period'];?>"><i><?php echo $rows['course'];?></i></a></td>
                                <td><a href="mark_sheet.php?course=<?php echo $rows['course'];?> && dept=<?php echo $rows['department'];?> && sec=<?php echo $rows['section'];?> && prd=<?php echo $rows['period'];?>"><i>Create mark sheet</i></a></td>
                            </tr>
                            <?php
                        }?>
                        </table>
                </div></div>
            <div class="dropdown-divider"></div>
            <div class="row">
                   <div class="col-sm-12 col-md-12 col-lg-12">
                       <?php
                       if(isset($_GET['course'])){

                           $obj= new Student;
                           $obj->fetchMyStudents();
                       }
                       ?>
                   </div>
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
