<?php $this->load->view('common/head'); ?>
<body>
<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">
        <?php $this->load->view('breadcrumb'); ?>
        <div class="pageheader">
            <div class="pagetitle">
               <h1><?php echo ( sprintf( lang("JOBASSIGN::joblist")) ); ?></h1>

            </div>
        </div><!--pageheader-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>css/smooth_jquery_ui.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/out_job_assign_combo_jquery.js"></script>
   <script src="<?php echo base_url()?>js/jquery.mousewheel.js"></script>
<?php
$year = date("Y");
$week = date("W");

$cur_date = strtotime(date("d-m-Y"));
if(strlen(($week - 1)) == 1){
		$back_weeknumber = "0".($week - 1);
	}else{
		$back_weeknumber = $week - 1;
	}
	if(strlen(($week + 1)) == 1){
		$next_weeknumber = "0".($week + 1);
	}else{
		$next_weeknumber = $week + 1;
	}
/* End wc-today */
?>
        <div class="maincontent">
            <div class="maincontentinner">
            	<div class="widgetbox box-inverse span10 filterbox" style="margin: 0px; width: 100%;">
            		<h4 class="widgettitle"><?php echo ( sprintf( lang("JOBASSIGN::filter_option")) ); ?></h4>
					<div class="widgetcontent stdform stdform2 jobassign">
						<form name="joblist" action="">
						<div style="width: 100%; overflow: hidden; height: 70px;">
<div class="opt_box" style="float: left; width: 300px;">
						   <label><?php echo ( sprintf( lang("JOBASSIGN::filter_operator")) ); ?></label>
						   <p>
						   	<input type="hidden" name="newsiteurl_nav" value="<?php echo site_url($i18n.'jobassign_filter/jobfilter') ?>" id = "newsiteurl_nav"/>
						   	<input type="hidden" name="deleteyellowboxurl" value="<?php echo site_url($i18n.'jobassign/deleteyellowbox') ?>" id = "deleteyellowboxurl"/>
						   	<input type="hidden" name="deletemovenav_url" value="<?php echo site_url($i18n.'jobassign_nav/navigation'); ?>" id="deletemovenav_url" />
						   	<select id="filter_operator" name="filter_operator">
                            	<option value="0" selected="selected"><?php echo ( sprintf( lang("COMMON::choose_one")) ); ?></option>
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
                            </select>
                           <!-- <span style="margin-left: 35px;">(<?php echo ( sprintf( lang("JOBASSIGN::filter_sch_only")) ); ?>)</span>-->
						   </p></div>

<div class="pat_box" style="float: left; width: 300px;">
						   <label><?php echo ( sprintf( lang("JOBASSIGN::filter_patient")) ); ?></label>
						    <p>
						   	<select id="filter_patient" name="filter_patient">
							<option value="0" selected="selected"><?php echo ( sprintf( lang("COMMON::choose_one")) ); ?></option>
                            <?php $pat = $this->common->getpatientlist();
							if(count($pat) > 0){
                             foreach($pat as $pats){
                            	$pid = $pats->pid;
								$pname = $pats->pname;
								$surname = $pats->surname;
								?>
								<option value="<?=$pid?>">PID-<?=$pid?>(<?php echo $surname." ".$pname?>)</option>
                          	<?php } }else{ ?>
								<option value=""><?php echo lang('INTERVENT::dataempty'); ?></option>
                        	<?php } ?>
							</select>
						 </p></div>
						 <div class="dist_box" style="float: left; width: 300px;">
						   <label><?php echo ( sprintf( lang("JOBASSIGN::filter_district")) ); ?></label>
						   <p>
						   	<select id="filter_district" name="filter_district">
							<option value="0" selected="selected"><?php echo ( sprintf( lang("COMMON::choose_one")) ); ?></option>
                            <?php $dist = $this->common->districtlist_new();
							if(count($dist) > 0){
                             foreach($dist as $dist_list){
                            	$did = $dist_list->did;
								$dist_name = $dist_list->dist_name;?>
								<option value="<?=$did?>"><?=$dist_name?></option>
                          	<?php } }else{ ?>
								<option value=""><?php echo lang('INTERVENT::dataempty'); ?></option>
                        	<?php } ?>
							</select>
						 </p>
