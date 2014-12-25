<div class="info_all">
	<?php echo get_formTable_jsCss();?>
	<div class="well">
		<ul class="nav nav-tabs">
			<li class=" <?=@$info ?> "><a href="#home" data-toggle="tab">个人信息</a></li>
			<li class=" <?=@$updatePwd ?> "><a href="#profile" data-toggle="tab">修改密码</a></li>
		</ul>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane <?=@$info ?> " id="home">
				<form action="<?=@$baseModuleUrl?>/dealnfo" method="post" class="formTable">
					<table width="100%" align="center" border="0" cellpadding="0"
						cellspacing="0">
						<tbody>
							<tr>
								<td class="eleName"><span class="need">*</span> 帐号:</td>
								<td class="eleCont"><input type="text" name="adminName"
								readonly="readonly"	value="<?=@$obj->adminName ?>" class="input_text"
									datatype="*5-20" nullmsg="请填写" errormsg="填写有误,5-20个字符"></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> 真实姓名:</td>
								<td class="eleCont"><input type="text" name="realName"
									value="<?=@$obj->realName ?>" class="input_text" datatype="*"
									nullmsg="请填写" errormsg="填写有误"></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> 性别:</td>
								<td class="eleCont"><input
									<?php $sex=@$obj->sex; if(isNullOrEmpty($sex)||$sex=='1'){echo 'checked="checked"';} ?>
									value="1" need="1" type="radio" name="sex" class="inputradio"
									datatype="*" nullmsg="请填写" errormsg="填写有误"> 男&nbsp;&nbsp;<input
									<?php if($sex=='2'){echo 'checked="checked"';} ?> value="2"
									type="radio" name="sex" class="inputradio"> 女&nbsp;&nbsp;</td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> 电话号码:</td>
								<td class="eleCont"><input type="text" name="phone"
									value="<?=@$obj->phone ?>" class="input_text" datatype="*"
									ignore="ignore" nullmsg="请填写" errormsg="填写有误"></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> 邮箱地址:</td>
								<td class="eleCont"><input type="text" name="email"
									value="<?=@$obj->email ?>" class="input_text" datatype="e"
									ignore="ignore" nullmsg="请填写" errormsg="填写有误"></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> 备注:</td>
								<td class="eleCont"><textarea type="textaera" name="bak"
										style="width: 400px; height: 80px;" nullmsg="请填写"
										errormsg="填写有误"><?=@$obj->bak ?></textarea></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>

							<tr class="">
								<td colspan="3" class="center"><input class="btn btn-primary"
									type="submit" value="提 交" />&nbsp;&nbsp;&nbsp;<input
									class="btn" type="reset" value="重 置" /><input name="Id"
									type="hidden" value="<?=@$obj->Id ?>" /></td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<div class="tab-pane <?=@$updatePwd ?> " id="profile">
				<form action="<?=@$baseModuleUrl?>/dealPwd" method="post" class="formTable">
					<table width="100%" align="center" border="0" cellpadding="0"
						cellspacing="0">
						<tbody>
							<tr>
								<td class="eleName"><span class="need">*</span> 原密码:</td>
								<td class="eleCont"><input type="password" name="oldPassword"
									value="<?=@$nopassword?>" class="input_text" datatype="*6-20"
									nullmsg="请填写" errormsg="填写有误, 6-20个字符"></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> 新密码:</td>
								<td class="eleCont"><input type="password" name="adminPwd"
									value="<?=@$nopassword?>" class="input_text" datatype="*6-20"
									nullmsg="请填写" errormsg="填写有误, 6-20个字符"></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span>确认新密码:</td>
								<td class="eleCont"><input type="password" name="adminPwd_re"
									recheck="adminPwd" value="<?=@$nopassword?>" class="input_text"
									datatype="*6-18" nullmsg="与密码不一致" errormsg="您两次输入的账号密码不一致"></td>
								<td class="eleTip"><div class="Validform_checktip">与新密码一致</div></td>
							</tr>

							<tr class="">
								<td colspan="3" class="center"><input class="btn btn-primary"
									type="submit" value="提 交" />&nbsp;&nbsp;&nbsp;<input
									class="btn" type="reset" value="重 置" /><input name="Id"
									type="hidden" value="<?=@$obj->Id ?>" /></td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>

		</div>

	</div>

</div>
