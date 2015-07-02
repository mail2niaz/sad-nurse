<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<a href="<?php echo site_url($i18n.'setting/admintypelist') ?>" class="btn btn-rounded btn-submit btn-primary">
            	<i class="icon-link"></i>&nbsp;<?php echo ( sprintf( lang("admin_type")) ); ?></a>
                            </p>
            <div class="pagetitle">
               <h1><?php echo ( sprintf( lang("admin_type")) ); ?></h1>
            </div>
        </div><!--pageheader-->
        <div class="maincontent">
            <div class="maincontentinner">

            <div class="widgetbox box-inverse span10" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo ( sprintf( lang("admin_type")) ); ?></h4>
                <div class="widgetcontent nopadding">
                	<?php if(isset($view)){ ?>
                		<div class="stdform stdform2">
                		<p>
                                <label><?php echo ( sprintf( lang("COMMON::type")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->type_name; ?></span>
                            </p>

                            <p class="stdformbutton" style="text-align:right">
                            	<?php $attributes2 = array('class' => 'btn btn-primary btn-submit');
                            	echo anchor($i18n.'setting/editadmintypedata/'.$optval->tid,'<i class="icon-link"></i>&nbsp;&nbsp;'.( sprintf( lang("editadmin_type")) ),$attributes2); ?> </a>
                            </p>
                            </div>
                		<?php }else{ ?>
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('setting/addadmintypedata',$attributes); ?>
           					<p>
                                <label><?php echo ( sprintf( lang("COMMON::type")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="type_name" id="type_name" class="input-xxlarge" /></span>
                            </p>

                            <p class="stdformbutton" style="text-align:right">
                                <button class="btn btn-primary btn-submit"><?php echo ( sprintf( lang("COMMON::sub_btn")) ); ?></button>
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo ( sprintf( lang("COMMON::reset_btn")) ); ?></button>
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