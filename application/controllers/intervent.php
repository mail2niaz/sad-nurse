<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Intervent extends CI_Controller {

  function __construct()
  {
    parent::__construct();
	if(!$this->session->userdata('logged_in'))
    {
	redirect('login', 'refresh');
	}
	$this->load->language('mci');
	$this->load->library('breadcrumbs');
	$this->load->model('intervent_model');
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
		$this->breadcrumbs->push(lang('INTERVENT::interlist'), site_url($data['i18n'].'intervent/interventlist'));
		/* end */
      $this->load->view('intervent_list', $data);

  }

    function interventlist()
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
		$this->breadcrumbs->push( lang('INTERVENT::interlist'), site_url($data['i18n'].'intervent/interventlist'));
		/* end */

      $this->load->view('intervent_list', $data);

  }


function adddynamicform($itype_asg_id=NULL)
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
		$this->breadcrumbs->push( lang('INTERVENT::interlist'), site_url($data['i18n'].'intervent/interventlist'));
		$this->breadcrumbs->push( lang('INTERVENT::addinter'), site_url($data['i18n'].'intervent/adddynamicform'));
		/* end */
		if($itype_asg_id != NULL){
			$data['itype_asg_id'] = $itype_asg_id;
		}
      $this->load->view('adddynamicform', $data);

  }

    public function adddynamic_form()
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

	$this->form_validation->set_rules('int_type_id', lang('INTERVENT::select_intervent_type'), 'trim|required|callback_check_dynamice_form');
	$this->form_validation->set_rules('role', lang('INTERVENT::frole'), 'trim|required');

			if($this->form_validation->run() == FALSE)
		{
			$this->load->view('adddynamicform', $data);
		}
		else
		{

		$rid = $this->intervent_model->add_dform();

		$data['msg'] = lang('COMMON::detail_msg');
  		redirect('intervent/adddynamicform_field/'.$rid);
	}
  }


  function adddynamicform_field($itype_asg_id,$view=NULL)
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
		$this->breadcrumbs->push( lang('INTERVENT::interlist'), site_url($data['i18n'].'intervent/interventlist'));
		$this->breadcrumbs->push( lang('INTERVENT::inter_add_form_field'), site_url($data['i18n'].'intervent/adddynamicform_field'));
		/* end */
		$data['itype_asg_id'] = $itype_asg_id;
		if(isset($view)){
		$data['view'] = "yes";
		}
      $this->load->view('adddynamicform_field', $data);
  }


    public function adddynamic_fields()
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
		$data['itype_asg_id'] = $this->input->post('itype_asg_id');
	$this->form_validation->set_rules('label_name[]', lang('INTERVENT::label'), 'trim|required|callback_check_label_name');
	$this->form_validation->set_rules('type[]', lang('INTERVENT::type'), 'trim|required');
	$this->form_validation->set_rules('sort_val[]', lang('INTERVENT::sorder'), 'trim|required|callback_check_sort_order');
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('adddynamicform_field',$data);
		}
		else
		{

			$ss = $this->intervent_model->add_dfields();
			$data['msg'] = lang('COMMON::detail_msg');
			$this->load->view('intervent_list',$data);
		}
  }

function editdynform_singlefield($fid,$itype_asg_id){
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
	$this->breadcrumbs->push( lang('INTERVENT::interlist'), site_url($data['i18n'].'intervent/interventlist'));
	$this->breadcrumbs->push( lang('INTERVENT::edit_inter'), site_url($data['i18n'].'intervent/editdynamic_form'));
	/* end */
	$this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');

	$data['itype_asg_id'] = $itype_asg_id;
	$data['fid'] = $fid;
	if($this->input->post('mysubmit')){

		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');
	$this->form_validation->set_rules('label_name[]', lang('INTERVENT::label'), 'trim|required|callback_check_label_name');
	$this->form_validation->set_rules('type[]', lang('INTERVENT::type'), 'trim|required');
	$this->form_validation->set_rules('sort_val[]', lang('INTERVENT::sorder'), 'trim|required|callback_check_sort_order');
		if($this->form_validation->run() == FALSE)
		{
			$data['optval'] = $this->intervent_model->getinterfield($fid,$itype_asg_id)->row();
			$this->load->view('editdynamic_single_field',$data);
		}
		else
		{

			$this->intervent_model->upd_singlefield();
			$data['msg'] = lang('COMMON::detail_msg');
			$view = "view";
			redirect($data['i18n'].'intervent/adddynamicform_field/'.$itype_asg_id.'/'.$view,'refresh');
		}
	}else{
		$data['optval'] = $this->intervent_model->getinterfield($fid,$itype_asg_id)->row();
		$this->load->view('editdynamic_single_field',$data);
	}
}

