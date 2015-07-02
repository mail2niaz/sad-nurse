<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

        <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
            <div class="pagetitle">
               <h1><?php echo ( sprintf( lang("REPORT::barchart")) ); ?></h1>
            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">
            	<div class="widgetbox box-inverse span10" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo ( sprintf( lang("REPORT::barchart")) ); ?></h4>
                <div class="widgetcontent nopadding">
                	 <?php
                	 if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>
                	 <?php if(isset($msg)){ ?> <div class="alert alert-info"><?php echo $msg; ?></div><?php } ?>

           <?php $attributes = array('class' => 'stdform stdform2');
           echo form_open($i18n.'report/showchartreport',$attributes); ?>

                            <p>
                                <label><?php echo ( sprintf( lang("REPORT::year")) ); ?><span class="rstar">*</span></label>
                                <span class="field"><select name="year" id="year" class="uniformselect">
                                    <option value="">-- <?php echo ( sprintf( lang("REPORT::year")) ); ?> --</option>
                                    <?php for( $i = 2000; $i< 2050; $i++){ ?>
 										<option value="<?=$i?>"><?=$i?></option>
                                   <?php } ?>
                                   </select></span>
                            </p>
                            <p class="stdformbutton" style="text-align:right">
                                <button class="btn btn-primary btn-submit"><?php echo ( sprintf( lang("COMMON::sub_btn")) ); ?></button>
                                <button type="reset" class="btn" style="margin-right:75px"><?php echo ( sprintf( lang("COMMON::reset_btn")) ); ?></button>
                            </p>
<?php echo form_close(); ?>
                </div><!--widgetcontent-->
                <?php if(isset($rep)){ ?>
	<!--Search Result -->
<div class="widgetbox box-inverse span10 search_result" style="margin-left: 5px;">
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto">
<?php foreach($bar_report as $breport){
	$mon[] = "'".$breport->month."'";
	$val[] = $breport->pcnt;
}
$mon_name = implode(",", $mon);
$pcnt = implode(",", $val);
if($year != ""){
	$selyear = "for - ".$year;
}else{
	$selyear = "";
}
?>
</div>
<script>
jQuery(function () {
        jQuery('#container').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: '<?php echo ( sprintf( lang("REPORT::patient_annual_report")) ); ?> <?=$selyear?>'
            },
            xAxis: {
                categories: [<?=$mon_name?>],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Patient (count)',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' Patient'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor: '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                data: [<?=$pcnt?>]
            }]
        });
    });

</script>
</div><!--Search Result -->
<?php } ?>
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
<?php $this->load->view('common/footer'); ?>