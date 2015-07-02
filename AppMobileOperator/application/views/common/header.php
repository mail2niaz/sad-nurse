<!--
  <div class="header">
        <div class="logo">
            <a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>images/logo.png" alt="" /></a>
            <span><?php echo $this->config->item('title'); ?></span>
        </div>
        <div class="headerinner">
            <ul class="headmenu">
                <li class="right">
                    <div class="userloggedinfo">
                        <div class="userinfo">
                            <h5><?php $username = $this->session->userdata('logged_in');
                            	echo $username['username'];
                            	?></h5>
                            <ul>
                                <li><a href="<?php echo base_url()?>index.php/home/logout"><?php echo ( sprintf( lang("sign_out")) ); ?></a></li>
                                <li><?php echo langbar();  ?></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul><!--headmenu
        </div>
    </div>-->




<div class="header">
        <div class="logo">
            <a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>images/logo.png" alt="" /></a>
        </div>
        <div class="headerinner">
            <ul class="headmenu">
                <li class="right">
                    <div class="userloggedinfo">
                        <img src="<?php echo base_url()?>images/icons/users.png" alt="" />
                        <div class="userinfo">
                            <h5><?php $username = $this->session->userdata('logged_in');
                            	echo $username['username'];
                            	?></h5>
                            <ul>
                                <li><a href="<?php echo base_url()?>index.php/home/logout"><?php echo ( sprintf( lang("sign_out")) ); ?></a></li>
                                <li><?php echo langbar();  ?></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul><!--headmenu-->
        </div>
    </div>