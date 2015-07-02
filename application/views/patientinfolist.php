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
               <a href="<?php echo site_url($i18n.'patient/addpatientinfo/'.$pid) ?>" class="btn btn-rounded btn-submit btn-primary">
            	<i class="icon-link"></i>&nbsp;<?php echo lang("PATIENT::add_pat_info"); ?></a>
            	</p>
            	<?php } ?>
            <div class="pagetitle">
               <h1><?php echo lang("PATIENT::pat_info_list"); ?></h1>

            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">
<table id="patientinfodyntable" class="table table-bordered responsive">
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
		  <th class="head1"><?php echo lang("PATIENT::role"); ?></th>
		  <th class="head1"><?php echo lang("PATIENT::info"); ?></th>
		  <th class="head1"><?php echo lang("PATIENT::pat_info_status"); ?></th>
		 <th class="head1"><?php echo lang("COMMON::action"); ?></th>
		</thead>
		<tbody>
		<?php $i = 1;
if ($result->num_rows() > 0)
{
   foreach ($result->result() as $row)
   {
   			$piid = $row->piid;
   			$pid = $row->pid;
    			$role = explode(",", $row->rid);
			$info = $row->info;
			$role_id = array();
			foreach ($role as $row_role)
			   {
					$role_id[] = $this->common->getrolename($row_role);
			   }
			$role_name = implode(", ", $role_id);
			$view = "view";
			$status = $row->status;
			?>
			<tr class="gradeX">
		<td><?=$i?></td>
		<td><?php echo $role_name; ?></td>
		<td><?=$info?></td>
		<td style="text-align: center;"><?php if($status == '1'){ ?>
			<i class="icon-ok" title="<?php echo lang("PATIENT::patinfo_status_active"); ?>"></i>
		<?php }else{ ?>
			<i class="icon-remove" title="<?php echo lang("PATIENT::patinfo_status_deactive"); ?>"></i>
		<?php } ?></td>
		<td>
		 	<?php if($sview == "1"){ echo anchor($i18n.'patient/addpatientinfo/'.$pid.'/'.$view.'/'.$piid,'<i class="icon-zoom-in" title="'. lang("COMMON::view").'"></i>&nbsp;&nbsp;'); } ?>
		 	<?php if($sedit == '1'){ echo anchor($i18n.'patient/editpatientinfo/'.$pid.'/'.$piid,'<i class="icon-edit" title="'. lang("COMMON::edit").'"></i>&nbsp;&nbsp;'); } ?>

<?php if($status == '1'){ echo anchor($i18n.'patient/status_pinfo/'.$pid.'/'.$piid.'/2','<i class="icon-remove" title="'. lang("PATIENT::patinfo_status_deactive").'"></i>&nbsp;&nbsp;'); }else{
	echo anchor($i18n.'patient/status_pinfo/'.$pid.'/'.$piid.'/1','<i class="icon-ok" title="'. lang("PATIENT::patinfo_status_active").'"></i>&nbsp;&nbsp;'); }
 ?>
		 	<?php if($sdelete == 1){
		 		 $onclick = array('onclick'=>"return confirm('SEI SICURO DI VOLERE CANCELLARE?')");
				 echo anchor($i18n.'patient/deletepinfo/'.$pid.'/'.$piid,'<i class="icon-trash" title="'. lang("COMMON::delete").'"></i>',$onclick); } ?>
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
