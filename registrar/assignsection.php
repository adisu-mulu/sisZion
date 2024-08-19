<?php
session_start();
include '../profile.php';
include 'classes/queries.php';
include_once '../database.php';
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--######### js scripts$$$$$ -->
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/jquery.js"></script>

    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <link rel="stylesheet" href="../layout.css">


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

                        <h3><i>Assign Section</i></h3>
                        <div class="dropdown-divider" style="border-radius: 5px;"></div>

                        <form method="post" action="assignSection.php">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom03">Select department</label>

                                    <select style="border-radius: 5px; height: 37px; width: 350px; position: relative; top: 4px;" onchange="location = this.value;" required>
                                        <option><?php echo $_GET['department'];?></option>
                                        <?php
                        $mydb= new db;
                        $conn=$mydb->connect();
                         $stmnt= $conn->prepare("SELECT * from seat where section=''");
                         $stmnt->execute();
                         $result=$stmnt->fetchAll();
                         foreach($result as $row){
                        ?>

                                        <option value="assignsection.php?department=<?php echo $row['dept'];?>">
                                            <tr>
                                                <td><?php echo $row['dept'];
                                            echo "      "; $obj=new queries;
                                            echo $obj->noOfAssignedStudents($row['dept']);?></td><br>
                                            </tr>
                                        </option>
                                        <?php
}
    ?>
                                    </select>&nbsp&nbsp&nbsp&nbsp
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationCustom03">No of section</label>

                                    <input type="number" class="form-control" name="noOfSection" placeholder="No of section" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="assignsection">Assign Section</button>
                        </form>
                        <?php
                        if(isset($_POST['assignsection'])){
                            
                            $obj=new queries;
                            $obj->assignSection($_SESSION['dept'], $_POST['noOfSection']);
                            $obj->displayStudentsSection($_SESSION['dept']);
                               header("Refresh:0");
                            
                        }
                        if(isset($_GET['department'])){
                            session_start();
                            $_SESSION['dept']= $_GET['department'];
                            $obj=new queries; echo "<BR>";
                           echo "<i>Number of student(s) in this department:  <i>"; echo $obj->noOfAssignedStudents($_GET['department']);
                           
                            $obj->displayStudentsWithId($_GET['department']);
                            
                        }
                        
                     ?>




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
