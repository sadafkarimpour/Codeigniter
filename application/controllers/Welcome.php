<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view("header");
		$path= "http://localhost/codeigniter/"; 
		// $data['PATH']=$path;
		// $data['siteUrl'] = site_url('note');
		$data = [
			'PATH' => $path,
			'siteUrl' => $path."index.php/note",
			'siteUrlauth' => $path."index.php/auth/login",
			'siteUrlreg' => $path."index.php/auth/register",
			'siteUrllogout' => $path."index.php/auth/logout",
		];
	    $this->load->view("menu", $data);
		$this->load->view('welcome_message');
		$this->load->view("footer");
		
	}
    

	public function login()
	{
		$this->load->view('auth.php');
	}
	public function sum($a , $b){
		$data = [];
		$data['a'] = $a;
		$data['b'] = $b;
		$data['sum'] = $a + $b;
		$this->load->view('sum', $data);
	}

	public function notes()
	{
		$this->load->database();
		$query = $this->db->query('SELECT * FROM addnote');

		foreach ($query->result() as $row)
		{
				echo $row->title . "<br/>";
		}

		echo 'Total Results: ' . $query->num_rows();
	}

	public function showNote($id)
	{
		$this->load->database();
		$query = $this->db->query('SELECT * FROM addnote where id = ' . $id);

		$row = $query->row();

		$data['note'] = $row;

		$this->load->view("show_note", $data);
	}
  
	
}
