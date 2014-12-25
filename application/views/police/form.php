<div class="info_all">
	<?php echo get_formTable_jsCss();?>
	<div class="well">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#home" data-toggle="tab">高级信息</a></li>
			<?php if(@$action !="add"){ ?>
			<li><a href="#advance" data-toggle="tab">高级设置</a></li>
			<li><a href="#info" data-toggle="tab">基本信息</a></li>
			<li><a href="#profile" data-toggle="tab">修改密码</a></li>
			<?php } ?>
		</ul>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane active in" id="home">
				<form action="<?=@$dealUrl?>" method="post" class="formTable">
					<table width="100%" align="center" border="0" cellpadding="0"
						cellspacing="0">
						<tbody>
							<tr>
								<td class="eleName"><span class="need">*</span> 所属组:</td>
								<td class="eleCont"><select type="select" name="gId"
									gId="<?=@$obj->gId ?>" class="select" datatype="*"
									nullmsg="请填写" errormsg="填写有误">
										<option value="">请选择</option>
								</select></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> 所属角色:</td>
								<td class="eleCont"><select type="select" name="rId"
									rId="<?=@$obj->rId ?>" class="select" datatype="*"
									nullmsg="请填写" errormsg="填写有误"><option value="">请选择</option></select></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> 警员编号:</td>
								<td class="eleCont"><input type="text" name="policeId"
									value="<?=@$obj->policeId ?>" class="input_text"
									datatype="*1-50" nullmsg="请填写" errormsg="填写有误,最多50个字符"></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> 警员姓名:</td>
								<td class="eleCont"><input type="text" name="name"
									value="<?=@$obj->name ?>" class="input_text" datatype="*1-20"
									nullmsg="请填写" errormsg="填写有误,1-20个字符"></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> 上传头像:</td>
								<td class="eleCont"><span class="upload_btn upload_imgsingle"
									id="imagesingle_btn">上传头像</span>
									<div class="multiimage_list" id="imagesingle">
										<?php echo getHeadImgHtml(@$obj->icon);?>

									</div></td>
								<td class="eleTip"><div class="Validform_checktip">上传图片不得超过2M !</div></td>
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
				<form action="<?=@$baseDealUrl?>/bindGPS" method="post" class="formTable">
					<table width="100%" align="center" border="0" cellpadding="0"
						cellspacing="0">
						<tbody>
							<tr>
								<td class="eleName"><span class="need">*</span> 终端所属组:</td>
								<td class="eleCont"><select type="select" name="terminal_gId"
									gId="<?=@$obj->terminal_gId ?>" class="select" datatype="*"
									nullmsg="请填写" errormsg="填写有误">
										<option value="">请选择</option>
										
								</select></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
						
							<tr>
								<td class="eleName"><span class="need">*</span>绑定GPS设备:</td>
								<td class="eleCont"><select type="select" name="terminalId" class="select" datatype="*"
									nullmsg="请填写" errormsg="填写有误">
										<option value="">请选择</option>
								</select></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							
							<tr class="">
								<td colspan="3" class="center"><input class="btn btn-primary"
									type="submit" value="提 交" />&nbsp;&nbsp;&nbsp;<input
									class="btn" type="reset" value="重 置" />
									<input name="Id" type="hidden" value="<?=@$obj->Id ?>" />
									</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>

			<div class="tab-pane fade" id="profile">
				<form action="<?=@$dealUrl?>" method="post" class="formTable">
					<table width="100%" align="center" border="0" cellpadding="0"
						cellspacing="0">
						<tbody>
							<tr>
								<td class="eleName"><span class="need">*</span> 密码:</td>
								<td class="eleCont"><input type="password" name="pwd"
									value="<?=@$nopassword?>" class="input_text" datatype="*6-20"
									nullmsg="请填写" errormsg="填写有误"></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> 重复密码:</td>
								<td class="eleCont"><input type="password" name="pwd_re"
									recheck="pwd" value="<?=@$nopassword?>" class="input_text"
									datatype="*6-18" nullmsg="与密码不一致" errormsg="您两次输入的账号密码不一致"></td>
								<td class="eleTip"><div class="Validform_checktip">与密码一致</div></td>
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

			<div class="tab-pane fade" id="info">
				<form action="<?=@$dealUrl?>" method="post" class="formTable">
					<table width="100%" align="center" border="0" cellpadding="0"
						cellspacing="0">
						<tbody>
							<tr>
								<td class="eleName"><span class="need">*</span> 证件类型:</td>
								<td class="eleCont"><select type="select" name="certificateType"
									class="select" datatype="*" nullmsg="请填写" errormsg="填写有误">
										<option value="">请选择</option>
										<?php echo getSelectHtml(config_item('certificateType'),@$obj->certificateType);?>
					</select></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> 证件号码:</td>
								<td class="eleCont"><input type="text" name="certificateNum"
									value="<?=@$obj->certificateNum ?>" class="input_text"
									datatype="*2-30" nullmsg="请填写" errormsg="填写有误，字符长度2-30"></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> 居民身份证住址:</td>
								<td class="eleCont"><input type="text" name="homeAddress"
									value="<?=@$obj->homeAddress ?>" class="input_text span10"
									datatype="*2-30" nullmsg="请填写" errormsg="填写有误，字符长度2-30"></td>
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
								<td class="eleName"><span class="need">*</span> 邮箱:</td>
								<td class="eleCont"><input type="text" name="email"
									value="<?=@$obj->email ?>" class="input_text" datatype="e"
									ignore="ignore" nullmsg="请填写" errormsg="填写有误"></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> 个人手机号码:</td>
								<td class="eleCont"><input type="text" name="personalPhone"
									value="<?=@$obj->personalPhone ?>" class="input_text" datatype="*"
									ignore="ignore" nullmsg="请填写" errormsg="填写有误"></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span> 固定电话：</td>
								<td class="eleCont"><input type="text" name="baseInfoPhone"
									value="<?=@$obj->baseInfoPhone ?>" class="input_text"
									datatype="*" ignore="ignore" nullmsg="请填写" errormsg="填写有误"></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span>联系地址：</td>
								<td class="eleCont"><input type="text" name="contactAddress"
									value="<?=@$obj->contactAddress ?>" class="input_text span10"
									datatype="*" ignore="ignore" nullmsg="请填写" errormsg="填写有误"></td>
								<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
							</tr>
							<tr>
								<td class="eleName"><span class="need">*</span>邮政编码：</td>
								<td class="eleCont"><input type="text" name="contactZip"
									value="<?=@$obj->contactZip ?>" class="input_text input-small"
									datatype="*" ignore="ignore" nullmsg="请填写" errormsg="填写有误"></td>
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
		<?php if(@$action =="add"){ ?>
			<div class="alert alert-info">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <div style="text-indent: 2em;">说明：首次添加警员，密码默认为<?=@config_item('default_password');?> ！请在添加后修改！
              </div>
            </div>
          <?php } ?>  
	</div>
