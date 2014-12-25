
<div class="content">
	<div>
		<ul class="breadcrumb">
			<li>欢迎进入后台管理系统</li>
			<li class="active"></li>
		</ul>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="row-fluid">
				<?php echo geAdminBaseInfo();?>
				<?php echo getServerInfo();?>
				
			</div>
<!-- 
			<div class="row-fluid">
				<?php //echo getAdminNotice();?>
				<?php //echo getStatInfo();?>
				<?php //echo ini_get("post_max_size");?>
			</div>
			 -->
			<?php echo get_footer(); ?>
		</div>
	</div>
</div>