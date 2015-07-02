<?php
Class Login_model extends CI_Model
{
	function login($username, $password)
	{
		$pass = MD5($password);
		$query = $this->db->query("select a.aid, a.username, a.type, b.* from admins as a, admin_types as b where a.username = '$username' AND a.password = '$pass' AND b.tid = a.type");
		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}

	}
}
?>