<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

  function __construct()
  {
    parent::__construct();
	if(!$this->session->userdata('logged_in'))
    {
	redirect('login', 'refresh');
	}

	$this->load->language('mci');
	$this->load->library('breadcrumbs');

  }

  function index()
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
	  /* language */
	  if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }
		/* breadcrumbs */
		$this->breadcrumbs->push(lang('HOME::dashboard'), site_url('home'));
      $this->load->view('home_view', $data);

  }

  function logout()
  {
    $this->session->unset_userdata('logged_in');
    session_destroy();
    redirect('home', 'refresh');
  }


}

?>