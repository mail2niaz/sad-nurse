<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
            <div class="pagetitle">
               <h1><?php echo lang("MANUAL-INT::title"); ?></h1>
            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">

<link rel="stylesheet" href="<?php echo base_url()?>css/smooth_jquery_ui.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/out_job_assign_combo_jquery.js"></script>

            <div class="widgetbox box-inverse span9">
                <h4 class="widgettitle"><?php echo lang("MANUAL-INT::title"); ?></h4>
                <div class="widgetcontent nopadding">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div>'; <?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2', 'id' => 'forms');
           echo form_open('',$attributes); ?>
           <input type="hidden" name="fetch_patient_intervent" value="<?php echo site_url($i18n.'jobassign/fetch_patient_intervent') ?>" id="fetch_patient_intervent" />
           				<p>
                                <label><?php echo lang("CMS-HOLIDAY::date"); ?><span class="rstar">*</span></label>
                                <span class="field">
                                	<input id="cdate" class="input-large" type="text" name="cdate" readonly="readonly" value="<?php echo set_value('fdate'); ?>">
                                </span>
                            </p>
                            <p>
                                <label><?php echo lang("oname"); ?><span class="rstar">*</span></label>
                                <span class="field">
                                	<select id="filter_operator" name="filter_operator">
                            	<option value="0" selected="selected"><?php echo lang("COMMON::choose_one"); ?></option>
                                <?php $primary = $this->common->getoperatorlist_new();
									if(count($primary) > 0){
                                foreach($primary as $primary_list){
                                	$oid = $primary_list->oid;
									$fname = $primary_list->firstname;
									$lname = $primary_list->lastname;
									$name = $lname." ".$fname; ?>
									<option value="<?=$oid?>"><?=$name?> <?php echo "(".$this->common->getrolename($primary_list->role).")"; ?></option>
                              <?php } }else{ ?>
									<option value=""><?php echo lang('INTERVENT::dataempty'); ?></option>
                              <?php } ?>
                            </select></span>
                            </p>

                            <p>
                                <label><?php echo lang("pname"); ?><span class="rstar">*</span></label>
                                <span class="field">
                                	<select id="patient_id" name="patient_id">
							<option value="" selected="selected">--Select--</option>
                            <?php $pat = $this->common->getpatientlist();
							if(count($pat) > 0){
                             foreach($pat as $pats){
                            	$pid = $pats->pid;
								$pname = $pats->pname;
								$surname = $pats->surname;
								?>
								<option <?php if(set_value('patient_id') == $pid){ ?> selected="selected" <?php } ?> value="<?=$pid?>">PID-<?=$pid?>(<?php echo $surname." ".$pname; ?>)</option>
                          	<?php } }else{ ?>
								<option value=""><?php echo lang('INTERVENT::dataempty'); ?></option>
                        	<?php } ?>
							</select>
                                </span>
                            </p>

                            <p>
                                <label><?php echo lang("mintervent"); ?><span class="rstar">*</span></label>
                                <span class="field">
                                	<select id="filter_district" name="filter_district">
								<option value="" selected="selected"><?php echo lang("JOBASSIGN::select"); ?></option>
								</select>

                                </span>
                            </p>

                            <p class="stdformbutton" style="text-align:right">
                                <input type="button" class="btn btn-primary btn-submit" onclick="getjobdetail();" value="<?php echo lang("COMMON::sub_btn"); ?>">
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo lang("COMMON::reset_btn"); ?></button>
                            </p>
<?php echo form_close(); ?>
                </div><!--widgetcontent-->
            </div><!--widget-->
<div class="cccc" style="float: left; width: 100%;"></div>

            </div><!--maincontentinner-->
        </div><!--maincontent-->

    </div><!--rightpanel-->

</div><!--mainwrapper-->
<script type="text/javascript">
	function getjobdetail () {
		var seldate = jQuery('#cdate').val();
		var oid = jQuery('#filter_operator').val();
		var pid = jQuery('#patient_id').val();
		var intid = jQuery('#filter_district').val();
		if(seldate != '' && oid != '0') {
		var siteurl = "<?php echo site_url($i18n.'jobassign2/getmanualintform') ?>";
			jQuery.post(siteurl,
	           { sdate: ""+seldate+"", oid: ""+oid+"",pid: ""+pid+"",intid: ""+intid+"" },
               function(data){
               	if(data != ''){
               		jQuery('.cccc').html('');
               		jQuery('.cccc').html(data);
               	}else{
               		jQuery('.cccc').html('');
               	}

	       });
	       }
	}
</script>
<?php $this->load->view('common/footer'); ?>