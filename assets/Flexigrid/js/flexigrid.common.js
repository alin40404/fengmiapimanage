try {
	function btnCB(com, grid){
		if (com == '全选/反选') {
			$.each($('tr', grid), function(key, value){
				var eleId = value.id;
				if (eleId) {
					if (!$("#" + eleId).hasClass('trSelected')) {
						$("#" + eleId).addClass('trSelected');
					}
					else {
						$("#" + eleId).removeClass('trSelected');
					}
				}
			});
		}
		else 
			if (com == '删除') {
				//console.log($('tr.trSelected', grid));
				var len = $('.trSelected', grid).length;
				if (len) {
					var strId = '';
					$.each($('tr.trSelected', grid), function(key, value){
						var eleId = value.id;
						id = $("#" + eleId).attr('data-id');
						strId += id + ',';
					});
					try{
						deleteOne(strId,'0');
					}catch(e){}
					
				}
				else {
					var msg='请选择要删除的内容！';
					var icon=base_url+'assets/dialog/icons/info.png';
					showDialog(msg,'提示','3000',icon,'');
				}
			}
	}
    refreshGrid = function(){
        $(".flexme").flexReload();
    }
	successCallback=function(){
		//console.log('数据加载成功！');
	}
	

	function selectLang(com)
	{
		var flexgridObj=$('.flexme');
		flexgridObj.flexOptions({newp:1, params:[{name:'lang', value: com},{name:'qtype',value:$('select[name=qtype]').val()}]});
		flexgridObj.flexReload(); 
	}
	
	function changeOrderNum(Id,value,url){
		var r=/^[+-]?\d+$/;
		if(r.test(value)){
			var data={Id:Id,orderNum:value,};
			
			$.ajax({type: "POST",url: url,data:data,dataType:"json",
			success: function(data, textStatus){
				var status=data.status;
				if(status==1){
                    var flexgridObj = $('.flexme');
                    flexgridObj.flexOptions({
                        newp: 1,
                        params: [{
                            name: 'qtype',
                            value: $('select[name=qtype]').val()
                        }]
                    });
                    flexgridObj.flexReload();
				}else{
					var msg=data.msg;var icon = base_url + 'assets/dialog/icons/error.png';
	        		showDialog(msg,'','3000',icon,'');
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				var msg=("Error");var icon = base_url + 'assets/dialog/icons/error.png';
	        	showDialog(msg,'','3000',icon,'');
	        }
	     });
		}else{
			var msg='请输入数字！';
            var icon = base_url + 'assets/dialog/icons/info.png';
            showDialog(msg, '提示', '3000', icon, '');
		}
	}
	
	function changeShow(id,value,url){
		var data={Id:id,isShow:value,};
		var iconUrl=base_url + 'assets/dialog/icons/';
		$.ajax({type: "POST",url: url,data:data,dataType:"json",
			success: function(data, textStatus){
				var status=data.status;
				var msg=data.message,i=status+'.png';
	        	showDialog(msg,'','3000',iconUrl+i,'');
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				var msg=("Error");i='error.png';
	        	showDialog(msg,'','3000',iconUrl+i,'');
	        }
	     });
	}

}catch(e){
	console.log(e.message);
}

