<!-- 
<div class="container-fluid navbar navbar-expand-lg  col fixed-top p-3 mb-2 ml-3  bg-primary  align-middle text-center">
  <div class="row ">
            <div class="col-lg-2 col-md-2 col-sm-1  align-middle text-center">
                <a href="<?php echo $PATH."index.php"?>" class="text-white  align-middle text-center">Home</a>
            </div>
			<?php if(Usermodel::getCurrentUserId()) { ?>
            <div class="col-lg-2 col-md-2 col-sm-1  align-middle text-center ">
                <a href="<?php echo $siteUrl ?>" class="text-white  align-middle text-center">Notes</a>
            </div>
			<?php } ?>
			<?php if(!Usermodel::getCurrentUserId()) { ?>
            <div class="col-lg-2 col-md-2 col-sm-1  align-middle text-center"> 
                <a href="<?php echo $siteUrlauth?>" class="text-white  align-middle text-center">Login</a>
            </div>
			<?php }?>
            <div class="col-lg-2 col-md-2 col-sm-1  align-middle text-center">
                <a href="<?php echo $siteUrllogout?>" class="text-white  align-middle text-center">Logout</a>
            </div>
			<?php if(!Usermodel::getCurrentUserId()) { ?>
            <div class="col-lg-2 col-md-2 col-sm-1  align-middle text-center">
                <a href="<?php echo $siteUrlreg?>" class="text-white  align-middle text-center">Register</a>
            </div>
			<?php } ?>
  </div>
</div> -->

<nav class="navbar navbar-expand-lg fixed-top bg-primary text-white text-center  align-self-center justify-content-center align-items-center " style="font-size: px;">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse text-center align-self-center align-items-center" id="navbarSupportedContent">
    <ul class="navbar-nav text-center align-self-center">
      <li class="nav-item active">
        <a class="nav-link text-white" href="<?php echo $PATH."index.php"?>" >Home</a>
      </li>
      <li class="nav-item ">
        <?php if(Usermodel::getCurrentUserId()) { ?>
        <a class="nav-link text-white" href="<?php echo $siteUrl ?>" >Notes</a>
        <?php } ?>
      </li>
      <li class="nav-item ">
        <?php if(!Usermodel::getCurrentUserId()) { ?>
        <a class="nav-link text-white" href="<?php echo $siteUrlauth?>" >Login</a>
        <?php } ?>
      </li>
      <li class="nav-item ">
        <a class="nav-link text-white" href="<?php echo $siteUrllogout?>" >Logout</a>
      </li>
      <li class="nav-item ">
        <?php if(!Usermodel::getCurrentUserId()) { ?>
        <a class="nav-link text-white" href="<?php echo $siteUrlreg?>" >Register</a>
        <?php } ?>
      </li>
    </ul>
  </div>
</nav>


