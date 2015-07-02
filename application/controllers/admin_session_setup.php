<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Admin_session_setup extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged_in'))
		{
			redirect('login', 'refresh');
		}
		$this->load->model('report_model');
		$this->load->language('mci');
		$this->load->library('breadcrumbs');
		$this->load->helper('chmod');
		
	}
	
	function index(){
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
	  if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }
		if($cid != ""){
			$data['pid'] = $cid;
			$data['from_pid'] = "yes";
		}
		/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('ADMIN-SESSION-SETUP::session_list'), site_url($data['i18n'].'admin_session_setup'));
		/* end */
		$data['result'] = $this->report_model->getsessionlist();
		$this->load->view('session_list', $data);
	}
	public function add_admin_session_setup()
	{
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
		if($this->lang->mci_current() == ""){
			$data['i18n'] = $this->lang->mci_current();
		}else{
			$data['i18n'] = $this->lang->mci_current()."/";
		}
		
		if(isset($_REQUEST['update'])){
			$fdata = $_REQUEST;
			$this->report_model->add_session_setup($fdata);
			$url = $data['i18n'].'admin_session_setup/index';
			redirect($url);
		} else {
			$this->load->view('add_session_setup',$data);
		}
	}
	public function edit_admin_session_setup($id)
	{
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
		if($this->lang->mci_current() == ""){
			$data['i18n'] = $this->lang->mci_current();
		}else{
			$data['i18n'] = $this->lang->mci_current()."/";
		}
		
		if(isset($_REQUEST['update'])){
			$fdata = $_REQUEST;
			$this->report_model->edit_session_setup($fdata,$id);
			$url = $data['i18n'].'admin_session_setup/index';
			redirect($url);
		} else {
			$data['optval'] = $this->report_model->getupdatesessionlist($id)->row();
			$url = 'editsession';
			$this->load->view($url,$data);
		}
	}
} 
?>