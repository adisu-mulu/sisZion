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
                <a href="pendingadmission.php" class="list-group-item list-group-item-action text-white" style="background-color: black;">Admissions
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
                        <h3><i>Pending admission requests:</i>
                            <?php $obj= new queries;
        	 $obj->requestcount();
        	 ?></h3>
                        <div class="dropdown-divider" style="border-radius: 5px;"></div>
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-lg-4">


                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4"></div>
                                <div class="col-sm-12 col-md-4 col-lg-4">

                                    <form class="form-inline" method="post" action="">

                                        <div class="form-group mx-sm-2 mb-2 mb-2">

                                            <input type="text" class="form-control" placeholder="search student" name="id" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2" name="search">Search</button>
                                    </form>
                                </div>
                            </div>
                            <?php
                            if(isset($_POST['search'])){
                                $obj=new queries;
                                $obj->changeStudDept($_POST['id']);
                                
                            }
                            
                            ?>
                            <div class="dropdown-divider" style="border-radius: 5px;"></div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-lg-4">

                                    <form method="post" action="">
                                        <button type="submit" class="btn btn-primary" name="assign" id="mylink">Allocate department</button>
                                    </form>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4"></div>
                                <div class="col-sm-12 col-md-4 col-lg-4">


                                </div>
                            </div>
                        </div>



                        <div id="tablewithid" style="display: none;">

                            <a href="assignsection.php">Click here to assign section</a>
                            <?php
                            
                            $obj=new queries;
                            $obj->generateId();
                            
                            ?>

                        </div>
                        <div id="tablewithoutid">

                            <?php
                            
                        if(isset($_POST['assign'])){
                             echo "department allocation done"; echo "<br>";
                            echo "<a href='#' class='assignid'>Click here to generate Id</a>";
                            $obj= new queries;
                            $obj->allocateDepartment();
                            $obj->fetchrequest();
                            exit();
                            
                        }
                            else{
                        $obj= new queries;
                        $obj->fetchrequest();
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
