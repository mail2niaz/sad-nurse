<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Contract extends CI_Controller {

  function __construct()
  {
    parent::__construct();
	if(!$this->session->userdata('logged_in'))
    {
	redirect('login', 'refresh');
	}
	$this->load->language('mci');
	$this->load->library('breadcrumbs');
	$this->load->model('contract_model');
	$this->load->helper('chmod');
  }

  function index($cid = NULL)
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
		if($cid != ""){
			$data['pid'] = $cid;
			$data['from_pid'] = "yes";
		}
		/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('CONTRACT::contract_list'), site_url($data['i18n'].'contract'));
		/* end */
      $this->load->view('contract_list', $data);

  }

    function addcontract()
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
		$this->breadcrumbs->push( lang('CONTRACT::contract_list'), site_url($data['i18n'].'contract'));
		$this->breadcrumbs->push( lang('CONTRACT::add_contract'), site_url($data['i18n'].'contract/addcontract'));
		/* end */
      $this->load->view('add_contract', $data);

  }

    public function addcontract_details()
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
	$last_intervent_days = $this->input->post('last_intervent_days') - 1;
	$this->form_validation->set_rules('patient_id', lang('CONTRACT::pname'), 'trim|required');
	$this->form_validation->set_rules('fdate', lang('CONTRACT::fdate'),  'trim|required');
	//$this->form_validation->set_rules('tdate', lang('CONTRACT::tdate'),  'trim|required');
	for($i = 0; $i < $last_intervent_days; $i++){
		$intervent_stage = "intervent_type".($i+1);
		$this->form_validation->set_rules($intervent_stage, lang('INTERVENT::intervent_type')."-".($i+1),  'trim|required');
	}
	/*
	for($i = 0; $i < $last_intervent_days; $i++){
		$week_days_stage = "week_days".($i+1)."[]";
		$this->form_validation->set_rules($week_days_stage, lang('CONTRACT::weekday')."-".($i+1),  'trim|required');
	}*/
	$this->form_validation->set_rules('note', 'Note', 'trim');

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('add_contract',$data);
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
	    	$file_ext = $files['userfile']['type'][$i];
			$fname = $this->getfilename($file_ext,$files['userfile']['name'][$i]);
      		$_FILES['userfile']['name']= time().$fname;
			if(!empty($files['userfile']['name'][$i])){
				$fdata[]= time().$fname;
			}

         $_FILES['userfile']['type']= $files['userfile']['type'][$i];
        $_FILES['userfile']['tmp_name']= trim($files['userfile']['tmp_name'][$i]);
        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
        $_FILES['userfile']['size']= $files['userfile']['size'][$i];
	    $this->upload->initialize($this->set_upload_options($fdata));
	    $this->upload->do_upload();
    }

		$this->contract_model->add_cont_details($fdata);
		//exit;
		$data['msg'] = lang('COMMON::detail_msg');
		unset($_POST);
		$this->load->view('add_contract',$data);
	}
  }

public function viewcontract($cid){
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
	$this->breadcrumbs->push( lang('CONTRACT::contract_list'), site_url($data['i18n'].'contract'));
	$this->breadcrumbs->push( lang('CONTRACT::view_contract'), site_url($data['i18n'].'contract/viewcontract'));
	/* end */
		$data['optval'] = $this->contract_model->getcont_detail($cid)->row();
		$url = 'view_contract';
		$this->load->view($url,$data);
}

 function editcontract($cid){
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
	$this->breadcrumbs->push( lang('CONTRACT::contract_list'), site_url($data['i18n'].'contract'));
	$this->breadcrumbs->push( lang('CONTRACT::edit_contract'), site_url($data['i18n'].'contract/editcontract'));
	/* end */
	$this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');


	if($this->input->post('mysubmit')){
		$this->form_validation->set_rules('fdate', lang('CONTRACT::fdate'),  'trim|required');
		//$this->form_validation->set_rules('tdate', lang('CONTRACT::tdate'),  'trim|required');
		$this->form_validation->set_rules('note', 'Note', 'trim');

		if($this->form_validation->run() == FALSE)
		{
			$data['optval'] = $this->contract_model->getcont_detail($cid)->row();
			$this->load->view('edit_contract',$data);
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
	    	$file_ext = $files['userfile']['type'][$i];
			$fname = $this->getfilename($file_ext,$files['userfile']['name'][$i]);
      		$_FILES['userfile']['name']= time().$fname;
			if(!empty($files['userfile']['name'][$i])){
				$fdata[]= time().$fname;
			}

         $_FILES['userfile']['type']= $files['userfile']['type'][$i];
        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
        $_FILES['userfile']['size']= $files['userfile']['size'][$i];
	    $this->upload->initialize($this->set_upload_options($fdata));
	    $this->upload->do_upload();
		//exit;
    }
		$time = time();
		$this->contract_model->edit_cont_details($cid,$fdata);
		$data['msg'] = lang('COMMON::detail_msg');
		unset($_POST);
		$url = $data['i18n'].'contract';
		redirect($url);
		}
	}else{
		$data['optval'] = $this->contract_model->getcont_detail($cid)->row();
		$url = 'edit_contract';
		$this->load->view($url,$data);
	}
}

public function getfilename($file_ext,$files){
	$strname = str_replace("", '_', str_replace(".", '_', $files));
	if($file_ext == "image/png"){
		$fname = $strname.".png";
	}elseif($file_ext == "image/gif"){
		$fname = $strname.".gif";
	}elseif($file_ext == "image/jpeg"){
		$fname = $strname.".jpeg";
	}elseif($file_ext == "application/pdf"){
		$fname = $strname.".pdf";
	}else{
		$fname = '';
	}
	return $fname;
}

