<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
        	<p class="stdformbutton searchbar" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'contract','<i class="icon-backward"></i>&nbsp;&nbsp;'.lang("CONTRACT::contract_list").'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>

            <div class="pagetitle">
               <h1><?php echo lang("CONTRACT::edit_contract"); ?></h1>
            </div>
        </div><!--pageheader-->
        <div class="maincontent">
            <div class="maincontentinner">

            <div class="widgetbox box-inverse span10" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo lang("CONTRACT::edit_contract"); ?></h4>
                <div class="widgetcontent nopadding">
                			<link rel="stylesheet" href="<?php echo base_url()?>css/smooth_jquery_ui.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/combo_jquery.js"></script>
    	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2','id' => 'upload1');
           echo form_open_multipart('contract/editcontract/'.$optval->cid,$attributes);
            echo form_hidden('cid',$optval->cid); ?>
 <input type="hidden" name="siteurl" value="<?php echo site_url($i18n.'contract/GetInterventHour') ?>" id = "siteurl"/>
						<div class="jobautocomp">
                            <label><?php echo lang("PATIENT::patient_list"); ?></label>
                            <span class="field">
                            	<input type="hidden" id="deletecontractimgage" name="deletecontractimgage" value="<?php echo site_url($i18n.'contract/deleteimgage') ?>" />
                            	<input type="hidden" name="multiimgdeletefrom" id="multiimgdeletefrom" value="contract" />
                            	<input type="hidden" id="patient_id" name="patient_id" value="<?php echo $optval->pid; ?>" />
                            	<input type="text" class="input-large" readonly="readonly" value="<?php echo $this->common->getpatientname($optval->pid); ?>" />
						</span>
						</div>
