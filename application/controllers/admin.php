<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller{
	public $module='admin';
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		checkLogin();
		
		$module=$this->module;
		$arrLang=lang('common_'.$module);
		
		$moduleMsg=$arrLang['lists'];
		$nav_power=array('module'=>$module,'action'=>'lists');
		$redirect='admin/logout';
		checkPower($nav_power,$moduleMsg,$redirect);
		
		$this->load->helper('admin_helper');
		
		$title=$arrLang['title'];
		$data_header['title']=$title;
		$config_sideNavBar=config_item('sideNavBar');
		
		$data_header['sideNavBar']=get_side_navbar($module,$config_sideNavBar);
		$lang=config_item("language");
		$base_url=base_url();
		$data['lang']=$lang;
		$data['base_url']=$base_url;
		$this->load->view('common/header',$data_header);
		$this->load->view('admin/index',$data);
		$this->load->view('common/footer');
	}
	public function login(){
		if (isAdminUserExist ()) {
			redirect ( 'admin/index' );
		}
		
		if(isPost()){
			$arr_post=$this->input->post();
			$userName=$arr_post['userName'];
			$password=$arr_post['password'];
			$validCode=strtolower(setvar($arr_post['validCode']));
			$sess_validCode =session('validCode');
			$this->load->library('encrypt');
			$sess_validCode = $this->encrypt->decode($sess_validCode);
			
			$data['userName']=$userName;
			if($validCode!==$sess_validCode){//验证码错误
				$msg='验证码错误，请重新输入！';
			}else{
				//查询数据库
				$this->load->model('Common_Model');$this->Common_Model->table='admin';
				$where=array('adminName'=>$userName);
				$query=$this->Common_Model->get_last_Num(1,$where);
				
				if(!isNullOrEmpty($query)){
					$obj=$query[0];
					$db_password=$this->encrypt->decode($obj->adminPwd);
					if($password!==$db_password){//密码错误
						$msg='密码错误';
					}else{
						$Id=$obj->Id;
						session('adminUser',$userName);
						session('adminId',$Id);
						
						$loginTimes=$obj->loginTimes;
						$loginTimes=is_numeric($loginTimes)?$loginTimes:1;
						$loginTimes=$loginTimes+1;
						$db_data=array();
						$db_data['loginTimes']=$loginTimes;
						$result=$this->Common_Model->update ($Id, $db_data );
						
						$lastLoginIP=$obj->lastLoginIP;
						$lastLoginTime=$obj->lastLoginTime;$lastLoginTime=date('Y-m-d H:i:s',$lastLoginTime);
						
						session('isFirstLogin',TRUE);
						session('lastLoginIP',$lastLoginIP);
						session('lastLoginTime',$lastLoginTime);
						
						
						if(operatePowerCacheFile('read')){
							$data=array('status'=>'warning','message'=>'警告：上次登录异常登出，请保管好帐号密码以防被盗！');
							session('loginStatus',$data);
						}else{
							$data=array('status'=>'success','message'=>'恭喜！登录正常！');
							session('loginStatus',$data);
						}
						
						$rId=$obj->rId;
						
						$this->Common_Model->table='role';
						$where=array('Id'=>$rId);
						$query=$this->Common_Model->get_last_Num(1,$where);
						
						$obj_role=@$query[0];
						$str_power=@$obj_role->power;
						
						//$str_power= serialize($str_power);
						$str_power = $this->encrypt->encode($str_power);
						$result=operatePowerCacheFile('write',$str_power);
						
						$msg='登录成功！';
						$logType=2;
						writeLog($msg,$logType);
						
						$url='admin/index';
						
						$redirect=$arr_post['redirect'];
						if(!isNullOrEmpty($redirect)){
							$url=$redirect;
						}
						
						redirect($url);
					}
				}else{//用户名不存在
					$msg='用户名不存在';
				}
			}
			$msg='登录失败，'.$msg;
			$logType=2;
			writeLog($msg,$logType);
				
			showDialog($msg,null,3000,"error");
			return;
		}else{
			$arr_get=$this->input->get();
			$redirect=@$arr_get['redirect'];
			if (isNullOrEmpty ( $redirect )) {
				$redirect='';
			}
			
		}
		$data['redirect']=$redirect;
		$data['title']='登录';
		$this->load->view ( 'admin/login',$data);
	}
	public function logout() {
		checkLogin();
		operatePowerCacheFile('delete');
		
		$msg='注销成功！';
		$logType=2;
		writeLog($msg,$logType);
		
// 		$adminId=@session('adminId');
// 		$this->load->model('Common_Model');$this->Common_Model->table='admin';
		
// 		$data=array();
// 		$data['lastLoginTime']=time();
// 		$data['lastLoginIP']=$_SERVER['REMOTE_ADDR'];
// 		$result = $this->Common_Model->update ($adminId, $data );
		
		unset_session("adminUser");
		unset_session('adminId');
		unset ( $_SESSION );
		session_unset (); // 释放所有Session变量
		session_destroy (); // 销毁Session，经此后Session ID就会没有了
		if(!isAdminUserExist()){//登出成功！
			
			$redirect=site_url().'/admin/login';
			showDialog($msg,'',3000,"succeed",$redirect);
			return;
		}
		redirect ( 'admin/login' );
	}
	
	public function cache(){
		checkLogin();
		
		$module=$this->module;$action='cache';
		$arrLang=lang('common_'.$module);
		$title=$arrLang[$action];
		
		$nav_power=array('module'=>$module,'action'=>$action);
		checkPower($nav_power,$title);
		
		//清除缓存
		$result=operatePowerCacheFile('delete');
		$redirect='';
		$logType=3;
		
		if($result){
			$this->load->model('Common_Model');$this->Common_Model->table='admin';
			$Id=session('adminId');
			$where=array('Id'=>$Id);
			$query=$this->Common_Model->get_last_Num(1,$where);
			$obj=$query[0];
			
			$rId=$obj->rId;
			
			$this->Common_Model->table='role';
			$where=array('Id'=>$rId);
			$query=$this->Common_Model->get_last_Num(1,$where);
			
			$obj_role=@$query[0];
			$str_power=@$obj_role->power;
			
			//$str_power= serialize($str_power);
			$this->load->library('encrypt');
			$str_power = $this->encrypt->encode($str_power);
			$result=operatePowerCacheFile('write',$str_power);
			if($result){
				$this->load->config('config_uploadfile');
				
				$upload_file_url=@config_item('upload_file_url');
				if(isNullOrEmpty($upload_file_url)){$upload_file_url='/upload/';}
				$upload_file_url=trim($upload_file_url,'/');
				$upload_file_url=$upload_file_url.'/temp/';
				$php_path = dirname(@$_SERVER['SCRIPT_FILENAME']) . '/';
				$base_url=base_url();
				//根目录路径，可以指定绝对路径，比如 /var/www/attached/
				$root_path = $php_path . $upload_file_url;
				
				deldir($root_path);
				
				$msg=$title.'成功 !';
				$icon="succeed";
			}else{
				$msg=$title.'失败！无法创建缓存文件！';
				$icon="error";
			}
		}else{
			$msg=$title.'失败！无法删除缓存文件！为保证数据正确，请重新登录！';
			$icon="error";
			$redirect=site_url().'/admin/logout';
		}
		
		writeLog($msg,$logType);
		
		showDialog($msg,'',3000,$icon,$redirect);
		return;
	}
}
