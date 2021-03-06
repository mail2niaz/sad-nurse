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
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'intervent/add_interventtype','<i class="icon-backward"></i>&nbsp;&nbsp;'.lang("INTERVENT::add_intervent_type").'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
                            <?php } ?>
            <div class="pagetitle">
               <h1><?php echo lang("INTERVENT::intervent_type"); ?></h1>
            </div>

        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">
<table id="interventtypelistdyntable" class="table table-bordered responsive">
	  <colgroup>
                        <col class="con0" style="align: center; width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
	    <thead>
		  <th class="head0"><?php echo lang("COMMON::sno"); ?></th>
		  <th class="head1"><?php echo lang("INTERVENT::intervent_code"); ?></th>
		  <th class="head0"><?php echo lang("INTERVENT::intervent_type"); ?></th>
		 <th class="head1"><?php echo lang("COMMON::action"); ?></th>
		</thead>
		<tfoot>
		  <th><?php echo lang("COMMON::sno"); ?></th>
		  <th><?php echo lang("INTERVENT::intervent_code"); ?></th>
		  <th><?php echo lang("INTERVENT::intervent_type"); ?></th>
		  <th><?php echo lang("COMMON::action"); ?></th>
		</tfoot>
		<tbody>
		<?php $i = 1;
$query = $this->intervent_model->InterventionTypes();
if ($query->num_rows() > 0)
{
   foreach ($query->result() as $row)
   {
   			$int_type_id = $row->int_type_id;
    		$int_code = $row->int_code;
			$int_type = $row->int_type;
			$view = "view";
			?>
		<tr class="gradeX">
		<td><?=$i?></td>
		<td><?=$int_code?></td>
		<td><?php echo $int_type;?></td>
		<td>
		 	<?php if($sview == "1"){ echo anchor($i18n.'intervent/add_interventtype/'.$view.'/'.$int_type_id,'<i class="icon-zoom-in" title="'.lang("COMMON::view").'"></i>&nbsp;&nbsp;'); } ?>
		 	<?php if($sedit == '1'){ echo anchor($i18n.'intervent/edit_interventtype/'.$int_type_id,'<i class="icon-edit" title="'.lang("COMMON::edit").'"></i>&nbsp;&nbsp;'); } ?>
		 	<?php if($sdelete == '1'){
				$onclick = array('onclick'=>"return confirm('SEI SICURO DI VOLERE CANCELLARE?')");
		 		 echo anchor($i18n.'intervent/deleteinterventtype/'.$int_type_id,'<i class="icon-trash" title="'.lang("COMMON::delete").'"></i>',$onclick); } ?>
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