<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  function __construct()
  {
    parent::__construct();
	$this->load->language('mci');
  }

  function index()
  {

	if($this->session->userdata('logged_in'))
    {
/* Session Variables */
      	$session_data=$this->session->userdata('logged_in');
		$data['username']=$session_data['username'];
		$data['stype'] = $session_data['type'];
		$data['sadd'] = $session_data['sadd'];
		$data['sedit'] = $session_data['sedit'];
		$data['sview'] = $session_data['sview'];
		$data['sdelete'] = $session_data['sdelete'];
		$data['mopt'] = $session_data['mopt'];
		$data['mpat'] = $session_data['mpat'];
		$data['mjob'] = $session_data['mjob'];
		$data['mcms'] = $session_data['mcms'];
		$data['mintervent'] = $session_data['mintervent'];
		$data['mreport'] = $session_data['mreport'];
		$data['mcontract'] = $session_data['mcontract'];
      /* Session Variables */
      $this->load->view('home_view', $data);
    }
    else
    {

      $this->load->helper('form');
	$data['i18n'] = $this->lang->mci_current();
	$data['loginlogo'] = 'mci_login_logo';
	$data['ph_username'] = 'ph_username';
	$data['ph_password'] = 'ph_password';
	$data['signin'] = 'signin';
	$data['forget_password'] = 'forget_password';
	$data['remember'] = 'remember';

    $this->load->view('login_view',$data);
	}
  }

  /* Webservices */
public function mlogin(){
	$obj = json_decode($_REQUEST['ipjson']);
	$uname = $obj->username;
	$pass = $obj->password;
	$udid = $obj->mobile_uuid;
	/*$uname = "simbu";
	$pass = "simbuk";
	$udid = "UI123";*/

	$this->load->model('login_model');
	$login_ary = array();
  	$result = $this->login_model->moblogin($uname,$pass,$udid);

	if($result == "pm"){
		$login_ary['status'] = "false";
		$login_ary['msg'] = "Password Mismatched";
		$login_ary['operator'] = "null";
		//exit;
	}elseif($result == "um"){
		$login_ary['status'] = "false";
		$login_ary['msg'] = "Username Mismatched";
		$login_ary['operator'] = "null";
	}elseif($result == "mm"){
		$login_ary['status'] = "false";
		$login_ary['msg'] = "Mobile UDID Mismatched";
		$login_ary['operator'] = "null";
	}
	elseif($result == "error"){
		$login_ary['status'] = "false";
		$login_ary['msg'] = "Username, Password,Mobile UDID Mismatched";
		$login_ary['operator'] = "null";
	}
	else{
		$login_ary['status'] = "true";
		$login_ary['msg'] = "Successfully Login";
		$login_ary['roledetail'] =$this->common->getroledetails($result[0]->role);
		$login_ary['operator'] = $result;
	}
		echo json_encode($login_ary);

  }

    /* Webservices */
    public function iosLogin(){

        $json = file_get_contents('php://input');
        $obj = json_decode($json);
        $uname = $obj->username;
        $pass = $obj->password;
        $udid = $obj->mobile_uuid;
        /*$uname = "simbu";
        $pass = "simbuk";
        $udid = "UI123";*/

        $this->load->model('login_model');
        $login_ary = array();
        $result = $this->login_model->moblogin($uname,$pass,$udid);

        if($result == "pm"){
            $login_ary['status'] = "false";
            $login_ary['msg'] = "Password Mismatched";
            $login_ary['operator'] = "null";
            //exit;
        }elseif($result == "um"){
            $login_ary['status'] = "false";
            $login_ary['msg'] = "Username Mismatched";
            $login_ary['operator'] = "null";
        }elseif($result == "mm"){
            $login_ary['status'] = "false";
            $login_ary['msg'] = "Mobile UDID Mismatched";
            $login_ary['operator'] = "null";
        }
        elseif($result == "error"){
            $login_ary['status'] = "false";
            $login_ary['msg'] = "Username, Password,Mobile UDID Mismatched";
            $login_ary['operator'] = "null";
        }
        else{
            $login_ary['status'] = "true";
            $login_ary['msg'] = "Successfully Login";
            $login_ary['roledetail'] =$this->common->getroledetails($result[0]->role);
            $login_ary['operator'] = $result;
        }
        echo json_encode($login_ary);

    }

    public function iosforget(){

        $this->load->library('email');
        $random= "";
        $length = 6;
        $obj = json_decode(file_get_contents('php://input'));
        $uname = $obj->username;
        //$uname = "demodoc";
        $this->load->model('login_model');
        $forget_ary = array();
        $result = $this->login_model->mobforget($uname);
        if($result == 1){
            srand((double)microtime()*1000000);

            $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
            $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
            $data .= "0FGH45OP89";

            for($i = 0; $i < $length; $i++)
            {
                $random .= substr($data, (rand()%(strlen($data))), 1);
            }
            $this->login_model->mobforgetsave($random,$uname);
            $this->email->to('silambarasan@constient.com');
            $this->email->from('kcsimbu@gmail.com');
            $this->email->subject('Here is your info '.$uname);
            $this->email->message('Hi '.$random.' Here is the info you requested.');
            $this->email->send();


            $forget_ary['msg'] = "Your Password has been reseted, Please check your email.";
        }else{
            $forget_ary['msg'] = "Sorry Username Mismatched, Please try again.";
        }

        echo json_encode($forget_ary);

    }


public function mforget(){

	$this->load->library('email');
	$random= "";
	$length = 6;
	$obj = json_decode($_REQUEST['ipjson']);
	$uname = $obj->username;
	//$uname = "demodoc";
	$this->load->model('login_model');
	$forget_ary = array();
  	$result = $this->login_model->mobforget($uname);
	if($result == 1){
		srand((double)microtime()*1000000);

	$data = "AbcDE123IJKLMN67QRSTUVWXYZ";
	$data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
	$data .= "0FGH45OP89";

	for($i = 0; $i < $length; $i++)
	{
	$random .= substr($data, (rand()%(strlen($data))), 1);
	}
	$this->login_model->mobforgetsave($random,$uname);
    $this->email->to('silambarasan@constient.com');
    $this->email->from('kcsimbu@gmail.com');
    $this->email->subject('Here is your info '.$uname);
    $this->email->message('Hi '.$random.' Here is the info you requested.');
    $this->email->send();


	$forget_ary['msg'] = "Your Password has been reseted, Please check your email.";
	}else{
		$forget_ary['msg'] = "Sorry Username Mismatched, Please try again.";
	}

	echo json_encode($forget_ary);

}

function mgeo_location()
	{
		print_r($_REQUEST);
	}
}
?>
