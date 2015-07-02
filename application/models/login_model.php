<?php
Class Login_model extends CI_Model
{
	function login($username, $password)
	{
		$pass = MD5($password);
		$query = $this->db->query("select a.aid, a.username, a.type, b.* from admins as a, admin_types as b where a.username = '$username' AND a.password = '$pass' AND b.tid = a.type");

		/*$this -> db -> select('a.aid, a.username, a.type');
		$this -> db -> from('admins');
		$this -> db -> where('username = ' . "'" . $username . "'");
		$this -> db -> where('password = ' . "'" . MD5($password) . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();*/
		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}

	}

		function moblogin($username, $password, $udid)
		{
			/* check udid */
	   /* $this -> db -> select('mobile_udid');
		$this -> db -> from('operators');
		$this -> db -> where('mobile_udid = ' . "'" . $udid . "'");
		$this -> db -> limit(1);
		$query_udid = $this -> db -> get();
		if($query_udid -> num_rows() == 1)
		{ */
			$this -> db -> select('username');
			$this -> db -> from('operators');
			$this -> db -> where('username = ' . "'" . $username . "'");
			$this -> db -> limit(1);
			$query_uname = $this -> db -> get();
			if($query_uname -> num_rows() == 1)
			{
			$this -> db -> select('password');
			$this -> db -> from('operators');
			$this -> db -> where('password = ' . "'" . MD5($password) . "'");
			$this -> db -> limit(1);
			$query_pass = $this -> db -> get();
				if($query_pass -> num_rows() == 1)
				{
				$this -> db -> select('*');
				$this -> db -> from('operators');
				//$this -> db -> where('mobile_udid = ' . "'" . $udid . "'");
				$this -> db -> where('username = ' . "'" . $username . "'");
				$this -> db -> where('password = ' . "'" . MD5($password) . "'");
				$this -> db -> limit(1);
				$query = $this -> db -> get();
				if($query -> num_rows() == 1)
				{
					return $query->result();
				}else{
					$msg = "error";
				}
				}else{
					$msg = "pm";
				}
			}else{
				$msg = "um";
			}
		/*}else{
			$msg = "mm";
		} */
			return $msg;

	}

public function mobforget($name = ''){


		$query_udid = $this -> db -> get_where("operators",array("username" => $name));

		return $query_udid -> num_rows();
}

	public function mobforgetsave($random,$uname)
	{
		$time = time();
			$data=array(
				'password'=>md5($random),
			);

		$this->db->where('username',$uname);
		$this->db->update('operators',$data);

	}

}
?>