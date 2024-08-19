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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <link rel="stylesheet" href="../layout.css">
    <!--######### js scripts$$$$$ -->

    <script src="../js/jquery.js"></script>
    <script src="../ckeditor/ckeditor.js"></script>
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <title>sisZion</title>
</head>

<body>



<nav class="navbar navbar-expand-lg" style="background: #27408B"">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
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
            <a href="studentgrade.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Student grade</a>
            <a href="uploadmaterial.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Upload Material</a>
            <a href="sendnotice.php" class="list-group-item list-group-item-action text-white" style="background-color: black;">Send Notice</a>
            <a href="fillattendance.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Fill Attendance</a>
            <a href="gradechangereq.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Request Grade Change</a>
        </div>
    </div>

    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <?php include '../design/contentwrapper.php';?>
       <br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <form method="post" action="">
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
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom03">Batch</label>

                            <select style="border-radius: 5px; height: 37px; width: 305px; position: relative; top: 0px;" name="batch">

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
                        </div><br><br><br><br><br>
                        <div class="form-group col-md-10" >
                            <label for="inputState">Notice here</label>
                            <textarea class="form-control ckeditor" rows="10" placeholder="Notice..." name="notice" required="true" style="border: 1px solid black;"></textarea>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary" name="sendNotice">Send</button>

                </form>
                <?php
                if(isset($_POST['sendNotice'])){

                    $obj= new Student;
                    $obj->sendNotice();
                }
                ?>
            </div>
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
