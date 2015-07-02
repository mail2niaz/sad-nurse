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
               <h1><?php echo lang("PATIENT::edit_patient"); ?></h1>
            </div>
        </div><!--pageheader-->
        <div class="maincontent">
            <div class="maincontentinner">

            <div class="widgetbox box-inverse span9" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo lang("PATIENT::edit_patient"); ?></h4>
                <div class="widgetcontent nopadding">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open($i18n.'patient/editpatient/'.$optval->pid,$attributes); ?>
           <?php echo form_hidden('pid',$optval->pid);
		    ?>
                            <p>
                                <label><?php echo lang("PATIENT::name"); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="pname" id="pname" class="input-large" value="<?php echo set_value('pname', $optval->pname);?>" /></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::surname"); ?><span class="rstar">*</span></label>
                                <span class="field"><input id="surname" class="input-large" type="text" name="surname" value="<?php echo set_value('surname', $optval->surname);?>"></span>
                            </p>

							<p>
                                <label><?php echo lang("COMMON::sex"); ?><span class="rstar">*</span></label>
                                <span class="field"><input class="input-large" type="radio" value="male" name="sex" <?php if(set_value('sex', $optval->sex) == 'male'){ ?> checked="checked" <?php };?>><?php echo lang("COMMON::male"); ?> &nbsp;&nbsp;
                                	<input class="input-large" type="radio" value="female" name="sex" <?php if(set_value('sex', $optval->sex) == 'female'){ ?> checked="checked" <?php };?>><?php echo lang("COMMON::female"); ?></span>
                            </p>

                             <p>
                                <label><?php echo lang("PATIENT::email"); ?></label>
                                <span class="field"><input type="text" name="email" id="email" class="input-large" value="<?php echo set_value('email', $optval->email);?>" /></span>
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
											<option value="<?=$did?>" <?php if(set_value('dist_id', $optval->dist_id) == $did){ ?> selected="selected" <?php } ?>><?=$dist_name?></option>
												<?php } }  ?>
                                </select></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::ws_code"); ?></label>
                                <span class="field"><input type="text" name="ws_code" id="ws_code" onchange="codeAddress()" class="input-large" value="<?php echo set_value('ws_code',$optval->ws_code);?>" /></span>
                            </p>

                            <p>
                                <label><?php echo lang("COMMON::birthday"); ?><span class="rstar">*</span></label>
                                <span class="field"><input id="datepicker" class="input-large" type="text" name="dob" readonly="readonly" value="<?php echo set_value('dob', date("d/m/Y",strtotime($optval->dob)));?>"></span>
                            </p>
                            <p>
                                <label><?php echo lang("PATIENT::provre"); ?></label>
                                <span class="field"><input type="text" name="provre" id="provre" class="input-large" value="<?php echo set_value('provre', $optval->provre);?>" /></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::con_no"); ?><span class="rstar">*</span></label>
                                <div class="field">
                                	<span id="phoneadd">
                                		<?php $i = 1;
                                	foreach(explode(",", $optval->contact_no) as $cont){
                                	?>
                                	<input type="text" name="contact_no[]" class="input-large d<?=$i?>" style="margin-top: 5px; width: 185px;" value="<?php echo set_value('contact_no[]', $cont);?>"/>
                                	<a href="javascript:void(0)" class="ad<?=$i?>" onclick="deletephoneno('<?=$i?>')" style="font-size: 40px; vertical-align: middle; text-decoration: none;">-</a>
                                	<?php $i++; } ?></span><br><br>
                                		<a class="btn btn-primary btn-submit" id="addnew" href="javascript:void(0)"><?php echo lang("PATIENT::add_phone_no"); ?></a>
                                </div>
                                </p>

                            <p>
                                <label><?php echo lang("PATIENT::ssn"); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="ssn" id="ssn" class="input-large" value="<?php echo set_value('ssn', $optval->ssn);?>"/></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::address"); ?><span class="rstar">*</span></label>
                                <span class="field"><textarea name="address" id="address" class="input-large"><?php echo set_value('address', $optval->address);?></textarea>
                                	<input type="button" value="<?php echo lang("PATIENT::map"); ?>" name="pickmap" onclick="codeAddress()" class="btn-submit btn-primary"/>
                                	<input type="button" value="<?php echo lang("PATIENT::gps"); ?>" name="gps" onclick="GPScodeAddress()" class="btn-submit btn-primary" />
                                </span>
                            </p>

							<p>
                                <label><?php echo lang("PATIENT::city"); ?></label>
                                <span class="field"><input type="text" name="city" id="city" onchange="codeAddress()" class="input-large" value="<?php echo set_value('city', $optval->city);?>" /></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::zip_code"); ?></label>
                                <span class="field"><input type="text" name="zip_code" id="zip_code" onchange="codeAddress()" class="input-large" value="<?php echo set_value('zip_code', $optval->zip_code);?>"/></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::latlang"); ?><span class="rstar">*</span></label>
                                <span class="field"><input type="text" name="latlang" id="latlang" class="input-large" value="<?php echo set_value('latlang', $optval->latlang);?>" readonly="readonly" /></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::pa_surname"); ?></label>
                                <span class="field"><input type="text" name="pa_surname" id="pa_surname" class="input-large" value="<?php echo set_value('pa_surname', $optval->pa_surname);?>" /></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::paying"); ?></label>
                                <span class="field"><input type="text" name="paying" id="paying" class="input-large" value="<?php echo set_value('paying', $optval->paying);?>" /></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::pa_address"); ?></label>
                                <span class="field"><textarea name="pa_address" id="pa_address" class="input-large"><?php echo set_value('pa_address', $optval->pa_address);?></textarea></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::pa_provre"); ?></label>
                                <span class="field"><input type="text" name="pa_provre" id="pa_provre" class="input-large" value="<?php echo set_value('pa_provre', $optval->pa_provre);?>" /></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::pa_cap"); ?></label>
                                <span class="field"><input type="text" name="pa_cap" id="pa_cap" class="input-large" value="<?php echo set_value('pa_cap', $optval->pa_cap);?>" /></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::pa_city"); ?></label>
                                <span class="field"><input type="text" name="pa_city" id="pa_city" class="input-large" value="<?php echo set_value('pa_city', $optval->pa_city);?>" /></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::nas_city"); ?></label>
                                <span class="field"><input type="text" name="nas_city" id="nas_city" class="input-large" value="<?php echo set_value('nas_city', $optval->nas_city);?>" /></span>
                            </p>


                            <p>
                                <label><?php echo lang("PATIENT::note"); ?></label>
                                <span class="field"><textarea name="note" id="note" class="input-large"><?php echo set_value('note', $optval->note);?></textarea></span>
                            </p>

                            <p class="stdformbutton" style="text-align:right">
                            	<input type="submit" class="btn btn-primary btn-submit" name="mysubmit" value="<?php echo lang("COMMON::sub_btn"); ?>">
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo lang("COMMON::reset_btn"); ?></button>
                            </p>
