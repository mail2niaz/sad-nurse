jQuery(document).ready(function() {
	jQuery("#combobox1").searchable();
	jQuery("#combobox2").searchable();
	jQuery("#combobox3").searchable();
	jQuery("#combobox1").change(function(){
		var optval = this.value;
		jQuery('#val_pry_operator').val(optval);
		var aid = jQuery('#aid').val();
		var current_week = jQuery('#current_week').val();
		var action = jQuery('#action').val();
		if(action == 'new'){
			var shourcombo = jQuery('.hourcombo').val();
			var smin = jQuery('.mincombo').val();
		}else if(action == 'edit'){
			var shourcombo = jQuery('#start_hid_hour').val();
			var smin = jQuery('#start_hid_min').val();
		}
		var ehourcombo = jQuery('#end_hid_hour').val();
		var emin = jQuery('#end_hid_min').val();
		var weekdays = jQuery('#weekdays').val();
		var siteurl = jQuery('#siteurl').val();
		jQuery.post(siteurl,
		{current_week: ""+current_week+"",shourcombo: ""+shourcombo+"",smin: ""+smin+"",ehourcombo: ""+ehourcombo+"",emin: ""+emin+"",opt: ""+optval+"", weekdays: ""+weekdays+"", aid: ""+aid+"" },
		function(data){
			if(data != ''){
				jQuery('#val_pry_operator').val('');
				 jQuery('#combobox1').prop('selectedIndex',0);
				jQuery('.pry_msg').html(data);
			}else{
				jQuery('.pry_msg').html('');
			}
		});
	});


jQuery("#combobox2").change(function(){
    	var optval = this.value;
      	jQuery('#val_sec_operator').val(optval);
      	var aid = jQuery('#aid').val();
      	var current_week = jQuery('#current_week').val();
      	var action = jQuery('#action').val();
      	if(action == 'new'){
      		var shourcombo = jQuery('.hourcombo').val();
      		var smin = jQuery('.mincombo').val();
      	}else if(action == 'edit'){
      		var shourcombo = jQuery('#start_hid_hour').val();
      		var smin = jQuery('#start_hid_min').val();
      	}
		var ehourcombo = jQuery('#end_hid_hour').val();
		var emin = jQuery('#end_hid_min').val();
		var weekdays = jQuery('#weekdays').val();
		var siteurl = jQuery('#siteurl').val();
jQuery.post(siteurl,
           {current_week: ""+current_week+"",shourcombo: ""+shourcombo+"",smin: ""+smin+"",ehourcombo: ""+ehourcombo+"",emin: ""+emin+"",opt: ""+optval+"", weekdays: ""+weekdays+"", aid: ""+aid+"" },
               function(data){
               	if(data != ''){
               		jQuery('#val_sec_operator').val('');
               		jQuery('#combobox2').prop('selectedIndex',0);
               		jQuery('.sec_msg').html(data);
               	}else{
               		jQuery('.sec_msg').html('');
               	}

	       });
      });


jQuery("#combobox2").change(function(){
    	var optval = this.value;
  	jQuery('#val_sup_operator').val(optval);
      	var aid = jQuery('#aid').val();
      	var current_week = jQuery('#current_week').val();
      	var action = jQuery('#action').val();
      	if(action == 'new'){
      		var shourcombo = jQuery('.hourcombo').val();
      		var smin = jQuery('.mincombo').val();
      	}else if(action == 'edit'){
      		var shourcombo = jQuery('#start_hid_hour').val();
      		var smin = jQuery('#start_hid_min').val();
      	}
		var ehourcombo = jQuery('#end_hid_hour').val();
		var emin = jQuery('#end_hid_min').val();
		var weekdays = jQuery('#weekdays').val();
		var siteurl = jQuery('#siteurl').val();
jQuery.post(siteurl,
           {current_week: ""+current_week+"",shourcombo: ""+shourcombo+"",smin: ""+smin+"",ehourcombo: ""+ehourcombo+"",emin: ""+emin+"",opt: ""+optval+"", weekdays: ""+weekdays+"", aid: ""+aid+"" },
               function(data){
               	if(data != ''){
               		jQuery('.sup .custom-combobox-input').val('');
               		jQuery('#val_sup_operator').val('');
               		jQuery('#combobox3').prop('selectedIndex',0);
               		jQuery('.sup_msg').html(data);
               	}else{
               		jQuery('.sup_msg').html('');
               	}

	       });
    	});

});