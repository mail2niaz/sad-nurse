<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

       <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
<p class="stdformbutton searchbar" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'patient/patientlist','<i class="icon-backward"></i>&nbsp;&nbsp;'.lang("PATIENT::patient_list").'&nbsp;&nbsp;<i class="icon-forward"></i>',$attributes2); ?>
                            </p>
            <div class="pagetitle">
               <h1><?php echo lang("LEFTMENU::add_patient"); ?></h1>
            </div>
        </div><!--pageheader-->
        <div class="maincontent">
            <div class="maincontentinner">
<div class="pat-innermain">
            <div class="widgetbox box-inverse span9" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo lang("LEFTMENU::add_patient"); ?></h4>
                <div class="widgetcontent nopadding">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open($i18n.'patient/addpatient',$attributes);
           echo form_hidden('tid',$stype);
           echo form_hidden('aid',$aid);
           ?>
                            <p>
                                <label><?php echo lang("PATIENT::name"); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="pname" id="pname" class="input-large" value="<?php echo set_value('pname'); ?>" /></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::surname"); ?><span class="rstar">*</span></label>
                                <span class="field"><input id="surname" class="input-large" type="text" name="surname" value="<?php echo set_value('surname'); ?>"></span>
                            </p>

                            <p>
                                <label><?php echo lang("COMMON::sex"); ?><span class="rstar">*</span></label>
                                <span class="field"><input class="input-large" type="radio" <?php if(set_value('sex') == 'male'){ ?> checked="checked" <?php } ?> value="male" name="sex"><?php echo lang("COMMON::male"); ?>&nbsp;&nbsp;
                                	<input class="input-large" type="radio" <?php if(set_value('sex') == 'female'){ ?> checked="checked" <?php } ?> value="female" name="sex"><?php echo lang("COMMON::female"); ?></span>
                            </p>

                             <p>
                                <label><?php echo lang("PATIENT::email"); ?></label>
                                <span class="field"><input type="text" name="email" id="email" class="input-large" value="<?php echo set_value('email'); ?>"/></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::district"); ?><span class="rstar">*</span></label>
                                <span class="field"><select name="dist_id" id="dist_id" class="uniformselect">
                                    <option value=""><?php echo lang("COMMON::choose_one"); ?></option>
                                    <?php
									$district = $this->common->districtlist();
									$district_cnt = $district->num_rows();
										if ($district_cnt > 0)
										{
										   foreach ($district->result() as $row_dist)
										   {
										   			$did = $row_dist->did;
										    		$dist_name = $row_dist->dist_name;
													?>
											<option value="<?=$did?>" <?php if(set_value('dist_id') == $did){ ?> selected="selected" <?php } ?>><?=$dist_name?></option>
												<?php } }  ?>
                                </select></span>
                            </p>

							<p>
                                <label><?php echo lang("PATIENT::ws_code"); ?></label>
                                <span class="field"><input type="text" name="ws_code" id="ws_code" onchange="codeAddress()" class="input-large" value="<?php echo set_value('city'); ?>" /></span>
                            </p>

                            <p>
                                <label><?php echo lang("COMMON::birthday"); ?><span class="rstar">*</span></label>
                                <span class="field"><input id="datepicker" class="input-large" type="text" name="dob" readonly="readonly" value="<?php echo set_value('dob'); ?>"></span>
                            </p>
                            <p>
                                <label><?php echo lang("PATIENT::provre"); ?></label>
                                <span class="field"><input type="text" name="provre" id="provre" class="input-large" value="<?php echo set_value('provre'); ?>" /></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::con_no"); ?><span class="rstar">*</span></label>

                                <div class="field">
                                	<span id="phoneadd">
                                		<input type="text" name="contact_no[]" class="input-large" value="<?php echo set_value('contact_no'); ?>"/></span><br><br>
                                		<a class="btn btn-primary btn-submit" id="addnew" href="javascript:void(0)"><?php echo lang("PATIENT::add_phone_no"); ?></a>
                                </div>

                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::ssn"); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="ssn" id="ssn" class="input-large" value="<?php echo set_value('ssn'); ?>"/></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::address"); ?><span class="rstar">*</span></label>
                                <span class="field"><textarea name="address" id="address" class="input-large"><?php echo set_value('address'); ?></textarea>
                                	<input type="button" value="<?php echo lang("PATIENT::map"); ?>" name="pickmap" onclick="codeAddress()" class="btn-submit btn-primary" />
                                	<input type="button" value="<?php echo lang("PATIENT::gps"); ?>" name="gps" onclick="GPScodeAddress()" class="btn-submit btn-primary" />
                                </span>
                            </p>

                             <p>
                                <label><?php echo lang("PATIENT::city"); ?></label>
                                <span class="field"><input type="text" name="city" id="city" onchange="codeAddress()" class="input-large" value="<?php echo set_value('city'); ?>" /></span>
                            </p>



                            <p>
                                <label><?php echo lang("PATIENT::zip_code"); ?></label>
                                <span class="field"><input type="text" name="zip_code" id="zip_code" onchange="codeAddress()" class="input-large" value="<?php echo set_value('zip_code'); ?>" /></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::latlang"); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="latlang" id="latlang" class="input-large" readonly="readonly" value="<?php echo set_value('latlang'); ?>"/></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::pa_surname"); ?></label>
                                <span class="field"><input type="text" name="pa_surname" id="pa_surname" class="input-large" value="<?php echo set_value('pa_surname'); ?>" /></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::paying"); ?></label>
                                <span class="field"><input type="text" name="paying" id="paying" class="input-large" value="<?php echo set_value('paying'); ?>" /></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::pa_address"); ?></label>
                                <span class="field"><textarea name="pa_address" id="pa_address" class="input-large"><?php echo set_value('pa_address'); ?></textarea></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::pa_provre"); ?></label>
                                <span class="field"><input type="text" name="pa_provre" id="pa_provre" class="input-large" value="<?php echo set_value('pa_provre'); ?>"/></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::pa_cap"); ?></label>
                                <span class="field"><input type="text" name="pa_cap" id="pa_cap" class="input-large" value="<?php echo set_value('pa_cap'); ?>" /></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::pa_city"); ?></label>
                                <span class="field"><input type="text" name="pa_city" id="pa_city" class="input-large" value="<?php echo set_value('pa_city'); ?>"/></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::nas_city"); ?></label>
                                <span class="field"><input type="text" name="nas_city" id="nas_city" class="input-large" value="<?php echo set_value('nas_city'); ?>"/></span>
                            </p>


                            <p>
                                <label><?php echo lang("PATIENT::note"); ?></label>
                                <span class="field"><textarea name="note" id="note" class="input-large"><?php echo set_value('note'); ?></textarea></span>
                            </p>

                            <p class="stdformbutton" style="text-align:right">
                                <button class="btn btn-primary btn-submit"><?php echo lang("COMMON::sub_btn"); ?></button>
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo lang("COMMON::reset_btn"); ?></button>
                            </p>
