<?php
Class Common extends CI_Model
{
public function commontimeformat($value)
{
	if(strlen($value)==1){
		$digit = "0".$value;
	}else{
		$digit = $value;
	}
	return $digit;

}

public function rolelist()
{
		$this -> db -> select('rid, type');
		$this -> db -> from('mt_role');
		$query = $this -> db -> get();
		return $query;
}

public function districtlist()
{
		$this -> db -> select('did, dist_name');
		$this -> db -> from('district');
		$query = $this -> db -> get();
		return $query;
}

public function districtlist_new()
{
		$this -> db -> select('did, dist_name');
		$this -> db -> from('district');
		$query = $this -> db -> get();
		$val = $query->result();
		return $val;
}

public function invrolelist()
{
		$this -> db -> select('rid, type');
		$this -> db -> from('mt_role');
		$this -> db -> where('status = 1');
		$query = $this -> db -> get();
		return $query;
}

public function getrolename($id)
{
		$this -> db -> select('rid, type');
		$this -> db -> from('mt_role');
		$this -> db -> where('rid = ' . "'" . $id . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$rolename = $val[0]->type;
		}
		else
		{
			$rolename = lang('COMMON::role_not_assign');
		}

	return $rolename;
}
public function getoptroleID($role)
{
		$this -> db -> select('rid');
		$this -> db -> from('mt_role');
		$this -> db -> where('type = ' . "'" . $role . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$rid = $val[0]->rid;
		}
		else
		{
			$rid = lang('COMMON::role_not_assign');
		}

	return $rid;
}
public function getdistname($did)
{
		$this -> db -> select('did, dist_name');
		$this -> db -> from('district');
		$this -> db -> where('did = ' . "'" . $did . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$dist_name = $val[0]->dist_name;
		}
		else
		{
			$dist_name = "";
		}

	return $dist_name;
}
public function getdistID($dist)
{
		$this -> db -> select('did');
		$this -> db -> from('district');
		$this -> db -> where('dist_name = ' . "'" . $dist . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$did = $val[0]->did;
		}
		else
		{
			$did = "";
		}

	return $did;
}
public function createdistID($dist)
{
		$this -> db -> select('did');
		$this -> db -> from('district');
		$this -> db -> where('dist_name = ' . "'" . mysql_escape_string($dist) . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$did = $val[0]->did;
		}
		else
		{
			$time = time();
			$data=array(
			'dist_name' => $dist,
			'created_date'=>$time,
			);
			$this->db->insert("district",$data);
			$did = $this->db->insert_id();
		}

	return $did;
}


public function getroledetails($id)
{
		$this -> db -> select('*');
		$this -> db -> from('mt_role');
		$this -> db -> where('rid = ' . "'" . $id . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
		}
		else
		{
			$val = lang('COMMON::role_not_assign');
		}

	return $val;
}

public function getpatientlist(){
	$this->db->where('pstatus', '1');
	$this->db->order_by('surname', 'ASC');
	$query = $this->db->get('patients');
	$val = $query->result();
	return $val;
}

public function getintervent_type_list(){
	$this->db->where('int_status', '1');
	$query = $this->db->get('intervention_types');
	$val = $query->result();
	return $val;
}


public function getpatientname($pid)
{
		$this -> db -> select('pname,surname');
		$this -> db -> from('patients');
		$this->db->order_by('surname', 'ASC');
		$this -> db -> where('pid = ' . "'" . $pid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$name = $val[0]->pname;
			$surname = $val[0]->surname;
			$pname = $surname." ".$name;
		}
		else
		{
			$pname = lang('COMMON::no_patient');
		}

	return $pname;
}
public function getpatientsurname($pid)
{
		$this -> db -> select('surname');
		$this -> db -> from('patients');
		$this -> db -> where('pid = ' . "'" . $pid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$surname = $val[0]->surname;
			$pname = $surname;
		}
		else
		{
			$pname = lang('COMMON::no_patient');
		}

	return $pname;
}

public function getpatientfsurname($pid)
{
		$this -> db -> select('pname,surname');
		$this -> db -> from('patients');
		$this -> db -> where('pid = ' . "'" . $pid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$name = $val[0]->pname;
			$surname = $val[0]->surname;
			$pname = $surname." ".substr($name,0,1).".";
		}
		else
		{
			$pname = lang('COMMON::no_patient');
		}

	return $pname;
}
public function getoperatorlist(){
	$this->db->where('status', '1');
	$this->db->order_by('lastname', 'ASC');
	$query = $this->db->get('operators');
	return $query;
}
public function getoperatorlist_new(){
	$this->db->where('status', '1');
	$this->db->order_by('lastname', 'ASC');
	$query = $this->db->get('operators');
	$val = $query->result();
	return $val;
}

public function getoperatorlist_hole_role($ids, $tag_id, $weekdate=NULL){
	 $exp =explode(",", $ids);
	 $i =1;
	 $count = count($tag_id);
	 if($count > 0){
	 $tags = '';
	 foreach($tag_id as $key=>$values){
			if($i == $count){
				$tags .=  "(".$values.")";
			} else{
				$tags .=  "(".$values.")|";
			}
		 $i++;
	 }
	  $qry_tag = "tags regexp '(^|,)($tags)(,|$)' AND";
	 }else{
	 	$qry_tag = "";
	 }
	if(isset($weekdate)){
$sel = $this->db->query("SELECT DISTINCT a.oid, a.firstname, a.role, a.lastname FROM operators AS a where $qry_tag (a.role IN ($ids) AND a.suspended != 'on' AND  a.oid NOT IN (SELECT ba.oid from operator_working_days as ba where FROM_UNIXTIME(SUBSTR(ba.wrk_date, 1,10), '%d-%m-%Y') = '$weekdate' AND leavetime = '3') AND a.status = '1') AND ((SELECT count(*) as cnt  FROM `app_holidays` where FROM_UNIXTIME( hdate, '%d-%m-%Y' ) ='$weekdate') < 1) order by a.lastname ASC");
	$val = $sel->result();
	}else{
	$this->db->where('status', '1');
	$this->db->where('suspended !=', 'on');
	if($count > 0){
	$this->db->where("tags regexp '(^|,)($tags)(,|$)'");
	}
	$this->db->where_in('role', $exp);
	$query = $this->db->get('operators');
	$val = $query->result();
	}
	return $val;
}

public function getoperatorlist_hole_role_dist($ids, $dist_id, $contract_tags, $weekdate=NULL){
	 $exp =explode(",", $ids);
	 $i =1;
	 $count = count($tag_id);
	 if($count > 0){
	 $tags = '';
	 foreach($tag_id as $key=>$values){
			if($i == $count){
				$tags .=  "(".$values.")";
			} else{
				$tags .=  "(".$values.")|";
			}
		 $i++;
	 }
	 $qry_tag = "tags regexp '(^|,)($tags)(,|$)' AND ";
	 }else{
	 	$qry_tag = "";
	 }
	if(isset($weekdate)){
$sel = $this->db->query("SELECT DISTINCT a.oid, a.firstname, a.role, a.lastname FROM operators AS a where $qry_tag (a.role IN ($ids) AND a.suspended != 'on' AND a.oid NOT IN (SELECT ba.oid from operator_working_days as ba where FROM_UNIXTIME(SUBSTR(ba.wrk_date, 1,10), '%d-%m-%Y') = '$weekdate') AND a.status = '1') AND ((SELECT count(*) as cnt  FROM `app_holidays` where FROM_UNIXTIME( hdate, '%d-%m-%Y' ) ='$weekdate') < 1)");
		$val = $sel->result();
	}else{
	$this->db->where('status', '1');
	$this->db->where('dist_id', $dist_id);
	$this->db->where('suspended !=', 'on');
	if($count > 0){
	$this->db->where("tags regexp '(^|,)($tags)(,|$)'");
	}
	$this->db->where_in('role', $exp);
	$query = $this->db->get('operators');
	$val = $query->result();
	}
	return $val;
}

public function getsuspendoperatorjob($exp,$oid)
{
	$this->db->where('status', '1');
	$this->db->where('oid', $oid);
	$this->db->where_in('role', $exp);
	$query = $this->db->get('operators');
	$val = $query->row_array();
	return $val;
}

public function getdoctorlist(){
	$this->db->where('role', '1');
	$query = $this->db->get('operators');
	$val = $query->result();
	return $val;
}


public function getnurselist(){
	$this->db->where('role', '2');
	$query = $this->db->get('operators');
	$val = $query->result();
	return $val;
}

public function getsupportlist(){
	$this->db->where('role', '3');
	$query = $this->db->get('operators');
	if($query -> num_rows() > 0)
	$val = $query->result();
	return $val;
}

public function getrequestlist(){
	$query = $this->db->query("select DISTINCT ap.patient_id, (select pname from patients where pid = ap.patient_id) as patient,(select surname from patients where pid = ap.patient_id) as patient_surname from assign_job_list as ap order by patient_surname ASC");
	return $query;
}

public function getadmintypelist(){
	$this -> db -> select('tid, type_name');
	$this -> db -> from('admin_types');
	$this -> db -> where('tstatus = 1');
	$query = $this -> db -> get();
	return $query;
}

public function getusertypename($tid)
{
		$this -> db -> select('type_name');
		$this -> db -> from('admin_types');
		$this -> db -> where('tid = ' . "'" . $tid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$type_name = $val[0]->type_name;
		}
		else
		{
			$type_name = lang('COMMON::admin_type_not_assign');
		}

	return $type_name;
}


public function getoperatorname($oid)
{
		$this -> db -> select('username');
		$this -> db -> from('operators');
		$this -> db -> where('oid = ' . "'" . $oid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$opt_username = $val[0]->username;
		}
		else
		{
			$opt_username = lang('COMMON::operator_not_exist');
		}

	return $opt_username;
}

public function getoperatorfirstname($oid)
{
		$this -> db -> select('firstname,lastname');
		$this -> db -> from('operators');
		$this -> db -> where('oid = ' . "'" . $oid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$opt_firstname = $val[0]->firstname;
			$opt_lastname = $val[0]->lastname;
			$opt_name = $opt_lastname." ".$opt_firstname;
		}else{
			$opt_name = "";
		}

	return $opt_name;
}
public function getoperatorsurnamename($oid)
{
		$this -> db -> select('lastname');
		$this -> db -> from('operators');
		$this -> db -> where('oid = ' . "'" . $oid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$opt_lastname = $val[0]->lastname;
			$opt_name1 = $opt_lastname;
		}else{
			$opt_name1 = "";
		}

	return $opt_name1;
}
public function getinterventname($int_id)
{
		$this -> db -> select('int_type');
		$this -> db -> from('intervention_types');
		$this -> db -> where('int_type_id = ' . "'" . $int_id . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$int_type = $val[0]->int_type;
		}else{
			$int_type = "";
		}

	return $int_type;
}

public function getjobpatientstatus($rid,$pid,$oid)
{
		$this -> db -> select('status');
		$this -> db -> from('assign_pdns');
		$this -> db -> where('request_id = ' . "'" . $rid . "'");
		$this -> db -> where('patient_id = ' . "'" . $pid . "'");
		$this -> db -> where('operator = ' . "'" . $oid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$status = $val[0]->status;
			if($status == 1){
				$name = "aprire";
			}elseif($status == 2){
				$name = "chiuso";
			}
		}
		else
		{
			$name = lang('COMMON::role_not_assign');
		}

	return $name;
}


/* Intervent Type */
public function last_intervent_code()
{
		$this -> db -> select('int_type_id');
		$this -> db -> from('intervention_types');
		$this->db->order_by("int_type_id", "desc");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$last_val = $val[0]->int_type_id + 1;
		}
		else
		{
			$last_val = 1;
		}

	return $last_val;
}

