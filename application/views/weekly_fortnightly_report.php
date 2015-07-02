<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

        <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
            <div class="pagetitle">
               <h1><?php echo lang("JOBASSIGN-WF::week_fortnight_report"); ?></h1>
            </div>

        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">
            	<div class="widgetbox box-inverse span10" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo lang("JOBASSIGN-WF::week_fortnight_report"); ?></h4>
                <div class="widgetcontent nopadding">
 <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open('',$attributes); ?>
           <div class="stdform stdform2">
           	<p>
                                <label><?php echo lang("REPORT::dname"); ?></label>
                                <span class="field">
                                	<select id="filter_district" name="filter_district">
							<option value="0" selected="selected"><?php echo lang("COMMON::choose_one"); ?></option>
                            <?php $dist = $this->common->districtlist_new();
							if(count($dist) > 0){
                             foreach($dist as $dist_list){
                            	$did = $dist_list->did;
								$dist_name = $dist_list->dist_name;?>
								<option value="<?=$did?>"><?=$dist_name?></option>
                          	<?php } }else{ ?>
								<option value=""><?php echo lang('INTERVENT::dataempty'); ?></option>
                        	<?php } ?>
							</select></span>
                            </p>
							<p>
                                <label><?php echo lang("JOBASSIGN-WF::choose_report_type"); ?><span class="rstar">*</span></label>
                                <span class="field">
									<select name="report_type" id="report_type">
										<option value=""><?php echo lang("JOBASSIGN::select"); ?></option>
										<option value="1"><?php echo lang("JOBASSIGN-WF::week_report"); ?></option>
										<option value="2"><?php echo lang("JOBASSIGN-WF::forthnight_report"); ?></option>
									</select>
                                </span>
                            </p>
                            <p>
                                <label><?php echo lang("JOBASSIGN-WF::choose_week"); ?></label>
                                <span class="field">
									<?php $start = array();
									
									/* $week = date("W");
									$year = date("Y");
									for($w = $week-10; $w <= $week + 10; $w++){
									for($d = 1; $d <= 7; $d++){
										if($d == 1){
											$start[$w]['start'] = date("d/m/Y", strtotime($year."W".$w.$d));
										}
										if($d == 7){
											$start[$w]['end'] = date("d/m/Y", strtotime($year."W".$w.$d));
										}
									}
									}  
									<select name="weekno" id="weekno">
										<option value="">--<?php echo lang("JOBASSIGN::select_designation_week"); ?>--</option>
										<?php foreach($start as $key=>$value){ ?>
										<option value="<?=$key?>"><?php echo $value['start']." - ".$value['end']; ?></option>
										<?php }*/
										 ?>
										 <select name="weekno" id="weekno">
				<option value="">--<?php echo lang("JOBASSIGN::select_designation_week"); ?>--</option>					
				<?php
                        $week_nav = date("W");
                        $year_nav_week = date("Y");
                        
                        if($week == '01') {
                             $year_nav =  $year_nav_week;
                        } else {
                             
                             $year_nav =  $year_nav_week + 0;
                        }
                        $gendate = new DateTime();
                        $gendate->setISODate($year_nav,$week_nav); //year , week num , day
                        $getweek_date = $gendate->format('d-m-Y');
                        //Get unix time of today
                        $today = strtotime($getweek_date);
                       for($i = 0; $i <= 160; $i++){
                        $startdate = strtotime("$getweek_date + $i day - 45 day");
                        $enddate = strtotime($getweek_date . ($i + 6) . " day - 45 day ");

                        if(date('D', $startdate) == 'Mon'){
                        echo '<option ';
                        // check to see if today is inside this week
                        if( $startdate < $today && $enddate > $today ){
                        echo ' selected="selected"';
                        }
                        $week_nav = date('W', $startdate);
                        $year_nav = date('Y', $enddate);          
                        echo ' value="'.$week_nav.'#'.$year_nav.'">' .date('d/m/Y', $startdate) . " - " . date('d/m/Y', $enddate) . "</option>";

                        }
                        }
				?>
									</select></span>
                            </p>
                            <p>
                                <label><?php echo lang("JOBASSIGN-WF::type_view"); ?><span class="rstar">*</span></label>
                                <span class="field">
									<select name="view_type" id="view_type">
										<option value="1" selected="selected"><?php echo lang("JOBASSIGN-WF::show_all"); ?></option>
										<option value="2"><?php echo lang("JOBASSIGN-WF::show_miss_intervent"); ?></option>
										<option value="3"><?php echo lang("JOBASSIGN-WF::show_intervent_more"); ?></option>
									</select>
                                </span>
                            </p>

                            <p class="stdformbutton" style="text-align:right">
                            <input type="button" value="<?php echo lang("COMMON::sub_btn"); ?>" style="height: 33px; margin-top: -5px;" class="btnSubmit btn btn-primary btn-submit"/>

                                <button type="reset" class="btn" style="margin-right:75px"><?php echo lang("COMMON::reset_btn"); ?></button>
                            </p>
<?php echo form_close(); ?>
                </div><!--widgetcontent-->
            </div>

<!--Search Result -->
<div class="widgetbox box-inverse span10 search_result" style="margin-left: 5px;">

</div><!--Search Result -->

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
 <script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.search_result').hide();
	jQuery('.btnSubmit').click(function(){
      var report_type = jQuery('#report_type').val();
      var weekno = jQuery('#weekno').val();
      var view_type = jQuery('#view_type').val();
      var filter_district = jQuery('#filter_district').val();
       var weekno = jQuery('#weekno').val();
      var split_week = weekno.split('#');
      var week = split_week[0];
      var year = split_week[1];

if(report_type == '1' || report_type == '2'){
if(weekno != ''){
		var valid = '1';
}else{
	var valid = '2';
	var message = '<?php echo lang("JOBASSIGN-WF::select_week_no"); ?>';
}
}else{
	var valid = '2';
	var message = '<?php echo lang("JOBASSIGN-WF::select_report_type"); ?>';
}
var url = "<?php echo site_url($i18n.'jobassign2/get_weekly_fortnightly_report') ?>/"+report_type+"/"+week+"/"+year+"/"+view_type+"/"+filter_district;
if(valid == '1'){
	 jQuery.ajax({
	 type: "POST",
	 url: url,
	 success: function(msg)
	 {
	 	jQuery('.search_result').show();
		jQuery('.search_result').html(msg);
	 }
	 });
	 }else{
		 alert(message);
	 }
 });
 });
</script>
<?php $this->load->view('common/footer'); ?>
