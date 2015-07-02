<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

        <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
            <div class="pagetitle">
               <h1><?php echo lang("LEFTMENU::jobassign_week_report"); ?></h1>
            </div>

        </div><!--pageheader-->

        	<link rel="stylesheet" href="<?php echo base_url()?>css/smooth_jquery_ui.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/combo_jquery.js"></script>
        <div class="maincontent">
            <div class="maincontentinner">
            	<div class="widgetbox box-inverse span10" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo lang("LEFTMENU::jobassign_week_report"); ?></h4>
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
                                	<input class="input-large week-picker" type="text" name="fdate" readonly="readonly">&nbsp;<br><br>
                                	<?php echo lang("from"); ?> &nbsp;
                                	<input id="startDate" class="input-large" type="text" name="fdate" readonly="readonly">&nbsp;
                                	<?php echo lang("to"); ?>&nbsp;
                                	<input id="endDate" class="input-large" type="text" name="tdate" readonly="readonly">
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

	var startDate;
    var endDate;
    var selectCurrentWeek = function () {
        window.setTimeout(function () {
            jQuery('.week-picker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
        }, 1);
    }
    var $weekPicker = jQuery('.week-picker');

    function updateWeekStartEnd() {
        var date = $weekPicker.datepicker('getDate') || new Date();
        startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay()+1);
        endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 7);
    }

    updateWeekStartEnd();

    function updateDateText(inst) {
       // var dateFormat = inst != 'start' &&  inst.settings.dateFormat ? inst.settings.dateFormat : $.datepicker._defaults.dateFormat;
         var dateFormat = "dd-mm-yy";
        console.log( dateFormat)
        jQuery('#startDate').val(jQuery.datepicker.formatDate(dateFormat, startDate, inst.settings));
       jQuery('#endDate').val(jQuery.datepicker.formatDate(dateFormat, endDate, inst.settings));
    }

    updateDateText('start');

    $weekPicker.datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        showWeek: true,
        defaultDate: "+1w",
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		firstDay: 1,
        onSelect: function (dateText, inst) {
            updateWeekStartEnd();
            updateDateText(inst);
            selectCurrentWeek();
        },
        beforeShowDay: function (date) {
            var cssClass = '';
            if (date >= startDate && date <= endDate) cssClass = 'ui-datepicker-current-day';
            return [true, cssClass];
        },
        onChangeMonthYear: function (year, month, inst) {
            selectCurrentWeek();
        }
    });

    selectCurrentWeek();

    jQuery('.week-picker .ui-datepicker-calendar tr').on('mousemove', function () {
        $(this).find('td a').addClass('ui-state-hover');
    });
    jQuery('.week-picker .ui-datepicker-calendar tr').on('mouseleave', function () {
        $(this).find('td a').removeClass('ui-state-hover');
    });

jQuery('.search_result').hide();
jQuery('.btnSubmit').click(function(){
	 var startDate = jQuery('#startDate').val();
	 var endDate = jQuery('#endDate').val();
	 var oid = jQuery('#oid').val();

	if(oid == ""){
		var foid = "null";
	}else{
		foid = oid;
	}

	var url = "<?php echo site_url($i18n.'jobassign2/get_week_report_result') ?>/"+startDate+"/"+endDate+"/"+foid;
	 jQuery.ajax({
	 type: "POST",
	 url: url,
	 success: function(msg)
	 {
	 	//jQuery('#pid').val('');
	 	//jQuery('#oid').val('');
	 	jQuery('.search_result').show();
		jQuery('.search_result').html(msg);
	 }
	 });
 });

 });
</script>
<?php $this->load->view('common/footer'); ?>