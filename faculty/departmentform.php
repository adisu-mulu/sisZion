<?php
error_reporting(0);
include_once '..//database.php';
include_once '..//profile.php';

class Department extends db {


// function to add new departments to database
	public function addDepartment($deptname, $depthead, $deptprefix, $deptfaculty){
			
		try{
		$this->deptname=$deptname; $this->depthead=$depthead; $this->deptprefix=$deptprefix; $this->deptfaculty=$deptfaculty;
		$checkDepthead= $this->connect()->prepare("SELECT * from staff where username='".$depthead."'");
		$checkDepthead->execute();
		if($checkDepthead->rowCount()==0){
		    echo "<script>alert('Please choose valid department head');</script>";
		    exit();

        }

		$cmd="insert into department (prefix, name, head, faculty) values('$deptprefix', '$deptname', '$depthead', '$deptfaculty')";
            $cmd3="insert into user_mgmnt(username, user_role) values ('$depthead', '$deptname');";
        $cmd2="select * from staff where username='".$depthead."'";
		if($this->connect()->exec($cmd)){
            $seat="insert into seat (dept) values('$deptname')";
            if($this->connect()->exec($seat)){
                if($this->connect()->exec($cmd3)) {
                    echo "<h3><i>Department added</i></h3>";
                }
            }
            
		}

		else {
			echo "<i style='color: red;'>Could not add department</i>";
		}} catch (PDOException $e){
		    echo "<script>alert('department already exists');</script>";
        }
	}

	// function to display all departments
	public function displayDepartment(){
        ?>
<br><br>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../layout.css">
<table style="border: 1px solid #dddddd;">
    <tr>
        <th style="background-color: gray;">Prefix</th>
        <th style="background-color: gray;">Department Name</th>
        <th style="background-color: gray;">Department Head</th>
        <th style="background-color: gray;">Faculty</th>
        <th style="background-color: gray; text-align: center;" colspan=2>Action</th>

    </tr>

        <?php 
             $stmnt= $this->connect()->prepare("SELECT department.prefix, department.name, department.faculty, department.head, staff.fname, staff.lname from department, staff where department.head=staff.username and department.status=1");
             $stmnt->execute();
             $result=$stmnt->fetchAll();
             foreach($result as $row){

            ?>

    <tr>
        <td><i><?php echo $row['prefix'];?></i></td>
        <td><i><?php echo $row['name'];?></i></td>
        <td><i><?php echo $row['fname'].' '.$row['lname'];?></i></td>
        <td><i><?php echo $row['faculty'];?></i></td>
        <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $row['prefix']; ?>" style="padding: 5px 10px 5px 10px; border: 1px solid white;"><span class="glyphicon glyphicon-plus"></span>Edit</button></td>
        <td><a href="removedept.php?id=<?php echo $row['prefix']; ?>"><button type="button" class="btn btn-info" style="padding: 5px 10px 5px 10px; background-color: red; border: none;"><img src="../icons/remove.png" style="height: 20px; width: 20px;">Remove</button></a></td>
    </tr>

    <!-- pop up modal-->
    <div id="myModal<?php echo $row['prefix'];?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4><i>Edit department</i></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Prefix</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="prefix" value="<?php echo $row['prefix'];?>" readonly>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Department Name</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" name="name" value="<?php echo $row['name'];?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Department Head</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="head" value="<?php echo $row['head'];?>">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Faculty</label>
                            <select id="inputState" class="form-control" name="faculty" required>
                                <option selected><?php echo $row['faculty']; ?></option>
                                <option>Business</option>
                                <option>Technology</option>

                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" name="changeDep">Submit</button>
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

	// function ends here
//live search department
public function deptSearch(){
        ?>
<br><br>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../layout.css">
<table style="border: 1px solid #dddddd;">
    <tr>
        <th style="background-color: gray;">Prefix</th>
        <th style="background-color: gray;">Department Name</th>
        <th style="background-color: gray;">Department Head</th>
        <th style="background-color: gray;">Faculty</th>
        <th style="background-color: gray; text-align: center;" colspan="2">Action</th>

    </tr>

    <?php 
            
             $stmnt= $this->connect()->prepare("SELECT * FROM department where prefix like '%".$_POST['searchDep']."%' or name like '%".$_POST['searchDep']."%'");
             $stmnt->execute();
             echo "search result: ".' '.$stmnt->rowCount().' '."department(s) found";
             $result=$stmnt->fetchAll();
             if($stmnt->rowCount()>0){
             foreach($result as $row){
               
            ?>

    <tr>
        <td><i><?php echo $row['prefix'];?></i></td>
        <td><i><?php echo $row['name'];?></i></td>
        <td><i><?php echo $row['head'];?></i></td>
        <td><i><?php echo $row['faculty'];?></i></td>
        <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $row['prefix']; ?>" style="padding: 5px 10px 5px 10px; border: 1px solid white;">Edit</button></td>
        <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $row['name'] ?>" style="padding: 5px 10px 5px 10px; background-color: red; border: none;">Remove</button></td>
    </tr>
    <?php
}}


?>
</table>



<?php       
} 
}
?>

<!-- out of class queries-->
<?php
if(isset($_POST['changeDep'])){
    $mydb= new db;
    $conn=$mydb->connect();
    $cmd=$conn->prepare("UPDATE department SET  name='".$_POST['name']."',head='".$_POST['head']."', faculty='".$_POST['faculty']."' where prefix='".$_POST['prefix']."'");
    $cmd->execute();

}
?>
