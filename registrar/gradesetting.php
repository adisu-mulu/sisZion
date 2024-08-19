<?php
session_start();

if(empty($_SESSION['uname'])){
    header('location: ../index.php');
}
include '../profile.php';
include 'classes/queries.php';
$obj=new Queries;
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
            <a href="clearancewithdraw.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Clearance and withdraw</a>
            <a href="gradesetting.php" class="list-group-item list-group-item-action text-white" style="background: black; color: white;">Grade settings</a>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <?php include '../design/contentwrapper.php';?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h3><i>Grade settings</i>
                       </h3>
                    <div class="dropdown-divider" style="border-radius: 5px;"></div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                <form method="post" action="">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="inputCity">A+</label>
                            <input type="text" class="form-control" id="inputCity" name="A+" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputState">A</label>
                            <input type="text" class="form-control" id="inputState" name="A" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip">A-</label>
                            <input type="text" class="form-control" id="inputZip" name="A-" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="inputCity">B+</label>
                            <input type="text" class="form-control" id="inputCity" name="B+" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputState">B</label>
                            <input type="text" class="form-control" id="inputState" name="B" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip">B-</label>
                            <input type="text" class="form-control" id="inputZip" name="B-" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="inputCity">C+</label>
                            <input type="text" class="form-control" id="inputCity" name="C+" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputState">C</label>
                            <input type="text" class="form-control" id="inputState" name="C" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip">C-</label>
                            <input type="text" class="form-control" id="inputZip" name="C-" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip">D+</label>
                            <input type="text" class="form-control" id="inputZip" name="D+" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip">D</label>
                            <input type="text" class="form-control" id="inputZip" name="D" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip">Fx</label>
                            <input type="text" class="form-control" id="inputZip" name="Fx" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip">F</label>
                            <input type="text" class="form-control" id="inputZip" name="F" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" name="gradesettings">Submit</button>
                    <div class="dropdown-divider"></div>
                    </form>
                    <?php
                    if(isset($_POST['gradesettings'])){

                        $obj=new Queries;
                        $obj->gradeSetting();
                    }
                    ?>
                </div>

                <div class="col-12-12 col-md-12 col-lg-12">
                    <h3><i>Passing points(CGPA)</i>
                    </h3>
                    <div class="dropdown-divider" style="border-radius: 5px;"></div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">

                    <form method="post" action="">
                        <div class="form-row">

                            <div class="form-group col-md-2">
                                <label for="inputState">Year1:Sem2</label>
                                <input type="text" class="form-control" id="inputState" name="y1s2" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputZip">Year2:Sem1</label>
                                <input type="text" class="form-control" id="inputZip" name="y2s1" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="inputCity">Year2:Sem2</label>
                                <input type="text" class="form-control" id="inputCity" name="y2s2" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputState">Year3:Sem1</label>
                                <input type="text" class="form-control" id="inputState" name="y3s1" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputZip">Year3:Sem2</label>
                                <input type="text" class="form-control" id="inputZip" name="y3s2" required>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="inputCity">Year4:Sem1</label>
                                <input type="text" class="form-control" id="inputCity" name="y4s1" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputState">Year4:Sem2</label>
                                <input type="text" class="form-control" id="inputState" name="y4s2" required>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary" name="passingCGPA">Submit</button>
                        <div class="dropdown-divider"></div>
                    </form>
                    <?php
                    if(isset($_POST['passingCGPA'])){
                        $obj=new Queries;
                        $obj->passingCGPASetting();
                    }
                    ?>
                </div>
                <div class="col-12-12 col-md-12 col-lg-12">
                    <h3><i>Grade status</i>
                    </h3>
                    <div class="dropdown-divider" style="border-radius: 5px;"></div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <form method="post" action="">
                        <div class="form-row">
                            <label for="inputState">Great Distinction</label><br>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputState" name="greatDistinctionMin" min="3" placeholder="min" required>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputZip" name="greatDistinctionMax" placeholder="max" max="4" required>
                            </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

                            <label for="inputState">Distinction</label>&nbsp&nbsp&nbsp&nbsp
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputState" name="distinctionMin" placeholder="min" required>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputZip" name="distinctionMax" placeholder="max" required>
                            </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                        </div>
                        <div class="form-row">
                            <label for="inputState">First Class</label><br>
                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputState" name="firstClassMin" placeholder="min" required>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputZip" name="firstClassMax" placeholder="max" required>
                            </div>
                            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                            <label for="inputState">Second Class</label><br>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputState" name="secondClassMin" placeholder="min" required>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputZip" name="secondClassMax" placeholder="max" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="gradeStatus">Submit</button>
                        <div class="dropdown-divider"></div>
                    </form>
                    <?php
                    if(isset($_POST['gradeStatus'])){
                        $obj=new Queries;
                        $obj->gradeStatusSetting();
                    }
                    ?>
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

