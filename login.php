<?php
session_start();
include_once 'database.php';

class login extends db{


 public function _login($username, $Unhashedpassword)
 {
     try{
     $password=md5($Unhashedpassword);
 	$stmnt="select * from account where username='".$username."' && password='".$password."' && status='activated'";
    $query= $this->connect()->query($stmnt);
    $result=$query->fetch(PDO::FETCH_ASSOC);
	if($query->rowCount()>0){
		$_SESSION['uname']= $username;
        $role= $result['role'];
        switch ($role) {
            case 'student':
                header('location: student/index.php');
                break;
            case 'Finance':
                header('location: finance/index.php');
                break;
            case 'Admin':
                header('location: admin/manageaccount2.php');
                break; 
            case 'Registrar':
                header('location: registrar/pendingadmission.php');
                break; 
            case 'Quality Assurance':
                header('location: curriculum/curriculum.php');
                break;
            case 'Faculty Head':
                header('location: faculty/index.php');
                break;
            case 'Department Head':
            header('location: dept_head/index.php');
            break;
            case 'Librarian':
                header('location: Librarian/index.php');
                break;
            case 'Instructor':
                header('location: teacher/index.php');
                break;
            default:
               header('location: instructor.php');
                break;
        }
		
	}
	
        $stmnt2="select * from account where username='".$username."' && password='".$password."' && status='deactivated'";
    $query2= $this->connect()->query($stmnt2);
    if ($query2->rowCount()>0){

         echo "<h4><i style='color: red;'>This account has been deactivated!! Please contact the administrators</i></h4>";
    }
    else echo "<h4><i style='color: red;'>Please fill your username/password correctly</i></h4>";

}
 
 catch(PDOException $e){
     
     echo "<h4><i style='color: red;'>No room for SQL Injection</i></h4>";
 }
 }
}
?>
