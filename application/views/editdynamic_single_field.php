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
               <h1><?php echo ( sprintf( lang("INTERVENT::inter_add_form_field")) ); ?></h1>
               <?php
               $query = $this->db->query("SELECT (SELECT int_type FROM `intervention_types` where int_type_id = IA.int_type_id ) as inttype, (SELECT int_code FROM `intervention_types` where int_type_id = IA.int_type_id ) as intcode, (SELECT type FROM `mt_role` where rid = IA.role ) as introle FROM intervention_types_assign as IA WHERE IA.int_type_asg_id = '$itype_asg_id'");
			   $fet = $query->result();
               ?>
               <p>
             <label style="color:#97400C"><?php echo ( sprintf( lang("INTERVENT::intervent_code")) ); ?><span>&nbsp;: &nbsp;<?php echo $fet[0]->intcode; ?></span></label>
             <label style="color:#97400C"><?php echo ( sprintf( lang("INTERVENT::intervent_type")) ); ?><span>&nbsp;: &nbsp;<?php echo $fet[0]->inttype; ?></span></label>
             <label style="color:#97400C"><?php echo ( sprintf( lang("INTERVENT::frole")) ); ?><span>&nbsp;: &nbsp;<?php echo $fet[0]->introle; ?></span></label>
                            </p>
            </div>
            <div class="pagetitle">

            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">


            <div class="widgetbox box-inverse span9">
                <h4 class="widgettitle"><?php echo ( sprintf( lang("INTERVENT::inter_add_form_field")) ); ?></h4>
                <div class="widgetcontent nopadding">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div>'; <?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
		   $url = $i18n.'intervent/editdynform_singlefield/'.$fid.'/'.$itype_asg_id;
           echo form_open($url,$attributes);
           echo form_hidden('itype_asg_id',$itype_asg_id);
		    echo form_hidden('fid',$fid);
           ?>
                            <table class="table responsive" id="ss">
                    <thead>
                        <tr>
                            <th><?php echo ( sprintf( lang("INTERVENT::label")) ); ?></th>
                            <th><?php echo ( sprintf( lang("INTERVENT::type")) ); ?></th>
                            <th><?php echo ( sprintf( lang("INTERVENT::options")) ); ?></th>
                            <th><?php echo ( sprintf( lang("INTERVENT::required")) ); ?></th>
                            <th><?php echo ( sprintf( lang("INTERVENT::sorder")) ); ?></th>
                            <th><?php echo ( sprintf( lang("INTERVENT::visible")) ); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                            <td><p><input type="text" class="span2" name="label_name" value="<?php echo $optval->label_name; ?>"></p></td>
                            <td><p>
                               <select name="type" id="selection2" class="uniformselect span2" style="width:130px">
                                    <option value="">Choose One</option>
                                    <option value="textbox" <?php if($optval->type == "textbox"){ ?> selected="selected" <?php } ?>>Text</option>
                                    <option value="textarea" <?php if($optval->type == "textarea"){ ?> selected="selected" <?php } ?>>Text Area</option>
                                    <option value="password" <?php if($optval->type == "password"){ ?> selected="selected" <?php } ?>>Password</option>
                                    <option value="listbox" <?php if($optval->type == "listbox"){ ?> selected="selected" <?php } ?>>Listbox</option>
                                    <option value="checkbox" <?php if($optval->type == "checkbox"){ ?> selected="selected" <?php } ?>>Check Box</option>
                                    <option value="radio" <?php if($optval->type == "radio"){ ?> selected="selected" <?php } ?>>Radio Option</option>
                                </select>
                            </p></td>
                            <td><p><input type="text" class="span2" name="opt_val" value="<?php echo $optval->options; ?>"></p></td>
                            <td class="center">
                            	<p>
                            	<select name="val_req" id="selection2" class="uniformselect span2" style="width:100px">
                                   <option value="0" <?php if($optval->required == "0"){ ?> selected="selected" <?php } ?>>No</option>
                                    <option value="1" <?php if($optval->required == "1"){ ?> selected="selected" <?php } ?>>Yes</option>
                                </select>
                            	</p></td>
                            <td><p><input type="text" class="span1" name="sort_val" value="<?php echo $optval->order; ?>"></p></td>
                            <td class="center"><p>
                            	<select name="visible" id="selection2" class="uniformselect span2" style="width:100px">
                                    <option value="0" <?php if($optval->visible == "0"){ ?> selected="selected" <?php } ?>>No</option>
                                    <option value="1" <?php if($optval->visible == "1"){ ?> selected="selected" <?php } ?>>Yes</option>

                                </select>
                            	</p></td>
                        </tr>
					</tbody>
                </table>
					<p class="stdformbutton" style="text-align:right">
                  <input type="submit" class="btn btn-primary btn-submit" name="mysubmit" value="<?php echo ( sprintf( lang("COMMON::sub_btn")) ); ?>">
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
<script type="text/javascript">
jQuery.noConflict();
jQuery(function($){
      $('#addnew').click(function()
            {
$('#ss tr:last').after('<tr><td><p><input type="text" class="span2" name="label_name[]"></p></td><td><p><select name="type[]" id="selection2" class="uniformselect span2" style="width:130px"><option value="">Choose One</option><option value="textbox">Text</option><option value="textarea">Text Area</option><option value="password">Password</option><option value="listbox">Select</option><option value="checkbox">Check Box</option><option value="radio">Radio Option</option></select></p></td><td><p><input type="text" class="span2" name="opt_val[]"></p></td><td class="center"><p><select name="val_req[]" id="selection2" class="uniformselect span2" style="width:100px"><option value="0">No</option><option value="1">Yes</option></select></p></td><td><p><input type="text" class="span1" name="sort_val[]"></p></td><td class="center"><p><select name="visible[]" id="selection2" class="uniformselect span2" style="width:100px"><option value="0">No</option><option value="1">Yes</option></select></p></td></tr>');
});


});

</script>
<?php $this->load->view('common/footer'); ?>