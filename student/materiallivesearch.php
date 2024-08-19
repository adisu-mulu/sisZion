<?php
session_start();
include_once '../database.php';

error_reporting(1);
$mydb= new db;
$conn= $mydb->connect();
if(isset($_POST["query"])){

    $q= $_POST["query"];

    $results=$conn->prepare("select *from materials where material like '%".$q."%' and department='".$_SESSION['dept']."' and batch='".$_SESSION['batch']."' and section ='".$_SESSION['section']."' " );
}
else{
    $results=$conn->prepare("select *from materials where department='".$_SESSION['dept']."' and batch='".$_SESSION['batch']."' and section ='".$_SESSION['section']."' ");
}
$results->execute();
foreach($results as $row){
    $timestamp = strtotime($row['date']);
    $date = date('d-m-Y', $timestamp);
    $time = date('G.i.s', $timestamp);
    $period= substr( $time,0, 4);
    $ext= pathinfo($row['material'], PATHINFO_EXTENSION);
    ?>
    <div  style="border: 1px solid black; border-radius: 40px 25px; width: 90%; padding: 5px 15px 5px 5px; background: dimgrey">
        <i style="border: 1px solid gray; border-radius: 5px; background: black; color: white; padding: 10px 5px 5px 5px; margin-left: 30%;"><?php echo $date;?></i><br>
        <div style="background: white; height: auto; padding: 10px 10px 10px 10px; border-radius: 8px;">
            <?php
            echo $row['attachment'];
            if($ext=='PNG' || $ext=='jpeg' || $ext=='jpg'){
                ?>
                <img height="30" width="40" src="../icons/png.png"><br>
                <?php
            }
            else if($ext=='pdf'){
                ?>
                <img height="30" width="40" src="../icons/pdf.png"><br>
                <?php
            }
            else if($ext=='docx'){
                ?>
                <img height="30" width="40" src="../icons/docx.png"><br>
                <?php
            }
            else if($ext=='ppt' || $ext=='pptx'){
                ?>
                <img height="30" width="40" src="../icons/ppt.png"><br>
                <?php
            }
            else{
                ?>
                <img height="30" width="40" src="" alt=""><br>
                <?php
            }
            echo $row['material'];?>
            <a href="download.php?id=<?php echo $row['path'];?>"><img height="30" width="40" src="../icons/download.png" alt="" style="margin-left: 95%;"></a>
        </div>
        <i style="border: 1px solid gray; border-radius: 5px; background: black; margin-left: 95%; color: white;"><?php echo $period;?></i>
    </div><br>

    <?php
}