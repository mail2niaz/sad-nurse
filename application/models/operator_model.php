<?php
Class Operator_model extends CI_Model
{
    public function __construct(){
        parent::__construct();
       $this->set_timezone();
    }

    public function set_timezone(){
        $this->db->query("SET time_zone='+5:30'");
    }
	 private $tbl_operator= 'operators';
	 private $tbl_operator_days= 'operator_working_days';
	 public function add_operator()
	{
		$time = time();
		if($this->input->post('tags') != ''){
			$tags = implode(",", $this->input->post('tags'));
		}else{
			$tags = "";
		}
		$dist = implode(",", $this->input->post('dist_id'));

		$data=array(
		'firstname'=>$this->input->post('firstname'),
		'lastname'=>$this->input->post('lastname'),
		'email'=>$this->input->post('email'),
		'username'=>$this->input->post('username'),
		'password'=>md5($this->input->post('password')),
		'role'=>$this->input->post('role'),
		'dist_id'=>$dist,
		'tags'=>$tags,
		'starting_point_address'=>mysql_escape_string($this->input->post('starting_point_address')),
		'contact_no'=>$this->input->post('contact_no'),
		'landline_no'=>$this->input->post('landline_no'),
		'ssn'=>$this->input->post('ssn'),
		'street'=>$this->input->post('street'),
		'hb_no'=>$this->input->post('hb_no'),
		'city'=>$this->input->post('city'),
		'postalcode'=>$this->input->post('postalcode'),
		'provincecode'=>$this->input->post('provincecode'),
		'mobile_udid'=>$this->input->post('mobile_udid'),
		'note'=>$this->input->post('note'),
		'dob'=>date("Y-m-d",strtotime($this->input->post('dob'))),
		'qualification'=>$this->input->post('qualification'),
		'hours_contract'=>$this->input->post('hours_contract'),
		'created_date'=>$time,
		);

		$this->db->insert('operators',$data);
	}

	public function update_operator($oid)
	{
		$time = time();
		if($this->input->post('suspended') == "on"){
			$suspended = $this->input->post('suspended');
		}else{
			$suspended = "off";
		}
		if($this->input->post('password') !=""){
			$data1 = array(
				'password'=>md5($this->input->post('password')),
			);
		}else{
			$data1 = array();
		}
		$dist = implode(",", $this->input->post('dist_id'));
			$tags = implode(",", $this->input->post('tags'));
			$data=array(
				'firstname'=>$this->input->post('firstname'),
				'lastname'=>$this->input->post('lastname'),
				'email'=>$this->input->post('email'),
				'username'=>$this->input->post('username'),
				'role'=>$this->input->post('role'),
				'dist_id'=>$dist,
				'tags'=>$tags,
				'starting_point_address'=>mysql_escape_string($this->input->post('starting_point_address')),
				'contact_no'=>$this->input->post('contact_no'),
				'landline_no'=>$this->input->post('landline_no'),
				'ssn'=>$this->input->post('ssn'),
				'street'=>$this->input->post('street'),
				'hb_no'=>$this->input->post('hb_no'),
				'city'=>$this->input->post('city'),
				'postalcode'=>$this->input->post('postalcode'),
				'provincecode'=>$this->input->post('provincecode'),
				'mobile_udid'=>$this->input->post('mobile_udid'),
				'note'=>$this->input->post('note'),
				'dob'=>date("Y-m-d",strtotime($this->input->post('dob'))),
				'qualification'=>$this->input->post('qualification'),
				'hours_contract'=>$this->input->post('hours_contract'),
				'edited_date'=>$time,
				'oid'=>$oid,
				'suspended'=>$suspended,
			);
			$insert_data=array_merge($data1,$data);

		$this->db->where('oid',$oid);
		$this->db->update($this->tbl_operator,$insert_data);

	}

function getoperator($oid=''){
	if($oid != ''){
		$this->db->where('oid', $oid);
		return $this->db->get($this->tbl_operator);
	}else{
		$this -> db -> select('oid,firstname,lastname,suspended,role,email,contact_no');
		$this -> db -> from($this->tbl_operator);
		$query = $this -> db -> get();
		return $query;
	}

 }

public function deleteoperator($oid)
{
	$this->db->where('oid',$oid);
	$this->db->delete($this->tbl_operator);
}

public function check_opt_exist($opt){
		$this->db->where("username",$opt);
		$query=$this->db->get("operators");
		if($query->num_rows()>0)
		{
			 return true;
		}else
			{
		 return false;

}
}

/* Operator Date */
public function operatordate_model($oid, $date, $actiondate, $leavetime)
{
	$lnote = $_REQUEST['lnote'];
	date_default_timezone_set("Asia/Kolkata");
	$subdate = substr($date, 0,-3);
	$chkdate = date("Y-m-d", $subdate);
	if($actiondate == "ins"){
	if($leavetime == 1){
		$cond = " AND ((start_time_hour >= 6 AND start_time_min >= 00) AND (end_time_hour <= 13))";
	}elseif($leavetime == 2){
		$cond = " AND ((start_time_hour >= 13 AND start_time_min >= 01) AND (end_time_hour <= 22))";
	}else{
		$cond = "";
	}
	$sel = mysql_query("SELECT * FROM `assign_job_list` WHERE $oid IN (pry_oid, sec_oid, sup_id) and job_date_assign = '$chkdate' $cond");
	$cnt = mysql_num_rows($sel);
	if($cnt > 0){
		echo lang("OPERATOR::leave_error");
	}else{
		$time = time();
		$data=array(
		'oid' => $oid,
		'wrk_date' => $date,
		'leavetime' => $leavetime,
		'note' => $lnote,
		'last_modify' => $time
		);
		$this->db->insert($this->tbl_operator_days,$data);
	}
	}elseif($actiondate == "rd"){
		$this->db->where('oid',$oid);
		$this->db->where('wrk_date',$date);
		$this->db->delete($this->tbl_operator_days);
	}
}


public function getoperatorleavelist($oid,$month)
{
		$sel = $this->db->query("SELECT wrk_date,note,FROM_UNIXTIME(SUBSTRING(wrk_date, 1, LENGTH(wrk_date)-3), '%d-%m-%Y') as date, leavetime FROM `operator_working_days` where oid = '$oid' AND FROM_UNIXTIME(SUBSTRING(wrk_date, 1, LENGTH(wrk_date)-3), '%m') = '$month' order by date ASC");
		$val = $sel->result();
		return $val;
}


public function GetAllHolidays($month=''){
	if($month !=''){
		$sel = $this->db->query("SELECT FROM_UNIXTIME(`hdate`, '%d-%m-%Y') as date, reason FROM `app_holidays` where FROM_UNIXTIME(`hdate`, '%m') = '$month'");
	}else{
		$sel = $this->db->query("SELECT hdate FROM `app_holidays`");
	}	
	return $sel;
} 
public function GetOperatorWorkingDays($oid){
	$sel = $this->db->query("SELECT * FROM operator_working_days WHERE oid = '$oid'");
	return $sel;
} 
}
?>
