<?php
	$year = date("Y");
	$cur_date = strtotime(date("d-m-Y"));
	$week = date("W");
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
<div style="float: left; width: 100%;">
            			<div class="hideshowbtn" style="float: left;">
            			<a href="javascript:void(0)" style="display: none;" class = "btn btn-rounded btn-primary btn-submit showopt" onclick="return filterdisplay('show')"><?php echo lang("JOBASSIGN::showfilter"); ?></a>
            			<a href="javascript:void(0)" class = "btn btn-rounded btn-primary btn-submit hideopt" onclick="return filterdisplay('hide')"><?php echo lang("JOBASSIGN::hidefilter"); ?></a></div>

            			<div class="add_copy_job" style="float: left; margin-left: 200px;">
            			<a href="javascript:void(0)" class = "btn btn-rounded btn-primary btn-submit" onclick="return add_job_popup()" style="float: right;"><i class="icon-backward"></i>&nbsp;&nbsp;<?php echo lang("JOBASSIGN::add_new_job"); ?>&nbsp;&nbsp;<i class="icon-forward"></i></a>&nbsp;&nbsp;
            			<input type="hidden" name="copyweek" value="<?php echo site_url($i18n.'jobassign_filter/jobfilter') ?>" id = "copyweek"/>
            			<a href="javascript:void(0)" class = "btn btn-rounded btn-primary btn-submit" onclick="return copyweek('<?=$week?>','<?=$year?>')" style="margin-right: 10px;"><i class="icon-backward"></i>&nbsp;&nbsp;<?php echo lang("JOBASSIGN::copy_week"); ?>&nbsp;&nbsp;<i class="icon-forward"></i></a>
            			</div>
            			<div class="navbtn" style="float: right;">
								<a href="javascript:void(0)" class="btn btn-rounded btn-primary btn-submit" onclick="return navigation('<?=$back_weeknumber?>','<?=$year?>')">Prev</a>
								<a href="javascript:void(0)" class="btn btn-rounded btn-primary btn-submit" onclick="return navigation('<?=$next_weeknumber?>','<?=$year?>')">Next</a>
            			</div>
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
				<tr class="optbox">
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
							<div class="wc-time ui-corner-all"><span><?=lang("OPERATOR::morning")?></span>
							<div style="float: right; margin-right: 10px;">
							<i class="icon-share" onclick="reassign('<?=$oid?>', '<?=$jobdate?>','1')"></i><i class="icon-edit" onclick="job_maintain('<?=$week?>','<?=$year?>','<?=$oid?>', '<?=$jobdate?>')"></i>
							</div>
							</div>
							<div class="wc-title" title="">
								<ul class="jobpatientlist">
									<?php
									$moring_sel = $this->jobassign_model->getmorningafterjoblist($oid, $jobdate,'1');
									foreach($moring_sel as $fet_morning){
										$aid = $fet_morning->aid;
										$patient_id = $fet_morning->patient_id;
										$pname = $this->common->getpatientsurname($patient_id);
										$start_time_hour = $this->common->commontimeformat($fet_morning->start_time_hour);
										$start_time_min = $this->common->commontimeformat($fet_morning->start_time_min);
										$end_time_hour = $this->common->commontimeformat($fet_morning->end_time_hour);
										$end_time_min = $this->common->commontimeformat($fet_morning->end_time_min);
										$start_time = $start_time_hour.":".$start_time_min;
										$end_time = $end_time_hour.":".$end_time_min;
										?>
							<li><a href="javascript:void(0)" onclick="editpopupform('<?=$aid?>')"><?=$start_time?> - <?=$end_time?> <?=$pname?></a></li>
									<?php } ?>
								</ul>
							</div></div>
					</div>
					<div class="wc-day-column-inner ui-droppable schedule">
						<div class="wc-cal-event ui-corner-all" <?=$afterleaveclass?>>
							<div class="wc-time ui-corner-all"><span><?=lang("OPERATOR::afternoon")?></span>
							<div style="float: right; margin-right: 10px;">
							<i class="icon-share" onclick="reassign('<?=$oid?>', '<?=$jobdate?>','2')"></i><i class="icon-edit" onclick="job_afternoon_maintain('<?=$week?>','<?=$year?>','<?=$oid?>', '<?=$jobdate?>')"></i>
							</div>
							</div>
							<div class="wc-title" title="">
								<ul class="jobpatientlist">
									<?php
									$after_sel = $this->jobassign_model->getmorningafterjoblist($oid, $jobdate,'2');
									foreach($after_sel as $fet_after){
										$after_aid = $fet_after->aid;
										$after_patient_id = $fet_after->patient_id;
										$after_pname = $this->common->getpatientsurname($after_patient_id);
										$after_start_time_hour = $this->common->commontimeformat($fet_after->start_time_hour);
										$after_start_time_min = $this->common->commontimeformat($fet_after->start_time_min);
										$after_end_time_hour = $this->common->commontimeformat($fet_after->end_time_hour);
										$after_end_time_min = $this->common->commontimeformat($fet_after->end_time_min);
										$after_start_time = $after_start_time_hour.":".$after_start_time_min;
										$after_end_time = $after_end_time_hour.":".$after_end_time_min;
										?>
							<li><a href="javascript:void(0)" onclick="editpopupform('<?=$after_aid?>')"><?=$after_start_time?> - <?=$after_end_time?> <?=$after_pname?></a></li>
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
  <span style="float: right; padding: 0px; margin: -10px 10px 0px 0px;"><a class="btn btn-rounded btn-primary btn-submit hideopt" href="javascript:void(0)" onclick="movejob('<?=$yellow_oid?>', '<?=$week?>', '<?=$year?>')">Move</a> </span>
				<table style="width: 100%;"><tr>
					<?php for($yd = 1; $yd <= 7; $yd++){
						$jobdate_yellow = strtotime($year."W".$week.$yd);
						?>
<td class="wc-day-column day-<?=$yd?> morning">
	<div class="wc-day-column-inner ui-droppable schedule">
						<div class="wc-cal-event ui-corner-all" style="background-color: #FFFFFF;">
							<div class="wc-time ui-corner-all"><span><?=lang("OPERATOR::morning")?></span></div>
							<div class="wc-title" title="">
								<ul class="jobpatientlist">
									<?php
									$moring_sel_yellow = $this->jobassign_model->yellowgetmorningafterjoblist($yellow_oid, $jobdate_yellow,'1');
									foreach($moring_sel_yellow as $fet_morning_yellow){
										$y_aid = $fet_morning_yellow->aid;
										$y_patient_id = $fet_morning_yellow->patient_id;
										$y_pname = $this->common->getpatientsurname($y_patient_id);
										$y_start_time_hour = $this->common->commontimeformat($fet_morning_yellow->start_time_hour);
										$y_start_time_min = $this->common->commontimeformat($fet_morning_yellow->start_time_min);
										$y_end_time_hour = $this->common->commontimeformat($fet_morning_yellow->end_time_hour);
										$y_end_time_min = $this->common->commontimeformat($fet_morning_yellow->end_time_min);
										$y_start_time = $y_start_time_hour.":".$y_start_time_min;
										$y_end_time = $y_end_time_hour.":".$y_end_time_min;
										?>
							<li><a href="javascript:void(0)"><?=$y_start_time?> - <?=$y_end_time?> <?=$y_pname?></a></li>
									<?php } ?>
								</ul>
							</div></div>
					</div>
					<div class="wc-day-column-inner ui-droppable schedule">
						<div class="wc-cal-event ui-corner-all" style="background-color: #FFFFFF;">
							<div class="wc-time ui-corner-all"><span><?=lang("OPERATOR::afternoon")?></span></div>
							<div class="wc-title" title="">
								<ul class="jobpatientlist">
									<?php
									$after_sel_yellow = $this->jobassign_model->yellowgetmorningafterjoblist($yellow_oid, $jobdate_yellow,'2');
									foreach($after_sel_yellow as $fet_after_yellow){
										$y_after_aid = $fet_after_yellow->aid;
										$y_after_patient_id = $fet_after_yellow->patient_id;
										$y_after_pname = $this->common->getpatientsurname($y_after_patient_id);
										$y_after_start_time_hour = $this->common->commontimeformat($fet_after_yellow->start_time_hour);
										$y_after_start_time_min = $this->common->commontimeformat($fet_after_yellow->start_time_min);
										$y_after_end_time_hour = $this->common->commontimeformat($fet_after_yellow->end_time_hour);
										$y_after_end_time_min = $this->common->commontimeformat($fet_after_yellow->end_time_min);
										$y_after_start_time = $y_after_start_time_hour.":".$y_after_start_time_min;
										$y_after_end_time = $y_after_end_time_hour.":".$y_after_end_time_min;
										?>
							<li><a href="javascript:void(0)"><?=$y_after_start_time?> - <?=$y_after_end_time?> <?=$y_after_pname?></a></li>
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