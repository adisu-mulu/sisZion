<?php
session_start();
if(empty($_SESSION['uname'])){
    header('location: ../index.php');
}

include '../profile.php';
include 'classes/queries.php';
$mydb= new db;
$conn=$mydb->connect();
$drole= $conn->prepare("SELECT * from registeredstudents where username='".$_SESSION['uname']."'");
$drole->execute();
$result=$drole->fetchAll();
foreach($result as $row){
    $_SESSION['dept'] = $row['dept'];
    $_SESSION['section'] = $row['section'];
    $_SESSION['batch']=$row['batch'];

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
            <div class="col-sm-12 col-md-5 col-lg-5"><br><br>
                <h4><i>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Courses currently active</i></h4><br>
                <?php
                    $obj= new queries;
                $obj-> fetchActiveCourses($_SESSION['uname']);
                ?>
            </div>
            <div class="col-sm-12 col-md-2 col-lg-2"><br><br>

            </div>
            <div class="col-sm-12 col-md-5 col-lg-5"><br><br>
                <h4><i>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Semester GPA and CGPA using chart</i></h4><br>
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
