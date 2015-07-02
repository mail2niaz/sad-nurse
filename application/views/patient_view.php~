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
               <h1><?php echo lang("PATIENT::view_patient"); ?></h1>
            </div>
        </div><!--pageheader-->
        <div class="maincontent">
            <div class="maincontentinner">
            <div class="widgetbox box-inverse span5" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo lang("PATIENT::view_patient"); ?></h4>
                <div class="widgetcontent nopadding">
                	<div class="stdform stdform2">
                            <p>
                                <label><?php echo lang("PATIENT::name"); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->pname;?></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::surname"); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->surname;?></span>
                            </p>

                            <p>
                                <label><?php echo lang("COMMON::sex"); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->sex;?></span>
                            </p>

                             <p>
                                <label><?php echo lang("PATIENT::email"); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->email;?></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::district"); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $this->common->getdistname($optval->dist_id); ?></span>
                            </p>

                            <p>
                                <label><?php echo lang("COMMON::birthday"); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo date("d/m/Y",strtotime($optval->dob));?></span>
                            </p>
                            <p>
                                <label><?php echo lang("PATIENT::provre"); ?></label>
                                <span class="field"><?php echo $optval->provre;?></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::con_no"); ?><span class="rstar">*</span></label>
                                <span class="field"><?php foreach(explode(",", $optval->contact_no) as $cont){ echo $cont."<br>"; } ?></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::ssn"); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->ssn;?></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::address"); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->address;?></textarea></span>
                            </p>
                            <p>
                                <label><?php echo lang("PATIENT::city"); ?></label>
                                <span class="field"><?php echo $optval->city;?></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::zip_code"); ?></label>
                                <span class="field"><?php echo $optval->zip_code;?></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::latlang"); ?><span class="rstar">*</span></label>
                                <span class="field"><?php echo $optval->latlang;?></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::pa_surname"); ?></label>
                                <span class="field"><?php echo $optval->pa_surname;?></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::paying"); ?></label>
                                <span class="field"><?php echo $optval->paying;?></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::pa_address"); ?></label>
                                <span class="field"><?php echo $optval->pa_address;?></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::pa_provre"); ?></label>
                                <span class="field"><?php echo $optval->pa_provre;?></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::pa_cap"); ?></label>
                                <span class="field"><?php echo $optval->pa_cap;?></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::pa_city"); ?></label>
                                <span class="field"><?php echo $optval->pa_city;?></span>
                            </p>

                            <p>
                                <label><?php echo lang("PATIENT::nas_city"); ?></label>
                                <span class="field"><?php echo $optval->nas_city;?></span>
                            </p>


                            <p>
                                <label><?php echo lang("PATIENT::note"); ?></label>
                                <span class="field"><?php echo $optval->note;?></span>
                            </p>
				<?php if($sedit == 1){ ?>
                            <p class="stdformbutton" style="text-align:right">
                            	<?php  $attributes2 = array('class' => 'btn btn-rounded btn-primary btn-submit');  echo anchor($i18n.'patient/editpatient/'.$optval->pid,'<i class="icon-link"></i>&nbsp;&nbsp;'.lang("PATIENT::edit_patient"),$attributes2); ?>
                            </p> <?php } ?>
                </div><!--widgetcontent-->
            </div><!--widget-->
</div>
<div class="span5" style="border:5px solid #97400C; margin-left: 5px;">
	<div id="map_canvas" style="width: 100%; height: 655px;"></div>
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
      	var pat_latlng = '<?php echo $optval->latlang;?>';
      	var myarr = pat_latlng.split(",");
		var myvar = myarr[0] + "," + myarr[1];
		var name = '<?php echo $optval->pname;?>';
		var address = '<?php echo $optval->address;?>';
			var myOptions = {
                center: new google.maps.LatLng(myarr[0],myarr[1]),
                zoom: 14,
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
                    draggable: false
                });
			 infoWindow.setContent(html);
            infoWindow.open(map, marker);
 			/* End */

      }
      google.maps.event.addDomListener(window, 'load', initialize);

</script>
<?php $this->load->view('common/footer'); ?>
