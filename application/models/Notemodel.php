<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
class Notemodel extends CI_Model{
    /**
     * شناسه یادداشت
     *
     * @var int
     */ 
    public $id;
    /**
     * عنوان یادداشت
     *
     * @var string
     */
    public $title;
      /**
     * توضیحات یادداشت
     *
     * @var string
     */
    public $description;
      /**
     * شناسه کاربر
     *
     * @var string
     */
    public $user_id;
      /**
     * تاریخ ثبت یادداشت
     *
     * @var string
     */
    public $datetime_created;
      /**
     * تاریخ آپدیت یادداشت
     *
     * @var string
     */
    public $datetime_edited;


    public static function insertnote($title,$description,$user_id)
    {
        $c = &get_instance();
        $c->load->database();
        
		$result=$c->db->query("INSERT INTO `addnote2` (title,note,user_id) VALUES ('$title','$description','$user_id')");
        //$sql="INSERT INTO `addnote` (title,note,user_id) VALUES ('$title','$description','$user_id')";
        // mysqli_query($connect,$sql); 
      //  header('location:note.php?action=index');
	  if($result){
		return array("statusCode"=>200);
	}
	else{
		return array("statusCode"=>201);
	
	}

    }
    
    public static function update($id,$title,$description,$date)
    {
		$c = &get_instance();
		$c->load->database();
        
		$result=$c->db->query("UPDATE `addnote2` SET  title='$title' , note='$description' , datee='$date'  where id='$id' ");
		

       // mysqli_query($connect,"UPDATE `addnote` SET datee='$date' , title='$title' , note='$description' , datee='$date'  where id='$id' ");
	   if($result){
		return array("statusCode"=>200);
	}
	else{
		return array("statusCode"=>201);
	
	}

    }
    
    public static function delete($id)
    {
		$c = &get_instance();
		$c->load->database();

		$checkid=$c->db->query("SELECT * FROM `addnote2` where id='$id' ");
		if($checkid->num_rows()> 0){
        
			$result=$c->db->query("delete from `addnote2` where id='$id' ");
			//mysqli_query($connect,"delete from `addnote` where id='$id' ");
			if( $result){
				return true;
			}
			else{
				return false;
			}
		}

		return false;
	
		


    }
    
    public static function findone($id)
    {
        return true;
    }
    
    /**
     * @param int $user_id
     * @param int $pageIndex
     * @param int $pageSize
     * @return NoteModel[]
     */
    public static function find($user_id, $pageIndex, $pageSize, &$numRows = 0)
    {
		
		$c = &get_instance();
		$c->load->model('Notemodel');
        $notes = [];

        
		$c->load->database();
        // todo .....
		$sql_result=$c->db->query("SELECT * from `addnote2` WHERE   `user_id`=$user_id  ");
		$total=$sql_result->num_rows();
		$total_pages=ceil($total/$pageSize);
        $numRows = $total_pages;
        $start_form=($pageIndex-1)*$pageSize;
		$sql=$c->db->query("SELECT * FROM `addnote2` WHERE `user_id`=$user_id   LIMIT " .  $start_form . ',' .  $pageSize );
		
		if ($total>0){
			
		foreach ($sql->result() as $row)
		{
		
				// $note=;
                $note = new NoteModel();
				
                $note->id = $row->id;
                $note->title = $row->title;
                $note->description=$row->note;
                $note->user_id=$row->user_id;
                // ... 
                $note->datetime_created = ($row->datee);
               // $note->datetime_edited =($row['datetime_edited']);
                // ....
                $notes[] = $note;
           
       
       // $sql="SELECT * from `addnote` WHERE   `user_id`=$user_id  " ;
       // $sql_result=mysqli_query($connect,$sql);

        //$total=mysqli_num_rows($sql_result);
        
       // $sql= "SELECT * FROM `addnote` WHERE `user_id`=$user_id   LIMIT " .  $start_form . ',' .  $pageSize ;  
       // $sql_result=mysqli_query($connect,$sql);
     
            // while ($row=mysqli_fetch_assoc($sql_result)) {
                //array_push($notes,$row);
		
		}
        }

		// var_dump($notes);
		log_message("debug", "notes:\n" . print_r($notes, true));

        return $notes;
    }


}

?>
