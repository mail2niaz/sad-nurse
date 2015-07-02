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
               <h1><?php echo lang("PATIENT::edit_pat_info"); ?></h1>
            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">

            <div class="widgetbox box-inverse span9">
                <h4 class="widgettitle"><?php echo lang("PATIENT::edit_pat_info"); ?></h4>
                <div class="widgetcontent nopadding">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

           			<?php      $attributes = array('class' => 'stdform stdform2','id' => 'upload');
           					echo form_open_multipart('patient/editpatientinfo/'.$pid.'/'.$piid,$attributes);
		   						echo form_hidden('piid',$piid);
								echo form_hidden('pid',$pid);
                    			?>

                            <p>
                            	<input type="hidden" name="deletepatinfoimg" id="deletepatinfoimg" value="<?php echo site_url($i18n.'patient/deletepatinfoimg') ?>" />
                            	<input type="hidden" name="multiimgdeletefrom" id="multiimgdeletefrom" value="patient" />
                                <label><?php echo lang("PATIENT::role"); ?><span class="rstar">*</span></label>
                                <span class="field"><select name="role[]" id="role" class="uniformselect" multiple="multiple">
                                    <option value=""><?php echo lang("COMMON::choose_one"); ?></option>
                                    <?php
									$role = $this->common->rolelist();
									$role_cnt = $role->num_rows();
									$rid_exp = explode(",", $optval->rid);
										if ($role_cnt > 0)
										{
										   foreach ($role->result() as $row)
										   {
										   			$rid = $row->rid;
										    		$type = $row->type;
													?>
											<option value="<?=$rid?>" <?php if(in_array($rid, $rid_exp)){ ?>  selected="selected" <?php } ?>><?=$type?></option>
												<?php }
										}  ?>
                                </select></span>
                            </p>

							<p>
                                <label><?php echo lang("PATIENT::note"); ?></label>
                                <span class="field"><textarea name="info" id="info" class="input-xxlarge"><?php echo $optval->info; ?></textarea></span>
                            </p>
								<p>
                            	 <label><?php echo lang("PATIENT::attachment"); ?></label>
                            	 <span class="field"><input type="file" name="userfile[]" size="20" class="multi" /></span>
                            	 <div class="patinfoimg">
								<?php $query = $this->patient_model->getpatientinfoimage($piid);
								if ($query->num_rows() > 0)
								{
									$i = 1;
								   foreach ($query->result() as $row)
								   {
								   	?>
								   	<div id="img<?php echo $i; ?>" class="patimg">
									<img src="<?php echo base_url(); ?>uploads/<?=$this->config->item('upload_folder')?>/<?php echo $row->files; ?>" width="100" height="100"  />
									<a class='delete_link' href='javascript:void(0)' data_link='<?php echo $row->pi_img_id; ?>' data_loop='<?php echo $i; ?>' >Remove</a>
</div>

								<?php $i++; } } ?>
							</div>
							</p>
                            <p class="stdformbutton" style="text-align:right">
                               <input type="submit" class="btn btn-primary btn-submit" name="mysubmit" value="<?php echo lang("COMMON::sub_btn"); ?>">
                            </p>
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