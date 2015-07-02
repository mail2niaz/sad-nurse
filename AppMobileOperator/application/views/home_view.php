<?php $this->load->view('common/head'); ?>
<body>
<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <div class="rightpanel">
       <?php //$this->load->view('breadcrumb'); ?>

        <div class="pageheader">
            <div class="pagetitle">
            	<h1><?php echo lang("SEARCH::head"); ?></h1>
            </div>
        </div><!--pageheader-->
        <div class="maincontent">
            <div class="maincontentinner">

            <div class="widgetbox box-inverse span12">
            <h4 class="widgettitle"><?php echo lang("SEARCH::head"); ?></h4>
                <div class="widgetcontent nopadding">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('home/plan_search',$attributes); ?>
           					<p>
                                <label><?php echo ( sprintf( lang("SEARCH::date")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><input id="datepicker" class="input-xxlarge" type="text" name="sdate" ></span>
                            </p>
                            <p>
                                <label><?php echo ( sprintf( lang("SEARCH::operator")) ); ?><span class="rstar">*</span></label>
                                <span class="field">
                                	<select name="operator" class="input-xxlarge">
										<option value="">--Select Operator--</option>
										<?php
										$operator = $this->common->getoperatorlist_new();
										foreach($operator as $opt){
											$oid = $opt->oid;
											$firstname = $opt->firstname;
											$lastname = $opt->lastname; ?>
											<option value="<?=$oid?>"><?php echo $lastname." ".$firstname; ?></option>
										<?php } ?>
                                	</select>
                                </span>
                            </p>


<p class="stdformbutton finalsubmit" style="text-align:center;">
	<button style="width: 98%;" class="btn btn-conform"><?php echo ( sprintf( lang("COMMON::sub_btn")) ); ?></button>
	<button style="width: 98%;" type="reset" class="btn btn-back" style="margin-right:75px"><?php echo ( sprintf( lang("COMMON::reset_btn")) ); ?></button>
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
