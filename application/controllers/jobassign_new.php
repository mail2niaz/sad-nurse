<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Jobassign_new extends CI_Controller {

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

public function filter()
{
	if($this->lang->mci_current() == ""){
	  	$i18n = $this->lang->mci_current();
	  }else{
		$i18n = $this->lang->mci_current()."/";
	  }
	$pid = $this->input->post('pat_id');
	$opt_id = $_REQUEST['opt_id'];
	$dist_id = $_REQUEST['dist_id'];
	$fplan_unplan = $_REQUEST['fplan_unplan'];
	$weekNumber = date("W");
	$year = date("Y");
	$non_schedule_data = array();
	$cur_date = strtotime(date("d-m-Y"));

	if(strlen(($weekNumber - 1)) == 1){
		$back_weeknumber = "0".($weekNumber - 1);
	}else{
		$back_weeknumber = $weekNumber - 1;
	}
	if(strlen(($weekNumber + 1)) == 1){
		$next_weeknumber = "0".($weekNumber + 1);
	}else{
		$next_weeknumber = $weekNumber + 1;
	}
$shd_detail_yid =array();
if(in_array($fplan_unplan, array('plan','confirm','unplan'))){
	$upc1 = "display:none;";
	$upc2 = "display:block;";
}else{
	$upc1 = "display:block;";
	$upc2 = "display:none;";
}

if($pid != '0' && $opt_id != '0' && $dist_id != '0' && in_array($fplan_unplan, array('plan','confirm','unplan'))){ /* Four option */
		$non_schedule_data = array();
		$yellow_schedule_data = array();
		$schedule_data = array();
		if($fplan_unplan == 'plan'){
			$class = "schedule";
			$qry = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.pid IN (SELECT pid from patients as d inner join assign_pdns as e on (d.pid = e.patient_id) where d.pid = '$pid' AND d.dist_id = '$dist_id' AND $opt_id IN (e.pry_oid,e.sec_oid,e.sup_id)) AND a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND  a.schedule_week = '$weekNumber' AND a.is_schedule = '1' AND a.reassign != '1' ORDER BY TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$click = "editpopupform";
			$do_action = "shd_edit";
	}elseif($fplan_unplan == 'confirm'){
			$class = "need-schedule";
			$qry = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.pid IN (SELECT pid from patients as d inner join assign_pdns as e on (d.pid = e.patient_id) where d.pid = '$pid' AND d.dist_id = '$dist_id' AND $opt_id IN (e.pry_oid,e.sec_oid,e.sup_id)) AND a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND a.schedule_week < '$weekNumber' AND a.is_schedule = '1' AND b.reassign != '1' AND a.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$click = "editpopupform";
			$do_action = "shd_confirm";
	}
	$schedule_data = array();
	if(!in_array($fplan_unplan, array('unplan'))){
	$sdata_qry = mysql_query($qry);
	$sdata_cnt = mysql_num_rows($sdata_qry);
	if($sdata_cnt > 0){
	while($sdata_fet = mysql_fetch_assoc($sdata_qry)){
		$schedule_data[] = $sdata_fet;
		if($fplan_unplan == 'confirm'){
			$shd_detail_yid[] = $sdata_fet['shd_detail_id'];
		}
	}
	} }
	}elseif($pid != '0' && $opt_id != '0' && $dist_id != '0'){ /* p O D */
	$non_schedule_data = array();
			$yellow_sdata_sel = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.is_schedule ='1' AND a.pid IN (SELECT patient_id FROM assign_pdns as c INNER JOIN patients as d on (c.patient_id = d.pid) WHERE $opt_id IN (pry_oid,sec_oid,sup_id) AND patient_id = '$pid' AND d.dist_id = '$dist_id') AND a.cid IN (SELECT cid FROM assign_pdns WHERE $opt_id IN (pry_oid,sec_oid,sup_id) AND patient_id = '$pid') AND a.shd_detail_id IN (SELECT shd_detail_id FROM assign_pdns WHERE $opt_id IN (pry_oid,sec_oid,sup_id) AND patient_id = '$pid') AND (a.schedule_week < '$weekNumber' AND a.reassign NOT IN(1,4) ) AND b.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$sdata_sel = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.is_schedule ='1' AND a.pid IN (SELECT patient_id FROM assign_pdns as c INNER JOIN patients as d on (c.patient_id = d.pid) WHERE $opt_id IN (pry_oid,sec_oid,sup_id) AND patient_id = '$pid' AND d.dist_id = '$dist_id') AND a.cid IN (SELECT cid FROM assign_pdns WHERE $opt_id IN (pry_oid,sec_oid,sup_id) AND patient_id = '$pid') AND a.shd_detail_id IN (SELECT shd_detail_id FROM assign_pdns WHERE $opt_id IN (pry_oid,sec_oid,sup_id) AND patient_id = '$pid') AND a.schedule_week = '$weekNumber' AND b.status = '1' AND a.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
	}elseif(in_array($fplan_unplan, array('plan','confirm','unplan')) && $opt_id != '0' && $pid != '0'){ /* Plan O P */
		$non_schedule_data = array();
		$yellow_schedule_data = array();
		$schedule_data = array();
		if($fplan_unplan == 'plan'){
			$class = "schedule";
			$qry = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND  a.schedule_week = '$weekNumber' AND a.is_schedule = '1' AND a.pid IN (SELECT patient_id FROM assign_pdns WHERE $opt_id IN (pry_oid,sec_oid,sup_id)  AND patient_id = '$pid') AND a.reassign != '1' ORDER BY TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$click = "editpopupform";
			$do_action = "shd_edit";
	}elseif($fplan_unplan == 'confirm'){
			$class = "need-schedule";
			$qry = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND a.schedule_week < '$weekNumber' AND a.is_schedule = '1' AND a.pid IN (SELECT patient_id FROM assign_pdns WHERE $opt_id IN (pry_oid,sec_oid,sup_id)  AND patient_id = '$pid') AND b.reassign != '1' AND a.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$click = "editpopupform";
			$do_action = "shd_confirm";
	}
	$schedule_data = array();
	if(!in_array($fplan_unplan, array('unplan'))){
	$sdata_qry = mysql_query($qry);
	$sdata_cnt = mysql_num_rows($sdata_qry);
	if($sdata_cnt > 0){
	while($sdata_fet = mysql_fetch_assoc($sdata_qry)){
		$schedule_data[] = $sdata_fet;
		if($fplan_unplan == 'confirm'){
			$shd_detail_yid[] = $sdata_fet['shd_detail_id'];
		}
	}
	} }
	}elseif(in_array($fplan_unplan, array('plan','confirm','unplan')) && $dist_id != '0' && $pid != '0'){ /* Plan D P */
		$non_schedule_data = array();
		$yellow_schedule_data = array();
		$schedule_data = array();
		if($fplan_unplan == 'plan'){
			$class = "schedule";
			$qry = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.pid IN (SELECT pid from patients as d where d.dist_id = '$dist_id' AND d.pid = '$pid') AND a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND  a.schedule_week = '$weekNumber' AND a.is_schedule = '1' AND a.reassign != '1' ORDER BY TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$click = "editpopupform";
			$do_action = "shd_edit";
	}elseif($fplan_unplan == 'confirm'){
			$class = "need-schedule";
			$qry = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.pid IN (SELECT pid from patients as d where d.dist_id = '$dist_id' AND d.pid = '$pid') AND a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND a.schedule_week < '$weekNumber' AND a.is_schedule = '1' AND b.reassign != '1' AND a.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$click = "editpopupform";
			$do_action = "shd_confirm";
	}elseif($fplan_unplan == 'unplan'){
			$class = "non-schedule";
			$qry = "select * from contract_intervent_weekdays_shd_details where pid IN (SELECT pid from patients as d where d.dist_id = '$dist_id' AND d.pid = '$pid') AND  cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND is_schedule = '0' order by suspendable DESC";
			$click = "popupform";
			$do_action = "shd_new";
	}
	$schedule_data = array();
	$sdata_qry = mysql_query($qry);
	$sdata_cnt = mysql_num_rows($sdata_qry);
	if($sdata_cnt > 0){
	while($sdata_fet = mysql_fetch_assoc($sdata_qry)){
		$schedule_data[] = $sdata_fet;
		if($fplan_unplan == 'confirm'){
			$shd_detail_yid[] = $sdata_fet['shd_detail_id'];
		}
	}
	}
	}elseif(in_array($fplan_unplan, array('plan','confirm','unplan')) && $dist_id != '0' && $opt_id != '0'){ /* Plan D O */
		$non_schedule_data = array();
		$yellow_schedule_data = array();
		$schedule_data = array();
		if($fplan_unplan == 'plan'){
			$class = "schedule";
			$qry = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.pid IN (SELECT pid from patients as d inner join assign_pdns as e on (d.pid = e.patient_id) where d.dist_id = '$dist_id' AND $opt_id IN (e.pry_oid,e.sec_oid,e.sup_id)) AND a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND  a.schedule_week = '$weekNumber' AND a.is_schedule = '1' AND a.reassign != '1' ORDER BY TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$click = "editpopupform";
			$do_action = "shd_edit";
	}elseif($fplan_unplan == 'confirm'){
			$class = "need-schedule";
			$qry = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.pid IN (SELECT pid from patients as d inner join assign_pdns as e on (d.pid = e.patient_id) where d.dist_id = '$dist_id' AND $opt_id IN (e.pry_oid,e.sec_oid,e.sup_id)) AND a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND a.schedule_week < '$weekNumber' AND a.is_schedule = '1' AND b.reassign != '1' AND a.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$click = "editpopupform";
			$do_action = "shd_confirm";
	}
	$schedule_data = array();
	if(!in_array($fplan_unplan, array('unplan'))){
	$sdata_qry = mysql_query($qry);
	$sdata_cnt = mysql_num_rows($sdata_qry);
	if($sdata_cnt > 0){
	while($sdata_fet = mysql_fetch_assoc($sdata_qry)){
		$schedule_data[] = $sdata_fet;
		if($fplan_unplan == 'confirm'){
			$shd_detail_yid[] = $sdata_fet['shd_detail_id'];
		}
	}
	} }
	}
	elseif($pid != '0' && $opt_id != '0'){ /* P O */
	$non_schedule_data = array();
			$yellow_sdata_sel = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.is_schedule ='1' AND a.pid IN (SELECT patient_id FROM assign_pdns WHERE $opt_id IN (pry_oid,sec_oid,sup_id) AND patient_id = '$pid') AND a.cid IN (SELECT cid FROM assign_pdns WHERE $opt_id IN (pry_oid,sec_oid,sup_id) AND patient_id = '$pid') AND a.shd_detail_id IN (SELECT shd_detail_id FROM assign_pdns WHERE $opt_id IN (pry_oid,sec_oid,sup_id) AND patient_id = '$pid') AND (a.schedule_week < '$weekNumber' AND a.reassign NOT IN(1,4) ) AND b.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$sdata_sel = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.is_schedule ='1' AND a.pid IN (SELECT patient_id FROM assign_pdns WHERE $opt_id IN (pry_oid,sec_oid,sup_id) AND patient_id = '$pid') AND a.cid IN (SELECT cid FROM assign_pdns WHERE $opt_id IN (pry_oid,sec_oid,sup_id) AND patient_id = '$pid') AND a.shd_detail_id IN (SELECT shd_detail_id FROM assign_pdns WHERE $opt_id IN (pry_oid,sec_oid,sup_id) AND patient_id = '$pid') AND a.schedule_week = '$weekNumber' AND b.status = '1' AND a.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
	}elseif($opt_id != '0' && $dist_id != '0'){ /* O D */
		$non_schedule_data = array();
			$yellow_sdata_sel = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.is_schedule ='1' AND a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND (a.pid IN (SELECT pid from patients where dist_id = '$dist_id') AND $opt_id IN (pry_oid,sec_oid,sup_id)) AND (a.schedule_week < '$weekNumber' AND a.reassign NOT IN(1,4) ) AND b.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$sdata_sel = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.is_schedule ='1' AND a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND (a.pid IN (SELECT pid from patients where dist_id = '$dist_id') AND $opt_id IN (pry_oid,sec_oid,sup_id)) AND a.schedule_week = '$weekNumber' AND b.status = '1' AND a.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
	}elseif(in_array($fplan_unplan, array('plan','confirm','unplan')) && $opt_id != '0'){ /* Plan O */
		$non_schedule_data = array();
		$yellow_schedule_data = array();
		$schedule_data = array();
		if($fplan_unplan == 'plan'){
			$class = "schedule";
			$qry = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND  a.schedule_week = '$weekNumber' AND a.is_schedule = '1' AND a.pid IN (SELECT patient_id FROM assign_pdns WHERE $opt_id IN (pry_oid,sec_oid,sup_id)) AND a.reassign != '1' ORDER BY TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$click = "editpopupform";
			$do_action = "shd_edit";
	}elseif($fplan_unplan == 'confirm'){
			$class = "need-schedule";
			$qry = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND a.schedule_week < '$weekNumber' AND a.is_schedule = '1' AND a.pid IN (SELECT patient_id FROM assign_pdns WHERE $opt_id IN (pry_oid,sec_oid,sup_id)) AND b.reassign != '1' AND a.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$click = "editpopupform";
			$do_action = "shd_confirm";
	}
	$schedule_data = array();
	if(!in_array($fplan_unplan, array('unplan'))){
	$sdata_qry = mysql_query($qry);
	$sdata_cnt = mysql_num_rows($sdata_qry);
	if($sdata_cnt > 0){
	while($sdata_fet = mysql_fetch_assoc($sdata_qry)){
		$schedule_data[] = $sdata_fet;
		if($fplan_unplan == 'confirm'){
			$shd_detail_yid[] = $sdata_fet['shd_detail_id'];
		}
	}
	} }
	}elseif($pid != '0' && $dist_id != '0'){ /* P D */
			$selj = "select * from contract_intervent_weekdays_shd_details where is_schedule !='1' AND cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND pid IN (SELECT pid from patients where dist_id = '$dist_id' AND pid = '$pid') order by suspendable DESC";
			$yellow_sdata_sel = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.is_schedule ='1' AND a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND a.pid IN (SELECT pid from patients where dist_id = '$dist_id' AND pid = '$pid') AND (a.schedule_week < '$weekNumber' AND a.reassign NOT IN(1,4) ) AND b.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$sdata_sel = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.is_schedule ='1' AND a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND a.pid IN (SELECT pid from patients where dist_id = '$dist_id' AND pid = '$pid') AND a.schedule_week = '$weekNumber' AND b.status = '1' AND a.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
	}elseif(in_array($fplan_unplan, array('plan','confirm','unplan')) && $pid != '0'){ /* Plan P */
		$non_schedule_data = array();
		$yellow_schedule_data = array();
		$schedule_data = array();
		if($fplan_unplan == 'plan'){
			$class = "schedule";
			$qry = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.pid = '$pid' AND a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND  a.schedule_week = '$weekNumber' AND a.is_schedule = '1' AND a.reassign != '1' ORDER BY TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$click = "editpopupform";
			$do_action = "shd_edit";
	}elseif($fplan_unplan == 'confirm'){
			$class = "need-schedule";
			$qry = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.pid = '$pid' AND a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND a.schedule_week < '$weekNumber' AND a.is_schedule = '1' AND b.reassign != '1' AND a.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$click = "editpopupform";
			$do_action = "shd_confirm";
	}elseif($fplan_unplan == 'unplan'){
			$class = "non-schedule";
			$qry = "select * from contract_intervent_weekdays_shd_details where pid = '$pid' AND  cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND is_schedule = '0' order by suspendable DESC";
			$click = "popupform";
			$do_action = "shd_new";
	}
	$schedule_data = array();
	$sdata_qry = mysql_query($qry);
	$sdata_cnt = mysql_num_rows($sdata_qry);
	if($sdata_cnt > 0){
	while($sdata_fet = mysql_fetch_assoc($sdata_qry)){
		$schedule_data[] = $sdata_fet;
		if($fplan_unplan == 'confirm'){
			$shd_detail_yid[] = $sdata_fet['shd_detail_id'];
		}
	}
	}
	}elseif(in_array($fplan_unplan, array('plan','confirm','unplan')) && $dist_id != '0'){ /* Plan D */
		$non_schedule_data = array();
		$yellow_schedule_data = array();
		$schedule_data = array();
		if($fplan_unplan == 'plan'){
			$class = "schedule";
			$qry = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.pid IN (SELECT pid from patients where dist_id = '$dist_id') AND a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND  a.schedule_week = '$weekNumber' AND a.is_schedule = '1' AND a.reassign != '1' ORDER BY TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$click = "editpopupform";
			$do_action = "shd_edit";
	}elseif($fplan_unplan == 'confirm'){
			$class = "need-schedule";
			$qry = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.pid IN (SELECT pid from patients where dist_id = '$dist_id') AND a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND a.schedule_week < '$weekNumber' AND a.is_schedule = '1' AND b.reassign != '1' AND a.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$click = "editpopupform";
			$do_action = "shd_confirm";
	}elseif($fplan_unplan == 'unplan'){
			$class = "non-schedule";
			$qry = "select * from contract_intervent_weekdays_shd_details where pid IN (SELECT pid from patients where dist_id = '$dist_id') AND  cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND is_schedule = '0' order by suspendable DESC";
			$click = "popupform";
			$do_action = "shd_new";
	}
	$schedule_data = array();
	$sdata_qry = mysql_query($qry);
	$sdata_cnt = mysql_num_rows($sdata_qry);
	if($sdata_cnt > 0){
	while($sdata_fet = mysql_fetch_assoc($sdata_qry)){
		$schedule_data[] = $sdata_fet;
		if($fplan_unplan == 'confirm'){
			$shd_detail_yid[] = $sdata_fet['shd_detail_id'];
		}
	}
	}
	}
	elseif($pid != '0'){ /* patient */
		$selj = "select * from contract_intervent_weekdays_shd_details where (is_schedule !='1' OR (schedule_week > $weekNumber AND reassign = '2')) AND pid = '$pid' order by suspendable DESC";
		$yellow_sdata_sel = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.is_schedule ='1' AND a.pid = '$pid' AND (a.schedule_week < '$weekNumber' AND a.reassign NOT IN(1) ) AND b.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
		$sdata_sel = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.is_schedule ='1' AND a.pid = '$pid' AND a.schedule_week = '$weekNumber' AND b.status = '1' AND a.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
	}elseif($opt_id != '0'){ /* Operator */
		$non_schedule_data = array();
			$yellow_sdata_sel = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.is_schedule ='1' AND a.pid IN (SELECT patient_id FROM assign_pdns WHERE  pry_oid = '$opt_id' OR sec_oid = '$opt_id' OR sup_id = '$opt_id') AND a.cid IN (SELECT cid FROM assign_pdns WHERE $opt_id IN (pry_oid,sec_oid,sup_id)) AND a.shd_detail_id IN (SELECT shd_detail_id FROM assign_pdns WHERE $opt_id IN (pry_oid,sec_oid,sup_id)) AND (a.schedule_week < '$weekNumber' AND a.reassign NOT IN(1,4) ) AND b.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$sdata_sel = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.is_schedule ='1' AND a.pid IN (SELECT patient_id FROM assign_pdns WHERE $opt_id IN (pry_oid,sec_oid,sup_id)) AND a.cid IN (SELECT cid FROM assign_pdns WHERE $opt_id IN (pry_oid,sec_oid,sup_id)) AND a.shd_detail_id IN (SELECT shd_detail_id FROM assign_pdns WHERE $opt_id IN (pry_oid,sec_oid,sup_id)) AND a.schedule_week = '$weekNumber' AND b.status = '1' AND a.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
	}elseif($dist_id != '0'){ /* District */
			$selj = "select * from contract_intervent_weekdays_shd_details where is_schedule !='1' AND cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND pid IN (SELECT pid from patients where dist_id = '$dist_id') order by suspendable DESC";
			$yellow_sdata_sel = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.is_schedule ='1' AND a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND a.pid IN (SELECT pid from patients where dist_id = '$dist_id') AND (a.schedule_week < '$weekNumber' AND a.reassign NOT IN(1,4) ) AND b.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$sdata_sel = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.is_schedule ='1' AND a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND a.pid IN (SELECT pid from patients where dist_id = '$dist_id') AND a.schedule_week = '$weekNumber' AND b.status = '1' AND a.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
	}elseif(in_array($fplan_unplan, array('plan','confirm','unplan'))){ /* Plan */
		$non_schedule_data = array();
		$yellow_schedule_data = array();
		$schedule_data = array();
		if($fplan_unplan == 'plan'){
			$class = "schedule";
			$qry = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND  a.schedule_week = '$weekNumber' AND a.is_schedule = '1' AND a.reassign != '1' ORDER BY TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$click = "editpopupform";
			$do_action = "shd_edit";
	}elseif($fplan_unplan == 'confirm'){
			$class = "need-schedule";
			$qry = "select a.*,b.aid from contract_intervent_weekdays_shd_details as a inner join assign_pdns as b on (a.shd_detail_id = b.shd_detail_id) where a.cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND a.schedule_week < '$weekNumber' AND a.is_schedule = '1' AND b.reassign != '1' AND a.reassign != '1' order by a.suspendable DESC, TIME(CONCAT(b.start_time_hour,':', b.start_time_min)) ASC";
			$click = "editpopupform";
			$do_action = "shd_confirm";
	}elseif($fplan_unplan == 'unplan'){
			$class = "non-schedule";
			$qry = "select * from contract_intervent_weekdays_shd_details where cid NOT IN (select cid from `contract_details` where last_ceased_date <= '$cur_date' AND last_ceased_date != '0') AND is_schedule = '0' order by suspendable DESC";
			$click = "popupform";
			$do_action = "shd_new";
	}
	$schedule_data = array();
	$sdata_qry = mysql_query($qry);
	$sdata_cnt = mysql_num_rows($sdata_qry);
	if($sdata_cnt > 0){
	while($sdata_fet = mysql_fetch_assoc($sdata_qry)){
		$schedule_data[] = $sdata_fet;
		if($fplan_unplan == 'confirm'){
			$shd_detail_yid[] = $sdata_fet['shd_detail_id'];
		}
	}
	}
	}

if($opt_id == '0' && $fplan_unplan == '0'){
	$qryj = mysql_query($selj);
	$cntj = mysql_num_rows($qryj);
	if($cntj > 0){
	while($fetj = mysql_fetch_assoc($qryj)){
		$non_schedule_data[] = $fetj;
	}
	}
}
	/* Yellow Schedule Data */
	if($fplan_unplan == '0'){
	$yellow_schedule_data = array();
	$yellow_sdata_qry = mysql_query($yellow_sdata_sel);
	$yellow_sdata_cnt = mysql_num_rows($yellow_sdata_qry);
	if($yellow_sdata_cnt > 0){
	while($yellow_sdata_fet = mysql_fetch_assoc($yellow_sdata_qry)){
		$yellow_schedule_data[] = $yellow_sdata_fet;
		$shd_detail_yid[] = $yellow_sdata_fet['shd_detail_id'];
	}
	} }

/* Schedule Data */
if($fplan_unplan == '0'){
	$schedule_data = array();
	$sdata_qry = mysql_query($sdata_sel);
	$sdata_cnt = mysql_num_rows($sdata_qry);
	if($sdata_cnt > 0){
	while($sdata_fet = mysql_fetch_assoc($sdata_qry)){
		$schedule_data[] = $sdata_fet;
	}
	} }
$week = date("W");
if($dist_id == '0'){
	$dist_val = "'undefined'";
}else{
	$dist_val = $dist_id;
}
if(count($shd_detail_yid) > 0){
	$imp_shd = implode(",", $shd_detail_yid);
}else{
	$imp_shd = '';
}


	/* End wc-today */
	?>
<script type="text/javascript">
jQuery().ready(function() {
	var pat_id = '<?=$pid?>';
	var opt_id = '<?=$opt_id?>';
	var dist_id = '<?=$dist_id?>';
	var siteurl = "<?php echo site_url($i18n.'jobassign_nav_new/NavFilter') ?>";
  jQuery('.wc-prev').click(function(){
  	$('#field_loader').show();
	var pre_week_no = $(this).attr('pre');

	jQuery.post(siteurl,
		{week_no: ""+pre_week_no+"", pat_id: ""+pat_id+"", opt_id: ""+opt_id+"", dist_id: ""+dist_id+""},
               function(data){
               	$('#field_loader').hide();
               	if(data != ''){
               		jQuery('#calendar1').html('');
               		jQuery('#calendar1').html(data);
               	}

	       });
	});

	jQuery('.wc-next').click(function(){
		$('#field_loader').show();
	var next_week_no = $(this).attr('next');
	var pid = $(this).attr('pid');
	jQuery.post(siteurl,
	           {week_no: ""+next_week_no+"", pat_id: ""+pat_id+"", opt_id: ""+opt_id+"", dist_id: ""+dist_id+""},
               function(data){
               	$('#field_loader').hide();
               	if(data != ''){
               		jQuery('#calendar1').html('');
               		jQuery('#calendar1').html(data);
               	}

	       });
	});

	jQuery('.wc-today').click(function(){
		$('#field_loader').show();
	var today_week_no = $(this).attr('today');
	var pid = $(this).attr('pid');
	jQuery.post(siteurl,
	           {week_no: ""+today_week_no+"", pat_id: ""+pat_id+"", opt_id: ""+opt_id+"", dist_id: ""+dist_id+""},
               function(data){
               	$('#field_loader').hide();
               	if(data != ''){
               		jQuery('#calendar1').html('');
               		jQuery('#calendar1').html(data);
               	}

	       });
	});
})

</script>
<form>

</form>
	<div class="wc-container">
		<?php if($fplan_unplan == '0'){ ?>
			<div class="wc-nav">
				<button class="wc-today" today="<?=$week?>" pid="<?=$pid?>"><?php echo sprintf( lang('JOBASSIGN::today') ); ?></button>
				<button class="wc-prev" pre="<?=$back_weeknumber?>" pid="<?=$pid?>">&nbsp;&lt;&nbsp;</button>
				<button class="wc-next" next="<?=$next_weeknumber?>" pid="<?=$pid?>">&nbsp;&gt;&nbsp;</button>
			</div> <?php } ?>
			<div id="LoadingImage" style="display: none; float: left"><img src="<?php echo base_url()?>images/486.GIF" height="1"/></div>
			<?php /*  if(!in_array($fplan_unplan, array('plan','unplan'))){ ?>
                            	<form method="post" action="<?php echo site_url($i18n.'jobassign/confirm_yellow_box/'.$weekNumber); ?>" style="text-align:right">
                            		<input type="hidden" name="yellow_update_id" value="<?=$imp_shd?>" />
<input type="submit" name="yellow_confirm" value="<?php echo ( sprintf( lang("JOBASSIGN::confirm_yellow")) ); ?>" class="btn btn-rounded btn-primary btn-submit" onclick = "return confirm('Sei vuoi confermare luscita di posti di lavoro?')" />
                            	</form><?php } */ ?>
	<table class="wc-header">
		<tbody>
			<tr>
				<td class="wc-time-column-header"></td><td class="wc-day-column-header wc-day-1"><?php echo ( sprintf( lang("WEEKDAYS::mon")) ); ?>
				<br>
				<?php echo $this->common->datei18tran(strtotime(date('M-d, Y', strtotime($year."W".$week.'1')))); ?></td><td class="wc-day-column-header wc-day-2"><?php echo ( sprintf( lang("WEEKDAYS::tue")) ); ?>
				<br>
				<?php echo $this->common->datei18tran(strtotime(date('M-d,Y', strtotime($year."W".$week.'2')))); ?></td><td class="wc-day-column-header wc-day-3"><?php echo ( sprintf( lang("WEEKDAYS::wed")) ); ?>
				<br>
				<?php echo $this->common->datei18tran(strtotime(date('M-d,Y', strtotime($year."W".$week.'3')))); ?></td><td class="wc-day-column-header wc-day-4"><?php echo ( sprintf( lang("WEEKDAYS::thu")) ); ?>
				<br>
				<?php echo $this->common->datei18tran(strtotime(date('M-d,Y', strtotime($year."W".$week.'4')))); ?></td><td class="wc-day-column-header wc-day-5"><?php echo ( sprintf( lang("WEEKDAYS::fri")) ); ?>
				<br>
				<?php echo $this->common->datei18tran(strtotime(date('M-d,Y', strtotime($year."W".$week.'5')))); ?></td><td class="wc-day-column-header wc-day-6"><?php echo ( sprintf( lang("WEEKDAYS::sat")) ); ?>
				<br>
				<?php echo $this->common->datei18tran(strtotime(date('M-d,Y', strtotime($year."W".$week.'6')))); ?></td><td class="wc-day-column-header wc-day-7"><?php echo ( sprintf( lang("WEEKDAYS::sun")) ); ?>
				<br>
				<?php echo $this->common->datei18tran(strtotime(date('M-d,Y', strtotime($year."W".$week.'7')))); ?></td><td class="wc-scrollbar-shim"></td>
			</tr>
		</tbody>
	</table>
	<div class="wc-scrollable-grid" style="height: 500px; <?=$upc1?>">
		<table class="wc-time-slots">
			<tbody>

				<tr>
					<td class="wc-day-column day-1">
						<?php
$day1_non = 1;
foreach($non_schedule_data as $fdata){
		$shd_detail_id = $fdata['shd_detail_id'];
		$cid = $fdata['cid'];
		$pid = $fdata['pid'];
		$int_id = $fdata['intervent_id'];
		$week_id = $fdata['shd_days'];
		$suspend = $fdata['suspendable'];

		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);
		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}

if($week_id == '1' && $this->common->contractbasedjoblist($cid,'1',$week) == "yes"){ ?>
			<div class="wc-day-column-inner ui-droppable non-schedule" onclick="popupform(<?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>);">
						<div class="wc-cal-event ui-corner-all tooltip-class-1-<?=$week?>-<?=$day1_non?>">
							<div class="wc-time ui-corner-all">
								<?php echo ( sprintf( lang("JOBASSIGN::non_schedule")) ); ?>
								<?php if($suspend == "1"){ ?>&nbsp;&nbsp;<i class="icon-warning-sign" title="Suspend"></i> <?php } ?>
							</div>
							<div class="wc-title" title="">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>

							</div>
							<div id="tooltip-info-1-<?=$week?>-<?=$day1_non?>" style="display: none;">
								<?php if($suspend == "1"){ ?><p><b style="color: red;"><?php echo ( sprintf( lang("JOBASSIGN::high_priority")) ); ?></b></p><?php } ?>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-class-1-<?=$week?>-<?=$day1_non?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-1-<?=$week?>-<?=$day1_non?>').html(); }
	});
});
</script>
			<?php } $day1_non++; } ?>