</div>
						 </div>

						 <div style="width: 100%; overflow: hidden; height: 70px;">
						 	<div class="status_box" style="float: left; width: 300px;">
						   <label><?php echo ( sprintf( lang("JOBASSIGN::filter_status")) ); ?></label>
						   <p>
						   	<select id="filter_box_status" name="filter_box_status">
							<option value="0" selected="selected"><?php echo ( sprintf( lang("COMMON::choose_one")) ); ?></option>
                            <option value="g"><?php echo lang("JOBASSIGN::green"); ?></option>
                            <option value="y"><?php echo lang("JOBASSIGN::yellow"); ?></option>
							</select>
						 </p>
</div>
<input type="hidden" name="navweek" id="navweek" value="<?=$week?>" />
<input type="hidden" name="navyear" id="navyear" value="<?=$year?>" />
<input type="button" class="btn btn-rounded btn-primary btn-submit" id="filter_sub" onclick="return filter_submit();" value="<?php echo ( sprintf( lang("COMMON::sub_btn")) ); ?>" style="padding: 7px; margin-top: 20px;" />
<input type="reset" class="btn btn-rounded btn-primary btn-submit" id="filter_sub" onclick="return restbtn();" value="<?php echo ( sprintf( lang("COMMON::reset_btn")) ); ?>" style="margin-top: 20px; padding: 7px;" />
                    <!-- <a onClick="window.location.reload( true );" style="margin-top: 20px;" class="btn"><?php echo ( sprintf( lang("COMMON::reset_btn")) ); ?></a> -->
			</div>						 </form>
					</div>
            		</div>

<link rel='stylesheet' type='text/css' href='<?php echo base_url()?>css/jquery.weekcalendar.css' />
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>

<script type="text/javascript">
	function add_job_popup (w,y) {
		$('#LoadingImage').show();
	var $about = $("#event_edit_container");
				  $.post("<?php echo site_url($i18n.'jobassign/add_job') ?>/"+w+"/"+y,
				  function (data) {
				  	$('#LoadingImage').hide();
				       $("#event_edit_container").html(data);
				       $about.dialog({
				         title: "<?php echo ( sprintf( lang("JOBASSIGN::assignjob")) ); ?>",
				         width: 900,
				         top: 0,
				         closeOnEscape: true,
				         position:'center',
				         close: function() {
				            $about.dialog("destroy").hide();
				            //$about.hide();
				           //location.reload();
				         },
				         buttons: {
				            close : function() {
				               $about.dialog("close");
				            }
				         }
				      }).show();
							  });

				 }

		function editpopupform (w,y,aid) {
			$('#LoadingImage').show();
	var $about = $("#event_edit_container");
				  $.post("<?php echo site_url($i18n.'jobassign/edit_jobassign_popup') ?>/"+w+"/"+y+"/"+aid,
				  function (data) {
				  	$('#LoadingImage').hide();
				       $("#event_edit_container").html(data);
				       $about.dialog({
				         title: "<?php echo ( sprintf( lang("JOBASSIGN::editassignjob")) ); ?>",
				         width: 900,
				         closeOnEscape: true,
				         position:'center',
				         close: function() {
				            $about.dialog("destroy").hide();
				            $about.hide();
				         },
				         buttons: {
				            close : function() {
				               $about.dialog("close");
				            }
				         }
				      }).show();
				});
				 }
	function reassign (week,year,oid, jobdate, section, type) {
		$('#LoadingImage').show();
	var $about = $("#event_edit_container");
				  $.post("<?php echo site_url($i18n.'jobassign/reassign_job') ?>/"+week+"/"+year+"/"+oid+"/"+jobdate+"/"+section+"/"+type,
				  function (data) {
				  	$('#LoadingImage').hide();
				       $("#event_edit_container").html(data);
				       $about.dialog({
				         title: "<?php echo ( sprintf( lang("JOBASSIGN::reassign_job")) ); ?>",
				         width: 900,
				         top: 0,
				         closeOnEscape: true,
				         position:'center',
				         close: function() {
				            $about.dialog("destroy").hide();
				         },
				         buttons: {
				            close : function() {
				               $about.dialog("close");
				            }
				         }
				      }).show();
							  });

				 }
	function movejob (oid, week, year) {
		$('#LoadingImage').show();
	var $about = $("#event_edit_container");
				  $.post("<?php echo site_url($i18n.'jobassign/move_job') ?>/"+oid+"/"+week+"/"+year,
				  function (data) {
				  	$('#LoadingImage').hide();
				       $("#event_edit_container").html(data);
				       $about.dialog({
				         title: "<?php echo ( sprintf( lang("JOBASSIGN::move_job")) ); ?>",
				         width: 900,
				         top: 0,
				         closeOnEscape: true,
				         position:'center',
				         close: function() {
				            $about.dialog("destroy").hide();
				         },
				         buttons: {
				            close : function() {
				               $about.dialog("close");
				            }
				         }
				      }).show();
							  });

				 }


	</script>
	<div>
		<div id="field_loader" style="display: none; float: left; padding-left: 350px;"><img src="<?php echo base_url()?>images/486.GIF" height="1"/></div>
	</div>

	<div id='calendar1'>
		<a href="<?php echo site_url($i18n.'jobassign_filter/planningexport/0/0/0/0/'.$week."/".$year) ?>" class="btn btn-rounded btn-primary btn-submit"><?php echo lang("JOBASSIGN::export_to_excel"); ?></a>&nbsp;
		<span style="color: red; font-size: 20px;"><?php echo $this->common->datei18tranlabel(strtotime(date('d-M-Y', strtotime($year."W".$week.'1')))); ?> - <?php echo $this->common->datei18tranlabel(strtotime(date('d-M-Y', strtotime($year."W".$week.'7')))); ?></span>