public function check_label_name()
	{

	    $result=$this->intervent_model->check_label_exist();

	    if($result)
		{
				$this->form_validation->set_message('check_label_name', lang('INTERVENT::label_exit'));
				return false;
		}
		else
		{
			return true;
		}
	}

public function check_sort_order()
	{

	    $result=$this->intervent_model->check_order_exist();
	    if($result)
		{
				$this->form_validation->set_message('check_sort_order', lang('INTERVENT::sort_exit'));
				return false;
		}
		else
		{
			return true;
		}
	}

public function check_dynamice_form()
	{

	    $result=$this->intervent_model->check_dynamice_form_exist();
	    if($result)
		{
				$this->form_validation->set_message('check_dynamice_form', lang('INTERVENT::dynamic_form_exit'));
				return false;
		}
		else
		{
			return true;
		}
	}

function editdynamic_form($itype_asg_id){
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
	$this->breadcrumbs->push( lang('INTERVENT::interlist'), site_url($data['i18n'].'intervent/interventlist'));
	$this->breadcrumbs->push( lang('INTERVENT::edit_inter'), site_url($data['i18n'].'intervent/editdynamic_form'));
	/* end */
	$this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');


	if($this->input->post('mysubmit')){
		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');

			$this->form_validation->set_rules('int_type_id', lang('INTERVENT::select_intervent_type'), 'trim|required');
	$this->form_validation->set_rules('role', lang('INTERVENT::frole'), 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('editdynamic_form', $data);
		}
		else
		{

			$this->intervent_model->edit_dform();
			$data['msg'] = lang('COMMON::detail_msg');
			$this->load->view('intervent_list',$data);
		}
	}else{
		$data['optval'] = $this->intervent_model->getinterform($itype_asg_id)->row();
		$this->load->view('edit_dynamicform',$data);
	}
}

public function delete($itype_asg_id)
{
	if($this->lang->mci_current() == ""){
	  	$i18n = $this->lang->mci_current();
	  }else{
		$i18n = $this->lang->mci_current()."/";
	  }

	$this->intervent_model->deletedynform($itype_asg_id);
	redirect($i18n.'intervent','refresh');
}

public function delete_singlefield($fid,$itype_asg_id)
{
	if($this->lang->mci_current() == ""){
	  	$i18n = $this->lang->mci_current();
	  }else{
		$i18n = $this->lang->mci_current()."/";
	  }

	$this->intervent_model->deletedynfield($fid);
	$view = "view";
	redirect($i18n.'intervent/adddynamicform_field/'.$itype_asg_id.'/'.$view,'refresh');
}


/* Intervent Type */
function interventtype()
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
		$this->breadcrumbs->push( lang('INTERVENT::intervent_type'), site_url($data['i18n'].'intervent/interventtype'));
		/* end */
      	$this->load->view('intervent_type_list', $data);

  }

  function add_interventtype($view=NULL,$int_type_id=NULL)
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
		$this->breadcrumbs->push( lang('INTERVENT::intervent_type'), site_url($data['i18n'].'intervent/interventtype'));
		$this->breadcrumbs->push( lang('INTERVENT::add_intervent_type'), site_url($data['i18n'].'intervent/add_interventtype'));
		/* end */
		if($int_type_id != ""){
			$data['view'] = "view";
			$data['int_type_id'] = $int_type_id;
		}
      	$this->load->view('add_intervent_type', $data);

  }

 public function add_interventtype_data()
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
	$this->form_validation->set_rules('type', lang('COMMON::intervent_type'), 'trim|required');
	$this->form_validation->set_rules('hours', lang('INTERVENT::hours'), 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('add_intervent_type',$data);
		}
		else
		{

			$ss = $this->intervent_model->add_invt_data();
			$data['msg'] = lang('COMMON::detail_msg');
			$this->load->view('intervent_type_list',$data);
		}
  }

