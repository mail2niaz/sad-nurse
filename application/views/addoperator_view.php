<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'operator/operatorlist','<i class="icon-backward"></i>&nbsp;&nbsp;'.( sprintf( lang("LEFTMENU::operator-list")) ).'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
            <div class="pagetitle">
               <h1><?php echo ( sprintf( lang("LEFTMENU::add_operator")) ); ?></h1>
            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">


            <div class="widgetbox box-inverse span10">
                <h4 class="widgettitle"><?php echo ( sprintf( lang("LEFTMENU::add_operator")) ); ?></h4>
                <div class="widgetcontent nopadding">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div>'; <?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2', 'id' => 'forms');
		   $url = $i18n.'operator/addoperator';
           echo form_open($url,$attributes); ?>
                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::fname")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="firstname" id="firstname" class="input-xlarge" value="<?php echo set_value('firstname'); ?>" /></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::lname")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="lastname" id="lastname" class="input-xlarge" value="<?php echo set_value('lastname'); ?>" /></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::email")) ); ?></label>
                                <span class="field"><input type="email" name="email" id="email" class="input-xlarge" value="<?php echo set_value('email'); ?>"/></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::uname")) ); ?></label>
                                <span class="field"><input type="text" name="username" autocomplete="off" id="username" class="input-xlarge" value="<?php echo set_value('username'); ?>" /></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::password")) ); ?></label>
                                <span class="field"><input type="password" name="password" autocomplete="off" id="password" class="input-xlarge" value="<?php echo set_value('password'); ?>"/></span>
                            </p>
							<p>
                                <label><?php echo ( sprintf( lang("COMMON::birthday")) ); ?></label>
                                <span class="field"><input id="datepicker" class="input-large" type="text" name="dob" readonly="readonly" value="<?php echo set_value('dob'); ?>"></span>
                            </p>
                             <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::role")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><select name="role" id="role" class="uniformselect" value="<?php echo set_value('role'); ?>">
                                    <option value=""><?php echo ( sprintf( lang("COMMON::choose_one")) ); ?></option>
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
											<option value="<?=$rid?>" <?php if(set_value('role') == $rid){ ?> selected="selected" <?php } ?>><?=$type?></option>
												<?php } }  ?>
                                </select></span>
                            </p>

							<p>
                                <label><?php echo ( sprintf( lang("OPERATOR::district_opt")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><select name="dist_id[]" id="dist_id" class="uniformselect" multiple="multiple" size="10" style="width: auto;">
                                    <option value=""><?php echo ( sprintf( lang("COMMON::choose_one")) ); ?></option>
                                    <?php
									$district = $this->common->districtlist();
									$district_cnt = $district->num_rows();
										if ($district_cnt > 0)
										{
										   foreach ($district->result() as $row_dist)
										   {
										   			$did = $row_dist->did;
										    		$dist_name = $row_dist->dist_name;
													?>
											<option value="<?=$did?>" <?php if(in_array($did, set_value('dist_id'))){ ?> selected="selected" <?php } ?>><?=$dist_name?></option>
												<?php } }  ?>
                                </select></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::starting_point_address")) ); ?></label>
                                <span class="field"><textarea name="starting_point_address" id="starting_point_address" class="input-xlarge" ><?php echo set_value('starting_point_address','Via A. Gramsci 54 / s 42124 Reggio Emilia'); ?></textarea></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::tag")) ); ?></label>
                                <span class="field">
                                <select name="tags[]" data-placeholder="<?php echo ( sprintf( lang("OPERATOR::choose_tag")) ); ?>" class="chzn-select" multiple="multiple" style="width:350px;" tabindex="4">
                                  <option value=""></option>
                                  <?php
                                  $tags = $this->common->get_tags_list();
								  foreach($tags as $fet){
								  	$tid = $fet->tid;
									 $tag_desc = $fet->tag_description; ?>
									 <option value="<?=$tid?>" <?php if(in_array($tid, set_value('tags'))){ ?> selected="selected" <?php } ?>><?=$tag_desc?></option>
								  <?php } ?>
                                </select>
                                </span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::qualification")) ); ?></label>
                                <span class="field"><input type="text" name="qualification" id="qualification" class="input-xlarge" value="<?php echo set_value('qualification'); ?>"/></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::hours_contract")) ); ?></label>
                                <span class="field"><input type="text" name="hours_contract" id="hours_contract" class="input-xlarge" value="<?php echo set_value('hours_contract'); ?>"/></span>
                            </p>
 							<p>
                                <label><?php echo ( sprintf( lang("OPERATOR::con_no")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="contact_no" id="contact_no" class="input-xlarge" value="<?php echo set_value('contact_no'); ?>"/></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::ssn")) ); ?><span class="rstar"></span></label>
                                <span class="field"><input type="text" name="ssn" id="ssn" class="input-xlarge" value="<?php echo set_value('ssn'); ?>"/></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::land_no")) ); ?></label>
                                <span class="field"><input type="text" name="landline_no" id="landline_no" class="input-xlarge" value="<?php echo set_value('landline_no'); ?>"/></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::street")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="street" id="street" class="input-xlarge" value="<?php echo set_value('street'); ?>"/></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::hb_no")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="hb_no" id="hb_no" class="input-xlarge" value="<?php echo set_value('hb_no'); ?>"/></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::city")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="city" id="city" class="input-xlarge" value="<?php echo set_value('city'); ?>"/></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::postal_code")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="postalcode" id="postalcode" class="input-xlarge" value="<?php echo set_value('postalcode'); ?>"/></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::pro_code")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="provincecode" id="provincecode" class="input-xlarge" value="<?php echo set_value('provincecode'); ?>"/></span>
                            </p>

                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::mob_udid")) ); ?></label>
                                <span class="field"><input type="text" name="mobile_udid" id="mobile_udid" class="input-xlarge" value="<?php echo set_value('mobile_udid'); ?>"/></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("OPERATOR::note")) ); ?></label>
                                <span class="field"><textarea name="note" id="note" class="input-xlarge" ><?php echo set_value('note'); ?></textarea></span>
                            </p>

                            <p class="stdformbutton" style="text-align:right">
                                <button class="btn btn-primary btn-submit"><?php echo ( sprintf( lang("COMMON::sub_btn")) ); ?></button>
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
