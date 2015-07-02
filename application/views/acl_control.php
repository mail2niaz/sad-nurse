<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
            <div class="pagetitle">
               <h1><?php echo lang("acl"); ?></h1>
            </div>
        </div><!--pageheader-->
        <div class="maincontent">
            <div class="maincontentinner">
       <script type="text/javascript">
jQuery(document).ready(function(){

    jQuery('a.update_link').click(function()
    {
            var tid = jQuery(this).attr('data_link');

            var add = jQuery('#add'+tid+':checked').val();
            var edit = jQuery('#edit'+tid+':checked').val();
            var view = jQuery('#view'+tid+':checked').val();
            var del = jQuery('#delete'+tid+':checked').val();
			var senddata = "add="+add+"&edit="+edit+"&view="+view+"&delete="+del;
            jQuery.ajax(
            {
                   type: "POST",
                   url: "<?php echo site_url($i18n.'setting/get_acl') ?>/"+tid,
                   cache: false,
                   data: senddata,
                   success: function(data)
                   {
                   	jQuery('.cinfo').append('<div class="alert alert-info"><?php echo lang("detail_upd_msg"); ?></div>');
                   		}
             });
    });

        jQuery('a.update_module_link').click(function()
    {
            var mtid = jQuery(this).attr('data_link_module');
            var operator = jQuery('#operator'+mtid+':checked').val();
            var patient = jQuery('#patient'+mtid+':checked').val();
            var job = jQuery('#job'+mtid+':checked').val();
            var cms = jQuery('#cms'+mtid+':checked').val();
            var intervent = jQuery('#intervent'+mtid+':checked').val();
            var report = jQuery('#report'+mtid+':checked').val();
            var contract = jQuery('#contract'+mtid+':checked').val();

			var msenddata = "operator="+operator+"&patient="+patient+"&job="+job+"&cms="+cms+"&intervent="+intervent+"&report="+report+"&contract="+contract;

            jQuery.ajax(
            {
                   type: "POST",
                   url: "<?php echo site_url($i18n.'setting/get_module_acl') ?>/"+mtid,
                   cache: false,
                   data: msenddata,
                   success: function(data)
                   {
                   	jQuery('.minfo').append('<div class="alert alert-info"><?php echo lang("detail_upd_msg"); ?></div>');
                   		}
             });
    });
});
 </script>
            <div class="widgetbox box-inverse span10" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo lang("acl"); ?></h4>
                <div class="widgetcontent nopadding">
                	<div class="cinfo"></div>
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('setting/get_module_acl',$attributes); ?>
                            <table class="table table-bordered responsive">
                    <thead>
                        <tr>
                            <th><?php echo lang("SETTING::type"); ?></th>
                            <th><?php echo lang("COMMON::add"); ?></th>
                            <th><?php echo lang("COMMON::edit"); ?></th>
                            <th><?php echo lang("COMMON::view"); ?></th>
                            <th><?php echo lang("COMMON::delete"); ?></th>
                            <th><?php echo lang("COMMON::action"); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php $i = 1;
		$query = $this->db->query("SELECT * from admin_types where tid != '1' ORDER BY tid ASC");

if ($query->num_rows() > 0)
{
   foreach ($query->result() as $row)
   {
   			$tid = $row->tid;
    		$type_name = $row->type_name;
			$add = $row->add;
			$edit = $row->edit;
			$view = $row->view;
			$delete = $row->delete;
			$tstatus = $row->tstatus;
			?>
			<tr>
			<td><?=$type_name?></td>
			<td><input type="checkbox" name="add<?=$tid?>" id="add<?=$tid?>" value="1" <?php if($add == 1) { ?> checked="checked" <?php } ?> /></td>
			<td><input type="checkbox" name="edit<?=$tid?>" id="edit<?=$tid?>" value="1" <?php if($edit == 1) { ?> checked="checked" <?php } ?> /></td>
			<td><input type="checkbox" name="view<?=$tid?>" id="view<?=$tid?>" value="1" <?php if($view == 1) { ?> checked="checked" <?php } ?> /></td>
			<td><input type="checkbox" name="delete<?=$tid?>" id="delete<?=$tid?>" value="1" <?php if($delete == 1) { ?> checked="checked" <?php } ?> /></td>
			<td><a class='update_link' href='javascript:void(0)' data_link='<?php echo $tid; ?>'><?php echo lang("save"); ?></a></td>
			</tr>
<?php $i++; }  }?>

                    </tbody>
                </table>

<?php echo form_close(); ?>
                </div><!--widgetcontent-->
            </div><!--widget-->

<?php /* Module Control */ ?>
            <div class="widgetbox box-inverse span10" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo lang("module_cont"); ?></h4>
                <div class="widgetcontent nopadding">
                		<div class="minfo"></div>
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('setting/get_acl',$attributes); ?>
                            <table class="table table-bordered responsive">
                    <thead>
                        <tr>
                            <th><?php echo lang("COMMON::type"); ?></th>
                            <th><?php echo lang("moperator"); ?></th>
                            <th><?php echo lang("mpatient"); ?></th>
                            <th><?php echo lang("mjob"); ?></th>
                            <th><?php echo lang("cms"); ?></th>
                            <th><?php echo lang("mintervent"); ?></th>
                            <th><?php echo lang("mreport"); ?></th>
                            <th><?php echo lang("CONTRACT::contract"); ?></th>
                            <th><?php echo lang("COMMON::action"); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php $i = 1;
		$query = $this->db->query("SELECT * from admin_types where tid != '1' ORDER BY tid ASC");

if ($query->num_rows() > 0)
{
   foreach ($query->result() as $row)
   {
   			$tid = $row->tid;
    		$type_name = $row->type_name;
			$operator = $row->operator;
			$patient = $row->patient;
			$job = $row->job;
			$cms = $row->cms;
			$intervent = $row->intervent;
			$report = $row->report;
			$contract = $row->contract;
			?>
			<tr>
			<td><?=$type_name?></td>
			<td><input type="checkbox" name="operator<?=$tid?>" id="operator<?=$tid?>" value="1" <?php if($operator == 1) { ?> checked="checked" <?php } ?> /></td>
			<td><input type="checkbox" name="patient<?=$tid?>" id="patient<?=$tid?>" value="1" <?php if($patient == 1) { ?> checked="checked" <?php } ?> /></td>
			<td><input type="checkbox" name="job<?=$tid?>" id="job<?=$tid?>" value="1" <?php if($job == 1) { ?> checked="checked" <?php } ?> /></td>
			<td><input type="checkbox" name="cms<?=$tid?>" id="cms<?=$tid?>" value="1" <?php if($cms == 1) { ?> checked="checked" <?php } ?> /></td>
			<td><input type="checkbox" name="intervent<?=$tid?>" id="intervent<?=$tid?>" value="1" <?php if($intervent == 1) { ?> checked="checked" <?php } ?> /></td>
			<td><input type="checkbox" name="report<?=$tid?>" id="report<?=$tid?>" value="1" <?php if($report == 1) { ?> checked="checked" <?php } ?> /></td>
			<td><input type="checkbox" name="contract<?=$tid?>" id="contract<?=$tid?>" value="1" <?php if($contract == 1) { ?> checked="checked" <?php } ?> /></td>
			<td><a class='update_module_link' href='javascript:void(0)' data_link_module='<?php echo $tid; ?>'><?php echo lang("save"); ?></a></td>
			</tr>
<?php $i++; }  }?>

                    </tbody>
                </table>

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