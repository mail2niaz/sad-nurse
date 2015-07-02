<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'setting/adminuserlist','<i class="icon-backward"></i>&nbsp;&nbsp;'.( sprintf( lang("admin_user")) ).'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
            <div class="pagetitle">
               <h1><?php echo ( sprintf( lang("editadmin_user")) ); ?></h1>
            </div>
        </div><!--pageheader-->
        <div class="maincontent">
            <div class="maincontentinner">

            <div class="widgetbox box-inverse span10" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo ( sprintf( lang("editadmin_user")) ); ?></h4>
                <div class="widgetcontent nopadding">
                    	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('setting/edituserdata/'.$optval->aid,$attributes);
		   echo form_hidden('aid',$optval->aid);
           ?>
           					<p>
                                <label><?php echo ( sprintf( lang("admin_name")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="name" id="name" value="<?php echo $optval->name; ?>" class="input-xxlarge" /></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("admin_email")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="email" name="email" value="<?php echo $optval->email; ?>" id="email" class="input-xxlarge" /></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("admin_uname")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="username" id="username" value="<?php echo $optval->username; ?>" class="input-xxlarge" /></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("SETTING::password")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="password" name="pass" value="" id="pass" class="input-xxlarge" /></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("SETTING::type")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><select name="type" id="type" class="uniformselect">
                                	<option value=""><?php echo ( sprintf( lang("COMMON::choose_one")) ); ?></option>
                                	<?php
									$type = $this->common->getadmintypelist();
										   foreach ($type->result() as $row)
										   {
										   			$tid = $row->tid;
										    		$type = $row->type_name;
													?>
											<option value="<?=$tid?>" <?php if($optval->type == $tid){ ?> selected="selected" <?php } ?>><?=$type?></option>
												<?php } ?>
                                </select></span>
                            </p>

                            <p class="stdformbutton" style="text-align:right">
                            	<input type="submit" class="btn btn-primary btn-submit" name="mysubmit" value="<?php echo ( sprintf( lang("COMMON::sub_btn")) ); ?>">
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo ( sprintf( lang("COMMON::reset_btn")) ); ?></button>
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