<?php
Class Setting_model extends CI_Model
{

	 public function changepass()
	{
		$aid = $this->input->post('aid');
		$data=array(
		'password'=>md5($this->input->post('cnew_pass')),
		);
		$this->db->where('aid',$aid);
		$this->db->update("admins",$data);
	}

 public function acl_control($tid)
	{
		if($_REQUEST['add'] == "undefined"){
			$add = 2;
		}else{
			$add = $_REQUEST['add'];
		}

		if($_REQUEST['edit'] == "undefined"){
			$edit = 2;
		}else{
			$edit = $_REQUEST['edit'];
		}

		if($_REQUEST['view'] == "undefined"){
			$view = 2;
		}else{
			$view = $_REQUEST['view'];
		}

		if($_REQUEST['delete'] == "undefined"){
			$delete = 2;
		}else{
			$delete = $_REQUEST['delete'];
		}
		$data=array(
		'add'=>$add,
		'edit'=>$edit,
		'view'=>$view,
		'delete'=>$delete,
		);
		$this->db->where('tid',$tid);
		$this->db->update("admin_types",$data);

	}

public function acl_module_control($tid)
	{
		if($_REQUEST['operator'] == "undefined"){
			$operator = 2;
		}else{
			$operator = $_REQUEST['operator'];
		}

		if($_REQUEST['patient'] == "undefined"){
			$patient = 2;
		}else{
			$patient = $_REQUEST['patient'];
		}

		if($_REQUEST['job'] == "undefined"){
			$job = 2;
		}else{
			$job = $_REQUEST['job'];
		}

		if($_REQUEST['cms'] == "undefined"){
			$cms = 2;
		}else{
			$cms = $_REQUEST['cms'];
		}

		if($_REQUEST['intervent'] == "undefined"){
			$intervent = 2;
		}else{
			$intervent = $_REQUEST['intervent'];
		}

		if($_REQUEST['report'] == "undefined"){
			$report = 2;
		}else{
			$report = $_REQUEST['report'];
		}

		if($_REQUEST['contract'] == "undefined"){
			$contract = 2;
		}else{
			$contract = $_REQUEST['contract'];
		}

		$data=array(
		'operator'=>$operator,
		'patient'=>$patient,
		'job'=>$job,
		'cms'=>$cms,
		'intervent'=>$intervent,
		'report'=>$report,
		'contract'=>$contract,
		);
		$this->db->where('tid',$tid);
		$this->db->update("admin_types",$data);

	}

public function check_user_exist($usr){
	$aid = $this->input->post('aid');
	$this->db->where("username",$usr);
	if($aid != ""){
	$this->db->where('aid !=', $aid);
	}
		$query=$this->db->get("admins");
		if($query->num_rows()>0)
		{
			 return true;
		}else
			{
		 return false;

}
}

	public function putuserdata()
	{
		$data=array(
		'name'=>$this->input->post('name'),
		'email'=>$this->input->post('email'),
		'username'=>$this->input->post('username'),
		'password'=>MD5($this->input->post('pass')),
		'type'=>$this->input->post('type'),
		);
		$this->db->insert('admins',$data);
	}

	public function update_userdata($aid)
	{
		$pass =$this->input->post('pass');
		if($pass != ""){
			$data=array(
		'name'=>$this->input->post('name'),
		'email'=>$this->input->post('email'),
		'username'=>$this->input->post('username'),
		'password'=>MD5($this->input->post('pass')),
		'type'=>$this->input->post('type'),
		);
		}else{
			$data=array(
		'name'=>$this->input->post('name'),
		'email'=>$this->input->post('email'),
		'username'=>$this->input->post('username'),
		'type'=>$this->input->post('type'),
		);
		}

		$this->db->where('aid',$aid);
		$this->db->update("admins",$data);
	}

	function getuserdata($aid){
		$this->db->where('aid', $aid);
		return $this->db->get('admins');
 	}

	public function deleteuser($aid)
{
	$this->db->where('aid',$aid);
	$this->db->delete('admins');
}

/* Types */
public function putadmintypedata()
	{
		$data=array(
		'type_name'=>$this->input->post('type_name'),
		);
		$this->db->insert('admin_types',$data);
	}
public function update_admintypedata($tid)
	{
		$data=array(
			'type_name'=>$this->input->post('type_name')
		);

		$this->db->where('tid',$tid);
		$this->db->update("admin_types",$data);
	}
function getadmintypedata($tid){
		$this->db->where('tid', $tid);
		return $this->db->get('admin_types');
 	}

public function deletetype($tid)
{
	$this->db->where('tid',$tid);
	$this->db->delete('admin_types');
}
/* Types */


function getstarting_point($id){
		$this->db->where('id', $id);
		return $this->db->get('operator_default_starting_point');
 	}
public function update_starting_point($starting_point_address, $id, $update)
	{
		$st_pint = mysql_escape_string($starting_point_address);
		if($update == '1'){
			mysql_query("update `operators` set `starting_point_address` = '$st_pint' WHERE `starting_point_address` LIKE 'Via A. Gramsci 54 / s 42124 Reggio Emilia'");
		}
            /* Log Insert */
            $sel_value_job = "select * from operator_default_starting_point WHERE id = $id";
            $q_job = mysql_query($sel_value_job);
            $val_job = mysql_fetch_assoc($q_job);
            $json_values_job = json_encode($val_job);
            $dt = new DateTime();
            $date_created = $dt->format('YmdHis');
            $insert_job = "INSERT INTO `dblogs` (`idutente`, `dataora`, `operazione`,`tabella`, `idtabella`, `data`,`rollbackfrom`, `canrollback`, `idpadre`) VALUES ('50000', '$date_created', 'U','operator_default_starting_point', '$id','$json_values_job','', 'N', '0')";
            mysql_query($insert_job);
		mysql_query("UPDATE operator_default_starting_point SET starting_point_address = '$st_pint' WHERE id = $id");

	}
}
?>