<?php /* Yellow */
$yday1 = 1;
foreach($yellow_schedule_data as $yfdata){
		$shd_detail_id = $yfdata['shd_detail_id'];
		$cid = $yfdata['cid'];
		$pid = $yfdata['pid'];
		$int_id = $yfdata['intervent_id'];
		$week_id = $yfdata['shd_days'];
		$schedule_week = $yfdata['schedule_week'];
		$suspend = $yfdata['suspendable'];
		$aid = $yfdata['aid'];

		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);
		$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
		$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
		$stime = $this->common->get_hours($aid,$week_id);
		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
			if($week_id == '1' && $this->common->contractbasedjoblist($cid,'1',$week) == "yes"){ ?>
			<div class="wc-day-column-inner ui-droppable need-schedule" onclick="editpopupform(<?=$aid?>,'yellow',<?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>);">
						<div class="wc-cal-event ui-corner-all tooltip-need-schedule-1-<?=$week?>-<?=$yday1?>">
							<div class="wc-time ui-corner-all">
								<?=$stime?>
								<?php if($suspend == "1"){ ?>&nbsp;&nbsp;<i class="icon-warning-sign" title="Suspend"></i> <?php } ?>
							</div>
							<div class="wc-title" title="">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>
								<br>
								<?=$operator_name?>
							</div>
							<div id="tooltip-info-1-need-schedule-<?=$week?>-<?=$yday1?>" style="display: none;">
								<?php if($suspend == "1"){ ?><p><b style="color: red;"><?php echo ( sprintf( lang("JOBASSIGN::high_priority")) ); ?></b></p><?php } ?>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::schedule_time")) ); ?>:</b>&nbsp;<?=$stime?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
								<p><?=$operator_name_popup?></p>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-need-schedule-1-<?=$week?>-<?=$yday1?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-1-need-schedule-<?=$week?>-<?=$yday1?>').html(); }
	});
});
</script>
			<?php } $yday1++; } /* End Yellow */ ?>

			<?php
			$day1 = 1;
