<?php 
include '../profile.php';
include 'departmentform.php';
session_start();
if(empty($_SESSION['uname'])){
    header('location: ../index.php');
}

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
        <link rel="stylesheet" href="../css/fontawesome.min.css">
        <link rel="stylesheet" href="../css/all.min.css">
            <link rel="stylesheet" href="../css/all.css">


    <link rel="stylesheet" href="../layout.css">
    <script src="../js/jquery.js"></script>

    <script src="../js/bootstrap.min.js"></script>
    <script>
        function myfunction() {
            document.getElementById("show").style.display = 'none';
            document.getElementById("result").style.display = 'block';
        }

    </script>
    <script>
        $(document).ready(function() {

            load_data();

            function load_data(query) {
                $.ajax({
                    url: "livesearch.php",
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
     $path= "../uploads/";
      $obj = new Profile;
      echo $obj->displaylong($path,"account", $_SESSION['uname']);
      ?> </div><br>
            <div class="list-group list-group-flush">
                <a href="index.php.php" class="list-group-item list-group-item-action text-white" style="background-color: black;">Add Department</a>



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
                            <button type="submit" class="btn btn-primary" name="add"><img src="../icons/add.png" style="width: 20px; height: 20px;">Add</button>
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
                            <form class="form-inline" method="post" action="index2.php">

                                <div class="input-group-prepend">
                                    <div class="input-group-text"><img src="../icons/search.png" style="width: 20px; height: 20px;"</div>
                                </div>
                                <input class="form-control mr-sm-1" type="text" placeholder="Search department" aria-label="Search" name="search_text" id="search_text" onclick="myfunction()">

                            </form>
                        </nav>
                    </div>
                </div>

                <div class="dropdown-divider"></div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12" id="list"><br>
                        <h5><i>List of departments</i></h5>
                        <div id="show" style="display: block;">
                            <?php
        $obj=new Department;
        $obj->displayDepartment();
      
        ?>
                        </div>
                        <div id="result" style="display: none;">

                        </div>
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
