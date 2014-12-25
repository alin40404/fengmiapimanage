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
		array (//内容管理
				'href' => '',
				'leftIcon'=>'icon-map-marker',
				'isVisible'=>TRUE,
				'ul' => array (
						array (
								'href' => '/category/index' ,
								'module'=>'category',
								'action'=>'index',
								'isCategory'=>FALSE,
						),
						array (
								'href' => '/artonce/index' ,
								'module'=>'artonce',
								'action'=>'index',
								'isCategory'=>TRUE,
						),
						array (
								'href' => '/product/index' ,
								'module'=>'product',
								'action'=>'index',
								'isCategory'=>TRUE,
						),
				),
		),

		array (//其他管理
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
								'href' => '/feedback/index' ,
								'module'=>'feedback',
								'action'=>'index',
								'isCategory'=>TRUE,
						),
						array (
								'href' => '/friendlink/index' ,
								'module'=>'friendlink',
								'action'=>'index',
								'isCategory'=>TRUE,
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
								'isCategory'=>FALSE,
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
// echo '<hr />';
// var_dump($config ['sideNavBar']);
// echo '<hr />';