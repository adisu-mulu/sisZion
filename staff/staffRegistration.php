<?php
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
    <link rel="stylesheet" href="../layout.css">
    <style>
        body {}

    </style>
    <title>sisZion</title>
</head>

<body>

    <div class="container-fluid" style="background-color: #27408B;">
        <div class="row">


            <div class="col-sm-12 col-md-4 col-lg-4">

                <!-- Image and text -->
                <nav class="navbar">

                    <img src="../images/logo.png" width="200" height="100" class="d-inline-block align-top" alt="NA">
                    <i style="color: white;">Zion College of Business and Technology</i>

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
                                <a class="nav-link" href="staffRegistration.php" style="color: white;">Staff Registration</a>
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
            <div class="col-sm-12 col-md-12 col-lg-12">


                <?php
error_reporting(0);
$username = $_GET['id'];
  if($username){
    echo "<h3><i>Registered successfully\r\nYour username is:</h3>".$username;  
  }
?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-8"><br><br>
                <h3><i>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Staff Registration</i></h3>
            </div>
            <div class="col-sm-12 col-md-2 col-lg-2">

            </div>

        </div>
    </div>

    <!--#### STAFF REGISTRATION FORM####-->




    <div class="container-fluid">
        <form method="post" action="registrationform.php" enctype="multipart/form-data">

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
                            <label for="validationCustom03">User Name</label>
                            <div class="input-group mb-2">

                                <div class="input-group-prepend">
                                    <div class="input-group-text">@</div>
                                </div>
                                <input type="text" class="form-control" name="username" placeholder="username" required>
                            </div>
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

                    <label for="validationCustom03">Sex</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sex" id="inlineRadio1" value="male" required="">
                        <label class="form-check-label" for="inlineRadio1">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sex" id="inlineRadio2" value="female" required="">
                        <label class="form-check-label" for="inlineRadio2">Female</label>
                    </div>
                    <br>
                    <label for="validationCustom03">Marital status</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="marital" id="inlineRadio1" value="married" required="">
                        <label class="form-check-label" for="inlineRadio1">Married</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="marital" id="inlineRadio2" value="single" required="">
                        <label class="form-check-label" for="inlineRadio2">Single</label>
                    </div>
                    <br>
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
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputState">Choose your role</label>
                            <select id="inputState" class="form-control" name="role" required>

                                <option selected>Instructor</option>
                                <option selected>Registrar</option>
                                <option selected>Finance</option>
                                <option selected>Librarian</option>
                                <option selected>Faculty Head</option>
                                <option selected>Department Head</option>
                                <option selected>Quality Assurance</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputState">Choose Department</label>
                            <select id="inputState" class="form-control" name="major_dept">
                                <option></option>
                                <?php
                                $mydb= new db;
                                $conn=$mydb->connect();
                                $deptFetch= $conn->prepare("SELECT * from department");
                                $deptFetch->execute();
                                $deptFetchresult=$deptFetch->fetchAll();
                                foreach($deptFetchresult as $row){
                                    ?>
                                    <option>
                                        <tr>
                                            <td><?php echo $row['name']; ?></td><br>
                                        </tr>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div></div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button><br><br>
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


</html
