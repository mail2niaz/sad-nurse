<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">

            <div class="pagetitle">
               <h1><?php echo ( sprintf( lang("add_operator")) ); ?></h1>
            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">


            <div class="widgetbox box-inverse span9">
                <h4 class="widgettitle"><?php echo ( sprintf( lang("add_operator")) ); ?></h4>
                <div class="widgetcontent nopadding">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div>'; <?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('assignoperatorpatient/passigno',$attributes); ?>
                            <p>
                            <label><?php echo ( sprintf( lang("patient_list")) ); ?></label>
                            <span class="field">
                            <select name="patient" class="span4" size="5">
                            	<option value="" selected="selected">--Select--</option>
                                <?php $pat = $this->common->getpatientlist();
								if(count($pat) > 0){
                                 foreach($pat as $pats){
                                	$pid = $pats->pid;
									$pname = $pats->pname;?>
									<option value="<?=$pid?>"><?=$pname?></option>
                              	<?php } }else{ ?>
									<option value="">Patients Not Available</option>
                            	<?php } ?>
                            </select>
                            </span>
                        </p>

                        <p>
                            <label><?php echo ( sprintf( lang("doctor")) ); ?></label>
                            <span class="field">
                            <select name="operator[]" class="span4" size="5">
                            	<option value="" selected="selected">--Select--</option>
                                <?php $doct = $this->common->getdoctorlist();
									if(count($doct) > 0){
                                foreach($doct as $docts){
                                	$oid = $docts->oid;
									$fname = $docts->firstname;
									$lname = $docts->lastname;
									$name = $fname." ".$lname; ?>
									<option value="<?=$oid?>"><?=$name?></option>
                              <?php } }else{ ?>
									<option value="">Doctors Not Available</option>
                              <?php } ?>
                            </select>
                            </span>
                        </p>

                        <p>
                            <label><?php echo ( sprintf( lang("nurse")) ); ?></label>
                            <span class="field">
                            <select name="operator[]" class="span4" size="5">
                            	<option value="" selected="selected">--Select--</option>
                                <?php $nur = $this->common->getnurselist();
								if(count($nur) > 0){
                                foreach($nur as $nurs){
                                	$oid = $nurs->oid;
									$fname = $nurs->firstname;
									$lname = $nurs->lastname;
									$name = $fname." ".$lname; ?>
									<option value="<?=$oid?>"><?=$name?></option>
                              <?php } }else{ ?>
									<option value="">Nurse Not Available</option>
                              <?php } ?>
                            </select>
                            </span>
                        </p>

						<p>
                            <label><?php echo ( sprintf( lang("support")) ); ?></label>
                            <span class="field">
                            <select name="operator[]" class="span4" size="5">
                            	<option value="" selected="selected">--Select--</option>
                                <?php $sup = $this->common->getsupportlist();
								if(count($sup) > 0){
                                foreach($sup as $sups){
                                	$oid = $sups->oid;
									$fname = $sups->firstname;
									$lname = $sups->lastname;
									$name = $fname." ".$lname; ?>
									<option value="<?=$oid?>"><?=$name?></option>
                              <?php } }else{ ?>
                              	<option value="">Supports Not Available</option>
                              <?php } ?>
                            </select>
                            </span>
                        </p>

                            <p class="stdformbutton" style="text-align:right">
                                <button class="btn btn-primary btn-submit"><?php echo ( sprintf( lang("sub_btn")) ); ?></button>
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo ( sprintf( lang("reset_btn")) ); ?></button>
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