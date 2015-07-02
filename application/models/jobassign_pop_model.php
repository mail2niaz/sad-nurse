<?php
Class Jobassign_pop_model extends CI_Model
{

/* 30-04-2014 */
public function get_contract_patient_list()
{
		$query = $this->db->query("SELECT DISTINCT contract_details.`pid` FROM (`contract_details`) LEFT JOIN `patients` ON (contract_details.pid = patients.pid) ORDER BY `patients`.`surname` ASC");
		return $query->result();
}
public function get_patient_intervent_list($pid)
{
	$valarray = array();
		$this->db->select('intervent_id');
		$this -> db -> where('pid = ' . "'" . $pid . "'");
		$query = $this->db->get('contract_intervent_weekdays');
		return $query->result();
}
public function getpatientnote($pid)
{
		$this -> db -> select('note');
		$this -> db -> from('patients');
		$this -> db -> where('pid = ' . "'" . $pid . "'");
		$this -> db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$val = $query->result();
			$note = $val[0]->note;
		}else{
			$note = "";
		}

	return $note;
}
public function get_contract_data($pid,$int_id)
{
		$this->db->select('cid, ciw_id, intervent_id, intervent_hour, week_days, intervent_fortnightly, suspendable, contract_tags');
		$this -> db -> where('pid = ' . "'" . $pid . "'");
		$this -> db -> where('intervent_id = ' . "'" . $int_id . "'");
		$query = $this->db->get('contract_intervent_weekdays');
		$data = $query->result();
		$intervent_id = $data[0]->intervent_id;
		$intervent_hour = $data[0]->intervent_hour;
		$week_days = $data[0]->week_days;
		$intervent_fortnightly = $data[0]->intervent_fortnightly;
		$suspendable = $data[0]->suspendable;
		$tag_id = $data[0]->contract_tags;
		$ciw_id = $data[0]->ciw_id;
		$cid = $data[0]->cid;
		$exp_hours = explode(":", $intervent_hour);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}
		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
		?>
		<script type="text/javascript" src="<?php echo base_url()?>js/job_assign_combo_jquery.js"></script>
		<div class="jobautocomp">
		<label><?php echo ( sprintf( lang("OPERATOR::tag")) ); ?></label>
		<?php
		if($tag_id != ''){
			$contract_tags = explode(",", $tag_id);
		}else{
			$contract_tags = array();
		}
		?>
		<span class="field">
		  <?php if($tag_id != ''){
		  $tags = $this->common->get_tags_list();
		  foreach($contract_tags as $fet_tid){
		  	 $tid = $fet_tid;
			 $tag_desc = $this->common->get_tag_names($tid); ?>
			<input type="checkbox" name="contract_tags[]" onclick="hideoperatorlist()" checked="checked" value="<?=$tid?>" /><?=$tag_desc?>
		  <?php } } ?>
		  <br>
		   <input type="button" class="btn btn-primary btn-submit" name="update_operator_list1" onclick="return update_operator_list()" value="<?php echo lang("JOBASSIGN::update_opt_list"); ?>" id="update_operator_list1" />
		   </span>

		</div>
		<div class="jobautocomp">
			<input type="hidden" id="cid" value="<?=$cid?>" name="cid" />
			<input type="hidden" id="contract_int_id" value="<?=$ciw_id?>" name="contract_int_id" />
			<input type="hidden" id="int_hour" value="<?=$int_hour?>" name="int_hour" />
            <input type="hidden" id="int_min" value="<?=$int_min?>" name="int_min" />
	        <label><?php echo ( sprintf( lang("JOBASSIGN::int_standard_duration")) ); ?></label>
	        <span class="field"><input type="text" value="<?=$intervent_hour?>" readonly="readonly" />(HH:MM)</span>
		</div>