foreach($schedule_data as $fdata){
		$shd_detail_id = $fdata['shd_detail_id'];
		$cid = $fdata['cid'];
		$pid = $fdata['pid'];
		$int_id = $fdata['intervent_id'];
		$week_id = $fdata['shd_days'];
		$schedule_week = $fdata['schedule_week'];
		$aid = $fdata['aid'];

		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);
		$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
		$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
		$stime = $this->common->get_hours($aid,$week_id);
		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
			if($week_id == '1' && $this->common->contractbasedjoblist($cid,'1',$week) == "yes"){ ?>
			<div class="wc-day-column-inner ui-droppable schedule" onclick="editpopupform(<?=$aid?>,'edit',<?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>);">
						<div class="wc-cal-event ui-corner-all tooltip-schedule-1-<?=$week?>-<?=$day1?>">
							<div class="wc-time ui-corner-all">
								<?=$stime?>
							</div>
							<div class="wc-title" title="">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>
								<br>
								<?=$operator_name?>
							</div>
							<div id="tooltip-info-1-schedule-<?=$week?>-<?=$day1?>" style="display: none; over">
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::schedule_time")) ); ?>:</b>&nbsp;<?=$stime?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
								<p><?=$operator_name_popup?></p>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-schedule-1-<?=$week?>-<?=$day1?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-1-schedule-<?=$week?>-<?=$day1?>').html(); }
	});
});
</script>
			<?php } $day1++; } ?>

					</td>
					<td class="wc-day-column day-2">
											<?php