public function interventtypelist()
{
		$this -> db -> select('int_type_id,int_code,int_type');
		$this -> db -> from('intervention_types');
		$this -> db -> where('int_status = 1');
		$query = $this -> db -> get();
		return $query;
}


public function get_hours($aid,$week_id){

$sel = mysql_query("SELECT start_time_hour,start_time_min,end_time_hour,end_time_min FROM assign_job_list where aid = '$aid' AND sel_week_day = '$week_id'");
		$fet = mysql_fetch_assoc($sel);
		$start_time_hour = $fet['start_time_hour'];
		if(strlen($fet['start_time_min']) > 1){ $start_time_min = $fet['start_time_min']; }else{ $start_time_min = "0".$fet['start_time_min']; }
		$end_time_hour = $fet['end_time_hour'];
		if(strlen($fet['end_time_min']) > 1){ $end_time_min = $fet['end_time_min']; }else{ 	$end_time_min = "0".$fet['end_time_min']; }
		$time = $start_time_hour.":".$start_time_min." - ".$end_time_hour.":".$end_time_min;
	return $time;
}

public function GetIntHour($cid, $pid, $int_id)
{
		$this -> db -> select('intervent_hour');
		$this -> db -> from('contract_intervent_weekdays');
		$this -> db -> where('ciw_id = ' . "'" . $cid . "'");
		$this -> db -> where('pid = ' . "'" . $pid . "'");
		$this -> db -> where('intervent_id = ' . "'" . $int_id . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$intervent_hour = $val[0]->intervent_hour;
		}
		else
		{
			$intervent_hour = "";
		}

	return $intervent_hour;
}

