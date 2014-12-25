<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (! function_exists ( 'echo_server_info' )) {
	function echo_server_info(){
		echo '---------------------------------- 服务器信息 ------------------------------------','<br /><br />';
		foreach($_SERVER as $key => $value){
			echo $key.' => '.$value.'<br />';
			echo '<br />';
		}
		echo '---------------------------------- 分割线 ------------------------------------','<br /><br />';
		
	}
}
