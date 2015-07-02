<?php $this->load->view('common/head'); ?>

<body>
<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

        <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
                            <p class="stdformbutton searchbar" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'cms/view_holidays_list','<i class="icon-backward"></i>&nbsp;&nbsp;'.lang("CMS::allholidays").'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
            <div class="pagetitle">
               <h1><?php echo lang("OPERATOR::opt_wrk_days"); ?> ( <?php echo $this->common->getoperatorfirstname($oid); ?> )</h1>

            </div>
        </div><!--pageheader-->
		<div class="datecolordetails" style="float: right;">
			<div class="selected_days" style="float: left; width: 160px; overflow: hidden;"><span style="border: 13px solid #743620;"></span>&nbsp;<?php echo lang("OPERATOR::opt_leave"); ?></div>
			<!--<div class="Holidays" style="float: left; width: 100px; overflow: hidden;"><span style="border: 13px solid green;"></span>&nbsp;<?php echo lang("OPERATOR::holiday"); ?></div>-->
			<div class="weekenddays" style="float: left; width: 125px; margin-right: 15px; overflow: hidden;"><span style="border: 13px solid yellow;"></span>&nbsp;<?php echo lang("OPERATOR::weekend_leave"); ?></div>
		</div>
        <div class="maincontent">
            <div class="maincontentinner">
            	<?php date_default_timezone_set("Asia/Kolkata"); ?>
            	<?php
            	$url = site_url($i18n.'operator/get_operator_date')."/".$oid;
            	?>
<div id="pre-select-dates" class="box" valoid="<?=$url?>"></div>
<?php
$month = date("m");
$dates = "";
$dates = array();
$qry = $this->operator_model->GetOperatorWorkingDays($oid);
foreach($qry->result() as $fet){
		$dates[] = $fet->wrk_date;
}

$cnt = count($dates);
if($cnt > 0){
	$date_imp = implode(",", $dates);
	}else{
	$date_imp = "";
	}
	/* Holidyas */
$dates_holi = "";
$dates_holi = array();
$qry_hdays = $this->operator_model->GetAllHolidays();
$cnt_holi = $qry_hdays->num_rows();
if($cnt_holi > 0){
foreach($qry_hdays->result() as $fet_holi){
	$dates_holi[] = $fet_holi->hdate.'000';
}
	$date_imp_holi = implode(",", $dates_holi);
	}else{
	$date_imp_holi = "";
	}

$pre_month = sprintf("%02s", date("m") - 1);
$next_month = sprintf("%02s", date("m") + 1);
$monthNum = sprintf("%02s", $month);
$timestamp = mktime(0, 0, 0, $monthNum, 10);
if($i18n == ""){
	$i18n = $this->lang->mci_current();
	$monthName = $this->common->GetMonthName(date("F", $timestamp));
}else{
	$i18n = $this->lang->mci_current()."/";
	$monthName = date("F", $timestamp);
}
?>
	<br><h3><?php echo lang("OPERATOR::operator_leave_list"); ?></h3>
<div class="optholidays" style="margin-top: 10px;">

<div class="widgetbox" style="width: 100%;">
	<input type="hidden" name="cmonth" id="cmonth" value="<?=$month?>" />
	<input type="hidden" name="optsiteurl" id="optsiteurl" value="<?php echo site_url($i18n.'operator/Nav_optnext/'.$oid) ?>" />
	<h4 class="widgettitle"><a class="optmprev" pre="<?=$pre_month?>" style="float: left;"> <span class="ui-icon ui-icon-circle-triangle-w">Prev</span> </a>&nbsp;&nbsp;<span style="text-align: center;width: 90%;float: left;"><?php echo $monthName; ?></span>&nbsp;&nbsp;
		<a class="optmnext" next="<?=$next_month?>" style="float: right;"> <span class="ui-icon ui-icon-circle-triangle-e">Next</span> </a></h4>
	<div class="widgetcontent">
			<table class="table">
				<tr><td><b><?php echo lang("MONTH::date"); ?></b></td>
					<td><b><?php echo lang("OPERATOR::leave_section"); ?></b></td>
					<td><b><?php echo lang("JOBASSIGN::note"); ?></b></td>
					</tr>
