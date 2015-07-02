<?php
Class Plan_model extends CI_Model
{
	public function getoperatorleave($oid,$date)
	{
		$date_val = date('Y-m-d', $date);
		//$sel = $this->db->query("SELECT leavetime FROM `operator_working_days` where oid = '$oid' AND FROM_UNIXTIME(SUBSTRING(wrk_date, 1, LENGTH(wrk_date)-3), '%Y-%m-%d') = '$date_val'");
		$sel1 = $this->db->query("SELECT leavetime,wrk_date FROM `operator_working_days` where oid = '$oid' AND leavetime = '1'");
		$val1 = $sel1->result();
		$fdate1 = array();
				foreach($val1 as $v1){
					$wrk_date1 = substr($v1->wrk_date, 0,-3);
					$fdate1[] = date("Y-m-d", $wrk_date1);
				}
				if(in_array($date_val,$fdate1)){
					$leavetime = '1';
				}

		$sel2 = $this->db->query("SELECT leavetime,wrk_date FROM `operator_working_days` where oid = '$oid' AND leavetime = '2'");
		$val2 = $sel2->result();
		$fdate2 = array();
				foreach($val2 as $v2){
					$wrk_date2 = substr($v2->wrk_date, 0,-3);
					$fdate2[] = date("Y-m-d", $wrk_date2);
				}
				if(in_array($date_val,$fdate2)){
					$leavetime = '2';
				}

		$sel3 = $this->db->query("SELECT leavetime,wrk_date FROM `operator_working_days` where oid = '$oid' AND leavetime = '3'");
		$val3 = $sel3->result();
		$fdate3 = array();
				foreach($val3 as $v3){
					$wrk_date3 = substr($v3->wrk_date, 0,-3);
					$fdate3[] = date("Y-m-d", $wrk_date3);
				}
				if(in_array($date_val,$fdate3)){
					$leavetime = '3';
				}
				if(isset($leavetime)){
					$leavetime1 = $leavetime;
				}else{
					$leavetime1 = '';
				}
		return $leavetime1;
	}

	public function getmorningafterjoblist($oid, $date, $section)
	{
            echo "test";die;
		$date_val = date('Y-m-d', $date);
		if($section == 1){
			$cond = " AND (start_time_hour >= 6 AND (start_time_hour <= 13 AND (start_time_min <=(case when start_time_hour >= 13 then 0 else 60 end))))";
		}elseif($section == 2){
			$cond = " AND (start_time_hour >= 13 AND (start_time_min >=(case when start_time_hour > 13 then 0 else 1 end)))";
		}else{
			$cond = "";
		}

			$new_oid = $oid;
		$sel = $this->db->query("SELECT * from assign_job_list where $new_oid IN (pry_oid,sec_oid,sup_id) and job_date_assign = '$date_val' $cond order by TIME(CONCAT(start_time_hour,':', start_time_min)) ASC");
		//echo "SELECT * from assign_job_list where $new_oid IN (pry_oid,sec_oid,sup_id) and job_date_assign = '$date_val' $cond order by TIME(CONCAT(start_time_hour,':', start_time_min)) ASC";
		$val = $sel->result();
		echo "<pre>";
		print_r($val);die;
		return $val;
	}

	public function getparticularjoblist($aid, $oid, $date, $section)
	{
//echo $aid."--".$oid."--".$date."--".$section;
		$date_val = date('Y-m-d', $date);
		if($section == 1){
			$cond = " AND aid='$aid' AND (start_time_hour >= 6 AND (start_time_hour <= 13 AND (start_time_min <=(case when start_time_hour >= 13 then 0 else 60 end))))";
		}elseif($section == 2){
			$cond = " AND aid='$aid' AND (start_time_hour >= 13 AND (start_time_min >=(case when start_time_hour > 13 then 0 else 1 end)))";
		}else{
			$cond = "";
		}

			$new_oid = $oid;
		$sel = $this->db->query("SELECT * from assign_job_list where $new_oid IN (pry_oid,sec_oid,sup_id) and job_date_assign = '$date_val' $cond order by TIME(CONCAT(start_time_hour,':', start_time_min)) ASC");
		//echo "SELECT * from assign_job_list where $new_oid IN (pry_oid,sec_oid,sup_id) and job_date_assign = '$date_val' $cond order by TIME(CONCAT(start_time_hour,':', start_time_min)) ASC";
		$val = $sel->result();
		return $val;
	}




}
?>
