


<style>
@media (min-width: 1200px) {
  .textsize {
    font-size: 15px;
  }
}
@media (max-width: 1199.98px) {
  .textsize {
    font-size: 12px;
  }
}
@media (max-width: 599px) {
  .textsize {
    font-size: 10px;
  }
}
@media (max-width: 531px) {
  .textsize {
    font-size: 8px;
  }
}
/* @media (max-width: 597px) {
  .textsize {
    font-size: 10px;
  }
}
@media (max-width: 534px) {
  .textsize {
    font-size: 8px;
  }
} */
</style>
<center>


<div class='alert alert-success alert-dismissible' id='success' style='display:none;margin-top:50px'>
	  <a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>
	</div>
	<div class='alert alert-danger alert-dismissible' id='error' style='display:none;margin-top:50px'>
	  <a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>
	</div>
<form  method='POST' action='' autocomplete='off' id='loginform'>
    <main>
      <div class="container">
        <div class="row">
        <div class=' w-50 bg-dark text-white rounded' style='margin-top:180px;height:300px;padding-top:20px;'>
            <div class='container'>
                <div class=' w-50 '>
                    <p  class='col-lg-12 col-md-6 col-sm-1 p-1 m-3'>
                    Login
                    </p>
                </div>
            </div>
    
            <div  class='row  w-100 d-flex justify-content-center'>
                <input class='col-lg-8 col-md-9 col-sm-6 col-8 p-1 mb-3 w-70 h-50 ' id='emaillog'  type='email' name='data[email]' placeholder='Email'  autocomplete='off'>
            </div>
    
            <div  class='row  w-100 d-flex justify-content-center'>
                <input class='col-lg-8 col-md-9 col-sm-6 col-8 p-1 mb-3  w-70 h-50' id='passworddlog'  type='password' name='data[passwordd]' placeholder='Password'   autocomplete='off'>
            </div>
    
            <div  class='row  w-100 d-flex justify-content-center'>
                <button class='col-lg-8 col-md-9 col-sm-6 col-8 p-1 mb-3 w-70  btn btn-primary text-white'  type='button'  name='login' id='loginbut' onclick='Login();' >Login</button>
            </div>
    
            <div class='container' >
                <div  class='row  w-100 d-flex justify-content-center'>
                    <div class='col-lg-6 col-md-6 col-sm-6 col-6 d-flex justify-content-end  ' style="font-size: 15px;" >
                        <h6 class="textsize" >Not registered?</h6>
                    </div>
                    <div class='col-lg-6 col-md-6 col-sm-6 col-6 d-flex justify-content-start'  style="font-size: 15px;">
                        <p class="textsize" >Click here to <a href='<?php echo $PATH ?>auth/register'>Sign Up</a></p>  
                    </div>
                </div>
            </div>
 
        </div>
        </div>
      </div>
    </main>
</form>
</center>
<script>

$(document).ready(function() {
$('#loginbut').on('click',function(){
      var email=$("#emaillog").val();
      var passwordd=$("#passworddlog").val();
      if(email!="" && passwordd!=""){
        let url = "<?php echo $PATH ?>auth/doLogin";
        $.ajax({
          url:url,
          type:"POST",
          data:{
            email:email,
            passwordd:passwordd,
          },
          cache:false,
          success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						location.href = "<?php echo $PATH ?>note/index";						
					}
					else if(dataResult.statusCode==201){
						$("#error").show();
						$('#error').html('Invalid EmailId or Password !');
					}
					
				}
			});
		}
		else{
      
			alert('Please fill all the field !');
     
		}
    });

});
</script>

<?php require_once "footer.php"; ?>
