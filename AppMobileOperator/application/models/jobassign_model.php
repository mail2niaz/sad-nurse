<?php
Class Jobassign_model extends CI_Model
{
	public function __construct(){
        parent::__construct();
       $this->set_timezone();
    }

    public function set_timezone(){
        $this->db->query("SET time_zone='+5:30'");
    }
	 private $tbl_apns= 'assign_job_list';

public function addreassignform()
	{
	 $job_assign_date = date("Y-m-d", strtotime($_REQUEST['job_date_assign']));
     $reassign_opt = $_REQUEST['reassign_opt'];
	 $oid = $_REQUEST['oid'];
	 $selaid = explode(",", $_REQUEST['selaid']);

	foreach($selaid as $eaid){
		$sel = "SELECT * FROM assign_job_list WHERE $oid IN (pry_oid,sec_oid,sup_id) AND aid = '$eaid' AND job_date_assign = '$job_assign_date'";
		$qry = mysql_query($sel);
		$fet = mysql_fetch_assoc($qry);
		$aid = $fet['aid'];
		$pry_oid = $fet['pry_oid'];
		$sec_oid = $fet['sec_oid'];
		$sup_id = $fet['sup_id'];
		if($pry_oid == $oid){
			$field = "pry_oid";
			$role = "1";
		}elseif($sec_oid == $oid){
			$field = "sec_oid";
			$role = "2";
		}elseif($sup_id == $oid){
			$field = "sup_id";
			$role = "3";
		}

		mysql_query("UPDATE assign_job_list SET $field = '$reassign_opt' WHERE $oid IN (pry_oid,sec_oid,sup_id) AND aid = '$eaid' AND job_date_assign = '$job_assign_date'");
		mysql_query("INSERT INTO `assign_job_status` (`aid`, `oid`, `opt_type`) VALUES ('$aid', '$reassign_opt', '$role') ON DUPLICATE KEY UPDATE  `aid` = values(aid), `oid` = values(oid), `opt_type` = values(opt_type)");
	}
}

function check_optweek_availabel_details($opt,$eaid,$job_date,$eend_hour,$eend_min) {
		$opt_id = $opt;
		$aid = $eaid;
		$job_date_assign = $job_date;
		$datetime = date('Y-m-d', strtotime($job_date_assign));

		$ehourcombo_form = $eend_hour;
		$emincombo_form = $eend_min;
		$morning = array();
		for($m = 6; $m <= 13; $m++){
			$morning[] = $m;
		}
		$afternoon = array();
		for($a = 13; $a <= 22; $a++){
			$afternoon[] = $a;
		}
		if(in_array($ehourcombo_form, $morning)){
			$leavetime = 1;
			if($ehourcombo_form == "13" && $emincombo_form > 0){
				$leavetime = 2;
			}
		}elseif(in_array($ehourcombo_form, $afternoon)){
			$leavetime = 2;
		}

if(isset($_REQUEST['actionfrom'])){
	$moveweek = $_REQUEST['moveweek'];
	$moveyear = $_REQUEST['moveyear'];
		$query = $this->db->query("SELECT * FROM assign_job_list WHERE week = '$moveweek' AND year = '$moveyear' AND $opt_id IN (pry_oid,sec_oid,sup_id)");
	return $query;
}else{
$check_opt_leave = "SELECT oid,FROM_UNIXTIME(SUBSTRING(wrk_date, 1, LENGTH(wrk_date)-3), '%Y-%m-%d') as sss FROM `operator_working_days` where leavetime = '$leavetime' AND FROM_UNIXTIME(SUBSTRING(wrk_date, 1, LENGTH(wrk_date)-3), '%Y-%m-%d') = '$datetime' AND oid = '$opt_id'";
$check_qry = mysql_query($check_opt_leave);
$chk_cnt = mysql_num_rows($check_qry);
if($chk_cnt > 0){
	$err = "leaveerror";
	return $err;
}else{
	$query = $this->db->query("select a.* from assign_job_list as a where $opt_id IN (a.pry_oid, a.sec_oid, a.sup_id) AND a.job_date_assign = '$datetime' OR ((SELECT COUNT(*) FROM `operator_working_days` where FROM_UNIXTIME(SUBSTRING(wrk_date, 1, CHAR_LENGTH(wrk_date) - 3), '%Y-%m-%d') = $datetime) = 1)");
	return $query;
}
}
}


/* 8-05-2014 */
public function getmorningafterjoblist($oid, $date, $section, $type)
{

		$date_val = date('Y-m-d', $date);
		if($section == 1){
			$cond = " AND (start_time_hour >= 6 AND (start_time_hour <= 13 AND (start_time_min <=(case when start_time_hour >= 13 then 0 else 60 end))))";
		}elseif($section == 2){
			$cond = " AND (start_time_hour >= 13 AND (start_time_min >=(case when start_time_hour > 13 then 0 else 1 end)))";
		}else{
			$cond = "";
		}
		if($type == "y"){
			$new_oid = '-'.$oid;
		}else{
			$new_oid = $oid;
		}
		$sel = $this->db->query("SELECT * from assign_job_list where $new_oid IN (pry_oid,sec_oid,sup_id) and job_date_assign = '$date_val' $cond order by TIME(CONCAT(start_time_hour,':', start_time_min)) ASC");
		//echo "SELECT * from assign_job_list where $new_oid IN (pry_oid,sec_oid,sup_id) and job_date_assign = '$date_val' $cond order by TIME(CONCAT(start_time_hour,':', start_time_min)) ASC";
		$val = $sel->result();
		return $val;
}


public function filter_getmorningafterjoblist($oid, $pid, $dist_id, $date, $section)
{
		$date_val = date('Y-m-d', $date);
		if($section == 1){
			$cond = " AND (start_time_hour >= 6 AND (start_time_hour <= 13 AND (start_time_min <=(case when start_time_hour >= 13 then 0 else 60 end))))";
		}elseif($section == 2){
			$cond = " AND (start_time_hour >= 13 AND (start_time_min >=(case when start_time_hour > 13 then 0 else 1 end)))";
		}else{
			$cond = "";
		}
		$sel = $this->db->query("SELECT * from assign_job_list where $oid IN (pry_oid,sec_oid,sup_id) and job_date_assign = '$date_val' $cond order by TIME(CONCAT(start_time_hour,':', start_time_min)) ASC");
		$val = $sel->result();
		return $val;
}
public function getoperatorleave($oid,$date)
{
		$date_val = date('Y-m-d', $date);
		$sel = $this->db->query("SELECT leavetime FROM `operator_working_days` where oid = '$oid' AND FROM_UNIXTIME(SUBSTRING(wrk_date, 1, LENGTH(wrk_date)-3), '%Y-%m-%d') = '$date_val'");
		$val = $sel->result();
		$leavetime = $val[0]->leavetime;
		return $leavetime;
}

public function getinterventtime($iid)
{
		$this->db->select('intervent_hour, intervent_fortnightly, suspendable');
		$this -> db -> where('ciw_id = ' . "'" . $iid . "'");
		$query = $this->db->get('contract_intervent_weekdays');
		$data = $query->result();
		return $data;
}

public function select_updated_opt_list()
{
	date_default_timezone_set("Asia/Kolkata");
	$timezone = date_default_timezone_get();
	$role = $this->input->post('queryString');
	$job_date_assign = date("Y-m-d", strtotime($this->input->post('job_date_assign')));
	$start_hid_hour = $this->input->post('start_hid_hour');
	$start_hid_min = $this->input->post('start_hid_min');
	$morning = array();
	for($m = 6; $m <= 13; $m++){
		$morning[] = $m;
	}
	$afternoon = array();
	for($a = 13; $a <= 22; $a++){
		$afternoon[] = $a;
	}
	if(in_array($start_hid_hour, $morning)){
		$leavetime = 1;
		if($start_hid_hour == "13" && $start_hid_min > 0){
			$leavetime = 2;
		}
	}elseif(in_array($start_hid_hour, $afternoon)){
		$leavetime = 2;
	}

	if($this->input->post('cont_tag') != ''){
	$tag_id = explode(",", $this->input->post('cont_tag'));
	$i =1;
	$count = count($tag_id);
	 $tags = '';
	 foreach($tag_id as $key=>$values){
			if($i == $count){
				$tags .=  "(".$values.")";
			} else{
				$tags .=  "(".$values.")|";
			}
		 $i++;
	 }
	 $qry_tag = " AND tags regexp '(^|,)($tags)(,|$)'";
	 }else{
	 	$qry_tag = "";
	 }
 $sel1 = "SELECT oid FROM `operator_working_days` where (leavetime = '$leavetime' AND FROM_UNIXTIME(SUBSTRING(wrk_date, 1, LENGTH(wrk_date)-3), '%Y-%m-%d') = '$job_date_assign') OR (FROM_UNIXTIME(SUBSTRING(wrk_date, 1, LENGTH(wrk_date)-3), '%Y-%m-%d') = '$job_date_assign' AND leavetime = '3')";
	$sel = "select oid,username,firstname,lastname,role from operators where role IN ($role) AND status = '1' $qry_tag AND oid NOT IN($sel1)";

	$query = $this->db->query($sel);
	return $query;


}


/* Yellow Box */
public function get_yellow_joblist_filter($navweek, $navyear, $filt_oid,$pid, $dist_id, $date, $filter_box_status)
{
		$date_val = date('Y-m-d', $date);
		$oid_data = array();

	if($pid == "0" && $dist_id == '0' && $filter_box_status != '0' && $filt_oid == '0'){
			//echo "two";
			$sel = $this->db->query("SELECT * from assign_job_list where job_date_assign = '$date_val' AND week='$navweek' AND year='$navyear' order by TIME(CONCAT(start_time_hour,':', start_time_min)) ASC");
		}elseif($filt_oid != '0' && $pid != '0' && $dist_id == '0' && $filter_box_status == '0'){
			$sel = $this->db->query("SELECT * from assign_job_list where patient_id = '$pid' AND -$filt_oid IN (pry_oid,sec_oid,sup_id) AND week='$navweek' AND year='$navyear' order by TIME(CONCAT(start_time_hour,':', start_time_min)) ASC");
		}elseif($filt_oid != '0' && $pid != '0' && $dist_id != '0' && $filter_box_status != '0'){
			//echo "old_one";
			$sel = $this->db->query("SELECT * from assign_job_list where patient_id = '$pid' AND -$filt_oid IN (pry_oid,sec_oid,sup_id) AND week='$navweek' AND year='$navyear' order by TIME(CONCAT(start_time_hour,':', start_time_min)) ASC");
		}
		elseif($filt_oid != '0' && $pid == "0" && $dist_id == '0'){
			//echo "one";
			$sel = $this->db->query("SELECT * from assign_job_list where -$filt_oid IN (pry_oid,sec_oid,sup_id) AND week='$navweek' AND year='$navyear' order by TIME(CONCAT(start_time_hour,':', start_time_min)) ASC");
		}
		elseif($filt_oid != '0' && $pid != "0" && $filter_box_status != '0'){
			//echo "one_new";
			$sel = $this->db->query("SELECT * from assign_job_list where patient_id = '$pid' AND -$filt_oid IN (pry_oid,sec_oid,sup_id) AND week='$navweek' AND year='$navyear' order by TIME(CONCAT(start_time_hour,':', start_time_min)) ASC");
		}
		elseif($pid != "0" && $dist_id == '0'){
			//echo "three";
			$sel = $this->db->query("SELECT * from assign_job_list where patient_id = '$pid' and job_date_assign = '$date_val' order by TIME(CONCAT(start_time_hour,':', start_time_min)) ASC");
		}elseif($dist_id != '0'){
			//echo "four";
			$sel = $this->db->query("select oid from operators as a,assign_job_list as b where dist_id = '$dist_id' AND -a.oid IN (pry_oid,sec_oid,sup_id)");
		}


if($dist_id != '0' && $pid == "0" && $dist_id == '0' && $filter_box_status == '0'){
	$i = 0;
	foreach($sel->result() as $res){
		$oid_data[listoid][$i] = $res->oid;
		$i++;
	}
}else{
	$i = 0;
foreach($sel->result() as $res){
	//print_r($res);
	if ($res->pry_oid != '0' && (strpos($res->pry_oid,'-') !== false)) {
 		$oid_data['listoid'][$i][] = substr($res->pry_oid, 1);
	}
	if ($res->sec_oid != '0' && (strpos($res->sec_oid,'-') !== false)) {
 		$oid_data['listoid'][$i][] = substr($res->sec_oid, 1);
	}
	if ($res->sup_id && (strpos($res->sup_id,'-') !== false)) {
 		$oid_data['listoid'][$i][] = substr($res->sup_id, 1);
	}
	$i++;
}
}
//print_r($oid_data);
	return $oid_data;
}

public function get_yellow_joblist($date)
{
	$date_val = date('Y-m-d', $date);
	$oid_data = array();
	$sel = $this->db->query("SELECT * from assign_job_list where job_date_assign = '$date_val'");
	$i = 0;
foreach($sel->result() as $res){
	if ($res->pry_oid != '0' && (strpos($res->pry_oid,'-') !== false)) {
 		$oid_data['listoid'][$i][] = substr($res->pry_oid, 1);
	}
	if ($res->sec_oid != '0' && (strpos($res->sec_oid,'-') !== false)) {
 		$oid_data['listoid'][$i][] = substr($res->sec_oid, 1);
	}
	if ($res->sup_id && (strpos($res->sup_id,'-') !== false)) {
 		$oid_data['listoid'][$i][] = substr($res->sup_id, 1);
	}
	$i++;
}
	//print_r($oid_data);
	return $oid_data;
}

public function yellowgetmorningafterjoblist($oid, $date, $section)
{
		$date_val = date('Y-m-d', $date);
		if($section == 1){
			$cond = " AND (start_time_hour >= 6 AND (start_time_hour <= 13 AND (start_time_min <=(case when start_time_hour >= 13 then 0 else 60 end))))";
		}elseif($section == 2){
			$cond = " AND (start_time_hour >= 13 AND (start_time_min >=(case when start_time_hour > 13 then 0 else 1 end)))";
		}else{
			$cond = "";
		}
		$sel = $this->db->query("SELECT * from assign_job_list where -$oid IN (pry_oid,sec_oid,sup_id) and job_date_assign = '$date_val' $cond order by TIME(CONCAT(start_time_hour,':', start_time_min)) ASC");
		$val = $sel->result();
		return $val;
}

/* Yellow box End */

/* Move Job */
public function put_move_job()
{
	$oid = $_REQUEST['oid'];
	$moveweek = $_REQUEST['moveweek'];
	$moveyear = $_REQUEST['moveyear'];
	$move_opt = $_REQUEST['move_opt'];
	$oid_data = array();
	$sel = "SELECT * FROM assign_job_list WHERE week = '$moveweek' AND year = '$moveyear' AND -$oid IN (pry_oid,sec_oid,sup_id)";
	$qry = mysql_query($sel);
	$i = 0;
	while($fet = mysql_fetch_assoc($qry)){
		$aid = $fet['aid'];
		$request_id = $fet['request_id'];
		$patient_id = $fet['patient_id'];
		$job_date_assign = $fet['job_date_assign'];
		$sel_sec = "SELECT * FROM assign_job_list WHERE -$oid IN (pry_oid,sec_oid,sup_id) AND patient_id = '$patient_id' AND job_date_assign = '$job_date_assign'";
		$qry_sec = mysql_query($sel_sec);
		$fet_sec = mysql_fetch_assoc($qry_sec);
		$pry_oid = substr($fet_sec['pry_oid'], 1);
		$sec_oid = substr($fet_sec['sec_oid'], 1);
		$sup_id = substr($fet_sec['sup_id'], 1);
		if($pry_oid == $oid){
			$field = "pry_oid = '$move_opt'";
			$role = "1";
		}elseif($sec_oid == $oid){
			$field = "sec_oid = '$move_opt'";
			$role = "2";
		}elseif($sup_id == $oid){
			$field = "sup_id = '$move_opt'";
			$role = "3";
		}
		if($this->getoperatorleave($move_opt,strtotime($job_date_assign)) == ""){
			mysql_query("UPDATE assign_job_list SET $field WHERE -$oid IN (pry_oid,sec_oid,sup_id) AND patient_id = '$patient_id' AND job_date_assign = '$job_date_assign'");
				mysql_query("INSERT INTO `assign_job_status` (`aid`, `oid`, `opt_type`) VALUES ('$aid', '$move_opt', '$role') ON DUPLICATE KEY UPDATE  `aid` = values(aid), `oid` = values(oid), `opt_type` = values(opt_type)");
		}
$i++;
	}
}
public function get_moved_operator_exist($oid, $week,$year)
{
	$sel = $this->db->query("SELECT * FROM assign_job_list WHERE week = '$week' AND year = '$year' AND -$oid IN (pry_oid,sec_oid,sup_id)");
	$val = $sel->result();
		return $val;
}

public function getweekfortnightly($report_type, $weekno)
{
	if($report_type == '1'){
		$sel = $this->db->query("select a.pid, sum(a.total_weekdays) as total_contract, (select count(aid) from assign_job_list where patient_id = a.pid AND week = '$weekno') as planned_job, (sum(a.total_weekdays) - (select count(aid) from assign_job_list where patient_id = a.pid AND week = '$weekno')) as difference  from contract_intervent_weekdays as a where a.week_days != '' group by a.pid");
	}elseif($report_type == '2'){
		$pweek = $weekno - 1;
		$sel = $this->db->query("select a.pid, (select count(aid) from assign_job_list where patient_id = a.pid AND week IN ('$pweek','$weekno')) as planned_job from contract_intervent_weekdays as a where a.intervent_fortnightly = 'on' group by a.pid");
	}
	$val = $sel->result();
	return $val;
}

public function getexceljoblist($oid, $date)
{

		$date_val = date('Y-m-d', $date);
		//echo "SELECT * from assign_job_list where $oid IN (pry_oid,sec_oid,sup_id) and job_date_assign = '$date_val' order by TIME(CONCAT(start_time_hour,':', start_time_min)) ASC";
		$sel = $this->db->query("SELECT * from assign_job_list where $oid IN (pry_oid,sec_oid,sup_id) and job_date_assign = '$date_val' order by TIME(CONCAT(start_time_hour,':', start_time_min)) ASC");
		$val = $sel->result();
		return $val;
}


public function jobcontract_ceased_date()
{
	$cid = $_REQUEST['cid'];
	$today_date = strtotime($_REQUEST['date']);
		$sel_cease_date = "select * from contract_details where cid = '$cid' AND ($today_date between start_date AND end_date)";
		$qry_cd = mysql_query($sel_cease_date);
		$fet_cd = mysql_fetch_assoc($qry_cd);
		$start_date = date("d-m-Y",$fet_cd['start_date']);

		if($fet_cd['last_ceased_date'] != '0'){
			$last_ceased_date = $fet_cd['last_ceased_date'];
			if($last_ceased_date > $today_date){
				return "yes";
			}else{
				return "No";
			}
		}else{
			$last_ceased_date = $fet_cd['end_date'];
			if($last_ceased_date >= $today_date){
				return "yes";
			}else{
				return "No";
			}
		}
}
}
?>