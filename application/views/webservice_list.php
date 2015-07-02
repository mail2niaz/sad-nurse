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
			<?php   /*if($sadd == 1){  echo anchor($i18n.'admin_webservice/add_webservice_url','<i class="icon-backward"></i>&nbsp;&nbsp;'.( sprintf( lang("LEFTMENU::add_webservice")) ).'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); }*/ ?>
                            	
			</p>
            <div class="pagetitle">
               <h1><?php echo lang("ADMIN-WEBSERVICE::webservice_list"); ?></h1>

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
		  <th class="head1"><?php echo ( sprintf( lang("ADMIN-WEBSERVICE::url")) ); ?></th>
		  <th class="head1"><?php echo ( sprintf( lang("ADMIN-WEBSERVICE::platform_code")) ); ?></th>
		  <th class="head1"><?php echo ( sprintf( lang("COMMON::action")) ); ?></th>
		  </thead>
		<tfoot>
            <th class="head0"><?php echo ( sprintf( lang("COMMON::sno")) ); ?></th>
            <th class="head1"><?php echo ( sprintf( lang("ADMIN-WEBSERVICE::url")) ); ?></th>
            <th class="head1"><?php echo ( sprintf( lang("ADMIN-WEBSERVICE::platform_code")) ); ?></th>
            <th class="head1"><?php echo ( sprintf( lang("COMMON::action")) ); ?></th>
		  </tfoot>
		<tbody>
		<?php $i = 1;
if ($result->num_rows() > 0)
{
   foreach ($result->result() as $row) 
   {
   			$id = $row->id;
			$url = $row->url;
			$platform_code = $row->platform_code;
			?>
		<tr class="gradeX" <?php  if($row->suspended == 'on') { echo "style='background-color: #ccc;'"; }  ?>>
		<td><?=$i?></td>
		<td><?=$url?></td>
		<td><?=$platform_code?></td>
		<td>
		 	<?php if($sedit == '1'){ echo anchor($i18n.'admin_webservice/edit_webservice/'.$id,'<i class="icon-edit" title="'.sprintf( lang("COMMON::edit") ).'"></i>&nbsp;&nbsp;'); } ?>
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
