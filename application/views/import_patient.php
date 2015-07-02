<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'patient/patientlist','<i class="icon-backward"></i>&nbsp;&nbsp;'.( sprintf( lang("PATIENT::patient_list")) ).'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
            <div class="pagetitle">
               <h1><?php echo ( sprintf( lang("PATIENT::import")) ); ?></h1>
            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">

            <div class="widgetbox box-inverse span9">
                <h4 class="widgettitle"><?php echo ( sprintf( lang("PATIENT::import")) ); ?></h4>
                <div class="widgetcontent nopadding">
          	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open_multipart('patient/import',$attributes);
           echo form_hidden('tid',$stype);
           echo form_hidden('aid',$aid);
           ?>
          					<p>
                                <label><?php echo ( sprintf( lang("OPERATOR::import_file")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="file" name="opt_file" /></span>
                            </p>
                            <p class="stdformbutton" style="text-align:right">
                                <input type="submit" class="btn btn-primary btn-submit" name="mysubmit" value="<?php echo ( sprintf( lang("COMMON::sub_btn")) ); ?>">
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo ( sprintf( lang("COMMON::reset_btn")) ); ?></button>
                            </p>
<?php echo form_close(); ?>
</div>
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