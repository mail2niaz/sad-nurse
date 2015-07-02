<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Patient extends CI_Controller {

  function __construct()
  {
    parent::__construct();
	if(!$this->session->userdata('logged_in'))
    {
	redirect('login', 'refresh');
	}
	$this->load->language('mci');
	$this->load->library('breadcrumbs');
	$this->load->helper('import');
	$this->load->helper('chmod');
	$this->load->model('patient_model');
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
		$data['aid'] = $session_data['aid'];
		$data['mcontract'] = $session_data['mcontract'];
      /* Session Variables */
	  if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }
		/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('LEFTMENU::add_patient'), site_url($data['i18n'].'patient/addpatient'));
		/* end */
      $this->load->view('add_patient', $data);

  }

    function patientlist()
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
		$data['aid'] = $session_data['aid'];
		$data['mcontract'] = $session_data['mcontract'];
      /* Session Variables */

	  if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }
		/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('PATIENT::patient_list'), site_url($data['i18n'].'patient/patientlist'));
		/* end */
	$data['result'] = $this->patient_model->getpatient();
      $this->load->view('patientlist', $data);

  }


    public function addpatient()
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
		$data['aid'] = $session_data['aid'];
		$data['mcontract'] = $session_data['mcontract'];
      /* Session Variables */
  	if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }
 	  $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');

	$this->form_validation->set_rules('pname', lang('PATIENT::name'), 'trim|required');
	$this->form_validation->set_rules('surname', lang('PATIENT::surname'), 'trim|required');
	$this->form_validation->set_rules('sex', lang('COMMON::sex'), 'trim|required');
	$this->form_validation->set_rules('email', lang('PATIENT::email'),  'trim|valid_email');
	$this->form_validation->set_rules('dist_id', lang('PATIENT::district'), 'trim|required');
	$this->form_validation->set_rules('dob', lang('COMMON::birthday'), 'required');
	$this->form_validation->set_rules('contact_no[]', lang('PATIENT::con_no'), 'trim|required');
	$this->form_validation->set_rules('ssn', lang('PATIENT::ssn'), 'trim|required');
	$this->form_validation->set_rules('address', lang('PATIENT::address'), 'trim|required');
	$this->form_validation->set_rules('latlang', lang('PATIENT::latlang'), 'trim|required');
	$this->form_validation->set_rules('note', lang('PATIENT::note'), 'trim');
			if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
	{
		$this->patient_model->add_patient();
		$data['msg'] = lang('COMMON::detail_msg');
		unset($_POST);
		$this->load->view('add_patient',$data);
	}
  }

 function editpatient($pid){
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
		$data['aid'] = $session_data['aid'];
		$data['mcontract'] = $session_data['mcontract'];
      /* Session Variables */
	if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }
	/* breadcrumbs */
	$this->breadcrumbs->push(lang('PATIENT::patient_list'), site_url($data['i18n'].'patient/patientlist'));
	$this->breadcrumbs->push( lang('PATIENT::edit_patient'), site_url($data['i18n'].'patient/editpatient'));
	/* end */
	$this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');


	if($this->input->post('mysubmit')){
		$this->form_validation->set_rules('pname', lang('PATIENT::name'), 'trim|required');
		$this->form_validation->set_rules('surname', lang('PATIENT::surname'), 'trim|required');
		$this->form_validation->set_rules('sex', lang('COMMON::sex'), 'trim|required');
		$this->form_validation->set_rules('email', lang('PATIENT::email'),  'trim|valid_email');
		$this->form_validation->set_rules('dist_id', lang('PATIENT::district'), 'trim|required');
		$this->form_validation->set_rules('dob', lang('COMMON::birthday'), 'required');
		$this->form_validation->set_rules('contact_no[]', lang('PATIENT::con_no'), 'trim|required');
		$this->form_validation->set_rules('ssn', lang('PATIENT::ssn'), 'trim|required');
		$this->form_validation->set_rules('address', lang('PATIENT::address'), 'trim|required');
		//$this->form_validation->set_rules('zip_code', lang('PATIENT::zip_code'), 'trim|required');
		$this->form_validation->set_rules('latlang', lang('PATIENT::latlang'), 'trim|required');
		$this->form_validation->set_rules('note', lang('PATIENT::note'), 'trim');
		if($this->form_validation->run() == FALSE)
		{
			$data['optval'] = $this->patient_model->getpatient($pid)->row();
			$this->load->view('editpatient',$data);
		}
		else
		{
		$time = time();
		$this->patient_model->update_patient($pid);
		$data['msg'] = lang('COMMON::detail_msg');
		unset($_POST);
		redirect('patient/patientlist');
		}
	}else{
		$data['optval'] = $this->patient_model->getpatient($pid)->row();
		$this->load->view('editpatient',$data);
	}
}

