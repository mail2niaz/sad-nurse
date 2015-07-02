<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Jobassign2 extends CI_Controller {

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
		$this->breadcrumbs->push(lang('COMMON::home'), site_url('home'));
		$this->breadcrumbs->push( lang('JOBASSIGN::joblist'), site_url('jobassign'));
		/* end */
      $this->load->view('joblist', $data);

  }

function getTimeDiff($dtime,$atime){

 $nextDay=$dtime>$atime?1:0;
 $dep=EXPLODE(':',$dtime);
 $arr=EXPLODE(':',$atime);
 $diff=ABS(MKTIME($dep[0],$dep[1],0,DATE('n'),DATE('j'),DATE('y'))-MKTIME($arr[0],$arr[1],0,DATE('n'),DATE('j')+$nextDay,DATE('y')));
 $hours=FLOOR($diff/(60*60));
 $mins=FLOOR(($diff-($hours*60*60))/(60));
 $secs=FLOOR(($diff-(($hours*60*60)+($mins*60))));
 IF(STRLEN($hours)<2){$hours="0".$hours;}
 IF(STRLEN($mins)<2){$mins="0".$mins;}
 IF(STRLEN($secs)<2){$secs="0".$secs;}
 RETURN $hours.':'.$mins.':'.$secs;
}

  function get_pat_opt_result($pid = NULL, $oid = NULL, $from_date = NULL ,$to_date = NULL){
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
  	$this->load->model('jobassign_model');
 	$results = $this->jobassign_model->get_pat_opt_resultdetails($pid,$oid,$from_date,$to_date);

 	?>
 	<h4 class="widgettitle"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::search_report")) ); ?></h4>
                <div class="widgetcontent nopadding">
               <?php echo anchor($this->lang->mci_current().'/jobassign2/pat_opt_csv/'.$pid."/".$oid."/".$from_date."/".$to_date,lang("JOBASSIGN-REPORT::export_csv"),array('class' => 'btn btn-primary btn-submit export')); ?>
               <?php echo anchor($this->lang->mci_current().'/jobassign2/pat_opt_pdf/'.$pid."/".$oid."/".$from_date."/".$to_date,lang("JOBASSIGN-REPORT::export_pdf"),array('class' => 'btn btn-primary btn-submit export')); ?>
<table  class="table table-bordered responsive">
	<tr></tr>
	<?php if($pid != "null"){ ?>
	<tr>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo ( sprintf( lang("JOBASSIGN-REPORT::pat_name")) ); ?>:</b></td><td> <?php echo $this->common->getpatientsurname($pid); ?></td>
	</tr> <?php } if($oid != "null"){  ?>
	<tr>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo ( sprintf( lang("JOBASSIGN-REPORT::oname")) ); ?>: </b></td><td><?php echo $this->common->getoperatorfirstname($oid); ?> </b></td>
	</tr><?php } ?>
</table>
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
		  <?php if($pid == "null"){ ?>
			<th class="head1"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::pat_name")) ); ?></th>
		  <?php }
		  if($oid == "null"){ ?>
			<th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::pry_operator_name")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::sec_operator_name")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::sup_operator_name")) ); ?></th>
		  <?php } ?>
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::int_name")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::job_day")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::assg_time")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::status")) ); ?></th>
		</thead>
		<tbody>
<?php if (count($results) > 0)
{
 	foreach($results as $result){
 			$req_id = $result->request_id;
    		$pname = $this->common->getpatientsurname($result->patient_id);
			$pry_oid = $this->common->getoperatorfirstname($result->pry_oid);
			$sec_oid = $this->common->getoperatorfirstname($result->sec_oid);
			$sup_id = $this->common->getoperatorfirstname($result->sup_id);
			//$cid = $result->cid;
			$intervent_type_id = $this->common->getinterventname($result->intervent_type_id);
			$week_day = $result->sel_week_day;
			$current_week = $result->current_week;
			$start_time_hour = $this->common->commontimeformat($result->start_time_hour);
			$start_time_min = $this->common->commontimeformat($result->start_time_min);
			$end_time_hour = $this->common->commontimeformat($result->end_time_hour);
			$end_time_min = $this->common->commontimeformat($result->end_time_min);
			$year = date("Y");
			$time = "<b>".lang('from').": </b>".$start_time_hour.":".$start_time_min."&nbsp <br><b>".lang('to').":</b>".$end_time_hour.":".$end_time_min;
			//echo $date = date('M-d, Y', strtotime($year."W".$current_week.$week_day));
			$date = $result->job_date_assign;
			$status = $result->status;
			$diff[] = $this->getTimeDiff($start_time_hour.":".$start_time_min,$end_time_hour.":".$end_time_min);
			?>
			<tr class="gradeX">
		<?php if($pid == "null"){ ?>
		<td><?=$pname?></td>
		<?php } if($oid == "null"){ ?>
		<td><?=$pry_oid?></td>
		<td><?=$sec_oid?></td>
		<td><?=$sup_id?></td> <?php } ?>
		<td><?=$intervent_type_id?></td>
		<td><?=$this->common->datei18tran(strtotime($date))?></td>
		<td><?=$time?></td>
		<td>
			<?php
			if($status == '1'){
				echo lang("JOBASSIGN-REPORT::status_level_pending");
			}elseif($status == '2'){
				echo lang("JOBASSIGN-REPORT::status_level_completed");
			}
			?>
		</td>
		</tr>
		<?php  }
 ?>
		<tr><td colspan="7" style="text-align: right;font-weight: bold;"><?php echo lang("JOBASSIGN-REPORT::total")." = ".$this->times_counter->get_total_time($diff); ?></td></tr>
		<?php
//echo implode(",", $diff);
//$counter = $this->times_counter($diff);

}else{ ?>
<tr><td colspan="6" style="text-align: center;"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::no_data")) ); ?></td></tr>
<?php }  ?>
</tbody>
		</table>
		</div>
<?php
 	}

function pat_opt_csv($pid = NULL, $oid = NULL, $from_date = NULL ,$to_date = NULL){
		header('Content-Type: application/vnd.ms-excel');	//define header info for browser
		header('Content-Disposition: attachment; filename=job_report'.time().'-'.$pid.'-'.$oid.'.xls');
		header('Pragma: no-cache');
		header('Expires: 0');
  	$this->load->model('jobassign_model');
 	$results = $this->jobassign_model->get_pat_opt_resultdetails($pid,$oid,$from_date,$to_date);

 	?>
<table  class="table table-bordered responsive">
	<tr></tr>
	<?php if($pid != "null"){ ?>
	<tr>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo ( sprintf( lang("JOBASSIGN-REPORT::pat_name")) ); ?>:</b></td><td> <?php echo $this->common->getpatientsurname($pid); ?></td>
	</tr> <?php } if($oid != "null"){  ?>
	<tr>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo ( sprintf( lang("JOBASSIGN-REPORT::oname")) ); ?>: </b></td><td><?php echo $this->common->getoperatorfirstname($oid); ?> </b></td>
	</tr><?php } ?>
</table>
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
		 <?php if($pid == "null"){ ?>
			<th class="head1"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::pat_name")) ); ?></th>
		  <?php }
		  if($oid == "null"){ ?>
			<th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::pry_operator_name")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::sec_operator_name")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::sup_operator_name")) ); ?></th>
		  <?php } ?>
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::int_name")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::job_day")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::assg_time")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::status")) ); ?></th>
		</thead>
		<tbody>
