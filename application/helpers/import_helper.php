<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function import_operator($fdata,$type,$filename)
{
	$ci=& get_instance();
   $session_data=$ci->session->userdata('logged_in');
			$handle = fopen($filename,"r");
			$i = 1;
			$log = '';
			while ($data = fgetcsv($handle,1000,",",'"')){

				if ($i != '1') {
					echo $ci->common->getoptroleID($data[6]);
					if($data[6] != '' && $ci->common->getoptroleID($data[6]) != ''){
						$data6 = $ci->common->getoptroleID($data[6]);
					}else{
						$log .='Role Not Matched in row no'.$i.'\n';
						$data6 = '';
					}
				if($data[7] != '' && $ci->common->getdistID($data[7]) != ''){
						$data7 = $ci->common->getdistID($data[7]);
					}else{
						$log .='District Not Matched in row no'.$i.'\n';
						$data7 = '';
					}
			if($log == ''){
						$qry = mysql_query("INSERT INTO `operators` (`firstname`, `lastname`, `email`, `username`, `password`, `dob`, `role`, `dist_id`, `qualification`, `hours_contract`, `contact_no`, `landline_no`, `street`, `hb_no`, `city`, `postalcode`, `provincecode`, `mobile_udid`, `note`) VALUES
		                (
		                    '".addslashes($data[0])."',
		                    '".addslashes($data[1])."',
		                    '".addslashes($data[2])."',
		                    '".addslashes($data[3])."',
		                    '".md5($data[4])."',
		                    '".addslashes($data[5])."',
		                    '".addslashes($data6)."',
		                    '".addslashes($data7)."',
		                    '".addslashes($data[8])."',
		                    '".addslashes($data[9])."',
		                    '".addslashes($data[10])."',
		                    '".addslashes($data[11])."',
		                    '".addslashes($data[12])."',
		                    '".addslashes($data[13])."',
		                    '".addslashes($data[14])."',
		                    '".addslashes($data[15])."',
		                    '".addslashes($data[16])."',
		                    '".addslashes($data[17])."',
		                    '".addslashes($data[18])."'
		                    ) ");
				}
			}

				$i++;
			}
			if($log == ''){
            		return "Success";
	        } else {
	              $errorlog = 'operator_Error'.time().'.txt';
	            $error =  fopen('uploads/errorlog/'.$errorlog,"w");
	            fwrite($error,$log);
	            fclose($error);
	            $log = '';
	            return $errorlog;
	        }
}

function import_patient($fdata,$type,$filename)
{
	$ci=& get_instance();
   $session_data=$ci->session->userdata('logged_in');
   $tid = $session_data['type'];
	$aid = $session_data['aid'];
	$time = time();
			$handle = fopen($filename,"r");
			$i = 1;
			$log = '';
			mysql_query("UPDATE patients SET pstatus = '2' where pstatus = '1'");
			while ($data = fgetcsv($handle,1000,";",'"')){
				if ($i != '1') {
					if($data[6] != ''){
					if($data[0] != ''){
						$dist_id = $ci->common->createdistID($data[0]);
					}else{
						$log .='District name missing in row no'.$i.'\n';
						$dist_id = '';
					}
					if($data[4] != ''){
						if($data[4] == "M"){
							$sex = "male";
						}elseif($data[4] == "F"){
							$sex = "female";
						}else{
							$sex = "";
						}
					}else{
						$sex = "";
					}
					if($data[8] != ''){
						$address = urlencode($data[8].",".$data[9]);
						$address_val = $ci->common->get_latlng_address($address);
					}else{
						$address_val = '';
					}
			if($log == ''){
						$qry = mysql_query("INSERT INTO `patients` (`p2000_id`, `dist_id`, `surname`, `pname`, `sex`, `dob`, `ssn`, `contact_no`, `address`, `zip_code`, `city`, `pa_surname`, `paying`, `pa_address`, `pa_cap`, `created_by_type`, `created_by`, `created_date`, `pstatus`, `latlang`) VALUES
		                (
		                	'".addslashes($data[1])."',
		                    '".$dist_id."',
		                    '".addslashes($data[2])."',
		                    '".addslashes($data[3])."',
		                    '".$sex."',
		                    '".date("Y-m-d", strtotime(str_replace("/", "-", $data[5])))."',
		                    '".addslashes($data[6])."',
		                    '".addslashes($data[7])."',
		                    '".addslashes($data[8])."',
		                    '".addslashes($data[9])."',
		                    '".addslashes($data[10])."',
		                    '".addslashes($data[12])."',
		                    '".addslashes($data[13])."',
		                    '".addslashes($data[14])."',
		                    '".addslashes($data[15])."',
		                    '".$tid."',
		                    '".$aid."',
		                    '".$time."',
		                    '1',
		                    '".$address_val."'
		                    ) ON DUPLICATE KEY UPDATE  `p2000_id` = values(p2000_id), `dist_id` = values(dist_id), `surname` = values(surname), `pname` = values(pname), `sex` = values(sex), `dob` = values(dob), `ssn` = values(ssn), `contact_no` = values(contact_no), `address` = values(address), `zip_code` = values(zip_code), `city` = values(city), `pa_surname` = values(pa_surname), `paying` = values(paying), `pa_address` = values(pa_address), `pa_cap` = values(pa_cap), `created_by_type` = values(created_by_type), `created_by` = values(created_by), `edited_date` = '$time', `pstatus` = '1', `latlang` = values(latlang)");
				}
			}

				$i++;

				}
			}

			$sel_disb_pat = mysql_query("SELECT * FROM patients WHERE pstatus IN ('2','0')");
			if(mysql_num_rows($sel_disb_pat) > 0){
				while($fet_dpat = mysql_fetch_assoc($sel_disb_pat)){
					$dpid = $fet_dpat['pid'];
					mysql_query("UPDATE contract_details SET last_ceased_date = '$time', last_modify = '$time' WHERE pid = '$dpid' AND last_ceased_date = '0'");
					$affted_z = mysql_affected_rows();
					if($affted_z > 0){
					$con_sel = mysql_query("SELECT * FROM `contract_details` where pid = '$dpid'");
					while($fet_con = mysql_fetch_assoc($con_sel)){
						$cont_cid = $fet_con['cid'];
						mysql_query("INSERT INTO contract_ceased_details(`cid`, `ceased_date`, `ceased_reopen`, `last_modify`) VALUES('$cont_cid', '$time', '2', '$time')");
					}
					}
				}
			}

			$sel_disb_pat = mysql_query("SELECT * FROM patients WHERE pstatus = '1'");
			if(mysql_num_rows($sel_disb_pat) > 0){
				while($fet_dpat = mysql_fetch_assoc($sel_disb_pat)){
					$dpid = $fet_dpat['pid'];
					mysql_query("UPDATE contract_details SET last_ceased_date = '', last_modify = '$time' WHERE pid = '$dpid' AND last_ceased_date != '0'");
					$affted_f = mysql_affected_rows();
					if($affted_f > 0){
					$con_sel = mysql_query("SELECT * FROM `contract_details` where pid = '$dpid'");
					while($fet_con = mysql_fetch_assoc($con_sel)){
						$cont_cid = $fet_con['cid'];
						mysql_query("INSERT INTO contract_ceased_details(`cid`, `ceased_date`, `ceased_reopen`, `last_modify`) VALUES('$cont_cid', '', '1','$time')");
					}
					}

				}
			}

			mysql_query("UPDATE patients SET pstatus = '1' where pstatus = '2'");
			if($log == ''){
            		return "Success";
	        } else {
	              $errorlog = 'patient_Error'.time().'.html';
	            $error =  fopen('uploads/errorlog/'.$errorlog,"w");
	            fwrite($error,$log);
	            fclose($error);
	            $log = '';
	            return $errorlog;
	        }
}

function cron_import_patient($file)
{
	$ci=& get_instance();
	$tid = "";
	$aid = "";
			if (($handle = fopen("CSV_Files/".$file, "r")) !== FALSE) {
			$i = 1;
			$log = '';
			mysql_query("UPDATE patients SET pstatus = '2' where pstatus = '1'");
			while ($data = fgetcsv($handle,1000,",",'"')){
				if ($i != '1') {
					if($data[0] != ''){
						$dist_id = $ci->common->createdistID($data[0]);
					}else{
						$log .='District name missing in row no'.$i.'\n';
						$dist_id = '';
					}
					if($data[4] != ''){
						if($data[4] == "M"){
							$sex = "male";
						}elseif($data[4] == "F"){
							$sex = "female";
						}else{
							$sex = "";
						}
					}else{
						$sex = "";
					}
					if($data[7] != ''){
						$address = urlencode($data[7].",".$data[8]);
						$address_val = $ci->common->get_latlng_address($address);
					}else{
						$address_val = '';
					}
			if($log == ''){
/*
				echo "INSERT INTO `patients` (`dist_id`, `surname`, `pname`, `sex`, `dob`, `ssn`, `address`, `zip_code`, `pa_surname`, `paying`, `pa_address`, `pa_cap`, `created_by_type`, `created_by`, `created_date`) VALUES
		                (
		                    '".$dist_id."',
		                    '".addslashes($data[1])."',
		                    '".addslashes($data[2])."',
		                    '".$sex."',
		                    '".date("Y-m-d", strtotime($data[4]))."',
		                    '".addslashes($data[5])."',
		                    '".addslashes($data[6])."',
		                    '".addslashes($data[7])."',
		                    '".addslashes($data[8])."',
		                    '".addslashes($data[9])."',
		                    '".addslashes($data[10])."',
		                    '".addslashes($data[11])."',
		                    '".$tid."',
		                    '".$aid."',
		                    '".time()."'
		                    ) ";
*/

						$qry = mysql_query("INSERT INTO `patients` (`p2000_id`, `dist_id`, `surname`, `pname`, `sex`, `dob`, `ssn`, `address`, `zip_code`, `pa_surname`, `paying`, `pa_address`, `pa_cap`, `created_by_type`, `created_by`, `created_date`, `pstatus`, `latlang`) VALUES
		                (
		                	'".addslashes($data[1])."',
		                    '".$dist_id."',
		                    '".addslashes($data[2])."',
		                    '".addslashes($data[3])."',
		                    '".$sex."',
		                    '".date("Y-m-d", strtotime($data[5]))."',
		                    '".addslashes($data[6])."',
		                    '".addslashes($data[7])."',
		                    '".addslashes($data[8])."',
		                    '".addslashes($data[9])."',
		                    '".addslashes($data[10])."',
		                    '".addslashes($data[11])."',
		                    '".addslashes($data[12])."',
		                    '".$tid."',
		                    '".$aid."',
		                    '".$time."',
		                    '1',
		                    '".$address_val."'
		                    ) ON DUPLICATE KEY UPDATE  `p2000_id` = values(p2000_id), `dist_id` = values(dist_id), `surname` = values(surname), `pname` = values(pname), `sex` = values(sex), `dob` = values(dob), `ssn` = values(ssn), `address` = values(address), `zip_code` = values(zip_code), `pa_surname` = values(pa_surname), `paying` = values(paying), `pa_address` = values(pa_address), `pa_cap` = values(pa_cap), `created_by_type` = values(created_by_type), `created_by` = values(created_by), `edited_date` = '$time', `pstatus` = '1', `latlang` = values(latlang)");
				}
			}

				$i++;
			}

			$sel_disb_pat = mysql_query("SELECT * FROM patients WHERE pstatus IN ('2','0')");
			if(mysql_num_rows($sel_disb_pat) > 0){
				while($fet_dpat = mysql_fetch_assoc($sel_disb_pat)){
					$dpid = $fet_dpat['pid'];
					mysql_query("UPDATE contract_details SET last_ceased_date = '$time', last_modify = '$time' WHERE pid = '$dpid' AND last_ceased_date = '0'");
					$affted_z = mysql_affected_rows();
					if($affted_z > 0){
					$con_sel = mysql_query("SELECT * FROM `contract_details` where pid = '$dpid'");
					while($fet_con = mysql_fetch_assoc($con_sel)){
						$cont_cid = $fet_con['cid'];
						mysql_query("INSERT INTO contract_ceased_details(`cid`, `ceased_date`, `ceased_reopen`, `last_modify`) VALUES('$cont_cid', '$time', '2', '$time')");
					}
					}
				}
			}


			$sel_disb_pat = mysql_query("SELECT * FROM patients WHERE pstatus = '1'");
			if(mysql_num_rows($sel_disb_pat) > 0){
				while($fet_dpat = mysql_fetch_assoc($sel_disb_pat)){
					$dpid = $fet_dpat['pid'];
					mysql_query("UPDATE contract_details SET last_ceased_date = '', last_modify = '$time' WHERE pid = '$dpid' AND last_ceased_date != '0'");
					$affted_f = mysql_affected_rows();
					if($affted_f > 0){
					$con_sel = mysql_query("SELECT * FROM `contract_details` where pid = '$dpid'");
					while($fet_con = mysql_fetch_assoc($con_sel)){
						$cont_cid = $fet_con['cid'];
						mysql_query("INSERT INTO contract_ceased_details(`cid`, `ceased_date`, `ceased_reopen`, `last_modify`) VALUES('$cont_cid', '', '1','$time')");
					}
					}

				}
			}

			mysql_query("UPDATE patients SET pstatus = '1' where pstatus = '2'");

			}
			if($log == ''){
            		return "Success";
	        } else {
	              $errorlog = 'patient_Error'.time().'.html';
	            $error =  fopen('uploads/errorlog/'.$errorlog,"w");
	            fwrite($error,$log);
	            fclose($error);
	            $log = '';
	            return $errorlog;
	        }
}
