<div class="info_all">
    <?php echo get_formTable_jsCss();?>
	<form action="<?=@$dealUrl?>" method="post" class="formTable">
		<table width="100%" align="center" border="0" cellpadding="0"
			cellspacing="0">
			<tbody>
				<tr>
					<td class="eleName"><span class="need"></span> 所属语言:</td>
					<td class="eleCont"><select type="select" name="lang"
						class="select" datatype="" nullmsg="请选择" disabled="disabled" errormsg="请选择">
						<?php echo get_Lang_html(@$obj->lang);?>
						</select></td>
					<td class="eleTip"><div class="Validform_checktip"></div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need"></span> 所属类别:</td>
					<td class="eleCont"><select type="select" name="cateId" disabled="disabled"
						class="select" datatype="" nullmsg="请填写" errormsg="填写有误"><option
								value="">请选择</option>
						<?php echo get_category_html(@$obj->cateId,$obj->lang,0,@$module);?>
					</select></td>
					<td class="eleTip"><div class="Validform_checktip"></div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need"></span> 标题:</td>
					<td class="eleCont"><?=@$obj->title?></td>
					<td class="eleTip"><div class="Validform_checktip"></div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 显示:</td>
					<td class="eleCont"><?=@$isShow ?></td>
					<td class="eleTip"><div class="Validform_checktip"></div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 时间:</td>
					<td class="eleCont"><?php echo date('Y-m-d H:i:s',@$obj->addTime);?></td>
					<td class="eleTip"><div class="Validform_checktip"></div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need"></span> 用户IP:</td>
					<td class="eleCont"><input type="text" name="source" value="<?=@$obj->addUserIP?>"
						class="input_text" datatype="" nullmsg="请填写" errormsg="填写有误"></td>
					<td class="eleTip"><div class="Validform_checktip"></div></td>
				</tr>
				
				<tr>
					<td class="eleName"><span class="need"></span> 反馈内容:</td>
					<td class="eleCont"><?php echo getKindEditor(@$obj->content);?></td>
					<td class="eleTip"><div class="Validform_checktip"></div></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>

