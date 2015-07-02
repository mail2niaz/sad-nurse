<?php
Class Assignoperatorpatient_model extends CI_Model
{
	 private $tbl_apns= 'assign_pdns';

	 public function add_passigno()
	{
		$time = time();
		$cnt = count(array_filter($this->input->post('operator')));

		$val = array_filter($this->input->post('operator'));
		$patient_id = $this->input->post('patient');
		for($i=0;$i<$cnt;$i++) {
			$ins = mysql_query("INSERT INTO assign_pdns(`request_id`, `patient_id`, `operator`, `assign_dtime`) VALUES('$time','$patient_id',$val[$i],'$time')");
    	}

		return mysql_insert_id();
}

	public function update_patient($pid)
	{
		$time = time();

		$data=array(
		'pname'=>$this->input->post('pname'),
		'surname'=>$this->input->post('surname'),
		'email'=>$this->input->post('email'),
		'dob'=>date("Y-m-d",strtotime($this->input->post('dob'))),
		'contact_no'=>$this->input->post('contact_no'),
		'ssn'=>$this->input->post('ssn'),
		'address'=>$this->input->post('address'),
		'zip_code'=>$this->input->post('zip_code'),
		'latlang'=>$this->input->post('latlang'),
		'note'=>$this->input->post('note'),
		'edited_date'=>$time,
		);

		$this->db->where('pid',$pid);
		$this->db->update($this->tbl_patients,$data);

	}

	 function getpatient($pid){
		$this->db->where('pid', $pid);
		return $this->db->get($this->tbl_patients);
 }

public function deletepatient($pid)
{
	$this->db->where('pid',$pid);
	$this->db->delete($this->tbl_patients);
}

}
?>