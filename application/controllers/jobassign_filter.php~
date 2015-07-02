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
			 <!--<a href="<?php echo site_url($i18n.'jobassign_filter/create_pdf/'.$pid."/".$filt_oid."/".$dist_id."/".$filter_box_status."/".$week."/".$year) ?>" class="btn btn-rounded btn-primary btn-submit"><?php echo lang("JOBASSIGN-REPORT::export_pdf"); ?></a>-->
			 <a href="#" onclick="pdf_ajax(<?php echo $pid;?>,<?php echo $filt_oid;?>,<?php echo $dist_id;?>,<?php echo $filter_box_status;?>,<?php echo $week;?>,<?php echo $year;?>)" class="btn btn-rounded btn-primary btn-submit"><?php echo lang("JOBASSIGN-REPORT::export_pdf"); ?></a>
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
<option value="" selected="selected"> </option>
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
<div class="scrollbar">
<!--<select name="weekno" id="weekno" onchange="return navigation_select(this.value);">-->
<?php 
/* Get unix time of today
$today = strtotime("today");
for($i = 0; $i <= 445; $i ++){
        $startdate = strtotime("today + $i day - 330 day");
        $enddate = strtotime("today + " . ($i + 6) . " day - 330 day "); 
        
        if(date('D', $startdate) == 'Mon'){
                echo '<option ';
                // check to see if today is inside this week
                if( $startdate < $today && $enddate > $today ){
                echo ' selected="selected"';
                }
                $week = date('W', $startdate);
                $year = date('Y', $startdate);          
                echo ' value="'. $week . '#'.$year.' ">' .date('d/m/Y', $startdate) . " - " . date('d/m/Y', $enddate) . "</option>";

        }
}*/
/*$week_no = $_REQUEST['week_no'];
$start = array();
$week_nav = date("W");
$year_nav = date("Y");
 for($w = $week_nav; $w <= 53; $w++){
        for($d = 1; $d <= 7; $d++){
                if($d == 1){
                        $start[$w]['start'] = date("d/m/Y", strtotime($year_nav."W".$w.$d));
                }
                if($d == 7){
                        $start[$w]['end'] = date("d/m/Y", strtotime($year_nav."W".$w.$d));
                }
        }
} 
//echo "<pre>";
//print_r($start);die;
?>
<select name="weekno" id="weekno_navgation" onchange="return navigation_select('0','0','<?=$pid?>','<?=$filt_oid?>','<?=$dist_id?>','<?=$filter_box_status?>')">
<option value="" selected="selected"> </option>
<?php foreach($start as $key=>$value){ ?>
<option value="<?=$key?>#<?=$year?>"  <?php if($key == $week_no) { echo 'selected="selected"'; } ?>><?php echo $value['start']." - ".$value['end']; ?></option>
<?php } 
*/
?>
<select name="weekno" id="weekno_navgation" onchange="return navigation_select('0','0','<?=$pid?>','<?=$filt_oid?>','<?=$dist_id?>','<?=$filter_box_status?>')">
<option value="">--<?php echo lang("JOBASSIGN::select_designation_week"); ?>--</option>
<?php
$week_nav_list = date("W");
$year_nav = date("Y");
if($week_nav_list == '01') {
     $year_nav_list =  $year_nav;
} else {
     
     $year_nav_list =  $year_nav + 0;
}

$gendate = new DateTime();
$gendate->setISODate($year_nav_list,$week_nav_list); //year , week num , day
$getweek_date = $gendate->format('d-m-Y');
//Get unix time of today
$today = strtotime($getweek_date);
for($i = 0; $i <= 160; $i++){
$startdate = strtotime("$getweek_date + $i day - 5 day");
$enddate = strtotime($getweek_date . ($i + 6) . " day - 5 day "); 

if(date('D', $startdate) == 'Mon'){
echo '<option ';
// check to see if today is inside this week
if( $startdate < $today && $enddate > $today ){
echo ' selected="selected"';
}
$week_nav = date('W', $startdate);
$year_nav = date('Y', $enddate);          
echo ' value="'.$week_nav.'#'.$year_nav.'">' .date('d/m/Y', $startdate) . " - " . date('d/m/Y', $enddate) . "</option>";

}
}

?>
                       
