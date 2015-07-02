<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Cms extends CI_Controller {

  function __construct()
  {
    parent::__construct();
	if(!$this->session->userdata('logged_in'))
    {
	redirect('login', 'refresh');
	}
	$this->load->language('mci');
	$this->load->library('breadcrumbs');
	$this->load->model('cms_model');
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
		$this->breadcrumbs->push(lang('cms'), site_url('cms'));
		/* end */
      $this->load->view('cms_view', $data);

  }

    function rolelist()
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
		$this->breadcrumbs->push( lang('CMS-ROLE::rolelist'), site_url($data['i18n'].'cms/rolelist'));
		/* end */
		$data['result'] = $this->cms_model->getrole();
      $this->load->view('cms_rolelist', $data);

  }

   public function addroleview()
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
		$this->breadcrumbs->push( lang('CMS-ROLE::add_role'), site_url($data['i18n'].'cms/addroleview'));
		/* end */
      $this->load->view('add_role', $data);
  }

    public function addrole()
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
 	  $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');

	$this->form_validation->set_rules('rname', 'Role Name', 'trim|required|callback_check_role_ci');

			if($this->form_validation->run() == FALSE)
		{
			$this->load->view('add_role',$data);
		}
		else
	{

		$this->cms_model->add_role();
		$data['msg'] = lang('COMMON::detail_msg');
		$this->load->view('add_role',$data);
	}
  }

 function editrole($rid){
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
	$this->breadcrumbs->push(lang('CMS-ROLE::rolelist'), site_url($data['i18n'].'cms/rolelist'));
	$this->breadcrumbs->push( lang('CMS-ROLE::edit_role'), site_url($data['i18n'].'cms/editrole'));
	/* end */
	$this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');


	if($this->input->post('mysubmit')){
		$this->form_validation->set_rules('rname', lang('CMS-ROLE::role_name'), 'trim|required|callback_check_role_ci');
		if($this->form_validation->run() == FALSE)
		{
			$data['optval'] = $this->cms_model->getrole($rid)->row();
			$data['view'] = "no";
			$this->load->view('editrole',$data);
		}
		else
		{
		$time = time();
		$this->cms_model->update_role($rid);
		$data['msg'] = lang('COMMON::detail_msg');
		redirect('cms/rolelist');
		}
	}else{
		$data['optval'] = $this->cms_model->getrole($rid)->row();
		$data['view'] = "no";
		$this->load->view('editrole',$data);
	}
}

public function check_role_ci()
	{

		$opt=$this->input->post('rname');
	    $result=$this->cms_model->check_role_exist($opt);
	    if($result)
		{
				$this->form_validation->set_message('check_role_ci', lang('CMS-ROLE::role_exit'));
				return false;
		}
		else
		{
			return true;
		}
	}

public function roledetails($rid){
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
	$this->breadcrumbs->push(lang('CMS-ROLE::rolelist'), site_url($data['i18n'].'cms/rolelist'));
	$this->breadcrumbs->push(lang('CMS-ROLE::view_role'), site_url($data['i18n'].'cms/roledetails'));
	/* end */

		$data['optval'] = $this->cms_model->getrole($rid)->row();
		$data['view'] = "yes";
		$url = 'editrole';
		$this->load->view($url,$data);
}

public function delete($rid)
{

	$this->cms_model->deleterole($rid);
	redirect('cms/rolelist','refresh');
}


/* Holidays */
public function view_holidays_list()
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
		$this->breadcrumbs->push( lang('CMS-HOLIDAY::holidays'), site_url($data['i18n'].'cms/view_holidays_list'));
		/* end */
		$data['result'] = $this->cms_model->getholiday_detail();
	$this->load->view('holidays_list',$data);
	}

   public function addholiday($hid = NULL)
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

		if($hid != ""){
			$data['edit'] = "yes";
			$data['hid'] = $hid;
			/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('CMS-HOLIDAY::editholidays'), site_url($data['i18n'].'cms/addholiday'));
		/* end */
			$data['optval'] = $this->cms_model->getholiday_detail($hid)->row();
		    $this->load->view('add_holiday', $data);
		}else{
			/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('CMS-HOLIDAY::addholidays'), site_url($data['i18n'].'cms/addholiday'));
		/* end */
		    $this->load->view('add_holiday', $data);
		}
  }

    public function putholiday_details()
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
 	  $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');

	$this->form_validation->set_rules('hdate', lang('CMS-HOLIDAY::date'), 'trim|required');

			if($this->form_validation->run() == FALSE)
		{
			$this->load->view('add_holiday',$data);
		}
		else
	{

		$this->cms_model->put_holiday();
		$data['msg'] = lang('COMMON::detail_msg');
		$this->load->view('add_holiday',$data);
	}
  }

public function updateholiday_details()
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
	$this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
	$data['hid'] = $this->input->post('hid');
	$this->form_validation->set_rules('hdate', lang('CMS-HOLIDAY::date'), 'trim|required');

			if($this->form_validation->run() == FALSE)
		{
			$this->load->view('add_holiday',$data);
		}
		else
	{

		$this->cms_model->update_holiday();
		$data['msg'] = lang('COMMON::detail_msg');
		$data['result'] = $this->cms_model->getholiday_detail();
		$this->load->view('holidays_list',$data);
	}
}

public function holidaydelete($hid)
{

	$this->cms_model->deleteholiday($hid);
	redirect('cms/view_holidays_list','refresh');
}
/* End Holiday */

