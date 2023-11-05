<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// require_once "models/NoteModel.php";
// require_once "models/UserModel.php";

// require "database.php";


class Auth extends MY_Controller {

/**
 * check if 'user' table exists
 * if table not exists, create table
 * این تابع قبل از تمام توابع دیگه این کلاس اجرا می شه
 * و بررسی می کنه آیا جدول user در دیتابیس وجود داره یا نه
 * اگر وجود نداشته باشد جدول مورد نیاز ایجاد می شود
 *
 * @return void
 */


public function checkUserTable(){
	$this->load->database();
    $tbl="CREATE TABLE IF NOT EXISTS `user2` (
        `id` int(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `fname` varchar(255) NOT NULL,
        `lname` varchar(255) NOT NULL,
        `username` varchar(255) NOT NULL,
        `phone_number` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `passwordd` varchar(255) NOT NULL)";
      $this->db->query($tbl);
	  $this->db->close();
   
}

// ----------------------------------------------------------------------------





/**
 * اینs تابع صفحه لاگین کاربران را نمایش می دهد
 *
 * @return void
 */
public function login(){
	$this->checkUserTable();
	$this->load->view("header");
	$path= "http://localhost/codeigniter/"; 
		$data = [
			'PATH' => $path,
			'siteUrl' => $path."index.php/note",
			'siteUrlauth' => $path."index.php/auth/login",
			'siteUrlreg' => $path."index.php/auth/register",
			'siteUrllogout' => $path."index.php/auth/logout",
		];

	$this->load->view("menu", $data);
	$this->load->view('authlogin');
	$this->load->view("footer");

}

// ----------------------------------------------------------------------------

/**
 * زمانی که کاربر بر روی کلید لاگین در فرم لاگین کلید می کند اطلاعات فرم از طریق پست و 
 * به صورت ایجکس به این تابع ارسال می شوند و 
 * عملیات لاگین در این تابع انجام می شود و نتیجه لاگین به صورت جیسون برگردانده می شود
 *
 * @return void
 */
public function doLogin(){
	$this->checkUserTable();
	$email=$this->input->post('email');
	$passwordd=$this->input->post('passwordd');
    // $email= $_POST['email'];
    // $passwordd= $_POST['passwordd'];
    
    $this->load->model('Usermodel');
    // $user = new UserModel();
	$result=$this->Usermodel->login($email, $passwordd);
    // $result = $user->login($email, $passwordd);
  
    if($result){
        echo json_encode([
            'statusCode'=>200
        ]);
        return;
    }

    echo json_encode([
        'statusCode'=>201
    ]);

    // Prepare the response as a JSON object
    // $response = array("statusCode" => $result);
  
    // // Return the response as a JSON string
    // echo json_encode($response);

}

// ----------------------------------------------------------------------------

/**
 * زمانی کاربر می خواهد از حساب کاربری خود خارج شود این تابع به صورت 
 * get یا post 
 * فراخوانی می شود و کاربر لاگ اوت می شود
 *
 * @return void
 */
public function logout(){
    
    // session_start();
    unset($_SESSION["id"]);
    unset($_SESSION["fname"]);
    unset($_SESSION["lname"]);
    unset($_SESSION["username"]);
    unset($_SESSION["phone_number"]);
    unset($_SESSION["email"]);
    unset($_SESSION["passwordd"]);
	redirect("welcome/index");
  
    
}

// ----------------------------------------------------------------------------

/**
 * این تابع فرم ثبت نام را نمایش می دهد
 *
 * @return void
 */
public function register(){
	$this->checkUserTable();
	$this->load->view("header");
	$path= "http://localhost/codeigniter/"; 
		$data = [
			'PATH' => $path,
			'siteUrl' => $path."index.php/note",
			'siteUrlauth' => $path."index.php/auth/login",
			'siteUrlreg' => $path."index.php/auth/register",
			'siteUrllogout' => $path."index.php/auth/logout",
		];

	$this->load->view("menu", $data);
	$this->load->view('authRegister');
	$this->load->view("footer");
}

// ----------------------------------------------------------------------------

/**
 * این تابع اطلاعات را از پست دریافت کرده
 * و عملیات مربوط به ثبت نام کاربر جدید را انجام می دهد
 * و نتیجه را به صورت حیسون برمی کرداند
 *
 * @return void
 */
public function doRegister(){

    // print_r($_POST);
   
	$this->checkUserTable();
	$fname=$this->input->post('fname');
	$lname=$this->input->post('lname');
	$username=$this->input->post('username');
	$phone_number=$this->input->post('phone_number');
	$email=$this->input->post('email');
	$passwordd=$this->input->post('passwordd');
    // $fname= $_POST['fname'];
    // $lname= $_POST['lname'];
    // $username= $_POST['username'];
    // $phone_number=$_POST['phone_number'];
    // $email= $_POST['email'];
    // $passwordd= $_POST['passwordd'];
  
	$d = $this->load->model('usermodel');
    // $user = new UserModel();
	// var_dump($d);die();
	$result=$this->usermodel->insert($fname, $lname, $username, $phone_number, $email, $passwordd);
    // $user = new UserModel();
    // $result= $user->insert($fname, $lname, $username, $phone_number, $email, $passwordd);
  
    // Prepare the response as a JSON object
    // $response = array("statusCode" => $result);
  
    // Return the response as a JSON string
    // echo json_encode($response);

    // echo json_encode([
    //     'code'=>1
    // ]);

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

// ----------------------------------------------------------------------------
// public function actions_auth(){
// 	$this->checkUserTable();

// 	$action = $_GET["action"];
	
	
// 	switch ($action) {
// 		case 'login':
// 			$this->login();
// 			break;
	
// 		case 'dologin':
// 			$this->doLogin();
// 			break;
	
// 		case 'logout':
// 			$this->logout();
// 			break;
	
// 		case 'register':
// 			$this->register();
// 			break;
	
// 		case 'doregister':
// 			$this->doRegister();
// 			break;
		
// 		default:
// 			# code...
// 			echo "action not found";
// 			break;
// 	}
// }

}
