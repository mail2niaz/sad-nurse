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
.attr( "title", "Mostra tutti" )
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
   jQuery( "#filter_operator" ).combobox();
   jQuery( "#filter_patient" ).combobox();
   jQuery( "#filter_district" ).combobox();
      jQuery( "#filter_plan_unplan" ).combobox();
      jQuery( "#filter_box_status" ).combobox();
jQuery( "#patient_id" ).combobox({
      select: function( event, ui ) {
      	var pat_id = ui.item.value;
		var fetch_patient_intervent =  jQuery('#fetch_patient_intervent').val();
		jQuery.post(fetch_patient_intervent,
			{pat_id: ""+pat_id+""},
   		function(data){
           	jQuery('#filter_district').html('');
           	jQuery('#filter_district').combobox('autocomplete', '');
            jQuery('#filter_district').html(data);
   		});
      }
      });
jQuery( "#toggle" ).click(function() {
jQuery( "#filter_operator" ).toggle();
jQuery( "#filter_patient" ).toggle();
jQuery( "#filter_district" ).toggle();
jQuery( "#filter_plan_unplan" ).toggle();
jQuery( "#filter_box_status" ).toggle();
});
});
