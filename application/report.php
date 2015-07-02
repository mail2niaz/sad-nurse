<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Report extends CI_Controller {

  function __construct()
  {
    parent::__construct();
	if(!$this->session->userdata('logged_in'))
    {
	redirect('login', 'refresh');
	}
	$this->load->language('mci');
	$this->load->library('breadcrumbs');
	$this->load->model('report_model');
	$this->load->library('times_counter');
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
		$this->breadcrumbs->push( lang('REPORT::report_dash'), site_url($data['i18n'].'report'));
		/* end */
      $this->load->view('report_view', $data);

  }

  /* Operator Report*/

    function operator_report()
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
		$this->breadcrumbs->push( lang('REPORT::opt_report'), site_url($data['i18n'].'report/operator_report'));
		/* end */
      $this->load->view('operator_report_list', $data);

  }

  function get_optresult($rid = NULL){
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
		if($rid != ""){

 	$results = $this->report_model->get_optresultdetails($rid); ?>
 	<h4 class="widgettitle"><?php echo lang("REPORT::search_report"); ?></h4>
                <div class="widgetcontent nopadding">
                	<?php echo anchor($this->lang->mci_current().'/report/opt_csv/'.$rid,lang("REPORT::export_csv"),array('class' => 'btn btn-primary btn-submit export')); ?>
                	<?php echo anchor($this->lang->mci_current().'/report/opt_pie_chart/'.$rid,lang("REPORT::view_pie_chart"),array('class' => 'btn btn-primary btn-submit export','target'=>'_blank')); ?>
	<table id="dyntable" class="table table-bordered responsive">
	  <colgroup>
                        <col class="con0" style="align: center; width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
	    <thead>
		  <th class="head0"><?php echo lang("COMMON::sno"); ?></th>
		  <th class="head1"><?php echo lang("OPERATOR::name"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::role"); ?></th>
		  <th class="head1"><?php echo lang("OPERATOR::email"); ?></th>
		  <th class="head0"><?php echo lang("OPERATOR::city"); ?></th>
		  <th class="head0"><?php echo lang("OPERATOR::mob_udid"); ?></th>
		</thead>
		<tbody>
<?php if (count($results) > 0)
{
	$i=1;
 	foreach($results as $result){
   			$oid = $result->oid;
    		$fname = $result->firstname;
			$lname = $result->lastname;
			$name = $lname." ".$fname;
			?>
			<tr class="gradeX">
		<td><?=$i?></td>
		<td><?=$name?></td>
		<td><?php echo $role = $this->common->getrolename($result->role);?></td>
		<td align="center"><?php echo $result->email;  ?></td>
		<td align="center"><?php echo $result->city; ?></td>
		<td align="center"><?php echo $result->mobile_udid; ?></td>
		</tr>
		<?php  $i++;  }
}else{ ?>
<tr><td colspan="6" style="text-align: center;"><?php echo lang("JOBASSIGN-REPORT::no_data"); ?></td></tr>
<?php }  ?>
</tbody>
		</table>
		</div>

<?php }
 	}


function opt_csv($rid)
    {
	    header('Content-Type: application/vnd.ms-excel');	//define header info for browser
		header('Content-Disposition: attachment; filename=opt_report'.time().'-'.$rid.'.xls');
		header('Pragma: no-cache');
		header('Expires: 0');

 	$results = $this->report_model->get_optresultdetails($rid); ?>

	<table id="dyntable" class="table table-bordered responsive">
	    <thead>
		  <th class="head0"><?php echo lang("COMMON::sno"); ?></th>
		  <th class="head1"><?php echo lang("OPERATOR::name"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::role"); ?></th>
		  <th class="head1"><?php echo lang("OPERATOR::email"); ?></th>
		  <th class="head0"><?php echo lang("OPERATOR::city"); ?></th>
		  <th class="head0"><?php echo lang("OPERATOR::mob_udid"); ?></th>
		</thead>
		<tbody>
<?php if (count($results) > 0)
{
	$i=1;
 	foreach($results as $result){
   			$oid = $result->oid;
    		$fname = $result->firstname;
			$lname = $result->lastname;
			$name = $lname." ".$fname;
			?>
			<tr class="gradeX">
		<td><?=$i?></td>
		<td><?=$name?></td>
		<td><?php echo $role = $this->common->getrolename($result->role);?></td>
		<td align="center"><?php echo $result->email;  ?></td>
		<td align="center"><?php echo $result->city; ?></td>
		<td align="center"><?php echo $result->mobile_udid; ?></td>
		</tr>
		<?php  $i++;  }
}else{ ?>
<tr><td colspan="6" style="text-align: center;"><?php echo lang("JOBASSIGN-REPORT::no_data"); ?></td></tr>
<?php }  ?>
</tbody>
		</table>
<?php

    }

function opt_pie_chart($rid)
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
		$this->breadcrumbs->push( lang('REPORT::piechart'), site_url($data['i18n'].'report/opt_pie_chart'));
		/* end */

 		$data['pie_data'] = $this->report_model->get_optpiechart($rid);
	 $this->load->view('operator_pie_chart', $data);
    }
/* Intervent */

    function opt_intervent_report()
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
		$this->breadcrumbs->push( lang('REPORT::inv_report'), site_url($data['i18n'].'operator/opt_intervent_report'));
		/* end */
      $this->load->view('operator_intervent_report', $data);
  }
