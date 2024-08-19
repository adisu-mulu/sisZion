<?php
session_start();
if(empty($_SESSION['uname'])){
    header('location: ../index.php');
}

include '../profile.php';
include 'classes/queries.php';
$mydb= new db;
$conn=$mydb->connect();


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

    <link rel="stylesheet" href="../layout.css">
    <script src="../js/jquery.js"></script>
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/w3.css">
    <title>sisZion</title>
</head>
<style>
    table, td, th {
        border: 1px solid #ddd;
        text-align: left;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        padding: 15px;
    }
</style>
<body>
<?php include '../design/navbar.php';
include 'navbar.php';
?>
<!-- Navigation bar -->

<div class="dropdown-divider"></div>

<div class="container-fluid">
    <br><br>
<div class="row">
    <div class="col-sm-1 col-md-1 col-lg-1"></div>
    <div class="col-sm-3 col-md-3 col-lg-3">
        <h4><i>Attendance</i></h4><br>

    </div>
    <div class="col-sm-7 col-md-7 col-lg-7">
        <form action="" method="post">
        <select style="border-radius: 5px; height: 37px; width: 305px; position: relative; top: 0px;" name="status">
            <option selected="selected" value="all">All attendance</option>
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
            <option value="Permit">Permit</option>
            <?php
            $stmnt= $conn->prepare("SELECT * FROM active_course where username='".$_SESSION['uname']."'");
            $stmnt->execute();
            $result=$stmnt->fetchAll();
            foreach($result as $row){
                ?>
            <option value="<?php echo $row['course'];?>"><?php echo $row['course']; ?></option>
            <?php
            }?>
        </select>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            Between <input type="date" name="from" style="border-radius: 5px; height: 37px; width: 150px; position: relative; top: 0px;">
            And&nbsp&nbsp<input type="date" name="and" style="border-radius: 5px; height: 37px; width: 150px; position: relative; top: 0px;">
            <button type="submit" class="btn btn-primary" name="fetch">Fetch</button>
        </form>
    </div>
    </div>
</div>
    <div class="row">
        <div class="col-sm-1 col-md-1 col-lg-1"></div>
        <div class="col-sm-11 col-md-11 col-lg-11"><br><br>
            <?php
            $obj = new queries;
            if(isset($_POST['fetch'])){

                $attendance = $obj->fetchAttendance();
                $result = $attendance->fetchAll();
            }
            else{
                $stmnt = $conn->prepare("SELECT * FROM attendance where username='" . $_SESSION['uname'] . "' order by date desc");
                $stmnt->execute();
                $result = $stmnt->fetchAll();
            }
            ?>
            <table style="width: 80%;">
                <tr>
                    <th style="">Course Name</th>
                    <th style="">Status</th>
                    <th style="">Date</th>


                </tr>
                <?php
                foreach($result as $rows){
                    $timestamp = strtotime($rows['date']);
                    $date = date('d-m-Y', $timestamp);

                    ?>
                    <tr>
                        <td><i><?php echo $rows['course'];?></i></td>
                        <td><i><?php echo $rows['attendance'];?></i></td>
                        <td><i><?php echo $date?></i></td>
                    </tr>
                    <?php
                }?>
            </table>
        </div>
    </div>

</div>
<!-- script for the accordion-->


</body>


</html>
