<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

        <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'jobassign2/manual_intervent','<i class="icon-backward"></i>&nbsp;&nbsp;'.lang("LEFTMENU::manual_intervent_title").'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
            <div class="pagetitle">
               <h1><?php echo lang("REPORT::inv_form"); ?></h1>
            </div>
<link rel="stylesheet" href="<?php echo base_url()?>css/smooth_jquery_ui.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/out_job_assign_combo_jquery.js"></script>

        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">
            	<div class="widgetbox box-inverse span10" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo lang("REPORT::inv_form"); ?></h4>
                <div class="widgetcontent nopadding">
 <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('',$attributes); ?>
           <div class="stdform stdform2">
                           <p>
                                <label><?php echo lang("REPORT::pname"); ?></label>
                                <span class="field"><select name="pid" id="filter_patient" class="uniformselect">
                                    <option value="0" selected="selected"><?php echo lang("COMMON::choose_one"); ?></option>
                                    <?php
									$role = $this->common->getpatientlist();
										   foreach ($role as $row)
										   {
													$pid = $row->pid;
													$name = $row->pname;
													$patient_surname = $row->surname;
													$pname = $patient_surname." ".$name;
													?>
											<option value="<?=$pid?>">PID-<?=$pid?>&nbsp;(<?=$pname?>)</option>
												<?php }  ?>
                                </select></span>
                            </p>
                            <p>
                                <label><?php echo lang("REPORT::oname"); ?></label>
                                <span class="field"><select name="oid" id="filter_operator" class="uniformselect">
                                    <option value="0" selected="selected"><?php echo lang("COMMON::choose_one"); ?></option>
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
                                <label><?php echo lang("REPORT::dname"); ?></label>
                                <span class="field">
                                	<select id="filter_district" name="filter_district">
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

							<p>
                                <label><?php echo lang("REPORT::entry_date"); ?></label>
                                <span class="field" style="height: 30px;">
                                <label style="float: left; width: 50px; margin: 0px; padding: 5px 0px 0px 0px;"><?php echo lang("from"); ?></label>
                                <input id="from" class="input-large" type="text" name="from" readonly="readonly" style="float: left;">
                                <label style="float: left; width: 50px; margin: 0px; padding: 5px 0px 0px 15px;"><?php echo lang("to"); ?></label>
                                <input id="to" class="input-large" type="text" name="to" readonly="readonly" style="float: left;">
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
<div class="search_result"></div><!--Search Result -->
<div id="search_result_popup" style="display: none;"></div>

            </div><!--maincontentinner-->
        </div><!--maincontent-->

    </div><!--rightpanel-->

</div><!--mainwrapper-->
<script type="text/javascript">
jQuery(document).ready(function(){
jQuery('.search_result').hide();
jQuery('.btnSubmit').click(function(){
	 var pid = jQuery('#filter_patient').val();
	 var oid = jQuery('#filter_operator').val();
	 var did = jQuery('#filter_district').val();
	 var from = jQuery('#from').val();
	 var to = jQuery('#to').val();
	if(pid == "0"){
		var fpid = "null";
	}else{
		fpid = pid;
	}

	if(oid == "0"){
		var foid = "null";
	}else{
		foid = oid;
	}
	if(did == "0"){
		var fdid = "null";
	}else{
		fdid = did;
	}

	if(from == ""){
		var ffrom = "null";
	}else{
		ffrom = from;
	}

	if(to == ""){
		var fto = "null";
	}else{
		fto = to;
	}
	 //if(pid !="0" || oid != "0" || did != '0' || (from != "" && to != "")){
	 var url = "<?php echo site_url($i18n.'report/get_pat_int_result') ?>/"+fpid+"/"+foid+"/"+ffrom+"/"+fto+"/"+fdid;
	 jQuery.ajax({
	 type: "POST",
	 url: url,
	 success: function(msg)
	 {
	 	jQuery('.search_result').show();
		jQuery('.search_result').html(msg);
	 }
	 });
	 /*}else{
	 	alert("Si prega di selezionare qualsiasi campo un filtro");
	 }*/
 });

 });
</script>
<?php $this->load->view('common/footer'); ?>