public function GetOptPlannerDetails($oid, $week_id)
{
	$year = date("Y");
	$from = date('Y-m-d', strtotime($year."W".$week_id.'1'));
	$to = date('Y-m-d', strtotime($year."W".$week_id.'7'));
	//$from = "2013-11-20";
	//$to = "2013-11-30";
	$q = mysql_query("select oid,SEC_TO_TIME(SUM(TIME_TO_SEC(`duration`))) AS totalhours, (select hours_contract from operators where oid = a.oid) as hours_contract from patients_intervention_extra_details as a where (DATE(entry_date) between '$from' and '$to') AND oid ='$oid'");
	$fet = mysql_fetch_assoc($q);
	$totalhours = $fet['totalhours'];
	$hours_contract = $fet['hours_contract'];
	if($totalhours != '' && $hours_contract != ''){
	$percentage1 = ($totalhours / $hours_contract) * 100;
	$percentage2 = (($hours_contract + $totalhours) / $hours_contract) * 100;
	$val = "<b>".lang('JOBASSIGN::confirmed') .": </b>".$totalhours ."/".$hours_contract." (".number_format((float)$percentage1, 2, '.', '')."%)<br><b>".lang('JOBASSIGN::to_be_confirmed') .": </b>".$hours_contract ."+". $totalhours ."/".$hours_contract." (".number_format((float)$percentage2, 2, '.', '')."%)";
	}else{
		$val = "";
	}
	return $val;

}


