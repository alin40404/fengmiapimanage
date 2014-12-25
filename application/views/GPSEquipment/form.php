<div class="info_all">
	<?php echo get_formTable_jsCss();?>
	<div class="well">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#home" data-toggle="tab">基本信息</a></li>
			<?php if(@$action !="add"){ ?>
			<li><a href="#advance" data-toggle="tab">高级设置</a></li>
			<li><a href="#info" data-toggle="tab">高级信息</a></li>
			<?php } ?>
		</ul>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane active in" id="home">
				<form action="<?=@$dealUrl?>" method="post" class="formTable">
					<table width="100%" align="center" border="0" cellpadding="0"
						cellspacing="0">
						<tbody>
							<tr>
								<td class="eleName"><span class="need">*</span> 终端所属组:</td>
								<td class="eleCont"><select type="select" name="gId"
									gId="<?=@$obj->gId ?>" class="select" datatype="*"
									nullmsg="请填写" errormsg="填写有误">
										<option value="">请选择</option>
								</select></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> 终端编号:</td>
								<td class="eleCont"><input type="text" name="no"
									value="<?=@$obj->no ?>" class="input_text" datatype="*1-50"
									nullmsg="请填写" errormsg="填写有误,最多50个字符"></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> GPS设备串号:</td>
								<td class="eleCont"><input type="text" name="IMEI"
									value="<?=@$obj->IMEI ?>" class="input_text" datatype="*1-50"
									nullmsg="请填写" errormsg="填写有误,最多50个字符"></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>

							<tr>
								<td class="eleName"><span class="need">*</span> GPS终端型号:</td>
								<td class="eleCont"><input type="text" name="equipmentType"
									value="<?=@$obj->equipmentType ?>" class="input_text"
									datatype="*1-20" nullmsg="请填写" errormsg="填写有误,1-20个字符"></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> GPS品牌:</td>
								<td class="eleCont"><input type="text" name="brand"
									value="<?=@$obj->brand ?>" class="input_text" datatype="*1-20"
									nullmsg="请填写" ignore="ignore" errormsg="填写有误,1-20个字符"></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> 状态:</td>
								<td class="eleCont">
								<?php echo getStatusHtml(@$obj->status); ?>
								</td>
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

			<div class="tab-pane fade" id="advance">
				<form action="<?=@site_url()?>/terminalPhone/bindPhone"
					method="post" class="formTable">
					<table width="100%" align="center" border="0" cellpadding="0"
						cellspacing="0">
						<tbody>
							<tr>
								<td class="eleName"><span class="need">*</span> 绑定手机号码:</td>
								<td class="eleCont"><input type="text" name="phone"
									value="<?=@$obj->phone ?>" class="input_text" datatype="*"
									nullmsg="请填写" errormsg="填写有误"></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>

							<tr>
								<td class="eleName"><span class="need">*</span> 获取验证码:</td>
								<td class="eleCont"><input type="text" name="validPhone"
									value="" class="input_text input-small" datatype="*"
									ignore="ignore" nullmsg="请填写" errormsg="填写有误"> <input
									class="btn btn-mini btn-info" type="button" value="获取" /></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr class="">
								<td colspan="3" class="center"><input class="btn btn-primary"
									type="submit" value="提 交" />&nbsp;&nbsp;&nbsp;<input
									class="btn" type="reset" value="重 置" /> <input
									name="terminalId" type="hidden" value="<?=@$obj->terminalId ?>" />
									<input name="Id" type="hidden" value="<?=@$obj->phoneId ?>" />
								</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>

			<div class="tab-pane fade" id="info">
				<form action="<?=@$dealUrl?>" method="post" class="formTable">
					<table width="100%" align="center" border="0" cellpadding="0"
						cellspacing="0">
						<tbody>
							<tr>
								<td class="eleName"><span class="need">*</span> 发送数据协议:</td>
								<td class="eleCont"><select type="select" name="sendProtocol"
									class="select" datatype="*" nullmsg="请填写" errormsg="填写有误">
										<option value="">请选择</option>
										<?php echo getSelectHtml(config_item('sendProtocol'),@$obj->sendProtocol);?>
									</select></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> 接收指令协议:</td>
								<td class="eleCont"><select type="select" name="receProtocol"
									class="select" datatype="*" nullmsg="请填写" errormsg="填写有误">
										<option value="">请选择</option>
										<?php echo getSelectHtml(config_item('receProtocol'),@$obj->receProtocol);?>
									</select></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> 最大电池容量:</td>
								<td class="eleCont"><input type="text" name="maxButteryCap"
									value="<?=@$obj->maxButteryCap ?>" class="input_text"
									datatype="d1-30" nullmsg="请填写" errormsg="填写有误，数字长度1-30"> mA（毫安）
									</td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> 最小电池容量:</td>
								<td class="eleCont"><input type="text" name="minButteryCap"
									value="<?=@$obj->minButteryCap ?>" class="input_text"
									datatype="d1-30" nullmsg="请填写" errormsg="填写有误，数字长度1-30"> mA（毫安）</td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> 备注:</td>
								<td class="eleCont"><textarea type="textaera" name="description"
										style="width: 400px; height: 80px;" ignore="ignore"
										nullmsg="请填写" datatype="*2-200" errormsg="字符不得多于200，填写有误"><?=@$obj->bak ?></textarea></td>
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
		</div>
	</div>
</div>

<script type="text/javascript">
	var iconUrl='<?php echo base_url();?>assets/dialog/icons/';
	var url='<?php echo site_url().'/';?>';
	$(function(){
		var gIdObj=$("select[name='gId']");
		$.ajax({
	        async: true,//是否为异步请求
	        type: "POST",//GET  POST
	        url: url+'commonCate/getCommonCate',
	        data: {lang:'<?=@$lang ?>',cateId:'<?=@$obj->gId ?>',forPlugin:'<?=@$forPlugin?>'},
	        dataType: "html",
	        success: function(data, textStatus){
		        
		        if(data){
			      var html=data;
		        	gIdObj.html(html);
		        }
	        },
	        error: function(XMLHttpRequest, textStatus, errorThrown){
	        	var msg=("Error");i='error.png';
	        	showDialog(msg,'','3000',iconUrl+i,'');
	        }
	    });

	});

	</script>
