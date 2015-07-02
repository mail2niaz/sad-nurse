jQuery.noConflict();

jQuery(document).ready(function(){
		if(jQuery(window).width() < 480) {
			jQuery('.header .logo').css({width: 210});
			jQuery('.logo a').css({width: 210});
			jQuery('.logo a img').css({width: 210});
		 }

	// dropdown in leftmenu
	jQuery('.leftmenu .dropdown > a').click(function(){

		if(!jQuery(this).next().is(':visible'))
			jQuery(this).next().slideDown('fast');
		else
			jQuery(this).next().slideUp('fast');
		return false;
	});


	if(jQuery.uniform)
	   jQuery('input:checkbox, input:radio, .uniform-file').uniform();

	if(jQuery('.widgettitle .close').length > 0) {
		  jQuery('.widgettitle .close').click(function(){
					 jQuery(this).parents('.widgetbox').fadeOut(function(){
								jQuery(this).remove();
					 });
		  });
	}


   // add menu bar for phones and tablet
   jQuery('<div class="topbar"><div class="chatmenu"></a></div>').insertBefore('.mainwrapper');

/*
	jQuery('.topbar .barmenu').click(function() {

		  var lwidth = '260px';
		  if(jQuery(window).width() < 340) {
					 lwidth = '240px';
		  }

		  if(!jQuery(this).hasClass('open')) {
					 jQuery('.rightpanel, .headerinner, .topbar').css({marginLeft: lwidth},'fast');
					 jQuery('.logo, .leftpanel').css({marginLeft: 0},'fast');
					 jQuery(this).addClass('open');
		  } else {
					 jQuery('.rightpanel, .headerinner, .topbar').css({marginLeft: 0},'fast');
					 jQuery('.logo, .leftpanel').css({marginLeft: '-'+lwidth},'fast');
					 jQuery(this).removeClass('open');
		  }
	});*/


	jQuery('.topbar .chatmenu').click(function(){

		if(!jQuery('.onlineuserpanel').is(':visible')) {
			jQuery('.onlineuserpanel,#chatwindows').show();
			jQuery('.topbar .chatmenu').css({right: '210px'});
		} else {
			jQuery('.onlineuserpanel, #chatwindows').hide();
			jQuery('.topbar .chatmenu').css({right: '10px'});
		}
	});

	// show/hide left menu
	jQuery(window).resize(function(){
		  if(!jQuery('.topbar').is(':visible')) {
		        // jQuery('.rightpanel, .headerinner').css({marginLeft: '260px'});
					jQuery('.logo, .leftpanel').css({marginLeft: 0});
		  } else {
		         jQuery('.rightpanel, .headerinner').css({marginLeft: 0});
					//jQuery('.logo, .leftpanel').css({marginLeft: '-260px'});
					jQuery('.header .logo').css({width: 210});
					jQuery('.logo a').css({width: 210});
					jQuery('.logo a img').css({width: 210});
		  }
   });

	// dropdown menu for profile image
	jQuery('.userloggedinfo img').click(function(){
		  if(jQuery(window).width() <= 480) {
					 var dm = jQuery('.userloggedinfo .userinfo');
					 if(dm.is(':visible')) {
								dm.hide();
					 } else {
								dm.show();
					 }
		  }
   });

	// expand/collapse boxes
	if(jQuery('.minimize').length > 0) {

		  jQuery('.minimize').click(function(){
					 if(!jQuery(this).hasClass('collapsed')) {
								jQuery(this).addClass('collapsed');
								jQuery(this).html("&#43;");
								jQuery(this).parents('.widgetbox')
										      .css({marginBottom: '20px'})
												.find('.widgetcontent')
												.hide();
					 } else {
								jQuery(this).removeClass('collapsed');
								jQuery(this).html("&#8211;");
								jQuery(this).parents('.widgetbox')
										      .css({marginBottom: '0'})
												.find('.widgetcontent')
												.show();
					 }
					 return false;
		  });

	}

});



function submit_reassign(){
if(jQuery('#reassign_opt').val() == "0")
   {
		jQuery('#reassign_opt').css({ 'border': '1px solid Red' });
		 document.getElementById('reassign_opt').focus();
		 return false;
}
var formsuburl = jQuery('#formsuburl').val();
var val = jQuery('#formjobreassign').serialize();
var oid = jQuery('#oid').val();
var hiddendate = jQuery('#hiddendate').val();
var hiddensection = jQuery('#hiddensection').val();
var selaid = jQuery('#selaid').val();
var reassign_opt = jQuery('#reassign_opt').val();
//alert(reassign_opt);
if(selaid != ''){
jQuery.post(formsuburl,val,
function (data) {
			var search_term = jQuery('#movenav_url').val()+'/'+reassign_opt+'/'+hiddendate;
			window.location.replace(search_term);
	});
	}else{
		alert("Nessun lavoro trovato per riassegnare...");
	}
}

function checkoptexist (optval) {
		if(optval != '0'){
      	if(jQuery('#joblistcount').val() > 0){
		var validatealldata = jQuery('#validatealldata').val();
		var section = jQuery('#section').val();
		var job_date_assign = jQuery('#job_date_assign').val();
		var siteurl = jQuery('#siteurl').val();
jQuery.post(siteurl,
           {validatealldata: ""+validatealldata+"",opt: ""+optval+"", job_date_assign: ""+job_date_assign+"", section: ""+section+"" },
               function(data){
               	//alert(data);
               	jQuery('#roid').val(optval);
               	jQuery('.error_msg').html(data);

	       });
	       }else{
	       	jQuery('.error_msg').html('Nessun lavoro trovato');
	       }
	     }else{
	     	alert("Selezionare Operator.");
	     	jQuery('.error_msg').html('');
	     }
}