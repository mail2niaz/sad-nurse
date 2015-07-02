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
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'patient','<i class="icon-backward"></i>&nbsp;&nbsp;'.lang("LEFTMENU::add_patient").'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            	<?php  echo anchor($i18n.'patient/import','<i class="icon-backward"></i>&nbsp;&nbsp;'.lang("PATIENT::import").'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
                            <?php } ?>
            <div class="pagetitle">
               <h1><?php echo lang("PATIENT::patient_list"); ?></h1>
            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">
<table id="patientdyntable" class="table table-bordered responsive">
	  <colgroup>
                        <col class="con0" style="align: center; width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                    </colgroup>
	    	<thead>
			<th class="head0"><?php echo lang("COMMON::sno"); ?></th>
			<th class="head1"><?php echo lang("PATIENT::name"); ?></th>
			<th class="head1"><?php echo lang("PATIENT::district"); ?></th>
			<th class="head1"><?php echo lang("PATIENT::phone_no"); ?></th>
			<th class="head1"><?php echo lang("COMMON::action"); ?></th>
		</thead>
		<tfoot>
		<tr>
			<th><?php echo lang("COMMON::sno"); ?></th>
			<th><?php echo lang("PATIENT::name"); ?></th>
			<th><?php echo lang("PATIENT::district"); ?></th>
			<th><?php echo lang("PATIENT::phone_no"); ?></th>
			<th><?php echo lang("COMMON::action"); ?></th>
		</tr>
	</tfoot>
		<tbody>
		<?php
		$i = 1;
if ($result->num_rows() > 0)
{
   foreach ($result->result() as $row)
   {
	$pid = $row->pid;
	$name = $row->pname;
	$surname = $row->surname;
	$name = $surname." ".$name;
?>
			<tr class="gradeX">
		<td><?=$i?></td>
		<td><?=$name?></td>
		<td><?php echo $this->common->getdistname($row->dist_id); ?></td>
		<td align="center"><?php echo $row->contact_no;  ?></td>
		<td>
			<?php echo anchor($i18n.'contract/index/'.$pid,'<i class="icon-list-alt" title="'.lang("PATIENT::contract_list").'"></i>'); ?>&nbsp;&nbsp;
			<?php echo anchor($i18n.'patient/patientinfodetails/'.$pid,'<i class="icon-user" title="'.lang("PATIENT::pat_info_list").'"></i>'); ?>&nbsp;&nbsp;
		 	<?php if($sview == "1"){ echo anchor($i18n.'patient/patientdetails/'.$pid,'<i class="icon-zoom-in" title="'.lang("COMMON::view").'"></i>&nbsp;&nbsp;'); } ?>
		 	<?php if($sedit == '1'){ echo anchor($i18n.'patient/editpatient/'.$pid,'<i class="icon-edit" title="'.lang("COMMON::edit").'"></i>&nbsp;&nbsp;'); } ?>
		 	<?php if($sdelete == 1){
		 			$onclick = array('onclick'=>"return confirm('SEI SICURO DI VOLERE CANCELLARE?')");
		 		 echo anchor($i18n.'patient/delete/'.$pid,'<i class="icon-trash" title="'.lang("COMMON::delete").'"></i>',$onclick); } ?>
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
