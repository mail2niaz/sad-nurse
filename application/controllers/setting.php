<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {

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
	  if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }
		/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('setting'), site_url($data['i18n'].'setting'));
		/* end */
      $this->load->view('setting_view', $data);

  }

/* ACL */
   function acl()
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
	  $data['aid'] = $session_data['aid'];

	  if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }

		/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('setting'), site_url($data['i18n'].'setting'));
		$this->breadcrumbs->push( lang('acl'), site_url($data['i18n'].'setting/acl'));
		/* end */

      $this->load->view('acl_control', $data);

  }

  function get_acl($tid){

	$this->load->model('setting_model');
	$ss = $this->setting_model->acl_control($tid);
  }

    function get_module_acl($tid){

	$this->load->model('setting_model');
	$ss = $this->setting_model->acl_module_control($tid);
  }
/* ACL */

/* Change Password */
   function changepassword()
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
	  $data['aid'] = $session_data['aid'];

	  if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }

		/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('setting'), site_url($data['i18n'].'setting'));
		$this->breadcrumbs->push( lang('cpass'), site_url($data['i18n'].'setting/changepassword'));
		/* end */

      $this->load->view('changepassword', $data);

  }

    public function cpass()
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
  	if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }

	  $data['aid'] = $session_data['aid'];
 	 $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
	$this->form_validation->set_rules('new_pass', 'password', 'trim|required|matches[cnew_pass]');
	$this->form_validation->set_rules('cnew_pass', 'password confirmation', 'required|trim');

	if($this->form_validation->run() == FALSE)
		{
			$this->load->view('changepassword',$data);
		}
		else
	{
		$this->load->model('setting_model');
		$this->setting_model->changepass();
		$data['msg'] = lang('detail_upd_msg');
		$this->load->view('changepassword',$data);
	}
  }
/* End Change Password */


/* Admin User */
  function adminuserlist()
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
	  if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }
		/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('setting'), site_url($data['i18n'].'setting'));
		$this->breadcrumbs->push( lang('admin_user'), site_url($data['i18n'].'setting/adminuserlist'));
		/* end */
      $this->load->view('adminuser_list', $data);

  }
  function add_adminuser()
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
	  if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }
		/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('setting'), site_url($data['i18n'].'setting'));
		$this->breadcrumbs->push( lang('admin_user'), site_url($data['i18n'].'setting/adminuserlist'));
		$this->breadcrumbs->push( lang('addadmin_user'), site_url($data['i18n'].'setting/add_adminuser'));
		/* end */
      $this->load->view('add_admin_user', $data);

  }

   public function addadminuserdata()
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
  	if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }

	  $data['aid'] = $session_data['aid'];
 	 $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
	$this->form_validation->set_rules('name', 'Name', 'trim|required');
	$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
	$this->form_validation->set_rules('username', 'Username', 'required|trim|callback_check_auser_ci');
	$this->form_validation->set_rules('pass', 'Password', 'required|trim');
	$this->form_validation->set_rules('type', 'Type', 'required|trim');

	if($this->form_validation->run() == FALSE)
		{
			$this->load->view('add_admin_user',$data);
		}
		else
	{
		$this->load->model('setting_model');
		$this->setting_model->putuserdata();
		$data['msg'] = lang('detail_msg');

		$this->load->view('add_admin_user',$data);
	}
  }

public function view_user_details($aid)
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
  	if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }
	/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('setting'), site_url($data['i18n'].'setting'));
		$this->breadcrumbs->push( lang('admin_user'), site_url($data['i18n'].'setting/adminuserlist'));
		$this->breadcrumbs->push( lang('addadmin_user'), site_url('setting/add_adminuser'));
		/* end */
	$this->load->model('setting_model');
	$data['optval'] = $this->setting_model->getuserdata($aid)->row();
	$data['view'] = "yes";
	$this->load->view('add_admin_user',$data);
	}


function edituserdata($aid){
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
	/* breadcrumbs */
	$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
	$this->breadcrumbs->push( lang('setting'), site_url($data['i18n'].'setting'));
	$this->breadcrumbs->push( lang('admin_user'), site_url('setting/adminuserlist'));
	$this->breadcrumbs->push( lang('editadmin_user'), site_url('setting/edituserdata'));
	/* end */
	$this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');
	$this->load->model('setting_model');

	if($this->input->post('mysubmit')){
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
	$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
	$this->form_validation->set_rules('username', 'Username', 'required|trim|callback_check_auser_ci');
	$this->form_validation->set_rules('type', 'Type', 'required|trim');
		if($this->form_validation->run() == FALSE)
		{
			$data['optval'] = $this->setting_model->getuserdata($aid)->row();
			$this->load->view('edit_admin_user',$data);
		}
		else
		{
		$time = time();
		$this->setting_model->update_userdata($aid);
		$data['msg'] = lang('detail_msg');
		redirect('setting/adminuserlist');
		}
	}else{
		$data['optval'] = $this->setting_model->getuserdata($aid)->row();
		$this->load->view('edit_admin_user',$data);
	}
}

