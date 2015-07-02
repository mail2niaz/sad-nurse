<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'contract','<i class="icon-backward"></i>&nbsp;&nbsp;'.lang("CONTRACT::contract_list").'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>

            <div class="pagetitle">
               <h1><?php echo lang("CONTRACT::view_contract"); ?></h1>
            </div>
        </div><!--pageheader-->
        <div class="maincontent">
            <div class="maincontentinner">

            <div class="widgetbox box-inverse span10" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo lang("CONTRACT::view_contract"); ?></h4>
                <div class="widgetcontent nopadding">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('contract/editcontract/'.$optval->cid,$attributes);
            echo form_hidden('cid',$optval->cid); ?>
<div class="stdform stdform2">
						<div class="jobautocomp">
                            <label><?php echo lang("PATIENT::patient_list"); ?></label>
                            <span class="field">
                            	<?php echo $this->common->getpatientname($optval->pid); ?>

						</span>
						</div>
						<p>
                            	 <label><?php echo lang("CONTRACT::attachment"); ?></label>
                            	<div class="patinfoimg">
								<?php $query = $this->db->query("SELECT * FROM contract_image WHERE cid = '$optval->cid'");
								if ($query->num_rows() > 0)
								{
									$k = 1;
									 foreach ($query->result() as $row)
								   {
								   		$ext = pathinfo($row->file, PATHINFO_EXTENSION);
									if($ext == "pdf"){
										$data_light = '';
										$target = 'target="_blank"';
									}else{
										$data_light = 'data-lightbox="example-'.$k.'"';
										$target = '';
									}
								   	?>

								   	<a <?=$target?> href="<?php echo base_url(); ?>uploads/contract_image/<?=$this->config->item('upload_folder')?>/<?php echo $row->file; ?>" <?=$data_light?>>
								   			<?php if($ext == "pdf"){ ?>
												<img src="<?php echo base_url(); ?>images/pdf.png" width="100" height="100"  />
								   			<?php }else{ ?>
									<img src="<?php echo base_url(); ?>uploads/contract_image/<?=$this->config->item('upload_folder')?>/<?php echo $row->file; ?>" width="100" height="100"  /><?php } ?></a>
								<?php $k++; }  } ?>