<?php if (count($results) > 0)
{
 	foreach($results as $result){
 			$req_id = $result->request_id;
    		$pname = $this->common->getpatientsurname($result->patient_id);
			$pry_oid = $this->common->getoperatorfirstname($result->pry_oid);
			$sec_oid = $this->common->getoperatorfirstname($result->sec_oid);
			$sup_id = $this->common->getoperatorfirstname($result->sup_id);
			//$cid = $result->cid;
			$intervent_type_id = $this->common->getinterventname($result->intervent_type_id);
			$week_day = $result->sel_week_day;
			$current_week = $result->current_week;
			$start_time_hour = $this->common->commontimeformat($result->start_time_hour);
			$start_time_min = $this->common->commontimeformat($result->start_time_min);
			$end_time_hour = $this->common->commontimeformat($result->end_time_hour);
			$end_time_min = $this->common->commontimeformat($result->end_time_min);
			$job_date = $result->job_date_assign;
			$year = date("Y");
			$time = "<b>".lang('from').": </b>".$start_time_hour.":".$start_time_min."<br><b>".lang('to').":</b>".$end_time_hour.":".$end_time_min;
			$date = date('M-d, Y', strtotime($year."W".$current_week.$week_day));
			$status = $result->status;
			?>
			<tr class="gradeX">
		<?php if($pid == "null"){ ?>
		<td><?=$pname?></td>
		<?php } if($oid == "null"){ ?>
		<td><?=$pry_oid?></td>
		<td><?=$sec_oid?></td>
		<td><?=$sup_id?></td> <?php } ?>
		<td><?=$intervent_type_id?></td>
		<td><?=$this->common->datei18tran(strtotime($job_date))?></td>
		<td><?=$time?></td>
		<td>
			<?php
			if($status == '1'){
				echo ( sprintf( lang("JOBASSIGN-REPORT::status_level_pending")) );
			}elseif($status == '2'){
				echo ( sprintf( lang("JOBASSIGN-REPORT::status_level_completed")) );
			}
			?>
		</td>
		</tr>
		<?php  }
}else{ ?>
<tr><td colspan="6" style="text-align: center;"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::no_data")) ); ?></td></tr>
<?php }  ?>
</tbody>
		</table>
<?php
 	}

function pat_opt_pdf($pid = NULL, $oid = NULL, $from_date = NULL ,$to_date = NULL){
	$session_data=$this->session->userdata('logged_in');
		$username=$session_data['username'];
		$this->load->helper('dompdf');
  	$this->load->model('jobassign_model');
	$this->load->model('common');
 	$results = $this->jobassign_model->get_pat_opt_resultdetails($pid,$oid,$from_date,$to_date);
		$cnt = round(count($results) / 25);
		$curent_date = $this->common->datei18tran(strtotime(date("d-m-Y")));

$html = '  <style>
    @page { margin: 180px 50px; }
    #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 50px; text-align: center; }
    #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 50px; border-top: 1px solid #000; }
    #footer .page:after { content: counter(page, upper-roman); }
    .breakAfter{ page-break-after: always; }
  </style>

  <div id="header"><table style="width:100%; font-family: sans-serif;">
	<tr align="center"><td colspan="2" align="center"><h1 style="font-family: sans-serif;">Coopselios SAD</h1></td></tr>';

	$html .= '<tr>
	<td align="left" style="font-family: sans-serif;">
		<table>';
		if($pid != "null"){
		$html .= '<tr><td><b>'.lang("JOBASSIGN-REPORT::pat_name").': </b>'.$this->common->getpatientsurname($pid).'</td></tr>';
		} if($oid != "null"){
		$html .= '<tr><td><b>'.lang("JOBASSIGN-REPORT::oname").': </b>'.$this->common->getoperatorfirstname($oid).'</td></tr>';
		}
		if($from_date != "null" && $to_date != "null"){
		$fdate = date("d-m-Y", strtotime($from_date));
		$tdate = date("d-m-Y", strtotime($to_date));
		$html .= '<tr><td><b>'.lang("from").': </b>'.$fdate.'</td></tr>';
		$html .= '<tr><td><b>'.lang("to").': </b>'.$tdate.'</td></tr>';
		}
		$html .= '</table></td>
	<td align="right" style="font-family: sans-serif; text-align: right;"><h2>'.lang("JOBASSIGN-REPORT::report_title").'</h2></td></tr>';
$html .='</table></div>';

	$html .= '<div id="content"><table style="width:100%;font-family: sans-serif;">
	    <tr align="center" style="background: none repeat scroll 0 0 #333333; color: #FFFFFF; font-size: 10px; font-weight: normal; text-transform: uppercase; font-family: sans-serif;">';
		  if($pid == "null"){
		  $html .='<td><b>'.lang("JOBASSIGN-REPORT::pat_name").'</b></td>';
		  }
		  if($oid == "null"){
		  $html .='<td><b>'.lang("JOBASSIGN-REPORT::pry_operator_name").'</b></td>
		  <td><b>'.lang("JOBASSIGN-REPORT::sec_operator_name").'</b></td>
		  <td><b>'.lang("JOBASSIGN-REPORT::sup_operator_name").'</b></td>';
		  }
		  $html .='<td><b>'.lang("JOBASSIGN-REPORT::int_name").'</b></td>
		  <td><b>'.lang("JOBASSIGN-REPORT::job_day").'</b></td>
		  <td><b>'.lang("JOBASSIGN-REPORT::assg_time").'</b></td>
		  <td><b>'.lang("JOBASSIGN-REPORT::status").'</b></td>
		</tr>';
 if (count($results) > 0)
{
	$i = 0;
	$html .= '<tr style="background-color: #cccccc; font-family: sans-serif; font-size: 8px;">';
 	foreach($results as $result){
 			$req_id = $result->request_id;
    		$pname = $this->common->getpatientsurname($result->patient_id);
			$pry_oid = $this->common->getoperatorfirstname($result->pry_oid);
			$sec_oid = $this->common->getoperatorfirstname($result->sec_oid);
			$sup_id = $this->common->getoperatorfirstname($result->sup_id);
			$intervent_type_id = $this->common->getinterventname($result->intervent_type_id);
			$week_day = $result->sel_week_day;
			$current_week = $result->current_week;
			$start_time_hour = $this->common->commontimeformat($result->start_time_hour);
			$start_time_min = $this->common->commontimeformat($result->start_time_min);
			$end_time_hour = $this->common->commontimeformat($result->end_time_hour);
			$end_time_min = $this->common->commontimeformat($result->end_time_min);
			$job_date = $result->job_date_assign;
			$year = date("Y");
			$time = "<b>".lang('from').": </b>".$start_time_hour.":".$start_time_min."<br><b>".lang('to').": </b>".$end_time_hour.":".$end_time_min;
			$date1 = date("M-d, Y", strtotime($year."W".$current_week.$week_day));
			$date = $this->common->datei18tran(strtotime($date1));
			$status = $result->status;

		if($i % 2 == 0){
			 $style_class = 'style="background-color: #cccccc; font-family: sans-serif; font-size: 8px;"';
		}else{
			 $style_class = 'style="background-color: #ffffff; font-family: sans-serif; font-size: 8px;"';
		}

		if ($i && $i % 25== 0){
		$html .= '</tr></table><div id="footer">
    <p>Stampato il: '.$curent_date.'&nbsp;'.date("H:i").'&nbsp;&nbsp;&nbsp; da '.$username.' Page <span class="page"></span>/'.$cnt.'</p>
  </div><div class="breakAfter"></div><table style="width:100%;font-family: sans-serif;">
  <tr align="center" style="background: none repeat scroll 0 0 #333333; color: #FFFFFF; font-size: 10px; font-weight: normal; text-transform: uppercase; font-family: sans-serif;">';
		  if($pid == "null"){
		  $html .='<td><b>'.lang("JOBASSIGN-REPORT::pat_name").'</b></td>';
		  }
		  if($oid == "null"){
		  $html .='<td><b>'.lang("JOBASSIGN-REPORT::pry_operator_name").'</b></td>
		  <td><b>'.lang("JOBASSIGN-REPORT::sec_operator_name").'</b></td>
		  <td><b>'.lang("JOBASSIGN-REPORT::sup_operator_name").'</b></td>';
		  }
		  $html .='<td><b>'.lang("JOBASSIGN-REPORT::int_name").'</b></td>
		  <td><b>'.lang("JOBASSIGN-REPORT::job_day").'</b></td>
		  <td><b>'.lang("JOBASSIGN-REPORT::assg_time").'</b></td>
		  <td><b>'.lang("JOBASSIGN-REPORT::status").'</b></td>
		</tr>
  <tr '.$style_class.'>'; }
   			 else if ($i) {
        $html .= '</tr><tr '.$style_class.'>'; }
		 if($pid == "null"){
		$html .= '<td>'.$pname.'</td>';
		 }
		 if($oid == "null"){
		$html .= '<td>'.$pry_oid.'</td>
		<td>'.$sec_oid.'</td>
		<td>'.$sup_id.'</td>';
		 }
		$html .= '<td>'.$intervent_type_id.'</td>
		<td align="center">'.$this->common->datei18tran(strtotime($job_date)).'</td>
		<td>'.$time.'</td>';
		if($status == '1'){
			$html .='<td><b>'.lang("JOBASSIGN-REPORT::status_level_pending").'</b></td>';
		}elseif($status == '2'){
			$html .='<td><b>'.lang("JOBASSIGN-REPORT::status_level_completed").'</b></td>';
		}
		$html .= '</tr>';
		$i++;
		  }
}else{
$html .= '<tr><td colspan="6" style="text-align: center;">'. lang("JOBASSIGN-REPORT::no_data").'</td></tr>';
 }
$html .= '</table></div>';

$html .='<div id="footer">
    <p>Stampato il: '.$curent_date.'&nbsp;'.date("H:i").'&nbsp;&nbsp;&nbsp; da '.$username.' Page <span class="page"></span>/'.$cnt.'</p>

  </div>';
$filename = "job_assign_pdf".time();
pdf_create($html, $filename);
 	}


function get_week_report_result($startDate = NULL, $endDate = NULL, $oid = NULL){

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
  	$this->load->model('jobassign_model');
 	$results = $this->jobassign_model->get_week_resultdetails($startDate, $endDate, $oid);

 	?>
 	<h4 class="widgettitle"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::search_report")) ); ?></h4>
                <div class="widgetcontent nopadding">
               <?php echo anchor($this->lang->mci_current().'/jobassign2/week_rep_csv/'.$startDate."/".$endDate."/".$oid,lang("JOBASSIGN-REPORT::export_csv"),array('class' => 'btn btn-primary btn-submit export')); ?>
               <?php echo anchor($this->lang->mci_current().'/jobassign2/week_rep_pdf/'.$startDate."/".$endDate."/".$oid,lang("JOBASSIGN-REPORT::export_pdf"),array('class' => 'btn btn-primary btn-submit export')); ?>
<table  class="table table-bordered responsive">
	<tr></tr>
	<?php if($oid != "null"){  ?>
	<tr>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo ( sprintf( lang("JOBASSIGN-REPORT::oname")) ); ?>: </b></td><td colspan="3"><?php echo $this->common->getoperatorfirstname($oid); ?> </b></td>
	</tr><?php } ?>
	<tr>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo ( sprintf( lang("from")) ); ?>: </b></td><td><?php echo $startDate; ?> </b></td>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo ( sprintf( lang("to")) ); ?>: </b></td><td><?php echo $endDate; ?> </b></td>
	</tr>
</table>
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
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::req_no")) ); ?></th>
		  <?php if($oid == "null"){ ?>
			<th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-WEEK-REPORT::operator_name")) ); ?></th>
		  <?php } ?>
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-WEEK-REPORT::total_hours")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-WEEK-REPORT::hours_contract")) ); ?></th>
		</thead>
		<tbody>