/* End Operator Report */

/* Intervent Report */
    function req_intervent_report()
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
		$this->breadcrumbs->push( lang('REPORT::inv_report'), site_url($data['i18n'].'report/req_intervent_report'));
		/* end */
      $this->load->view('intervent_report_list', $data);
  }


  function get_reqresult($pid = NULL, $oid = NULL, $from_date = NULL ,$to_date = NULL){
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

 	$results = $this->report_model->get_reqresultdetails($pid,$oid,$from_date,$to_date);
 	?>
 	<h4 class="widgettitle"><?php echo lang("REPORT::search_report"); ?></h4>
                <div class="widgetcontent nopadding">
                	<?php echo anchor($this->lang->mci_current().'/report/intervent_csv/'.$pid."/".$oid."/".$from_date."/".$to_date,lang("REPORT::export_csv"),array('class' => 'btn btn-primary btn-submit export')); ?>

	<table id="dyntable" class="table table-bordered responsive">
	  <colgroup>
                        <col class="con0" style="align: center; width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
	    <thead>
		  <th class="head0"><?php echo lang("REPORT::req_id"); ?></th>
		  <th class="head1"><?php echo lang("REPORT::pname"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::oname"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::duration"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::coordinates"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::entry_date"); ?></th>
		</thead>
		<tbody>
<?php if (count($results) > 0)
{
 	foreach($results as $result){
 			$req_id = $result->request_id;
    		$pname = $result->pname;
			$oname = $result->oname;
			$latlang = $result->latlang;
			$duration = $result->duration;
			$entry_date = $result->entry_date;
			?>
			<tr class="gradeX">
		<td><?=$req_id?></td>
		<td><?=$pname?></td>
		<td><?php echo $oname." (<b>".$result->role ."</b>)"; ?></td>
		<td><?=$duration?></td>
		<td><?=$latlang?></td>
		<td align="center"><?php echo $entry_date;  ?></td>
		</tr>
		<?php  }
}else{ ?>
<tr><td colspan="6" style="text-align: center;"><?php echo lang("JOBASSIGN-REPORT::no_data"); ?></td></tr>
<?php }  ?>
</tbody>
		</table>
		</div>
<?php
 	}

