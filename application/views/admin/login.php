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
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/validform/css/style.css" type="text/css" media="all">
<link rel="stylesheet" type="text/css"
	href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css"
	href="<?php echo base_url(); ?>assets/admin/css/theme.css">
<link rel="stylesheet"
	href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css">

<script src="<?php echo base_url(); ?>assets/jquery-1.9.1.min.js"
	type="text/javascript"></script>

<!-- Demo page code -->

<style type="text/css">
#line-chart {
	height: 300px;
	width: 800px;
	margin: 0px auto;
	margin-top: 1em;
}

.brand {
	font-family: georgia, serif;
}

.brand .first {
	color: #ccc;
	font-style: italic;
}

.brand .second {
	color: #fff;
	font-weight: bold;
}
.login-valid-img{
	margin-bottom: 10px;
	cursor: pointer;
}

</style>

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>

<!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
<!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
<!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
<!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<body class="">
	<!--<![endif]-->
      <?php echo get_navbar();?>
        <div class="row-fluid">
    <div class="dialog">
        <div class="block ">
            <p class="block-heading"><i class="icon-user"></i>&nbsp;请&nbsp;登&nbsp;录</p>
            <div class="block-body admin_login_bg">
                <form class="loginform" method="post" action="<?php echo site_url(); ?>/admin/login">
                <div>
                    <label>用户名<span class="Validform_label"></span></label>
                    <input type="text" value="<?=@$userName;?>" name="userName" class="span6" nullmsg="请输入用户名！" datatype="s4-20" errormsg="至少4个字符,最多20个字符！"  />
                </div>
                <div>
                    <label>密码<span class="Validform_label"></span></label>
                    <input type="password" name="password" class="span6" nullmsg="请输入密码！" datatype="*6-15" errormsg="密码范围在6~15位之间！">
                 </div>
                 <div>
                     <label>验证码</label>
                    <input type="text" name="validCode" class="span4" nullmsg="请输入验证码！" datatype="s4-4" errormsg="验证码不正确！">
                    <img class="login-valid-img" src="<?php echo site_url(); ?>/common/proValidCode" style="vertical-align:middle;" onclick="this.src='<?php echo site_url(); ?>/common/proValidCode?r='+Math.random()">
                   </div>
                   <input type="hidden" name="redirect" value="<?=@$redirect?>" />
                    <button type="submit"  class="btn btn-primary pull-right" data-loading-text="正在登录">登&nbsp;录</button>
<!--                     <label class="remember-me"><input name="rememberMe" type="checkbox">记住我</label> -->
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
        <p><a href="#">忘记密码?</a></p>
    </div>
</div>

<?php echo get_footer(); ?>
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/Validform/js/Validform_v5.3.2_min.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
        $(function(){
        	$(".loginform").Validform({
        		tiptype:3,
        		label:".label",
        		showAllError:true,
        		datatype:{
        			//"zh1-6":/^[\u4E00-\u9FA5\uf900-\ufa2d]{1,6}$/
        		},
        		//ajaxPost:true
            });
        });
    </script>
  
  </body>
</html>


    