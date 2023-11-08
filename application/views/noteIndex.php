<?php

// require_once 'header.php';

// require_once 'database.php';


// session_start();
// $usid=$_SESSION["id"];


?>


<div id="App" class="container-fluid text-center" >
	<form action="" method="POST">

	<div class='row mt-3 d-none alert alert-success alert-dismissible' id='success' >
	  <a href='#' class='col close' data-dismiss='alert' aria-label='close'>×</a>
	</div>
	<div class='row mt-3 d-none alert alert-danger alert-dismissible' id='error' >
	  <a href='#' class='col close' data-dismiss='alert' aria-label='close'>×</a>
	</div>


    <div :style="{height:isheight+'px'}" class="container bg-dark text-white rounded d-flex align-items-center justify-content-center" style="width:1300px">
		<div class="row w-100 h-100 align-items-center">
			<div class="col w-100 h-100">
				<div class='container-fluid w-100 ' >
					<div class="row w-100 ">
					<h2 class="col col-lg-12 col-md-12 col-sm-12 p-1 bg-primary">
					<?php
					echo $usid."یادداشت های";
					?>
				</h2>
					</div>
				</div>
				<div class='container-fluid w-100 h-75' >
					<div class='row w-100 h-100'>
						<div class="col col-lg-5 col-md-5 col-sm-5"  >
						<!-- base_url for image url -->
							<img  src="<?php echo $base_url?>" alt="" class="w-100 h-100" >
						</div>
  
    
   
						<div  class="col col-lg-7 col-md-7 col-sm-7  text-white align-self-start" >
							<table class="w-100">
								<tr >
									<div class="col-lg-2 col-md-2 col-sm-1 p-2 m-2" >
									<th style="border:1px solid white ; color:white" >شماره</th>
									</div>
								
									<div class="col-lg-2 col-md-2 col-sm-1 p-2 m-2 text-white" >
									<th  style="border:1px solid white ; color:white">تاریخ</th>

									</div>
									<div class="col-lg-2 col-md-2 col-sm-1 p-2 m-2 text-white">
									<th style="border:1px solid white ; color:white">عنوان</th>

									</div >

									<div class="col-lg-2 col-md-2 col-sm-1 p-2 m-2 text-white" >
									<th style="border:1px solid white ; color:white" >متن</th>

									</div>
									<div class="col-lg-2 col-md-2 col-sm-1 p-2 m-2 text-white" >
									<th style="border:1px solid white ; color:white;">حذف / ویرایش</th>

									</div>
									</tr>
								<?php 

							


								$num_page=4;
								
								if($page1){
									$page=$page1;
								}
								else{
									$page=1;
								}
								


								$numRows = 0;
								
								$c = &get_instance();
								$c->load->model('Notemodel');
							
								$notes=$c->Notemodel->find($usid, $page, $num_page, $numRows);

								// print_r("notes:<hr/>");
								// print_r($notes);
								
								
								
							
									
									?>
							
								
									<tr v-for="note in notes"  style='border:1px solid white ; color:white;text-align:center;'>
										<td style='border:1px solid white ; color:white;text-align:center;justify-content:center;'><div  class='col-lg-2 col-md-2 col-sm-1 p-1 m-2 w-100 ' v-html="note.id" ></div></td>
										<td   style='border:1px solid white ; color:white;justify-content:center;text-align:center'><div class='col-lg-2 col-md-2 col-sm-1 p-1 m-2 w-100 text-justify text-center' v-html="note.datetime_created "></div></td>
										<td   style='border:1px solid white ; color:white'>
											<div v-if="editing && note.id == editId" >
												<input v-model="title" id='title' type='text' placeholder='عنوان یادداشت' class='w-75 p-2 m-3'>
											</div>
											<div v-else class='col-lg-2 col-md-2 col-sm-1 p-1 m-2 w-100' v-html="note.title" style="justify-content:center;text-align:center"></div>
										</td>
										<td style='border:1px solid white ; color:white ;padding-right:20px'>
											<div v-if="editing && note.id == editId" >
												<input v-model="description" id='description' type='text' placeholder='متن یادداشت' class='w-75 p-2 m-3'>
											</div>
											<div v-else class='col-lg-2 col-md-2 col-sm-1 p-2 m-2 w-100' v-html="note.description" style="justify-content:center;text-align:center; display: block; overflow-y: scroll;padding: 5px;height: 95px"></div>
										</td>
										<td>

											<div  class='btn-group'>
												
												<a v-if="editing &&  note.id == editId"  @click="doedit(editing)" class='btn btn-primary' >ثبت</a>
												<a v-else  @click="edit(note)" class='btn btn-primary'>ویرایش</a>

												

												<a class='btn btn-danger' @click="deletebut(note.id)">حذف</a>
											
											</div>
							
										</td>
									
									</tr>
								
								
							</table>

						</div>
	
						<!-- add note form -->
	<div class="" id="Appadd"  v-if="open" style="display: flex;align-items:center;justify-content:center;text-align: center;padding-left:150px;margin-top:20px;border:1px solid white">
		<form action="" method="POST" id="addform">
				<div  class=' w-100  bg-dark text-white rounded' style='height:150px'>
					<div class="container-fluid " >
						<div class="row">
							<input id="title" v-model="titled"  type="text" placeholder="عنوان یادداشت" name="data[title]" class="w-75 p-1 m-2 h-25" >
						</div>
					</div>
					<div class="container-fluid ">
						<div class="row">
						<	input id="note" v-model="noted" type="text" placeholder="متن یادداشت" name="data[note]"  class="w-75 p-1  m-2 h-25">
						</div>
					</div>
					<div class="container-fluid" style="padding-left: 120px;">
						<div class="row">
							<button class="btn btn-primary col-lg-6  w-25 p-1 m-1" type="button" name="save" id="save" @click="savebut()" >Save</button>
							<button class="btn btn-outline-primary col-lg-6 w-25 p-1 m-1 " type="button" name="return" id="return" @click="returnbut()" >Return</button>
						</div>
					</div>
			</div>
		</form>
	</div>
					
    </div>
    </div>
    </div>
    </div>
	</div>
     <div class="container" >
          <div class="row" style="margin-top: 10px">

          <div  class='col-lg-4' >
        <button @click="addnote()"   class='w-70 h-70 col-lg-6 col-md-3 col-sm-1 p-1   btn btn-primary text-white' style="margin-left:60px"   type='button'  name='addnew' id='addnew' >Add New</button>
		<!-- onclick="addnotes();" -->
    </div>
          <div class="col-lg-8">
     <?php 
            
       
            // $sql="SELECT * from `addnote` WHERE   `user_id`=$usid  " ;
            // $sql_result=mysqli_query($connect,$sql);
            // $total=mysqli_num_rows($sql_result);
            // $total_pages=ceil($total/$num_page);
           $start=1;$end=$numRows;$pre=0;$next=0;
           echo '<a href ="'. $PATH .'note/index?page=' . $start . '" class="col-lg-1 p-2 mt-2  border border-primary rounded-circle bg-primary text-white" style="margin-right:5px;text-decoration:none;margin-left:370px">Start </a>';

               if ($page==$start){
                $pre=$page;
               }
               else{
                $pre=$page-1;
               }
           
                if ($page==$end){
                    $next=$end;
                }
                else{
                    $next=$page+1;
                }
             
                echo '<a href ="'. $PATH .'note/index?page=' . $pre . '" class="col-lg-1 p-2 mt-2 border border-primary rounded-circle bg-primary text-white" style="margin-right:5px;text-decoration:none">Pre </a>';

                echo '<a href ="'. $PATH .'note/index?page=' . $page . '" class="col-lg-1 p-2 mt-2  border border-primary rounded-circle bg-primary text-white" style="margin-right:5px;text-decoration:none">' . $page . ' </a>';
               
                echo '<a href ="'. $PATH .'note/index?page=' . $next . '" class="col-lg-1 p-2 mt-2 border border-primary rounded-circle  bg-primary text-white" style="margin-right:5px;text-decoration:none">Next</a>';

            

            echo '<a href ="'. $PATH .'note/index?page=' . $end . '" class="col-lg-1 p-2 mt-2  border border-primary rounded-circle bg-primary text-white" style="margin-right:5px;text-decoration:none">End</a>';
      
        
        ?>
        </div>
    
		  </div>
    </div>
	
		  