<?php echo form_close(); ?>
                </div><!--widgetcontent-->
            </div><!--widget-->

                <div id="map_canvas"></div>


</div>


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

        function codeAddress() {
		    if(document.getElementById("address").value != ''){
		    	var gaddress = document.getElementById("address").value;
		    }else{
		    	var gaddress = '';
		    }
		    if(document.getElementById("city").value != ''){
		    	var city = ','+document.getElementById("city").value;
		    }else{
		    	var city = '';
		    }
		     if(document.getElementById("zip_code").value != ''){
		    	var zip_code = ','+document.getElementById("zip_code").value;
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
    if(address != ''){
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
			document.getElementById('latlang').value = latlong1;

			google.maps.event.addListener(myMarker, 'dragend', function(evt){
				var lat = evt.latLng.lat().toFixed(6);
				var lng = evt.latLng.lng().toFixed(6);
				var latlong = lat+","+lng;
				document.getElementById('latlang').value = latlong;
				getAddress(evt.latLng);
			});

			map.setCenter(myMarker.position);
			myMarker.setMap(map);
} else {
        alert("Geocode non è riuscita per il seguente motivo: " + status);
      }
    });
    }else{
			var myOptions = {
                center: new google.maps.LatLng(42.714732,12.128906 ),
                zoom: 18,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            geocoder = new google.maps.Geocoder();
            var map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions);

            google.maps.event.addListener(map, 'click', function(event) {
            	var lat3 = event.latLng.lat().toFixed(6);
				var lng3 = event.latLng.lng().toFixed(6);
				var latlong3 = lat3+","+lng3;
				document.getElementById('latlang').value = latlong3;
                placeMarker(event.latLng);
            });

            var marker;
            function placeMarker(location) {
                if(marker){
                    marker.setPosition(location);
                }else{
                    marker = new google.maps.Marker({
                        position: location,
                        map: map,
                        draggable: true

                    });
                      google.maps.event.addListener(marker, 'dragend', function (event) {
                      	var lat2 = this.getPosition().lat().toFixed(6);
						var lng2 = this.getPosition().lng().toFixed(6);
						var latlong2 = lat2+","+lng2;
						getAddress(this.getPosition());
						document.getElementById('latlang').value = latlong2;
					});
                    marker.setMap(map);
                }
                getAddress(location);
            }

    }
}
      function getAddress(latLng) {
        geocoder.geocode( {'latLng': latLng},
          function(results, status) {
            if(status == google.maps.GeocoderStatus.OK) {
              if(results[0]) {
                document.getElementById("address").value = results[0].formatted_address;
              }
              else {
                document.getElementById("address").value = "No results";
              }
            }
            else {
              document.getElementById("address").value = status;
            }
          });
        }
      google.maps.event.addDomListener(window, 'load', initialize);



function GPScodeAddress(){
    if(navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(callback);
	}
	else
	{
		alert("Geolocalizzazione non è supportato da questo browser.");
	}
}
function callback(position){
	var lat = position.coords.latitude.toFixed(6);
	var lng = position.coords.longitude.toFixed(6);
	var latlongdatatext = lat+','+lng;
	var latlongdata = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
	getAddress(latlongdata);
	document.getElementById('latlang').value = latlongdatatext;
}

jQuery.noConflict();
jQuery(function($){
      $('#addnew').click(function()
            {
				$('#phoneadd').append('<input type="text" name="contact_no[]" class="input-large" style="margin-top:5px;" />');
			});
});
</script>

<?php $this->load->view('common/footer'); ?>
