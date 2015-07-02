<?php
/**
 * Created by PhpStorm.
 * User: logesh
 * Date: 16/6/15
 * Time: 4:12 PM
 */

class Service_model extends CI_Model
{
    public function Auth($username,$password){

        $dataAuth = $this->db->get_where('patients_login',array('username'=>$username,'password'=>$password));
        if($dataAuth->num_rows() == 1){
            $data = $dataAuth->row_array();
            $response = array('LoginStatus'=>'success','UserID'=>$data['pid'],'UserTypeID'=>$data['UserTypeID'],'DateTIme'=>time(),'TokenID'=>$this->generateRandomString(),'LoginMessage'=>'Login Successfully','ImagePath'=>base_url().'/patient/uploads/667/patient.gif');
            echo json_encode($response);
        }

    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function personal($pid){
        $data = $this->db->get_where('patients_personal_data',array('pid'=>$pid));
        $result = $data->row_array();
        echo json_encode($result);
    }

    public function critical($pid){
        $alergy = $this->db->query('select AllergiesName from Allergies');
        $aresult = $alergy->result_array();
        $data = $this->db->query("SELECT CONCAT(pname,' ',surname) AS Name,DOB,contact_no AS ContactNumber,CONCAT(address,',',zip_code) AS ContactAddress,b.* FROM `patients` a INNER JOIN patients_critical_data b ON (a.pid = b.pid) where a.pid = ".$pid);
        $result = $data->row_array();
        $i =0;
        $output = array();
        foreach($aresult as $res){
            $output[]['AllergiesName'] = $res['AllergiesName'];
            $i++;
        }
        $result['Allergies'] = $output;
        echo json_encode($result);

    }


}