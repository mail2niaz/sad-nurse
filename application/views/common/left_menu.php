<div class="leftpanel">
 <?php $current_menu = $this->router->fetch_class();
 $current_sub_menu = $this->router->fetch_method();

if($current_menu == "" || $current_menu == "home") {
	$active_home = "active";
}else{
	$active_home = "";
}

/* Operator Menu */
if($current_menu == "operator") {
	$active_opt = "active";
	$show_opt = "style='display: block;'";

	if($current_sub_menu == "operatorlist" || $current_sub_menu == "operatordetails" || $current_sub_menu == "editoperator" || $current_sub_menu == "operatorcalendar"){
		$active_opt = "active";
		$active_opt_sub = "active-sub";
	}else{
		$active_opt_sub = "";
	}
	if($current_sub_menu == "index"){
		$active_opt = "active";
		$active_opt_sub1 = "active-sub";
	}else{
		$active_opt_sub1 = "";
	}

}else{
	$active_opt = "";
	$show_opt = "";
	$active_opt_sub = "";
	$active_opt_sub1 = "";
}
/* End Operator Menu */

/* Patient menu */

if($current_menu == "patient"){
	$show_pat = "style='display: block;'";
	$active_pat = "active";
	if($current_sub_menu == "patientlist" || $current_sub_menu == "patientinfodetails" || $current_sub_menu == "addpatientinfo" || $current_sub_menu == "editpatientinfo"){
		$active_pat_sub = "active-sub";
	}else{
		$active_pat_sub = "";
	}
	if($current_sub_menu == "index"){
		$active_pat_sub1 = "active-sub";
	}else{
		$active_pat_sub1 = "";
	}

}else{
	$show_pat = "";
	$active_pat = "";
	$active_pat_sub = "";
	$active_pat_sub1 = "";
}
/* End Patient menu */

/* Job Assign */
if($current_menu == "jobassign" || $current_menu == "jobassign2"){
	$show_job = "style='display: block;'";
	$active_job = "active";
	if($current_sub_menu == "index"){
		$active_job_sub = "active-sub";
	}else{
		$active_job_sub = "";
	}

	if($current_sub_menu == "jobassign_report"){
		$active_job_sub1 = "active-sub";
	}else{
		$active_job_sub1 = "";
	}
	if($current_sub_menu == "jobassign_week_report"){
		$active_job_sub2 = "active-sub";
	}else{
		$active_job_sub2 = "";
	}
	if($current_sub_menu == "jobassign_monthly_km_report"){
		$active_job_sub3 = "active-sub";
	}else{
		$active_job_sub3 = "";
	}
	if($current_sub_menu == "weekly_fortnightly_report"){
		$active_job_sub4 = "active-sub";
	}else{
		$active_job_sub4 = "";
	}
	if($current_sub_menu == "call_report_availibiity"){
		$active_job_sub5 = "active-sub";
	}else{
		$active_job_sub5 = "";
	}
	if($current_sub_menu == "manual_intervent"){
		$active_job_sub6 = "active-sub";
	}else{
		$active_job_sub6 = "";
	}

}else{
	$show_job = "";
	$active_job = "";
	$active_job_sub = "";
	$active_job_sub1 = "";
	$active_job_sub2 = "";
	$active_job_sub3 = "";
	$active_job_sub4 = "";
	$active_job_sub5 = "";
	$active_job_sub6 = "";
}


