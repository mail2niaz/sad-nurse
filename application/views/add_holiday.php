<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'cms/view_holidays_list','<i class="icon-backward"></i>&nbsp;&nbsp;'.lang("CMS-HOLIDAY::holidays").'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
            <div class="pagetitle">
            	<?php if(isset($edit)){ ?>
               <h1><?php echo lang("CMS-HOLIDAY::editholidays"); ?></h1>
               <?php }else{ ?>
				<h1><?php echo lang("CMS-HOLIDAY::addholidays"); ?></h1>
               <?php } ?>
            </div>
        </div><!--pageheader-->
        <div class="maincontent">
            <div class="maincontentinner">

            <div class="widgetbox box-inverse span10" style="margin-left: 5px;">

                	<?php if(isset($edit)){ ?>
                		<h4 class="widgettitle"><?php echo lang("CMS-HOLIDAY::editholidays"); ?></h4>
                <div class="widgetcontent nopadding">
                		<?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('cms/updateholiday_details/'.$hid,$attributes);
		   echo form_hidden('hid',$optval->hid);
		    ?>
                			<p>
                                <label><?php echo lang("CMS-HOLIDAY::date"); ?><span class="rstar">*</span></label>
                                <span class="field"><input id="hdate" class="input-large" type="text" name="hdate" value="<?php echo date("d-m-Y",  $optval->hdate); ?>" readonly="readonly"></span>
                            </p>
                            <p>
                                <label><?php echo lang("CMS-HOLIDAY::reason"); ?><span class="rstar">*</span></label>
                                <span class="field"><textarea name="reason" id="reason" class="input-large"><?php echo $optval->reason; ?></textarea></span>
                            </p>

							<p class="stdformbutton" style="text-align:right">
                                <button class="btn btn-primary btn-submit"><?php echo lang("COMMON::sub_btn"); ?></button>
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo lang("COMMON::reset_btn"); ?></button>
                            </p>
<?php echo form_close(); ?>
                            </div>
                		<?php }else{ ?>
                			<h4 class="widgettitle"><?php echo lang("CMS-HOLIDAY::addholidays"); ?></h4>
                <div class="widgetcontent nopadding">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('cms/putholiday_details',$attributes); ?>
           					<p>
                                <label><?php echo lang("CMS-HOLIDAY::date"); ?><span class="rstar">*</span></label>
                                <span class="field"><input id="hdate" class="input-large" type="text" name="hdate" readonly="readonly"></span>
                            </p>
                            <p>
                                <label><?php echo lang("CMS-HOLIDAY::reason"); ?><span class="rstar">*</span></label>
                                <span class="field"><textarea name="reason" id="reason" class="input-large"></textarea></span>
                            </p>

                            <p class="stdformbutton" style="text-align:right">
                                <button class="btn btn-primary btn-submit"><?php echo lang("COMMON::sub_btn"); ?></button>
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo lang("COMMON::reset_btn"); ?></button>
                            </p>
<?php echo form_close(); ?>
</div><!--widgetcontent-->
<?php } ?>

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