<?php
	$front_common_lang = @lang ( 'front_common_home' );
	$arr_companyNewsDetail_lang = @$front_common_lang ['companyNewsDetail'];
// 	$arr_common_lang=@$front_common_lang['common'];
	
	$editor_lang=$arr_companyNewsDetail_lang['editor'];
	$introduction_lang=$arr_companyNewsDetail_lang['introduction'];
	$source_lang=$arr_companyNewsDetail_lang['source'];
	$keyword_lang=$arr_companyNewsDetail_lang['keyword'];
	
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
		 <div class="">
     	      <div class="position">·<?php echo get_position(@$cateId,TRUE);?><?='<h1>'.@$newsTitle.'</h1>'; ?></div>
     	      <?=@$imageDetail ?>
     	</div>
		 <div class="clear"></div>
		  <div class="detail padding10">
		  <div class="center"><?=@$newsTitle; ?></div>
		   <div class="center"><?=@$editor_lang.$editor;?>&nbsp;&nbsp;&nbsp;&nbsp;<?=@$introduction_lang.$description; ?></div>
     	      <?=@$content?>
     	     <div><em><?=@$source_lang.$source ?></em></div>
     	      <div><em><?=@$keyword_lang.$keywords ?></em></div>
     	   </div>
     	 <div class="w100"><img src="<?=$base_url; ?>assets/home/images/jx.jpg" border="0"></div>
	</div>
</div>
