<?php $this->load->view('common/head'); ?>
<body>
	<div id="mainwrapper" class="mainwrapper">
		<?php $this->load->view('common/header'); ?>
		<?php $this->load->view('common/left_menu'); ?>
		<div class="rightpanel">
			<?php $this->load->view('breadcrumb'); ?>
			<div class="pageheader">
				<p class="stdformbutton searchbar" style="text-align:right">
					<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'contract','<i class="icon-backward"></i>&nbsp;&nbsp;'.lang("ADMIN-WEBSERVICE::webservice_list").'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
				</p>
				 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

				<div class="pagetitle">
				<h1><?php echo ( sprintf( lang("LEFTMENU::add_webservice")) ); ?></h1>
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
							<?php $attributes = array('class' => 'stdform stdform2');
							echo form_open($i18n.'admin_webservice/add_webservice_url',$attributes);
							echo form_hidden('tid',$stype);
							echo form_hidden('aid',$aid);
							?>
			
                            <p>

                               
                            </p>
                                          <input type="hidden" name="action_url" id="action_url" value="<?php ?>">
							<div class="jobautocomp">
								<label><?php echo ( sprintf( lang("ADMIN-WEBSERVICE::url")) ); ?><span class="rstar">*</span></label>
								<span class="field">
								<input type="text" name="url" id="url" />
							</div>
												
                            <p class="stdformbutton" style="text-align:right">
                                <button name="update" class="btn btn-primary btn-submit" onclick="return check_webservice_url();"><?php echo lang("COMMON::sub_btn"); ?></button>
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
