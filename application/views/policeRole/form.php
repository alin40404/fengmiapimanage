<div class="info_all">
    <?php echo get_formTable_jsCss();?>
	<form action="<?=@$dealUrl?>" method="post" class="formTable">
		<table width="100%" align="center" border="0" cellpadding="0"
			cellspacing="0">
			<tbody>
				<tr>
					<td class="eleName"><span class="need">*</span> 所属警员组:</td>
					<td class="eleCont">
					<select type="select" name="gId" gId="<?=@$obj->gId ?>" class="select"
						datatype="*" nullmsg="请填写" errormsg="填写有误">
						<option value="">请选择</option>
						<?php echo get_common_cate_html(@$obj->gId,$lang,0,@$forPlugin);?>
					</select></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span>角色名:</td>
					<td class="eleCont"><input type="text" name="rName"
						value="<?=@$obj->rName ?>" class="input_text Validform_error"
						datatype="*" nullmsg="请填写" errormsg="填写有误"></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 排序数组:</td>
					<td class="eleCont"><input type="text" name="orderNum"
						value="<?php if(!isNullOrEmpty(@$obj->orderNum)){echo @$obj->orderNum ;}else{echo '0';} ?>"
						class="input_text" datatype="*" nullmsg="请填写" errormsg="填写有误"></td>
					<td class="eleTip"><div class="Validform_checktip">通过信息验证！</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 备注:</td>
					<td class="eleCont"><textarea type="textaera" name="bak"
							style="width: 400px; height: 80px;" nullmsg="请填写" errormsg="填写有误"><?=@$obj->bak ?></textarea></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 权限:</td>
					<td id="power" class="eleCont"><?=@$power?></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr class="">
					<td colspan="3" class="center"><input class="btn btn-primary"
						type="submit" value="提 交" />&nbsp;&nbsp;&nbsp;<input class="btn"
						type="reset" value="重 置" /> <input name="Id" type="hidden"
						value="<?=@$obj->Id ?>" /></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
