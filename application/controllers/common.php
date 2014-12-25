<?php if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );

class Common extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->load->helper('category_helper');
	}
	
	public function proValidCode() {
		error_reporting ( 0 );
		$chars = 'abcdefghjkmnprstuvwxyABCDEFGHJKLMNPRSTUVWXYZ2345689';
		$chars_len = strlen ( $chars ) - 1;
		$this->load->library('encrypt');
		$randCode = $chars [mt_rand ( 0, $chars_len )] . $chars [mt_rand ( 0, $chars_len )] . $chars [mt_rand ( 0, $chars_len )] . $chars [mt_rand ( 0, $chars_len )];
		session('validCode',$this->encrypt->encode ( strtolower ( $randCode ) )); // 记录session
		$imagedata = get_imageData ( $randCode, 60 );
		
		$this->load->library ( 'gif_encoder', $imagedata );
		header ( 'Content-type:image/gif' );
		echo $this->gif_encoder->GetAnimation ();
	}
	public function uploadJson() {
		if(!isPost()){
			$msg='输入的链接不正确！';
			showErrorMsg($msg);
		}
		
		$this->load->config('config_uploadfile');
		
		$upload_file_url=@config_item('upload_file_url');
		if(isNullOrEmpty($upload_file_url)){$upload_file_url='/upload/';}
		$upload_file_url=trim($upload_file_url,'/');
		
// 		$action=@$_POST['action'];
// 		$Id=@$_POST['Id'];if(isNullOrEmpty($Id)){$Id='';}
// 		$title=@$_POST['title'];if(isNullOrEmpty($title)){$title='';}
		
		$type=@($_GET['type']);
		$module=@($_GET['module']);if(isNullOrEmpty($module)){$module='';}
		
		switch ($type){
			case 'imagesingle' ://上传图片或图片集
			case 'imagelist' :
				$upload_file_url=$upload_file_url.'/temp/';
				break;
			case 'kindeditor' :
			default://上传编辑器的图片
				$type='kindeditor';
				$upload_file_url=$upload_file_url.'/'.$type.'/';
				break;
		}
		
// 		if($action==='delete'){
// // 			if($type=='imagesingle'){
				
// // 			}else if($type=='imagelist'){
				
// // 			}
// 			unset_session($type,$Id);
// 			header('Content-type: text/html; charset=UTF-8');
// 			$this->load->library ( 'Services_JSON' );
// 			echo $this->services_json->encode(array('error' => 0, 'msg' => '图片删除成功！'));
// 			exit;
			
// 		}else if($action==='update'){
// 			$arr_tmp=session($type);
// 			$update_url=@$arr_tmp[$Id]['url'];
// 			$arr_update=array('url'=>$update_url,'title'=>$title);
// 			session($type,$arr_update,$Id);
// 			header('Content-type: text/html; charset=UTF-8');
// 			$this->load->library ( 'Services_JSON' );
// 			echo $this->services_json->encode(array('error' => 0, 'msg' => '图片标题修改成功！'));
// 			exit;
// 		}
		
		$php_path = dirname(@$_SERVER['SCRIPT_FILENAME']) . '/';
		$base_url=base_url();
		//根目录路径，可以指定绝对路径，比如 /var/www/attached/
		$root_path = $php_path . $upload_file_url;//'assets/kindeditor/attached/'
		//根目录URL，可以指定绝对路径，比如 http://www.yoursite.com/attached/
		$root_url = $base_url . $upload_file_url;
		
		//文件保存目录路径
		$save_path = $root_path;createFolder($save_path);
		//文件保存目录URL
		$save_url = $root_url;
		
		
		
		//定义允许上传的文件扩展名
		$ext_arr = @config_item('upload_file_ext');
		//最大文件大小
		$max_size =@config_item('upload_file_max_size');
		
		$save_path = realpath($save_path) . '/';
		
		//PHP上传失败
		if (!empty($_FILES['imgFile']['error'])) {
			switch($_FILES['imgFile']['error']){
				case '1':
					$error = '超过php.ini允许的大小。';
					break;
				case '2':
					$error = '超过表单允许的大小。';
					break;
				case '3':
					$error = '图片只有部分被上传。';
					break;
				case '4':
					$error = '请选择图片。';
					break;
				case '6':
					$error = '找不到临时目录。';
					break;
				case '7':
					$error = '写文件到硬盘出错。';
					break;
				case '8':
					$error = 'File upload stopped by extension。';
					break;
				case '999':
				default:
					$error = '未知错误。';
			}
			$this->alert($error);
		}
		
		//有上传文件时
		if (empty($_FILES) === false) {
			//原文件名
			$file_name = $_FILES['imgFile']['name'];
			//服务器上临时文件名
			$tmp_name = $_FILES['imgFile']['tmp_name'];
			//文件大小
			$file_size = $_FILES['imgFile']['size'];
			//检查文件名
			if (!$file_name) {
				$this->alert("请选择文件。");
			}
			//检查目录
			if (@is_dir($save_path) === false) {
				$this->alert("上传目录不存在。");
			}
			//检查目录写权限
			if (@is_writable($save_path) === false) {
				$this->alert("上传目录没有写权限。");
			}
			//检查是否已上传
			if (@is_uploaded_file($tmp_name) === false) {
				$this->alert("上传失败。");
			}
			//检查文件大小
			if ($file_size > $max_size) {
				$this->alert("上传文件大小超过限制。");
			}
			//检查目录名
			$dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
			if (empty($ext_arr[$dir_name])) {
				$this->alert("目录名不正确。");
			}
			//获得文件扩展名
			$temp_arr = explode(".", $file_name);
			$file_ext = array_pop($temp_arr);
			$file_ext = trim($file_ext);
			$file_ext = strtolower($file_ext);
			//检查扩展名
			if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
				$this->alert("上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr[$dir_name]) . "格式。");
			}
			//创建文件夹
			if ($dir_name !== '') {
				$save_path .= $dir_name . "/";
				$save_url .= $dir_name . "/";
				if (!file_exists($save_path)) {
					createFolder($save_path);
				}
			}
			$ymd = date("Ymd");
			$save_path .= $ymd . "/";
			$save_url .= $ymd . "/";
			if (!file_exists($save_path)) {
				createFolder($save_path);
			}
			
			$file_Id=$module.'_'.date("YmdHis") . '_' . rand(10000, 99999);
			//新文件名
			$new_file_name =  $file_Id. '.' . $file_ext;
			//移动文件
			$file_path = $save_path . $new_file_name;
			if (move_uploaded_file($tmp_name, $file_path) === false) {
				$this->alert("上传文件失败。");
			}
			
			//文件上传成功！
			$arr_post=$this->input->post();
			$isResizeOpen=@$arr_post['isResizeOpen'];
			$isWatermarkOpen=@$arr_post['isWatermarkOpen'];
			
// 			var_dump($arr_post);exit;
			
			if(!isNullOrEmpty($isResizeOpen)||!isNullOrEmpty($isWatermarkOpen)){
				$this->load->config('config_image_lib');
				$image_lib=@config_item('image_lib');
			}
// 			$image_lib_open=@$image_lib['open'];
// 			$isResizeOpen=@$image_lib_open['resize'];$isWatermarkOpen=@$image_lib_open['watermark'];
			if($isResizeOpen){
				$width=@$arr_post['width'];if(!is_numeric($width)||$width<=0){$width='';}
				$height=@$arr_post['height'];if(!is_numeric($height)||$height<=0){$height='';}
				
				$config_resize=@$image_lib['resize'];
// 				$size=@$image_lib['size'][$module];
				$size=array('width'=>$width,'height'=>$height);
				$config_resize=array_merge($size,$config_resize);
				$config_resize['source_image']=$file_path;
				$this->load->library('image_lib', $config_resize);
				
				$result=$this->image_lib->resize();
				if ( ! $result)
				{
					$this->alert("修剪失败。");
// 					echo $this->image_lib->display_errors();
				}
			}
			if($isWatermarkOpen){
				$wm_text=@$arr_post['wm_text'];
				$wm_font_color=@$arr_post['wm_font_color'];$wm_font_color=trim($wm_font_color,'#');
				
				$config_watermark=@$image_lib['watermark'];
// 				$size=@$image_lib['size'][$module];
// 				$config_watermark=array_merge($size,$config_watermark);
				$config_watermark['source_image']=$file_path;
				$config_watermark['wm_text']=$wm_text;
				$config_watermark['wm_font_color']=$wm_font_color;
				
				$this->load->library('image_lib');
				//var_dump($config_watermark);exit;
				$this->image_lib->initialize($config_watermark);
				$result=$this->image_lib->watermark();
				if ( ! $result)
				{
					$this->alert("添加水印失败。");
					// 					echo $this->image_lib->display_errors();
				}
			}
			
			@chmod($file_path, 0644);
			$file_url = $save_url . $new_file_name;
			
// 			switch ($type){
// 				case 'imagesingle' ://上传图片或图片集
// 				case 'imagelist' :
// 					$arr_tmp=array();
// 					$arr_tmp['url']=$file_url;
// 					$arr_tmp['title']=$title;
// 					session($type,$arr_tmp,$file_Id);
// 					break;
// 				case 'kindeditor' :
// 				default://上传编辑器的图片
// 					break;
// 			}
		
			header('Content-type: text/html; charset=UTF-8');
			$this->load->library ( 'Services_JSON' );
// 			$json = new Services_JSON();
			echo $this->services_json->encode(array('error' => 0, 'url' => $file_url));
			exit;
		}
	} 
	private function alert($msg) {
		header('Content-type: text/html; charset=UTF-8');
		$this->load->library ( 'Services_JSON' );
// 		$json = new Services_JSON();
		echo $this->services_json->encode(array('error' => 1, 'message' => $msg));
		exit;
	}
	
	public function fileManagerJson(){
// 		if(!isPost()){
// 			$msg='输入的链接不正确！';
// 			showErrorMsg($msg);
// 		}
		
		$this->load->config('config_uploadfile');
		
		$upload_file_url=@config_item('upload_file_url');
		if(isNullOrEmpty($upload_file_url)){$upload_file_url='/upload/';}
		$upload_file_url=trim($upload_file_url,'/').'/';

		$type=@($_GET['type']);
		$module=@($_GET['module']);if(isNullOrEmpty($module)){$module='';}
		
		switch ($type){
			case 'imagesingle' ://上传图片或图片集
			case 'imagelist' :
				$upload_file_url=$upload_file_url.'/temp/';
				break;
			case 'kindeditor' :
			default://上传编辑器的图片
				$type='kindeditor';
				$upload_file_url=$upload_file_url.'/'.$type.'/';
				break;
		}
		
		
		$php_path = dirname(@$_SERVER['SCRIPT_FILENAME']) . '/';
// 		$php_url = dirname($_SERVER['PHP_SELF']) . '/';
// 		$site_url=site_url();
		$base_url=base_url();
		//根目录路径，可以指定绝对路径，比如 /var/www/attached/
		$root_path = $php_path . $upload_file_url;
		//根目录URL，可以指定绝对路径，比如 http://www.yoursite.com/attached/
		$root_url = $base_url . $upload_file_url;
		
		//图片扩展名
		$ext_arr =$ext_arr = @config_item('upload_file_ext');// array('gif', 'jpg', 'jpeg', 'png', 'bmp');
		$ext_arr=$ext_arr['image'];
		
		//目录名
		$dir_name = empty($_GET['dir']) ? '' : trim($_GET['dir']);
		if (!in_array($dir_name, array('', 'image', 'flash', 'media', 'file'))) {
			echo "Invalid Directory name.";
			exit;
		}
		if ($dir_name !== '') {
			$root_path .= $dir_name . "/";
			$root_url .= $dir_name . "/";
			if (!file_exists($root_path)) {
				createFolder($root_path);
			}
		}
		
		//根据path参数，设置各路径和URL
		if (empty($_GET['path'])) {
			$current_path = realpath($root_path) . '/';
			$current_url = $root_url;
			$current_dir_path = '';
			$moveup_dir_path = '';
		} else {
			$current_path = realpath($root_path) . '/' . $_GET['path'];
			$current_url = $root_url . $_GET['path'];
			$current_dir_path = $_GET['path'];
			$moveup_dir_path = preg_replace('/(.*?)[^\/]+\/$/', '$1', $current_dir_path);
		}
		
// 		echo realpath($root_path);
		
		//排序形式，name or size or type
		$order = empty($_GET['order']) ? 'name' : strtolower($_GET['order']);
		
		//不允许使用..移动到上一级目录
		if (preg_match('/\.\./', $current_path)) {
			echo 'Access is not allowed.';
			exit;
		}
		//最后一个字符不是/
		if (!preg_match('/\/$/', $current_path)) {
			echo 'Parameter is not valid.';
			exit;
		}
		//目录不存在或不是目录
		if (!file_exists($current_path) || !is_dir($current_path)) {
			echo 'Directory does not exist.';
			exit;
		}
		
		//遍历目录取得文件信息
		$file_list = array();
		$handle = opendir($current_path);
		if (!is_bool($handle)) {
			$i = 0;
			while (false !== ($filename = readdir($handle))) {
				if ($filename{0} == '.') continue;
				$file = $current_path . $filename;
				if (is_dir($file)) {
					$file_list[$i]['is_dir'] = true; //是否文件夹
					$file_list[$i]['has_file'] = (count(scandir($file)) > 2); //文件夹是否包含文件
					$file_list[$i]['filesize'] = 0; //文件大小
					$file_list[$i]['is_photo'] = false; //是否图片
					$file_list[$i]['filetype'] = ''; //文件类别，用扩展名判断
				} else {
					$file_list[$i]['is_dir'] = false;
					$file_list[$i]['has_file'] = false;
					$file_list[$i]['filesize'] = filesize($file);
					$file_list[$i]['dir_path'] = '';
					$file_ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
					$file_list[$i]['is_photo'] = in_array($file_ext, $ext_arr);
					$file_list[$i]['filetype'] = $file_ext;
				}
				$file_list[$i]['filename'] = $filename; //文件名，包含扩展名
				$file_list[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file)); //文件最后修改时间
				$i++;
			}
			closedir($handle);
		}
		
		//排序
		function cmp_func($a, $b) {
			global $order;
			if ($a['is_dir'] && !$b['is_dir']) {
				return -1;
			} else if (!$a['is_dir'] && $b['is_dir']) {
				return 1;
			} else {
				if ($order == 'size') {
					if ($a['filesize'] > $b['filesize']) {
						return 1;
					} else if ($a['filesize'] < $b['filesize']) {
						return -1;
					} else {
						return 0;
					}
				} else if ($order == 'type') {
					return strcmp($a['filetype'], $b['filetype']);
				} else {
					return strcmp($a['filename'], $b['filename']);
				}
			}
		}
		usort($file_list, 'cmp_func');
		
		$result = array();
		//相对于根目录的上一级目录
		$result['moveup_dir_path'] = $moveup_dir_path;
		//相对于根目录的当前目录
		$result['current_dir_path'] = $current_dir_path;
		//当前目录的URL
		$result['current_url'] = $current_url;
		//文件数
		$result['total_count'] = count($file_list);
		//文件列表数组
		$result['file_list'] = $file_list;
		
		//输出JSON字符串
		header('Content-type: application/json; charset=UTF-8');
		$this->load->library ( 'Services_JSON' );
// 		$json = new Services_JSON();
		echo $this->services_json->encode($result);
	}
	
	public function sidebarStatus(){
		if(!isPost()){
			$msg='输入的链接不正确！';
			showErrorMsg($msg);
		}
		$arr_post=$this->input->post();
		$status=$arr_post['status'];
		//var_dump($status);
		session('sidebarStatus',$status);
		
		$jsonData=array("status"=>$status);
		
		header("Content-type: application/json");
		echo json_encode($jsonData);
	}

}