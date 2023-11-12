<?php 

defined('BASEPATH') OR exit('No direct script access allowed');


class Usermodel extends CI_Model {

    /**
     * شناسه کاربر
     *
     * @var int
     */ 
    public $id;
    /**
     * نام کاربر
     *
     * @var string
     */
    public $fisrtname;
      /**
     * نام خانوادگی کاربر
     *
     * @var string
     */
    public $lastname;
      /**
     * نام کاربری
     *
     * @var string
     */
    public $username;
      /**
     * ایمیل کاربر
     *
     * @var string
     */
    public $email;
      /**
     * رمز عبور کاربر
     *
     * @var string
     */
    public $password;


    public static function insert($firstname,$lastname,$username,$phone_number,$email,$passwordd)
    {
       
		$c = &get_instance();
		$c->load->database();
		$result = $c->db->query("INSERT INTO `user2` ( `fname`, `lname`, `username`, `phone_number`, `email`, `passwordd`) VALUES ('$firstname','$lastname','$username','$phone_number','$email','$passwordd')");

        if($result){
            return array("statusCode"=>200);
        }
        else{
            return array("statusCode"=>201);
        
        }
    }

    public static function update($id,$firstname,$lastname,$username,$email,$password)
    {
		$c = &get_instance();
        return true;
    }
    
    public static function login($email,$passwordd)
    {
		
		$c = &get_instance();
		$c->load->database();
        
		$email=$c->input->post('email');
		$passwordd=$c->input->post('passwordd');
    
		$check = $c->db->query("SELECT * From  `user2` WHERE email='$email' and passwordd='$passwordd'");
		$num_rows=$check->num_rows();
        if($num_rows===1){
			foreach ($check->result() as $row)
		{

			if($row->email==$email and $row->passwordd==$passwordd){
           
				$_SESSION["id"]=$row->id;
				
			  	return true;
			   
				
			  }
			 else{
			  return false;
			 }
				
		}
        }
        else
        {
           
            return false;
        }
    
    }
    
    public static function logout($id)

    {
	    $c = &get_instance();
        return true;
    }
    
    
    public static function findone($id)
    {
		$c = &get_instance();
        return true;
    }

	public static function getCurrentUserId()
	{
		if(isset($_SESSION['id'])){
			$userId = $_SESSION["id"];
			if(!$userId){
				return false;
			}
			return $userId;
		}

		return false;
	}

}
?>
