/*
 * Additional function for forms.html
 *	Written by ThemePixels
 *	http://themepixels.com/
 *
 *	Copyright (c) 2012 ThemePixels (http://themepixels.com)
 *
 *	Built for Katniss Premium Responsive Admin Template
 *  http://themeforest.net/category/site-templates/admin-templates
 */

jQuery(document).ready(function(){
	// Transform upload file
	//jQuery('.uniform-file').uniform();
	// Date Picker
	jQuery("#datepicker").datepicker({
		inline: true,
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		//maxDate: 0,
		firstDay: 1,
		defaultDate: "+1w",
		yearRange: "-100:+0",
	});

	//jQuery(".chzn-select").chosen();
});