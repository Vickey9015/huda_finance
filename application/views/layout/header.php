<!DOCTYPE html>

<head>
<meta charset="utf-8"/>
<title>IPAY Platform | Indusind</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<meta http-equiv="refresh" content="900;url=<?php echo base_url() ?>" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">

<script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.1/angular.min.js"></script>
<script type="text/javascript"  src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script>
<script type="text/javascript"  src="https://cdnjs.cloudflare.com/ajax/libs/angular-resource/1.6.2/angular-resource.min.js" type="text/javascript"></script>
  <!-- Angular Material Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>
  
<script src="<?php echo base_url() ?>assets/js/apiCtrl.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>
		$(document).ready(function () {
			$(".toggle-sidebar").click(function () {
				$("#sidebar").toggleClass("collapsed");
				$("#content").toggleClass("side_b col-md-11 col-md-10");
				
				$(".aside_bar ul li a").toggleClass("tog_pic")
				
				return false;
			});
		});
	</script>


<body class="page-header-fixed page-quick-sidebar-over-content" ng-app="app">
    <div class="container-fluid">
  <div class="row">
    
