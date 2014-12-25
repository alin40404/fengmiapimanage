<?php
// 图片、文件上传的文件夹，相对于脚本文件的位置
$config['upload_file_url']='/upload/';

$config['upload_file_ext']= array(
				'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
				'flash' => array('swf', 'flv'),
				'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
				'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
);
$config['upload_file_max_size']=1000000;