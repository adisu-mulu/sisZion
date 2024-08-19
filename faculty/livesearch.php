<?php
include_once '../database.php';
error_reporting(0);
$mydb= new db;
$conn= $mydb->connect();
if(isset($_POST["query"])){

	$q= $_POST["query"];

	$results=$conn->prepare("select department.prefix, department.name, department.faculty, department.head, staff.fname, staff.lname from department, staff where (department.name like '%".$q."%' OR department.prefix like '%".$q."%') AND (department.head=staff.username) and department.status=1");
}
else{
	$results=$conn->prepare("select * from deparment");
}
?>
<script src="..js/jquery.js"></script>
<script src="..js/bootstrap.min.js"></script>

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
$results->execute();
foreach($results as $row){
	?>

    <tr>
        <td><i><?php echo $row['prefix'];?></i></td>
        <td><i><?php echo $row['name'];?></i></td>
        <td><i><?php echo $row['fname'].' '. $row['lname'];?></i></td>
        <td><i><?php echo $row['faculty'];?></i></td>
         <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModals<?php echo $row['prefix'] ?>" style="padding: 5px 10px 5px 10px; background-color: green; border: none;">Edit</button></td>
        <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $row['prefix'] ?>" style="padding: 5px 10px 5px 10px; background-color: red; border: none;"><img src="../icons/remove.png" style="height: 20px; width: 20px;">Remove</button></td>
    

    <!-- pop up modal-->
    <div id="myModals<?php echo $row['prefix'];?>" class="modal fade" role="dialog">
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

                        <button type="submit" class="btn btn-primary" name="changeDep">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
        </tr>
    <?php
}
?>
</table>
<?php
if(isset($_POST['changeDep'])){
    $mydb= new db;
    $conn=$mydb->connect();
    $cmd=$conn->prepare("UPDATE department SET  name='".$_POST['name']."',head='".$_POST['head']."', faculty='".$_POST['faculty']."' where prefix='".$_POST['prefix']."'");
    $cmd->execute();

}
?>