$day2_non = 1;
foreach($non_schedule_data as $fdata){
		$shd_detail_id = $fdata['shd_detail_id'];
		$cid = $fdata['cid'];
		$pid = $fdata['pid'];
		$int_id = $fdata['intervent_id'];
		$week_id = $fdata['shd_days'];
		$suspend = $fdata['suspendable'];
		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);

		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
if($week_id == '2' && $this->common->contractbasedjoblist($cid,'2',$week) == "yes"){ ?>
					<div class="wc-day-column-inner ui-droppable non-schedule" onclick="popupform(<?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>);">
						<div class="wc-cal-event ui-corner-all tooltip-class-2-<?=$week?>-<?=$day2_non?>">
							<div class="wc-time ui-corner-all">
								<?php echo ( sprintf( lang("JOBASSIGN::non_schedule")) ); ?>
								<?php if($suspend == "1"){ ?>&nbsp;&nbsp;<i class="icon-warning-sign" title="Suspend"></i> <?php } ?>
							</div>
							<div class="wc-title" title="">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>

							</div>
							<div id="tooltip-info-2-<?=$week?>-<?=$day2_non?>" style="display: none;">
								<?php if($suspend == "1"){ ?><p><b style="color: red;"><?php echo ( sprintf( lang("JOBASSIGN::high_priority")) ); ?></b></p><?php } ?>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
							</div>
						</div>
					</div>
	<script>
	 $(function() {
	$( ".tooltip-class-2-<?=$week?>-<?=$day2_non?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-2-<?=$week?>-<?=$day2_non?>').html(); }
	});
});
</script>

					<?php } $day2_non++; } ?>

<?php /* Yellow */
			$yday2 = 1;
foreach($yellow_schedule_data as $yfdata){
		$shd_detail_id = $yfdata['shd_detail_id'];
		$cid = $yfdata['cid'];
		$pid = $yfdata['pid'];
		$int_id = $yfdata['intervent_id'];
		$week_id = $yfdata['shd_days'];
		$schedule_week = $yfdata['schedule_week'];
		$suspend = $yfdata['suspendable'];
		$aid = $yfdata['aid'];

		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);
		$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
		$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
		$stime = $this->common->get_hours($aid,$week_id);
		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
			if($week_id == '2' && $this->common->contractbasedjoblist($cid,'2',$week) == "yes"){ ?>
			<div class="wc-day-column-inner ui-droppable need-schedule" onclick="editpopupform(<?=$aid?>,'yellow',<?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>);">
						<div class="wc-cal-event ui-corner-all tooltip-need-schedule-1-<?=$week?>-<?=$yday2?>">
							<div class="wc-time ui-corner-all">
								<?=$stime?>
								<?php if($suspend == "1"){ ?>&nbsp;&nbsp;<i class="icon-warning-sign" title="Suspend"></i> <?php } ?>
							</div>
							<div class="wc-title" title="">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>
								<br>
								<?=$operator_name?>
							</div>
							<div id="tooltip-info-1-need-schedule-<?=$week?>-<?=$yday2?>" style="display: none;">
								<?php if($suspend == "1"){ ?><p><b style="color: red;"><?php echo ( sprintf( lang("JOBASSIGN::high_priority")) ); ?></b></p><?php } ?>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::schedule_time")) ); ?>:</b>&nbsp;<?=$stime?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
								<p><?=$operator_name_popup?></p>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-need-schedule-1-<?=$week?>-<?=$yday2?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-1-need-schedule-<?=$week?>-<?=$yday2?>').html(); }
	});
});
</script>
			<?php } $yday2++; } /* End Yellow */ ?>

<?php
$day2 = 1;
foreach($schedule_data as $fdata){
		$shd_detail_id = $fdata['shd_detail_id'];
		$cid = $fdata['cid'];
		$pid = $fdata['pid'];
		$int_id = $fdata['intervent_id'];
		$week_id = $fdata['shd_days'];
		$schedule_week = $fdata['schedule_week'];
		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);
		$aid = $fdata['aid'];

		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
		$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
		$stime = $this->common->get_hours($aid,$week_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
			if($week_id == '2' && $this->common->contractbasedjoblist($cid,'2',$week) == "yes"){ ?>
			<div class="wc-day-column-inner ui-droppable schedule" onclick="editpopupform(<?=$aid?>,'edit',<?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>);">
						<div class="wc-cal-event ui-corner-all tooltip-schedule-2-<?=$week?>-<?=$day2?>">
							<div class="wc-time ui-corner-all">
								<?=$stime?>
							</div>
							<div class="wc-title" title="">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>
								<br>
								<?=$operator_name?>
							</div>
							<div id="tooltip-info-2-schedule-<?=$week?>-<?=$day2?>" style="display: none;">
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::schedule_time")) ); ?>:</b>&nbsp;<?=$stime?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
								<p><?=$operator_name_popup?></p>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-schedule-2-<?=$week?>-<?=$day2?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-2-schedule-<?=$week?>-<?=$day2?>').html(); }
	});
});
</script>
			<?php } $day2++; } ?>
					</td>
					<td class="wc-day-column day-3">
<?php
$day3_non = 1;
foreach($non_schedule_data as $fdata){
		$shd_detail_id = $fdata['shd_detail_id'];
		$cid = $fdata['cid'];
		$pid = $fdata['pid'];
		$int_id = $fdata['intervent_id'];
		$week_id = $fdata['shd_days'];
		$suspend = $fdata['suspendable'];
		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);
		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
if($week_id == '3' && $this->common->contractbasedjoblist($cid,'3',$week) == "yes"){ ?>
					<div class="wc-day-column-inner ui-droppable non-schedule" onclick="popupform(<?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>);">
						<div class="wc-cal-event ui-corner-all tooltip-class-3-<?=$week?>-<?=$day3_non?>" title="">
							<div class="wc-time ui-corner-all">
								<?php echo ( sprintf( lang("JOBASSIGN::non_schedule")) ); ?>
								<?php if($suspend == "1"){ ?>&nbsp;&nbsp;<i class="icon-warning-sign" title="Suspend"></i> <?php } ?>
							</div>
							<div class="wc-title">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>

							</div>
							<div id="tooltip-info-3-<?=$week?>-<?=$day3_non?>" style="display: none;">
								<?php if($suspend == "1"){ ?><p><b style="color: red;"><?php echo ( sprintf( lang("JOBASSIGN::high_priority")) ); ?></b></p><?php } ?>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
							</div>
						</div>
					</div>
					<script>
	 $(function() {
	$( ".tooltip-class-3-<?=$week?>-<?=$day3_non?>" ).tooltip({
		position: { my: "left right", at: "top right" },
		content: function() { return $('#tooltip-info-3-<?=$week?>-<?=$day3_non?>').html(); }
	});
});
</script>
					<?php } $day3_non++; } ?>

<?php /* Yellow */
			$yday3 = 1;
foreach($yellow_schedule_data as $yfdata){
		$shd_detail_id = $yfdata['shd_detail_id'];
		$cid = $yfdata['cid'];
		$pid = $yfdata['pid'];
		$int_id = $yfdata['intervent_id'];
		$week_id = $yfdata['shd_days'];
		$schedule_week = $yfdata['schedule_week'];
		$suspend = $yfdata['suspendable'];
		$aid = $yfdata['aid'];

		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);
		$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
		$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
		$stime = $this->common->get_hours($aid,$week_id);
		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
if($week_id == '3' && $this->common->contractbasedjoblist($cid,'3',$week) == "yes"){ ?>
			<div class="wc-day-column-inner ui-droppable need-schedule" onclick="editpopupform(<?=$aid?>,'yellow',<?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>);">
						<div class="wc-cal-event ui-corner-all tooltip-need-schedule-1-<?=$week?>-<?=$yday3?>">
							<div class="wc-time ui-corner-all">
								<?=$stime?>
								<?php if($suspend == "1"){ ?>&nbsp;&nbsp;<i class="icon-warning-sign" title="Suspend"></i> <?php } ?>
							</div>
							<div class="wc-title" title="">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>
								<br>
								<?=$operator_name?>
							</div>
							<div id="tooltip-info-1-need-schedule-<?=$week?>-<?=$yday3?>" style="display: none;">
								<?php if($suspend == "1"){ ?><p><b style="color: red;"><?php echo ( sprintf( lang("JOBASSIGN::high_priority")) ); ?></b></p><?php } ?>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::schedule_time")) ); ?>:</b>&nbsp;<?=$stime?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
								<p><?=$operator_name_popup?></p>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-need-schedule-1-<?=$week?>-<?=$yday3?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-1-need-schedule-<?=$week?>-<?=$yday3?>').html(); }
	});
});
</script>
			<?php } $yday3++; } /* End Yellow */ ?>

					<?php
