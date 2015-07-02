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
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'cms/adddistrict','<i class="icon-backward"></i>&nbsp;&nbsp;'.lang("CMS-DISTRICT::add_district").'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
                            <?php } ?>
            <div class="pagetitle">
               <h1><?php echo lang("CMS-DISTRICT::district_list"); ?></h1>

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
		  <th class="head1"><?php echo lang("CMS-DISTRICT::district_name"); ?></th>
		  <th class="head1"><?php echo lang("CMS-DISTRICT::p200_code"); ?></th>
		 <th class="head1"><?php echo lang("COMMON::action"); ?></th>
		</thead>
		<tbody>
		<?php $i = 1;
if ($result->num_rows() > 0)
{
   foreach ($result->result() as $row)
   {
   			$did = $row->did;
			$dist_name = $row->dist_name;
			$p200_code = $row->P2000_CODE;
			?>
			<tr class="gradeX">
		<td><?=$i?></td>
		<td><?=$dist_name?></td>
		<td><?=$p200_code?></td>
		<td>
			<?php if($sedit == 1){ echo anchor($i18n.'cms/adddistrict/'.$did,'<i class="icon-edit" title="'.lang("COMMON::edit").'"></i>'); } ?>
		 	<?php if($sdelete == 1){
		 		$onclick = array('onclick'=>"return confirm('SEI SICURO DI VOLERE CANCELLARE?')");
				 echo anchor($i18n.'cms/district_delete/'.$did,'<i class="icon-trash" title="'.lang("COMMON::delete").'"></i>',$onclick); } ?>
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
