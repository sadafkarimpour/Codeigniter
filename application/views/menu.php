
<div class="v-container-fluid v-col col fixed-top p-3 mb-2 ml-3  bg-primary  align-middle text-center">
  <div class="row ">
            <div class="col-lg-2 col-md-2 col-sm-1  align-middle text-center">
                <a href="<?php echo $PATH."index.php"?>" class="text-white  align-middle text-center">Home</a>
            </div>
			<?php if(!Usermodel::getCurrentUserId()) { ?>
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
</div>
