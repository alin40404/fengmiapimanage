<!-- content -->
<div class="content">
       <?php echo get_banner(@$cateId,@$lang);?>   
    <div class="main">
		<div class="w100"><img src="<?php echo base_url(); ?>assets/home/images/jx.jpg" border="0"></div>
		<div id="" class="main_left">
        <div>
        <?php echo get_left_nav(@$cateId,@$cateId);?>

		</div>
        </div>
		<div class="main_right">
     	      <div class="position">·<?php echo get_position(@$cateId);?></div>
     	      <div class="">
     	      <?php echo get_product_lists(@$cateId,@$lang,@$page,@$perpage);?>
     	      </div>
     	</div>
		 <div class="clear"></div>
     	 <div class="w100"><img src="<?php echo base_url(); ?>assets/home/images/jx.jpg" border="0"></div>
	</div>
</div>
