<?php

include_once 'classes/queries.php';
include_once '../database.php';

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="layout.css">
    <title>sisZion</title>
    <style>
        body {
            text-decoration-color: black;
        }

    </style>

    <script>
        var id;
        var fchoice;
        var schoice;
        var tchoice;

        function allowDrop(ev) {
            ev.preventDefault();
        }

        function dragStart(ev) {
            id = ev.target.id;

        }

        function drop(ev) {
            var choice = ev.target.id;
            ev.target.append(document.getElementById(id));
            if (choice == 'fchoice') {
                document.getElementById("firstc").value = id;
            }
            if (choice == 'schoice') {
                document.getElementById("secondc").value = id;

            }
            if (choice == 'tchoice') {
                var txt1 = document.getElementById("thirdc").value = id;
            }
        }
        $.post("../student/tvetregistration", {
            fchoice: fchoice,
            schoice: schoice,
            tchoice: tchoice
        });

    </script>

</head>

<body>
    <div class="container-fluid" style="background-color: #27408B;">
        <div class="row">


            <div class="col-sm-12 col-md-4 col-lg-4">

                <!-- Image and text -->
                <nav class="navbar">

                    <img src="../images/logo.png" width="200" height="100" class="d-inline-block align-top">
                    <i style="color: black;">Zion College of Business and Technology</i>

                </nav>
                <!-- ############ Logo code ends here -->

            </div>


            <div class="col-sm-12 col-md-8 col-lg-8">
                <!-- Navbar and Menu-->
                <br><br>
                <nav class="navbar navbar-expand-lg navbar-light">

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="../index.php" style="color: white;">Home<span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" style="color: white;">Contact Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../feedback.php" style="color: white;">Feedback</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../staff/staffRegistration.php" style="color: white;">Staff Registration</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../admission/trial.php" style="color: white;">Admission</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-2 col-lg-2">

            </div>
            <div class="col-sm-12 col-md-8 col-lg-8"><br>
                <?php
error_reporting(0);
if(isset($_GET['invalidDOB'])){
    echo "<script> alert('Age and Date of Birth do not match');</script>";
}
$value = $_GET['value'];
if($value=="sent")
    echo "<h2><i style='color: blue;'>Admission sent successfully</i></h2><br>";
