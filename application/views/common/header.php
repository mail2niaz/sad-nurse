  <div class="header">
        <div class="logo">
            <a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>images/logo.png" alt="" /></a>
            <h4 style="color: #ffffff; float: left; margin-left: 0px;width: 350px;"><?=$this->config->item('title')?></h4>
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
                            	<?php if($stype == "1"){ ?>
                                <li><a href="<?php echo site_url($i18n.'setting') ?>"><?php echo ( sprintf( lang("account_settings")) ); ?></a></li><?php } ?>
                                <li><a href="<?php echo base_url()?>?c=home&m=logout"><?php echo ( sprintf( lang("sign_out")) ); ?></a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul><!--headmenu-->
        </div>
    </div>