$day3 = 1;
foreach($schedule_data as $fdata){
		$shd_detail_id = $fdata['shd_detail_id'];
		$cid = $fdata['cid'];
		$pid = $fdata['pid'];
		$int_id = $fdata['intervent_id'];
		$week_id = $fdata['shd_days'];
		$aid = $fdata['aid'];
		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);
		$schedule_week = $fdata['schedule_week'];
		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
		$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
		$stime = $this->common->get_hours($aid,$week_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
if($week_id == '3' && $this->common->contractbasedjoblist($cid,'3',$week) == "yes"){ ?>
			<div class="wc-day-column-inner ui-droppable schedule" onclick="editpopupform(<?=$aid?>,'edit',<?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>);">
						<div class="wc-cal-event ui-corner-all tooltip-schedule-3-<?=$week?>-<?=$day3?>" title="">
							<div class="wc-time ui-corner-all">
								<?=$stime?>
							</div>
							<div class="wc-title">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>
								<br>
								<?=$operator_name?>
							</div>
							<div id="tooltip-info-3-schedule-<?=$week?>-<?=$day3?>" style="display: none;">
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::schedule_time")) ); ?>:</b>&nbsp;<?=$stime?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
								<p><?=$operator_name_popup?></p>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-schedule-3-<?=$week?>-<?=$day3?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-3-schedule-<?=$week?>-<?=$day3?>').html(); }
	});
});
</script>
			<?php } $day3++; } ?>
					</td>

<td class="wc-day-column day-4">
						<?php
$day4_non = 1;
foreach($non_schedule_data as $fdata){
		$shd_detail_id = $fdata['shd_detail_id'];
		$cid = $fdata['cid'];
		$pid = $fdata['pid'];
		$int_id = $fdata['intervent_id'];
		$week_id = $fdata['shd_days'];
		$suspend = $fdata['suspendable'];
		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);
		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
if($week_id == '4' && $this->common->contractbasedjoblist($cid,'4',$week) == "yes"){ ?>
					<div class="wc-day-column-inner ui-droppable non-schedule" onclick="popupform(<?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>);">
						<div class="wc-cal-event ui-corner-all tooltip-class-4-<?=$week?>-<?=$day4_non?>" title="">
							<div class="wc-time ui-corner-all">
								<?php echo ( sprintf( lang("JOBASSIGN::non_schedule")) ); ?>
								<?php if($suspend == "1"){ ?>&nbsp;&nbsp;<i class="icon-warning-sign" title="Suspend"></i> <?php } ?>
							</div>
							<div class="wc-title">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>

							</div>
							<div id="tooltip-info-4-<?=$week?>-<?=$day4_non?>" style="display: none;">
								<?php if($suspend == "1"){ ?><p><b style="color: red;"><?php echo ( sprintf( lang("JOBASSIGN::high_priority")) ); ?></b></p><?php } ?>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
							</div>
						</div>
					</div>
					<script>
	 $(function() {
	$( ".tooltip-class-4-<?=$week?>-<?=$day4_non?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-4-<?=$week?>-<?=$day4_non?>').html(); }
	});
});
</script>
					<?php } $day4_non++; } ?>

<?php /* Yellow */
			$yday4 = 1;
foreach($yellow_schedule_data as $yfdata){
		$shd_detail_id = $yfdata['shd_detail_id'];
		$cid = $yfdata['cid'];
		$pid = $yfdata['pid'];
		$int_id = $yfdata['intervent_id'];
		$week_id = $yfdata['shd_days'];
		$schedule_week = $yfdata['schedule_week'];
		$suspend = $yfdata['suspendable'];
		$aid = $yfdata['aid'];

		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);
		$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
		$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
		$stime = $this->common->get_hours($aid,$week_id);
		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
if($week_id == '4' && $this->common->contractbasedjoblist($cid,'4',$week) == "yes"){ ?>
			<div class="wc-day-column-inner ui-droppable need-schedule" onclick="editpopupform(<?=$aid?>,'yellow',<?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>);">
						<div class="wc-cal-event ui-corner-all tooltip-need-schedule-1-<?=$week?>-<?=$yday4?>">
							<div class="wc-time ui-corner-all">
								<?=$stime?>
								<?php if($suspend == "1"){ ?>&nbsp;&nbsp;<i class="icon-warning-sign" title="Suspend"></i> <?php } ?>
							</div>
							<div class="wc-title" title="">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>
								<br>
								<?=$operator_name?>
							</div>
							<div id="tooltip-info-1-need-schedule-<?=$week?>-<?=$yday4?>" style="display: none;">
								<?php if($suspend == "1"){ ?><p><b style="color: red;"><?php echo ( sprintf( lang("JOBASSIGN::high_priority")) ); ?></b></p><?php } ?>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::schedule_time")) ); ?>:</b>&nbsp;<?=$stime?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
								<p><?=$operator_name_popup?></p>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-need-schedule-1-<?=$week?>-<?=$yday4?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-1-need-schedule-<?=$week?>-<?=$yday4?>').html(); }
	});
});
</script>
			<?php } $yday4++; } /* End Yellow */ ?>

					<?php
$day4 = 1;
foreach($schedule_data as $fdata){
		$shd_detail_id = $fdata['shd_detail_id'];
		$cid = $fdata['cid'];
		$pid = $fdata['pid'];
		$int_id = $fdata['intervent_id'];
		$week_id = $fdata['shd_days'];
		$schedule_week = $fdata['schedule_week'];
		$aid = $fdata['aid'];
		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);

		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
		$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
		$stime = $this->common->get_hours($aid,$week_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
if($week_id == '4' && $this->common->contractbasedjoblist($cid,'4',$week) == "yes"){ ?>
			<div class="wc-day-column-inner ui-droppable schedule" onclick="editpopupform(<?=$aid?>,'edit',<?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>);">
						<div class="wc-cal-event ui-corner-all tooltip-schedule-4-<?=$week?>-<?=$day4?>" title="">
							<div class="wc-time ui-corner-all">
								<?=$stime?>
							</div>
							<div class="wc-title">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>
								<br>
								<?=$operator_name?>
							</div>
							<div id="tooltip-info-4-schedule-<?=$week?>-<?=$day4?>" style="display: none;">
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::schedule_time")) ); ?>:</b>&nbsp;<?=$stime?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
								<p><?=$operator_name_popup?></p>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-schedule-4-<?=$week?>-<?=$day4?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-4-schedule-<?=$week?>-<?=$day4?>').html(); }
	});
});
</script>
			<?php } $day4++; } ?>
					</td>

<td class="wc-day-column day-5">
						<?php
$day5_non = 5;
foreach($non_schedule_data as $fdata){
		$shd_detail_id = $fdata['shd_detail_id'];
		$cid = $fdata['cid'];
		$pid = $fdata['pid'];
		$int_id = $fdata['intervent_id'];
		$week_id = $fdata['shd_days'];
		$suspend = $fdata['suspendable'];
		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);
		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
if($week_id == '5' && $this->common->contractbasedjoblist($cid,'5',$week) == "yes"){ ?>
					<div class="wc-day-column-inner ui-droppable non-schedule" onclick="popupform(<?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>);">
						<div class="wc-cal-event ui-corner-all tooltip-class-5-<?=$week?>-<?=$day5_non?>" title="">
							<div class="wc-time ui-corner-all">
								<?php echo ( sprintf( lang("JOBASSIGN::non_schedule")) ); ?>
								<?php if($suspend == "1"){ ?>&nbsp;&nbsp;<i class="icon-warning-sign" title="Suspend"></i> <?php } ?>
							</div>
							<div class="wc-title">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>

							</div>
							<div id="tooltip-info-5-<?=$week?>-<?=$day5_non?>" style="display: none;">
								<?php if($suspend == "1"){ ?><p><b style="color: red;"><?php echo ( sprintf( lang("JOBASSIGN::high_priority")) ); ?></b></p><?php } ?>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-class-5-<?=$week?>-<?=$day5_non?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-5-<?=$week?>-<?=$day5_non?>').html(); }
	});
});
</script>
					<?php } $day5_non++; } ?>

<?php /* Yellow */
			$yday5 = 1;
foreach($yellow_schedule_data as $yfdata){
		$shd_detail_id = $yfdata['shd_detail_id'];
		$cid = $yfdata['cid'];
		$pid = $yfdata['pid'];
		$int_id = $yfdata['intervent_id'];
		$week_id = $yfdata['shd_days'];
		$schedule_week = $yfdata['schedule_week'];
		$suspend = $yfdata['suspendable'];
		$aid = $yfdata['aid'];

		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);
		$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
		$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
		$stime = $this->common->get_hours($aid,$week_id);
		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
if($week_id == '5' && $this->common->contractbasedjoblist($cid,'5',$week) == "yes"){ ?>
			<div class="wc-day-column-inner ui-droppable need-schedule" onclick="editpopupform(<?=$aid?>,'yellow',<?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>);">
						<div class="wc-cal-event ui-corner-all tooltip-need-schedule-5-<?=$week?>-<?=$yday5?>">
							<div class="wc-time ui-corner-all">
								<?=$stime?>
								<?php if($suspend == "1"){ ?>&nbsp;&nbsp;<i class="icon-warning-sign" title="Suspend"></i> <?php } ?>
							</div>
							<div class="wc-title" title="">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>
								<br>
								<?=$operator_name?>
							</div>
							<div id="tooltip-info-5-need-schedule-<?=$week?>-<?=$yday5?>" style="display: none;">
								<?php if($suspend == "1"){ ?><p><b style="color: red;"><?php echo ( sprintf( lang("JOBASSIGN::high_priority")) ); ?></b></p><?php } ?>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::schedule_time")) ); ?>:</b>&nbsp;<?=$stime?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
								<p><?=$operator_name_popup?></p>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-need-schedule-5-<?=$week?>-<?=$yday5?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-5-need-schedule-<?=$week?>-<?=$yday5?>').html(); }
	});
});
</script>
			<?php } $yday5++; } /* End Yellow */ ?>

					<?php
