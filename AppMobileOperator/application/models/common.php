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
public function getpatientname($pid)
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
			$pname = $surname." ".$name;
		}
		else
		{
			$pname = lang('COMMON::no_patient');
		}

	return $pname;
}

public function getoperatorlist_new(){
	$this -> db -> select('oid,firstname,lastname,role');
	$this->db->where('status', '1');
	$this->db->order_by('lastname', 'ASC');
	$query = $this->db->get('operators');
	$val = $query->result();
	return $val;
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

}
?>
