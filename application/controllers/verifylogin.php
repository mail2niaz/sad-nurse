<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('login_model','',TRUE);
	$this->load->language('mci');
  }

  function index()
  {
    //This method will have the credentials validation

    $this->load->library('form_validation');

    $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
	if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }
    if($this->form_validation->run() == FALSE)
    {
    	$data['error'] = "User Name OR Password Wrong";

		$data['loginlogo'] = 'mci_login_logo';
		$data['ph_username'] = 'ph_username';
		$data['ph_password'] = 'ph_password';
		$data['signin'] = 'signin';
		$data['forget_password'] = 'forget_password';
		$data['remember'] = 'remember';
      $this->load->view('login_view',$data);
    }
    else
    {
      //Go to private area
      redirect('home', 'refresh');
    }

  }

  function check_database($password)
  {
    //Field validation succeeded.  Validate against database
    $username = $this->input->post('username');

    //query the database

    $result = $this->login_model->login($username, $password);

    if($result)
    {
      $sess_array = array();
      foreach($result as $row)
      {
        $sess_array = array(
          'aid' => $row->aid,
          'username' => $row->username,
          'type' => $row->type,
          'sadd' => $row->add,
          'sedit' => $row->edit,
          'sview' => $row->view,
          'sdelete' => $row->delete,
          'mopt' => $row->operator,
          'mpat' => $row->patient,
          'mjob' => $row->job,
          'mcms' => $row->cms,
          'mintervent' => $row->intervent,
          'mreport' => $row->report,
          'mcontract' => $row->contract,
        );
        $this->session->set_userdata('logged_in', $sess_array);
      }
      return TRUE;
    }
    else
    {
      $this->form_validation->set_message('check_database', 'Invalid username or password');
      return false;
    }
  }
}
?>