<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (! function_exists ( 'get_category_module_html' )) {
	function get_category_module_html($selectModule='',$isDisabled=FALSE){
		$str='';
		$config=@config_item('sideNavBar');
		if(!is_array($config)){
			$str='';
		}else{
			if(!is_string($selectModule)){$selectModule='';}
			if(!is_bool($isDisabled)){$isDisabled=FALSE;}
			if($isDisabled){
				$disabled=' disabled="disabled" ';
			}else{
				$disabled='';
			}
			foreach ($config as $key=>$value){
				$ul=$value['ul'];
				if(is_array($ul)&&isNullOrEmpty($ul)==FALSE){
					$i=1;
					$temp='';
					foreach($ul as $key1=>$a){
						$isCategory=@$a['isCategory'];
						if(!isNullOrEmpty($isCategory)&&$isCategory==TRUE){
							
							$a_module=@$a['module'];
							$key1 = $a_module;
							$a_name=lang('common_'.$key1);$a_name=@$a_name['title'];
							
							$check='';
							$a_dsiabled='';
							if(is_numeric(strpos($selectModule, $a_module))){
								$check=' checked="checked" ';
								$a_dsiabled='';
							}else{
								$check='';
								$a_dsiabled=$disabled;
							}
							$li_a='<label class="forPlugin"><input value="'.$a_module.'" need="1" type="checkbox" name="forPlugin[]" '.$check.$a_dsiabled.' />'.$a_name.'</label>';
							$temp.=$li_a;
							if($i%4==0){
								$str.='<div>'.$temp.'</div>';
								$temp='';
							}
							$i++;
						}
					}
					$i--;
					if($i%4!=0){
						$str.='<div>'.$temp.'</div>';
					}
				}
			}
		}
		
		return $str;
	}
}


if (! function_exists ( 'get_category_html' )) {
	function get_category_html($cateId='',$lang='',$where=array('fatherId'=>0),$like=array()){
		if(!is_numeric($cateId)){$cateId='';}
		if(isNullOrEmpty($lang)){
			$lang=config_item('language');
		}
		if(!is_array($where)){
			$fatherId=$where;
			if(!is_numeric($fatherId)||$fatherId<0){
				$fatherId=0;
			}
			$where=array();
			$where['fatherId']=$fatherId;
		}else{
// 			$where=$fatherId;
			if(isNullOrEmpty(@$where['fatherId'])){
				$where['fatherId']=0;
			}
		}
		
		$where['lang']=$lang;
		
		if(!isNullOrEmpty($like)){
			if(!is_array($like)){
				$temp=$like;
				$like=array();
				$like['forPlugin']=$temp;
			}
		}else{
			$like=array();		
		}
		
		
		$CI =& get_instance();
		$CI->load->model('Common_Model');
		$CI->Common_Model->table='category';
		$max=config_item('max_num');
		$order=' orderNum asc,Id asc ';
		
		$query = $CI->Common_Model->get_last_Num ($max,$where,$like,$order);
// 		$str='<option value="">请选择</option>';
		$str='';
		if(!isNullOrEmpty($query)){
			$temp='';
			foreach ($query as $key=>$value){
				$Id=$value->Id;
				$cateName=$value->cateName;
				$level=$value->level;
				
				if($Id==$cateId){
					$temp='<option value="'.$Id.'" selected="selected">'.getLine($level).$cateName.'</option>';
				}else{
					$temp='<option value="'.$Id.'" >'.getLine($level).$cateName.'</option>';
				}
				$temp=$temp.get_category_html($cateId,$lang,$Id);
				$str.=$temp;
			}
		}
		return $str;
	}
}


if (! function_exists ( 'get_common_cate_html' )) {
	function get_common_cate_html($cateId='',$lang='',$where=array('fatherId'=>0),$like=array()){
		if(!is_numeric($cateId)){$cateId='';}
		if(isNullOrEmpty($lang)){
			$lang=config_item('language');
		}
		if(!is_array($where)){
			$fatherId=$where;
			if(!is_numeric($fatherId)||$fatherId<0){
				$fatherId=0;
			}
			$where=array();
			$where['fatherId']=$fatherId;
		}else{
			// 			$where=$fatherId;
			if(isNullOrEmpty(@$where['fatherId'])){
				$where['fatherId']=0;
			}
		}

		//$where['lang']=$lang;

		if(!isNullOrEmpty($like)){
			if(!is_array($like)){
				$temp=$like;
				$like=array();
				$like['forPlugin']=$temp;
			}
		}else{
			$like=array();
		}


		$CI =& get_instance();
		$CI->load->model('Common_Model');
		$CI->Common_Model->table='common_cate';
		$max=config_item('max_num');
		$order=' orderNum asc,Id asc ';

		$query = $CI->Common_Model->get_last_Num ($max,$where,$like,$order);
		// 		$str='<option value="">请选择</option>';
		$str='';
		if(!isNullOrEmpty($query)){
			$temp='';
			foreach ($query as $key=>$value){
				$Id=$value->Id;
				$cateName=$value->cateName;
				$level=$value->level;

				if($Id==$cateId){
					$temp='<option value="'.$Id.'" selected="selected">'.getLine($level).$cateName.'</option>';
				}else{
					$temp='<option value="'.$Id.'" >'.getLine($level).$cateName.'</option>';
				}
				$temp=$temp.get_common_cate_html($cateId,$lang,$Id);
				$str.=$temp;
			}
		}
		return $str;
	}
}


if (! function_exists ( 'getLine' )) {
	function getLine($count=1){
		if(!is_numeric($count)||$count<1){
			$count=1;
		}
		$str='';
		$count--;
		for($i=0;$i<$count;$i++){
			$str.='-&nbsp;';
		}
		return $str;
	}
}