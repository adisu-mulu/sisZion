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
                url: "materiallivesearch.php",
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
<?php include '../design/navbar.php';
include 'navbar.php';
?>
<!-- Navigation bar -->

<div class="dropdown-divider"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-1 col-md-1 col-lg-1"></div>
        <div class="col-sm-8 col-md-8 col-lg-8">
            <h4><i>Material</i></h4><br>

        </div>
        <div class="col-sm-3 col-md-3 col-lg-3">
            <form class="form-inline" method="post" action="">
                <input class="form-control" type="text" placeholder="Search material" aria-label="Search" name="search_text" id="search_text" onclick="myfunction()">

            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-1 col-md-1 col-lg-1" ></div>
        <div class="col-sm-11 col-md-11 col-lg-11" id="show"><br><br>

            <?php
            $obj=new queries;
            $material=$obj->fetchMaterial();
            $result = $material->fetchAll();
            foreach($result as $row){
                $timestamp = strtotime($row['date']);
                $date = date('d-m-Y', $timestamp);
                $time = date('G.i.s', $timestamp);
                $period= substr( $time,0, 4);
                $ext= pathinfo($row['material'], PATHINFO_EXTENSION);
                ?>
                <div style="border: 1px solid black; border-radius: 40px 25px; width: 90%; padding: 5px 15px 5px 5px; background: dimgrey">
                    <i style="border: 1px solid gray; border-radius: 5px; background: black; color: white; padding: 10px 5px 5px 5px; margin-left: 30%;"><?php echo $date;?></i><br>
                    <div style="background: white; height: auto; padding: 10px 10px 10px 10px; border-radius: 8px;">
                        <?php
                        echo $row['attachment'];
                        if($ext=='PNG' || $ext=='jpeg' || $ext=='jpg'){
                            ?>
                            <img height="30" width="40" src="../icons/png.png"><br>
                        <?php
                        }
                        else if($ext=='pdf'){
                            ?>
                            <img height="30" width="40" src="../icons/pdf.png"><br>
                            <?php
                        }
                        else if($ext=='docx'){
                            ?>
                            <img height="30" width="40" src="../icons/docx.png"><br>
                            <?php
                        }
                        else if($ext=='ppt' || $ext=='pptx'){
                            ?>
                            <img height="30" width="40" src="../icons/ppt.png"><br>
                            <?php
                        }
                        else{
                            ?>
                            <img height="30" width="40" src="" alt=""><br>
                            <?php
                        }
                        echo $row['material'];?>
                        <a href="download.php?id=<?php echo $row['path'];?>"><img height="30" width="40" src="../icons/download.png" alt="" style="margin-left: 95%;"></a>
                    </div>
                    <i style="border: 1px solid gray; border-radius: 5px; background: black; margin-left: 95%; color: white;"><?php echo $period;?></i>
                </div><br>

                <?php
            }
            ?>
        </div>
        <div id="result" style="display: none; width: 90%;">

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