function intervent_csv($pid = NULL, $oid = NULL, $from_date = NULL ,$to_date = NULL){
  	/* Session Variables */

      	header('Content-Type: application/vnd.ms-excel');	//define header info for browser
		header('Content-Disposition: attachment; filename=intervent_report'.time().'.xls');
		header('Pragma: no-cache');
		header('Expires: 0');
      /* Session Variables */

 	$results = $this->report_model->get_reqresultdetails($pid,$oid,$from_date,$to_date); ?>
 	<h4 class="widgettitle"><?php echo lang("search_report"); ?></h4>
                <div class="widgetcontent nopadding">
                	<?php echo anchor($this->lang->mci_current().'/report/intervent_csv/'.$pid."/".$oid."/".$from_date."/".$to_date,lang("REPORT::export_csv"),array('class' => 'btn btn-primary btn-submit export')); ?>
	<table id="dyntable" class="table table-bordered responsive">
	  <colgroup>
                        <col class="con0" style="align: center; width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
	    <thead>
		  <th class="head0"><?php echo lang("REPORT::req_id"); ?></th>
		  <th class="head1"><?php echo lang("REPORT::pname"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::oname"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::duration"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::coordinates"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::entry_date"); ?></th>
		</thead>
		<tbody>
<?php if (count($results) > 0)
{
 	foreach($results as $result){
 			$req_id = $result->request_id;
    		$pname = $result->pname;
			$oname = $result->oname;
			$latlang = $result->latlang;
			$duration = $result->duration;
			$entry_date = $result->entry_date;
			?>
			<tr class="gradeX">
		<td><?=$req_id?></td>
		<td><?=$pname?></td>
		<td><?php echo $oname." (<b>".$result->role ."</b>)"; ?></td>
		<td><?=$duration?></td>
		<td><?=$latlang?></td>
		<td align="center"><?php echo $entry_date;  ?></td>
		</tr>
		<?php  }
}else{ ?>
<tr><td colspan="6" style="text-align: center;"><?php echo lang("JOBASSIGN-REPORT::no_data"); ?></td></tr>
<?php }  ?>
</tbody>
		</table>
		</div>
<?php
 	}

    function req_intervent_chart_report()
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
		$this->breadcrumbs->push( lang('REPORT::barchart'), site_url($data['i18n'].'report/req_intervent_chart_report'));
		/* end */
      $this->load->view('intervent_chart_report', $data);
  }

    public function showchartreport()
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
		$this->breadcrumbs->push( lang('REPORT::barchart'), site_url($data['i18n'].'report/req_intervent_chart_report'));
		/* end */

		$data['year'] = $this->input->post('year');
		$data['bar_report'] = $this->report_model->get_reqchart();
		//$data['pview'] = $this->load->view('intervent_bar_report',$data1);
		$data['rep'] = "yes";
		$this->load->view('intervent_chart_report',$data);

  }
/* End Intervent Report */

