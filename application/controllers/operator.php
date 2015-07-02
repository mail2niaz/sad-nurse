<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Operator extends CI_Controller {

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
	$this->load->model('operator_model');

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
		$this->breadcrumbs->push(lang('LEFTMENU::operator-list'), site_url('operator/operatorlist'));
		$this->breadcrumbs->push( lang('LEFTMENU::add_operator'), site_url('operator'));
		/* end */
      $this->load->view('addoperator_view', $data);

  }

    function operatorlist()
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
		$this->breadcrumbs->push( lang('LEFTMENU::operator-list'), site_url('operator/operatorlist'));
		/* end */
		$data['result'] = $this->operator_model->getoperator();
      $this->load->view('operatorlist_view', $data);

  }


    public function addoperator()
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

	$this->form_validation->set_rules('firstname', lang('OPERATOR::fname'), 'trim|required');
	$this->form_validation->set_rules('lastname', lang('OPERATOR::lname'), 'trim|required');
	$this->form_validation->set_rules('role', lang('OPERATOR::role'), 'trim|required');
	$this->form_validation->set_rules('dist_id[]', lang('OPERATOR::district_opt'), 'trim|required');
	$this->form_validation->set_rules('contact_no', lang('OPERATOR::con_no'), 'trim|required');
	$this->form_validation->set_rules('landline_no', lang('OPERATOR::land_no'), 'trim');
	$this->form_validation->set_rules('street', lang('OPERATOR::street'), 'trim|required');
	$this->form_validation->set_rules('hb_no', lang('OPERATOR::hb_no'), 'trim|required');
	$this->form_validation->set_rules('city', lang('OPERATOR::city'), 'trim|required');
	$this->form_validation->set_rules('postalcode', lang('OPERATOR::postal_code'), 'trim|required');
	$this->form_validation->set_rules('provincecode', lang('OPERATOR::pro_code'), 'trim|required');
	$this->form_validation->set_rules('note', lang('OPERATOR::note'), 'trim');
			if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
	{
		$this->load->model('operator_model');
		$this->operator_model->add_operator();
		//exit;
		$data['msg'] = lang('COMMON::detail_msg');
		unset($_POST);
		$this->load->view('addoperator_view',$data);
	}
  }

 function editoperator($oid){
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
	$this->breadcrumbs->push(lang('LEFTMENU::operator-list'), site_url('operator/operatorlist'));
	$this->breadcrumbs->push( lang('OPERATOR::edit_operator'), site_url('operator/editoperator'));
	/* end */
	$this->load->helper(array('form', 'url'));
	$this->load->library('form_validation');
	$this->load->model('operator_model');

	if($this->input->post('mysubmit')){
	$this->form_validation->set_rules('firstname', lang('OPERATOR::fname'), 'trim|required');
	$this->form_validation->set_rules('lastname', lang('OPERATOR::lname'), 'trim|required');
	$this->form_validation->set_rules('role', lang('OPERATOR::role'), 'trim|required');
	$this->form_validation->set_rules('dist_id[]', lang('OPERATOR::district_opt'), 'trim|required');
	$this->form_validation->set_rules('contact_no', lang('OPERATOR::con_no'), 'trim|required');
	$this->form_validation->set_rules('landline_no', lang('OPERATOR::land_no'), 'trim');
	$this->form_validation->set_rules('street', lang('OPERATOR::street'), 'trim|required');
	$this->form_validation->set_rules('hb_no', lang('OPERATOR::hb_no'), 'trim|required');
	$this->form_validation->set_rules('city', lang('OPERATOR::city'), 'trim|required');
	$this->form_validation->set_rules('postalcode', lang('OPERATOR::postal_code'), 'trim|required');
	$this->form_validation->set_rules('provincecode', lang('OPERATOR::pro_code'), 'trim|required');
	$this->form_validation->set_rules('note', lang('OPERATOR::note'), 'trim');
		if($this->form_validation->run() == FALSE)
		{
			$data['optval'] = $this->operator_model->getoperator($oid)->row();
			$this->load->view('editoperator',$data);
		}
		else
		{
		$time = time();
		$this->operator_model->update_operator($oid);
		$data['msg'] = lang('COMMON::detail_msg');
		unset($_POST);
		$url = $data['i18n'].'operator/operatorlist';
		redirect($url);
		}
	}else{

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
				$this->form_validation->set_message('check_operator_ci', lang('OPERATOR::username_exit'));
				return false;
		}
		else
		{
			return true;
		}
	}

