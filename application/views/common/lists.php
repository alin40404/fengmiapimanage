
<div class="content">
	<div class="container-fluid-none">
		<div class="row-fluid-none">
				<div class="block-none">
					<div class="block-heading height27em">
					<span class="block-icon pull-right"> <a href="javascript:back();" rel="tooltip" title="返回"><i
								class="icon-arrow-left">返回</i></a>
						</span>
						<span class="block-icon pull-right"> <a href="javascript:refreshGrid();" rel="tooltip" title="刷新"><i class="icon-refresh">刷新</i></a>
						</span><?php if(!isNullOrEmpty(@$add_url)){ ?> <span class="block-icon pull-right"> <a href="<?=@$add_url?>"  rel="tooltip" title="添加"><i class="icon-plus">添加</i></a>
						</span><?php } ?><a href="#widget2container" data-toggle="collapse"><?=@$barTitle?></a>
					</div>
					<div id="widget2container" class=" in">
					<?=@$flexigrid?>
					</div>
				</div>
		</div>
	</div>
	<?php echo get_footer(); ?>
</div>

<script type="text/javascript">
			var base_url='<?php echo base_url();?>';
			$(function(){
				deleteOne=function(id,time){
					var t='3000';if(isNullOrEmpty(time)){t='3000';}else{t=time;}
					var icon='<?php echo base_url();?>assets/dialog/icons/';
					showDialog('确定要删除？','警告：','3000',icon+'warning.png','取消',function(){
						var url='<?php echo site_url().'/'.@$module.'/delete';?>';
						var data={'Id':id,}
						$.ajax({
					        async: true,//是否为异步请求
					        type: "POST",//GET  POST
					        url: url,
					        data: data,
					        dataType: "json",
					        beforeSend: function(XMLHttpRequest, textStatus){
					        },
					        success: function(data, textStatus){
						        //console.log(data);
						        var msg=data.message;
						        if(data.status){refreshGrid();i='succeed.png';}else{i='info.png';}
						        showDialog(msg,'',t,icon+i,'');
					        },
					        complete: function(XMLHttpRequest, textStatus){
					        },
					        error: function(XMLHttpRequest, textStatus, errorThrown){
					        	var msg=("Error");i='error.png';
					        	showDialog(msg,'','3000',icon+i,'');
					        }
					    });
					});
				}
			});
</script>
