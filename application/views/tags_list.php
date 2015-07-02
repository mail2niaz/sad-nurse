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
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'cms/add_tag','<i class="icon-backward"></i>&nbsp;&nbsp;'.lang("TAG::add_tag").'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
                            <?php } ?>
            <div class="pagetitle">
               <h1><?php echo lang("TAG::tag_list"); ?></h1>

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
		  <th class="head1"><?php echo lang("TAG::tag_desc"); ?></th>
		 <th class="head1"><?php echo lang("COMMON::action"); ?></th>
		</thead>
		<tbody>
		<?php $i = 1;
if ($result->num_rows() > 0)
{
   foreach ($result->result() as $row)
   {
   			$tid = $row->tid;
			$tag_description = $row->tag_description;
			?>
			<tr class="gradeX">
		<td><?=$i?></td>
		<td><?=$tag_description?></td>
		<td>
			<?php if($sview == "1"){ echo anchor($i18n.'cms/view_tag/'.$tid,'<i class="icon-zoom-in" title="'.lang("COMMON::view").'"></i>&nbsp;&nbsp;'); } ?>
			<?php if($sedit == 1){ echo anchor($i18n.'cms/edit_tag/'.$tid,'<i class="icon-edit" title="'.lang("COMMON::edit").'"></i>'); } ?>
		 	<?php if($sdelete == 1){
		 		$onclick = array('onclick'=>"return confirm('SEI SICURO DI VOLERE CANCELLARE?')");
				 echo anchor($i18n.'cms/delete_tag/'.$tid,'<i class="icon-trash" title="'.lang("COMMON::delete").'"></i>',$onclick); } ?>
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