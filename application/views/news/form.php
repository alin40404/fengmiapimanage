<div class="info_all">
    <?php echo get_formTable_jsCss();?>
	<form action="<?=@$dealUrl?>" method="post" class="formTable">
		<table width="100%" align="center" border="0" cellpadding="0"
			cellspacing="0">
			<tbody>
				<tr>
					<td class="eleName"><span class="need">*</span> 所属语言:</td>
					<td class="eleCont"><select type="select" name="lang"
						class="select" datatype="*" nullmsg="请选择" errormsg="请选择">
						<?php echo get_Lang_html(@$obj->lang);?>
						</select></td>
					<td class="eleTip"><div class="Validform_checktip">请选择</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 所属类别:</td>
					<td class="eleCont"><select type="select" name="cateId"
						class="select" datatype="*" nullmsg="请填写" errormsg="填写有误"><option
								value="">请选择</option>
						<?php echo get_category_html(@$obj->cateId,$obj->lang,0,@$module);?>
					</select></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 新闻标题:</td>
					<td class="eleCont"><input type="text" name="title"
						value="<?=@$obj->title?>" class="input_text" datatype="*2-100"
						nullmsg="请填写" errormsg="字符不得多于100，填写有误"></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 关键字:</td>
					<td class="eleCont"><input type="text" name="keywords" value="<?=@$obj->keywords?>"
						class="input_text" datatype="*" nullmsg="请填写" errormsg="填写有误"></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need"></span> 编辑:</td>
					<td class="eleCont"><input type="text" name="editor"
						value="<?=@$obj->editor?>" class="input_text" datatype=""
						nullmsg="请填写" errormsg="填写有误"></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need"></span> 新闻来源:</td>
					<td class="eleCont"><input type="text" name="source" value="<?=@$obj->editor?>"
						class="input_text" datatype="" nullmsg="请填写" errormsg="填写有误"></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 是否顶置:</td>
					<td class="eleCont"><input <?php if(@$obj->isTop != 2){echo 'checked="checked"';} ?> value="1" need="1"
						type="radio" name="isTop" class="inputradio" datatype="*"
						nullmsg="请填写" errormsg="填写有误"> Yes&nbsp;&nbsp;<input <?php if(@$obj->isTop==2){echo 'checked="checked"';} ?> value="2"
						type="radio" name="isTop" class="inputradio"> No&nbsp;&nbsp;</td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 是否热门:</td>
					<td class="eleCont"><input <?php if(@$obj->isHot == 1){echo 'checked="checked"';} ?> value="1" need="1"
						type="radio" name="isHot" class="inputradio" datatype="*"
						nullmsg="请填写" errormsg="填写有误"> Yes&nbsp;&nbsp;<input <?php if(@$obj->isHot !=1){echo 'checked="checked"';} ?> value="2"
						type="radio" name="isHot" class="inputradio"> No&nbsp;&nbsp;</td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr style="display: table-row;">
					<td class="eleName"><span class="need">*</span> 排序:</td>
					<td class="eleCont"><input type="text" name="orderNum"
						value="<?=@$orderNum?>" class="input_text" datatype="d1-3"
						nullmsg="请填写" errormsg="填写有误"></td>
					<td class="eleTip"><div class="Validform_checktip">请填写,取值范围[0-998].</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 新闻简介:</td>
					<td class="eleCont"><textarea type="textaera" name="description"
							datatype="*2-200" style="width: 400px; height: 80px;"
							nullmsg="请填写" errormsg="字符不得多于200，填写有误"><?=@$obj->description?></textarea></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need"></span> 正文内容:</td>
					<td class="eleCont"><?php echo getKindEditor(@$obj->content);?></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need"></span> 上传缩略图:</td>
					<td class="eleCont"><span class="upload_btn upload_imgsingle"
						id="imagesingle_btn">上传缩略图</span>
						<div class="multiimage_list" id="imagesingle"><?=@$imageSingleHtml?></div>
						<?php echo getImageSingle(@$module); ?>
					</td>
					<td class="eleTip"><div class="Validform_checktip">请点击按钮上传缩略图!</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need"></span> 上传图片集:</td>
					<td class="eleCont"><span class="upload_btn" id="imagelist_btn">上传图片集</span>
						<div class="multiimage_list" id="imagelist"><?=@$imageListHtml?></div>
						<?php echo getImageList(@$module); ?>
					</td>
					<td class="eleTip"><div class="Validform_checktip">请点击按钮上传图片集!</div></td>
				</tr>
				<tr class="_button">
					<td colspan="3" class="center"><input class="btn btn-primary"
						type="submit" value="提 交" />&nbsp;&nbsp;&nbsp;<input class="btn"
						type="reset" value="重 置" /> <input name="Id" type="hidden"
						value="<?=@$obj->Id ?>" /><input name="no" type="hidden"
						value="<?=@$obj->no ?>" /></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<script type="text/javascript">
	var iconUrl='<?php echo base_url();?>assets/dialog/icons/';
	var url='<?php echo site_url().'/';?>';
	$(function(){
		var langObj=$("select[name='lang']");
		var cateObj=$("select[name='cateId']");
		langObj.bind('change',function(){
			var lang=$(this).val();
			//if(!isNullOrEmpty(lang)){}
			 setPostHtml(url+'category/getCategory',{fatherId:0,lang:lang,module:'<?=@$module?>'},cateObj,iconUrl);
			//setPostHtml(url+'category/getCategoryField',{fatherId:0},'#cateModule',iconUrl);
			
	    });
		cateObj.bind('change',function(){
			var value=$(this).val();
			//alert(value);
			//setPostHtml(url+'category/getCategoryField',{fatherId:value},'#cateModule',iconUrl);
		});
	});
	
</script>
