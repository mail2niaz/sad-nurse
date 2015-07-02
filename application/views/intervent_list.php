<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">
        <?php $this->load->view('breadcrumb'); ?>
        <div class="pageheader">
        	<?php if($sadd == 1){ ?>
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'intervent/adddynamicform','<i class="icon-backward"></i>&nbsp;&nbsp;'.( sprintf( lang("INTERVENT::addinter")) ).'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
                            <?php } ?>
            <div class="pagetitle">
               <h1><?php echo ( sprintf( lang("INTERVENT::inter_list")) ); ?></h1>
            </div>

        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#dyntable').dataTable({
            "sPaginationType": "full_numbers",
            aoColumnDefs: [
				  {
				     bSortable: false,
				     aTargets: [ -1 ]
				  }
				]
        }).columnFilter({
			aoColumns: [ null,
				     { type: "text" },
				     { type: "text" },
				     null,
				     null
				]
				});

    });
</script>
<table id="dyntable" class="table table-bordered responsive">
	  <colgroup>
                        <col class="con0" style="align: center; width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
	    <thead>
		  <th class="head0"><?php echo ( sprintf( lang("COMMON::sno")) ); ?></th>
		  <th class="head1"><?php echo ( sprintf( lang("INTERVENT::intervent_code")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("INTERVENT::intervent_type")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("OPERATOR::role")) ); ?></th>
		 <th class="head1"><?php echo ( sprintf( lang("COMMON::action")) ); ?></th>
		</thead>
		<tfoot>
		  <th><?php echo ( sprintf( lang("COMMON::sno")) ); ?></th>
		  <th><?php echo ( sprintf( lang("INTERVENT::intervent_code")) ); ?></th>
		  <th><?php echo ( sprintf( lang("INTERVENT::intervent_type")) ); ?></th>
		  <th><?php echo ( sprintf( lang("OPERATOR::role")) ); ?></th>
		  <th><?php echo ( sprintf( lang("COMMON::action")) ); ?></th>
		</tfoot>
		<tbody>
		<?php $i = 1;
		$query = $this->db->query("SELECT IA.int_type_asg_id, (SELECT int_type FROM `intervention_types` where int_type_id = IA.int_type_id ) as inttype, (SELECT int_code FROM `intervention_types` where int_type_id = IA.int_type_id ) as intcode, (SELECT type FROM `mt_role` where rid = IA.role ) as introle FROM intervention_types_assign as IA WHERE IA.status != '0'");

if ($query->num_rows() > 0)
{
   foreach ($query->result() as $row)
   {
   			$itype_asg_id = $row->int_type_asg_id;
    		$inttype = $row->inttype;
			$intcode = $row->intcode;
			$introle = $row->introle;
			$view = "view";
			?>
			<tr class="gradeX">
		<td><?=$i?></td>
		<td><?=$intcode?></td>
		<td><?php echo $inttype;?></td>
		<td><?php echo $introle;?></td>
		<td>
		 	<?php if($sview == "1"){ echo anchor($i18n.'intervent/adddynamicform/'.$itype_asg_id,'<i class="icon-zoom-in" title="'.sprintf( lang("INTERVENT::inter_form_view") ).'"></i>&nbsp;&nbsp;'); } ?>
		 	<?php if($sview == "1"){ echo anchor($i18n.'intervent/adddynamicform_field/'.$itype_asg_id.'/'.$view,'<i class="icon-zoom-in" title="'.sprintf( lang("INTERVENT::inter_form_field_view") ).'"></i>&nbsp;&nbsp;'); } ?>
		 	<?php if($sedit == '1'){ echo anchor($i18n.'intervent/editdynamic_form/'.$itype_asg_id,'<i class="icon-edit" title="'.sprintf( lang("INTERVENT::inter_form_edit") ).'"></i>&nbsp;&nbsp;'); } ?>
		 	<?php if($sdelete == '1'){
		 		$onclick = array('onclick'=>"return confirm('SEI SICURO DI VOLERE CANCELLARE?')");
				 echo anchor($i18n.'intervent/delete/'.$itype_asg_id,'<i class="icon-trash" title="'.sprintf( lang("INTERVENT::inter_form_delete") ).'"></i>',$onclick); } ?>
		</td>
		</tr>
		<?php  $i++;  }
}  ?>
</tbody>
		</table>
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