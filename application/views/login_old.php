<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.1
Version: 3.6
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Huda Platform Login</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url() ?>assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>assets/admin/pages/css/login-soft.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url() ?>assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?php echo base_url() ?>assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<style>
 #username-error, #password-error, #CaptchaInput-error {
    color:red;
    }  
.forget_password{
     color: red;
}
</style>
<style type="text/css">
      .capbox {
  background-color: #bdc0ba;
  /*border: #B3E272 0px solid;*/
      width: 100%;
  border-width: 0px 12px 0px 0px;
  display: inline-block;
  *display: inline; zoom: 1; /* FOR IE7-8 */
  padding: 8px;
  }

.capbox-inner {
  font: bold 11px arial, sans-serif;
  color: #000000;
  /*background-color: #DBF3BA;*/
  margin: 5px auto 0px auto;
  padding: 3px;
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  border-radius: 4px;
  }

#CaptchaDiv {
  font: bold 20px verdana, arial, sans-serif;
  font-style: italic;
  color: #6a6a6a;
   float: left;
    width: 85%;
  /*background-color: #FFFFFF;*/
  background-image: url("./assets/img/captcha_bg.jpeg");
  padding: 4px;
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  border-radius: 4px;
 letter-spacing:5px;
  text-align: center;
  }

#CaptchaInput { margin: 1px 0px 1px 0px; width: 100%; }
.refreshCaptcha{font-size: 14px;}
    </style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="#">
		<img src="<?php echo base_url() ?>image/Logo.png" alt="" style="margin-bottom: -2%; width:25%">
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<?php

if($this->session->flashdata('item')) {
$message = $this->session->flashdata('item');
?>
<div class="<?php echo $message['class'] ?>" style="color: red;
text-align: center;
height: auto;font-size: 15px;"><?php echo $message['message']; ?>

</div>
<?php
}

?>
  <?php  echo validation_errors(); ?>
	<!-- BEGIN LOGIN FORM -->
	<form class="form-horizontal m-t-20" id="loginform" action="<?php echo base_url(); ?>user/login" method="post" autocomplete="off" >
                        <?php echo form_open(); ?>
                        <div class="form-group ">
                            <div class="col-xs-12">
                               <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="username" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                               <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="capbox">
                                    <div id="CaptchaDiv"> </div>
                                    <div>
                                     <button type="button" class="btn btn-default btn-sm refreshCaptcha">
                                     <span class="glyphicon glyphicon-refresh"></span> 
                                      </button>
                                      </div>
                                    <div class="capbox-inner">
                                        Type the above number:<br>
                                        <input type="hidden"   id="txtCaptcha">
                                        <input type="text"  class="form-control form-control-solid placeholder-no-fix" name="CaptchaInput" id="CaptchaInput" size="15"><br>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center m-t-30">
                            <div class="col-xs-12">
                                <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" id="h_login"  type="submit">Log In</button>
                            </div>
                        </div>
                        <div class="clearfix clear"><a class="forget_password" href="<?php echo base_url(); ?>user/forgotpassword"><i>Forgot / Change Password ?</i></a></div>

                       <!-- <div class="form-group m-t-30 m-b-0">
                            <div class="col-sm-12">
<a href="javascript:;" id="forget-password" class="forget-password"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                            </div>
                        </div>-->
                    </form>
	
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->

<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url() ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url() ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js" type="text/javascript"></script>

<script src="<?php echo base_url() ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url() ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url() ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/admin/pages/scripts/login-soft.js" type="text/javascript"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
  Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
 	Login.init();
  	Demo.init();
       // init background slide images
       $.backstretch([
        "<?php echo base_url() ?>assets/admin/pages/media/bg/1.jpg",
        "<?php echo base_url() ?>assets/admin/pages/media/bg/2.jpg",
        "<?php echo base_url() ?>assets/admin/pages/media/bg/3.jpg",
        "<?php echo base_url() ?>assets/admin/pages/media/bg/4.jpg"
        ], {
          fade: 1000,
          duration: 8000
    }
    );
});
</script>
<script type="text/javascript">
	$.validator.addMethod("noSpecial", function(value, element) {
	var regex = /^[a-zA-Z0-9/_-]+$/;
	    if (regex.test(value) || !value) {
        return true;
    }
    return false;
}, "No special characters allowed except '/ - _'");

        $("#loginform").validate({
            rules: {
                "username": {
                    required : true,
                    maxlength: 1000

                },
                "password": {
                    required : true,
                    maxlength: 50

                },
                CaptchaInput:{
                    required: true,
                    maxlength: 6,
                    minlength: 6
                }
            },
            messages: {
                    username: "Please enter email !",
                    password: "Please enter password !",
            }
        });

    </script>
<!-- <script type="text/javascript">
	  function recaptcha_callback() {
	       $('#h_login').removeAttr('disabled');
	    };                                 
</script> -->
<script>
$(document).ready(function(){
    captcha_request();
});


$(document).ready(function() {
  $('.refreshCaptcha').on('click', function(){
    captcha_request();
  });
});

function captcha_request(){
  jQuery.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>" + "user/created_captcha",
    dataType: 'json',
    success: function(res) {
      if (res)
      {
          // Show Entered Value
        //console.log(res);
        jQuery("#CaptchaDiv").html(res.custom_cap);
      }
    }
  });
}
</script>
<script type="text/javascript">
$(document).ready(function () {
    //Disable cut copy paste
    $('body').bind('cut copy paste', function (e) {
        e.preventDefault();
    });
   
    //Disable mouse right click
    $("body").on("contextmenu",function(e){
        return false;
    });
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>