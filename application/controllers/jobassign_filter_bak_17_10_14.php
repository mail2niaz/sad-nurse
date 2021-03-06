<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Jobassign_filter extends CI_Controller {

  function __construct()
  {
    parent::__construct();
	if(!$this->session->userdata('logged_in'))
    {
	redirect('login', 'refresh');
	}
	$this->load->language('mci');
	$this->load->library('breadcrumbs');
  }

  function index()
  {
/* Session Variables */
      	$session_data=$this->session->userdata('logged_in');
		$data['username']=$session_data['username'];
		$data['stype'] = $session_data['type'];
		$data['sadd'] = $session_data['sadd'];
		$data['sedit'] = $session_data['sedit'];
		$data['sview'] = $session_data['sview'];
		$data['sdelete'] = $session_data['sdelete'];
		$data['mopt'] = $session_data['mopt'];
		$data['mpat'] = $session_data['mpat'];
		$data['mjob'] = $session_data['mjob'];
		$data['mcms'] = $session_data['mcms'];
		$data['mintervent'] = $session_data['mintervent'];
		$data['mreport'] = $session_data['mreport'];
		$data['mcontract'] = $session_data['mcontract'];
      /* Session Variables */
	   if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }

		/* breadcrumbs */
		$this->breadcrumbs->push(lang('home'), site_url('home'));
		$this->breadcrumbs->push( lang('joblist'), site_url('jobassign'));
		/* end */
      $this->load->view('joblist', $data);

  }
