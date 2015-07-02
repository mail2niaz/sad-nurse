<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Jobassign extends CI_Controller {

  function __construct()
  {
    parent::__construct();
	if(!$this->session->userdata('logged_in'))
    {
	redirect('login', 'refresh');
	}
	$this->load->language('mci');
	$this->load->library('breadcrumbs');
	$this->load->model('jobassign_model');
	$this->load->model('jobassign_pop_model');
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
		$this->breadcrumbs->push(lang('COMMON::home'), site_url('home'));
		$this->breadcrumbs->push( lang('JOBASSIGN::joblist'), site_url('jobassign'));
		/* end */
      $this->load->view('joblist', $data);
  }


    function passigno()
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


		$ss = $this->jobassign_model->add_passigno();
		if($this->lang->mci_current() == ""){
	  	$i18n = $this->lang->mci_current();
	  }else{
		$i18n = $this->lang->mci_current()."/";
	  }
		redirect($i18n.'jobassign','refresh');
  }

    function ajax_data()
  {
  	/* Session Variables */
      	$session_data=$this->session->userdata('logged_in');
		$data['username']=$session_data['username'];
      /* Session Variables */
if($this->lang->mci_current() == ""){
	  	$data['i18n'] = $this->lang->mci_current();
	  }else{
		$data['i18n'] = $this->lang->mci_current()."/";
	  }

		$this->load->view('ajax_result_joblist', $data);
  }

function add_job($week,$year) {
		if($this->lang->mci_current() == ""){
	  		$i18n = $this->lang->mci_current();
	  	}else{
			$i18n = $this->lang->mci_current()."/";
	  	}

		$weekNumber = date("W");
		?>

		<div class="widgetbox box-inverse span9">
		<script type="text/javascript" src="<?php echo base_url()?>js/job_assign_combo_jquery.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
            	jQuery("#job_date_assign").datepicker({
					inline: true,
					dateFormat: 'dd-mm-yy',
					changeMonth: true,
					changeYear: true,
					firstDay: 1,
					defaultDate: "+1w",
					yearRange: "-100:+0",
				});
jQuery('#map_canvas1').hide();

$('.combo').change(function(){
	var combo_hour_to_min = parseInt($('.hourcombo').val()) ;
	var combo_min = parseInt($('.mincombo').val());
	total_combo_min = combo_hour_to_min +':'+ combo_min;

	int_hour_to_min = parseInt($('#int_hour').val());
	int_min = parseInt($('#int_min').val());
	total_int_val = int_hour_to_min+':'+int_min;
	var totalTime = addTime(total_combo_min, total_int_val);
	jQuery('#start_hid_hour').val(combo_hour_to_min);
	jQuery('#start_hid_min').val(combo_min);
	hideoperatorlist();
})

/*$('.hourcombo').change(function(){
	var hour = $('.hourcombo').val();
	var weekdays = $('#weekdays').val();
	var current_week = $('#current_week').val();
	var pidval = $('#pidval').val();
	var siteurl = '<?php echo site_url($i18n.'jobassign/get_nearest_operator') ?>';
		jQuery.post(siteurl,
           { hour: ""+hour+"", weekdays: ""+weekdays+"", current_week: ""+current_week+"", pidval: ""+pidval+"" },
               function(data){
               	jQuery('#map_canvas1').show();
               	if(data != ''){
				jQuery('#map_canvas1').html(data);
               	}
	       });
})*/

function addTime()
{
    if (arguments.length < 2)
    {
        if (arguments.length == 1 && isFormattedDate(arguments[0])) return arguments[0];
        else return false;
    }

    var time1Split, time2Split, totalHours, totalMinutes;
    if (isFormattedDate(arguments[0])) var totalTime = arguments[0];
    else return false;

    for (var i = 1; i < arguments.length; i++)
    {
        // Add them up
        time1Split = totalTime.split(':');
        time2Split = arguments[i].split(':');

        totalHours = parseInt(time1Split[0]) + parseInt(time2Split[0]);
        totalMinutes = parseInt(time1Split[1]) + parseInt(time2Split[1]);

        // If total minutes is more than 59, then convert to hours and minutes
        if (totalMinutes > 59)
        {
            totalHours += Math.floor(totalMinutes / 60);
            totalMinutes = totalMinutes % 60;
        }
		var endhourcombo = document.getElementById('endhourcombo');
	    for(var i = 0, j = endhourcombo.options.length; i < j; ++i) {
	        if(endhourcombo.options[i].value == totalHours) {
	           jQuery(endhourcombo.options[i]).attr('selected','selected');
	           break;
	        }
	    }
	    var endmincombo = document.getElementById('endmincombo');
	    for(var k = 0, s = endmincombo.options.length; k < s; ++k) {
	        if(endmincombo.options[k].value == totalMinutes) {
	           jQuery(endmincombo.options[k]).attr('selected','selected');
	           break;
	        }
	    }
        totalTime = totalHours + ':' + padWithZeros(totalMinutes);
    }

    return totalTime;
}

function isFormattedDate(date)
{
    var splitDate = date.split(':');
    if (splitDate.length == 2 && (parseInt(splitDate[0]) + '').length <= 2 && (parseInt(splitDate[1]) + '').length <= 2) return true;
    else return false;
}

function padWithZeros(number)
{
    var lengthOfNumber = (parseInt(number) + '').length;
    if (lengthOfNumber == 2) return number;
    else if (lengthOfNumber == 1) return '0' + number;
    else if (lengthOfNumber == 0) return '00';
    else return false;
}
});

function dist_non_dist_optpry (checkbox, roles, dist_id, selclass) {
	var siteurl = '<?php echo site_url($i18n.'jobassign/checkbox_dist_opt_pry') ?>';
	if($('#'+checkbox).is(":checked")){
		var action = 'dist';
		jQuery.post(siteurl,
           { dist_id: ""+dist_id+"", roles: ""+roles+"", action: ""+action+"" },
               function(data){
               	if(data != ''){

               		jQuery('#'+selclass).html('');
               		jQuery('#'+selclass).html(data);
               	}
	       });
  }else{
  	var action = 'nondist';
  		jQuery.post(siteurl,
           { dist_id: ""+dist_id+"", roles: ""+roles+"", action: ""+action+"" },
               function(data){
               	if(data != ''){
               		jQuery('#'+selclass).html('');
               		jQuery('#'+selclass).html(data);
               	}
	       });

  }
}

function checkcontractdetails (date) {
  var cid = jQuery('#cid').val();
  var csiteurl = '<?php echo site_url($i18n.'jobassign/checkcontractdetails_contract') ?>';
  jQuery.post(csiteurl,
           { cid: ""+cid+"", date: ""+date+"" },
               function(data){
            //   	alert(data);
               	if(data == 'yes'){
               		jQuery('#update_operator_list1').hide();
               		alert('<?php echo ( sprintf( lang("JOBASSIGN::check_job_contract")) ); ?>');
               	}
	       });
}

</script>
                <h4 class="widgettitle"><span><?php echo ( sprintf( lang("JOBASSIGN::assignjob")) ); ?></span></h4>
                <div class="widgetcontent nopadding stdform stdform2" style="width: 866px;">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div>'; <?php } ?>

           <?php $attributes = array('id' => 'formjobassign', 'name' => 'form_validate');
           echo form_open('',$attributes); ?>

					<div class="map_data">
<div style="float: left;">

                            <div class="jobautocomp">
                            	<input type="hidden" name="siteurl" value="<?php echo site_url($i18n.'jobassign/check_optweek_availabel') ?>" id = "siteurl"/>
                            	<input type="hidden" name="passurl" value="<?php echo site_url($i18n.'jobassign/passigno') ?>" id="passurl" />
<input type="hidden" name="movenav_url" value="<?php echo site_url($i18n.'jobassign_nav/navigation'); ?>" id="movenav_url" />
                            	<input type="hidden" name="fetch_previous_job_data" value="<?php echo site_url($i18n.'jobassign/fetch_previous_job_data') ?>" id="fetch_previous_job_data" />
                            	<input type="hidden" name="fetch_patient_intervent" value="<?php echo site_url($i18n.'jobassign/fetch_patient_intervent') ?>" id="fetch_patient_intervent" />
                            	<input type="hidden" name="fetch_all_data" value="<?php echo site_url($i18n.'jobassign/fetch_all_data') ?>" id="fetch_all_data" />
                            	<input type="hidden" name="action" value="new" id="action" />
                            	<input type="hidden" name="aid" value="" id="aid" />
                            	<input type="hidden" id="update_operator_list_url" value="<?php echo site_url($i18n.'jobassign/get_updated_opt_list') ?>" name="update_operator_list_url" />
                            	<input type="hidden" name="moveweek" id="moveweek" value="<?=$week?>" />
                            	<input type="hidden" name="moveyear" id="moveyear" value="<?=$year?>" />

					<label><?php echo ( sprintf( lang("JOBASSIGN::patient_list")) ); ?></label>
                            <span class="field">
							<select id="patient_id" name="patient_id">
							<option value="" selected="selected"><?php echo lang("JOBASSIGN::select"); ?></option>
                            <?php $contract_patient_list = $this->jobassign_pop_model->get_contract_patient_list();
							if(count($contract_patient_list) > 0){
                             foreach($contract_patient_list as $patient_list){
                            	$pid = $patient_list->pid;
								 $pname = $this->common->getpatientname($pid);
								?>
								<option <?php if(set_value('patient_id') == $pid){ ?> selected="selected" <?php } ?> value="<?=$pid?>">PID-<?=$pid?>(<?php echo $pname; ?>)</option>
                          	<?php } }else{ ?>
								<option value=""><?php echo lang('INTERVENT::dataempty'); ?></option>
                        	<?php } ?>
							</select>

						</span>
						</div>

						<div class="jobautocomp">
                            <label><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?></label>
                            <span class="field intervent_type_list">
                            	<select id="intervent_type" name="intervent_type">
								<option value="" selected="selected"><?php echo lang("JOBASSIGN::select"); ?></option>
								</select>
                            </span>
						</div>
		<div class="jobautocomp">
	        <label><?php echo ( sprintf( lang("JOBASSIGN::assign_date")) ); ?><span class="rstar">*</span></label>
	        <span class="field"><input type="text" readonly="readonly" name="job_date_assign" id="job_date_assign" onchange="checkcontractdetails(this.value); hideoperatorlist()" /></span>
		</div>

		<div class="jobautocomp">
                            <label><?php echo ( sprintf( lang("JOBASSIGN::stime")) ); ?><span class="rstar">*</span></label>
                            <span class="field">

								<input type="hidden" name="start_hid_hour" id="start_hid_hour" />
								<input type="hidden" name="start_hid_min" id="start_hid_min" />
                            	<select name="hourcombo" class="hourcombo combo" id="hourcombo">
	                            	<option value="0">00</option>
                            	<?php for($st = 6; $st <= 22; $st++ ){ ?>
     								<option value="<?=$st?>"><?php echo $this->common->commontimeformat($st);?></option>
                            	<?php } ?>
							</select>
<select name="mincombo" class="mincombo combo" id="mincombo">
	<?php for($mt = 0; $mt <= 55; $mt = $mt+5 ){ ?>
     								<option value="<?=$mt?>"><?php echo $this->common->commontimeformat($mt);?></option>
                            	<?php } ?>
</select>(HH:MM)</span>
						</div>
						<div class="jobautocomp">
                            <label><?php echo ( sprintf( lang("JOBASSIGN::etime")) ); ?><span class="rstar">*</span></label>
                            <span class="field">
                            	<input type="hidden" name="end_hid_hour" id="end_hid_hour" />
                            	<input type="hidden" name="end_hid_min" id="end_hid_min" />
								<select name="endhourcombo" class="endhourcombo" id="endhourcombo" onchange="change_end_time(this.value,'endhourcombo')">
	                            	<option value="0">00</option>
                            	<?php for($eht = 6; $eht <= 22; $eht++ ){ ?>
     								<option value="<?=$eht?>"><?php echo $this->common->commontimeformat($eht);?></option>
                            	<?php } ?>
							</select>
							<select name="endmincombo" class="endmincombo" id="endmincombo" onchange="change_end_time(this.value,'endmincombo')">
								<?php for($emt = 0; $emt <= 55; $emt = $emt+5 ){ ?>
     								<option value="<?=$emt?>"><?php echo $this->common->commontimeformat($emt);?></option>
                            	<?php } ?>
							</select>(HH:MM)</span>
                            	</span>
						</div>

						</div>
