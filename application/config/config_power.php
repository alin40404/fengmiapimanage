<?php
/* 配置模块权限 */

$temp_power= array (
		array(
// 				'admin'=> array(
// 						'index'=>'admin_00',
// 						'lists'=>'admin_01',
// 						)
				),
		array (
				'adminGroup' => array ( /* 设置模块权限  */
						'index' => 'adminGroup_00', /* 模块首页权限 */
						'lists' => 'adminGroup_01', /* 模块列表权限 */
						'add' => 'adminGroup_02', /*  模块添加权限 */
						'delete' => 'adminGroup_03', /* 模块删除 */
						'update' => 'adminGroup_04',  /* 模块修改权限 */
				),
				'adminRole' => array ( /* 设置模块权限  */
						'index' => 'adminRole_00', /* 模块首页权限 */
						'lists' => 'adminRole_01', /* 模块列表权限 */
						'add' => 'adminRole_02', /*  模块添加权限 */
						'delete' => 'adminRole_03', /* 模块删除 */
						'update' => 'adminRole_04',  /* 模块修改权限 */
				),
				'adminUser' => array ( /* 设置模块权限  */
						'index' => 'adminUser_00', /* 模块首页权限 */
						'lists' => 'adminUser_01', /* 模块列表权限 */
						'add' => 'adminUser_02', /*  模块添加权限 */
						'delete' => 'adminUser_03', /* 模块删除 */
						'update' => 'adminUser_04',  /* 模块修改权限 */
				)
		),
		array (
				'category' => array ( /* 设置模块权限  */
						'index' => 'category_00', /* 模块首页权限 */
						'lists' => 'category_01', /* 模块列表权限 */
						'add' => 'category_02', /*  模块添加权限 */
						'delete' => 'category_03', /* 模块删除 */
						'update' => 'category_04',  /* 模块修改权限 */
				),
				'artonce' => array ( /* 设置模块权限  */
						'index' => 'artonce_00', /* 模块首页权限 */
						'lists' => 'artonce_01', /* 模块列表权限 */
						'add' => 'artonce_02', /*  模块添加权限 */
						'delete' => 'artonce_03', /* 模块删除 */
						'update' => 'artonce_04',  /* 模块修改权限 */
				),

				'product' => array ( /* 设置模块权限  */
						'index' => 'product_00', /* 模块首页权限 */
						'lists' => 'product_01', /* 模块列表权限 */
						'add' => 'product_02', /*  模块添加权限 */
						'delete' => 'product_03', /* 模块删除 */
						'update' => 'product_04',  /* 模块修改权限 */
				)

		),
		array (
				'logs' => array ( /* 设置模块权限  */
						'index' => 'logs_00', /* 模块首页权限 */
						'lists' => 'logs_01', /* 模块列表权限 */
						'add' => 'logs_02', /*  模块添加权限 */
						'delete' => 'logs_03', /* 模块删除 */
						'update' => 'logs_04',  /* 模块修改权限 */
				),
				'feedback' => array ( /* 设置模块权限  */
						'index' => 'feedback_00', /* 模块首页权限 */
						'lists' => 'feedback_01', /* 模块列表权限 */
						'add' => 'feedback_02', /*  模块添加权限 */
						'delete' => 'feedback_03', /* 模块删除 */
						'update' => 'feedback_04',  /* 模块修改权限 */
				),
				'friendlink' => array ( /* 设置模块权限  */
						'index' => 'friendlink_00', /* 模块首页权限 */
						'lists' => 'friendlink_01', /* 模块列表权限 */
						'add' => 'friendlink_02', /*  模块添加权限 */
						'delete' => 'friendlink_03', /* 模块删除 */
						'update' => 'friendlink_04',  /* 模块修改权限 */
				),
		),
		array (
			'admin'=> array(
				'index'=>'admin_00',
				'lists'=>'admin_01',
				
				'cache'=>'admin_05',
				'setting'=>'admin_06',
		 		),
		),
		array (

		),
		array (
		
		),
		array (
		
		),
);

$config ["power"]=array();
foreach($temp_power as $key => $value){
	$t_key="menu".$key;
	$config ["power"][$t_key]=$value;
}