public function jobfilter()
{
	$this->load->model('jobassign_model');
	$pid = $this->input->post('pat_id');
	$filt_oid = $_REQUEST['opt_id'];
	$dist_id = $_REQUEST['dist_id'];
	$filter_box_status = $_REQUEST['filter_box_status'];
	if($_REQUEST['navweek'] == ""){ $week = date("W"); }else{ $week = $_REQUEST['navweek']; }
	if($_REQUEST['navyear'] == ""){ $year = date("Y"); }else{ $year = $_REQUEST['navyear']; }
	//echo $week."---".$year;
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
	?>
		<script>
	jQuery(document).ready(function(){
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
	</script>
<div id='calendar1'>
		<?php $cur_date = strtotime(date("d-m-Y"));
	/* End wc-today */
	?>
			<a href="<?php echo site_url($i18n.'jobassign_filter/planningexport/'.$pid."/".$filt_oid."/".$dist_id."/".$filter_box_status."/".$week."/".$year) ?>" class="btn btn-rounded btn-primary btn-submit"><?php echo lang("JOBASSIGN::export_to_excel"); ?></a>
			<span style="color: red; font-size: 20px;"><?php echo $this->common->datei18tranlabel(strtotime(date('d-M-Y', strtotime($year."W".$week.'1')))); ?> - <?php echo $this->common->datei18tranlabel(strtotime(date('d-M-Y', strtotime($year."W".$week.'7')))); ?></span>
<div style="float: left; width: 100%;">
            			<div class="hideshowbtn" style="float: left;">
            			<a href="javascript:void(0)" style="display: none;" class = "btn btn-rounded btn-primary btn-submit showopt" onclick="return filterdisplay('show')"><?php echo lang("JOBASSIGN::showfilter"); ?></a>
            			<a href="javascript:void(0)" class = "btn btn-rounded btn-primary btn-submit hideopt" onclick="return filterdisplay('hide')"><?php echo lang("JOBASSIGN::hidefilter"); ?></a></div>

            			<div class="add_copy_job">
            			<a href="javascript:void(0)" class = "btn btn-rounded btn-primary btn-submit" onclick="return add_job_popup('<?=$week?>','<?=$year?>')" style="float: right;"><i class="icon-backward"></i>&nbsp;&nbsp;<?php echo lang("JOBASSIGN::add_new_job"); ?>&nbsp;&nbsp;<i class="icon-forward"></i></a>&nbsp;&nbsp;
            			<input type="hidden" name="copyweek" value="<?php echo site_url($i18n.'jobassign_filter/jobfilter') ?>" id = "copyweek"/>
            			<a href="javascript:void(0)" class = "btn btn-rounded btn-primary btn-submit" onclick="return copyweek('<?=$week?>','<?=$year?>','<?=$pid?>','<?=$filt_oid?>','<?=$dist_id?>','<?=$filter_box_status?>')" style="margin-right: 10px;"><i class="icon-backward"></i>&nbsp;&nbsp;<?php echo lang("JOBASSIGN::copy_week"); ?>&nbsp;&nbsp;<i class="icon-forward"></i></a>
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
		<a href="javascript:void(0)" class="btn btn-rounded btn-primary btn-submit" onclick="return navigation('<?=$back_weeknumber?>','<?=$year?>','<?=$pid?>','<?=$filt_oid?>','<?=$dist_id?>','<?=$filter_box_status?>')"><?php echo lang("JOBASSIGN::prev"); ?></a>
		<a href="javascript:void(0)" class="btn btn-rounded btn-primary btn-submit" onclick="return navigation('<?=$next_weeknumber?>','<?=$year?>','<?=$pid?>','<?=$filt_oid?>','<?=$dist_id?>','<?=$filter_box_status?>')"><?php echo lang("JOBASSIGN::next"); ?></a>

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
				unset($while_loop);
				$while_loop = array();
				if($filt_oid == '0'){
				$sel_opt = "SELECT * FROM operators where status = '1'";
				$qry_opt = mysql_query($sel_opt);
				while($fet_opt = mysql_fetch_assoc($qry_opt)){
					$while_loop[] = $fet_opt;
				}
				}else{
					$while_loop[0]['oid'] = $filt_oid;
					$while_loop[0]['name'] = $this->common->getoperatorfirstname($filt_oid);
				}
				/* OID LIST */
				$stop = array();
if($filter_box_status != 'y'){
	if($filt_oid == '0' && $dist_id == '0' && $filter_box_status != '0'){
					  for($d = 1; $d <= 7; $d++){
						$jobdate1 = strtotime($year."W".$week.$d);
						$stop[] = $this->jobassign_model->stop_filter_joblist($week, $year, $pid, $dist_id, $jobdate1,$filter_box_status);
					  }
					  $items = array();
						foreach ($stop as $inner){
							if(count($inner) >0 ){
								 $item = array($inner['listoid'][0]);
						   		 $items = array_merge($items, $item);
							}
						}
						$result = call_user_func_array("array_merge", $items);
	}elseif($filt_oid == '0' && $dist_id == '0'){
					  for($d = 1; $d <= 7; $d++){
						$jobdate1 = strtotime($year."W".$week.$d);
						$stop[] = $this->jobassign_model->stop_filter_joblist($week, $year, $pid, $dist_id, $jobdate1);
					  }
					  $items = array();
						foreach ($stop as $inner){
							if(count($inner) >0 ){
								//print_r($inner['listoid']);
								 $item = array($inner['listoid'][0]);
						   		 $items = array_merge($items, $item);
							}
						}
						$result = call_user_func_array("array_merge", $items);
				}elseif($dist_id != '0'){
					//echo "F2";
					$stop[] = $this->jobassign_model->stop_filter_joblist($week, $year, $pid, $dist_id);
					$result = $stop[0][listoid];
				}else{
					//echo "F3";
					$result[0] = $filt_oid;
				}

				foreach($while_loop as $fet_opt_filt){
					$oid = $fet_opt_filt['oid'];
					if($filt_oid == '0'){
						$optname = $fet_opt_filt['lastname']." ".$fet_opt_filt['firstname'];
					}else{
						$optname = $fet_opt_filt['name'];
					}
					if(in_array($oid,array_unique($result))){
					 ?>
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
							<div class="wc-time ui-corner-all"><span><?=lang("OPERATOR::morning")?></span><i class="icon-share" onclick="reassign('<?php echo $week;?>','<?php echo $year;?>','<?php echo $oid;?>', '<?php echo $jobdate;?>','1')"></i></div>
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
	</td></tr><?php }
} } ?>

	<?php /* Yellow Box */
	$stop_yellow = array();
	 $items_yellow = array();
	 //echo $filt_oid."--".$dist_id."--".$pid."--".$filter_box_status;
	if($filter_box_status != 'g'){
	if($filt_oid == '0' && $dist_id == '0' && $pid == '0' && $filter_box_status != '0'){
		//echo "first";
			for($d = 1; $d <= 7; $d++){
						$jobdate1 = strtotime($year."W".$week.$d);
						$stop_yellow[] = $this->jobassign_model->get_yellow_joblist_filter($week, $year, $filt_oid,$pid, $dist_id, $jobdate1, $filter_box_status);
					  }

						foreach ($stop_yellow as $inner_yellow){
							if(count($inner_yellow) >0 ){
								$item_yellow = array($inner_yellow['listoid']);
								foreach($item_yellow as $aa){
									$items_yellow = array_merge($items_yellow, $aa);
								}
							}
						}
						$result_yellow = call_user_func_array("array_merge", $items_yellow);
	}
	elseif($filt_oid != '0' && $pid != '0' && $dist_id == '0' && $filter_box_status == '0'){
		//echo "second";
			for($d = 1; $d <= 7; $d++){
						$jobdate1 = strtotime($year."W".$week.$d);
						$stop_yellow[] = $this->jobassign_model->get_yellow_joblist_filter($week, $year, $filt_oid,$pid, $dist_id, $jobdate1, $filter_box_status);
					  }
						foreach ($stop_yellow as $inner_yellow){
							if(count($inner_yellow) >0 ){
								$item_yellow = array($inner_yellow['listoid']);
								foreach($item_yellow as $aa){
									$items_yellow = array_merge($items_yellow, $aa);
								}
							}
						}
						$result_yellow = call_user_func_array("array_merge", $items_yellow);
	}
				elseif($filt_oid == '0' && $dist_id == '0'){
					//echo "third";
					  for($d = 1; $d <= 7; $d++){
						$jobdate1 = strtotime($year."W".$week.$d);
						$stop_yellow[] = $this->jobassign_model->get_yellow_joblist_filter($week, $year, $filt_oid,$pid, $dist_id, $jobdate1,$filter_box_status);
					  }
						foreach ($stop_yellow as $inner_yellow){
							if(count($inner_yellow) >0 ){
								$item_yellow = array($inner_yellow['listoid']);
								foreach($item_yellow as $aa){
									$items_yellow = array_merge($items_yellow, $aa);
								}
							}
						}
						$result_yellow = call_user_func_array("array_merge", $items_yellow);
				}elseif($dist_id != '0' && $filt_oid == '0' && $pid == '0' && $filter_box_status == '0'){
					//echo "fourth";
					 for($d = 1; $d <= 7; $d++){
						$jobdate1 = strtotime($year."W".$week.$d);
						$stop_yellow[] = $this->jobassign_model->get_yellow_joblist_filter($week, $year, $filt_oid,$pid, $dist_id, $jobdate1,$filter_box_status);
					  }
						foreach ($stop_yellow as $inner_yellow){
							if(count($inner_yellow) >0 ){
								$item_yellow = array($inner_yellow['listoid']);
								foreach($item_yellow as $aa){
									$items_yellow = array_merge($items_yellow, $aa);
								}
							}
						}
						$result_yellow = $items_yellow;
				}elseif($filt_oid != '0' && $dist_id != '0' && $filter_box_status != '0'){
					//echo "last";
					  for($d = 1; $d <= 7; $d++){
						$jobdate1 = strtotime($year."W".$week.$d);
						$stop_yellow[] = $this->jobassign_model->get_yellow_joblist_filter($week, $year, $filt_oid,$pid, $dist_id, $jobdate1,$filter_box_status);
					  }
						foreach ($stop_yellow as $inner_yellow){
							if(count($inner_yellow) >0 ){
								$item_yellow = array($inner_yellow['listoid']);
								foreach($item_yellow as $aa){
									$items_yellow = array_merge($items_yellow, $aa);
								}
							}
						}
						$result_yellow = call_user_func_array("array_merge", $items_yellow);
				}
				elseif($dist_id != '0' && $filter_box_status != '0'){
					//echo "six";
						 for($d = 1; $d <= 7; $d++){
						$jobdate1 = strtotime($year."W".$week.$d);
						$stop_yellow[] = $this->jobassign_model->get_yellow_joblist_filter($week, $year, $filt_oid,$pid, $dist_id, $jobdate1,$filter_box_status);
					  }
						foreach ($stop_yellow as $inner_yellow){
							if(count($inner_yellow) >0 ){
								$item_yellow = array($inner_yellow['listoid']);
								foreach($item_yellow as $aa){
									$items_yellow = array_merge($items_yellow, $aa);
								}
							}
						}
						$result_yellow = $items_yellow;
				}else{
					//echo "fifth";
					/*
					$stop_yellow[] = $this->jobassign_model->get_yellow_joblist_filter($week, $year, $filt_oid,$pid, $dist_id, NULL, $filter_box_status);
										$result_yellow = $stop_yellow[0][listoid];*/
						for($d = 1; $d <= 7; $d++){
						$jobdate1 = strtotime($year."W".$week.$d);
						$stop_yellow[] = $this->jobassign_model->get_yellow_joblist_filter($week, $year, $filt_oid,$pid, $dist_id, $jobdate1,$filter_box_status);
					  }
						foreach ($stop_yellow as $inner_yellow){
							if(count($inner_yellow) >0 ){
								$item_yellow = array($inner_yellow['listoid']);
								foreach($item_yellow as $aa){
									$items_yellow = array_merge($items_yellow, $aa);
								}
							}
						}
						$result_yellow = call_user_func_array("array_merge", $items_yellow);

				}
				foreach($while_loop as $fet_opt_filt_yellow){
					$yellow_oid = $fet_opt_filt_yellow['oid'];
					if($filt_oid == '0'){
						$yellow_optname = $fet_opt_filt_yellow['lastname']." ".$fet_opt_filt_yellow['firstname'];
					}else{
						$yellow_optname = $fet_opt_filt_yellow['name'];
					}
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
							<div class="wc-time ui-corner-all"><span><?=lang("OPERATOR::morning")?></span><i class="icon-share" onclick="reassign('<?php echo $week;?>','<?php echo $year;?>','<?php echo $yellow_oid;?>', '<?php echo $jobdate_yellow;?>','1','y')"></i></div>
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
							<li><a Tooltip="<?=$y_pname_over?>" class="nameover" href="javascript:void(0)" onclick="editpopupform('<?=$week?>','<?=$year?>','<?=$y_aid?>')"><span class="boxtime"><?=$y_start_time?> - <?=$y_end_time?> </span><span class="boxname"><?=trim($y_pname)?></span><span class="boxdots">...</span></a></li>

									<?php } ?>
								</ul>
							</div></div>
					</div>
					<div class="wc-day-column-inner ui-droppable schedule">
						<div class="wc-cal-event ui-corner-all" style="background-color: #FFFFFF;">
							<div class="wc-time ui-corner-all"><span><?=lang("OPERATOR::afternoon")?></span><i class="icon-share" onclick="reassign('<?php echo $week;?>','<?php echo $year;?>','<?php echo $yellow_oid;?>', '<?php echo $jobdate_yellow;?>','2','y')"></i></div>
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
										<li><a Tooltip="<?=$y_after_pname_over?>" class="nameover" href="javascript:void(0)" onclick="editpopupform('<?=$week?>','<?=$year?>','<?=$y_after_aid?>')"><span class="boxtime"><?=$y_after_start_time?> - <?=$y_after_end_time?> </span><span class="boxname"><?=trim($y_after_pname)?></span><span class="boxdots">...</span></a></li>
									<?php } ?>
								</ul>
							</div></div>
					</div>
</td>
					<?php } ?>
</tr>
			</tbody>
			</table></fieldset>
	</td></tr><?php } } } ?>
		</table>
	</div>
