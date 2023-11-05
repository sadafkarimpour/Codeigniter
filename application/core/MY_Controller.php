<?php

class MY_Controller extends CI_Controller{

	public function __construct(){
		session_start();

		parent::__construct();
	}

}
