<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'cms/tag_list','<i class="icon-backward"></i>&nbsp;&nbsp;'.lang("TAG::tag_list").'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
            <div class="pagetitle">
            	<?php if($action == "edit"){ ?>
            		<h1><?php echo lang("TAG::edit_tag"); ?></h1>
            		<?php }elseif($action == "add"){ ?>
            			<h1><?php echo lang("TAG::add_tag"); ?></h1>
            			<?php } ?>

            </div>
        </div><!--pageheader-->
        <div class="maincontent">
            <div class="maincontentinner">

            <div class="widgetbox box-inverse span10" style="margin-left: 5px;">

                	                	<?php if($action == "edit"){ ?>
                	                		<h4 class="widgettitle"><?php echo lang("TAG::edit_tag"); ?></h4>
                <div class="widgetcontent nopadding">
                		<?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open($i18n.'cms/edit_tag/'.$optval->tid,$attributes);
		   echo form_hidden('tid',$optval->tid);
		    ?>
                			<p>
                                <label><?php echo lang("TAG::tag_desc"); ?><span class="rstar">*</span></label>
                                <span class="field"><input id="tag_description" class="input-xxlarge" type="text" name="tag_description" value="<?php echo $optval->tag_description; ?>"></span>
                            </p>

							<p class="stdformbutton" style="text-align:right">
                                <input type="submit" class="btn btn-primary btn-submit" name="mysubmit" value="<?php echo lang("COMMON::sub_btn"); ?>" />
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo lang("COMMON::reset_btn"); ?></button>
                            </p>
<?php echo form_close(); ?>
                            </div>
                	<?php }elseif($action == "add"){ ?>
                			<h4 class="widgettitle"><?php echo lang("TAG::add_tag"); ?></h4>
                <div class="widgetcontent nopadding">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('cms/add_tag',$attributes); ?>
                            <p>
                                <label><?php echo lang("TAG::tag_desc"); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="tag_description" id="tag_description" class="input-xxlarge" /></span>
                            </p>

                            <p class="stdformbutton" style="text-align:right">
                            	<input type="submit" class="btn btn-primary btn-submit" name="mysubmit" value="<?php echo lang("COMMON::sub_btn"); ?>" />
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