public function operatordetails($oid){
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
	$this->load->model('operator_model');
	/* breadcrumbs */
	$this->breadcrumbs->push(lang('LEFTMENU::operator-list'), site_url('operator/operatorlist'));
	$this->breadcrumbs->push( lang('OPERATOR::view_operator'), site_url('operator/operatordetails'));
	/* end */
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

/* Calendar */
    function operatorcalendar($oid)
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
		$data['oid'] = $oid;
		/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url('home'));
		$this->breadcrumbs->push( lang('OPERATOR::opt_wrk_days'), site_url('operator/operatorlist'));
		/* end */
      $this->load->view('operatorlist_calendar', $data);
  }

function get_operator_date($oid, $date, $actiondate, $leavetime){
		$this->load->model('operator_model');
		$this->operator_model->operatordate_model($oid, $date, $actiondate, $leavetime);
}

function Nav_next(){

	$month_no = $_REQUEST['month_no'];
	$next_month_no = sprintf("%02s", $_REQUEST['month_no'] + 1);
	$pre_month_no = sprintf("%02s", $_REQUEST['month_no'] - 1);
	$hdays_array = array();
	$monthNum = sprintf("%02s", $month_no);
	$timestamp = mktime(0, 0, 0, $monthNum, 10);
	if($this->lang->mci_current() == ""){
	  	$i18n = $this->lang->mci_current();
		$monthName = $this->common->GetMonthName(date("F", $timestamp));
	  }else{
		$i18n = $this->lang->mci_current()."/";
		$monthName = date("F", $timestamp);
	  }
	?>
	<script type="text/javascript">
	var $k = jQuery.noConflict();
	$k(document).ready(function(){
		var hide_next_month_no = jQuery('.mnext').attr('next');
		var hide_pre_month_no = jQuery('.mprev').attr('pre');
		if(hide_next_month_no > 12){
			jQuery('.mnext').hide();
		}else{
			jQuery('.mnext').show();
		}
		if(hide_pre_month_no < 1){
			jQuery('.mprev').hide();
		}else{
			jQuery('.mprev').show();
		}

	var siteurl = "<?php echo site_url($i18n.'operator/Nav_next') ?>";
  	jQuery('.mprev').click(function(){
	var pre_month_no = jQuery('.mprev').attr('pre');
	if(pre_month_no >= 1){
			jQuery.post(siteurl,
	           {month_no: ""+pre_month_no+"" },
               function(data){
               	jQuery('.holidays').html('');
               		jQuery('.holidays').html(data);
	       });
	}

	});

	jQuery('.mnext').click(function(){
		var next_month_no = jQuery(this).attr('next');
		if(next_month_no <= 12){
			jQuery.post(siteurl,
	       {month_no: ""+next_month_no+"" },
	       function(data){
	       	jQuery('.holidays').html('');
	       		jQuery('.holidays').html(data);

	   });
		}
   });
});
</script>
	<div class="widgetbox" style="width: 100%;">
	<h4 class="widgettitle"><a class="mprev" pre="<?=$pre_month_no?>" style="float: left;"> <span class="ui-icon ui-icon-circle-triangle-w">Prev</span> </a>&nbsp;&nbsp;<span style="text-align: center;width: 90%;float: left;"><?php echo $monthName; ?></span>&nbsp;&nbsp;<a class="mnext" next="<?=$next_month_no?>" style="float: right;"> <span class="ui-icon ui-icon-circle-triangle-e">Next</span> </a></h4>
	<div class="widgetcontent">
			<table class="table">
				<tr><td><b><?php echo ( sprintf( lang("MONTH::date")) ); ?></b></td><td><b><?php echo ( sprintf( lang("MONTH::reason")) ); ?></b></td></tr>


<?php
$qry_hdays = $this->operator_model->GetAllHolidays($month_no);
$cnt_hdays = $qry_hdays->num_rows();
if($cnt_hdays > 0){
	foreach($qry_hdays->result() as $hdates){
		$date = $hdates->date;
		$mon = date("m", strtotime($date));
		$reason = $hdates->reason; ?>
<tr><td><?=$date?></td><td><?=$reason?></td></tr>
					<?php } } ?>
</table>
	</div>
</div>
<?php }

