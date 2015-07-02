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

	 public function add_passigno()
	{
		$action = $_REQUEST['action'];
		$time = time();
		$pid = $_REQUEST['patient_id'];
		$intervent_type = $_REQUEST['intervent_type'];
		$shourcombo = $_REQUEST['start_hid_hour'];
		$smincombo = $_REQUEST['start_hid_min'];
		//$end_time = explode(":", $_REQUEST['end_time']);
		$ehour = $_REQUEST['endhourcombo'];
		$emin = $_REQUEST['endmincombo'];
		$job_assign_date = date("Y-m-d", strtotime($_REQUEST['job_date_assign']));
		$duedt = explode("-", $job_assign_date);
		$date  = mktime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
		$week  = (int)date('W', $date);
		$year  = (int)date('Y', $date);
		$day_of_week = date('N', strtotime(date("l",strtotime($job_assign_date))));
		$contract_int_id = $_REQUEST['contract_int_id'];
		$cid = $_REQUEST['cid'];
		if(!empty($_REQUEST['p200_code_op1'])) {
		      $p200_code_op1 = $_REQUEST['p200_code_op1'];
		} else {
		      $p200_code_op1 = 0;
		
		}
		if(!empty($_REQUEST['p200_code_op2'])) {
		      $p200_code_op2 = $_REQUEST['p200_code_op2'];
		} else {
		      $p200_code_op2 = 0;
		}
		if(!empty($_REQUEST['p200_code_op3'])) {
                   $p200_code_op3 = $_REQUEST['p200_code_op3'];
            } else {
                  $p200_code_op3 = 0;
            }
		if(isset($_REQUEST['pry_operator'])){
			if(isset($_REQUEST['default_pry_operator'])){
				if($_REQUEST['default_pry_operator'] == $_REQUEST['pry_operator']){
					$data1 = array();

				}else{
					$data1 = array(
						'pry_oid'=>$_REQUEST['pry_operator'],
					);
				}
			}else{
			$data1 = array(
				'pry_oid'=>$_REQUEST['pry_operator'],
			); }
		}else{
			$data1 = array();
		}
		if(isset($_REQUEST['sec_operator'])){
			if(isset($_REQUEST['default_sec_operator'])){
				if($_REQUEST['default_sec_operator'] == $_REQUEST['sec_operator']){
					$data2 = array();
				}else{
					$data2 = array(
						'sec_oid'=>$_REQUEST['sec_operator'],
					);
				}
			}else{
			$data2 = array(
				'sec_oid'=>$_REQUEST['sec_operator'],
			); }
		}else{
			$data2 = array();
		}
		if(isset($_REQUEST['sup_operator'])){
			if(isset($_REQUEST['default_sup_operator'])){
				if($_REQUEST['default_sup_operator'] == $_REQUEST['sup_operator']){
					$data3 = array();
				}else{
					$data3 = array(
						'sup_id'=>$_REQUEST['sup_operator'],
					);
				}
			}else{
			$data3 = array(
				'sup_id'=>$_REQUEST['sup_operator'],
			); }
		}else{
			$data3 = array();
		}
		 
		$data = array(
			'intervent_type_id'=>$intervent_type,
			'patient_id'=>$pid,
			'start_time_hour'=>$shourcombo,
			'start_time_min'=>$smincombo,
			'end_time_hour'=>$ehour,
			'end_time_min'=>$emin,
			'job_date_assign'=>$job_assign_date,
			'week'=>$week,
			'year'=>$year,
			'contract_int_id'=>$contract_int_id,
			'sel_week_day'=>$day_of_week,
			'cid'=>$cid
		);

		if($action == "new"){
			$datanew = array(
		 		'request_id'=>$time
			);
			
                  
			 
			$final_data = array_merge($data,$data1,$data2,$data3,$datanew);
			//echo "<pre>";
			//print_r($final_data);
			$this->db->insert($this->tbl_apns,$final_data);
		}elseif($action == "edit"){
			$datanew = array();
			$uaid = $_REQUEST['aid'];
			
			
			$final_data = array_merge($data,$data1,$data2,$data3,$datanew);
			$this->db->where('aid', $uaid);
			$this->db->update($this->tbl_apns,$final_data);
		}
		$aid = mysql_insert_id();

if($action == "new"){
	if(isset($_REQUEST['pry_operator'])){
		if($_REQUEST['pry_operator'] != ""){
		      $get_id = $this->db->query("select max(aid) as aid from assign_job_list");
		      $result = $get_id->row_array();
		       $aid = $result['aid'];
			$this->db->query("INSERT INTO `assign_job_status` (`aid`, `oid`, `opt_type`) VALUES ('$aid', '$_REQUEST[pry_operator]', '1')");
            
			
		}
	}
if(isset($_REQUEST['sec_operator'])){
		if($_REQUEST['sec_operator'] != ""){
		      $get_id = $this->db->query("select max(aid) as aid from assign_job_list");
		      $result = $get_id->row_array();
		       $aid = $result['aid'];
			$this->db->query("INSERT INTO `assign_job_status` (`aid`, `oid`, `opt_type`) VALUES ('$aid', '$_REQUEST[sec_operator]', '2')");
                 
		}
	}
if(isset($_REQUEST['sup_operator'])){
		if($_REQUEST['sup_operator'] != ""){
		      $get_id = $this->db->query("select max(aid) as aid from assign_job_list");
		      $result = $get_id->row_array();
		       $aid = $result['aid'];
			$this->db->query("INSERT INTO `assign_job_status` (`aid`, `oid`, `opt_type`) VALUES ('$aid', '$_REQUEST[sup_operator]', '3')");
                  
		}
	}
}elseif($action == "edit"){
	if(isset($_REQUEST['pry_operator'])){
	if(isset($_REQUEST['default_pry_operator'])){
		if($_REQUEST['default_pry_operator'] != $_REQUEST['pry_operator']){
			if($_REQUEST['pry_operator'] != ""){
				$this->db->query("INSERT INTO `assign_job_status` (`aid`, `oid`, `opt_type`) VALUES ('$uaid', '$_REQUEST[pry_operator]', '1') ON DUPLICATE KEY UPDATE `aid` = $uaid, `oid` = values(oid), `opt_type` = values(opt_type)");
				
                  
            
			}
	} }else{
		if($_REQUEST['pry_operator'] != ""){
		$this->db->query("INSERT INTO `assign_job_status` (`aid`, `oid`, `opt_type`) VALUES ('$uaid', '$_REQUEST[pry_operator]', '1') ON DUPLICATE KEY UPDATE `aid` = $uaid, `oid` = values(oid), `opt_type` = values(opt_type)"); 
		
                 
		
		}
	} }

	if(isset($_REQUEST['sec_operator'])){
	if(isset($_REQUEST['default_sec_operator'])){
		if($_REQUEST['default_sec_operator'] != $_REQUEST['sec_operator']){
			if($_REQUEST['sec_operator'] != ""){
				$this->db->query("INSERT INTO `assign_job_status` (`aid`, `oid`, `opt_type`) VALUES ('$uaid', '$_REQUEST[sec_operator]', '2') ON DUPLICATE KEY UPDATE `aid` = $uaid, `oid` = values(oid), `opt_type` = values(opt_type)");
				
                  
			}
	} }else{
		if($_REQUEST['sec_operator'] != ""){
				$this->db->query("INSERT INTO `assign_job_status` (`aid`, `oid`, `opt_type`) VALUES ('$uaid', '$_REQUEST[sec_operator]', '2') ON DUPLICATE KEY UPDATE  `aid` = $uaid, `oid` = values(oid), `opt_type` = values(opt_type)"); 
                 
                  
				
				
				}
	}

	}

	if(isset($_REQUEST['sup_operator'])){
	if(isset($_REQUEST['default_sup_operator'])){
		if($_REQUEST['default_sup_operator'] != $_REQUEST['sup_operator']){
			if($_REQUEST['sup_operator'] != ""){
				mysql_query("INSERT INTO `assign_job_status` (`aid`, `oid`, `opt_type`) VALUES ('$uaid', '$_REQUEST[sup_operator]', '3') ON DUPLICATE KEY UPDATE  `aid` = $uaid, `oid` = values(oid), `opt_type` = values(opt_type)");
				
                
			}
	} }else{
		if($_REQUEST['sup_operator'] != ""){
		mysql_query("INSERT INTO `assign_job_status` (`aid`, `oid`, `opt_type`) VALUES ('$uaid', '$_REQUEST[sup_operator]', '3') ON DUPLICATE KEY UPDATE  `aid` = $uaid, `oid` = values(oid), `opt_type` = values(opt_type)");
                  
                  
		
		}
	} }

}

}
/* Job Assisgn Model */
public function editjobmaintain($fdata)
{	
	$count = count($fdata['patient_id']);
	for($i=0;$i<$count;$i++) {
		
		$aid = $fdata['aid'][$i];
		$patient_id = $fdata['patient_id'][$i]; 
		$hourcombo = $fdata['hourcombo'][$i]; 
		$mincombo = $fdata['mincombo'][$i];
		$endhourcombo =$fdata['endhourcombo'][$i]; 
		$endmincombo = $fdata['endmincombo'][$i];
		
		
            
		$job_update = "UPDATE assign_job_list SET start_time_hour = '$hourcombo',start_time_min = '$mincombo',end_time_hour = '$endhourcombo',end_time_min = '$endmincombo' WHERE patient_id = '$patient_id' AND aid ='$aid '";
		$job_update_execu = $this->db->query($job_update);
		
	}

}
public function addreassignform()
	{
	 $job_assign_date = date("Y-m-d", strtotime($_REQUEST['job_date_assign']));
    $patient_ids = explode(",", $_REQUEST['patient_ids']);
    $reassign_opt = $_REQUEST['reassign_opt'];
	if($_REQUEST['ctype'] == "y"){
		$oid = "-".$_REQUEST['oid'];
	}else{
		$oid = $_REQUEST['oid'];
	}

	foreach($patient_ids as $pid){
		$sel = "SELECT * FROM assign_job_list WHERE $oid IN (pry_oid,sec_oid,sup_id) AND patient_id = '$pid' AND job_date_assign = '$job_assign_date'";
		$qry = $this->db->query($sel);
		$fet = $qry->row_array();
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
		
            
$this->db->query("UPDATE assign_job_list SET $field = '$reassign_opt' WHERE $oid IN (pry_oid,sec_oid,sup_id) AND patient_id = '$pid' AND job_date_assign = '$job_assign_date'");

            
		$this->db->query("INSERT INTO `assign_job_status` (`aid`, `oid`, `opt_type`) VALUES ('$aid', '$reassign_opt', '$role') ON DUPLICATE KEY UPDATE  `aid` = values(aid), `oid` = values(oid), `opt_type` = values(opt_type)");
		
		
	}
}
public function copy_addreassignform()
{
      $job_assign_date = date("Y-m-d", strtotime($_REQUEST['job_date_assign']));
      $job_date_assign_val = date("Y-m-d", strtotime($_REQUEST['job_date_assign_val']));
      $date_job = new DateTime($job_assign_date);
      $week_job = $date_job->format("W");
      $year_job = $date_job->format("Y");
      $day_of_week = date('N', strtotime(date("l",strtotime($job_assign_date))));
      $patient_ids = explode(",", $_REQUEST['patient_ids']);
      $job_aid = explode(",", $_REQUEST['job_aid']);
      $copy_check = $_REQUEST['copy_check'];
      $copy_block = implode(",", array_unique($copy_check));
      $copy_job = explode(",",$copy_block);
      $reassign_opt = $_REQUEST['pry_reassign_opt'];
      $reassign_sec_opt = $_REQUEST['sec_operator'];
	if($_REQUEST['ctype'] == "y"){
		$oid = "-".$_REQUEST['oid'];
	}else{
		$oid = $_REQUEST['oid'];
	}
        
	foreach($copy_job as $jobaid){
		$sel = "SELECT * FROM assign_job_list WHERE $oid IN (pry_oid,sec_oid,sup_id) AND aid = '$jobaid' AND job_date_assign = '$job_date_assign_val'";
		$qry = $this->db->query($sel);
		$fet = $qry->row_array();
		$aid = $fet['aid'];
		$request_id = $fet['request_id'];
		$contract_int_id = $fet['contract_int_id'];
		$intervent_type_id = $fet['intervent_type_id'];
            $patient_id = $fet['patient_id'];
            $cid = $fet['cid'];
            $start_time_hour = $fet['start_time_hour'];
            $start_time_min = $fet['start_time_min'];
            $end_time_hour = $fet['end_time_hour'];
            $end_time_min = $fet['end_time_min'];
            $sel_week_day = $fet['sel_week_day'];
            $week = $fet['week'];
            $year = $fet['year'];
            $status = $fet['status'];
		$pry_oid = $fet['pry_oid'];
		$sec_oid = $fet['sec_oid'];
		$sup_id = $fet['sup_id'];
		if(!empty($sec_oid)) {
		      $sec_reassign_opr = $reassign_sec_opt;  
		} else {
	             $sec_reassign_opr =  0;
		}
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
		//$sel_copy_block="UPDATE assign_job_list SET $field = '$reassign_opt',job_date_assign = '$job_assign_date'  WHERE $oid IN (pry_oid,sec_oid,sup_id) AND patient_id = '$pid' AND job_date_assign = '$job_date_assign_val'";
         $sel_copy_block = "INSERT INTO `assign_job_list` (`request_id`,`contract_int_id`,`intervent_type_id`,`patient_id`, `pry_oid`,`sec_oid`,`sup_id`,`cid`,`start_time_hour`,`start_time_min`,`end_time_hour`,`end_time_min`,`sel_week_day`,`week`,`year`,`status`,`job_date_assign`) VALUES ('$request_id','$contract_int_id','$intervent_type_id','$patient_id','$reassign_opt','$sec_reassign_opr','0','$cid', '$start_time_hour','$start_time_min','$end_time_hour','$end_time_min','$day_of_week','$week_job','$year_job','$status','$job_assign_date')";
		$sel_copy_execu = $this->db->query($sel_copy_block);
		$aid_last_insert_id = $this->db->insert_id();
		
		$sel_copy_insert = "INSERT INTO `assign_job_status` (`aid`, `oid`, `opt_type`) VALUES ('$aid_last_insert_id', '$reassign_opt', '$role') ON DUPLICATE KEY UPDATE  `aid` = values(aid), `oid` = values(oid), `opt_type` = values(opt_type)";
		$sel_copy_execu_insert = $this->db->query($sel_copy_insert);
		
		
	}
}
function getjobdetail($pid,$request_id){

	$this->db->select('A.*');
	$this->db->from('assign_pdns as A');
	$this->db->join('patients as P', 'A.patient_id= P.pid');
	$this->db->where('A.patient_id', $pid);
	$this->db->where('A.request_id', $request_id);
	$q = $this->db->get();
	return $q;
 }

