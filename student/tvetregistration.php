<?php

include_once 'classes/queries.php';

if(isset($_POST['submit'])){
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$age=$_POST['age'];
$dob=$_POST['dob'];
$sex=$_POST['sex'];
$marital=$_POST['marital'];
$region=$_POST['region'];
$zone=$_POST['zone'];
$woreda=$_POST['woreda'];
$fchoice=$_POST['firstc'];
$schoice=$_POST['secondc'];
$tchoice=$_POST['thirdc'];
$email=$_POST['email'];

   $batch= date("Y");
   $exactDOB= $batch - $age;
    if($exactDOB != $dob) {
    	echo "<script>alert('age and date of birth do not match');</script>";
		exit();
       //header('location: ../admission/trial.php?invalidDOB');
    }
	$ran= rand();
	$dir= '../uploads/';
	$imgname= $_FILES['image']['name'];
	$imgtmp= $_FILES['image']['tmp_name'];
	//$image= file_get_contents($image);
	//$image= base64_encode($image);
	move_uploaded_file($imgtmp, $dir.$ran.$imgname);
    
    $docname=$_FILES['documents']['name'];
    $doctmp=$_FILES['documents']['tmp_name'];
    move_uploaded_file($doctmp, $dir.$ran.$docname);

$obj= new tvetRegistration;
$obj->register($fname, $sex, $woreda, $zone, $marital, $region, $lname, $age, $dob,
	$fchoice, $schoice, $tchoice,$ran.$imgname, $email, $ran.$docname);
}

class tvetRegistration{

	
	private $fname; private $sex; private $woreda;
	private $zone;  private $marital; private $region;
	private $lname; private $age; private $dob; private $email;
	private $fchoice; private $schoice; private $tchoice; private $imname; private $tbname; private $documents;
	
	public function register($fname, $sex, $woreda, $zone, $marital, $region, $lname, $age, $dob,
	$fchoice, $schoice, $tchoice, $imname, $email, $documents)
	{
		
		$this->fname= $fname; $this->lname= $lname; $this->sex= $sex; $this->woreda= $woreda; $this->zone= $zone;
		$this->marital=$marital; $this->region= $region; $this->age= $age; $this->dob= $dob; $this->fchoice= $fchoice;
		$this->schoice= $schoice; $this->tchoice= $tchoice; $this->imname= $imname; $this->email=$email; $this->documents=$documents;

		$cmd="insert into pendingrequest(fname,lname,email,age,dob,sex,maritalstatus,region,zone,woreda,fchoice,schoice,tchoice,picname, documents) values('$fname','$lname','$email','$age', '$dob', '$sex', '$marital', '$region', '$zone', '$woreda','$fchoice', '$schoice', '$tchoice','$imname','$documents');";	

			$obj = new Queries;
			$obj->insert($cmd);
			 header('Location: ../admission/trial.php?value=sent');
				
}
			
}
?>
