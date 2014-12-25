<?php
	$front_common_lang = @lang ( 'front_common_home' );
	$arr_productsDetail_lang = @$front_common_lang ['service'];
// 	$arr_common_lang=@$front_common_lang['common'];
	
	$product_lang=$arr_productsDetail_lang['product'];
	$description_lang=$arr_productsDetail_lang['description'];
// 	$source_lang=$arr_productsDetail_lang['source'];
// 	$keyword_lang=$arr_productsDetail_lang['keyword'];
	
	$base_url=base_url();
	$site_url=site_url();
?>


<style type="text/css">
.detail,.detail p {
	line-height: 30px;
}
.feedback{
	border-left: solid 1px #DDDFDD;
	font-size:16px;
}
.feedback h3{
color: #1370AB;
padding: 0px;
margin: 0px;
display: inline;
}
.feedback input,.feedback p{
line-height: 26px;
}
.feedback input[type=text],.feedback textarea{
	height: 26px;
	padding: 3px;border: 1px solid #8B9DAA;
}
.feedback ._button{
	padding: 1px 20px;border: 1px solid #8B9DAA;font-size: 0.9em;cursor: pointer;
}
.feedback p{
	padding:5px;
}
.feedback .Validform_checktip{
	display: inline-block;
}
</style>
<!-- content -->
<div class="content">
       <?php echo get_banner(@$cateId,@$lang);?>   
    <div class="main">
		<div class="w100">
			<img src="<?=$base_url; ?>assets/home/images/jx.jpg" border="0">
		</div>
		<div class="position">·<?php echo get_position(@$cateId);?></div>
		<div class="clear"></div>
		<div class="feedback detail floatR padding10 " style="width: 48%;">
			<form action="<?=@$site_url.'/home/feedback'?>" method="post" class="formTable">
			<div><h3>留言反馈：</h3></div>
			<p><label>邮箱：</label><label><input type="text" datatype="e" nullmsg="请填写" errormsg="填写有误"  name="email" value="" />
					</label><span></span>
				</p>
				<p>
					<label>标题：</label><label><input type="text" datatype="*2-100" nullmsg="请填写" errormsg="填写有误" name="title" value="" /></label>
				<span></span></p>
				<p>
					<label>建议：</label><label><textarea type="textaera" name="content"
							datatype="*2-200" style="width: 300px; height: 100px;"
							nullmsg="请填写" errormsg="字符不得多于200，填写有误" ></textarea></label>
				<span></span></p>
				<p style="text-align: center;">
					<label><input class="_button" type="submit" value="提交" /></label>
					<label><input class="_button" type="reset"  value="重置" /></label>
				</p>
			</form>
			<?php echo get_formTable_jsCss();?>
			<div class="clear"></div>
		</div>
		<div class="width50">
			<div class="detail padding10">
     	      <?php echo get_artonce(@$cateId,@$lang);?>
     	 </div>
		</div>
		<div class="clear"></div>

		<div class="w100">
			<img src="<?=$base_url; ?>assets/home/images/jx.jpg" border="0">
		</div>
	</div>
</div>
