<?php
Class Report_model extends CI_Model
{
      private $tbl_patients= 'patients';

      private $tbl_patients_info= 'patients_info_details';

      private $tbl_session_setup_details = 'admin_session_setup';

	public function add_session_setup($fdata)
	{
		
		$time = time();
		$morn_start_time = $this->input->post('morn_start_time');
		$morn_end_time = $this->input->post('morn_end_time');
		$data=array(
		'morn_start_time'=>$morn_start_time,
		'morn_end_time'=>$morn_end_time,
		'created_date'=>$time,
		'last_modify'=>$time,
		);
		$this->db->insert($this->tbl_session_setup_details,$data);
		
		return mysql_insert_id();
	}
	public function edit_session_setup($fdata,$id)
	{
		
		$time = time();
		$morn_start_time = $this->input->post('morn_start_time');
		$morn_end_time = $this->input->post('morn_end_time');
		$data=array(
		'morn_start_time'=>$morn_start_time,
		'morn_end_time'=>$morn_end_time,
		'created_date'=>$time,
		'last_modify'=>$time,
		);
		$this->db->where('id',$id);
		$this->db->update($this->tbl_session_setup_details,$data);
		
		return mysql_insert_id();
	}
	public function getsessionlist()
	{
		$query = $this->db->query("SELECT * FROM admin_session_setup");
		return $query;
	}
	public function getupdatesessionlist($id='')
	{
		$query = $this->db->query("SELECT * FROM admin_session_setup where id ='$id'");
		return $query;
	}
	/*Add webservice */
	public function add_webservice_url($fdata)
	{
	      $time = time();
		$url = $this->input->post('url');
		$data=array(
		      'url'=>$url,
		      'created_date'=>$time,
		      'last_modify'=>$time,
		);
		
		$url = $data['url'];
		$created_date = $data['created_date'];
		$last_modify = $data['last_modify'];
		$sel = "insert into admin_webservice(url,created_date,last_modify) values('$url','$created_date','$last_modify')";
		$sel_execu = mysql_query($sel);
		$last_insert_id = mysql_insert_id();
		/*Log */
            $sel_value_status = "select * from admin_webservices WHERE id = '$last_insert_id'";
            $q_status = mysql_query($sel_value_status);
            $val_status = mysql_fetch_assoc($q_status);
            $json_values_status = json_encode($val_status);
            $dt = new DateTime();
            $date_created = $dt->format('YmdHis');
            $insert_status = "INSERT INTO `dblogs` (`idutente`, `dataora`, `operazione`,`tabella`, `idtabella`, `data`,`rollbackfrom`, `canrollback`, `idpadre`) VALUES ('50000', '$date_created', 'I','admin_webservice', '$last_insert_id','$json_values_status','', 'N', '0')";
            mysql_query($insert_status);
		return $last_insert_id;
		//$this->db->insert($this->$tbl_admin_webservice_details,$data);
		//return mysql_insert_id();
	}
	public function edit_webservice($fdata,$id)
	{
		
		$time = time();
		$url = $this->input->post('url');
		$platform_code = $this->input->post('platform_code');
		$data=array(
		'url'=>$url,
		'platform_code'=>$platform_code,
		'created_date'=>$time,
		'last_modify'=>$time,
		);
	      $url = $data['url'];
	      $platform_code = $data['platform_code'];
		$created_date = $data['created_date'];
		$last_modify = $data['last_modify'];
		/*Log */
            $sel_value_status = "select * from admin_webservices WHERE id = '$id'";
            $q_status = mysql_query($sel_value_status);
            $val_status = mysql_fetch_assoc($q_status);
            $json_values_status = json_encode($val_status);
            $dt = new DateTime();
            $date_created = $dt->format('YmdHis');
            $insert_status = "INSERT INTO `dblogs` (`idutente`, `dataora`, `operazione`,`tabella`, `idtabella`, `data`,`rollbackfrom`, `canrollback`, `idpadre`) VALUES ('50000', '$date_created', 'U','admin_webservice', '$last_insert_id','$json_values_status','', 'N', '0')";
            mysql_query($insert_status);
		$sel = "update admin_webservice SET url='$url',platform_code = '$platform_code',created_date='$created_date',last_modify ='$last_modify' where id = '$id'";
		$sel_execu = mysql_query($sel);
		$last_insert_id = mysql_insert_id();
		return $last_insert_id;
		
	}
	public function getwebservicelist()
	{
		$query = $this->db->query("SELECT * FROM admin_webservice");
		return $query;
	}
	public function getwebservice($id='')
	{
		$query = $this->db->query("SELECT * FROM admin_webservice where id ='$id'");
		return $query;
	}
	public function getwebserviceurl() {
            $this->db->select('*');
            $this->db->from('admin_webservice');
            $q = $this->db->get();
            $val = $q->row_array();
            return $val;
	}
	/*End webservice */
	
      
function get_optresultdetails($rid){
	$this->db->select('*');
	$this->db->from('operators');
	$this->db->where('role', $rid);
	$q = $this->db->get();
	$val = $q->result();
	return $val;
 }

function get_optpiechart($rid){
	$q = $this->db->query("select opt.firstname, opt.lastname, (select count(*) from assign_pdns where operator = opt.oid) as cntpatient from operators as opt where role = '$rid'");
	$val = $q->result();
	return $val;
 }


/* Intervent Report */
function get_reqresultdetails($pid = NULL, $oid = NULL, $fdate = NULL ,$tdate = NULL){
	if($pid != "null" && $oid != "null" && $fdate != "null" && $tdate != "null"){
		$from_date = date("Y-m-d", strtotime($fdate));
		$to_date = date("Y-m-d", strtotime($tdate));
		$sel = "select request_id,duration,entry_date, (select DISTINCT CONCAT( `surname` , ' ', `pname` ) from patients where pid = pi.pid) as pname, (select CONCAT(`lastname`,' ',`firstname`) from operators where oid = pi.oid) as oname, (select latlang from patients where pid = pi.pid) as latlang, (select (select type from mt_role where rid = o.role ) from operators as o where oid = pi.oid) as role from patients_intervention_extra_details as pi where (DATE(pi.entry_date) between '$from_date' and '$to_date') AND pi.pid = '$pid' AND pi.oid='$oid'";

	}elseif($pid != "null" && $fdate != "null" && $tdate != "null"){
		$from_date = date("Y-m-d", strtotime($fdate));
		$to_date = date("Y-m-d", strtotime($tdate));
		$sel = "select request_id,duration,entry_date, (select DISTINCT CONCAT( `surname` , ' ', `pname` ) from patients where pid = pi.pid) as pname, (select CONCAT(`lastname`,' ',`firstname`) from operators where oid = pi.oid) as oname, (select latlang from patients where pid = pi.pid) as latlang, (select (select type from mt_role where rid = o.role ) from operators as o where oid = pi.oid) as role from patients_intervention_extra_details as pi where (DATE(pi.entry_date) between '$from_date' and '$to_date') AND pi.pid = '$pid'";
	}elseif($oid != "null" && $fdate != "null" && $tdate != "null"){
		$from_date = date("Y-m-d", strtotime($fdate));
		$to_date = date("Y-m-d", strtotime($tdate));
		$sel = "select request_id,duration,entry_date, (select DISTINCT CONCAT( `surname` , ' ', `pname` ) from patients where pid = pi.pid) as pname, (select CONCAT(`lastname`,' ',`firstname`) from operators where oid = pi.oid) as oname, (select latlang from patients where pid = pi.pid) as latlang, (select (select type from mt_role where rid = o.role ) from operators as o where oid = pi.oid) as role from patients_intervention_extra_details as pi where (DATE(pi.entry_date) between '$from_date' and '$to_date') AND pi.oid = '$oid'";
	}
	elseif($fdate != "null" && $tdate != "null"){
		$from_date = date("Y-m-d", strtotime($fdate));
		$to_date = date("Y-m-d", strtotime($tdate));
		$sel = "select request_id,duration,entry_date, (select DISTINCT CONCAT( `surname` , ' ', `pname` ) from patients where pid = pi.pid) as pname, (select CONCAT(`lastname`,' ',`firstname`) from operators where oid = pi.oid) as oname, (select latlang from patients where pid = pi.pid) as latlang, (select (select type from mt_role where rid = o.role ) from operators as o where oid = pi.oid) as role from patients_intervention_extra_details as pi where (DATE(pi.entry_date) between '$from_date' and '$to_date')";
	}
	elseif($pid != "null" && $oid != "null"){
		$sel = "select request_id,duration,entry_date, (select DISTINCT CONCAT( `surname` , ' ', `pname` ) from patients where pid = pi.pid) as pname, (select CONCAT(`lastname`,' ',`firstname`) from operators where oid = pi.oid) as oname, (select latlang from patients where pid = pi.pid) as latlang, (select (select type from mt_role where rid = o.role ) from operators as o where oid = pi.oid) as role from patients_intervention_extra_details as pi where pi.pid = '$pid' AND pi.oid = '$oid'";
	}
	elseif($pid != "null"){
		$sel = "select request_id,duration,entry_date, (select DISTINCT CONCAT( `surname` , ' ', `pname` ) from patients where pid = pi.pid) as pname, (select CONCAT(`lastname`,' ',`firstname`) from operators where oid = pi.oid) as oname, (select latlang from patients where pid = pi.pid) as latlang, (select (select type from mt_role where rid = o.role ) from operators as o where oid = pi.oid) as role from patients_intervention_extra_details as pi where pi.pid = '$pid'";
	}elseif($oid != "null"){
		$sel = "select request_id,duration,entry_date, (select DISTINCT CONCAT( `surname` , ' ', `pname` ) from patients where pid = pi.pid) as pname, (select CONCAT(`lastname`,' ',`firstname`) from operators where oid = pi.oid) as oname, (select latlang from patients where pid = pi.pid) as latlang, (select (select type from mt_role where rid = o.role ) from operators as o where oid = pi.oid) as role from patients_intervention_extra_details as pi where pi.oid = '$oid'";
	}
	$q = $this->db->query($sel);
	$val = $q->result();
	return $val;
 }



function get_reqresultcmt($rid){
	$q = $this->db->query("select meta_name, meta_value from patients_intervention_values where request_id = '$rid'");
	$val = $q->result();
	return $val;
 }

 function get_reqchart(){
 	//$mon = $this->input->post('mon');
 	$year = $this->input->post('year');
 	if($year != ""){
		$q = $this->db->query("SELECT FROM_UNIXTIME(`entry_date`, '%M') as month, count(pid) as pcnt, (select firstname from operators where oid = piv.oid) as oname FROM `patients_intervention_values` as piv where FROM_UNIXTIME(`entry_date`, '%Y') LIKE '$year' GROUP BY FROM_UNIXTIME(`entry_date`, '%m') ORDER BY FROM_UNIXTIME( `entry_date` , '%m' ) ASC");
 	}else{
		$q = $this->db->query("SELECT FROM_UNIXTIME(`entry_date`, '%M') as month, count(pid) as pcnt, (select firstname from operators where oid = piv.oid) as oname FROM `patients_intervention_values` as piv GROUP BY FROM_UNIXTIME(`entry_date`, '%m') ORDER BY FROM_UNIXTIME( `entry_date` , '%m' ) ASC");
 	}

	$val = $q->result();
	return $val;
 }
/* End Intervent Report */

/* Patient Intervent Report */
function get_patresultdetails($pid = NULL, $oid = NULL, $fdate = NULL ,$tdate = NULL, $did = NULL){
	
      if($pid == "null" && $oid == "null" && $fdate == "null" && $tdate == "null" && $did == "null"){
            $sel = "select pi.ped_id,pi.aid,pi.request_id,pi.entry_date,pi.oid,pi.pid,pi.start_time,pi.end_time,
            pi.duration,pi.intervent_id,pi.start_address,pi.note,pi.end_address,GROUP_CONCAT( DISTINCT(surname), ' ',(pname)) as pname,GROUP_CONCAT(DISTINCT (patient_address), ' ',(patient_city),' ',(patient_zip)) as planned_address,GROUP_CONCAT(DISTINCT(lastname),' ',(firstname)) as oname,r.type as role from  patients_intervention_extra_details as pi
            INNER JOIN patients as pn ON pn.pid = pi.pid INNER JOIN contract_intervent_weekdays as cw ON 
            cw.intervent_id = pi.intervent_id AND cw.pid = pi.pid INNER JOIN operators as op ON op.oid = pi.oid INNER JOIN mt_role as r ON r.rid = op.role GROUP BY pi.pid ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";

      } else if ($pid != "null" && $oid != "null" && $fdate != "null" && $tdate != "null" && $did != "null") {
            $from_date = date("Y-m-d", strtotime($fdate));
            $to_date = date("Y-m-d", strtotime($tdate));
            $sel = "select pi.ped_id,pi.aid,pi.request_id,pi.entry_date,pi.oid,pi.pid,pi.start_time,pi.end_time,
            pi.duration,pi.intervent_id,pi.start_address,pi.note,pi.end_address,GROUP_CONCAT( DISTINCT(surname), ' ',(pname)) as pname,GROUP_CONCAT(DISTINCT (patient_address), ' ',(patient_city),' ',(patient_zip)) as planned_address,GROUP_CONCAT(DISTINCT(lastname),' ',(firstname)) as oname,r.type as role from  patients_intervention_extra_details as pi
            INNER JOIN patients as pn ON pn.pid = pi.pid INNER JOIN contract_intervent_weekdays as cw ON 
            cw.intervent_id = pi.intervent_id AND cw.pid = pi.pid INNER JOIN operators as op ON op.oid = pi.oid INNER JOIN mt_role as r ON r.rid = op.role where pi.entry_date >= '$from_date' AND pi.entry_date <= '$to_date' AND pi.pid IN (SELECT pid from patients where pid = '$pid' AND FIND_IN_SET('$did', dist_id)) AND pi.oid='$oid' GROUP BY pi.pid ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
      } else if ($oid != "null" && $fdate != "null" && $tdate != "null" && $did != "null") {
            $from_date = date("Y-m-d", strtotime($fdate));
            $to_date = date("Y-m-d", strtotime($tdate));
            $sel = "select pi.ped_id,pi.aid,pi.request_id,pi.entry_date,pi.oid,pi.pid,pi.start_time,pi.end_time,
            pi.duration,pi.intervent_id,pi.start_address,pi.note,pi.end_address,GROUP_CONCAT( DISTINCT(surname), ' ',(pname)) as pname,GROUP_CONCAT(DISTINCT (patient_address), ' ',(patient_city),' ',(patient_zip)) as planned_address,GROUP_CONCAT(DISTINCT(lastname),' ',(firstname)) as oname,r.type as role from  patients_intervention_extra_details as pi
            INNER JOIN patients as pn ON pn.pid = pi.pid INNER JOIN contract_intervent_weekdays as cw ON 
            cw.intervent_id = pi.intervent_id AND cw.pid = pi.pid INNER JOIN operators as op ON op.oid = pi.oid INNER JOIN mt_role as r ON r.rid = op.role where pi.entry_date >= '$from_date' AND pi.entry_date < '$to_date' AND pi.pid IN (SELECT pid from patients where FIND_IN_SET('$did', dist_id)) AND pi.oid='$oid' GROUP BY pi.pid ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
      }else if($pid != "null" && $fdate != "null" && $tdate != "null" && $did != "null"){
            $from_date = date("Y-m-d", strtotime($fdate));
            $to_date = date("Y-m-d", strtotime($tdate));
            $sel = "select pi.ped_id,pi.aid,pi.request_id,pi.entry_date,pi.oid,pi.pid,pi.start_time,pi.end_time,
            pi.duration,pi.intervent_id,pi.start_address,pi.note,pi.end_address,GROUP_CONCAT( DISTINCT(surname), ' ',(pname)) as pname,GROUP_CONCAT(DISTINCT (patient_address), ' ',(patient_city),' ',(patient_zip)) as planned_address,GROUP_CONCAT(DISTINCT(lastname),' ',(firstname)) as oname,r.type as role from  patients_intervention_extra_details as pi
            INNER JOIN patients as pn ON pn.pid = pi.pid INNER JOIN contract_intervent_weekdays as cw ON 
            cw.intervent_id = pi.intervent_id AND cw.pid = pi.pid INNER JOIN operators as op ON op.oid = pi.oid INNER JOIN mt_role as r ON r.rid = op.role where pi.entry_date >= '$from_date' AND pi.entry_date <= '$to_date' AND pi.pid IN (SELECT pid from patients where pid = '$pid' AND FIND_IN_SET('$did', dist_id)) GROUP BY pi.pid ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
      }else if($pid != "null" && $oid != "null" && $did != "null"){
           
            $sel = "select pi.ped_id,pi.aid,pi.request_id,pi.entry_date,pi.oid,pi.pid,pi.start_time,pi.end_time,
            pi.duration,pi.intervent_id,pi.start_address,pi.note,pi.end_address,GROUP_CONCAT( DISTINCT(surname), ' ',(pname)) as pname,GROUP_CONCAT(DISTINCT (patient_address), ' ',(patient_city),' ',(patient_zip)) as planned_address,GROUP_CONCAT(DISTINCT(lastname),' ',(firstname)) as oname,r.type as role from  patients_intervention_extra_details as pi
            INNER JOIN patients as pn ON pn.pid = pi.pid INNER JOIN contract_intervent_weekdays as cw ON 
            cw.intervent_id = pi.intervent_id AND cw.pid = pi.pid INNER JOIN operators as op ON op.oid = pi.oid INNER JOIN mt_role as r ON r.rid = op.role where pi.pid IN (SELECT pid from patients where pid = '$pid' AND FIND_IN_SET('$did', dist_id)) AND pi.oid='$oid' GROUP BY pi.pid ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
      }else if($pid != "null" && $fdate != "null" && $tdate != "null"){
            $from_date = date("Y-m-d", strtotime($fdate));
		$to_date = date("Y-m-d", strtotime($tdate));
            $sel = "select pi.ped_id,pi.aid,pi.request_id,pi.entry_date,pi.oid,pi.pid,pi.start_time,pi.end_time,
            pi.duration,pi.intervent_id,pi.start_address,pi.note,pi.end_address,GROUP_CONCAT( DISTINCT(surname), ' ',(pname)) as pname,GROUP_CONCAT(DISTINCT (patient_address), ' ',(patient_city),' ',(patient_zip)) as planned_address,GROUP_CONCAT(DISTINCT(lastname),' ',(firstname)) as oname,r.type as role from  patients_intervention_extra_details as pi
            INNER JOIN patients as pn ON pn.pid = pi.pid INNER JOIN contract_intervent_weekdays as cw ON 
            cw.intervent_id = pi.intervent_id AND cw.pid = pi.pid INNER JOIN operators as op ON op.oid = pi.oid INNER JOIN mt_role as r ON r.rid = op.role where pi.entry_date >= '$from_date' AND pi.entry_date <= '$to_date' AND pi.pid = '$pid' GROUP BY pi.pid ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
      } else if($oid != "null" && $fdate != "null" && $tdate != "null"){
            $from_date = date("Y-m-d", strtotime($fdate));
		$to_date = date("Y-m-d", strtotime($tdate));
            $sel = "select pi.ped_id,pi.aid,pi.request_id,pi.entry_date,pi.oid,pi.pid,pi.start_time,pi.end_time,
            pi.duration,pi.intervent_id,pi.start_address,pi.note,pi.end_address,GROUP_CONCAT( DISTINCT(surname), ' ',(pname)) as pname,GROUP_CONCAT(DISTINCT (patient_address), ' ',(patient_city),' ',(patient_zip)) as planned_address,GROUP_CONCAT(DISTINCT(lastname),' ',(firstname)) as oname,r.type as role from  patients_intervention_extra_details as pi
            INNER JOIN patients as pn ON pn.pid = pi.pid INNER JOIN contract_intervent_weekdays as cw ON 
            cw.intervent_id = pi.intervent_id AND cw.pid = pi.pid INNER JOIN operators as op ON op.oid = pi.oid INNER JOIN mt_role as r ON r.rid = op.role where pi.entry_date >= '$from_date' AND pi.entry_date <= '$to_date' AND pi.oid = '$oid' GROUP BY pi.pid ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
      } else if($fdate != "null" && $tdate != "null" && $did != "null"){
            $from_date = date("Y-m-d", strtotime($fdate));
		$to_date = date("Y-m-d", strtotime($tdate));
            $sel = "select pi.ped_id,pi.aid,pi.request_id,pi.entry_date,pi.oid,pi.pid,pi.start_time,pi.end_time,
            pi.duration,pi.intervent_id,pi.start_address,pi.note,pi.end_address,GROUP_CONCAT( DISTINCT(surname), ' ',(pname)) as pname,GROUP_CONCAT(DISTINCT (patient_address), ' ',(patient_city),' ',(patient_zip)) as planned_address,GROUP_CONCAT(DISTINCT(lastname),' ',(firstname)) as oname,r.type as role from  patients_intervention_extra_details as pi
            INNER JOIN patients as pn ON pn.pid = pi.pid INNER JOIN contract_intervent_weekdays as cw ON 
            cw.intervent_id = pi.intervent_id AND cw.pid = pi.pid INNER JOIN operators as op ON op.oid = pi.oid INNER JOIN mt_role as r ON r.rid = op.role where pi.entry_date >= '$from_date' AND pi.entry_date <= '$to_date' AND pi.pid IN (SELECT pid from patients where FIND_IN_SET('$did', dist_id)) GROUP BY pi.pid ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
      }else if($fdate != "null" && $tdate != "null" && $did != "null"){
            $from_date = date("Y-m-d", strtotime($fdate));
		$to_date = date("Y-m-d", strtotime($tdate));
            $sel = "select pi.ped_id,pi.aid,pi.request_id,pi.entry_date,pi.oid,pi.pid,pi.start_time,pi.end_time,
            pi.duration,pi.intervent_id,pi.start_address,pi.note,pi.end_address,GROUP_CONCAT( DISTINCT(surname), ' ',(pname)) as pname,GROUP_CONCAT(DISTINCT (patient_address), ' ',(patient_city),' ',(patient_zip)) as planned_address,GROUP_CONCAT(DISTINCT(lastname),' ',(firstname)) as oname,r.type as role from  patients_intervention_extra_details as pi
            INNER JOIN patients as pn ON pn.pid = pi.pid INNER JOIN contract_intervent_weekdays as cw ON 
            cw.intervent_id = pi.intervent_id AND cw.pid = pi.pid INNER JOIN operators as op ON op.oid = pi.oid INNER JOIN mt_role as r ON r.rid = op.role where pi.entry_date >= '$from_date' AND pi.entry_date <= '$to_date' GROUP BY pi.pid ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
      } else if($pid != "null" && $oid != "null"){

            $sel = "select pi.ped_id,pi.aid,pi.request_id,pi.entry_date,pi.oid,pi.pid,pi.start_time,pi.end_time,
            pi.duration,pi.intervent_id,pi.start_address,pi.note,pi.end_address,GROUP_CONCAT( DISTINCT(surname), ' ',(pname)) as pname,GROUP_CONCAT(DISTINCT (patient_address), ' ',(patient_city),' ',(patient_zip)) as planned_address,GROUP_CONCAT(DISTINCT(lastname),' ',(firstname)) as oname,r.type as role from  patients_intervention_extra_details as pi
            INNER JOIN patients as pn ON pn.pid = pi.pid INNER JOIN contract_intervent_weekdays as cw ON 
            cw.intervent_id = pi.intervent_id AND cw.pid = pi.pid INNER JOIN operators as op ON op.oid = pi.oid INNER JOIN mt_role as r ON r.rid = op.role where pi.pid = '$pid' AND pi.oid = '$oid' GROUP BY pi.pid ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
      } else if($pid != "null" && $did != "null"){

            $sel = "select pi.ped_id,pi.aid,pi.request_id,pi.entry_date,pi.oid,pi.pid,pi.start_time,pi.end_time,
            pi.duration,pi.intervent_id,pi.start_address,pi.note,pi.end_address,GROUP_CONCAT( DISTINCT(surname), ' ',(pname)) as pname,GROUP_CONCAT(DISTINCT (patient_address), ' ',(patient_city),' ',(patient_zip)) as planned_address,GROUP_CONCAT(DISTINCT(lastname),' ',(firstname)) as oname,r.type as role from  patients_intervention_extra_details as pi
            INNER JOIN patients as pn ON pn.pid = pi.pid INNER JOIN contract_intervent_weekdays as cw ON 
            cw.intervent_id = pi.intervent_id AND cw.pid = pi.pid INNER JOIN operators as op ON op.oid = pi.oid INNER JOIN mt_role as r ON r.rid = op.role where pi.pid = '$pid' AND pi.oid IN (SELECT pid from patients where FIND_IN_SET('$did', dist_id)) GROUP BY pi.pid ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
      } else if($oid != "null" && $did != "null"){

            $sel = "select pi.ped_id,pi.aid,pi.request_id,pi.entry_date,pi.oid,pi.pid,pi.start_time,pi.end_time,
            pi.duration,pi.intervent_id,pi.start_address,pi.note,pi.end_address,GROUP_CONCAT( DISTINCT(surname), ' ',(pname)) as pname,GROUP_CONCAT(DISTINCT (patient_address), ' ',(patient_city),' ',(patient_zip)) as planned_address,GROUP_CONCAT(DISTINCT(lastname),' ',(firstname)) as oname,r.type as role from  patients_intervention_extra_details as pi
            INNER JOIN patients as pn ON pn.pid = pi.pid INNER JOIN contract_intervent_weekdays as cw ON 
            cw.intervent_id = pi.intervent_id AND cw.pid = pi.pid INNER JOIN operators as op ON op.oid = pi.oid INNER JOIN mt_role as r ON r.rid = op.role where pi.pid IN (SELECT pid from patients where FIND_IN_SET('$did', dist_id)) AND pi.oid = '$oid' GROUP BY pi.pid ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
      } else if($pid != "null") {

            $sel = "select pi.ped_id,pi.aid,pi.request_id,pi.entry_date,pi.oid,pi.pid,pi.start_time,pi.end_time,
            pi.duration,pi.intervent_id,pi.start_address,pi.note,pi.end_address,GROUP_CONCAT( DISTINCT(surname), ' ',(pname)) as pname,GROUP_CONCAT(DISTINCT (patient_address), ' ',(patient_city),' ',(patient_zip)) as planned_address,GROUP_CONCAT(DISTINCT(lastname),' ',(firstname)) as oname,r.type as role from  patients_intervention_extra_details as pi
            INNER JOIN patients as pn ON pn.pid = pi.pid INNER JOIN contract_intervent_weekdays as cw ON 
            cw.intervent_id = pi.intervent_id AND cw.pid = pi.pid INNER JOIN operators as op ON op.oid = pi.oid INNER JOIN mt_role as r ON r.rid = op.role where pi.pid = '$pid' GROUP BY pi.pid ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
      } else if($oid != "null") {

            $sel = "select pi.ped_id,pi.aid,pi.request_id,pi.entry_date,pi.oid,pi.pid,pi.start_time,pi.end_time,
            pi.duration,pi.intervent_id,pi.start_address,pi.note,pi.end_address,GROUP_CONCAT( DISTINCT(surname), ' ',(pname)) as pname,GROUP_CONCAT(DISTINCT (patient_address), ' ',(patient_city),' ',(patient_zip)) as planned_address,GROUP_CONCAT(DISTINCT(lastname),' ',(firstname)) as oname,r.type as role from  patients_intervention_extra_details as pi
            INNER JOIN patients as pn ON pn.pid = pi.pid INNER JOIN contract_intervent_weekdays as cw ON 
            cw.intervent_id = pi.intervent_id AND cw.pid = pi.pid INNER JOIN operators as op ON op.oid = pi.oid INNER JOIN mt_role as r ON r.rid = op.role where pi.oid = '$oid' GROUP BY pi.pid ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
      } else if($did != "null") {

            $sel = "select pi.ped_id,pi.aid,pi.request_id,pi.entry_date,pi.oid,pi.pid,pi.start_time,pi.end_time,
            pi.duration,pi.intervent_id,pi.start_address,pi.note,pi.end_address,GROUP_CONCAT( DISTINCT(surname), ' ',(pname)) as pname,GROUP_CONCAT(DISTINCT (patient_address), ' ',(patient_city),' ',(patient_zip)) as planned_address,GROUP_CONCAT(DISTINCT(lastname),' ',(firstname)) as oname,r.type as role from  patients_intervention_extra_details as pi
            INNER JOIN patients as pn ON pn.pid = pi.pid INNER JOIN contract_intervent_weekdays as cw ON 
            cw.intervent_id = pi.intervent_id AND cw.pid = pi.pid INNER JOIN operators as op ON op.oid = pi.oid INNER JOIN mt_role as r ON r.rid = op.role where pi.pid IN (SELECT pid from patients where  FIND_IN_SET('$did', dist_id)) GROUP BY pi.pid ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
      } else if($fdate != "null" && $tdate != "null") {
            $from_date = date("Y-m-d", strtotime($fdate));
		$to_date = date("Y-m-d", strtotime($tdate));
            $sel = "select pi.ped_id,pi.aid,pi.request_id,pi.entry_date,pi.oid,pi.pid,pi.start_time,pi.end_time,
            pi.duration,pi.intervent_id,pi.start_address,pi.note,pi.end_address,GROUP_CONCAT( DISTINCT(surname), ' ',(pname)) as pname,GROUP_CONCAT(DISTINCT (patient_address), ' ',(patient_city),' ',(patient_zip)) as planned_address,GROUP_CONCAT(DISTINCT(lastname),' ',(firstname)) as oname,r.type as role from  patients_intervention_extra_details as pi
            INNER JOIN patients as pn ON pn.pid = pi.pid INNER JOIN contract_intervent_weekdays as cw ON 
            cw.intervent_id = pi.intervent_id AND cw.pid = pi.pid INNER JOIN operators as op ON op.oid = pi.oid INNER JOIN mt_role as r ON r.rid = op.role where pi.entry_date >= '$from_date' AND pi.entry_date <= '$to_date' GROUP BY pi.pid ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
      }

      $qsel = $sel;
      $qry = $this->db->query($qsel);
      $val = $qry->result();
      return $val;
 }
 
/*function get_patresultdetails($pid = NULL, $oid = NULL, $fdate = NULL ,$tdate = NULL, $did = NULL){
	$sel = "select pi.ped_id,pi.aid,pi.request_id,pi.entry_date,pi.oid,pi.pid,pi.start_time,pi.end_time,pi.duration,pi.intervent_id,pi.start_address,pi.note,pi.end_address, (select DISTINCT CONCAT( `surname` , ' ', `pname` ) from patients where pid = pi.pid) as pname,(select CONCAT( `patient_address` , ' ', `patient_city`,' ', `patient_zip` ) from contract_intervent_weekdays where intervent_id = pi.intervent_id AND pid = pi.pid) as planned_address,(select CONCAT(`lastname`,' ',`firstname`) from operators where oid = pi.oid) as oname, (select (select type from mt_role where rid = o.role ) from operators as o where oid = pi.oid) as role from  patients_intervention_extra_details as pi where ";

	if($pid != "null" && $oid != "null" && $fdate != "null" && $tdate != "null" && $did != "null"){
		$from_date = date("Y-m-d", strtotime($fdate));
		$to_date = date("Y-m-d", strtotime($tdate));
		$q = "(DATE(pi.entry_date) between '$from_date' and '$to_date') AND pi.pid IN (SELECT pid from patients where pid = '$pid' AND dist_id = '$did') AND pi.oid='$oid' ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";

	}else if($oid != "null" && $fdate != "null" && $tdate != "null" && $did != "null"){
		$from_date = date("Y-m-d", strtotime($fdate));
		$to_date = date("Y-m-d", strtotime($tdate));
		$q = "(DATE(pi.entry_date) between '$from_date' and '$to_date') AND pi.pid IN (SELECT pid from patients where dist_id = '$did') AND pi.oid='$oid' ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
	}elseif($pid != "null" && $fdate != "null" && $tdate != "null" && $did != "null"){
		$from_date = date("Y-m-d", strtotime($fdate));
		$to_date = date("Y-m-d", strtotime($tdate));
		$q = "(DATE(pi.entry_date) between '$from_date' and '$to_date') AND pi.pid IN (SELECT pid from patients where pid = '$pid' AND dist_id = '$did') ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
	}elseif($pid != "null" && $oid != "null" && $did != "null"){
		$q = "pi.pid IN (SELECT pid from patients where pid = '$pid' AND dist_id = '$did') AND pi.oid='$oid' ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";

	}
	elseif($pid != "null" && $fdate != "null" && $tdate != "null"){
		$from_date = date("Y-m-d", strtotime($fdate));
		$to_date = date("Y-m-d", strtotime($tdate));
		$q = "(DATE(pi.entry_date) between '$from_date' and '$to_date') AND pi.pid = '$pid' ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";

	}elseif($oid != "null" && $fdate != "null" && $tdate != "null"){
		$from_date = date("Y-m-d", strtotime($fdate));
		$to_date = date("Y-m-d", strtotime($tdate));
		$q = "(DATE(pi.entry_date) between '$from_date' and '$to_date') AND pi.oid = '$oid' ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
	}elseif($fdate != "null" && $tdate != "null" && $did != "null"){
		$from_date = date("Y-m-d", strtotime($fdate));
		$to_date = date("Y-m-d", strtotime($tdate));
		$q = "(DATE(pi.entry_date) between '$from_date' and '$to_date') AND pi.pid IN (SELECT pid from patients where dist_id = '$did') ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";

	}
	elseif($fdate != "null" && $tdate != "null"){
			$from_date = date("Y-m-d", strtotime($fdate));
		$to_date = date("Y-m-d", strtotime($tdate));
		$q = "(DATE(pi.entry_date) between '$from_date' and '$to_date') ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
	}
	elseif($pid != "null" && $oid != "null"){
		$q = "pi.pid = '$pid' AND pi.oid = '$oid' ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
	}elseif($pid != "null" && $did != "null"){
		$q = "pi.pid = '$pid' AND pi.oid IN (SELECT pid from patients where dist_id = '$did') ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
	}
	elseif($did != "null" && $oid != "null"){
		$q = "pi.pid IN (SELECT pid from patients where dist_id = '$did') AND pi.oid = '$oid' ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";
	}
	elseif($pid != "null"){
		$q = "pi.pid = '$pid' ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";

	}elseif($oid != "null"){
		$q = "pi.oid = '$oid' ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) ASC";

	}elseif($did != "null"){
		$q = "pi.pid IN (SELECT pid from patients where  dist_id = '$did') ORDER BY CONCAT(pi.entry_date, ' ',pi.start_time) DESC";
	}
$qsel = $sel.$q;
$qry = $this->db->query($qsel);
	$val = $qry->result();
	return $val;
 }*/

function get_patcmtdetails($pid, $oid, $req_id){
	$q = $this->db->query("select DISTINCT request_id, meta_name,meta_value from patients_intervention_values as opt where request_id = '$req_id' AND oid = '$oid' AND pid= '$pid'");
	$val = $q->result();
	return $val;
}
function get_individual_patresultdetails($id){
	$q = $this->db->query("select start_time,end_time,start_address,end_address,note from patients_intervention_extra_details where ped_id = '$id'");
	$val = $q->result();
	return $val;
}

public function put_individual_patresultdetails()
{
	$shourcombo = $_REQUEST['shourcombo'];
	$smincombo = $_REQUEST['smincombo'];
	$sseccombo = $_REQUEST['sseccombo'];
	$start_time = $shourcombo.":".$smincombo.":".$sseccombo;

	$ehourcombo = $_REQUEST['ehourcombo'];
	$emincombo = $_REQUEST['emincombo'];
	$eseccombo = $_REQUEST['eseccombo'];
	$end_time = $ehourcombo.":".$emincombo.":".$eseccombo;

	$start_address = mysql_escape_string($_REQUEST['start_address']);
	$end_address = mysql_escape_string($_REQUEST['end_address']);
	$note = mysql_escape_string($_REQUEST['note']);
	$ped_id = $_REQUEST['ped_id'];
	$duration = $this->getTimeDiff($shourcombo.":".$smincombo,$ehourcombo.":".$emincombo);


$this->times_counter->get_total_time($diff);
		$data=array(
			'start_time'=>$start_time,
			'end_time'=>$end_time,
			'start_address'=>$start_address,
			'end_address'=>$end_address,
			'note'=>$note,
			'duration'=>$duration,
		);

		$this->db->where('ped_id',$ped_id);
		$this->db->update("patients_intervention_extra_details",$data);

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
 /* End Patient Intervent Report */
 /*Insert data webservice */
function senddata_webservice_insert($event,$response_arr) {
      
     
      $time = time();
      $send_data = json_encode($event);
      $response_data = json_encode($response_arr);
      $data = array(
		'dataSend'=>$send_data,
		'ws_response'=>$response_data,
		'created_date'=>$time,
		); 
	echo "<pre>";
	print_r($data);die;
	$this->db->insert('store_ws_sendata_response',$data);
      return $this->db->insert_id();
      
}

 
}
?>