<?php if (count($results) > 0)
{
	$i = 1;
 	foreach($results as $result){
 			$oname = $this->common->getoperatorfirstname($result->oid);
 			$duration = $result->totalhours;
			$hours_contract = $result->hours_contract;
			?>
			<tr class="gradeX">
		<td><?=$i?></td>
		<?php if($oid == "null"){ ?>
		<td><?=$oname?></td> <?php } ?>
		<td><?=$duration?></td>
		<td><?=$hours_contract?></td>
		</tr>
		<?php $i++;  }
}else{ ?>
<tr><td colspan="3" style="text-align: center;"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::no_data")) ); ?></td></tr>
<?php }  ?>
</tbody>
		</table>
		</div>
<?php
 	}

function week_rep_csv($startDate = NULL, $endDate = NULL, $oid = NULL){
		header('Content-Type: application/vnd.ms-excel');	//define header info for browser
		header('Content-Disposition: attachment; filename=job_report'.time().'.xls');
		header('Pragma: no-cache');
		header('Expires: 0');
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
  	$this->load->model('jobassign_model');
 	$results = $this->jobassign_model->get_week_resultdetails($startDate, $endDate, $oid);

 	?>
 	<h4 class="widgettitle"><?php echo ( sprintf( lang("LEFTMENU::jobassign_week_report")) ); ?></h4>
                <div class="widgetcontent nopadding">

<table  class="table table-bordered responsive">
	<tr></tr>
	<?php if($oid != "null"){  ?>
	<tr>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo ( sprintf( lang("JOBASSIGN-REPORT::oname")) ); ?>: </b></td><td><?php echo $this->common->getoperatorfirstname($oid); ?> </b></td>
	</tr><?php } ?>
</table>
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
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::req_no")) ); ?></th>
		  <?php if($oid == "null"){ ?>
			<th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-WEEK-REPORT::operator_name")) ); ?></th>
		  <?php } ?>
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-WEEK-REPORT::total_hours")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-WEEK-REPORT::hours_contract")) ); ?></th>
		</thead>
		<tbody>
<?php if (count($results) > 0)
{
	$i = 1;
 	foreach($results as $result){
 			$oname = $this->common->getoperatorfirstname($result->oid);
 			$duration = $result->totalhours;
 			$hours_contract = $result->hours_contract;
			?>
			<tr class="gradeX">
		<td><?=$i?></td>
		<?php if($oid == "null"){ ?>
		<td><?=$oname?></td> <?php } ?>
		<td><?=$duration?></td>
		<td><?=$hours_contract?></td>
		</tr>
		<?php $i++;  }
}else{ ?>
<tr><td colspan="3" style="text-align: center;"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::no_data")) ); ?></td></tr>
<?php }  ?>
</tbody>
		</table>
		</div>
<?php
 	}