private function set_upload_options($fdata)
{
//  upload an image options
	$dirname = $this->config->item('upload_folder');
	$filename = "./uploads/contract_image/" . $dirname . "/";
	if (!file_exists($filename)) {
	    mkdir("./uploads/contract_image/" . $dirname, 0777);
	    //echo "The directory $dirname was successfully created.";
	} else {
	    //echo "The directory $dirname exists.";
	}
	foreach($fdata as $fimg){
		chmod_R("./uploads/contract_image/" . $dirname,0777);
	}
    $config = array();
    $config['upload_path'] = $filename;
    $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc';
    $config['max_size']      = '0';
    $config['overwrite']     = FALSE;
    return $config;
}

public function contractdelete($cid)
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

	$res = $this->contract_model->deletecont_detail($cid);

		/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url($data['i18n'].'home'));
		$this->breadcrumbs->push( lang('CONTRACT::contract_list'), site_url($data['i18n'].'contract'));
		/* end */
		if($res == '1'){
			$data['error_msg'] = lang("CONTRACT::delete_contract_message");
	      	$this->load->view('contract_list', $data);
		}else{
			$url = $data['i18n'].'contract';
			redirect($url,'refresh');
		}




}
function deleteimgage($img){


 	$results = $this->contract_model->deleteimgage_model($img);
	$val = "succ";
	return $results;
}
public function check_pat_int()
	{

		$patient_id = $this->input->post('patient_id');
		$intervent_type = $this->input->post('intervent_type');
	    $result=$this->contract_model->check_pat_int_exist($patient_id, $intervent_type);
	    if($result)
		{
				$this->form_validation->set_message('check_pat_int', lang('CONTRACT::error_pat_int'));
				return false;
		}
		else
		{
			return true;
		}
	}

public function GetInterventHour(){

	$inputval = $this->input->post('inputval');
	$result = $this->contract_model->getinthour();
	$patient_details = $this->contract_model->getpatinterventaddress();
	$cnt = $result->num_rows();
	if($cnt > 0){
	 foreach($result->result() as $row){
	 	$time = explode(":", $row->int_time);
		 $hour = $time[0];
		 $min = $time[1];

	 	?>
	 	<div style="padding-bottom: 10px;">
	 		<label style="width: 100%;"><?php echo ( lang("INTERVENT::standard_duration")); ?></label>
	 		<select name="hourcombo<?=$inputval?>" class="endhourcombo">
	                            	<option value="0">00</option>
                            	<?php for($eht = 0; $eht <= 23; $eht++ ){ ?>
     								<option value="<?=$eht?>" <?php if($eht == $hour){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($eht);?></option>
                            	<?php } ?>
							</select>
							<select name="mincombo<?=$inputval?>" class="endhourcombo">
								<?php for($emt = 0; $emt <= 55; $emt = $emt+5 ){ ?>
     								<option value="<?=$emt?>" <?php if($emt == $min){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($emt);?></option>
                            	<?php } ?>
			</select>
	 		<!--<input type="text" name="int_time<?=$inputval?>" value="<?=$row->int_time?>" class="input-large" />--> ( HH:MM )
	 	</div>
		<div>
			<label style="width: 100%;"><?php echo ( sprintf( lang("CONTRACT::patient_address")) ); ?></label>
			<textarea style="width: 350px;" id="pataddress<?=$inputval?>" name="pataddress<?=$inputval?>"><?=$patient_details[0]->address?></textarea>
		</div>
		<div style="float: left; width: 225px;">
			<label style="width: 100%;"><?php echo ( sprintf( lang("CONTRACT::patient_city")) ); ?></label>
			<input type="text" style="width: 200px;" id="patcity<?=$inputval?>" name="patcity<?=$inputval?>" value="<?php echo $patient_details[0]->city; ?>">
		</div>
		<div style="float: left; width: 225px;">
			<label style="width: 100%;"><?php echo ( sprintf( lang("CONTRACT::patient_zip")) ); ?></label>
			<input type="text" style="width: 200px;" id="patzip<?=$inputval?>" name="patzip<?=$inputval?>" value="<?php echo $patient_details[0]->zip_code; ?>">
		</div>
		<div style="float: left; width: 215px;">
			<label style="width: 100%;"><?php echo ( sprintf( lang("CONTRACT::patient_latlng")) ); ?></label>
			<input type="text" style="width: 200px;" id="patlatlng<?=$inputval?>" name="patlatlng<?=$inputval?>" value="<?php echo $patient_details[0]->latlang; ?>">
		</div>
		<div style="float: left; width: 36px;">
		<input type="button" value="Map" name="pickmap" onclick="codeAddress('<?=$inputval?>')" class="btn-submit btn-primary"  style="margin-top: 37px;"/>
		</div>
	 	<?php } }
}

public function checkpatintervent(){
	$intval = $this->input->post('intval');
	$patient_id = $this->input->post('patient_id');
	$result = $this->contract_model->getdubpatintervent($intval,$patient_id);
	$cnt = $result->num_rows();
	if($cnt > 0){
		echo "duplicate";
	}else{
		echo "noduplicate";
	}
}

public function delete_contract_intervent($pid,$cid,$intid)
{
	$result = $this->contract_model->delete_cont_inter($pid,$cid,$intid);
	return $result;
}
}
?>