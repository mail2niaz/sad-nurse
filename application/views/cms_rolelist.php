<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

        <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
            <div class="pagetitle">
               <h1><?php echo lang("CMS-ROLE::rolelist"); ?></h1>
            </div>
            <a href="<?php echo site_url($i18n.'cms/addroleview') ?>" class="btn btn-rounded btn-submit btn-primary">
            	<i class="icon-link"></i>&nbsp;<?php echo lang("CMS-ROLE::add_role"); ?></a>
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
		  <th class="head1"><?php echo lang("CMS-ROLE::role_name"); ?></th>
		 <th class="head1"><?php echo lang("COMMON::action"); ?></th>
		</thead>
		<tbody>
		<?php $i = 1;
if ($result->num_rows() > 0)
{
   foreach ($result->result() as $row)
   {
   			$rid = $row->rid;
    		$name = $row->type;
			?>
			<tr class="gradeX">
		<td><?=$i?></td>
		<td><?=$name?></td>
		<td>
		 	<?php echo anchor($i18n.'cms/roledetails/'.$rid,'<i class="icon-zoom-in" title="'.lang("COMMON::view").'"></i>'); ?>&nbsp;&nbsp;
		 	<?php echo anchor($i18n.'cms/editrole/'.$rid,'<i class="icon-edit" title="'.lang("COMMON::edit").'"></i>'); ?>&nbsp;&nbsp;
		 	<?php
		 	$onclick = array('onclick'=>"return confirm('SEI SICURO DI VOLERE CANCELLARE?')");
		 	echo anchor($i18n.'cms/delete/'.$rid,'<i class="icon-trash" title="'.lang("COMMON::delete").'"></i>',$onclick); ?>
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