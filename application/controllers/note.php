<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require_once "models/NoteModel.php";
// require_once "models/UserModel.php";

// require "database.php";


class Note extends MY_Controller {

	// public function __construct(){
		// check if user logged in
		// check session
		// $userIsLoggedIn = false;
		// if($userIsLoggedIn){
			// do nothing
		// } else {
		// 	// redirect to login page
	// 	// }
	// }

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
	$data = [
		'PATH' => $path,
		'siteUrl' => $path."index.php/note",
		'siteUrlauth' => $path."index.php/auth/login",
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
		$data = [
			'PATH' => $path,
			'siteUrl' => $path."index.php/note",
			'siteUrlauth' => $path."index.php/auth/login",
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
	$this->load->helper('url');
	$this->checkNoteTable();
    $usid=$_SESSION["id"];
	$title=$this->input->post("title");
	$note=$this->input->post("note");

	$this->load->model('Notemodel');
	$user=$this->Notemodel->insertnote($title, $note, $usid);

  
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
	$this->load->database();
		$data = [
			'PATH' => $path,
			'siteUrl' => $path."index.php/note",
			'siteUrlauth' => $path."index.php/auth/login",
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

}

// ----------------------------------------------------------------------------

public function update(){

	$this->load->database();
	$id=$this->input->post('id');
    date_default_timezone_set('Asia/Tehran');
	$date =date('Y-m-d H:i:s');
	$title=$this->input->post('title');
	$note=$this->input->post('note');
 
	$this->load->model('Notemodel');
	$user=$this->Notemodel->update($id, $title, $note, $date);

  
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
	$this->load->helper('url');
	$this->checkNoteTable();
	$data = $this->input->post();
	$id=$data['id'];
	

	$this->load->model('Notemodel');
	$result = $this->Notemodel->delete($id);

   
	if($result){
        echo json_encode([
            'statusCode'=>200
        ]);
        return;
    }

    echo json_encode([
        'statusCode'=>201
    ]);

   
}

public function getnotes(){
	$usid=$_SESSION["id"];
	$data = $this->input->post();
	
	$this->load->model('Notemodel');
	$result = $this->Notemodel->find($usid, $data['page'],$data['num_page'] , $data['numRows'], $data['search'] );
	if($result){
		echo json_encode($result);
		return;
	}

	echo json_encode([]);
}


public function Searchnote(){

	$data = $this->input->post();
	$this->load->model('Notemodel');
	$result = $this->Notemodel->search($data['search_word']);
	if($result){
		echo json_encode($result);
		return;
	}

	echo json_encode([]);
    
}



// ----------------------------------------------------------------------------


}
