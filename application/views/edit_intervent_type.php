<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'intervent/interventtype','<i class="icon-backward"></i>&nbsp;&nbsp;'.( sprintf( lang("INTERVENT::intervent_type")) ).'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
            <div class="pagetitle">
               <h1><?php echo ( sprintf( lang("INTERVENT::edit_intervent_type")) ); ?></h1>
            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">


            <div class="widgetbox box-inverse span9">
                <h4 class="widgettitle"><?php echo ( sprintf( lang("INTERVENT::edit_intervent_type")) ); ?></h4>
               <div class="widgetcontent nopadding">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div>'; <?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
		   $url = $i18n.'intervent/edit_interventtype/'.$optval->int_type_id;
           echo form_open($url,$attributes);
			echo form_hidden('int_type_id',$optval->int_type_id);
           ?>
                            <p>
                                <label><?php echo ( sprintf( lang("INTERVENT::intervent_code")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="code" readonly="readonly" id="code" class="input-xxlarge" value="<?php echo $optval->int_code; ?>" /></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("INTERVENT::intervent_type")) ); ?></label>
                                <span class="field"><input type="text" name="type" id="type" class="input-xxlarge" value="<?php echo $optval->int_type; ?>" /></span>
                            </p>
                               <p>
                                <label><?php echo ( sprintf( lang("INTERVENT::standard_duration")) ); ?></label>
                                <?php $int_time = $optval->int_time;
								if($int_time != ""){
								$time_exp = explode(":", $int_time);
									$hours = $time_exp[0];
									$mint = $time_exp[1];
								}else{
									$hours = "0";
									$mint = "0";
								}
                                ?>
                                <span class="field">
                                <select name="hours" id="hours" class="endhourcombo">
	                            	<option value="0">00</option>
                            	<?php for($eht = 0; $eht <= 23; $eht++ ){ ?>
     								<option value="<?=$eht?>" <?php if($eht == $hours){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($eht);?></option>
                            	<?php } ?>
							</select>
							<select name="mint" id="mint" class="endhourcombo">
								<?php for($emt = 0; $emt <= 55; $emt = $emt+5 ){ ?>
     								<option value="<?=$emt?>" <?php if($emt == $mint){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($emt);?></option>
                            	<?php } ?>
			</select>
                                	<!--
									<input type="text" name="hours" id="hours" value="<?php echo $hours; ?>" class="input-small" style="width: 20px;" />
																		&nbsp;&nbsp;<input type="text" name="mint" id="mint" value="<?php echo $mint; ?>"  class="input-small" style="width: 20px;" />-->
									 (HH:MM)
                                </span>
                            </p>
                            <div style="border: 1px solid #000">
								<p>
                                <label><?php echo ( sprintf( lang("INTERVENT::primary")) ); ?></label>
                                <span class="field"><input type="text" name="prole" readonly="readonly" value="<?php echo ( sprintf( lang("INTERVENT::primary")) ); ?>" id="prole" class="input-xxlarge" /></span>
                            	</p>
                            	<p>
                                <label><?php echo ( sprintf( lang("INTERVENT::mandatory")) ); ?></label>
                                <span class="field"><input type="checkbox" <?php if($optval->primary_mandatory == '1'){ ?> checked="checked" <?php } ?> name="pmandatory" id="pmandatory" class="input-xxlarge" /></span>
                            	</p>
                            	<p>
                                <label><?php echo ( sprintf( lang("INTERVENT::permitted_user_role")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><select name="puserrole[]" id="puserrole" class="uniformselect" multiple="multiple">
                                    <?php
									$puser_role = explode(",", $optval->primary_roles);
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
                                <label><?php echo ( sprintf( lang("INTERVENT::secondary")) ); ?></label>
                                <span class="field"><input type="text" name="secrole" readonly="readonly" value="<?php echo ( sprintf( lang("INTERVENT::secondary")) ); ?>" id="secrole" class="input-xxlarge" /></span>
                            	</p>
                            	<p>
                                <label><?php echo ( sprintf( lang("INTERVENT::mandatory")) ); ?></label>
                                <span class="field"><input type="checkbox" name="sec_mandatory" <?php if($optval->secondary_mandatory == '1'){ ?> checked="checked" <?php } ?> id="sec_mandatory" class="input-xxlarge" /></span>
                            	</p>
                            	<p>
                                <label><?php echo ( sprintf( lang("INTERVENT::permitted_user_role")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><select name="sec_userrole[]" id="sec_userrole" class="uniformselect" multiple="multiple">
                                    <?php
                                    $secuser_role = explode(",", $optval->secondary_roles);
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
                                <label><?php echo ( sprintf( lang("INTERVENT::supervisor")) ); ?></label>
                                <span class="field"><input type="text" name="sup_type" readonly="readonly" value="<?php echo ( sprintf( lang("INTERVENT::supervisor")) ); ?>" id="sup_type" class="input-xxlarge" /></span>
                            	</p>
                            	<p>
                                <label><?php echo ( sprintf( lang("INTERVENT::mandatory")) ); ?></label>
                                <span class="field"><input type="checkbox" name="sup_mandatory" <?php if($optval->supervisor_mandatory == '1'){ ?> checked="checked" <?php } ?> id="sup_mandatory" class="input-xxlarge" /></span>
                            	</p>
                            	<p>
                                <label><?php echo ( sprintf( lang("INTERVENT::permitted_user_role")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><select name="sup_userrole[]" id="sup_userrole" class="uniformselect" multiple="multiple">
                                    <?php $supuser_role = explode(",", $optval->supervisor_roles);
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
                            
                            <div class="maincontent">
                            <?php echo anchor($i18n.'intervent/operator_code/'.$optval->int_type_id,'<i class="icon-backward"></i>&nbsp;&nbsp;'.lang("INTERVENT::add_intervent_op_code").'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
            <div class="maincontentinner">
<table class="table table-bordered responsive">
		<colgroup>
			<col class="con0" style="align: center; width: 4%" />
			<col class="con1" />
			<col class="con0" />
			<col class="con1" />
			<col class="con0" />
			<col class="con1" />
		</colgroup>
	    <thead>
	         <th class="head0"><?php echo ( sprintf( lang("COMMON::sno")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("INTERVENT::code_op1")) ); ?></th>
		  <th class="head1"><?php echo ( sprintf( lang("INTERVENT::code_op2")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("INTERVENT::code_op3")) ); ?></th>
		  <th class="head1"><?php //echo ( sprintf( lang("COMMON::action")) ); ?></th>
		</thead>
		<tbody>
		<?php 
		$int_code = $optval->int_type_id;
            $job_code_oper = $this->intervent_model->getintertype_job_code($int_code);
            $i = 1;
            foreach($job_code_oper as $row) 
            {
            $id = $row['id'];
            $id_job = $row['id_job'];
            $code_op1 = $row['code_op1'];
            $code_op2 = $row['code_op2'];
            $code_op3 = $row['code_op3'];
            ?>
            <tr class="gradeX">
            <td><?=$i?></td>
            <td><?=$code_op1 ?></td>
          <td><?=$code_op2?></td>
          <td><?=$code_op3?></td>
            <td>
            <?php if($sedit == '1'){ echo anchor($i18n.'intervent/edit_operator_code/'.$id.'/'.$id_job,'<i class="icon-edit" title="'.sprintf( lang("COMMON::edit") ).'"></i>&nbsp;&nbsp;'); } 
             if($sdelete == 1){
		      $onclick = array('onclick'=>"return confirm('SEI SICURO DI VOLERE CANCELLARE?')");
 		 echo anchor($i18n.'intervent/delete_job_code/'.$id.'/'.$id_job,'<i class="icon-trash" title="'.sprintf( lang("COMMON::delete") ).'"></i>',$onclick); }?>
            </td>
            </tr>
            <?php $i++; }
            ?>
            </tbody>
		</table>
                            
							</div>

                            <p class="stdformbutton" style="text-align:right">
                            	<input type="submit" class="btn btn-primary btn-submit" name="mysubmit" value="<?php echo ( sprintf( lang("COMMON::sub_btn")) ); ?>">
                            	  
                            	  
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo ( sprintf( lang("COMMON::reset_btn")) ); ?></button>
                            </p>
<?php echo form_close(); ?>
                </div>
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