/* End Job Assign */
/* CMS */
if($current_menu == "cms"){
	$show_cms = "style='display: block;'";
	$active_cms = "active";
	if($current_sub_menu == "rolelist" || $current_sub_menu == "addrole" || $current_sub_menu == "roledetails" || $current_sub_menu == "editrole"){
		$active_cms_sub = "active-sub";
	}else{
		$active_cms_sub = "";
	}
	if($current_sub_menu == "view_holidays_list" || $current_sub_menu == "addholiday" || $current_sub_menu == "editholiday" || $current_sub_menu == "viewholiday"){
		$active_cms_sub1 = "active-sub";
	}else{
		$active_cms_sub1 = "";
	}
	if($current_sub_menu == "view_district_list" || $current_sub_menu == "adddistrict"){
		$active_cms_sub2 = "active-sub";
	}else{
		$active_cms_sub2 = "";
	}
	if($current_sub_menu == "tag_list" || $current_sub_menu == "edit_tag" || $current_sub_menu == "add_tag" || $current_sub_menu == "view_tag"){
		$active_cms_sub3 = "active-sub";
	}else{
		$active_cms_sub3 = "";
	}
}else{
	$show_cms = "";
	$active_cms = "";
	$active_cms_sub = "";
	$active_cms_sub1 = "";
	$active_cms_sub2 = "";
	$active_cms_sub3 = "";
}
/* End CMS */
/* Intervent */
if($current_menu == "intervent"){
	$show_int = "style='display: block;'";
	$active_int = "active";
	if($current_sub_menu == "index" || $current_sub_menu == "adddynamicform_field"){
		$active_int_sub = "active-sub";
	}else{
		$active_int_sub = "";
	}
	if($current_sub_menu == "adddynamicform" || $current_sub_menu == "editdynamic_form"){
		$active_int_sub1 = "active-sub";
	}else{
		$active_int_sub1 = "";
	}
	if($current_sub_menu == "interventtype" || $current_sub_menu == "add_interventtype"){
		$active_int_sub2 = "active-sub";
	}else{
		$active_int_sub2 = "";
	}

}else{
	$show_int = "";
	$active_int = "";
	$active_int_sub = "";
	$active_int_sub1 = "";
	$active_int_sub2 = "";
}
/* End Intervent */
/* Contract */
if($current_menu == "contract"){
	$show_cont = "style='display: block;'";
	$active_cont = "active";
	if($current_sub_menu == "index" || $current_sub_menu = "editcontract "){
		$active_cont_sub = "active-sub";
	}else{
		$active_cont_sub = "";
	}
	if($current_sub_menu == "addcontract"){
		$active_cont_sub1 = "active-sub";
	}else{
		$active_cont_sub1 = "";
	}

}else{
	$show_cont = "";
	$active_cont = "";
	$active_cont_sub = "";
	$active_cont_sub1 = "";
}
/* End Contract */
/* Report */
if($current_menu == "report"){
	$show_rep = "style='display: block;'";
	$active_rep = "active";
	if($current_sub_menu == "operator_report"){
		$active_rep_sub = "active-sub";
	}else{
		$active_rep_sub = "";
	}
	if($current_sub_menu == "req_intervent_report"){
		$active_rep_sub1 = "active-sub";
	}else{
		$active_rep_sub1 = "";
	}
	if($current_sub_menu == "req_intervent_chart_report"){
		$active_rep_sub2 = "active-sub";
	}else{
		$active_rep_sub2 = "";
	}
	if($current_sub_menu == "patient_intervent_report"){
		$active_rep_sub3 = "active-sub";
	}else{
		$active_rep_sub3 = "";
	}

}else{
	$show_rep = "";
	$active_rep = "";
	$active_rep_sub = "";
	$active_rep_sub1 = "";
	$active_rep_sub2 = "";
	$active_rep_sub3 = "";
}

if($current_menu == "setting" || $current_sub_menu == "acl") {
	$active_setting = "active";
}else{
	$active_setting = "";
}
/*Admin session setup*/
if($current_menu == "admin_session_setup") {
	$active_session_setup = "active";
	$show_session = "style='display: block;'";
	if($current_sub_menu == "admin_session_setup" || $current_sub_menu = "edit_admin_session_setup"){
		$active_cont_session = "active-sub";
	}else{
		$active_cont_session = "";
	}
}else{
	$active_webservice = "";
	$show_session = "";
}
/*Admin Webservice*/
if($current_menu == "admin_webservice") {
	$active_webservice = "active";
	$show_webservice = "style='display: block;'";
	if($current_sub_menu == "admin_webservice" || $current_sub_menu = "edit_webservice "){
		$active_cont_webservice = "active-sub";
	}else{
		$active_cont_webservice = "";
	}
}else{
	$active_webservice = "";
	$show_webservice = "";
}
/* Admin Sesson Setup page */
/*if($current_menu == "admin_setup"){
	$show_cont = "style='display: block;'";
	$active_setup = "active";
	if($current_sub_menu == "index" || $current_sub_menu = "editcontract "){
		$active_setup_sub = "active-sub";
	}else{
		$active_cont_sub = "";
	}
	if($current_sub_menu == "add_session_setup"){
		$active_setup_sub1 = "active-sub";
	}else{
		$active_setup_sub1 = "";
	}

}else{
	$show_cont = "";
	$active_setup = "";
	$active_cont_sub = "";
	$active_setup_sub1 = "";
}*/
/* End Contract */
  ?>
        <div class="leftmenu">
            <ul class="nav nav-tabs nav-stacked">
            	<!--li class="nav-header"><?php echo ( sprintf( lang("LEFTMENU::navigation")) ); ?><?php // echo langbar();  ?></li-->
                <li class="<?=$active_home?>"><a href="<?php echo site_url($i18n.'home') ?>"><?php echo ( sprintf( lang("HOME::dashboard")) ); ?></a></li>

