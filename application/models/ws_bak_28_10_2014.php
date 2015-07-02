<?php
Class Ws extends CI_Model
{
public function getoperatorpatient($id,$currdate,$week)
{

$q = $this->db->query("SELECT DISTINCT AJ.aid, `P`.pid,`P`.p2000_id, `P`.pname, `P`.surname, `P`.sex, `P`.email, `P`.dist_id, `P`.dob, `P`.contact_no, `P`.ssn, `P`.note, `A`.`request_id` as requestid, `A`.`intervent_type_id`, `O`.`role`, `A`.`start_time_hour`, `A`.`start_time_min`, `A`.`end_time_hour`, `A`.`end_time_min`,CW.patient_address as address,CW.patient_city as city,CW.patient_zip as zip_code,CW.patient_latlng as latlang FROM (`assign_job_list` as A) JOIN `patients` as P ON `A`.`patient_id`= `P`.`pid` JOIN `operators` as O ON `A`.`pry_oid`= `O`.`oid` OR A.sec_oid= O.oid OR A.sup_id = O.oid JOIN `assign_job_status` as AJ ON `AJ`.`aid`= `A`.`aid` JOIN contract_intervent_weekdays as CW on (CW.ciw_id = A.contract_int_id AND CW.pid = A.patient_id AND CW.intervent_id = A.intervent_type_id) WHERE `AJ`.`oid` = '$id' AND `A`.`sel_week_day` = '$currdate' AND `A`.`week` = '$week' AND `AJ`.`status` = '1'");

	$val = $q->result();
	return $val;
}

public function getfeatureoperatorpatient($oid,$todaydate,$sevendate)
{
	$td = date('Y-m-d', $todaydate);
	$sd = date('Y-m-d', $sevendate);
$q = $this->db->query("SELECT DISTINCT AJ.aid, `P`.*, `A`.`request_id` as requestid, `A`.`intervent_type_id`, `O`.`role`, `A`.`start_time_hour`, `A`.`start_time_min`, `A`.`end_time_hour`, `A`.`end_time_min`,`A`.`job_date_assign` FROM (`assign_job_list` as A) JOIN `patients` as P ON `A`.`patient_id`= `P`.`pid` JOIN `operators` as O ON `A`.`pry_oid`= `O`.`oid` OR A.sec_oid= O.oid OR A.sup_id = O.oid JOIN `assign_job_status` as AJ ON `AJ`.`aid`= `A`.`aid` WHERE `AJ`.`oid` = '$oid' AND (`A`.`job_date_assign` between '$td' AND '$sd') AND `AJ`.`status` = '1' ORDER BY `A`.job_date_assign ASC, TIME(CONCAT(`A`.start_time_hour,':', `A`.start_time_min)) ASC");
	$val = $q->result();
	return $val;
}


public function getoperatorpatientinfo($rid, $pid)
{
	$this->db->select('piid, pid, rid, info');
	$this->db->from('patients_info_details');
	$this->db->where('pid', $pid);
	$this->db->where('status', '1');
	$this->db->where("FIND_IN_SET('$rid',rid) !=", 0);
	$q = $this->db->get();
	$val = $q->result();
	return $val;
}

public function getpatientimages($piid, $pid)
{
	$this->db->select('P.piid,P.pid,P.files');
	$this->db->from('patients_info_image as P');
	$this->db->where('P.piid', $piid);
	$this->db->where('P.pid', $pid);
	$q = $this->db->get();
	$val = $q->result();
	return $val;
}
/*
public function getoptfields($rid,$intervent_type_id)
{
	$this->db->select('*');
	$this->db->from('intervention_fields as IF');
	$this->db->join('intervention_types_assign as IA', 'IA.int_type_asg_id = IF.int_type_asg_id');
	$this->db->where('IA.role', $rid);
	$this->db->where('IA.int_type_id', $intervent_type_id);
	$this->db->order_by("order", "asc");
	$q = $this->db->get();
	$val = $q->result();
	return $val;
}
*/
public function get_dynamic_fields($rid,$intervent_type_id)
{
	$q = $this->db->query("select a.label_name,a.type,a.options,a.required,a.order,b.int_type_id as intervent_type_id from intervention_fields as a, intervention_types_assign as b where (b.int_type_asg_id  =  a.int_type_asg_id) and (b.role='$rid' and b.int_type_id = '$intervent_type_id') and visible = 1 order by `order` ASC");
	$val = $q->result();
	return $val;
}

public function putgetfieldsdata($ary)
{
	//print_r($_REQUEST);
	$pid = $ary['pid'];
	$aid = $ary['aid'];
	$time = time();
	$oid = $ary['oid'];
	$request_id = $ary['request_id'];
	$int_type_id = $ary['int_type_id'];

	/* Time Details	 */
	$current_date = date("Y-m-d");
	$starttime = $ary['starttime'];
	$endtime = $ary['endtime'];
	$duration = $ary['durationTimeValue'];
	$note = $ary['notes'];
	$startloc = $ary['startloc'];
	$endloc = $ary['endloc'];
	 /* Time Details */

	$query_int_id = $this->db->query("SELECT int_type_asg_id FROM intervention_types_assign where int_type_id='$int_type_id'");
	$int_id = $query_int_id->result();
	$int_type_asg_id = $int_id[0]->int_type_asg_id;

	$query_oid = $this->db->query("SELECT role FROM operators where oid='$oid';");
	$role_id = $query_oid->result();
	$rid = $role_id[0]->role;

	$this->db->select('label_name');
	$this->db->from('intervention_fields as I');
	$this->db->where('int_type_asg_id', $int_type_asg_id);
	$query = $this -> db -> get();
	$val = $query->result();
	/* Customer Deteced */
	if($pid != "pid"){
	foreach ($ary as $key => $value){
		foreach ($val as $k => $v){
			if($key == $v->label_name)
			{
				$value = $ary[$v->label_name];
				$succ = $this->db->query("insert into patients_intervention_values(`aid`, `pid`,`oid`,`request_id`,`meta_name`,`meta_value`,`entry_date`) values('$aid', '$pid','$oid','$request_id','$v->label_name','$value','$current_date')");

			}
		}
	}
$succ = $this->db->query("UPDATE assign_job_status SET status='2', closed_datetime = '$time' WHERE aid = '$aid' AND oid = '$oid'");

	/* Patient Info Details */
	if(isset($ary['new_pat_info'])){
$new_pat_info = $ary['new_pat_info'];
$exp_new_pat_info = explode("~", $new_pat_info);
$current_date_time = time();
//print_r($exp_new_pat_info);
for($i = 0; $i < count($exp_new_pat_info); $i++){
	$pat_val = explode(",", $exp_new_pat_info[$i]);
	$patinfo_pid = $pat_val[0];
	$patinfo_img = $pat_val[1];
	$patinfo = $pat_val[2];
	$sel_dup = mysql_query("SELECT * FROM patients_info_details WHERE `pid` = '$patinfo_pid' and `rid`='$rid' and `info` = '$patinfo'");
	$cnt_dup = mysql_num_rows($sel_dup);
	if($cnt_dup > 0){
			$fet_dup = mysql_fetch_assoc($sel_dup);
			$piid = $fet_dup['piid'];
	}else{
		$this->db->query("INSERT INTO patients_info_details(`pid`, `rid`, `info`, `entry_date`, `upload _id`, `status`) VALUES('$patinfo_pid', '$rid', '$patinfo', '$current_date_time', '$oid', '2')");

	$piid = mysql_insert_id();
	}

	$this->db->query("INSERT INTO patients_info_image(`piid`, `pid`, `files`) VALUES('$piid','$patinfo_pid','$patinfo_img')");

}

	}
/* End Patient Info Details */

/* Time Duration */
$start_address = mysql_escape_string($this->common->getaddressusinglatlng($startloc));
$end_address = mysql_escape_string($this->common->getaddressusinglatlng($endloc));

	//$succ = $this->db->query("insert into patients_intervention_extra_details(`aid`, `pid`,`oid`,`request_id`,`start_time`,`end_time`,`duration`,`note`,`entry_date`,`start_location`,`end_location`,`data_coming_from`,`intervent_id`) values('$aid', '$pid','$oid','$request_id','$starttime','$endtime','$duration','$note','$current_date','$startloc','$endloc','2','$int_type_id')");

	$succ = $this->db->query("insert into patients_intervention_extra_details(`aid`, `pid`,`oid`,`request_id`,`start_time`,`end_time`,`duration`,`note`,`entry_date`,`start_location`,`end_location`,`data_coming_from`,`intervent_id`, `start_address`, `end_address`) values('$aid', '$pid','$oid','$request_id','$starttime','$endtime','$duration','$note','$current_date','$startloc','$endloc','2','$int_type_id','$start_address','$end_address')");

	/* End */
	return $succ;

	}else{
		$succ =  "Patient Mismatched.";
		return $succ;
	}
}

public function offline_save_data()
{
	$ary = $_REQUEST;
	//echo "PID=".$ary['pid']."---AID=".$ary['aid']."---OID=".$ary['oid']."---Request-Id=".$ary['request_id'];
	//exit;
	$pid = $ary['pid'];
	$aid = $ary['aid'];
	$time = time();
	$oid = $ary['oid'];
	$request_id = $ary['request_id'];
	$int_type_id = $ary['int_type_id'];

	/* Time Details	 */
	$current_date = date("Y-m-d");
	$starttime = $ary['starttime'];
	$endtime = $ary['endtime'];
	$duration = $ary['durationTimeValue'];
	$note = $ary['notes'];
	$startloc = $ary['startloc'];
	$endloc = $ary['endloc'];
	 /* Time Details */

	$query_int_id = $this->db->query("SELECT int_type_asg_id FROM intervention_types_assign where int_type_id='$int_type_id'");
	$int_id = $query_int_id->result();
	$int_type_asg_id = $int_id[0]->int_type_asg_id;

	$query_oid = $this->db->query("SELECT role FROM operators where oid='$oid';");
	$role_id = $query_oid->result();
	$rid = $role_id[0]->role;

	$this->db->select('label_name');
	$this->db->from('intervention_fields as I');
	$this->db->where('int_type_asg_id', $int_type_asg_id);
	$query = $this -> db -> get();
	$val = $query->result();
	/* Customer Deteced */
	if($pid != "pid"){
	foreach ($ary as $key => $value){
		foreach ($val as $k => $v){
			if($key == $v->label_name)
			{
				$value = $ary[$v->label_name];
				$succ = $this->db->query("insert into patients_intervention_values(`aid`, `pid`,`oid`,`request_id`,`meta_name`,`meta_value`,`entry_date`) values('$aid', '$pid','$oid','$request_id','$v->label_name','$value','$current_date')");

			}
		}
	}
$succ = $this->db->query("UPDATE assign_job_status SET status='2', closed_datetime = '$time' WHERE aid = '$aid' AND oid = '$oid'");

	/* Patient Info Details */
	if(isset($ary['new_pat_info'])){
$new_pat_info = $ary['new_pat_info'];
$exp_new_pat_info = explode("~", $new_pat_info);
$current_date_time = time();
//print_r($exp_new_pat_info);
for($i = 0; $i < count($exp_new_pat_info); $i++){
	$pat_val = explode(",", $exp_new_pat_info[$i]);
	$patinfo_pid = $pat_val[0];
	$patinfo_img = $pat_val[1];
	$patinfo = $pat_val[2];
	$sel_dup = mysql_query("SELECT * FROM patients_info_details WHERE `pid` = '$patinfo_pid' and `rid`='$rid' and `info` = '$patinfo'");
	$cnt_dup = mysql_num_rows($sel_dup);
	if($cnt_dup > 0){
			$fet_dup = mysql_fetch_assoc($sel_dup);
			$piid = $fet_dup['piid'];
	}else{
		$this->db->query("INSERT INTO patients_info_details(`pid`, `rid`, `info`, `entry_date`, `upload _id`, `status`) VALUES('$patinfo_pid', '$rid', '$patinfo', '$current_date_time', '$oid', '2')");

	$piid = mysql_insert_id();
	}

	$this->db->query("INSERT INTO patients_info_image(`piid`, `pid`, `files`) VALUES('$piid','$patinfo_pid','$patinfo_img')");

}

	}
/* End Patient Info Details */

/* Time Duration */
$start_address = mysql_escape_string($this->common->getaddressusinglatlng($startloc));
$end_address = mysql_escape_string($this->common->getaddressusinglatlng($endloc));

	//$succ = $this->db->query("insert into patients_intervention_extra_details(`aid`, `pid`,`oid`,`request_id`,`start_time`,`end_time`,`duration`,`note`,`entry_date`,`start_location`,`end_location`,`data_coming_from`,`intervent_id`) values('$aid', '$pid','$oid','$request_id','$starttime','$endtime','$duration','$note','$current_date','$startloc','$endloc','2','$int_type_id')");

	$succ = $this->db->query("insert into patients_intervention_extra_details(`aid`, `pid`,`oid`,`request_id`,`start_time`,`end_time`,`duration`,`note`,`entry_date`,`start_location`,`end_location`,`data_coming_from`,`intervent_id`, `start_address`, `end_address`) values('$aid', '$pid','$oid','$request_id','$starttime','$endtime','$duration','$note','$current_date','$startloc','$endloc','2','$int_type_id','$start_address','$end_address')");

	/* End */
	return $succ;

	}else{
		$succ =  "Patient Mismatched.";
		return $succ;
	}
}


public function putdata()
{
	//$succ = $this->db->query("ALTER TABLE `patients_intervention_extra_details` CHANGE `duration` `duration` TIME NOT NULL");
//$succ = $this->db->query("ALTER TABLE `patients_intervention_extra_details` ADD `entry_date` DATE NOT NULL AFTER `duration`");

//02-DEC-2013 $succ1 = $this->db->query("ALTER TABLE `contract_details`  ADD `suspendable` INT(2) NOT NULL AFTER `note`");
//02-DEC-2013 $succ2 = $this->db->query("ALTER TABLE `contract_intervent_weekdays_shd_details`  ADD `start_time_hour` INT NOT NULL AFTER `schedule_week`,  ADD `end_time_hour` INT NOT NULL AFTER `start_time_hour`");
//02-DEC-2013 $succ3 = $this->db->query("ALTER TABLE `contract_intervent_weekdays_shd_details`  ADD `suspendable` INT(2) NOT NULL AFTER `end_time_hour`");

//02-DEC-2013 $succ4 = $this->db->query("ALTER TABLE `contract_intervent_weekdays`  ADD `suspendable` INT NOT NULL AFTER `week_days`");

//03-DEC-2013 $this->db->query("ALTER TABLE `assign_pdns`  ADD `current_year` INT NOT NULL AFTER `current_week`");
//03-DEC-2013 $this->db->query("ALTER TABLE `contract_intervent_weekdays_shd_details` ADD `schedule_year` INT NOT NULL AFTER `schedule_week`");

/* 03-DEC-2013  $succ1 = $this->db->query("CREATE TABLE IF NOT EXISTS `assign_pdns_history` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` varchar(50) NOT NULL,
  `shd_detail_id` int(11) NOT NULL,
  `intervent_type_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `pry_oid` int(11) NOT NULL,
  `sec_oid` int(11) NOT NULL,
  `sup_id` int(11) NOT NULL,
  `cid` int(11) NOT NULL COMMENT 'Contract ID',
  `sel_week_day` int(11) NOT NULL,
  `start_time_hour` int(11) NOT NULL,
  `start_time_min` int(11) NOT NULL,
  `end_time_hour` int(11) NOT NULL,
  `end_time_min` int(11) NOT NULL,
  `current_week` int(11) NOT NULL,
  `current_year` int(11) NOT NULL,
  `assign_dtime` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1-Open, 2- Closed',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1"); */

//return $succ1;

/*
return $succ2;
return $succ3;
return $succ4;*/

/*
$succ = $this->db->query("TRUNCATE `assign_job_status`");
$succ = $this->db->query("TRUNCATE `assign_pdns`");
$succ = $this->db->query("TRUNCATE `assign_pdns_history`");
$succ = $this->db->query("TRUNCATE `patients_intervention_extra_details`");
$succ = $this->db->query("TRUNCATE `patients_intervention_values`");


$succ = $this->db->query("update `contract_intervent_weekdays_shd_details` set is_schedule = '0',schedule_week = '0',schedule_year='0',start_time_hour ='0',end_time_hour='0'");

*/
/*
$succ = $this->db->query("ALTER TABLE `operators` ADD `suspended` VARCHAR( 50 ) NOT NULL DEFAULT 'off' COMMENT 'on - Suspended, off - Non Suspended' AFTER `hours_contract`");*/

$sel_job = mysql_query("SELECT aid,sel_week_day,current_week,current_year FROM assign_pdns");
while($fet_job = mysql_fetch_assoc($sel_job)){
$aid = $fet_job['aid'];
$sel_week_day = $fet_job['sel_week_day'];
$current_week = $fet_job['current_week'];
$current_year = $fet_job['current_year'];
$job_assign_date = date("Y-m-d", strtotime($current_year."W".$current_week.$sel_week_day));
echo "update assign_pdns set job_date_assign = '$job_assign_date' where aid = '$aid'<br>";
mysql_query("update assign_pdns set job_date_assign = '$job_assign_date' where aid = '$aid'");
}
}

public function updatejobassign()
{
	$sel_job = mysql_query("SELECT aid,sel_week_day,current_week,current_year FROM assign_pdns_history");
	while($fet_job = mysql_fetch_assoc($sel_job)){
		$aid = $fet_job['aid'];
		$sel_week_day = $fet_job['sel_week_day'];
		$current_week = $fet_job['current_week'];
		$current_year = $fet_job['current_year'];
		$job_assign_date = date("Y-m-d", strtotime($current_year."W".$current_week.$sel_week_day));
		echo "update assign_pdns_history set job_date_assign = '$job_assign_date' where aid = '$aid'<br>";
		mysql_query("update assign_pdns_history set job_date_assign = '$job_assign_date' where aid = '$aid'");
	}

	}
}
?>