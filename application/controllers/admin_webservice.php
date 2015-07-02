<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Admin_webservice extends CI_Controller 
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
		$this->breadcrumbs->push( lang('ADMIN-SESSION-SETUP::session_list'), site_url($data['i18n'].'admin_webservice'));
		/* end */
		$data['result'] = $this->report_model->getwebservicelist();
		$this->load->view('webservice_list', $data);
	}
	public function add_webservice_url()
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
			$this->report_model->add_webservice_url($fdata);
			$url = $data['i18n'].'admin_webservice/index';
			redirect($url);
		} else {
			$this->load->view('add_webservice_url',$data);
		}
	}
	public function edit_webservice($id)
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
			$this->report_model->edit_webservice($fdata,$id);
			$url = $data['i18n'].'admin_webservice/index';
			redirect($url);
		} else {
			$data['optval'] = $this->report_model->getwebservice($id)->row();
			$url = 'edit_webservice';
			$this->load->view($url,$data);
		}
	}
} 
?>
