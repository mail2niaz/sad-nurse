<?php $this->load->view('common/head'); ?>
<body>

<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>

    <div class="rightpanel">

        <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
            <div class="pagetitle">
               <h1><?php echo ( sprintf( lang("REPORT::piechart")) ); ?></h1>
            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">
            	<div class="widgetbox box-inverse span10" style="margin-left: 5px;">
                <h4 class="widgettitle"><?php echo ( sprintf( lang("REPORT::piechart")) ); ?></h4>
                <div class="widgetcontent nopadding">

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<script>
	jQuery(function () {
    jQuery('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: '<?php echo ( sprintf( lang("REPORT::role_based_report")) ); ?>'
        },
        tooltip: {
    	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            type: 'pie',
            name: '<?php echo ( sprintf( lang("REPORT::total_pat")) ); ?>',
            data: [
					<?php foreach($pie_data as $pdata){ ?>
	['<?php echo $pdata->firstname; ?>',   <?php echo $pdata->cntpatient; ?>],
<?php } ?>


            ]
        }]
    });
});


</script>
                </div><!--widgetcontent-->
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