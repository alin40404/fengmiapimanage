back=function(){window.history.back();}
operateItems = function(url){window.location.href = url;}
try{
	$(function(){
		showDialog=function(msg,title,time,icon,cancel,okCallback){
					if(title==''||title==null||typeof title=='undefined'){title='提示：';}
					var dialog=new Dialog(msg,{
						title:title,
						time:time,
						icon:icon,
						cancel:cancel,
						afterOk:function(that){that.close();if(typeof okCallback=='function')okCallback();},
						afterClose:function(){},
						beforeClose:function(){return true;}
			}).show();
		}
	});
   setPostHtml=function(url,data,obj,iconUrl,callback){
    	$.ajax({type: "POST",url: url,data:data,dataType:"html",
			success: function(data, textStatus){
				if(typeof obj =='object'){
					obj.html(data);
				}else{
					if (!isNullOrEmpty(obj)) {
						$(obj).html(data);
					}
				}
				if(typeof callback == 'function'){
					callback();
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				var msg=("Error");i='error.png';
	        	showDialog(msg,'','3000',iconUrl+i,'');
	        }
	     });
    }
	
	   setPostJson = function (url, data, iconUrl, callback) {
       $.ajax({
           type: "POST", url: url, data: data, dataType: "json",
           success: function (data, textStatus) {
               if (typeof callback == 'function') {
                   callback(data);
               }
           },
           error: function (XMLHttpRequest, textStatus, errorThrown) {
               var msg = ("Error"); i = 'error.png';
               showDialog(msg, '', '3000', iconUrl + i, '');
           }
       });
   }
 
}catch(e){}
try{
    function getTotalHeight(){
        if ($.browser.msie) {
            return document.compatMode == "CSS1Compat" ? document.documentElement.clientHeight : document.body.clientHeight;
        }
        else {
            return self.innerHeight;
        }
    }
    
    //得到浏览器的宽度
    function getTotalWidth(){
        if ($.browser.msie) {
            return document.compatMode == "CSS1Compat" ? document.documentElement.clientWidth : document.body.clientWidth;
        }
        else {
            return self.innerWidth;
        }
    }
    
    //设置高度
    function setHeight(aHeight){
        aHeight = aHeight - 41;
        $("body>.sidebar-nav").css("height", aHeight);
        $("body>.sidebar-nav").css("min-height", aHeight);
        $("body>.content").css("height", aHeight);
        $("body>.content").css("min-height", aHeight);
        
    }
    
    //设置flash宽度
    function setWidth(aWidth){
    }

    $(function(){
        //初始化检测宽高
        var sHeight = getTotalHeight();
        var sWidth = getTotalWidth();
        setHeight(sHeight);
        //得到浏览器的高度
        $(window).resize(function(){
            //得到resize后的 浏览器宽高
            var rHeight = getTotalHeight();
            setHeight(rHeight);
        });
    });
}catch(e){}

function isNullOrEmpty(value){
	if(isNumber(value)){
		return false;
	}
	if(value!=''&&typeof value!='undefined'&&value!=null){
		return false;
	}else{
		return true;
	}
}
function isNumber(value){
	try{
		var num=parseInt(value);
		if(isNaN(num)){
			return false;
		}else{
			return true;
		}
	}catch(e){
		return false;
	}
}

sidebarNavToggle= function(siteUrl){
    var obj = $("body>.content");
	var obj_menuResize=$("#menuResize");
    var status = obj.attr("status");
    var tempSta = "";
    if (status == "close") {
		animate_margin_left(obj,180);
		animate_left(obj_menuResize,180);
		
        obj.attr("status", "");
        tempSta = "";
    } else {
		animate_margin_left(obj,0);
		animate_left(obj_menuResize,0);
        obj.attr("status", "close");
        tempSta = "close";
    }
    var data = { status: tempSta, };
    
    var url = siteUrl+"/Common/sidebarStatus";
    setPostJson(url,data,'');

}
animate_margin_left=function(obj,n){
	if(typeof obj != 'object'){
		obj=$(obj);
	}
	if(typeof n=='string'){
        if (n.indexOf('px') == -1) {
            n = n + 'px';
        }
	}else{
		 n = n + 'px';
	}
	
	obj.animate({
            'margin-left': n,
     });
}
animate_left=function(obj,n){
	if(typeof obj != 'object'){
		obj=$(obj);
	}
	if(typeof n=='string'){
        if (n.indexOf('px') == -1) {
            n = n + 'px';
        }
	}else{
		 n = n + 'px';
	}
	
	obj.animate({
            'left': n,
     });
}
scrolltop=function(){
	var id='content';
	$('#'+id).animate({},'slow',function(){
	document.getElementById(id).scrollTop = 0;
	});
}

getCommonCateOption=function(url,lang,cateId,forPlugin,callback){
	
	$.ajax({
        async: true,//是否为异步请求
        type: "POST",
        url: url+'commonCate/getCommonCate',
        data: {lang:lang,cateId:cateId,forPlugin:forPlugin},
        dataType: "html",
        success: function(data, textStatus){
	        if(typeof callback == "function"){
				callback(data);
			}
        },
        error: function(XMLHttpRequest, textStatus, errorThrown){
        	var msg=("Error");i='error.png';
        	showDialog(msg,'','3000',iconUrl+i,'');
        }
    });
}

setCommonCate=function(url,lang,cateId,forPlugin,callback){
		getCommonCateOption(url,lang,cateId,forPlugin,function(data){
			var html='<select onchange="" type="select" name="gId" class="select" datatype="*" nullmsg="请填写" errormsg="填写有误">'+data+'</select>';
			if(typeof callback=="function"){
				callback(html);
			}
		});
}