function week_rep_pdf($startDate = NULL, $endDate = NULL, $oid = NULL){
	$session_data=$this->session->userdata('logged_in');
	$username=$session_data['username'];
	$this->load->helper('dompdf');
  	$this->load->model('jobassign_model');
	$this->load->model('common');
 	$results = $this->jobassign_model->get_week_resultdetails($startDate, $endDate, $oid);

	$cnt = round(count($results) / 10);
	$curent_date = $this->common->datei18tran(strtotime(date("d-m-Y")));
$html = '  <style>
    @page { margin: 180px 50px; }
    #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 50px; text-align: center; }
    #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 50px; border-top: 1px solid #000; }
    #footer .page:after { content: counter(page, upper-roman); }
    .breakAfter{ page-break-after: always; }
  </style>

  <div id="header"><table style="width:100%; font-family: sans-serif;">
	<tr align="center"><td colspan="2" align="center"><h1 style="font-family: sans-serif;">Coopselios SAD</h1></td></tr>';

	$html .= '<tr>
	<td align="left" style="font-family: sans-serif;">
		<table>';
		if($oid != "null"){
		$html .= '<tr><td><b>'.lang("JOBASSIGN-REPORT::oname").': </b>'.$this->common->getoperatorfirstname($oid).'</td></tr>';
		}
		$html .= '</table></td>
	<td align="right" style="font-family: sans-serif; text-align: right;"><h2>'.lang("LEFTMENU::jobassign_week_report").'</h2></td></tr>';
$html .='</table></div>';

	$html .= '<div id="content"><table style="width:100%;font-family: sans-serif;">
	    <tr align="center" style="background: none repeat scroll 0 0 #333333; color: #FFFFFF; font-size: 10px; font-weight: normal; text-transform: uppercase; font-family: sans-serif;">
		  <td><b>'.lang("JOBASSIGN-REPORT::req_no").'</b></td>';
		  if($oid == "null"){
		  $html .='<td><b>'.lang("JOBASSIGN-WEEK-REPORT::operator_name").'</b></td>';
		  }
		  $html .='<td><b>'.lang("JOBASSIGN-WEEK-REPORT::total_hours").'</b></td>
		  <td><b>'.lang("JOBASSIGN-WEEK-REPORT::hours_contract").'</b></td>
		</tr>';
 if (count($results) > 0)
{
	$i = 0;
	$html .= '<tr style="background-color: #cccccc; font-family: sans-serif; font-size: 10px;">';
 	foreach($results as $result){
 			$oname = $this->common->getoperatorfirstname($result->oid);
 			$duration = $result->totalhours;
			$hours_contract = $result->hours_contract;

		if($i % 2 == 0){
			 $style_class = 'style="background-color: #cccccc; font-family: sans-serif; font-size: 10px;"';
		}else{
			 $style_class = 'style="background-color: #ffffff; font-family: sans-serif; font-size: 10px;"';
		}

		if ($i && $i % 10== 0){
		$html .= '</tr></table><div id="footer">
    <p>Stampato il: '.$curent_date.'&nbsp;'.date("H:i").'&nbsp;&nbsp;&nbsp; da '.$username.' Page <span class="page"></span>/'.$cnt.'</p>
  </div><div class="breakAfter"></div><table style="width:100%;font-family: sans-serif;">
  <tr align="center" style="background: none repeat scroll 0 0 #333333; color: #FFFFFF; font-size: 10px; font-weight: normal; text-transform: uppercase; font-family: sans-serif;">
		  <td><b>'.lang("JOBASSIGN-REPORT::req_no").'</b></td>';
		  if($oid == "null"){
		  $html .='<td><b>'.lang("JOBASSIGN-WEEK-REPORT::operator_name").'</b></td>';
		  }
		  $html .='<td><b>'.lang("JOBASSIGN-WEEK-REPORT::total_hours").'</b></td>
		  <td><b>'.lang("JOBASSIGN-WEEK-REPORT::hours_contract").'</b></td>
		</tr>
  <tr '.$style_class.'>'; }
   			 else if ($i) {
        $html .= '</tr><tr '.$style_class.'>'; }

		$html .= '<td>'.($i+1).'</td>';

		 if($oid == "null"){
		$html .= '<td>'.$oname.'</td>';
		 }
		$html .= '<td align="center">'.$duration.'</td>
		<td align="center">'.$hours_contract.'</td>
		</tr>';
		$i++;
		  }
}else{
$html .= '<tr><td colspan="3" style="text-align: center;">'. lang("JOBASSIGN-REPORT::no_data").'</td></tr>';
 }
$html .= '</table></div>';

$html .='<div id="footer">
    <p>Stampato il: '.$curent_date.'&nbsp;'.date("H:i").'&nbsp;&nbsp;&nbsp; da '.$username.' Page <span class="page"></span>/'.$cnt.'</p>

  </div>';
$filename = "job_assign_week_pdf".time();

pdf_create($html, $filename);
 	}



function get_km_report_result($startDate = NULL, $endDate = NULL, $oid = NULL){

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
  	$this->load->model('jobassign_model');
 	$results = $this->jobassign_model->get_km_plannedresultdetails($startDate, $endDate, $oid);

 	?>
 	<h4 class="widgettitle"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::search_report")) ); ?></h4>
                <div class="widgetcontent nopadding">
               <?php echo anchor($this->lang->mci_current().'/jobassign2/get_km_excel_report_result/'.$startDate."/".$endDate."/".$oid,lang("JOBASSIGN-REPORT::export_csv"),array('class' => 'btn btn-primary btn-submit export')); ?>
               <?php echo anchor($this->lang->mci_current().'/jobassign2/month_km_rep_pdf/'.$startDate."/".$endDate."/".$oid,lang("JOBASSIGN-REPORT::export_pdf"),array('class' => 'btn btn-primary btn-submit export')); ?>
<table  class="table table-bordered responsive">
	<tr></tr>
	<?php if($oid != "null"){  ?>
	<tr>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo ( sprintf( lang("JOBASSIGN-REPORT::oname")) ); ?>: </b></td><td colspan="2"><?php echo $this->common->getoperatorfirstname($oid); ?> </b></td>
	</tr><?php }
	if($startDate != 'null' && $endDate != "null"){
	?>
	<tr>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo ( sprintf( lang("from")) ); ?>: </b></td><td><?php echo $startDate; ?> </b></td>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo ( sprintf( lang("to")) ); ?>: </b></td><td><?php echo $endDate; ?> </b></td>
	</tr><?php } ?>
</table>
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
		  <th class="head0"><?php echo ( sprintf( lang("MONTH::date")) ); ?></th>
			<th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-KM-REPORT::start_address")) ); ?></th>
			<th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-KM-REPORT::goal_address")) ); ?></th>
			<th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-KM-REPORT::patient_name")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-KM-REPORT::planned_km")) ); ?></th>
		  <!--<th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-KM-REPORT::real_km")) ); ?></th>-->
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-KM-REPORT::estimated_time")) ); ?></th>

		</thead>
		<tbody>
<?php if (count($results) > 0)
{
	$i = 1;
	$total_km = "0";
	$total_real_km = "0";
	$from = $this->common->getoptdefaultaddress($oid);
 	foreach($results as $result){
 		$aid = $result->aid;
 			$request_id = $result->request_id;
			$pid = $result->patient_id;
			$real_km = $this->jobassign_model->get_km_realdetails($aid,$oid,$pid);
			$total_real_km += $real_km;
 			$entry_date = date("d/m/Y", strtotime($result->job_date_assign));
			$address = $result->address;
			$to = $from;
			$from = $address;
			$to_rep = str_replace(" ", "+", str_replace(",", "+", $to));
			$from_rep = str_replace(" ", "+", str_replace(",", "+", $from));
			$get_address = $to_rep."&destinations=".$from_rep;
			$km = $this->common->GetKM($get_address);
			$time=  $this->common->GetEstimateTime($get_address);
			$total_km += $km;
			?>
			<tr class="gradeX">
		<td><?=$entry_date?></td>
		<td><?php echo $to; ?></td>
		<td><?php echo $from; ?></td>
		<td><?php echo $this->common->getpatientname($pid); ?></td>
		<td><?php echo $km; ?></td>
		<!--<td><?php echo $real_km; ?></td>-->
		<td><?php echo $time; ?></td>
		</tr>
		<?php $i++;  } ?>
		<tr><td colspan="4"><b style="float: right;"><?php echo ( sprintf( lang("JOBASSIGN-KM-REPORT::total_dist")) ); ?></b></td><td><b><?php echo $total_km." km"; ?></b></td>
			<!--<td><b><?php echo $total_real_km." km";?></b></td>--></tr>

<?php }else{ ?>
<tr><td colspan="3" style="text-align: center;"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::no_data")) ); ?></td></tr>
<?php }  ?>
</tbody>
		</table>
		</div>
<?php
 	}

function get_km_excel_report_result($startDate = NULL, $endDate = NULL, $oid = NULL){
		header('Content-Type: application/vnd.ms-excel');	//define header info for browser
		header('Content-Disposition: attachment; filename=job_month_report'.time().'.xls');
		header('Pragma: no-cache');
		header('Expires: 0');
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
  	$this->load->model('jobassign_model');
 	$results = $this->jobassign_model->get_km_plannedresultdetails($startDate, $endDate, $oid);

 	?>
 	<h4 class="widgettitle"><?php echo ( sprintf( lang("JOBASSIGN-KM-REPORT::km_opt_usg")) ); ?></h4>
                <div class="widgetcontent nopadding">

<table  class="table table-bordered responsive">
	<tr></tr>
	<?php if($oid != "null"){  ?>
	<tr>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo ( sprintf( lang("JOBASSIGN-REPORT::oname")) ); ?>: </b></td><td colspan="2"><?php echo $this->common->getoperatorfirstname($oid); ?> </b></td>
	</tr><?php }
	if($startDate != 'null' && $endDate != "null"){
	?>
	<tr>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo ( sprintf( lang("from")) ); ?>: </b></td><td><?php echo $startDate; ?> </b></td>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo ( sprintf( lang("to")) ); ?>: </b></td><td><?php echo $endDate; ?> </b></td>
	</tr><?php } ?>
</table>
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
		  <th class="head0"><?php echo ( sprintf( lang("MONTH::date")) ); ?></th>
			<th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-KM-REPORT::start_address")) ); ?></th>
			<th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-KM-REPORT::goal_address")) ); ?></th>
			<th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-KM-REPORT::patient_name")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-KM-REPORT::planned_km")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("JOBASSIGN-KM-REPORT::estimated_time")) ); ?></th>
		</thead>
		<tbody>