<div style="float: left; width: 100%;">
            			<div class="hideshowbtn" style="float: left;">
            			<a href="javascript:void(0)" style="display: none;" class = "btn btn-rounded btn-primary btn-submit showopt" onclick="return filterdisplay('show')"><?php echo lang("JOBASSIGN::showfilter"); ?></a>
            			<a href="javascript:void(0)" class = "btn btn-rounded btn-primary btn-submit hideopt" onclick="return filterdisplay('hide')"><?php echo lang("JOBASSIGN::hidefilter"); ?></a></div>

            			<div class="add_copy_job">
            			<a href="javascript:void(0)" class = "btn btn-rounded btn-primary btn-submit" onclick="return add_job_popup('<?=$week?>','<?=$year?>')" style="float: right;"><i class="icon-backward"></i>&nbsp;&nbsp;<?php echo lang("JOBASSIGN::add_new_job"); ?>&nbsp;&nbsp;<i class="icon-forward"></i></a>&nbsp;&nbsp;
            			<input type="hidden" name="copyweek" value="<?php echo site_url($i18n.'jobassign_filter/jobfilter') ?>" id = "copyweek"/>
            			<a href="javascript:void(0)" class = "btn btn-rounded btn-primary btn-submit" onclick="return copyweek('<?=$week?>','<?=$year?>')" style="margin-right: 10px;"><i class="icon-backward"></i>&nbsp;&nbsp;<?php echo lang("JOBASSIGN::copy_week"); ?>&nbsp;&nbsp;<i class="icon-forward"></i></a>
            			</div>
<div class="navbtn">
<div class="scrollbar">
<select id="optid" onchange="return scrollfunc(this.value);">
	<option value="" selected="selected"><?php echo ( sprintf( lang("COMMON::choose_one")) ); ?></option>
	<?php $primary = $this->common->getoperatorlist_new();
	if(count($primary) > 0){
foreach($primary as $primary_list){
	$oid = $primary_list->oid;
	$fname = $primary_list->firstname;
	$lname = $primary_list->lastname;
	$name = $lname." ".$fname; ?>
	<option value="#<?=$oid?>"><?=$name?> <?php echo "(".$this->common->getrolename($primary_list->role).")"; ?></option>
    <?php } } ?>
</select>
</div>
<div class="navicon">
		<a href="javascript:void(0)" class="btn btn-rounded btn-primary btn-submit" onclick="return navigation('<?=$back_weeknumber?>','<?=$year?>','0','0','0','0')"><?php echo lang("JOBASSIGN::prev"); ?></a>
		<a href="javascript:void(0)" class="btn btn-rounded btn-primary btn-submit" onclick="return navigation('<?=$next_weeknumber?>','<?=$year?>','0','0','0','0')"><?php echo lang("JOBASSIGN::next"); ?></a>

