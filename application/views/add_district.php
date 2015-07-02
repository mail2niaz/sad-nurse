<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
            <div class="pagetitle">
            	<?php if(isset($edit)){ ?>
            		<h1><?php echo lang("CMS-DISTRICT::edit_district"); ?></h1>
            		<?php }else{ ?>
            			<h1><?php echo lang("CMS-DISTRICT::add_district"); ?></h1>
            		<?php } ?>

            </div>
        </div><!--pageheader-->
        <div class="maincontent">
            <div class="maincontentinner">

            <div class="widgetbox box-inverse span10" style="margin-left: 5px;">

                	                	<?php if(isset($edit)){ ?>
                	                		<h4 class="widgettitle"><?php echo lang("CMS-DISTRICT::edit_district"); ?></h4>
                <div class="widgetcontent nopadding">
                		<?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('cms/update_district_details/'.$did,$attributes);
		   echo form_hidden('did',$optval->did);
		    ?>
                			<p>
                                <label><?php echo lang("CMS-DISTRICT::district_name"); ?><span class="rstar">*</span></label>
                                <span class="field"><input id="dist_name" class="input-xxlarge" type="text" name="dist_name" value="<?php echo $optval->dist_name; ?>"></span>
                            </p>
                            <p>
                                <label><?php echo lang("CMS-DISTRICT::p200_code"); ?><span class="rstar">*</span></label>
                                <span class="field"><input id="p2000_code" class="input-xxlarge" type="text" name="p2000_code" value="<?php echo $optval->P2000_CODE; ?>"></span>
                            </p>

							<p class="stdformbutton" style="text-align:right">
                                <button class="btn btn-primary btn-submit"><?php echo lang("COMMON::sub_btn"); ?></button>
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo lang("COMMON::reset_btn"); ?></button>
                            </p>
<?php echo form_close(); ?>
                            </div>
                		<?php }else{ ?>
                			<h4 class="widgettitle"><?php echo lang("CMS-DISTRICT::add_district"); ?></h4>
                <div class="widgetcontent nopadding">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('cms/put_district_details',$attributes); ?>
                            <p>
                                <label><?php echo lang("CMS-DISTRICT::district_name"); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="dist_name" id="dist_name" class="input-xxlarge" /></span>
                            </p>
                               <p>
                                <label><?php echo lang("CMS-DISTRICT::p200_code"); ?><span class="rstar">*</span></label>
                                <span class="field"><input id="p2000_code" class="input-xxlarge" type="text" name="p2000_code"></span>
                            </p>
                            <p class="stdformbutton" style="text-align:right">
                                <button class="btn btn-primary btn-submit"><?php echo lang("COMMON::sub_btn"); ?></button>
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo lang("COMMON::reset_btn"); ?></button>
                            </p>
<?php echo form_close(); ?>
<?php } ?>
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
