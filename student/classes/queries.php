<?php
error_reporting();

include_once '..//database.php';
include_once '..//profile.php';

class Queries extends db{

public function insert($query){
    if($this->connect()->exec($query)){
        echo "a have executed";
    }
    else print("something is wrong");   
}

    public function changeStudentPassword(){

        $username= $_SESSION['uname'];
        $hashOldPass= $_POST['oldPassword'];
        $oldPass=md5($hashOldPass);
        $newPassword=$_POST['newPassword'];
        $confirmPassword=$_POST['confirmPassword'];
        $hashedPassword= md5($newPassword);

        $stmnt= $this->connect()->prepare("SELECT * FROM account where username='".$username."' and password='".$oldPass."'");
        $stmnt->execute();
        if($stmnt->rowCount()>0){
            if($confirmPassword==$newPassword) {
                $insertNewPassword = $this->connect()->prepare("UPDATE account SET password='" . $hashedPassword . "' where username='" . $username . "'");
                $insertNewPassword->execute();
                echo "<script>alert('Password changed successfully');</script>";
            }else   echo "<script>alert('Passwords don\'t match');</script>";
        }
        else  echo "<script>alert('Your old password is not correct');</script>";
    }

    public function fetchActiveCourses($username){
            $stmnt= $this->connect()->prepare("SELECT * FROM active_course where username='".$username."'");
             $stmnt->execute();
             $result=$stmnt->fetchAll();
             foreach($result as $row){
                 $course= $row['course'];
                 $dept=$_SESSION['dept'];
                 $sect=$_SESSION['section'];
                 $instFetch="select staff.username, fname, lname, course, department, section from staff, active_teachers where staff.username=active_teachers.username and active_teachers.course='".$course."' and active_teachers.department='".$dept."' and active_teachers.section='".$sect."'";
                 $query= $this->connect()->query($instFetch);
                 $instInfo=$query->fetch(PDO::FETCH_ASSOC);
                 ?>
        <div class="w3-container">
    <button onclick="activeCourses('Demo1<?php echo $course;?>')" class="w3-btn w3-block w3-gray w3-left-align" style="border-radius: 5px 5px 0px 0px;"><?php echo $row['course']; ?></button>
    <div id="Demo1<?php echo $course;?>" class="w3-container w3-hide" style="border: 1px solid gray; border-radius: 0px 0px 5px 5px;"><br>
        <table style="width: 100%;">
            <tr>
                <td style="">Course Code</td>
                <td style="">Course Name</td>
                <td style="">Credit Hour</td>
                <td style="">Instructor</td>
            </tr>
            <?php 
             $stmnts= $this->connect()->prepare("SELECT * FROM coursebank where coursename='".$course."'");
             $stmnts->execute();
             $results=$stmnts->fetchAll();
             foreach($results as $rows){
            ?>
            <tr>
                <td><i><?php echo $rows['coursecode'];?></i></td>
                <td><i><?php echo $rows['coursename'];?></i></td>
                <td><i><?php echo $rows['credithour'];?></i></td>
                <td><a href=""><i><?php   $path="..//uploads/";
                            $con= new Profile;
                            $con->displayshort($path,"staff", $instInfo['username']); echo "<br>";
                            echo $instInfo['fname'].' '.$instInfo['lname'];?></i></a>
                </td>
            </tr>
            <?php
}?>
        </table>
    </div>
    <div class="dropdown-divider"></div>
</div>
<?php 
             } 
    }
    public function fetchSemesters(){
        $username = $_SESSION['uname'];
        $stmnt= $this->connect()->prepare("SELECT distinct period from student_course where username='".$username."'");
             $stmnt->execute();
             $result=$stmnt->fetchAll();
        foreach($result as $row){
            $prd=$row['period'];
                 ?>
    <div class="w3-container">
<button onclick="myFunction('Demo1<?php echo $prd; ?>')" class="w3-btn w3-block w3-black w3-left-align"><?php echo $row['period']; ?></button>
</div>
            <?php
    }
}
public function noticeCount($username){
    $stmnt= "SELECT * FROM notices where username='".$username."' and status=0";
    $sql =$this->connect()->query($stmnt);
    $count= $sql->rowCount();
    if($count>0){
        echo "<i style='color: red;'>$count</i>";
    }
}
public function fetchNotices($username){
    $stmnt = $this->connect()->prepare("SELECT * FROM notices where username='" .$username . "' order by date desc");
    $stmnt->execute();
    return $stmnt;
}
public function fetchMaterial(){
    $stmnt = $this->connect()->prepare("SELECT * FROM materials where department='" .$_SESSION['dept'] . "' and batch='".$_SESSION['batch']."' and section ='".$_SESSION['section']."' order by date desc");
    $stmnt->execute();
    return $stmnt;
}
public function fetchAttendance(){
    $date1= $_POST['from'];
    $date2= $_POST['and'];
    $status=$_POST['status'];
   if($date1!=' ' and $date2!=' '){


       if($status=='Present'){
            $stmnt = $this->connect()->prepare("SELECT * FROM attendance where username='".$_SESSION['uname']."' and attendance= 'Present' and date between '".$date1."' and '$date2'");
        }
        else if($status=='Absent'){
            $stmnt = $this->connect()->prepare("SELECT * FROM attendance where username='".$_SESSION['uname']."' and attendance= 'Absent' and date between '".$date1."' and '$date2'");

        }
        else if($status=='Permit'){
            $stmnt = $this->connect()->prepare("SELECT * FROM attendance where username='".$_SESSION['uname']."' and attendance= 'Permit' and date between '".$date1."' and '$date2'");
        }
        else if($status!='Present' and $status!='Absent' and $status!='Permit' and $status!='all'){
            $stmnt = $this->connect()->prepare("SELECT * FROM attendance where username='".$_SESSION['uname']."' and course='".$status."' and date between '".$date1."' and '$date2'");
        }
        else{
            $stmnt = $this->connect()->prepare("SELECT * FROM attendance where username='".$_SESSION['uname']."' order by date desc");
        }

    }
    else {

        if ($status == 'Present') {
            $stmnt = $this->connect()->prepare("SELECT * FROM attendance where username='" . $_SESSION['uname'] . "' and attendance= 'Present' order by date desc");
        } else if ($status == 'Absent') {
            $stmnt = $this->connect()->prepare("SELECT * FROM attendance where username='" . $_SESSION['uname'] . "' and attendance= 'Absent' order by date desc");

        } else if ($status == 'Permit') {
            $stmnt = $this->connect()->prepare("SELECT * FROM attendance where username='" . $_SESSION['uname'] . "' and attendance= 'Permit' order by date desc");
        } else if ($status != 'Present' and $status != 'Absent' and $status != 'Permit' and $status != 'all') {
            $stmnt = $this->connect()->prepare("SELECT * FROM attendance where username='" . $_SESSION['uname'] . "' and course='" . $status . "' order by date desc");
        } else {
            $stmnt = $this->connect()->prepare("SELECT * FROM attendance where username='" . $_SESSION['uname'] . "' order by date desc");
        }
    }
    $stmnt->execute();
    return $stmnt;
}
public function fetchNoticesFromWhen($date1, $date2){
    $stmnt = $this->connect()->prepare("SELECT * FROM notices where username='" .$_SESSION['uname'] . "' and date Between '$date1' and '$date2' order by date desc");
    $stmnt->execute();
    return $stmnt;
}

public function fetchAssessmentStructure($Iuname, $courseName, $period){
    $stmnt = $this->connect()->prepare("SELECT * FROM assessment_structure where username='" .$Iuname . "' and course='".$courseName."' and period='".$period."'");
    $stmnt->execute();
    return $stmnt;
}

public function fetchMark($studUname, $courseName, $period){
    $stmnt = $this->connect()->prepare("SELECT * FROM student_mark where username='" .$studUname . "' and course='".$courseName."' and period='".$period."'");
    $stmnt->execute();
    return $stmnt;
}
}
	
?>
