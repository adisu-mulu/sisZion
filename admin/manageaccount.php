<?php
include '../profile.php';
include 'fetchaccount.php';
error_reporting(0);
session_start();
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

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="dropdown-divider" style="border-radius: 5px;"></div>
                        <button style="background: darkgray; text-color: black; width: 80%; text-align: left;">
                            <h5><i id="activateButtonclick" style="text-decoration: none;">Activate account</i></h5>
                        </button>
                        <br>
                        <form method="post" action="manageaccount.php" id="activateaccount" style="display: none;">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <i> <label for="inputEmail4">Staff Account</label></i>
                                    <div class="input-group mb-2">

                                        <div class="input-group-prepend">
                                            <div class="input-group-text">@</div>
                                        </div>
                                        <input type="text" class="form-control" name="username" placeholder=" staff username">
                                    </div>
                                </div>
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
?>
                        <script type="text/javascript">
                            document.getElementById('activateaccount').style.display = 'block';

                        </script>
                        <?php
$obj= new manageAccount;
$obj->activateAccount($staffuname, $studid);
}
$val= $_GET['value'];

  if($val=="activated")
    echo "<h2><i>Account activated</i><h2>"
    ?>
                    </div>
                </div>


                <!-- Deactivate account-->

                <div class="row">

                    <div class="col-sm-12 col-md-12 col-lg-12"><br>
                        <!--Update account-->
                        <div class="dropdown-divider"></div>
                        <h5><i id="deactivateButtonclick">Deactivate account</i></h5>
                        <br>
                        <form method="post" action="manageaccount.php" id="deactivateaccount" style="display: none;">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <i> <label for="inputEmail4">Staff Account</label></i>
                                    <div class="input-group mb-2">

                                        <div class="input-group-prepend">
                                            <div class="input-group-text">@</div>
                                        </div>
                                        <input type="text" class="form-control" name="username" placeholder=" staff username">
                                    </div>
                                </div>
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
                <!-- change password or reactivate account-->
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12"><br>
                        <!--Update account-->
                        <div class="dropdown-divider" style="border-radius: 5px;"></div>
                        <h5><i id="updatePasswordclick">Change password/Reactivate account</i></h5>
                        <br>
                        <form method="post" action="manageaccount.php" id="updatePassword" style="display: none;">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <i> <label for="inputEmail4">Staff Account</label></i>
                                    <div class="input-group mb-2">

                                        <div class="input-group-prepend">
                                            <div class="input-group-text">@</div>
                                        </div>
                                        <input type="text" class="form-control" name="username" placeholder=" staff username">
                                    </div>
                                </div>
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
    echo "<h2><i>Password changed</i><h2>"
    ?>


                    </div>
                </div>

                <div class="dropdown-divider"></div>
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
