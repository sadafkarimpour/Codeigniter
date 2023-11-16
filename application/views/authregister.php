


<div id="App" class="container-fluid text-center" >
	<div class='row d-none alert alert-success alert-dismissible ' id='success' >
		<div  class="col mt-3">
			<a href='#' class='col close' data-dismiss='alert' aria-label='close'>×</a>
		</div class="col mt-3"> 
		<div class='row d-none alert alert-danger alert-dismissible' id='error' >
			<a href='#' class='col close' data-dismiss='alert' aria-label='close'>×</a>
		</div>
	</div>
	<form  method='POST' action='' autocomplete='off' id='signform' class="container d-flex align-items-center justify-content-center" style="width:650px">
		<main class="row w-100 h-75 align-items-center " >
			<div class='col w-100 h-75 bg-dark text-white rounded' >
				<!-- <div class='container w-100 '> -->
					<div class='row w-100 '>
						<p  class='col col-lg-12 col-md-12 col-sm-12 p-1 m-1'>
							Sign Up
						</p>
					</div>
			
				
					<div  class='row w-100 d-flex justify-content-center m-2'>
						<input v-model="fname" class='col col-lg-10 col-md-10 col-sm-10 col-10 p-1 h-50 ' id='fname' type='text' name='data[fname]' placeholder='First Name'  autocomplete='off'>
					</div>
					
					<div  class='row w-100 d-flex justify-content-center m-2'>
						<input v-model="lname" class='col col-lg-10 col-md-10 col-sm-10 col-10 p-1 h-50' id='lname' type='text' name='data[lname]' placeholder='Last Name'  autocomplete='off'>
					</div>
			
					<div  class='row w-100 d-flex justify-content-center m-2'>
						<input v-model="username" class='col col-lg-10 col-md-10 col-sm-10 col-10 p-1 h-50' id='username'  type='text' name='data[username]' placeholder='Username'  autocomplete='off'>
					</div>
			
					<div  class='row w-100 d-flex justify-content-center m-2'>
						<input v-model="phonenumber" class='col col-lg-10 col-md-10 col-sm-10 col-10 p-1 h-50' id='phone-number'  type='text' name='data[phone-number]' placeholder='Phone Number'  autocomplete='off'>
					</div>
			
					<div  class='row w-100 d-flex justify-content-center m-2'>
						<input v-model="email"  class='col col-lg-10 col-md-10 col-sm-10 col-10 p-1 h-50 ' id='email'  type='email' name='data[email]' placeholder='Email'  autocomplete='off'>
					</div>
			
					<div  class='row w-100 d-flex justify-content-center m-2'>
						<input v-model="passwordd" class='col col-lg-10 col-md-10 col-sm-10 col-10 p-1 h-50' id='passwordd'  type='password' name='data[passwordd]' placeholder='Password'   autocomplete='off'>
					</div>
			
					<div  class='row w-100 d-flex justify-content-center m-2'>
						<button class='col col-lg-10 col-md-10 col-sm-10 col-10 p-1 h-50 btn btn-primary text-white'  type='button'  name='signup' id='signupbut' @click="signup()" >Sign Up</button>
					</div>
		
					<!-- <div class='container '> -->
						<div  class='row d-inline-flex w-100 h-50'>
							<div class='col col-lg-6 col-md-6 col-sm-6 ' >
								<h6 >Already signed up?</h6>
							</div>
							<div class='col col-lg-6 col-md-6 col-sm-6 ' >
								<p >Click here to <a href='<?php echo $PATH ?>authlogin.php'>Login</a></p>  
							</div>
						</div>
					<!-- </div> -->
				<!-- </div> -->
			</div>
		</main>
	</form>
</div>
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
