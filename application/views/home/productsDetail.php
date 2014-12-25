<?php
	$front_common_lang = @lang ( 'front_common_home' );
	$arr_productsDetail_lang = @$front_common_lang ['productsDetail'];
// 	$arr_common_lang=@$front_common_lang['common'];
	
	$product_lang=$arr_productsDetail_lang['product'];
	$description_lang=$arr_productsDetail_lang['description'];
// 	$source_lang=$arr_productsDetail_lang['source'];
// 	$keyword_lang=$arr_productsDetail_lang['keyword'];
	
	$base_url=base_url();
	$site_url=site_url();
?>


<style type="text/css">
	.detail,.detail p{
		line-height:30px;
	}
</style>
<!-- content -->
<div class="content">
       <?php echo get_banner(@$cateId,@$lang);?>   
    <div class="main">
		<div class="w100"><img src="<?=$base_url; ?>assets/home/images/jx.jpg" border="0"></div>
		 <div class="position">·<?php echo get_position(@$cateId,TRUE);?><?='<h1>'.@$proTitle.'</h1>'; ?></div>
		 <div class="detail floatR padding10 width40" style="width: 38%;">
			<p><?=@$product_lang.$proTitle?></p>
			<p><?=@$description_lang.$description?></p>
			<div class="clear"></div>
		</div>
		 <div class="width60">
     	     <div class="productDetail"	>
	     	     <?=@$imageDetail ?>
	     	     <div class="clear"></div>
     	     </div>
     	</div>
		 <div class="clear"></div>
		  <div class="detail padding10">
     	      <?php echo get_artonce(@$cateId,@$lang);?>
     	      </div>
     	 <div class="w100"><img src="<?=$base_url; ?>assets/home/images/jx.jpg" border="0"></div>
	</div>
</div>
