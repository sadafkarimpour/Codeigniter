

<div id="App" class="container-fluid text-center" >

	<div class='row text-center alert alert-success alert-dismissible' id='success' style="display: none;" >
		<div class="col col-lg-12 col-md-12 col-sm-12 col-12 text-center">
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>
		</div>
	</div>
	<div class='row text-center alert alert-danger alert-dismissible' id='error' style="display: none;" >
		<div class="col col-lg-12 col-md-12 col-sm-12 col-12 text-center">
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>
		</div>
	</div>

	<form  method='POST' action='' autocomplete='off' id='loginform' class="container align-items-center justify-content-center" style="width:500px" >
			<main class="row w-100 h-100 align-items-center" >
				<div class='col w-100  h-50  bg-dark text-white rounded' >
						<div class=' w-100 h-25 d-flex align-items-center justify-content-center'>
								<div class='row w-100 h-25 align-items-center'>
										<p  class='col col-lg-12 col-md-12 col-sm-12 p-1 m-12'>
										Login
										</p>
								</div>
						</div>
		
						<div  class='row w-100 d-flex justify-content-center' id="emailin">
								<input v-model="email" required  class='col col-lg-9 col-md-9 col-sm-9 col-9 p-1 mb-4  h-50 ' id='emaillog'  type='email' name='data[email]' placeholder='Email'  autocomplete='off'>
								<!-- <span style="margin-top:-15px ;color:green" v-if="!validateEmail()">Your Email is not valid.</span> -->
							</div>
		
						<div  class='row w-100 d-flex justify-content-center'>
								<input  v-model="passwordd"  class='col col-lg-9 col-md-9 col-sm-9 col-9 p-1 mb-4   h-50' id='passworddlog'  type='password' name='data[passwordd]' placeholder='Password'   autocomplete='off'>
						</div>
		
						<div  class='row  w-100 d-flex justify-content-center'>
								<button @click="loginmsg()" class='col col-lg-9 col-md-9 col-sm-9 col-9 p-1 mb-4   btn btn-primary text-white'  type='button'  name='login' id='loginbut'  >Login</button>
						</div>
		
						<!-- <div class='container' > -->
								<div  class='row  w-100 d-flex justify-content-center'>
										<div class='col col-lg-6 col-md-6 col-sm-6 col-6 d-flex justify-content-end  '>
												<h6 class="textsize" >Not registered?</h6>
										</div>
										<div class='col col-lg-6 col-md-6 col-sm-6 col-6 d-flex justify-content-start'>
												<p class="textsize" >Click here to <a href='<?php echo $PATH ?>auth/register'>Sign Up</a></p>  
										</div>
								</div>
						<!-- </div> -->
				</div>
			</main>
	</form>
</div>

<script>
Vue.createApp({
	data(){
    return{
			email:'',
			passwordd:'',
		}
	},

  methods:{
	  loginmsg(){
      if((this.email)!="" && (this.passwordd)!=""){
        let url = "<?php echo $PATH ?>auth/doLogin";
        $.ajax({
          url:url,
          type:"POST",
          data:{
            email:this.email,
            passwordd:this.passwordd,
          },
          cache:false,
          success:(dataResult)=>{
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
  
		}
	}


}).mount('#App');




// Vue.createApp({
//     data() {
//       return {
//         email: '',
//     	reg: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,
// 		// msg: [],
//       }
//     },

//     methods: {

//         validateEmail(){
// 			// console.log("email: " + this.email)
// 			// console.log("email len: " + this.email.length)
// 			if(this.email.length < 1){
// 				return true
// 			}
//             if (this.reg.test(this.email)) {
// 				// return this.msg['email'] = '';
// 				return true
//             } else {
               
// 				// return this.msg['email'] = 'Please enter a valid email address';
// 				return false
//             }
//         }

//     }
//   }).mount('#emailin');

</script>


