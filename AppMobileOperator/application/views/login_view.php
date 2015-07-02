<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Coopselios S.A.D.</title>
<link rel="stylesheet" href="<?php echo $this->config->item('base_url'); ?>css/style.default.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->config->item('base_url'); ?>css/theme.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->config->item('base_url'); ?>css/style_custom.css" type="text/css" />

<script type="text/javascript" src="<?php echo $this->config->item('base_url'); ?>js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url'); ?>js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url'); ?>js/jquery-ui-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url'); ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url'); ?>js/jquery.cookie.js"></script>
</head>
<body class="loginpage">
<div class="loginpanel">
    <div class="loginpanelinner">
    	 <?php echo langbar();  ?>
        <div class="logo animate0 bounceIn"><?php echo lang($loginlogo); ?> </div>
          <?php if(validation_errors()){ ?> <div class="alert alert-error"><?php echo validation_errors(); ?></div> <?php } ?>

           <?php $attributes = array('id' => 'process');
           echo form_open('verifylogin',$attributes); ?>
            <div class="inputwrapper animate1 bounceIn">
                <input type="text" name="username" id="username" placeholder="<?php echo lang($ph_username); ?>" />
            </div>
            <div class="inputwrapper animate2 bounceIn">
                <input type="password" name="password" id="password" placeholder="<?php echo lang($ph_password); ?>" />
            </div>
            <div class="inputwrapper animate3 bounceIn">
                <button name="submit"><?php echo lang($signin); ?></button>
            </div>
        </form>
    </div><!--loginpanelinner-->
</div><!--loginpanel-->

<!--
<div class="loginfooter">
    <p>&copy; 2013. Coopselios S.A.D. &raquo; All Rights Reserved.</p>
</div>-->

</body>
</html>