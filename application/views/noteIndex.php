
<!-- <style>
	.fade{
		z-index: 1;
    -webkit-filter: blur(5px);
    filter: blur(5px);
      background-color: #e8e8e8d9;
	}
</style> -->


<div id="App" class="container text-center " >
	<form action="" method="POST">

		<div class='row mt-3 p-1 d-none alert alert-success alert-dismissible' id='success' >
			<div class="col">
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>
			</div>
		</div>
		<div class='row mt-3 p-1 d-none alert alert-danger alert-dismissible' id='error' >
			<div class="col">
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>
			</div>
		</div>
		
			
		<div  class="row mb-4 text-white rounded  align-items-center ">
			<!-- <div class="row w-100 h-75 align-items-center  justify-content-center"> -->
				<div class="col col-lg-12 col-md-12 col-sm-12 bg-dark p-4">
					<div class='row' >
							<h2 class="col col-lg-12 col-md-12 col-sm-12 bg-primary">
								<?php
								echo $usid."یادداشت های";
								?>
							</h2>
						
					</div>
					<div class='row' >
							<div class="col col-lg-5 col-md-5 col-sm-12 col-12"   >
							<!-- base_url for image url -->
								<img  src="<?php echo $base_url?>" alt="" class="w-100 h-100" >
							</div>
	
		
	
							<div  class="col col-lg-7 col-md-7 col-sm-12 col-12 text-white " >
								<nav class="row navbar navbar-dark bg-dark">
								
										<div class="col col-lg-6 col-md-6 col-sm-6 col-6">
											<input v-model="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
										</div>
										<div class="col col-lg-6 col-md-6 col-sm-6 col-6 d-flex align-items-start">
											<button class="btn btn-outline-primary my-2 my-sm-0 w-50" type="button" @click="searchbut()">Search</button>
										</div>
									
										
								</nav>
								<div class="table-responsive-lg table-responsive-md table-responsive-sm table-responsive">
								<table class="w-100">
									<thead>
										<tr>
											<th style="border:1px solid white " >شماره</th>
											<th  style="border:1px solid white ">تاریخ</th>
											<th style="border:1px solid white ">عنوان</th>
											<th style="border:1px solid white ;" >متن</th>
											<th style="border:1px solid white ; ">حذف / ویرایش</th>													
										</tr>
									</thead>

									<tbody>
										
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
											<td >
												<div  class='btn-group'>
													<div v-if="editing && note.id == editId">		
													<a   @click="doedit(editing)" class='m-1 p-2 btn btn-primary' >ثبت</a>
													<a   @click="returnbut()" class=' p-2 btn btn-danger' >بازگشت</a>
													</div>
													<div v-else>
														<a  @click="edit(note)" class='m-1 p-2 btn btn-primary'>ویرایش</a>
														<a  @click="deletebut(note.id)"  class=' p-2 btn btn-danger'>حذف</a>
													</div>
													
												</div>
											</td>
											</tr>
									</tbody>	
								</table>
								</div>
							</div>
						</div>
					</div>					
				</div>
					
			<div class="row" >
				<div  class='col col-lg-4 col-md-4 col-sm-4 col-4 ' >
					<button  class='w-75 col-lg-4 col-md-4 col-sm-4 col-4 p-1 btn btn-primary text-white' type='button' data-toggle="modal" data-target="#exampleModal"  name='addnew' >Add New</button>
					<!-- onclick="addnotes();" -->
				</div>
				<!-- add note form -->
				<form action="" method="POST" id="addform" >
					<div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"   >
						<div class="modal-dialog "  role="document">
							<div  class='modal-content border-0  bg-light text-dark rounded' >
								<div class="modal-header border-0">
									<h5 class="modal-title text-primary" id="exampleModalLabel">Add Note</h5>
									<button type="button" class="close bg-light border-0 text-primary h4" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body border-0">
									<div class="border-0 " >
										<div class="modal-title w-100 h-100 " id="exampleModalLabel">
											<input id="title" v-model="titled"  type="text" placeholder="عنوان یادداشت" name="data[title]" class="col col-lg-11 col-md-11 col-sm-11 col-11 p-2 mb-2 h-25 modal-title  border-bottom-2 border-primary text-dark rounded" >
										</div>
									</div>
									<div class="border-0">
										<div class="w-100 h-100">
											<input id="note" v-model="noted" type="text" placeholder="متن یادداشت" name="data[note]"  class="col col-lg-11 col-md-11 col-sm-11 col-11 p-2 h-25  border-bottom-2 border-primary text-dark rounded">
										</div>
									</div>
								</div>
								<div class="modal-footer border-0" >
									<div class="w-100 h-100">
										<button class="btn btn-primary  col col-lg-5 col-md-5 col-sm-5 col-5 p-1 m-1" type="button" name="save" id="save" @click="savebut()" >Save</button>
										<button class="btn btn-outline-primary col col-lg-5 col-md-5 col-sm-5 col-5 p-1 m-1"  type="button" name="return" id="return"  data-dismiss="modal" >Return</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!-- add note form -->	
				<div class="col col-lg-8 col-md-8 col-sm-8 col-8 ">
					<?php 
						
			
					// $sql="SELECT * from `addnote` WHERE   `user_id`=$usid  " ;
					// $sql_result=mysqli_query($connect,$sql);
					// $total=mysqli_num_rows($sql_result);
					// $total_pages=ceil($total/$num_page);
					$start=1;$end=$numRows;$pre=0;$next=0;
					echo '<a href ="'. $PATH .'note/index?page=' . $start . '" class="col-lg-2 col-md-2 col-sm-2 p-2 border border-primary rounded-circle bg-primary text-white" style="text-decoration:none">Start </a>';

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
						
							echo '<a href ="'. $PATH .'note/index?page=' . $pre . '" class="col-lg-2  col-md-2 col-sm-2 p-2 border border-primary rounded-circle bg-primary text-white" style="margin-right:5px;text-decoration:none">Pre </a>';

							echo '<a href ="'. $PATH .'note/index?page=' . $page . '" class="col-lg-2  col-md-2 col-sm-2 p-2  border border-primary rounded-circle bg-primary text-white" style="margin-right:5px;text-decoration:none">' . $page . ' </a>';
						
							echo '<a href ="'. $PATH .'note/index?page=' . $next . '" class="col-lg-2 col-md-2 col-sm-2 p-2 border border-primary rounded-circle  bg-primary text-white" style="margin-right:5px;text-decoration:none">Next</a>';

						

						echo '<a href ="'. $PATH .'note/index?page=' . $end . '" class="col-lg-2 col-md-2 col-sm-2 p-2  border border-primary rounded-circle bg-primary text-white" style="margin-right:5px;text-decoration:none">End</a>';
				
					
					?>
			
			
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
			isheight:900,
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
			path:'<?php echo $PATH?>',
			search:''




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
									search: this.search
								},
								success:(res)=>{
									console.log();
										var data = JSON.parse(res);
										this.notes=data;
								
								}
						})
				
			},
		    // addnote(){
			// 	this.open=true

			// },
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
			this.editing=false
			this.open=false

			},
			searchbut(){
				// let url = "<?php echo $PATH?>note/Searchnote";
				// $.ajax({
				// 		url:url,
				// 		type:'POST',
				// 		data:{
				// 			search_word:this.search
				// 		},
				// 		success: (dataResult)=>{
				// 				var data = JSON.parse(dataResult);
				// 				if(data.statusCode==200){
									
				// 				}
				// 				else if(data.statusCode==201){
				// 					$('#error').show();
				// 					$('#error').html('Not Found')
				// 				}
				// 		}
				// });
				this.getlist();

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
