<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Login extends CI_Controller {
public $i18n;
  function __construct()
  {
    parent::__construct();
	$this->load->language('mci');
	if($this->lang->mci_current() == ""){
		$this->i18n = $this->lang->mci_current();
	}else{
		$this->i18n = $this->lang->mci_current()."/";
	}
  }

  function index()
  {
	if($this->session->userdata('logged_in'))
    {
      	$session_data=$this->session->userdata('logged_in');
		$data['username']=$session_data['username'];
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
}
?>
