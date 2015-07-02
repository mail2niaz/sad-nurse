<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'jobassign','<i class="icon-backward"></i>&nbsp;&nbsp;'.( sprintf( lang("joblist")) ).'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
            <div class="pagetitle">
               <h1><?php echo ( sprintf( lang("assignjob")) ); ?></h1>
            </div>
        </div><!--pageheader-->

<link rel="stylesheet" href="<?php echo base_url()?>css/smooth_jquery_ui.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/combo_jquery.js"></script>

<script>
jQuery( document ).ready(function () {
	jQuery( "#ui-id-2" ).click(function () {
		var sss = jQuery('#combobox1').val();
		   jQuery.post("<?php echo site_url($i18n.'jobassign/autocomplete_int_type') ?>",
               {queryString: ""+sss+""},
               function(data){
                         jQuery('#val').html(data);
	       });
});

jQuery( "#jobsub" ).click(function () {

var pm = document.getElementById('primary_mandatory').value;
var secm = document.getElementById('secondary_mandatory').value;
var supm = document.getElementById('supervisor_mandatory').value;

if(pm == '1'){
if(document.getElementById('primay_opt').value=="")
   {
		jQuery('#primay_opt').css({ 'border': '1px solid Red' });
		 document.getElementById('primay_opt').focus();
		 return false;
} }

if(secm == '1'){
if(document.getElementById('secondary_opt').value=="")
   {
		 jQuery('#secondary_opt').css({ 'border': '1px solid Red' });
		 document.getElementById('secondary_opt').focus();
		 return false;
} }

if(supm == '1'){
if(document.getElementById('supervisor_opt').value=="")
   {
		 jQuery('#supervisor_opt').css({ 'border': '1px solid Red' });
		 document.getElementById('supervisor_opt').focus();
		 return false;
} }

});

});

function primay_role_fun(pval){
		   jQuery.post("<?php echo site_url($i18n.'jobassign/get_select_role_list') ?>",
           {queryString: ""+pval+""},
               function(data){
                         jQuery('#primay_opt').html(data);
	       });
}

function secondary_role_fun(secval){
	jQuery.post("<?php echo site_url($i18n.'jobassign/get_select_role_list') ?>",
           {queryString: ""+secval+""},
               function(data){
                         jQuery('#secondary_opt').html(data);
	       });
}

function supervisor_role_fun(supval){
	jQuery.post("<?php echo site_url($i18n.'jobassign/get_select_role_list') ?>",
           {queryString: ""+supval+""},
               function(data){
                         jQuery('#supervisor_opt').html(data);
	       });
}


</script>

        <div class="maincontent">
            <div class="maincontentinner">



          <div class="widgetbox box-inverse span9">
                <h4 class="widgettitle"><?php echo ( sprintf( lang("assignjob")) ); ?></h4>
                <div class="widgetcontent nopadding">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div>'; <?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2', 'name' => 'form_validate');
           echo form_open('jobassign/passigno',$attributes); ?>
                            <div class="jobautocomp">
                            <label><?php echo ( sprintf( lang("patient_list")) ); ?></label>
                            <span class="field">
							<select id="combobox" name="patient_name" id="">
							<option value="" selected="selected">--Select--</option>
                            <?php $pat = $this->common->getpatientlist();
							if(count($pat) > 0){
                             foreach($pat as $pats){
                            	$pid = $pats->pid;
								$pname = $pats->pname;?>
								<option value="<?=$pid?>"><?=$pname?></option>
                          	<?php } }else{ ?>
								<option value="">Patients Not Available</option>
                        	<?php } ?>
							</select>

						</span>
						</div>

						<div class="jobautocomp">
                            <label><?php echo ( sprintf( lang("intervent_type")) ); ?></label>
                            <span class="field">
							<select id="combobox1" name="intervent_type" class="sss">
							<option value="" selected="selected">--Select--</option>
                                <?php $int_type = $this->common->getintervent_type_list();
									if(count($int_type) > 0){
                                foreach($int_type as $int_type_list){
                                	$int_id = $int_type_list->int_type_id;
									$int_code = $int_type_list->int_code; ?>
									<option value="<?=$int_id?>"><?=$int_code?></option>
                              <?php } }else{ ?>
									<option value="">Intervent Type Not Available</option>
                              <?php } ?>
							</select>
						</span>
						</div>

						<div id="val"></div>

                        <p class="stdformbutton" style="text-align:right">
                                <button class="btn btn-primary btn-submit" id="jobsub"><?php echo ( sprintf( lang("sub_btn")) ); ?></button>
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo ( sprintf( lang("reset_btn")) ); ?></button>
                            </p>
<?php echo form_close(); ?>
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
<?php $this->load->view('common/footer'); ?>