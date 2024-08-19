<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #27408B;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="" style="color: white;">siszion</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <?php
     $path= "../uploads/";
      $obj = new Profile;
      echo $obj->displayshort($path,"account",$_SESSION['uname']);

      ?>

            </li>
        </ul>
    </div>
</nav>
