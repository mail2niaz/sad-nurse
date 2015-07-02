<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'intervent','<i class="icon-backward"></i>&nbsp;&nbsp;'.( sprintf( lang("INTERVENT::interlist")) ).'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
            <div class="pagetitle">
               <h1><?php echo ( sprintf( lang("INTERVENT::inter_title")) ); ?></h1>
            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">


            <div class="widgetbox box-inverse span9">
                <h4 class="widgettitle"><?php echo ( sprintf( lang("INTERVENT::inter_title")) ); ?></h4>
                <div class="widgetcontent nopadding">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div>'; <?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
		   $url = $i18n.'intervent/editdynamic_form/'.$optval->int_type_asg_id;
           echo form_open($url,$attributes); ?>
           <?php echo form_hidden('int_type_asg_id',$optval->int_type_asg_id); ?>
                            <p>
                                <label><?php echo ( sprintf( lang("INTERVENT::intervent_type")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><select name="int_type_id" id="int_type_id" class="uniformselect input-xxlarge">
                                    <option value=""><?php echo ( sprintf( lang("COMMON::choose_one")) ); ?></option>
                                    <?php
									$role = $this->common->interventtypelist();
									$role_cnt = $role->num_rows();
										if ($role_cnt > 0)
										{
										   foreach ($role->result() as $row)
										   {
										   			$int_type_id = $row->int_type_id;
										   			$int_code = $row->int_code;
													$int_type = $row->int_type;

													?>
											<option value="<?=$int_type_id?>" <?php if($int_type_id == $optval->int_type_id){ ?> selected="selected" <?php } ?>><?php echo $int_type; ?></option>
												<?php } }  ?>
                                </select></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("INTERVENT::frole")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><select name="role" id="role" class="uniformselect">
                                    <option value=""><?php echo ( sprintf( lang("COMMON::choose_one")) ); ?></option>
                                    <?php
									$role = $this->common->invrolelist();
									$role_cnt = $role->num_rows();
										if ($role_cnt > 0)
										{
										   foreach ($role->result() as $row)
										   {
										   			$rid = $row->rid;
										    		$type = $row->type;
													?>
											<option value="<?=$rid?>" <?php if($rid == $optval->role){ ?> selected="selected" <?php } ?>><?=$type?></option>
												<?php } }  ?>
                                </select></span>
                            </p>


 							<p>
                                <label><?php echo ( sprintf( lang("INTERVENT::fstatus")) ); ?><span class="rstar">*</span></label>
                                <span class="field">
				                    <input type="radio" name="status" value="2" <?php if($optval->status == "2"){ ?> checked="checked" <?php } ?>> <?php echo ( sprintf( lang("INTERVENT::draft")) ); ?> &nbsp;&nbsp;
				                    <input type="radio" name="status" value="1" <?php if($optval->status == "1"){ ?> checked="checked" <?php } ?>> <?php echo ( sprintf( lang("INTERVENT::publish")) ); ?>
				                </span>
                            </p>

                            <p class="stdformbutton" style="text-align:right">
                               <input type="submit" class="btn btn-primary btn-submit" name="mysubmit" value="<?php echo ( sprintf( lang("COMMON::sub_btn")) ); ?>">
                            </p>
<?php echo form_close(); ?>
                </div>
                <!--widgetcontent-->
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