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
                            <a class="nav-link" href="feedback.php" style="color: white;">Feedback</a>
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

        <div class="col-sm-2 col-md-2 col-lg-2">
            <br><br>


        </div>


        <div class="col-sm-8 col-md-8 col-lg-8">
            <br><br>
            <div style="border: 2px solid gray; border-radius: 8px; padding: 5px 5px 10px 10px;">

                <form action="feedback.php" method="post">
                    <div class="form-group">
                        <i>Please give us your feedback</i><br><br>

                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-group" id="show_hide_password">
                            <input class="form-control" type="email" name="email" placeholder="email" required="">

                        </div>
                    </div>
                    <div class="form-group">
                        <label>Feedback</label>
                        <div class="input-group" id="show_hide_password">
                            <textarea placeholder="feedback" rows="8" style="width: 100%;" name="feedback"></textarea>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;" name="submit">Submit</button><br><br>

                </form>


            </div>
        </div>

    </div>
    <div class="col-sm-2 col-md-2 col-lg-2">


</div>
</div>


<?php if(isset($_POST['submit'])){

    $email=$_POST['email'];
    $feedback= $_POST['feedback'];
    $mydb= new db;
    $conn=$mydb->connect();
    $cmd=$conn->prepare("insert into feedback(email,feedback) values ('$email', '$feedback')");
    $cmd->execute();
    if($cmd){
        echo "<script>alert('Feedback sent');</script>";
    }
}?>


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
    function forgetPass() {
        document.getElementById("forgetPass").style.display='block';
    }
</script>
<div class="row" style="border: 1px solid gray; position: absolute; bottom: 0%; background: grey; width: 100%; height: 10%;">
    <div class="col-sm-6 col-lg-6 col-md-6">
        @copyright Zion College of Business and Technology
    </div>
    <div class="col-sm-6 col-lg-6 col-md-6">
        visit us at <a href="https://www.zioncollegetbc.com">https://www.zioncollegetbc.com</a>
    </div>
</div>
</body>

</html>
