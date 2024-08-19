<?php
session_start();
include '../../profile.php';

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">


    <link rel="stylesheet" href="../../layout.css">
    <!--######### js scripts$$$$$ -->
    <script src="../../js/jquery.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/jquery-1.10.2.js"></script>

    <title>sisZion</title>
</head>

<body>

    <?php include '../../design/navbar.php';?>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="" id="sidebar-wrapper" style="background-color: #34495E;">
            <div class="sidebar-heading">
                <?php
     $path= "../../uploads/";
      $obj = new Profile;
      echo $obj->displaylong($path,"account",$_SESSION['uname']);
      ?> </div><br>
            <div class="list-group list-group-flush">
                <a href="studgradereport.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Student grade report</a>

                <a href="registrationslip.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Registration slip</a>
                <a href="studentcopy.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Student copy</a>
                <a href="pendingadmission.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Admission
                    <?php
                    include '../classes/queries.php'; 
                    $obj= new Queries;
           $obj->requestcount();
           ?>

                </a>
                <a href="clearancewithdraw.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Clearance/Withdraw</a>

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
                                Name
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Change Password</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">View Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Log Out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>



            <div class="dropdown-divider"></div>
            <h2>&nbsp&nbsp Pending request</h2>
            <i> &nbsp&nbsp <?php echo $_GET["id"];?></i>

            <div class="dropdown-divider"></div>

            <!--form-->
            <?php $name= $_GET['id'];?>
            <form method="post" action="../../classes/approved.php?id=<?php echo $name;?>" style="padding: 10px 10px 10px 5px;">

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputCity">Assign ID</label>
                        <input type="text" class="form-control" id="inputCity" required="" name="assignID">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="inputState">Assign Department</label>
                        <select id="inputState" class="form-control" required name="assignDept">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputZip">Assign Section</label>
                        <input type="text" class="form-control" id="inputZip" required="" name="assignSec">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" name="submit">Approve request</button>
                <a href="../pendingadmission.php" style="border: 1px solid red; background: red;color: white; border-radius: 5px;padding:5px 5px 10px 5px;">Cancel request</a>
            </form>
            <!-- /#page-content-wrapper -->
            <div id="senttofinance">
                <?php 
        if($_GET['id']=="Approved")
          //echo "<h2 style='margin-left: 25%;'><i>Request approved and sent to finance</i></h2>";
          ?>
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

    </script>



    <!-- $$$$$ page contents start here $$$$-->

    <!-- $$$$$ page contents end here$$$$-->

</body>

</html>
