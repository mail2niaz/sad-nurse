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
jQuery( "#combobox" ).combobox();
jQuery( "#combobox1" ).combobox();
jQuery( "#combobox2" ).combobox({
      select: function( event, ui ) {
      	var intval = ui.item.value;
      	var siteurl = jQuery('#siteurl').val();
      	if(jQuery('#combobox').val() == undefined){
			var patient_id = jQuery('#patient_id').val();
		}else{
			var patient_id = jQuery('#combobox').val();
		}
      	var checkpatintervent = jQuery('#checkpatintervent').val();
      	commonvalidation(siteurl,checkpatintervent,intval,patient_id,'combobox2',1);
      }
});
jQuery( "#combobox3" ).combobox({
	select: function( event, ui ) {
		var intval = ui.item.value;
		var siteurl = jQuery('#siteurl').val();
      	if(jQuery('#combobox').val() == undefined){
			var patient_id = jQuery('#patient_id').val();
		}else{
			var patient_id = jQuery('#combobox').val();
		}
      	var checkpatintervent = jQuery('#checkpatintervent').val();
      	commonvalidation(siteurl,checkpatintervent,intval,patient_id,'combobox3',2);
	}
});
jQuery( "#combobox4" ).combobox({
	select: function( event, ui ) {
		var intval = ui.item.value;
		var siteurl = jQuery('#siteurl').val();
		if(jQuery('#combobox').val() == undefined){
			var patient_id = jQuery('#patient_id').val();
		}else{
			var patient_id = jQuery('#combobox').val();
		}
      	var checkpatintervent = jQuery('#checkpatintervent').val();
      	commonvalidation(siteurl,checkpatintervent,intval,patient_id,'combobox4',3);
	}
});
jQuery( "#combobox5" ).combobox({
	select: function( event, ui ) {
		var intval = ui.item.value;
		var siteurl = jQuery('#siteurl').val();
		if(jQuery('#combobox').val() == undefined){
			var patient_id = jQuery('#patient_id').val();
		}else{
			var patient_id = jQuery('#combobox').val();
		}
      	var checkpatintervent = jQuery('#checkpatintervent').val();
      	commonvalidation(siteurl,checkpatintervent,intval,patient_id,'combobox5',4);
	}
});
jQuery( "#combobox6" ).combobox({
	select: function( event, ui ) {
		var intval = ui.item.value;
		var siteurl = jQuery('#siteurl').val();
		if(jQuery('#combobox').val() == undefined){
			var patient_id = jQuery('#patient_id').val();
		}else{
			var patient_id = jQuery('#combobox').val();
		}
      	var checkpatintervent = jQuery('#checkpatintervent').val();
      	commonvalidation(siteurl,checkpatintervent,intval,patient_id,'combobox6',5);
	}
});
jQuery( "#combobox7" ).combobox({
	select: function( event, ui ) {
		var intval = ui.item.value;
		var siteurl = jQuery('#siteurl').val();
		if(jQuery('#combobox').val() == undefined){
			var patient_id = jQuery('#patient_id').val();
		}else{
			var patient_id = jQuery('#combobox').val();
		}
      	var checkpatintervent = jQuery('#checkpatintervent').val();
      	commonvalidation(siteurl,checkpatintervent,intval,patient_id,'combobox7',6);
	}
});
jQuery( "#combobox8" ).combobox({
	select: function( event, ui ) {
		var intval = ui.item.value;
		var siteurl = jQuery('#siteurl').val();
		if(jQuery('#combobox').val() == undefined){
			var patient_id = jQuery('#patient_id').val();
		}else{
			var patient_id = jQuery('#combobox').val();
		}
      	var checkpatintervent = jQuery('#checkpatintervent').val();
      	commonvalidation(siteurl,checkpatintervent,intval,patient_id,'combobox8',7);
	}
});
jQuery( "#combobox9" ).combobox({
	select: function( event, ui ) {
		var intval = ui.item.value;
		var siteurl = jQuery('#siteurl').val();
		if(jQuery('#combobox').val() == undefined){
			var patient_id = jQuery('#patient_id').val();
		}else{
			var patient_id = jQuery('#combobox').val();
		}
      	var checkpatintervent = jQuery('#checkpatintervent').val();
      	commonvalidation(siteurl,checkpatintervent,intval,patient_id,'combobox9',8);
	}
});
jQuery( "#combobox10" ).combobox({
	select: function( event, ui ) {
		var intval = ui.item.value;
		var siteurl = jQuery('#siteurl').val();
		if(jQuery('#combobox').val() == undefined){
			var patient_id = jQuery('#patient_id').val();
		}else{
			var patient_id = jQuery('#combobox').val();
		}
      	var checkpatintervent = jQuery('#checkpatintervent').val();
      	commonvalidation(siteurl,checkpatintervent,intval,patient_id,'combobox10',9);
	}
});
jQuery( "#combobox11" ).combobox({
	select: function( event, ui ) {
		var intval = ui.item.value;
		var siteurl = jQuery('#siteurl').val();
		if(jQuery('#combobox').val() == undefined){
			var patient_id = jQuery('#patient_id').val();
		}else{
			var patient_id = jQuery('#combobox').val();
		}
      	var checkpatintervent = jQuery('#checkpatintervent').val();
      	commonvalidation(siteurl,checkpatintervent,intval,patient_id,'combobox11',10);
	}
});

jQuery( "#report_pat" ).combobox({
	select: function( event, ui ) {
		var intval = ui.item.value;
		jQuery('#pid').val(intval);
	}
});

jQuery( "#report_opt" ).combobox({
	select: function( event, ui ) {
		var intval = ui.item.value;
		jQuery('#oid').val(intval);
	}
});
jQuery( "#toggle" ).click(function() {
jQuery( "#combobox" ).toggle();
jQuery( "#combobox1" ).toggle();
jQuery( "#combobox2" ).toggle();
jQuery( "#combobox3" ).toggle();
jQuery( "#combobox4" ).toggle();
jQuery( "#combobox5" ).toggle();
jQuery( "#combobox6" ).toggle();
jQuery( "#combobox7" ).toggle();
jQuery( "#combobox8" ).toggle();
jQuery( "#combobox9" ).toggle();
jQuery( "#combobox10" ).toggle();
jQuery( "#combobox11" ).toggle();
jQuery( "#report_pat" ).toggle();
jQuery( "#report_opt" ).toggle();
});

function commonvalidation(siteurl,checkpatintervent,intval,patient_id,combobox_val,stage){
			jQuery.post(checkpatintervent,
           {intval: ""+intval+"", patient_id: ""+patient_id+""},
               function(data){
               	if(data == 'duplicate'){
               		alert("Duplicato Intervent per il paziente sopra selezionato");
	               	jQuery('#'+combobox_val).val('');
	               	jQuery('#'+combobox_val).combobox('autocomplete', '');
	               	jQuery('#int_time'+stage).val('');
	               	jQuery('#hour_id'+stage).hide();
               	}else{
               		jQuery.post(siteurl,
			           {intval: ""+intval+"", inputval: ""+stage+"", patient_id: ""+patient_id+"" },
			               function(data){
			               	if(data != ''){
			               		jQuery('#hour_id'+stage).show();
			               		jQuery('#hour_id'+stage).html(data);
			               	}else{
			               		jQuery('#hour_id'+stage).html('');
			               	}
				       });
               	}
	       });
}
});