public function GetJobOperatornames($aid,$week_id)
{
		$opt_name = array();
		$query = mysql_query("SELECT `pry_oid`, `sec_oid`, `sup_id` FROM `assign_job_list` WHERE aid = '$aid'");
		if(mysql_num_rows($query) > 0)
		{
			$opt_name[] = "<b>".lang('JOBASSIGN::primary_opt') ." : </b>";
			while($val = mysql_fetch_assoc($query)){
				if($val['pry_oid'] != '0'){
					$opt_name[] = $this->getoperatorsurnamename($val['pry_oid']);
				}
				if($val['sec_oid'] != '0'){
					$opt_name[] = $this->getoperatorsurnamename($val['sec_oid']);
				}
				if($val['sup_id'] != '0'){
					$opt_name[] = $this->getoperatorsurnamename($val['sup_id']);
				}

			}

		}
return $imp = implode(" - ", $opt_name);
}

public function GetJobOperatornames_popup($aid,$week_id)
{
		$opt_name = array();
		$query = mysql_query("SELECT `pry_oid`, `sec_oid`, `sup_id` FROM `assign_job_list` WHERE aid = '$aid'");
		if(mysql_num_rows($query) > 0)
		{
			while($val = mysql_fetch_assoc($query)){
				if($val['pry_oid'] != '0'){
					$opt_name[] = "<b>".lang('JOBASSIGN::primary_opt') ." : </b>".$this->getoperatorfirstname($val['pry_oid'])."<br>".$this->GetOptPlannerDetails($val['pry_oid'], $week_id);
				}
				if($val['sec_oid'] != '0'){
					$opt_name[] = "<b>".lang('JOBASSIGN::secondary_opt') ." : </b>".$this->getoperatorfirstname($val['sec_oid'])."<br>".$this->GetOptPlannerDetails($val['sec_oid'], $week_id);
				}
				if($val['sup_id'] != '0'){
					$opt_name[] = "<b>".lang('JOBASSIGN::supervisor_opt') ." : </b>".$this->getoperatorfirstname($val['sup_id'])."<br>".$this->GetOptPlannerDetails($val['sup_id'], $week_id);
				}

			}

		}
return $imp = implode("<br>", $opt_name);
}

