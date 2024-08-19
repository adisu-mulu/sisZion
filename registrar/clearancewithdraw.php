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
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-1.10.2.js"></script>

    <script>
        $(document).ready(function() {
            $(".assignid").click(function() {
                $("#tablewithid").show();
                $("#tablewithoutid").hide();

            });
        });

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

            <a href="courseregistration.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Registration</a>
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
            <a href="clearancewithdraw.php" class="list-group-item list-group-item-action text-white" style="background-color: black;">Clearance and withdraw</a>
            <a href="gradesetting.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Grade settings</a>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <?php include '../design/contentwrapper.php';?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h3><i>Clearance and withdraw</i></h3>
                        <form method="post" action="">
                            <div class="form-row">


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
                                    <label for="validationCustom03">Username</label>

                                    <input type="text" class="form-control" name="username" placeholder="Enter student ID"  style="border-radius: 5px; height: 37px; width: 305px;">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="clearanceWithdraw">Select</button>
                        </form>
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <?php
                        if(isset($_POST['clearanceWithdraw'])){
                            $obj=new Queries;
                            $obj-> fetchClearanceWithdraw();
                        }
                        if(isset($_GET['id'])=='cleared'){
                            echo "<script>alert('Student cleared');</script>";
                        }
                        ?>

                    </div>

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
<?php
if(isset($_POST['updateDept'])){
    echo "am i really";
    $updateDept=$this->connect()->prepare("UPDATE registeredstudents SET section='".$_POST['section']."', dept='".$_GET['dept']."' where username='".$row['username']."'");

    if($updateDept->execute())
    {
        echo "changes made";
    }
    else echo "query not successful";
}
?>