<?php if (count($results) > 0)
{
	$i = 1;
	$total_km = "0";
	$total_real_km = "0";
	$from = $this->common->getoptdefaultaddress($oid);
 	foreach($results as $result){
 		$aid = $result->aid;
 			$request_id = $result->request_id;
			$pid = $result->patient_id;
			$real_km = $this->jobassign_model->get_km_realdetails($aid,$oid,$pid);
			$total_real_km += $real_km;
 			$entry_date = date("d/m/Y", strtotime($result->job_date_assign));
			$address = $result->address;
			$to = $from;
			$from = $address;
			$to_rep = str_replace(" ", "+", str_replace(",", "+", $to));
			$from_rep = str_replace(" ", "+", str_replace(",", "+", $from));
			$get_address = $to_rep."&destinations=".$from_rep;
			$km = $this->common->GetKM($get_address);
			$total_km += $km;
			$time=  $this->common->GetEstimateTime($get_address);
			?>
			<tr class="gradeX">
		<td><?=$entry_date?></td>
		<td><?php echo $to; ?></td>
		<td><?php echo $from; ?></td>
		<td><?php echo $this->common->getpatientname($pid); ?></td>
		<td><?php echo $km; ?></td>
		<td><?php echo $time; ?></td>
		</tr>
		<?php $i++;  } ?>
		<tr><td colspan="4"><b style="float: right;"><?php echo ( sprintf( lang("JOBASSIGN-KM-REPORT::total_dist")) ); ?></b></td><td><b><?php echo $total_km." km"; ?></b></td></tr>

<?php }else{ ?>
<tr><td colspan="3" style="text-align: center;"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::no_data")) ); ?></td></tr>
<?php }  ?>
</tbody>
		</table>
		</div>
<?php
 	}


function month_km_rep_pdf($startDate = NULL, $endDate = NULL, $oid = NULL){
	$session_data=$this->session->userdata('logged_in');
	$username=$session_data['username'];
	$this->load->helper('dompdf');
  	$this->load->model('jobassign_model');
	$this->load->model('common');
 	$results = $this->jobassign_model->get_km_plannedresultdetails($startDate, $endDate, $oid);

	$cnt = round(count($results) / 20);
	$curent_date = $this->common->datei18tran(strtotime(date("d-m-Y")));
$html = '  <style>
    @page { margin: 180px 50px; }
    #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 50px; text-align: center; }
    #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 50px; border-top: 1px solid #000; }
    #footer .page:after { content: counter(page, upper-roman); }
    .breakAfter{ page-break-after: always; }
  </style>

  <div id="header"><table style="width:100%; font-family: sans-serif;">
	<tr align="center"><td colspan="2" align="center"><h1 style="font-family: sans-serif;">Coopselios SAD</h1></td></tr>';

	$html .= '<tr>
	<td align="left" style="font-family: sans-serif;">
		<table>';
		if($oid != "null"){
		$html .= '<tr><td><b>'.lang("JOBASSIGN-REPORT::oname").': </b>'.$this->common->getoperatorfirstname($oid).'</td></tr>';
		}
		$html .= '</table></td>
	<td align="right" style="font-family: sans-serif; text-align: right;"><h2>'.lang("JOBASSIGN-KM-REPORT::km_opt_usg").'</h2></td></tr>';
$html .='</table></div>';

	$html .= '<div id="content"><table style="width:100%;font-family: sans-serif;">
	    <tr align="center" style="background: none repeat scroll 0 0 #333333; color: #FFFFFF; font-size: 10px; font-weight: normal; text-transform: uppercase; font-family: sans-serif;">
		  <td><b>'. lang("MONTH::date") .'</b></td>';
		  $html .='<td><b>'.lang("JOBASSIGN-KM-REPORT::start_address").'</b></td>
		  <td><b>'.lang("JOBASSIGN-KM-REPORT::goal_address").'</b></td>
		  <td><b>'.lang("JOBASSIGN-KM-REPORT::patient_name").'</b></td>
		  <td><b>'.lang("JOBASSIGN-KM-REPORT::planned_km").'</b></td>
		  <td><b>'.lang("JOBASSIGN-KM-REPORT::estimated_time").'</b></td>
		</tr>';
 if (count($results) > 0)
{
	$i = 0;
	$html .= '<tr style="background-color: #cccccc; font-family: sans-serif; font-size: 10px;">';

	$total_km = "0";
	$total_real_km = "0";
	$from = $this->common->getoptdefaultaddress($oid);
 	foreach($results as $result){
 		$aid = $result->aid;
 			$request_id = $result->request_id;
			$pid = $result->patient_id;
			$real_km = $this->jobassign_model->get_km_realdetails($aid,$oid,$pid);
			$total_real_km += $real_km;
 			$entry_date = date("d/m/Y", strtotime($result->job_date_assign));
			$address = $result->address;
			$to = $from;
			$from = $address;
			$to_rep = str_replace(" ", "+", str_replace(",", "+", $to));
			$from_rep = str_replace(" ", "+", str_replace(",", "+", $from));
			$get_address = $to_rep."&destinations=".$from_rep;
			$km = $this->common->GetKM($get_address);
			$total_km += $km;
			$time=  $this->common->GetEstimateTime($get_address);

		if($i % 2 == 0){
			 $style_class = 'style="background-color: #cccccc; font-family: sans-serif; font-size: 10px;"';
		}else{
			 $style_class = 'style="background-color: #ffffff; font-family: sans-serif; font-size: 10px;"';
		}

		if ($i && $i % 20== 0){
		$html .= '</tr></table><div id="footer">
    <p>Stampato il: '.$curent_date.'&nbsp;'.date("H:i").'&nbsp;&nbsp;&nbsp; da '.$username.' Page <span class="page"></span>/'.$cnt.'</p>
  </div><div class="breakAfter"></div><table style="width:100%;font-family: sans-serif;">
  <tr align="center" style="background: none repeat scroll 0 0 #333333; color: #FFFFFF; font-size: 10px; font-weight: normal; text-transform: uppercase; font-family: sans-serif;">
		  <td><b>'.lang("MONTH::date").'</b></td>';
		  $html .='<td><b>'.lang("JOBASSIGN-KM-REPORT::start_address").'</b></td>
		  <td><b>'.lang("JOBASSIGN-KM-REPORT::goal_address").'</b></td>
		  <td><b>'.lang("JOBASSIGN-KM-REPORT::patient_name").'</b></td>
		  <td><b>'.lang("JOBASSIGN-KM-REPORT::planned_km").'</b></td>
		  <td><b>'.lang("JOBASSIGN-KM-REPORT::estimated_time").'</b></td>
		</tr>
  <tr '.$style_class.'>'; }
   			 else if ($i) {
        $html .= '</tr><tr '.$style_class.'>'; }

		$html .= '<td>'.$entry_date.'</td>';

		$html .= '<td>'.$to.'</td>
		<td>'.$from.'</td>
		<td>'.$this->common->getpatientname($pid).'</td>
		<td>'.$km.'</td>
		<td>'.$time.'</td>
		</tr>';
		$i++;
		  }
$html .= '<tr><td colspan="4"><b style="float: right;">'.lang("JOBASSIGN-KM-REPORT::total_dist").'</b></td><td><b>'.$total_km.' km</b></td></tr>';

}else{
$html .= '<tr><td colspan="3" style="text-align: center;">'. lang("JOBASSIGN-REPORT::no_data").'</td></tr>';
 }
$html .= '</table></div>';

$html .='<div id="footer">
    <p>Stampato il: '.$curent_date.'&nbsp;'.date("H:i").'&nbsp;&nbsp;&nbsp; da '.$username.' Page <span class="page"></span>/'.$cnt.'</p>

  </div>';
$filename = "job_month_report_pdf_".time();

pdf_create($html, $filename);
 	}



function weekly_fortnightly_report()
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
		$this->breadcrumbs->push( lang('JOBASSIGN-WF::week_fortnight_report'), site_url('jobassign2/weekly_fortnightly_report'));
		/* end */
	  $this->load->view('weekly_fortnightly_report', $data);
  }

