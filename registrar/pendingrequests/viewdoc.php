<?php
include_once '../../database.php';

class ViewDoc extends db{

        public function viewDocs(){
   $doc=$_GET['id'];
        echo $doc;
    $stmnt="select * from pendingrequest where id='".$_GET['id']."'";
        $result= $this->connect()->query($stmnt);
        $res=$result->fetchAll();
             foreach($res as $row){
                 $docx=$row['documents'];
}
        echo $docx;
        $path= '../../uploads/';
        $file = $path.$docx;
        header('Content-type: application/pdf');
        header('Content-Description: inline; filename="'.$file.'"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        @readfile($file);
        }

}

$obj=new ViewDoc;
$obj->viewDocs();
?>
