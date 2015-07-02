<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?=$this->config->item('title')?></title>

<style type="text/css">
@import url("<?php echo base_url()?>css/style_default_custom_lightbox.php");
</style>
<?php $current_menu = $this->router->fetch_class();?>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-1.9.1.min.js"></script>
<script src="<?php echo base_url()?>js/lightbox.js"></script>
<?php $current_sub_menu = $this->router->fetch_method();

$limitjs_main = array('jobassign');
$limitjs_sub = array('addcontract','editcontract','addcontract_details','patient_intervent_report','jobassign_report','manual_intervent');

if(!in_array($current_menu, $limitjs_main)){
	if(!in_array($current_sub_menu, $limitjs_sub)){ ?>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui-1.10.3.min.js"></script>
<?php } } ?>
<?php if($i18n == ""){ ?>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.ui.datepicker-it.js"></script>
<?php }else{ ?>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.ui.datepicker.js"></script>
<?php } ?>
<script type="text/javascript" src="<?php echo base_url()?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.dataTables.columnFilter.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.autogrow-textarea.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/charCount.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/forms.js"></script>
<?php if( $current_menu == "report") { ?>
<script src="<?php echo base_url()?>js/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<?php } ?>
<!-- File Upload JS -->
<?php
$footlimitjs_sub = array('addcontract','editcontract','addcontract_details','addpatientinfo','editpatientinfo');
if(in_array($current_sub_menu, $footlimitjs_sub)){ ?>
<script src="<?php echo base_url(); ?>js/jquery.MultiFile.min.js" type="text/javascript" language="javascript"></script><?php } ?>
<!-- File Upload JS -->
<script type="text/javascript" src="<?php echo base_url()?>js/custom.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/define.datatables.js"></script>
<?php if($current_sub_menu == 'operatorcalendar'){ ?>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui.multidatespicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/mdp.css"><?php } ?>
</head>
