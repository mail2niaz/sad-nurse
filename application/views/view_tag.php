<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'cms/add_tag','<i class="icon-backward"></i>&nbsp;&nbsp;'.lang("TAG::tag_list").'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
            <div class="pagetitle">
            	<h1><?php echo lang("TAG::view_tag"); ?></h1>            </div>
        </div><!--pageheader-->
        <div class="maincontent">
            <div class="maincontentinner">

            <div class="widgetbox box-inverse span10" style="margin-left: 5px;">
                	                		<h4 class="widgettitle"><?php echo lang("TAG::view_tag"); ?></h4>
                <div class="widgetcontent nopadding stdform stdform2">
                			<p>
                                <label><?php echo lang("TAG::tag_desc"); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->tag_description; ?></span>
                            </p>

							<?php
							$tid = $optval->tid;
							 if($sedit == 1){ ?>
                            <p class="stdformbutton" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'cms/edit_tag/'.$optval->tid,'<i class="icon-link"></i>&nbsp;&nbsp;'.lang("TAG::edit_tag"),$attributes2); ?>
                            </p> <?php } ?>
 </div>

                </div><!--widgetcontent-->
                <div class="pagetitle">
               <h1><?php echo lang("LEFTMENU::operator-list"); ?></h1>

            </div>
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
		  <th class="head0"><?php echo lang("COMMON::sno"); ?></th>
		  <th class="head1"><?php echo lang("OPERATOR::name"); ?></th>
		 <th class="head1"><?php echo lang("COMMON::action"); ?></th>
		</thead>
		<tbody>
		<?php $i = 1;
if ($opt_list->num_rows() > 0)
{
   foreach ($opt_list->result() as $row)
   {
   			$oid = $row->oid;
    		$fname = $row->firstname;
			$lname = $row->lastname;
			$name = $fname." ".$lname;
			?>
			<tr class="gradeX">
		<td><?=$i?></td>
		<td><?=$name?></td>
		<td>
		 	<?php if($sdelete == 1){
		 		$onclick = array('onclick'=>"return confirm('SEI SICURO DI VOLERE CANCELLARE?')");
				 echo anchor($i18n.'cms/delete_opt_tag/'.$tid.'/'.$oid,'<i class="icon-remove" title="'.lang("COMMON::delete").'"></i>',$onclick); } ?>
		</td>
		</tr>
  <?php $i++; }
}  ?>
</tbody>
		</table>
            </div><!--widget-->

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