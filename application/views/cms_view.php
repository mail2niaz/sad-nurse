<?php $this->load->view('common/head'); ?>
<body>
<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>


    <div class="rightpanel">

        <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
            <div class="pagetitle">
                <h1><?php echo lang("dashboard"); ?></h1>
            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span8">
                        <ul class="shortcuts">
                            <li class="events">
                                <a href="<?php echo site_url($i18n.'cms/rolelist') ?>">
                                    <span class="shortcuts-icon iconsi-event"></span>
                                    <span class="shortcuts-label"><?php echo lang("role"); ?></span>
                                </a>
                            </li>
                            <li class="events">
                                <a href="<?php echo site_url($i18n.'cms/view_holidays_list') ?>">
                                    <span class="shortcuts-icon iconsi-event"></span>
                                    <span class="shortcuts-label"><?php echo lang("holidays"); ?></span>
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