<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require_once "models/NoteModel.php";
// require_once "models/UserModel.php";

// require "database.php";


class Note extends CI_Controller {

/**
 *
 *
 * @return void
 */
public function checkNoteTable(){
    $this->load->database();
    $tbl2="CREATE TABLE IF NOT EXISTS `addnote2` (
        `id` int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `datee` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
        `title` varchar(255) NOT NULL,
        `note` varchar(255) NOT NULL,
        `user_id` int(255) REFERENCES signupnote(id)
       )";
        $this->db->query($tbl2);
		$this->db->close();
}




public function index(){
	$this->checkNoteTable();
	$this->load->view("header");
	$path= "http://localhost/codeigniter/"; 
	session_start();
	$data = [
		'PATH' => $path,
		'siteUrl' => $path."index.php/note",
		'siteUrlauth' => $path."index.php/auth",
		'siteUrlreg' => $path."index.php/auth/register",
		'siteUrllogout' => $path."index.php/auth/logout",
		'base_url'=>$this->config->base_url("asset/3255309.jpg"),
		'page1'=>$this->input->get('page'),
		'usid'=>$_SESSION["id"],
	];
	$this->load->view("menu", $data);
	$this->load->view('noteIndex', $data);
	$this->load->view("footer");
}


public function addnote(){
	$this->checkNoteTable();
	$this->load->view("header");
	$path= "http://localhost/codeigniter/"; 
	session_start();
		$data = [
			'PATH' => $path,
			'siteUrl' => $path."index.php/note",
			'siteUrlauth' => $path."index.php/auth",
			'siteUrlreg' => $path."index.php/auth/register",
			'siteUrllogout' => $path."index.php/auth/logout",
			'page1'=>$this->input->get('page'),
			'usid'=>$_SESSION["id"],
		];
	$this->load->view("menu", $data);
	$this->load->view('noteadd',$data);
	$this->load->view("footer");
}

public function insert(){

	$this->checkNoteTable();
	session_start();
    $usid=$_SESSION["id"];
	$title=$this->input->post("title");
	$note=$this->input->post("note");
    // $usid=$_SESSION["id"];
    // $title=$_POST['title'];
    // $note=$_POST['note'];

	$this->load->model('Notemodel');
    // $user = new UserModel();
	$user=$this->Notemodel->insertnote($title, $note, $usid);
	//var_dump($this->Notemodel->insertnote($title, $note, $usid));
    // $user = new NoteModel();
    // $user->insertnote($title, $note, $usid);
  
    if($user){
        echo json_encode([
            'statusCode'=>200
        ]);
        return;
    }

    echo json_encode([
        'statusCode'=>201
    ]);
   
}

// ----------------------------------------------------------------------------

public function search(){
    // $notes = NoteModel::find(10);
    // echo json_encode($notes);
}

// ----------------------------------------------------------------------------

public function edit($id, $page){

	$this->load->view("header");
	$path= "http://localhost/codeigniter/"; 
	session_start();
	$this->load->database();
		$data = [
			'PATH' => $path,
			'siteUrl' => $path."index.php/note",
			'siteUrlauth' => $path."index.php/auth",
			'siteUrlreg' => $path."index.php/auth/register",
			'siteUrllogout' => $path."index.php/auth/logout",
			'page1'=>$page,
			'id'=>$id,
			
		];
	$this->load->view("menu", $data);

  $query=$this->db->query("select * from `addnote2` where id='$id' ");
  $data['row'] = $query->row();
  $this->load->view('noteEdit',$data);

  $this->load->view("footer");
  
// $id=$_GET['id'];
// $query=mysqli_query($connect,"select * from `addnote2` where id='$id' ");
// $row=mysqli_fetch_array($query);

// require_once 'view/noteEdit.php';
}

// ----------------------------------------------------------------------------

public function update(){

	$this->load->database();
	$id=$this->input->post('id');
	
    //$id=$_POST['id'];
    date_default_timezone_set('Asia/Tehran');
	$date =date('Y-m-d H:i:s');
    //$date = date('Y-m-d H:i:s'); 
	$title=$this->input->post('title');
	$note=$this->input->post('note');
    // $title=$_POST['title'];
    // $note=$_POST['note'];
   

	
	$this->load->model('Notemodel');
    // $user = new UserModel();
	$user=$this->Notemodel->update($id, $title, $note, $date);

    // $user = new NoteModel();
    // $user->update($id, $title, $note, $date);
  
    if($user){
        echo json_encode([
            'statusCode'=>200
        ]);
        return;
    }

    echo json_encode([
        'statusCode'=>201
    ]);
}

// ----------------------------------------------------------------------------

public function save(){}

// ----------------------------------------------------------------------------

public function delete(){
	$this->checkNoteTable();
	$id=$this->input->get('id');
	$page=$this->input->get('page');
    // $id=$_GET['id'];
    // $page=$_GET['page'];
    

	$this->load->model('Notemodel');
	$user=$this->Notemodel->login($id, $page);

    // $user = new NoteModel();
    // $user->delete($id);
  
    if($user){
       
		$this->load->view('note/index&page=$page'); //?
       // header("Location: note.php?action=index&page=$page");

       // echo '<script>alert("Note with id('.$page.') Deleted")</script>';
     //   exit;
	}

   
}



// ----------------------------------------------------------------------------

// public function actions(){
// 	$this->checkNoteTable();
// 	session_start();
// 	$usid=$_SESSION["id"];
	
// 	$action = $_GET["action"];
	
// 	switch ($action) {
// 		case 'index':
// 			$this->index();
// 			break;
	
	
// 		case 'addnote':
// 			$this->addnote();
// 			break;
// 		case 'insert':
// 			$this->insert();
// 			break;
		
// 		case 'edit':
// 			$this->edit();
// 			break;
	
// 		case 'update':
// 			$this->update();
// 			break;
// 		case 'delete':
// 			$this->delete();
// 			break;
	
// 		case 'search':
// 			$this->search();
// 			break;
		
// 		default:
// 			# code...
// 			echo "action not found";
// 			break;
// 	}
// }


}