</div></div>
            		</div>
		<div class="wc-container">
			<div id="LoadingImage" style="display: none; float: left"><img src="<?php echo base_url()?>images/486.GIF" height="1"/></div>

	<table class="wc-header">
		<tbody>
			<tr>
				<td class="wc-time-column-header"></td><td class="wc-day-column-header wc-day-1"><?php echo ( sprintf( lang("WEEKDAYS::mon")) ); ?>
				<br>
				<?php echo $this->common->datei18tran(strtotime(date('M-d, Y', strtotime($year."W".$week.'1')))); ?></td><td class="wc-day-column-header wc-day-2"><?php echo ( sprintf( lang("WEEKDAYS::tue")) ); ?>
				<br>
				<?php echo $this->common->datei18tran(strtotime(date('M-d,Y', strtotime($year."W".$week.'2')))); ?></td><td class="wc-day-column-header wc-day-3"><?php echo ( sprintf( lang("WEEKDAYS::wed")) ); ?>
				<br>
				<?php echo $this->common->datei18tran(strtotime(date('M-d,Y', strtotime($year."W".$week.'3')))); ?></td><td class="wc-day-column-header wc-day-4"><?php echo ( sprintf( lang("WEEKDAYS::thu")) ); ?>
				<br>
				<?php echo $this->common->datei18tran(strtotime(date('M-d,Y', strtotime($year."W".$week.'4')))); ?></td><td class="wc-day-column-header wc-day-5"><?php echo ( sprintf( lang("WEEKDAYS::fri")) ); ?>
				<br>
				<?php echo $this->common->datei18tran(strtotime(date('M-d,Y', strtotime($year."W".$week.'5')))); ?></td><td class="wc-day-column-header wc-day-6"><?php echo ( sprintf( lang("WEEKDAYS::sat")) ); ?>
				<br>
				<?php echo $this->common->datei18tran(strtotime(date('M-d,Y', strtotime($year."W".$week.'6')))); ?></td><td class="wc-day-column-header wc-day-7"><?php echo ( sprintf( lang("WEEKDAYS::sun")) ); ?>
				<br>
				<?php echo $this->common->datei18tran(strtotime(date('M-d,Y', strtotime($year."W".$week.'7')))); ?></td><td class="wc-scrollbar-shim"></td>
			</tr>
		</tbody>
	</table>
	<div class="wc-scrollable-grid" style="height: 500px;">
		<table class="wc-time-slots">
			<tbody>
				<?php
				$while_loop = array();
				$sel_opt = "SELECT * FROM operators where status = '1'";
				$qry_opt = mysql_query($sel_opt);
				while($fet_opt = mysql_fetch_assoc($qry_opt)){
					$while_loop[] = $fet_opt;
				}

				foreach($while_loop as $fet_opt){
					$oid = $fet_opt['oid'];
					$optname = $fet_opt['lastname']." ".$fet_opt['firstname'];  ?>
				<tr class="optbox" id="<?=$oid?>">
					<td><fieldset style="border: 1px solid; padding: 5px; background-color: rgb(182, 215, 168);">
  <legend style="color: #333333; display: block; font-size: 21px; width: auto;"><?=$optname?></legend>
				<table style="width: 100%;"><tr>
					<?php for($d = 1; $d <= 7; $d++){
						$jobdate = strtotime($year."W".$week.$d);
						$opt_leave = $this->jobassign_model->getoperatorleave($oid,$jobdate);
						if($opt_leave == '1'){
							$morleaveclass = 'style="background-color: red;"';
							$afterleaveclass = 'style="background-color: #FFFFFF;"';
						}elseif($opt_leave == '2'){
							$afterleaveclass = 'style="background-color: red !important;"';
							$morleaveclass = 'style="background-color: #FFFFFF;"';
						}elseif($opt_leave == '3'){
							$afterleaveclass = 'style="background-color: red !important;"';
							$morleaveclass = 'style="background-color: red !important;"';
						}else{
							$morleaveclass = 'style="background-color: #FFFFFF;"';
							$afterleaveclass = 'style="background-color: #FFFFFF;"';
						}
						?>
<td class="wc-day-column day-<?=$d?> morning">
	<div class="wc-day-column-inner ui-droppable schedule">
						<div class="wc-cal-event ui-corner-all" <?=$morleaveclass?>>
							<div class="wc-time ui-corner-all"><span><?=lang("OPERATOR::morning")?></span><i class="icon-share" onclick="reassign('<?=$week?>','<?=$year?>','<?=$oid?>', '<?=$jobdate?>','1')"></i></div>
							<div class="wc-title" title="">
								<ul class="jobpatientlist">
									<?php
									$moring_sel = $this->jobassign_model->getmorningafterjoblist($oid, $jobdate,'1');
									foreach($moring_sel as $fet_morning){
										$aid = $fet_morning->aid;
										$patient_id = $fet_morning->patient_id;
										$pname_over = $this->common->getpatientname($patient_id);
										if(strlen($pname_over) > 12){
											$pname = substr($this->common->getpatientfsurname($patient_id),0,12);
										}else{
											$pname = $pname_over;
										}
										$start_time_hour = $this->common->commontimeformat($fet_morning->start_time_hour);
										$start_time_min = $this->common->commontimeformat($fet_morning->start_time_min);
										$end_time_hour = $this->common->commontimeformat($fet_morning->end_time_hour);
										$end_time_min = $this->common->commontimeformat($fet_morning->end_time_min);
										$start_time = $start_time_hour.":".$start_time_min;
										$end_time = $end_time_hour.":".$end_time_min;
										?>
							<li><a Tooltip="<?=$pname_over?>" class="nameover" href="javascript:void(0)" onclick="editpopupform('<?=$week?>','<?=$year?>','<?=$aid?>')"><span class="boxtime"><?=$start_time?> - <?=$end_time?> </span><span class="boxname"><?=trim($pname)?></span><span class="boxdots">...</span></a></li>
									<?php } ?>
								</ul>
							</div></div>
					</div>
					<div class="wc-day-column-inner ui-droppable schedule">
						<div class="wc-cal-event ui-corner-all" <?=$afterleaveclass?>>
							<div class="wc-time ui-corner-all"><span><?=lang("OPERATOR::afternoon")?></span><i class="icon-share" onclick="reassign('<?php echo $week;?>','<?php echo $year;?>','<?php echo $oid;?>', '<?php echo $jobdate;?>','2')"></i></div>
							<div class="wc-title" title="">
								<ul class="jobpatientlist">
									<?php
									$after_sel = $this->jobassign_model->getmorningafterjoblist($oid, $jobdate,'2');
									foreach($after_sel as $fet_after){
										$after_aid = $fet_after->aid;
										$after_patient_id = $fet_after->patient_id;
										$after_pname_over = $this->common->getpatientname($after_patient_id);
										if(strlen($after_pname_over) > 12){
											$after_pname = substr($this->common->getpatientfsurname($after_patient_id),0,12);
										}else{
											$after_pname = $after_pname_over;
										}
										$after_start_time_hour = $this->common->commontimeformat($fet_after->start_time_hour);
										$after_start_time_min = $this->common->commontimeformat($fet_after->start_time_min);
										$after_end_time_hour = $this->common->commontimeformat($fet_after->end_time_hour);
										$after_end_time_min = $this->common->commontimeformat($fet_after->end_time_min);
										$after_start_time = $after_start_time_hour.":".$after_start_time_min;
										$after_end_time = $after_end_time_hour.":".$after_end_time_min;
										?>
										<li><a Tooltip="<?=$after_pname_over?>" class="nameover" href="javascript:void(0)" onclick="editpopupform('<?=$week?>','<?=$year?>','<?=$after_aid?>')"><span class="boxtime"><?=$after_start_time?> - <?=$after_end_time?> </span><span class="boxname"><?=trim($after_pname)?></span><span class="boxdots">...</span></a></li>
									<?php } ?>
								</ul>
							</div></div>
					</div>
</td>
					<?php } ?>
</tr>
			</tbody>
			</table></fieldset>
	</td></tr><?php  }  ?>

