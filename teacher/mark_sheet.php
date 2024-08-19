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
            <a href="studentgrade.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Student grade</a>
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
                <div class="col-sm-5 col-md-5 col-lg-5"></div>
                <div class="col-sm-2 col-md-2 col-lg-2">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <br>
                    <h5><i>Mark sheet<i></i></h5>
                    <div class="dropdown-divider"></div>
                    <form method="post" action="">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="inputCity">Assessment 1</label>
                                <input type="text" class="form-control" id="inputCity" name="assessment1">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputState">Assessment 2</label>
                                <input type="text" class="form-control" id="inputState" name="assessment2">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputZip">Assessment 3</label>
                                <input type="text" class="form-control" id="inputZip" name="assessment3">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="inputCity">Assessment 4</label>
                                <input type="text" class="form-control" id="inputCity" name="assessment4">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputState">Assessment 5</label>
                                <input type="text" class="form-control" id="inputState" name="assessment5">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputZip">Assessment 6</label>
                                <input type="text" class="form-control" id="inputZip" name="assessment6">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputZip">Assessment 7</label>
                                <input type="text" class="form-control" id="inputZip" name="assessment7">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputZip">Assessment 8</label>
                                <input type="text" class="form-control" id="inputZip" name="assessment8">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="mark_sheet">Save mark_sheet</button>
                        <div class="dropdown-divider"></div>
                    </form>
                </div>
                <?php
                if(isset($_POST['mark_sheet'])){
                    $obj= new Student;
                    $obj-> saveMark_sheet($_GET['course']);
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