$day5 = 1;
foreach($schedule_data as $fdata){
		$shd_detail_id = $fdata['shd_detail_id'];
		$cid = $fdata['cid'];
		$pid = $fdata['pid'];
		$int_id = $fdata['intervent_id'];
		$week_id = $fdata['shd_days'];
		$schedule_week = $fdata['schedule_week'];
		$aid = $fdata['aid'];
		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);

		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
		$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
		$stime = $this->common->get_hours($aid,$week_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
if($week_id == '5' && $this->common->contractbasedjoblist($cid,'5',$week) == "yes"){ ?>
			<div class="wc-day-column-inner ui-droppable schedule" onclick="editpopupform(<?=$aid?>,'edit',<?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>);">
						<div class="wc-cal-event ui-corner-all tooltip-schedule-5-<?=$week?>-<?=$day5?>" title="">
							<div class="wc-time ui-corner-all">
								<?=$stime?>
							</div>
							<div class="wc-title">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>
								<br>
								<?=$operator_name?>
							</div>
							<div id="tooltip-info-5-schedule-<?=$week?>-<?=$day5?>" style="display: none;">
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::schedule_time")) ); ?>:</b>&nbsp;<?=$stime?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
								<p><?=$operator_name_popup?></p>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-schedule-5-<?=$week?>-<?=$day5?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-5-schedule-<?=$week?>-<?=$day5?>').html(); }
	});
});
</script>
			<?php }  $day5++; } ?>
					</td>

<td class="wc-day-column day-6">
						<?php
$day6_non = 1;
		foreach($non_schedule_data as $fdata){
		$shd_detail_id = $fdata['shd_detail_id'];
		$cid = $fdata['cid'];
		$pid = $fdata['pid'];
		$int_id = $fdata['intervent_id'];
		$week_id = $fdata['shd_days'];
		$suspend = $fdata['suspendable'];

		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);
		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
if($week_id == '6' && $this->common->contractbasedjoblist($cid,'6',$week) == "yes"){ ?>
					<div class="wc-day-column-inner ui-droppable non-schedule" onclick="popupform(<?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>);">
						<div class="wc-cal-event ui-corner-all tooltip-class-6-<?=$week?>-<?=$day6_non?>" title="">
							<div class="wc-time ui-corner-all">
								<?php echo ( sprintf( lang("JOBASSIGN::non_schedule")) ); ?>
								<?php if($suspend == "1"){ ?>&nbsp;&nbsp;<i class="icon-warning-sign" title="Suspend"></i> <?php } ?>
							</div>
							<div class="wc-title">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>

							</div>
							<div id="tooltip-info-6-<?=$week?>-<?=$day6_non?>" style="display: none;">
								<?php if($suspend == "1"){ ?><p><b style="color: red;"><?php echo ( sprintf( lang("JOBASSIGN::high_priority")) ); ?></b></p><?php } ?>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
							</div>
						</div>
					</div>
					<script>
	 $(function() {
	$( ".tooltip-class-6-<?=$week?>-<?=$day6_non?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-6-<?=$week?>-<?=$day6_non?>').html(); }
	});
});
</script>
					 <?php } $day6_non++; } ?>

<?php /* Yellow */
			$yday6 = 1;
foreach($yellow_schedule_data as $yfdata){
		$shd_detail_id = $yfdata['shd_detail_id'];
		$cid = $yfdata['cid'];
		$pid = $yfdata['pid'];
		$int_id = $yfdata['intervent_id'];
		$week_id = $yfdata['shd_days'];
		$schedule_week = $yfdata['schedule_week'];
		$suspend = $yfdata['suspendable'];
		$aid = $yfdata['aid'];

		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);
		$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
		$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
		$stime = $this->common->get_hours($aid,$week_id);
		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
if($week_id == '6' && $this->common->contractbasedjoblist($cid,'6',$week) == "yes"){ ?>
			<div class="wc-day-column-inner ui-droppable need-schedule" onclick="editpopupform(<?=$aid?>,'yellow',<?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>);">
						<div class="wc-cal-event ui-corner-all tooltip-need-schedule-1-<?=$week?>-<?=$yday6?>">
							<div class="wc-time ui-corner-all">
								<?=$stime?>
								<?php if($suspend == "1"){ ?>&nbsp;&nbsp;<i class="icon-warning-sign" title="Suspend"></i> <?php } ?>
							</div>
							<div class="wc-title" title="">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>
								<br>
								<?=$operator_name?>
							</div>
							<div id="tooltip-info-1-need-schedule-<?=$week?>-<?=$yday6?>" style="display: none;">
								<?php if($suspend == "1"){ ?><p><b style="color: red;"><?php echo ( sprintf( lang("JOBASSIGN::high_priority")) ); ?></b></p><?php } ?>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::schedule_time")) ); ?>:</b>&nbsp;<?=$stime?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
								<p><?=$operator_name_popup?></p>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-need-schedule-1-<?=$week?>-<?=$yday6?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-1-need-schedule-<?=$week?>-<?=$yday6?>').html(); }
	});
});
</script>
			<?php } $yday6++; } /* End Yellow */ ?>

					<?php
$day6 = 1;
foreach($schedule_data as $fdata){
		$shd_detail_id = $fdata['shd_detail_id'];
		$cid = $fdata['cid'];
		$pid = $fdata['pid'];
		$int_id = $fdata['intervent_id'];
		$week_id = $fdata['shd_days'];
		$schedule_week = $fdata['schedule_week'];
		$aid = $fdata['aid'];
		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);

		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
		$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
		$stime = $this->common->get_hours($aid,$week_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
if($week_id == '6' && $this->common->contractbasedjoblist($cid,'6',$week) == "yes"){ ?>
			<div class="wc-day-column-inner ui-droppable schedule" onclick="editpopupform(<?=$aid?>,'edit',<?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>);">
						<div class="wc-cal-event ui-corner-all tooltip-schedule-6-<?=$week?>-<?=$day6?>" title="">
							<div class="wc-time ui-corner-all">
								<?=$stime?>
							</div>
							<div class="wc-title">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>
								<br>
								<?=$operator_name?>
							</div>
							<div id="tooltip-info-6-schedule-<?=$week?>-<?=$day6?>" style="display: none;">
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::schedule_time")) ); ?>:</b>&nbsp;<?=$stime?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
								<p><?=$operator_name_popup?></p>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-schedule-6-<?=$week?>-<?=$day6?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-6-schedule-<?=$week?>-<?=$day6?>').html(); }
	});
});
</script>
			<?php } $day6++; } ?>
					</td><td class="wc-day-column day-7">
						<?php
$day7_non = 1;
foreach($non_schedule_data as $fdata){
		$shd_detail_id = $fdata['shd_detail_id'];
		$cid = $fdata['cid'];
		$pid = $fdata['pid'];
		$int_id = $fdata['intervent_id'];
		$week_id = $fdata['shd_days'];
		$suspend = $fdata['suspendable'];
		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);
		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
			if($week_id == '7' && $this->common->contractbasedjoblist($cid,'7',$week) == "yes"){ ?>
					<div class="wc-day-column-inner ui-droppable non-schedule" onclick="popupform(<?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>);">
						<div class="wc-cal-event ui-corner-all tooltip-class-7-<?=$week?>-<?=$day7_non?>" title="">
							<div class="wc-time ui-corner-all">
								<?php echo ( sprintf( lang("JOBASSIGN::non_schedule")) ); ?>
								<?php if($suspend == "1"){ ?>&nbsp;&nbsp;<i class="icon-warning-sign" title="Suspend"></i> <?php } ?>
							</div>
							<div class="wc-title">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>

							</div>
							<div id="tooltip-info-7-<?=$week?>-<?=$day7_non?>" style="display: none;">
								<?php if($suspend == "1"){ ?><p><b style="color: red;"><?php echo ( sprintf( lang("JOBASSIGN::high_priority")) ); ?></b></p><?php } ?>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
							</div>
						</div>
					</div>
					<script>
	 $(function() {
	$( ".tooltip-class-7-<?=$week?>-<?=$day7_non?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-7-<?=$week?>-<?=$day7_non?>').html(); }
	});
});
</script>
					<?php } $day7_non++; } ?>

<?php /* Yellow */
$yday7 = 1;
foreach($yellow_schedule_data as $yfdata){
		$shd_detail_id = $yfdata['shd_detail_id'];
		$cid = $yfdata['cid'];
		$pid = $yfdata['pid'];
		$int_id = $yfdata['intervent_id'];
		$week_id = $yfdata['shd_days'];
		$schedule_week = $yfdata['schedule_week'];
		$suspend = $yfdata['suspendable'];
		$aid = $yfdata['aid'];

		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);
		$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
		$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
		$stime = $this->common->get_hours($aid,$week_id);
		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
			if($week_id == '7' && $this->common->contractbasedjoblist($cid,'7',$week) == "yes"){ ?>
			<div class="wc-day-column-inner ui-droppable need-schedule" onclick="editpopupform(<?=$aid?>,'yellow',<?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>);">
						<div class="wc-cal-event ui-corner-all tooltip-need-schedule-1-<?=$week?>-<?=$yday7?>">
							<div class="wc-time ui-corner-all">
								<?=$stime?>
								<?php if($suspend == "1"){ ?>&nbsp;&nbsp;<i class="icon-warning-sign" title="Suspend"></i> <?php } ?>
							</div>
							<div class="wc-title" title="">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>
								<br>
								<?=$operator_name?>
							</div>
							<div id="tooltip-info-1-need-schedule-<?=$week?>-<?=$yday7?>" style="display: none;">
								<?php if($suspend == "1"){ ?><p><b style="color: red;"><?php echo ( sprintf( lang("JOBASSIGN::high_priority")) ); ?></b></p><?php } ?>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::schedule_time")) ); ?>:</b>&nbsp;<?=$stime?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
								<p><?=$operator_name_popup?></p>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-need-schedule-1-<?=$week?>-<?=$yday7?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-1-need-schedule-<?=$week?>-<?=$yday7?>').html(); }
	});
});
</script>
			<?php } $yday7++; } /* End Yellow */ ?>

					<?php
$day7 = 1;
foreach($schedule_data as $fdata){
		$shd_detail_id = $fdata['shd_detail_id'];
		$cid = $fdata['cid'];
		$pid = $fdata['pid'];
		$int_id = $fdata['intervent_id'];
		$week_id = $fdata['shd_days'];
		$schedule_week = $fdata['schedule_week'];
		$aid = $fdata['aid'];
		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);

		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
		$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
		$stime = $this->common->get_hours($aid,$week_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
if($week_id == '7' && $this->common->contractbasedjoblist($cid,'7',$week) == "yes"){ ?>
			<div class="wc-day-column-inner ui-droppable schedule" onclick="editpopupform(<?=$aid?>,'edit',<?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>);">
						<div class="wc-cal-event ui-corner-all tooltip-schedule-7-<?=$week?>-<?=$day7?>" title="">
							<div class="wc-time ui-corner-all">
								<?=$stime?>
							</div>
							<div class="wc-title">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>
								<br>
								<?=$operator_name?>
							</div>
							<div id="tooltip-info-7-schedule-<?=$week?>-<?=$day7?>" style="display: none;">
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::schedule_time")) ); ?>:</b>&nbsp;<?=$stime?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
								<p><?=$operator_name_popup?></p>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-schedule-7-<?=$week?>-<?=$day7?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-7-schedule-<?=$week?>-<?=$day7?>').html(); }
	});
});
</script>
			<?php } $day7++; } ?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>