function getjobdetaillist($oid){

	$this->db->select('A.*');
	$this->db->from('assign_pdns as A');
	$this->db->join('patients as P', 'A.patient_id= P.pid');
	$this->db->where('A.operator', $oid);
	$q = $this->db->get();
	return $q;
 }

function deleteassignedjob(){
	$aid = $_REQUEST['aid'];
	
      
	$query = $this->db->query("delete from assign_job_list WHERE aid = '$aid'");
      
	return $query;
}

function GetAutocomplete($options = array())
    {
		$this->db->select('pid,pname');
		$this->db->like('pname', $options['keyword']);
		$query = $this->db->get('patients');
		return $query->result();
    }

function entries_pat() {
	$val = $this->input->post('queryString');
	if($val != ""){
		$query = $this->db->query("select pname,pid,surname from patients where (pname LIKE '$val%' OR surname LIKE '$val%')");
	}else{
		$query = $this->db->query("select pname,pid,surname from patients");
	}

	return $query;
}

function select_role_list() {
	$val = $this->input->post('queryString');
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
	$query = $this->db->query("select oid,username,firstname,lastname,role from operators where role IN ($val) AND status = '1' $qry_tag");
	return $query;
}


function entries_type($val) {
	//$val = $this->input->post('queryString');
		$query = $this->db->query("select * from intervention_types where int_type_id = '$val'");
	return $query;
}