function edit_interventtype($intid){
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
		$this->breadcrumbs->push( lang('INTERVENT::intervent_type'), site_url($data['i18n'].'intervent/interventtype'));
	$this->breadcrumbs->push( lang('INTERVENT::edit_intervent_type'), site_url($data['i18n'].'intervent/edit_interventtype'));
	/* end */
	$this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');

	if($this->input->post('mysubmit')){

		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');
		$this->form_validation->set_rules('type', lang('COMMON::intervent_type'), 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$data['optval'] = $this->intervent_model->getintertype($intid)->row();
			$this->load->view('edit_intervent_type',$data);
		}
		else
		{

			$this->intervent_model->update_invt_data();
			$data['msg'] = lang('COMMON::detail_msg');
			redirect('intervent/interventtype','refresh');
		}
	}else{
		$data['optval'] = $this->intervent_model->getintertype($intid)->row();
		$this->load->view('edit_intervent_type',$data);
	}
}
public function deleteinterventtype($intid)
{
	if($this->lang->mci_current() == ""){
	  	$i18n = $this->lang->mci_current();
	  }else{
		$i18n = $this->lang->mci_current()."/";
	  }

	$this->intervent_model->deleteinttype($intid);
	redirect($i18n.'intervent/interventtype','refresh');
}
public function operator_code()
  {
  $id_job_code = $this->uri->segment(3,0);
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
	$this->form_validation->set_rules('code_op1', lang('INTERVENT::code_op1'), 'trim|required');
	$this->form_validation->set_rules('code_op2', lang('INTERVENT::code_op2'), 'trim|required');
	$this->form_validation->set_rules('code_op3', lang('INTERVENT::code_op3'), 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('add_job_code',$data);
		}
		else
		{

			$ss = $this->intervent_model->add_operator_code();
			$data['msg'] = lang('COMMON::detail_msg');
			redirect($i18n.'intervent/edit_interventtype/'.$id_job_code,'refresh');
			$this->load->view('intervent_type_list',$data);
		}
  }
  function edit_operator_code($intid_job) {
      $id_job_code = $this->uri->segment(4,0);

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
		$this->breadcrumbs->push( lang('INTERVENT::intervent_type'), site_url($data['i18n'].'intervent/interventtype'));
	$this->breadcrumbs->push( lang('INTERVENT::edit_intervent_type'), site_url($data['i18n'].'intervent/edit_interventtype'));
	/* end */
	$this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');

	if($this->input->post('mysubmit')){
            
		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');
		$this->form_validation->set_rules('code_op1', lang('INTERVENT::code_op1'), 'trim|required');
	      $this->form_validation->set_rules('code_op2', lang('INTERVENT::code_op2'), 'trim|required');
	      $this->form_validation->set_rules('code_op3', lang('INTERVENT::code_op3'), 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$data['optval'] = $this->intervent_model->getintertype_job($intid_job)->row();
			$this->load->view('edit_operator_code',$data);
		}
		else
		{

			$this->intervent_model->update_operator_code();
			$data['msg'] = lang('COMMON::detail_msg');
			redirect($i18n.'intervent/edit_interventtype/'.$id_job_code,'refresh');
		}
	}else{
		$data['optval'] = $this->intervent_model->getintertype_job($intid_job)->row();
		$this->load->view('edit_operator_code',$data);
	}
}
public function delete_job_code($intid,$id_job)
{
	if($this->lang->mci_current() == ""){
	  	$i18n = $this->lang->mci_current();
	  }else{
		$i18n = $this->lang->mci_current()."/";
	  }

	$this->intervent_model->deleteinttype_job_code($intid);
	redirect($i18n.'intervent/edit_interventtype/'.$id_job,'refresh');
}

/* End Intervent Type */
}

?>
