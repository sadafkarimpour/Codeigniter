

<center>
<div class=' alert alert-success alert-dismissible ' id='success' style='display:none;margin-top:50px'>
    <div >
	  <a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>
	</div>
	<div class='alert alert-danger alert-dismissible' id='error' style='display:none;margin-top:50px'>
	  <a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>
	</div>
</div>
<form  method='POST' action='' autocomplete='off' id='signform'>
    <main>
        <div class=' w-50  bg-dark text-white rounded' style='margin-top:100px;height:500px;padding-top:20px;'>
            <div class='container'>
                <div class=' w-50 '>
                    <p  class='col-lg-12 col-md-6 col-sm-1 p-1 m-3'>
                        Sign Up
                    </p>
                </div>
            </div>
            
            <div  class='row w-50 m-3'>
                <input class='col-lg-12 col-md-6 col-sm-1  p-1 w-70 h-50 ' id='fname' type='text' name='data[fname]' placeholder='First Name'  autocomplete='off'>
            </div>
            
            <div  class='row  w-50 m-3'>
                <input class='col-lg-12 col-md-6 col-sm-1 p-1 w-70 h-50' id='lname' type='text' name='data[lname]' placeholder='Last Name'  autocomplete='off'>
            </div>
    
            <div  class='row w-50 m-3'>
                <input class='col-lg-12 col-md-6 col-sm-1 p-1 w-70 h-50' id='username'  type='text' name='data[username]' placeholder='Username'  autocomplete='off'>
            </div>
    
            <div  class='row  w-50 m-3'>
                <input class='col-lg-12 col-md-6 col-sm-1 p-1 w-70 h-50' id='phone-number'  type='text' name='data[phone-number]' placeholder='Phone Number'  autocomplete='off'>
            </div>
    
            <div  class='row  w-50 m-3'>
                <input class='col-lg-12 col-md-6 col-sm-1 p-1 w-70 h-50 ' id='email'  type='email' name='data[email]' placeholder='Email'  autocomplete='off'>
            </div>
    
            <div  class='row  w-50 m-3'>
                <input class='col-lg-12 col-md-6 col-sm-1 p-1 w-70 h-50' id='passwordd'  type='password' name='data[passwordd]' placeholder='Password'   autocomplete='off'>
            </div>
    
            <div  class='row  w-50 m-3'>
                <button class='col-lg-12 col-md-6 col-sm-1 p-1  btn btn-primary text-white'  type='button'  name='signup' id='signupbut' >Sign Up</button>
            </div>
    
            <div class='container '>
                <div  class='row d-inline-flex w-50 h-50'>
                    <div class='col-lg-6 col-md-3 col-sm-1 ' >
                        <h6 >Already signed up?</h6>
                    </div>
                    <div class='col-lg-6 col-md-3 col-sm-1 ' >
                        <p >Click here to <a href='<?php echo $PATH ?>authlogin.php'>Login</a></p>  
                    </div>
                </div>
            </div>
 
        </div>
    </main>
</form>
</center>
<script>

$(document).ready(function(){
    $("#signupbut").click(function(){
    $('#signupbut').attr('disabled','disables');
    var fname=$('#fname').val();
    var lname=$('#lname').val();
    var username=$('#username').val();
    var phone_number=$('#phone-number').val();
    var email=$('#email').val();
    var password=$('#passwordd').val();

    if(!fname || !lname || !username || !phone_number || !email || !password){
        alert('Please fill all the field !');
        return;
    }

    let url = "<?php echo $PATH ?>auth/doregister";

    $.ajax({
        url:url,
        type:'POST',
        data:{
            fname:fname,
            lname:lname,
            username:username,
            phone_number:phone_number,
            email:email,
            passwordd:password,
        },
        success: function(dataResult){
            var data = JSON.parse(dataResult);
            if(data.statusCode==200){
                $('#signupbut').removeAttr('disabled');
                $('#signform').find('input:text').val('');
                $('#success').show();
                $('#success').html('Registration successful !'); 
                location.href = "<?php echo $PATH ?>auth/login";
            }
            else if(data.statusCode==201){
              $('#error').show();
              $('#error').html('Email already exists!')
            }
        }
    });
});
});



</script>