</div>
</div>
<?php  }

public function planningexport($pid,$filt_oid,$dist_id,$filter_box_status,$cweek,$cyear)
{
		header('Content-Type: application/vnd.ms-excel');	//define header info for browser
		header('Content-Disposition: attachment; filename=week_report_'.date("d_m_Y",time()).'.xls');
		header('Pragma: no-cache');
		header('Expires: 0');

	$this->load->model('jobassign_model');
	//$pid = $this->input->post('pat_id');
	//$filt_oid = $_REQUEST['opt_id'];
	//$dist_id = $_REQUEST['dist_id'];
	//$filter_box_status = $_REQUEST['filter_box_status'];
	if($cweek == ""){ $week = date("W"); }else{ $week = $cweek; }
	if($cyear == ""){ $year = date("Y"); }else{ $year = $cyear; }
	//echo "pid = ".$pid."--- OID= ".$filt_oid." --- DID= ".$dist_id." ---Stauts = ".$filter_box_status." --- Week = ".$week; ?>

			<table style="border: 1px solid;">

				<?php
				unset($while_loop);
				$while_loop = array();
				if($filt_oid == '0'){
				$sel_opt = "SELECT * FROM operators where status = '1'";
				$qry_opt = mysql_query($sel_opt);
				while($fet_opt = mysql_fetch_assoc($qry_opt)){
					$while_loop[] = $fet_opt;
				}
				}else{
					$while_loop[0]['oid'] = $filt_oid;
					$while_loop[0]['name'] = $this->common->getoperatorfirstname($filt_oid);
				}
				/* OID LIST */
				$stop = array();
	if($filt_oid == '0' && $dist_id == '0' && $filter_box_status != '0'){
					  for($d = 1; $d <= 7; $d++){
						$jobdate1 = strtotime($year."W".$week.$d);
						$stop[] = $this->jobassign_model->stop_filter_joblist($week, $year, $pid, $dist_id, $jobdate1,$filter_box_status);
					  }
					  $items = array();
						foreach ($stop as $inner){
							if(count($inner) >0 ){
								 $item = array($inner['listoid'][0]);
						   		 $items = array_merge($items, $item);
							}
						}
						$result = call_user_func_array("array_merge", $items);
	}elseif($filt_oid == '0' && $dist_id == '0'){
					  for($d = 1; $d <= 7; $d++){
						$jobdate1 = strtotime($year."W".$week.$d);
						$stop[] = $this->jobassign_model->stop_filter_joblist($week, $year, $pid, $dist_id, $jobdate1);
					  }
					  $items = array();
						foreach ($stop as $inner){
							if(count($inner) >0 ){
								//print_r($inner['listoid']);
								 $item = array($inner['listoid'][0]);
						   		 $items = array_merge($items, $item);
							}
						}
						$result = call_user_func_array("array_merge", $items);
				}elseif($dist_id != '0'){
					//echo "F2";
					$stop[] = $this->jobassign_model->stop_filter_joblist($week, $year, $pid, $dist_id);
					$result = $stop[0][listoid];
				}else{
					//echo "F3";
					$result[0] = $filt_oid;
				}

				foreach($while_loop as $fet_opt_filt){
					$oid = $fet_opt_filt['oid'];
					if($filt_oid == '0'){
						$optname = $fet_opt_filt['lastname']." ".$fet_opt_filt['firstname'];
					}else{
						$optname = $fet_opt_filt['name'];
					}
					//if(in_array($oid,array_unique($result))){
					 ?>
				<tr>
					<td>
				<table style="width: 100%; border: 1px solid;">
					<tr><b><?=$optname?></b></tr>
					<tr>
					<?php for($d = 1; $d <= 7; $d++){
						$jobdate = strtotime($year."W".$week.$d); ?>
						<td>
							<table>
								<tr><td colspan="2" align="center"><b><?=date("d-m-Y", $jobdate)?></b></td></tr>
								<tr><td><table><tr><td><b><?php echo lang("JOBASSIGN::from"); ?></b></td><td><b><?php echo lang("JOBASSIGN::to"); ?></b></td></tr></table></td><td><b><?php echo lang("JOBASSIGN-REPORT::pat_name"); ?></b></td></tr>

						<?php
									$moring_sel = $this->jobassign_model->getexceljoblist($oid, $jobdate);
									foreach($moring_sel as $fet_morning){
										$aid = $fet_morning->aid;
										$patient_id = $fet_morning->patient_id;
										$pname = $this->common->getpatientfsurname($patient_id);
										$start_time_hour = $this->common->commontimeformat($fet_morning->start_time_hour);
										$start_time_min = $this->common->commontimeformat($fet_morning->start_time_min);
										$end_time_hour = $this->common->commontimeformat($fet_morning->end_time_hour);
										$end_time_min = $this->common->commontimeformat($fet_morning->end_time_min);
										$start_time = $start_time_hour.":".$start_time_min;
										$end_time = $end_time_hour.":".$end_time_min;
										?>
										<tr>
											<td><table><tr><td><?=$start_time?></td><td><?=$end_time?></td></tr></table></td>
											<td><?=$pname?></td>
										</tr>
									<?php }
									for($sk = 0; $sk < 16 - count($moring_sel); $sk++){ ?>
<tr><td><table><tr><td>&nbsp;</td><td>&nbsp;</td></tr></table></td>
											<td>&nbsp;</td>
										</tr>
									<?php }

									 ?></table>
						</td><td></td> <?php } ?>
</tr>
			</table>
	</td></tr>
	<tr></tr>
	<?php // }
} ?>

		</table>
<?php }

}
?>