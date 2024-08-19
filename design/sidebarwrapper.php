 <!-- Sidebar -->
 <div class="" id="sidebar-wrapper" style="background-color: #34495E;">
     <div class="sidebar-heading">
         <?php
     $path= "../uploads/";
      $obj = new Profile;
      echo $obj->displaylong($path);
      ?> </div><br>
     <div class="list-group list-group-flush">
         <a href="#" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Student grade report</a>

         <a href="#" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Registration slip</a>
         <a href="#" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Student copy</a>
         <a href="#" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Admission</a>
         <a href="#" class="list-group-item list-group-item-action text-white" style="background-color: #34495E;">Clearance/Withdraw</a>

     </div>
 </div>
 <!-- /#sidebar-wrapper -->

 <!-- Page Content -->