<?php if($mopt == "1"){  ?>
                <li class="dropdown <?=$active_opt?>"><a href="javascript:void(0)"><?php echo ( sprintf( lang("LEFTMENU::opt")) ); ?></a>
                	<?php ?>
                	<ul <?=$show_opt?>>
                        <li class="<?=$active_opt_sub?>"><a href="<?php echo site_url($i18n.'operator/operatorlist') ?>"><?php echo ( sprintf( lang("LEFTMENU::operator-list")) ); ?></a></li>
						<?php if($sadd == "1"){ ?><li class="<?=$active_opt_sub1?>"><a href="<?php echo site_url($i18n.'operator') ?>"><?php echo ( sprintf( lang("LEFTMENU::add_operator")) ); ?></a></li><?php } ?>
                    </ul>
                </li> <?php } ?>

<?php if($mpat == "1"){  ?>
                <li class="dropdown <?=$active_pat?>"><a href="javascript:void(0)"><?php echo ( sprintf( lang("LEFTMENU::patient")) ); ?></a>
                	<ul <?=$show_pat?>>
                        <li class="<?=$active_pat_sub?>"><a href="<?php echo site_url($i18n.'patient/patientlist') ?>"><?php echo ( sprintf( lang("LEFTMENU::patient_info")) ); ?></a></li>
						<?php if($sadd == "1"){ ?><li class="<?=$active_pat_sub1?>"><a href="<?php echo site_url($i18n.'patient') ?>"><?php echo ( sprintf( lang("LEFTMENU::add_patient")) ); ?></a></li><?php } ?>
                    </ul>
                </li><?php } ?>

<?php if($mjob == "1"){  ?>
                <li class="dropdown <?=$active_job?>"><a href="javascript:void(0)"><?php echo ( sprintf( lang("LEFTMENU::job")) ); ?></a>
                	<ul <?=$show_job?>>
                		<li class="<?=$active_job_sub?>"><a href="<?php echo site_url($i18n.'jobassign') ?>"><?php echo ( sprintf( lang("LEFTMENU::joblist")) ); ?></a></li>
                		<li class="<?=$active_job_sub1?>"><a href="<?php echo site_url($i18n.'jobassign/jobassign_report') ?>"><?php echo ( sprintf( lang("LEFTMENU::jobassign_report")) ); ?></a></li>
                		<li class="<?=$active_job_sub2?>"><a href="<?php echo site_url($i18n.'jobassign/jobassign_week_report') ?>"><?php echo ( sprintf( lang("LEFTMENU::jobassign_week_report")) ); ?></a></li>
                		<li class="<?=$active_job_sub3?>"><a href="<?php echo site_url($i18n.'jobassign/jobassign_monthly_km_report') ?>"><?php echo ( sprintf( lang("LEFTMENU::km_opt_usg")) ); ?></a></li>
                		<li class="<?=$active_job_sub4?>"><a href="<?php echo site_url($i18n.'jobassign2/weekly_fortnightly_report') ?>"><?php echo ( sprintf( lang("LEFTMENU::week_fortnight_report")) ); ?></a></li>
                		<li class="<?=$active_job_sub5?>"><a href="<?php echo site_url($i18n.'jobassign2/call_report_availibiity') ?>"><?php echo ( sprintf( lang("LEFTMENU::call_report_title")) ); ?></a></li>
                		<li class="<?=$active_job_sub6?>"><a href="<?php echo site_url($i18n.'jobassign2/manual_intervent') ?>"><?php echo ( sprintf( lang("LEFTMENU::manual_intervent_title")) ); ?></a></li>
                	</ul>
                </li><?php } ?>

                <?php if($mcms == "1"){  ?>
                <li class="dropdown <?=$active_cms?>"><a href="javascript:void(0)"><?php echo ( sprintf( lang("LEFTMENU::cms")) ); ?></a>
                	<ul <?=$show_cms?>>
                		<li class="<?=$active_cms_sub?>"><a href="<?php echo site_url($i18n.'cms/rolelist') ?>"><?php echo ( sprintf( lang("LEFTMENU::role")) ); ?></a></li>
                		<li class="<?=$active_cms_sub1?>"><a href="<?php echo site_url($i18n.'cms/view_holidays_list') ?>"><?php echo ( sprintf( lang("LEFTMENU::holidays")) ); ?></a></li>
                		<li class="<?=$active_cms_sub2?>"><a href="<?php echo site_url($i18n.'cms/view_district_list') ?>"><?php echo ( sprintf( lang("LEFTMENU::district")) ); ?></a></li>
                		<li class="<?=$active_cms_sub3?>"><a href="<?php echo site_url($i18n.'cms/tag_list') ?>"><?php echo ( sprintf( lang("LEFTMENU::tag_list")) ); ?></a></li>
                	</ul>
                </li><?php } ?>