public function check_auser_ci()
	{
		$this->load->model('setting_model');
		$opt=$this->input->post('username');
	    $result=$this->setting_model->check_user_exist($opt);
	    if($result)
		{
				$this->form_validation->set_message('check_auser_ci', lang('username_exit'));
				return false;
		}
		else
		{
			return true;
		}
	}

public function userdelete($aid)
{
	$this->load->model('setting_model');
	$this->setting_model->deleteuser($aid);
	redirect('setting/adminuserlist','refresh');

}
/* Admin User */

/* Admin Types */
  function admintypelist()
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
	  if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }
		/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('setting'), site_url($data['i18n'].'setting'));
		$this->breadcrumbs->push( lang('admin_type'), site_url('setting/admintypelist'));
		/* end */
      $this->load->view('admin_type_list', $data);

  }
  function add_admintype()
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
	  if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }
		/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('setting'), site_url($data['i18n'].'setting'));
		$this->breadcrumbs->push( lang('admin_type'), site_url('setting/admintypelist'));
		$this->breadcrumbs->push( lang('admin_type'), site_url('setting/add_admintype'));
		/* end */
      $this->load->view('add_admin_type', $data);

  }

   public function addadmintypedata()
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
  	if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }

	  $data['aid'] = $session_data['aid'];
 	 $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
	$this->form_validation->set_rules('type_name', 'Type Name', 'trim|required');

	if($this->form_validation->run() == FALSE)
		{
			$this->load->view('add_admin_type',$data);
		}
		else
	{

		$this->load->model('setting_model');
		$this->setting_model->putadmintypedata();
		$data['msg'] = lang('detail_msg');
		$this->load->view('add_admin_type',$data);
	}
  }

public function view_admintype_details($tid)
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
  	if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }
		/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('setting'), site_url($data['i18n'].'setting'));
		$this->breadcrumbs->push( lang('admin_type'), site_url('setting/admintypelist'));
		$this->breadcrumbs->push( lang('admin_type'), site_url('setting/add_admintype'));
		/* end */
	$this->load->model('setting_model');
	$data['optval'] = $this->setting_model->getadmintypedata($tid)->row();
	$data['view'] = "yes";
	$this->load->view('add_admin_type',$data);
	}


function editadmintypedata($tid){
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
	/* breadcrumbs */
	$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('setting'), site_url($data['i18n'].'setting'));
	$this->breadcrumbs->push( lang('admin_type'), site_url('setting/admintypelist'));
	$this->breadcrumbs->push( lang('editadmin_type'), site_url('setting/editadmintypedata'));
	/* end */
	$this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');
	$this->load->model('setting_model');

	if($this->input->post('mysubmit')){
		$this->form_validation->set_rules('type_name', 'Type Name', 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$data['optval'] = $this->setting_model->getadmintypedata($tid)->row();
			$this->load->view('edit_admin_type',$data);
		}
		else
		{
		$time = time();
		$this->setting_model->update_admintypedata($tid);
		$data['msg'] = lang('detail_msg');
		redirect('setting/admintypelist');
		}
	}else{
		$data['optval'] = $this->setting_model->getadmintypedata($tid)->row();
		$this->load->view('edit_admin_type',$data);
	}
}
public function admintypedelete($tid)
{
	$this->load->model('setting_model');
	$this->setting_model->deletetype($tid);
	redirect('setting/admintypelist','refresh');

}

/* Admin Types */

/* Default Starting Point Address */
  function default_starting_point_address($action, $id)
  {
/* Session Variables */
$this->load->model('setting_model');
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
		/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('setting'), site_url($data['i18n'].'setting'));
		$this->breadcrumbs->push( lang('default_starting_point'), site_url($data['i18n'].'setting/default_starting_point_address'));
		/* end */
		$data['action'] = $action;
		/*if($action == "submit"){
		$this->form_validation->set_rules('starting_point_address', lang('OPERATOR::starting_point_address'), 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$data['optval'] = $this->setting_model->getstarting_point($id)->row();
			$this->load->view('set_default_opt_address',$data);
		}
		else
		{
		echo $this->setting_model->update_starting_point($id);
		$data['msg'] = lang('COMMON::detail_msg');
		unset($_POST);
		$url = $data['i18n'].'setting/default_starting_point_address/view/'.$id;
		redirect($url);
		}
	}else{

	} */
	$data['optval'] = $this->setting_model->getstarting_point($id)->row();
		$this->load->view('set_default_opt_address', $data);

  }


public function submit(){
	$this->load->model('setting_model');
	$starting_point_address = $_REQUEST['starting_point_address'];
	$id = $_REQUEST['sid'];
	$update = $_REQUEST['update'];
	$this->setting_model->update_starting_point($starting_point_address, $id, $update);
}
}
?>
