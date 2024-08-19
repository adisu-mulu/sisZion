<?php
/**
 * Created by PhpStorm.
 * User: kul_Hab
 * Date: 6/8/2019
 * Time: 6:59 AM
 */



include_once '../profile.php';
include_once 'queries.php';
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

            <a href="index.php" class="list-group-item list-group-item-action text-white" style="background-color: black;">Clearance and Withdraw</a>

        </div>
    </div>
    <!-- /#sidebar-wrapper -->
    <div id="page-content-wrapper">
        <?php include '../design/contentwrapper.php';?>

        <div class="container-fluid">

            <h2><i>Student clearance and withdraw</i></h2>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <form method="post" action="">
                        <div class="form-row">


                            <div class="form-group col-md-3">
                                <label for="inputState">Period</label>
                                <select id="inputState" class="form-control" name="period" required>
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
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom03">Username</label>

                                <input type="text" class="form-control" name="username" placeholder="Enter student ID"  style="border-radius: 5px; height: 37px; width: 305px;">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="clearanceWithdraw">Select</button>
                    </form>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <?php
                    if(isset($_POST['clearanceWithdraw'])){
                        $obj=new Queries;
                        $obj-> fetchClearanceWithdraw();
                    }
                    if(isset($_GET['id'])=='cleared'){
                        echo "<script>alert('Student cleared');</script>";
                    }
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
