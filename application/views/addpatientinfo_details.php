<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
        	<?php if($sadd == 1){ ?>
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'patient/patientinfodetails/'.$pid,'<i class="icon-backward"></i>&nbsp;&nbsp;'.lang("PATIENT::pat_info_list").'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
                            <?php } ?>
            <div class="pagetitle">
               <h1><?php echo lang("PATIENT::add_pat_info"); ?></h1>
            </div>

        </div><!--pageheader-->
        <div class="maincontent">
            <div class="maincontentinner">

            <div class="widgetbox box-inverse span9">
                <h4 class="widgettitle"><?php echo lang("PATIENT::add_pat_info"); ?></h4>
                <div class="widgetcontent nopadding">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>


           <?php
                    	if(isset($view)){ ?>
       <div class="stdform stdform2">
						 <?php
                    		$query = $this->db->query("SELECT * FROM `patients_info_details` where piid='$piid'");
						if ($query->num_rows() > 0)
						{
						   $row = $query->result();
							$pid = $row[0]->pid;
							$rid = explode(",", $row[0]->rid);
						   //	$rid = $row[0]->rid;
							$info = $row[0]->info;
							$status = $row[0]->status;
						   	?>
                    		<p>
                                <label><?php echo lang("PATIENT::role"); ?></label>
                                <span class="field">
                                	<?php $role_id = array();
										foreach ($rid as $row_role)
										   {
												$role_id[] = $this->common->getrolename($row_role);
										   }
										echo $role_name = implode(", ", $role_id);
                                	   ?></span>
                            </p>

							<p>
                                <label><?php echo lang("PATIENT::note"); ?></label>
                                <span class="field"><?=$info?></span>
                            </p>
							<p>
                            	 <label><?php echo lang("PATIENT::attachment"); ?></label>
                            	<div class="patinfoimg">
								<?php $query = $this->patient_model->getpatientinfoimage($piid);
								if ($query->num_rows() > 0)
								{ ?>

								 <?php  foreach ($query->result() as $row)
								   { ?>
									<img src="<?php echo base_url(); ?>uploads/<?=$this->config->item('upload_folder')?>/<?php echo $row->files; ?>" />
								<?php }  } ?>

							</p>
							<?php if($sedit == 1){ ?>
                            <p class="stdformbutton" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');
								if($status == '1'){
									 echo anchor($i18n.'patient/status_pinfo/'.$pid.'/'.$piid.'/2','<i class="icon-remove"></i>&nbsp;&nbsp;'.lang("PATIENT::patinfo_status_deactive"),$attributes2)."&nbsp&nbsp&nbsp";
								}else{
									 echo anchor($i18n.'patient/status_pinfo/'.$pid.'/'.$piid.'/1','<i class="icon-ok"></i>&nbsp;&nbsp;'.lang("PATIENT::patinfo_status_active"),$attributes2)."&nbsp&nbsp&nbsp";
								}

                            	echo anchor($i18n.'patient/editpatientinfo/'.$pid.'/'.$piid,'<i class="icon-link"></i>&nbsp;&nbsp;'.lang("PATIENT::edit_pat_info"),$attributes2); ?>
                            </p>
                            <?php } ?>
                    		<?php } ?> </div><?php }else{

                    			$attributes = array('class' => 'stdform stdform2','id' => 'upload');
           					echo form_open_multipart('patient/addpatientinfodata',$attributes);
		   						echo form_hidden('pid',$pid);
                    			?>

                            <p>
                                <label><?php echo lang("PATIENT::role"); ?><span class="rstar">*</span></label>
                                <span class="field"><select name="role[]" id="role" class="uniformselect" multiple="multiple" size="10">
                                    <option value=""><?php echo lang("COMMON::choose_one"); ?></option>
                                    <?php
									$role = $this->common->rolelist();
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
                                <label><?php echo lang("PATIENT::rolenote"); ?></label>
                                <span class="field"><textarea name="info" id="info" class="input-xxlarge"></textarea></span>
                            </p>
                            <p>
                            	 <label><?php echo lang("PATIENT::attachment"); ?></label>
                            	 <span class="field"><input type="file" name="userfile[]" size="20" class="multi" /></span>
							</p>

                            <p class="stdformbutton" style="text-align:right">
                                <button class="btn btn-primary btn-submit"><?php echo lang("COMMON::sub_btn"); ?></button>
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo lang("COMMON::reset_btn"); ?></button>
                            </p>
                            <?php } ?>
<?php echo form_close(); ?>
                </div><!--widgetcontent-->
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