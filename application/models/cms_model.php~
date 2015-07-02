<?php
Class Cms_model extends CI_Model
{
	 private $tbl_role= 'mt_role';

	 private $tbl_patients_info= 'patients_info_details';

	 private $tbl_app_holidays= 'app_holidays';

	 private $tbl_district= 'district';
	 private $tbl_tag = 'tags';

	 public function add_role()
	{
		$time = time();
		$data=array(
		'type'=>$this->input->post('rname'),
		'created_date'=>$time,
		'status'=>'1',
		);
		$this->db->insert($this->tbl_role,$data);
	}

	public function update_role($rid)
	{
		$time = time();
		$data=array(
		'type'=>$this->input->post('rname'),
		'edited_date'=>$time,
		);
		$this->db->where('rid',$rid);
		$this->db->update($this->tbl_role,$data);

	}

function getrole($rid=''){
	 	if($rid!=''){
			$this->db->where('rid', $rid);
			return $this->db->get($this->tbl_role);
	 	}else{
	 		$this -> db -> select('*');
			$this -> db -> from($this->tbl_role);
			return $query = $this -> db -> get();
	 	}

 }

public function deleterole($rid)
{
	$this->db->where('rid',$rid);
	$this->db->delete($this->tbl_role);
}

public function check_role_exist($opt){
	$this->db->where("type",$opt);
		$query=$this->db->get($this->tbl_role);
		if($query->num_rows()>0)
		{
			 return true;
		}else
			{
		 return false;

}
}

/* Holidays */
	 public function put_holiday()
	{
		$date = strtotime($this->input->post('hdate'));
		$data=array(
		'hdate'=>$date,
		'reason'=>$this->input->post('reason')
		);
		$this->db->insert($this->tbl_app_holidays,$data);
	}

 	public function update_holiday()
	{
		$date = strtotime($this->input->post('hdate'));
		$hid = $this->input->post('hid');
		$data=array(
		'hdate'=>$date,
		'reason'=>$this->input->post('reason')
		);
		$this->db->where('hid',$hid);
		$this->db->update($this->tbl_app_holidays,$data);
	}
	public function deleteholiday($hid)
	{
		$this->db->where('hid',$hid);
		$this->db->delete($this->tbl_app_holidays);
	}

	 function getholiday_detail($hid=''){
	 	if($hid != ''){
		 	$this->db->where('hid', $hid);
			return $this->db->get($this->tbl_app_holidays);
	 	}else{
			$this -> db -> select('*');
			$this -> db -> from($this->tbl_app_holidays);
			return $query = $this -> db -> get();
	 	}

 }

	/* District Module */
public function put_district()
	{
		$time = time();
		$data=array(
		'dist_name'=>$this->input->post('dist_name'),
		'p2000_code'=>$this->input->post('p2000_code'),
		'created_date'=>$time
		);
		$this->db->insert($this->tbl_district,$data);
	}

 	public function update_district()
	{
		$did = $this->input->post('did');
		$data=array(
		'dist_name'=>$this->input->post('dist_name'),
		'p2000_code'=>$this->input->post('p2000_code'),
		);
		$this->db->where('did',$did);
		$this->db->update($this->tbl_district,$data);
	}

function getdistrict_detail($did=''){
	if($did!=''){
		$this->db->where('did', $did);
		return $this->db->get($this->tbl_district);
	}else{
		$this -> db -> select('*');
		$this -> db -> from($this->tbl_district);
		return $query = $this -> db -> get();
	}
 }
public function deletedistrict($did)
	{
		$this->db->where('did',$did);
		$this->db->delete($this->tbl_district);
	}


/* End District Module */

/* Tags */

	 public function add_tag_detail()
	{
		$time = date("Y-m-d", time());
		$data=array(
		'tag_description'=>$this->input->post('tag_description'),
		'created_date'=>$time,
		);
		$this->db->insert($this->tbl_tag,$data);
	}

	public function update_tag_detail($tid)
	{
		$data=array(
		'tag_description'=>$this->input->post('tag_description'),
		);
		$this->db->where('tid',$tid);
		$this->db->update($this->tbl_tag,$data);

	}

	 function get_tag_detail($tid){
	 	if($tid!=''){
			$this->db->where('tid', $tid);
			return $this->db->get($this->tbl_tag);
	 	}else{
			$this -> db -> select('*');
			$this -> db -> from($this->tbl_tag);
			return $query = $this -> db -> get();
	 	}

 }

public function get_tag_opt_list($tid){
		$this -> db -> select('*');
		$this -> db -> from('operators');
		$this -> db -> where("tags regexp '(^|,)($tid)(,|$)'");
		$query = $this -> db -> get();
		return $query;
}

public function deletetag($tid)
{
	$this->db->where('tid',$tid);
	$this->db->delete($this->tbl_tag);
}

public function deleteopttag($tid,$oid)
{
	mysql_query("update `operators` set tags = TRIM(BOTH ',' FROM REPLACE(REPLACE(tags, '$tid', ''), ',,', ',')) where `oid` = '$oid'");
}

public function check_tag_name_exist($name){

	$this->db->where("tag_description",$name);
	if(isset($_REQUEST['tid'])){
		$this->db->where("tid !=",$this->input->post('tid'));
	}
	$query=$this->db->get($this->tbl_tag);
	if($query->num_rows()>0)
		{
		 return true;
	}else
		{
		return false;
    	}
}
}
?>
