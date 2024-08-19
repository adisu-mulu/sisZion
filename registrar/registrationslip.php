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

    <title>sisZion</title>
</head>
<script>
    function myFunction() {
        document.getElementById("GPA").style.display="block";
    }
    function CGPA() {
        document.getElementById("CGPA").style.display="block";
    }
</script>
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

            <a href="courseregistration.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Registration</a>
            <div class="dropdown">
                <button class="btn btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="background: none; color: white;">
                    &nbsp Student
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="studgradereport.php">Grade report</a>
                    <a class="dropdown-item" href="registrationslip.php" style="background-color: black;">Registration slip</a>
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
                    <h2><i>Student registration slip</i></h2>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-1 col-md-1 col-lg-1"></div>
                <div class="col-sm-11 col-md-11 col-lg-11">
                    <form method="post" action="">
                        <div class="form-row">

                            <div class="form-group col-md-3">
                                <label for="inputState">Period</label>
                                <select id="inputState" class="form-control" name="period" required>
                                    <option value="Year1:Sem1">Year1:Sem1</option>
                                    <option value="Year1:Sem2">Year1:Sem2</option>
                                    <option value="Year2:Sem1">Year2:Sem1</option>
                                    <option value="Year2:Sem2">Year2:Sem2</option>
                                    <option value="Year3:Sem1">Year3:Sem1</option>
                                    <option value="Year3:Sem2">Year3:Sem2</option>
                                    <option value="Year4:Sem1">Year4:Sem1</option>
                                    <option value="Year4:Sem2">Year4:Sem2</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom03">Username</label>

                                <input type="text" class="form-control" name="username" placeholder="Enter student ID"  style="border-radius: 5px; height: 37px; width: 305px;">
                            </div>
                            <div class="col-md-4 mb-3">
                                <br>
                                <label for="validationCustom03">     </label>
                                <button type="submit" class="btn btn-primary" name="regSlip" >Fetch slip</button>
                            </div>

                        </div>

                    </form>

                </div>
                <?php
                if(isset($_POST['regSlip'])) {
                    $obj = new Queries;
                    $obj->fetchRegistrationSlip();
                    echo"<br>";

                }

                ?>
            </div>


            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <?php
                    if(isset($_POST['calculateGPA'])){
                        ?>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <form action="" method="post" id="CGPA"><br>
                                    <button type="submit" class="btn btn-primary" name="calculateCGPA">Calculate CGPA</button><br>
                                </form>
                            </div>
                        </div>
                        <?php
                        $obj= new Queries;
                        $obj->calculateGPA($_SESSION['dept'], $_SESSION['GPAperiod']);
                    }
                    ?>
                </div>
            </div>
            <?php
            if(isset($_POST['calculateCGPA'])){
                $obj= new Queries;
                $obj->calculateCGPA($_SESSION['dept'], $_SESSION['GPAperiod']);
            }
            ?>
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
