<?php
/**
 * 分页
 */
$config['uri_segment'] = 3;
$config['num_links'] = 2;
$config['use_page_numbers'] = TRUE;
$config['page_query_string'] = TRUE;
$config['query_string_segment'] ='page';

$config['full_tag_open'] = '';
$config['full_tag_close'] = '';

$config['first_link'] = 'First';
$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';

$config['last_link'] = 'Last';
$config['last_tag_open'] = '<li>';
$config['last_tag_close'] = '</li>';

$config['next_link'] = 'Next';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = 'Prev';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="on">';
$config['cur_tag_open'] = '</li>';

$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';

$config['anchor_class'] = "";//添加 CSS 类