<?php  
 if(isset($_POST["create_pdf"]))  
 {  
      require_once('tcpdf/tcpdf.php'); 
      // Extend the TCPDF class to create custom Header and Footer
     ob_end_clean();

    class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file ='tcpdf/hwu logo.png';
        //Image( $file, $x = '', $y = '', $w = 0, $h = 0, $type = '', $link = '', $align = '', $resize = false, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = false, $hidden = false, $fitonpage = false, $alt = false, $altimgs = array() );
        $this->Image($image_file, 10, 5, 10, 10, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('times', 'B', 20);
        // Title
        $this->Cell(0, 10, 'Hawassa University 2011 GC Students Yearbook', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Line(5, 17, $this->w - 5, 17);
    }

    // Page footer
    public function Footer() {
        $this->Line(5, $this->y, $this->w - 5, $this->y);
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('times', 'I', 8);
        // Page number
        $this->Cell(10, 15, $this->getAliasNumPage(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
     
     
      // create new PDF document
      $obj_pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
      $image_file ='tcpdf/cover.jpeg';
        //Image( $file, $x = '', $y = '', $w = 0, $h = 0, $type = '', $link = '', $align = '', $resize = false, $dpi = 300, $palign = '', $ismask = false, $imgmask = false, $border = 0, $fitbox = false, $hidden = false, $fitonpage = false, $alt = false, $altimgs = array() );
      $obj_pdf->Image($image_file, 0, 0, 2480, 3508, 'jpeg', '', 'T', false, 300, '', false, false, 0, false, false, false);
      // set document information
      $obj_pdf->SetCreator(PDF_CREATOR);
      $obj_pdf->SetAuthor('Solomon Girmay');
      $obj_pdf->SetTitle('Hawassa University 2011 GC Students Yearbook');
      $obj_pdf->SetSubject('Yearbook Pdf generator');
    

      // set default header data
      $obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

      // set header and footer fonts
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
      
      // set default monospaced font
      $obj_pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

      // set margins
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

      // set auto page breaks
      $obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
      // set image scale factor
      $obj_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
      
      $obj_pdf->SetFont('helvetica', '', 12);  
      $obj_pdf->AddPage(); 
      $connect = mysqli_connect("localhost", "root", "", "2011");
      $img="Image";
      $txt="Text";
      $content = '';  
     $coverpage = "SELECT * FROM modification";  
     $coverpageRes = mysqli_query($connect, $coverpage);
     $coverpageResu = mysqli_fetch_array($coverpageRes); 
     $coverpageImg=$coverpageResu['Logo'];
     $content = '<figure id="slide-2"><img style="width:710px; height:868px" src="Admin/Logo/student-icon-graduation-with-mortar-board-for-vector-19676166.jpg" alt="">
                                  
                                </figure>
                                <br>
                                <br>
                                <br>
                                '; 
     
     
     
     $stmt = "SELECT * FROM message";  
     $res = mysqli_query($connect, $stmt);
     
     while($resu = mysqli_fetch_array($res))  
     { 
         $S_ID=$resu['Staff_ID'];
         $sel="SELECT * FROM staff where ID='$S_ID' AND Possition!='faculty Dean'";
         $set=mysqli_query($connect,$sel);
         if (mysqli_num_rows($set) > 0) {
         $resa=mysqli_fetch_array($set);
         $fnm=$resa['Fname'];
         $mnm=$resa['Mname'];
         $poss=$resa['Possition'];
         $prof=$resa['ProfileImg'];
             
          $content .= '<h1 style="color:green;"> Message From Staff</h1>
          <h3>'.$poss." ".$fnm." ".$mnm.'</h3>
          <figure id="slide-2"><img style="width:75px; height:80px" src="student/students image/'.$prof.'" alt="">
                                    <div class="block clear" style="padding-left:5px;">   
                                    </div>
                                </figure>
                                <br>
                                <h3><i>"'.$resu['Message'].'"</i></h3>';  
             
         }
        
     }
     
       
      $sql = "SELECT * FROM student ORDER BY Department ASC";  
      $result1 = mysqli_query($connect, $sql); 
     
     $arrDepartment=array();
                            
                            $i=0;
                           while($rows = mysqli_fetch_array($result1))
                           {   $arrDepartment[$i]=$rows['Department'];
                            $i++;
                           }
    
     for ($i=0; $i<count($arrDepartment); $i++){
    $stmt = "SELECT * FROM message";  
     $res = mysqli_query($connect, $stmt);
     while($resu = mysqli_fetch_array($res))  
     { 
         $content .= '<h1 style="color:blue; ";>'.$arrDepartment[$i].' Department</h1>';
         $S_ID=$resu['Staff_ID'];
         $sel="SELECT * FROM staff where ID='$S_ID' AND Department='$arrDepartment[$i]' AND Possition='faculty Dean'";
         $set=mysqli_query($connect,$sel);
         if (mysqli_num_rows($set) > 0) {
         $resa=mysqli_fetch_array($set);
         $fnm=$resa['Fname'];
         $mnm=$resa['Mname'];
         $poss=$resa['Possition'];
         $prof=$resa['ProfileImg'];
             
          $content .= '<h1 style="color:green;"> Message From Staff</h1>
          <h3>'.$poss." ".$fnm." ".$mnm.'</h3>
          <figure id="slide-2"><img style="width:75px; height:80px" src="student/students image/'.$prof.'" alt="">
                                    <div class="block clear" style="padding-left:5px;">   
                                    </div>
                                </figure>
                                <br>
                                <h3><i>"'.$resu['Message'].'"</i></h3>'; 
             
         }
     }
    
     $st = "SELECT * FROM student WHERE Department='$arrDepartment[$i]'";  
     $result11 = mysqli_query($connect, $st); 
     
     while($result = mysqli_fetch_array($result11))  
      {   
         $ID=$result['ID'];
         $cover=$result['Cover'];
         $pro=$result['ProfileImg'];
         $depar=$result['Department'];
         $childhoodImg=$result['childishImg'];
         $tnxTxt=$result['tanxText'];
         $bio=$result['biography'];
         
     
         
         
        $content .='<div class="wrapper">
        <div id="slider">
            <div class="rounded">
                <main id="slide-wrapper" class="container clear">
                                <div class="hp">
                                    <h3>'.$result['Fname']." ".$result['Mname']." ".$result['Lname'].'</h3>
                                </div>
                                
                                <figure id="slide-2"><img style="width:670px; height:200px" src="student/students image/'.$cover.'" alt="">
                                    <div class="block clear" style="padding-left:5px;">   
                                    </div>
                                </figure>
                                <figure id="slide-2"><img style="width:75px; height:80px" src="student/students image/'.$pro.'" alt="">
                                    <div class="block clear" style="padding-left:5px;">   
                                    </div>
                                </figure>
                                <h1>Childhood Image</h1>
                                <figure id="slide-2"><img style="width:200px; height:200px" src="student/students image/'.$childhoodImg.'" alt="">
                                    <div class="block clear" style="padding-left:5px;">   
                                    </div>
                                </figure>
                                <h1>Thanks Text</h1>
                                <h3>"'.$tnxTxt.'"</h3>
                                <h1>Biography</h1>
                                <h3>"'.$bio.'"</h3>';
                       $sq = "SELECT * FROM uploads where G_ID='$ID'";  
                        $result = mysqli_query($connect, $sq);
                        while($resul = mysqli_fetch_array($result))  
                        {  $type=$resul['Types'];
                           $desc=$resul['PostDisc'];
                           if($type==$img){
                               if($desc!=null){
                               $content .='<h2><i>'.$resul['PostDisc'].'</i></h2>';
                                }
                            $content .='<figure id="slide-2"><img style="width:450px; height:350px" src="student/students image/'.$resul['PostFile'].'" alt="">
                                    <div class="block clear" style="padding-left:5px;">   
                                    </div>
                                </figure>';
                           }
                          if($type==$txt){
                              if($desc!=null){
                               $content .='<h1> <i>'.$desc.'<i></h1>';
                               }
                               $content .='<h2>'.$resul['PostFile'].'</h2>';
                           }
                         
                        }$content .=' 
                </main>
            </div>
        </div>
    </div>'; 
      }
         
     }
      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('Yearbook.pdf', 'I');  
 }  
 ?>
<!DOCTYPE html>
<html>

<head>
    <title>yearbook</title>
    <link rel="shortcut icon" href="student/students image/yearbook.jpg" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <link rel="icon" type="image/png" herf="images/demo/avatar.png">
    <link href="layout/styles/framework.css" rel="stylesheet" type="text/css" media="all">
</head>

<body>
    <br /><br />
    <div style="margin-top:350px; margin-left:550px;">
        
            <br />
            <form method="post">
                <input style=" width:300px; height:40px; color:blue; font-size:25px; " type="submit" name="create_pdf"   value="Download E-Yearbook" />
            </form>
        
    </div>
</body>

<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.fitvids.min.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<script src="layout/scripts/tabslet/jquery.tabslet.min.js"></script>

<script src="../layout/scripts/nivo-lightbox/nivo-lightbox.min.js"></script>

</html>