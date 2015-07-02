<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

        <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
            <div class="pagetitle">
               <h1><?php echo lang("JOBASSIGN-KM-REPORT::km_opt_usg"); ?></h1>
            </div>

        </div><!--pageheader-->
        	<link rel="stylesheet" href="<?php echo base_url()?>css/smooth_jquery_ui.css" />

        <div class="maincontent">
            <div class="maincontentinner">
            	<div class="widgetbox box-inverse span10" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo lang("JOBASSIGN-KM-REPORT::km_opt_usg"); ?></h4>
                <div class="widgetcontent nopadding">
 <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('',$attributes); ?>
           <div class="stdform stdform2">

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
                                <label><?php echo lang("JOBASSIGN-WEEK-REPORT::choose_week"); ?><span class="rstar">*</span></label>
                                <span class="field">
                                	<?php echo lang("from"); ?> &nbsp;
                                	<input id="fdate" class="input-large" type="text" name="fdate" readonly="readonly">&nbsp;
                                	<?php echo lang("to"); ?>&nbsp;
                                	<input id="tdate" class="input-large" type="text" name="tdate" readonly="readonly">
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
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/combo_jquery.js"></script>
        <script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.search_result').hide();
	jQuery('.btnSubmit').click(function(){
	 var startDate = jQuery('#fdate').val();
	 var endDate = jQuery('#tdate').val();
	 var oid = jQuery('#oid').val();
	 var message = '<?php echo lang("JOBASSIGN-KM-REPORT::select_operator"); ?>';
	/*
	if(oid == ""){
		var foid = "null";
	}else{
		foid = oid;
	}
*/
	if(startDate == ""){
		fstartDate = "null";
	}else{
		fstartDate = startDate;
	}
	if(endDate == ""){
		fendDate = "null";
	}else{
		fendDate = endDate;
	}
	var url = "<?php echo site_url($i18n.'jobassign2/get_km_report_result') ?>/"+fstartDate+"/"+fendDate+"/"+oid;
	if(oid != ""){
	 jQuery.ajax({
	 type: "POST",
	 url: url,
	 success: function(msg)
	 {
	 	jQuery('#oid').val(oid);
	 	jQuery('.search_result').show();
		jQuery('.search_result').html(msg);
	 }
	 });
	}else{
		alert(message);
	}
 });

jQuery( "#fdate" ).datepicker({
defaultDate: "+1w",
dateFormat: 'dd-mm-yy',
changeMonth: true,
changeYear: true,
firstDay: 1,
onClose: function( selectedDate ) {
jQuery( "#tdate" ).datepicker( "option", "minDate", selectedDate );
}
});
jQuery( "#tdate" ).datepicker({
defaultDate: "+1w",
dateFormat: 'dd-mm-yy',
changeMonth: true,
changeYear: true,
firstDay: 1,
onClose: function( selectedDate ) {
jQuery( "#fdate" ).datepicker( "option", "maxDate", selectedDate );
}
});
 });
</script>
<?php $this->load->view('common/footer'); ?>