//得到焦点时触发事件  
function OnFocusFun(element,elementvalue){  
	if(element.value==elementvalue){  
	element.value="";  
	}  
}  
//离开输入框时触发事件  
function OnBlurFun(element,elementvalue){  
	if(element.value==""||element.value.replace(/\s/g,"")==""){  
		element.value=elementvalue;  
	}  
}

//子页导航
$(document).ready(function(){
	mouse(".main_left_list li a","main_nav_right","main_nav_left");
//	mouseleave(".main_left ul li a span",".main_nav_left",".main_nav_right");	
	$("ul.main_left_list li").click(function(){
		//var next=$(this).find('a').next();
		//  $(next).slideToggle();
	});
});