function entries_doc() {
			$val = $this->input->post('queryString');
			if($val != ""){
				$query = $this->db->query("select username,firstname,lastname,oid from operators where role = '1' and (firstname LIKE '$val%' OR lastname LIKE '$val%')");
			}else{
				$query = $this->db->query("select username,firstname,lastname,oid from operators where role = '1'");
			}

	return $query;

     }

function entries_nurse() {
	$val = $this->input->post('queryString');
	if($val != ""){
		$query = $this->db->query("select username,firstname,lastname,oid from operators where role = '2' and (firstname LIKE '$val%' OR lastname LIKE '$val%')");
	}else{
		$query = $this->db->query("select username,firstname,lastname,oid from operators where role = '2'");
	}

	return $query;
     }
function entries_sup() {
           $val = $this->input->post('queryString');
			$query = $this->db->query("select username,firstname,lastname,oid from operators where role = '3' and (firstname LIKE '$val%' OR lastname LIKE '$val%')");
	return $query;
     }


function check_optweek_availabel_details() {

		$opt_id = $this->input->post('opt');
		$aid = $this->input->post('aid');
		$job_date_assign = $this->input->post('job_date_assign');
		$datetime = date('Y-m-d', strtotime($job_date_assign));

		$ehourcombo_form = $this->input->post('ehourcombo');
		$emincombo_form = $this->input->post('emin');
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
	$jobassingdate = $_REQUEST['job_date_assign'];
	
		$query = $this->db->query("SELECT * FROM assign_job_list WHERE job_date_assign = '$jobassingdate' AND week = '$moveweek' AND year = '$moveyear' AND $opt_id IN (pry_oid,sec_oid,sup_id)");
		 
	return $query;
}else{
$check_opt_leave = "SELECT oid,FROM_UNIXTIME(SUBSTRING(wrk_date, 1, LENGTH(wrk_date)-3), '%Y-%m-%d') as sss FROM `operator_working_days` where leavetime = '$leavetime'  AND FROM_UNIXTIME(SUBSTRING(wrk_date, 1, LENGTH(wrk_date)-3), '%Y-%m-%d') = '$datetime' OR (FROM_UNIXTIME(SUBSTRING(wrk_date, 1, LENGTH(wrk_date)-3), '%Y-%m-%d') = '$datetime' AND leavetime = '3') AND oid = '$opt_id'";
$check_qry = $this->db->query($check_opt_leave);
$chk_cnt = mysql_num_rows($check_qry);
if($chk_cnt > 0){
	$err = "leaveerror";
	return $err;
}else{
if($aid != ""){
	$query = $this->db->query("select a.* from assign_job_list as a where $opt_id IN (a.pry_oid, a.sec_oid, a.sup_id) AND a.aid NOT IN ($aid) AND a.job_date_assign = '$datetime' OR ((SELECT COUNT(*) FROM `operator_working_days` where FROM_UNIXTIME(SUBSTRING(wrk_date, 1, CHAR_LENGTH(wrk_date) - 3), '%Y-%m-%d') = $datetime) = 1)");
}else{
	//echo "select a.* from assign_job_list as a where $opt_id IN (a.pry_oid, a.sec_oid, a.sup_id) AND a.job_date_assign = '$datetime' OR ((SELECT COUNT(*) FROM `operator_working_days` where FROM_UNIXTIME(SUBSTRING(wrk_date, 1, CHAR_LENGTH(wrk_date) - 3), '%Y-%m-%d') = $datetime) = 1)";
	$query = $this->db->query("select a.* from assign_job_list as a where $opt_id IN (a.pry_oid, a.sec_oid, a.sup_id) AND a.job_date_assign = '$datetime' OR ((SELECT COUNT(*) FROM `operator_working_days` where FROM_UNIXTIME(SUBSTRING(wrk_date, 1, CHAR_LENGTH(wrk_date) - 3), '%Y-%m-%d') = $datetime) = 1)");
}
	return $query;
}
}
}

