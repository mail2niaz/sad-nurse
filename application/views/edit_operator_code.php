<?php $this->load->view('common/head'); ?>
<body>
	<div id="mainwrapper" class="mainwrapper">
		<?php $this->load->view('common/header'); ?>
		<?php $this->load->view('common/left_menu'); ?>
		<div class="rightpanel">
			<?php $this->load->view('breadcrumb'); ?>
			<div class="pageheader">
				
				 

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
							<?php $attributes = array('class' => 'stdform stdform2');
							 $url = $i18n.'intervent/edit_operator_code/'.$optval->id.'/'.$this->uri->segment(4,0);
                                           echo form_open($url,$attributes);
							 echo form_hidden('id',$optval->id);
							 
							$id_job = $this->uri->segment(3,0);
							$id_job_code = $this->uri->segment(4,0);
                                          $job_code_oper = $this->intervent_model->getintertype_job_code($id_job); 
							?>
			
                            <p>
                               
                            </p>
                                         
                                          <input type="hidden" name="id_job" id="id_job" class="input-xxlarge" value="<?php echo $optval->id_job; ?>" />

							<div class="jobautocomp">
								<label><?php echo lang("INTERVENT::code_op1"); ?></label>
								<span class="field"><input type="text" name="code_op1" id="code_op1" class="input-xxlarge" value="<?php echo $optval->code_op1; ?>"  /></span>
							</div>
							<div class="jobautocomp">
								<label><?php echo lang("INTERVENT::code_op2"); ?></label>
								<span class="field"><input type="text" name="code_op2" id="code_op2" class="input-xxlarge" value="<?php echo $optval->code_op2; ?>"  /></span>
							</div>
							<div class="jobautocomp">
								<label><?php echo lang("INTERVENT::code_op3"); ?></label>
								<span class="field"><input type="text" name="code_op3" id="code_op3" class="input-xxlarge" value="<?php echo $optval->code_op3; ?>"  /></span>
							</div>
							
                            <p class="stdformbutton" style="text-align:right">

                                 <input type="submit" class="btn btn-primary btn-submit" name="mysubmit" value="<?php echo ( sprintf( lang("INTERVENT::add_intervent_op_code")) ); ?>">
                               
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
