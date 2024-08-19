<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto" style="padding: 30px 10px 0px 80px; font-size: 16px;">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home </a>
            </li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <li class="nav-item active">
                <a class="nav-link" href="YourGrades.php">Your Grades </a>
            </li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <li class="nav-item">
                <a class="nav-link" href="seeAttendance.php">Attendance</a>
            </li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <li class="nav-item">
                <a class="nav-link" href="practiceExercise.php">Practice Exercise</a>
            </li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <li class="nav-item">
                <a class="nav-link" href="notice.php">Notice
                <?php
                $obj= new Queries;
                $obj->noticeCount($_SESSION['uname']);
                ?>
                </a>
            </li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <li class="nav-item">
                <a class="nav-link" href="materials.php">Materials</a>
            </li>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <ul style="list-style: none;">
                <li class="nav-item dropdown" style="padding: 30px 10px 0px 0px; font-size: 17px;">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php 
                $obj=new Profile;
               echo $obj->profileImageName("../uploads/","account",$_SESSION['uname']);
                ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profile">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#password">Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../logout.php">Log out</a>
                    </div>
                </li>
            </ul>
        </form>
    </div>
</nav>
<!-- Modal for profile -->
<div class="modal fade" id="profile" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i>Personal profile</i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $mydb= new db;
                $conn=$mydb->connect();
                $username= $_SESSION['uname'];
                $stmnt=$conn->prepare("select *from registeredstudents where username ='".$username."'");
                $stmnt->execute();
                $result= $stmnt->fetchAll();
                foreach ($result as $row){

                ?>

                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Name</label>
                            <input type="text" class="form-control" id="inputEmail4" value="<?php echo $row['fname']. ' '. $row['lname']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">ID</label>
                            <input type="text" class="form-control" id="inputPassword4" value="<?php echo $row['username'];?>" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Email</label>
                        <input type="text" class="form-control" id="inputAddress2" value="<?php echo $row['email'];?>">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Address</label>
                        <input type="text" class="form-control" id="inputAddress2" value="<?php echo $row['region'].','.' '. $row['zone'].','.' '. $row['woreda'];?>">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">Department</label>
                            <input type="text" class="form-control" id="inputCity" value="<?php echo $row['dept'];?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCity">Batch</label>
                            <input type="text" class="form-control" id="inputCity" value="<?php echo $row['batch'];?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip">Section</label>
                            <input type="text" class="form-control" id="inputZip" value="<?php echo $row['section'];?>">
                        </div>
                    </div>

                </form>
<?php }
?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal for password -->
<div class="modal fade" id="password" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle"><i>Change password</i></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Old Password</label>
                        <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name ="oldPassword" placeholder="Enter old password" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">New Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter new password" name="newPassword" minlength="8" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm New Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirm new password" minlength="8" name="confirmPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="changepass">Save changes</button>
                </form>
                <?php 
                if(isset($_POST['changepass'])){
                    $obj= new Queries;
                    $obj->changeStudentPassword();

                }
                ?>
            </div>

        </div>
    </div>
</div>
