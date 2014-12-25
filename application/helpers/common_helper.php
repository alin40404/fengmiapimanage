<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
date_default_timezone_set("PRC");
header("Content-type: text/html; charset=utf-8");

function getSelectHtml($array=null,$select=null){
	
	if(isNullOrEmpty($array)){
		$str='';	
	}else{
		if(is_array($array)){
			foreach ($array as $key => $value){
				if($key==$select){$selected=' selected="selected" ';}else{$selected='';}
				$str.='<option value="'.$key.'" '.$selected.' >'.$value.'</option>';
			}
		}else{
			$str.='<option value="'.$array.'" >'.$array.'</option>';
		}
	}
	return $str;
}

function getStatusHtml($status=0){
	if(isNullOrEmpty($status)){
		$status=0;
	}
	$arr_status=config_item('status');
	
	$str='';
	foreach($arr_status as $key => $value){
		if($key==$status){
			$checked=' checked="checked" ';
		}else{
			$checked='';
		}
		$str.='<input '.$checked.' value="'.$key.'" need="1" type="radio" name="status" class="inputradio" datatype="*" nullmsg="请填写"
									errormsg="填写有误"> '.$value.'&nbsp;&nbsp;';
	}
	
	return $str;
}

function getHeadImgHtml($icon=null){
	$base_url=base_url();
	if(isNullOrEmpty($icon)){
		$input='';
		$src=$base_url."assets/admin/images/head.png";
	}else{
		$input='';
		if(!is_numeric(@strpos($icon, 'http://'))){
			$icon=$base_url.$icon;
		}
		$src=$icon;
	}
	$str=<<<SHOW
			<span> 
				<img class="head_img" src="<{SRC}>">
			</span>
SHOW;
	$str = str_replace ( '<{SRC}>', $src, $str );
	return $str;
}

function getImageFileHtml($cSign,$where=array()){
	$CI=&get_instance();
	$CI->load->model('Common_Model');
	$CI->Common_Model->table='relefile';
	$max_num=@config_item('max_num');
	$order=array('Id'=>'asc');
	$query=$CI->Common_Model->get_last_Num ($max_num, $where,NULL,$order );
	$str='';
	if(!isNullOrEmpty($query)){
		$str='';$base_url=base_url();
		foreach ($query as $key=>$obj){
			$no=$obj->no;
			$title=$obj->title;
			$url=$obj->url;
			$url=copyImageToTemp($url);
			$temp='<span><button type="button" class="close">×</button><img src="'.$base_url.$url.'"><br><input type="text" name="'.$cSign.'['.$key.'][title]" value="'.$title.'"><input type="hidden" name="'.$cSign.'['.$key.'][url]" value="'.$url.'"></span>';
			$str.=$temp;
		}
	}else{
		$str='';
	}
	
	return $str;
	
}

function copyImageToTemp($url){
	$arr=parse_url($url);
	$path=$arr['path'];
	
	$doc_root=@$_SERVER['DOCUMENT_ROOT'];
	$doc_root=str_replace('\\', '/', $doc_root);
	
	$filename=$doc_root.'/'.trim($path,'/');
	
	$CI=&get_instance();
	$CI->load->config('config_uploadfile');
	$upload_file_url=@config_item('upload_file_url');
	if(isNullOrEmpty($upload_file_url)){$upload_file_url='/upload/';}
	
	$upload_file_url =trim($upload_file_url,'/').'/temp/image/'.date('Ymd',time()).'/';
	
	$destination = dirname(@$_SERVER['SCRIPT_FILENAME']) . '/';
	$save_path = $destination . $upload_file_url;
	$root_url=base_url().$upload_file_url;
	
	if(!file_exists($filename)){
		return FALSE;
	}else{
	
		$basename=basename($filename);
		//文件保存目录路径
		$destination=$save_path.$basename;
	
		//文件保存目录URL
		$save_url = $root_url.$basename;
	
// 		echo $filename,'<br />';
// 		echo $destination,'<br />';
// 		echo dirname($destination);
// 		exit;
		
		createFolder(dirname($destination).'/');
	
		if(copy($filename, $destination)){
			return $save_url;
		}else{
			return FALSE;
		}
	}
}

/**
 * 删除文件夹
 * @param string $dir
 * @return boolean
 */
function deldir($dir) {
	if(!is_dir(dirname($dir).'/')){
		return FALSE;
	}else if(!file_exists($dir)){
		return FALSE;
	}
	
	// 先删除目录下的文件：
	if (! $dh = @opendir ( $dir )) {
		return FALSE;
	}
	
	while (FALSE !== ($file=@readdir($dh))) {
		if($file!="." && $file!="..") {
			$fullpath=$dir."/".$file;
			if(!is_dir($fullpath)) {
				@unlink($fullpath);
			} else {
				deldir($fullpath);
			}
		}
	}
	@closedir($dh);
// 	if (rmdir ( $dir )) {
// 		return true;
// 	} else {
// 		return false;
// 	}
}

function removeImageFile($module,$no,$isDelFolder=FALSE){
	$CI=&get_instance();
	$CI->load->config('config_uploadfile');
	$upload_file_url=@config_item('upload_file_url');
	if(isNullOrEmpty($upload_file_url)){$upload_file_url='/upload/';}
	$upload_file_url=trim($upload_file_url,'/');
	if(isNullOrEmpty($module)){return FALSE;}
	if(isNullOrEmpty($no)){return FALSE;}
	if(!is_bool($isDelFolder)){
		$isDelFolder=FALSE;
	}
	
	$upload_file_url=$upload_file_url.'/'.$module.'/image/'.$no.'/';
	
	$destination = dirname(@$_SERVER['SCRIPT_FILENAME']) . '/';
	$root_path = $destination . $upload_file_url;
	if(!is_dir($root_path)){
		return false;
	}else{
		if(!file_exists($root_path)){
			return false;
		}else{
			deldir($root_path);
		}
	}
	if($isDelFolder){
		rmdir($root_path);
	}
}

function copyImageFile($filename,$module,$no){

	$CI=&get_instance();
	$CI->load->config('config_uploadfile');
	$upload_file_url=@config_item('upload_file_url');
	if(isNullOrEmpty($upload_file_url)){$upload_file_url='/upload/';}
	$upload_file_url=trim($upload_file_url,'/');
	if(isNullOrEmpty($module)){return FALSE;}
	if(isNullOrEmpty($no)){return FALSE;}
	
	$upload_file_url=$upload_file_url.'/'.$module.'/image/'.$no.'/';
	
	$host=@$_SERVER['HTTP_HOST'];
	$host='http://'.$host;
	$filename=str_replace($host, '', $filename);
	$filename=str_replace('\\', '/', $filename);
	
	$destination = dirname(@$_SERVER['SCRIPT_FILENAME']) . '/';
	$base_url=base_url();
	$root_path = $destination . $upload_file_url;
// 	$root_url = $base_url . $upload_file_url;
	$root_url = $upload_file_url;
	
	//文件保存目录路径
	$save_path = $root_path;
	
	//文件保存目录URL
	$save_url = $root_url;
	
	
	$doc_root=@$_SERVER['DOCUMENT_ROOT'];
	$doc_root=str_replace('\\', '/', $doc_root);
	
	$filename=$doc_root.'/'.trim($filename,'/');
	
	if(!file_exists($filename)){
		return FALSE;
	}else{
		
		$basename=basename($filename);
		//文件保存目录路径
		$destination=$save_path.$basename;
		
		//文件保存目录URL
		$save_url = $root_url.$basename;
		
// 		echo $filename,'<br />';
// 		echo $destination,'<br />';
// 		echo dirname($destination);
		
		createFolder(dirname($destination).'/');
		
		if(copy($filename, $destination)){
			return $save_url;
		}else{
			return FALSE;
		}
	}
}
/**
 * 创建文件夹
 * @param string $path
 */
