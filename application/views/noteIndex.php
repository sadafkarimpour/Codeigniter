<?php

// require_once 'header.php';

// require_once 'database.php';


// session_start();
// $usid=$_SESSION["id"];


?>
<form action="" method="POST">

<div class='alert alert-success alert-dismissible' id='success' style='display:none;margin-top:50px'>
	  <a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>
	</div>
	<div class='alert alert-danger alert-dismissible' id='error' style='display:none;margin-top:50px'>
	  <a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>
	</div>


    <div class="  bg-dark text-white rounded" style='width:1200px;margin-top:70px;height:650px;padding-top:20px;margin-left:175px'>
    <div class='container-fluid' style="  text-align: center">
    <h2 class="w-100 col-lg-12 col-md-6 col-sm-1 p-1  bg-primary">
        <?php
        echo $usid."یادداشت های";
        ?>
    </h2>
    </div>
    <div class='container-fluid' style=" text-align: center;">
    <div class='row'>
<div class="col-lg-3 col-md-3 col-sm-1 "  style="width:500px ; height: 600px;">
<!-- base_url for image url -->
       <img  src="<?php echo $base_url?>" alt="" class="w-100 " style="height: 555px;">
    </div>
  
    <div  class="col-lg-8 col-md-5 col-sm-3 h-50 text-white" style="margin-top: -30px;width:700px ;">
    <div class="container" >
    <div class="row w-70 h-70" >
        <table>
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
           

             foreach($notes as $note){

          
            
            // $start_form=($page-1)*$num_page;
            // $sql= "SELECT * FROM `addnote` WHERE `user_id`=$usid   LIMIT " .  $start_form . ',' .  $num_page ;  
            // $sql_result=mysqli_query($connect,$sql);
            // if (mysqli_num_rows($sql_result)>0){
            //     while ($row=mysqli_fetch_assoc($sql_result)) {
                echo "<tr style='border:1px solid white ; color:white;text-align:center;'>
                <div class='col-lg-2 col-md-2 col-sm-1 p-1 m-2  ' ><td style='border:1px solid white ; color:white;text-align:center;'>". $note->id  . "</td></div>
                <td style='border:1px solid white ; color:white'><div class='col-lg-2 col-md-2 col-sm-1 p-1 m-2 text-justify text-center'>".  $note->datetime_created . "</div></td>
                <td style='border:1px solid white ; color:white'><div class='col-lg-2 col-md-2 col-sm-1 p-1 m-2'>".  $note->title  . "</div></td>
                <td style='border:1px solid white ; color:white'><div class='col-lg-2 col-md-2 col-sm-1 p-1 m-2'>".  $note->description . 
                "</div></td><td>
                <div class='btn-group'>
             
               
                <a  class='btn btn-primary' id='editbut' href='" .$PATH."note/edit&id=".  $note->id."&page=$page'>ویرایش</a>
                <a class='btn btn-danger' href='" .$PATH."note/delete&id=".  $note->id."&page=$page'>حذف</a>
                
                </div>
                " 

                ."</td></tr>";
            }
                echo "</table>";
           
           
        
        // }
        // else{
        //     echo "nothing";
        // }
        
        
            ?>
            
            
        </table>
       

          
</div>
    </div>
    </div>
    </div>
    </div>
     </div>
     <div class="container" >
          <div class="row" style="margin-top: 10px">

          <div  class='col-lg-4' >
        <button    class='w-70 h-70 col-lg-6 col-md-3 col-sm-1 p-1   btn btn-primary text-white' style="margin-left:60px"   type='button'  name='addnew' id='addnew' onclick="addnotes();">Add New</button>
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

<script>
function addnotes(){
    $.ajax({
          url:"<?php echo $PATH?>note/addnote",
          type:"GET",
          success: function(r) 
  {
    location.href = "<?php echo $PATH ?>note/addnote";
   
  },
  


    });
};
</script>


<!-- <?php
// require_once 'footer.php';?> -->
