<?php
/**
 * 后台导航列表
 * 
 */

$cache_title='清除缓存';

$lang_menu=array(
		array('title'=>'首页'),
		array('title'=>'管理员管理'),
		array('title'=>'GPS管理'),
		array('title'=>'GPS设置'),
		array('title'=>'警员管理'),
		array('title'=>'短信管理'),		
		array('title'=>'系统管理'),
		array('title'=>'日志管理'),
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

$arr_temp=array(
		'admin'=>'后台首页',
		'logs'=>'系统日志',
		'database'=>'数据库',
		'adminGroup'=>'管理员组',
		'adminRole'=>'管理员角色',
		'adminUser'=>'管理员',
		'category'=>'类别',
		'policeCate'=>'警员组',
		'policeRole'=>'警员角色',
		'police'=>'警员',
		'policePhone'=>'警员手机号',
		'terminalPhone'=>'终端手机号',
		'GPS'=>'GPS数据地图处理',
		'GPSEquipmentCate'=>'GPS设备组',
		'GPSEquipment'=>'GPS设备',
		'GPSLogs'=>'GPS绑定记录',
		'msg'=>'短信',
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


$lang ['common_admin']=array_merge(@$lang ['common_admin'], array (
		'title' => '后台首页' ,
		'lists' => '进入后台首页' ,
		'cache' => $cache_title,
		'setting'=>'系统设置',
));

$lang ['common_GPS']=array_merge(@$lang ['common_GPS'], array (
		'title' => 'GPS数据地图处理' ,
		'lists' => 'GPS数据地图处理' ,
		'status' => 'GPS状态',
		'confImg'=>'GPS回放图标配置',
));

$lang ['common_msg']=array_merge(@$lang ['common_msg'], array (
// 		'title' => '短信管理' ,
// 		'lists' => '短信管理' ,
		'send' => '短信发送管理',
		'receive'=>'短信收取管理',
		'info'=>'短信基本信息管理',
));

$lang ['common_terminalPhone']=array_merge(@$lang ['common_terminalPhone'], array (
		'bindPhone' => '手机号绑定',
));
$lang ['common_police']=array_merge(@$lang ['common_police'], array (
		'bindGPS' => '绑定GPS终端',
));
