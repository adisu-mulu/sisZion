<?php
include_once '../database.php';
error_reporting(0);
$mydb= new db;
$conn= $mydb->connect();
if(isset($_POST["query"])){

	$q= $_POST["query"];

	$results=$conn->prepare("select *from coursebank where coursename like '%".$q."%' OR coursecode like '%".$q."%' and status =1" );
}
else{
	$results=$conn->prepare("select * from coursebank");
}
?>
<script src="..js/jquery.js"></script>
<script src="..js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../layout.css">
<table style="border: 1px solid #dddddd;">
    <tr>
        <th style="background-color: gray;">Department</th>
        <th style="background-color: gray;">Course Name</th>
        <th style="background-color: gray;">Course Code</th>
        <th style="background-color: gray;">Credit Hour</th>
        <th style="background-color: gray;">Period</th>
        <th style="background-color: gray;">Prerequisite</th>
        <th style="background-color: gray; text-align: center;" colspan=2>Action</th>

    </tr>

    <?php
$results->execute();
foreach($results as $row){
	?>

    <tr>
        <td><i><?php echo $row['department'];?></i></td>
        <td><i><?php echo $row['coursename'];?></i></td>
        <td><i><?php echo $row['coursecode'];?></i></td>
        <td><i><?php echo $row['credithour'];?></i></td>
        <td><i><?php echo $row['period'];?></i></td>
        <td><i><?php echo $row['prerequisite'];?></i></td>
        <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModals<?php echo $row['prefix']; ?>" style="padding: 5px 10px 5px 10px; border: 1px solid white;"><span class="glyphicon glyphicon-plus"></span>Edit</button></td>
        <td><a href="removeCourse.php?id=<?php echo $row['coursecode']; ?>"><button type="button" class="btn btn-info"  style="padding: 5px 10px 5px 10px; background-color: red; border: none;"><img src="../icons/remove.png" style="height: 20px; width: 20px;"> Remove</button></a></td>
    </tr>

    <!-- pop up modal-->
    <div id="myModals<?php echo $row['prefix'];?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4><i>Edit course</i></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <form method="post" action="">
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
                        <button type="submit" class="btn btn-primary" name="changeCourse">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}?>
</table>

<?php
if(isset($_POST['changeCourse'])){
$mydb= new db;
$conn=$mydb->connect();
$cmd=$conn->prepare("UPDATE coursebank SET  department='".$_POST['department']."',coursename='".$_POST['coursename']."', coursecode='".$_POST['coursecode']."', credithour='".$_POST['credithour']."', period='".$_POST['period']."', prerequisite='".$_POST['prerequisite']."' where coursecode='".$_POST['coursecode']."'");
$cmd->execute();

}