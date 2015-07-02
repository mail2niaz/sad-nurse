<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
            <div class="pagetitle">
               <h1><?php
               if($view == "no"){
               echo lang("CMS-ROLE::edit_role"); }elseif($view == "yes"){
				echo lang("CMS-ROLE::view_role");
               } ?></h1>
            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">

			<?php  if($view == "no"){ ?>
            <div class="widgetbox box-inverse span9">
                <h4 class="widgettitle"><?php echo lang("CMS-ROLE::edit_role"); ?></h4>
                <div class="widgetcontent nopadding">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div>'; <?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('cms/editrole/'.$optval->rid,$attributes); ?>
           <?php echo form_hidden('rid',$optval->rid);
           ?>
                            <p>
                                <label><?php echo lang("CMS-ROLE::role_name"); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="rname" id="rname" class="input-xxlarge" value="<?php echo $optval->type;?>" /></span>
                            </p>

                            <p class="stdformbutton" style="text-align:right">
                            	<input type="submit" class="btn btn-primary btn-submit" name="mysubmit" value="<?php echo lang("COMMON::sub_btn"); ?>">
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo lang("COMMON::reset_btn"); ?></button>
                            </p>
<?php echo form_close(); ?>
                </div><!--widgetcontent-->
            </div><!--widget-->
			<?php }elseif($view == "yes"){ ?>
				<div class="widgetbox box-inverse span9">
                <h4 class="widgettitle"><?php echo lang("CMS-ROLE::view_role"); ?></h4>
                <div class="widgetcontent nopadding">
				<div class="stdform stdform2">
				<p>
                                <label><?php echo lang("CMS-ROLE::role_name"); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->type;?></span>
                </p>

				<p class="stdformbutton" style="text-align:right">
                            	<?php $attributes2 = array('class' => 'btn btn-primary btn-submit');
                            	echo anchor($i18n.'cms/editrole/'.$optval->rid,'<i class="icon-link"></i>&nbsp;&nbsp;'.lang("CMS-ROLE::edit_role"),$attributes2); ?> </a>
                            </p></div>
                </div></div>
				<?php } ?>

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