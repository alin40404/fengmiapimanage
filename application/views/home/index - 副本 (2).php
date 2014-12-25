<?php
	$front_common_lang = @lang ( 'front_common_home' );
	$arr_index_lang = @$front_common_lang ['index'];
	$arr_common_lang=@$front_common_lang['common'];
// 	array_push($arr_index_lang, $arr_common_lang);
// 	$arr_index_lang=array_merge($arr_common_lang,$arr_index_lang);
// 	$inputSearch=$arr_index_lang['inputSearch'];
	$company=$arr_common_lang['company'];
	
	$hotNews=$arr_index_lang['hotNews'];
	$companyNews=$arr_index_lang['companyNews'];
	$productNews=$arr_index_lang['productNews'];
	$wonderfulVideo=$arr_index_lang['wonderfulVideo'];
	$recentNews=$arr_index_lang['recentNews'];
	$produc=$arr_index_lang['produc'];
	$news=$arr_index_lang['news'];
	$base_url=base_url();
	$site_url=site_url();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?=$title ?> 蜂觅 · API</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="蜂觅 API">
    <meta name="author" content="Allan 陈真林">
    <meta name="keywords" content="蜂觅  API">
    <!-- Le styles -->
    <link href="<?=$base_url; ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?=$base_url; ?>assets/home/css/docs.css" rel="stylesheet">
    <link href="<?=$base_url; ?>assets/home/css/prettify.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=$base_url; ?>assets/home/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=$base_url; ?>assets/home/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=$base_url; ?>assets/home/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="<?=$base_url; ?>assets/home/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="<?=$base_url; ?>assets/home/ico/favicon.png">

  </head>

  <body data-spy="scroll" data-target=".bs-docs-sidebar">

    <!-- Navbar
    ================================================== -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="./index.html">蜂觅</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="">
                <a href="?">首页</a>
              </li>
			  <?php echo get_home_navigator(@$cateId,@$lang); ?>
              <li class="">
                <a href="#" target="_blank">下载1.0.0版本</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

<!-- Masthead
================================================== -->
<header class="jumbotron subhead" id="overview">
  <div class="container">
    <!-- <h1>自定义及下载</h1> -->
    <p class="lead" style="text-align: center;">
	<?php if($title){
		echo $title;
	}else{
	?>
		蜂觅 · API · 1.0.0版本
	<?php } ?>
	</p>
  </div>
</header>

<?php 

$query = get_artonce(@$cateId,@$lang);
$count = count($query);

?>

  <div class="container">

    <!-- Docs nav
    ================================================== -->
    <div class="row">
      <div class="span3 bs-docs-sidebar">
        <ul class="nav nav-list bs-docs-sidenav">
		<?php
			if(!isNullOrEmpty($query)){
				foreach ($query as $key=>$obj){
					$content=toStripslashes(@$obj->content);
					$obj->content = $content;
					$query[$key] = $obj;
				}
			}
		?>
		
          <li><a href="#components"><i class="icon-chevron-right"></i> 1. 选择组件</a></li>
          <li><a href="#plugins"><i class="icon-chevron-right"></i> 2. 选择jQuery插件</a></li>
          <li><a href="#variables"><i class="icon-chevron-right"></i> 3. 自定义变量</a></li>
          <li><a href="#download"><i class="icon-chevron-right"></i> 4. 下载</a></li>
        </ul>
      </div>
      <div class="span9">


        <!-- Customize form
        ================================================== -->
          <section class="download" id="components">
            <div class="page-header">
              <a class="btn btn-small pull-right toggle-all" href="#">全选/全取消</a>
              <h1>
                1. 选择组件
              </h1>
            </div>
            <div class="row download-builder">
              <div class="span3">
		        
              </div><!-- /span -->
            </div><!-- /row -->
          </section>

		  
          <section class="download" id="plugins">
            <div class="page-header">
              <a class="btn btn-small pull-right toggle-all" href="#">全选/全取消</a>
              <h1>
                2. 选择jQuery插件
              </h1>
            </div>
            <div class="row download-builder">
              <div class="span3">

              </div><!-- /span -->
              <div class="span3">
                <h4 class="muted">注意!</h4>
                <p class="muted">所有选中的插件将会被编译成一个单独文件, bootstrap.js. 所有插件都需要包含最新版本的 <a href="http://jquery.com/" target="_blank">jQuery</a>.</p>
              </div><!-- /span -->
            </div><!-- /row -->
          </section>


          <section class="download" id="variables">
            <div class="page-header">
              <a class="btn btn-small pull-right toggle-all" href="#">重置</a>
              <h1>
                3. 自定义变量
              </h1>
            </div>
            <div class="row download-builder">
              <div class="span3">

              </div><!-- /span -->
              <div class="span3">

              </div><!-- /span -->
              <div class="span3">

              </div><!-- /span -->
            </div><!-- /row -->
          </section>

          <section class="download" id="download">
            <div class="page-header">
              <h1>
                4. 下载
              </h1>
            </div>
            <div class="download-btn">
              <a class="btn btn-primary" href="#" >定制下载</a>
              <h4>包含哪些内容?</h4>
              <p>下载内容包含已编译和压缩版本的CSS, JS, 和jQuery. 为了你的方便, 我们都把所有东西都打包(zip)好了.</p>
            </div>
          </section>
		  <!-- /download -->

      </div>
    </div>

  </div>



    <!-- Footer
    ================================================== -->
    <footer class="footer">
      <div class="container">
        <ul class="footer-links">
          <li><a href="#">博客</a></li>
          <li class="muted">&middot;</li>
          <li><a href="#">问题</a></li>
          <li class="muted">&middot;</li>
          <li><a href="#">更改日志</a></li>
        </ul>
      </div>
    </footer>



    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>-->
    <script src="<?=$base_url; ?>assets/jquery-1.7.2.min.js"></script>
    <script src="<?=$base_url; ?>assets/bootstrap/js/bootstrap.min.js"></script>

    <script src="<?=$base_url; ?>assets/bootstrap/js/holder.js"></script>
    <script src="<?=$base_url; ?>assets/bootstrap/js/prettify.js"></script>

    <script src="<?=$base_url; ?>assets/bootstrap/js/application.js"></script>
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-34583971-1']);
      _gaq.push(['_trackPageview']);
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>


  </body>
</html>