<p>
                            	 <label><?php echo lang("CONTRACT::attachment"); ?></label>
                            	 <span class="field"><input type="file" name="userfile[]" size="20" class="multi" /></span>
                            	 <div class="patinfoimg">
								<?php $query = $this->contract_model->ContractImages($optval->cid);
								if ($query->num_rows() > 0)
								{
									$i = 1;
								   foreach ($query->result() as $row)
								   {
								   	$ext = pathinfo($row->file, PATHINFO_EXTENSION);
									if($ext == "pdf"){
										$data_light = '';
										$target = 'target="_blank"';
									}else{
										$data_light = 'data-lightbox="example-'.$i.'"';
										$target = '';
									}
								   	?>
								   	<div id="img<?php echo $i; ?>" class="patimg">
								   		<a <?=$target?> href="<?php echo base_url(); ?>uploads/contract_image/<?=$this->config->item('upload_folder')?>/<?php echo $row->file; ?>" <?=$data_light?>>
								   			<?php if($ext == "pdf"){ ?>
												<img src="<?php echo base_url(); ?>images/pdf.png" width="100" height="100"  />
								   			<?php }else{ ?>
									<img src="<?php echo base_url(); ?>uploads/contract_image/<?=$this->config->item('upload_folder')?>/<?php echo $row->file; ?>" width="100" height="100"  /><?php } ?></a>
									<a class='delete_link' href='javascript:void(0)' data_link='<?php echo $row->contract_img_id; ?>' data_loop='<?php echo $i; ?>' >Remove</a>
</div>								<?php $i++; } } ?>
							</div>
							</p>
						<p>
                                <label><?php echo lang("CMS-HOLIDAY::date"); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo lang("from"); ?> &nbsp;
                                	<input id="cdate" class="input-large" type="text" name="fdate" readonly="readonly" value="<?php echo set_value('fdate', date("d-m-Y",$optval->start_date)); ?>" >
                                </span>
                            </p>

						<div class="jobautocomp">
                            <span class="field">
                            	<div id="div_intervent_days">
                            		<?php
                            		$sel_int_week = $this->contract_model->ContractInterventWeekdays($optval->cid);
									$int_week_cnt = $sel_int_week->num_rows();
									$int_week_cnt_next = $int_week_cnt + 1;
									$fetch_intervent_days = 10 + $int_week_cnt;
									if ($int_week_cnt > 0)
									{
										$iw = 1;
										$j = 10 + $iw;
										foreach ($sel_int_week->result() as $row_int_week)
										   {
											$intervent_id = $row_int_week->intervent_id;
											$ciw_id = $row_int_week->ciw_id;
											$intervent_fortnightly 	 = $row_int_week->intervent_fortnightly;
											$patient_address = $row_int_week->patient_address;
											$patient_city = $row_int_week->patient_city;
											$patient_zip_code = $row_int_week->patient_zip;
											$patient_latlang =$row_int_week->patient_latlng;
											$inttime = explode(":", $row_int_week->intervent_hour);
										 	$hour = $inttime[0];
										 	$min = $inttime[1];
											if($intervent_fortnightly == "on"){
												$wkday = 'style="display: none;"';
											}else{
												$wkday = 'style="display: block;"';
											}
											$week_days = explode(",", $row_int_week->week_days);
											 ?>
											<input type="hidden" name="update_intervent_weekdays<?=$j?>" id="update_intervent_weekdays<?=$j?>" value="<?=$ciw_id?>" />
							<div class="contractcom" id = "com<?=$j?>">
                            	<label style="width: 100%;"><?php echo lang("INTERVENT::intervent_type"); ?></label>
                            	<div class="ranintervent_type">
							<select id="combobox<?=$iw?>" name="intervent_type<?=$j?>">
							<option value="" selected="selected">--Select--</option>
                                <?php $int_type = $this->common->getintervent_type_list();
									if(count($int_type) > 0){
                                foreach($int_type as $int_type_list){
                                	$int_id = $int_type_list->int_type_id;
									$int_code = $int_type_list->int_code;
									$int_type = $int_type_list->int_type; ?>
									<option value="<?=$int_id?>" <?php if(set_value('intervent_type'.$j.'', $intervent_id) == $int_id ){ ?> selected="selected" <?php } ?>><?=$int_code?>(<?=$int_type?>)</option>
                              <?php } }else{ ?>
									<option value="">Intervent Type Not Available</option>
                              <?php } ?>
							</select>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="javascript:void(0)" class="btn btn-rounded btn-primary btn-submit" onclick="deletecontractintervent('<?=$j?>','<?=$optval->pid?>','<?=$optval->cid?>',<?=$intervent_id?>);"><?php echo lang("CONTRACT::delete_intervent");?></a>
							<?php
							$sel_check_suspend = $this->contract_model->CheckSuspendable($optval->cid,$optval->pid,$intervent_id);
									foreach($sel_check_suspend->result() as $fet_check_suspend){
										$suspend = $fet_check_suspend->suspendable; ?>
										<div>
							<input type="checkbox" name="suspend<?=$j?>" <?php if($suspend == "1"){ ?>checked="checked"<?php } ?> />&nbsp;&nbsp;<?php echo lang('CONTRACT::non_suspendable'); ?>
							</div>
								<?php } ?>
							</div>

							<div class="tags">
							<label style="width: 100%;"><?php echo lang("OPERATOR::tag"); ?></label>
							<select name="contract_tags<?=$j?>[]" data-placeholder="<?php echo lang("OPERATOR::choose_tag"); ?>" class="chzn-select" multiple="multiple" style="width:350px;" tabindex="4">
                                  <option value=""></option>
                                  <?php
                                  $tags = $this->common->get_tags_list();
								  foreach($tags as $fet){
								  	$tid = $fet->tid;
									 $tag_desc = $fet->tag_description; ?>
									 <option value="<?=$tid?>" <?php if(in_array($tid, explode(",", $row_int_week->contract_tags))){ ?> selected="selected" <?php } ?>><?=$tag_desc?></option>
								  <?php } ?>
                                </select>
							</div>

							<div class="ranweekdays">
							<label class="intervent_fortnightly"><input type="checkbox" name="intervent_fortnightly<?=$j?>" onclick="weedayshide('<?=$j?>');"  id="intervent_fortnightly<?=$j?>" <?php if($intervent_fortnightly == "on"){ ?> checked="checked" <?php } ?> /><?php echo lang("CONTRACT::intervent_fortnightly"); ?></label>
							</div>

							<div class="ranweekdays weekdays<?=$j?>" <?=$wkday?>>
							<label style="width: 100%;"><?php echo lang("CONTRACT::days"); ?></label>
                                	<?php
                                	$sel_week = $this->common->WeekDays();
									foreach($sel_week->result() as $fet_week){
										$week_id = $fet_week->week_id;
										$week_name = $fet_week->week_name; ?>
										<input type="checkbox" name="week_days<?=$j?>[]" value="<?=$week_id?>" <?php if(in_array($week_id, $week_days)) { ?> checked="checked" <?php } ?> /><?=$week_name?>&nbsp;
									<?php } ?></div>
									<div id="hour_id<?=$j?>" style="padding-bottom: 10px; float: left;">
										<div style="padding-bottom: 10px;">
								 		<label style="width: 100%;"><?php echo ( lang("INTERVENT::standard_duration")); ?></label>
								 		<select name="hourcombo<?=$j?>" class="endhourcombo">
	                            	<option value="0">00</option>
                            	<?php for($eht = 0; $eht <= 23; $eht++ ){ ?>
     								<option value="<?=$eht?>" <?php if($eht == $hour){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($eht);?></option>
                            	<?php } ?>
							</select>
							<select name="mincombo<?=$j?>" class="endhourcombo">
								<?php for($emt = 0; $emt <= 55; $emt = $emt+5 ){ ?>
     								<option value="<?=$emt?>" <?php if($emt == $min){ ?> selected="selected" <?php } ?>><?php echo $this->common->commontimeformat($emt);?></option>
                            	<?php } ?>
			</select>

								 		<!--<input type="text" name="int_time<?=$j?>" value="<?=$row_int_week->intervent_hour?>" class="input-large" />-->  ( HH:MM )
								 	</div>

		<div>
			<label style="width: 100%;"><?php echo lang("CONTRACT::patient_address"); ?></label>
			<textarea style="width: 350px;" id="pataddress<?=$j?>" name="pataddress<?=$j?>"><?=$patient_address?></textarea>
		</div>
		<div style="float: left; width: 225px;">
			<label style="width: 100%;"><?php echo lang("CONTRACT::patient_city"); ?></label>
			<input type="text" style="width: 200px;" id="patcity<?=$j?>" name="patcity<?=$j?>" value="<?php echo $patient_city; ?>">
		</div>
		<div style="float: left; width: 225px;">
			<label style="width: 100%;"><?php echo lang("CONTRACT::patient_zip"); ?></label>
			<input type="text" style="width: 200px;" id="patzip<?=$j?>" name="patzip<?=$j?>" value="<?php echo $patient_zip_code; ?>">
		</div>
		<div style="float: left; width: 215px;">
			<label style="width: 100%;"><?php echo lang("CONTRACT::patient_latlng"); ?></label>
			<input type="text" style="width: 200px;" id="patlatlng<?=$j?>" name="patlatlng<?=$j?>" value="<?php echo $patient_latlang; ?>">
		</div>
		<div style="float: left; width: 36px;">
		<input type="button" value="Map" name="pickmap" onclick="codeAddress('<?=$j?>')" class="btn-submit btn-primary"  style="margin-top: 37px;"/>
		</div>
									</div>
									</div>
										   <?php $iw++; $j++; }
									}
                            		?>

									<?php $this->load->view('intervent_weekdays'); ?>
									</div>
									<input type="hidden" name="cnt_intervent_days" id="cnt_intervent_days" value="<?=$int_week_cnt?>" />
									<input type="hidden" name="fetch_intervent_days" id="fetch_intervent_days" value="<?=$fetch_intervent_days?>" />
									<input type="hidden" name="last_intervent_days" id="last_intervent_days" value="<?=$int_week_cnt_next?>" />
									<a class="btn btn-primary btn-submit" id="addnew" href="javascript:void(0)"><?php echo ( lang("CONTRACT::add_intervent")); ?></a>
						</span>

						</div>
						<?php /* Ceased Details */
						$sel_ceased_det = $this->contract_model->GetContractCeasedDetails($optval->cid,NULL,'2');
						$qry_ceased_det = $sel_ceased_det->result();
						$cnt_ceased_det = $sel_ceased_det->num_rows();
						if($cnt_ceased_det > 0){
							$ceased_id = $qry_ceased_det[0]->ceased_id;
							$ceased_reopen = $qry_ceased_det[0]->ceased_reopen;
						if($ceased_reopen == '2'){
							$ceased_date = date("d-m-Y",$qry_ceased_det[0]->ceased_date);
							$ceased_reason = $qry_ceased_det[0]->ceased_reason;
							$ceased_reopen_style = 'style="display:block"';
						}else{
							$ceased_date = "";
							$ceased_reason = "";
							$ceased_reopen_style = 'style="display:none"';
						}
						}else{
							$ceased_id = '';
							$ceased_reopen = '';
							$ceased_date = "";
							$ceased_reason = "";
							$ceased_reopen_style = 'style="display:none"';
						}

						?>
						<p>
                                <label><?php echo lang("CONTRACT::ceased_date"); ?></label>
                                <span class="field">
                                	<input id="hdate" class="input-large" type="text" name="ceased_date" readonly="readonly" value="<?php echo $ceased_date; ?>" >&nbsp;
                                	<input type="hidden" name="last_ceased_date" value="<?php echo $ceased_date; ?>" />
                                	 <span  <?=$ceased_reopen_style?>>
                                	<a href="javascript:void(0)" onclick="deactive();"><?php echo lang("CONTRACT::reactivate"); ?></a></span>

                                </span>
                            </p>
							<p>
                                <label><?php echo lang("CONTRACT::ceased_reason"); ?></label>
                                <span class="fieldcombobox field"><textarea name="ceased_reason" id="ceased_reason" class="input-large"><?php echo $ceased_reason; ?></textarea></span>
                          </p><?php /* End Ceased Details */ ?>
                            <p>
                                <label><?php echo lang("OPERATOR::note"); ?></label>
                                <span class="field"><textarea name="note" id="note" class="input-large"><?php echo $optval->note; ?></textarea></span>
                            </p>

                            <p class="stdformbutton" style="text-align:right">
                                <input type="submit" class="btn btn-primary btn-submit" id="subbtn" name="mysubmit" value="<?php echo lang("COMMON::sub_btn"); ?>">
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo lang("COMMON::reset_btn"); ?></button>
                            </p>
<?php echo form_close(); ?>
                </div><!--widgetcontent-->
            </div><!--widget-->
            <div id="map_canvas" style="width: 100%; height: 600px; display: none;"></div>
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
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>

<script type="text/javascript">
 var map;
      var geocoder;
      var mapOptions = { center: new google.maps.LatLng(0.0, 0.0), zoom: 2,
        mapTypeId: google.maps.MapTypeId.ROADMAP };
      function initialize() {
			var myOptions = {
                center: new google.maps.LatLng(42.714732,12.128906 ),
                zoom: 12,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            geocoder = new google.maps.Geocoder();
            var map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions);
            var marker;
      }

        function codeAddress(valid) {
		    if(document.getElementById("pataddress"+valid).value != ''){
		    	var gaddress = document.getElementById("pataddress"+valid).value;
		    }else{
		    	var gaddress = '';
		    }
		    if(document.getElementById("patcity"+valid).value != ''){
		    	var city = ','+document.getElementById("patcity"+valid).value;
		    }else{
		    	var city = '';
		    }
		     if(document.getElementById("patzip"+valid).value != ''){
		    	var zip_code = ','+document.getElementById("patzip"+valid).value;
		    }else{
		    	var zip_code = '';
		    }

/* popup map */
	var $about = jQuery("#map_canvas");
       $about.dialog({
				         title: "<?php echo lang("CONTRACT::patient_map"); ?>",
				         width: 900,
				         height: 600,
				         top: 0,
				         closeOnEscape: true,
				         position:'center',
				         close: function() {
				            $about.dialog("destroy").hide();
				         },
				         buttons: {
				            close : function() {
				               $about.dialog("close");
				            }
				         }
				      }).show();
/* End popup */
    var address = gaddress+city+zip_code;
    var loc=[];
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        loc[0]=results[0].geometry.location.lat();
        loc[1]=results[0].geometry.location.lng();
			geocoder = new google.maps.Geocoder();
		    var latlng = new google.maps.LatLng(loc[0],loc[1]);
		    var myOptions = {
		      zoom: 14,
		      center: latlng,
		      mapTypeId: google.maps.MapTypeId.ROADMAP
		    }
		    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		   	var myMarker = new google.maps.Marker({
    		position: new google.maps.LatLng(loc[0],loc[1]),
   	 		draggable: true
			});

			var lat1 = loc[0].toFixed(6);
			var lng1 = loc[1].toFixed(6);
			var latlong1 = lat1+","+lng1;
			document.getElementById('patlatlng'+valid).value = latlong1;

			google.maps.event.addListener(myMarker, 'dragend', function(evt){
				var lat = evt.latLng.lat().toFixed(6);
				var lng = evt.latLng.lng().toFixed(6);
				var latlong = lat+","+lng;
				document.getElementById('patlatlng'+valid).value = latlong;
				getAddress1(evt.latLng,valid);
			});
			map.setCenter(myMarker.position);
			myMarker.setMap(map);
} else {
        alert("Geocode non è riuscita per il seguente motivo: " + status);
      }
    });
}
      function getAddress1(latLng,valid) {
        geocoder.geocode( {'latLng': latLng},
          function(results, status) {
            if(status == google.maps.GeocoderStatus.OK) {
              if(results[0]) {
                document.getElementById("pataddress"+valid).value = results[0].formatted_address;
              }
              else {
                document.getElementById("pataddress"+valid).value = "No results";
              }
            }
            else {
              document.getElementById("pataddress"+valid).value = status;
            }
          });
        }
      google.maps.event.addDomListener(window, 'load', initialize);

function deletecontractintervent (autoid,pid,cid,intid) {
var r = confirm("sicuro di voler eliminare l'intervento?");
if (r == true) {
    var url = "<?php echo site_url($i18n.'contract/delete_contract_intervent') ?>/"+pid+"/"+cid+"/"+intid;
	 jQuery.ajax({
	 type: "POST",
	 url: url,
	 success: function(msg)
	 {
	 	if(msg == 'success'){
			jQuery('#com'+autoid).hide();
	 	}else{
			alert(msg);
	 	}
	 }
	 });
}
}
</script>
<?php $this->load->view('common/footer'); ?>