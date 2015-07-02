<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<?php $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');
echo anchor($i18n.'setting/default_starting_point_address/view/'.$optval->id,'<i class="icon-backward"></i>&nbsp;&nbsp;'.( sprintf( lang("view_default_starting_point")) ).'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2);
                            	?>
                            </p>
            <div class="pagetitle">
               <h1><?php echo ( sprintf( lang("default_starting_point")) ); ?></h1>
            </div>
        </div><!--pageheader-->
<script type="text/javascript">
        jQuery(function() {
            jQuery('#mysubmit').click(function(e) {
            	var siteurl = "<?php echo site_url($i18n.'setting/submit') ?>";
            	var redirect = "<?php echo site_url($i18n.'setting/default_starting_point_address/view/'.$optval->id) ?>";
	        	var starting_point_address = jQuery('#starting_point_address').val();
	        	var sid = '<?=$optval->id?>';
	        	var message = "<?php echo ( sprintf( lang('msg_starting_point')) ); ?>";
                e.preventDefault();
                var dialog = jQuery('<p>'+message+'</p>').dialog({
                    buttons: {
                        "Yes": function() {
                        	//alert('you chose yes');
								jQuery.post(siteurl, {starting_point_address: ""+starting_point_address+"", sid: ""+sid+"", update: ""+1+"" },
					               function(data){
					               	 dialog.dialog('close');
					               	 window.location.assign(redirect);
								});
                        	},
                        "No":  function() { //alert('you chose no');
                        		jQuery.post(siteurl, {starting_point_address: ""+starting_point_address+"", sid: ""+sid+"", update: ""+2+"" },
					               function(data){
					               	 dialog.dialog('close');
					               	 window.location.assign(redirect);
								});
                        },
                        "Cancel":  function() {
                            //alert('you chose cancel');
                            dialog.dialog('close');
                        }
                    }
                });
            });
        });

    </script>
        <div class="maincontent">
            <div class="maincontentinner">
            	<div class="widgetbox box-inverse span9">
				<?php if($action == "edit"){ ?>
				<h4 class="widgettitle"><?php echo ( sprintf( lang("edit_default_starting_point")) ); ?></h4>
                <div class="widgetcontent nopadding">
          	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

          <?php $attributes = array('class' => 'stdform stdform2');
		   //$url = $i18n.'setting/default_starting_point_address/view/'.$optval->id;
		   $url = '';
           echo form_open($url,$attributes); echo form_hidden('id',$optval->id);
           ?>
			<p>
                <label><?php echo ( sprintf( lang("OPERATOR::starting_point_address")) ); ?><span class="rstar">*</span></label>
                <span class="field"><textarea name="starting_point_address" id="starting_point_address" class="input-xxlarge" ><?php echo set_value('starting_point_address',$optval->starting_point_address); ?></textarea></span>
            </p>
            <p class="stdformbutton" style="text-align:right">
            	<button class="btn btn-primary btn-submit" name="mysubmit" id="mysubmit"><?php echo ( sprintf( lang("COMMON::sub_btn")) ); ?></button>
                <button type="reset" class="btn" style="margin-right:75px"><?php echo ( sprintf( lang("COMMON::reset_btn")) ); ?></button>
            </p>
<?php echo form_close(); ?>
</div>
				<?php }elseif($action == "view"){ ?>
				<h4 class="widgettitle"><?php echo ( sprintf( lang("view_default_starting_point")) ); ?></h4>
                <div class="widgetcontent nopadding stdform stdform2">
			<p>
                <label><?php echo ( sprintf( lang("OPERATOR::starting_point_address")) ); ?><span class="rstar">*</span></label>
                <span class="field"><?php echo $optval->starting_point_address; ?></textarea></span>
            </p>
            <?php if($sedit == '1'){ ?>
            <p class="stdformbutton" style="text-align:right">
            	<?php $attributes2 = array('class' => 'btn btn-primary btn-submit');
            	echo anchor($i18n.'setting/default_starting_point_address/edit/'.$optval->id,'<i class="icon-link"></i>&nbsp;&nbsp;'.( sprintf( lang("edit_default_starting_point")) ),$attributes2); ?> </a>
            </p>
                            <?php } ?>
</div>
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