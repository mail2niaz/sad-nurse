<?php
Class Contract_model extends CI_Model
{
	 private $tbl_contract_details = 'contract_details';
	 private $tbl_contract_intervent_weekdays = 'contract_intervent_weekdays';


	 public function add_cont_details($fdata)
	{
		$time = time();
		$patient_id = $this->input->post('patient_id');
		$fdate = strtotime($this->input->post('fdate'));
		//$tdate = strtotime($this->input->post('tdate'));
		$tdate = "2080080000";
		$note = $this->input->post('note');
		$last_intervent_days = $this->input->post('last_intervent_days');
		$data=array(
			'pid'=>$patient_id,
			'start_date'=>$fdate,
			'end_date'=>$tdate,
			'note'=>$note,
			'created_date'=>$time,
			'last_modify'=>$time,
		);

		$this->db->insert($this->tbl_contract_details,$data);
		$cid = mysql_insert_id();

		$files = count($fdata);
		for($i = 0; $i < $files; $i++){
			mysql_query("insert into contract_image(`cid`,`file`) values('$cid','$fdata[$i]')");
		}

		for($i = 1; $i < $last_intervent_days; $i++){
			if($this->input->post('week_days'.$i.'') != ""){
				$week_days = implode(",", $this->input->post('week_days'.$i.''));
				$total_weekdays = count($this->input->post('week_days'.$i.''));
			}else{
				$week_days = "";
				$total_weekdays = "";
			}
			if($this->input->post('intervent_fortnightly'.$i.'') != ""){
				$intervent_fortnightly = $this->input->post('intervent_fortnightly'.$i.'');
			}else{
				$intervent_fortnightly = "";
			}
			if($this->input->post('contract_tags'.$i.'') != ""){
				$contract_tags = implode(",", $this->input->post('contract_tags'.$i.''));
			}else{
				$contract_tags = "";
			}
			$suspend_val1 = $this->input->post('suspend'.$i.'');
			if($suspend_val1 == 'on'){
					$suspend1 = 1;
				}else{
					$suspend1 = 0;
				}
			$intervent_type = $this->input->post('intervent_type'.$i.'');
			$hour = $this->input->post('hourcombo'.$i.'');
			$min = $this->input->post('mincombo'.$i.'');
			$pataddress = $this->input->post('pataddress'.$i.'');
			$patcity = $this->input->post('patcity'.$i.'');
			$patzip = $this->input->post('patzip'.$i.'');
			$patlatlng = $this->input->post('patlatlng'.$i.'');
			$intervent_hour = $hour.":".$min; //$this->input->post('int_time'.$i.'');
			$data1=array(
			'cid'=>$cid,
			'pid'=>$patient_id,
			'intervent_id'=>$intervent_type,
			'intervent_hour'=>$intervent_hour,
			'week_days'=>$week_days,
			'last_modify'=>$time,
			'suspendable'=>$suspend1,
			'contract_tags'=>$contract_tags,
			'intervent_fortnightly'=>$intervent_fortnightly,
			'total_weekdays'=>$total_weekdays,
			'patient_address'=>$pataddress,
			'patient_city'=>$patcity,
			'patient_zip'=>$patzip,
			'patient_latlng'=>$patlatlng,
		);
			$this->db->insert($this->tbl_contract_intervent_weekdays,$data1);

		}
		return mysql_insert_id();
	}


	 public function edit_cont_details($cid,$fdata)
	{

		$time = time();
		$fdate = strtotime($this->input->post('fdate'));
		//$tdate = strtotime($this->input->post('tdate'));
		$tdate = "2080080000";
		$note = $this->input->post('note');

		$patient_id = $this->input->post('patient_id');
		$data=array(
			'start_date'=>$fdate,
			'end_date'=>$tdate,
			'note'=>$note,
			'last_modify'=>$time,
		);

		$this->db->where('cid',$cid);
		$this->db->update($this->tbl_contract_details,$data);

		$files = count($fdata);
		for($i = 0; $i < $files; $i++){
			$this->db->query("insert into contract_image(`cid`,`file`) values('$cid','$fdata[$i]')");
                  /*Log table */
                  $last_insert_id = $this->db->insert_id();
                  $sel_value_status = "select * from contract_image WHERE contract_img_id = '$last_insert_id'";
                  $q_status = $this->db->query($sel_value_status);
                  $val_status = $q_status->row_array();
                  $json_values_status = json_encode($val_status);
                  $dt = new DateTime();
                  $date_created = $dt->format('YmdHis');
                  $insert_status = "INSERT INTO `dblogs` (`idutente`, `dataora`, `operazione`,`tabella`, `idtabella`, `data`,`rollbackfrom`, `canrollback`, `idpadre`) VALUES ('50000', '$date_created', 'I','contract_image', '$last_insert_id','$json_values_status','', 'N', '0')";
                  $this->db->query($insert_status);
		}

		$last_intervent_days = $this->input->post('last_intervent_days');
		$cnt_intervent_days = $this->input->post('cnt_intervent_days') + 1;
		$fetch_intervent_days = $this->input->post('fetch_intervent_days');

		/* Update Intervent weekdays  */
		for($i = 11; $i <= $fetch_intervent_days; $i++){
			$update_intervent_weekdays = $this->input->post('update_intervent_weekdays'.$i.'');
			if($this->input->post('week_days'.$i.'') != ""){
				$week_days = implode(",", $this->input->post('week_days'.$i.''));
				$total_weekdays = count($this->input->post('week_days'.$i.''));
			}else{
				$week_days = "";
				$total_weekdays = "";
			}
			if($this->input->post('intervent_fortnightly'.$i.'') != ""){
				$intervent_fortnightly = $this->input->post('intervent_fortnightly'.$i.'');
				$week_days = "";
			}else{
				$intervent_fortnightly = "";
			}
			if($this->input->post('contract_tags'.$i.'') != ""){
				$contract_tags = implode(",", $this->input->post('contract_tags'.$i.''));
			}else{
				$contract_tags = "";
			}

			$suspend_val1 = $this->input->post('suspend'.$i.'');
			if($suspend_val1 == 'on'){
					$suspend1 = 1;
				}else{
					$suspend1 = 0;
				}
			$intervent_type = $this->input->post('intervent_type'.$i.'');
		//	$intervent_hour = $this->input->post('int_time'.$i.'');
			$hour = $this->input->post('hourcombo'.$i.'');
			$min = $this->input->post('mincombo'.$i.'');
			$pataddress = $this->input->post('pataddress'.$i.'');
			$patcity = $this->input->post('patcity'.$i.'');
			$patzip = $this->input->post('patzip'.$i.'');
			$patlatlng = $this->input->post('patlatlng'.$i.'');
			$intervent_hour = $hour.":".$min; //$this->input->post('int_time'.$i.'');
			$data1=array(
			'cid'=>$cid,
			'intervent_id'=>$intervent_type,
			'intervent_hour'=>$intervent_hour,
			'week_days'=>$week_days,
			'last_modify'=>$time,
			'suspendable'=>$suspend1,
			'contract_tags'=>$contract_tags,
			'intervent_fortnightly'=>$intervent_fortnightly,
			'total_weekdays'=>$total_weekdays,
			'patient_address'=>$pataddress,
			'patient_city'=>$patcity,
			'patient_zip'=>$patzip,
			'patient_latlng'=>$patlatlng,
		);
			$this->db->where('ciw_id',$update_intervent_weekdays);
			$this->db->update($this->tbl_contract_intervent_weekdays,$data1);
		}

		/* New Intervent weekdays  */
			if($last_intervent_days > $cnt_intervent_days){
				for($j = $cnt_intervent_days; $j < $last_intervent_days; $j++){
				if($this->input->post('week_days'.$j.'') != ""){
					$week_days1 = implode(",", $this->input->post('week_days'.$j.''));
					$total_weekdays1 = count($this->input->post('week_days'.$j.''));
				}else{
					$week_days1 = "";
					$total_weekdays1 = "";
				}
				if($this->input->post('intervent_fortnightly'.$j.'') != ""){
					$intervent_fortnightly1 = $this->input->post('intervent_fortnightly'.$j.'');
					$week_days1 = "";
				}else{
					$intervent_fortnightly1 = "";
				}
				if($this->input->post('contract_tags'.$j.'') != ""){
					$contract_tags1 = implode(",", $this->input->post('contract_tags'.$j.''));
				}else{
					$contract_tags1 = "";
				}
				$suspend_val12 = $this->input->post('suspend'.$j.'');
				if($suspend_val12 == 'on'){
					$suspend12 = 1;
				}else{
					$suspend12 = 0;
				}
				$intervent_type1 = $this->input->post('intervent_type'.$j.'');
				//$intervent_hour1 = $this->input->post('int_time'.$j.'');
				$hour1 = $this->input->post('hourcombo'.$j.'');
				$min1 = $this->input->post('mincombo'.$j.'');
				$pataddress1 = $this->input->post('pataddress'.$j.'');
				$patcity1 = $this->input->post('patcity'.$j.'');
				$patzip1 = $this->input->post('patzip'.$j.'');
				$patlatlng1 = $this->input->post('patlatlng'.$j.'');
				$intervent_hour1 = $hour1.":".$min1; //$this->input->post('int_time'.$i.'');
				$data2=array(
				'cid'=>$cid,
				'pid'=>$patient_id,
				'intervent_id'=>$intervent_type1,
				'intervent_hour'=>$intervent_hour1,
				'week_days'=>$week_days1,
				'contract_tags'=>$contract_tags1,
				'intervent_fortnightly'=>$intervent_fortnightly1,
				'suspendable'=>$suspend12,
				'last_modify'=>$time,
				'total_weekdays'=>$total_weekdays1,
				'patient_address'=>$pataddress1,
				'patient_city'=>$patcity1,
				'patient_zip'=>$patzip1,
				'patient_latlng'=>$patlatlng1,
			);
				$this->db->insert($this->tbl_contract_intervent_weekdays,$data2);
			}
		}
		/* Ceased Details */


		if($this->input->post('ceased_date') != ""){
		$ceased_date = strtotime($this->input->post('ceased_date'));
		$ceased_reopen = '2';
		$ceased_reason = $this->input->post('ceased_reason');
		$data3=array(
				'cid'=>$cid,
				'ceased_date'=>$ceased_date,
				'ceased_reason'=>$ceased_reason,
				'ceased_reopen'=>$ceased_reopen,
				'last_modify'=>$time,
			);
		$this->db->insert('contract_ceased_details',$data3);
            $aid_insert_id = $this->db->insert_id();
            /* Log Insert */
            $sel_value_job = "select * from contract_ceased_details WHERE cid = '$cid'";
            $q_job = $this->db->query($sel_value_job);
            $val_job = $q_job->row_array();;
            $json_values_job = json_encode($val_job);
            $dt = new DateTime();
            $date_created = $dt->format('YmdHis');
            $insert_job = "INSERT INTO `dblogs` (`idutente`, `dataora`, `operazione`,`tabella`, `idtabella`, `data`,`rollbackfrom`, `canrollback`, `idpadre`) VALUES ('50000', '$date_created', 'U','contract_ceased_details', '$cid','$json_values_job','', 'N', '0')";
            $this->db->query($insert_job);
		$this->db->query("UPDATE contract_details SET last_ceased_date = '$ceased_date' WHERE cid = '$cid'");
		} else{
			$ceased_date = $this->input->post('last_ceased_date');
			$ceased_reopen = '1';
			$data3=array(
				'cid'=>$cid,
				'ceased_reopen'=>$ceased_reopen,
				'last_modify'=>$time,
			);
			$this->db->insert('contract_ceased_details',$data3);
                  /*Log Table */
                  
                  $sel_value_status = "select * from contract_details WHERE  cid = '$cid'";
                  $q_status = $this->db->query($sel_value_status);
                  $val_status = $q_status->row_array();
                  $json_values_status = json_encode($val_status);
                  $dt = new DateTime();
                  $date_created = $dt->format('YmdHis');
                  $insert_status = "INSERT INTO `dblogs` (`idutente`, `dataora`, `operazione`,`tabella`, `idtabella`, `data`,`rollbackfrom`, `canrollback`, `idpadre`) VALUES ('50000', '$date_created', 'U','contract_details', '$cid','$json_values_status','', 'N', '0')";
                  $this->db->query($insert_status);
			$this->db->query("UPDATE contract_details SET last_ceased_date = '' WHERE cid = '$cid'");
		}
		return mysql_insert_id();
	}

	 function getcont_detail($cid){
		$this->db->where('cid', $cid);
		return $this->db->get($this->tbl_contract_details);
 	}

	 public function deletecont_detail($cid)
	{
		$this->db->where("cid",$cid);
		$query=$this->db->get("assign_job_list");
		if($query->num_rows()>0)
		{
			 return 1;
		}else
			{
				$this->db->where('cid',$cid);
				$this->db->delete($this->tbl_contract_details);

				$this->db->where('cid',$cid);
				$this->db->delete($this->tbl_contract_intervent_weekdays);

				$this->db->where('cid',$cid);
				$this->db->delete('contract_ceased_details');
			}

	}
public function deleteimgage_model($img)
{
	$this -> db -> select('file');
	$this -> db -> from('contract_image');
	$this -> db -> where('contract_img_id = ' . "'" . $img . "'");
	$query = $this -> db -> get();
	$val = $query->result();
	//echo $val[0]->file;
	$dirname = $this->config->item('upload_folder');
	$file = "uploads/contract_image/".$dirname."/".$val[0]->file;
	unlink($file);

	$this->db->where('contract_img_id',$img);
	$this->db->delete("contract_image");
}
	public function check_pat_int_exist($patient_id, $intervent_type){
		$this->db->where("pid",$patient_id);
		$this->db->where("intervent_id",$intervent_type);
		$query=$this->db->get($this->tbl_contract_details);
		if($query->num_rows()>0)
		{
			 return true;
		}else
			{
		 return false;

}
}


public function getinthour()
{
	$int_id = $this->input->post('intval');
	$query = $this->db->query("SELECT int_time FROM intervention_types WHERE int_type_id = '$int_id'");
	return $query;
}
public function getpatinterventaddress()
{
	$int_id = $this->input->post('intval');
	$patient_id = $this->input->post('patient_id');
	$query1 = $this->db->query("SELECT patient_address FROM contract_intervent_weekdays WHERE intervent_id = '$int_id' AND pid = '$patient_id'");
	if($query1->num_rows() > 0){
		$val = $query->result();
		$address = $val[0]->patient_address;
	}else{
		$query = $this->db->query("SELECT address,zip_code,latlang,city FROM patients WHERE pid = '$patient_id'");
		$num = $query->num_rows();
		if($num > 0){
			$val = $query->result();
			//$address = $val[0]->address;
		}else{
			$val = "";
		}
	}
	return $val;
}
public function getdubpatintervent($intval,$patient_id)
{
	$query = $this->db->query("SELECT * FROM contract_intervent_weekdays WHERE pid = '$patient_id' AND intervent_id = '$intval'");
	return $query;
}

public function getcontractlist($pid='')
{
	if($pid != ''){
		$query = $this->db->query("SELECT * FROM contract_details where pid = '$pid'");
	}else{
		$query = $this->db->query("SELECT * FROM contract_details order by cid DESC");
	}
	return $query;
}

public function GetContractCeasedDetails($cid,$cur_end_date='',$level)
{
	if($level == '1'){
		$query = $this->db->query("SELECT ceased_id FROM contract_ceased_details WHERE cid='$cid' AND ceased_date='$cur_end_date' AND ceased_reopen='2'");
	}elseif($level == '2'){
		$query = $this->db->query("SELECT * FROM contract_ceased_details where cid = '$cid' order by ceased_id DESC LIMIT 1");
	}
	return $query;

}
public function ListPageCeasedInsert($cid,$cur_end_date,$type,$status,$time)
{
	$query = $this->db->query("INSERT INTO contract_ceased_details (cid, ceased_date, ceased_reason, ceased_reopen, last_modify) VALUES('$cid','$cur_end_date', '$type', '$status', '$time' )");
	
	/*Log Table */
	$last_insert_id = $this->db->insert_id();
	$sel_value_status = "select * from contract_ceased_details WHERE  ceased_id = '$last_insert_id'";
      $q_status = $this->db->query($sel_value_status);
      $val_status = $q_status->row_array();
      $json_values_status = json_encode($val_status);
      $dt = new DateTime();
      $date_created = $dt->format('YmdHis');
      $insert_status = "INSERT INTO `dblogs` (`idutente`, `dataora`, `operazione`,`tabella`, `idtabella`, `data`,`rollbackfrom`, `canrollback`, `idpadre`) VALUES ('50000', '$date_created', 'I','contract_details', '$last_insert_id','$json_values_status','', 'N', '0')";
      $this->db->query($insert_status);
}
public function ContractInterventWeekdays($cid)
{
	$query = $this->db->query("SELECT * FROM contract_intervent_weekdays where cid = '$cid'");
	return $query;
}
public function ContractImages($cid)
{
	$query = $this->db->query("SELECT * FROM contract_image WHERE cid = '$cid'");
	return $query;
}

public function CheckSuspendable($cid,$pid,$intervent_id)
{
	$query = $this->db->query("select suspendable from contract_intervent_weekdays where cid = '$cid' AND	pid = '$pid' AND intervent_id = '$intervent_id'");
	return $query;
}

public function ContractInterventWeekdaysShdDetails($cid,$pid,$intervent_id)
{
	$query = $this->db->query("select shd_days from contract_intervent_weekdays_shd_details where cid = '$cid' AND	pid = '$pid' AND intervent_id = '$intervent_id' AND is_schedule = '1' AND `reassign` = '0'");
	return $query->result_array();
}

public function delete_cont_inter($pid, $cid, $intid){
		$this->db->where("cid",$cid);
		$this->db->where("intervent_type_id",$intid);
		$this->db->where("patient_id",$pid);
		$query=$this->db->get("assign_job_list");
		if($query->num_rows()>0)
		{
			 echo lang("CONTRACT::error_message_for_intervent_delete");
		}else
			{
			$this->db->where('cid',$cid);
			$this->db->where('intervent_id',$intid);
			$this->db->delete($this->tbl_contract_intervent_weekdays);
			echo "success";

		}
}
}
?>

