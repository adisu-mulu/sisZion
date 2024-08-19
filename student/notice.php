<?php
session_start();
if(empty($_SESSION['uname'])){
    header('location: ../index.php');
}

include '../profile.php';
include 'classes/queries.php';
$mydb= new db;
$conn=$mydb->connect();
$cmd=$conn->prepare("UPDATE notices SET status=1 where username='".$_SESSION['uname']."'");
$cmd->execute();

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

    <link rel="stylesheet" href="layout.css">
    <script src="../js/jquery.js"></script>
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/w3.css">
    <title>sisZion</title>

</head>

<body>
<?php include '../design/navbar.php';
include 'navbar.php';
?>
<!-- Navigation bar -->

<div class="dropdown-divider"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-1 col-md-1 col-lg-1"></div>
        <div class="col-sm-5 col-md-5 col-lg-5">
            <h4><i>Notices</i></h4><br>

        </div>
        <div class="col-sm-6 col-md-6 col-lg-6">
            <form action="" method="post">
                Between <input type="date" name="from" style="border-radius: 5px; height: 37px; width: 200px; position: relative; top: 0px;" required>
                And&nbsp&nbsp<input type="date" name="and" style="border-radius: 5px; height: 37px; width: 200px; position: relative; top: 0px;" required>
                <button type="submit" class="btn btn-primary" name="fromwhen">Fetch</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1 col-md-1 col-lg-1"></div>
        <div class="col-sm-11 col-md-11 col-lg-11" id="show" style="display: block;"><br><br>
            <?php
            $obj=new queries;
            $notice=$obj->fetchNotices($_SESSION['uname']);
            $result = $notice->fetchAll();
            foreach($result as $row){
                $timestamp = strtotime($row['date']);
                $date = date('d-m-Y', $timestamp);
                $time = date('G.i.s', $timestamp);
                $period= substr( $time,0, 5);
                ?>
                <div style="border: 1px solid black; border-radius: 40px 25px; width: 90%; padding: 5px 15px 5px 5px; background: dimgrey">
            <i style="border: 1px solid gray; border-radius: 5px; background: black; color: white; padding: 10px 5px 5px 5px; margin-left: 30%;"><?php echo $date;?></i><br>
            <div style="background: white; height: auto; padding: 10px 10px 10px 10px; border-radius: 8px;">
                <?php echo $row['notice'];?>
            </div>
                    <i style="border: 1px solid gray; border-radius: 5px; background: black; margin-left: 95%; color: white;"><?php echo $period;?></i>
                </div><br>

            <?php
            }
            ?>
        </div>
        <div id="fromwhen" style="display: none; width: 90%;">

            <?php
            if(isset($_POST['fromwhen'])){
                ?><script>
                    document.getElementById("show").style.display = 'none';
                    document.getElementById("fromwhen").style.display = 'block';
                </script>
            <?php
                $date1=$_POST['from']; $date2= $_POST['and'];
            $notice=$obj->fetchNoticesFromWhen($_POST['from'], $_POST['and']);
            $result = $notice->fetchAll();
            if($notice->rowCount()==0){
                echo "<h2 style='margin-left: 20%;'><br><br>No notices between '$date1' and '$date2'</h2>";
            }else{
            foreach($result as $row){
                $timestamp = strtotime($row['date']);
                $date = date('d-m-Y', $timestamp);
                $time = date('G.i.s', $timestamp);
                $period= substr( $time,0, 5);
                ?>
                <div style="border: 1px solid black; border-radius: 40px 25px; width: 90%; padding: 5px 15px 5px 5px; background: dimgrey">
                    <i style="border: 1px solid gray; border-radius: 5px; background: black; color: white; padding: 10px 5px 5px 5px; margin-left: 30%;"><?php echo $date;?></i><br>
                    <div style="background: white; height: auto; padding: 10px 10px 10px 10px; border-radius: 8px;">
                        <?php echo $row['notice'];?>
                    </div>
                    <i style="border: 1px solid gray; border-radius: 5px; background: black; margin-left: 95%; color: white;"><?php echo $period;?></i>
                </div><br>

                <?php
            }}}
            ?>
        </div>
    </div>

</div>
<!-- script for the accordion-->

<script>
    function activeCourses(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }

</script>

</body>


</html>