</form>

</div>
<script>
	Vue.createApp({
	data(){
    return{
		    editing: false,
			open: false,
			isheight:650,
			editId: '',
			title:'',
			description:'',
			notes:[],
			page: 1,
			num_page: 4,
			numRows: 0,
			titled:'',
			noted:'',
			page:'<?php echo $page?>',
			path:'<?php echo $PATH?>'




		}
	},
	mounted(){
		this.getlist()
	},

	

		methods: {
			edit(note){
				this.editing = true
				this.editId = note.id
				this.datetime_created =note.datetime_created
				this.title = note.title
				this.description = note.description
			},

			doedit(editing){
				this.editing=false
					let url = "<?php echo $PATH?>note/update";
					$.ajax({
							url:url,
							type:'POST',
							data:{
									
									id:this.editId,
									title:this.title,
									note:this.description,  
							},
							success:(dataResult)=>{
									var data = JSON.parse(dataResult);
									if(data.statusCode==200){
											$('#success').show();
											$('#success').html('note added successfuly!'); 
											this.getlist();
											
										
									}
									else if(data.statusCode==201){
										$('#error').show();
										$('#error').html('sth went wronge')
									}
							}
					});


			},

			getlist(){
				let url = "<?php echo $PATH?>note/getnotes"
				$.ajax({
								url:url,
								type:'POST',
								data:{
									page:this.page,
									num_page:this.num_page,
									numRows:this.numRows,
								},
								success:(res)=>{
									console.log();
										var data = JSON.parse(res);
										this.notes=data;
								
								}
						})
				
			},
		    addnote(){
				this.open=true
				this.isheight=800

			},
			savebut(){
			if(!(this.titled) || !(this.noted) ){
					alert('Please fill all the field !');
					return;
			}
			let url = "<?php echo $PATH?>note/insert";
			$.ajax({
					url:url,
					type:'POST',
					data:{
							title:this.titled,
							note:this.noted,  
					},
				// dataType:'json',
					success: (dataResult)=>{
							var data = JSON.parse(dataResult);
							if(data.statusCode==200){
								//  $('#save').removeAttr('disabled');
								//  $('#addform').find('input:text').val('');
									$('#success').show();
									$('#success').html('note added successfuly!'); 
									this.notes=data;
									location.href = "<?php echo $PATH ?>note/index";
								
							}
							else if(data.statusCode==201){
								$('#error').show();
								$('#error').html('sth went wronge')
							}
					}
			});
	  },
		deletebut(deleteId){
				
				let url=""+this.path+"note/delete";
				$.ajax({
					url:url,
					type:'POST',
					data:{
						
						id:deleteId,
					},
					dataType: 'json',
					success: (data) =>
					{
						// var data = JSON.parse(r);
						if(data.statusCode==200){
							$('#success').show();
							$('#success').html('note deleted successfuly!'); 
							this.getlist();
							}
							else if(data.statusCode==201){
								$('#error').show();
								$('#error').html('sth went wronge')
							}
						}

						});
					},
			returnbut(){
				$.ajax({
					url:"<?php echo $PATH?>note/index",
					type:"GET",
					success: function(r) 
			{
				if(data.statusCode==200){
					$('#success').show();
					$('#success').html('note deleted successfuly'); 
					this.getlist();
					}
					else if(data.statusCode==201){
						$('#error').show();
						$('#error').html('sth went wronge')
					}
				}
			});

		}		
			}
	}).mount("#App");





// function addnotes(){
//     $.ajax({
//           url:"<?php echo $PATH?>note/addnote",
//           type:"GET",
//           success: function(r) 
//   {
//     location.href = "<?php echo $PATH ?>note/addnote";
   

//   },


//     });
// };
</script>


<!-- <?php
// require_once 'footer.php';?> -->