public function datei18tran($date){
	//$date = strtotime("Nov-18, 2013");
	$month = date("M", $date);
	$year = date("Y", $date);
	$date = date("d", $date);
	switch ($month) {
		case 'Jan':
			$mon = "Gen";
			break;
		case 'Feb':
			$mon = "Feb";
			break;
		case 'Mar':
			$mon = "Mar";
			break;
		case 'Apr':
			$mon = "Apr";
			break;
		case 'May':
			$mon = "Mag";
			break;
		case 'Jun':
			$mon = "giu";
			break;
		case 'Jul':
			$mon = "Lug";
			break;
		case 'Aug':
			$mon = "ago";
			break;
		case 'Sep':
			$mon = "set";
			break;
		case 'Oct':
			$mon = "Ott";
			break;
		case 'Nov':
			$mon = "nov";
			break;
		case 'Dec':
			$mon = "dic";
			break;
	}
	return $mon."-".$date.",".$year;
}

public function datei18tranlabel($date){
	$month = date("M", $date);
	$year = date("Y", $date);
	$date = date("d", $date);
	switch ($month) {
		case 'Jan':
			$mon = "Gen";
			break;
		case 'Feb':
			$mon = "Feb";
			break;
		case 'Mar':
			$mon = "Mar";
			break;
		case 'Apr':
			$mon = "Apr";
			break;
		case 'May':
			$mon = "Mag";
			break;
		case 'Jun':
			$mon = "giu";
			break;
		case 'Jul':
			$mon = "Lug";
			break;
		case 'Aug':
			$mon = "ago";
			break;
		case 'Sep':
			$mon = "set";
			break;
		case 'Oct':
			$mon = "Ott";
			break;
		case 'Nov':
			$mon = "nov";
			break;
		case 'Dec':
			$mon = "dic";
			break;
	}
	return $date."-".$mon."-".$year;
}

public function GetMonthName($mno){
	switch ($mno) {
		case 'January':
			$mon = "Gennaio";
			break;
		case 'February':
			$mon = "febbraio";
			break;
		case 'March':
			$mon = "marzo";
			break;
		case 'April':
			$mon = "aprile";
			break;
		case 'May':
			$mon = "maggio";
			break;
		case 'June':
			$mon = "giugno";
			break;
		case 'July':
			$mon = "luglio";
			break;
		case 'August':
			$mon = "agosto";
			break;
		case 'September':
			$mon = "settembre";
			break;
		case 'October':
			$mon = "ottobre";
			break;
		case 'November':
			$mon = "novembre";
			break;
		case 'December':
			$mon = "dicembre";
			break;
	}
	return $mon;
}

function GetKM($urls){
	$site_url = "http://maps.googleapis.com/maps/api/distancematrix/json?origins=".$urls."&sensor=false";
    $url=str_replace('&amp;','&',$site_url);
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $xml = curl_exec ($ch);
    curl_close ($ch);
	$keywords = preg_split("/distance/", $xml);
	$s1 = $keywords[1];
	$s2 = preg_split("/text/", $s1);
	$s3 = preg_split("/:/", $s2[1]);
	$s4 = preg_split('/",/',substr($s3[1], 2, -8));
	$pos = strpos($s4[0], "km");
    if ($pos == false) {
        $ss4 = $s4[0] *(1 / 1000)." km";
    } else {
        $ss4 = $s4[0];
    }
	return $ss4;
}
function GetEstimateTime($urls){
	$site_url = "http://maps.googleapis.com/maps/api/distancematrix/json?origins=".$urls."&sensor=false";

    $url=str_replace('&amp;','&',$site_url);
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $xml = curl_exec ($ch);
    curl_close ($ch);
	$keywords = preg_split("/duration/", $xml);
	$s1 = $keywords[1];

	$s2 = preg_split("/text/", $s1);
	$s3 = preg_split("/:/", $s2[1]);
	$s4 = preg_split('/",/',substr($s3[1], 2, -8));
		$pos = strpos($s4[0], "mins");





    if ($pos == false) {
        $ss4 = $s4[0] *(1 / 1000)." mins";
    } else {
        $ss4 = $s4[0];
    }
	return $ss4;

}
public function getaddressusinglatlng($from)
{
$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($from).'&sensor=false';
$json = @file_get_contents($url);
$data=json_decode($json);
$status = $data->status;
if($status=="OK")
return $data->results[0]->formatted_address;
else
return false;
}

