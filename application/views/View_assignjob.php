<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'jobassign','<i class="icon-backward"></i>&nbsp;&nbsp;'.( sprintf( lang("joblist")) ).'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
            <div class="pagetitle">
               <h1><?php echo ( sprintf( lang("view_assign_patient")) ); ?></h1>
            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">
				<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#dyntable').dataTable({
            "sPaginationType": "full_numbers",
            "aaSortingFixed": [[0,'asc']],
            "fnDrawCallback": function(oSettings) {
                jQuery.uniform.update();
            }
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
		  <th class="head0"><?php echo ( sprintf( lang("sno")) ); ?></th>
		  <th class="head1"><?php echo ( sprintf( lang("req_id")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("pname")) ); ?></th>
		  <th class="head0"><?php echo ( sprintf( lang("fstatus")) ); ?></th>
		 <th class="head1"><?php echo ( sprintf( lang("action")) ); ?></th>
		</thead>
		<tbody>
		<?php $i = 1;
if (count($optval) > 0)
{
   foreach ($optval as $row)
   {
   			$rid = $row->request_id;
			$pid = $row->patient_id;
			$oid = $row->operator;
			$status = $this->common->getjobpatientstatus($rid,$pid,$oid);
			?>
			<tr class="gradeX">
		<td><?=$i?></td>
		<td><?=$rid?></td>
		<td><?php echo $this->common->getpatientname($pid); ?></td>
		<td><?php echo $status; ?></td>
		<td>
		 	<?php if($status == "Open"){ if($sdelete == 1){ echo anchor($i18n.'jobassign/delete/'.$pid.'/'.$rid.'/'.$oid,'<i class="icon-trash" title="'.sprintf( lang("delete") ).'"></i>'); } } ?>
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