<?php $this->load->view('common/head'); ?>
<body>
	<div id="mainwrapper" class="mainwrapper">
		<?php $this->load->view('common/header'); ?>
		<?php $this->load->view('common/left_menu'); ?>
		<div class="rightpanel">
			<?php $this->load->view('breadcrumb'); ?>
			<div class="pageheader">
				<p class="stdformbutton searchbar" style="text-align:right">
					<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'admin_session_setup','<i class="icon-backward"></i>&nbsp;&nbsp;'.lang("ADMIN-SESSION-SETUP::session_list").'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
				</p>
				 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

				<div class="pagetitle">
				<h1><?php echo lang($title_val); ?></h1>
				</div>
			</div><!--pageheader-->
			<div class="maincontent">
				<div class="maincontentinner">
					<div class="widgetbox box-inverse span10" style="margin-left: 5px;">
						<h4 class="widgettitle"><?php echo lang($title_val); ?></h4>
						<div class="widgetcontent nopadding">
							<link rel="stylesheet" href="<?php echo base_url()?>css/smooth_jquery_ui.css" />
							<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui-1.10.3.min.js"></script>
							<script type="text/javascript" src="<?php echo base_url()?>js/combo_jquery.js"></script>
							<?php
							if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
							<?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>
							 
							<?php 
							$attributes = array('class' => 'stdform stdform2');
							$url = $i18n.'admin_session_setup/edit_admin_session_setup/'.$optval->id;
							echo form_open($url,$attributes); ?>
							<?php echo form_hidden('id',$optval->id); ?>
                            <p>
                                <label><?php echo lang("ADMIN-SESSION-SETUP::morn_start_time"); ?></label>
                               
                            </p>
							<div class="jobautocomp">
								<label><?php echo ( sprintf( lang("ADMIN-SESSION-SETUP::start_time")) ); ?><span class="rstar">*</span></label>
								<span class="field">
								<input type="hidden" name="start_hid_hour" id="start_hid_hour" />
								<input type="hidden" name="start_hid_min" id="start_hid_min" />
								<select name="morn_start_time" class="hourcombo combo" id="hourcombo">
								<option value="<?php echo $optval->morn_start_time;?>"><?php echo $optval->morn_start_time ?></option>
								<?php for($st = 6; $st <= 22; $st++ ){ ?>
								<option value="<?=$st?>"><?php echo $this->common->commontimeformat($st);?></option>
								<?php } ?>
								</select><span style="font-size:16px;">00</span>
								(HH:MM)</span>
							</div>
							<div class="jobautocomp">
								<label><?php echo ( sprintf( lang("ADMIN-SESSION-SETUP::end_time")) ); ?><span class="rstar">*</span></label>
								<span class="field">
								<input type="hidden" name="end_hid_hour" id="end_hid_hour" />
								<input type="hidden" name="end_hid_min" id="end_hid_min" />
								<select name="morn_end_time" class="endhourcombo" id="endhourcombo" onchange="change_end_time(this.value,'endhourcombo')">
								<option value="<?php echo $optval->morn_end_time;?>"><?php echo $optval->morn_end_time ?></option>
								<?php for($eht = 6; $eht <= 22; $eht++ ){ ?>
								<option value="<?=$eht?>"><?php echo $this->common->commontimeformat($eht);?></option>
								<?php } ?>
								</select><span style="font-size:16px;">59</span>
								(HH:MM)</span>
								</span>
							</div>
							
                            <p class="stdformbutton" style="text-align:right">
                                <button name="update" class="btn btn-primary btn-submit"><?php echo lang("COMMON::sub_btn"); ?></button>
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo lang("COMMON::reset_btn"); ?></button>
                            </p>
							<?php echo form_close(); ?>
						</div><!--widgetcontent-->
					</div><!--widget-->
				</div><!--maincontentinner-->
			</div><!--maincontent-->
		</div><!--rightpanel-->
	</div><!--mainwrapper-->
	<?php $this->load->view('common/footer'); ?>
</body>