<?php
session_start();
error_reporting(0);
include '../profile.php';
include 'classes.php';
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
            <a href="index.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Assign Instructor
            </a>
            <a href="gradeSettings.php" class="list-group-item list-group-item-action text-white" style="background-color: black;">Grade Settings</a>

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
                    <br>
                    <h5><i>Grade range</i></h5>
                    <form method="post" action="">
                        <div class="form-row">
                            <label for="inputState">A+</label><br>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputState" name="A+min" min="" placeholder="min" required>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputZip" name="A+max" placeholder="max" max="100" required>
                            </div>

                            <label for="inputState">A</label>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputState" name="Amin" placeholder="min" required>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputZip" name="Amax" placeholder="max" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <label for="inputState">A-</label><br>

                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputState" name="A-min" placeholder="min" required>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputZip" name="A-max" placeholder="max" required>
                            </div>

                            <label for="inputState">B+</label><br>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputState" name="B+min" placeholder="min" required>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputZip" name="B+max" placeholder="max" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <label for="inputState">B</label><br>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputState" name="Bmin" min="3" placeholder="min" required>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputZip" name="Bmax" placeholder="max" max="4" required>
                            </div>

                            <label for="inputState">B-</label>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputState" name="B-min" placeholder="min" required>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputZip" name="B-max" placeholder="max" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <label for="inputState">C+</label><br>

                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputState" name="C+min" placeholder="min" required>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputZip" name="C+max" placeholder="max" required>
                            </div>

                            <label for="inputState">C</label><br>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputState" name="Cmin" placeholder="min" required>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputZip" name="Cmax" placeholder="max" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <label for="inputState">C-</label><br>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputState" name="C-max" min="3" placeholder="min" required>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputZip" name="C-min" placeholder="max" max="4" required>
                            </div>

                            <label for="inputState">D+</label>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputState" name="D+min" placeholder="min" required>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputZip" name="D+max" placeholder="max" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <label for="inputState">D</label><br>

                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputState" name="Dmin" placeholder="min" required>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputZip" name="Dmax" placeholder="max" required>
                            </div>

                        </div>
                        <div class="form-row">
                            <label for="inputState">Fx</label><br>

                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputState" name="FXmin" placeholder="min" required>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputZip" name="FXmax" placeholder="max" required>
                            </div>

                        </div>
                        <div class="form-row">
                            <label for="inputState">F</label><br>

                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" id="inputState" name="Fmin" placeholder="min" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="gradeRange">Submit</button>
                        <div class="dropdown-divider"></div>
                    </form>
                </div>

                <?php
                if(isset($_POST['gradeRange'])){
                    $obj=new Queries;
                    $obj->gradeRange();
                }
                ?>

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
