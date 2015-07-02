<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

        <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
            <div class="pagetitle">
               <h1><?php echo ( sprintf( lang("opt_report")) ); ?></h1>
            </div>
        </div><!--pageheader-->
        <script type="text/javascript">
jQuery(document).ready(function(){
jQuery('.search_result').hide();
jQuery('#role').change(function(){
 var role_id = jQuery('#role').val();
 var url = "<?php echo site_url($i18n.'report/get_optresult') ?>/"+role_id;
 jQuery.ajax({
 type: "POST",
 url: url,
 success: function(msg)
 {
 	jQuery('.search_result').show();
	jQuery('.search_result').html(msg);
 }
 });
 });
 });
</script>

        <div class="maincontent">
            <div class="maincontentinner">
            	<div class="widgetbox box-inverse span10" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo ( sprintf( lang("add_patient")) ); ?></h4>
                <div class="widgetcontent nopadding">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('patient/addpatient',$attributes); ?>
                           <p>
                                <label><?php echo ( sprintf( lang("role")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><select name="role" id="role" class="uniformselect">
                                    <option value=""><?php echo ( sprintf( lang("choose_one")) ); ?></option>
                                    <?php
									$role = $this->common->rolelist();
									$role_cnt = $role->num_rows();
										if ($role_cnt > 0)
										{
										   foreach ($role->result() as $row)
										   {
										   			$rid = $row->rid;
										    		$type = $row->type;
													?>
											<option value="<?=$rid?>"><?=$type?></option>
												<?php } }  ?>
                                </select></span>
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
<?php $this->load->view('common/footer'); ?>