</div>
<link rel="stylesheet"
	href="<?php echo base_url();?>assets/kindeditor/themes/default/default.css" />
<link rel="stylesheet"
	href="<?php echo base_url();?>assets/kindeditor/plugins/code/prettify.css" />
<script type="text/javascript" charset="utf-8"
	src="<?php echo base_url();?>assets/kindeditor/kindeditor-min.js"></script>
<script type="text/javascript" charset="utf-8"
	src="<?php echo base_url();?>assets/kindeditor/lang/zh_cn.js"></script>
<script type="text/javascript" charset="utf-8"
	src="<?php echo base_url();?>assets/kindeditor/plugins/code/prettify.js"></script>
<script type="text/javascript" charset="utf-8"
	src="<?php echo base_url();?>assets/kindeditor/kindeditor.common.js"></script>
<script type="text/javascript">
	var iconUrl='<?php echo base_url();?>assets/dialog/icons/';
	var url='<?php echo site_url().'/';?>';
	$(function(){
		var gIdObj=$("select[name='gId']");
		var gId='<?=@$obj->gId ?>';
		setGroupIdName(gIdObj,gId,'<?=@$forPlugin?>',url);
	    var rIdObj=$("select[name='rId']");
	    var rId='<?=@$obj->rId ?>';
	    setRoleIdName(rIdObj,gId,url+'policeRole/getRoleIdName',rId);
	    
	    gIdObj.bind('change',function(){
			var gId=$(this).val();
			setRoleIdName(rIdObj,gId,url+'policeRole/getRoleIdName','');
	    });

		var terminal_gId_obj=$("select[name='terminal_gId']");
		var terminal_gId='<?=@$obj->terminal_gId ?>';
		setGroupIdName(terminal_gId_obj,terminal_gId,'GPSEquipmentCate',url);
		var terminalId_obj=$("select[name='terminalId']");
	    var terminalId='<?=@$obj->terminalId ?>';
	    setPostHtml(url+'GPSEquipment/getGPSEquipmentIdName',{gId:terminal_gId,terminalId:terminalId},terminalId_obj,iconUrl);
	    terminal_gId_obj.bind('change',function(){
			terminal_gId=$(this).val();
			var data={gId:terminal_gId,terminalId:terminalId};
		    setPostHtml(url+'GPSEquipment/getGPSEquipmentIdName',data,terminalId_obj,iconUrl);
	    });

	});

	setGroupIdName=function(gIdObj,gId,forPlugin,url){
		var data={lang:'<?=@$lang ?>',cateId:gId,forPlugin:forPlugin};
		var obj=gIdObj;
		setPostHtml(url+'commonCate/getCommonCate',data,obj,iconUrl);
	}
	
    setRoleIdName=function(rIdObj,gId,url,rId){
		$.ajax({
	        async: true,//是否为异步请求
	        type: "POST",//GET  POST
	        url: url,
	        data: {gId:gId},
	        dataType: "json",
	        success: function(data, textStatus){
		       
		        var len=data.length;
		        var html='';
		        if(len>0){
			        //var rId=rIdObj.attr("rId");
			        for(i=0;i<len;i++){
				        var obj=data[i];
				        var tmp='';
				        var tmpgId=obj.rId;
				        var tmpgName=obj.rName;
				        if(tmpgId==rId){
				        	tmp='<option value="'+tmpgId+'" selected="selected" >'+tmpgName+'</option>';
				        }else{
				        	tmp='<option value="'+tmpgId+'">'+tmpgName+'</option>';
				        }
				        html += tmp;
			        }
		        }
		        html='<option value="">请选择</option>'+html;
		        rIdObj.html(html);
	        },
	        error: function(XMLHttpRequest, textStatus, errorThrown){
	        	var msg=("Error");i='error.png';
	        	showDialog(msg,'','3000',iconUrl+i,'');
	        }
	    });
    }

	</script>
