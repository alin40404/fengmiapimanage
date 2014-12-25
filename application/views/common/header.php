<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>蜂觅API-后台管理-<?=@$title?></title>
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="蜂觅API">
<meta name="author" content="蜂觅API">
<link href="<?php echo base_url(); ?>assets/admin/images/favicon.ico" type="image/x-icon" rel="shortcut icon">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/css/theme.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/dialog/dialog.css"  />
<script src="<?php echo base_url(); ?>assets/jquery-1.7.2.min.js" type="text/javascript"></script>

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php 
		$sidebarStatus=session("sidebarStatus");
		$sidebarWidth=session("sidebarWidth");

        if ($sidebarStatus=="close"){
            $sidebarWidth=0;
        }else{
			//$marginLeft ="";
			//$left="";
			if(isNullOrEmpty($sidebarWidth)){$sidebarWidth=180;}
		}
		$marginLeft = "margin-left:".$sidebarWidth.'px;';
		$left="left:".$sidebarWidth.'px;';
		//$width="width:".$sidebarWidth.'px;';
 ?>
</head>
<style type="text/css">
	body>.content{<?=@$marginLeft ?>}
	body>.sidebar-nav{<?=@$width ?>}
	#menuResize{<?=@$left ?>}
</style>
        <script type="text/javascript">
			$(function(){
				$("body>.content").attr("status",'<?=@$sidebarStatus?>');
				$("body>.content").attr("sidebarWidth",'<?=@$sidebarWidth?>');
				$("body>.content").attr("id",'content');
		    });
        </script>
<!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
<!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
<!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
<!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<body class="">
<!--<![endif]-->
<?php echo get_navbar();?>
<?=@$sideNavBar?>
