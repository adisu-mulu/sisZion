<?php
error_reporting(0);
session_start();
if(empty($_SESSION['uname'])){
    header('location: ../index.php');
}

include '../profile.php';
include 'classes/queries.php';

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

    <div class="row">
        <div class="col-sm-2 col-md-2 col-lg-2"><br><br>

        </div>
        <div class="col-sm-8 col-md-8 col-lg-8"><br><br>
            <h5><i>Your Continous Assessment<i></i></h5>
            <?php
            $obj= new Queries;
            $selectAssessmentStructure=$obj->fetchAssessmentStructure($_GET['Iuname'],$_GET['cname'],$_GET['period']);
            $colNo=$selectAssessmentStructure->rowCount();
            $assessmentStructure=$selectAssessmentStructure->fetchAll();
            ?>
            <table style="width: 100%;">
                <tr>
                    <?php
                    foreach($assessmentStructure as $mark) {
                        ?>
                        <th><?php echo $mark['structure']; ?></th>
                        <?php
                    }
                    ?>
                </tr>
            </table>
            <table style="width: 100%;">
                <tr>
                    <?php
                    $obj= new Queries;
                    $fetchMark=$obj->fetchMark($_SESSION['uname'], $_GET['cname'], $_GET['period']);
                    $studMark=$fetchMark->fetchAll();
                    foreach($studMark as $mark){
                        if($mark['assessment1']!=''){
                        ?>
                        <td><?php echo $mark['assessment1']; ?></td>
                            <?php
                        }
                            ?>
                        <?php
                        if($mark['assessment2']!=''){
                            ?>
                            <td><?php echo $mark['assessment2']; ?></td>
                            <?php
                        }
                        ?>
                        <?php
                        if($mark['assessment3']!=''){
                            ?>
                            <td><?php echo $mark['assessment3']; ?></td>
                            <?php
                        }
                        ?>
                        <?php
                        if($mark['assessment4']!=''){
                            ?>
                            <td><?php echo $mark['assessment4']; ?></td>
                            <?php
                        }
                        ?>
                        <?php
                        if($mark['assessment5']!=''){
                            ?>
                            <td><?php echo $mark['assessment5']; ?></td>
                            <?php
                        }
                        ?>
                        <?php
                        if($mark['assessment6']!=''){
                            ?>
                            <td><?php echo $mark['assessment6']; ?></td>
                            <?php
                        }
                        ?>
                        <?php
                        if($mark['assessment7']!=''){
                            ?>
                            <td><?php echo $mark['assessment7']; ?></td>
                            <?php
                        }
                        ?>
                        <?php
                        if($mark['assessment8']!=''){
                            ?>
                            <td><?php echo $mark['assessment8']; ?></td>
                            <?php
                        }
                    }
                    ?>
                </tr>
            </table>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2"><br><br>

        </div>
    </div>

</div>
<!-- script for the accordion-->

<script>
    function myFunction(id) {
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
