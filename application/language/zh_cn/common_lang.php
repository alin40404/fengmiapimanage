<?php
/**
 * 后台导航列表
 * 
 */

$cache_title='清除缓存';

$lang_menu=array(
		array('title'=>'首页'),
		array('title'=>'管理员管理'),
		array('title'=>'内容管理'),
		array('title'=>'其他管理'),
		array('title'=>$cache_title),
		array('title'=>'个人中心'),
		array('title'=>'帮助'),
		array('title'=>'常见问题'),
	  );

if(is_array($lang_menu)){
	if(!empty($lang_menu)){
		foreach($lang_menu as $key => $value){
			$temp='common_menu'.$key;
			$lang[$temp]=$value;
		}
	}
}
// var_dump($lang);
$arr_temp=array(
		'admin'=>'后台首页',
		'logs'=>'系统日志',
		'database'=>'数据库',
		'adminGroup'=>'管理员组',
		'adminRole'=>'管理员角色',
		'adminUser'=>'管理员',
		'category'=>'类别',
		'artonce'=>'单页面',
		'product'=>'产品',
		'feedback'=>'留言反馈',
		'friendlink'=>'链接',
		'news'=>'新闻',
		'advertise'=>'广告',
);

if(is_array($arr_temp)){
	if(!empty($arr_temp)){
		foreach($arr_temp as $key => $value){
			$common_key='common_'.$key;
			$temp=$value;
			$arr_t = array (
					'title' =>'管理'.$temp ,
					'lists' => '查看' . $temp,
					'add' => '添加' . $temp,
					'delete' => '删除 ' . $temp,
					'update' => '修改' . $temp 
			);
			$lang[$common_key]=$arr_t;
		}
	}
}

$lang ['common_adminUser']['info'] = '个人信息';
$lang ['common_adminUser']['updatePwd'] = '修改密码';

$lang ['common_database']['backup'] = '备份数据库';
$lang ['common_database']['recover'] = '恢复数据库';


