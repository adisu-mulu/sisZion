<?php
error_reporting();

include_once '..//database.php';
include_once '..//profile.php';

class Queries extends db{

    public function gradeRange(){
        $deleteActive = $this->connect()->prepare("delete from grade_scale where 1");
        $deleteActive->execute();


        $Apmin= $_POST['A+min']; $Amin= $_POST['Amin']; $Ammin= $_POST['A-min']; $Bpmin= $_POST['B+min']; $Bmin= $_POST['Bmin']; $Bmmin= $_POST['B-min']; $Cpmin= $_POST['C+min']; $Cmin= $_POST['Cmin'];
        $Cmmin= $_POST['C-min']; $Dpmin= $_POST['D+min']; $Dmin= $_POST['Dmin'];
        $Apmax= $_POST['A+max']; $Amax= $_POST['Amax']; $Ammax= $_POST['A-max']; $Bpmax= $_POST['B+max']; $Bmax= $_POST['Bmax']; $Bmmax= $_POST['B-max']; $Cpmax= $_POST['C+max']; $Cmax= $_POST['Cmax'];
        $Cmmax= $_POST['C-max']; $Dpmax= $_POST['D+max']; $Dmax= $_POST['Dmax']; $FXmin=$_POST['FXmax']; $FXmax=$_POST['Fxmax']; $Fmin=$_POST['Fmin'];

        $cmd1 ="insert into grade_scale (grade, min_point, max_point) values ('A+','$Apmin','$Apmax')";
        $cmd2 ="insert into grade_scale (grade, min_point, max_point) values ('A','$Amin','$Amax')";
        $cmd3 ="insert into grade_scale (grade, min_point, max_point) values ('A-','$Ammin','$Ammax')";
        $cmd4 ="insert into grade_scale (grade, min_point, max_point) values ('B+','$Bpmin','$Bpmax')";
        $cmd5 ="insert into grade_scale (grade, min_point, max_point) values ('B','$Bmin','$Bmax')";
        $cmd6 ="insert into grade_scale (grade, min_point, max_point) values ('B-','$Bmmin','$Bmmax')";
        $cmd7 ="insert into grade_scale (grade, min_point, max_point) values ('C+','$Cpmin','$Cpmax')";
        $cmd8 ="insert into grade_scale (grade, min_point, max_point) values ('C','$Cmin','$Cmax')";
        $cmd9 ="insert into grade_scale (grade, min_point, max_point) values ('C-','$Cmmin','$Cmmax')";
        $cmd10 ="insert into grade_scale (grade, min_point, max_point) values ('D+','$Dpmin','$Dpmax')";
        $cmd11 ="insert into grade_scale (grade, min_point, max_point) values ('D','$Dmin','$Dmax')";
        $cmd12 ="insert into grade_scale (grade, min_point, max_point) values ('Fx','$FXmin','$FXmax')";
        $cmd13 ="insert into grade_scale (grade, min_point, max_point) values ('F','$Fmin',0)";

        $this->connect()->exec($cmd1);
        $this->connect()->exec($cmd2);
        $this->connect()->exec($cmd3);
        $this->connect()->exec($cmd4);
        $this->connect()->exec($cmd5);
        $this->connect()->exec($cmd6);
        $this->connect()->exec($cmd7);
        $this->connect()->exec($cmd8);
        $this->connect()->exec($cmd9);
        $this->connect()->exec($cmd10);
        $this->connect()->exec($cmd11);
        $this->connect()->exec($cmd12);
        $this->connect()->exec($cmd13);

        if($cmd1 and $cmd2 and $cmd3 and $cmd4 and $cmd5 and $cmd6 and $cmd7 and $cmd8 and $cmd9 and $cmd10 and $cmd11 and $cmd12 and $cmd13){
            echo "<script> alert('Grade range updated');</script>";
        }

    }

}
