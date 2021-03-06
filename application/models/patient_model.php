<?php
Class Patient_model extends CI_Model
{
	 private $tbl_patients= 'patients';

	 private $tbl_patients_info= 'patients_info_details';

	 private $tbl_patients_info_img= 'patients_info_image';

	 public function add_patient()
	{
		$time = time();
		$cont = implode(",", $this->input->post('contact_no'));
		$data=array(
		'pname'=>$this->input->post('pname'),
		'surname'=>$this->input->post('surname'),
		'sex'=>$this->input->post('sex'),
		'email'=>$this->input->post('email'),
		'dist_id'=>$this->input->post('dist_id'),
		'ws_code'=>$this->input->post('ws_code'),
		'dob'=>date("Y-m-d",strtotime($this->input->post('dob'))),
		'contact_no'=>$cont,
		'ssn'=>$this->input->post('ssn'),
		'address'=>$this->input->post('address'),
		'zip_code'=>$this->input->post('zip_code'),
		'latlang'=>$this->input->post('latlang'),
		'note'=>$this->input->post('note'),
		'created_date'=>$time,
		'created_by_type'=>$this->input->post('tid'),
		'created_by'=>$this->input->post('aid'),
		'provre'=>$this->input->post('provre'),
		'pa_surname'=>$this->input->post('pa_surname'),
		'paying'=>$this->input->post('paying'),
		'pa_address'=>$this->input->post('pa_address'),
		'pa_provre'=>$this->input->post('pa_provre'),
		'pa_cap'=>$this->input->post('pa_cap'),
		'pa_city'=>$this->input->post('pa_city'),
		'city'=>$this->input->post('city'),
		'nas_city'=>$this->input->post('nas_city'),
		'p2000_id'=>$time,
		);

		$this->db->insert($this->tbl_patients,$data);
	}

	public function update_patient($pid)
	{
		$time = time();
		$cont = implode(",", $this->input->post('contact_no'));
		$data=array(
		'pname'=>$this->input->post('pname'),
		'surname'=>$this->input->post('surname'),
		'sex'=>$this->input->post('sex'),
		'email'=>$this->input->post('email'),
		'dist_id'=>$this->input->post('dist_id'),
		'ws_code'=>$this->input->post('ws_code'),
		'dob'=>date("Y-m-d",strtotime($this->input->post('dob'))),
		'contact_no'=>$cont,
		'ssn'=>$this->input->post('ssn'),
		'address'=>$this->input->post('address'),
		'zip_code'=>$this->input->post('zip_code'),
		'latlang'=>$this->input->post('latlang'),
		'note'=>$this->input->post('note'),
		'edited_date'=>$time,
		'provre'=>$this->input->post('provre'),
		'pa_surname'=>$this->input->post('pa_surname'),
		'paying'=>$this->input->post('paying'),
		'pa_address'=>$this->input->post('pa_address'),
		'pa_provre'=>$this->input->post('pa_provre'),
		'pa_cap'=>$this->input->post('pa_cap'),
		'pa_city'=>$this->input->post('pa_city'),
		'city'=>$this->input->post('city'),
		'nas_city'=>$this->input->post('nas_city'),
		);

		$this->db->where('pid',$pid);
		$this->db->update($this->tbl_patients,$data);

	}

function getpatient($pid=''){
	if($pid != ''){
		$this->db->where('pid', $pid);
		return $this->db->get($this->tbl_patients);
	}else{
		$this -> db -> select('pid,pname,surname,dist_id,contact_no');
		$this -> db -> from($this->tbl_patients);
		$this->db->order_by('pid', 'DESC');
		$query = $this -> db -> get();
		return $query;
	}
 }

public function deletepatient($pid)
{
	$this->db->where('pid',$pid);
	$this->db->delete($this->tbl_patients);
}

/* Patient Info */
 public function add_patientinfo($fdata)
	{
		$time = time();
		$pid = $this->input->post('pid');
		$role = array_filter($this->input->post('role'));
		$role_imp = implode(",", $role);

		$data=array(
		'pid' => $pid,
		'rid'=>$role_imp,
		'info'=>$this->input->post('info'),
		'entry_date'=>$time,
		);
		$this->db->insert($this->tbl_patients_info,$data);
		$piid = $this->db->insert_id();
		$files = count($fdata);
		for($i = 0; $i < $files; $i++){
			$img = str_replace(" ", "_", $fdata[$i]);
			mysql_query("insert into patients_info_image(`piid`,`pid`,`files`) values('$piid','$pid','$img')");
			 $pi_img_insert_id = mysql_insert_id();
                  /* Log Insert */
                  $sel_value_job = "select * from patients_info_image WHERE pi_img_id = '$pi_img_insert_id'";
                  $q_job = mysql_query($sel_value_job);
                  $val_job = mysql_fetch_assoc($q_job);
                  $json_values_job = json_encode($val_job);
                  $dt = new DateTime();
                  $date_created = $dt->format('YmdHis');
                  $insert_job = "INSERT INTO `dblogs` (`idutente`, `dataora`, `operazione`,`tabella`, `idtabella`, `data`,`rollbackfrom`, `canrollback`, `idpadre`) VALUES ('50000', '$date_created', 'I','patients_info_image', '$pi_img_insert_id','$json_values_job','', 'N', '0')";
                  mysql_query($insert_job);
		}
	}


	public function update_patientinfo($piid,$fdata)
	{
		$time = time();
		$role = array_filter($this->input->post('role'));
		$role_imp = implode(",", $role);
		$data=array(
		'rid'=>$role_imp,
		'info'=>$this->input->post('info'),
		'entry_date'=>$time,
		);

		$this->db->where('piid',$piid);
		$this->db->update($this->tbl_patients_info,$data);
		$pid = $this->input->post('pid');
		//$piid = $this->db->insert_id();
		$files = count($fdata);

		if($files > 0){
		for($i = 0; $i < $files; $i++){
			$img = str_replace(" ", "_", $fdata[$i]);
			mysql_query("insert into patients_info_image(`piid`,`pid`,`files`) values('$piid','$pid','$img')");
			 $pi_img_insert_id = mysql_insert_id();
                  /* Log Insert */
                  $sel_value_job = "select * from patients_info_image WHERE pi_img_id = '$pi_img_insert_id'";
                  $q_job = mysql_query($sel_value_job);
                  $val_job = mysql_fetch_assoc($q_job);
                  $json_values_job = json_encode($val_job);
                  $dt = new DateTime();
                  $date_created = $dt->format('YmdHis');
                  $insert_job = "INSERT INTO `dblogs` (`idutente`, `dataora`, `operazione`,`tabella`, `idtabella`, `data`,`rollbackfrom`, `canrollback`, `idpadre`) VALUES ('50000', '$date_created', 'U','patients_info_image', '$pi_img_insert_id','$json_values_job','', 'N', '0')";
                  mysql_query($insert_job);
		}
		}
	}

function getpatientinfo($piid){
		$this->db->where('piid', $piid);
		return $this->db->get($this->tbl_patients_info);
 }
function getpatientinfolist($pid){
		$this->db->where('pid', $pid);
		return $this->db->get($this->tbl_patients_info);
 }
function getpatientinfoimage($piid){
		$this->db->where('piid', $piid);
		return $this->db->get($this->tbl_patients_info_img);
 }
public function deletepatinfo($piid)
{
	$this->db->where('piid',$piid);
	$this->db->delete($this->tbl_patients_info);

	$this->db->where('piid',$piid);
	$this->db->delete($this->tbl_patients_info_img);
}

public function deletepatinfoimg_model($piimg)
{
	$this -> db -> select('files');
	$this -> db -> from('patients_info_image');
	$this -> db -> where('pi_img_id = ' . "'" . $piimg . "'");
	$query = $this -> db -> get();
	$val = $query->result();
	$dirname = $this->config->item('upload_folder');
	$file = "uploads/".$dirname."/".$val[0]->files;
	unlink($file);
	$this->db->where('pi_img_id',$piimg);
	$this->db->delete($this->tbl_patients_info_img);
}

public function statuspatinfo($pid,$piid, $status)
{
	$data=array(
		'status'=>$status,
		);
	$this->db->where('piid',$piid);
	$this->db->where('pid',$pid);
	$this->db->update($this->tbl_patients_info,$data);
}
}
?>
