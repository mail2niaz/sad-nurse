<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

        <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
            <div class="pagetitle">
               <h1><?php echo lang("LEFTMENU::jobassign_report"); ?></h1>
            </div>

        </div><!--pageheader-->
<link rel="stylesheet" href="<?php echo base_url()?>css/smooth_jquery_ui.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/combo_jquery.js"></script>
        <div class="maincontent">
            <div class="maincontentinner">
            	<div class="widgetbox box-inverse span10" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo lang("LEFTMENU::jobassign_report"); ?></h4>
                <div class="widgetcontent nopadding">
 <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('',$attributes); ?>
           <div class="stdform stdform2">
                           <p>
                                <label><?php echo lang("JOBASSIGN-REPORT::pname"); ?></label>
                                <span class="field">
                                	<input type="hidden" value="" id="pid" />
                                	<select name="pid" id="report_pat" class="uniformselect">
                                    <option value="0"><?php echo lang("COMMON::choose_one"); ?></option>
                                    <?php
									$role = $this->common->getpatientlist();
										   foreach ($role as $row)
										   {
													$pid = $row->pid;
													$name = $row->pname;
													$patient_surname = $row->surname;
													$pname = $patient_surname." ".$name;
													?>
											<option value="<?=$pid?>">PID-<?=$pid?>&nbsp;(<?=$pname?>)</option>
												<?php }  ?>
                                </select></span>
                            </p>
                            <p>
                                <label><?php echo lang("JOBASSIGN-REPORT::oname"); ?></label>
                                <span class="field">
                                	<input type="hidden" value="" id="oid" />
                                	<select name="oid" id="report_opt" class="uniformselect">
                                    <option value="0"><?php echo lang("COMMON::choose_one"); ?></option>
                                    <?php
									$role = $this->common->getoperatorlist();
									$role_cnt = $role->num_rows();
										if ($role_cnt > 0)
										{
										   foreach ($role->result() as $row)
										   {
													$oid = $row->oid;
													$name = $row->firstname;
													$last_name = $row->lastname;
													$oname = $last_name." ".$name;
													?>
											<option value="<?=$oid?>">OPT-ID-<?=$oid?>&nbsp;(<?=$oname?>)</option>
												<?php } }  ?>
                                </select></span>
                            </p>
                            <p>
                                <label><?php echo lang("REPORT::entry_date"); ?></label>
                                <span class="field" style="height: 30px;">
                                <label style="float: left; width: 50px; margin: 0px; padding: 5px 0px 0px 0px;"><?php echo lang("from"); ?></label>
                                <input id="fdate" class="input-small" type="text" name="from" readonly="readonly" style="float: left;">
                                <label style="float: left; width: 50px; margin: 0px; padding: 5px 0px 0px 15px;"><?php echo lang("to"); ?></label>
                                <input id="tdate" class="input-small" type="text" name="to" readonly="readonly" style="float: left;">
                                </span>
                            </p>
                            <p class="stdformbutton" style="text-align:right">
                            <input type="button" value="<?php echo lang("COMMON::sub_btn"); ?>" style="height: 33px; margin-top: -5px;" class="btnSubmit btn btn-primary btn-submit"/>

                                <button type="reset" class="btn" style="margin-right:75px"><?php echo lang("COMMON::reset_btn"); ?></button>
                            </p>
<?php echo form_close(); ?>
                </div><!--widgetcontent-->
            </div>

<!--Search Result -->
<div class="widgetbox box-inverse span10 search_result" style="margin-left: 5px;">

</div><!--Search Result -->

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
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery('.search_result').hide();
jQuery('.btnSubmit').click(function(){
	 var pid = jQuery('#pid').val();
	 var oid = jQuery('#oid').val();
	 var from = jQuery('#fdate').val();
	 var to = jQuery('#tdate').val();
	if(pid == ""){
		var fpid = "null";
	}else{
		fpid = pid;
	}

	if(oid == ""){
		var foid = "null";
	}else{
		foid = oid;
	}

	if(from == ""){
		var ffrom = "null";
	}else{
		ffrom = from;
	}

	if(to == ""){
		var fto = "null";
	}else{
		fto = to;
	}

	 if(from != "" && to != ""){
	var url = "<?php echo site_url($i18n.'jobassign2/get_pat_opt_result') ?>/"+fpid+"/"+foid+"/"+ffrom+"/"+fto;
	 jQuery.ajax({
	 type: "POST",
	 url: url,
	 success: function(msg)
	 {
	 	jQuery('.search_result').show();
		jQuery('.search_result').html(msg);
	 }
	 });
	 }else{
	 	alert("Please Select Any one Filter Field");
	 }
 });

 });
</script>
<?php $this->load->view('common/footer'); ?>