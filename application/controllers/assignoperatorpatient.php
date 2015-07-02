<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Assignoperatorpatient extends CI_Controller {

  function __construct()
  {
    parent::__construct();
	$this->load->language('mci');
	$this->load->library('breadcrumbs');
  }

  function index()
  {


    if($this->session->userdata('logged_in'))
    {
      $session_data = $this->session->userdata('logged_in');
      $data['username'] = $session_data['username'];
	   $data['i18n'] = $this->lang->mci_current();

		/* breadcrumbs */
		$this->breadcrumbs->push(lang('operator_info'), site_url('operator/operatorlist'));
		$this->breadcrumbs->push( lang('add_operator'), site_url('operator'));
		/* end */
      $this->load->view('assignpatientoperator', $data);
    }
    else
    {
      redirect('login', 'refresh');
	}
  }

    function passigno()
  {
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
	$this->form_validation->set_rules('patient', 'Patient', 'trim|required');
	if($this->form_validation->run() == FALSE)
		{
			$this->index();

		}
		else
	{
		$this->load->model('assignoperatorpatient_model');

		$this->assignoperatorpatient_model->add_passigno();
		$data['msg']="Details Successfully Added";
 		$this->load->view('assignpatientoperator', $data);
	}
  }

function check_default($post_string)
{
  return $post_string == '0' ? FALSE : TRUE;
}

    public function addoperator()
  {
 	  $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');

	$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
	$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
	$this->form_validation->set_rules('email', 'Email',  'trim|required|valid_email');
	$this->form_validation->set_rules('username', 'Username',  'trim|required|callback_check_operator_ci');
	$this->form_validation->set_rules('password', 'Password', 'required');
	$this->form_validation->set_rules('role', 'Role', 'trim|required');
	$this->form_validation->set_rules('contact_no', 'Contact Number', 'trim|required');
	$this->form_validation->set_rules('landline_no', 'Landline Number', 'trim');
	$this->form_validation->set_rules('street', 'Street', 'trim|required');
	$this->form_validation->set_rules('hb_no', 'House/Building number', 'trim|required');
	$this->form_validation->set_rules('city', 'City', 'trim|required');
	$this->form_validation->set_rules('postalcode', 'Postal Code', 'trim|required');
	$this->form_validation->set_rules('provincecode', 'Province Code', 'trim|required');
	$this->form_validation->set_rules('mobile_udid', 'Mobile UDID', 'trim|required');
	$this->form_validation->set_rules('note', 'Note', 'trim');
			if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
	{
		$this->load->model('operator_model');
		$this->operator_model->add_operator();
		$session_data=$this->session->userdata('logged_in');
		$data['username']=$session_data['username'];
		$data['msg'] = "Details Added Successfully.";

		$this->load->view('addoperator_view',$data);
	}
  }

 function editoperator($oid){

	/* breadcrumbs */
	$this->breadcrumbs->push(lang('operator_info'), site_url('operator/operatorlist'));
	$this->breadcrumbs->push( lang('edit_operator'), site_url('operator/editoperator'));
	/* end */
	$this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');
	$this->load->model('operator_model');

	if($this->input->post('mysubmit')){
		$this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
		$this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
		$this->form_validation->set_rules('email', 'Email',  'trim|required|valid_email');
		$this->form_validation->set_rules('role', 'Role', 'trim|required');
		$this->form_validation->set_rules('contact_no', 'Contact Number', 'trim|required');
		$this->form_validation->set_rules('landline_no', 'Landline Number', 'trim');
		$this->form_validation->set_rules('street', 'Street', 'trim|required');
		$this->form_validation->set_rules('hb_no', 'House/Building number', 'trim|required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('postalcode', 'Postal Code', 'trim|required');
		$this->form_validation->set_rules('provincecode', 'Province Code', 'trim|required');
		$this->form_validation->set_rules('mobile_udid', 'Mobile UDID', 'trim|required');
		$this->form_validation->set_rules('note', 'Note', 'trim');
		if($this->form_validation->run() == FALSE)
		{
			$data['optval'] = $this->operator_model->getoperator($oid)->row();
			$this->load->view('editoperator',$data);
		}
		else
		{
		$time = time();
		$this->operator_model->update_operator($oid);
		$data['msg'] = "Details Added Successfully.";
		redirect('operator/operatorlist');
		}
	}else{
		$session_data=$this->session->userdata('logged_in');
		$data['username']=$session_data['username'];
		$data['optval'] = $this->operator_model->getoperator($oid)->row();
		$url = 'editoperator';
		$this->load->view($url,$data);
	}
}

public function check_operator_ci()
	{
		$this->load->model('operator_model');
		$opt=$this->input->post('username');
	    $result=$this->operator_model->check_opt_exist($opt);
	    if($result)
		{
				$this->form_validation->set_message('check_operator_ci', lang('username_exit'));
				return false;
		}
		else
		{
			return true;
		}
	}

public function operatordetails($oid){
	$this->load->model('operator_model');
	/* breadcrumbs */
	$this->breadcrumbs->push(lang('operator_info'), site_url('operator/operatorlist'));
	$this->breadcrumbs->push( lang('view_operator'), site_url('operator/operatordetails'));
	/* end */

	$session_data=$this->session->userdata('logged_in');
		$data['username']=$session_data['username'];
		$data['optval'] = $this->operator_model->getoperator($oid)->row();
		$url = 'operator_view';
		$this->load->view($url,$data);
}

public function delete($oid)
{

	$this->load->model('operator_model');
	$this->operator_model->deleteoperator($oid);
	redirect('operator/operatorlist','refresh');

}



}

?>