?>
                <h2><i style="color: black;">Admission form</i></h2><br>
            </div>
            <div class="col-sm-12 col-md-2 col-lg-2">

            </div>

        </div>
    </div>

    <!--#### ADMISSIION FORM FOR TVET PROGRAMME####-->
    <div class="container-fluid">
        <form method="post" action="../student/tvetregistration.php" enctype="multipart/form-data" style="color: black; border: 1px solid none; padding: 10px 10px 10px 10px;">
            <div class="row">

                <div class="col-sm-12 col-md-2 col-lg-2">
                </div>

                <div class="col-sm-12 col-md-5 col-lg-5">

                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom03">First Name</label>

                            <input type="text" class="form-control" name="fname" placeholder="first name" required>
                            <div class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom03">Last Name</label>

                            <input type="text" class="form-control" name="lname" placeholder="last name" required>

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom03">Email</label>

                            <input type="email" class="form-control" name="email" placeholder="email" required>

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom03">Age</label>

                            <input type="number" class="form-control" name="age" placeholder="age" min="1" required>
                            <div class="invalid-feedback">
                                Please provide a valid Region.
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="validationCustom03">Date of birth</label>

                            <input type="Date" class="form-control" name="dob" placeholder="dob" required>
                            <div class="invalid-feedback">
                                Please provide a valid Region.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-5 col-lg-5">
                    <!-- ###### profile picture######-->
                    <img src="../images/profile.jpg" style="display: block" id="default"><br>
                    <img src="" style="display: none;" height=250 width=250 id="profile"><br>
                    <input type="file" name="image" onchange="showImage.call(this)" id="file" required="">
                    <script type="text/JavaScript">

                        function showImage(){
                      var fileinput= document.getElementById("file");
                      var filepath=fileinput.value;
                      var allowedext=/(\.jpeg|\.jpg|\.png)$/i;

                      if(!allowedext.exec(filepath)){
                        alert("please choose an image");
                        fileinput.value='';
                        return false;
                      }
                      else {

                    if(this.files && this.files[0])
                    {
                      var obj= new FileReader();
                      obj.onload= function(data){
                        document.getElementById("default").style.display="none";
                        var image= document.getElementById("profile");
                        image.src = data.target.result;
                        image.style.display="block";
                      }
                      obj.readAsDataURL(this.files[0]);
                    }
                      }
                  }
                </script>


                </div>

            </div>


            <div class="row">

                <div class="col-sm-12 col-md-2 col-lg-2">

                </div>

                <div class="col-sm-12 col-md-8 col-lg-8">

                    <label for="validationCustom03">Sex</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sex" id="inlineRadio1" value="male" required="">
                        <label class="form-check-label" for="inlineRadio1">Male</label>
                    </div>
                    <div class="form-check form-check-inline">&nbsp&nbsp&nbsp&nbsp&nbsp
                        <input class="form-check-input" type="radio" name="sex" id="inlineRadio2" value="female" required="">
                        <label class="form-check-label" for="inlineRadio2">Female</label>
                    </div>
                    <br>
                    <label for="validationCustom03">Marital status</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="marital" id="inlineRadio1" value="married" required="">
                        <label class="form-check-label" for="inlineRadio1">Married</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="marital" id="inlineRadio2" value="single" required="">
                        <label class="form-check-label" for="inlineRadio2">Single</label>
                    </div>
                    <br>
                    <label for="validationCustom03">Program</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="program" id="inlineRadio1" value="Regular" required="" checked>
                        <label class="form-check-label" for="inlineRadio1">Regular</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="program" id="inlineRadio2" value="Extension" required="" disabled>
                        <label class="form-check-label" for="inlineRadio2">Extension</label>
                    </div><br>

                    <div class="form-row">

                        <div class="col-md-6 mb-3">

                            <label for="validationCustom03">Attach documents</label>&nbsp<i style="color:red;">(documents must be in pdf or docx format)</i>
                            <input type="file" class="form-control" name="documents" onchange="showDoc.call(this)" id="doc" required>
                            <script type="text/JavaScript">

                                function showDoc(){
                      var fileinput= document.getElementById("doc");
                      var filepath=fileinput.value;
                      var allowedext=/(\.pdf|\.)$/i;

                      if(!allowedext.exec(filepath)){
                        alert("please choose from allowed format");
                        fileinput.value='';
                        return false;
                      }
                      else {

                    if(this.files && this.files[0])
                    {
                      var obj= new FileReader();
                      obj.readAsDataURL(this.files[0]);
                    }
                      }
                  }
                </script>
                        </div>
                    </div>

                    <label for="validationCustom03">Place of birth</label>
                    <div class="form-row">

                        <div class="col-md-6 mb-3">

                            <label for="validationCustom03">Region</label>
                            <input type="text" class="form-control" name="region" placeholder="region" required>
                            <div class="invalid-feedback">
                                Please provide a valid Region.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom04">Zone</label>
                            <input type="text" class="form-control" name="zone" placeholder="zone" required>
                            <div class="invalid-feedback">
                                Please provide a valid Zone.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom05">Woreda</label>
                            <input type="text" class="form-control" name="woreda" placeholder="woreda" required>
                            <div class="invalid-feedback">
                                Please provide a valid Woreda.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2 col-lg-2"></div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-2 col-lg-2"></div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <label for="validationCustom05">Fields currently available at Zion</label>

                    <select name="depts" size="10" style='width: 400px;'>
                        <option>--Drag and drop your choices-- </option>
                        <?php
                        $mydb= new db;
                        $conn=$mydb->connect();
             $stmnt= $conn->prepare("SELECT * from department");
             $stmnt->execute();
             $result=$stmnt->fetchAll();
             foreach($result as $row){
            ?>

                        <option id="<?php echo $row['name'];?>" draggable="true" ondragstart="dragStart(event)">
                            <tr>
                                <td><?php echo $row['name']; echo "    "; $obj=new queries;
                                    $obj->availableSeat($row['name']);?></td><br>
                            </tr>
                        </option>
                        <?php
                        }
                 ?>
                    </select>

                </div>

                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div>
                        <div class="form-row">
                            <div class="col-md-8 mb-3">
                                <label for="validationCustom03">First choice</label>

                                <!--                            <input type="text" class="form-control" name="fchoice" id="fchoice" ondrop="drop(event)" ondragover="allowDrop(event)" placeholder="">-->
                                <div style="border: 1px solid black; background-color: white; color: darkwhite; padding: 5px 5px 5px; height: 50px;" id="fchoice" ondragover="allowDrop(event)" ondrop="drop(event)"></div>
                                <input type="text" name="firstc" id="firstc" hidden>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-8 mb-3">
                                <label for="validationCustom03">Second choice</label>
                                <!--                            <input type="text" class="form-control" name="schoice" id="schoice" ondrop="drop(event)" ondragover="allowDrop(event)" placeholder="">-->
                                <input type="text" name="schoice" hidden>
                                <div style="border: 1px solid black; background-color: white; color: black; padding: 5px 5px 5px; height: 50px;" id="schoice" ondragover="allowDrop(event)" ondrop="drop(event)"></div>
                                <input type="text" name="secondc" id="secondc" hidden>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-8 mb-3">
                                <label for="validationCustom03">Third choice</label>

                                <!--                            <input type="text" class="form-control" name="tchoice" id="tchoice" ondrop="drop(event)" ondragover="allowDrop(event)" placeholder="">-->
                                <div style="border: 1px solid black; background-color: white; color: black; padding: 5px 5px 5px; height: 50px;" id="tchoice" ondragover="allowDrop(event)" ondrop="drop(event)"></div>
                                <input type="text" name="thirdc" id="thirdc" hidden>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-2 col-md-2"></div>
                <div class="col-sm-12 col-md-8 col-lg-8">

                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
                <div class="col-sm-12 col-md-2 col-lg-2">
                </div>
            </div>

        </form>

    </div>


    <!--##### ADMISSION FORM FOR TVET PROGRAMME ENDETH HERE####-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>

</body>


</html>
