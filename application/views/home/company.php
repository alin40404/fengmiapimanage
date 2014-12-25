<!-- content -->
<div class="content">
       <?php echo get_banner(@$cateId,@$lang);?>   
    <div class="main">
		<div class="w100"><img src="<?php echo base_url(); ?>assets/home/images/jx.jpg" border="0"></div>
		<div class="">
		
		</div>
		 <div class="">
     	      <div class="position">·<?php echo get_position(@$cateId);?></div>
     	      <div class="">
     	      <?php echo get_artonce(@$cateId,@$lang);?>
     	      </div>
     	</div>
		 <div class="clear"></div>
     	 <div class="w100"><img src="<?php echo base_url(); ?>assets/home/images/jx.jpg" border="0"></div>
	</div>
</div>
