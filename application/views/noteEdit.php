<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// $page=$_GET['page'];

?>


<div class=' alert alert-success alert-dismissible ' id='success' style='display:none;margin-top:50px'>
    <div >
	  <a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>
	</div>
	<div class='alert alert-danger alert-dismissible' id='error' style='display:none;margin-top:50px'>
	  <a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>
	</div>
</div>

<form action="" method="POST" id="addform">
    <div  class=' w-50  bg-dark text-white rounded' style='margin-top:160px;height:300px;padding-top:35px;margin-left:400px'>
<div class="container-fluid " style="margin-left: 180px;">
<div class="row">
<input id="title" type="text" placeholder="عنوان یادداشت" name="data[title]" class="w-50 p-2 m-3 " value="<?php echo $row->title; ?>" >
</div>
</div>
<div class="container-fluid " style="margin-left: 180px;">
<div class="row">
<input id="note" type="text" placeholder="متن یادداشت" name="data[note]"  class="w-50 p-2 m-3 " value="<?php echo $row->note; ?>">
</div>
</div>
<div class="container-fluid" style="margin-left: 180px;">
<div class="row">
    <button class="btn btn-primary col-lg-6  w-25 p-2 m-1" type="button" name="edit" id="edit" onclick="editbut();" >Edit</button>
    <button class="btn btn-outline-primary col-lg-6 w-25 p-2 m-1 " type="button" name="return" id="return" onclick="returnbut();" >Return</button>
</div>
</div>
</div>
</form>

<script>
function editbut(){
   // $('#save').attr('disabled','disables');
    var title=$('#title').val();
    var note=$('#note').val();
    if(!title || !note ){
        alert('Please fill all the field !');
        return;
    }
    let url = "<?php echo $PATH?>note/update";
    $.ajax({
        url:url,
        type:'POST',
        data:{
            
            id:<?php  echo $id?>,
            title:title,
            note:note,  
        },
       // dataType:'json',
        success: function(dataResult){
            var data = JSON.parse(dataResult);
            if(data.statusCode==200){
              //  $('#save').removeAttr('disabled');
              //  $('#addform').find('input:text').val('');
                $('#success').show();
                $('#success').html('note added successfuly!'); 
                location.href = "<?php echo $PATH?>note/index?page=<?php echo $page1?>";
               
            }
            else if(data.statusCode==201){
              $('#error').show();
              $('#error').html('sth went wronge')
            }
        }
    });
}

function returnbut(){
    $.ajax({
          url:"<?php echo $PATH?>note/index",
          type:"GET",
          success: function(r) 
  {
    location.href = "note.php?action=index";
   
  },
});

}
</script>

