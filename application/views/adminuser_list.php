<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

        <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<a href="<?php echo site_url($i18n.'setting/add_adminuser') ?>" class="btn btn-rounded btn-submit btn-primary">
            	<i class="icon-link"></i>&nbsp;<?php echo ( sprintf( lang("addadmin_user")) ); ?></a>
                            </p>
            <div class="pagetitle">
               <h1><?php echo ( sprintf( lang("admin_user")) ); ?></h1>
            </div>

        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">
<script type="text/javascript">
    jQuery(document).ready(function(){
        // dynamic table
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
		  <th class="head0"><?php echo ( sprintf( lang("COMMON::sno")) ); ?></th>
		  <th class="head1"><?php echo ( sprintf( lang("admin_name")) ); ?></th>
		  <th class="head1"><?php echo ( sprintf( lang("admin_uname")) ); ?></th>
		 <th class="head1"><?php echo ( sprintf( lang("COMMON::action")) ); ?></th>
		</thead>
		<tbody>
		<?php $i = 1;
		$query = $this->db->query("SELECT * FROM admins");

if ($query->num_rows() > 0)
{
   foreach ($query->result() as $row)
   {
   			$aid = $row->aid;
    		$name = $row->name;
			$username = $row->username;
			$status = $row->status;
			?>
			<tr class="gradeX">
		<td><?=$i?></td>
		<td><?=$name?></td>
		<td><?=$username?></td>
		<td>
		 	<?php echo anchor($i18n.'setting/view_user_details/'.$aid,'<i class="icon-zoom-in" title="'.sprintf( lang("COMMON::view") ).'"></i>'); ?>&nbsp;&nbsp;
		 	<?php echo anchor($i18n.'setting/edituserdata/'.$aid,'<i class="icon-edit" title="'.sprintf( lang("COMMON::edit") ).'"></i>'); ?>&nbsp;&nbsp;
		 	<?php
		 	$onclick = array('onclick'=>"return confirm('SEI SICURO DI VOLERE CANCELLARE?')");
		 	 echo anchor($i18n.'setting/userdelete/'.$aid,'<i class="icon-trash" title="'.sprintf( lang("COMMON::delete") ).'"></i>',$onclick); ?>
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