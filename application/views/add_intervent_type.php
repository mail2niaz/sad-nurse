<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'intervent','<i class="icon-backward"></i>&nbsp;&nbsp;'.lang("INTERVENT::interlist").'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
            <div class="pagetitle">
               <h1><?php echo lang("INTERVENT::add_intervent_type"); ?></h1>
            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">


            <div class="widgetbox box-inverse span9">
                <h4 class="widgettitle"><?php echo lang("INTERVENT::add_intervent_type"); ?></h4>
                <?php
                if(isset($int_type_id)){
                	$query = $this->intervent_model->InterventionTypes($int_type_id);
					$fet = $query->result();
					$int_code = $fet[0]->int_code;
                	?>
<div class="widgetcontent nopadding stdform stdform2">
                            <p>
                                <label><?php echo lang("INTERVENT::intervent_code"); ?></label>
                                <span class="field"><?php echo $fet[0]->int_code; ?></span>
                            </p>

                            <p>
                                <label><?php echo lang("INTERVENT::intervent_type"); ?></label>
                                <span class="field"><?php echo $fet[0]->int_type; ?></span>
                            </p>

                            <p>
                                <label><?php echo lang("INTERVENT::standard_duration"); ?></label>
                                <span class="field"><?php                                 $inttimed = explode(":", $fet[0]->int_time);
								echo  $this->common->commontimeformat($inttimed[0]).":". $this->common->commontimeformat($inttimed[1]); ?> ( HH:MM )</span>
                            </p>

                            <div style="border: 1px solid #000">
								<p>
                                <label><?php echo lang("INTERVENT::primary"); ?></label>
                                <span class="field"><input type="text" name="prole" readonly="readonly" value="<?php echo lang("INTERVENT::primary"); ?>" id="prole" class="input-xxlarge" /></span>
                            	</p>
                            	<p>
                                <label><?php echo lang("INTERVENT::mandatory"); ?></label>
                                <span class="field"><input type="checkbox" <?php if($fet[0]->primary_mandatory == '1'){ ?> checked="checked" <?php } ?> name="pmandatory" id="pmandatory" class="input-xxlarge" disabled="disabled" /></span>
                            	</p>
                            	<p>
                                <label><?php echo lang("INTERVENT::permitted_user_role"); ?><span class="rstar">*</span></label>
                                <span class="field"><select name="puserrole[]" id="puserrole" disabled="disabled" class="uniformselect" multiple="multiple">
                                    <?php
									$puser_role = explode(",", $fet[0]->primary_roles);
									$role = $this->common->invrolelist();
									$role_cnt = $role->num_rows();
										if ($role_cnt > 0)
										{
										   foreach ($role->result() as $row)
										   {
										   	$rid = $row->rid;
										    $type = $row->type;
													?>
											<option value="<?=$rid?>" <?php if(in_array($rid,$puser_role)) { ?> selected="selected" <?php } ?>><?=$type?></option>
												<?php } }  ?>
                                </select></span>
                            </p>
							</div>
							<div style="border: 1px solid #000">
								<p>
                                <label><?php echo lang("INTERVENT::secondary"); ?></label>
                                <span class="field"><input type="text" name="secrole" readonly="readonly" value="<?php echo lang("INTERVENT::secondary"); ?>" id="secrole" class="input-xxlarge" /></span>
                            	</p>
                            	<p>
                                <label><?php echo lang("INTERVENT::mandatory"); ?></label>
                                <span class="field"><input type="checkbox" disabled="disabled" name="sec_mandatory" <?php if($fet[0]->secondary_mandatory == '1'){ ?> checked="checked" <?php } ?> id="sec_mandatory" class="input-xxlarge" /></span>
                            	</p>
                            	<p>
                                <label><?php echo lang("INTERVENT::permitted_user_role"); ?><span class="rstar">*</span></label>
                                <span class="field"><select name="sec_userrole[]" id="sec_userrole" disabled="disabled" class="uniformselect" multiple="multiple">
                                    <?php
                                    $secuser_role = explode(",", $fet[0]->secondary_roles);
									$role = $this->common->invrolelist();
									$role_cnt = $role->num_rows();
										if ($role_cnt > 0)
										{
										   foreach ($role->result() as $row)
										   {
										   			$rid = $row->rid;
										    		$type = $row->type;
													?>
											<option value="<?=$rid?>" <?php if(in_array($rid,$secuser_role)) { ?> selected="selected" <?php } ?>><?=$type?></option>
												<?php } }  ?>
                                </select></span>
                            </p>
							</div>
							<div style="border: 1px solid #000">
								<p>
                                <label><?php echo lang("INTERVENT::supervisor"); ?></label>
                                <span class="field"><input type="text" readonly="readonly" name="sup_type" value="<?php echo lang("INTERVENT::supervisor"); ?>" id="sup_type" class="input-xxlarge" /></span>
                            	</p>
                            	<p>
                                <label><?php echo lang("INTERVENT::mandatory"); ?></label>
                                <span class="field"><input type="checkbox" disabled="disabled" name="sup_mandatory" <?php if($fet[0]->supervisor_mandatory == '1'){ ?> checked="checked" <?php } ?> id="sup_mandatory" class="input-xxlarge" /></span>
                            	</p>
                            	<p>
                                <label><?php echo lang("INTERVENT::permitted_user_role"); ?><span class="rstar">*</span></label>
                                <span class="field"><select name="sup_userrole[]" id="sup_userrole" class="uniformselect" disabled="disabled" multiple="multiple">
                                    <?php $supuser_role = explode(",", $fet[0]->supervisor_roles);
									$role = $this->common->invrolelist();
									$role_cnt = $role->num_rows();
										if ($role_cnt > 0)
										{
										   foreach ($role->result() as $row)
										   {
										   			$rid = $row->rid;
										    		$type = $row->type;
													?>
											<option value="<?=$rid?>" <?php if(in_array($rid,$supuser_role)) { ?> selected="selected" <?php } ?>><?=$type?></option>
												<?php } }  ?>
                                </select></span>
                            </p>
							</div>
<?php if($sedit == "1"){ ?>
                            <p class="stdformbutton" style="text-align:right">
                                <?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'intervent/edit_interventtype/'.$int_type_id,'<i class="icon-link"></i>&nbsp;&nbsp;'.lang("INTERVENT::edit_intervent_type"),$attributes2); ?>
                            </p>
                            <?php } ?>
                </div>
              <?php }else{ ?>

                <div class="widgetcontent nopadding">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div>'; <?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
		   $url = $i18n.'intervent/add_interventtype_data';
           echo form_open($url,$attributes); ?>
                            <p>
                                <label><?php echo lang("INTERVENT::intervent_code"); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="code" readonly="readonly" id="code" class="input-xxlarge" value="<?php echo "INTCODE-".$this->common->last_intervent_code(); ?>" /></span>
                            </p>

                            <p>
                                <label><?php echo lang("INTERVENT::intervent_type"); ?></label>
                                <span class="field"><input type="text" name="type" id="type" class="input-xxlarge" /></span>
                            </p>
                            <p>
                                <label><?php echo lang("INTERVENT::standard_duration"); ?></label>
                                <span class="field">
                                	<select name="hours" id="hours" class="endhourcombo">
	                            	<option value="0">00</option>
                            	<?php for($eht = 0; $eht <= 23; $eht++ ){ ?>
     								<option value="<?=$eht?>"><?php echo $this->common->commontimeformat($eht);?></option>
                            	<?php } ?>
							</select>
							<select name="mint" id="mint" class="endhourcombo">
								<?php for($emt = 0; $emt <= 55; $emt = $emt+5 ){ ?>
     								<option value="<?=$emt?>"><?php echo $this->common->commontimeformat($emt);?></option>
                            	<?php } ?>
			</select>

                                	<!--
									<input type="text" name="hours" id="hours" value="00" class="input-small" style="width: 20px;" />
																		&nbsp;&nbsp;<input type="text" name="mint" id="mint" value="00" class="input-small" style="width: 20px;" />-->
									 (HH:MM)
                                </span>
                            </p>


							<div style="border: 1px solid #000">
								<p>
                                <label><?php echo lang("INTERVENT::primary"); ?></label>
                                <span class="field"><input type="text" name="prole" readonly="readonly" value="<?php echo lang("INTERVENT::primary"); ?>" id="prole" class="input-xxlarge" /></span>
                            	</p>
                            	<p>
                                <label><?php echo lang("INTERVENT::mandatory"); ?></label>
                                <span class="field"><input type="checkbox" name="pmandatory" id="pmandatory" class="input-xxlarge" /></span>
                            	</p>
                            	<p>
                                <label><?php echo lang("INTERVENT::permitted_user_role"); ?><span class="rstar">*</span></label>
                                <span class="field"><select name="puserrole[]" id="puserrole" class="uniformselect" multiple="multiple">
                                    <?php
									$role = $this->common->invrolelist();
									$role_cnt = $role->num_rows();
										if ($role_cnt > 0)
										{
										   foreach ($role->result() as $row)
										   {
										   			$rid = $row->rid;
										    		$type = $row->type;
													?>
											<option value="<?=$rid?>"><?=$type?></option>
												<?php } }  ?>
                                </select></span>
                            </p>
							</div>
							<div style="border: 1px solid #000">
								<p>
                                <label><?php echo lang("INTERVENT::secondary"); ?></label>
                                <span class="field"><input type="text" name="secrole" readonly="readonly" value="<?php echo lang("INTERVENT::secondary"); ?>" id="secrole" class="input-xxlarge" /></span>
                            	</p>
                            	<p>
                                <label><?php echo lang("INTERVENT::mandatory"); ?></label>
                                <span class="field"><input type="checkbox" name="sec_mandatory" id="sec_mandatory" class="input-xxlarge" /></span>
                            	</p>
                            	<p>
                                <label><?php echo lang("INTERVENT::permitted_user_role"); ?><span class="rstar">*</span></label>
                                <span class="field"><select name="sec_userrole[]" id="sec_userrole" class="uniformselect" multiple="multiple">
                                    <?php
									$role = $this->common->invrolelist();
									$role_cnt = $role->num_rows();
										if ($role_cnt > 0)
										{
										   foreach ($role->result() as $row)
										   {
										   			$rid = $row->rid;
										    		$type = $row->type;
													?>
											<option value="<?=$rid?>"><?=$type?></option>
												<?php } }  ?>
                                </select></span>
                            </p>
							</div>
							<div style="border: 1px solid #000">
								<p>
                                <label><?php echo lang("INTERVENT::supervisor"); ?></label>
                                <span class="field"><input type="text" name="sup_type" readonly="readonly" value="<?php echo lang("INTERVENT::supervisor"); ?>" id="sup_type" class="input-xxlarge" /></span>
                            	</p>
                            	<p>
                                <label><?php echo lang("INTERVENT::mandatory"); ?></label>
                                <span class="field"><input type="checkbox" name="sup_mandatory" id="sup_mandatory" class="input-xxlarge" /></span>
                            	</p>
                            	<p>
                                <label><?php echo lang("INTERVENT::permitted_user_role"); ?><span class="rstar">*</span></label>
                                <span class="field"><select name="sup_userrole[]" id="sup_userrole" class="uniformselect" multiple="multiple">
                                    <?php
									$role = $this->common->invrolelist();
									$role_cnt = $role->num_rows();
										if ($role_cnt > 0)
										{
										   foreach ($role->result() as $row)
										   {
										   			$rid = $row->rid;
										    		$type = $row->type;
													?>
											<option value="<?=$rid?>"><?=$type?></option>
												<?php } }  ?>
                                </select></span>
                            </p>
							</div>
                            <p class="stdformbutton" style="text-align:right">
                              <?php
                              $int_job_code = $this->common->last_intervent_code();
                              ?>
                                <button class="btn btn-primary btn-submit"><?php echo lang("INTERVENT::next"); ?></button>
                                 <?php echo anchor($i18n.'intervent/operator_code/'.$int_job_code,'<i class="icon-backward"></i>&nbsp;&nbsp;'.lang("INTERVENT::add_intervent_op_code").'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo lang("COMMON::reset_btn"); ?></button>
                            </p>
<?php echo form_close(); ?>
                </div>
                <?php } ?>
                <!--widgetcontent-->
            </div><!--widget-->


            <div class="footer">
                    <div class="footer-left">
                        <span></span>
                    </div>
                    <div class="footer-right">
                        <span></span>
                    </div>
                </div><!--footer-->

            </div><!--maincontentinner-->
        </div><!--maincontent-->

    </div><!--rightpanel-->

</div><!--mainwrapper-->
<?php $this->load->view('common/footer'); ?>