<div id="map_canvas1" style="height: 300px; float: right; display: block; margin-left: 10px; width: 35%;"></div>
					</div>
					<div class="putalldata"></div>
			<p class="stdformbutton finalsubmit" style="text-align:right;">
                                <a href="javascript:void(0);" onclick="validate();" class="jobsubbtn btn btn-primary btn-submit"><?php echo ( sprintf( lang("COMMON::sub_btn")) ); ?></a>
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo ( sprintf( lang("COMMON::reset_btn")) ); ?></button>
           </p>
<?php echo form_close(); ?> </div></div>
<?php
    }

function edit_jobassign_popup($week,$year,$aid) {
	$session_data=$this->session->userdata('logged_in');
	$sdelete = $session_data['sdelete'];
	if($this->lang->mci_current() == ""){
	  	$i18n = $this->lang->mci_current();
	  }else{
		$i18n = $this->lang->mci_current()."/";
	  }

        $this->load->model('jobassign_model', 'inttype');
		$this->load->model('common');
       $query= $this->inttype->entries_type($intval);
		 $sel_saved_data = "SELECT * FROM assign_job_list WHERE aid = '$aid'";
		$qry_saved_data = mysql_query($sel_saved_data);
		$cnt_saved_data = mysql_num_rows($qry_saved_data);
		$fet_saved_data = mysql_fetch_assoc($qry_saved_data);
		$aid = $fet_saved_data['aid'];
		$patient_id = $fet_saved_data['patient_id'];
		$pry_oid = $fet_saved_data['pry_oid'];
		$sec_oid = $fet_saved_data['sec_oid'];
		$sup_id = $fet_saved_data['sup_id'];
		$contract_int_id = $fet_saved_data['contract_int_id'];
		$cid = $fet_saved_data['cid'];
		$intervent_type_id = $fet_saved_data['intervent_type_id'];
		$job_date_assign = date("d-m-Y", strtotime($fet_saved_data['job_date_assign']));
		$stime_hour = $fet_saved_data['start_time_hour'];
		$etime_hour = $fet_saved_data['end_time_hour'];
		if(strlen($fet_saved_data['start_time_min']) > 1){
			$smin = $fet_saved_data['start_time_min'];
		}else{
			$smin = "0".$fet_saved_data['start_time_min'];
		}
		if(strlen($fet_saved_data['end_time_min']) > 1){
			$emin = $fet_saved_data['end_time_min'];
    	}else{
    		$emin = "0".$fet_saved_data['end_time_min'];
    	}
		$contract_tbl_details = $this->jobassign_model->getinterventtime($contract_int_id);
		$intervent_fortnightly = $contract_tbl_details[0]->intervent_fortnightly;
		$suspendable = $contract_tbl_details[0]->suspendable;
		$intervent_hour = $contract_tbl_details[0]->intervent_hour;
		$exp_hours = explode(":", $intervent_hour);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}
		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}

		$get_pat_det = mysql_fetch_assoc(mysql_query("SELECT * FROM patients where pid = '$patient_id'"));
		$latlang = $get_pat_det['latlang'];
		$pname = mysql_escape_string($get_pat_det['surname'])." ".mysql_escape_string($get_pat_det['pname']);
		$address = mysql_escape_string($get_pat_det['address']);
		$note = mysql_escape_string($get_pat_det['note']);
		?>

		<div class="widgetbox box-inverse span9">
<script type="text/javascript" src="<?php echo base_url()?>js/job_assign_combo_jquery.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
            	 jQuery("#job_date_assign").datepicker({
					inline: true,
					dateFormat: 'dd-mm-yy',
					changeMonth: true,
					changeYear: true,
					firstDay: 1,
					defaultDate: "+1w",
					yearRange: "-100:+0",
				});
/* MAp */
		var name = '<?php echo $pname;?>';
		var address = '<?php echo $address;?>';
		var time = '<?=$stime_hour?>:<?=$smin?>' + ' TO '+ '<?=$etime_hour?>:<?=$emin?>';
      var map = new google.maps.Map(document.getElementById('map_canvas1'), {
      zoom: 14,
      center: new google.maps.LatLng(<?php echo $latlang;?>),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker;
    	var pat_latlng = '<?php echo $latlang;?>';
      	var myarr = pat_latlng.split(",");

      marker = new google.maps.Marker({
        position: new google.maps.LatLng(myarr[0], myarr[1]),
        map: map
      });
       infowindow.setContent('<div class="map-content"><h4>' + time + '</h4>' + name + '<br />' + address + '</div>');
		infowindow.open(map, marker);

 			/* map End */

    /*jQuery('.hourcombo').change(function(){
	var hour = $('.hourcombo').val();
	var weekdays = $('#weekdays').val();
	var current_week = $('#current_week').val();
	var pidval = $('#pidval').val();
	var siteurl = '<?php echo site_url($i18n.'jobassign/get_nearest_operator') ?>';
		jQuery.post(siteurl,
           { hour: ""+hour+"", weekdays: ""+weekdays+"", current_week: ""+current_week+"", pidval: ""+pidval+"" },
               function(data){
               	if(data != ''){
				jQuery('#map_canvas1').html(data);
               	}
	       });
})*/

 			/* map End */

jQuery('#job_date_assign').change(function(){
	jQuery('.pry .custom-combobox-input').val('');
	jQuery('.sec .custom-combobox-input').val('');
	jQuery('.sup .custom-combobox-input').val('');
	jQuery('#pry_operator').val('');
	jQuery('#sec_operator').val('');
	jQuery('#sup_operator').val('');
	jQuery('.sup_msg').html('');
	jQuery('.sec_msg').html('');
	jQuery('.pry_msg').html('');
   	jQuery('.default_record').hide();
   	jQuery('.finalsubmit').hide();
})

jQuery('.combo').change(function(){
	var combo_hour_to_min = parseInt(jQuery('.hourcombo').val()) ;
	var combo_min = parseInt(jQuery('.mincombo').val());
	total_combo_min = combo_hour_to_min +':'+ combo_min;
	int_hour_to_min = parseInt(jQuery('#int_hour').val());
	int_min = parseInt(jQuery('#int_min').val());
	total_int_val = int_hour_to_min+':'+int_min;
	var totalTime = addTime(total_combo_min, total_int_val);
	jQuery('#start_hid_hour').val(combo_hour_to_min);
	jQuery('#start_hid_min').val(combo_min);
	hideoperatorlist();
})

function addTime()
{
    if (arguments.length < 2)
    {
        if (arguments.length == 1 && isFormattedDate(arguments[0])) return arguments[0];
        else return false;
    }

    var time1Split, time2Split, totalHours, totalMinutes;
    if (isFormattedDate(arguments[0])) var totalTime = arguments[0];
    else return false;

    for (var i = 1; i < arguments.length; i++)
    {
        // Add them up
        time1Split = totalTime.split(':');
        time2Split = arguments[i].split(':');

        totalHours = parseInt(time1Split[0]) + parseInt(time2Split[0]);
        totalMinutes = parseInt(time1Split[1]) + parseInt(time2Split[1]);

        // If total minutes is more than 59, then convert to hours and minutes
        if (totalMinutes > 59)
        {
            totalHours += Math.floor(totalMinutes / 60);
            totalMinutes = totalMinutes % 60;
        }
        		var endhourcombo = document.getElementById('endhourcombo');
	    for(var i = 0, j = endhourcombo.options.length; i < j; ++i) {
	        if(endhourcombo.options[i].value == totalHours) {
	           jQuery(endhourcombo.options[i]).attr('selected','selected');
	           break;
	        }
	    }
	    var endmincombo = document.getElementById('endmincombo');
	    for(var k = 0, s = endmincombo.options.length; k < s; ++k) {
	        if(endmincombo.options[k].value == totalMinutes) {
	           jQuery(endmincombo.options[k]).attr('selected','selected');
	           break;
	        }
	    }
        totalTime = totalHours + ':' + padWithZeros(totalMinutes);
    }

    return totalTime;
}

function isFormattedDate(date)
{
    var splitDate = date.split(':');
    if (splitDate.length == 2 && (parseInt(splitDate[0]) + '').length <= 2 && (parseInt(splitDate[1]) + '').length <= 2) return true;
    else return false;
}

function padWithZeros(number)
{
    var lengthOfNumber = (parseInt(number) + '').length;
    if (lengthOfNumber == 2) return number;
    else if (lengthOfNumber == 1) return '0' + number;
    else if (lengthOfNumber == 0) return '00';
    else return false;
}
});
</script>

                <h4 class="widgettitle"><span><?php echo ( sprintf( lang("JOBASSIGN::assignjob")) ); ?></span></h4>
                <div class="widgetcontent nopadding stdform stdform2" style="width: 866px;">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div>'; <?php } ?>

           <?php $attributes = array('id' => 'formjobassign', 'name' => 'form_validate');
           echo form_open('',$attributes); ?>

	<div class="map_data">
<div style="float: left;">
                            <div class="jobautocomp">
                            	<?php $cweekNumber = date("W");
								if( $gweekNumber == "undefined"){
									$weekNumber = $cweekNumber;
								}elseif($gweekNumber  > $cweekNumber){
                            		$weekNumber = $gweekNumber;
                            	}else{
                            		$weekNumber = $cweekNumber;
                            	} ?>

                            	<input type="hidden" name="siteurl" value="<?php echo site_url($i18n.'jobassign/check_optweek_availabel') ?>" id = "siteurl"/>
                            	<input type="hidden" name="passurl" value="<?php echo site_url($i18n.'jobassign/passigno') ?>" id="passurl" />
