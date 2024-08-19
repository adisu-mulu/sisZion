<?php
include '../profile.php';
require_once 'classes/queries.php';
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
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-1.10.2.js"></script>

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
      echo $obj->displaylong($path);
      ?> </div><br>
            <div class="list-group list-group-flush">
                <a href="studgradereport.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Student grade report</a>

                <a href="registrationslip.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Registration slip</a>
                <a href="studentcopy.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Student copy</a>
                <a href="pendingadmission.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Admission</a>
                <a href="clearancewithdraw.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Clearance/Withdraw</a>
                <a href="gradesetting.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Grade settings</a>

            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <?php include '../design/contentwrapper.php';?>
            <div class="container-fluid">


                <h2>come home</h2>
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
