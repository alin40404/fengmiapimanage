<?php
/**
 * 默认是否开启修剪功能、加水印功能
 */
$config['image_lib']['open']=array(
		'resize'=>TRUE,
		'watermark'=>FALSE, //FALSE
		);

/**
 * 图片修剪配置
 */
$config['image_lib']['resize']=array(
		'image_library'=> 'gd2',
		'source_image'=>'',
		'create_thumb'=>FALSE,
		'maintain_ratio'=>FALSE,
		);
$config['image_lib']['size']=array(
		'product'=>array('width'=>600,'height'=>400),
		'advertise'=>array('width'=>600,'height'=>400),
		'news'=>array('width'=>600,'height'=>400),
);


/**
 * 图片加水印配置
 */
$config['image_lib']['watermark']=array(
		'source_image'=>'',
		'wm_text'=> 'Powered By Paxonpilot © '.date('Y',time()),
		'wm_type'=>'text',
		'wm_font_path'=> './system/fonts/texb.ttf',
		'wm_font_size'=>'10',
		'wm_font_color'=>'336699',//字体颜色，以十六进制给出。注意, 你必须给出完整的6位数的十六进制值(例如993300), 而不是3位数的简化值(例如fff)。
		'wm_vrt_alignment'=>'bottom',
		'wm_hor_alignment'=>'center',
		'wm_padding'=>'0',
);	