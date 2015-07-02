<?php $this->load->view('common/head'); ?>
<body>
<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>


    <div class="rightpanel">

        <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
            <div class="pagetitle">
                <h1><?php echo ( sprintf( lang("setting")) ); ?></h1>
            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span8">
                        <ul class="shortcuts">
                            <li class="events">
                            	<a href="<?php echo site_url($i18n.'setting/changepassword') ?>">
                                    <span class="shortcuts-icon iconsi-event"></span>
                                    <span class="shortcuts-label"><?php echo ( sprintf( lang("cpass")) ); ?></span>
                                </a>
                            </li>
                            <li class="events">
                                <a href="<?php echo site_url($i18n.'setting/adminuserlist') ?>">
                                    <span class="shortcuts-icon iconsi-event"></span>
                                    <span class="shortcuts-label"><?php echo ( sprintf( lang("admin_user")) ); ?></span>
                                </a>
                            </li>
                            <li class="archive">
                                <a href="<?php echo site_url($i18n.'setting/acl') ?>">
                                    <span class="shortcuts-icon iconsi-archive"></span>
                                    <span class="shortcuts-label"><?php echo ( sprintf( lang("acl")) ); ?></span>
                                </a>
                            </li>
                            <li class="archive">
                                <a href="<?php echo site_url($i18n.'setting/admintypelist') ?>">
                                    <span class="shortcuts-icon iconsi-archive"></span>
                                    <span class="shortcuts-label"><?php echo ( sprintf( lang("admin_type")) ); ?></span>
                                </a>
                            </li>
                            <li class="archive">
                                <a href="<?php echo site_url($i18n.'setting/default_starting_point_address/view/1') ?>">
                                    <span class="shortcuts-icon iconsi-archive"></span>
                                    <span class="shortcuts-label"><?php echo ( sprintf( lang("default_starting_point")) ); ?></span>
                                </a>
                            </li>
                        </ul>

                    </div><!--span8-->
                </div><!--row-fluid-->

            </div><!--maincontentinner-->
        </div><!--maincontent-->

    </div><!--rightpanel-->

</div><!--mainwrapper-->
<?php $this->load->view('common/footer'); ?>