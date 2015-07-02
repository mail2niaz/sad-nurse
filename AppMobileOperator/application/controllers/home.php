<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Home extends CI_Controller {
public $i18n;
  function __construct()
  {
    parent::__construct();
	if(!$this->session->userdata('logged_in'))
    {
	redirect('login', 'refresh');
	}

	$this->load->language('mci');
	$this->load->library('breadcrumbs');
	if($this->lang->mci_current() == ""){
		$this->i18n = $this->lang->mci_current();
	}else{
		$this->i18n = $this->lang->mci_current()."/";
	}
	$this->load->model('plan_model');
  }

  function index()
  {
/* Session Variables */
      	$session_data=$this->session->userdata('logged_in');
		$data['username']=$session_data['username'];
		$data['aid'] = $session_data['aid'];
      /* Session Variables */
		/* breadcrumbs */
	   $this->breadcrumbs->push(lang('HOME::dashboard'), site_url('home'));
      $this->load->view('home_view', $data);
  }

  function plan_search()
  {
/* Session Variables */
      	$session_data=$this->session->userdata('logged_in');
		$data['username']=$session_data['username'];
		$data['aid'] = $session_data['aid'];
      /* Session Variables */
		/* breadcrumbs */
	   $this->breadcrumbs->push(lang('HOME::dashboard'), site_url('home'));
		$this->form_validation->set_rules('sdate', lang('SEARCH::date'), 'trim|required');
		$this->form_validation->set_rules('operator', lang('SEARCH::operator'), 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$data['sdate'] = strtotime($this->input->post('sdate'));
			$data['operator'] = $this->input->post('operator');
			$this->load->view('planning_result',$data);
		}
  }

  function successplan_search($oid,$date)
  {
/* Session Variables */
      	$session_data=$this->session->userdata('logged_in');
		$data['username']=$session_data['username'];
		$data['aid'] = $session_data['aid'];
      /* Session Variables */
		/* breadcrumbs */
	   $this->breadcrumbs->push(lang('HOME::dashboard'), site_url('home'));
	   $data['sdate'] = $date;
	   $data['operator'] = $oid;
	   $this->load->view('planning_result',$data);
  }

function job_reassign($oid,$date,$section)
  {
/* Session Variables */
      	$session_data=$this->session->userdata('logged_in');
		$data['username']=$session_data['username'];
		$data['aid'] = $session_data['aid'];
      /* Session Variables */
		/* breadcrumbs */
	   $this->breadcrumbs->push(lang('HOME::dashboard'), site_url('home'));
			$data['jobdate'] = $date;
			$data['oid'] = $oid;
			$data['section'] = $section;
			$data['cfrom'] = 'list';
			$this->load->view('job_reassign',$data);
  }
  function single_job_reassign($aid,$oid,$date,$section)
  {
/* Session Variables */
      	$session_data=$this->session->userdata('logged_in');
		$data['username']=$session_data['username'];
		$data['aid'] = $session_data['aid'];
      /* Session Variables */
		/* breadcrumbs */
	   $this->breadcrumbs->push(lang('HOME::dashboard'), site_url('home'));
			$data['jobdate'] = $date;
			$data['oid'] = $oid;
			$data['section'] = $section;
			$data['aid'] = $aid;
			$data['cfrom'] = 'single';
			$this->load->view('job_reassign',$data);
  }

  function logout()
  {
  	$session_data=$this->session->userdata('logged_in');
  	session_destroy();
    $this->session->unset_userdata('logged_in');
    redirect('home', 'refresh');
  }
}

?>