public function get_weekly_fortnightly_report($report_type, $weekno,$year,$view_type, $district)
{
	$this->load->model('jobassign_model');
	if($view_type == '1'){
		$diff = 'style=""';
		$diff2 = 'style=""';
	}elseif($view_type == '2'){
		$diff = 'style=""';
		$diff2 = 'style="display:none"';
	}elseif($view_type == '3'){
		$diff = 'style="display:none"';
		$diff2 = 'style=""';
	}
	?>

<div class="widgetcontent nopadding">
	<table id="dyntable" class="table table-bordered responsive">
	<thead>
		<th class="head0"><?php echo lang("JOBASSIGN-WF::patient"); ?></th>
		<th class="head0"><?php echo lang("JOBASSIGN-WF::no_of_contract_set"); ?></th>
		<th class="head0"><?php echo lang("JOBASSIGN-WF::no_of_planned_job"); ?></th>
		<th class="head0" <?=$diff?>><?php echo lang("JOBASSIGN-WF::difference"); ?></th>
		<th class="head0" <?=$diff2?>><?php echo lang("JOBASSIGN-WF::more_than_contract_job"); ?></th>
	</thead>
		<tbody>
		<?php $fdata = $this->jobassign_model->getweekfortnightly($report_type,$weekno,$year,$district);
		foreach($fdata as $fetchdata){
			$pid = $this->common->getpatientname($fetchdata->pid);
			$planned_job = $fetchdata->planned_job;
			if($report_type == '2'){
				$total_contract = '1';
				if($planned_job > 0){
					$difference = "0";
				}else{
					$difference = "1";
				}
			}else{
				$total_contract = $fetchdata->total_contract;
				$difference = $fetchdata->difference;
			}

			if($planned_job > $total_contract){
				$more_difference = $planned_job - $total_contract;
			}else{
				$more_difference = '0';
			}
			if($view_type == '2'){
				if($difference == '0'){
					$md = 'style="display:none"';
				}else{
					$md = "";
				}
			}elseif($view_type == '3'){
				if($more_difference == '0'){
					$md = 'style="display:none"';
				}else{
					$md = '';
				}
			}else{
				$md = '';
			}
			?>
			<tr <?=$md?>>
				<td><?=$pid?></td>
				<td><center><?=$total_contract?></center></td>
				<td><center><?=$planned_job?></center></td>
				<td <?=$diff?>><center><?=$difference?></center></td>
				<td <?=$diff2?>><center><?=$more_difference?></center></td>
			</tr>
		<?php }
		?>
		</tbody>
	</table>
	</div>
	<?php
}

public function call_report_availibiity()
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
		$this->breadcrumbs->push( lang('CALL-REPORT::title'), site_url('jobassign2/call_report_availibiity'));
		/* end */
	  $this->load->view('call_report_availibiity', $data);
	//echo $fdate."--".$tdate."--".$ftime."--".$ttime;
}

function getAllDatesBetweenTwoDates($strDateFrom,$strDateTo)
{
    $aryRange=array();

    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

    if ($iDateTo>=$iDateFrom)
    {
        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
        while ($iDateFrom<$iDateTo)
        {
            $iDateFrom+=86400; // add 24 hours
            array_push($aryRange,date('Y-m-d',$iDateFrom));
        }
    }
    return $aryRange;
}

function get_call_report_result($strDateFrom = NULL, $strDateTo = NULL, $fhour = NULL, $thour = NULL, $fmincombo = NULL, $tmincombo = NULL){
  		?>
  		 	<h4 class="widgettitle"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::search_report")) ); ?></h4>
                <div class="widgetcontent nopadding">
               <?php echo anchor($this->lang->mci_current().'/jobassign2/get_xls_call_report_result/'.$strDateFrom."/".$strDateTo."/".$fhour."/".$thour."/".$fmincombo."/".$tmincombo,lang("JOBASSIGN-REPORT::export_csv"),array('class' => 'btn btn-primary btn-submit export')); ?>
               <?php echo anchor($this->lang->mci_current().'/jobassign2/get_pdf_call_report_result/'.$strDateFrom."/".$strDateTo."/".$fhour."/".$thour."/".$fmincombo."/".$tmincombo,lang("JOBASSIGN-REPORT::export_pdf"),array('class' => 'btn btn-primary btn-submit export')); ?>
<table  class="table table-bordered responsive">
	<tr></tr>
	<?php
	if($startDate != 'null' && $endDate != "null"){
	?>
	<tr></div>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo lang("from")." ".lang("MONTH::date"); ?>: </b></td><td><?php echo date("d-m-Y", strtotime($strDateFrom)); ?> </b></td>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo lang("to")." ".lang("MONTH::date"); ?>: </b></td><td><?php echo date("d-m-Y", strtotime($strDateTo)); ?> </b></td>
	</tr><?php } ?>
	<?php
	if($fhour != 'null' && $thour != "null"){
	?>
	<tr>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo lang("from")." ".lang("CALL-REPORT::time"); ?>: </b></td><td><?php echo $this->common->commontimeformat($fhour).":".$this->common->commontimeformat($fmincombo); ?> </b></td>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo lang("to")." ".lang("CALL-REPORT::time"); ?>: </b></td><td><?php echo $this->common->commontimeformat($thour).":".$this->common->commontimeformat($tmincombo); ?> </b></td>
	</tr>
	<?php } ?>
</table>
	<table id="dyntable" class="table table-bordered responsive cursorpoint">
		<tbody>
  		<?php
  	$this->load->model('jobassign_model');
	$startdate = date("Y-m-d", strtotime($strDateFrom));
	$enddate = date("Y-m-d", strtotime($strDateTo));
	$dateArray = $this->getAllDatesBetweenTwoDates($startdate, $enddate);
	$aoid = array();
foreach($dateArray as $dates){ ?>
		<tr style="background: #ccc;"><td><b><?php echo lang("MONTH::date")." : ".date("d-m-Y", strtotime($dates)); ?></b></td></tr>
		<?php
		$sel_opt = mysql_query("select oid,firstname,lastname from operators order by lastname ASC");
		$cnt_opt = mysql_num_rows($sel_opt);
		if($cnt_opt > 0){
		while($fet = mysql_fetch_assoc($sel_opt)){
			$noid = $fet['oid'];
			$ress = $this->check_optweek_availabelnew($noid,$dates, $fhour, $thour, $fmincombo, $tmincombo);
			$firstname = $fet['lastname']." ".$fet['firstname'];
			if($ress != $noid ){ ?>
			<tr><td><?=$ress?><?php echo $firstname; ?></td></tr>
			<?php } ?>
		<?php } }else{ ?>
			<tr><td><?php echo lang("CALL-REPORT::all_operator_busy"); ?></td></tr>
		<?php }
}
?>
</tbody>
</table>
<?php unset($aoid); ?>
		</div>
<?php
 	}


