<?php $this->load->view('common/head'); ?>
<body>
<div id="mainwrapper" class="mainwrapper">
    <?php $this->load->view('common/header'); ?>
    <?php $this->load->view('common/left_menu'); ?>


    <div class="rightpanel">

        <?php $this->load->view('breadcrumb'); ?>

        <div class="pageheader">
            <div class="pagetitle">
                <h1><?php echo lang("HOME::dashboard"); ?></h1>
            </div>
        </div><!--pageheader-->

        <div class="maincontent">
            <div class="maincontentinner">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span8">
                        <ul class="shortcuts">
							<?php if($mopt == "1"){  ?>
                        	<li class="archive">
                                <a href="<?php echo site_url($i18n.'operator/operatorlist') ?>">
                                    <span class="shortcuts-icon iconsi-archive"></span>
                                    <span class="shortcuts-label"><?php echo lang("HOME::operator_info"); ?></span>
                                </a>
                            </li>
                        	<?php if($sadd == '1'){ ?>
                            <li class="events">
                                <a href="<?php echo site_url($i18n.'operator') ?>">
                                    <span class="shortcuts-icon iconsi-event"></span>
                                    <span class="shortcuts-label"><?php echo lang("HOME::add_operator"); ?></span>
                                </a>
                            </li>
                            <?php } } ?>

                            <?php if($mpat == "1"){  ?>
                            <li class="help">
                                <a href="<?php echo site_url($i18n.'patient/patientlist') ?>">
                                    <span class="shortcuts-icon iconsi-help"></span>
                                    <span class="shortcuts-label"><?php echo lang("HOME::patient_info"); ?></span>
                                </a>
                            </li>
                            <?php if($sadd == '1'){ ?>
                            <li class="events">
                                <a href="<?php echo site_url($i18n.'patient') ?>">
                                    <span class="shortcuts-icon iconsi-event"></span>
                                    <span class="shortcuts-label"><?php echo lang("HOME::add_patient"); ?></span>
                                </a>
                            </li>
                             <?php }
							/*

                            $query_info = $this->db->query("SELECT * FROM patients_info_details where status = '2'");
							$info_cnt = $query_info->num_rows();
                             ?>
                             <li class="events">
                                <a href="<?php echo site_url($i18n.'patient/patientlist') ?>">
                                    <span class="shortcuts-icon"><h1><?=$info_cnt?></h1></span>
                                    <span class="shortcuts-label"><?php echo lang("HOME::pending_patient_info"); ?></span>
                                </a>
                            </li>

                             <?php */ } ?>

							<?php if($mreport == "1"){  ?>
                            <li class="last images">
                                <a href="<?php echo site_url($i18n.'report') ?>">
                                    <span class="shortcuts-icon iconsi-images"></span>
                                    <span class="shortcuts-label"><?php echo lang("HOME::reports"); ?></span>
                                </a>
                            </li>
								<?php } ?>

							<?php if($mjob == "1"){  ?>
                            <li class="last images">
                                <a href="<?php echo site_url($i18n.'jobassign') ?>">
                                    <span class="shortcuts-icon iconsi-images"></span>
                                    <span class="shortcuts-label"><?php echo lang("HOME::job"); ?></span>
                                </a>
                            </li>
                            <?php } ?>

                            <?php if($mintervent == "1"){  ?>
                            <li class="last images">
                                <a href="<?php echo site_url($i18n.'intervent') ?>">
                                    <span class="shortcuts-icon iconsi-images"></span>
                                    <span class="shortcuts-label"><?php echo lang("HOME::inter"); ?></span>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>

                    </div><!--span8-->
                </div><!--row-fluid-->

            </div><!--maincontentinner-->
        </div><!--maincontent-->

    </div><!--rightpanel-->

</div><!--mainwrapper-->
<?php $this->load->view('common/footer'); ?>