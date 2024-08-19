<?php
session_start();
include '../profile.php';


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

    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <title>sisZion</title>
</head>

<body>

<nav class="navbar navbar-expand-lg" style="background: #27408B">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="#" style="color: white;">siszion</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <?php
                $path= "../uploads/";
                $obj = new Profile;
                echo $obj->displayshort($path,"account",$_SESSION['uname']);

                ?>

            </li>
        </ul>
    </div>
</nav>

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
            <a href="studentgrade.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Student grade</a>
            <a href="uploadmaterial.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Upload Material</a>
            <a href="sendnotice.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Send Notice</a>
            <a href="fillattendance.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Fill Attendance</a>
            <a href="gradechangereq.php" class="list-group-item list-group-item-action text-white" style="background-color: black;">Request Grade Change</a>
        </div>
    </div>

    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <?php include '../design/contentwrapper.php';?>
        <br>
        <h4>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            Grade change request</h4><br>
        <div class="row">
            <div class="col-sm-1 col-md-1 col-lg-1"></div>
            <div class="col-sm-11 col-md-11 col-lg-11">

                <div class="form-group row">
                    <label for="inputState" class="col-sm-2 col-form-label">Course Title</label>
                    <div>
                        <select id="inputState" class="form-control form-control-sm" >
                            <option selected>CoputerScience</option>
                            <option>Bussines management</option>
                            <option>Accounting</option>
                            <option>...</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputState" class="col-sm-2 col-form-label">Course code</label>
                    <div>
                        <select id="inputState" class="form-control form-control-sm" >
                            <option selected>Comp112</option>
                            <option>Bussmgmt112</option>
                            <option>Acc221</option>
                            <option>...</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="inputState" class="col-sm-2 col-form-label">Semister</label>
                    <div>
                        <select id="inputState" class="form-control form-control-sm" >
                            <option selected>Semister 1</option>
                            <option>Semister 2</option>
                        </select>
                    </div>
                </div>

                <div class="form-group" style="width: 80%;">
                    <label for="exampleFormControlTextarea1"><i>Reason for grade change</i></></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" placeholder="Reason for grade change..."></textarea>
                </div>

                <div>

                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="type student id" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button><br><br><br><br>
                    </form>
                </div>
            <form>
                <table class="table table-striped table-bordered table-hover" style="width: 90%;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>program</th>
                        <th>Department</th>
                        <th>previousGrade</th>
                        <th>changed Grede</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>cs/001</td>
                        <td>alex</td>
                        <td>Regular</td>
                        <td>cs</td>
                        <td>3.3</td>
                        <td><input type="text" name="newGrade"></td>
                    </tr>
                    </tbody>
                </table>
                <div>
                    <button type="submit" class="btn btn-primary" id="GredeChangeButton">Submit Reqest</button><br>
                </div>
            </form>

            </div>

        </div>

    </div>

</div>


    <!-- /#page-content-wrapper -->


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
