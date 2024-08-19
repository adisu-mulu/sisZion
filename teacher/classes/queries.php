<?php
error_reporting(0);
include '../../database.php';


class Student extends db {

//function to upload material
    public function uploadMaterial()
    {
        $ran = rand();
        $dir = '../materials/';
        $materialName = $ran . $material = $_FILES['material']['name'];
        $materialTemp = $_FILES['material']['tmp_name'];
        move_uploaded_file($materialTemp, $dir . $materialName);

        $batch = $_POST['batch'];
        $dept = $_POST['dept'];
        $section = $_POST['section'];
        $attachment = $_POST['attachment'];

        $cmd = "insert into materials(material, department, batch, section, attachment, path) values('$material', '$dept', '$batch', '$section','$attachment','$materialName');";
        if ($this->connect()->exec($cmd)) {

            echo "<script>alert('Material uploaded successfully')</script>";
        }
    }

    public function sendNotice()
    {

        $notice = $_POST['notice'];
        $batch = $_POST['batch'];
        $dept = $_POST['dept'];
        $section = $_POST['section'];

        $stmnt = $this->connect()->prepare("SELECT * FROM registeredstudents where dept='" . $dept . "' and section ='" . $section . "' and batch='" . $batch . "'");
        $stmnt->execute();
        $result = $stmnt->fetchAll();
        if ($stmnt->rowCount() == 0) {
            echo "<script>alert('No students available')</script>";
        } else {
            foreach ($result as $row) {
                $username = $row['username'];

                $cmd = "insert into notices (username, notice) values('$username', '$notice');";
                $this->connect()->exec($cmd);
            }
            echo "<script>alert('Notice sent successfully')</script>";
        }
    }

    public function fetchStudentForAttendance()
    {

        static $var = 1;

        $_SESSION['batch'] = $batch = $_POST['batch'];
        $_SESSION['dept'] = $dept = $_POST['dept'];
        $_SESSION['section'] = $section = $_POST['section'];

        $stmnt = $this->connect()->prepare("SELECT * FROM registeredstudents where dept='" . $dept . "' and section ='" . $section . "' and batch='" . $batch . "'");
        $stmnt->execute();
        return $stmnt;

    }

    public function saveAttendance($course)
    {
        $stmnt = $this->connect()->prepare("SELECT * FROM registeredstudents where dept='" . $_SESSION['dept'] . "' and section ='" . $_SESSION['section'] . "' and batch='" . $_SESSION['batch'] . "'");
        $stmnt->execute();
        $result = $stmnt->fetchAll();
        foreach ($result as $row) {
            $studId = $row['username'];
            $attendance = $_POST[$studId];
            $date = $_POST['date'];

            if ($_POST['date'] == '') {
                $cmd = "insert into attendance(username, course, attendance) values('$studId', '$course', '$attendance');";
            } else {
                $cmd = "insert into attendance(username, course, attendance, date) values('$studId', '$course', '$attendance','$date');";
            }
            if ($this->connect()->exec($cmd)) {

                echo "<script>alert('Attendance saved successfully')</script>";
            }

        }
    }
    public function fetchActiveCourse()
    {
        $stmnt = $this->connect()->prepare("SELECT * FROM active_teachers where department='" . $_SESSION['user_role'] . "' and username ='" . $_SESSION['uname'] . "'");
        $stmnt->execute();
        return $stmnt;
    }

    public function fetchMyStudents()
    {
        echo "<br>";echo "<h5>Students list</h5>";
        $fetchStud = $this->connect()->prepare("SELECT username FROM active_course where course='" .$_GET['course']. "'  and period='" .$_GET['prd']."'");
        $fetchStud->execute();
        $myStudResult = $fetchStud->fetchAll();
        ?>
        <br>
        <script src="../../js/jquery.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../layout.css">
        <table style="width: 100%;">
            <tr>
                <td style=""><h5>Student name</h5></td>
                <td style=""><h5>Action</h5></td>
            </tr>
            <?php
            foreach ($myStudResult as $rows) {
            $fetchSpecStud = $this->connect()->prepare("SELECT * FROM registeredstudents where username='" .$rows['username']. "'  and dept='" .$_GET['dept']."' and section='".$_GET['sec']."'");
            $fetchSpecStud->execute();
            $mySpecStudResult = $fetchSpecStud->fetchAll();
            foreach($mySpecStudResult as $stud){
                ?>
                <tr>
                    <td><?php echo $stud['fname'].' '.$stud['lname'];?></td>
                    <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $rows['username']; ?>" style="padding: 5px 10px 5px 10px; border: 1px solid white;">View profile</button></td>
                </tr>
                <!-- pop up modal-->
                <div id="myModal<?php echo $rows['username'];?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4><i>Edit course</i></h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                            </div>
                            <div class="modal-body">
                                <form method="post" action="updatedept.php">
                                    <div class="form-group">
                                        <label for="inputState">Department</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="department" value="<?php echo $row['department'];?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Course Name</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="coursename" value="<?php echo $row['coursename'];?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Course Code</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="coursecode" value="<?php echo $row['coursecode'];?>">

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Credit Hour</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1" name="credithour" min="1" value="<?php echo $row['credithour'];?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Period</label>
                                        <select id="inputState" class="form-control" name="period" required>
                                            <option selected>Year1:Sem1</option>
                                            <option value="">Year1:Sem2</option>
                                            <option value="">Year2:Sem1</option>
                                            <option value="">Year2:Sem2</option>
                                            <option value="">Year3:Sem1</option>
                                            <option value="">Year3:Sem2</option>
                                            <option value="">Year4:Sem1</option>
                                            <option value="">Year4:Sem2</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Prerequisite</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" name="prerequisite" value="<?php echo $row['prerequisite'];?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }?>

        </table>
        <?php
    }
    }

