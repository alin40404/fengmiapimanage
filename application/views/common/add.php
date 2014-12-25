
<div class="content">
	<div>
		<ul class="breadcrumb">
			<li><a href="<?=@$lists_url?>"><?=@$title?></a> <span class="divider">/</span></li>
			<li class="active"><?=@$barTitle?></li>
		</ul>
	</div>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="block">
				<div class="block-heading ">
					<span class="block-icon pull-right"> <a href="javascript:back();"
						rel="tooltip" title="返回"><i class="icon-arrow-left">返回</i></a>
					</span> <span class="block-icon pull-right"> <a
						href="<?=@$add_url?>" rel="tooltip" title="添加"><i
							class="icon-plus">添加</i></a>
					</span> <span class="block-icon pull-right"> <a
						href="<?=@$lists_url?>" rel="tooltip" title="列表"><i
							class="icon-list">列表</i></a></span> <a href="#widget2container"
						data-toggle="collapse"><?=@$barTitle?></a>
				</div>
				<div id="widget2container" class=" in">
					<?=@$formTable?>
				</div>
			</div>
		</div>
	</div>
	<?php echo get_footer(); ?>
</div>
