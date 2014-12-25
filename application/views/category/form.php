<div class="info_all">
    <?php echo get_formTable_jsCss();?>
<style type="text/css">
.formTable .subTh {
	background-image: none;
}
td>label{
	display: inline;
}
label.forPlugin{
	display: inline;
	padding: 10px;
   border: rgb(226, 183, 183) 1px solid;cursor: pointer;
}
label.forPlugin input[type=checkbox]{
	margin:0;
}
div>label.forPlugin{
height: 40px;
line-height: 40px;
margin: 0 5px 5px;
}
</style>
	<br />
	<form action="<?=@$dealUrl?>" method="post" class="formTable">
		<table width="100%" align="center" border="0" cellpadding="0"
			cellspacing="0">
			<tbody>
				<tr>
					<th colspan="3" class="subTh" id="basic">基本属性</th>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 所属语言:</td>
					<td class="eleCont"><select type="select" name="lang"
						class="select" <?=@$disabled ?> datatype="*" nullmsg="请选择" errormsg="请选择">
						<?php echo get_Lang_html(@$obj->lang);?>
						</select></td>
					<td class="eleTip"><div class="Validform_checktip">请选择</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need"></span> 所属父类别:</td>
					<td class="eleCont"><select type="select" name="fatherId"  <?=@$disabled ?>
						class="select" nullmsg="请填写" errormsg="填写有误"><option value="">请选择</option>
						<?php echo get_category_html(@$obj->fatherId);?>
					</select></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 类别名称:</td>
					<td class="eleCont"><input type="text" name="cateName" value="<?=@$obj->cateName?>"
						class="input_text" datatype="*2-100" nullmsg="请填写" errormsg="字符不得多于100，填写有误"></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr style="display: table-row;">
					<td class="eleName"><span class="need">*</span> 排序:</td>
					<td class="eleCont"><input type="text" name="orderNum"
						 value="<?=@$orderNum?>" class="input_text"
						datatype="d1-3" nullmsg="请填写" errormsg="填写有误"></td>
					<td class="eleTip"><div class="Validform_checktip">请填写,取值范围[0-998].</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 关键字:</td>
					<td class="eleCont"><input type="text" name="keywords" value="<?=@$obj->keywords?>"
						class="input_text" datatype="*2-100" nullmsg="请填写" errormsg="字符不得多于100，填写有误"></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 描述:</td>
					<td class="eleCont"><textarea type="textaera" name="description"
							style="width: 400px; height: 80px;" nullmsg="请填写" datatype="*2-200"  errormsg="字符不得多于200，填写有误"><?=@$obj->description?></textarea></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr class="none_fade">
					<th colspan="3" class="subTh" id="advanced">高级属性：请谨慎操作</th>
				</tr>
				<!--  
				<tr>
					<td class="eleName"><span class="need"></span>菜单高亮:</td>
					<td class="eleCont"><select type="select" name="navHover"
						nullmsg="请填写" errormsg="填写有误"><option value="">请选择</option>
					
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				-->
				<tr>
					<td class="eleName"><span class="need">*</span> 导航栏目:</td>
					<td class="eleCont">
					<label><input <?php if(@$obj->isNav!=2){echo 'checked="checked"';}?>  value="1" need="1"
						type="radio" name="isNav" nullmsg="请填写" errormsg="填写有误">
						是&nbsp;&nbsp;</label>
						<label><input <?php if(@$obj->isNav==2){echo 'checked="checked"';}?> value="2" type="radio" name="isNav">
						否&nbsp;&nbsp;</label></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 目标窗口:</td>
					<td class="eleCont">
					<label><input <?php if(@$obj->isNav!='_blank'){echo 'checked="checked"';}?> value="_self" need="1"
						type="radio" name="target" nullmsg="请填写" errormsg="填写有误">
						_self&nbsp;&nbsp;</label>
						<label><input <?php if(@$obj->isNav =='_blank'){echo 'checked="checked"';}?> value="_blank" type="radio" name="target">
						_blank&nbsp;&nbsp;</label></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 链接地址:</td>
					<td class="eleCont"><input type="text" name="linkURL" value="<?=@$linkURL?>"
						class="input_text" datatype="*" nullmsg="请填写" errormsg="填写有误"></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need"></span> 所属模块:</td>
					<td class="eleCont" id="cateModule">
					<?php echo get_category_module_html(@$obj->forPlugin,$isDisabled);?>
					</td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr class="_button none_fade">
					<td colspan="3" class="center"><input class="btn btn-primary"
						type="submit" value="提 交" />&nbsp;&nbsp;&nbsp;<input class="btn"
						type="reset" value="重 置" />
						<input name="Id" type="hidden" value="<?=@$obj->Id ?>" />
						<!--  <input name="level" type="hidden" value="<?=@$obj->level ?>" />
						<input name="catePath" type="hidden" value="<?=@$obj->catePath ?>" />  -->
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<script type="text/javascript">
	function topple(obj){
		var next=obj.next();
		if(!next.hasClass('none_fade')){
			next.fadeToggle(1000);
			topple(next);
		}
	}
	$(function(){
		$("#basic").bind('click',function(){
			topple($(this).parent());
		});
		$("#advanced").bind('click',function(){
			topple($(this).parent());
		});
	});
</script>
<script type="text/javascript">
	var iconUrl='<?php echo base_url();?>assets/dialog/icons/';
	var url='<?php echo site_url().'/';?>';
	$(function(){
		var langObj=$("select[name='lang']");
		//var lang=langObj.val();
		var fatherObj=$("select[name='fatherId']");
		//setPostHtml(url+'category/getCategory',{fatherId:0,lang:lang,},fatherObj,iconUrl);
		langObj.bind('change',function(){
			var lang=$(this).val();
			//if(!isNullOrEmpty(lang)){}
			setPostHtml(url+'category/getCategory',{fatherId:0,lang:lang,},fatherObj,iconUrl);
			setPostHtml(url+'category/getCategoryField',{fatherId:0},'#cateModule',iconUrl);
			
	    });
		fatherObj.bind('change',function(){
			var value=$(this).val();
			//alert(value);
			setPostHtml(url+'category/getCategoryField',{fatherId:value},'#cateModule',iconUrl);
		});
	});
	
</script>