/*Check patient available */
function check_patientweek_availabel_details() {

        $patient_id = $this->input->post('patient_id');
        $intervent_type_id= $this->input->post('intervent_type_id');
        $aid = $this->input->post('aid');
        $job_date_assign = $this->input->post('job_date_assign');
        $datetime = date('Y-m-d', strtotime($job_date_assign));
        $ehourcombo_form = $this->input->post('ehourcombo_check');
        $emincombo_form = $this->input->post('emin_check');
	if($aid != ""){	
	        $query = $this->db->query("select a.* from assign_job_list as a where a.patient_id ='$patient_id' AND a.intervent_type_id ='$intervent_type_id' AND a.aid NOT IN ($aid) AND a.job_date_assign = '$datetime'");
	 } else {
	  $query = $this->db->query("select a.* from assign_job_list as a where a.patient_id ='$patient_id' AND a.intervent_type_id ='$intervent_type_id' AND a.job_date_assign = '$datetime'");
	 
	 }
	return $query;

}
/*End check patient available */
function json_cal_contract_detail(){
	$caldata = array();
	$weekNumber = date("W");
	$year = date("Y");
	$sel = "SELECT * FROM  contract_intervent_weekdays WHERE is_schedule = '1' AND schedule_week = '$weekNumber' order by cid ASC";
	$qry = mysql_query($sel);
	$i = 1;
	while($fet = mysql_fetch_assoc($qry)){
		$pid = $fet['pid'];
		$cid = $fet['cid'];
		$intervent_id = $fet['intervent_id'];
		$sel_job = "select sel_week_day, start_time_hour, start_time_min, start_time_sec, end_time_hour, end_time_min, end_time_sec from assign_pdns where intervent_type_id = '$intervent_id' AND patient_id = '$pid' AND cid = '$cid' AND  	current_week = '$weekNumber'";
		$qry_job = mysql_query($sel_job);
		while($fet_job = mysql_fetch_assoc($qry_job)){
			$sel_week_day = $fet_job['sel_week_day'];
			$start_time_hour = $fet_job['start_time_hour'];
			$start_time_min = $fet_job['start_time_min'];
			$start_time_sec = $fet_job['start_time_sec'];
			$end_time_hour = $fet_job['end_time_hour'];
			$end_time_min = $fet_job['end_time_min'];
			$end_time_sec = $fet_job['end_time_sec'];
			$date = date('Y-m-d', strtotime($year."W".$weekNumber.$sel_week_day));
			$sdate = $date."T".$start_time_hour.":".$start_time_min.":".$start_time_sec.".000+10:00";
			$edate = $date."T".$end_time_hour.":".$end_time_min.":".$end_time_sec.".000+10:00";
			$caldata['id'] = $i;
			$caldata['start'] = $sdate;
			$caldata['end'] = $edate;
			$caldata['title'] = "SimbuK";

		}
	}
	echo json_encode($caldata);
}


function get_pat_opt_resultdetails($pid = NULL, $oid = NULL, $fdate = NULL ,$tdate = NULL){
	if($pid != "null" && $oid != "null" && $fdate != "null" && $tdate != "null"){
		$from_date = date("Y-m-d", strtotime($fdate));
		$to_date = date("Y-m-d", strtotime($tdate));
		$sel = "select * from assign_job_list where patient_id = '$pid' AND (pry_oid ='$oid' OR sec_oid = '$oid' OR sup_id='$oid') AND (job_date_assign between '$from_date' and '$to_date') ORDER BY job_date_assign ASC";
	}elseif($pid != "null" && $fdate != "null" && $tdate != "null"){
		$from_date = date("Y-m-d", strtotime($fdate));
		$to_date = date("Y-m-d", strtotime($tdate));
		$sel = "select * from assign_job_list where patient_id = '$pid' AND (job_date_assign between '$from_date' and '$to_date') ORDER BY job_date_assign ASC";
	}elseif($oid != "null" && $fdate != "null" && $tdate != "null"){
		$from_date = date("Y-m-d", strtotime($fdate));
		$to_date = date("Y-m-d", strtotime($tdate));
		$sel = "select * from assign_job_list where (pry_oid ='$oid' OR sec_oid = '$oid' OR sup_id='$oid') AND (job_date_assign between '$from_date' and '$to_date') ORDER BY job_date_assign ASC";
	}elseif($fdate != "null" && $tdate != "null"){
		$from_date = date("Y-m-d", strtotime($fdate));
		$to_date = date("Y-m-d", strtotime($tdate));
		$sel = "select * from assign_job_list where (job_date_assign between '$from_date' and '$to_date') ORDER BY job_date_assign ASC";
	}
	elseif($pid != "null" && $oid != "null"){
		$sel = "select * from assign_job_list where patient_id = '$pid' AND (pry_oid ='$oid' OR sec_oid = '$oid' OR sup_id='$oid') ORDER BY job_date_assign ASC";

	}
	elseif($pid != "null"){
		$sel = "select * from assign_job_list where patient_id = '$pid' ORDER BY job_date_assign ASC";

	}elseif($oid != "null"){
		$sel = "select * from assign_job_list where (pry_oid ='$oid' OR sec_oid = '$oid' OR sup_id='$oid') ORDER BY job_date_assign ASC";

	}
	//echo $sel;
	$q = $this->db->query($sel);
	$val = $q->result();
	return $val;
 }

function get_week_resultdetails($startDate = NULL, $endDate = NULL, $oid = NULL){
	$startdate = date("Y-m-d", strtotime($startDate));
	$enddate = date("Y-m-d", strtotime($endDate));
	if($startDate != "" && $endDate != "" && $oid != "null"){
		$q = $this->db->query("select oid,SEC_TO_TIME(SUM(TIME_TO_SEC(`duration`))) AS totalhours, (select hours_contract from operators where oid = a.oid) as hours_contract from patients_intervention_extra_details as a where (DATE(entry_date) between '$startdate' and '$enddate') AND oid ='$oid'");
	}
	elseif($startDate != "null" && $endDate != "null"){
		$q = $this->db->query("select oid,SEC_TO_TIME(SUM(TIME_TO_SEC(`duration`))) AS totalhours, (select hours_contract from operators where oid = a.oid) as hours_contract from patients_intervention_extra_details as a where (DATE(entry_date) between '$startdate' and '$enddate') group by oid");
	}elseif($oid != "null"){
		$q = $this->db->query("select oid,SEC_TO_TIME(SUM(TIME_TO_SEC(`duration`))) AS totalhours, (select hours_contract from operators where oid = a.oid) as hours_contract from patients_intervention_extra_details as a where oid ='$oid'");
	}
	$val = $q->result();
	return $val;
 }
/*
function get_km_resultdetails($startDate = NULL, $endDate = NULL, $oid = NULL){
	$startdate = date("Y-m-d", strtotime($startDate));
	$enddate = date("Y-m-d", strtotime($endDate));
	if($startDate != "null" && $endDate != "null" && $oid != "null"){
		$q = $this->db->query("select pid,entry_date, (SELECT CONCAT(address, ',',city) FROM `patients` where pid = a.pid ) as address from patients_intervention_extra_details as a where (DATE(entry_date) between '$startdate' and '$enddate') AND oid ='$oid' order by ped_id ASC");
	}
	elseif($startDate != "null" && $endDate != "null"){
		$q = $this->db->query("select pid,entry_date, (SELECT CONCAT(address, ',',city) FROM `patients` where pid = a.pid ) as address from patients_intervention_extra_details as a where (DATE(entry_date) between '$startdate' and '$enddate') order by ped_id ASC");
	}elseif($oid != "null"){
		$q = $this->db->query("select pid,entry_date, (SELECT CONCAT(address, ',',city) FROM `patients` where pid = a.pid ) as address from patients_intervention_extra_details as a where oid ='$oid' order by ped_id ASC");
	}
	$val = $q->result();
	return $val;
 } */
