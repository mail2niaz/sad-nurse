<?php $this->load->view('common/head'); ?>
<body>
<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <div class="rightpanel">
       <?php //$this->load->view('breadcrumb'); ?>

        <div class="pageheader">
            <div class="pagetitle">
            	<h1><?php //echo lang("SEARCH::head")." : ".date("d-m-Y", $jobdate);
            	echo date("d-m-Y", $jobdate);
				 ?></h1>
            </div>
        </div><!--pageheader-->
        <div class="maincontent">
            <div class="maincontentinner">

            <div class="widgetbox box-inverse span12">
                <div class="widgetbox box-inverse span9">
<h4 class="widgettitle"><span><?php echo ( sprintf( lang("JOBASSIGN::reassign_job")) ); ?></span></h4>
                <div class="widgetcontent nopadding stdform stdform2">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div>'; <?php } ?>

           <?php $attributes = array('id' => 'formjobreassign', 'name' => 'form_validate');
           echo form_open('',$attributes); ?>
           <input type="hidden" name="siteurl" value="<?php echo site_url($this->i18n.'jobassign/check_optweek_availabel') ?>" id = "siteurl"/>
          <input type="hidden" name="formsuburl" value="<?php echo site_url($this->i18n.'jobassign/submitreassignform') ?>" id = "formsuburl"/>
           <input type="hidden" name="oid" id="oid" value="<?=$oid?>" />
           <input type="hidden" name="movenav_url" value="<?php echo site_url($this->i18n.'home/successplan_search'); ?>" id="movenav_url" />
           <input type="hidden" value="<?=$jobdate?>" id="hiddendate" name="hiddendate" />
           <input type="hidden" value="<?=$section?>" id="hiddensection" name="hiddensection" />

		<p style="width: 90%; margin: 0px auto; overflow: hidden; padding: 10px;">
			<label style="float: left; width: 100%;"><?php echo lang("JOBASSIGN::reassign_date"); ?></label>
			<span style="float: left; width: 98%;">
				<input type="text" value="<?=date("d-m-Y", $jobdate)?>" readonly="readonly" id="job_date_assign" name="job_date_assign" style="width: 100%;" />
			</span>
		</p>
		<p class="optassign" style="width: 90%; margin: 0px auto; overflow: hidden; padding: 10px;">
			<label style="float: left; width: 100%;"><?php echo lang("JOBASSIGN::reassign_operator"); ?></label>
			<span style="float: left; width: 100%;">
				<input type="hidden" name="roid" id="roid" />
			<select name="reassign_opt" id="reassign_opt" onchange="checkoptexist(this.value);">
								<option value="0" selected="selected"><?php echo lang("JOBASSIGN::select"); ?></option>
										<?php
											$reassign_opt = $this->common->getoperatorlist_new();
											if(count($reassign_opt) > 0){
										foreach($reassign_opt as $reassign_opt_list){

											$foid = $reassign_opt_list->oid;
											$fname = $reassign_opt_list->firstname;
											$lname = $reassign_opt_list->lastname;
											$name = $lname." ".$fname; if($foid != $oid){ ?>
											<option value="<?=$foid?>"><?=$name?><?php echo " (".$this->common->getrolename($reassign_opt_list->role).")"; ?></option>
									  <?php } } }else{ ?>
											<option value=""><?php echo lang('INTERVENT::dataempty'); ?></option>
									  <?php } ?>
									</select><br>
									<span class="error_msg"></span>
						</span>
						</p>
			<?php
			if($cfrom == 'single'){
				$moring_sel = $this->plan_model->getparticularjoblist($aid,$oid, $jobdate, $section);
			}else{
				$moring_sel = $this->plan_model->getmorningafterjoblist($oid, $jobdate, $section);
			}

		 $jlistcount = count($moring_sel);
		 ?>
		 <input type="hidden" name="joblistcount" id="joblistcount" value="<?=$jlistcount?> " />
		<?php
		$sk = 1;
		unset($timedata);
		unset($piddata);
		$timedata = array();
		$piddata = array();
		if($jlistcount > 0){
		foreach($moring_sel as $fet_morning){
			$aid = $fet_morning->aid;
			$patient_id = $fet_morning->patient_id;
			$piddata[] = $fet_morning->patient_id;
			$pname = $this->common->getpatientsurname($patient_id);
			$start_time_hour = $this->common->commontimeformat($fet_morning->start_time_hour);
			$start_time_min = $this->common->commontimeformat($fet_morning->start_time_min);
			$end_time_hour = $this->common->commontimeformat($fet_morning->end_time_hour);
			$end_time_min = $this->common->commontimeformat($fet_morning->end_time_min);
			$start_time = $start_time_hour.":".$start_time_min;
			$end_time = $end_time_hour.":".$end_time_min;
			$start_end_time[] = $aid."&".$patient_id."&".$fet_morning->start_time_hour.":".$fet_morning->start_time_min."^".$fet_morning->end_time_hour.":".$fet_morning->end_time_min;
			if($sk == 1){
				$timedata[] = $start_time;
				$start_hour = $fet_morning->start_time_hour;
				$start_min = $fet_morning->start_time_min;
			}
			if(count($moring_sel) == $sk){
				$timedata[] = $end_time;
				$end_hour = $fet_morning->end_time_hour;
				$end_min = $fet_morning->end_time_min;
			}
		$sk++; }
 ?>
		<input type="hidden" name="shour" id="shour" value="<?=$start_hour?>" />
		<input type="hidden" name="smin" id="smin" value="<?=$start_min?>" />
		<input type="hidden" name="ehour" id="ehour" value="<?=$end_hour?>" />
		<input type="hidden" name="emin" id="emin" value="<?=$end_min?>" />
		<input type="hidden" name="patient_ids" id="patient_ids" value="<?=implode(",", array_unique($piddata))?>" />
		<input type="hidden" name="validatealldata" id="validatealldata" value="<?=implode(",", $start_end_time)?>" />
		<input type="hidden" name="section" id="section" value="<?=$section?>" />

		<?php } ?>
				<p class="stdformbutton finalsubmit" style="text-align:center;">
					<button type="button" class="btn subreassign btn-conform" style="width: 98%;" onclick="submit_reassign();"><?php echo lang("COMMON::sub_btn"); ?></button>
                    <button type="button" class="btn btn-back" style="width: 98%;" onclick="location.href = '<?php echo site_url($this->i18n.'home/successplan_search/'.$oid.'/'.$jobdate); ?>';"><?php echo lang("JOBASSIGN::back_to_search"); ?></button>
           </p>

<?php echo form_close(); ?> </div></div>

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
