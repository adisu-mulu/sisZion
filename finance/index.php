<?php 
include_once '../profile.php';
include_once 'classes/queries.php';
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
<?php
    if(isset($_GET['report'])){
        $report=$_GET['report'];
        echo "<script> alert('i am a report for $report');</script>";
    }
    ?>

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
                <a href="index.php" class="list-group-item list-group-item-action text-white" style="background-color: black;" active>Registration payment
                    <?php $obj= new Queries;
           $obj->passedToFinanceRequestCount();
           ?>
                </a>

                <a href="academic_payments.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Academics payment</a>
                <a href="clearanceWithdraw.php" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Clearance and Withdraw</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->
        <div id="page-content-wrapper">
            <?php include '../design/contentwrapper.php';?>

            <div class="container-fluid">

                <h2><i>Pending registration payment</i>
                    <?php $obj= new Queries;
           $obj->passedToFinanceRequestCount();
           ?>
                </h2>


                <div class="dropdown-divider" style="border-radius: 5px;"></div>
                <?php $obj= new Queries;
           $obj->fetchRequestsentToFinance();
           ?>
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