public function getoperatorname_fetch($oid)
{
		$this -> db -> select('firstname,lastname,role');
		$this -> db -> from('operators');
		$this -> db -> where('oid = ' . "'" . $oid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$fname = $val[0]->firstname;
			$lname = $val[0]->lastname;
			$role = $val[0]->role;
			$opt_name_det = $fname." ".$lname." "."(".$this->getrolename($role).")";
		}else{
			$opt_name_det = '';
		}
return $opt_name_det;
}

/*
public function contractbasedjoblist($cid,$day,$week)
{
		$year = date("Y");
		$today_date = strtotime(date('d-m-Y', strtotime($year."W".$week.$day)));
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
}*/

public function getcurrentdatejob($aid,$day,$week)
{
		$year = date("Y");
		$today_date = date('Y-m-d', strtotime($year."W".$week.$day));
		$sel_cease_date = "SELECT *  FROM `assign_job_list` WHERE aid = '$aid' AND `job_date_assign` = '$today_date'";
		$qry_cd = mysql_query($sel_cease_date);
		$cnt = mysql_num_rows($qry_cd);
		if($cnt > 0){
			return "yes";
		}else{
			return "no";
		}
}

public function getoptdefaultaddress($oid)
{
	$sel = "SELECT * FROM operators WHERE oid = '$oid' AND starting_point_address != ''";
	$qry = mysql_query($sel);
	$cnt = mysql_num_rows($qry);
	if($cnt == 1){
		$fet = mysql_fetch_assoc($qry);
		$starting_point_address = $fet['starting_point_address'];
	}else{
		$sel_admin = mysql_query("SELECT * FROM operator_default_starting_point limit 1");
		$fet_admin = mysql_fetch_assoc($sel_admin);
		$starting_point_address = $fet_admin['starting_point_address'];
	}
	return $starting_point_address;

}

public function get_tags_list()
{
		$this -> db -> select('tid, tag_description');
		$this -> db -> from('tags');
		$query = $this -> db -> get();
		$val = $query->result();
		return $val;
}

public function get_tag_names($tid)
{
		$this -> db -> select('tag_description');
		$this -> db -> from('tags');
		$this -> db -> where('tid = ' . "'" . $tid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$tag_description = $val[0]->tag_description;
		}else{
			$tag_description = "";
		}

	return $tag_description;
}
public function get_contract_tag_id($contract_int_id,$cid,$intervent_type_id,$patient_id)
{
		$this -> db -> select('contract_tags');
		$this -> db -> from('contract_intervent_weekdays');
		$this -> db -> where('ciw_id = ' . "'" . $contract_int_id . "'");
		$this -> db -> where('cid = ' . "'" . $cid . "'");
		$this -> db -> where('intervent_id = ' . "'" . $intervent_type_id . "'");
		$this -> db -> where('pid = ' . "'" . $patient_id . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$contract_tags = $val[0]->contract_tags;
		}else{
			$contract_tags = "";
		}

	return $contract_tags;
}

public function get_latlng_address($address)
{
	$address_encode = ($address);
	$url = "http://maps.google.com/maps/api/geocode/json?address=$address_encode&sensor=false";
	$response = file_get_contents($url);
	$response = json_decode($response, true);
	$lat = $response['results'][0]['geometry']['location']['lat'];
	$long = $response['results'][0]['geometry']['location']['lng'];

	$val = $lat.",".$long;
	return $val;
}

public function getoperatorrole($oid)
{
		$this -> db -> select('role');
		$this -> db -> from('operators');
		$this -> db -> where('oid = ' . "'" . $oid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$role = $val[0]->role;
		}else{
			$role = '';
		}
return $role;
}

public function WeekDays($week_id='')
{
	$query = $this->db->query("select * from  week_days order by week_id ASC");
	return $query;
}
}
?>