function get_km_plannedresultdetails($startDate = NULL, $endDate = NULL, $oid = NULL){
	$startdate = date("Y-m-d", strtotime($startDate));
	$enddate = date("Y-m-d", strtotime($endDate));
	if($startDate != "null" && $endDate != "null" && $oid != "null"){
		$q = $this->db->query("select aid,request_id,patient_id,job_date_assign, (SELECT CONCAT(address, ',',city) FROM `patients` where pid = a.patient_id ) as address from assign_job_list as a where (DATE(job_date_assign) between '$startdate' and '$enddate') AND $oid IN (pry_oid,sec_oid,sup_id) order by aid ASC");
	}
	elseif($startDate != "null" && $endDate != "null"){
		$q = $this->db->query("select aid,request_id,patient_id,job_date_assign, (SELECT CONCAT(address, ',',city) FROM `patients` where pid = a.patient_id ) as address from assign_job_list as a where (DATE(job_date_assign) between '$startdate' and '$enddate') order by aid ASC");
	}elseif($oid != "null"){
		$q = $this->db->query("select aid,request_id,patient_id,job_date_assign, (SELECT CONCAT(address, ',',city) FROM `patients` where pid = a.patient_id) as address from assign_job_list as a where $oid IN (pry_oid,sec_oid,sup_id) order by aid ASC");
	}
	$val = $q->result();
	return $val;
 }

function get_km_realdetails($aid,$oid,$pid){
	$q = mysql_query("select start_location, end_location from patients_intervention_extra_details as a where oid ='$oid' AND pid = '$pid' AND aid = '$aid'");
	$cnt = mysql_num_rows($q);
	if($cnt > 0){
		$fet = mysql_fetch_assoc($q);
		if($fet['start_location'] != ''){
			$start_location = $this->common->getaddressusinglatlng($fet['start_location']);
			$end_location = $this->common->getaddressusinglatlng($fet['end_location']);
			return $get_address = $this->common->GetKM(urlencode($start_location)."&destinations=".urlencode($end_location));
		}
	}
 }


function get_patient_nearest_operator($hour, $weekdays, $current_week, $pidval){
	//echo "select * from assign_pdns where patient_id != '$pidval' AND sel_week_day = '$weekdays' AND end_time_hour < '$hour' AND current_week = '$current_week'";
	$q = $this->db->query("select * from assign_pdns where patient_id != '$pidval' AND sel_week_day = '$weekdays' AND end_time_hour < '$hour' AND current_week = '$current_week'");
	$val = $q->result();
	return $val;
}