    public function saveMark_sheet($course){

        $ass1=$_POST['assessment1']; $ass2=$_POST['assessment2']; $ass3=$_POST['assessment3']; $ass4=$_POST['assessment4'];
        $ass5=$_POST['assessment5']; $ass6=$_POST['assessment6']; $ass7=$_POST['assessment7']; $ass8=$_POST['assessment8'];
        $list=1;
        $username=$_SESSION['uname']; $course=$_GET['course']; $prd=$_GET['prd'];
        $assessment= 'assessment';
        if($ass1!=''){
            $mark_sheet[$list]=$ass1;
            ++$list;
        }
        if($ass2!=''){
            $mark_sheet[$list]=$ass2;
            ++$list;
        }
        if($ass3!=''){
            $mark_sheet[$list]=$ass3;
            ++$list;
        }
        if($ass4!=''){
            $mark_sheet[$list]=$ass4;
            ++$list;
        }
        if($ass5!=''){
            $mark_sheet[$list]=$ass5;
            ++$list;
        }
        if($ass6!=''){
            $mark_sheet[$list]=$ass6;
            ++$list;
        }
        if($ass7!=''){
            $mark_sheet[$list]=$ass7;
            ++$list;
        }
        if($ass8!=''){
            $mark_sheet[$list]=$ass8;
        }
    $colCount=count($mark_sheet);
        for($x = 1; $x <= $colCount; $x++) {
            $mark_sheet[$x];
            $assessment_Structure="insert into assessment_structure (username, course, period, assessment, structure)
                                    values ('$username','$course','$prd','$assessment$x', '$mark_sheet[$x]' )";
           $this->connect()->exec($assessment_Structure);

        }
        echo "<script>alert('mark sheet saved');</script>";
    }

    public function fetchGradeExcel(){
        $course=$_POST['course'];  $prd=$_POST['period']; $dept=$_POST['dept']; $section=$_POST['section'];
       $studList=$this->connect()->prepare("select  * from active_course, registeredstudents where active_course.username=registeredstudents.username and active_course.course='".$course."' and active_course.period='".$prd."' and registeredstudents.dept='".$dept."' and registeredstudents.section='".$section."' ");
        //$studList=$this->connect()->prepare("select  distinct username from active_course where course= '".$course."' and period='".$prd."'");
        $studList->execute();
        $studNames= $studList->fetchAll();
        //foreach($studNames as $row){
            //echo $row['username'];
           // $username= $row['username'];
            $fileName= $_FILES['excelGrade']['name'];
            $fileTempName= $_FILES['excelGrade']['tmp_name'];
            $handle= fopen($fileTempName, 'r');

            while(($myData= fgetcsv($handle))!== false){
                $assessment0=$myData[0];
                $assessment1=$myData[1];
                $assessment2=$myData[2];
                $assessment3=$myData[3];
                $assessment4=$myData[4];
                $assessment5=$myData[5];
                $assessment6=$myData[6];
                $assessment7=$myData[7];
                $assessment8=$myData[8];

                $insertMark="insert into student_mark(username, course, period, assessment1, assessment2, assessment3, assessment4, assessment5, assessment6, assessment7, assessment8) values('".$assessment0."','".$course."','".$prd."','".$assessment1."','".$assessment2."','".$assessment3."','".$assessment4."','".$assessment5."','".$assessment6."','".$assessment7."','".$assessment8."') ";
                if($this->connect()->exec($insertMark)){

                }else {
                    echo "<script>alert('Could not finish the query!! Please try again');</script>";
                    exit();
                }
            }
            echo "<h4>Successfully uploaded grade</h4>";

       // }

    }
}
?>