<div class="wc-scrollable-grid 2" style="height: 500px; <?=$upc2?>">
		<table class="wc-time-slots">
			<tbody>
				<tr>
					<td class="wc-day-column day-1">
			<?php
			$day1 = 1;
foreach($schedule_data as $fdata){
		$shd_detail_id = $fdata['shd_detail_id'];
		$cid = $fdata['cid'];
		$pid = $fdata['pid'];
		$int_id = $fdata['intervent_id'];
		$week_id = $fdata['shd_days'];
		$schedule_week = $fdata['schedule_week'];
		$suspend = $fdata['suspendable'];
		if($do_action == "shd_edit"){
			$aid = $fdata['aid'];
			$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
			$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
			$stime = $this->common->get_hours($aid,$week_id);
			$pop = $aid.",'edit',";
		}elseif($do_action == "shd_confirm"){
			$aid = $fdata['aid'];
			$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
			$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
			$stime = $this->common->get_hours($aid,$week_id);
			$pop = $aid.",'yellow',";
		}elseif($do_action == "shd_new"){
			$pop = '';

		}
		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);
		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
			if($week_id == '1'){ ?>
			<div class="wc-day-column-inner ui-droppable <?=$class?>" onclick="<?=$click?>(<?=$pop?><?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>,<?=$weekNumber?>);">
						<div class="wc-cal-event ui-corner-all tooltip-<?=$class?>-1-<?=$week?>-<?=$day1?>">
							<div class="wc-time ui-corner-all">
								<?php if($fplan_unplan != 'unplan'){ echo $stime; }else { echo ( sprintf( lang("JOBASSIGN::non_schedule")) ); } ?>
									<?php if($suspend == "1" && $fplan_unplan != 'plan'){ ?>&nbsp;&nbsp;<i class="icon-warning-sign" title="Suspend"></i> <?php } ?>
							</div>
							<div class="wc-title" title="">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>
								<br>
								<?php if($fplan_unplan == 'unplan'){ ?>
								<b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b><?=$int_name?> <?php }else{ ?>
									<?=$operator_name?>
								<?php  } ?>
							</div>
							<div id="tooltip-info-1-<?=$class?>-<?=$week?>-<?=$day1?>" style="display: none;">
								<?php if($suspend == "1" && $fplan_unplan != 'plan'){ ?><p><b style="color: red;"><?php echo ( sprintf( lang("JOBASSIGN::high_priority")) ); ?></b></p><?php } ?>
								<?php if($fplan_unplan != 'unplan'){ ?><p><b><?php echo ( sprintf( lang("JOBASSIGN::schedule_time")) ); ?>:</b>&nbsp;<?=$stime?></p><?php } ?>

								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
								<?php if($fplan_unplan != 'unplan'){ ?><p><?=$operator_name_popup?></p><?php } ?>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-<?=$class?>-1-<?=$week?>-<?=$day1?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-1-<?=$class?>-<?=$week?>-<?=$day1?>').html(); }
	});
});
</script>
			<?php } $day1++; } ?>

					</td>
					<td class="wc-day-column day-2">
<?php
$day2 = 1;
foreach($schedule_data as $fdata){
		$shd_detail_id = $fdata['shd_detail_id'];
		$cid = $fdata['cid'];
		$pid = $fdata['pid'];
		$int_id = $fdata['intervent_id'];
		$week_id = $fdata['shd_days'];
		$schedule_week = $fdata['schedule_week'];
		$suspend = $fdata['suspendable'];
		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);
		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		if($do_action == "shd_edit"){
			$aid = $fdata['aid'];
			$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
			$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
			$stime = $this->common->get_hours($aid,$week_id);
			$pop = $aid.",'edit',";
		}elseif($do_action == "shd_confirm"){
			$aid = $fdata['aid'];
			$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
			$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
			$stime = $this->common->get_hours($aid,$week_id);
			$pop = $aid.",'yellow',";
		}elseif($do_action == "shd_new"){
			$pop = '';

		}

		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
			if($week_id == '2'){ ?>
			<div class="wc-day-column-inner ui-droppable <?=$class?>" onclick="<?=$click?>(<?=$pop?><?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>,<?=$weekNumber?>);">
						<div class="wc-cal-event ui-corner-all tooltip-<?=$class?>-2-<?=$week?>-<?=$day2?>">
							<div class="wc-time ui-corner-all">
								<?php if($fplan_unplan != 'unplan'){ echo $stime; }else { echo ( sprintf( lang("JOBASSIGN::non_schedule")) ); } ?>
									<?php if($suspend == "1" && $fplan_unplan != 'plan'){ ?>&nbsp;&nbsp;<i class="icon-warning-sign" title="Suspend"></i> <?php } ?>
							</div>
							<div class="wc-title" title="">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>
								<br>
								<?php if($fplan_unplan == 'unplan'){ ?>
								<b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b><?=$int_name?> <?php }else{ ?>
									<?=$operator_name?>
								<?php  } ?>
							</div>
							<div id="tooltip-info-2-<?=$class?>-<?=$week?>-<?=$day2?>" style="display: none;">
								<?php if($suspend == "1" && $fplan_unplan != 'plan'){ ?><p><b style="color: red;"><?php echo ( sprintf( lang("JOBASSIGN::high_priority")) ); ?></b></p><?php } ?>
								<?php if($fplan_unplan != 'unplan'){ ?><p><b><?php echo ( sprintf( lang("JOBASSIGN::schedule_time")) ); ?>:</b>&nbsp;<?=$stime?></p><?php } ?>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
								<?php if($fplan_unplan != 'unplan'){ ?><p><?=$operator_name_popup?></p><?php } ?>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-<?=$class?>-2-<?=$week?>-<?=$day2?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-2-<?=$class?>-<?=$week?>-<?=$day2?>').html(); }
	});
});
</script>
			<?php } $day2++; } ?>
					</td>
					<td class="wc-day-column day-3">
					<?php
$day3 = 1;
foreach($schedule_data as $fdata){
		$shd_detail_id = $fdata['shd_detail_id'];
		$cid = $fdata['cid'];
		$pid = $fdata['pid'];
		$int_id = $fdata['intervent_id'];
		$week_id = $fdata['shd_days'];
		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);
		$schedule_week = $fdata['schedule_week'];
		$suspend = $fdata['suspendable'];

		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		if($do_action == "shd_edit"){
			$aid = $fdata['aid'];
			$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
			$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
			$stime = $this->common->get_hours($aid,$week_id);
			$pop = $aid.",'edit',";
		}elseif($do_action == "shd_confirm"){
			$aid = $fdata['aid'];
			$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
			$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
			$stime = $this->common->get_hours($aid,$week_id);
			$pop = $aid.",'yellow',";
		}elseif($do_action == "shd_new"){
			$pop = '';

		}
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
			if($week_id == '3'){ ?>
			<div class="wc-day-column-inner ui-droppable <?=$class?>" onclick="<?=$click?>(<?=$pop?><?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>,<?=$weekNumber?>);">
						<div class="wc-cal-event ui-corner-all tooltip-<?=$class?>-3-<?=$week?>-<?=$day3?>" title="">
							<div class="wc-time ui-corner-all">
								<?php if($fplan_unplan != 'unplan'){ echo $stime; }else { echo ( sprintf( lang("JOBASSIGN::non_schedule")) ); } ?>
									<?php if($suspend == "1" && $fplan_unplan != 'plan'){ ?>&nbsp;&nbsp;<i class="icon-warning-sign" title="Suspend"></i> <?php } ?>
							</div>
							<div class="wc-title">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>
								<br>
								<?php if($fplan_unplan == 'unplan'){ ?>
								<b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b><?=$int_name?> <?php }else{ ?>
									<?=$operator_name?>
								<?php  } ?>
							</div>
							<div id="tooltip-info-3-<?=$class?>-<?=$week?>-<?=$day3?>" style="display: none;">
								<?php if($suspend == "1" && $fplan_unplan != 'plan'){ ?><p><b style="color: red;"><?php echo ( sprintf( lang("JOBASSIGN::high_priority")) ); ?></b></p><?php } ?>
								<?php if($fplan_unplan != 'unplan'){ ?><p><b><?php echo ( sprintf( lang("JOBASSIGN::schedule_time")) ); ?>:</b>&nbsp;<?=$stime?></p><?php } ?>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
								<?php if($fplan_unplan != 'unplan'){ ?><p><?=$operator_name_popup?></p><?php } ?>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-<?=$class?>-3-<?=$week?>-<?=$day3?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-3-<?=$class?>-<?=$week?>-<?=$day3?>').html(); }
	});
});
</script>
			<?php } $day3++; } ?>
					</td><td class="wc-day-column day-4">
					<?php
$day4 = 1;
foreach($schedule_data as $fdata){
		$shd_detail_id = $fdata['shd_detail_id'];
		$cid = $fdata['cid'];
		$pid = $fdata['pid'];
		$int_id = $fdata['intervent_id'];
		$week_id = $fdata['shd_days'];
		$schedule_week = $fdata['schedule_week'];
		$suspend = $fdata['suspendable'];
		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);

		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		if($do_action == "shd_edit"){
			$aid = $fdata['aid'];
			$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
			$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
			$stime = $this->common->get_hours($aid,$week_id);
			$pop = $aid.",'edit',";
		}elseif($do_action == "shd_confirm"){
			$aid = $fdata['aid'];
			$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
			$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
			$stime = $this->common->get_hours($aid,$week_id);
			$pop = $aid.",'yellow',";
		}elseif($do_action == "shd_new"){
			$pop = '';

		}
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
			if($week_id == '4'){ ?>
			<div class="wc-day-column-inner ui-droppable <?=$class?>" onclick="<?=$click?>(<?=$pop?><?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>,<?=$weekNumber?>);">
						<div class="wc-cal-event ui-corner-all tooltip-<?=$class?>-4-<?=$week?>-<?=$day4?>" title="">
							<div class="wc-time ui-corner-all">
								<?php if($fplan_unplan != 'unplan'){ echo $stime; }else { echo ( sprintf( lang("JOBASSIGN::non_schedule")) ); } ?>
									<?php if($suspend == "1" && $fplan_unplan != 'plan'){ ?>&nbsp;&nbsp;<i class="icon-warning-sign" title="Suspend"></i> <?php } ?>
							</div>
							<div class="wc-title">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>
								<br>
								<?php if($fplan_unplan == 'unplan'){ ?>
								<b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b><?=$int_name?> <?php }else{ ?>
									<?=$operator_name?>
								<?php  } ?>
							</div>
							<div id="tooltip-info-4-<?=$class?>-<?=$week?>-<?=$day4?>" style="display: none;">
								<?php if($suspend == "1" && $fplan_unplan != 'plan'){ ?><p><b style="color: red;"><?php echo ( sprintf( lang("JOBASSIGN::high_priority")) ); ?></b></p><?php } ?>
								<?php if($fplan_unplan != 'unplan'){ ?><p><b><?php echo ( sprintf( lang("JOBASSIGN::schedule_time")) ); ?>:</b>&nbsp;<?=$stime?></p><?php } ?>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
								<?php if($fplan_unplan != 'unplan'){ ?><p><?=$operator_name_popup?></p><?php } ?>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-<?=$class?>-4-<?=$week?>-<?=$day4?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-4-<?=$class?>-<?=$week?>-<?=$day4?>').html(); }
	});
});
</script>
			<?php } $day4++; } ?>
					</td><td class="wc-day-column day-5">
					<?php