function Nav_optnext($oid){
	date_default_timezone_set("Asia/Kolkata");
	$month_no = $_REQUEST['month_no'];
	$next_month_no = sprintf("%02s", $_REQUEST['month_no'] + 1);
	$pre_month_no = sprintf("%02s", $_REQUEST['month_no'] - 1);
	$hdays_array = array();
	$monthNum = sprintf("%02s", $month_no);
	$timestamp = mktime(0, 0, 0, $monthNum, 10);
	if($this->lang->mci_current() == ""){
	  	$i18n = $this->lang->mci_current();
		$monthName = $this->common->GetMonthName(date("F", $timestamp));
	  }else{
		$i18n = $this->lang->mci_current()."/";
		$monthName = date("F", $timestamp);
	  }
	?>
	<script type="text/javascript">
	var $k = jQuery.noConflict();
	$k(document).ready(function(){
		var hide_next_month_no = jQuery('.optmnext').attr('next');
		var hide_pre_month_no = jQuery('.optmprev').attr('pre');
		if(hide_next_month_no > 12){
			jQuery('.optmnext').hide();
		}else{
			jQuery('.optmnext').show();
		}
		if(hide_pre_month_no < 1){
			jQuery('.optmprev').hide();
		}else{
			jQuery('.optmprev').show();
		}

   	var optsiteurl = "<?php echo site_url($i18n.'operator/Nav_optnext/'.$oid) ?>";
  	jQuery('.optmprev').click(function(){
	var pre_month_no = jQuery('.optmprev').attr('pre');
	if(pre_month_no >= 1){
			jQuery.post(optsiteurl,
	           {month_no: ""+pre_month_no+"" },
               function(data){
               	jQuery('.optholidays').html('');
               		jQuery('.optholidays').html(data);
	       });
	}

	});

	jQuery('.optmnext').click(function(){
		var next_month_no = jQuery(this).attr('next');
		if(next_month_no <= 12){
			jQuery.post(optsiteurl,
	       {month_no: ""+next_month_no+"" },
	       function(data){
	       	jQuery('.optholidays').html('');
	       		jQuery('.optholidays').html(data);

	   });
		}
   });
});
</script>
	<div class="widgetbox" style="width: 100%;">
		<input type="hidden" name="cmonth" id="cmonth" value="<?=$month_no?>" />
		<input type="hidden" name="optsiteurl" id="optsiteurl" value="<?php echo site_url($i18n.'operator/Nav_optnext/'.$oid) ?>" />
	<h4 class="widgettitle"><a class="optmprev" pre="<?=$pre_month_no?>" style="float: left;"> <span class="ui-icon ui-icon-circle-triangle-w">Prev</span> </a>&nbsp;&nbsp;<span style="text-align: center;width: 90%;float: left;"><?php echo $monthName; ?></span>&nbsp;&nbsp;<a class="optmnext" next="<?=$next_month_no?>" style="float: right;"> <span class="ui-icon ui-icon-circle-triangle-e">Next</span> </a></h4>
	<div class="widgetcontent">
			<table class="table">
				<tr><td><b><?php echo ( sprintf( lang("MONTH::date")) ); ?></b></td><td><b><?php echo ( sprintf( lang("OPERATOR::leave_section")) ); ?></b></td><td><b><?php echo ( sprintf( lang("JOBASSIGN::note")) ); ?></b></td></tr>
<?php
$optdays_array = $this->operator_model->getoperatorleavelist($oid,$month_no);
$cnt_optdays = count($optdays_array);
if($cnt_optdays > 0){
	foreach($optdays_array as $optdates){
						$wrk_date = substr($optdates->wrk_date, 0,-3);
					   $date = date("Y-m-d", $wrk_date);
						$mon = date("m", strtotime($date));
						if($optdates->leavetime == '1'){
							$leavetime = lang("OPERATOR::morning");
						}elseif($optdates->leavetime == '2'){
							$leavetime = lang("OPERATOR::afternoon");
						}elseif($optdates->leavetime == '3'){
							$leavetime = lang("OPERATOR::both");
						}  ?>
<tr><td><?=$date?></td><td><?=$leavetime?></td><td><?php echo $optdates->note; ?></td></tr>
					<?php } } ?>
</table>
	</div>
</div>
<?php }


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
      /* Session Variables */
	  if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }
		/* breadcrumbs */
		$this->breadcrumbs->push(lang('COMMON::home'), site_url('home'));
		$this->breadcrumbs->push( lang('OPERATOR::import'), site_url('operator/import'));
		/* end */
			if($this->input->post('mysubmit')){
			$fdata = $_FILES['opt_file']['name'];
			$type = $_FILES['opt_file']['type'];
			$filename = $_FILES['opt_file']['tmp_name'];
			$file = import_operator($fdata,$type,$filename);
			//exit;
		    if($file == 'Success'){
            		$data['msg'] = lang('data_uploaded_successfully');
               	$this->load->view('import_operator',$data);
              } else{
                    $data['msg'] = lang("data_uploaded_failed"). ' <a target="_blank" href="'.base_url().'uploads/errorlog/'.$file.'">error log</a>';
                  $this->load->view('import_operator', $data);
              }
			}else{
	  			  $this->load->view('import_operator', $data);
			}
  }
}
?>
