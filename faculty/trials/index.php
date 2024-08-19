<?php 
include '../profile.php';
include 'departmentform.php';
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
    <script src="../js/jquery.js"></script>

    <script src="../js/bootstrap.min.js"></script>

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
      echo $obj->displaylong($path,"account", $_SESSION['uname']);
      ?> </div><br>
            <div class="list-group list-group-flush">
                <a href="studgradereport.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">###</a>

                <a href="registrationslip.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">#####</a>
                <a href="studentcopy.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">#####</a>
                <a href="pendingadmission.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">#####</a>
                <a href="clearancewithdraw.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">#####</a>

            </div>
        </div>
        <!-- /#sidebar-wrapper -->
        <div id="page-content-wrapper">
            <?php include '../design/contentwrapper.php';?>

            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <?php
        if(isset($_POST['add'])){

          $deptname= $_POST['deptname'];
          $depthead=$_POST['depthead'];
          $deptprefix=$_POST['deptprefix'];
          $deptfaculty=$_POST['deptfaculty'];

          $obj = new Department;
          $obj->addDepartment($deptname, $depthead, $deptprefix, $deptfaculty); 
        }
      ?>

                        <form method="post" action="index.php" style="padding: 10px 10px 10px 5px;">
                            <h3><i>Add new department</i></h3>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputCity">Department Name</label>
                                    <input type="text" class="form-control" id="inputCity" required="" name="deptname" placeholder="dept name">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputZip">Department Head</label>
                                    <input type="text" class="form-control" id="inputZip" required="" name="depthead" placeholder="@username">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputZip">Department Prefix</label>
                                    <input type="text" class="form-control" id="inputZip" required="" name="deptprefix" placeholder="dept prefix">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputState">Faculty</label>
                                    <select id="inputState" class="form-control" required name="deptfaculty">
                                        <option selected>Business</option>
                                        <option>Technology</option>
                                    </select>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary" name="add">Add</button>
                        </form>
                        <div class="dropdown-divider"></div>
                    </div>

                </div>
                <!-- second row-->
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4"></div>
                    <div class="col-sm-12 col-md-4 col-lg-4"></div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <nav class="navbar navbar-light bg-light">
                            <form class="form-inline" method="post" action="index.php">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search department" aria-label="Search" name="searchDep">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search_dept">Search</button>
                            </form>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <?php
        if(isset($_POST['search_dept'])){
            
          $obj=new Department;
          $obj->deptSearch();
          ?>
                        <script>
                            document.getElementById("list").style.display = "none";

                        </script>
                        <?php
        }?>
                    </div>
                </div><br>
                <div class="dropdown-divider"></div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12" id="list"><br>
                        <h5><i>List of departments</i></h5>
                        <?php
        $obj=new Department;
        $obj->displayDepartment();
      
        ?>
                    </div>

                </div>
            </div>
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
