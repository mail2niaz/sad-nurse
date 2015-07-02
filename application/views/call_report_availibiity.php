<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

        <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
            <div class="pagetitle">
               <h1><?php echo lang("CALL-REPORT::title"); ?></h1>
            </div>

        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">
            	<div class="widgetbox box-inverse span10" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo lang("CALL-REPORT::title"); ?></h4>
                <div class="widgetcontent nopadding">
 <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('',$attributes); ?>
           <div class="stdform stdform2">
                            <p>
                              <label><?php echo lang("CALL-REPORT::date"); ?><span class="rstar">*</span></label>
                                <span class="field">
                                	<?php echo lang("from"); ?> &nbsp;
                                	<input id="fdate" class="input-large" type="text" name="fdate" readonly="readonly">&nbsp;
                                	<?php echo lang("to"); ?>&nbsp;
                                	<input id="tdate" class="input-large" type="text" name="tdate" readonly="readonly">
                                </span>
                            </p>
                            <p>
                              <label><?php echo lang("CALL-REPORT::time"); ?><span class="rstar">*</span></label>
                                <span class="field">
                                	<?php echo lang("from"); ?> &nbsp;
                                	<select name="hourcombo" class="hourcombo combo" id="fhourcombo">
	                            	<option value="0">00</option>
                            	<?php for($st = 6; $st <= 22; $st++ ){ ?>
     								<option value="<?=$st?>"><?php echo $this->common->commontimeformat($st);?></option>
                            	<?php } ?>
							</select>
							<select name="mincombo" class="mincombo combo" id="fmincombo">
	<?php for($mt = 0; $mt <= 55; $mt = $mt+5 ){ ?>
     								<option value="<?=$mt?>"><?php echo $this->common->commontimeformat($mt);?></option>
                            	<?php } ?>
</select>(HH:MM)
                                	&nbsp;
                                	<?php echo lang("to"); ?>&nbsp;
                                	<select name="hourcombo" class="hourcombo combo" id="thourcombo">
	                            	<option value="0">00</option>
                            	<?php for($st = 6; $st <= 22; $st++ ){ ?>
     								<option value="<?=$st?>"><?php echo $this->common->commontimeformat($st);?></option>
                            	<?php } ?>
							</select>
							<select name="mincombo" class="mincombo combo" id="tmincombo">
	<?php for($mt = 0; $mt <= 55; $mt = $mt+5 ){ ?>
     								<option value="<?=$mt?>"><?php echo $this->common->commontimeformat($mt);?></option>
                            	<?php } ?>
</select>(HH:MM)
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
	 var startDate = jQuery('#fdate').val();
	 var endDate = jQuery('#tdate').val();
	 var fhourcombo = jQuery('#fhourcombo').val();

	 var thourcombo = jQuery('#thourcombo').val();
	 var fmincombo = jQuery('#fmincombo').val();
	 var tmincombo = jQuery('#tmincombo').val();
	 var message = '<?php echo lang("CALL-REPORT::select_all_fields"); ?>';

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
	var url = "<?php echo site_url($i18n.'jobassign2/get_call_report_result') ?>/"+fstartDate+"/"+fendDate+"/"+fhourcombo+"/"+thourcombo+"/"+fmincombo+"/"+tmincombo;
//	alert(url);

	if(startDate != "" && endDate != "" && fhourcombo != "0" && thourcombo != "0"){
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