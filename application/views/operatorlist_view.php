<?php $this->load->view('common/head'); ?>
<body>
<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

        <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
        	<?php $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  ?>
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<?php   if($sadd == 1){  echo anchor($i18n.'operator','<i class="icon-backward"></i>&nbsp;&nbsp;'.( sprintf( lang("LEFTMENU::add_operator")) ).'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); } ?>
                            	<?php  echo anchor($i18n.'operator/import','<i class="icon-backward"></i>&nbsp;&nbsp;'.( sprintf( lang("OPERATOR::import")) ).'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
            <div class="pagetitle">
               <h1><?php echo ( sprintf( lang("LEFTMENU::operator-list")) ); ?></h1>

            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">
<table id="operatordyntable" class="table table-bordered responsive">
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
		  <th class="head1"><?php echo ( sprintf( lang("OPERATOR::name")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("OPERATOR::role")) ); ?></th>
		  <th class="head1"><?php echo ( sprintf( lang("OPERATOR::email")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("OPERATOR::con_no")) ); ?></th>
		 <th class="head1"><?php echo ( sprintf( lang("COMMON::action")) ); ?></th>
		</thead>
		<tfoot>
		  <th><?php echo ( sprintf( lang("COMMON::sno")) ); ?></th>
		  <th><?php echo ( sprintf( lang("OPERATOR::name")) ); ?></th>
		  <th><?php echo ( sprintf( lang("OPERATOR::role")) ); ?></th>
		  <th><?php echo ( sprintf( lang("OPERATOR::email")) ); ?></th>
		  <th><?php echo ( sprintf( lang("OPERATOR::con_no")) ); ?></th>
		  <th><?php echo ( sprintf( lang("COMMON::action")) ); ?></th>
		</tfoot>
		<tbody>
		<?php $i = 1;
if ($result->num_rows() > 0)
{
   foreach ($result->result() as $row)
   {
   			$oid = $row->oid;
    			$fname = $row->firstname;
			$lname = $row->lastname;
			$name = $lname." ".$fname;
			?>
			<tr class="gradeX" <?php  if($row->suspended == 'on') { echo "style='background-color: #ccc;'"; }  ?>>
		<td><?=$i?></td>
		<td><?=$name?></td>
		<td><?php echo $role = $this->common->getrolename($row->role);?></td>
		<td align="center"><?php echo $row->email;  ?></td>
		<td align="center"><?php echo $row->contact_no; ?></td>
		<td>
			<?php echo anchor($i18n.'operator/operatorcalendar/'.$oid,'<i class="icon-calendar" title="'.sprintf( lang("COMMON::calendar") ).'"></i>&nbsp;&nbsp;');  ?>
		 	<?php if($sview == "1"){  echo anchor($i18n.'operator/operatordetails/'.$oid,'<i class="icon-zoom-in" title="'.sprintf( lang("COMMON::view") ).'"></i>&nbsp;&nbsp;'); } ?>
		 	<?php if($sedit == '1'){ echo anchor($i18n.'operator/editoperator/'.$oid,'<i class="icon-edit" title="'.sprintf( lang("COMMON::edit") ).'"></i>&nbsp;&nbsp;'); } ?>
		 	<?php if($sdelete == 1){
		 			   $onclick = array('onclick'=>"return confirm('SEI SICURO DI VOLERE CANCELLARE?')");
		 		 echo anchor($i18n.'operator/delete/'.$oid,'<i class="icon-trash" title="'.sprintf( lang("COMMON::delete") ).'"></i>',$onclick); } ?>
		</td>
		</tr>
  <?php $i++; }
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
