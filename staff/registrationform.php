<?php

include_once '../admission/classes/queries.php';

if(isset($_POST['submit'])){
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];

    $dob=$_POST['dob'];
    $sex=$_POST['sex'];
    $marital=$_POST['marital'];
    $region=$_POST['region'];
    $zone=$_POST['zone'];
    $woreda=$_POST['woreda'];
    $username=$_POST['username'];
    $role=$_POST['role'];
    $major_dept=$_POST['major_dept'];
    $email=$_POST['email'];

    $ran= rand();
    $dir= '../uploads/';
    $imgname= $_FILES['image']['name'];
    $imgtmp= $_FILES['image']['tmp_name'];
    //$image= file_get_contents($image);
    //$image= base64_encode($image);
    move_uploaded_file($imgtmp, $dir.$ran.$imgname);


    $obj= new staffReg;
    $obj->register($fname, $sex, $woreda, $zone, $marital, $region, $lname, $dob,
        $username.$ran, $role, $ran.$imgname, $email, $major_dept);
}

class staffReg{


    private $fname; private $sex; private $woreda;
    private $zone;  private $marital; private $region;
    private $lname;  private $dob; private $email;
    private $username; private $role; private $imname; private $major_dept;

    public function register($fname, $sex, $woreda, $zone, $marital, $region, $lname, $dob,
                             $username, $role, $imgname, $email, $major_dept)
    {

        $this->fname= $fname; $this->lname= $lname; $this->sex= $sex; $this->woreda= $woreda; $this->zone= $zone;
        $this->marital=$marital; $this->region= $region; $this->dob= $dob; $this->username= $username;
        $this->role= $role;$this->imgname= $imgname; $this->email=$email; $this->major_dept= $major_dept;

        $cmd="insert into staff(fname,lname,email,dob,sex,maritalstatus,region,zone,woreda,username,role,picname) values('$fname','$lname','$email','$dob', '$sex', '$marital', '$region', '$zone', '$woreda','$username', '$role','$imgname');";
        $cmd2="insert into user_mgmnt(username, user_role) values ('$username', '$major_dept');";
        $obj = new queries;
        $obj->insert($cmd, $cmd2);
        header('Location: staffRegistration.php?id='.$username);

    }

}
?>