public function patientdetails($pid){
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
		$data['aid'] = $session_data['aid'];
		$data['mcontract'] = $session_data['mcontract'];
      /* Session Variables */
	if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }

	/* breadcrumbs */
	$this->breadcrumbs->push(lang('PATIENT::patient_list'), site_url($data['i18n'].'patient/patientlist'));
	$this->breadcrumbs->push( lang('PATIENT::view_patient'), site_url($data['i18n'].'patient/patientdetails'));
	/* end */

		$data['optval'] = $this->patient_model->getpatient($pid)->row();
		$this->load->view('patient_view',$data);
}

public function delete($pid)
{
	if($this->lang->mci_current() == ""){
	  	$i18n = $this->lang->mci_current();
	  }else{
		$i18n = $this->lang->mci_current()."/";
	  }

	$this->patient_model->deletepatient($pid);
	redirect($i18n.'patient/patientlist','refresh');
}

/* Webservices */

public function patientdetailsjson($pid){

		$data['optval'] = $this->patient_model->getpatient($pid)->row();
		echo json_encode($data);
}


/* Patient Info */

 function patientinfodetails($pid)
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
		$data['aid'] = $session_data['aid'];
		$data['mcontract'] = $session_data['mcontract'];
      /* Session Variables */
	  if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }
		/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('PATIENT::patient_list'), site_url($data['i18n'].'patient/patientlist'));
		$this->breadcrumbs->push( lang('PATIENT::pat_info_list'), site_url($data['i18n'].'patient/patientinfodetails'));
		/* end */
		$data['pid'] = $pid;
	$data['result'] = $this->patient_model->getpatientinfolist($pid);
      $this->load->view('patientinfolist', $data);

  }

public function addpatientinfo($pid,$view=NULL,$piid=NULL)
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
		$data['aid'] = $session_data['aid'];
		$data['mcontract'] = $session_data['mcontract'];
      /* Session Variables */
	  if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }
		/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('PATIENT::patient_list'), site_url($data['i18n'].'patient/patientlist'));
		$this->breadcrumbs->push(lang('PATIENT::pat_info_list'), site_url($data['i18n'].'patient/patientinfodetails'));
		$this->breadcrumbs->push( lang('PATIENT::add_pat_info'), site_url($data['i18n'].'patient/addpatientinfo/'.$pid));
		/* end */
		$data['pid'] = $pid;
		if(isset($view)){
		$data['piid'] = $piid;
		$data['view'] = "yes";
		}
      $this->load->view('addpatientinfo_details', $data);


}

public function addpatientinfodata()
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
		$data['aid'] = $session_data['aid'];
		$data['mcontract'] = $session_data['mcontract'];
      /* Session Variables */
  	if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }
 	  $this->load->helper(array('form', 'url'));

    $this->load->library('form_validation');
	$data['pid'] = $this->input->post('pid');
	$this->form_validation->set_rules('role[]', lang('PATIENT::role'), 'trim|required');
	$this->form_validation->set_rules('info', lang('PATIENT::rolenote'), 'trim|required');
			if($this->form_validation->run() == FALSE)
		{
			$data['pid'] = $this->input->post('pid');
      $this->load->view('addpatientinfo_details', $data);
		}
		else
	{
		/* File Upload */
		$this->load->library('upload');
		$files = $_FILES;
		$fdata = array();
    	$cpt = count($_FILES['userfile']['name']);
		for($i=0; $i<$cpt; $i++)
	    {

      	$_FILES['userfile']['name']= time().$files['userfile']['name'][$i];
		if(!empty($files['userfile']['name'][$i])){
			$fdata[]= time().$files['userfile']['name'][$i];
		}

        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
        $_FILES['userfile']['size']= $files['userfile']['size'][$i];


    $this->upload->initialize($this->set_upload_options($fdata));
    $this->upload->do_upload();


    }
		/* File Upload */

		$this->patient_model->add_patientinfo($fdata);
		$data['result'] = $this->patient_model->getpatientinfolist($this->input->post('pid'));
		$data['msg'] = lang('COMMON::detail_msg');
		$this->load->view('patientinfolist',$data);
	}
  }



