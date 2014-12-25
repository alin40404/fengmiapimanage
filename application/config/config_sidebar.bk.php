<?php
/** 
 * name 字段 移到语言文件下面配置了，此处禁止使用！！
 */

$arr_temp = array (
		array (//首页
				'href' => '/admin/index',
				'module'=>'admin',
				'action'=>'index',
				'leftIcon'=>'icon-home',
				'ul' => array (),
		),
		array (//后台管理员管理
				'href' => '',
				'leftIcon'=>'icon-user',
				'ul' => array (
						 array (
								'href' => '/adminGroup/index' ,
								'module'=>'adminGroup',
						 		'action'=>'index',
								'isCategory'=>FALSE,
						),
						 array (
								'href' => '/adminRole/index' ,
						 		'module'=>'adminRole',
						 		'action'=>'index',
								'isCategory'=>FALSE,
						),
						array (
								'href' => '/adminUser/index' ,
								'module'=>'adminUser',
								'action'=>'index',
								'isCategory'=>FALSE,
						),
				)
		),
		array (//GPS管理
				'href' => '',
				'leftIcon'=>'icon-map-marker',
				'ul' => array (
						array (
								'href' => '/GPSEquipmentCate/index' ,
								'module'=>'GPSEquipmentCate',
								'action'=>'index',
								'isCategory'=>FALSE,
						),
						array (
								'href' => '/GPSEquipment/index' ,
								'module'=>'GPSEquipment',
								'action'=>'index',
								'isCategory'=>FALSE,
						),
						array (
								'href' => '/terminalPhone/index' ,
								'module'=>'terminalPhone',
								'action'=>'index',
								'isCategory'=>FALSE,
						),
				)
		),
		array (//GPS设置
				'href' => '',
				'leftIcon'=>'icon-asterisk',
				'ul' => array (
						array (
								'href' => '/GPS/index' ,
								'module'=>'GPS',
								'action'=>'index',
								'isCategory'=>FALSE,
						),
						array (
								'href' => '/GPS/status' ,
								'module'=>'GPS',
								'action'=>'status',
								'isCategory'=>FALSE,
						),
						array (
								'href' => '/GPS/confImg' ,
								'module'=>'GPS',
								'action'=>'confImg',
								'isCategory'=>FALSE,
						),
		
				)
		),
		array (//警员管理
				'href' => '',
				'leftIcon'=>'icon-briefcase',
				'ul' => array (
						 array (
								'href' => '/policeCate/index' ,
								'module'=>'policeCate',
						 		'action'=>'index',
								'isCategory'=>FALSE,
						),
						array (
								'href' => '/policeRole/index' ,
								'module'=>'policeRole',
								'action'=>'index',
								'isCategory'=>FALSE,
						),
						 array (
								'href' => '/police/index' ,
								'module'=>'police',
								'action'=>'index',
								'isCategory'=>FALSE,
						),

				)
		),

		array (// 短信管理
				'href' => '#',
				'leftIcon'=>'icon-tags',
				'ul' => array (
						array (
								'href' => '/msg/info' ,
								'module'=>'msg',
								'action'=>'info',
								'isCategory'=>FALSE,
						),
						array (
								'href' => '/msg/send',
								'module'=>'msg',
								'action'=>'send',
								'isCategory'=>FALSE,
						),
						array (
								'href' => '/msg/receive',
								'module'=>'msg',
								'action'=>'receive',
								'isCategory'=>FALSE,
						),
						
				),
		),

		 array (// 系统管理 
				'href' => '#',
				'leftIcon'=>'icon-tasks',
				'ul' => array (
						 array (
								'href' => '/admin/setting',
								'module'=>'admin',
								'action'=>'setting',
								'isCategory'=>FALSE,
						),
						 array (
								'href' => '/database/index',
								'module'=>'database',
								'action'=>'index',
								'isCategory'=>FALSE,
						),
						
				),
		),
		array (//日志管理
				'href' => '',
				'leftIcon'=>'icon-pencil',
				'isVisible'=>TRUE,
				'ul' => array (
						array (
								'href' => '/logs/index',
								'module'=>'logs',
								'action'=>'index',
								'isCategory'=>FALSE,
						),
						array (
								'href' => '/GPSLogs/index' ,
								'module'=>'GPSLogs',
								'action'=>'index',
								'isCategory'=>FALSE,
						),
				),
		),
		 array (
				'href' => '/admin/cache' ,
				//'module'=>'admin',
				'action'=>'cache',
				'leftIcon'=>'icon-filter',
				'ul' => array (),
				'isVisible'=>TRUE,
		), 
		 array (
				'href' => '',
				'leftIcon'=>'icon-wrench',
				'isVisible'=>TRUE,
				'ul' => array (
						 array (
								'href' => '/adminUser/info' ,
								'module'=>'adminUser',
								'action'=>'info',
								'isCategory'=>FALSE,
						),
						 array (
								'href' => '/adminUser/updatePwd' ,
								'module'=>'adminUser',
								'action'=>'updatePwd',
								'isCategory'=>TRUE,
						),
				),
		),
		array (
				'href' => '/help/index',
				'leftIcon'=>'icon-question-sign',
				'ul' => array (),
				'isVisible'=>TRUE,
		),
		 array (
				'href' => '/faq/index',
				'leftIcon'=>'icon-comment',
				'ul' => array (),
				'isVisible'=>TRUE,
		), 
);

$config ['sideNavBar']=array();
if(is_array($arr_temp)){
	if(!empty($arr_temp)){
		foreach($arr_temp as $key=>$value){
			$temp='menu'.$key;
			$config ['sideNavBar'][$temp]=$value;
		}
	}
}
