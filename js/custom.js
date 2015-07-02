var is_filter = 0;
var is_filter_p = 0;
var is_filter_pat_id = 0;
var is_filter_opt = 0;
var is_filter_opt_id = 0;
var is_filter_dist = 0;
var is_filter_dist_id = 0;
var is_filter_status = 0;
var is_filter_filter_box_status = 0;
var is_navweek = 0;
var is_navyear = 0;
jQuery.noConflict();

jQuery(document).ready(function(){
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
   jQuery('<div class="topbar"><a class="barmenu">'+
		    '</a><div class="chatmenu"></a></div>').insertBefore('.mainwrapper');

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
	});

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
		         jQuery('.rightpanel, .headerinner').css({marginLeft: '260px'});
					jQuery('.logo, .leftpanel').css({marginLeft: 0});
		  } else {
		         jQuery('.rightpanel, .headerinner').css({marginLeft: 0});
					jQuery('.logo, .leftpanel').css({marginLeft: '-260px'});
		  }
   });

	// dropdown menu for profile image
	jQuery('.userloggedinfo img').click(function(){
		  if(jQuery(window).width() < 480) {
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

	/* Contract */
	jQuery("#checkall").click(function () {
		jQuery(".classweekday").prop('checked', jQuery(this).prop('checked'));
	});
	jQuery('#addnew').click(function()
	{
		var last_intervent_days = jQuery('#last_intervent_days').val();
		if(last_intervent_days == '10'){
			jQuery('#addnew').hide();
		}

		jQuery('#com'+last_intervent_days).show();
		var next_intervent_days = parseInt(last_intervent_days) + 1;
		if(last_intervent_days != '10'){
			jQuery('#last_intervent_days').val(next_intervent_days);
		}
	});

	jQuery('a.delete_link').click(function()
    {
    	var multiimgdeletefrom = jQuery('#multiimgdeletefrom').val();
    	if(multiimgdeletefrom == 'patient'){
			var deleteurl = jQuery('#deletepatinfoimg').val();
    	}else if(multiimgdeletefrom == 'contract'){
			var deleteurl = jQuery('#deletecontractimgage').val();
    	}

        if (confirm("Sei sicuro di voler eliminare questo attaccamento?"))
        {
            var val = jQuery(this).attr('data_link');
            var imgval = jQuery(this).attr('data_loop');
            jQuery.ajax(
            {
                   type: "POST",
                   url: deleteurl+"/"+val,
                   cache: false,
                   success: function(data)
                   {
                    jQuery('#img'+imgval).hide();
                   }
             });
        }
    });
	/* End Contract */
/* Job List */

/* End Job List */

});
/* Check no of job assing */
function get_patient(ele) {

var job_date_assign = jQuery('#job_date_assign').val();
var get_pat_id = jQuery('#patient_id').val();
var intervent_type = jQuery('#intervent_type').val();
var check_no_contract_url = jQuery('#check_no_contract').val();
$.ajax({
        url: check_no_contract_url,
        type: 'POST',
        async: false,
        data: 'job_date_assign=' + job_date_assign + '&get_pat_id=' + get_pat_id + '&intervent_type=' + intervent_type,
        success: function(data) {
	        if(data) {
                        $("#count_assign_job").val(data);
	        }
        }
        });


}
/* Check no of job assing */
function get_patient_distric(ele) {
var get_pat_id = jQuery('#patient_id').val();
var check_distric = jQuery('#get_distric').val();
$.ajax({
        url: check_distric,
        type: 'POST',
        async: false,
        data: 'get_pat_id =' + get_pat_id,
        success: function(data) {
	        if(data) {
                        $("#distric").val(data);
	        }
        }
        });


}
function get_disignation_operator(ele) {
var distric = jQuery('#district').val();
var designation_operator = jQuery('#get_designation_operator').val();
$.ajax({
        url: designation_operator,
        type: 'POST',
        async: false,
        data: ' distric =' + distric,
        success: function(data) {
	        if(data) {
                       $("div.jobautocomp_operator").html(data);
	        }
        }
        });



}
function validate(){
var pm = document.getElementById('primary_mandatory').value;
var secm = document.getElementById('secondary_mandatory').value;
var supm = document.getElementById('supervisor_mandatory').value;
var shourcombo = $('.hourcombo').val();
var mincombo = $('.mincombo').val();
var endhourcombo = jQuery('.endhourcombo').val();
var endmincombo =jQuery('.endmincombo').val();
var dist_id =jQuery('#distric').val();
var action = $('#action').val();
var flag = 0;
//var current_week = document.getElementById('current_week').value;
if(shourcombo == endhourcombo && mincombo == endmincombo) {
      alert('La durata minima per un  intervento è di 5 minuti');
      return false;
}

if(action != 'edit'){
if(shourcombo == "0" && mincombo == "0")
   {
		jQuery('.hourcombo').css({ 'border': '1px solid Red' });
		 return false;
}else if(endhourcombo == "0" && endmincombo == "0")
	   {
			jQuery('.endhourcombo').css({ 'border': '1px solid Red' });
			 return false;
	   }
}
if(pm == '1'){

if(document.getElementById('val_pry_operator').value == "" || document.getElementById('pry_operator').value == "")
   {
		jQuery('.pry .custom-combobox').css({ 'border': '1px solid Red' });
		 document.getElementById('pry_operator').focus();
		 return false;
} }

if(secm == '1'){
if(document.getElementById('val_sec_operator').value=="" || document.getElementById('sec_operator').value == "")
   {
		 jQuery('.sec .custom-combobox').css({ 'border': '1px solid Red' });
		 document.getElementById('sec_operator').focus();
		 return false;
} }

if(supm == '1'){
if(document.getElementById('val_sup_operator').value=="" || document.getElementById('sup_operator').value == "")
   {
		 jQuery('.sup .custom-combobox').css({ 'border': '1px solid Red' });
		 document.getElementById('sup_operator').focus();
		 return false;
} }

var count_assign_job = $('#count_assign_job').val();
var count_contract_job = $('#count_contract_job').val();

/* check patient availabel get data */
var sucess = 0;
var check_patient = 0;
var action_check = jQuery('#action').val();
var patient_id = jQuery('.patient_id').val();
var intervent_type_id = jQuery('.intervent_type').val();

if(action_check == 'new'){
	var shourcombo_check = jQuery('.hourcombo').val();
	var smin_check = jQuery('.mincombo').val();
	var aid = '';
}else if(action_check == 'edit'){
	var shourcombo_check = jQuery('#start_hid_hour').val();
	var smin_check = jQuery('#start_hid_min').val();
	var aid = jQuery('#aid').val();
}
	var ehourcombo_check = jQuery('#endhourcombo').val();
	var emin_check = jQuery('#endmincombo').val();
	var job_date_assign = jQuery('#job_date_assign').val();
	var check_patient_url = jQuery('#check_patient_url').val();
	
/*End get data check patient */
/*Check add  Patient availabel or not */
if(action_check == 'new'){
        $.ajax({
                url: check_patient_url,
                type: 'POST',
                 async: false,
                data: 'shourcombo_check=' + shourcombo_check + '&smin_check=' + smin_check + '&ehourcombo_check=' + ehourcombo_check + '&emin_check=' + emin_check + '&patient_id=' + patient_id + '&intervent_type_id=' + intervent_type_id + '&aid=' + aid + '&job_date_assign=' + job_date_assign,
        success: function(data) {
                        if(data) {
                              sucess = 0;
	                        check_patient = 1;
                        }
                }
        });
  }
               

/*End patient availale check */


/*Check edit  Patient availabel or not */
if(action_check == 'edit'){
        $.ajax({
                url: check_patient_url,
                type: 'POST',
                 async: false,
                data: 'shourcombo_check=' + shourcombo_check + '&smin_check=' + smin_check + '&ehourcombo_check=' + ehourcombo_check + '&emin_check=' + emin_check + '&patient_id=' + patient_id + '&intervent_type_id=' + intervent_type_id + '&aid=' + aid + '&job_date_assign=' + job_date_assign,
        success: function(data) {
                        if(data) {
                              sucess = 0;
                              check_patient = 1;
                        }
                }
        });
  }
               

/*End patient availale check */

if(sucess == 0) {
     
  var count_contract_job_check = count_assign_job;
      var count_assign_job_check = count_contract_job;
       /*Check Patient busy time */
      if(check_patient == 1) {
            var check_patient_time = confirm("L utente è già impegnato per quella data a quell ora.Continuare?");
            if(check_patient_time == true){
                 
                 
                  var count_contract_job1 = count_assign_job;
                  var count_assign_job1 = count_contract_job;
                                   
                  if(count_assign_job1 <= count_contract_job1) {
                         var retVal = confirm("Attenzione - questo utente ha superato la soglia degli interventi settimanali da contratto. Continuare?");
                 
                        if(retVal == true){
                              flag = 1;
                        } else{
                              return false;
                        }

                  } else {
                        flag = 1;
                  }
            } else{
                  return false;

            }

      } else if(count_assign_job_check <= count_contract_job_check) {
            var retVal = confirm("Attenzione - questo utente ha superato la soglia degli interventi settimanali da contratto. Continuare?");

            if(retVal == true){
                  flag = 1;
            } else{
                  return false;
            }
      
      
      }
jQuery('.jobsubbtn').hide();
var passurl = $('#passurl').val();
var $about = $("#event_edit_container");
var val = $('#formjobassign').serialize();
jQuery.post(passurl,val,
function (data) {
	jQuery('#field_loader').show();
	var moveweek = jQuery('#moveweek').val();
	var moveyear = jQuery('#moveyear').val();
	
if(is_filter == 1 ){
		var search_term = jQuery('#newsiteurl_nav').val();
		var arg = {opt_id: ""+is_filter_opt_id+"", pat_id: ""+is_filter_pat_id+"", dist_id: ""+is_filter_dist_id+"", filter_box_status: ""+is_filter_filter_box_status+"", navweek: ""+moveweek+"", navyear: ""+moveyear+""};
} else{
        var flag = 1;
	var search_term = jQuery('#movenav_url').val();
	var arg = {opt_id: "0", pat_id: "0", dist_id: "0", filter_box_status: "0", week_no: ""+moveweek+"", year_no: ""+moveyear+""};
}
//alert(search_term);
//alert(arg);
	$about.dialog("destroy").hide();
	jQuery.post(search_term,
			arg,
		 function(data1){
		 jQuery('#field_loader').hide();
			 if(data1 != '' ){
				 jQuery('#calendar1').html('');
				 jQuery('#calendar1').html(data1);
			 }
		});
	});

}
}

function jobremove(){
	var val = $('#formjobassign').serialize();
	var jobremoveurl = $('#jobremoveurl').val();
	var $about = $("#event_edit_container");
	var moveweek = jQuery('#moveweek').val();
	var moveyear = jQuery('#moveyear').val();
	jQuery.post(jobremoveurl,val,
		function (data) {
			if(is_filter == 1){
					var search_term = jQuery('#newsiteurl_nav').val();
					var arg = {opt_id: ""+is_filter_opt_id+"", pat_id: ""+is_filter_pat_id+"", dist_id: ""+is_filter_dist_id+"", filter_box_status: ""+is_filter_filter_box_status+"", navweek: ""+moveweek+"", navyear: ""+moveyear+""};
			}else{
				var search_term = jQuery('#movenav_url').val();
				var arg = {opt_id: "0", pat_id: "0", dist_id: "0", filter_box_status: "0",week_no: ""+moveweek+"", year_no: ""+moveyear+""};
			}
//alert(search_term);
//alert(arg);
	$about.dialog("destroy").hide();
	jQuery.post(search_term,
			arg,
		 function(data1){
			 if(data1 != ''){
				 jQuery('#calendar1').html('');
				 jQuery('#calendar1').html(data1);
			 }
		});
	});
}

function check_webservice_url() {

      if(document.getElementById('url').value == "")
      {
            alert('Inserisci il webservice url');
            jQuery('#url').css({ 'border': '1px solid Red' });
		 document.getElementById('url').focus();
            return false;
      } 

}
function hideoperatorlist () {
	jQuery('.default_record').hide();
	jQuery('.finalsubmit').hide();
	jQuery('.pry .custom-combobox-input').val('');
	jQuery('.sec .custom-combobox-input').val('');
	jQuery('.sup .custom-combobox-input').val('');
	/* jQuery('#val_pry_operator').val('');
	jQuery('#val_sec_operator').val('');
	jQuery('#val_sup_operator').val(''); */
	jQuery('#pry_operator').val('');
	jQuery('#sec_operator').val('');
	jQuery('#sup_operator').val('');
	jQuery('.sup_msg').html('');
	jQuery('.sec_msg').html('');
	jQuery('.pry_msg').html('');
	//jQuery('.ecombo').val('');
}

function update_operator_list () {

	var update_operator_list_url = jQuery('#update_operator_list_url').val();
	var pry_role_ids = jQuery('#pry_role_ids').val();
	var sec_role_ids = jQuery('#sec_role_ids').val();
	var sup_role_ids = jQuery('#sup_role_ids').val();
	var job_date_assign = jQuery('#job_date_assign').val();
	var start_hid_hour = jQuery('#start_hid_hour').val();
	var start_hid_min = jQuery('#start_hid_min').val();
	//var end_time = jQuery('#end_time').val();
	var shourcombo = jQuery('.hourcombo').val();
	var mincombo =jQuery('.mincombo').val();
	var endhourcombo = jQuery('.endhourcombo').val();
	var endmincombo =jQuery('.endmincombo').val();
	var val_pry_operator = jQuery('#val_pry_operator').val();
	var val_sec_operator = jQuery('#val_sec_operator').val();
	var val_sup_operator = jQuery('#val_sup_operator').val();
	var aid = jQuery('#aid').val();

	var action = $('#action').val();
	if( job_date_assign == ''){
		jQuery('#job_date_assign').css({ 'border': '1px solid Red' });
		return false;
	}else if(shourcombo == "0" && mincombo == "0")
	   {
			jQuery('.hourcombo').css({ 'border': '1px solid Red' });
			 return false;
	   }else if(endhourcombo == "0" && endmincombo == "0")
	   {
			jQuery('.endhourcombo').css({ 'border': '1px solid Red' });
			 return false;
	   }

		/* Tag */
	var checkboxes = document.getElementsByName('contract_tags[]');
	var cont_tag = "";
	for (var i=0, n=checkboxes.length;i<n;i++) {
		if (checkboxes[i].checked)
	  	{
	  		cont_tag += ","+checkboxes[i].value;
	  	}
	}
	if (cont_tag) cont_tag = cont_tag.substring(1);
	/* Tag */
	jQuery('.default_record').show();
	jQuery('.finalsubmit').show();
	//jQuery('input[name=primay_role]').attr('checked',false);
	//jQuery('input[name=secondary_role]').attr('checked',false);
	//jQuery('input[name=supervisor_role]').attr('checked',false);
	var siteurl = jQuery('#siteurl').val();

	if(pry_role_ids != undefined){
		if(val_pry_operator != '' && val_pry_operator != '0'){
		jQuery.post(siteurl,
           {shourcombo: ""+start_hid_hour+"",smin: ""+start_hid_min+"",ehourcombo: ""+endhourcombo+"",emin: ""+endmincombo+"",opt: ""+val_pry_operator+"", aid: ""+aid+"", job_date_assign: ""+job_date_assign+"" },
               function(data){
               	if(data != ''){

               		jQuery('.pry .custom-combobox-input').val('');
               		jQuery('#val_pry_operator').val('');
               		jQuery('#pry_operator').val('');
               		jQuery('.pry_msg').html(data);
               	}else{
               		jQuery('.pry_msg').html('');
               		jQuery.post(update_operator_list_url,
           {queryString: ""+pry_role_ids+"", cont_tag: ""+cont_tag+"", job_date_assign: ""+job_date_assign+"", start_hid_hour: ""+start_hid_hour+"", start_hid_min: ""+start_hid_min+"", val_oid: ""+val_pry_operator+"", typefrom: "pry_operator"},
               function(data){
           			 jQuery('#pry_operator').html('');
                     jQuery('#pry_operator').html(data);
	       });
               	}

	       });
		}else{
jQuery.post(update_operator_list_url,
           {queryString: ""+pry_role_ids+"", cont_tag: ""+cont_tag+"", job_date_assign: ""+job_date_assign+"", start_hid_hour: ""+start_hid_hour+"", start_hid_min: ""+start_hid_min+"", val_oid: ""+val_pry_operator+"", typefrom: "pry_operator"},
               function(data){
           			 jQuery('#pry_operator').html('');
                     jQuery('#pry_operator').html(data);
	       });
		}

	}
	if(sec_role_ids != undefined){
		if(val_sec_operator != '' && val_sec_operator != '0'){
		jQuery.post(siteurl,
           {shourcombo: ""+start_hid_hour+"",smin: ""+start_hid_min+"",ehourcombo: ""+endhourcombo+"",emin: ""+endmincombo+"",opt: ""+val_sec_operator+"", aid: ""+aid+"", job_date_assign: ""+job_date_assign+"" },
               function(data){
               	if(data != ''){
               		jQuery('.sec .custom-combobox-input').val('');
               		jQuery('#val_sec_operator').val('');
               		jQuery('#sec_operator').val('');
               		jQuery('.sec_msg').html(data);
               	}else{
               		jQuery('.sec_msg').html('');
		jQuery.post(update_operator_list_url,
              {queryString: ""+sec_role_ids+"", cont_tag: ""+cont_tag+"", job_date_assign: ""+job_date_assign+"", start_hid_hour: ""+start_hid_hour+"", start_hid_min: ""+start_hid_min+"", val_oid: ""+val_sec_operator+"", typefrom: "sec_operator"},
               function(data){
               	jQuery('#sec_operator').html('');
                jQuery('#sec_operator').html(data);
	       });
               	}

	       });
		}else{
		jQuery.post(update_operator_list_url,
              {queryString: ""+sec_role_ids+"", cont_tag: ""+cont_tag+"", job_date_assign: ""+job_date_assign+"", start_hid_hour: ""+start_hid_hour+"", start_hid_min: ""+start_hid_min+"", val_oid: ""+val_sec_operator+"", typefrom: "sec_operator"},
               function(data){
               	jQuery('#sec_operator').html('');
                jQuery('#sec_operator').html(data);
	       });
		}

	}
	if(sup_role_ids != undefined){
	if(val_sup_operator != '' && val_sup_operator != '0'){
		jQuery.post(siteurl,
           {shourcombo: ""+start_hid_hour+"",smin: ""+start_hid_min+"",ehourcombo: ""+endhourcombo+"",emin: ""+endmincombo+"",opt: ""+val_sup_operator+"", aid: ""+aid+"", job_date_assign: ""+job_date_assign+"" },
               function(data){
               	if(data != ''){
               		jQuery('.sup .custom-combobox-input').val('');
               		jQuery('#val_sup_operator').val('');
               		jQuery('#sup_operator').val('');
               		jQuery('.sup_msg').html(data);
               	}else{
               		jQuery('.sup_msg').html('');
	       jQuery.post(update_operator_list_url,
            {queryString: ""+sup_role_ids+"", cont_tag: ""+cont_tag+"", job_date_assign: ""+job_date_assign+"", start_hid_hour: ""+start_hid_hour+"", start_hid_min: ""+start_hid_min+"", val_oid: ""+val_sup_operator+"", typefrom: "sup_operator"},
               function(data){
               	jQuery('#sup_operator').html('');
                jQuery('#sup_operator').html(data);
	       });
               	}

	       });
		}else{
	       jQuery.post(update_operator_list_url,
            {queryString: ""+sup_role_ids+"", cont_tag: ""+cont_tag+"", job_date_assign: ""+job_date_assign+"", start_hid_hour: ""+start_hid_hour+"", start_hid_min: ""+start_hid_min+"", val_oid: ""+val_sup_operator+"", typefrom: "sup_operator"},
               function(data){
               	jQuery('#sup_operator').html('');
                jQuery('#sup_operator').html(data);
	       });
		}
	}
	jQuery('.finalsubmit').show();

}
function change_end_time (val,cname) {
	hideoperatorlist();
	var endhourcombo = document.getElementById(cname);
	jQuery('#'+cname+'').val('');
	    for(var i = 0, j = endhourcombo.options.length; i < j; ++i) {
	        if(endhourcombo.options[i].value == val) {
	           jQuery(endhourcombo.options[i]).attr('selected','selected');
	           break;
	        }
	    }
}

function submit_reassign(){
if(document.getElementById('reassign_opt').value == "")
   {
		jQuery('.optassign .custom-combobox').css({ 'border': '1px solid Red' });
		 document.getElementById('reassign_opt').focus();
		 return false;
}

var formsuburl = $('#formsuburl').val();
var $about = $("#event_edit_container");
var val = $('#formjobreassign').serialize();
var moveweek = jQuery('#moveweek').val();
var moveyear = jQuery('#moveyear').val();
jQuery.post(formsuburl,val,
function (data) {
if(is_filter == 1){
		var search_term = jQuery('#newsiteurl_nav').val();
		var arg = {opt_id: ""+is_filter_opt_id+"", pat_id: ""+is_filter_pat_id+"", dist_id: ""+is_filter_dist_id+"", filter_box_status: ""+is_filter_filter_box_status+"", navweek: ""+moveweek+"", navyear: ""+moveyear+""};
}else{
		var search_term = jQuery('#movenav_url').val();
		var arg = {opt_id: "0", pat_id: "0", dist_id: "0", filter_box_status: "0",week_no: ""+moveweek+"", year_no: ""+moveyear+""};
}
	$about.dialog("destroy").hide();
	jQuery.post(search_term,
			arg,
		 function(data1){
			 if(data1 != ''){
				 jQuery('#calendar1').html('');
				 jQuery('#calendar1').html(data1);
			 }
		});
	});
}

function checkopertor() {

 //$('.custom-combobox-input').val('');
 jQuery('.error_msg_sec').html(''); 

}
function checkopertor_job() {
      //jQuery('#job_date_assign').val('');    
      //jQuery('.optassign .custom-combobox-input').val('');
      //jQuery('#pry_reassign_opt').val('');
      //jQuery('.sec_opertor .custom-combobox-input').val('');
      //jQuery('#sec_operator').val('');    

}
function submit_copy__reassign(event) {

var checked=false;
var elements = document.getElementsByName("copy_check[]");
for(var l=0; l < elements.length; l++){
	if(elements[l].checked) {
		checked = true;
	}
}
if (!checked) {
	 alert('Seleziona almeno un intervento');
       return false;
} 
if(document.getElementById('job_date_assign').value == "")
{
        //jQuery('.optassign .custom-combobox').css({ 'border': '1px solid Red' });
        document.getElementById('job_date_assign').focus();
        //jQuery('.sec_opertor .custom-combobox-input').val('');
	  //jQuery('#sec_operator').val('');
	  jQuery('.error_msg_sec').html('');
        return false;
}
if(document.getElementById('pry_reassign_opt').value == "")
{
        jQuery('.optassign .custom-combobox').css({ 'border': '1px solid Red' });
        document.getElementById('pry_reassign_opt').focus();
        return false;
}
var curent_job_assign_date = $("#job_date_assign_val").val();
var job_assing_date = $("#job_date_assign").val();
if(curent_job_assign_date == job_assing_date) {
        alert('Copia sullo stesso giorno non consentita');
        jQuery('.optassign .custom-combobox').css({ 'border': '1px solid Red' });
       document.getElementById('job_date_assign').focus();
        return false;
}
var formsuburl = $('#formsuburl').val();
var $about = $("#event_edit_container");
var val = $('#formjobreassign').serialize();
var moveweek = jQuery('#moveweek').val();
var moveyear = jQuery('#moveyear').val();
var actionfrom = "move";
/* Get array value in checkbox*/
var selchbox = []; 
// gets all the input tags in frm, and their number
var inpfields = document.getElementsByName("copy_check[]");
var nr_inpfields = inpfields.length;
for(var i=0; i<nr_inpfields; i++) {
      if(inpfields[i].type == 'checkbox' && inpfields[i].checked == true) 
      selchbox.push(inpfields[i].value);
}
/*Check for operator busy*/
var count = $('[class^=shour_]').length;
var siteurl = jQuery('#siteurl').val();
var siteurl = jQuery('#siteurl').val();
var job_date_assign = jQuery('#job_date_assign').val();

		for(var k = 1; k <= count; k++ ) {
		      var optval = jQuery('#pry_reassign_opt').val();
            	var shourcombo = jQuery('.shour_'+k).val();
            	var smin = jQuery('.smin_'+k).val();
		      var ehourcombo = jQuery('.ehour_'+k).val();
		      var emin = jQuery('.emin_'+k).val();
		      var aid = '';
                  var aid_job = jQuery('.aid_'+k).val();
                  if($.inArray(aid_job, selchbox )>=0){
                        $.ajax({
				      url: siteurl,
				      type: 'POST',
				      async: false,
				      data: 'shourcombo=' + shourcombo + '&smin=' + smin + '&ehourcombo=' + ehourcombo + '&emin=' + emin + '&opt=' + optval + '&aid=' + aid + '&job_date_assign=' + job_date_assign,
				      success: function(data) {
					      if(data != ''){
                                 		alert('Operatore occupato');
                                 		flag = 0;
                                 		event.preventDefault();
                           	}
				      }
			      });
		      }
	     }
	      
  
/*End check for operator busy*/
/*check secondarary operator */
for(var l = 1; l <= count; l++ ) {
                  var optval = jQuery('#sec_operator').val(); 
            	var shourcombo = jQuery('.shour_'+l).val();
            	var smin = jQuery('.smin_'+l).val();
		      var ehourcombo = jQuery('.ehour_'+l).val();
		      var emin = jQuery('.emin_'+l).val();
		      var aid = '';
                  var aid_job = jQuery('.aid_'+l).val();
                  if($.inArray(aid_job, selchbox )>=0){
                        $.ajax({
				      url: siteurl,
				      type: 'POST',
				      async: false,
				      data: 'shourcombo=' + shourcombo + '&smin=' + smin + '&ehourcombo=' + ehourcombo + '&emin=' + emin + '&opt=' + optval + '&aid=' + aid + '&job_date_assign=' + job_date_assign,
				      success: function(data) {
					      if(data != ''){
                                 		alert('Operatore occupato');
                                 		flag = 0;
                                 		event.preventDefault();
                           	}
				      }
			      });
		      }
	     }
/*End check secondaray operator*/
/*Check for Busy Patient  */
flag = 1;
var ajaxResponse;
var count = $('[class^=shour_]').length;
var check_patient_url = jQuery('#check_patient_url').val();
	for(var j = 1; j <= count; j++ ){
	      aid = $(".aid_"+j).val();
		patient_id = $(".pid_"+j).val();
		job_date_assign = $("#job_date_assign").val();
		intervent_type_id = $(".intervent_type_id_"+j).val();
		shourcombo_check = $(".shour_"+j).val();
		smin_check = $(".smin_"+j).val();
		ehourcombo_check = $(".ehour_"+j).val();
		emin_check = $(".emin_"+j).val();
		if($.inArray(aid, selchbox )>=0){
		      $.ajax({
			      url:  check_patient_url,
			      type: 'POST',
			      async: false,
			       data: 'shourcombo_check=' + shourcombo_check + '&smin_check=' + smin_check + '&ehourcombo_check=' + ehourcombo_check + '&emin_check=' + emin_check + '&patient_id=' + patient_id + '&intervent_type_id=' + intervent_type_id + '&aid=' + aid + '&job_date_assign=' + job_date_assign,
			      success: function(data) {
				      if(data) {
                                    ajaxResponse = data;
                                    flag = 0;
				      }
			      }
		      });
            }
/*Check Patient busy time */
if(flag == 0) {
     var check_patient_time = confirm(ajaxResponse + "è già impegnata a tale data in quel momento - a continuare ?");
	if(check_patient_time == true){
            flag = 1;
      }else{
          return false;
            
      }

}            
	}
	if(flag == 1) {
jQuery.post(formsuburl,val,
function (data) {
 jQuery('#field_loader').show();
if(is_filter == 1){
		var search_term = jQuery('#newsiteurl_nav').val();
		var arg = {opt_id: ""+is_filter_opt_id+"", pat_id: ""+is_filter_pat_id+"", dist_id: ""+is_filter_dist_id+"", filter_box_status: ""+is_filter_filter_box_status+"", navweek: ""+moveweek+"", navyear: ""+moveyear+"",actionfrom: ""+actionfrom+""};
}else{
		var search_term = jQuery('#movenav_url').val();
		var arg = {opt_id: "0", pat_id: "0", dist_id: "0", filter_box_status: "0",week_no: ""+moveweek+"", year_no: ""+moveyear+""};
}
	$about.dialog("destroy").hide();
	jQuery.post(search_term,
			arg,
		 function(data1){
		        jQuery('#field_loader').hide();
			 if(data1 != ''){
				 jQuery('#calendar1').html('');
				 jQuery('#calendar1').html(data1);
			 }
		});
	});
}	
}
/* Job Assign page filter */
function filter_submit () {
	var filter_operator = jQuery('#filter_operator').val();
	var filter_patient = jQuery('#filter_patient').val();
	var filter_district = jQuery('#filter_district').val();
	var filter_box_status = jQuery('#filter_box_status').val();
	var navweek = jQuery('#navweek').val();
	var navyear = jQuery('#navyear').val();

	var msg = 'Si prega di scegliere una opzione di filtro';
	if(filter_operator != '0' || filter_patient != '0' || filter_district != '0' || filter_box_status != '0'){
	jQuery('#field_loader').show();
	var newsiteurl = jQuery('#newsiteurl_nav').val();
	//alert(newsiteurl);
	jQuery.post(newsiteurl,
	{opt_id: ""+filter_operator+"", pat_id: ""+filter_patient+"", dist_id: ""+filter_district+"", filter_box_status: ""+filter_box_status+"", navweek: ""+navweek+"", navyear: ""+navyear+""},
	function(data){
		//alert(data);
		is_filter = 1;
		is_filter_opt_id = filter_operator;
		is_filter_pat_id = filter_patient;
		is_filter_dist_id = filter_district;
		is_filter_filter_box_status = filter_box_status;
		is_navweek = navweek;
		is_navyear = navyear;

		jQuery('#field_loader').hide();
		if(data != ''){
		jQuery('#calendar1').html('');
		jQuery('#calendar1').html(data);
		}
	});
}else{
	alert(msg);
}
}

function filterdisplay (status) {
	if(status == "show"){
		jQuery('.filterbox').show();
		jQuery('.showopt').hide();
		jQuery('.hideopt').show();
	}else if(status == "hide"){
		jQuery('.filterbox').hide();
		jQuery('.showopt').show();
		jQuery('.hideopt').hide();
	}
}
/* Job Assign page filter */
/*Ajax Pdf */
function pdf_ajax(pid,filt_oid,dist_id,filter_box_status,week,cyear) {
    
    
    if(week.toString().length == 1) {
      cweek = "0"+week;
    } else {
    cweek = week;
    
    }
    jQuery('#field_loader').show();
    var siteurl_pdf = jQuery('#siteurl_pdf').val();
    var success = false;
    var l = window.location;
    var base_url = l.protocol + "//" + l.host + "/";
    var pdf_location = base_url+"pdf_data/job_planned.pdf";
    
    $.ajax({
        url: siteurl_pdf,
        type: 'POST',
        data: 'pid=' + pid + '&filt_oid=' + filt_oid + '&dist_id=' + dist_id + '&filter_box_status=' + filter_box_status + '&cweek=' + cweek + '&cyear=' + cyear,
        async:false,
    success: function(html) {
        jQuery('#field_loader_pdf').hide();
        success = true
        jQuery('#field_loader').hide();
    }
});
     if(success){ //AND THIS CHANGED
        window.open(pdf_location)
    }
    jQuery('#field_loader').hide();
}

/*End Ajax Pdf*/
/* Copy Week */


function submitcopyweek () {
if(document.getElementById('district').value == "0")
   {
		jQuery('#district').css({ 'border': '1px solid Red' });
		 document.getElementById('district').focus();
		 return false;
}
var checked=false;
var elements = document.getElementsByName("copy_week[]");
for(var l=0; l < elements.length; l++){
	if(elements[l].checked) {
		checked = true;
	}
}
if (!checked) {
	 alert('Seleziona almeno un intervento');
       return false;
} 
if(document.getElementById('weekno').value == "")
   {
		jQuery('#weekno').css({ 'border': '1px solid Red' });
		 document.getElementById('weekno').focus();
		 return false;
}
var selectedweekno = jQuery('#selectedweekno').val();
var year = jQuery('#year').val();
var formsuburl = jQuery('#weekurl').val();
var navurl = jQuery('#nav_url').val();
var $about = jQuery("#event_edit_container");
var val = jQuery('#formweek').serialize();
var filter_operator = jQuery('#filter_operator').val();
var filter_patient = jQuery('#filter_patient').val();
var filter_district = jQuery('#filter_district').val();
var filter_box_status = jQuery('#filter_box_status').val();

jQuery.post(formsuburl,val,
function (data) {
jQuery('#field_loader').show();
jQuery('.flash').show();
if(data != ''){
	if(data == "Attenzione - Settimana copiata escludendo alcuni interventi cessati"){
		alert(data);
		$about.dialog("destroy").hide();
	}else{
		alert(data);
	}
	}else{
	$about.dialog("destroy").hide();
	jQuery.post(navurl,
		{opt_id: ""+filter_operator+"", pat_id: ""+filter_patient+"", dist_id: ""+filter_district+"", filter_box_status: ""+filter_box_status+"", week_no: ""+selectedweekno+"", year_no: ""+year+""},
	function(data1){
		if(data1 != ''){
		jQuery('#field_loader').hide();
		jQuery('.flash').show();
		jQuery('#calendar1').html('');
		jQuery('#calendar1').html(data1);
		}
	});
	}
	});
}
/* Copy Week */

/* Move Job */
function javasubmitmovejob(){
if(document.getElementById('move_opt').value == "")
   {
		jQuery('.optmove .custom-combobox').css({ 'border': '1px solid Red' });
		 document.getElementById('move_opt').focus();
		 return false;
}
var moveweek = jQuery('#moveweek').val();
var moveyear = jQuery('#moveyear').val();

var formsuburl = $('#formsuburl').val();
var $about = $("#event_edit_container");
var val = $('#formmovejob').serialize();

/* Check Operator Avalible */
		var siteurl = $('#siteurl').val();
		var optval = $('#move_opt').val();
		var count = $('[id^=shour_]').length;
		flag = 1;
		for(var j = 1; j <= count; j++ ){
		aid = $("#aid_"+j).val();
		optid = $("#optid_"+j).val();
              	var shourcombo = $('#shour_'+j).val();
              	var smin = $('#smin_'+j).val();
		var ehourcombo = $('#ehour_'+j).val();
		var emin = $('#emin_'+j).val();
		var job_date_assign = $("#job_date_assign_"+j).val();
		var actionfrom = "move";
	    var optsplit = optid.split('_');		
		for(var s = 0; s < optsplit.length; s++){
			
			$.ajax({
				url: siteurl,
				type: 'POST',
				async: false,
				data: 'shourcombo=' + shourcombo + '&smin=' + smin + '&ehourcombo=' + ehourcombo + '&emin=' + emin + '&opt=' + optval + '&aid=' + aid + '&job_date_assign=' + job_date_assign + '&moveweek=' + moveweek + '&actionfrom=' + actionfrom + '&moveyear=' + moveyear,
				success: function(data) {
					
					if(data != ''){
						
						jQuery('.sec .custom-combobox-input').val('');
						jQuery('#move_opt').val('');
						jQuery('.error_msg').html(data);
						flag = 0;
						
               	} 
				}
			});
		}
	}
	if(flag == 1) {
		jQuery('.error_msg').html('');
               		jQuery.post(formsuburl,val,
					function (data2) {
						if(data2 != ''){
							alert(data2);
						}
						if(is_filter == 1){
		var search_term = jQuery('#newsiteurl_nav').val();
		var arg = {opt_id: ""+is_filter_opt_id+"", pat_id: ""+is_filter_pat_id+"", dist_id: ""+is_filter_dist_id+"", filter_box_status: ""+is_filter_filter_box_status+"", navweek: ""+moveweek+"", navyear: ""+moveyear+""};
}else{
		var search_term = jQuery('#movenav_url').val();
		var arg = {opt_id: "0", pat_id: "0", dist_id: "0", filter_box_status: "0",week_no: ""+moveweek+"", year_no: ""+moveyear+""};
}
						jQuery.post(search_term,
						arg,
						function(data1){
							if(data1 != ''){
							jQuery('#calendar1').html('');
							jQuery('#calendar1').html(data1);
							}
						});
						$about.dialog("destroy").hide();
						});
	}
      	

	       /* End */
}




/*function javasubmitmovejob(){
if(document.getElementById('move_opt').value == "")
   {
		jQuery('.optmove .custom-combobox').css({ 'border': '1px solid Red' });
		 document.getElementById('move_opt').focus();
		 return false;
}
var moveweek = jQuery('#moveweek').val();
var moveyear = jQuery('#moveyear').val();

var formsuburl = $('#formsuburl').val();
var $about = $("#event_edit_container");
var val = $('#formmovejob').serialize();

/* Check Operator Avalible 
      	var optval = $('#move_opt').val();
      	var shourcombo = $('#shour').val();
      	var smin = $('#smin').val();
		var ehourcombo = $('#ehour').val();
		var emin = $('#emin').val();
		var job_date_assign = '';
		var siteurl = $('#siteurl').val();
		var aid = '';
		var actionfrom = "move";
jQuery.post(siteurl,
           {shourcombo: ""+shourcombo+"",smin: ""+smin+"",ehourcombo: ""+ehourcombo+"",emin: ""+emin+"",opt: ""+optval+"", aid: ""+aid+"", job_date_assign: ""+job_date_assign+"", actionfrom: ""+actionfrom+"", moveweek: ""+moveweek+"",moveyear: ""+moveyear+"" },
               function(data){
               	if(data != ''){
               		jQuery('.sec .custom-combobox-input').val('');
               		jQuery('#move_opt').val('');
               		jQuery('.error_msg').html(data);
               	}else{
               		jQuery('.error_msg').html('');
               		jQuery.post(formsuburl,val,
					function (data2) {
						if(data2 != ''){
							alert(data2);
						}
						if(is_filter == 1){
		var search_term = jQuery('#newsiteurl_nav').val();
		var arg = {opt_id: ""+is_filter_opt_id+"", pat_id: ""+is_filter_pat_id+"", dist_id: ""+is_filter_dist_id+"", filter_box_status: ""+is_filter_filter_box_status+"", navweek: ""+moveweek+"", navyear: ""+moveyear+""};
}else{
		var search_term = jQuery('#movenav_url').val();
		var arg = {opt_id: "0", pat_id: "0", dist_id: "0", filter_box_status: "0",week_no: ""+moveweek+"", year_no: ""+moveyear+""};
}
						jQuery.post(search_term,
						arg,
						function(data1){
							if(data1 != ''){
							jQuery('#calendar1').html('');
							jQuery('#calendar1').html(data1);
							}
						});
						$about.dialog("destroy").hide();
						});
               	}

	       });
	       /* End 
}*/
/* Contract */
function weedayshide (cur_id) {
	var isChecked = jQuery('#intervent_fortnightly'+cur_id).prop('checked');
	if(isChecked == true){
		jQuery(".weekdays"+cur_id).hide();
	}else{
		jQuery(".weekdays"+cur_id).show();
	}
}
	function deactive()
	{
		var elem1 = document.getElementById('note');
		elem1.value = '';
		var elem1 = document.getElementById('ceased_reason');
		elem1.value = '';
		var elem1 = document.getElementById('hdate');
		elem1.value = '';
	}
/* End Contract */

/* Job List */
    function scrollfunc(val) {
    	jQuery('.optbox').removeClass('active');
    	jQuery(''+val+'').addClass('active');
        jQuery(".wc-scrollable-grid").scrollTop(jQuery(".optbox.active").position().top);
    }
    function restbtn () {
	var navweek = jQuery('#navweek').val();
	var navyear = jQuery('#navyear').val();
	navigation(navweek,navyear,0,0,0,0);
}

function primay_role_fun(pval,cont_tag){
   	var update_operator_list_url = jQuery('#update_operator_list_url').val();
	var job_date_assign = jQuery('#job_date_assign').val();
	var start_hid_hour = jQuery('#start_hid_hour').val();
	var start_hid_min = jQuery('#start_hid_min').val();
	var end_time = jQuery('#end_time').val();
	var shourcombo = jQuery('.hourcombo').val();
	var mincombo =jQuery('.mincombo').val();
	if( job_date_assign == ''){
		jQuery('#job_date_assign').css({ 'border': '1px solid Red' });
		return false;
	}else if(shourcombo == "0" && mincombo == "0")
	   {
			jQuery('.hourcombo').css({ 'border': '1px solid Red' });
			 return false;
	   }

		/* Tag */
	var checkboxes = document.getElementsByName('contract_tags[]');
	var cont_tag = "";
	for (var i=0, n=checkboxes.length;i<n;i++) {
		if (checkboxes[i].checked)
	  	{
	  		cont_tag += ","+checkboxes[i].value;
	  	}
	}
	if (cont_tag) cont_tag = cont_tag.substring(1);
	/* Tag */
		   jQuery.post(update_operator_list_url,
            {queryString: ""+pval+"", cont_tag: ""+cont_tag+"", job_date_assign: ""+job_date_assign+"", start_hid_hour: ""+start_hid_hour+"", start_hid_min: ""+start_hid_min+"", end_time: ""+end_time+""},
               function(data){
               		jQuery('#pry_operator').html('');
                    jQuery('#pry_operator').html(data);
	       });
}

function secondary_role_fun(secval,cont_tag){
	jQuery.post(update_operator_list_url,
            {queryString: ""+secval+"", cont_tag: ""+cont_tag+"", job_date_assign: ""+job_date_assign+"", start_hid_hour: ""+start_hid_hour+"", start_hid_min: ""+start_hid_min+"", end_time: ""+end_time+""},
               function(data){
               				jQuery('#sec_operator').html('');
                         jQuery('#sec_operator').html(data);
	       });
}
function supervisor_role_fun(supval,cont_tag){
	jQuery.post(update_operator_list_url,
           {queryString: ""+supval+"", cont_tag: ""+cont_tag+"", job_date_assign: ""+job_date_assign+"", start_hid_hour: ""+start_hid_hour+"", start_hid_min: ""+start_hid_min+"", end_time: ""+end_time+""},
               function(data){
               	jQuery('#sup_operator').html('');
                         jQuery('#sup_operator').html(data);
	       });
}
/* End Job List */

	function editreportdata (id,pid,oid,from_date,to_date,did) {
	var $about = jQuery("#search_result_popup");
	var url = jQuery('#popupeditlink').val();
				  jQuery.post(url+"/"+id+"/"+pid+"/"+oid+"/"+from_date+"/"+to_date+"/"+did,
				  function (data) {
				       jQuery("#search_result_popup").html(data);
				       $about.dialog({
				         title: "Dati intervento",
				         width: 600,
				         top: 0,
				         closeOnEscape: true,
				         position:'center',
				         close: function() {
				            $about.dialog("destroy").hide();
				         },
				         buttons: {
				            close : function() {
				               $about.dialog("close");
				            }
				         }
				      }).show();
							  });


				 }
function update_report_data () {
	var ped_id = jQuery('#ped_id').val();
	var pid = jQuery('#pid').val();
	var oid = jQuery('#oid').val();
	var did = jQuery('#did').val();
	var from = jQuery('#from_date').val();
	var to = jQuery('#to_date').val();

	var shourcombo = jQuery('#shourcombo').val();
	var smincombo = jQuery('#smincombo').val();
	var sseccombo = jQuery('#sseccombo').val();

	var ehourcombo = jQuery('#ehourcombo').val();
	var emincombo = jQuery('#emincombo').val();
	var eseccombo = jQuery('#eseccombo').val();

	var start_address = jQuery('#start_address').val();
	var end_address = jQuery('#end_address').val();
        var note = jQuery('#note').val();
	var siteurl = jQuery('#siteurl').val();
	var responsesiteurl = jQuery('#responsesiteurl').val();


  jQuery.post(siteurl,
           {shourcombo: ""+shourcombo+"",smincombo: ""+smincombo+"",sseccombo: ""+sseccombo+"",ehourcombo: ""+ehourcombo+"",emincombo: ""+emincombo+"", eseccombo: ""+eseccombo+"", start_address: ""+start_address+"", end_address: ""+end_address+"",note: ""+note+"", ped_id: ""+ped_id+""  },
               function(data){

 var url = responsesiteurl+"/"+pid+"/"+oid+"/"+from+"/"+to+"/"+did;
	 jQuery.ajax({
	 type: "POST",
	 url: url,
	 success: function(msg)
	 {
	 	jQuery('.search_result').show();
		jQuery('.search_result').html(msg);
		 jQuery("#search_result_popup").dialog("destroy").hide();
	 }
	 });

	       });
}


function deleteyellowjob (oid, week, year) {
		var r = confirm("sicuro di voler eliminare questo lavoro?");
				if (r == true) {
					var url = jQuery('#deleteyellowboxurl').val();
					var moveweek = week;
					var moveyear = year;
					jQuery.post(url+"/"+oid+"/"+week+"/"+year,
						  function (data2) {
						  if(is_filter == 1){
				var search_term = jQuery('#newsiteurl_nav').val();
				var arg = {opt_id: ""+is_filter_opt_id+"", pat_id: ""+is_filter_pat_id+"", dist_id: ""+is_filter_dist_id+"", filter_box_status: ""+is_filter_filter_box_status+"", navweek: ""+moveweek+"", navyear: ""+moveyear+""};
		}else{
				var search_term = jQuery('#deletemovenav_url').val();
				var arg = {opt_id: "0", pat_id: "0", dist_id: "0", filter_box_status: "0",week_no: ""+moveweek+"", year_no: ""+moveyear+""};
		}
								jQuery.post(search_term,
								arg,
								function(data1){
									if(data1 != ''){
									jQuery('#calendar1').html('');
									jQuery('#calendar1').html(data1);
									}
								});
								});
				}

}


      jQuery(document).delegate("#selecctall","click",function(e){
                  jQuery('.copy_week').each(function() { //loop through each checkbox
                        this.checked = true;  //select all checkboxes               
                   });

      });
      
      jQuery(document).delegate("#deselecctall","click",function(e){
                  jQuery('.copy_week').each(function() { //loop through each checkbox
                        this.checked = false;  //select all uncheckboxes              
                   });

      });
    