function get_xls_call_report_result($strDateFrom = NULL, $strDateTo = NULL, $fhour = NULL, $thour = NULL, $fmincombo = NULL, $tmincombo = NULL){
		header('Content-Type: application/vnd.ms-excel');	//define header info for browser
		header('Content-Disposition: attachment; filename=call_report_result'.time().'.xls');
		header('Pragma: no-cache');
		header('Expires: 0');
  		?>
  		 	<h4 class="widgettitle"><?php echo ( sprintf( lang("JOBASSIGN-REPORT::search_report")) ); ?></h4>
                <div class="widgetcontent nopadding">
<table  class="table table-bordered responsive">
	<tr></tr>
	<?php
	if($startDate != 'null' && $endDate != "null"){
	?>
	<tr>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo lang("from")." ".lang("MONTH::date"); ?>: </b></td><td><?php echo date("d-m-Y", strtotime($strDateFrom)); ?> </b></td>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo lang("to")." ".lang("MONTH::date"); ?>: </b></td><td><?php echo date("d-m-Y", strtotime($strDateTo)); ?> </b></td>
	</tr><?php } ?>
		<?php
	if($fhour != 'null' && $thour != "null"){
	?>
	<tr>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo lang("from")." ".lang("CALL-REPORT::time"); ?>: </b></td><td><?php echo $this->common->commontimeformat($fhour).":".$this->common->commontimeformat($fmincombo); ?> </b></td>
		<td style="width: 320px; padding-left: 8px;"><b><?php echo lang("to")." ".lang("CALL-REPORT::time"); ?>: </b></td><td><?php echo $this->common->commontimeformat($thour).":".$this->common->commontimeformat($tmincombo); ?> </b></td>
	</tr>
	<?php } ?>
</table><br><br>
	<table id="dyntable" class="table table-bordered responsive">
		<tbody>
  		<?php
  	$this->load->model('jobassign_model');
	$startdate = date("Y-m-d", strtotime($strDateFrom));
	$enddate = date("Y-m-d", strtotime($strDateTo));
$dateArray = $this->getAllDatesBetweenTwoDates($startdate, $enddate);
$aoid = array();
foreach($dateArray as $dates){
	$results = $this->jobassign_model->get_call_report_data_pdf($dates, $fhour, $thour, $fmincombo, $tmincombo);
	if(empty($results)){
		?>
		<tr style="background: #ccc;"><td><b><?php echo lang("MONTH::date")." : ".date("d-m-Y", strtotime($dates)); ?></b></td></tr>
		<?php
		$sel_opt = mysql_query("select oid,firstname,lastname from operators order by firstname ASC");
		$cnt_opt = mysql_num_rows($sel_opt);
		if($cnt_opt > 0){
		while($fet = mysql_fetch_assoc($sel_opt)){
			$firstname = $fet['firstname']." ".$fet['lastname']; ?>
			<tr><td><?php echo $firstname; ?></td></tr>
		<?php } }else{ ?>
			<tr><td><?php echo lang("CALL-REPORT::all_operator_busy"); ?></td></tr>
		<?php }
	}else{
	if($results[0]->job_date_assign != ""){
		if($results[0]->pry_oid != '0'){ $aoid[] = "'".$results[0]->pry_oid; }
		if($results[0]->sec_oid != '0'){ $aoid[] = "'".$results[0]->sec_oid; }
		if($results[0]->sup_id != '0'){ $aoid[] = "'".$results[0]->sup_id; }
		$toid = implode("',", $aoid)."'"; ?>
		<tr style="background: #ccc;"><td><b><?php echo lang("MONTH::date")." : ".date("d-m-Y", strtotime($dates)); ?></b></td></tr>
		<?php
		$sel_opt = mysql_query("select oid,firstname,lastname from operators where oid NOT IN($toid) order by firstname ASC");
		$cnt_opt = mysql_num_rows($sel_opt);
		if($cnt_opt > 0){
		while($fet = mysql_fetch_assoc($sel_opt)){
			$firstname = $fet['firstname']." ".$fet['lastname']; ?>
			<tr><td><?php echo $firstname; ?></td></tr>
		<?php } }else{ ?>
			<tr><td><?php echo lang("CALL-REPORT::all_operator_busy"); ?></td></tr>
		<?php } ?>

	<?php } }
}
?>
</tbody>
</table>
<?php unset($aoid); ?>
		</div>
<?php
 	}



function get_pdf_call_report_result($strDateFrom = NULL, $strDateTo = NULL, $fhour = NULL, $thour = NULL, $fmincombo = NULL, $tmincombo = NULL){
	$this->load->helper('dompdf');
$html .= '<div id="header"><table style="width:100%; font-family: sans-serif;">
	<tr align="center"><td colspan="3" align="center"><h1 style="font-family: sans-serif;">Coopselios SAD</h1></td></tr>'; ?>
	<?php
	if($startDate != 'null' && $endDate != "null"){

	$html .= '<tr>
		<td><b>'.lang("from")." ".lang("MONTH::date").': </b></td><td>'.date("d-m-Y", strtotime($strDateFrom)).'</b></td>
		<td><b>'.lang("to")." ".lang("MONTH::date").': </b></td><td>'.date("d-m-Y", strtotime($strDateTo)).'</b></td>
	</tr>'; }
	if($fhour != 'null' && $thour != "null"){

	$html .= '<tr>
		<td><b>'.lang("from")." ".lang("CALL-REPORT::time").': </b></td><td>'.$this->common->commontimeformat($fhour).":".$this->common->commontimeformat($fmincombo).'</b></td>
		<td><b>'.lang("to")." ".lang("CALL-REPORT::time").': </b></td><td>'.$this->common->commontimeformat($thour).":".$this->common->commontimeformat($tmincombo).'</b></td>
	</tr>';
	 }
$html .= '</table>
	<br><br><table id="dyntable" class="table table-bordered responsive">
		<tbody>'; ?>
<?php
  	$this->load->model('jobassign_model');
	$startdate = date("Y-m-d", strtotime($strDateFrom));
	$enddate = date("Y-m-d", strtotime($strDateTo));
$dateArray = $this->getAllDatesBetweenTwoDates($startdate, $enddate);
	$cnt = round(count($dateArray) / 20);
	$curent_date = $this->common->datei18tran(strtotime(date("d-m-Y")));
$html .= '<style>
@page responsive {
  size: A4 portrait;
  margin: 2cm;
}

.responsive {
   page: teacher;
   page-break-after: always;
}
  </style>';

$aoid = array();

foreach($dateArray as $dates){
	$results = $this->jobassign_model->get_call_report_data_pdf($dates, $fhour, $thour, $fmincombo, $tmincombo);
	if(empty($results)){
		$html .='<tr style="background: #ccc;"><td><b>'.lang("MONTH::date")." : ".date("d-m-Y", strtotime($dates)).'</b></td></tr>';
		$sel_opt = mysql_query("select oid,firstname,lastname from operators order by firstname ASC");
		$cnt_opt = mysql_num_rows($sel_opt);
		if($cnt_opt > 0){
		while($fet = mysql_fetch_assoc($sel_opt)){
			$firstname = $fet['firstname']." ".$fet['lastname'];
			$html .='<tr><td>'.$firstname.'</td></tr>';
			 } }else{
			 	$html .='<tr><td>'.lang("CALL-REPORT::all_operator_busy").'</td></tr>';
			 }
	}else{
	if($results[0]->job_date_assign != ""){
		if($results[0]->pry_oid != '0'){ $aoid[] = "'".$results[0]->pry_oid; }
		if($results[0]->sec_oid != '0'){ $aoid[] = "'".$results[0]->sec_oid; }
		if($results[0]->sup_id != '0'){ $aoid[] = "'".$results[0]->sup_id; }
		$toid = implode("',", $aoid)."'";
		$html .='<tr style="background: #ccc;"><td><b>'.lang("MONTH::date")." : ".date("d-m-Y", strtotime($dates)).'</b></td></tr>';
		$sel_opt = mysql_query("select oid,firstname,lastname from operators where oid NOT IN($toid) order by firstname ASC");
		$cnt_opt = mysql_num_rows($sel_opt);
		if($cnt_opt > 0){
		while($fet = mysql_fetch_assoc($sel_opt)){
			$firstname = $fet['firstname']." ".$fet['lastname'];
			$html .='<tr><td>'.$firstname.'</td></tr>';
			 } }else{
			 	$html .='<tr><td>'.lang("CALL-REPORT::all_operator_busy").'</td></tr>';
			 } ?>

	<?php } }
}

$html .='</tbody>
</table></div>';
 unset($aoid);
		$html .='</div>';
$filename = "job_month_report_pdf_".time();

pdf_create($html, $filename);

 	}

public function manual_intervent()
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
		$this->breadcrumbs->push( lang('MANUAL-INT::title'), site_url('jobassign2/manual_intervent'));
		/* end */
	  $this->load->view('manual_intervent', $data);
	//echo $fdate."--".$tdate."--".$ftime."--".$ttime;
}