/* District Module */
public function view_district_list()
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
		$this->breadcrumbs->push( lang('CMS-DISTRICT::district'), site_url($data['i18n'].'cms/view_district_list'));
		/* end */
		$data['result'] = $this->cms_model->getdistrict_detail();
	$this->load->view('district_list',$data);
	}

   public function adddistrict($did = NULL)
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

		if($did != ""){
			$data['edit'] = "yes";
			$data['did'] = $did;
			/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('CMS-DISTRICT::district'), site_url($data['i18n'].'cms/view_district_list'));
		$this->breadcrumbs->push( lang('CMS-DISTRICT::edit_district'), site_url($data['i18n'].'cms/adddistrict'));
		/* end */
			$data['optval'] = $this->cms_model->getdistrict_detail($did)->row();
		    $this->load->view('add_district', $data);
		}else{
			/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('CMS-DISTRICT::district'), site_url($data['i18n'].'cms/view_district_list'));
		$this->breadcrumbs->push( lang('CMS-DISTRICT::add_district'), site_url($data['i18n'].'cms/adddistrict'));
		/* end */
		    $this->load->view('add_district', $data);
		}


  }

   public function put_district_details()
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
 	  $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');

	$this->form_validation->set_rules('dist_name', lang('district_name'), 'trim|required');
      $this->form_validation->set_rules('p2000_code', lang('p200_code'), 'trim|required');
			if($this->form_validation->run() == FALSE)
		{
			$this->load->view('add_district',$data);
		}
		else
	{

		$this->cms_model->put_district();
		$data['msg'] = lang('COMMON::detail_msg');
		$this->load->view('add_district',$data);
	}
  }

public function update_district_details()
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
	$this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
	$data['did'] = $this->input->post('did');
	$this->form_validation->set_rules('dist_name', lang('district_name'), 'trim|required');
      $this->form_validation->set_rules('p2000_code', lang('p200_code'), 'trim|required');
			if($this->form_validation->run() == FALSE)
		{
			$this->load->view('add_district',$data);
		}
		else
	{

		$this->cms_model->update_district();
		$data['msg'] = lang('COMMON::detail_msg');
		$data['result'] = $this->cms_model->getdistrict_detail();
		$this->load->view('district_list',$data);
	}
}
public function district_delete($did)
{

	$this->cms_model->deletedistrict($did);
	redirect('cms/view_district_list','refresh');
}
/* End District Module */

/* Tags */
/* District Module */
public function tag_list()
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
		$this->breadcrumbs->push( lang('TAG::tag_list'), site_url($data['i18n'].'cms/tag_list'));
		/* end */
		$data['result'] = $this->cms_model->get_tag_detail();
	$this->load->view('tags_list',$data);
	}

function add_tag()
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
		$this->breadcrumbs->push( lang('TAG::tag_list'), site_url($data['i18n'].'cms/tag_list'));
		$this->breadcrumbs->push( lang('TAG::add_tag'), site_url($data['i18n'].'cms/add_tag'));
		/* end */
		$data['action'] = "add";
		if($this->input->post('mysubmit')){
			$this->form_validation->set_rules('tag_description', lang('TAG::tag_desc'), 'trim|required|callback_check_tag_name');
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('crud_tags', $data);
			}
			else
			{
				$this->cms_model->add_tag_detail();
				$data['msg'] = lang('COMMON::detail_msg');
				$this->load->view('crud_tags',$data);
			}
		}else{
			 $this->load->view('crud_tags', $data);
		}

  }

 function edit_tag($tid){
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
		$this->breadcrumbs->push( lang('TAG::tag_list'), site_url($data['i18n'].'cms/tag_list'));
		$this->breadcrumbs->push( lang('TAG::edit_tag'), site_url($data['i18n'].'cms/edit_tag/'.$tid));
		/* end */
		$data['action'] = "edit";
	if($this->input->post('mysubmit')){
		$this->form_validation->set_rules('tag_description', lang('TAG::tag_desc'), 'trim|required|callback_check_tag_name');
		if($this->form_validation->run() == FALSE)
		{
			$data['optval'] = $this->cms_model->get_tag_detail($tid)->row();
			$data['action'] = "edit";
			$this->load->view('crud_tags',$data);
		}
		else
		{

		$this->cms_model->update_tag_detail($tid);
		$data['msg'] = lang('COMMON::detail_msg');
		redirect($data['i18n'].'cms/tag_list','refresh');
		}
	}else{
		$data['optval'] = $this->cms_model->get_tag_detail($tid)->row();
		$data['action'] = "edit";
		$this->load->view('crud_tags',$data);
	}
}

public function view_tag($tid)
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
		$this->breadcrumbs->push( lang('TAG::tag_list'), site_url($data['i18n'].'cms/tag_list'));
		$this->breadcrumbs->push( lang('TAG::view_tag'), site_url($data['i18n'].'cms/view_tag'));
		/* end */
		$data['optval'] = $this->cms_model->get_tag_detail($tid)->row();
		$data['opt_list'] = $this->cms_model->get_tag_opt_list($tid);
		$this->load->view('view_tag',$data);
	}
public function delete_tag($tid)
{

	$this->cms_model->deletetag($tid);
	redirect('cms/tag_list','refresh');
}

public function delete_opt_tag($tid,$oid)
{

	$this->cms_model->deleteopttag($tid,$oid);
	redirect('cms/view_tag/'.$tid,'refresh');
}

public function check_tag_name()
{

	$name = $this->input->post('tag_description');
	$result=$this->cms_model->check_tag_name_exist($name);
	if($result > 0)
	{
		$this->form_validation->set_message('check_tag_name', lang('TAG::tag_exist'));
		return false;
	}
	else
	{
		return true;
	}
}
}

?>
