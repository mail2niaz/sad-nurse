<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/report_left_menu'); ?>

    <div class="rightpanel">

        <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
            <div class="pagetitle">
               <h1><?php echo lang("REPORT::pat_report"); ?></h1>
            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">

<table id="cmsdyntable" class="table table-bordered responsive">
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
		  <th class="head1"><?php echo lang("REPORT::pname"); ?></th>
		  <th class="head1"><?php echo lang("PATIENT::email"); ?></th>
		 <th class="head1"><?php echo lang("COMMON::action"); ?></th>
		</thead>
		<tbody>
		<?php $i = 1;
		$query = $this->db->query("SELECT * FROM patients");

if ($query->num_rows() > 0)
{
   foreach ($query->result() as $row)
   {
   			$pid = $row->pid;
    		$name = $row->pname;
			$surname = $row->surname;
			$name = $name." ".$surname;
			?>
			<tr class="gradeX">
		<td><?=$i?></td>
		<td><?=$name?></td>
		<td align="center"><?php echo $row->email;  ?></td>
		<td>
			<?php echo anchor($i18n.'patient/patientinfodetails/'.$pid,'<i class="icon-user" title="'.lang("PATIENT::info").'"></i>'); ?>&nbsp;&nbsp;
		 	<?php echo anchor($i18n.'patient/patientdetails/'.$pid,'<i class="icon-zoom-in" title="'.lang("COMMON::view").'"></i>'); ?>&nbsp;&nbsp;
		 	<?php echo anchor($i18n.'patient/editpatient/'.$pid,'<i class="icon-edit" title="'.lang("COMMON::edit").'"></i>'); ?>&nbsp;&nbsp;
		 	<?php echo anchor($i18n.'patient/delete/'.$pid,'<i class="icon-trash" title="'.lang("COMMON::delete").'"></i>'); ?>
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