<?php /* Yellow Box */
$stop_yellow = array();
for($d = 1; $d <= 7; $d++){
	$jobdate1 = strtotime($year."W".$week.$d);
	$stop_yellow[] = $this->jobassign_model->get_yellow_joblist($jobdate1);
}

  $items_yellow = array();
	foreach ($stop_yellow as $inner_yellow){
		if(count($inner_yellow) >0 ){
			 $item_yellow = array($inner_yellow['listoid']);
		foreach($item_yellow as $aa){
			$items_yellow = array_merge($items_yellow, $aa);
		}
	}
}
$result_yellow = call_user_func_array("array_merge", $items_yellow);

foreach($while_loop as $fet_yellow_opt){
$yellow_oid = $fet_yellow_opt['oid'];
$yellow_optname = $fet_yellow_opt['lastname']." ".$fet_yellow_opt['firstname'];

if(in_array($yellow_oid,array_unique($result_yellow))){
?>
				<tr class="optbox">
					<td><fieldset style="border: 1px solid; padding: 5px; background-color: #FFFF00;">
  <legend style="color: #333333; display: block; font-size: 21px; width: auto;"><?=$yellow_optname?></legend>
  <span style="float: left; padding: 0px;"><a class="btn btn-rounded btn-primary btn-submit hideopt" href="javascript:void(0)" onclick="return deleteyellowjob('<?=$yellow_oid?>', '<?=$week?>', '<?=$year?>');"><?php echo lang("JOBASSIGN::delete_yellow_box"); ?></a> </span>
  <span style="float: right; padding: 0px; margin: -10px 10px 0px 0px;"><a class="btn btn-rounded btn-primary btn-submit hideopt" href="javascript:void(0)" onclick="movejob('<?=$yellow_oid?>', '<?=$week?>', '<?=$year?>')"><?php echo lang("COMMON::move"); ?></a> </span>
				<table style="width: 100%;"><tr>
					<?php for($yd = 1; $yd <= 7; $yd++){
						$jobdate_yellow = strtotime($year."W".$week.$yd);
						?>
<td class="wc-day-column day-<?=$yd?> morning">
	<div class="wc-day-column-inner ui-droppable schedule">
						<div class="wc-cal-event ui-corner-all" style="background-color: #FFFFFF;">
							<div class="wc-time ui-corner-all"><span><?=lang("OPERATOR::morning")?></span><i class="icon-share" onclick="reassign('<?=$week?>','<?=$year?>','<?=$yellow_oid?>', '<?=$jobdate_yellow?>','1','y')"></i></div>
							<div class="wc-title" title="">
								<ul class="jobpatientlist">
									<?php
									$moring_sel_yellow = $this->jobassign_model->yellowgetmorningafterjoblist($yellow_oid, $jobdate_yellow,'1');
									foreach($moring_sel_yellow as $fet_morning_yellow){
										$y_aid = $fet_morning_yellow->aid;
										$y_patient_id = $fet_morning_yellow->patient_id;
										$y_pname_over = $this->common->getpatientname($y_patient_id);
										if(strlen($y_pname_over) > 12){
											$y_pname = substr($this->common->getpatientfsurname($y_patient_id),0,12);
										}else{
											$y_pname = $y_pname_over;
										}
										$y_start_time_hour = $this->common->commontimeformat($fet_morning_yellow->start_time_hour);
										$y_start_time_min = $this->common->commontimeformat($fet_morning_yellow->start_time_min);
										$y_end_time_hour = $this->common->commontimeformat($fet_morning_yellow->end_time_hour);
										$y_end_time_min = $this->common->commontimeformat($fet_morning_yellow->end_time_min);
										$y_start_time = $y_start_time_hour.":".$y_start_time_min;
										$y_end_time = $y_end_time_hour.":".$y_end_time_min;
										?>
										<li><a Tooltip="<?=$y_pname_over?>" class="nameover" href="javascript:void(0)" onclick="editpopupform('<?=$y_aid?>')"><span class="boxtime"><?=$y_start_time?> - <?=$y_end_time?> </span><span class="boxname"><?=trim($y_pname)?></span><span class="boxdots">...</span></a></li>

									<?php } ?>
								</ul>
							</div></div>
					</div>
					<div class="wc-day-column-inner ui-droppable schedule">
						<div class="wc-cal-event ui-corner-all" style="background-color: #FFFFFF;">
							<div class="wc-time ui-corner-all"><span><?=lang("OPERATOR::afternoon")?></span><i class="icon-share" onclick="reassign('<?=$week?>','<?=$year?>','<?=$yellow_oid?>', '<?=$jobdate_yellow?>','2','y')"></i></div>
							<div class="wc-title" title="">
								<ul class="jobpatientlist">
									<?php
									$after_sel_yellow = $this->jobassign_model->yellowgetmorningafterjoblist($yellow_oid, $jobdate_yellow,'2');
									foreach($after_sel_yellow as $fet_after_yellow){
										$y_after_aid = $fet_after_yellow->aid;
										$y_after_patient_id = $fet_after_yellow->patient_id;
										$y_after_pname_over = $this->common->getpatientname($y_after_patient_id);
										if(strlen($y_after_pname_over) > 12){
											$y_after_pname = substr($this->common->getpatientfsurname($y_after_patient_id),0,12);
										}else{
											$y_after_pname = $y_after_pname_over;
										}
										$y_after_start_time_hour = $this->common->commontimeformat($fet_after_yellow->start_time_hour);
										$y_after_start_time_min = $this->common->commontimeformat($fet_after_yellow->start_time_min);
										$y_after_end_time_hour = $this->common->commontimeformat($fet_after_yellow->end_time_hour);
										$y_after_end_time_min = $this->common->commontimeformat($fet_after_yellow->end_time_min);
										$y_after_start_time = $y_after_start_time_hour.":".$y_after_start_time_min;
										$y_after_end_time = $y_after_end_time_hour.":".$y_after_end_time_min;
										?>
										<li><a Tooltip="<?=$y_after_pname_over?>" class="nameover" href="javascript:void(0)" onclick="editpopupform('<?=$y_after_aid?>')"><span class="boxtime"><?=$y_after_start_time?> - <?=$y_after_end_time?> </span><span class="boxname"><?=trim($y_after_pname)?></span><span class="boxdots">...</span></a></li>
									<?php } ?>
								</ul>
							</div></div>
					</div>
</td>
					<?php } ?>
</tr>
			</tbody>
			</table></fieldset>
	</td></tr><?php } } ?>
		</table>
	</div>
