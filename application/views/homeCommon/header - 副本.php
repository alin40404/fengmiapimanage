<?php
	$front_common_lang = @lang ( 'front_common_home' );
	$arr_header_lang = @$front_common_lang ['header'];
	$arr_common_lang=@$front_common_lang['common'];
// 	array_push($arr_header_lang, $arr_common_lang);
// 	$arr_header_lang=array_merge($arr_common_lang,$arr_header_lang);
	$inputSearch=$arr_header_lang['inputSearch'];
	$company=$arr_common_lang['company'];
	
	$base_url=base_url();
	$site_url=site_url();
?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title><?=@$title.'-'.$company; ?></title>
<link href="<?=$base_url; ?>assets/favicon.ico"
	type="image/x-icon" rel="shortcut icon">
<link type="text/css" rel="stylesheet"
	href="<?=$base_url; ?>assets/home/css/base.css">
<link type="text/css" rel="stylesheet"
	href="<?=$base_url; ?>assets/home/css/banner.css">
<link type="text/css" rel="stylesheet"
	href="<?=$base_url; ?>assets/home/css/style.css">
<link type="text/css" rel="stylesheet"
	href="<?=$base_url; ?>assets/home/css/common.css">
<link type="text/css" rel="stylesheet"
	href="<?=$base_url; ?>assets/home/css/page.css">
<script type="text/javascript"
	src="<?=$base_url; ?>assets/home/js/jquery-1.7.2.js"></script>
<script type="text/javascript"
	src="<?=$base_url; ?>assets/home/js/banner.js"></script>
<script type="text/javascript"
	src="<?=$base_url; ?>assets/home/js/function.js"></script>
<script type="text/javascript"
	src="<?=$base_url; ?>assets/home/js/common.js"></script>
</head>
<body>
	<div class="container">
		<!-- header -->
		<div class="header">
			<div class="logo">
				<a href="" target="_self" title="<?=$company?>"> <img
					src="<?=$base_url; ?>assets/home/images/logo.png"
					alt="logo"></a>
			</div>
			<div id="nav0" class="nav">
				<ul class="f_right">
					<li class="link"><a href="<?php echo $site_url.'?lang=zh_cn';?>"
						target="_self" title="<?=$company?>">中文</a></li>
					<li>|</li>
					<li class="link"><a href="<?php echo $site_url.'?lang=english';?>"
						target="_self" title="<?=$company?>">English</a></li>
				</ul>
				<div class="clear"></div>
				<div class="search f_right">
					<form method="get" action="<?=$site_url?>/home/productSearch">
						<input name="search" type="text" class="input_search" value="<?=$inputSearch?>" onfocus="OnFocusFun(this,'<?=$inputSearch?>');" onblur="OnBlurFun(this,'<?=$inputSearch?>');"> 
						<img title="" alt="" src="<?=$base_url; ?>assets/home/images/search.jpg" class="btn_search" />
<!-- 						<input type="submit" value="submit" /> -->
					</form>
				</div>

			</div>
			<div class="clear"></div>
			<div id="navigator" class="nav">
              <?php echo get_home_navigator(@$cateId,@$lang); ?>
        </div>
			<div class="clear"></div>
		</div>