<script type="text/javascript">
		$(function(){
		    KindEditor.ready(function(K){
		        var editor = K.editor({
		            allowFileManager: true,
		            langType: '<?=@$lang ?>',
		            fileManagerJson: '<?php echo base_url();?>index.php/common/fileManagerJson?type=imagesingle&module=<?=@$module?>',
		            uploadJson: '<?php echo base_url();?>index.php/common/uploadJson?type=imagesingle&module=<?=@$module ?>',
		        });
		        K('#imagesingle_btn').click(function(){
					
					//K('#imagesingle').val()
		            editor.loadPlugin('image', function(){
		                editor.plugin.imageDialog({
		                    imageUrl: K('#imagesingle').val(),
		                    showRemote: false,
							isResizeOpen:false,
							isWatermarkOpen:false,
							isShowResizeAndWatermark:false,
							resize:{width:'50',height:'50',},
							watermark:{wmText:'Powered By Paxonpilot © 2014',wmFontColor:'336699'},
		                    clickFn: function(url, title, width, height, border, align){
		                        var div = K('#imagesingle');
		                        //div.html('');
		                        var urlArr = url.split('/');
		                        var lResId = urlArr[urlArr.length - 1];
		                        var resId = lResId.split('.')[0];
	                            div.html('<span>'+"<img class="+'"head_img"'+"  src='" + url + "'/><input type='hidden' name='icon' value='" + url + "'/></span>");
		                        editor.hideDialog();
								removeImage();
		                    }
		                });
						selectResizeAndWm();
						getColorpicker('#wm_font_color');
		            });
		        });
				removeImage();
		    });
		    
		});
		
	</script>

