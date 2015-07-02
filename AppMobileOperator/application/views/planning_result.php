<?php $this->load->view('common/head'); ?>
<body>
<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <div class="rightpanel">
       <?php //$this->load->view('breadcrumb'); ?>
<?php date_default_timezone_set("Asia/Kolkata");
				$oid = $operator;
				$jobdate = $sdate;
				//$jobdate = strtotime(date("d-m-Y", $jobdate));
				$optname = $this->common->getoperatorfirstname($oid);
					 ?>
        <div class="pageheader">
            <div class="pagetitle">
            	<h1><?php //echo lang("SEARCH::head")." : ".date("d-m-Y", $jobdate)
				echo date("d-m-Y", $jobdate); ?></h1>
            </div>

        </div><!--pageheader-->
        <div class="maincontent">
            <div class="maincontentinner">

            <div class="widgetbox box-inverse span12">
            <h4 class="widgettitle"><?php echo lang("SEARCH::head"); ?></h4>
                <div class="widgetcontent nopadding">
<table class="wc-time-slots" style="width: 98%; margin: 0px auto;">
			<tbody>

				<tr class="optbox">
					<td><fieldset style="border: 1px solid; padding: 5px; background-color: rgb(182, 215, 168);">
  <legend style="color: #333333; display: block; font-size: 21px; width: auto;"><?=$optname?></legend>
				<table style="width: 100%;"><tr>
					<?php
						$opt_leave = $this->plan_model->getoperatorleave($oid,$jobdate);
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
<td class="morning">
	<div class="wc-day-column-inner schedule">
						<div class="wc-cal-event ui-corner-all" <?=$morleaveclass?>>
							<div class="wc-time ui-corner-all"><span><?=lang("SEARCH::morning")?></span><a href="<?php echo site_url($this->i18n.'home/job_reassign/'.$oid.'/'.$jobdate.'/1') ?>"><i class="icon-share"></i></a></div>
							<div class="wc-title" title="">
								<ul class="jobpatientlist">
									<?php
									$moring_sel = $this->plan_model->getmorningafterjoblist($oid, $jobdate,'1');
									echo "<pre>";
									print_r($moring_sel);die;
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
							<li style="width: 100%; float: left; list-style: none;"><span style="float: left; margin: 6px; color: #97400C;" href="javascript:void(0)"><?=$start_time?> - <?=$end_time?> <?=$pname?></span>
								<a style="float: right;" href="<?php echo site_url($this->i18n.'home/single_job_reassign/'.$aid.'/'.$oid.'/'.$jobdate.'/1') ?>"><i class="icon-share"></i></a>

							</li>
									<?php } ?>
								</ul>
							</div></div>
					</div>
					<div class="wc-day-column-inner schedule">
						<div class="wc-cal-event ui-corner-all" <?=$afterleaveclass?>>
							<div class="wc-time ui-corner-all"><span><?=lang("SEARCH::afternoon")?></span><a href="<?php echo site_url($this->i18n.'home/job_reassign/'.$oid.'/'.$jobdate.'/2') ?>"><i class="icon-share"></i></a></div>
							<div class="wc-title" title="">
								<ul class="jobpatientlist">
									<?php
									$after_sel = $this->plan_model->getmorningafterjoblist($oid, $jobdate,'2');
									foreach($after_sel as $fet_after){
										$after_aid = $fet_after->aid;
										$after_patient_id = $fet_after->patient_id;
										$after_pname = $this->common->getpatientfsurname($after_patient_id);
										$after_start_time_hour = $this->common->commontimeformat($fet_after->start_time_hour);
										$after_start_time_min = $this->common->commontimeformat($fet_after->start_time_min);
										$after_end_time_hour = $this->common->commontimeformat($fet_after->end_time_hour);
										$after_end_time_min = $this->common->commontimeformat($fet_after->end_time_min);
										$after_start_time = $after_start_time_hour.":".$after_start_time_min;
										$after_end_time = $after_end_time_hour.":".$after_end_time_min;
										?>
							<li style="width: 100%; float: left; list-style: none;"><span style="float: left; margin: 6px; color: #97400C;" href="javascript:void(0)"><?=$after_start_time?> - <?=$after_end_time?> <?=$after_pname?></span>
								<a style="float: right;" href="<?php echo site_url($this->i18n.'home/single_job_reassign/'.$after_aid.'/'.$oid.'/'.$jobdate.'/2') ?>"><i class="icon-share"></i></a>

							</li>
									<?php } ?>
								</ul>
							</div></div>
					</div>
</td>
</tr>
			</tbody>
			</table></fieldset>
	</td></tr>
		</table>

		<p class="stdformbutton finalsubmit" style="text-align:center;">
                                <button type="button" class="btn btn-back" style="width: 98%;" onclick="location.href = '<?php echo site_url($this->i18n.'home'); ?>';"><?php echo ( sprintf( lang("SEARCH_RESULT::back_to_search")) ); ?></button>
           </p>
</div><!--widgetcontent-->

            </div><!--widget-->

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
