<?php
session_start();

if(empty($_SESSION['uname'])){
    header('location: ../index.php');
}
include '../profile.php';
require_once '../registrar/classes/queries.php';
include_once '../database.php';
include 'query.php';
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../layout.css">
    <!--######### js scripts$$$$$ -->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-1.10.2.js"></script>
    <script>
        function myfunction(){
            document.getElementById("show").style.display = 'none';
            document.getElementById("result").style.display = 'block';
        }

    </script>
    <script>
        $(document).ready(function() {

            load_data();

            function load_data(query) {
                $.ajax({
                    url: "coursesearch.php",
                    method: "post",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#result').html(data);
                    }
                });
            }

            $('#search_text').keyup(function() {
                var search = $(this).val();
                if (search != ' ') {
                    load_data(search);
                } else {
                    load_data();
                }
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
     $path= "uploads/";
      $obj = new Profile;
      echo $obj->displaylong($path,"account",$_SESSION['uname']);
      ?>
            </div><br>
            <div class="list-group list-group-flush">
                <a href="studgradereport.php" class="list-group-item list-group-item-action text-white" style="background-color: black;">Add course</a>

<!--                <a href="registrationslip.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">########</a>-->
<!--                <a href="studentcopy.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">######</a>-->
<!--                <a href="pendingadmission.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">####</a>-->
<!--                <a href="clearancewithdraw.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">##</a>-->

            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <?php include '../design/contentwrapper.php';?>
            <div class="container-fluid">
                <h2><i>Add course</i></h2>
                <div class="row">
                    <div class="col-sm-12 col-md-10 col-lg-10">
                        <form method="post" action="curriculum.php">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputState">Department</label>
                                    <select id="inputState" class="form-control" name="department" required>

                                        <?php
                        $mydb= new db;
                        $conn=$mydb->connect();
                         $stmnt= $conn->prepare("SELECT * from department");
                         $stmnt->execute();
                         $result=$stmnt->fetchAll();
                         foreach($result as $row){
                        ?>

                                        <option>
                                            <tr>
                                                <td><?php echo $row['name'];
                                           
                                          ?></td><br>
                                            </tr>
                                        </option>
                                        <?php
}
    ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputCity">Course Name</label>
                                    <input type="text" class="form-control" id="inputCity" name="coursename" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="inputZip">Course code</label>
                                    <input type="text" class="form-control" id="inputZip" name="coursecode" required>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="inputCity">Credit hour</label>
                                    <input type="number" class="form-control" id="inputCity" name="credithour" required min="1">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputState">Period</label>
                                    <select id="inputState" class="form-control" name="period">
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
                                <div class="form-group col-md-4">
                                    <label for="inputZip">Prerequisite</label>
                                    <input type="text" class="form-control" id="inputZip" name="prerequisite">
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary" name="addcourse"><img src="../icons/add.png"style="width: 20px; height: 20px;"> Add course</button>
                        </form>
                        <div class="dropdown-divider">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2 col-lg-2">
                    </div>
                </div>
                <!-- second row-->
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4"></div>
                    <div class="col-sm-12 col-md-4 col-lg-4"></div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <nav class="navbar navbar-light bg-light">
                            <form class="form-inline" method="post" action="curriculum.php">
                                <input class="form-control" type="text" placeholder="Search course" aria-label="Search" name="search_text" id="search_text" onclick="myfunction()">

                            </form>
                        </nav>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12" id="list"><br>
                        <h5><i>List of courses</i></h5>
                        <div id="show" style="display: block;">
                            <?php
                        $obj= new query;
                            $obj-> viewCourses();
                            
      
        ?>
                        </div>
                        <div id="result" style="display: none;">

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
    <?php

    if(isset($_POST['addcourse'])){
        
        $obj=new query;
        echo $obj->addCourse();
        //$obj-> viewCourses();
    }
?>
</body>

</html>
