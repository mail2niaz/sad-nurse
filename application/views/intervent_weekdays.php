<?php
for($i = 2; $i <= 10; $i++){
	$j = $i+1; ?>
<div id = "com<?=$i?>" class="total_int_div_hide contractcom">
                            	<label style="width: 100%;"><?php echo ( sprintf( lang("INTERVENT::intervent_type")) ); ?></label>
                            	<div class="ranintervent_type">
							<select id="combobox<?=$j?>" name="intervent_type<?=$i?>">
							<option value="" selected="selected">--Select--</option>
                                <?php $int_type = $this->common->getintervent_type_list();
									if(count($int_type) > 0){
                                foreach($int_type as $int_type_list){
                                	$int_id = $int_type_list->int_type_id;
									$int_code = $int_type_list->int_code;
									$int_type = $int_type_list->int_type;
									?>
									<option value="<?=$int_id?>"><?=$int_code?>(<?=$int_type?>)</option>
                              <?php } }else{ ?>
									<option value="">Intervent Type Not Available</option>
                              <?php } ?>
							</select>
							<div>
							<input type="checkbox" name="suspend<?=$i?>" />&nbsp;&nbsp;<?php echo lang('CONTRACT::non_suspendable'); ?>
							</div>
							</div>
							<div class="tags">
							<label style="width: 100%;"><?php echo ( sprintf( lang("OPERATOR::tag")) ); ?></label>
							<select name="contract_tags<?=$i?>[]" data-placeholder="<?php echo ( sprintf( lang("OPERATOR::choose_tag")) ); ?>" class="chzn-select" multiple="multiple" style="width:350px;" tabindex="4">
                                  <option value=""></option>
                                  <?php
                                  $tags = $this->common->get_tags_list();
								  foreach($tags as $fet){
								  	$tid = $fet->tid;
									 $tag_desc = $fet->tag_description; ?>
									 <option value="<?=$tid?>"><?=$tag_desc?></option>
								  <?php } ?>
                                </select>
							</div>
							<div class="ranweekdays">
							<label class="intervent_fortnightly"><input type="checkbox" name="intervent_fortnightly<?=$i?>" onclick="weedayshide('<?=$i?>');" class="intfortnightly" id="intervent_fortnightly<?=$i?>" /><?php echo ( sprintf( lang("CONTRACT::intervent_fortnightly")) ); ?></label>
							</div>
							<div class="ranweekdays weekdays<?=$i?>">
							<label style="width: 100%;"><?php echo ( sprintf( lang("CONTRACT::days")) ); ?></label>
                                	<?php
                                	$sel_week = "select * from  week_days order by week_id ASC";
									$qry_week = mysql_query($sel_week);
									while($fet_week = mysql_fetch_assoc($qry_week)){
										$week_id = $fet_week['week_id'];
										$week_name = $fet_week['week_name']; ?>
										<input type="checkbox" name="week_days<?=$i?>[]" value="<?=$week_id?>" /><?=$week_name?>&nbsp;
									<?php } ?></div>
									<div id="hour_id<?=$i?>" style="padding-bottom: 10px; float: left;"></div>
</div>
<?php } ?>