<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'intervent','<i class="icon-backward"></i>&nbsp;&nbsp;'.( sprintf( lang("INTERVENT::interlist")) ).'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
            <div class="pagetitle">
               <h1><?php echo ( sprintf( lang("INTERVENT::addinter")) ); ?></h1>
            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">


            <div class="widgetbox box-inverse span9">
                <h4 class="widgettitle"><?php echo ( sprintf( lang("INTERVENT::addinter")) ); ?></h4>
                <?php
                if(isset($itype_asg_id)){
                	$query = $this->db->query("SELECT IA.int_type_asg_id,IA.status, (SELECT int_type FROM `intervention_types` where int_type_id = IA.int_type_id ) as inttype, (SELECT int_code FROM `intervention_types` where int_type_id = IA.int_type_id ) as intcode, (SELECT type FROM `mt_role` where rid = IA.role ) as introle FROM intervention_types_assign as IA WHERE IA.int_type_asg_id = '$itype_asg_id'");
					$fet = $query->result();
					$int_type_asg_id = $fet[0]->int_type_asg_id;
                	?>
<div class="widgetcontent nopadding stdform stdform2">
							<p>
                                <label><?php echo ( sprintf( lang("INTERVENT::intervent_code")) ); ?></label>
                                <span class="field"><?php echo $fet[0]->intcode; ?></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("INTERVENT::intervent_type")) ); ?></label>
                                <span class="field"><?php echo $fet[0]->inttype; ?></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("INTERVENT::frole")) ); ?></label>
                                <span class="field"><?php echo $fet[0]->introle; ?></span>
                            </p>

 							<p>
                                <label><?php echo ( sprintf( lang("INTERVENT::fstatus")) ); ?></label>
                                <span class="field"><?php $status = $fet[0]->status;
                                	if($status == "1"){
											echo ( sprintf( lang("INTERVENT::publish")) );
                                	}elseif($status == "2"){
											echo ( sprintf( lang("INTERVENT::draft")) );
                                	}
                                	?>
				                </span>
                            </p>
<?php if($sedit == "1"){ ?>
                            <p class="stdformbutton" style="text-align:right">
                                <?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'intervent/editdynamic_form/'.$int_type_asg_id,'<i class="icon-link"></i>&nbsp;&nbsp;'.( sprintf( lang("INTERVENT::edit_inter")) ),$attributes2); ?>
                            </p>
                            <?php } ?>
                </div>
              <?php }else{ ?>

                <div class="widgetcontent nopadding">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div>'; <?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
		   $url = $i18n.'intervent/adddynamic_form';
           echo form_open($url,$attributes); ?>
                            <p>
                                <label><?php echo ( sprintf( lang("INTERVENT::intervent_type")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><select name="int_type_id" id="int_type_id" class="uniformselect input-xxlarge">
                                    <option value=""><?php echo ( sprintf( lang("COMMON::choose_one")) ); ?></option>
                                    <?php
									$role = $this->common->interventtypelist();
									$role_cnt = $role->num_rows();
										if ($role_cnt > 0)
										{
										   foreach ($role->result() as $row)
										   {
										   			$int_type_id = $row->int_type_id;
										   			$int_code = $row->int_code;
													$int_type = $row->int_type;

													?>
											<option value="<?=$int_type_id?>"><?php echo $int_type; ?></option>
												<?php } }  ?>
                                </select></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("INTERVENT::frole")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><select name="role" id="role" class="uniformselect">
                                    <option value=""><?php echo ( sprintf( lang("COMMON::choose_one")) ); ?></option>
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

 							<p>
                                <label><?php echo ( sprintf( lang("INTERVENT::fstatus")) ); ?><span class="rstar">*</span></label>
                                <span class="field">
				                    <input type="radio" name="status" value="2" checked="checked"> <?php echo ( sprintf( lang("INTERVENT::draft")) ); ?> &nbsp;&nbsp;
				                    <input type="radio" name="status" value="1"> <?php echo ( sprintf( lang("INTERVENT::publish")) ); ?>
				                </span>
                            </p>

                            <p class="stdformbutton" style="text-align:right">
                                <button class="btn btn-primary btn-submit"><?php echo ( sprintf( lang("INTERVENT::next")) ); ?></button>
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo ( sprintf( lang("COMMON::reset_btn")) ); ?></button>
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