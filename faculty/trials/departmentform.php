<?php
include_once '..//database.php';
include_once '..//profile.php';

class Department extends db {


// function to add new departments to database
	public function addDepartment($deptname, $depthead, $deptprefix, $deptfaculty){
			
		
		$this->deptname=$deptname; $this->depthead=$depthead; $this->deptprefix=$deptprefix; $this->deptfaculty=$deptfaculty;
		$cmd="insert into department (prefix, name, head, faculty) values('$deptprefix', '$deptname', '$depthead', '$deptfaculty')";

		if($this->connect()->exec($cmd)){
			echo "<h3><i>Department added</i></h3>";
		}

		else {
			echo "<h3><i>Can not add Department</i></h3>";
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
             $stmnt= $this->connect()->prepare("SELECT department.prefix, department.name, department.faculty, department.head, staff.fname, staff.lname from department, staff where department.head=staff.username ");
             $stmnt->execute();
             $result=$stmnt->fetchAll();
             foreach($result as $row){

            ?>

    <tr>
        <td><i><?php echo $row['prefix'];?></i></td>
        <td><i><?php echo $row['name'];?></i></td>
        <td><i><?php echo $row['fname'].' '.$row['lname'];?></i></td>
        <td><i><?php echo $row['faculty'];?></i></td>
        <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $row['prefix']; ?>" style="padding: 5px 10px 5px 10px; border: 1px solid white;">Edit</button></td>
        <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $row['prefix'] ?>" style="padding: 5px 10px 5px 10px; background-color: red; border: none;">Remove</button></td>
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
                    <form method="post" action="updatedept.php">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Prefix</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="prefix" value="<?php echo $row['prefix'];?>">

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
                            <input type="text" class="form-control" id="exampleInputPassword1" name="faculty" value="<?php echo $row['faculty'];?>">
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
