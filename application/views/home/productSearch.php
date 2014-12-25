<style type="text/css">
	.detail,.detail p{
		line-height:30px;
	}
	#page{
		width:100%;
	}
</style>
<!-- content -->
<div class="content">
       <?php //echo get_banner(@$cateId,@$lang);?>   
    <div class="main">
		<div class="w100"><img src="<?php echo base_url(); ?>assets/home/images/jx.jpg" border="0"></div>
		 <div class="">
     	      <div class="position">·<?=@$searchResultLang;?><?='<h1>'.@$search.'</h1>'; ?></div>
     	      <?=@$searchResult ?>
     	</div>
		 <div class="clear"></div>
		  <div class="detail padding10">
     	   </div>
     	 <div class="w100"><img src="<?php echo base_url(); ?>assets/home/images/jx.jpg" border="0"></div>
	</div>
</div>
