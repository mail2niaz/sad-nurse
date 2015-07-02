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
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'contract/addcontract','<i class="icon-backward"></i>&nbsp;&nbsp;'.lang("CONTRACT::add_contract").'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
                            <?php } ?>
            <div class="pagetitle">
               <h1><?php echo lang("CONTRACT::contract_list"); ?></h1>

            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">
            	<?php if(isset($error_msg)){ echo '<h4 style="color: red; text-align: center;">'.$error_msg.'</h4>'; }	?>
<table id="contractlistdyntable" class="table table-bordered responsive">
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
		  <th class="head1"><?php echo lang("CONTRACT::pname"); ?></th>
		  <th class="head2"><?php echo lang("JOBASSIGN::intervent_type"); ?></th>
		  <th class="head3"><?php echo lang("CMS-HOLIDAY::date"); ?></th>
		  <th class="head4"><?php echo lang("CONTRACT::ceased_date"); ?></th>
		 <th class="head5"><?php echo lang("COMMON::action"); ?></th>
		</thead>
		<tfoot>
		<tr>
			<th><?php echo lang("COMMON::sno"); ?></th>
			<th><?php echo lang("CONTRACT::pname"); ?></th>
			<th><?php echo lang("JOBASSIGN::intervent_type"); ?></th>
			<th><?php echo lang("CMS-HOLIDAY::date"); ?></th>
			<th><?php echo lang("CONTRACT::ceased_date"); ?></th>
		 	<th><?php echo lang("COMMON::action"); ?></th>
		</tr>
	</tfoot>
		<tbody>
		<?php $i = 1;
		$intervent_id = array();
		if(isset($from_pid)){
			$query = $this->contract_model->getcontractlist($pid);
		}else{
			$query = $this->contract_model->getcontractlist();
		}
if ($query->num_rows() > 0)
{
   foreach ($query->result() as $row)
   {
   			$time = time();
   			$cid = $row->cid;
			$cur_end_date = strtotime(date("d-m-Y"));
			 $contract_end_date = $row->end_date;
			if($cur_end_date == $contract_end_date){
				$sel_cceased = $this->contract_model->GetContractCeasedDetails($cid,$cur_end_date,'1');
				$cnt_cceased = $sel_cceased->num_rows();
				if($cnt_cceased < 1){
					$ins_cceased_details = $this->contract_model->ListPageCeasedInsert($cid,$cur_end_date,'contratto chiuso','2',$time);
				}
			}
			/* Ceased Details */
			$sel_ceased_det = $this->contract_model->GetContractCeasedDetails($cid,NULL,'2');
			$qry_ceased_det = $sel_ceased_det->result();
			$cnt_ceased_det = $sel_ceased_det->num_rows();
			if($cnt_ceased_det > 0){
				$ceased_reopen = $qry_ceased_det[0]->ceased_reopen;
				$ceased_date = $qry_ceased_det[0]->ceased_date;
				$cur_date = strtotime(date("d-m-Y"));
				if($ceased_date == $cur_date && $ceased_reopen == "2" ){
					$c_reopen = lang("cclosed");
				}else{

					$c_reopen = date("d-m-Y", $ceased_date);
				}
			}else{
				$c_reopen = lang("copen");
			}

			/* End Ceased Details */
			$pid = $this->common->getpatientname($row->pid);
			$sel_int = $this->contract_model->ContractInterventWeekdays($cid);

			foreach ($sel_int->result() as $row_int)
			   {
					$intervent_id[] = $this->common->getinterventname($row_int->intervent_id);
			   }
			$intervent_name = implode(", ", $intervent_id);
			$intervent_id = '';
    		$sdata = date("d-m-Y", $row->start_date);
    		$edata = date("d-m-Y", $row->end_date );
			?>
			<tr class="gradeX" <?php  if($row->last_ceased_date != 0) { echo "style='background-color: #ccc;'"; }  ?>>
		<td><?=$i?></td>
		<td><?=trim($pid)?></td>
		<td><?php echo trim($intervent_name);?></td>
		<td><?php echo $sdata ."&nbsp;<b>".lang("to")."</b>&nbsp;".$edata;?></td>
		<td><?php if($row->last_ceased_date == 0){echo ''; } else {echo $c_reopen; } ?></td>
		<td>
			<?php if($sview == 1){ echo anchor($i18n.'contract/viewcontract/'.$cid,'<i class="icon-zoom-in" title="'.lang("COMMON::view").'"></i>'); }  ?>
			<?php if($sedit == 1){ echo anchor($i18n.'contract/editcontract/'.$cid,'<i class="icon-edit" title="'.lang("COMMON::edit").'"></i>'); }  ?>
		 	<?php if($sdelete == 1){
				$onclick = array('onclick'=>"return confirm('SEI SICURO DI VOLERE CANCELLARE?')");
				 echo anchor($i18n.'contract/contractdelete/'.$cid,'<i class="icon-trash" title="'.lang("COMMON::delete").'"></i>',$onclick); } ?>
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