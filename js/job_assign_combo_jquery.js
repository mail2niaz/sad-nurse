(function( jQuery ) {
jQuery.widget( "custom.combobox", {
_create: function() {
this.wrapper = jQuery( "<span>" )
.addClass( "custom-combobox" )
.insertAfter( this.element );
this.element.hide();
this._createAutocomplete();
this._createShowAllButton();
},
_createAutocomplete: function() {
var selected = this.element.children( ":selected" ),
value = selected.val() ? selected.text() : "";
this.input = jQuery( "<input>" )
.appendTo( this.wrapper )
.val( value )
.attr( "title", "" )
.addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
.autocomplete({
delay: 0,
minLength: 0,
source: jQuery.proxy( this, "_source" )
})
.tooltip({
tooltipClass: "ui-state-highlight"
});
this._on( this.input, {
autocompleteselect: function( event, ui ) {
	//alert(ui.item.value);
ui.item.option.selected = true;
this._trigger( "select", event, {
item: ui.item.option
});

},
autocompletechange: "_removeIfInvalid"
});
},
_createShowAllButton: function() {
var input = this.input,
wasOpen = false;
jQuery( "<a>" )
.attr( "tabIndex", -1 )
.attr( "title", "Mostra tutti gli articoli" )
.tooltip()
.appendTo( this.wrapper )
.button({
icons: {
primary: "ui-icon-triangle-1-s"
},
text: false
})
.removeClass( "ui-corner-all" )
.addClass( "custom-combobox-toggle ui-corner-right" )
.mousedown(function() {
wasOpen = input.autocomplete( "widget" ).is( ":visible" );
})
.click(function() {
input.focus();
// Close if already visible
if ( wasOpen ) {
return;
}
// Pass empty string as value to search for, displaying all results
input.autocomplete( "search", "" );
});
},
_source: function( request, response ) {
var matcher = new RegExp( jQuery.ui.autocomplete.escapeRegex(request.term), "i" );
response( this.element.children( "option" ).map(function() {
var text = jQuery( this ).text();
if ( this.value && ( !request.term || matcher.test(text) ) )
return {
label: text,
value: text,
option: this
};
}) );
},
_removeIfInvalid: function( event, ui ) {

// Selected an item, nothing to do
if ( ui.item ) {
return;
}
// Search for a match (case-insensitive)
var value = this.input.val(),
valueLowerCase = value.toLowerCase(),
valid = false;

this.element.children( "option" ).each(function() {
if ( jQuery( this ).text().toLowerCase() === valueLowerCase ) {
this.selected = valid = true;
return false;
}
});

// Found a match, nothing to do
if ( valid ) {
return;
}
// Remove invalid value
this.input
.val( "" )
.attr( "title", value + " non corrisponde ad alcuna voce" )
.tooltip( "open" );
this.element.val( "" );

this._delay(function() {
this.input.tooltip( "close" ).attr( "title", "" );
}, 2500 );
this.input.data( "ui-autocomplete" ).term = "";
},
_destroy: function() {
this.wrapper.remove();
this.element.show();
},
autocomplete : function(value) {
        this.element.children( "option" ).each(function() {
		if ( jQuery( this ).text().toLowerCase() === value.toLowerCase() ) {
			this.selected = valid = true;
			return false;
			}
		});
        this.input.val(value);
    }
});
})( jQuery );