<?php
$optdays_array = $this->operator_model->getoperatorleavelist($oid,$month);
$cnt_optdays = count($optdays_array);
if($cnt_optdays > 0){
	foreach($optdays_array as $optdates){
						$wrk_date = substr($optdates->wrk_date, 0,-3);
					   $date = date("Y-m-d", $wrk_date);
						$mon = date("m", strtotime($date));
						if($optdates->leavetime == '1'){
							$leavetime = lang("OPERATOR::morning");
						}elseif($optdates->leavetime == '2'){
							$leavetime = lang("OPERATOR::afternoon");
						}elseif($optdates->leavetime == '3'){
							$leavetime = lang("OPERATOR::both");
						}  ?>
<tr><td><?=$date?></td><td><?=$leavetime?></td><td><?php echo $optdates->note; ?></td></tr>
					<?php } } ?>
</table>
	</div>
</div>
</div>
<br><h3><?php echo lang("CMS-HOLIDAY::holidays"); ?></h3>
<div class="holidays" style="margin-top: 10px;">
<div class="widgetbox" style="width: 100%;">
	<h4 class="widgettitle"><a class="mprev" pre="<?=$pre_month?>" style="float: left;"> <span class="ui-icon ui-icon-circle-triangle-w">Prev</span> </a>&nbsp;&nbsp;<span style="text-align: center;width: 90%;float: left;"><?php echo $monthName; ?></span>&nbsp;&nbsp;
		<a class="mnext" next="<?=$next_month?>" style="float: right;"> <span class="ui-icon ui-icon-circle-triangle-e">Next</span> </a></h4>
	<div class="widgetcontent">
			<table class="table">
				<tr><td><b><?php echo lang("MONTH::date"); ?></b></td><td><b><?php echo lang("MONTH::reason"); ?></b></td></tr>
<?php
$qry_hdays = $this->operator_model->GetAllHolidays($month);
$cnt_hdays = $qry_hdays->num_rows();
if($cnt_hdays > 0){
	foreach($qry_hdays->result() as $hdates){
		$date = $hdates->date;
		$mon = date("m", strtotime($date));
		$reason = $hdates->reason; ?>
<tr><td><?=$date?></td><td><?=$reason?></td></tr>
					<?php } } ?>
</table>
	</div>
</div>
</div>
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
<div id="edit_container" style="display: none;">
	<h4 class="widgettitle"><span><?php echo lang("OPERATOR::opt_wrk_days"); ?></span></h4>
     <div class="widgetcontent nopadding stdform stdform2">
     	<form name="operator_leave" method="post">
			<input name="sel_date" type="hidden" id = "sel_date" />
			<input name="action" type="hidden" id = "action" />
			<input name="inserturl" type="hidden" id = "inserturl" value="<?=$url?>" />
			<p>
                <label><?php echo lang("JOBASSIGN::etime"); ?><span class="rstar">*</span></label>
                <span class="field">
					<input type="radio" name="leavetime" value="1" /><?php echo lang("OPERATOR::morning"); ?> &nbsp;&nbsp;
					<input type="radio" name="leavetime" value="2" /><?php echo lang("OPERATOR::afternoon"); ?> &nbsp;&nbsp;
					<input type="radio" name="leavetime" value="3" checked="checked" /><?php echo lang("OPERATOR::both"); ?>
                </span>
			</p>
			<p>
                <label><?php echo lang("JOBASSIGN::note"); ?><span class="rstar">*</span></label>
                <span class="field">
					<textarea name="lnote" id="lnote"></textarea>
                </span>
			</p>
			<p class="stdformbutton" style="text-align:right">
				<a href="javascript:void();" onclick="operator_leave_validate();" class="btn btn-primary btn-submit"><?php echo lang("COMMON::sub_btn"); ?></a>
                 <button type="reset" class="btn" style="margin-right:75px"><?php echo lang("COMMON::reset_btn"); ?></button>
             </p>
     	</form>
     </div>
