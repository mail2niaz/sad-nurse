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
               <h1><?php echo ( sprintf( lang("addadmin_user")) ); ?></h1>
            </div>
        </div><!--pageheader-->
        <div class="maincontent">
            <div class="maincontentinner">

            <div class="widgetbox box-inverse span10" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo ( sprintf( lang("addadmin_user")) ); ?></h4>
                <div class="widgetcontent nopadding">
                	<?php if(isset($view)){ ?>
                		<div class="stdform stdform2">
                		<p>
                                <label><?php echo ( sprintf( lang("admin_name")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->name; ?></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("admin_email")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->email; ?></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("admin_uname")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->username; ?></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("SETTING::type")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $this->common->getusertypename($optval->type); ?></span>
                            </p>

                            <p class="stdformbutton" style="text-align:right">
                            	<?php $attributes2 = array('class' => 'btn btn-primary btn-submit');
                            	echo anchor($i18n.'setting/edituserdata/'.$optval->aid,'<i class="icon-link"></i>&nbsp;&nbsp;'.( sprintf( lang("editadmin_user")) ),$attributes2); ?> </a>
                            </p>
                            </div>
                		<?php }else{ ?>
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('setting/addadminuserdata',$attributes); ?>
           					<p>
                                <label><?php echo ( sprintf( lang("admin_name")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="name" id="name" class="input-xxlarge" /></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("admin_email")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="email" name="email" id="email" class="input-xxlarge" /></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("admin_uname")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="username" id="username" class="input-xxlarge" /></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("SETTING::password")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="password" name="pass" id="pass" class="input-xxlarge" /></span>
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
											<option value="<?=$tid?>"><?=$type?></option>
												<?php } ?>
                                </select></span>
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