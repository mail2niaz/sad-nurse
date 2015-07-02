<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Jobassign extends CI_Controller {

  function __construct()
  {
    parent::__construct();
	if(!$this->session->userdata('logged_in'))
    {
	redirect('login', 'refresh');
	}
	$this->load->language('mci');
	$this->load->library('breadcrumbs');
	$this->load->model('jobassign_model');
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
		$this->breadcrumbs->push(lang('COMMON::home'), site_url('home'));
		$this->breadcrumbs->push( lang('JOBASSIGN::joblist'), site_url('jobassign'));
		/* end */
      $this->load->view('joblist', $data);
  }


function check_optweek_availabel() {
		$this->load->model('common');
		$selaid = array();
		$validatealldata = $_REQUEST['validatealldata'];
		$opt = $_REQUEST['opt'];
		$section = $_REQUEST['section'];
		$job_date_assign = $_REQUEST['job_date_assign'];

		$exp_validatealldata = explode(",", $validatealldata); ?>
		<label style="float: left; width: 100%;"><?php echo lang("JOBASSIGN::reassign_job_list"); ?></label>
		<div class="opterrormsg">
<div class="opterrortitle">
<?php
if($section == '1'){ $leavetime = lang("SEARCH::morning"); }elseif($section == '2'){ $leavetime = lang("SEARCH::afternoon"); }
echo $leavetime;
?>
</div>
<ul>
		<?php $i = 1;
		foreach($exp_validatealldata as $edata){
			$exp_data = explode('&', $edata);
			$eaid = $exp_data[0];
			$epid = $exp_data[1];
			$setime = explode("^", $exp_data[2]);
			$estart_time = explode(':', $setime[0]);
			$sstart_hour = $estart_time[0];
			$sstart_min = $estart_time[1];
			$eend_time = explode(':', $setime[1]);
			$eend_hour = $eend_time[0];
			$eend_min = $eend_time[1];
			//echo 'aid='.$eaid."--pid=".$epid."--setime="."--start-time=".$sstart_hour.":".$sstart_min." --End-time=".$setime[1]."<br>";
			//exit;


        $this->load->model('jobassign_model', 'check_availabel');
      $query = $this->check_availabel->check_optweek_availabel_details($opt,$eaid,$job_date_assign,$eend_hour,$eend_min);
		if($query == "leaveerror"){
			if($i == 1){
			echo lang("JOBASSIGN::operator_error_msg"); }
		}else{
			$opt_id = $opt;
			$shourcombo_form = $sstart_hour;
			$smincombo_form = $sstart_min;
			$ehourcombo_form = $eend_hour;
			$emincombo_form = $eend_min;
			$is_available = 0;
			$cnt = $query->num_rows();
			if($cnt > 0){
				//echo 'aid='.$eaid."--pid=".$epid."--setime="."--start-time=".$sstart_hour.":".$sstart_min." --End-time=".$setime[1]."<br>";
				foreach($query->result() as $fetch){
				$start_time_hour = $fetch->start_time_hour;
				$start_time_min = $fetch->start_time_min;
				$end_time_hour = $fetch->end_time_hour;
				$end_time_min = $fetch->end_time_min;
				$output = $this->check_operator_availabel($start_time_hour,$start_time_min,$end_time_hour,$end_time_min,$shourcombo_form,$smincombo_form,$ehourcombo_form,$emincombo_form);
				 if($output == 1){
						$is_available = 1;
				 }
				}
if($is_available == '1'){ ?>
<li class="redcolor">
	<?php echo $shourcombo_form.":".$smincombo_form ." - ". $ehourcombo_form.":".$emincombo_form;?> <?=$this->common->getpatientname($epid)?>
</li>
<?php }else{
	$selaid[] = $eaid; ?>
	<li class="greencolor">
	<?php echo $shourcombo_form.":".$smincombo_form ." - ". $ehourcombo_form.":".$emincombo_form;?> <?=$this->common->getpatientname($epid)?>
</li>
<?php }
	}else{
			$selaid[] = $eaid;
		?>
<li class="greencolor">
	<?php echo $shourcombo_form.":".$smincombo_form ." - ". $ehourcombo_form.":".$emincombo_form;?> <?=$this->common->getpatientname($epid)?>
</li>
<?php } } $i++; } ?>
<input type="hidden" name="selaid" id="selaid" value="<?php echo implode(",", $selaid); ?>" />
</ul></div>
<?php }

function check_operator_availabel($starthour,$startmin,$endhour,$endmin,$shourcombo,$smincombo,$ehourcombo,$emincombo){
	$status = 0;

	if($smincombo == '0'){
		$start_min = $smincombo + 1;
	}else{
		$start_min = $smincombo;
	}
	if($emincombo == '0'){
		$end_min = "59";
		$end_hour  = $ehourcombo - 1;
	}else{
		$end_min = $emincombo;
		$end_hour  = $ehourcombo;
	}

$job = array();
for($i=$starthour;$i<=$endhour;$i++ ){
	if($i != $starthour && $endhour != $i){
			for($j=0;$j<60;$j++){
			$job[] = $i.":".$j;
		}
	}elseif($i == $endhour){
		if($starthour == $i){
			$j = $startmin +1;
		} else{
			$j= 0;
		}
		for($j;$j<$endmin;$j++){
			$job[] = $i.":".$j;
		}
	}else{
		if($starthour == $i){
			$j = $startmin +1;
		} else{
			$j= 0;
		}
			for($j;$j<60;$j++){
				$job[] = $i.":".$j;
			}
	}
}

$job1 = array();
for($i=$shourcombo;$i<=$end_hour;$i++ ){
	if($i != $shourcombo && $end_hour != $i){
			for($j=0;$j<60;$j++){
			$job1[] = $i.":".$j;
		}
	}elseif($i == $end_hour){
		if($shourcombo == $i){
			$j = $start_min +1;
		} else{
			$j= 0;
		}
		for($j;$j<$end_min;$j++){
			$job1[] = $i.":".$j;
		}
	}else{
		if($shourcombo == $i){
			$j = $start_min +1;
		} else{
			$j= 0;
		}
			for($j;$j<60;$j++){
				$job1[] = $i.":".$j;
			}
	}
}
//print_r($job);
//print_r($job1);
foreach($job1 as $check_job){
	if(in_array($check_job, $job) ){
	 //echo "Yes = ".$check_job;
		$status = 1;
	}

}
//echo $status;
return $status;
}

public function checkbox_dist_opt_pry()
{
	$this->load->model('common');
	$this->load->model('jobassign_model');
	$dist_id = $this->input->post('dist_id');
	$roles = $this->input->post('roles');
	$action = $this->input->post('action');
	?>
	<option value="" selected="selected"><?php echo ( sprintf( lang("COMMON::choose_one")) ); ?></option>
                                <?php
                               if($action == "dist"){
                               	 	$primary = $this->common->getoperatorlist_hole_role_dist($roles, $dist_id);
                               }else{
 									$primary = $this->common->getoperatorlist_hole_role($roles);
                               }

									if(count($primary) > 0){
                                foreach($primary as $primary_list){
                                	$oid = $primary_list->oid;
									$fname = $primary_list->firstname;
									$lname = $primary_list->lastname;
									$name = $lname." ".$fname; ?>
									<option value="<?=$oid?>"><?=$name?> <?php echo "(".$this->common->getrolename($primary_list->role).")"; ?></option>
                              <?php } }else{ ?>
									<option value=""><?php echo lang('INTERVENT::dataempty'); ?></option>
                              <?php }
}

function submitreassignform()
  {
/* Session Variables */
      	$session_data=$this->session->userdata('logged_in');
		$data['username']=$session_data['username'];
		$data['aid'] = $session_data['aid'];
      /* Session Variables */
  	if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }

		$this->load->model('jobassign_model');
		$ss = $this->jobassign_model->addreassignform();
		if($this->lang->mci_current() == ""){
	  	$i18n = $this->lang->mci_current();
	  }else{
		$i18n = $this->lang->mci_current()."/";
	  }
		//redirect($i18n.'jobassign','refresh');
  }


public function checkcontractdetails_contract()
{
	$this->load->model('jobassign_model');
	echo $ss = $this->jobassign_model->jobcontract_ceased_date();
}
}
?>