</div>
<script type="text/javascript">
	var $k = jQuery.noConflict();
	var optsiteurl = "<?php echo site_url($i18n.'operator/Nav_optnext/'.$oid) ?>";
			$k(document).ready(function(){
				var date = new Date();
				var cntt = '<?=$cnt?>';
				if(cntt > 0){
					$k('#pre-select-dates').multiDatesPicker({
						addDates: [<?=$date_imp?>],
						addDisabledDates: [<?=$date_imp_holi?>]
					});
				}else{
					$k('#pre-select-dates').multiDatesPicker({
						addDisabledDates: [<?=$date_imp_holi?>]
					});
				}


		var hide_next_month_no = jQuery('.mnext').attr('next');
		var hide_pre_month_no = jQuery('.mprev').attr('pre');
		if(hide_next_month_no > 12){
			jQuery('.mnext').hide();
		}else{
			jQuery('.mnext').show();
		}
		if(hide_pre_month_no < 1){
			jQuery('.mprev').hide();
		}else{
			jQuery('.mprev').show();
		}
	var siteurl = "<?php echo site_url($i18n.'operator/Nav_next') ?>";
  	jQuery('.mprev').click(function(){
	var pre_month_no = jQuery('.mprev').attr('pre');
	if(pre_month_no >= 1){
			jQuery.post(siteurl,
	           {month_no: ""+pre_month_no+"" },
               function(data){
               	jQuery('.holidays').html('');
               		jQuery('.holidays').html(data);
	       });
	}

	});

	jQuery('.mnext').click(function(){
		var next_month_no = jQuery(this).attr('next');
		if(next_month_no <= 12){
			jQuery.post(siteurl,
	       {month_no: ""+next_month_no+"" },
	       function(data){
	       	jQuery('.holidays').html('');
	       		jQuery('.holidays').html(data);

	   });
		}
   });

  	jQuery('.optmprev').click(function(){
	var pre_month_no = jQuery('.optmprev').attr('pre');
	if(pre_month_no >= 1){
			jQuery.post(optsiteurl,
	           {month_no: ""+pre_month_no+"" },
               function(data){
               	jQuery('.optholidays').html('');
               		jQuery('.optholidays').html(data);
	       });
	}

	});

	jQuery('.optmnext').click(function(){
		var next_month_no = jQuery(this).attr('next');
		if(next_month_no <= 12){
			jQuery.post(optsiteurl,
	       {month_no: ""+next_month_no+"" },
	       function(data){
	       	jQuery('.optholidays').html('');
	       		jQuery('.optholidays').html(data);

	   });
		}
   });
			});

function operator_leave_validate () {
	var seldate = jQuery('#sel_date').val();
	var actiontype = jQuery('#action').val();
    var leave_time = jQuery('input[name$="leavetime"]:checked').val();
    var lnote = jQuery('#lnote').val();
    var inserturl = jQuery('#inserturl').val()+"/"+seldate+"/"+actiontype+"/"+leave_time;
	jQuery.post(inserturl,
	           {lnote: ""+lnote+"" },
               function(msg){
               	if(msg != ""){
	 		alert(msg);
			var newDate = new Date(parseInt(seldate));
	 		jQuery('#pre-select-dates').multiDatesPicker('removeDates', newDate);
			jQuery("#edit_container").dialog("destroy").hide();
	 	}else{
	 		var cmonth = jQuery('#cmonth').val();
	 			jQuery.post(optsiteurl,
	       			{month_no: ""+cmonth+"" },
	       			function(data){
	       				jQuery('.optholidays').html('');
	       				jQuery('.optholidays').html(data);
	   				});
	 		jQuery("#edit_container").dialog("destroy").hide();
	 	}
	       });
}
</script>
<?php $this->load->view('common/footer'); ?>
