

<center>

<div id="App">
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
                <input v-model="fname" class='col-lg-12 col-md-6 col-sm-1  p-1 w-70 h-50 ' id='fname' type='text' name='data[fname]' placeholder='First Name'  autocomplete='off'>
            </div>
            
            <div  class='row  w-50 m-3'>
                <input v-model="lname" class='col-lg-12 col-md-6 col-sm-1 p-1 w-70 h-50' id='lname' type='text' name='data[lname]' placeholder='Last Name'  autocomplete='off'>
            </div>
    
            <div  class='row w-50 m-3'>
                <input v-model="username" class='col-lg-12 col-md-6 col-sm-1 p-1 w-70 h-50' id='username'  type='text' name='data[username]' placeholder='Username'  autocomplete='off'>
            </div>
    
            <div  class='row  w-50 m-3'>
                <input v-model="phonenumber" class='col-lg-12 col-md-6 col-sm-1 p-1 w-70 h-50' id='phone-number'  type='text' name='data[phone-number]' placeholder='Phone Number'  autocomplete='off'>
            </div>
    
            <div  class='row  w-50 m-3'>
                <input v-model="email"  class='col-lg-12 col-md-6 col-sm-1 p-1 w-70 h-50 ' id='email'  type='email' name='data[email]' placeholder='Email'  autocomplete='off'>
            </div>
    
            <div  class='row  w-50 m-3'>
                <input v-model="passwordd" class='col-lg-12 col-md-6 col-sm-1 p-1 w-70 h-50' id='passwordd'  type='password' name='data[passwordd]' placeholder='Password'   autocomplete='off'>
            </div>
    
            <div  class='row  w-50 m-3'>
                <button class='col-lg-12 col-md-6 col-sm-1 p-1  btn btn-primary text-white'  type='button'  name='signup' id='signupbut' @click="signup()" >Sign Up</button>
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
</div>
</center>
<script>

Vue.createApp({
	data(){
		return{
			fname:'',
			lname:'',
			username:'',
			phonenumber:'',
			email:'',
			passwordd:'',
		}
	},

  	methods:{
		signup(){
			if(!(this.fname) || !(this.lname) || !(this.username) || !(this.phonenumber) || !(this.email) || !(this.passwordd)){
				alert('Please fill all the field !');
				return;
			}

			let url = "<?php echo $PATH ?>auth/doregister";
			// log_message("debug", "fname: " . print_r(this.fname, true));
			// log_message("debug", "lname: " . print_r(this.fname, true));
			// log_message("debug", "username: " . print_r(this.username, true));
			// log_message("debug", "phonenumber: " . print_r(this.phonenumber, true));
			// log_message("debug", "email: " . print_r(this.email, true));
			// log_message("debug", "passwordd: " . print_r(this.passwordd, true));
			$.ajax({
				url:url,
				type:'POST',
				data:{
					fname:this.fname,
					lname:this.lname,
					username:this.username,
					phone_number:this.phonenumber,
					email:this.email,
					passwordd:this.passwordd,
				},


				success:(dataResult)=>{
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
	}
}

}).mount('#App');



</script>
