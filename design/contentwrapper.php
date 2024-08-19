<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    <?php
                $obj=new Profile;
               echo $obj->profileImageName("../uploads/","account",$_SESSION['uname']);
                ?>
                </a>
                <form action="" method="post">
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profile">Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#password">Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../logout.php">Log out</a>
                </div>
                </form>
            </li>

        </ul>
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
                $stmnt=$conn->prepare("select *from staff where username ='".$username."'");
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
                                <label for="inputPassword4">Username</label>
                                <input type="text" class="form-control" id="inputPassword4" value="<?php echo $row['username'];?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Email</label>
                            <input type="text" class="form-control" id="inputAddress2" value="<?php echo $row['email'];?>">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Sex</label>
                            <input type="text" class="form-control" id="inputAddress2" value="<?php echo $row['sex'];?>">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Address</label>
                            <input type="text" class="form-control" id="inputAddress2" value="<?php echo $row['region'].','.' '. $row['zone'].','.' '. $row['woreda'];?>">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">Role</label>
                                <input type="text" class="form-control" id="inputCity" value="<?php echo $row['role'];?>">
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
                    $mydb= new db;
                    $conn=$mydb->connect();
                    $username= $_SESSION['uname'];
                    $hashedOldPass= $_POST['oldPassword'];
                    $oldPass= md5($hashedOldPass);
                    $newPassword=$_POST['newPassword'];
                    $confirmPassword=$_POST['confirmPassword'];
                    $hashedPassword= md5($newPassword);

                    $stmnt= $conn->prepare("SELECT * FROM account where username='".$username."' and password='".$oldPass."'");
                    $stmnt->execute();
                    if($stmnt->rowCount()>0){
                        if($confirmPassword==$newPassword) {
                            $insertNewPassword = $conn->prepare("UPDATE account SET password='" . $hashedPassword . "' where username='" . $username . "'");
                            $insertNewPassword->execute();
                            echo "<script>alert('Password changed successfully');</script>";
                        }else   echo "<script>alert('Passwords don\'t match');</script>";
                    }
                    else  echo "<script>alert('Your old password is not correct');</script>";
                }
                ?>
            </div>

        </div>
    </div>
</div>


