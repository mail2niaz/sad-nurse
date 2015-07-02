<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

        <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
            <div class="pagetitle">
               <h1><?php echo lang("REPORT::inv_report"); ?></h1>
            </div>
            <?php echo anchor($this->lang->mci_current().'/report/req_intervent_chart_report/',lang("REPORT::int_chart_report"),array('class' => 'btn btn-primary btn-submit export')); ?>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">
            	<div class="widgetbox box-inverse span10" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo lang("REPORT::inv_report"); ?></h4>
                <div class="widgetcontent nopadding">
 <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('',$attributes); ?>
           <div class="stdform stdform2">
                           <p>
                                <label><?php echo lang("REPORT::pname"); ?></label>
                                <span class="field"><select name="req_id" id="req_id" class="uniformselect">
                                    <option value=""><?php echo lang("COMMON::choose_one"); ?></option>
                                    <?php
									$role = $this->common->getrequestlist();
									$role_cnt = $role->num_rows();
										if ($role_cnt > 0)
										{
										   foreach ($role->result() as $row)
										   {
													$patient_id = $row->patient_id;
													$name = $row->patient;
													$patient_surname = $row->patient_surname;
													$pname =$patient_surname." ".$name;
													?>
											<option value="<?=$patient_id?>">PID-<?=$patient_id?>&nbsp;(<?=$pname?>)</option>
												<?php } }  ?>
                                </select></span>
                            </p>

                            <p>
                                <label><?php echo lang("REPORT::oname"); ?></label>
                                <span class="field"><select name="oid" id="oid" class="uniformselect">
                                    <option value=""><?php echo lang("COMMON::choose_one"); ?></option>
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
                                <label><?php echo lang("REPORT::entry_date"); ?></label>
                                <span class="field" style="height: 30px;">
                                <label style="float: left; width: 50px; margin: 0px; padding: 5px 0px 0px 0px;"><?php echo lang("from"); ?></label>
                                <input id="fdate" class="input-large" type="text" name="from" readonly="readonly" style="float: left;">
                                <label style="float: left; width: 50px; margin: 0px; padding: 5px 0px 0px 15px;"><?php echo lang("to"); ?></label>
                                <input id="tdate" class="input-large" type="text" name="to" readonly="readonly" style="float: left;">
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
jQuery('.search_result').hide();
jQuery('.btnSubmit').click(function(){

	 var pid = jQuery('#req_id').val();
	 var oid = jQuery('#oid').val();
	 var from = jQuery('#fdate').val();
	 var to = jQuery('#tdate').val();
	if(pid == ""){
		var fpid = "null";
	}else{
		fpid = pid;
	}

	if(oid == ""){
		var foid = "null";
	}else{
		foid = oid;
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
	 if(pid !="" || oid != "" || (from != "" && to != "")){
	 var url = "<?php echo site_url($i18n.'report/get_reqresult') ?>/"+fpid+"/"+foid+"/"+ffrom+"/"+fto;
	 jQuery.ajax({
	 type: "POST",
	 url: url,
	 success: function(msg)
	 {
	 	jQuery('.search_result').show();
		jQuery('.search_result').html(msg);
	 }
	 });
	 }else{
	 	alert("Please Select Any one Filter Field");
	 }
 });

 });
</script>
<?php $this->load->view('common/footer'); ?>