<?php echo form_close(); ?>
                </div><!--widgetcontent-->
            </div><!--widget-->

	<div id="map_canvas"></div>

            </div><!--maincontentinner-->
        </div><!--maincontent-->

    </div><!--rightpanel-->

</div><!--mainwrapper-->
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>

<!--
<script type="text/javascript">
 var map;
      var geocoder;
      var mapOptions = { center: new google.maps.LatLng(0.0, 0.0), zoom: 2,
        mapTypeId: google.maps.MapTypeId.ROADMAP };

      function initialize() {
      	var pat_latlng = '<?php echo $optval->latlang;?>';
      	var myarr = pat_latlng.split(",");
		var myvar = myarr[0] + "," + myarr[1];
		var name = '<?php echo $optval->pname;?>';
		var address = '<?php echo $optval->address;?>';
			var myOptions = {
                center: new google.maps.LatLng(myarr[0],myarr[1]),
                zoom: 18,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            geocoder = new google.maps.Geocoder();
            var map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions);

            /* Onload Map */

             var infoWindow = new google.maps.InfoWindow();
            var point = new google.maps.LatLng( parseFloat(myarr[0]), parseFloat(myarr[1]));

                var html = "<b>" + name + "</b> <br/>" + address;

                var marker = new google.maps.Marker(
                {
                    map: map,
                    position: point,
                    //draggable: true
                });

 			/* End */

            google.maps.event.addListener(map, 'click', function(event) {
            	var lat3 = event.latLng.lat().toFixed(6);
				var lng3 = event.latLng.lng().toFixed(6);
				var latlong3 = lat3+","+lng3;
				var infoWindow = "";
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
                      	var lat2 = this.getPosition().lat().toFixed(4);
						var lng2 = this.getPosition().lng().toFixed(4);
						var latlong2 = lat2+","+lng2;
						getAddress(this.getPosition());
						document.getElementById('latlang').value = latlong2;
					});
                    marker.setMap(map);
                }
                getAddress(location);
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
      }


        function codeAddress() {
        	var infoWindow = "";
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

    var address = gaddress+city+zip_code;
    //var address = document.getElementById("address").value;
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
				getAddress1(evt.latLng);
			});

			map.setCenter(myMarker.position);
			myMarker.setMap(map);
} else {
        alert("Geocode non è riuscita per il seguente motivo: " + status);
      }
    });
}



</script>-->


<script type="text/javascript">
      	var pat_latlng = '<?php echo $optval->latlang;?>';
      	var myarr = pat_latlng.split(",");
		var myvar = myarr[0] + "," + myarr[1];
		var name = '<?php echo $optval->pname;?>';
		var address = '<?php echo $optval->address;?>';
			var myOptions = {
                center: new google.maps.LatLng(myarr[0],myarr[1]),
                zoom: 18,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            geocoder = new google.maps.Geocoder();
            var map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions);

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
$('#phoneadd').append('<input type="text" name="contact_no[]" class="input-large" style="margin-top: 5px; width: 185px;" />');
});
});

function deletephoneno (dval) {

  $target = jQuery('.d'+dval);
    $target.toggleClass('open');
      var disable = ( $target.hasClass('open') ) ? true: false;
     jQuery('.d'+dval).attr("disabled", "disabled");
     jQuery('.d'+dval).css("display", "none");
     jQuery('.ad'+dval).css("display", "none");
}
</script>
<?php $this->load->view('common/footer'); ?>