</div>

</div>
<div id='event_edit_container' style="display: none"></div>
            </div><!--maincontentinner-->
        </div><!--maincontent-->

    </div><!--rightpanel-->

</div><!--mainwrapper-->
<script>
jQuery(document).ready(function(){
	jQuery('.leftmenu .dropdown > a').click(function(){
		if(!jQuery(this).next().is(':visible'))
			jQuery(this).next().slideDown('fast');
		else
			jQuery(this).next().slideUp('fast');
		return false;
	});
	 jQuery('.wc-scrollable-grid').mousewheel(function(event, delta) {
			jQuery('#optid').val('');
	});

jQuery('.nameover').hover(function(event) {
   var toolTip = jQuery(this).attr('Tooltip');
   jQuery('<span class="tooltip"></span>').text(toolTip)
            .appendTo('body')
            .css('top', (event.pageY - 10) + 'px')
            .css('left', (event.pageX + 20) + 'px')
            .fadeIn('slow');
    }, function() {
        jQuery('.tooltip').remove();
    }).mousemove(function(event) {
        jQuery('.tooltip')
        .css('top', (event.pageY - 10) + 'px')
        .css('left', (event.pageX + 20) + 'px');
	});

})

function copyweek (week, year,pid,filt_oid,dist_id,filter_box_status) {
		$('#LoadingImage').show();
	var $about = $("#event_edit_container");
				  $.post("<?php echo site_url($i18n.'jobassign/copyweek') ?>/"+week+"/"+year+"/"+filt_oid+"/"+pid+"/"+dist_id+"/"+filter_box_status,
				  function (data) {
				  	$('#LoadingImage').hide();
				       $("#event_edit_container").html(data);
				       $about.dialog({
				         title: "<?php echo ( sprintf( lang("JOBASSIGN::copy_week")) ); ?>",
				         width: 900,
				         top: 0,
				         closeOnEscape: true,
				         position:'center',
				         close: function() {
				            $about.dialog("destroy").hide();
				         },
				         buttons: {
				            close : function() {
				               $about.dialog("close");
				            }
				         }
				      }).show();
	});
}
var siteurl = "<?php echo site_url($i18n.'jobassign_nav/navigation') ?>";
function navigation(week,year,pid,filt_oid,dist_id,filter_box_status) {
		jQuery('#navweek').val(week);
		jQuery('#navyear').val(year);
	  	$('#field_loader').show();
		jQuery.post(siteurl,
	           {week_no: ""+week+"", year_no: ""+year+"", opt_id: ""+filt_oid+"", pat_id: ""+pid+"", dist_id: ""+dist_id+"", filter_box_status: ""+filter_box_status+"" },
               function(data){
               //	alert(data);
               	$('#field_loader').hide();
               	if(data != ''){
               		jQuery('#calendar1').html('');
               		jQuery('#calendar1').html(data);
               	}

	       });
	}

</script>
<?php $this->load->view('common/footer'); ?>