/* Patient Intrvent Report */

    function patient_intervent_report()
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
		$this->breadcrumbs->push( lang('REPORT::inv_form'), site_url($data['i18n'].'report/patient_intervent_report'));
		/* end */
      $this->load->view('patient_intervent_report_list', $data);
  }

  function get_pat_int_result($pid = NULL, $oid = NULL, $from_date = NULL ,$to_date = NULL, $did = NULL){
  	$this->load->library('times_counter');
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

 	$results = $this->report_model->get_patresultdetails($pid,$oid,$from_date,$to_date,$did);
 	?>

 	<h4 class="widgettitle"><?php echo lang("REPORT::search_report"); ?></h4>
 	<input type="hidden" name="popupeditlink" id="popupeditlink" value="<?php echo site_url($i18n.'report/edit_popup_pat_intervent') ?>" />
                <div class="widgetcontent nopadding">
<?php echo anchor($this->lang->mci_current().'/report/pat_intervent_csv/'.$pid."/".$oid."/".$from_date."/".$to_date."/".$did,lang("REPORT::export_csv"),array('class' => 'btn btn-primary btn-submit export')); ?>
	<table id="repdyntable" class="table table-bordered responsive">
	    <thead>
	      <th class="head0"><?php echo lang("COMMON::sno"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::pname"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::oname"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::intervent_name"); ?></th>
		  <!--<th class="head0"><?php echo lang("REPORT::contract_name"); ?></th>-->
		  <th class="head0"><?php echo lang("REPORT::duration"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::start_stop_time"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::inv_form"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::planned_address"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::start_address"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::end_address"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::entry_date"); ?></th>
		  <th class="head0"><?php echo lang("COMMON::action"); ?></th>
		</thead>

<?php if (count($results) > 0)
{ ?>
	<tbody>
		<?php
	$i = 1;
 	foreach($results as $result){
 			$ped_id = $result->ped_id;
 			$req_id = $result->request_id;
    		$pname = $result->pname;
			$oname = $result->oname;
			$intervent_name = $this->common->getinterventname($result->intervent_id);
			//$contract_name = $result->cid;
			$duration = $result->duration;
			$startend_time = $result->start_time." / ".$result->end_time;
			$res_oid = $result->oid;
			$res_pid = $result->pid;
			$planned_address = $result->planned_address;
			$start_address = $result->start_address;
			$end_address = $result->end_address;
			$entry_date = $result->entry_date;
			$note = $result->note;
			$aid = $result->aid;
			$duration_array[]=$result->duration;
			if($aid == '0'){
				$sty = 'style="background: none repeat scroll 0% 0% rgb(204, 204, 204);"';
			}else{
				$sty = '';
			}
			?>
			<tr class="gradeX" <?=$sty?>>
		<td><?=$i?></td>
		<td><?=$pname?></td>
		<td><?php echo $oname." (<b>".$result->role ."</b>)"; ?></td>
		<td><?=$intervent_name?></td>
		<!--<td><?=$contract_name?></td>-->
		<td><?=$duration?></td>
		<td><?=$startend_time?></td>
		<td>
			<div class="peoplelist">
			<div class="peopleinfo" style="margin-left: 0px;">
                                    <ul>
                                    	<?php $ret_cmt = $this->report_model->get_patcmtdetails($res_pid,$res_oid,$req_id);
										foreach($ret_cmt as $ret){
                                    	?>
                                        <li><span><?=$ret->meta_name?>:</span> <?=$ret->meta_value?></li>
                                        <?php } ?>
                                        <?php
                                        if(!empty($note)) {
                                        ?>
                                        <li><?php echo lang("REPORT::note"); ?>:<?php echo $note; ?></li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                                </div>
		</td>
		<td><?=$planned_address?></td>
		<td><?=$start_address?></td>
		<td><?=$end_address?></td>
		<td align="center"><?php echo $entry_date;  ?></td>
		<td><a href="javascript:void(0)" onclick="editreportdata('<?=$ped_id?>','<?=$pid?>','<?=$oid?>','<?=$from_date?>','<?=$to_date?>','<?=$did?>');"><?php echo lang("COMMON::edit"); ?></a></td>
		</tr>
		<?php  $i++; } ?>
		</tbody>
		<!--<tr><td colspan="8" style="text-align: center;font-weight: bold;"><?php echo lang("JOBASSIGN-REPORT::total")." = ".$this->times_counter->get_total_time($duration_array); ?></td></tr>-->
<?php } ?>
		</table>
			<p style="text-align: center; font-weight: bold; font-size: 16px;">
<?php echo lang("JOBASSIGN-REPORT::total")." = ".$this->times_counter->get_total_time($duration_array); ?>
		</p>
		</div>
		<script>
		jQuery(document).ready(function(){
			  var oTable = jQuery('#repdyntable').dataTable();
			  oTable.fnSort( [ [0,'asc'], [1,'asc'] ] );
        })
		</script>
<?php
 	}

   public function external_webservice_export($pid = NULL, $oid = NULL, $from_date = NULL ,$to_date = NULL, $did = NULL){


      $this->load->helper('nusoap');
      error_reporting(-1);
      ini_set('display_errors','1');
      ini_set('soap.wsdl_cache_enabled',0);
      ini_set('soap.wsdl_cache_ttl',0);

      /*
      $result_P2000 = json_decode(json_encode( $result_web), true);
      foreach( $result_P2000 as $web_url) {
            $TPD2009 =  $web_url['url'];
            $platform_code = $web_url['platform_code'];

      }
	   * */
	  $TPD2009 = 'http://93.63.250.130:8080/TPD2009/tpd2009?wsdl';
	  $platform_code = '8888';
      $client = new SoapClient("$TPD2009");
      $client->__setLocation("$TPD2009");
 	  $results = $this->report_model->get_patresultdetails($pid,$oid,$from_date,$to_date,$did);
 	  $username = 'tpd';
      $password = 'ComuneTpd01';
      $export_P2000 = json_decode(json_encode($results), true);
      $i =1;
      $evento = array();

 	foreach($export_P2000 as $result){

 		
 	      $pid =  $result['pid'];
 	      $ped_id =  $result['ped_id'];
 	      $aid =  $result['aid'];
 	      $oid =  $result['oid'];
 	      $opertor_name =  $result['oname'];
            $start_time =  $result['start_time'];
            $duration =  $result['duration'];
            $entry_date =  $result['entry_date'];
            $job_assign_date = date("d/m/Y", strtotime($entry_date));
            $job_date_time = $job_assign_date.' '. $start_time;
            $time = explode(":",$duration);
            $minutes = intval($time[0])*60 + intval($time[1]);
            /*Get Operator job code */
 	      	$sel_job = "SELECT * FROM assign_job_list WHERE aid  = '$aid'";
			$qry_job = mysql_query($sel_job);
			$fet_job = mysql_fetch_assoc($qry_job);
			$pry_oid = $fet_job['pry_oid'];
            $sec_oid = $fet_job['sec_oid'];
			$sup_id = $fet_job['sup_id'];
			
			$query = $this->db->get_where("job_operator_code",array("id_job" => $result['intervent_id']));
			$result_id = $query->result_array();
			print_r($result_id);
			die;
			$i = 1;
			
			foreach($result_id as $result){
				if($oid == $pry_oid) {
					$p200_code_op = $result['code_op1'];
				}else if($oid == $sec_oid) {
					$p200_code_op = $result['code_op2'];
				}else if($oid == $sup_id) {
					$p200_code_op = $result['code_op3'];
				} else {
					$p200_code_op = "0";
				}
				if($i == 1){
					
					/*Get Patient ssn */
					$sel = "SELECT * FROM patients WHERE pid  = '$pid'";
					$qry = mysql_query($sel);
					$fet = mysql_fetch_assoc($qry);
					$ssn = $fet['ssn'];
					$sel_contract = "SELECT * FROM contract_details WHERE pid  = '$pid'";
					$qry_contract = mysql_query($sel_contract);
					$fet_contract = mysql_fetch_assoc($qry_contract);
					$cid = $fet_contract['cid'];
					
					/*Get Operator ssn */
					$sel_opertor = "SELECT * FROM operators WHERE oid  = '$oid'";
					$qry_operator = mysql_query($sel_opertor);
					$fet_operator = mysql_fetch_assoc($qry_operator);
					$operator_ssn = $fet_operator['mobile_udid'];
					
						$evento =  array
						(
							  array(
									"idEventoTrasmesso" => $platform_code.'_'.$ped_id.'_'.'A',
									"codiceContratto" => $platform_code,
									"codiceSottoContratto" => '1',
									"codicePresidio" => '',
									"CFOperatore" => $operator_ssn,
									"descOperatore" => $opertor_name,
									"tipoEvento" => 'A',
									"codiceUtente" => $ssn,
									"idAccesso" => '',
									"dataTimeInizioEvento" => $job_date_time,
									"durataEvento" => $minutes,
									"dataTimeInizioPrestazione" => $job_date_time,
									"durataPrestazione" => $minutes,
									"codicePrestazione" => $p200_code_op
							  ),array(
									"idEventoTrasmesso" => $platform_code.'_'.$ped_id.'_'.'P',
									"codiceContratto" => $platform_code,
									"codiceSottoContratto" => '1',
									"codicePresidio" => '',
									"CFOperatore" => $operator_ssn,
									"descOperatore" => $opertor_name,
									"tipoEvento" => 'P',
									"codiceUtente" => $ssn,
									"idAccesso" => $platform_code.'_'.$ped_id.'_'.'A',
									"dataTimeInizioEvento" => $job_date_time,
									"durataEvento" => $minutes,
									"dataTimeInizioPrestazione" => $job_date_time,
									"durataPrestazione" => $minutes,
									"codicePrestazione" => $p200_code_op
							 )
						);
				} else {
						$evento[$i+1] = array(
									"idEventoTrasmesso" => $platform_code.'_'.$ped_id.'_'.'P',
									"codiceContratto" => $platform_code,
									"codiceSottoContratto" => '1',
									"codicePresidio" => '',
									"CFOperatore" => $operator_ssn,
									"descOperatore" => $opertor_name,
									"tipoEvento" => 'P',
									"codiceUtente" => $ssn,
									"idAccesso" => $platform_code.'_'.$ped_id.'_'.'A',
									"dataTimeInizioEvento" => $job_date_time,
									"durataEvento" => $minutes,
									"dataTimeInizioPrestazione" => $job_date_time,
									"durataPrestazione" => $minutes,
									"codicePrestazione" => $p200_code_op
							 );
				}
				$i++;	
			}
			
				print_r($evento);
				die;
				foreach ($evento as $event) {
					$result = $client->sendEvento(
						array(
                        "user" => $username,
                        "password" => $password,
                        "evento" => $event
						));
				 $response_arr = $this->objectToArray($result);
    			 echo "return_code= " . str_replace(";", "", $response_arr["sendEventoResponse"]);
				  echo "<br><br>";
				}



	  }

	  }

		function objectToArray($d)
	{
		if (is_object($d))
		{
			$d = get_object_vars($d);
		}

		if (is_array($d))
		{
			return array_map(__FUNCTION__, $d);
		}
		else
		{
			return $d;
		}
	}

  function pat_intervent_csv($pid = NULL, $oid = NULL, $from_date = NULL ,$to_date = NULL, $did = NULL){
/* Session Variables */
      	header('Content-Type: application/vnd.ms-excel');	//define header info for browser
		header('Content-Disposition: attachment; filename=pat_intervent_report'.time().'.xls');
		header('Pragma: no-cache');
		header('Expires: 0');
      /* Session Variables */

 	$results = $this->report_model->get_patresultdetails($pid,$oid,$from_date,$to_date,$did);
 	?>
                <div class="widgetcontent nopadding">
	<table id="dyntable" class="table table-bordered responsive">
	    <thead>
		  <th class="head0"><?php echo lang("COMMON::sno"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::pname"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::oname"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::intervent_name"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::duration"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::start_stop_time"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::inv_form"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::planned_address"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::start_address"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::end_address"); ?></th>
		  <th class="head0"><?php echo lang("REPORT::entry_date"); ?></th>
		</thead>
		<tbody>
<?php if (count($results) > 0)
{
	$i= 1;
 	foreach($results as $result){
 			$req_id = $result->request_id;
    		$pname = $result->pname;
			$oname = $result->oname;
			$intervent_name = $this->common->getinterventname($result->intervent_id);
			//$contract_name = $result->cid;
			$duration = $result->duration;
			$startend_time = $result->start_time." / ".$result->end_time;
			$res_oid = $result->oid;
			$res_pid = $result->pid;
			$planned_address = $result->planned_address;
			$start_address = $result->start_address;
			$end_address = $result->end_address;
			$entry_date = $result->entry_date;
			$note = $result->note;
			?>
			<tr class="gradeX">
		<td><?=$i?></td>
		<td><?=$pname?></td>
		<td><?php echo $oname." (<b>".$result->role ."</b>)"; ?></td>
		<td><?=$intervent_name?></td>
		<!--<td><?=$contract_name?></td>-->
		<td><?=$duration?></td>
		<td><?=$startend_time?></td>
		<td>

        	<?php $ret_cmt = $this->report_model->get_patcmtdetails($res_pid,$res_oid,$req_id);
			foreach($ret_cmt as $ret){
        	?>
            <?=$ret->meta_name?>: <?=$ret->meta_value?><br>
            <?php } ?>
            <?=$note?>
		</td>
		<td><?=$planned_address?></td>
		<td><?=$start_address?></td>
		<td><?=$end_address?></td>
		<td align="center"><?php echo $entry_date;  ?></td>
		</tr>
		<?php  $i++; }
}else{ ?>
<tr><td colspan="6" style="text-align: center;"><?php echo lang("JOBASSIGN-REPORT::no_data"); ?></td></tr>
<?php }  ?>
</tbody>
		</table>
		</div>
<?php
 	}

public function edit_popup_pat_intervent($id,$pid,$oid,$from_date,$to_date,$did)
{
	$results = $this->report_model->get_individual_patresultdetails($id);
	?>
		<div class="widgetbox box-inverse span6" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo lang("COMMON::edit"); ?></h4>
                <div class="widgetcontent nopadding">
 <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('',$attributes); ?>
           <div class="stdform stdform2">
           	<input type="hidden" name="ped_id" value="<?=$id?>" id="ped_id" />
           	<input type="hidden" name="pid" value="<?=$pid?>" id="pid" />
           	<input type="hidden" name="oid" value="<?=$oid?>" id="oid" />
           	<input type="hidden" name="from_date" value="<?=$from_date?>" id="from_date" />
           	<input type="hidden" name="to_date" value="<?=$to_date?>" id="to_date" />
           	<input type="hidden" name="did" value="<?=$did?>" id="did" />
           	<input type="hidden" name="siteurl" value="<?php echo site_url($i18n.'report/save_popup_pat_intervent') ?>" id="siteurl" />
           	<input type="hidden" name="responsesiteurl" value="<?php echo site_url($i18n.'report/get_pat_int_result') ?>" id="responsesiteurl" />
                           <p>
                                <label><?php echo lang("REPORT::start_time"); ?></label>
                                <span class="field">
                                	<select name="shourcombo" class="hourcombo combo" id="shourcombo">
                            	<?php
                            	$start_time_exp = explode(":", $results[0]->start_time);
                            	for($st = 0; $st <= 23; $st++ ){ ?>
     								<option value="<?=$this->common->commontimeformat($st)?>" <?php if($this->common->commontimeformat($st) == $start_time_exp[0]){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($st);?></option>
                            	<?php } ?>
</select>
<select name="smincombo" class="mincombo combo" id="smincombo">
	                            	<?php for($mt = 0; $mt <= 60; $mt++ ){ ?>
     								<option value="<?=$this->common->commontimeformat($mt)?>" <?php if($this->common->commontimeformat($mt) == $start_time_exp[1]){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($mt);?></option>
                            	<?php } ?>
</select>(HH:MM)
<input type="hidden" name="sseccombo" id="sseccombo" value="<?php echo $start_time_exp[2]; ?>"/>
</span>
                            </p>
                             <p>
                                <label><?php echo lang("REPORT::stop_time"); ?></label>
                                                                <span class="field">
                                	<select name="ehourcombo" class="hourcombo combo" id="ehourcombo">
                            	<?php
                            	$end_time_exp = explode(":", $results[0]->end_time);
                            	for($et = 0; $et <= 23; $et++ ){ ?>
     								<option value="<?=$this->common->commontimeformat($et)?>" <?php if($this->common->commontimeformat($et) == $end_time_exp[0]){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($et);?></option>
                            	<?php } ?>
</select>
<select name="emincombo" class="mincombo combo" id="emincombo">
	                            	<?php for($emt = 0; $emt <= 60; $emt++ ){ ?>
     								<option value="<?=$this->common->commontimeformat($emt)?>" <?php if($this->common->commontimeformat($emt) == $end_time_exp[1]){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($emt);?></option>
                            	<?php } ?>
</select>(HH:MM)
<input type="hidden" name="eseccombo" id="eseccombo" value="<?php echo $end_time_exp[2]; ?>"/>
</span></p>
                             <p>
                                <label><?php echo lang("REPORT::start_address"); ?></label>
                                <span class="field"><textarea name="start_address" id="start_address"><?php echo $results[0]->start_address; ?></textarea></span>
                            </p>
                            <p>
                                <label><?php echo lang("REPORT::end_address"); ?></label>
                                <span class="field"><textarea name="end_address" id="end_address"><?php echo $results[0]->end_address; ?></textarea></span>
                            </p>
                             <p>
                                <label><?php echo lang("REPORT::note"); ?></label>
                                <span class="field"><textarea name="note" id="note"><?php echo $results[0]->note; ?></textarea></span>
                            </p>
                            <p class="stdformbutton" style="text-align:right">
                            <input type="button" value="<?php echo lang("COMMON::sub_btn"); ?>" style="height: 33px; margin-top: -5px;" class="btn btn-primary btn-submit" onclick="update_report_data();" />
							<button type="reset" class="btn" style="margin-right:75px"><?php echo lang("COMMON::reset_btn"); ?></button>
                            </p>
<?php echo form_close(); ?>
                </div><!--widgetcontent-->
            </div>
            </div><!--maincontentinner-->
<?php }

public function save_popup_pat_intervent()
{
		$res = $this->report_model->put_individual_patresultdetails();
}

 	/* End Patient Intrvent Report */
}

?>