</select>
</div>
<div class="navicon">
<?php
if($next_weeknumber == 02) { 
$back_weeknumber = 52;
$year_week_back = $year-1;

?>
		<a href="javascript:void(0)" class="btn btn-rounded btn-primary btn-submit" onclick="return navigation('<?=$back_weeknumber?>','<?=$year_week_back?>','<?=$pid?>','<?=$filt_oid?>','<?=$dist_id?>','<?=$filter_box_status?>')"><?php echo lang("JOBASSIGN::prev"); ?></a>
		<a href="javascript:void(0)" class="btn btn-rounded btn-primary btn-submit" onclick="return navigation('<?=$next_weeknumber?>','<?=$year?>','<?=$pid?>','<?=$filt_oid?>','<?=$dist_id?>','<?=$filter_box_status?>')"><?php echo lang("JOBASSIGN::next"); ?></a>
<?php
} else {

?>
<a href="javascript:void(0)" class="btn btn-rounded btn-primary btn-submit" onclick="return navigation('<?=$back_weeknumber?>','<?=$year?>','<?=$pid?>','<?=$filt_oid?>','<?=$dist_id?>','<?=$filter_box_status?>')"><?php echo lang("JOBASSIGN::prev"); ?></a>
		<a href="javascript:void(0)" class="btn btn-rounded btn-primary btn-submit" onclick="return navigation('<?=$next_weeknumber?>','<?=$year?>','<?=$pid?>','<?=$filt_oid?>','<?=$dist_id?>','<?=$filter_box_status?>')"><?php echo lang("JOBASSIGN::next"); ?></a>
<?php
}
?>
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
	} elseif($filt_oid == '0' && $dist_id == '0' && $filt_oid == '0' && $pid != '0'){
                    //echo "F2";
                    $job_list = $this->jobassign_model->job_plan_stop_filter_joblist($week, $year, $pid);
                    
                    $result = array();
                    
                    foreach($job_list['listoid']  as $val){
                        $result[] = $val[0]; 
                    }
                    
                    //$result = call_user_func_array("array_merge", $test_array);

                } elseif($filt_oid == '0' && $dist_id == '0'){
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
						<div class="wc-cal-event ui-corner-all" >
							<div class="wc-time ui-corner-all"><span><?=lang("OPERATOR::morning")?></span><div style="float: right; margin-right: 10px;">
							<i class="icon-copy" onclick="copy_reassign('<?php echo $week;?>','<?php echo $year;?>','<?php echo $oid;?>', '<?php echo $jobdate;?>','1')"></i>
							<i class="icon-share" onclick="reassign('<?php echo $week;?>','<?php echo $year;?>','<?php echo $oid;?>', '<?php echo $jobdate;?>','1')"></i><i class="icon-edit" onclick="job_maintain('<?=$week?>','<?=$year?>','<?=$oid?>', '<?=$jobdate?>')"></i>
							</div></div>
							<div class="wc-title" title="" <?=$morleaveclass?>>
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
						<div class="wc-cal-event ui-corner-all" >
							<div class="wc-time ui-corner-all"><span><?=lang("OPERATOR::afternoon")?></span>
							<div style="float: right; margin-right: 10px;">
							<i class="icon-copy" onclick="copy_reassign('<?php echo $week;?>','<?php echo $year;?>','<?php echo $oid;?>', '<?php echo $jobdate;?>','2')"></i>
							<i class="icon-share" onclick="reassign('<?php echo $week;?>','<?php echo $year;?>','<?php echo $oid;?>', '<?php echo $jobdate;?>','2')"></i><i class="icon-edit" onclick="job_afternoon_maintain('<?=$week?>','<?=$year?>','<?=$oid?>', '<?=$jobdate?>')"></i>
							</div>
							
							</div>
							<div class="wc-title" title="" <?=$afterleaveclass?>>
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
							<div class="wc-time ui-corner-all"><span><?=lang("OPERATOR::morning")?></span>
							
							<div style="float: right; margin-right: 10px;">
                                                            
							<i class="icon-share" onclick="reassign('<?php echo $week;?>','<?php echo $year;?>','<?php echo $yellow_oid?>', '<?php echo $jobdate_yellow;?>','1','y')"></i>
							</div></div>
							<div class="wc-title" title=""  <?=$morleaveclass?>>
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
							<div class="wc-time ui-corner-all"><span><?=lang("OPERATOR::afternoon")?></span>
							
							<div style="float: right; margin-right: 10px;">
							
							<i class="icon-share" onclick="reassign('<?php echo $week;?>','<?php echo $year;?>','<?php echo$yellow_oid;?>', '<?php echo $jobdate_yellow;?>','2','y')"></i>
							</div>
							
							</div>
							<div class="wc-title" title=""  <?=$afterleaveclass?>
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

public function create_pdf($pid = null,$filt_oid = null,$dist_id = null,$filter_box_status = null,$cweek = null,$cyear = null)
{
    $this->load->library("Pdf");
    $this->load->model('jobassign_model');
    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);   
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('');
    $pdf->SetTitle('Job Planned');
    $pdf->SetSubject('Job Planned');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');  
    // set default header data
    //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
    //$pdf->setFooterData(array(0,64,0), array(0,64,128));
    // set header and footer fonts
    //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);   
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }  
 
    // ---------------------------------------------------------   
 
    // set default font subsetting mode
    $pdf->setFontSubsetting(true);  
 
    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont('dejavusans', '',7, '', true);  
 
    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage();
 
    // set text shadow effect
    //$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal')); 
        $pid = $_REQUEST['pid'];
        $filt_oid = $_REQUEST['filt_oid'];
        $dist_id = $_REQUEST['dist_id'];
        $filter_box_status = $_REQUEST['filter_box_status'];
        $cweek = $_REQUEST['cweek'];
        $cyear = $_REQUEST['cyear'];
    if($cweek == ""){ $week = date("W"); }else{ $week = $cweek; }
    if($cyear == ""){ $year = date("Y"); }else{ $year = $cyear; }

    // Set some content to print

    
	$html.='<div><table class="element" style="font-family: "Times New Roman", Times, serif;">';
	$html .= '<style>
                       
                        .element:last-child {
                                 page-break-after:auto;
                        }
                        
                 </style>';
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
		$html.='<tr style="page-break-after:always;"><td>';
		$html.='<table><tr><h1 style="font-family:sans-serif;">'.$optname.'</h1>';
		for($d=1;$d<=7;$d++) {
			$jobdate = strtotime($year."W".$week.$d);
			$html.='<td><div><span style="font-family: "Times New Roman", Times, serif;text-shadow: none;">'.date("M d,Y", $jobdate).'</span>
		</div>';
			$html.='<div class="myH1" style="font-family: "Times New Roman", Times, serif;text-shadow: none;height:195px !important;"><b>Mattina</b>';
			$moring_sel = $this->jobassign_model->getmorningafterjoblist($oid, $jobdate,1);
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
				$html.='<div>
					<span style="font-size:5.5px;font-family: "Times New Roman", Times, serif;text-shadow: none;">'.$start_time.':'.$end_time.'</span>
					<span style="font-size:5.5px;float:left;width:48%;font-family:sans-serif;text-shadow: none;">'.$pname.'</span>
				</div>';
			
			
			}
			
			for($sk = 0; $sk < 10 - count($moring_sel); $sk++){ 
			        $html.='<div>
					<span style="font-size:5.8px;text-shadow: none;">&nbsp;</span>
					<span style="font-size:5.8px;float:left;width:48%;">&nbsp;</span>
				</div>';
			
			}
																			
			$html.='</div>';
			$html.='<div class="myH1" style="height:195px !important;font-family:sans-serif;"><b>Pomeriggio</b>';
			$after_sel = $this->jobassign_model->getmorningafterjoblist($oid, $jobdate,2);
			foreach($after_sel as $fet_morning){
				$aid = $fet_morning->aid;
				$patient_id = $fet_morning->patient_id;
				$pname = $this->common->getpatientfsurname($patient_id);
				$start_time_hour = $this->common->commontimeformat($fet_morning->start_time_hour);
				$start_time_min = $this->common->commontimeformat($fet_morning->start_time_min);
				$end_time_hour = $this->common->commontimeformat($fet_morning->end_time_hour);
				$end_time_min = $this->common->commontimeformat($fet_morning->end_time_min);
				$start_time = $start_time_hour.":".$start_time_min;
				$end_time = $end_time_hour.":".$end_time_min;
				$html.='<div>
					<span style="font-size:5.8px;font-family: "Times New Roman", Times, serif;text-shadow: none;">'.$start_time.':'.$end_time.'</span>
					<span style="font-size:5.8px;float:left;width:48%;font-family: "Times New Roman", Times, serif;text-shadow: none;">'.$pname.'</span>
				</div>';
			
			}
			
			$html.='</div>';
			$html.='</td>';
		
		}
		$html.='</tr></table>';
		$html.='</td></tr>';
		//break;
	}
	$html.='</table></div>';
        //echo "<pre>";
        //print_r($html);die;
    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);  
    $pdf->lastPage(); 
    // ---------------------------------------------------------   
     //$pdf->Output('job_planned.pdf', 'D');
        $filelocation = 'pdf_data/';
        $pdf->Output($filelocation.'job_planned.pdf', 'F');
        echo test;die;
       
}
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