<input type="hidden" name="movenav_url" value="<?php echo site_url($i18n.'jobassign_nav/navigation'); ?>" id="movenav_url" />
                            	<input type="hidden" name="fetch_patient_intervent" value="<?php echo site_url($i18n.'jobassign/fetch_patient_intervent') ?>" id="fetch_patient_intervent" />
                            	<input type="hidden" name="fetch_all_data" value="<?php echo site_url($i18n.'jobassign/fetch_all_data') ?>" id="fetch_all_data" />
								<input type="hidden" name="action" value="edit" id="action" />
                            	<input type="hidden" name="aid" value="<?=$aid?>" id="aid" />
                            	<input type="hidden" name="cid" value="<?=$cid?>" id="cid" />
                            	<input type="hidden" name="contract_int_id" value="<?=$contract_int_id?>" id="contract_int_id" />
                            	<input type="hidden" id="update_operator_list_url" value="<?php echo site_url($i18n.'jobassign/get_updated_opt_list') ?>" name="update_operator_list_url" />
                            	<input type="hidden" id="jobremoveurl" value="<?php echo site_url($i18n.'jobassign/deletejobassign') ?>" name="jobremoveurl" />
                            	<input type="hidden" name="moveweek" id="moveweek" value="<?=$week?>" />
                            	<input type="hidden" name="moveyear" id="moveyear" value="<?=$year?>" />


                            <label><?php echo ( sprintf( lang("JOBASSIGN::patient_list")) ); ?></label>
                            <span class="field">
                            	<input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>" />
                            	<input type="text" readonly="readonly" class="input-large" name="pid" value="<?php echo  $this->common->getpatientname($patient_id); ?>" /></span>
						</div>
						<div class="jobautocomp">
                            <label><?php echo ( sprintf( lang("JOBASSIGN::intervent_type")) ); ?></label>
                            <span class="field">
                            	<input type="hidden" name="intervent_type" value="<?php echo $intervent_type_id; ?>" />
                            	<input type="text" readonly="readonly" class="input-large" name="intid" value="<?php echo $this->common->getinterventname($intervent_type_id); ?>" /></span>
						</div>
						<div class="jobautocomp">
	        <label><?php echo ( sprintf( lang("JOBASSIGN::assign_date")) ); ?></label>
	        <span class="field"><input type="text" readonly="readonly" name="job_date_assign" id="job_date_assign" value="<?=$job_date_assign?>" /></span>
		</div>

						<div class="jobautocomp">
                            <label><?php echo ( sprintf( lang("JOBASSIGN::int_standard_duration")) ); ?><span class="rstar">*</span></label>
                            <span class="field">
	                            <input type="hidden" id="int_hour" value="<?=$int_hour?>" name="int_hour" />
	            				<input type="hidden" id="int_min" value="<?=$int_min?>" name="int_min" />
                            	<input type="text" value="<?=$int_hour?>:<?=$int_min?>" readonly="readonly" />(HH:MM)</span>
						</div>
						<div class="jobautocomp">
                            <label><?php echo ( sprintf( lang("JOBASSIGN::stime")) ); ?><span class="rstar">*</span></label>
                            <span class="field">
                            <input type="hidden" name="start_hid_hour" id="start_hid_hour" value="<?php echo $stime_hour;?>" />
       <input type="hidden" name="start_hid_min" id="start_hid_min" value="<?php echo $fet_saved_data['start_time_min'];?>" >
       <select name="hourcombo" class="hourcombo combo" id="hourcombo">
                            	<option value="0">00</option>
                            	<?php for($st = 6; $st <= 22; $st++ ){ ?>
     								<option value="<?=$st?>" <?php if($st == $stime_hour){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($st);?></option>
                            	<?php } ?>
</select>
<select name="mincombo" class="mincombo combo" id="mincombo">
	                            	<?php for($mt = 0; $mt <= 55; $mt = $mt+5 ){ ?>
     								<option value="<?=$mt?>" <?php if($mt == $fet_saved_data['start_time_min']){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($mt);?></option>
                            	<?php } ?>
</select>(HH:MM)</span>
						</div>
						<div class="jobautocomp">
                            <label><?php echo ( sprintf( lang("JOBASSIGN::etime")) ); ?><span class="rstar">*</span></label>
                            <span class="field">
                            	<select name="endhourcombo" class="endhourcombo ecombo" id="endhourcombo" onchange="change_end_time(this.value,'endhourcombo')">
	                            	<option value="0">00</option>
                            	<?php for($eht = 6; $eht <= 22; $eht++ ){ ?>
     								<option value="<?=$eht?>" <?php if($eht == $fet_saved_data['end_time_hour']){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($eht);?></option>
                            	<?php } ?>
							</select>
							<select name="endmincombo" class="endmincombo ecombo" id="endmincombo" onchange="change_end_time(this.value,'endmincombo')">
								<?php for($emt = 0; $emt <= 55; $emt = $emt+5 ){ ?>
     								<option value="<?=$emt?>" <?php if($emt == $emin){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($emt);?></option>
                            	<?php } ?>
							</select>(HH:MM)
                            	</span>
						</div>
						<div class="jobautocomp">
                            <label><?php echo ( sprintf( lang("OPERATOR::tag")) ); ?></label>
                            <?php
                            $tag_id = $this->common->get_contract_tag_id($contract_int_id,$cid,$intervent_type_id,$patient_id);
							if($tag_id != ''){
								$contract_tags = explode(",", $tag_id);
							}else{
								$contract_tags = array();
							}
                            ?>
                            <span class="field">
                                  <?php if($tag_id != ''){
                                  $tags = $this->common->get_tags_list();
								  foreach($contract_tags as $fet_tid){
								  	$tid = $fet_tid;
									 $tag_desc = $this->common->get_tag_names($tid); ?>
									<input type="checkbox" name="contract_tags[]" onclick="hideoperatorlist()" value="<?=$tid?>" /><?=$tag_desc?>
								  <?php } } ?>
								  <br>
		   <input type="button" class="btn btn-primary btn-submit" name="update_operator_list1" onclick="return update_operator_list()" value="<?php echo lang("JOBASSIGN::update_opt_list"); ?>" id="update_operator_list1" />
                           </span>
						</div>

						</div>
						<div id="map_canvas1" style="height: 300px; float: right; display: block; margin-left: 10px; width: 36%;"></div>
						</div>


<div class="default_record">
<?php $contract_tags = array();
		$query = $this->db->query("select * from intervention_types where int_type_id = '$intervent_type_id'");
        foreach($query->result() as $row){
			$primary_mandatory = $row->primary_mandatory;
			$secondary_mandatory = $row->secondary_mandatory;
			$supervisor_mandatory = $row->supervisor_mandatory;
			$primary_roles = $row->primary_roles;
			$secondary_roles = $row->secondary_roles;
			$supervisor_roles = $row->supervisor_roles;
			if($primary_roles != ""){
				$primary_exp = explode(",", $primary_roles);
				$i = 3; ?>

				<div class="jobautocomp">
					<input type="hidden" name="primary_mandatory" id="primary_mandatory" value="<?=$primary_mandatory?>" />
					<input type="hidden" name="secondary_mandatory" id="secondary_mandatory" value="<?=$secondary_mandatory?>" />
					<input type="hidden" name="supervisor_mandatory" id="supervisor_mandatory" value="<?=$supervisor_mandatory?>" />
                            <label><?php echo lang('INTERVENT::primary'); ?> <?php if($primary_mandatory == '1'){ ?><span class="rstar">*</span> <?php }?></label>
                            <span class="field" style="padding-bottom: 20px;">
				<?php foreach($primary_exp as $primary_val){ ?>
							<div style="float: left;"><input type="radio" value="<?=$primary_val?>" onchange="primay_role_fun(this.value,'<?=$tag_id?>')" name="primay_role" style="float: left; margin-top: 4px;" /><span style="float: left;"><?php echo $this->common->getrolename($primary_val); ?></span></div>
				<?php $i++; } ?>
				<div style="float: left;"><input type="radio" checked="checked" value="<?=$primary_roles?>" onchange="primay_role_fun(this.value,'<?=$tag_id?>')" name="primay_role" style="float: left; margin-top: 4px;" /><span style="float: left;"><?php echo lang('JOBASSIGN::all'); ?></span></div>
				</span>
				<?php
				if(strpos($pry_oid,'-') !== false){
					$pry_class = 'style="background: #FFFF00;"';
					$pry_oid_sub = substr($pry_oid, 1); ?>
					<input type="hidden" name="default_pry_operator" id="default_pry_operator" value="<?=$pry_oid_sub?>" />
				<?php }else{
					$pry_class = '';
					$pry_oid_sub = $pry_oid;
				}
				?>
				<span class="field pry" <?=$pry_class?>>
				<input type="hidden" name="pry_opt_role" value="1" />
				<input type="hidden" name="val_pry_operator" id="val_pry_operator" value="<?=$pry_oid_sub?>" />

				<select name="pry_operator" id="pry_operator">
						<option value="" selected="selected"><?php echo lang("JOBASSIGN::select"); ?></option>
						<?php
						$sus = $this->common->getsuspendoperatorjob($primary_roles,$pry_oid_sub);
						if($sus['suspended'] == 'on'){
							$name = $sus['firstname']." ".$sus['lastname'];
							$role_sus = $sus['role'];
							?>
							<option value="<?=$sus['oid']?>" selected="selected"><?=$name?> <?php echo "(".$this->common->getrolename($role_sus).")"; ?></option>
						<?php } ?>
                                <?php echo $primary = $this->common->getoperatorlist_hole_role($primary_roles,$contract_tags);
									if(count($primary) > 0){
                                foreach($primary as $primary_list){
                                	$oid = $primary_list->oid;
									$fname = $primary_list->firstname;
									$lname = $primary_list->lastname;
									$name = $lname." ".$fname; ?>
									<option value="<?=$oid?>" <?php if($oid == $pry_oid_sub){ ?> selected="selected" <?php } ?>><?=$name?> <?php echo "(".$this->common->getrolename($primary_list->role).")"; ?></option>
                              <?php } }else{ ?>
									<option value=""><?php echo lang('INTERVENT::dataempty'); ?></option>
                              <?php } ?>
                            </select>
                            <input type="hidden" name="pry_role_ids" id="pry_role_ids" value="<?=$primary_roles?>" />
                            <br>
                            <span class="pry_msg"></span>
				</span>
				</div>

			<?php }
			if($secondary_roles != ""){
				$secondary_exp = explode(",", $secondary_roles); ?>
				<div class="jobautocomp">
                            <label><?php echo lang('INTERVENT::secondary'); ?><?php if($secondary_mandatory == '1'){ ?><span class="rstar">*</span> <?php }?></label>
                            <span class="field" style="padding-bottom: 20px;">
				<?php foreach($secondary_exp as $secondary_val){ ?>
							<div style="float: left;"><input type="radio" value="<?=$secondary_val?>" onchange="secondary_role_fun(this.value,'<?=$tag_id?>')" name="secondary_role" style="float: left; margin-top: 4px;" /><span style="float: left;"><?php echo $this->common->getrolename($secondary_val); ?></span></div>
				<?php } ?>
				<div style="float: left;"><input type="radio" checked="checked" value="<?=$secondary_roles?>" onchange="secondary_role_fun(this.value,'<?=$tag_id?>')" name="secondary_role" style="float: left; margin-top: 4px;" /><span style="float: left;"><?php echo lang('JOBASSIGN::all'); ?></span></div>
				</span>
<?php
				if(strpos($sec_oid,'-') !== false){
					$sec_class = 'style="background: #FFFF00;"';
					$sec_oid_sub = substr($sec_oid, 1); ?>
					<input type="hidden" name="default_sec_operator" id="default_sec_operator" value="<?=$sec_oid_sub?>" />
				<?php
				}else{
					$sec_class = '';
					$sec_oid_sub = $sec_oid;
				}
				?>
				<span class="field sec" <?=$sec_class?>>
				<input type="hidden" name="sec_opt_role" value="2" />
				<input type="hidden" name="val_sec_operator" id="val_sec_operator" value="<?=$sec_oid_sub?>" />
					<select name="sec_operator" id="sec_operator">
						<option value="" selected="selected"><?php echo lang("JOBASSIGN::select"); ?></option>
						<?php
						$sus1 = $this->common->getsuspendoperatorjob($secondary_roles,$sec_oid_sub);
						if($sus1['suspended'] == 'on'){
							$name1 = $sus1['firstname']." ".$sus1['lastname'];
							$role_sus1 = $sus1['role'];
							?>
							<option value="<?=$sus1['oid']?>" selected="selected"><?=$name1?> <?php echo "(".$this->common->getrolename($role_sus1).")"; ?></option>
						<?php } ?>
                                <?php $secondary = $this->common->getoperatorlist_hole_role($secondary_roles,$contract_tags);
									if(count($secondary) > 0){
                                foreach($secondary as $secondary_list){
                                	$oid = $secondary_list->oid;
									$fname = $secondary_list->firstname;
									$lname = $secondary_list->lastname;
									$name = $lname." ".$fname; ?>
									<option value="<?=$oid?>" <?php if($oid == $sec_oid_sub){ ?> selected="selected" <?php } ?>><?=$name?><?php echo "(".$this->common->getrolename($secondary_list->role).")"; ?></option>
                              <?php } }else{ ?>
									<option value=""><?php echo lang('INTERVENT::dataempty'); ?></option>
                              <?php } ?>
                            </select>
                            <input type="hidden" name="sec_role_ids" id="sec_role_ids" value="<?=$secondary_roles?>" />
                            <br><span class="sec_msg"></span>
				</span>
				</div><?php
			}
			if($supervisor_roles != ""){
				$supervisor_exp = explode(",", $supervisor_roles); ?>
				<div class="jobautocomp">
                            <label><?php echo lang('INTERVENT::supervisor'); ?><?php if($supervisor_mandatory == '1'){ ?><span class="rstar">*</span> <?php }?></label>
                            <span class="field" style="padding-bottom: 20px;">
				<?php foreach($supervisor_exp as $supervisor_val){ ?>
							<div style="float: left;"><input type="radio" value="<?=$supervisor_val?>" onchange="supervisor_role_fun(this.value,'<?=$tag_id?>')" name="supervisor_role" style="float: left; margin-top: 4px;" /><span style="float: left;"><?php echo $this->common->getrolename($supervisor_val); ?></span></div>
				<?php } ?>
				<div style="float: left;"><input type="radio" checked="checked" value="<?=$supervisor_roles?>" onchange="supervisor_role_fun(this.value,'<?=$tag_id?>')" name="supervisor_role" style="float: left; margin-top: 4px;" /><span style="float: left;"><?php echo lang('JOBASSIGN::all'); ?></span></div>
				</span>
<?php
				if(strpos($sup_id,'-') !== false){
					$sup_class = 'style="background: #FFFF00;"';
					$sup_oid_sub = substr($sup_id, 1); ?>
					<input type="hidden" name="default_sup_operator" id="default_sup_operator" value="<?=$sup_oid_sub?>" />
				<?php }else{
					$sup_class = '';
					$sup_oid_sub = $sup_id;
				}
				?>
				<span class="field sup" <?=$sup_class?>>
					<input type="hidden" name="sup_opt_role" value="3" />
					<input type="hidden" name="val_sup_operator" id="val_sup_operator" value="<?=$sup_oid_sub?>" />
					<select name="sup_operator" id="sup_operator">
						<option value="" selected="selected"><?php echo lang("JOBASSIGN::select"); ?></option>
						<?php
						$sus2 = $this->common->getsuspendoperatorjob($supervisor_roles,$sup_oid_sub);
						if($sus2['suspended'] == 'on'){
							$name2 = $sus2['firstname']." ".$sus2['lastname'];
							$role_sus2 = $sus2['role'];
							?>
							<option value="<?=$sus2['oid']?>" selected="selected"><?=$name2?> <?php echo "(".$this->common->getrolename($role_sus2).")"; ?></option>
						<?php } ?>
                                <?php $supervisor = $this->common->getoperatorlist_hole_role($supervisor_roles,$contract_tags);
									if(count($supervisor) > 0){
                                foreach($supervisor as $supervisor_list){
                                	$oid = $supervisor_list->oid;
									$fname = $supervisor_list->firstname;
									$lname = $supervisor_list->lastname;
									$name = $lname." ".$fname; ?>
									<option value="<?=$oid?>" <?php if($oid == $sup_oid_sub){ ?> selected="selected" <?php } ?>><?=$name?><?php echo "(".$this->common->getrolename($supervisor_list->role).")"; ?></option>
                              <?php } }else{ ?>
									<option value=""><?php echo lang('INTERVENT::dataempty'); ?></option>
                              <?php } ?>
                            </select>
                            <input type="hidden" name="sup_role_ids" id="sup_role_ids" value="<?=$supervisor_roles?>" />
                            <br>
                            <span class="sup_msg"></span>
				</span>
				</div><?php
			}
			} ?>

			</div>
			<div class="jobautocomp">
				<label><?php echo ( sprintf( lang("JOBASSIGN::note")) ); ?></label>
				<span class="field"><?php echo $note; ?></span>
			</div><br>

			<p class="stdformbutton finalsubmit" style="text-align:right;">
				<?php if($sdelete == 1){ ?>
<a href="javascript:void(0);" onclick="jobremove();" class="btn btn-primary btn-submit"><?php echo ( sprintf( lang("JOBASSIGN::remove")) ); ?></a>
                          <?php } ?>
                          <?php if($boxaction == "yellow"){ $btn_style = 'style="display: none";' ?><a href="javascript:void(0)" onclick="verify_yellow_box_opt();" class="btn btn-primary btn-submit" id="verify_btn"><?php echo ( sprintf( lang("JOBASSIGN::check_operator_available")) ); ?></a> <?php }else{
		$btn_style = '';
	} ?>                                <a href="javascript:void(0);" <?php echo $btn_style ?> onclick="validate();" id="sub_btn" class="jobsubbtn btn btn-primary btn-submit"><?php echo ( sprintf( lang("COMMON::sub_btn")) ); ?></a>
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo ( sprintf( lang("COMMON::reset_btn")) ); ?></button>
                            </p>
<?php echo form_close(); ?> </div></div>
<?php
    }

public function deletejobassign()
{
	if($this->lang->mci_current() == ""){
	  	$i18n = $this->lang->mci_current();
	  }else{
		$i18n = $this->lang->mci_current()."/";
	  }

	$this->jobassign_model->deleteassignedjob();
	redirect($i18n.'jobassign','refresh');

}

function get_cal_contract_detail(){

	 $query= $this->jobassign_model->json_cal_contract_detail();
	 return $query;
}

function check_optweek_availabel() {
		$this->load->model('common');
        $this->load->model('jobassign_model', 'check_availabel');
      $query = $this->check_availabel->check_optweek_availabel_details();
		if($query == "leaveerror"){
			echo lang("JOBASSIGN::operator_error_msg");
		}else{
			$patient_id = array();
			$opt_id = $this->input->post('opt');
			$shourcombo_form = $this->input->post('shourcombo');
			$smincombo_form = $this->input->post('smin');
			$ehourcombo_form = $this->input->post('ehourcombo');
			$emincombo_form = $this->input->post('emin');
			$is_available = 0;
			$cnt = $query->num_rows();
			if($cnt > 0){
				foreach($query->result() as $fetch){

				$start_time_hour = $fetch->start_time_hour;
				$start_time_min = $fetch->start_time_min;
				$end_time_hour = $fetch->end_time_hour;
				$end_time_min = $fetch->end_time_min;

				$output = $this->check_operator_availabel($start_time_hour,$start_time_min,$end_time_hour,$end_time_min,$shourcombo_form,$smincombo_form,$ehourcombo_form,$emincombo_form);
				 if($output == 1){
						$is_available = 1;
					    $patient_id['id'] = $fetch->patient_id;
						$patient_id['start_hour'] = $start_time_hour;
						$patient_id['start_min'] = $start_time_min;
						$patient_id['end_hour'] = $end_time_hour;
						$patient_id['end_min'] = $end_time_min;
						$pat[]=  $patient_id;
				 }
				}
if($is_available == '1'){
	echo '<span style="color: red;">'.lang("JOBASSIGN::opt_not_msg").'</span>';
	?>
<div class="opterrormsg">
<div class="opterrortitle"><?=$leavetime_cnt?> (<?=$this->common->getoperatorfirstname($opt_id)?>)</div>
<ul>
<?php foreach($pat as $pval ){

					if($pval['start_hour'] == ""){
						$shourcombo = "00";
					}else{
						$shourcombo = $this->common->commontimeformat($pval['start_hour']);
					}
					if($pval['start_min'] == ""){
						$smincombo = "00";
					}else{
						$smincombo = $this->common->commontimeformat($pval['start_min']);
					}
					if($pval['end_hour'] == ""){
						$ehourcombo = "00";
					}else{
						$ehourcombo = $this->common->commontimeformat($pval['end_hour']);
					}
					if($pval['end_min'] == ""){
						$emincombo = "00";
					}else{
						$emincombo = $this->common->commontimeformat($pval['end_min']);

					}


	$morning = array();
	for($m = 6; $m <= 13; $m++){
		$morning[] = $m;
	}
	$afternoon = array();
	for($a = 13; $a <= 22; $a++){
		$afternoon[] = $a;
	}
	if(in_array($shourcombo, $morning)){
		$leavetime = 1;
		$leavetime_cnt = "Morninsupg";
		if($shourcombo == "13" && $smincombo > 0){
			$leavetime = 2;
			$leavetime_cnt = "Afternoon";
		}
	}elseif(in_array($shourcombo, $afternoon)){
		$leavetime = 2;
		$leavetime_cnt = "Afternoon";
	}
?>
	<li><?php echo $shourcombo.":".$smincombo ." - ". $ehourcombo.":".$emincombo;?> <?=$this->common->getpatientname($pval['id'])?></li>
<?php } ?>
</ul>
</div>
<?php
$patient_id[] = '';
				}else{
					$patient_id[] = '';
				}
			}
			}
    }
function check_operator_availabel($starthour,$startmin,$endhour,$endmin,$shourcombo,$smincombo,$ehourcombo,$emincombo){
	$status = 0;

	if($smincombo == '0'){
		$start_min = $smincombo + 1;
	}else{
		$start_min = $smincombo;
	}
	if($emincombo == '0'){
		$end_min = "59";
		$end_hour  = $ehourcombo - 1;
	}else{
		$end_min = $emincombo;
		$end_hour  = $ehourcombo;
	}

$job = array();
for($i=$starthour;$i<=$endhour;$i++ ){
	if($i != $starthour && $endhour != $i){
			for($j=0;$j<60;$j++){
			$job[] = $i.":".$j;
		}
	}elseif($i == $endhour){
		if($starthour == $i){
			$j = $startmin +1;
		} else{
			$j= 0;
		}
		for($j;$j<$endmin;$j++){
			$job[] = $i.":".$j;
		}
	}else{
		if($starthour == $i){
			$j = $startmin +1;
		} else{
			$j= 0;
		}
			for($j;$j<60;$j++){
				$job[] = $i.":".$j;
			}
	}
}

$job1 = array();
for($i=$shourcombo;$i<=$end_hour;$i++ ){
	if($i != $shourcombo && $end_hour != $i){
			for($j=0;$j<60;$j++){
			$job1[] = $i.":".$j;
		}
	}elseif($i == $end_hour){
		if($shourcombo == $i){
			$j = $start_min +1;
		} else{
			$j= 0;
		}
		for($j;$j<$end_min;$j++){
			$job1[] = $i.":".$j;
		}
	}else{
		if($shourcombo == $i){
			$j = $start_min +1;
		} else{
			$j= 0;
		}
			for($j;$j<60;$j++){
				$job1[] = $i.":".$j;
			}
	}
}
foreach($job1 as $check_job){
	if(in_array($check_job, $job) ){
		$status = 1;
	}

}
return $status;
}

public function checkbox_dist_opt_pry()
{
	$this->load->model('common');

	$dist_id = $this->input->post('dist_id');
	$roles = $this->input->post('roles');
	$action = $this->input->post('action');
	?>
	<option value="" selected="selected"><?php echo ( sprintf( lang("COMMON::choose_one")) ); ?></option>
                                <?php
                               if($action == "dist"){
                               	 	$primary = $this->common->getoperatorlist_hole_role_dist($roles, $dist_id);
                               }else{
 									$primary = $this->common->getoperatorlist_hole_role($roles);
                               }

									if(count($primary) > 0){
                                foreach($primary as $primary_list){
                                	$oid = $primary_list->oid;
									$fname = $primary_list->firstname;
									$lname = $primary_list->lastname;
									$name = $fname." ".$lname; ?>
									<option value="<?=$oid?>"><?=$name?> <?php echo "(".$this->common->getrolename($primary_list->role).")"; ?></option>
                              <?php } }else{ ?>
									<option value=""><?php echo lang('INTERVENT::dataempty'); ?></option>
                              <?php }
}


public function jobassign_report()
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
		$this->breadcrumbs->push(lang('COMMON::home'), site_url('home'));
		$this->breadcrumbs->push( lang('JOBASSIGN::jobassign_report'), site_url('jobassign/jobassign_report'));
		/* end */
      $this->load->view('job_assign_report_list', $data);
}


public function get_nearest_operator()
{

	$hour = $this->input->post('hour');
	$weekdays = $this->input->post('weekdays');
	$current_week = $this->input->post('current_week');
	$pidval = $this->input->post('pidval');
	$points = $this->jobassign_model->get_patient_nearest_operator($hour, $weekdays, $current_week, $pidval);
	$data = array();
	$i = 0;
	foreach($points as $points_list){
		$pid = $points_list->patient_id;
		$intervent_type_id = $this->common->getinterventname($points_list->intervent_type_id);
		$time = $points_list->start_time_hour.":".$points_list->start_time_min." To: ".$points_list->end_time_hour.":".$points_list->end_time_min;
		$get_pat_det = mysql_fetch_assoc(mysql_query("SELECT * FROM patients where pid = '$pid'"));
		$latlang = $get_pat_det['latlang'];
		$address = $get_pat_det['address'];
		$pname = $get_pat_det['pname'];
		$surname = $get_pat_det['surname'];
		if($points_list->pry_oid != '0'){
			$pry_oid = $this->common->getoperatorfirstname($points_list->pry_oid);
		}else{
			$pry_oid = "";
		}
		if($points_list->sec_oid != '0'){
			$sec_oid = $this->common->getoperatorfirstname($points_list->sec_oid);
		}else{
			$sec_oid ="";
		}
		if($points_list->sup_id != '0'){
			$sup_id = $this->common->getoperatorfirstname($points_list->sup_id);
		}else{
			$sup_id = "";
		}

		$data[$i][] = $time;
		$data[$i][] = $surname." ".$pname;
		$data[$i][]= $latlang;
		$data[$i][] = mysql_escape_string($address);
		$data[$i][] = $pry_oid;
		$data[$i][] = $sec_oid;
		$data[$i][] = $sup_id;
		$data[$i][] = $intervent_type_id;
$i++;
	}
$sds = json_encode(array_filter($data)); ?>

<script>

var locations = <?=$sds?>;
    var map = new google.maps.Map(document.getElementById('map_canvas'), {
      zoom: 14,
      center: new google.maps.LatLng(44.652684,10.783963),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {
    	if(locations[i][4] != ''){
			var pry_opt_name = '<b><?php echo lang("JOBASSIGN::primary_opt"); ?>: </b>'+locations[i][4]+'<br />';
    	}else{
    		pry_opt_name = '';
    	}
    	if(locations[i][5] != ''){
			var sec_opt_name = '<b><?php echo lang("JOBASSIGN::secondary_opt"); ?>: </b>'+locations[i][5]+'<br />';
    	}else{ sec_opt_name = ''; }
    	if(locations[i][6] != ''){
			var sup_opt_name = '<b><?php echo lang("JOBASSIGN::supervisor_opt"); ?>: </b>'+locations[i][6]+'<br />';
    	}else{ sup_opt_name = ''; }

		var intervent_type = '<b><?php echo lang("JOBASSIGN::intervent_type"); ?>: </b>'+locations[i][7]+'<br />';
    	var pat_latlng = locations[i][2];
      	var myarr = pat_latlng.split(",");

      marker = new google.maps.Marker({
        position: new google.maps.LatLng(myarr[0], myarr[1]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent('<div class="map-content"><h3>' + locations[i][0] + '</h3><br /><b>'+'<?php echo lang("JOBASSIGN::patient"); ?>'+ ':</b>' + locations[i][1] +'<br />'+ intervent_type + pry_opt_name + sec_opt_name + sup_opt_name + '<br /><a href="http://maps.google.com/?daddr=' + locations[i][3] + '" target="_blank">Get Directions</a></div>');
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
    </script>
    <div id="map_canvas" style="width: 100%; height: 300px;"></div>
<?php }

public function jobassign_week_report()
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
		$this->breadcrumbs->push(lang('COMMON::home'), site_url('home'));
		$this->breadcrumbs->push( lang('JOBASSIGN-WEEK-REPORT::jobassign_week_report'), site_url('jobassign/jobassign_week_report'));
		/* end */
      $this->load->view('job_assign_week_report', $data);
}
public function jobassign_monthly_km_report()
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
		$this->breadcrumbs->push(lang('COMMON::home'), site_url('home'));
		$this->breadcrumbs->push( lang('JOBASSIGN-KM-REPORT::km_opt_usg'), site_url('jobassign/jobassign_monthly_km_report'));
		/* end */
      $this->load->view('job_opt_km_report ', $data);
}

function fetch_patient_intervent()
  {
  	/* Session Variables */
      	$session_data=$this->session->userdata('logged_in');
		$data['username']=$session_data['username'];
      /* Session Variables */

		$pat_id = $this->input->post('pat_id');

		$query = $this->jobassign_pop_model->get_patient_intervent_list($pat_id);
		?>
		<?php
		foreach ($query as $intervent) {
			$id = $intervent->intervent_id;
			$name = $this->common->getinterventname($intervent->intervent_id);
			echo '<option value="'.$id.'">'.$name.'</option>';
		}
  }
  function fetch_all_data()
  {
  	/* Session Variables */
      	$session_data=$this->session->userdata('logged_in');
		$data['username']=$session_data['username'];
      /* Session Variables */
		$pat_id = $this->input->post('pat_id');
		$int_id = $this->input->post('int_id');

		$query= $this->jobassign_pop_model->get_contract_data($pat_id,$int_id);
  }

  function get_select_role_list() {
		$this->load->model('common');
        $this->load->model('jobassign_model', 'doctor');
        $query= $this->doctor->select_role_list();
        foreach($query->result() as $row){ ?>
			<option value="<?php echo $row->oid; ?>"><?php echo $row->firstname." ".$row->lastname."(".$this->common->getrolename($row->role).")"; ?></option>
       <?php }
    }


  function get_updated_opt_list() {
		
		$this->load->model('common');
		$get_oid = $_REQUEST['val_oid'];
		$val_status = "";
		$val_name= "";
		$typefrom = $_REQUEST['typefrom'];
		if($typefrom == "pry_operator"){ $spanclass = "pry"; }elseif($typefrom == "sec_operator"){ $spanclass = "sec"; }elseif($typefrom == "sup_operator"){ $spanclass = "sup"; }
        $query= $this->jobassign_model->select_updated_opt_list(); ?>
        <option value=""><?php echo lang("JOBASSIGN::select"); ?></option>
		  <?php foreach($query->result() as $row){
		  	if($row->oid == $get_oid){
				$val_status = $get_oid;
				$val_name = $row->lastname." ".$row->firstname."(".$this->common->getrolename($row->role).")";
		  	}
			 ?>
			<option value="<?php echo $row->oid; ?>" <?php if($row->oid == $get_oid){ ?>selected="selected" <?php } ?>><?php echo $row->lastname." ".$row->firstname."(".$this->common->getrolename($row->role).")"; ?></option>
       <?php } ?>
		  <script>
		  jQuery('#val_<?=$typefrom?>').val('<?=$val_status?>');
	      jQuery('#<?=$typefrom?>').val('<?=$val_status?>');
	      jQuery('.<?=$spanclass?> .custom-combobox-input').val('<?=$val_name?>');
		</script>
		  <?php
    }


  function reassign_job($week, $year, $oid, $jobdate, $section, $type) {
		if($this->lang->mci_current() == ""){
	  		$i18n = $this->lang->mci_current();
	  	}else{
			$i18n = $this->lang->mci_current()."/";
	  	}


		$date_val = date('d-m-Y', $jobdate);
		?>

<div class="widgetbox box-inverse span9">
<script type="text/javascript" src="<?php echo base_url()?>js/job_assign_combo_jquery.js"></script>
<h4 class="widgettitle"><span><?php echo ( sprintf( lang("JOBASSIGN::reassign_job")) ); ?></span></h4>
                <div class="widgetcontent nopadding stdform stdform2" style="width: 866px;">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div>'; <?php } ?>

           <?php $attributes = array('id' => 'formjobreassign', 'name' => 'form_validate');
           echo form_open('',$attributes); ?>
           <div class="jobautocomp">
           <input type="hidden" name="siteurl" value="<?php echo site_url($i18n.'jobassign/check_optweek_availabel') ?>" id = "siteurl"/>
           <input type="hidden" name="formsuburl" value="<?php echo site_url($i18n.'jobassign/submitreassignform') ?>" id = "formsuburl"/>
           <input type="hidden" name="oid" id="oid" value="<?=$oid?>" />
		   
           <input type="hidden" name="ctype" id="ctype" value="<?=$type?>" />

           	<input type="hidden" name="movenav_url" value="<?php echo site_url($i18n.'jobassign_nav/navigation'); ?>" id="movenav_url" />
           	<input type="hidden" name="moveweek" id="moveweek" value="<?=$week?>" />
			<input type="hidden" name="moveyear" id="moveyear" value="<?=$year?>" />

	        <label><?php echo ( sprintf( lang("JOBASSIGN::reassign_date")) ); ?></label>
	        <span class="field"><input type="text" value="<?=$date_val?>" readonly="readonly" id="job_date_assign" name="job_date_assign" /></span>
		</div>
		<div class="jobautocomp">
	        <label><?php echo ( sprintf( lang("JOBASSIGN::reassign_job_list")) ); ?></label>
	        <span class="field">
	        <div class="opterrormsg">
	        	<?php
	        	if($section == '1'){
	        				$leavetime = lang("OPERATOR::morning");
					   }elseif($section == '2'){
					   		$leavetime = lang("OPERATOR::afternoon");
					   } ?>
<div class="opterrortitle"><?=$leavetime?></div>
<ul>
	<?php
 $moring_sel = $this->jobassign_model->getmorningafterjoblist($oid, $jobdate, $section, $type);
$sk = 1;
unset($timedata);
unset($piddata);
$timedata = array();
$piddata = array();
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
?>
<li><a href="javascript:void(0)"><?=$start_time?> - <?=$end_time?> <?=$pname?></a></li>
<?php $sk++; }  ?>
</ul>
<input type="hidden" name="shour" id="shour" value="<?=$start_hour?>" />
<input type="hidden" name="smin" id="smin" value="<?=$start_min?>" />
<input type="hidden" name="ehour" id="ehour" value="<?=$end_hour?>" />
<input type="hidden" name="emin" id="emin" value="<?=$end_min?>" />
<input type="hidden" name="patient_ids" id="patient_ids" value="<?=implode(",", array_unique($piddata))?>" />
</div>
	        </span>
		</div>

		<div class="jobautocomp optassign">
		    <label><?php echo lang('JOBASSIGN::reassign_operator'); ?></label>
		    <span class="field" style="padding-bottom: 20px;">
		</span>
				<span class="field sec">
					<select name="reassign_opt" id="reassign_opt">
						<option value="" selected="selected"><?php echo lang("JOBASSIGN::select"); ?></option>
                                <?php
									$reassign_opt = $this->common->getoperatorlist_new();
									if(count($reassign_opt) > 0){
                                foreach($reassign_opt as $reassign_opt_list){
									$foid = $reassign_opt_list->oid;
									$fname = $reassign_opt_list->firstname;
									$lname = $reassign_opt_list->lastname;
									$name = $fname." ".$lname; ?>
									<option value="<?=$foid?>"><?=$name?><?php echo "(".$this->common->getrolename($reassign_opt_list->role).")"; ?></option>
                              <?php } }else{ ?>
									<option value=""><?php echo lang('INTERVENT::dataempty'); ?></option>
                              <?php } ?>
                            </select><br>
                            <span class="error_msg"></span>
				</span>
				</div>
			<p class="stdformbutton finalsubmit" style="text-align:right;">
                                <a href="javascript:void(0);" onclick="submit_reassign();" class="btn btn-primary btn-submit"><?php echo ( sprintf( lang("COMMON::sub_btn")) ); ?></a>
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo ( sprintf( lang("COMMON::reset_btn")) ); ?></button>
           </p>
<?php echo form_close(); ?> </div></div>
<?php
    }

function submitreassignform()
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


		$ss = $this->jobassign_model->addreassignform();
		if($this->lang->mci_current() == ""){
	  	$i18n = $this->lang->mci_current();
	  }else{
		$i18n = $this->lang->mci_current()."/";
	  }
		redirect($i18n.'jobassign','refresh');
  }

/* Job Maintain */
function job_maintain_popup($week, $year, $oid, $jobdate) {
	$session_data=$this->session->userdata('logged_in');
	$sdelete = $session_data['sdelete'];
	if($this->lang->mci_current() == ""){
		$i18n = $this->lang->mci_current();
	}else{
		$i18n = $this->lang->mci_current()."/";
	}
	
?>
<script type="text/javascript" src="<?php echo base_url()?>js/job_assign_combo_jquery.js"></script>
<script type="text/javascript">
function check_update_time(i) {
	 
	var combo_hour_to_min = parseInt($('#hourcombo_'+i).val()) ;
	var combo_min = parseInt($('#mincombo_'+i).val());
	total_combo_min = combo_hour_to_min +':'+ combo_min;
	int_hour_to_min = parseInt($('#int_hour'+i).val());
	int_min = parseInt($('#int_min'+i).val());
	total_int_val = int_hour_to_min+':'+int_min;
	
	var totalTime = addTime(total_combo_min, total_int_val,i);
	
	jQuery('#start_hid_hour').val(combo_hour_to_min);
	jQuery('#start_hid_min').val(combo_min);
	
	hideoperatorlist();
}
function addTime(arg1,arg2,k)
{

    if (arguments.length < 2)
    {
        if (arguments.length == 1 && isFormattedDate(arguments[0])) return arguments[0];
        else return false;
    }

    var time1Split, time2Split, totalHours, totalMinutes;
    if (isFormattedDate(arguments[0])) var totalTime = arguments[0];
    else return false;
	
    for (var i = 1; i < 2; i++)
    {
		
        // Add them up
        time1Split = totalTime.split(':');
        time2Split = arguments[i].split(':');

        totalHours = parseInt(time1Split[0]) + parseInt(time2Split[0]);
        totalMinutes = parseInt(time1Split[1]) + parseInt(time2Split[1]);

        // If total minutes is more than 59, then convert to hours and minutes
        if (totalMinutes > 59)
        {
            totalHours += Math.floor(totalMinutes / 60);
            totalMinutes = totalMinutes % 60;
        }
		
        var endhourcombo = document.getElementById('endhourcombo_'+k);
	    for(var i = 0, j = endhourcombo.options.length; i < j; ++i) {
	        if(endhourcombo.options[i].value == totalHours) {
	           jQuery(endhourcombo.options[i]).attr('selected','selected');
	           break;
	        }
	    }
	    var endmincombo = document.getElementById('endmincombo_'+k);
	    for(var k = 0, s = endmincombo.options.length; k < s; ++k) {
	        if(endmincombo.options[k].value == totalMinutes) {
	           jQuery(endmincombo.options[k]).attr('selected','selected');
	           break;
	        }
	    }
        totalTime = totalHours + ':' + padWithZeros(totalMinutes);
    }

    return totalTime;
}

function isFormattedDate(date)
{
    var splitDate = date.split(':');
    if (splitDate.length == 2 && (parseInt(splitDate[0]) + '').length <= 2 && (parseInt(splitDate[1]) + '').length <= 2) return true;
    else return false;
}

function padWithZeros(number)
{
    var lengthOfNumber = (parseInt(number) + '').length;
    if (lengthOfNumber == 2) return number;
    else if (lengthOfNumber == 1) return '0' + number;
    else if (lengthOfNumber == 0) return '00';
    else return false;
}
$(document).ready(function() {
	/*$('.combo').change(function(){
		
	var combo_hour_to_min = parseInt($('.hourcombo').val()) ;
	var combo_min = parseInt($('.mincombo').val());
	total_combo_min = combo_hour_to_min +':'+ combo_min;
	int_hour_to_min = parseInt($('#int_hour').val());
	int_min = parseInt($('#int_min').val());
	total_int_val = int_hour_to_min+':'+int_min;
	var totalTime = addTime(total_combo_min, total_int_val);
	jQuery('#start_hid_hour').val(combo_hour_to_min);
	jQuery('#start_hid_min').val(combo_min);
	hideoperatorlist();
})*/



});
</script>
<h4 class="widgettitle"><span><?php echo ( sprintf( lang("JOBASSIGN::assignjob")) ); ?></span></h4>
<div class="widgetcontent nopadding stdform stdform2" style="width: 866px;">
<?php
if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
<?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div>'; <?php } ?>
<?php $attributes = array('id' => 'formjobassign', 'name' => 'form_validate');
echo form_open($i18n.'jobassign/job_maintain_edit',$attributes);
echo form_open('',$attributes); ?>
<div class="map_data">
	<?php
	$moring_sel = $this->jobassign_model->getmorningafterjoblist($oid, $jobdate,'1');
	$i = 1;
	foreach ($moring_sel as $row) {
		$aid = $row->aid;
		$pry_oid = $row->pry_oid;
		$sec_oid = $row->sec_oid;
		$sup_id = $row->sup_id;
		$stime_hour = $row->start_time_hour;
		$start_time_min = $row->start_time_min;
		$end_time_hour = $row->end_time_hour;
		$end_time_min = $row->end_time_min;
		$job_date = $row->job_date_assign;
		$job_date_assign = date("d-m-Y", strtotime($job_date));
		/*Get Patient Name*/
		$patient_id = $row->patient_id;
		$sel_patient = $this->db->query("SELECT pname FROM patients where pid = '$patient_id'");
		$val_patient = $sel_patient->result();
		$patient_name = $val_patient[0]->pname;
		/*Get Intevent Name*/
		$contract_int_id = $row->contract_int_id;
		$intervent_type_id = $row->intervent_type_id;
		$sel_intervent = $this->db->query("SELECT int_type FROM intervention_types where int_type_id = '$intervent_type_id'");
		$val_intervent = $sel_intervent->result();
		$intervent_name = $val_intervent[0]->int_type; 
		$contract_tbl_details = $this->jobassign_model->getinterventtime($contract_int_id);
		$intervent_fortnightly = $contract_tbl_details[0]->intervent_fortnightly;
		$suspendable = $contract_tbl_details[0]->suspendable;
		$intervent_hour = $contract_tbl_details[0]->intervent_hour;
		$exp_hours = explode(":", $intervent_hour);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}
		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
		
	?>
	<div style="border-bottom: 1px solid rgb(51, 51, 51);">
		<div class="jobautocomp_job" >
			<?php $cweekNumber = date("W");
			if( $gweekNumber == "undefined"){
			$weekNumber = $cweekNumber;
			}elseif($gweekNumber  > $cweekNumber){
			$weekNumber = $gweekNumber;
			}else{
			$weekNumber = $cweekNumber;
			} ?>
			<input type="hidden" name="formsuburl" value="<?php echo site_url($i18n.'jobassign/job_maintain_edit') ?>" id = "formsuburl"/>
			<input type="hidden" name="siteurl" value="<?php echo site_url($i18n.'jobassign/check_optweek_availabel') ?>" id = "siteurl"/>
			<input type="hidden" name="passurl" value="<?php echo site_url($i18n.'jobassign/passigno') ?>" id="passurl" />
			<input type="hidden" name="movenav_url" value="<?php echo site_url($i18n.'jobassign_nav/navigation'); ?>" id="movenav_url" />
			<input type="hidden" name="fetch_patient_intervent" value="<?php echo site_url($i18n.'jobassign/fetch_patient_intervent') ?>" id="fetch_patient_intervent" />
			<input type="hidden" name="fetch_all_data" value="<?php echo site_url($i18n.'jobassign/fetch_all_data') ?>" id="fetch_all_data" />
			<input type="hidden" name="action" value="edit" id="action" />
			<input type="hidden" name="aid[]" value="<?=$aid?>" id="aid" />
			<input type="hidden" name="cid" value="<?=$cid?>" id="cid" />
			<input type="hidden" name="contract_int_id" value="<?=$contract_int_id?>" id="contract_int_id" />
			<input type="hidden" id="update_operator_list_url" value="<?php echo site_url($i18n.'jobassign/get_updated_opt_list') ?>" name="update_operator_list_url" />
			<input type="hidden" id="jobremoveurl" value="<?php echo site_url($i18n.'jobassign/deletejobassign') ?>" name="jobremoveurl" />
			<input type="hidden" name="moveweek" id="moveweek" value="<?=$week?>" />
			<input type="hidden" name="moveyear" id="moveyear" value="<?=$year?>" />
			<label><?php echo ( sprintf( lang("JOBASSIGN::patient_list")) ); ?></label>
			<span class="field">
				<input type="hidden" name="patient_id[]" value="<?php echo $patient_id; ?>" />
				<input type="text" readonly="readonly" class="input-large" name="pid[]" value="<?php echo $patient_name; ?>" />
			</span>
		</div>
		<div class="jobautocomp_job">
		<label><?php echo ( sprintf( lang("JOBASSIGN::assign_date")) ); ?></label>
		<span class="field"><input type="text" readonly="readonly" name="job_date_assign[]" id="job_date_assign" value="<?php echo $job_date_assign; ?>" /></span>
		</div>
		
		<div id="get_current_value">
			<?php
				$a= 0;
				$b= $i;
				$span_count = $a+$b;?>
				 <input type="hidden" id="int_hour<?php echo $i; ?>" value="<?=$int_hour?>" name="int_hour" />
				<input type="hidden" id="int_min<?php echo $i; ?>" value="<?=$int_min?>" name="int_min" />
				<input type="hidden" value="<?=$int_hour?>:<?=$int_min?>" readonly="readonly" />
		<div class="jobautocomp_job">
			
			<span><input type="hidden" id="current_time_<?php echo $i; ?>" value="<?php echo $span_count; ?>"></span>
			<label><?php echo ( sprintf( lang("JOBASSIGN::stime")) ); ?><span class="rstar">*</span></label>
			<span class="field">
			<input type="hidden" name="start_hid_hour[]" id="start_hid_hour" value="<?php echo $stime_hour;?>" />
			<input type="hidden" name="start_hid_min[]" id="start_hid_min" value="<?php echo $start_time_min;?>" >
			<select name="hourcombo[]" class="hourcombo combo" id="hourcombo_<?php echo $i; ?>" onchange="check_update_time(<?php echo $i; ?>)">
			<option value="0">00</option>
			<?php for($st = 6; $st <= 22; $st++ ){ ?>
			<option value="<?=$st?>" <?php if($st == $stime_hour){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($st);?></option>
			<?php } ?>
			</select>
			<select name="mincombo[]" class="mincombo combo" id="mincombo_<?php echo $i; ?>" onchange="check_update_time(<?php echo $i; ?>)">
			<?php for($mt = 0; $mt <= 55; $mt = $mt+5 ){ ?>
			<option value="<?=$mt?>" <?php if($mt == $start_time_min){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($mt);?></option>
			<?php } ?>
			</select>(HH:MM)
			</span>
		</div>
		<div class="jobautocomp_job">
			<label><?php echo ( sprintf( lang("JOBASSIGN::etime")) ); ?><span class="rstar">*</span></label>
			<span class="field">
			<select name="endhourcombo[]" class="endhourcombo ecombo" id="endhourcombo_<?php echo $i; ?>" onchange="check_update_time(<?php echo $i; ?>)">
			<option value="0">00</option>
			<?php for($eht = 6; $eht <= 22; $eht++ ){ ?>
			<option value="<?=$eht?>" <?php if($eht == $end_time_hour){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($eht);?></option>
			<?php } ?>
			</select>
			<select name="endmincombo[]" class="endmincombo ecombo" id="endmincombo_<?php echo $i; ?>" onchange="check_update_time(<?php echo $i; ?>)">
			<?php for($emt = 0; $emt <= 55; $emt = $emt+5 ){ ?>
			<option value="<?=$emt?>" <?php if($emt == $end_time_min){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($emt);?></option>
			<?php } ?>
			</select>(HH:MM)
			</span>
		</div>
	</div>
	</div>
	
	<?php
	$i++;
	}
	?>
</div>
<p class="stdformbutton" style="text-align:right;">
	 <a name="update" class="btn btn-primary btn-submit" onclick="timecheck();"><?php echo lang("COMMON::sub_btn"); ?></a>
	 
	 <input type="hidden" name="update" value="update">
	<button type="reset" class="btn" style="margin-right:75px"><?php echo ( sprintf( lang("COMMON::reset_btn")) ); ?></button>
</p>

<?php echo form_close(); ?> </div></div>
<script type="text/javascript">
/*function check_avail_opeator(ele) {
	var value = ele.value;
	var id = ele.id;  
	var start_time_count = $('[id^=hourcombo_]').length;
	var start_min_count = $('[id^=mincombo_]').length;
	var end_time_count = $('[id^=endhourcombo_]').length;
	var end_min_count = $('[id^=endmincombo_]').length;
	var substr = id.split('_');
	for(i=1;i<=start_time_count;i++) {
		var current_start_time = $("#hourcombo_"+i).val();
		var first_start_time = $("#hourcombo_1").val();
		if(substr[1]!=1) {
			if(first_start_time === value) {
				alert('already exit');
				//document.getElementByValue(value).value;
				return false;
			} 
		}
	
	}
}*/
function timecheck(){
	var not_avialble = 0;
	var count = $('[id^=hourcombo_]').length;
	for(var i=1;i <= count;i++){
		startcheck = get_availablity($("#hourcombo_"+i).val(),$("#mincombo_"+i).val(),i,"start");				
		if(startcheck === false){				
			endcheck = get_availablity($("#endhourcombo_"+i).val(),$("#endmincombo_"+i).val(),i,"end");	
			if(endcheck === true){
				//alert("end busy"+i);
				not_avialble = 1;
				break;		
			}	
		} else {
			//alert("start busy"+i);	
			not_avialble = 1;
			break;		
		}
	}	
	//return not_avialble;
	if(not_avialble == 0) {
		$('#formjobassign').submit();	
	}
}
function get_availablity(hour,minute,j,duration){
	//alert("time"+j);
	
	var count = $('[id^=hourcombo_]').length;
	var available = 0;
	for(var i=1;i <= count;i++){
	  if(i != j){
			var starthour = parseInt($("#hourcombo_"+i).val());
			var startmin = parseInt($("#mincombo_"+i).val());
			var endhour = parseInt($("#endhourcombo_"+i).val());
			var endmin = parseInt($("#endmincombo_"+i).val());
			var start = new Date(2014,9,17,starthour,startmin).getTime(); // 03:00 PM 2014/09/17
			var now = new Date(2014,9,17,hour,minute).getTime();// current time 
			var end = new Date(2014,9,17,endhour,endmin).getTime(); // 03:30 PM 2014/09/17
			if( (start < now ) && (now < end )) {				
				alert(duration+" time for job "+ j + " is clash with job " + i  );
				available = 1;	
				
			} else {
				available = 0;
			}
			
		}					
	}
	if(available == 1){
		return true;
	} else {
		return false;	
	}			
}

</script>
<?php
	
}

/* End Job Maintain*/

/* Start Afer noon Job Maintain */
function job_after_noon_maintain_popup($week, $year, $oid, $jobdate) {
	$session_data=$this->session->userdata('logged_in');
	$sdelete = $session_data['sdelete'];
	if($this->lang->mci_current() == ""){
		$i18n = $this->lang->mci_current();
	}else{
		$i18n = $this->lang->mci_current()."/";
	}
	
?>
<script type="text/javascript" src="<?php echo base_url()?>js/job_assign_combo_jquery.js"></script>
<script type="text/javascript">
function check_update_time(i) {
	 
	var combo_hour_to_min = parseInt($('#hourcombo_'+i).val()) ;
	var combo_min = parseInt($('#mincombo_'+i).val());
	total_combo_min = combo_hour_to_min +':'+ combo_min;
	int_hour_to_min = parseInt($('#int_hour'+i).val());
	int_min = parseInt($('#int_min'+i).val());
	total_int_val = int_hour_to_min+':'+int_min;
	
	var totalTime = addTime(total_combo_min, total_int_val,i);
	
	jQuery('#start_hid_hour').val(combo_hour_to_min);
	jQuery('#start_hid_min').val(combo_min);
	
	hideoperatorlist();
}
function addTime(arg1,arg2,k)
{

    if (arguments.length < 2)
    {
        if (arguments.length == 1 && isFormattedDate(arguments[0])) return arguments[0];
        else return false;
    }

    var time1Split, time2Split, totalHours, totalMinutes;
    if (isFormattedDate(arguments[0])) var totalTime = arguments[0];
    else return false;
	
    for (var i = 1; i < 2; i++)
    {
		
        // Add them up
        time1Split = totalTime.split(':');
        time2Split = arguments[i].split(':');

        totalHours = parseInt(time1Split[0]) + parseInt(time2Split[0]);
        totalMinutes = parseInt(time1Split[1]) + parseInt(time2Split[1]);

        // If total minutes is more than 59, then convert to hours and minutes
        if (totalMinutes > 59)
        {
            totalHours += Math.floor(totalMinutes / 60);
            totalMinutes = totalMinutes % 60;
        }
		
        var endhourcombo = document.getElementById('endhourcombo_'+k);
	    for(var i = 0, j = endhourcombo.options.length; i < j; ++i) {
	        if(endhourcombo.options[i].value == totalHours) {
	           jQuery(endhourcombo.options[i]).attr('selected','selected');
	           break;
	        }
	    }
	    var endmincombo = document.getElementById('endmincombo_'+k);
	    for(var k = 0, s = endmincombo.options.length; k < s; ++k) {
	        if(endmincombo.options[k].value == totalMinutes) {
	           jQuery(endmincombo.options[k]).attr('selected','selected');
	           break;
	        }
	    }
        totalTime = totalHours + ':' + padWithZeros(totalMinutes);
    }

    return totalTime;
}

function isFormattedDate(date)
{
    var splitDate = date.split(':');
    if (splitDate.length == 2 && (parseInt(splitDate[0]) + '').length <= 2 && (parseInt(splitDate[1]) + '').length <= 2) return true;
    else return false;
}

function padWithZeros(number)
{
    var lengthOfNumber = (parseInt(number) + '').length;
    if (lengthOfNumber == 2) return number;
    else if (lengthOfNumber == 1) return '0' + number;
    else if (lengthOfNumber == 0) return '00';
    else return false;
}
$(document).ready(function() {
	/*$('.combo').change(function(){
		
	var combo_hour_to_min = parseInt($('.hourcombo').val()) ;
	var combo_min = parseInt($('.mincombo').val());
	total_combo_min = combo_hour_to_min +':'+ combo_min;
	int_hour_to_min = parseInt($('#int_hour').val());
	int_min = parseInt($('#int_min').val());
	total_int_val = int_hour_to_min+':'+int_min;
	var totalTime = addTime(total_combo_min, total_int_val);
	jQuery('#start_hid_hour').val(combo_hour_to_min);
	jQuery('#start_hid_min').val(combo_min);
	hideoperatorlist();
})*/



});
</script>
<h4 class="widgettitle"><span><?php echo ( sprintf( lang("JOBASSIGN::assignjob")) ); ?></span></h4>
<div class="widgetcontent nopadding stdform stdform2" style="width: 866px;">
<?php
if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
<?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div>'; <?php } ?>
<?php $attributes = array('id' => 'formjobassign', 'name' => 'form_validate');
echo form_open($i18n.'jobassign/job_maintain_edit',$attributes);
echo form_open('',$attributes); ?>
<div class="map_data">
	<?php
	$moring_sel = $this->jobassign_model->getmorningafterjoblist($oid, $jobdate,'2');
	$i = 1;
	foreach ($moring_sel as $row) {
		$aid = $row->aid;
		$pry_oid = $row->pry_oid;
		$sec_oid = $row->sec_oid;
		$sup_id = $row->sup_id;
		$stime_hour = $row->start_time_hour;
		$start_time_min = $row->start_time_min;
		$end_time_hour = $row->end_time_hour;
		$end_time_min = $row->end_time_min;
		$job_date = $row->job_date_assign;
		$job_date_assign = date("d-m-Y", strtotime($job_date));
		/*Get Patient Name*/
		$patient_id = $row->patient_id;
		$sel_patient = $this->db->query("SELECT pname FROM patients where pid = '$patient_id'");
		$val_patient = $sel_patient->result();
		$patient_name = $val_patient[0]->pname;
		/*Get Intevent Name*/
		$contract_int_id = $row->contract_int_id;
		$intervent_type_id = $row->intervent_type_id;
		$sel_intervent = $this->db->query("SELECT int_type FROM intervention_types where int_type_id = '$intervent_type_id'");
		$val_intervent = $sel_intervent->result();
		$intervent_name = $val_intervent[0]->int_type; 
		$contract_tbl_details = $this->jobassign_model->getinterventtime($contract_int_id);
		$intervent_fortnightly = $contract_tbl_details[0]->intervent_fortnightly;
		$suspendable = $contract_tbl_details[0]->suspendable;
		$intervent_hour = $contract_tbl_details[0]->intervent_hour;
		$exp_hours = explode(":", $intervent_hour);
		if($exp_hours[0] != ""){
			$int_hour = $exp_hours[0];
		}else{
			$int_hour = "";
		}
		if($exp_hours[1] != ""){
			$int_min = $exp_hours[1];
		}else{
			$int_min = "";
		}
		
	?>
	<div style="border-bottom: 1px solid rgb(51, 51, 51);">
		<div class="jobautocomp_job" >
			<?php $cweekNumber = date("W");
			if( $gweekNumber == "undefined"){
			$weekNumber = $cweekNumber;
			}elseif($gweekNumber  > $cweekNumber){
			$weekNumber = $gweekNumber;
			}else{
			$weekNumber = $cweekNumber;
			} ?>
			<input type="hidden" name="formsuburl" value="<?php echo site_url($i18n.'jobassign/job_maintain_edit') ?>" id = "formsuburl"/>
			<input type="hidden" name="siteurl" value="<?php echo site_url($i18n.'jobassign/check_optweek_availabel') ?>" id = "siteurl"/>
			<input type="hidden" name="passurl" value="<?php echo site_url($i18n.'jobassign/passigno') ?>" id="passurl" />
			<input type="hidden" name="movenav_url" value="<?php echo site_url($i18n.'jobassign_nav/navigation'); ?>" id="movenav_url" />
			<input type="hidden" name="fetch_patient_intervent" value="<?php echo site_url($i18n.'jobassign/fetch_patient_intervent') ?>" id="fetch_patient_intervent" />
			<input type="hidden" name="fetch_all_data" value="<?php echo site_url($i18n.'jobassign/fetch_all_data') ?>" id="fetch_all_data" />
			<input type="hidden" name="action" value="edit" id="action" />
			<input type="hidden" name="aid[]" value="<?=$aid?>" id="aid" />
			<input type="hidden" name="cid" value="<?=$cid?>" id="cid" />
			<input type="hidden" name="contract_int_id" value="<?=$contract_int_id?>" id="contract_int_id" />
			<input type="hidden" id="update_operator_list_url" value="<?php echo site_url($i18n.'jobassign/get_updated_opt_list') ?>" name="update_operator_list_url" />
			<input type="hidden" id="jobremoveurl" value="<?php echo site_url($i18n.'jobassign/deletejobassign') ?>" name="jobremoveurl" />
			<input type="hidden" name="moveweek" id="moveweek" value="<?=$week?>" />
			<input type="hidden" name="moveyear" id="moveyear" value="<?=$year?>" />
			<label><?php echo ( sprintf( lang("JOBASSIGN::patient_list")) ); ?></label>
			<span class="field">
				<input type="hidden" name="patient_id[]" value="<?php echo $patient_id; ?>" />
				<input type="text" readonly="readonly" class="input-large" name="pid[]" value="<?php echo $patient_name; ?>" />
			</span>
		</div>
		<div class="jobautocomp_job">
		<label><?php echo ( sprintf( lang("JOBASSIGN::assign_date")) ); ?></label>
		<span class="field"><input type="text" readonly="readonly" name="job_date_assign[]" id="job_date_assign" value="<?php echo $job_date_assign; ?>" /></span>
		</div>
		
		<div id="get_current_value">
			<?php
				$a= 0;
				$b= $i;
				$span_count = $a+$b;?>
				 <input type="hidden" id="int_hour<?php echo $i; ?>" value="<?=$int_hour?>" name="int_hour" />
				<input type="hidden" id="int_min<?php echo $i; ?>" value="<?=$int_min?>" name="int_min" />
				<input type="hidden" value="<?=$int_hour?>:<?=$int_min?>" readonly="readonly" />
		<div class="jobautocomp_job">
			
			<span><input type="hidden" id="current_time_<?php echo $i; ?>" value="<?php echo $span_count; ?>"></span>
			<label><?php echo ( sprintf( lang("JOBASSIGN::stime")) ); ?><span class="rstar">*</span></label>
			<span class="field">
			<input type="hidden" name="start_hid_hour[]" id="start_hid_hour" value="<?php echo $stime_hour;?>" />
			<input type="hidden" name="start_hid_min[]" id="start_hid_min" value="<?php echo $start_time_min;?>" >
			<select name="hourcombo[]" class="hourcombo combo" id="hourcombo_<?php echo $i; ?>" onchange="check_update_time(<?php echo $i; ?>)">
			<option value="0">00</option>
			<?php for($st = 6; $st <= 22; $st++ ){ ?>
			<option value="<?=$st?>" <?php if($st == $stime_hour){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($st);?></option>
			<?php } ?>
			</select>
			<select name="mincombo[]" class="mincombo combo" id="mincombo_<?php echo $i; ?>" onchange="check_update_time(<?php echo $i; ?>)">
			<?php for($mt = 0; $mt <= 55; $mt = $mt+5 ){ ?>
			<option value="<?=$mt?>" <?php if($mt == $start_time_min){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($mt);?></option>
			<?php } ?>
			</select>(HH:MM)
			</span>
		</div>
		<div class="jobautocomp_job">
			<label><?php echo ( sprintf( lang("JOBASSIGN::etime")) ); ?><span class="rstar">*</span></label>
			<span class="field">
			<select name="endhourcombo[]" class="endhourcombo ecombo" id="endhourcombo_<?php echo $i; ?>" onchange="check_update_time(<?php echo $i; ?>)">
			<option value="0">00</option>
			<?php for($eht = 6; $eht <= 22; $eht++ ){ ?>
			<option value="<?=$eht?>" <?php if($eht == $end_time_hour){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($eht);?></option>
			<?php } ?>
			</select>
			<select name="endmincombo[]" class="endmincombo ecombo" id="endmincombo_<?php echo $i; ?>" onchange="check_update_time(<?php echo $i; ?>)">
			<?php for($emt = 0; $emt <= 55; $emt = $emt+5 ){ ?>
			<option value="<?=$emt?>" <?php if($emt == $end_time_min){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($emt);?></option>
			<?php } ?>
			</select>(HH:MM)
			</span>
		</div>
	</div>
	</div>
	
	<?php
	$i++;
	}
	?>
</div>
<p class="stdformbutton" style="text-align:right;">
	 <a name="update" class="btn btn-primary btn-submit" onclick="timecheck();"><?php echo lang("COMMON::sub_btn"); ?></a>
	 
	 <input type="hidden" name="update" value="update">
	<button type="reset" class="btn" style="margin-right:75px"><?php echo ( sprintf( lang("COMMON::reset_btn")) ); ?></button>
</p>

<?php echo form_close(); ?> </div></div>
<script type="text/javascript">
/*function check_avail_opeator(ele) {
	var value = ele.value;
	var id = ele.id;  
	var start_time_count = $('[id^=hourcombo_]').length;
	var start_min_count = $('[id^=mincombo_]').length;
	var end_time_count = $('[id^=endhourcombo_]').length;
	var end_min_count = $('[id^=endmincombo_]').length;
	var substr = id.split('_');
	for(i=1;i<=start_time_count;i++) {
		var current_start_time = $("#hourcombo_"+i).val();
		var first_start_time = $("#hourcombo_1").val();
		if(substr[1]!=1) {
			if(first_start_time === value) {
				alert('already exit');
				//document.getElementByValue(value).value;
				return false;
			} 
		}
	
	}
}*/
function timecheck(){
	var not_avialble = 0;
	var count = $('[id^=hourcombo_]').length;
	for(var i=1;i <= count;i++){
		startcheck = get_availablity($("#hourcombo_"+i).val(),$("#mincombo_"+i).val(),i,"start");				
		if(startcheck === false){				
			endcheck = get_availablity($("#endhourcombo_"+i).val(),$("#endmincombo_"+i).val(),i,"end");	
			if(endcheck === true){
				//alert("end busy"+i);
				not_avialble = 1;
				break;		
			}	
		} else {
			//alert("start busy"+i);	
			not_avialble = 1;
			break;		
		}
	}	
	//return not_avialble;
	if(not_avialble == 0) {
		$('#formjobassign').submit();	
	}
}
function get_availablity(hour,minute,j,duration){
	//alert("time"+j);
	
	var count = $('[id^=hourcombo_]').length;
	var available = 0;
	for(var i=1;i <= count;i++){
	  if(i != j){
			var starthour = parseInt($("#hourcombo_"+i).val());
			var startmin = parseInt($("#mincombo_"+i).val());
			var endhour = parseInt($("#endhourcombo_"+i).val());
			var endmin = parseInt($("#endmincombo_"+i).val());
			var start = new Date(2014,9,17,starthour,startmin).getTime(); // 03:00 PM 2014/09/17
			var now = new Date(2014,9,17,hour,minute).getTime();// current time 
			var end = new Date(2014,9,17,endhour,endmin).getTime(); // 03:30 PM 2014/09/17
			if( (start < now ) && (now < end )) {				
				alert(duration+" time for job "+ j + " is clash with job " + i  );
				available = 1;	
				
			} else {
				available = 0;
			}
			
		}					
	}
	if(available == 1){
		return true;
	} else {
		return false;	
	}			
}

</script>
<?php
	
}

/* End After noon Job Maintain*/

/*Edit Job maintain */
public function job_maintain_edit() {
 
	
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
	
		if(isset($_REQUEST['update'])){
			$fdata = $_REQUEST;
			$ss = $this->jobassign_model->editjobmaintain($fdata);
		} 
		
		if($this->lang->mci_current() == ""){
	  	$i18n = $this->lang->mci_current();
	  }else{
		$i18n = $this->lang->mci_current()."/";
	  }
		redirect($i18n.'jobassign','refresh');
  }

/*End Job Maintain*/
public function copyweek($week, $year,$filt_oid,$pid,$dist_id,$filter_box_status)
{ ?>

	<h4 class="widgettitle"><span><?php echo ( sprintf( lang("JOBASSIGN::copy_week")) ); ?></span></h4>
	<div class="widgetcontent nopadding stdform stdform2" style="width: 866px;">
	 <?php
	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div>'; <?php } ?>

   <?php $attributes = array('id' => 'formweek', 'name' => 'form_validate');
   echo form_open('',$attributes); ?>

<div class="map_data">
	<p>
                                <label><?php echo lang("REPORT::dname"); ?><span class="rstar">*</span></label>
                                <span class="field">
                                	<select id="district" name="district">
							<option value="0" selected="selected"><?php echo lang("COMMON::choose_one"); ?></option>
                            <?php $dist = $this->common->districtlist_new();
							if(count($dist) > 0){
                             foreach($dist as $dist_list){
                            	$did = $dist_list->did;
								$dist_name = $dist_list->dist_name;?>
								<option value="<?=$did?>"><?=$dist_name?></option>
                          	<?php } }else{ ?>
								<option value=""><?php echo lang('INTERVENT::dataempty'); ?></option>
                        	<?php } ?>
							</select></span>
                            </p>
	<div class="jobautocomp">
		<input type="hidden" value="<?=$filt_oid?>" name="filter_operator" id="filter_operator"/>
		<input type="hidden" value="<?=$pid?>" name="filter_patient" id="filter_patient"/>
		<input type="hidden" value="<?=$dist_id?>" name="filter_district" id="filter_district"/>
		<input type="hidden" value="<?=$filter_box_status?>" name="filter_box_status" id="filter_box_status"/>
		<input type="hidden" name="nav_url" value="<?php echo site_url($i18n.'jobassign_nav/navigation'); ?>" id="nav_url" />
		<input type="hidden" name="weekurl" value="<?php echo site_url($i18n.'jobassign/submit_week_copy_form') ?>" id="weekurl" />
		<label><?php echo lang("JOBASSIGN::select_designation_week"); ?><span class="rstar">*</span></label>
		<span class="field">
			<?php $start = array();
			for($w = $week+1; $w <= $week + 10; $w++){
			for($d = 1; $d <= 7; $d++){
				if($d == 1){
					$start[$w]['start'] = date("d/m/Y", strtotime($year."W".$w.$d));
				}
				if($d == 7){
					$start[$w]['end'] = date("d/m/Y", strtotime($year."W".$w.$d));
				}
			}
			} ?>
			<input type="hidden" name="selectedweekno" id="selectedweekno" value="<?=$week?>" />
			<input type="hidden" name="year" id="year" value="<?=$year?>" />
			<select name="weekno" id="weekno">
				<option value="">--<?php echo lang("JOBASSIGN::select_designation_week"); ?>--</option>
				<?php foreach($start as $key=>$value){ ?>
				<option value="<?=$key?>"><?php echo $value['start']." - ".$value['end']; ?></option>
				<?php } ?>
			</select></span>
	</div>
</div>
<p class="stdformbutton finalsubmit" style="text-align:right;">
		<a href="javascript:void(0);" <?php echo $btn_style ?> onclick="submitcopyweek();" id="sub_btn" class="btn btn-primary btn-submit"><?php echo ( sprintf( lang("COMMON::sub_btn")) ); ?></a>
		<button type="reset" class="btn" style="margin-right:75px"><?php echo ( sprintf( lang("COMMON::reset_btn")) ); ?></button>
</p>
<?php echo form_close(); ?> </div></div>
<?php }

function submit_week_copy_form()
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


		$ss = $this->jobassign_model->putcopyweekdata();
		if($this->lang->mci_current() == ""){
	  	$i18n = $this->lang->mci_current();
	  }else{
		$i18n = $this->lang->mci_current()."/";
	  }
		redirect($i18n.'jobassign','refresh');
  }

/* Move job  */
  function move_job($oid, $week, $year) {
		if($this->lang->mci_current() == ""){
	  		$i18n = $this->lang->mci_current();
	  	}else{
			$i18n = $this->lang->mci_current()."/";
	  	}
		$date_val = date('d-m-Y', $jobdate);
		?>
<div class="widgetbox box-inverse span9">
<script type="text/javascript" src="<?php echo base_url()?>js/job_assign_combo_jquery.js"></script>
<h4 class="widgettitle"><span><?php echo ( sprintf( lang("JOBASSIGN::move_job")) ); ?></span></h4>
                <div class="widgetcontent nopadding stdform stdform2" style="width: 866px;">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div>'; <?php } ?>

           <?php $attributes = array('id' => 'formmovejob', 'name' => 'form_validate');
           echo form_open('',$attributes); ?>
           <div class="jobautocomp">
			<input type="hidden" name="movenav_url" value="<?php echo site_url($i18n.'jobassign_nav/navigation'); ?>" id="movenav_url" />
           <input type="hidden" name="siteurl" value="<?php echo site_url($i18n.'jobassign/check_optweek_availabel') ?>" id = "siteurl"/>
           <input type="hidden" name="formsuburl" value="<?php echo site_url($i18n.'jobassign/submitmovejob') ?>" id = "formsuburl"/>

           <input type="hidden" name="oid" id="oid" value="<?=$oid?>" />
           	<input type="hidden" name="moveweek" id="moveweek" value="<?=$week?>" />
			<input type="hidden" name="moveyear" id="moveyear" value="<?=$year?>" />
		</div>
		<?php
$moring_sel = $this->jobassign_model->get_moved_operator_exist($oid, $week,$year);
$sk = 1;
unset($timedata);
unset($piddata);
$timedata = array();
$piddata = array();
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
?>
<?php $sk++; }  ?>
<input type="hidden" name="shour" id="shour" value="<?=$start_hour?>" />
<input type="hidden" name="smin" id="smin" value="<?=$start_min?>" />
<input type="hidden" name="ehour" id="ehour" value="<?=$end_hour?>" />
<input type="hidden" name="emin" id="emin" value="<?=$end_min?>" />
		<div class="jobautocomp optmove">
		    <label><?php echo lang('JOBASSIGN::reassign_operator'); ?></label>
				<span class="field sec">
					<select name="move_opt" id="move_opt">
						<option value="" selected="selected"><?php echo lang("JOBASSIGN::select"); ?></option>
                                <?php
									$move_opt = $this->common->getoperatorlist_new();
									if(count($move_opt) > 0){
                                foreach($move_opt as $move_opt_list){
                                	$move_oid = $move_opt_list->oid;
									$move_fname = $move_opt_list->firstname;
									$move_lname = $move_opt_list->lastname;
									$move_name = $move_fname." ".$move_lname; ?>
									<option value="<?=$move_oid?>" <?php if($oid == $move_oid){ ?>selected="selected" <?php } ?>><?=$move_name?><?php echo "(".$this->common->getrolename($move_opt_list->role).")"; ?></option>
                              <?php } }else{ ?>
									<option value=""><?php echo lang('INTERVENT::dataempty'); ?></option>
                              <?php } ?>
                            </select><br>
                            <span class="error_msg"></span>
				</span>
				</div>
			<p class="stdformbutton finalsubmit" style="text-align:right;">
                                <a href="javascript:void(0);" onclick="javasubmitmovejob();" class="btn btn-primary btn-submit"><?php echo ( sprintf( lang("COMMON::sub_btn")) ); ?></a>
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo ( sprintf( lang("COMMON::reset_btn")) ); ?></button>
           </p>
<?php echo form_close(); ?> </div></div>
<?php
    }

function submitmovejob()
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


		echo $ss = $this->jobassign_model->put_move_job();

  }

public function checkcontractdetails_contract()
{
	echo $ss = $this->jobassign_model->jobcontract_ceased_date();
}
public function deleteyellowbox($oid,$week,$year)
{
	$this->jobassign_model->deleteyellowbox_jobs($oid,$week,$year);
}
}
?>