public function getmanualintform()
{
	  if($this->lang->mci_current() == ""){
	  	$i18n = $this->lang->mci_current();
	  }else{
		$i18n = $this->lang->mci_current()."/";
	  }
	$this->load->model('jobassign_model');
	$rid = $this->common->getoperatorrole($_REQUEST['oid']);
	$oid = $_REQUEST['oid'];
	$pid = $_REQUEST['pid'];
	$intid = $_REQUEST['intid'];
/*
	$res = $this->jobassign_model->manual_jobdetail();

 		$fval = $res->result();*/

		//if($res->num_rows() > 0){
		/*
			$aid = $fval[0]->aid;
				   $request_id = $fval[0]->request_id;
				   $start_time_hour = $fval[0]->start_time_hour;
				   $start_time_min = $fval[0]->start_time_min;
				   $end_time_hour = $fval[0]->end_time_hour;
				   $end_time_min = $fval[0]->end_time_min;*/


/*
		$csel = "select * from assign_job_status WHERE aid = '$aid' AND oid = '$oid' AND status='1'";
		$q1 = $this->db->query($csel);
		$cnt1 = $q1->num_rows();
		if($cnt1 > 0){*/

	 ?>
		<div class="widgetbox box-inverse span9">
                <h4 class="widgettitle"><?php echo ( sprintf( lang("MANUAL-INT::title")) ); ?></h4>
                <div class="widgetcontent nopadding">
                	<?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div>'; <?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2', 'id' => 'forms');
           echo form_open($i18n.'jobassign2/sub_manual_intervent',$attributes);

           ?>
<!--
           <input type="hidden" name="aid" value="<?=$aid?>" />
           <input type="hidden" name="request_id" value="<?=$request_id?>" />-->

           <input type="hidden" name="intid" value="<?=$intid?>" />
           <input type="hidden" name="pid" value="<?=$pid?>" />
           <input type="hidden" name="oid" value="<?=$oid?>" />
           						<div class="jobautocomp">
                            <label><?php echo ( sprintf( lang("JOBASSIGN::stime")) ); ?><span class="rstar">*</span></label>
                            <span class="field">
       <select name="hourcombo" class="hourcombo combo" id="hourcombo">
                            	<option value="0">00</option>
                            	<?php for($st = 6; $st <= 22; $st++ ){ ?>
     								<option value="<?=$st?>"><?php echo $this->common->commontimeformat($st);?></option>
                            	<?php } ?>
</select>
<select name="mincombo" class="mincombo combo" id="mincombo">
	                            	<?php for($mt = 0; $mt <= 55; $mt = $mt+5 ){ ?>
     								<option value="<?=$mt?>"><?php echo $this->common->commontimeformat($mt);?></option>
                            	<?php } ?>
</select>(HH:MM)</span>
						</div>
						<div class="jobautocomp">
                            <label><?php echo ( sprintf( lang("JOBASSIGN::etime")) ); ?><span class="rstar">*</span></label>
                            <span class="field">
                            	<select name="endhourcombo" class="endhourcombo ecombo" id="endhourcombo" onchange="change_end_time(this.value,'endhourcombo')">
	                            	<option value="0">00</option>
                            	<?php for($eht = 6; $eht <= 22; $eht++ ){ ?>
     								<option value="<?=$eht?>"><?php echo $this->common->commontimeformat($eht);?></option>
                            	<?php } ?>
							</select>
							<select name="endmincombo" class="endmincombo ecombo" id="endmincombo" onchange="change_end_time(this.value,'endmincombo')">
								<?php for($emt = 0; $emt <= 55; $emt = $emt+5 ){ ?>
     								<option value="<?=$emt?>"><?php echo $this->common->commontimeformat($emt);?></option>
                            	<?php } ?>
							</select>(HH:MM)
                            	</span>
						</div>

		<?php
		$results = $this->ws->get_dynamic_fields($rid,$intid);
		foreach($results as $r){
			$label_name = $r->label_name;
			$type = $r->type;
			$options = $r->options;
			$required = $r->required; ?>
				<p>
                    <label><?php echo ucwords($label_name); ?><span class="rstar">*</span></label>
                    <span class="field">
                    	<?php
                    	if($type == "textbox"){ ?>
							<input class="input-large" type="<?=$type?>" name="<?=$label_name?>">
                    	<?php }elseif($type == "textarea"){ ?>
							<textarea class="input-large" name="<?=$label_name?>"></textarea>
                    	<?php } ?>

                    </span>
               </p>
		<?php } ?>

		<p class="stdformbutton" style="text-align:right">
                                <input type="submit" class="btn btn-primary btn-submit" value="<?php echo ( sprintf( lang("COMMON::sub_btn")) ); ?>">
                            </p>
		<?php echo form_close(); ?>
		        </div>
		</div>
	<?php /* }else{
		echo '<h3 style="color: red; text-align: center;">'.lang("MANUAL-INT::job_already_inserted").'</h3>';
	}*/
}

function sub_manual_intervent(){
  	$this->load->library('times_counter');
	$hourcombo = $this->common->commontimeformat($_REQUEST['hourcombo']);
	$mincombo = $this->common->commontimeformat($_REQUEST['mincombo']);
	$endhourcombo = $this->common->commontimeformat($_REQUEST['endhourcombo']);
	$endmincombo = $this->common->commontimeformat($_REQUEST['endmincombo']);
	$diff = $this->getTimeDiff($hourcombo.":".$mincombo,$endhourcombo.":".$endmincombo);
	$this->load->model('jobassign_model');
	$result = $this->jobassign_model->save_manual_intervent($diff,$hourcombo,$mincombo,$endhourcombo,$endmincombo);
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
		$this->breadcrumbs->push( lang('MANUAL-INT::title'), site_url('jobassign2/manual_intervent'));
		/* end */
		$data['msg'] = lang("MANUAL-INT::job_successfully_inserted");
	$this->load->view('manual_intervent', $data);
}


/* Test */
public function check_optweek_availabelnew($oid,$dates, $fhour, $thour, $fmincombo, $tmincombo) {

      $this->load->model('jobassign_model');
		$query = $this->jobassign_model->get_call_report_data($oid, $dates);

			$opt_id = $oid;
			$shourcombo_form = $fhour;
			$smincombo_form = $fmincombo;
			$ehourcombo_form = $thour;
			$emincombo_form = $tmincombo;
			$is_available = 0;
			$cnt = $query->num_rows();
			if($cnt > 0){
				foreach($query->result() as $fetch){

				$start_time_hour = $fetch->start_time_hour;
				$start_time_min = $fetch->start_time_min;
				$end_time_hour = $fetch->end_time_hour;
				$end_time_min = $fetch->end_time_min;

				$output = $this->check_operator_availabelnew($start_time_hour,$start_time_min,$end_time_hour,$end_time_min,$shourcombo_form,$smincombo_form,$ehourcombo_form,$emincombo_form);
				if($output == 1){
				 	return $opt_id;
				}else{
					return 0;
				}
				}
			}
    }


function check_operator_availabelnew($starthour,$startmin,$endhour,$endmin,$shourcombo,$smincombo,$ehourcombo,$emincombo){
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
foreach($job1 as $check_job){
	if(in_array($check_job, $job) ){
		$status = 1;
	}

}
return $status;
}
}
?>