function editpatientinfo($pid,$piid){
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
		$data['aid'] = $session_data['aid'];
		$data['mcontract'] = $session_data['mcontract'];
      /* Session Variables */
if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }

	/* breadcrumbs */
	$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
	$this->breadcrumbs->push( lang('PATIENT::patient_list'), site_url($data['i18n'].'patient/patientlist'));
	$this->breadcrumbs->push(lang('PATIENT::pat_info_list'), site_url($data['i18n'].'patient/patientinfodetails'));
	$this->breadcrumbs->push( lang('PATIENT::edit_patient'), site_url($data['i18n'].'patient/editpatientinfo'.$pid));
	/* end */
	$this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');

	$data['pid'] = $pid;
	$data['piid'] = $piid;
	if($this->input->post('mysubmit')){
		$this->form_validation->set_rules('role[]', lang('PATIENT::role'), 'trim|required');
		$this->form_validation->set_rules('info', lang('PATIENT::rolenote'), 'trim|required');
		if($this->form_validation->run() == FALSE)
		{
			$data['optval'] = $this->patient_model->getpatientinfo($piid)->row();
			$this->load->view('editpatientinfo_details',$data);
		}
		else
		{
			/* File Upload */
		$cpt = count($_FILES['userfile']['name']);
		$fdata = array();
		if($cpt > 1){
		$this->load->library('upload');
		$files = $_FILES;

		for($i=0; $i<$cpt; $i++)
	    {

      	$_FILES['userfile']['name']= time().$files['userfile']['name'][$i];
		if(!empty($files['userfile']['name'][$i])){
			$fdata[]= time().$files['userfile']['name'][$i];
		}

        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
        $_FILES['userfile']['size']= $files['userfile']['size'][$i];

    $this->upload->initialize($this->set_upload_options($fdata));
    $this->upload->do_upload();
    }
		}
		/* File Upload */
		$time = time();

		$ss = $this->patient_model->update_patientinfo($piid,$fdata);

		$data['msg'] = lang('COMMON::detail_msg');
		redirect($data['i18n'].'patient/patientinfodetails/'.$pid);
		}
	}else{
		$data['optval'] = $this->patient_model->getpatientinfo($piid)->row();
		$this->load->view('editpatientinfo_details',$data);
	}
}

private function set_upload_options($fdata)
{
	$dirname = $this->config->item('upload_folder');
	$filename = "./uploads/" . $dirname . "/";
	if (!file_exists($filename)) {
	    mkdir("./uploads/" . $dirname, 777);
	    //echo "The directory $dirname was successfully created.";
	} else {
	    //echo "The directory $dirname exists.";
	}
	foreach($fdata as $fimg){
		chmod_R("./uploads/" . $dirname,0777);
	}
    $config = array();
    $config['upload_path'] = $filename;
    $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc';
    $config['max_size']      = '0';
    $config['overwrite']     = FALSE;
    return $config;
}

public function deletepinfo($pid,$piid)
{
	if($this->lang->mci_current() == ""){
	  	$i18n = $this->lang->mci_current();
	  }else{
		$i18n = $this->lang->mci_current()."/";
	  }

	$this->patient_model->deletepatinfo($piid);
	redirect($i18n.'patient/patientinfodetails/'.$pid, 'refresh');
}

function deletepatinfoimg($piimg){


 	$results = $this->patient_model->deletepatinfoimg_model($piimg);
	$val = "succ";
	return $results;
}

public function status_pinfo($pid,$piid, $status)
{
	if($this->lang->mci_current() == ""){
	  	$i18n = $this->lang->mci_current();
	  }else{
		$i18n = $this->lang->mci_current()."/";
	  }

	$this->patient_model->statuspatinfo($pid,$piid, $status);
	redirect($i18n.'patient/patientinfodetails/'.$pid, 'refresh');
}
    function import()
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
		$data['aid'] = $session_data['aid'];
      /* Session Variables */
	  if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }
		/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url('home'));
		$this->breadcrumbs->push( lang('PATIENT::patient_list'), site_url($data['i18n'].'patient/patientlist'));
		$this->breadcrumbs->push( lang('PATIENT::import'), site_url('patient/import'));
		/* end */
			if($this->input->post('mysubmit')){
			$fdata = $_FILES['opt_file']['name'];
			$type = $_FILES['opt_file']['type'];
			$filename = $_FILES['opt_file']['tmp_name'];

			$file = import_patient($fdata,$type,$filename);
//exit;
		    if($file == 'Success'){
            		$data['msg'] = lang('data_uploaded_successfully');
               	$this->load->view('import_patient',$data);
              } else{
                    $data['msg'] = lang("data_uploaded_failed"). ' <a target="_blank" href="'.base_url().'uploads/errorlog/'.$file.'">error log</a>';
                  $this->load->view('import_patient', $data);
              }
			}else{
	  			  $this->load->view('import_patient', $data);
			}
  }
}
?>