jQuery(function() {
      jQuery( "#pry_operator" ).combobox({
      select: function( event, ui ) {
      	var optval = ui.item.value;
      	jQuery('#val_pry_operator').val(optval);
      	jQuery("#distric").val(optval);
      	var aid = jQuery('#aid').val();
      	//var current_week = jQuery('#current_week').val();
      	var action = jQuery('#action').val();
      	if(action == 'new'){
      		var shourcombo = jQuery('.hourcombo').val();
      		var smin = jQuery('.mincombo').val();
      	}else if(action == 'edit'){
      		var shourcombo = jQuery('#start_hid_hour').val();
      		var smin = jQuery('#start_hid_min').val();
      	}
		var ehourcombo = jQuery('#endhourcombo').val();
		var emin = jQuery('#endmincombo').val();
		var job_date_assign = jQuery('#job_date_assign').val();
		var siteurl = jQuery('#siteurl').val();
jQuery.post(siteurl,
           {shourcombo: ""+shourcombo+"",smin: ""+smin+"",ehourcombo: ""+ehourcombo+"",emin: ""+emin+"",opt: ""+optval+"", aid: ""+aid+"", job_date_assign: ""+job_date_assign+"" },
               function(data){
                //alert(data);
               	if(data != ''){
               		jQuery('.pry .custom-combobox-input').val('');
               		jQuery('#val_pry_operator').val('');
               		jQuery('#pry_operator').val('');
               		jQuery('.pry_msg').html(data);
               	}else{
               		jQuery('.pry_msg').html('');
               	}

	       });
	       var get_pat_id = jQuery('#patient_id').val();
             var check_distric = jQuery('#get_distric').val();
             jQuery.post(check_distric,
           {get_pat_id: ""+get_pat_id+""},
               function(data){
                //alert(data);
               	if(data) {
                        $("#distric").val(data);
	        }

	       });
      }
      });

jQuery( "#sec_operator" ).combobox({
      select: function( event, ui ) {
    	var optval = ui.item.value;
      	jQuery('#val_sec_operator').val(optval);
      	var aid = jQuery('#aid').val();
      	//var current_week = jQuery('#current_week').val();
      	var action = jQuery('#action').val();
      	if(action == 'new'){
      		var shourcombo = jQuery('.hourcombo').val();
      		var smin = jQuery('.mincombo').val();
      	}else if(action == 'edit'){
      		var shourcombo = jQuery('#start_hid_hour').val();
      		var smin = jQuery('#start_hid_min').val();
      	}
		var ehourcombo = jQuery('#endhourcombo').val();
		var emin = jQuery('#endmincombo').val();
		var job_date_assign = jQuery('#job_date_assign').val();
		//var weekdays = jQuery('#weekdays').val();
		var siteurl = jQuery('#siteurl').val();
jQuery.post(siteurl,
           {shourcombo: ""+shourcombo+"",smin: ""+smin+"",ehourcombo: ""+ehourcombo+"",emin: ""+emin+"",opt: ""+optval+"", aid: ""+aid+"", job_date_assign: ""+job_date_assign+"" },
               function(data){
               	if(data != ''){
               		jQuery('.sec .custom-combobox-input').val('');
               		jQuery('#val_sec_operator').val('');
               		jQuery('#sec_operator').val('');
               		jQuery('.sec_msg').html(data);
               	}else{
               		jQuery('.sec_msg').html('');
               	}

	       });
      }
      });

jQuery( "#sup_operator" ).combobox({
      select: function( event, ui ) {
      	var optval = ui.item.value;
      	jQuery('#val_sup_operator').val(optval);
      	var aid = jQuery('#aid').val();
      	//var current_week = jQuery('#current_week').val();
      	var action = jQuery('#action').val();
      	if(action == 'new'){
      		var shourcombo = jQuery('.hourcombo').val();
      		var smin = jQuery('.mincombo').val();
      	}else if(action == 'edit'){
      		var shourcombo = jQuery('#start_hid_hour').val();
      		var smin = jQuery('#start_hid_min').val();
      	}
		var ehourcombo = jQuery('#endhourcombo').val();
		var emin = jQuery('#endmincombo').val();
		var job_date_assign = jQuery('#job_date_assign').val();
		//var weekdays = jQuery('#weekdays').val();
		var siteurl = jQuery('#siteurl').val();
jQuery.post(siteurl,
           {shourcombo: ""+shourcombo+"",smin: ""+smin+"",ehourcombo: ""+ehourcombo+"",emin: ""+emin+"",opt: ""+optval+"", aid: ""+aid+"", job_date_assign: ""+job_date_assign+"" },
               function(data){
               	if(data != ''){
               		jQuery('.sup .custom-combobox-input').val('');
               		jQuery('#val_sup_operator').val('');
               		jQuery('#sup_operator').val('');
               		jQuery('.sup_msg').html(data);
               	}else{
               		jQuery('.sup_msg').html('');
               	}

	       });
      }
      });
jQuery( "#patient_id" ).combobox({
      select: function( event, ui ) {
      	var pat_id = ui.item.value;
		var fetch_patient_intervent =  jQuery('#fetch_patient_intervent').val();
		jQuery.post(fetch_patient_intervent,
			{pat_id: ""+pat_id+""},
   		function(data){
	        jQuery('#hourcombo').val('');
       		jQuery('#mincombo').val('');
       		jQuery('#endhourcombo').val('');
		    jQuery('#endmincombo').val('');
       		//jQuery('#end_time').val('');
       		jQuery('#end_hid_hour').val('');
       		jQuery('#end_hid_min').val('');
           	jQuery('#intervent_type').html('');
           	jQuery('#intervent_type').combobox('autocomplete', '');
            jQuery('#intervent_type').html(data);
   		});
      }
      });
jQuery( "#intervent_type" ).combobox({
      select: function( event, ui ) {
			var int_id = ui.item.value;
	      	var pat_id = jQuery('#patient_id').val();
      		var intervent_type = jQuery('#intervent_type').val();
	        var check_no_contract_job =  jQuery('#check_no_contract_job').val();
	      	var fetch_all_data =  jQuery('#fetch_all_data').val();
	      	if(pat_id != undefined) {
	              	jQuery.post(fetch_all_data,
	                   {int_id: ""+int_id+"", pat_id: ""+pat_id+""},
                       function(data){
                       		jQuery('#hourcombo').val('');
                       		jQuery('#mincombo').val('');
                       		jQuery('#endhourcombo').val('');
		            		jQuery('#endmincombo').val('');
                       		//jQuery('#end_time').val('');
                       		jQuery('#end_hid_hour').val('');
                       		jQuery('#end_hid_min').val('');
                       		jQuery('.putalldata').html('');
	                       	jQuery('.putalldata').html(data);
                       });
               }
               if(pat_id != undefined && intervent_type != undefined ) {
                        jQuery.post(check_no_contract_job,
	                        {pat_id: ""+pat_id+"", intervent_type: ""+intervent_type+""},
	                        function(data){
                                       $("#count_contract_job").val(data); 
	                        });
                             
                  
                  }
      }
});

jQuery( "#reassign_opt" ).combobox({
      select: function( event, ui ) {
      	var optval = ui.item.value;
      	var shourcombo = jQuery('#shour').val();
      	var smin = jQuery('#smin').val();
		var ehourcombo = jQuery('#ehour').val();
		var emin = jQuery('#emin').val();
		var job_date_assign = jQuery('#job_date_assign').val();
		var siteurl = jQuery('#siteurl').val();
		var siteurl = jQuery('#siteurl').val();
		var aid = '';
jQuery.post(siteurl,
           {shourcombo: ""+shourcombo+"",smin: ""+smin+"",ehourcombo: ""+ehourcombo+"",emin: ""+emin+"",opt: ""+optval+"", aid: ""+aid+"", job_date_assign: ""+job_date_assign+"" },
               function(data){
               	if(data != ''){
               		jQuery('.optassign .custom-combobox-input').val('');
               		jQuery('#reassign_opt').val('');
               		jQuery('.error_msg').html(data);
               	}else{
               		jQuery('.error_msg').html('');
               	}

	       });
      }
      });
      
/*Check operator available for copy operator*/
jQuery( "#pry_reassign_opt" ).combobox({
      select: function( event, ui ) {
      	var optval = ui.item.value;
      	var count = $('[class^=shour_]').length;
      	var siteurl = jQuery('#siteurl').val();
		var siteurl = jQuery('#siteurl').val();
		var job_date_assign = jQuery('#job_date_assign').val();
		var flag = 1;
		/* Get array value in checkbox*/
            var selchbox = []; 
            // gets all the input tags in frm, and their number
            var inpfields = document.getElementsByName("copy_check[]");
            var nr_inpfields = inpfields.length;
            for(var i=0; i<nr_inpfields; i++) {
                  if(inpfields[i].type == 'checkbox' && inpfields[i].checked == true) 
                  selchbox.push(inpfields[i].value);
            }
		for(var j = 1; j <= count; j++ ) {
            	var shourcombo = jQuery('.shour_'+j).val();
            	var smin = jQuery('.smin_'+j).val();
		      var ehourcombo = jQuery('.ehour_'+j).val();
		      var emin = jQuery('.emin_'+j).val();
		      var aid = '';
                  var aid_job = jQuery('.aid_'+j).val();
                  if($.inArray(aid_job, selchbox )>=0){
                        $.ajax({
				      url: siteurl,
				      type: 'POST',
				      async: false,
				      data: 'shourcombo=' + shourcombo + '&smin=' + smin + '&ehourcombo=' + ehourcombo + '&emin=' + emin + '&opt=' + optval + '&aid=' + aid + '&job_date_assign=' + job_date_assign,
				      success: function(data) {
					      if(data != ''){
                                 		jQuery('.optassign .custom-combobox-input').val('');
                                 		jQuery('#pry_reassign_opt').val('');
                                 		//jQuery('#job_date_assign').val('');
                                 		jQuery('.error_msg').html(data);
                                 		flag = 0;
                                 		event.preventDefault();
                           	}
				      }
			      });
		      }
	     }
	     if(flag == 1) {
	          jQuery('.error_msg').html('');  
	     }
      }
      
});
jQuery( ".sec_operator" ).combobox({
      select: function( event, ui ) {
            var optval = ui.item.value;
            var count = $('[class^=shour_]').length;
            var siteurl = jQuery('#siteurl').val();
            var siteurl = jQuery('#siteurl').val();
            var job_date_assign = jQuery('#job_date_assign').val();
            var flag = 1;
            /* Get array value in checkbox*/
            var selchbox = []; 
            // gets all the input tags in frm, and their number
            var inpfields = document.getElementsByName("copy_check[]");
            var nr_inpfields = inpfields.length;
            for(var i=0; i<nr_inpfields; i++) {
                  if(inpfields[i].type == 'checkbox' && inpfields[i].checked == true) 
                  selchbox.push(inpfields[i].value);
            }
		for(var j = 1; j <= count; j++ ) {
            	var shourcombo = jQuery('.shour_'+j).val();
            	var smin = jQuery('.smin_'+j).val();
		      var ehourcombo = jQuery('.ehour_'+j).val();
		      var emin = jQuery('.emin_'+j).val();
		      var aid = '';
		      var aid_job = jQuery('.aid_'+j).val();
		      if($.inArray(aid_job, selchbox )>=0){
                        $.ajax({
				      url: siteurl,
				      type: 'POST',
				      async: false,
				      data: 'shourcombo=' + shourcombo + '&smin=' + smin + '&ehourcombo=' + ehourcombo + '&emin=' + emin + '&opt=' + optval + '&aid=' + aid + '&job_date_assign=' + job_date_assign,
				      success: function(data) {
					      if(data != ''){
                                 		jQuery('.sec_opertor .custom-combobox-input').val('');
                                 		jQuery('#sec_operator').val('');
                                 		//jQuery('#job_date_assign').val('');
                                 		jQuery('.error_msg_sec').html(data);
                                 		event.preventDefault();
                                 		flag =0;
                           	} 
				      }
			      });
		     }
	     }
	      if(flag == 1) {
	          jQuery('.error_msg_sec').html('');  
	     }
      }
});
jQuery( "#move_opt" ).combobox({
      select: function( event, ui ) {
      	var optval = ui.item.value;
      	var shourcombo = jQuery('#shour').val();
      	var smin = jQuery('#smin').val();
		var ehourcombo = jQuery('#ehour').val();
		var emin = jQuery('#emin').val();
		var job_date_assign = '';
		var siteurl = jQuery('#siteurl').val();
		var aid = '';
		var actionfrom = "move";
		var moveweek = jQuery('#moveweek').val();
		var moveyear = jQuery('#moveyear').val();
jQuery.post(siteurl,
           {shourcombo: ""+shourcombo+"",smin: ""+smin+"",ehourcombo: ""+ehourcombo+"",emin: ""+emin+"",opt: ""+optval+"", aid: ""+aid+"", job_date_assign: ""+job_date_assign+"", actionfrom: ""+actionfrom+"", moveweek: ""+moveweek+"",moveyear: ""+moveyear+"" },
               function(data){
               	if(data != ''){
               		jQuery('.sec .custom-combobox-input').val('');
               		jQuery('#move_opt').val('');
               		jQuery('.error_msg').html(data);
               	}else{
               		jQuery('.error_msg').html('');
               	}

	       });
      }
      });

jQuery( "#toggle" ).click(function() {
jQuery( "#pry_operator" ).toggle();
jQuery( "#sec_operator" ).toggle();
jQuery( "#sup_operator" ).toggle();
jQuery( "#patient_id" ).toggle();
jQuery( "#intervent_type" ).toggle();
jQuery( "#move_opt" ).toggle();
});
});
