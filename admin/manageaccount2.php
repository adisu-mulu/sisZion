<?php
error_reporting(0);
session_start();
if(empty($_SESSION['uname'])){
    header('location: ../index.php');
}
include '../profile.php';
include 'fetchaccount.php';



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
    <script src=".../js/jquery.js"></script>
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/w3.css">
    <style>
        h5 {
            color: rgb(0, 0, 255);
        }

        h5:hover {

            text-decoration: underline;
        }

    </style>
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
                <a href="studgradereport.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Manage account</a>

                <a href="registrationslip.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">###</a>


            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php 
                $obj=new Profile;
               echo $obj->profileImageName("../uploads/","account",$_SESSION['uname']);
                ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Change Password</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">View Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">Log Out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- activate account--><br><br>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-8">

                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne">Activate Account</button>
                                    </h2>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <form method="post" action="manageaccount2.php" id="activateaccount">
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <i> <label for="inputEmail4">Staff Account</label></i>
                                                    <div class="input-group mb-2">

                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">@</div>
                                                        </div>
                                                        <input type="text" class="form-control" name="username" placeholder=" staff username">
                                                    </div>
                                                </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                <div class="form-group col-md-4">
                                                    <i><label for="inputPassword4">Student Account</label></i>
                                                    <input type="text" class="form-control" id="inputPassword4" placeholder="student id" name="studid">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary" name="submit">Search
                                            </button>
                                        </form>
                                        <?php
    if(isset($_POST['submit'])){
$staffuname= $_POST['username'];
$studid=$_POST['studid'];
                                       
                                   
$obj= new manageAccount;
$obj->activateAccount($staffuname, $studid);
}
$val= $_GET['value'];

  if($val=="activated")
    echo "<h2><i>Account activated</i><h2>"
    ?>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="accordion" id="accordionExample2">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo">Deactivate Account</button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample2">
                                    <div class="card-body">
                                        <form method="post" action="manageaccount2.php" id="deactivateaccount">
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <i> <label for="inputEmail4">Staff Account</label></i>
                                                    <div class="input-group mb-2">

                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">@</div>
                                                        </div>
                                                        <input type="text" class="form-control" name="username" placeholder=" staff username">
                                                    </div>
                                                </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                <div class="form-group col-md-4">
                                                    <i><label for="inputPassword4">Student Account</label></i>
                                                    <input type="text" class="form-control" id="inputPassword4" placeholder="student id" name="studid">
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary" name="deactivate">Search
                                            </button>

                                        </form>
                                        <?php
    if(isset($_POST['deactivate'])){
$staffuname= $_POST['username'];
$studid=$_POST['studid'];
?>
                                        <script type="text/javascript">
                                            document.getElementById('deactivateaccount').style.display = 'block';

                                        </script>
                                        <?php
$obj= new manageAccount;
$obj->deactivateaccount($staffuname, $studid);
}
$val= $_GET['value'];

  if($val=="deactivated")
    echo "<h2><i>Account deactivated</i><h2>"
    ?>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="accordion" id="accordionExample3">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseThree">Reactivate Account</button>
                                    </h2>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample3">
                                    <div class="card-body">
                                        <form method="post" action="manageaccount2.php" id="updatePassword">
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <i> <label for="inputEmail4">Staff Account</label></i>
                                                    <div class="input-group mb-2">

                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">@</div>
                                                        </div>
                                                        <input type="text" class="form-control" name="username" placeholder=" staff username">
                                                    </div>
                                                </div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                <div class="form-group col-md-4">
                                                    <i><label for="inputPassword4">Student Account</label></i>
                                                    <input type="text" class="form-control" id="inputPassword4" placeholder="student id" name="studid">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary" name="update">Search
                                            </button>
                                        </form>
                                        <?php
    if(isset($_POST['update'])){
$staffuname= $_POST['username'];
$studid=$_POST['studid'];
?>
                                        <script type="text/javascript">
                                            document.getElementById('updatePassword').style.display = 'block';

                                        </script>
                                        <?php
$obj= new manageAccount;
$obj->updatePassword($staffuname, $studid);
}
$val= $_GET['value'];

  if($val=="updated")
    echo "<h2><i>Account reactivated</i><h2>"
    ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-12 col-md-2 col-lg-2">

                    </div>
                    <div class="col-sm-12 col-md-2 col-lg-2">

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /#wrapper -->
    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
        $("#activateButtonclick").click(function() {
            $("#activateaccount").toggle();
        });
        $("#updatePasswordclick").click(function() {
            $("#updatePassword").toggle();
        });
        $("#deactivateButtonclick").click(function() {
            $("#deactivateaccount").toggle();
        });

    </script>


    <!-- $$$$$ page contents start here $$$$-->

    <!-- $$$$$ page contents end here$$$$-->

</body>


</html>