<?php if($mintervent == "1"){  ?>
                <li class="dropdown <?=$active_int?>"><a href="javascript:void(0)"><?php echo ( sprintf( lang("LEFTMENU::inter")) ); ?></a>
                	<ul <?=$show_int?>>
                		<!--<li class="<?=$active_int_sub?>"><a href="<?php echo site_url($i18n.'intervent') ?>"><?php echo ( sprintf( lang("LEFTMENU::interlist")) ); ?></a></li>-->
                		<?php /* if($sadd == "1"){ ?><li class="<?=$active_int_sub1?>"><a href="<?php echo site_url($i18n.'intervent/adddynamicform') ?>"><?php echo ( sprintf( lang("LEFTMENU::addinter")) ); ?></a></li><?php } */ ?>
                		<li class="<?=$active_int_sub2?>"><a href="<?php echo site_url($i18n.'intervent/interventtype') ?>"><?php echo ( sprintf( lang("LEFTMENU::intervent_type")) ); ?></a></li>

                	</ul>
                </li><?php } ?>

                <?php if($mcontract == "1"){  ?>
                <li class="dropdown <?=$active_cont?>"><a href="javascript:void(0)"><?php echo ( sprintf( lang("LEFTMENU::contract")) ); ?></a>
                	<ul <?=$show_cont?>>
                		<li class="<?=$active_cont_sub?>"><a href="<?php echo site_url($i18n.'contract') ?>"><?php echo ( sprintf( lang("LEFTMENU::contract_list")) ); ?></a></li>
                		<?php if($sadd == "1"){ ?><li class="<?=$active_cont_sub1?>"><a href="<?php echo site_url($i18n.'contract/addcontract') ?>"><?php echo ( sprintf( lang("LEFTMENU::add_contract")) ); ?></a></li><?php } ?>
                	</ul>
                </li><?php } ?>

               <?php if($mreport == "1"){  ?>
                <li class="dropdown <?=$active_rep?>"><a href="javascript:void(0)"><?php echo ( sprintf( lang("LEFTMENU::report_dash")) ); ?></a>
                	<ul <?=$show_rep?>>
                		<li class="<?=$active_rep_sub?>"><a href="<?php echo site_url($i18n.'report/operator_report') ?>"><?php echo ( sprintf( lang("LEFTMENU::opt_report")) ); ?></a></li>
                <li class="<?=$active_rep_sub1?>"><a href="<?php echo site_url($i18n.'report/req_intervent_report') ?>"><?php echo ( sprintf( lang("LEFTMENU::inv_report")) ); ?></a></li>
				<li class="<?=$active_rep_sub2?>"><a href="<?php echo site_url($i18n.'report/req_intervent_chart_report') ?>"><?php echo ( sprintf( lang("LEFTMENU::inv_chart_report")) ); ?></a></li>
				<li class="<?=$active_rep_sub3?>"><a href="<?php echo site_url($i18n.'report/patient_intervent_report') ?>"><?php echo ( sprintf( lang("LEFTMENU::inv_form")) ); ?></a></li>
                    </ul>
                </li><?php } ?>
	<?php if($stype == "1"){ ?>
                <li class="<?=$active_setting?>"><a href="<?php echo site_url($i18n.'setting/acl') ?>"><?php echo ( sprintf( lang("module_cont")) ); ?></a></li>
                <?php } ?>
				  <?php if($stype == "1"){  ?>
                <li class="dropdown <?=$active_session_setup?>"><a href="javascript:void(0)"><?php echo ( sprintf( lang("admin_setup")) ); ?></a>
                	<ul <?=$show_session ?>>
                		<li class="<?=$active_cont_sub?>"><a href="<?php echo site_url($i18n.'admin_session_setup') ?>"><?php echo ( sprintf( lang("LEFTMENU::session_list")) ); ?></a></li>
                		<?php if($sadd == "1"){ ?><li class="<?=$active_cont_sub1?>"><a href="<?php echo site_url($i18n.'admin_session_setup/add_admin_session_setup') ?>"><?php echo ( sprintf( lang("LEFTMENU::add_session")) ); ?></a></li><?php } ?>
                	</ul>
                </li><?php } ?>
			<?php if($stype == "1"){  ?>
                <li class="dropdown <?=$active_webservice?>"><a href="javascript:void(0)"><?php echo ( sprintf( lang("admin_webservice")) ); ?></a>
                	<ul <?=$show_webservice?>>
                		<li class="<?=$active_webservice?>"><a href="<?php echo site_url($i18n.'admin_webservice') ?>"><?php echo ( sprintf( lang("LEFTMENU::webservice_list")) ); ?></a></li>
                		<?php /*if($sadd == "1"){ ?><li class="<?=$active_cont_sub1?>"><a href="<?php echo site_url($i18n.'admin_webservice/add_webservice_url') ?>"><?php echo ( sprintf( lang("LEFTMENU::add_webservice")) ); ?></a></li><?php }*/ ?>
                	</ul>
                </li><?php } ?>	 
                
				
                		
                
            </ul>
        </div><!--leftmenu-->

    </div><!-- leftpanel -->
