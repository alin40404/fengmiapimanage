<div class="info_all">
	<?php echo get_formTable_jsCss();?>
	<div class="well">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#home" data-toggle="tab">高级信息</a></li>
			<?php if(@$action !="add"){ ?>
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
					<td class="eleName"><span class="need">*</span> 所属用户组:</td>
					<td class="eleCont"><select type="select" name="gId"
						gId="<?=@$obj->gId ?>" class="select" datatype="*" nullmsg="请填写"
						errormsg="填写有误">
							<option value="">请选择</option>
					</select></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 所属角色:</td>
					<td class="eleCont"><select type="select" name="rId"
						rId="<?=@$obj->rId ?>" class="select" datatype="*" nullmsg="请填写"
						errormsg="填写有误"><option value="">请选择</option></select></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 帐号:</td>
					<td class="eleCont"><input type="text" name="adminName"
						value="<?=@$obj->adminName ?>" class="input_text" datatype="*5-20"
						nullmsg="请填写" errormsg="填写有误,5-20个字符"></td>
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
						type="reset" value="重 置" /><input name="Id" type="hidden"
						value="<?=@$obj->Id ?>" /></td>
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
					<td class="eleCont"><input type="password" name="adminPwd"
						value="<?=@$nopassword?>" class="input_text" datatype="*6-20"
						nullmsg="请填写" errormsg="填写有误"></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 重复密码:</td>
					<td class="eleCont"><input type="password" name="adminPwd_re"
						recheck="adminPwd" value="<?=@$nopassword?>" class="input_text"
						datatype="*6-18" nullmsg="与密码不一致" errormsg="您两次输入的账号密码不一致"></td>
					<td class="eleTip"><div class="Validform_checktip">与密码一致</div></td>
				</tr>

				<tr class="">
					<td colspan="3" class="center"><input class="btn btn-primary"
						type="submit" value="提 交" />&nbsp;&nbsp;&nbsp;<input class="btn"
						type="reset" value="重 置" /><input name="Id" type="hidden"
						value="<?=@$obj->Id ?>" /></td>
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
					<td class="eleName"><span class="need">*</span> Email:</td>
					<td class="eleCont"><input type="text" name="email"
						value="<?=@$obj->email ?>" class="input_text" datatype="e"
						ignore="ignore" nullmsg="请填写" errormsg="填写有误"></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 备注:</td>
					<td class="eleCont"><textarea type="textaera" name="bak"
							style="width: 400px; height: 80px;" nullmsg="请填写" errormsg="填写有误"><?=@$obj->bak ?></textarea></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>

				<tr class="">
					<td colspan="3" class="center"><input class="btn btn-primary"
						type="submit" value="提 交" />&nbsp;&nbsp;&nbsp;<input class="btn"
						type="reset" value="重 置" /><input name="Id" type="hidden"
						value="<?=@$obj->Id ?>" /></td>
				</tr>
			</tbody>
		</table>
	</form>
			</div>
		</div>

				<?php if(@$action =="add"){ ?>
			<div class="alert alert-info">
              <button type="button" class="close" data-dismiss="alert">×</button>
     <div>说明：</div> 
              <div style="text-indent: 2em;">首次添加管理员，密码默认为<?=@config_item('default_password');?> ！请在添加后修改！
              </div>
            </div>
          <?php } ?>  
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
	    var rIdObj=$("select[name='rId']");
	    var gId='<?=@$obj->gId ?>';
	    var rId='<?=@$obj->rId ?>';
	    setRoleIdName(rIdObj,gId,url+'adminRole/getRoleIdName',rId);

	    if(rId==''){
	    	setPostHtml(url+'adminRole/getRolePower',{Id:rId},'#power',iconUrl);
	    }
	    
	    gIdObj.bind('change',function(){
			var gId=$(this).val();
			setRoleIdName(rIdObj,gId,url+'adminRole/getRoleIdName','');
	    });

	    rIdObj.bind('change',function(){
			var value=$(this).val();
			setPostHtml(url+'adminRole/getRolePower',{Id:value,isDisabledCB:true,},'#power',iconUrl);
		});

	});
	
    setRoleIdName=function(rIdObj,gId,url,rId){
		$.ajax({
	        async: true,//是否为异步请求
	        type: "POST",//GET  POST
	        url: url,
	        data: {gId:gId},
	        dataType: "json",
	        success: function(data, textStatus){
		        console.log(data);
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

</div>