$day5 = 1;
foreach($schedule_data as $fdata){
		$shd_detail_id = $fdata['shd_detail_id'];
		$cid = $fdata['cid'];
		$pid = $fdata['pid'];
		$int_id = $fdata['intervent_id'];
		$week_id = $fdata['shd_days'];
		$schedule_week = $fdata['schedule_week'];
		$suspend = $fdata['suspendable'];
		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);

		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		if($do_action == "shd_edit"){
			$aid = $fdata['aid'];
			$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
			$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
			$stime = $this->common->get_hours($aid,$week_id);
			$pop = $aid.",'edit',";
		}elseif($do_action == "shd_confirm"){
			$aid = $fdata['aid'];
			$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
			$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
			$stime = $this->common->get_hours($aid,$week_id);
			$pop = $aid.",'yellow',";
		}elseif($do_action == "shd_new"){
			$pop = '';

		}
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
			if($week_id == '5'){ ?>
			<div class="wc-day-column-inner ui-droppable <?=$class?>" onclick="<?=$click?>(<?=$pop?><?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>,<?=$weekNumber?>);">
						<div class="wc-cal-event ui-corner-all tooltip-<?=$class?>-5-<?=$week?>-<?=$day5?>" title="">
							<div class="wc-time ui-corner-all">
								<?php if($fplan_unplan != 'unplan'){ echo $stime; }else { echo ( sprintf( lang("JOBASSIGN::non_schedule")) ); } ?>
									<?php if($suspend == "1" && $fplan_unplan != 'plan'){ ?>&nbsp;&nbsp;<i class="icon-warning-sign" title="Suspend"></i> <?php } ?>
							</div>
							<div class="wc-title">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>
								<br>
								<?php if($fplan_unplan == 'unplan'){ ?>
								<b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b><?=$int_name?> <?php }else{ ?>
									<?=$operator_name?>
								<?php  } ?>
							</div>
							<div id="tooltip-info-5-<?=$class?>-<?=$week?>-<?=$day5?>" style="display: none;">
								<?php if($suspend == "1" && $fplan_unplan != 'plan'){ ?><p><b style="color: red;"><?php echo ( sprintf( lang("JOBASSIGN::high_priority")) ); ?></b></p><?php } ?>
								<?php if($fplan_unplan != 'unplan'){ ?><p><b><?php echo ( sprintf( lang("JOBASSIGN::schedule_time")) ); ?>:</b>&nbsp;<?=$stime?></p><?php } ?>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
								<?php if($fplan_unplan != 'unplan'){ ?><p><?=$operator_name_popup?></p><?php } ?>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-<?=$class?>-5-<?=$week?>-<?=$day5?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-5-<?=$class?>-<?=$week?>-<?=$day5?>').html(); }
	});
});
</script>
			<?php } $day5++; } ?>
					</td><td class="wc-day-column day-6">
					<?php
$day6 = 1;
foreach($schedule_data as $fdata){
		$shd_detail_id = $fdata['shd_detail_id'];
		$cid = $fdata['cid'];
		$pid = $fdata['pid'];
		$int_id = $fdata['intervent_id'];
		$week_id = $fdata['shd_days'];
		$schedule_week = $fdata['schedule_week'];
		$suspend = $fdata['suspendable'];
		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);

		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		if($do_action == "shd_edit"){
			$aid = $fdata['aid'];
			$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
			$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
			$stime = $this->common->get_hours($aid,$week_id);
			$pop = $aid.",'edit',";
		}elseif($do_action == "shd_confirm"){
			$aid = $fdata['aid'];
			$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
			$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
			$stime = $this->common->get_hours($aid,$week_id);
			$pop = $aid.",'yellow',";
		}elseif($do_action == "shd_new"){
			$pop = '';
		}
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
			if($week_id == '6'){ ?>
			<div class="wc-day-column-inner ui-droppable <?=$class?>" onclick="<?=$click?>(<?=$pop?><?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>,<?=$weekNumber?>);">
						<div class="wc-cal-event ui-corner-all tooltip-<?=$class?>-6-<?=$week?>-<?=$day6?>" title="">
							<div class="wc-time ui-corner-all">
								<?php if($fplan_unplan != 'unplan'){ echo $stime; }else { echo ( sprintf( lang("JOBASSIGN::non_schedule")) ); } ?>
									<?php if($suspend == "1" && $fplan_unplan != 'plan'){ ?>&nbsp;&nbsp;<i class="icon-warning-sign" title="Suspend"></i> <?php } ?>
							</div>
							<div class="wc-title">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>
								<br>
								<?php if($fplan_unplan == 'unplan'){ ?>
								<b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b><?=$int_name?> <?php }else{ ?>
									<?=$operator_name?>
								<?php  } ?>
							</div>
							<div id="tooltip-info-6-<?=$class?>-<?=$week?>-<?=$day6?>" style="display: none;">
								<?php if($suspend == "1" && $fplan_unplan != 'plan'){ ?><p><b style="color: red;"><?php echo ( sprintf( lang("JOBASSIGN::high_priority")) ); ?></b></p><?php } ?>
								<?php if($fplan_unplan != 'unplan'){ ?><p><b><?php echo ( sprintf( lang("JOBASSIGN::schedule_time")) ); ?>:</b>&nbsp;<?=$stime?></p><?php } ?>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
								<?php if($fplan_unplan != 'unplan'){ ?><p><?=$operator_name_popup?></p><?php } ?>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-<?=$class?>-6-<?=$week?>-<?=$day6?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-6-<?=$class?>-<?=$week?>-<?=$day6?>').html(); }
	});
});
</script>
			<?php } $day6++; } ?>
					</td><td class="wc-day-column day-7">
					<?php
$day7 = 1;
foreach($schedule_data as $fdata){
		$shd_detail_id = $fdata['shd_detail_id'];
		$cid = $fdata['cid'];
		$pid = $fdata['pid'];
		$int_id = $fdata['intervent_id'];
		$week_id = $fdata['shd_days'];
		$schedule_week = $fdata['schedule_week'];
		$suspend = $fdata['suspendable'];
		$pname = $this->common->getpatientsurname($pid);
		$int_name = $this->common->getinterventname($int_id);
		$int_time = $this->common->GetIntHour($cid, $pid, $int_id);
		if($do_action == "shd_edit"){
			$aid = $fdata['aid'];
			$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
			$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
			$stime = $this->common->get_hours($aid,$week_id);
			$pop = $aid.",'edit',";
		}elseif($do_action == "shd_confirm"){
			$aid = $fdata['aid'];
			$operator_name = $this->common->GetJobOperatornames($aid,$week_id);
			$operator_name_popup = $this->common->GetJobOperatornames_popup($aid,$week_id);
			$stime = $this->common->get_hours($aid,$week_id);
			$pop = $aid.",'yellow',";
		}elseif($do_action == "shd_new"){
			$pop = '';
		}
		$exp_hours = explode(":", $int_time);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}

		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
			if($week_id == '7'){ ?>
			<div class="wc-day-column-inner ui-droppable <?=$class?>" onclick="<?=$click?>(<?=$pop?><?=$shd_detail_id?>,<?=$cid?>,<?=$pid?>,<?=$int_id?>,<?=$week_id?>,<?=$int_hour?>,<?=$int_min?>,<?=$dist_val?>,<?=$weekNumber?>);">
						<div class="wc-cal-event ui-corner-all tooltip-<?=$class?>-7-<?=$week?>-<?=$day7?>" title="">
							<div class="wc-time ui-corner-all">
								<?php if($fplan_unplan != 'unplan'){ echo $stime; }else { echo ( sprintf( lang("JOBASSIGN::non_schedule")) ); } ?>
									<?php if($suspend == "1" && $fplan_unplan != 'plan'){ ?>&nbsp;&nbsp;<i class="icon-warning-sign" title="Suspend"></i> <?php } ?>
							</div>
							<div class="wc-title">
								<b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b><?=$pname?>
								<br>
								<?php if($fplan_unplan == 'unplan'){ ?>
								<b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b><?=$int_name?> <?php }else{ ?>
									<?=$operator_name?>
								<?php  } ?>
							</div>
							<div id="tooltip-info-7-<?=$class?>-<?=$week?>-<?=$day7?>" style="display: none;">
								<?php if($suspend == "1" && $fplan_unplan != 'plan'){ ?><p><b style="color: red;"><?php echo ( sprintf( lang("JOBASSIGN::high_priority")) ); ?></b></p><?php } ?>
								<?php if($fplan_unplan != 'unplan'){ ?><p><b><?php echo ( sprintf( lang("JOBASSIGN::schedule_time")) ); ?>:</b>&nbsp;<?=$stime?></p><?php } ?>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::patient")) ); ?>:</b>&nbsp;<?=$pname?></p>
								<p><b><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?>:</b>&nbsp;<?=$int_name?></p>
								<?php if($fplan_unplan != 'unplan'){ ?><p><?=$operator_name_popup?></p><?php } ?>
							</div>
						</div>
					</div>
<script>
	 $(function() {
	$( ".tooltip-<?=$class?>-7-<?=$week?>-<?=$day7?>" ).tooltip({
		position: { my: "left center", at: "top center" },
		content: function() { return $('#tooltip-info-7-<?=$class?>-<?=$week?>-<?=$day7?>').html(); }
	});
});
</script>
			<?php } $day7++; } ?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	</div>
<?php }
}

?>