<div class="default_record" style="display: none;">
<?php
		$query = $this->db->query("select * from intervention_types where int_type_id = '$intervent_id'");
        foreach($query->result() as $row){
			$primary_mandatory = $row->primary_mandatory;
			$secondary_mandatory = $row->secondary_mandatory;
			$supervisor_mandatory = $row->supervisor_mandatory;
			$primary_roles = $row->primary_roles;
			$secondary_roles = $row->secondary_roles;
			$supervisor_roles = $row->supervisor_roles;
			if($primary_roles != ""){
				$primary_exp = explode(",", $primary_roles);
				$i = 3; ?>

				<div class="jobautocomp">
					<input type="hidden" name="primary_mandatory" id="primary_mandatory" value="<?=$primary_mandatory?>" />
					<input type="hidden" name="secondary_mandatory" id="secondary_mandatory" value="<?=$secondary_mandatory?>" />
					<input type="hidden" name="supervisor_mandatory" id="supervisor_mandatory" value="<?=$supervisor_mandatory?>" />
                            <label><?php echo lang('INTERVENT::primary'); ?> <?php if($primary_mandatory == '1'){ ?><span class="rstar">*</span> <?php }?></label>
                            <span class="field" style="padding-bottom: 20px;">
				<?php foreach($primary_exp as $primary_val){ ?>
							<div style="float: left;"><input type="radio" value="<?=$primary_val?>" onchange="primay_role_fun(this.value,'<?=$tag_id?>')" name="primay_role" style="float: left; margin-top: 4px;" /><span style="float: left;"><?php echo $this->common->getrolename($primary_val); ?></span></div>
				<?php $i++; } ?>
				<div style="float: left;"><input type="radio" checked="checked" value="<?=$primary_roles?>" onchange="primay_role_fun(this.value,'<?=$tag_id?>')" name="primay_role" style="float: left; margin-top: 4px;" /><span style="float: left;"><?php echo lang('JOBASSIGN::all'); ?></span></div>
				</span>

				<span class="field pry">
				<input type="hidden" name="pry_opt_role" value="1" />
				<input type="hidden" name="val_pry_operator" id="val_pry_operator" value="" />
				 <input type="hidden" name="distric" id="distric" value="">
				<select id="pry_operator" name="pry_operator">
					<option value="" selected="selected">--Select--</option>
                                <?php
 									$primary = $this->common->getoperatorlist_hole_role($primary_roles,$contract_tags);
									if(count($primary) > 0){
                                foreach($primary as $primary_list){
                                	$oid = $primary_list->oid;
									$fname = $primary_list->firstname;
									$lname = $primary_list->lastname;
									$name = $fname." ".$lname; ?>
									<option value="<?=$oid?>"><?=$name?> <?php echo "(".$this->common->getrolename($primary_list->role).")"; ?></option>
                              <?php } }else{ ?>
									<option value=""><?php echo lang('INTERVENT::dataempty'); ?></option>
                              <?php } ?>
                            </select>
                            <input type="hidden" name="pry_role_ids" id="pry_role_ids" value="<?=$primary_roles?>" /><br>
                            <span class="pry_msg"></span>
				</span>
				</div>
                        
			<?php }
			if($secondary_roles != ""){
				$secondary_exp = explode(",", $secondary_roles); ?>
				<div class="jobautocomp">
                            <label><?php echo lang('INTERVENT::secondary'); ?><?php if($secondary_mandatory == '1'){ ?><span class="rstar">*</span> <?php }?></label>
                            <span class="field" style="padding-bottom: 20px;">
				<?php foreach($secondary_exp as $secondary_val){ ?>
							<div style="float: left;"><input type="radio" value="<?=$secondary_val?>" onchange="secondary_role_fun(this.value,'<?=$tag_id?>')" name="secondary_role" style="float: left; margin-top: 4px;" /><span style="float: left;"><?php echo $this->common->getrolename($secondary_val); ?></span></div>
				<?php } ?>
				<div style="float: left;"><input type="radio" checked="checked" value="<?=$secondary_roles?>" onchange="secondary_role_fun(this.value,'<?=$tag_id?>')" name="secondary_role" style="float: left; margin-top: 4px;" /><span style="float: left;"><?php echo lang('JOBASSIGN::all'); ?></span></div>
				</span>

				<span class="field sec">
				<input type="hidden" name="sec_opt_role" value="2" />
				<input type="hidden" name="val_sec_operator" id="val_sec_operator" value="" />
					<select name="sec_operator" id="sec_operator">
						<option value="" selected="selected">--Select--</option>
                                <?php
									$secondary = $this->common->getoperatorlist_hole_role($secondary_roles,$contract_tags);
									if(count($secondary) > 0){
                                foreach($secondary as $secondary_list){
                                	$oid = $secondary_list->oid;
									$fname = $secondary_list->firstname;
									$lname = $secondary_list->lastname;
									$name = $fname." ".$lname; ?>
									<option value="<?=$oid?>"><?=$name?><?php echo "(".$this->common->getrolename($secondary_list->role).")"; ?></option>
                              <?php } }else{ ?>
									<option value=""><?php echo lang('INTERVENT::dataempty'); ?></option>
                              <?php } ?>
                            </select>
                            <input type="hidden" name="sec_role_ids" id="sec_role_ids" value="<?=$secondary_roles?>" /><br>
                            <span class="sec_msg"></span>
				</span>
				</div>
				
				
				<?php
			}
			if($supervisor_roles != ""){
				$supervisor_exp = explode(",", $supervisor_roles); ?>
				<div class="jobautocomp">
                            <label><?php echo lang('INTERVENT::supervisor'); ?><?php if($supervisor_mandatory == '1'){ ?><span class="rstar">*</span> <?php }?></label>
                            <span class="field" style="padding-bottom: 20px;">
				<?php foreach($supervisor_exp as $supervisor_val){ ?>
							<div style="float: left;"><input type="radio" value="<?=$supervisor_val?>" onchange="supervisor_role_fun(this.value,'<?=$tag_id?>')" name="supervisor_role" style="float: left; margin-top: 4px;" /><span style="float: left;"><?php echo $this->common->getrolename($supervisor_val); ?></span></div>
				<?php } ?>
				<div style="float: left;"><input type="radio" checked="checked" value="<?=$supervisor_roles?>" onchange="supervisor_role_fun(this.value,'<?=$tag_id?>')" name="supervisor_role" style="float: left; margin-top: 4px;" /><span style="float: left;"><?php echo lang('JOBASSIGN::all'); ?></span></div>
				</span>

				<span class="field sup">
					<input type="hidden" name="sup_opt_role" value="3" />
					<input type="hidden" name="val_sup_operator" id="val_sup_operator" value="" />
					<select name="sup_operator" id="sup_operator">
						<option value="" selected="selected">--Select--</option>
                                <?php
									$supervisor = $this->common->getoperatorlist_hole_role($supervisor_roles,$contract_tags);
									if(count($supervisor) > 0){
                                foreach($supervisor as $supervisor_list){
                                	$oid = $supervisor_list->oid;
									$fname = $supervisor_list->firstname;
									$lname = $supervisor_list->lastname;
									$name = $fname." ".$lname; ?>
									<option value="<?=$oid?>"><?=$name?><?php echo "(".$this->common->getrolename($supervisor_list->role).")"; ?></option>
                              <?php } }else{ ?>
									<option value=""><?php echo lang('INTERVENT::dataempty'); ?></option>
                              <?php } ?>
                            </select>
                            <input type="hidden" name="sup_role_ids" id="sup_role_ids" value="<?=$supervisor_roles?>" /><br>
                            <span class="sup_msg"></span>
				</span>
				</div>
				<div class="jobautocomp">
                              <label><?php echo ( sprintf( lang("JOBASSIGN::P2000_CODE_OP3")) ); ?><span class="rstar"></span></label>
                               <span class="field">
                              <input type="text" name="p200_code_op3" id="p200_code_op3" />
                        </div>
				
				<?php
			}
			} ?>

			</div>
			
<?php }

}
?>
