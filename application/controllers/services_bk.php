<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class Services extends CI_Controller {

  function __construct()
  {
    parent::__construct();
	$this->load->language('mci');
  }

  /* Webservices */

public function getpatdetails(){

	$obj = json_decode($_REQUEST['ipjson']);
	$oid =  $obj->oid;
	$currdate = $obj->currdate;
	$week = date("W");
    $todaydate = strtotime($obj->todaydate);
/*
	$currdate = 1;
	$week = "30";
	$oid = 1;
	$todaydate = strtotime('2014-07-21');
*/

	$tommorrowdate = strtotime("+1 day", $todaydate);
	$sevendate = strtotime("+7 day", $todaydate);

	$this->load->model('ws');
	$result = array();

  	$result['patient'] = $this->ws->getoperatorpatient($oid,$currdate,$week);
	$cnt = count($result['patient']);

	for($i = 0; $i<$cnt; $i++){
		$pid = $result['patient'][$i]->pid;
		$rid = $result['patient'][$i]->role;
		$intervent_type_id = $result['patient'][$i]->intervent_type_id;
		$pinfo_cnt = count($this->ws->getoperatorpatientinfo($rid, $pid));
		//if($pinfo_cnt != '0'){
			$result['patientinfo'][] = array_filter($this->ws->getoperatorpatientinfo($rid, $pid));
			$info_cnt = count($result['patientinfo'][$i]);
			$piid =  $result['patientinfo'][$i][0]->piid;
			for($s = 0; $s < $info_cnt; $s++){
				//echo $result['patientinfo'][$i][$s]->piid;
				$result['patientattachment'][] = $this->ws->getpatientimages($result['patientinfo'][$i][$s]->piid,$pid);
			}
			//$result['patientattachment'][] = $this->ws->getpatientimages($piid,$pid);

		//}
		$result['patientdynamicform'][$i] = $this->ws->get_dynamic_fields($rid,$intervent_type_id);
	}

	$result['fpatient'] = $this->ws->getfeatureoperatorpatient($oid,$tommorrowdate,$sevendate);
	$cnt1 = count($result['fpatient']);

	for($j = 0; $j<$cnt1; $j++){
		$fpid = $result['fpatient'][$j]->pid;
		$frid = $result['fpatient'][$j]->role;
		$faid = $result['fpatient'][$j]->aid;
		$fintervent_type_id = $result['fpatient'][$j]->intervent_type_id;
		//$fpinfo_cnt = count($this->ws->getoperatorpatientinfo($frid, $fpid));
			$result['fpatientinfo'][] = array_filter($this->ws->getoperatorpatientinfo($frid, $fpid));
			$finfo_cnt = count($result['fpatientinfo'][$j]);
			$fpiid =  $result['fpatientinfo'][$j][0]->piid;
			for($fs = 0; $fs < $finfo_cnt; $fs++){
				$result['fpatientattachment'][] = $this->ws->getpatientimages($result['fpatientinfo'][$j][$fs]->piid,$fpid);
			}
		$result['fpatientdynamicform'][$j] = $this->ws->get_dynamic_fields($frid,$fintervent_type_id);
	}
	//print_r(array_filter($result));
   echo json_encode($result);
}

public function getoptfieldsdetails(){
	$obj = json_decode($_REQUEST['ipjson']);
	$rid = $obj->rid;
	$intervent_type_id = $obj->intervent_type_id;
	//$rid = 1;

	$this->load->model('ws');
	$result = array();
  	$result['fields'] = $this->ws->getoptfields($rid,$intervent_type_id);
	echo json_encode($result);

  }

public function getfieldsdata(){
	$ary = $_REQUEST;
	$this->load->model('ws');
	$result = array();
  	$result = $this->ws->putgetfieldsdata($ary);
	echo json_encode($result);
}

public function saveofflinedata(){
	$this->load->model('ws');
		$result = array();
		 $result = $this->ws->offline_save_data();
		echo json_encode($result);
}


public function dbdata(){
	$this->load->model('ws');
  	$result = $this->ws->putdata();
	echo $result;

}

public function dbdata1(){
    $this->load->model('ws');
      $result = $this->ws->updatejobassign();
    echo $result;

}



public function deletedupcontract(){
	$query = $this->db->query("SELECT * FROM contract_details order by cid DESC");
	foreach ($query->result() as $row)
   {
		$ss[] = $row->cid;
   }
   $scid = implode(",", $ss);
	$sel = "SELECT cid FROM contract_intervent_weekdays a where a.cid NOT IN ($scid)";
	$qry = mysql_query($sel);
	while($fet = mysql_fetch_assoc($qry)){
		$cid = $fet['cid'];
		mysql_query("delete from contract_intervent_weekdays where cid = '$cid'");
	}
}

public function deleteduppatient()
{
	$query = $this->db->query("SELECT ssn, COUNT(*) c FROM patients where ssn !='' GROUP BY ssn HAVING c > 1");
	foreach ($query->result() as $row)
   {
		$ssn = $row->ssn;
		$c = $row->c;
		//echo $ssn."--".$c."<br>";
		$select = "SELECT pid,ssn FROM patients where ssn = '$ssn'";
		$qry = mysql_query($select);
		$i = 1;
		while($fet = mysql_fetch_assoc($qry)){

			//echo $pid = $ssn1."--".$fet['pid']."<br>";
			if($i != 1){
				$ssn1 = $fet['ssn'];
				$pid = $fet['pid'];
				mysql_query("DELETE FROM patients WHERE pid = '$pid' AND ssn = '$ssn1'");
			}
			$i++;
		}
   }
}

public function operator_geo()
{
	print_r($_REQUEST);
}
?>