/* 8-05-2014 */
public function getmorningafterjoblist($oid, $date, $section, $type)
{
		$sel = $this->db->query("SELECT * FROM admin_session_setup ORDER BY id DESC LIMIT 0 , 1 ");
		$val = $sel->result();
		foreach ($sel->result() as $row)
		{
			$morn_start_time = $row->morn_start_time;
			$morn_end_time = $row->morn_end_time;
		}
		$date_val = date('Y-m-d', $date);
		if($section == 1){
			$cond = " AND (start_time_hour >= ".$morn_start_time." AND (start_time_hour <= ".$morn_end_time." AND (start_time_min <=(case when start_time_hour >= ".$morn_end_time." then 0 else 60 end))))";
		}elseif($section == 2){
			$cond = " AND (start_time_hour >= ".$morn_end_time." AND (start_time_min >=(case when start_time_hour > ".$morn_end_time." then 0 else 1 end)))";
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
/*Check primary operator and secondary operator */
public function pry_sec_intverent_check($intervent_type_id)
{
      $sel = $this->db->query("select * from intervention_types where int_type_id = '$intervent_type_id'");
      $val = $sel->result();
	return $val;

}
/*Get data from job navagation */
public function getmorningafterjoblist_navigation($oid, $date, $section, $type)
{
		$sel = $this->db->query("SELECT * FROM admin_session_setup ORDER BY id DESC LIMIT 0 , 1 ");
		$val = $sel->result();
		foreach ($sel->result() as $row)
		{
			$morn_start_time = $row->morn_start_time;
			$morn_end_time = $row->morn_end_time;
		}
		$date_val = date('Y-m-d', $date);
		if($section == 1){
			$cond = " AND (start_time_hour >= ".$morn_start_time." AND (start_time_hour <= ".$morn_end_time." AND (start_time_min <=(case when start_time_hour >= ".$morn_end_time." then 0 else 60 end))))";
		}elseif($section == 2){
			$cond = " AND (start_time_hour >= ".$morn_end_time." AND (start_time_min >=(case when start_time_hour > ".$morn_end_time." then 0 else 1 end)))";
		}else{
			$cond = "";
		}
		if($type == "y"){
			$new_oid = '-'.$oid;
		}else{
			$new_oid = $oid;
		}
		
		$sel = $this->db->query("SELECT aid,patient_id,start_time_hour,start_time_min,end_time_hour,end_time_min USE INDEX (pry_oid,sec_oid,sup_id,start_time_hour,start_time_min,job_date_assign) from assign_job_list where $new_oid IN (pry_oid,sec_oid,sup_id) and job_date_assign = '$date_val' $cond order by TIME(CONCAT(start_time_hour,':', start_time_min)) ASC");
		//echo "SELECT * from assign_job_list where $new_oid IN (pry_oid,sec_oid,sup_id) and job_date_assign = '$date_val' $cond order by TIME(CONCAT(start_time_hour,':', start_time_min)) ASC";
		$val = $sel->result();
		return $val;
}

public function stop_filter_joblist($navweek, $navyear, $pid, $dist_id, $date,$filter_box_status)
{
		$date_val = date('Y-m-d', $date);
		$oid_data = array();
		if($pid == "0" && $dist_id == '0' && $filter_box_status != '0'){
			$sel = $this->db->query("SELECT * from assign_job_list where job_date_assign = '$date_val' order by TIME(CONCAT(start_time_hour,':', start_time_min)) ASC");
			}
elseif($pid != "0" && $dist_id == '0'){
			$sel = $this->db->query("SELECT * from assign_job_list where patient_id = '$pid' and job_date_assign = '$date_val' order by TIME(CONCAT(start_time_hour,':', start_time_min)) ASC");
		}elseif($dist_id != '0'){
			//echo "select oid from operators where FIND_IN_SET('$dist_id', dist_id)";
			$sel = $this->db->query("select oid from operators where FIND_IN_SET('$dist_id', dist_id)");
		}


if($dist_id != '0'){
	$i = 0;
	foreach($sel->result() as $res){
		$oid_data[listoid][$i] = $res->oid;
		$i++;
	}
}else{
	$i = 0;
foreach($sel->result() as $res){
	if($res->pry_oid != '0'){ $oid_data['listoid'][$i][] = $res->pry_oid; }
	if($res->sec_oid != '0'){ $oid_data['listoid'][$i][] = $res->sec_oid; }
	if($res->sup_id != '0'){ $oid_data['listoid'][$i][] = $res->sup_id; }
	$i++;
}
}
	return $oid_data;
}
public function job_plan_stop_filter_joblist($navweek,$navyear,$pid)
{
        $oid_data = array();
        $sel_execu = "SELECT * from assign_job_list where patient_id = '$pid' and week = '$navweek' order by TIME(CONCAT(start_time_hour,':', start_time_min)) ASC";
        $sel = $this->db->query($sel_execu);
        $i = 0;
    foreach($sel->result() as $res){
        if($res->pry_oid != '0'){ $oid_data['listoid'][$i][] = $res->pry_oid; }
        if($res->sec_oid != '0'){ $oid_data['listoid'][$i][] = $res->sec_oid; }
        if($res->sup_id != '0'){ $oid_data['listoid'][$i][] = $res->sup_id; }
        $i++;
    }    
    
    return $oid_data;
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
	$sel = "select oid,username,firstname,lastname,role from operators where role IN ($role) AND status = '1' AND suspended = 'off' $qry_tag AND oid NOT IN($sel1) order by lastname ASC";

	$query = $this->db->query($sel);
	return $query;


}


public function putcopyweekdata()
{
      $selectedweekno = $_REQUEST['selectedweekno'];
      $weekno_explode = $_REQUEST['weekno'];
      $split_value = explode('#',$weekno_explode);
      $weekno = $split_value[0];
      $year_dest = $split_value[1];
      $year = $_REQUEST['year'];
      $district = $_REQUEST['district'];
      $error = '';
      $copy_check = $_REQUEST['copy_week'];
      $copy_block = implode(",", array_unique($copy_check));
      $copy_job = explode(",",$copy_block);
      $check_destination_week = "SELECT b.* FROM operators as a,assign_job_list as b WHERE b.week = '$weekno' AND FIND_IN_SET('$district', a.dist_id) AND a.oid IN (pry_oid,sec_oid,sup_id)";
      $sel_execu_week = $qry = mysql_query($check_destination_week);
      $numcnt_desti_week = mysql_num_rows($sel_execu_week); 
        if(empty($numcnt_desti_week)) {
            foreach($copy_job as $op_id) { 
	              $sel = "SELECT b.* FROM operators as a,assign_job_list as b WHERE b.week = '$selectedweekno' AND b.year = '$year' AND FIND_IN_SET('$district', a.dist_id) AND a.oid IN (pry_oid,sec_oid,sup_id) AND a.oid = '$op_id'"; 
	              $qry = mysql_query($sel);
	              $numcnt_check_soucre_week = mysql_num_rows($qry);
	              $source_check = $this->db->query("SELECT b.* FROM operators as a,assign_job_list as b WHERE b.week = '$selectedweekno' AND b.year = '$year' AND FIND_IN_SET('$district', a.dist_id) AND a.oid IN (pry_oid,sec_oid,sup_id)");
	              $numcnt_soucre_week = $source_check->num_rows();
	              $cnt = array();
	              $fetdata = array();
	              $i = 0;
	              while($fet = mysql_fetch_assoc($qry)){
                        $fetdata[] = $fet;
                        $request_id = $fet['request_id'];
                        $sel_week_day = $fet['sel_week_day'];
                        $jobdate = date("Y-m-d", strtotime($year."W".$weekno.$sel_week_day));
                        $check_sel_week = "SELECT b.* FROM operators as a,assign_job_list as b where b.job_date_assign = '$jobdate' AND b.request_id = '$request_id' AND FIND_IN_SET('$district', a.dist_id) AND -a.oid IN (pry_oid,sec_oid,sup_id)";
                        $check_sel = mysql_query($check_sel_week);
                        $numcnt = mysql_num_rows($check_sel);
                        if(empty($numcnt)){
                        $aid = $fet['aid'];
                        $job_date_assign = $fet['job_date_assign'];
                        $jobdate = date("Y-m-d", strtotime($year_dest."W".$weekno.$sel_week_day));
                        $minus_sel = "SELECT patient_id,pry_oid,sec_oid,sup_id,cid FROM assign_job_list where aid = '$aid'";
                        $minus_qry = mysql_query($minus_sel);
                        $minus_fet = mysql_fetch_assoc($minus_qry);
                        $pry_oid = $minus_fet['pry_oid'];
                        $sec_oid = $minus_fet['sec_oid'];
                        $sup_id = $minus_fet['sup_id'];
                        $cid = $minus_fet['cid'];
                        //echo "<pre>";
                        //print_r($copy_check);die;
                        if (in_array($pry_oid, $copy_check)) {
                              $prim_oid = -$pry_oid;
                        } else {
                              $prim_oid = 0;

                        }
                        if (in_array($sec_oid, $copy_check)) {
                              $seco_oid = -$sec_oid;
                        } else {
                              $seco_oid = 0;

                        }
                        if (in_array($sup_id, $copy_check)) {
                              $supr_oid = -$sup_oid;
                        } else {
                              $supr_oid = 0;

                        }
		              
                        if((strpos($minus_fet['pry_oid'],'-') !== false) || (strpos($minus_fet['sec_oid'],'-') !== false) || (strpos($minus_fet['sup_id'],'-') !== false)){
		              }else {
			              $sel_contract =mysql_query("SELECT last_ceased_date FROM `contract_details` WHERE `cid` ='$cid'") or die(mysql_error());
			              mysql_num_rows($sel_contract);
			              $qry_fet_contract = mysql_fetch_assoc($sel_contract);
			              //echo $qry_fet_contract['last_ceased_date']."<br>";
                                    if($qry_fet_contract['last_ceased_date'] != '0'){
                                          $ceased_date = date("Y-m-d",$qry_fet_contract['last_ceased_date']);
                                          $ccdate = new DateTime($ceased_date);
                                          $contweek = $ccdate->format("W");
                                          //echo $weekno."---".$contweek;
                                          if($weekno < $contweek){
                                                $sel = "INSERT INTO assign_job_list (request_id,contract_int_id,intervent_type_id,patient_id,pry_oid,sec_oid,sup_id,cid,start_time_hour,start_time_min,end_time_hour,end_time_min,sel_week_day,week,year,job_date_assign) SELECT request_id,contract_int_id,intervent_type_id,
                                                patient_id,$prim_oid,$seco_oid, $supr_oid,cid,start_time_hour,start_time_min,end_time_hour,end_time_min,sel_week_day,$weekno,$year_dest,'$jobdate' FROM assign_job_list where aid = '$aid'";
                                                 $sel_exeu = $this->db->query($sel);

                                          } else{
                                                $error .= "yes";
                                          }
                                    }else {
                                          $sel ="INSERT INTO assign_job_list (request_id,contract_int_id,intervent_type_id,patient_id,pry_oid,sec_oid,sup_id,cid,start_time_hour,start_time_min,end_time_hour,end_time_min,sel_week_day,week,year,job_date_assign) SELECT request_id,contract_int_id,intervent_type_id,
                                          patient_id,$prim_oid,$seco_oid, $supr_oid,cid,start_time_hour,start_time_min,end_time_hour,end_time_min,sel_week_day,$weekno,$year_dest,'$jobdate' FROM assign_job_list where aid = '$aid'"; 
                                          $sel_exeu = $this->db->query($sel);
                                    }
		              }
              }
                  $cnt[$i] = $numcnt;
                  $i++;
	              }
	       }
	 }
      if(!empty($numcnt_desti_week)) {
            echo lang("JOBASSIGN::not_empty_week_desti");
      }else if(empty($numcnt_soucre_week)) {
            echo lang("JOBASSIGN::not_empty_week");
      }else{
            if($error != ''){
                  echo lang("JOBASSIGN::some_job_has_ceased");
            }
      }
}

/* Yellow Box */
public function get_yellow_joblist_filter($navweek, $navyear, $filt_oid,$pid, $dist_id, $date, $filter_box_status)
{
		$date_val = date('Y-m-d', $date);
		$oid_data = array();
		//echo $navweek." -- ".$navyear." -- ".$filt_oid." -- ".$pid." -- ".$dist_id." -- ".$date." -- ".$filter_box_status;
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
		}elseif($filt_oid != '0' && $dist_id != '0'){
			//echo "six";
			$sel = $this->db->query("SELECT DISTINCT b.* FROM operators as a,assign_job_list as b WHERE FIND_IN_SET('$dist_id', a.dist_id) AND -$filt_oid IN (pry_oid,sec_oid,sup_id) AND b.job_date_assign = '$date_val'");
		}
		elseif($dist_id != '0'){
			//echo "four";
			$sel = $this->db->query("select oid from operators as a,assign_job_list as b where FIND_IN_SET('$dist_id', a.dist_id) AND -a.oid IN (pry_oid,sec_oid,sup_id) AND b.job_date_assign = '$date_val'");
		}else{
			//echo "last";
			//echo "select oid from operators as a,assign_job_list as b where -a.oid IN (pry_oid,sec_oid,sup_id) AND b.job_date_assign = '$date_val'";
			$sel = $this->db->query("select b.pry_oid,b.sec_oid,b.sup_id from operators as a,assign_job_list as b where -a.oid IN (pry_oid,sec_oid,sup_id) AND b.job_date_assign = '$date_val'");
		}

if($dist_id != '0' && $pid == "0" && $filt_oid == '0'){
	//echo "yes yes";
	$i = 0;
	foreach($sel->result() as $res){
		$oid_data[listoid][$i] = $res->oid;
		$i++;
	}
}else{
	//echo "No";
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
		$sel = $this->db->query("SELECT * FROM admin_session_setup ORDER BY id DESC LIMIT 0 , 1 ");
		$val = $sel->result();
		foreach ($sel->result() as $row)
		{
			$morn_start_time = $row->morn_start_time;
			$morn_end_time = $row->morn_end_time;
		}
		$date_val = date('Y-m-d', $date);
		if($section == 1){
			$cond = " AND (start_time_hour >= ".$morn_start_time." AND (start_time_hour <= ".$morn_end_time." AND (start_time_min <=(case when start_time_hour >= ".$morn_end_time." then 0 else 60 end))))";
		}elseif($section == 2){
			$cond = " AND (start_time_hour >= ".$morn_end_time." AND (start_time_min >=(case when start_time_hour > ".$morn_end_time." then 0 else 1 end)))";
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
		
		       /* Log Insert 
                  $sel_value_job = "select * from assign_job_list WHERE -$oid IN (pry_oid,sec_oid,sup_id) AND patient_id = '$patient_id' AND job_date_assign = '$job_date_assign'";
                  $q_job = $this->db->query($sel_value_job);
                  $val_job = $q_job->result();
                  $json_values_job = json_encode($val_job);
                  $dt = new DateTime();
                  $date_created = $dt->format('YmdHis');
                  $insert_job = "INSERT INTO `dblogs` (`idutente`, `dataora`, `operazione`,`tabella`, `idtabella`, `data`,`rollbackfrom`, `canrollback`, `idpadre`) VALUES ('50000', '$date_created', 'U','assign_job_list', '$aid','$json_values_job','', 'N', '0')";
                  $this->db->query($insert_job);*/
                  
			$this->db->query("UPDATE assign_job_list SET $field WHERE -$oid IN (pry_oid,sec_oid,sup_id) AND patient_id = '$patient_id' AND job_date_assign = '$job_date_assign'");
			
				$this->db->query("INSERT INTO `assign_job_status` (`aid`, `oid`, `opt_type`) VALUES ('$aid', '$move_opt', '$role') ON DUPLICATE KEY UPDATE  `aid` = values(aid), `oid` = values(oid), `opt_type` = values(opt_type)");
				 /*LOG Insert 
                        $aid_job_status_insert_id = $this->db->insert_id();
                        $sel_value_status = "select * from assign_job_status WHERE ajob_status_id = '$aid_job_status_insert_id'";
                        $q_status = $this->db->query($sel_value_status);
                        $val_status = $q_status->result();
                        $json_values_status = json_encode($val_status);
                        $dt = new DateTime();
                        $date_created = $dt->format('YmdHis');
                        $insert_status = "INSERT INTO `dblogs` (`idutente`, `dataora`, `operazione`,`tabella`, `idtabella`, `data`,`rollbackfrom`, `canrollback`, `idpadre`) VALUES ('50000', '$date_created', 'U','assign_job_status', '$aid_job_status_insert_id','$json_values_status','', 'N', '0')";
                        $this->db->query($insert_status);*/
				
		}
$i++;
	}

    $selchek = "SELECT * FROM assign_job_list WHERE week = '$moveweek' AND year = '$moveyear' AND -$oid IN (pry_oid,sec_oid,sup_id)";
    $qrycheck = mysql_query($selchek);
	$chkcnt = mysql_num_rows($qrycheck);
    if($chkcnt > 0){
        $re= "Attenzione - non tutti gli interventi possono essere spostati sull'operatore perchè sono stati trovati dei giorni di non disponibilità. Verificare.";
    }else{
        $re='';
    }
    return $re;
}
public function get_moved_operator_exist($oid, $week,$year)
{
	$sel = $this->db->query("SELECT * FROM assign_job_list WHERE week = '$week' AND year = '$year' AND -$oid IN (pry_oid,sec_oid,sup_id)");
	$val = $sel->result();
		return $val;
}

public function getweekfortnightly($report_type,$weekno,$year,$district)
{
	if($district == '0'){
		$did = '';
	}else{
		$did = ' AND b.dist_id = '.$district.'';
	}
	if($report_type == '1'){
		$sel = $this->db->query("select a.pid, sum(a.total_weekdays) as total_contract, (select count(aid) from assign_job_list where patient_id = a.pid AND week = '$weekno' AND year = '$year') as planned_job, (sum(a.total_weekdays) - (select count(aid) from assign_job_list where patient_id = a.pid AND week = '$weekno' AND year = '$year')) as difference  from contract_intervent_weekdays as a INNER JOIN patients as b on (a.pid = b.pid) INNER JOIN contract_details as f  on(f.cid = a.cid AND f.last_ceased_date = 0 AND f.pid = a.pid) where a.week_days != '' $did group by a.pid order by b.surname");
	}elseif($report_type == '2'){
		$pweek = $weekno - 1;
		$sel = $this->db->query("select a.pid, (select count(aid) from assign_job_list where patient_id = a.pid AND year = '$year' AND week IN ('$pweek','$weekno')) as planned_job from contract_intervent_weekdays as a INNER JOIN patients as b on (a.pid = b.pid) INNER JOIN contract_details as f  on(f.cid = a.cid AND f.last_ceased_date = 0 AND f.pid = a.pid) where a.intervent_fortnightly = 'on' $did group by a.pid order by b.surname");
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
		if(mysql_num_rows($qry_cd) > 0){
			$fet_cd = mysql_fetch_assoc($qry_cd);
			$start_date = date("d-m-Y",$fet_cd['start_date']);
			if($fet_cd['last_ceased_date'] != '0'){
				//echo "first";
				$last_ceased_date = $fet_cd['last_ceased_date'];
				if($last_ceased_date <= $today_date){
					return "yes";
				}else{
					return "No";
				}
			}else{
				//echo "second";
				$last_ceased_date = $fet_cd['end_date'];
				if($last_ceased_date <= $today_date){
					return "yes";
				}else{
					return "No";
				}
			}
		}else{
			return "No";
		}

}

function get_call_report_data($oid = NULL,$startDate = NULL){

/*
	if($fmincombo != '0' && $tmincombo != '0'){
		$min = "AND (start_time_min >= '$fmincombo' AND end_time_min <= '$tmincombo')";
	}elseif($fmincombo != '0' && $tmincombo == '0'){
		$min = "AND (start_time_min >= '$fmincombo')";
	}elseif($fmincombo == '0' && $tmincombo != '0'){
		$min = "AND (end_time_min <= '$tmincombo')";
	}elseif($fmincombo == '0' && $tmincombo == '0'){
		$min = "";
	}*/


	//$query = $this->db->query("select a.* from assign_job_list as a where $oid IN (a.pry_oid, a.sec_oid, a.sup_id) AND a.job_date_assign = '$datetime' OR ((SELECT COUNT(*) FROM `operator_working_days` where FROM_UNIXTIME(SUBSTRING(wrk_date, 1, CHAR_LENGTH(wrk_date) - 3), '%Y-%m-%d') = $datetime) = 1)");

$sel = "select a.* from assign_job_list as a where DATE(job_date_assign) = '$startDate' AND $oid IN (a.pry_oid, a.sec_oid, a.sup_id) OR ((SELECT COUNT(*) FROM `operator_working_days` where FROM_UNIXTIME(SUBSTRING(wrk_date, 1, CHAR_LENGTH(wrk_date) - 3), '%Y-%m-%d')) = '$startDate') = 1";

	//echo $sel = "select a.* from assign_job_list as a where DATE(job_date_assign) = '$startDate' AND ((start_time_hour >= '$fhour' AND end_time_hour <='$thour') $min)";
	$q = $this->db->query($sel);

	//$val = $q->result();
	return $q;
 }
  function get_call_report_data_pdf($oid = NULL,$startDate = NULL){

/*
	if($fmincombo != '0' && $tmincombo != '0'){
		$min = "AND (start_time_min >= '$fmincombo' AND end_time_min <= '$tmincombo')";
	}elseif($fmincombo != '0' && $tmincombo == '0'){
		$min = "AND (start_time_min >= '$fmincombo')";
	}elseif($fmincombo == '0' && $tmincombo != '0'){
		$min = "AND (end_time_min <= '$tmincombo')";
	}elseif($fmincombo == '0' && $tmincombo == '0'){
		$min = "";
	}*/


	//$query = $this->db->query("select a.* from assign_job_list as a where $oid IN (a.pry_oid, a.sec_oid, a.sup_id) AND a.job_date_assign = '$datetime' OR ((SELECT COUNT(*) FROM `operator_working_days` where FROM_UNIXTIME(SUBSTRING(wrk_date, 1, CHAR_LENGTH(wrk_date) - 3), '%Y-%m-%d') = $datetime) = 1)");

$sel = "select a.* from assign_job_list as a where DATE(job_date_assign) = '$startDate' AND $oid IN (a.pry_oid, a.sec_oid, a.sup_id) OR ((SELECT COUNT(*) FROM `operator_working_days` where FROM_UNIXTIME(SUBSTRING(wrk_date, 1, CHAR_LENGTH(wrk_date) - 3), '%Y-%m-%d')) = '$startDate') = 1";

	//echo $sel = "select a.* from assign_job_list as a where DATE(job_date_assign) = '$startDate' AND ((start_time_hour >= '$fhour' AND end_time_hour <='$thour') $min)";
	$q = $this->db->query($sel);

	$val = $q->result();
	return $val;
 }
function manual_jobdetail(){


	$sdate = date("Y-m-d", strtotime($_REQUEST['sdate']));
	$oid = $_REQUEST['oid'];
	$pid = $_REQUEST['pid'];
	$intid = $_REQUEST['intid'];
	$sel = "select * from assign_job_list as a where DATE(job_date_assign) = '$sdate' AND $oid IN (pry_oid,sec_oid,sup_id) AND patient_id = '$pid' AND intervent_type_id = '$intid'";
	$q = $this->db->query($sel);
	//$cnt = $q->num_rows();
	//$val = $q->result();
	return $q;
}

public function save_manual_intervent($diff,$hourcombo,$mincombo,$endhourcombo,$endmincombo)
{
	$request_id = $_REQUEST['request_id'];
	$time = time();
	$aid = $_REQUEST['aid'];
	$oid = $_REQUEST['oid'];
	$pid = $_REQUEST['pid'];
	$intid = $_REQUEST['intid'];
	$current_date = date("Y-m-d");
	$starttime = $hourcombo.":".$mincombo.":00";
	$endtime = $endhourcombo.":".$endmincombo.":00";

	$this->db->select('label_name');
	$this->db->from('intervention_fields as I');
	$this->db->where('int_type_asg_id', $intid);
	$query = $this -> db -> get();
	$vals = $query->result();
	$ary[] = $_REQUEST;
	foreach ($ary[0] as $key => $value){
		foreach ($vals as $k => $v){
			if($key == $v->label_name)
			{
				$value = $ary[0][$v->label_name];
				$succ = $this->db->query("insert into patients_intervention_values(`pid`,`oid`,`meta_name`,`meta_value`,`entry_date`) values('$pid','$oid','$v->label_name','$value','$current_date')");

			}
		}
		}
//$succ1 = $this->db->query("UPDATE assign_job_status SET status='2', closed_datetime = '$time' WHERE aid = '$aid' AND oid = '$oid'");
	$succ = $this->db->query("insert into patients_intervention_extra_details(`pid`,`oid`,`start_time`,`end_time`,`duration`,`entry_date`,`data_coming_from`,`intervent_id`) values('$pid','$oid','$starttime','$endtime','$diff','$current_date','1','$intid')");

     
}

public function deleteyellowbox_jobs($oid,$week,$year)
{
	$sel = $this->db->query("DELETE FROM assign_job_list WHERE week = '$week' AND year = '$year' AND -$oid IN (pry_oid,sec_oid,sup_id)");
}
public function get_job_operator(){

      $this->db->where('status','1');
      $result = $this->db->get('operators');
      return $result;
}
public function get_patient_distric($get_pat_id){
    
      $this->db->where('oid', $get_pat_id);
	$result =  $this->db->get('operators');
	return $result->row_array();
}
public function get_distric_operator($distric_id = NULL){

      $this->db->where("FIND_IN_SET('$distric_id',dist_id) !=", 0);
      $this->db->order_by('lastname', 'ASC');
      $result = $this->db->get('operators');
      $val =  $result->result_array();
      return $val;
}
}
?>
