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
     <?php if(isset($view)){ $title_val = "CONTRACT::view_contract"; }else{ $title_val = "CONTRACT::add_contract"; } ?>

            <div class="pagetitle">
               <h1><?php echo lang($title_val); ?></h1>
            </div>
        </div><!--pageheader-->
        <div class="maincontent">
            <div class="maincontentinner">

            <div class="widgetbox box-inverse span10" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo lang($title_val); ?></h4>
                <div class="widgetcontent nopadding">
<link rel="stylesheet" href="<?php echo base_url()?>css/smooth_jquery_ui.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/combo_jquery.js"></script>
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2','id' => 'upload1');
           echo form_open_multipart('contract/addcontract_details',$attributes); ?>
           <input type="hidden" name="siteurl" value="<?php echo site_url($i18n.'contract/GetInterventHour') ?>" id = "siteurl"/>
           <input type="hidden" name="checkpatintervent" value="<?php echo site_url($i18n.'contract/checkpatintervent') ?>" id = "checkpatintervent"/>
           					<div class="jobautocomp">
                            <label><?php echo lang("PATIENT::patient_list"); ?></label>
                            <span class="field">
							<select id="combobox" name="patient_id">
							<option value="" selected="selected">--Select--</option>
                            <?php $pat = $this->common->getpatientlist();
							if(count($pat) > 0){
                             foreach($pat as $pats){
                            	$pid = $pats->pid;
								$pname = $pats->pname;
								$surname = $pats->surname;
								?>
								<option <?php if(set_value('patient_id') == $pid){ ?> selected="selected" <?php } ?> value="<?=$pid?>">PID-<?=$pid?>(<?php echo $surname." ".$pname; ?>)</option>
                          	<?php } }else{ ?>
								<option value=""><?php echo lang('INTERVENT::dataempty'); ?></option>
                        	<?php } ?>
							</select>

						</span>
						</div>
						<p>
                                <label><?php echo lang("CONTRACT::attachment"); ?></label>
                                <span class="field"><input type="file" name="userfile[]" size="20" class="multi" /></span>
                            </p>
						<p>
                                <label><?php echo lang("CMS-HOLIDAY::date"); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo lang("from"); ?> &nbsp;
                                	<input id="cdate" class="input-large" type="text" name="fdate" readonly="readonly" value="<?php echo set_value('fdate'); ?>">
                                </span>
                            </p>

						<div class="jobautocomp">
                            <span class="field">
                            	<div id="div_intervent_days">
                            	<div class="total_int_div" id="com1">
                            	<label style="width: 100%;"><?php echo lang("INTERVENT::intervent_type"); ?></label>
                            	<div class="ranintervent_type">
							<select id="combobox2" name="intervent_type1">
							<option value="" selected="selected">--Select--</option>
                                <?php $int_type = $this->common->getintervent_type_list();
									if(count($int_type) > 0){
                                foreach($int_type as $int_type_list){
                                	$int_id = $int_type_list->int_type_id;
									$int_code = $int_type_list->int_code;
									$int_type = $int_type_list->int_type; ?>
									<option <?php if(set_value('intervent_type1') == $int_id){ ?> selected="selected" <?php } ?> value="<?=$int_id?>"><?=$int_code?>(<?=$int_type?>)</option>
                              <?php } }else{ ?>
									<option value=""><?php echo lang('INTERVENT::dataempty'); ?></option>
                              <?php } ?>
							</select>
							<div>
							<input type="checkbox" name="suspend1" <?php if(set_value('suspend1') != ''){ ?> checked="checked" <?php } ?> />&nbsp;&nbsp;<?php echo lang('CONTRACT::non_suspendable'); ?>
							</div>
							</div>

							<div class="tags">
							<label style="width: 100%;"><?php echo lang("OPERATOR::tag"); ?></label>
							<select name="contract_tags1[]" data-placeholder="<?php echo lang("OPERATOR::choose_tag"); ?>" class="chzn-select" multiple="multiple" style="width:350px;" tabindex="4">
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
							<label class="intervent_fortnightly"><input type="checkbox" name="intervent_fortnightly1" onclick="weedayshide(1);"  id="intervent_fortnightly1" /><?php echo lang("CONTRACT::intervent_fortnightly"); ?></label>
							</div>
							<div class="ranweekdays weekdays1">
							<label style="width: 100%;"><?php echo lang("CONTRACT::days"); ?></label>
							<input type="checkbox" id="checkall" /><?php echo lang("CONTRACT::all"); ?>&nbsp;
                                	<?php
                                	$sel_week = $this->common->WeekDays();
									$qry_week = mysql_query($sel_week);
									foreach($sel_week->result() as $fet_week){
										$week_id = $fet_week->week_id;
										$week_name = $fet_week->week_name; ?>
										<input type="checkbox" class="classweekday" <?php if(in_array($week_id, set_value('week_days1',array()))){ ?> checked="checked" <?php } ?> name="week_days1[]" value="<?=$week_id?>" /><?=$week_name?>&nbsp;
									<?php } ?></div>

									<div id="hour_id1" style="padding-bottom: 10px; float: left;">
									</div>
									</div>
									<?php $this->load->view('intervent_weekdays'); ?>
									</div>
									<input type="hidden" name="last_intervent_days" id="last_intervent_days" value="2" />
									<a class="btn btn-primary btn-submit" id="addnew" href="javascript:void(0)"><?php echo ( lang("CONTRACT::add_intervent")); ?></a>
						</span>

					</div>

                            <p>
                                <label><?php echo lang("OPERATOR::note"); ?></label>
                                <span class="field"><textarea name="note" id="note" class="input-large"><?php echo set_value('note'); ?></textarea></span>

                            </p>

                            <p class="stdformbutton" style="text-align:right">
                                <button class="btn btn-primary btn-submit" id="sub_cont"><?php echo lang("COMMON::sub_btn"); ?></button>
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo lang("COMMON::reset_btn"); ?></button>
                            </p>
<?php echo form_close(); ?>
<div id="map_canvas" style="width: 100%; height: 600px; display: none;"></div>
                </div><!--widgetcontent-->
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

</script>
<?php $this->load->view('common/footer'); ?>