function createFolder($path){
	if(!file_exists($path)){
		createFolder(dirname($path));
		@mkdir($path,0777);
	}
}

function getImageSingle($module='',$lang = '',$divId='imagesingle',$isNeedJsCss=FALSE){
	if(isNullOrEmpty($module)){$module='';}
	if (isNullOrEmpty ( $lang )) {$lang = config_item ( 'language' );}
	if(isNullOrEmpty($divId)){$divId='imagesingle';}
	
	$str=<<<HTML
	<script type="text/javascript">
		$(function(){
		    KindEditor.ready(function(K){
		        var editor = K.editor({
		            allowFileManager: true,
		            langType: '<{LANG}>',
		            fileManagerJson: '<{SITE_URL}>/common/fileManagerJson?type=imagesingle&module=<{MODULE}>',
		            uploadJson: '<{SITE_URL}>/common/uploadJson?type=imagesingle&module=<{MODULE}>',
		        });
		        K('#imagesingle_btn').click(function(){
					
					//K('#imagesingle').val()
		            editor.loadPlugin('image', function(){
		                editor.plugin.imageDialog({
		                    imageUrl: K('#imagesingle').val(),
		                    showRemote: false,
							isResizeOpen:'<{RESIZECHECK}>',
							isWatermarkOpen:'<{WMCHECK}>',
							resize:{width:'<{WIDTH}>',height:'<{HEIGHT}>',},
							watermark:{wmText:'<{WMTEXT}>',wmFontColor:'<{WMFONTCOLOR}>'},
		                    clickFn: function(url, title, width, height, border, align){
		                        var div = K('#imagesingle');
		                        //div.html('');
		                        var urlArr = url.split('/');
		                        var lResId = urlArr[urlArr.length - 1];
		                        var resId = lResId.split('.')[0];
	                            div.append('<span><button type="button" class="close">×</button>'+"<img src='" + url + "'/><br/><input type='text' name='imagesingle[" + resId + "][title]' value='' /><input type='hidden' name='imagesingle[" + resId + "][url]' value='" + url + "'/></span>");
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
HTML;
	if(is_bool($isNeedJsCss)&&$isNeedJsCss){
		$jscss=<<<HTML
		<link rel="stylesheet" href="<{KIND_URL}>/themes/default/default.css" />
		<link rel="stylesheet" href="<{KIND_URL}>/plugins/code/prettify.css" />
		<script type="text/javascript" charset="utf-8" src="<{KIND_URL}>/kindeditor-min.js"></script>
		<script type="text/javascript" charset="utf-8" src="<{KIND_URL}>/lang/<{LANG}>.js"></script>
		<script type="text/javascript" charset="utf-8" src="<{KIND_URL}>/plugins/code/prettify.js"></script>
		<script type="text/javascript" charset="utf-8" src="<{KIND_URL}>/kindeditor.common.js"></script>
HTML;
	}else{
		$jscss='';
	}
	$str=$jscss.$str;
	
	$site_url=site_url();
	$base_url = base_url ();
	$kindUrl = $base_url . 'assets/kindeditor';
	
	$CI=&get_instance();$CI->load->config('config_image_lib');
	$image_lib=config_item('image_lib');
	
	$open=$image_lib['open'];
	$isResizeOpen=$open['resize'];$resizeCheck='';if($isResizeOpen){$resizeCheck='checked';}
	$isWatermarkOpen=$open['watermark'];$wmCheck='';if($isWatermarkOpen){$wmCheck='checked';}
	
	$watermark=@$image_lib['watermark'];
	$wmText=@$watermark['wm_text'];
	$wmFontColor=@$watermark['wm_font_color'];
	
	
	$size=@$image_lib['size'];
	$width=@$size[$module]['width'];$height=@$size[$module]['height'];
	
	$str = str_replace ( '<{RESIZECHECK}>', $resizeCheck, $str );
	$str = str_replace ( '<{WMCHECK}>', $wmCheck, $str );
	
	$str = str_replace ( '<{WIDTH}>', $width, $str );
	$str = str_replace ( '<{HEIGHT}>', $height, $str );
	$str = str_replace ( '<{WMTEXT}>', $wmText, $str );
	$str = str_replace ( '<{WMFONTCOLOR}>', $wmFontColor, $str );
	
	$str = str_replace ( '<{KIND_URL}>', $kindUrl, $str );
	$str = str_replace ( '<{SITE_URL}>', $site_url, $str );
	$str = str_replace ( '<{MODULE}>', $module, $str );
	$str = str_replace ( '<{LANG}>', $lang, $str );
	return $str;
}

function getImageList($module='',$lang = '',$divId='imagelist',$isNeedJsCss=FALSE){
	if(isNullOrEmpty($module)){$module='';}
	if (isNullOrEmpty ( $lang )) {$lang = config_item ( 'language' );}
	if(isNullOrEmpty($divId)){$divId='imagelist';}
	$str=<<<HTML
	<script type="text/javascript">
		$(function(){
		    KindEditor.ready(function(K){
		    	var editor = K.editor({
		            allowFileManager: true,
		            langType: '<{LANG}>',
		            fileManagerJson: '<{SITE_URL}>/common/fileManagerJson?type=imagelist&module=<{MODULE}>',
		            uploadJson: '<{SITE_URL}>/common/uploadJson?type=imagelist&module=<{MODULE}>',
		        });
		        K('#imagelist_btn').click(function(){
		            editor.loadPlugin('multiimage', function(){
		                editor.plugin.multiImageDialog({
							isResizeOpen:'<{RESIZECHECK}>',
							isWatermarkOpen:'<{WMCHECK}>',
							resize:{width:'<{WIDTH}>',height:'<{HEIGHT}>',},
							watermark:{wmText:'<{WMTEXT}>',wmFontColor:'<{WMFONTCOLOR}>'},
		                    clickFn: function(urlList){
		                        var div = K('#imagelist');
		                        K.each(urlList, function(i, data){
			                        var imgUrl=data.url;
		                            var urlArr = data.url.split('/');
		                            var lResId = urlArr[urlArr.length - 1];
		                            var resId = lResId.split('.')[0];
		                            div.append('<span><button type="button" class="close">×</button>'+"<img src='" + imgUrl + "'/><br/><input type='text' name='imagelist[" + resId + "][title]' value='' /><input type='hidden' name='imagelist[" + resId + "][url]' value='" + imgUrl + "'/></span>");
		                        });
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
HTML;
	if(is_bool($isNeedJsCss)&&$isNeedJsCss){
		$jscss=<<<HTML
		<link rel="stylesheet" href="<{KIND_URL}>/themes/default/default.css" />
		<link rel="stylesheet" href="<{KIND_URL}>/plugins/code/prettify.css" />
		<script type="text/javascript" charset="utf-8" src="<{KIND_URL}>/kindeditor-min.js"></script>
		<script type="text/javascript" charset="utf-8" src="<{KIND_URL}>/lang/<{LANG}>.js"></script>
		<script type="text/javascript" charset="utf-8" src="<{KIND_URL}>/kindeditor.common.js"></script>
		<script type="text/javascript" charset="utf-8" src="<{KIND_URL}>/plugins/code/prettify.js"></script>
HTML;
	}else{
		$jscss='';
	}
	$str=$jscss.$str;
	
	$site_url=site_url();
	$base_url = base_url ();
	$kindUrl = $base_url . 'assets/kindeditor';
	
	$CI=&get_instance();$CI->load->config('config_image_lib');
	$image_lib=config_item('image_lib');
	
	$open=$image_lib['open'];
	$isResizeOpen=$open['resize'];$resizeCheck='';if($isResizeOpen){$resizeCheck='checked';}
	$isWatermarkOpen=$open['watermark'];$wmCheck='';if($isWatermarkOpen){$wmCheck='checked';}
	
	$watermark=@$image_lib['watermark'];
	$wmText=@$watermark['wm_text'];
	$wmFontColor=@$watermark['wm_font_color'];
	
	
	$size=@$image_lib['size'];
	$width=@$size[$module]['width'];$height=@$size[$module]['height'];
	
	$str = str_replace ( '<{RESIZECHECK}>', $resizeCheck, $str );
	$str = str_replace ( '<{WMCHECK}>', $wmCheck, $str );
	
	$str = str_replace ( '<{WIDTH}>', $width, $str );
	$str = str_replace ( '<{HEIGHT}>', $height, $str );
	$str = str_replace ( '<{WMTEXT}>', $wmText, $str );
	$str = str_replace ( '<{WMFONTCOLOR}>', $wmFontColor, $str );
	
	$str = str_replace ( '<{KIND_URL}>', $kindUrl, $str );
	$str = str_replace ( '<{SITE_URL}>', $site_url, $str );
	$str = str_replace ( '<{MODULE}>', $module, $str );
	$str = str_replace ( '<{LANG}>', $lang, $str );
	return $str;
}

if (! function_exists ( 'getKindEditor' )) {
	function getKindEditor($msg='',$lang = '') {
		if (isNullOrEmpty ( $msg )) {
			$msg = '';
		}
		if (isNullOrEmpty ( $lang )) {
			$lang = config_item ( 'language' );
		}
		
		$str = <<<HTML
		<link rel="stylesheet" href="<{KIND_URL}>/themes/default/default.css" />
		<link rel="stylesheet" href="<{KIND_URL}>/plugins/code/prettify.css" />
		<script type="text/javascript" charset="utf-8" src="<{KIND_URL}>/kindeditor-min.js"></script>
		<script type="text/javascript" charset="utf-8" src="<{KIND_URL}>/lang/<{LANG}>.js"></script>
		<script type="text/javascript" charset="utf-8" src="<{KIND_URL}>/plugins/code/prettify.js"></script>
		<script type="text/javascript" charset="utf-8" src="<{KIND_URL}>/kindeditor.common.js"></script>
		<textarea id="myEditor" name="content" style="width:700px;height:500px;visibility:hidden;"><{TESTAREA}></textarea>
		<script type="text/javascript">
			$(function(){
				//KindEditor.options.filterMode = false;
				var editor = KindEditor.create('textarea[name="content"]',{
						cssPath : '<{KIND_URL}>/plugins/code/prettify.css',
						allowFileManager:true,
						fileManagerJson:'<{SITE_URL}>/common/fileManagerJson',
						uploadJson:'<{SITE_URL}>/common/uploadJson',
						langType:'<{LANG}>',
						afterCreate : function() {},
					});
				$('#myEditor').bind('submit',function(){editor.sync();});
			});
		</script>
HTML;
		$base_url = base_url ();
		$site_url=site_url();
		$kindUrl = $base_url . 'assets/kindeditor';
		$str = str_replace ( '<{KIND_URL}>', $kindUrl, $str );
		$str = str_replace ( '<{SITE_URL}>', $site_url, $str );
		$str = str_replace ( '<{LANG}>', $lang, $str );
		$str = str_replace ( '<{TESTAREA}>', $msg, $str );
		
		return $str;
	}
}


if (! function_exists ( 'getKeyFromValue' )) {
	function getKeyFromValue($array=array(),$value=''){
		if(!is_array($array)){return '';}
		if(isNullOrEmpty($array)){return '';}
		$arr=array_flip($array);
		return @$arr[$value];
	}
}
if (! function_exists ( 'get_lang_button' )) {
	function get_lang_button(){
		$arr_lang=config_item('lang');
		$langBtn='';
		foreach ($arr_lang as $key=>$value){
			$tmp_langBtn='{
					name : "'.$value.'",
					bclass : "lang",
					onpress : selectLang,
				},';
			$langBtn.=$tmp_langBtn;
		}
		return $langBtn;
	}
}
if (! function_exists ( 'get_Lang_html' )) {
	function get_Lang_html($lang=''){
		if(isNullOrEmpty($lang)){
			$lang=config_item('language');
		}
		$str='<option value="">请选择</option>';
		$arr_lang=config_item('lang');
		if(is_array($arr_lang)){
			$temp='';
			foreach($arr_lang as $key=>$value){
				if($key==$lang){
					$temp='<option value="'.$key.'" selected="selected">'.$value.'</option>';
				}else{
					$temp='<option value="'.$key.'" >'.$value.'</option>';
				}
				$str.=$temp;
			}
		}
		return $str;
	}
}

if (! function_exists ( 'session' )) {
	function session($key,$value=NULL,$isArray=FALSE){
		if(isNull($value)){
			$value=@$_SESSION[get_subclass_prefix().$key];
		}else{
			if(!isNullOrEmpty($isArray)){
				if(is_numeric($isArray)||is_string($isArray)){
					$_SESSION[get_subclass_prefix().$key][$isArray]=$value;
				}else if(is_bool($isArray)&&$isArray===TRUE){
					$_SESSION[get_subclass_prefix().$key][]=$value;
				}else{
					$_SESSION[get_subclass_prefix().$key]=$value;
				}
			}else{
				$_SESSION[get_subclass_prefix().$key]=$value;
			}
		}
		
		return $value;
	}
}
if (! function_exists ( 'unset_session' )) {
	function unset_session($key,$key1='',$key2=''){
		if(isNullOrEmpty($key)){
			//do something,请谨慎操作
		}else if(isNullOrEmpty($key1)){
			unset($_SESSION[get_subclass_prefix().$key]);
		}else if(isNullOrEmpty($key2)){
			unset($_SESSION[get_subclass_prefix().$key][$key1]);
		}else{
			unset($_SESSION[get_subclass_prefix().$key][$key1][$key2]);
		}
		
	}
}

if (! function_exists ( 'get_db_prefix' )) {
	function get_db_prefix(){
		$db_prefix=strtolower(config_item('db_prefix'));
		return $db_prefix;
	}
}
if (! function_exists ( 'get_subclass_prefix' )) {
	function get_subclass_prefix(){
		$subclass_prefix=strtolower(config_item('subclass_prefix'));
		return $subclass_prefix;
	}
}
if (! function_exists ( 'writeLog' )) {
	function writeLog($describe='',$logType=0){
		if(!is_numeric($logType)){$logType=0;}else{
			$type=config_item('log_type');
			if(isNullOrEmpty(@$type[$logType])){$logType=0;}
		}
		$site_url=site_url () ;
			
		
		$ip=$_SERVER['REMOTE_ADDR'];
		
		$absolute_url=absolute_url();
		$emergeURL=$absolute_url;
		
		$arr_post['logTime']=time();
		$arr_post['logType']=$logType;
		$arr_post['describe']=$describe;
		$arr_post['ip']=$ip;
		$arr_post['emergeURL']=$emergeURL;
		$arr_post['userId']=@session('adminId');
		
		$CI =& get_instance();
		$CI->load->model('Common_Model');
		$CI->Common_Model->table='log';
		$result = $CI->Common_Model->insert ( $arr_post );
		return $result;
	}
}

if (! function_exists ( 'operatePowerCacheFile' )) {
	function operatePowerCacheFile($action='read',$data='',$adminName=''){
		if(isNullOrEmpty($adminName)){$adminName=session('adminUser');}
		
		$file=productFileName($adminName);
		$base_url=base_url();
		$script_filename=$_SERVER['SCRIPT_FILENAME'];
		$script_filename=str_replace('\\', '/', $script_filename);
		$script_filename=substr($script_filename, 0,strrpos($script_filename, '/'));
		$path=$script_filename.'/application/cache/admin/'.$file;
		$result=operateFile($path,$action,$data);
		return $result;
	}
}
if (! function_exists ( 'productFileName' )) {
	function productFileName($string){
		$rand=config_item('subclass_prefix').$string;
		$file=sha1($rand);
		if(!isNullOrEmpty($file)){$file.='.php';}
		return $file;
	}
}
if (! function_exists ( 'operateFile' )) {
	/**
	 * 操作文件
	 * @param string $file 文件路径
	 * @param string $action 文件操作，r或read,w或write,d或delete
	 * @param string $data 当文件操作是write时，写到文件的数据
	 * @param string $mode 当文件操作是write时，默认 r+
	 * @return Ambigous <string, boolean>
	 */
	function operateFile($file,$action='read',$data='',$mode='w+'){
		$str='';
		if(!isNullOrEmpty($file)){
			$action=strtolower($action);
			if($action=='r'||$action=='read'){
				$str=read_file($file);
			}else if($action=='w'||$action=='write'){
				$str=write_file($file, $data,$mode);
				if(!$str){
					header('Content-type:text/html;charset=utf-8');
					$msg=$file.',文件写入失败,请查看文件是否可写或文件及文件夹是否存在！';
					exit($msg);
				}
			}else if($action=='d'||$action=='delete'){
				if(is_file($file)){
					$str=@unlink($file);
				}else{
					$str=delete_files($file);
				}
			}else{
				$str=FALSE;
			}
		}
		return $str;
	}
}

if (! function_exists ( 'getPowerCode' )) {
	/**
	 * 获取权限码
	 * @param array $nav_power=array('module'=>'','action'=>'');
	 * @param array $power
	 */
	function getPowerCode($nav_power,$power=NULL) {
		if(!is_array($nav_power)){return '';}
		if(isNullOrEmpty($power)){$power=config_item('power');}
		if(!is_array($power)){exit('权限配置文件配置出错！');}
		//$menu=@$nav_power['menu'];
		$module=@$nav_power['module'];
		$action=@$nav_power['action'];
		//$menu=isNullOrEmpty($menu)?'menu1':$menu;
		$module=isNullOrEmpty($module)?'index':$module;
		$action=isNullOrEmpty($action)?'lists':$action;
		$powerCode='';
		foreach ($power as $menu){
			if(is_array($menu)){
				foreach ($menu as $key=>$value){
					if($module==$key){
						$powerCode=@$value[$action];
						break;
					}
				}
			}
			
		}
		return $powerCode;
	}
}
if (! function_exists ( 'isHavePower' )) {
	/**
	 * 是否有操作权限
	 * @param array $nav_power=array('module'=>'','action'=>'');
	 */
	function isHavePower($nav_power){
		$powerCode=getPowerCode($nav_power);
		$result=operatePowerCacheFile('read');
		if(is_bool($result)){
			$msg='无法读取缓存文件！为保证数据正确，请重新登录！';
			$icon="error";
			$redirect=site_url().'/admin/logout';
			showDialog($msg,'',3000,$icon,$redirect);
			exit();
		}
		$str_power=$result;
		//$str_power= @unserialize($result);
		$CI =& get_instance();
		$CI->load->library('encrypt');
		$str_power = $CI->encrypt->decode($str_power);
		
		$isHave=FALSE;
		if(is_numeric(@strpos($str_power, $powerCode))){
			$isHave=TRUE;
		}else{
			$isHave=FALSE;
		}
		return $isHave;
	}
}
if (! function_exists ( 'checkPower' )) {
	function checkPower($nav_power,$moduleMsg='',$redirect=''){
		//if(session('adminId')==='1'){return true;}
		if(!isHavePower($nav_power)){
// 			$msg = '您无权限操作！';
// 			if(!isNullOrEmpty($moduleMsg)){}
			$msg='抱歉，您无'.$moduleMsg.'操作权限！';
			$logType=1;
			writeLog($msg,$logType);
			if(!isNullOrEmpty($redirect)){$redirect = site_url () . '/'.$redirect;}
			showDialog ( $msg, '警告', 3000, "warning" ,$redirect);
			exit ();
		}
	}
}
if (! function_exists ( 'absolute_url' )) {
	/**
	 * 绝对路径
	 * @param int $protocol 协议 默认0 http 1为https
	 * @return string
	 */
	function absolute_url($protocol=0){
		$host=@$_SERVER['HTTP_HOST'];
		$request_uri=@$_SERVER['REQUEST_URI'];
		
		$absolute_url=$host.$request_uri;
		if($protocol==0){
			$protocol='http';
		}else if($protocol==1){
			$protocol='https';
		}else{
			$protocol='http';
		}
		$protocol=$protocol.'://';
		
		$absolute_url=$protocol.$absolute_url;
		return $absolute_url;
	}
}

if (! function_exists ( 'checkLogin' )) {
	function checkLogin() {
		if (! isAdminUserExist ()) { // 登录
			$msg = '请先登录';
			$site_url=site_url () ;
			$absolute_url=absolute_url();
			
// 			$CI=&get_instance();
// 			$CI->load->library('encrypt');
// 			$absolute_url=$CI->encrypt->encode($absolute_url);
			
			$redirect = $site_url. '/admin/login';
			$redirect.='?redirect='.$absolute_url;
			showDialog ( $msg, '警告', 3000, "warning", $redirect );
			exit ();
		}
	}
}

if (! function_exists ( 'setvar' )) {
	/**
	 * 去空格
	 * @param string $var
	 * @return string
	 */
	function setvar($var){
		if(is_string($var)){
			$var=trim($var);
		}
		return $var;
	}
}

if (! function_exists ( 'setForm' )) {
	function setForm($var){
		if(is_array($var)){
			foreach($var as $key=>$value){
// 				if(is_string($key)){$key=strtolower($key);}
				switch ($key){
					case 'power':
					case 'forPlugin':
						if(is_array($value)){
							$tmp=implode(',', $value);
						}else{
							$tmp=setvar($value);
						}
						break;
					case 'Id':
					case 'id':
						if(is_numeric(strpos($value, ','))){
							$tmp=(trim($value,','));
							$tmp=explode(',', $tmp);
						}else{
							$tmp=setvar($value);
						}
						break;
					case 'fatherId':
						$tmp=setvar($value);
						$tmp=(is_numeric($tmp))?$tmp:0;
						break;
					case 'content':
// 					case 'title':
// 					case 'keywords':
					case 'description':
						$tmp=toAddSlashes($value);//添加反斜杠
						//$tmp=$value;
						break;
					default:
						$value=toAddSlashes($value);//添加反斜杠
						$tmp=setvar($value);
						break;
				}
				$var[$key]=$tmp;
			}
		}else if(is_string($var)){
			$var=setvar($var);
		}
		return $var;
	}
}
if (! function_exists ( 'toAddSlashes' )) {
	/**
	 * 预定义字符：单引号 (')、双引号 (")、反斜杠 (\)、NULL，添加反斜杠
	 * @param var $var
	 */
	function toAddSlashes($var){
		$str='';
		if(!isNullOrEmpty($var)){
			if(!get_magic_quotes_gpc()){
				if(is_array($var)){
					$str=array();
					foreach($var as $key=>$value){
						if(!is_array($value)){
							if(is_numeric($value)){
								$str=$var;
							}else{
								$str[$key]=addslashes($value);
							}
						}else{
							$str[$key]=toAddSlashes($value);
						}
					}
				}else if(is_numeric($var)){
					$str=$var;
				}else{
					$str=addslashes($var);
				}
			}
		}else{
			$str=$var;
		}
		
		return $str;
	}
}
if (! function_exists ( 'toStripslashes' )) {
	/**
	 * 预定义字符,删除反斜杠
	 * @param var $var
	 */
	function toStripslashes($var){
		$str='';
		if(!isNullOrEmpty($var)){
			//if(!get_magic_quotes_gpc()){
				if(is_array($var)){
					$str=array();
					foreach($var as $key=>$value){
						if(!is_array($value)){
							if(is_numeric($value)){
								$str=$var;
							}else{
								$str[$key]=stripslashes($value);
							}
						}else{
							$str[$key]=toStripslashes($value);
						}
					}
				}else if(is_numeric($var)){
					$str=$var;
				}else{
					$str=stripslashes($var);
				}
			//}
		}else{
			$str=$var;
		}
		
		return $str;
	}
}

if (! function_exists ( 'toHtmlSpecialChars' )) {
	/**
	 *  html代码 源码输出
	 * @param var $var
	 */
	function toHtmlSpecialChars($var){
		$str='';
		if(!isNullOrEmpty($var)){
			
			if(is_array($var)){
				$str=array();
				foreach($var as $key=>$value){
					if(!is_array($value)){
							$str[$key]=htmlspecialchars($value);
					}else{
						$str[$key]=toHtmlSpecialChars($value);
					}
				}
			}else{
				$str=htmlspecialchars($var);
			}
			
		}else{
			$str=$var;
		}
	
		return $str;
	}
}

if (! function_exists ( 'toStriForHtmlSpeChar' )) {
	/**
	 *  去掉反斜杠，html代码 源码输出
	 * @param var $var
	 */
	function toStriForHtmlSpeChar($var){
		$str=toHtmlSpecialChars(toStripslashes($var));
		return $str;
	}
}

if (! function_exists ( 'get_power_html' )) {
	/**
	 * 根据配置权限，生成html代码
	 * @param array $power 配置权限数组
	 * @param array $selectPower 已选择的权限
	 * @param bool $isDisabledCB checkbox是否禁用，默认可用
	 * @return void|string
	 */
	function get_power_html($power,$selectPower=NULL,$isDisabledCB=FALSE){
		//$isDisabledCB=true;
		if(!is_array($power)){ if(isNullOrEmpty($power)){$power=config_item('power');}else{ $power=str_split($power,',');}}
		
		if(isNullOrEmpty($selectPower)){ $selectPower=''; }
		if(!is_bool($isDisabledCB)){ $isDisabledCB=FALSE; }
		if($isDisabledCB) { $disabled=' disabled '; }else{ $disabled=''; }
		$temp='';
		foreach ( $power as $key => $value ) {
			if(isNullOrEmpty($value)){
				continue;
			}
			$vTmp = '';
			$nTmp = lang ( 'common_' . $key );
			$tempA = '<h2><label>&nbsp;&nbsp;<input type="hidden"  name="" value="">' . $nTmp['title'] . '</label></h2>';
			$roleB = '';
			if (is_array ( $value )) {
				foreach ( $value as $key1 => $value1 ) {
					$vTmp = @$value1 ['index']; // 权限值
					$arrLang = lang ( 'common_' . $key1 ); // 文字
					$title = $arrLang ['title'];
					$check='';$tmpDisabled=$disabled;
					if(is_numeric(strpos($selectPower, $vTmp))){$check=' checked=checked ';}else{ $tmpDisabled=$disabled; }
					$tempB = '<label><strong><input type="checkbox" name="power[]" value="' . $vTmp .'"'.$check.$tmpDisabled.' />' . $title . '</strong></label>';
					$roleC = '';
					if (is_array ( $value1 )) {
						foreach ( $value1 as $key2 => $value2 ) {
							if ($key2 != 'index') {
								$nTmp = $arrLang [$key2];
								$check='';$tmpDisabled=$disabled;
								if(is_numeric(strpos($selectPower, $value2))){$check=' checked=checked ';}else{ $tmpDisabled=$disabled; }
								
								$tempC = '<label><input type="checkbox" name="power[]" value="' . $value2 .'"'.$check.$tmpDisabled.' />' . $nTmp . '</label>&nbsp;&nbsp;&nbsp;';
								$roleC .= $tempC;
							}
						}
						$roleC = '<div class="rolesC">' . $roleC . '</div>';
					}
					$roleB .= $tempB . $roleC;
				}
				$roleB = '<div class="rolesB">' . $roleB . '</div>';
			}
			$roleA = '<div class="rolesA clearfix">' . $tempA . $roleB . '</div>';
			$temp .= $roleA;
		}
		$str=$temp;
		$js='<script type="text/javascript" src="'.base_url().'assets/admin/js/topower.js"></script>';
		$str.=$js;
		return $str;
	}
}

if (! function_exists ( 'get_formTable_jsCss' )) {
	/**
	 * --get_formTable_jsCss-- 
	 * @param unknown_type $formEle
	 * @return string|mixed
	 */
	function get_formTable_jsCss(){
		$str=<<<HTML
				<link rel="stylesheet" href="<{BASE_URL}>assets/admin/css/topower.css" type="text/css" media="all">
				<link rel="stylesheet" href="<{BASE_URL}>assets/validform/css/validform.css" type="text/css" media="all">
				<script src="<{BASE_URL}>assets/Validform/js/Validform_v5.3.2_min.js"></script>
				<script type="text/javascript">
					$(function(){
						$(".formTable").Validform({
							tiptype:2,
							datatype:{
								"z2-4" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,4}$/,
								"d1-3":/^\d{1,3}$/,
							},
							tipmsg:{
								tit:"提示信息",
								w:"请输入正确信息！",
								r:"通过信息验证！",
								c:"正在检测信息…",
								s:"请填入信息！",
								v:"所填信息没有经过验证，请稍后…",
								p:"正在提交数据…",
								err:"出错了！提交地址或返回数据格式是错误！",
								abort:"Ajax操作被取消！"
								},
						});
					});
				</script>
HTML;
		
		$base_url=base_url();
		$str = str_replace ( '<{BASE_URL}>', $base_url, $str );
		return $str;
	}
}

if (! function_exists ( 'get_flexigrid' )) {
	function get_flexigrid($flexigridData=array(),$flexigridId='flexme'){
		
		$str=<<<HTML
					<link rel="stylesheet" type="text/css" href="<{BASE_URL}>assets/Flexigrid/css/flexigrid.pack.css" />
					<div class="<{FLEXIGRID_ID}>"></div>
					<script type="text/javascript" src="<{BASE_URL}>assets/Flexigrid/js/flexigrid.pack.js"></script>
					<script type="text/javascript" src="<{BASE_URL}>assets/Flexigrid/js/flexigrid.common.js"></script>
					<script type="text/javascript">
					<{REFRESHFLEXIGRID_FUN}>
					$(function(){
		            $(".<{FLEXIGRID_ID}>").flexigrid(<{FLEXIGRID_DATA}>);
				});
				</script>
HTML;
		$data = array (
				'url' => '',
				'dataType' => 'json',
				'method' => 'POST',
				'colModel' => '',
				'buttons' => '[{name : "全选/反选",bclass : "allSelected",onpress : btnCB},{name : "删除",bclass : "delete",onpress : btnCB},{separator : true}]',
				'searchitems' => '',
				'sortname' => 'Id',
				'sortorder' => 'asc',
				'usepager' => true,
				'rp' => 10,
				'rpOptions' => '[10, 15, 20, 25, 40, 100]',
				'showTableToggleBtn' => false,
				'pagestat' => '显示记录从{from}到{to}，总数 {total} 条',
				'procmsg' => '正在处理数据，请稍候 ...',
				'nomsg' => '没有符合条件的记录存在',
				'width' => '100%',
				'height' => '100%',
				'blockOpacity' => 0.85,
				'findtext'=>'查找：',
				'function'=>array(
						'onSuccess'=>'successCallback()',
						),
		);
		
		$base_url=base_url();
		if (isNullOrEmpty ( $flexigridId )) {
			$flexigridId = 'flexme';
		}
		if ($flexigridId != 'flexme') {
			$refreshflexigrid = 'refreshGrid_' . $flexigridId . ' = function(){$(".' . $flexigridId . '").flexReload();}';
		} else {
			$refreshflexigrid = '';
		}
		
		$flexigridData=array_merge($data,$flexigridData);//合并数组
		
		$flexigridDataStr='{';
		foreach ($flexigridData as $key=>$value){
			if(is_string($value)){
				$value=trim($value);
				if(strpos($value, '[')===0){
					$tmp=$key.':'.$value.',';
				}else{
					$tmp=$key.':"'.$value.'",';
				}
				
			}else if(is_array($value)){
				foreach ($value as $key1=>$value1){
					$tmp=$key1.':'.$value1.',';
				}
			}else{
				if(is_bool($value)){$value=$value?'true':'false';}
				$tmp=$key.':'.$value.',';
			}
			$flexigridDataStr .= $tmp;
		}
		$flexigridDataStr.='}';
		
		$str = str_replace ( '<{BASE_URL}>', $base_url, $str );
		$str = str_replace ( '<{FLEXIGRID_ID}>', $flexigridId, $str );
		$str = str_replace ( '<{REFRESHFLEXIGRID_FUN}>', $refreshflexigrid, $str );
		$str = str_replace ( '<{FLEXIGRID_DATA}>', $flexigridDataStr, $str );
		return $str;	
	}
}

if (! function_exists ( 'isAdminUserExist' )) {
	function isAdminUserExist(){//判断管理用户是否已登录
		$sess_adminUser=@session('adminUser');
		$coo_adminUser=get_cookie();
		if(empty($sess_adminUser)&&empty($coo_adminUser)){
			return FALSE;
		}else{
			return TRUE;
		}
	}
}
if (! function_exists ( 'showErrorMsg' )) {
	function showErrorMsg($msg=''){
		if(isNullOrEmpty($msg)){$msg='Error';}
		$logType=3;
		writeLog($msg,$logType);
		showDialog($msg,'错误',3000,"error");
		exit();
	}
}
if (! function_exists ( 'showDialog' )) {
	function showDialog($msg="",$title="提示",$time=0,$icon="",$redirect=""){
		
		$str=<<<SHOW
		<!DOCTYPE html>
		<html>
		<head>
		<link href="<{BASE_URL}>assets/dialog/dialog.css" type="text/css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<{BASE_URL}>assets/bootstrap/css/bootstrap.min.css">
		<script src="<{BASE_URL}>assets/dialog/jquery.min.js" type="text/javascript"></script>
		<script src="<{BASE_URL}>assets/dialog/dialog.js" type="text/javascript"></script>
		<script type="text/javascript">
				$(function(){
				var dialog=new Dialog('<{MSG}>',{
				title:'<{TITLE}>',
				time:'<{TIME}>',
				icon:'<{ICON}>',
				cancel:'',
				afterOk:function(that){that.close();},
				afterClose:function(){<{REDIRECT}>},
				beforeClose:function(){return true;}
	}).show();
				});
		</script>
		</head>
		<body>
		</body>
		</html>
SHOW;
		$title=isNullOrEmpty($title)?'提示':$title;
		$time=is_numeric($time)?$time:0;
		$base_url=base_url();
		$icon=isNullOrEmpty($icon)?'':$base_url.'assets/dialog/icons/'.$icon.'.png';
		$redirect=isNullOrEmpty($redirect)?'window.history.back();':'window.location.href="'.$redirect.'";';
		$str = str_replace ( '<{BASE_URL}>', $base_url, $str );
		$str = str_replace ( '<{MSG}>', $msg, $str );
		$str = str_replace ( '<{TITLE}>', $title, $str );
		$str = str_replace ( '<{TIME}>', $time, $str );
		$str = str_replace ( '<{ICON}>', $icon, $str );
		$str = str_replace ( '<{REDIRECT}>', $redirect, $str );
		header("Content-type: text/html; charset=utf-8");
		echo $str;
	}
}
if (! function_exists ( 'isNullOrEmpty' )) {
	function isNullOrEmpty($var){
		if(is_numeric($var)){
			return FALSE;
		}else if(empty($var)||!isset($var)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if (! function_exists ( 'isNull' )) {
	function isNull($var){
		if($var===NULL||!isset($var)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

if (! function_exists ( 'get_footer' )) {
	/**
	 * 获取footer 
	 * @return mixed
	 */
	function get_footer() {
		$str = <<<SHOW
			<footer>
				<hr>
				<p class="pull-right">
					<a href="https://github.com/twbs/bootstrap"
						target="_blank">Free Bootstrap</a>
				</p>
				<p>
					 <a href="http://www.paxonpilot.com" target="_blank">Paxonpilot</a>&nbsp;&copy; <{TIME}> &nbsp;Copyright (C)
				</p>
			</footer>
SHOW;
		$time = date ( 'Y', time () );
		$str = str_replace ( '<{TIME}>', $time, $str );
		return $str;
	}
}

if (! function_exists ( 'get_side_navbar' )) {
	function get_side_navbar($current,$currAction='',$config=''){
		$side_navbar='<div class="sidebar-nav">';
		if(isNullOrEmpty($config)){
// 			$side_navbar .='</div>';
			$config=config_item('sideNavBar');
		}
		
		if(!is_array($config)){
			$side_navbar .=$config.'</div>';
		}else{
			$side_navbar_tmp='';
			foreach ($config as $key=>$value){
				$id=$key;
				//$name=$value['name'];
				$name=lang('common_'.$key);$name=$name['title'];
				$ul=@$value['ul'];
				$leftIcon=@$value['leftIcon'];
				$isVisible=@$value['isVisible'];
				$href=@$value['href'];
				
				$data_toggle='';
				$icon_chevron_up='';
				$ul_menu='';
				if(is_array($ul)&&isNullOrEmpty($ul)==FALSE){
					$href='#'.$id;
					$str='';
					$isCurrent=false;
					foreach($ul as $key1=>$a){
						//$a_name=$a['name'];
						
						$a_module=@$a['module'];
						$a_action=@$a['action'];
						
						$nav_power=array('module'=>$a_module,'action'=>$a_action);
						
						if(isNullOrEmpty($isVisible)||$isVisible==FALSE){
							if(!isHavePower($nav_power)){
								continue;
							}
						}
						
						$a_name=lang('common_'.$a_module);
						
						if($a_action===$a_module||$a_action==="index"){
							$a_name_key='title';
						}else{
							$a_name_key=$a_action;
						}
						
						$a_name=@$a_name[$a_name_key];
						
						
						$a_href=@$a['href'];if(isNullOrEmpty($a_href)){$a_href='/'.$a_module.'/index';}
						$a_href=site_url().$a_href;
						
						$currClass='';
						if($current===$a_module){
							if(isNullOrEmpty($currAction)){
								$currClass=' class="current" ';
								$isCurrent=true;
							}else if($a_action===$currAction){
								$currClass=' class="current" ';
								$isCurrent=true;
							}else{
								$currClass='';
							}
							
						}else{
							$currClass='';
							//$li_a='<li><a href="'.$a_href.'">'.$a_name.'</a></li>';
						}
						
						$li_a = '<li><a '.$currClass.' href="' . $a_href . '">' . $a_name . '</a></li>';
						
						$str.=$li_a;
					}
					
					if(!isNullOrEmpty($str)){
						if($isCurrent){
							$ul_menu='<ul id="'.$id.'" class="nav nav-list collapse in">';
							$collapsed='';
						}else{
							$ul_menu='<ul id="'.$id.'" class="nav nav-list collapse">';
							$collapsed=' collapsed ';
						}
						$ul_menu.=$str.'</ul>';
						$icon_chevron_up='<i class="icon-chevron-up"></i>';
						$data_toggle='data-toggle="collapse"';
						
						$menu='<a href="'.$href.'" class="nav-header '.$collapsed.'" '.$data_toggle.' ><i
			class="'.$leftIcon.'"></i>'.$name.$icon_chevron_up.'</a>';
						
					}else{
						$menu="";
					}
				}else{
					$href=site_url().$href;
					
					$icon_chevron_up='';
					$data_toggle='';
					$ul_menu='';
					$collapsed='';
					
					
					
					if(!isNullOrEmpty($isVisible)&&$isVisible==TRUE){
						$menu='<a href="'.$href.'" class="nav-header '.$collapsed.'" '.$data_toggle.' ><i
			class="'.$leftIcon.'"></i>'.$name.$icon_chevron_up.'</a>';
						
					}else{
						$module=@$value['module'];
						$action=@$value['action'];
						$nav_power=array('module'=>$module,'action'=>$action);
						
						if(!isHavePower($nav_power)){
							$menu="";
							
							//var_dump($nav_power);
						}else{
							$menu='<a href="'.$href.'" class="nav-header '.$collapsed.'" '.$data_toggle.' ><i
			class="'.$leftIcon.'"></i>'.$name.$icon_chevron_up.'</a>';
								
						}
					}
				}
				
				$menu.=$ul_menu;
				$side_navbar_tmp.=$menu;
			}
			
			$side_navbar.=$side_navbar_tmp.'</div>';
		}
		$troggle_temp=<<<HTML
		<div class="navigation_resizer" id="menuResize">
  			 <div class="troggle_icon" id="sidebar_troggle"  rel="tooltip" data-placement="right" data-original-title="打开/关闭左菜单" onclick="sidebarNavToggle('<{SITE_URL}>');"  ></div>
		</div>
HTML;
		$site_url = site_url();
		$troggle_temp = str_replace ( '<{SITE_URL}>', $site_url, $troggle_temp );
		
		return $side_navbar.$troggle_temp;
	}
}

if (! function_exists ( 'get_navbar' )) {
	/**
	 * 获取导航bar 
	 * @return mixed
	 */
	function get_navbar() {
		if(isAdminUserExist()){
			$str=<<<SHOW
				<div class="navbar">
		<div class="navbar-inner">
			<ul class="nav pull-right">

				<li><a href="#" class="hidden-phone visible-tablet visible-desktop"
					role="button">设&nbsp;置</a></li>
				<li id="fat-menu" class="dropdown"><a href="#" role="button"
					class="dropdown-toggle" data-toggle="dropdown">欢迎您，<i
						class="icon-user"></i>&nbsp;<{ADMINUSER}>&nbsp;<i class="icon-caret-down"></i>
				</a>
					<ul class="dropdown-menu">
						<li><a tabindex="-1" href="<{ADMINURL}>">个人信息</a></li>
						<li class="divider"></li>
						<li><a tabindex="-1" href="<{SITE_URL}>/adminUser/updatePwd">修改密码</a></li>
						<li class="divider visible-phone"></li>
						<li><a tabindex="-1" class="visible-phone" href="#">设&nbsp;置</a></li>
						<li class="divider visible-phone"></li>
						<li><a tabindex="-1" class="visible-phone" href="<{SITE_URL}>/admin/logout">注&nbsp;销</a></li>
					</ul></li>
				<li><a class="hidden-phone visible-tablet visible-desktop" href="<{SITE_URL}>/admin/logout">注&nbsp;销</a></li>
			</ul>
			<a class="admin_logo" target="_blank" href="<{SITE_URL}>"><img
					src="<{BASE_URL}>assets/admin/images/logo.png"
					alt="logo"><span class="">蜂觅API-V1.0</span></a>
		</div>
	</div>
						
	<a rel="tooltip" data-placement="left" data-original-title="返回顶部" onclick="scrolltop();" class="set no-print" style="bottom: 100px; "><i class="icon-arrow-up"></i></a>
	
SHOW;
			$adminId=@session('adminId');
			//$adminUrl=site_url().'/adminUser/update/'.$adminId;
			$adminUrl=site_url().'/adminUser/info';
			$str = str_replace ( '<{ADMINURL}>', $adminUrl, $str );
			$adminUser=@session('adminUser');
			$str = str_replace ( '<{ADMINUSER}>', $adminUser, $str );
		}else{
			$str = <<<SHOW
    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                </ul>
					<a class="admin_logo" target="_blank" href="<{SITE_URL}>"><img
					src="<{BASE_URL}>assets/admin/images/logo.png"
					alt="logo"><span class="">蜂觅API-V1.0</span></a>
        </div>
    </div>
SHOW;
		}
		
		$site_url = site_url();
		$base_url=base_url();
		$str = str_replace ( '<{SITE_URL}>', $site_url, $str );
		$str = str_replace ( '<{BASE_URL}>', $base_url, $str );
		
		return $str;
	}
}

if(!function_exists('get_imageData')){
	/**
	 * get_imageData
	 * @param $string 字符串
	 * @param $width 宽度
	 * @param $height 高度
	 * @return string
	 */
	function get_imageData($string = '', $width = 75, $height = 25){
		$authstr = $string ? $string : ((time () % 2 == 0) ? mt_rand ( 1000, 9999 ) : mt_rand ( 10000, 99999 ));
		$board_width = $width;
		$board_height = $height;
		// 生成一个32帧的GIF动画
		for($i = 0; $i < 32; $i ++) {
			ob_start ();
			$image = imagecreate ( $board_width, $board_height );
			imagecolorallocate ( $image, 0, 0, 0 );
			// 设定文字颜色数组
			$colorList [] = ImageColorAllocate ( $image, 15, 73, 210 );
			$colorList [] = ImageColorAllocate ( $image, 0, 64, 0 );
			$colorList [] = ImageColorAllocate ( $image, 0, 0, 64 );
			$colorList [] = ImageColorAllocate ( $image, 0, 128, 128 );
			$colorList [] = ImageColorAllocate ( $image, 27, 52, 47 );
			$colorList [] = ImageColorAllocate ( $image, 51, 0, 102 );
			$colorList [] = ImageColorAllocate ( $image, 0, 0, 145 );
			$colorList [] = ImageColorAllocate ( $image, 0, 0, 113 );
			$colorList [] = ImageColorAllocate ( $image, 0, 51, 51 );
			$colorList [] = ImageColorAllocate ( $image, 158, 180, 35 );
			$colorList [] = ImageColorAllocate ( $image, 59, 59, 59 );
			$colorList [] = ImageColorAllocate ( $image, 0, 0, 0 );
			$colorList [] = ImageColorAllocate ( $image, 1, 128, 180 );
			$colorList [] = ImageColorAllocate ( $image, 0, 153, 51 );
			$colorList [] = ImageColorAllocate ( $image, 60, 131, 1 );
			$colorList [] = ImageColorAllocate ( $image, 0, 0, 0 );
			$fontcolor = ImageColorAllocate ( $image, 0, 0, 0 );
			$gray = ImageColorAllocate ( $image, 245, 245, 245 );
				
			$color = imagecolorallocate ( $image, 255, 255, 255 );
			$color2 = imagecolorallocate ( $image, 255, 0, 0 );
				
			imagefill ( $image, 0, 0, $gray );
			
			$top=0; //
			$space = 15; // 字符间距
			if ($i > 0) 			// 屏蔽第一帧
			{
				for($k = 0; $k < strlen ( $authstr ); $k ++) {
					$colorRandom = mt_rand ( 0, sizeof ( $colorList ) - 1 );
					$float_top = rand ( 0, 4 );
					$float_left = rand ( 0, 3 );
					imagestring ( $image, 6, $space * $k, $top + $float_top, substr ( $authstr, $k, 1 ), $colorList [$colorRandom] );
				}
			}
				
			for($k = 0; $k < 20; $k ++) {
				$colorRandom = mt_rand ( 0, sizeof ( $colorList ) - 1 );
				imagesetpixel ( $image, rand () % 70, rand () % 15, $colorList [$colorRandom] );
			}
			// 添加干扰线
			for($k = 0; $k < 3; $k ++) {
				$colorRandom = mt_rand ( 0, sizeof ( $colorList ) - 1 );
				// $todrawline = rand(0,1);
				$todrawline = 1;
				if ($todrawline) {
					imageline ( $image, mt_rand ( 0, $board_width ), mt_rand ( 0, $board_height ), mt_rand ( 0, $board_width ), mt_rand ( 0, $board_height ), $colorList [$colorRandom] );
				} else {
					$w = mt_rand ( 0, $board_width );
					$h = mt_rand ( 0, $board_width );
					imagearc ( $image, $board_width - floor ( $w / 2 ), floor ( $h / 2 ), $w, $h, rand ( 90, 180 ), rand ( 180, 270 ), $colorList [$colorRandom] );
				}
			}
			imagegif ( $image );
			imagedestroy ( $image );
			$imagedata [] = ob_get_contents ();
			ob_clean ();
			++ $i;
		}
		return $imagedata;
	}
}
if (! function_exists ( 'isPost' )) {
	function isPost() {
		$server = $_SERVER;
		$method = $server ['REQUEST_METHOD'];
		if (strtoupper ( $method ) === 'POST') {
			return true;
		} else {
			return false;
		}
	}
}