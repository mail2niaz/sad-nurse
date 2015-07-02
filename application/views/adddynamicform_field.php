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
		   $url = $i18n.'intervent/adddynamic_fields/'.$itype_asg_id;
           echo form_open($url,$attributes);
           echo form_hidden('itype_asg_id',$itype_asg_id);
           ?>


                    	<?php
                    	if(isset($view)){ ?>
                    		<table class="table responsive" id="ss1">
                    		<thead>
                        <tr>
                            <th><?php echo ( sprintf( lang("INTERVENT::label")) ); ?></th>
                            <th><?php echo ( sprintf( lang("INTERVENT::type")) ); ?></th>
                            <th><?php echo ( sprintf( lang("INTERVENT::options")) ); ?></th>
                            <th><?php echo ( sprintf( lang("INTERVENT::required")) ); ?></th>
                            <th><?php echo ( sprintf( lang("INTERVENT::sorder")) ); ?></th>
                            <th><?php echo ( sprintf( lang("INTERVENT::visible")) ); ?></th>
                            <th><?php echo ( sprintf( lang("INTERVENT::action")) ); ?></th>
                        </tr>
                    </thead>
                    <tbody>
						<?php $query = $this->db->query("SELECT * FROM `intervention_fields` where int_type_asg_id='$itype_asg_id'");
						if ($query->num_rows() > 0)
						{
						   foreach ($query->result() as $row)
						   {
						   	$fid = $row->fid;
							$itype_asg_id = $row->int_type_asg_id;
						   	?>
					<tr>
						<td><p><?php echo $row->label_name; ?></p></td>
						<td><p><?php echo $row->type; ?> </p></td>
						<td><p><?php echo $row->options; ?></p></td>
						<td><p><?php if($row->required ==0){ echo "No"; }else{ echo "Yes"; }; ?></p></td>
						<td><p><?php echo $row->order; ?></p></td>
						<td><p><?php if($row->visible ==0){ echo "No"; }else{ echo "Yes"; };?></p></td>
						<td>
							<?php if($sedit == "1"){ echo anchor($i18n.'intervent/editdynform_singlefield/'.$fid.'/'.$itype_asg_id,'<i class="icon-edit" title="'.sprintf( lang("COMMON::edit") ).'"></i>&nbsp;&nbsp;'); } ?>
							<?php if($sdelete == "1"){
								$onclick = array('onclick'=>"return confirm('SEI SICURO DI VOLERE CANCELLARE?')");
								 echo anchor($i18n.'intervent/delete_singlefield/'.$fid.'/'.$itype_asg_id,'<i class="icon-remove" title="'.sprintf( lang("COMMON::delete") ).'"></i>',$onclick); } ?></td>
						</tr>
<?php } } ?></tbody>
</table>
<?php if($sadd == "1"){ ?>
<p class="stdformbutton" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'intervent/adddynamicform_field/'.$itype_asg_id,'<i class="icon-link"></i>&nbsp;&nbsp;'.( sprintf( lang("INTERVENT::add_field")) ),$attributes2); ?>
                            </p>
                            <?php } ?>
 <?php }else{ ?>
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
                            <td><p><input type="text" class="span2" name="label_name[]"></p></td>
                            <td><p>
                               <select name="type[]" id="selection2" class="uniformselect span2" style="width:130px">
                                    <option value="">Choose One</option>
                                    <option value="textbox">Text</option>
                                    <option value="textarea">Text Area</option>
                                    <option value="password">Password</option>
                                    <option value="listbox">List</option>
                                    <option value="checkbox">Check Box</option>
                                    <option value="radio">Radio Option</option>
                                </select>
                            </p></td>
                            <td><p><input type="text" class="span2" name="opt_val[]"></p></td>
                            <td class="center">
                            	<p>
                            	<select name="val_req[]" id="selection2" class="uniformselect span2" style="width:100px">
                                   <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            	</p></td>
                            <td><p><input type="text" class="span1" name="sort_val[]"></p></td>
                            <td class="center"><p>
                            	<select name="visible[]" id="selection2" class="uniformselect span2" style="width:100px">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>

                                </select>
                            	</p></td>
                        </tr>
						<?php } ?>
					</tbody>
                </table>
                <?php if(isset($view)){ ?>

				<?php }else{ ?>
					<p class="stdformbutton"><a class="btn btn-primary btn-submit" id="addnew" href="javascript:void(0)"><?php echo ( sprintf( lang("INTERVENT::add_field")) ); ?></a></p>
				<p class="stdformbutton" style="text-align:right"><button class="btn btn-primary btn-submit"><?php echo ( sprintf( lang("INTERVENT::finish")) ); ?></button></p>
			<?php	}
 echo form_close(); ?>
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