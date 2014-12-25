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
// 	$base_url=base_url();
// 	$site_url=site_url();
?>
<!-- content -->
<div class="content">
       <?php echo get_banner(@$cateId,@$lang);?>   
        <div class="main">
		<div class="hot_news">
			<table class="hot_news">
				<tbody>
					<tr>
						<td class="news_title" style="">
							<div class="scrollNews" style="margin: 0 0 0 10px;">
								<h3 style=""><?=$hotNews;?></h3>
								<ul style="margin-top: 0px;">
									<?php echo getHotNewsLists('',@$lang);?>
								</ul>
								<div class="clear"></div>
							</div>
						</td>
						<td class="news_content news_mount" style="">4/7</td>
						<td class="news_content news_link" style="">
							<div id="news_link1" class="h_news_link block_news_link">
								<span><a href="" target="_self"><?=$companyNews;?></a></span><span>|</span> <span><a
									href="" target="_self"><?=$productNews;?></a></span><span>|</span> <span><a
									style="color: red;" href="" target="_self"><?=$wonderfulVideo;?></a></span>
							</div>
							<div id="news_link2" class="h_news_link ">
								<span><a href="" target="_self"><?=$news;?></a></span><span>|</span> <span><a
									href="" target="_self"><?=$produc;?></a></span>
<!-- 									<span>|</span> <span><a style="color: red;" href="" target="_self">视频</a></span> -->
							</div>
						</td>
						<td class="news_content news_nav"><span class="arrow_left">&nbsp;&nbsp;&nbsp;&nbsp;</span>
							<span class="arrow_right">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="products">
			<div class="recent_news new" style="height: 180px;">
				<h4><?=$recentNews;?></h4>
				<ol>
				<?php echo getTopNewsList(@$lang,4);?>
				</ol>
			</div>
			<div class="recent_news productsShow" style="height: 180px;">
				<h4><?=$produc; ?></h4>
				<ol>
				<?php echo getHotProduct(@$lang,6);?>
				</ol>
			</div>
			<div class="clear"></div>
		</div>
		<div class="artonceContain">
		<?php echo get_artonce(@$cateId,@$lang);?>
		</div>
	</div>
</div>
<script type="text/javascript">
	    $(function () {
           var settime;
		   var li=$(".scrollNews ul li");//获取新闻的数量
		   var one=1;
		   var len=li.length;
		   if(len<1){one=0;}
		    var str=one+"/"+len;
			$(".news_mount").html(str);
            $(".scrollNews").hover(function () {
               clearInterval(settime);
           }, function () {
              settime = setInterval(function () {
                    var $first = $(".scrollNews ul:first");     //选取div下的第一个ul 而不是li；
					var height = $first.find("li:first").height();      //获取第一个li的高度，为ul向上移动做准备；
                    $first.animate({ "marginTop": -height + "px" }, 600, function () {
                        $first.css({ marginTop: 0 }).find("li:first").appendTo($first); //设置上边距为零，为了下一次移动做准备
                     	 ++one;
						 str=one+"/"+len;
						$(".news_mount").html(str);
						if(one>=len){
							one=0;
						}
						
                    });
                 }, 3000);
            }).trigger("mouseleave");       //trigger()方法的作用是触发被选元素的制定事件类型
            
			$(".news_nav .arrow_left").mousemove(function(){
				$(this).addClass("arrow_move_left");	
			});
			$(".news_nav .arrow_left").mouseleave(function(){
				$(this).removeClass("arrow_move_left");	
			});
			$(".news_nav .arrow_right").mousemove(function(){
				$(this).addClass("arrow_move_right");	
			});
			$(".news_nav .arrow_right").mouseleave(function(){
				$(this).removeClass("arrow_move_right");	
			});
			$(".arrow_left").click(function(){
				$("#news_link2").removeClass("block_news_link");
				$("#news_link1").addClass("block_news_link");
				
			});
			$(".arrow_right").click(function(){
			    $("#news_link1").removeClass("block_news_link");
				$("#news_link2").addClass("block_news_link");
				
			});
         });
    </script>