</div>
							</p>

						<p>
                                <label><?php echo lang("CMS-HOLIDAY::date"); ?></label>
                                <span class="field"><b><?php echo lang("from"); ?></b> :&nbsp;<?php echo date("d-m-Y",$optval->start_date); ?>&nbsp;&nbsp;
                                	<b><?php echo lang("to"); ?></b> :&nbsp;<?php echo date("d-m-Y",$optval->end_date); ?>
                                </span>
                            </p>
						<div class="jobautocomp">
                            <span class="field">
                            	<div id="div_intervent_days">
                            		<?php
                            		$sel_int_week = $this->db->query("SELECT * FROM contract_intervent_weekdays where cid = '$optval->cid'");
									$int_week_cnt = $sel_int_week->num_rows();
									$int_week_cnt_next = $int_week_cnt + 1;
									$fetch_intervent_days = 10 + $int_week_cnt;
									if ($int_week_cnt > 0)
									{
										$iw = 1;
										$j = 10 + $iw;
										foreach ($sel_int_week->result() as $row_int_week)
										   {
											$intervent_id = $row_int_week->intervent_id;
											$ciw_id = $row_int_week->ciw_id;
											$intervent_fortnightly 	 = $row_int_week->intervent_fortnightly;
											$patient_address 	 = $row_int_week->patient_address;
											$patient_city = $row_int_week->patient_city;
											$patient_zip_code = $row_int_week->patient_zip;
											$patient_latlang =$row_int_week->patient_latlng;
											if($intervent_fortnightly == "on"){
												$wkday = 'style="display: none;"';
												$wkday1 = 'style="display: block;"';
											}else{
												$wkday = 'style="display: block;"';
												$wkday1 = 'style="display: none;"';
											}
											$week_days = explode(",", $row_int_week->week_days); ?>

							<div class="contractcom" id = "com<?=$j?>">
                            	<label style="width: 100%;"><?php echo lang("INTERVENT::intervent_type"); ?></label>
                            	<div class="ranintervent_type">
                                <?php echo $int_type = $this->common->getinterventname($intervent_id); ?>
							<div>
							<input type="checkbox" disabled="disabled" name="suspend<?=$j?>" <?php if($row_int_week->suspendable == "1"){ ?>checked="checked"<?php } ?> />&nbsp;&nbsp;<?php echo lang('CONTRACT::non_suspendable'); ?>
							</div>
							</div>

							<div class="tags">
							<label style="width: 100%;"><?php echo lang("OPERATOR::tag"); ?></label>
							<?php
                                $tags = explode(",", $row_int_week->contract_tags);
								foreach($tags as $tags_id){
									$tag[] = $this->common->get_tag_names($tags_id);
								}
								echo $tag_name = implode(", ", $tag);
								unset($tag);
                                ?>
							</div>

							<div class="ranweekdays" <?=$wkday1?>>
							<label class="intervent_fortnightly"><input type="checkbox" disabled="disabled" name="intervent_fortnightly<?=$j?>"  id="intervent_fortnightly<?=$j?>" <?php if($intervent_fortnightly == "on"){ ?> checked="checked" <?php } ?> /><?php echo lang("CONTRACT::intervent_fortnightly"); ?></label>
							</div>

							<div class="ranweekdays weekdays<?=$j?>" <?=$wkday?>>
							<label style="width: 100%;"><?php echo lang("CONTRACT::days"); ?></label>
                                	<?php
                                	$sel_week = "select * from  week_days order by week_id ASC";
									$qry_week = mysql_query($sel_week);
									while($fet_week = mysql_fetch_assoc($qry_week)){
										$week_id = $fet_week['week_id'];
										$week_name = $fet_week['week_name']; ?>
										<input disabled="disabled" type="checkbox" name="week_days<?=$j?>[]" value="<?=$week_id?>" <?php if(in_array($week_id, $week_days)) { ?> checked="checked" <?php } ?> /><?=$week_name?>&nbsp;
									<?php } ?></div>

									<div id="hour_id<?=$j?>" style="padding-bottom: 10px;">
										<div style="padding-bottom: 10px;">
								 		<label style="width: 100%;"><?php echo ( lang("INTERVENT::standard_duration")); ?></label>
								 		<?=$row_int_week->intervent_hour?>  ( HH:MM )
								 	</div>
									</div>
				<div>
			<label style="width: 100%;"><?php echo lang("CONTRACT::patient_address"); ?></label>
			<?=$patient_address?>
		</div>
		<div style="float: left; width: 225px;">
			<label style="width: 100%;"><?php echo lang("CONTRACT::patient_city"); ?></label>
			<?php echo $patient_city; ?>
		</div>
		<div style="float: left; width: 225px;">
			<label style="width: 100%;"><?php echo lang("CONTRACT::patient_zip"); ?></label>
			<?php echo $patient_zip_code; ?>
		</div>
		<div style="float: left; width: 215px;">
			<label style="width: 100%;"><?php echo lang("CONTRACT::patient_latlng"); ?></label>
			<?php echo $patient_latlang; ?>
		</div>
									</div>
										   <?php $iw++; $j++; }
									}
                            		?>

									</div>
						</span>

						</div>
						<?php /* Ceased Details */
						$sel_ceased_det = $this->db->query("SELECT * FROM contract_ceased_details where cid = '$optval->cid' order by ceased_id DESC LIMIT 1");
						$qry_ceased_det = $sel_ceased_det->result();
						$cnt_ceased_det = $sel_ceased_det->num_rows();
						if($cnt_ceased_det > 0){
							$ceased_id = $qry_ceased_det[0]->ceased_id;
							$ceased_reopen = $qry_ceased_det[0]->ceased_reopen;
						if($ceased_reopen == '2'){
							$ceased_date = date("d-m-Y",$qry_ceased_det[0]->ceased_date);
							$ceased_reason = $qry_ceased_det[0]->ceased_reason;
							$ceased_reopen_style = 'style="display:block"';
						}else{
							$ceased_date = "";
							$ceased_reason = "";
							$ceased_reopen_style = 'style="display:none"';
						}
						}else{
							$ceased_id = '';
							$ceased_reopen = '';
							$ceased_date = "";
							$ceased_reason = "";
							$ceased_reopen_style = 'style="display:none"';
						}

						?>
						<p>
                                <label><?php echo lang("CONTRACT::ceased_date"); ?></label>
                                <span class="field">
                                	<?php echo $ceased_date; ?>&nbsp;
                                	 <span  <?=$ceased_reopen_style?>>
                                	</span>
                                </span>
                            </p>
							<p>
                                <label><?php echo lang("CONTRACT::ceased_reason"); ?></label>
                                <span class="field"><?php echo $ceased_reason; ?></span>
                          </p><?php /* End Ceased Details */ ?>
                            <p>
                                <label><?php echo lang("OPERATOR::note"); ?></label>
                                <span class="field"><?php echo $optval->note; ?></span>
                            </p>
<?php if($sedit == 1){ ?>
                            <p class="stdformbutton" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'contract/editcontract/'.$optval->cid,'<i class="icon-link"></i>&nbsp;&nbsp;'.lang("CONTRACT::edit_contract"),$attributes2); ?>
                            </p><?php } ?>
</div>
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