<?php
include 'profile.php';
include 'login.php';
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="layout.css">
    <title>sisZion</title>
</head>

<body style="width: 100%;">


<div class="container-fluid" style="background-color: #27408B;">
    <div class="row">


        <div class="col-sm-12 col-md-4 col-lg-4">

            <!-- Image and text -->
            <nav class="navbar">

                <img src="images/logo.png" width="200" height="100" class="d-inline-block align-top" alt="NA">
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
                            <a class="nav-link" href="index.php" style="color: white;">Home <span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="color: white;">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="color: white;">Feedback</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="staff/staffRegistration.php" style="color: white;">Staff Registration</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admission/trial.php" style="color: white;">Admission</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>

<!-- Navbar and menu code ends here-->

<!--Announcements and Login forms start here-->


<div class="container-fluid">
    <div class="row">

        <div class="col-sm-12 col-md-2 col-lg-2">
            <br><br>


        </div>


        <div class="col-sm-12 col-md-8 col-lg-8">
            <br><br>
            <div style="border: 2px solid gray; border-radius: 8px; padding: 5px 5px 10px 10px;">

                <?php if(isset($_POST['submit'])){

                    $username= $_POST['username'];
                    $password=$_POST['password'];
                    $obj=new login();
                    $obj->_login($username, $password);
                }?>
                <form action="index.php" method="post">
                    <div class="form-group">
                        <i>Please provide the old password and the new password</i><br><br>
                        <label for="exampleInputEmail1">Old Password</label>

                            <div class="input-group-prepend">
                                <div class="input-group-text">@</div>
                            </div>
                            <input type="password" class="form-control" placeholder="old password" name="username" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <div class="input-group" id="show_hide_password">
                            <input class="form-control" type="password" name="new password" required="">
                            <div class="input-group-addon">
                                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>confirm Password</label>
                        <div class="input-group" id="show_hide_password">
                            <input class="form-control" type="password" name="confirm password" required="">
                            <div class="input-group-addon">
                                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;" name="submit">Login</button><br><br>
                    <a href="" > <i>Forgot password? Provide email and username to get new password</i></a><br>
                </form>


            </div>
        </div>
        <div class="col-sm-2 col-md-2 col-lg-2"></div>

    </div>


</div>
</div>




<!--Announcements and Login forms ends here-->




<!--admission modal goes here-->



<!-- admission modal ends here-->




<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("fa-eye-slash");
                $('#show_hide_password i').removeClass("fa-eye");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("fa-eye-slash");
                $('#show_hide_password i').addClass("fa-eye");
            }
        });
    });

</script>
<script>
    function myfunction() {
        document.getElementById("forgetPass").style.display='block';
    }
</script>
</body>

</html>
