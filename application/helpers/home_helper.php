<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_home_navigator($cateId='',$lang='',$where=array('fatherId'=>0),$like=array(),$level=0){
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
		if(isNullOrEmpty(@$where['fatherId'])){
			$where['fatherId']=0;
		}
	}
	
	$where['lang']=$lang;
	$where['isNav']=1;
	
	if(!isNullOrEmpty($like)){
		if(!is_array($like)){
			$temp=$like;
			$like=array();
			$like['forPlugin']=$temp;
		}
	}else{
		$like=array();
	}
	if(isNullOrEmpty($level)){$level=0;}
	
	$CI =& get_instance();
	$CI->load->model('Common_Model');
	$CI->Common_Model->table='category';
	$max=config_item('max_num');
	$order=' orderNum asc, Id asc ';
	
	$query = $CI->Common_Model->get_last_Num ($max,$where,$like,$order);
	
	$str='';
	if(!isNullOrEmpty($query)){
		$str='';
		$temp='';
		$temp_child='';
		$temp_t='';
		foreach ($query as $key=>$value){
			$Id=@$value->Id;
			
			$cateName=@$value->cateName;
			$linkURL=@$value->linkURL;
			if(!is_numeric(strpos($linkURL, 'http://'))){
				if($linkURL=="#"){
					$linkURL='?cateId='.$Id;
				}
				$linkURL=site_url().'/home'.$linkURL;
			}
			$target=@$value->target;
			$level=@$value->level;
			
			if($Id==$cateId){
				$temp ='<li class="hover"><a href="'.$linkURL.'" target="'.$target.'" title="'.$cateName.'">'.$cateName.'</a>';
			}else{
				$temp ='<li class="link"><a href="'.$linkURL.'" target="'.$target.'" title="'.$cateName.'">'.$cateName.'</a>';
			}
			//$temp_child=get_home_navigator($cateId,$lang,$Id,$like,$level);
			
// 			echo htmlspecialchars($temp_child);
// 			$temp_child='';
			$temp =$temp.$temp_child.'</li>';
			
			$temp_t.=$temp;
			
		}
		$str.=$temp_t.'';
	}
	
	return $str;
}

function get_position($cateId,$isAllHref=FALSE){
	if(isNullOrEmpty($cateId)){
		return '';
	}
// 	if(isNullOrEmpty($lang)){
// 		$lang=config_item('language');
// 	}
	$CI =& get_instance();
	$CI->load->model('Common_Model');
	$CI->Common_Model->table='category';
	
	$where=array();
	$where['Id']=$cateId;
	//$where['lang']=$lang;
	
	$query = $CI->Common_Model->get_last_Num (1,$where);
	$str='';
	if(!isNullOrEmpty($query)){
		$obj=$query[0];
		$fatherId=$obj->fatherId;
		$cateName=toStriForHtmlSpeChar($obj->cateName);
		if($isAllHref==TRUE){
// 			$cateName = @$obj->cateName;
			$linkURL = @$obj->linkURL;
			if (! is_numeric ( strpos ( $linkURL, 'http://' ) )) {
				$linkURL = site_url () . '/home' . $linkURL;
			}
			//$target = @$value->target;
				
			$temp='<a title="'.$cateName.'" href="'.$linkURL.'">'.$cateName.'</a> -&gt; ';
		}else{
			$temp='<h1>'.$cateName.'</h1>';
		}
		
		
		if($fatherId != 0){
			$catePath=$obj->catePath;
			$catePath=explode(',', $catePath);
			$where['Id']=$catePath;
			$max=config_item('max_num');
			$query = $CI->Common_Model->get_last_Num ($max,$where);
			$f_temp='';
			if(!isNullOrEmpty($query)){
				foreach ($query as $key=>$value){
					$cateName = @$value->cateName;
					$linkURL = @$value->linkURL;
					if (! is_numeric ( strpos ( $linkURL, 'http://' ) )) {
						$linkURL = site_url () . '/home' . $linkURL;
					}
					//$target = @$value->target;
					
					$f_temp.='<a title="'.$cateName.'" href="'.$linkURL.'">'.$cateName.'</a> -&gt; ';
					
				}
			}
			$temp =$f_temp.$temp;
		}
		$str.=$temp;
		
	}else{
		$str='';
	}
	
	return $str;
	
}

function get_website_title($cateId){
	if(!is_numeric($cateId)){
		return FALSE;
	}
	$CI =& get_instance();
	$CI->load->model('Common_Model');
	$CI->Common_Model->table='category';

	$where=array();
	$where['Id']=$cateId;

	$query = $CI->Common_Model->get_last_Num (1,$where);
	$str='';
	if(!isNullOrEmpty($query)){
		$obj=$query[0];
		$title=$obj->cateName;
		$str=$title;
	}else{
		$str=FALSE;
	}

	return $str;

}

function get_banner($cateId='',$lang=''){
	$where=array();
	if(isNullOrEmpty($cateId)){
		return '';
	}else{
		$where['cateId']=$cateId;
	}
	if(isNullOrEmpty($lang)){
		$lang=config_item('language');
	}
	
	$where['isShow']=1;
	$where['lang']=$lang;
	
	$temp='';
	foreach($where as $key =>$value){
		if(is_numeric($value)){
			$temp.=" and $key = $value";
		}else{
			$temp.=" and $key = '$value'";
		}
		
	}
	$where=$temp;
	
	$CI =& get_instance();
	$CI->load->model('Common_Model');
	
	$subclass_prefix=strtolower(config_item('subclass_prefix'));
	$table=$subclass_prefix.'advertise';
	$table_relefile=$subclass_prefix.'relefile';
// 	$table_admin=$subclass_prefix.'admin';

	$max=5;
	
	$sql='select distinct a.cateId,a.advName,a.advLink,r.url from '.$table.' as a left join '.$table_relefile.' as r on r.no=a.no where 1=1 '.$where.' group by a.no order by a.orderNum,r.addTime desc ';
	
	$query=$CI->Common_Model->query($sql,$max);
	
// 	$order=' addTime desc ';
	
// 	$like=array();
// 	$query = $CI->Common_Model->get_last_Num ($max,$where,$like,$order);
	$banner='';
	if(!isNullOrEmpty($query)){
		$tempBanner='';
		$tempControl='';
		foreach($query as $key => $obj){
			$advName=$obj->advName;
			$advLink=$obj->advLink;
			$url=$obj->url;
			$bannerId='banner-'.$key;
			if ($key == 0) {
				$tempBanner .= '<div class="banner current" id="'.$bannerId.'"><a href="'.$advLink.'"  target="_self" title="'.$advName.'" ><img alt="'.$advName.'" src="'.$url.'" /></a></div>';
				$tempControl .= '<li class="active"><a href="#" rel="'.$bannerId.'"></a></li>';
			} else {
				$tempBanner .= '<div class="banner" id="'.$bannerId.'"><a href="'.$advLink.'"  target="_self" title="'.$advName.'" ><img alt="'.$advName.'" src="'.$url.'" /></a></div>';
				$tempControl .= '<li><a href="#" rel="'.$bannerId.'"></a></li>';
			}
		}
		$tempBanner='<div id="banners">'.$tempBanner.'</div>';
		$tempControl='<ul id="controls">'.$tempControl.'</ul>';
		$banner='<div class="bigbanner">'.$tempBanner.$tempControl.'</div>';
	}
	return $banner;
}

function get_artonce($cateId,$lang='',$num=100){
	if(isNullOrEmpty($cateId)){return '';}
	$where=array();
	if(isNullOrEmpty($lang)){
		$lang=config_item('language');
	}
	if(!is_numeric($num)){$num=100;}
	
	$CI =& get_instance();
	$CI->load->model('Common_Model');
	$CI->Common_Model->table='artonce';
	
	$where['lang']=$lang;
	$where['cateId']=$cateId;
	
	$query=$CI->Common_Model->get_last_Num($num,$where);
	$str='';
	if(!isNullOrEmpty($query)){
		foreach ($query as $key=>$obj){
// 			$content=(@$obj->content);
			$content=toStripslashes(@$obj->content);
			//$str.=$content;
			$obj->content = $content;
			$query[$key] = $obj;
		}
	}
	
	return $query;
}

function get_news($cateId,$lang='',$num=10,$where=array(),$page=1,$isGetCount=FALSE){
	if(!isNullOrEmpty($cateId)){
		$where['cateId']=$cateId;
	}
	if(isNullOrEmpty($lang)){
		$lang=config_item('language');
	}
	if(!is_numeric($num)){
		$num=10;
	}
	if(!is_numeric($page)||$page<1){
		$page=1;
	}
	
	$where['lang']=$lang;
	$offset=($page-1)*$num;
	
	$order=array();
	$order['isTop']='asc';
	$order['orderNum']='asc';
	$order['addTime']='desc';
	
	$CI =& get_instance();
	$CI->load->model('Common_Model');
	$CI->Common_Model->table='news';


	if(!is_bool($isGetCount)||$isGetCount==FALSE){
		$query=$CI->Common_Model->get($offset,$num,$where,'',$order);
	}else{
		$query=$CI->Common_Model->get_count($where);
	}
	
	return $query;	
// 	$str='';
// 	if(!isNullOrEmpty($query)){
// 		foreach ($query as $key=>$obj){
// 			$title=toStriForHtmlSpeChar(@$obj->title);
// 			$str.=$title;
// 		}
// 	}

// 	return $str;
}

function getHotNewsLists($cateId,$lang='',$num=10){
	$where=array();
	$where['isHot']=1;
	$where['isTop']=2;
	$query=get_news($cateId,$lang,$num,$where);
	$str='';
	if(!isNullOrEmpty($query)){
		foreach ($query as $key=>$obj){
			$title=toStriForHtmlSpeChar(@$obj->title);
			$time=date('Y-m-d',@$obj->addTime);
			$Id=@$obj->Id;
			$t_cateId=@$obj->cateId;
// 			$href=$Id;
			$href=site_url().'/home/companyNewsDetail?cateId='.$t_cateId.'&Id='.$Id;
				
			$temp='<li><label>'.$time.'</label><a href="'.$href.'" class="tooltip" title="'.$title.'">'.$title.'</a></li>';
			
			$str.=$temp;
		}
	}

	return $str;
}

function getTopNewsList($lang='',$num=10){
	$cateId='';
	$where=array();
	$where['isTop']=1;
	$query=get_news($cateId,$lang,$num,$where);
	$str='';
	if(!isNullOrEmpty($query)){
		foreach ($query as $key=>$obj){
			$title=toStriForHtmlSpeChar(@$obj->title);
			$time=date('Y-m-d',@$obj->addTime);
			$Id=@$obj->Id;
			$t_cateId=@$obj->cateId;
// 			$href=$Id;
			$href=site_url().'/home/companyNewsDetail?cateId='.$t_cateId.'&Id='.$Id;
			
			$temp='<li><span class="arrow_right1">&nbsp;&nbsp;&nbsp;&nbsp;</span><a href="'.$href.'" target="_self" title="">'.$title.'&nbsp;&nbsp;&nbsp;&nbsp;'.$time.'</a></li>';
				
			$str.=$temp;
		}
	}
	
	return $str;
}

function get_news_lists($cateId,$lang='',$page=1){
	$perpage=@config_item('perpage');
	$query=get_news($cateId,$lang,$perpage,'',$page);
	$str='';
	if(!isNullOrEmpty($query)){
		$str='<ol class="news_lists">';
		$temp='';
		$num=get_news($cateId,$lang,'','','',TRUE);
		foreach($query as $key=>$obj){
			$title=toStriForHtmlSpeChar(@$obj->title);
			$time=date('Y-m-d H:i:s',@$obj->addTime);
			$Id=@$obj->Id;
			$t_cateId=@$obj->cateId;
			$isHot=@$obj->isHot;
			$isTop=@$obj->isTop;
			$hot='';
			$top='';
			if($isHot==1){
				$hot='<span class="hot">&nbsp;&nbsp;</span>';
			}
			if($isTop==1){
				$top='<span class="top">&nbsp;&nbsp;</span>';
			}
			$href=site_url().'/home/companyNewsDetail?cateId='.$t_cateId.'&Id='.$Id;
			$temp.='<li><span>·</span><a href="'.$href.'" title="'.$title.'"><div style="width: 75%;">'.$title.'&nbsp;'.$top.$hot.'</div><div style="text-align: right;">'.$time.'</div></a></li>';
		}
		$str.=$temp.'</ol>';
		$url=site_url().'/home/companyNews?cateId='.$cateId;
		
		$str_page=get_page($perpage, $num, $url);
		$str='<div class="">'.$str.'</div>'.$str_page;
	}
	return $str;
}

function get_page($perpage,$num,$url){
	if(!is_numeric($perpage)||$perpage<1){
		$perpage=@config_item('perpage');
	}
	
// 	var_dump($perpage);

	$CI=&get_instance();
	$CI->load->library('pagination');
	
	$config['base_url'] = $url;
	$config['total_rows'] = $num;
	$config['per_page'] = $perpage;
	$CI->pagination->initialize($config);
	$temp= $CI->pagination->create_links();
	$str=$temp;
	$str='<div id="page" class="pages"><ul>'.$str;
	if(!isNullOrEmpty($temp)){
		$str.='<li class="pages_input"><input type="text" value="1" onkeydown="javascript: if(event.keyCode==13){ location='."'$url&amp;page='+this.value+'';".'return false;}" title="You want the input to the page:"></li>';
	}
	$str.='</ul><div class="clear"></div></div>';
	return $str;
}

function get_product_lists($cateId,$lang='',$page=1,$perpage=12,$where=array(),$like=array(),$url=null){
// 	$perpage=@config_item('perpage');
// 	$perpage=12;
	$query=get_product($cateId,$lang,$perpage,$where,$page,FALSE,$like);
	$str='';
	if(!isNullOrEmpty($query)){
		$str='<ol>';
		$temp='';
		$num=get_product($cateId,$lang,$perpage,$where,$page,TRUE,$like);
		
		$where=array();
		$module='product';
		$cSign=@config_item('cSign');$cSign=@$cSign[$module];
		$where['cType']='image';
		$where['cSign']=@$cSign[0];
		$CI =& get_instance();
		$CI->load->model('Common_Model');
		$CI->Common_Model->table='relefile';
		
		$order = array ();
		$order ['addTime'] = 'desc';
		
		foreach($query as $key=>$obj){
			$title=toStriForHtmlSpeChar(@$obj->title);
			$time=date('Y-m-d',@$obj->addTime);
			$Id=@$obj->Id;
			$isHot=@$obj->isHot;
			$no=@$obj->no;
			$where['no']=$no;
			
			$t_cateId=@$obj->cateId;
			
			$ref_query=$CI->Common_Model->get_last_Num(1,$where,'',$order);
			
			$ref_title='';
			$ref_url='';
			if(!isNullOrEmpty($ref_query)){
				$ref_obj=$ref_query[0];
				$ref_title=toStriForHtmlSpeChar(@$ref_obj->title);
				$ref_url=@$ref_obj->url;
			}
			
			$hot='';
			if($isHot==1){
				$hot='<span class="hot">&nbsp;&nbsp;</span>';
			}
			
			$href=site_url().'/home/productsDetail?cateId='.$t_cateId.'&Id='.$Id;
			$img_src=$ref_url;
			$temp.='<li><a href="'.$href.'" target="_self" title="'.$title.'"><img alt="'.$ref_title.'" title="'.$ref_title.'" src="'.$img_src.'">'.$title.$hot.'</a></li>';
			
		}
		$str.=$temp.'</ol>';
		
		if(isNullOrEmpty($url)){
			$url=site_url().'/home/product?cateId='.$cateId;
		}
		

		$str_page=get_page($perpage, $num, $url);
		$str='<div class="productsList"><h2></h2>'.$str.'<div class="clear"></div></div>'.$str_page;
	}
	return $str;
}

function get_product($cateId,$lang='',$num=10,$where=array(),$page=1,$isGetCount=FALSE,$like=array()){

	if(!isNullOrEmpty($cateId)){
		$where['cateId']=$cateId;
	}
	if(isNullOrEmpty($lang)){
		$lang=config_item('language');
	}
	if(!is_numeric($num)){
		$num=10;
	}
	if(!is_numeric($page)||$page<1){
		$page=1;
	}
	
	$where['lang']=$lang;
	$offset=($page-1)*$num;
	
	$order=array();
	$order['orderNum']='asc';
	$order['addTime']='desc';

	$CI =& get_instance();
	$CI->load->model('Common_Model');
	$CI->Common_Model->table='product';

	if(!is_bool($isGetCount)||$isGetCount==FALSE){
		$query=$CI->Common_Model->get($offset,$num,$where,$like,$order);
	}else{
		$query=$CI->Common_Model->get_count($where,$like);
	}
	
	return $query;
}

function getHotProduct($lang='',$num=6){
	$cateId='';
	$where=array();
	$where['isHot']=1;
	$query=get_product($cateId,$lang,$num,$where);
	$str='';
	if(!isNullOrEmpty($query)){
		$where=array();
		$module='product';
		$cSign=@config_item('cSign');$cSign=@$cSign[$module];
		$where['cType']='image';
		$where['cSign']=@$cSign[0];
		$CI =& get_instance();
		$CI->load->model('Common_Model');
		$CI->Common_Model->table='relefile';
		
		$order = array ();
		$order ['addTime'] = 'desc';
		
		foreach ($query as $key=>$obj){
			$title=toStriForHtmlSpeChar(@$obj->title);
			$time=date('Y-m-d',@$obj->addTime);
			$Id=@$obj->Id;
			
			$cateId=@$obj->cateId;
			
			$no=@$obj->no;
			$where['no']=$no;
			
			$ref_query=$CI->Common_Model->get_last_Num(1,$where,'',$order);
			
			$ref_title='';
			$ref_url='';
			if(!isNullOrEmpty($ref_query)){
				$ref_obj=$ref_query[0];
				$ref_title=toStriForHtmlSpeChar(@$ref_obj->title);
				$ref_url=@$ref_obj->url;
			}
			
			$href=site_url().'/home/productsDetail?cateId='.$cateId.'&Id='.$Id;
			$img_src=$ref_url;
			$temp='<li><a href="'.$href.'" target="_self" title="'.$title.'"><img alt="'.$ref_title.'" title="'.$ref_title.'" src="'.$img_src.'">'.$title.'</a></li>';
			
			$str.=$temp;
		}
	}
	
	return $str;
}

function get_left_nav($cateId,$fatherId){
	$where=array();
	if(isNullOrEmpty($cateId)){$cateId='';}
	if(!is_numeric(($fatherId))){
		return '';
	}
	$like=array();
	$CI =& get_instance();
	$CI->load->model('Common_Model');
	$CI->Common_Model->table='category';
	$order=' orderNum asc, Id asc ';
	
	$max=config_item('max_num');
	
	$str='';
		// if (! is_numeric ( $level )) {
		// return '';
		// } else if ($level == 1) {
		
	$where ['Id'] = $fatherId;
	$query = $CI->Common_Model->get_last_Num ( $max, $where, $like, $order );
	if (! isNullOrEmpty ( $query )) {
		$obj = $query [0];
		$t_fatherId=$obj->fatherId;
		if($t_fatherId!=0){
			$catePath=explode(',', $obj->catePath);
			$t_fatherId=@$catePath[1];
			$str=get_left_nav($cateId,$t_fatherId);
			
		}else{
			$cateName = $obj->cateName;
			//var_dump($fatherId);
			$str = ' <h2 style=""><span>&nbsp;&nbsp;</span>' . $cateName . '</h2>';
			$str.=get_left_nav_cate($cateId,$fatherId);
		}
	}
	
	return $str;
// 	}else{
// 		$where=array();
// 		$where['fatherId']=$cateId;
// 		$query = $CI->Common_Model->get_last_Num ($max,$where,$like,$order);
// 		if(!isNullOrEmpty($query)){
// 			foreach($query as $key => $obj){
// 				$cateName=$obj->cateName;
// 				$str.=' <h2 style=""><span>&nbsp;&nbsp;</span>'.$cateName.'</h2>';
// 			}
// 		}
// 	}
	
}

function get_left_nav_cate($cateId,$fatherId){
	$where = array ();
	if (! is_numeric ( $cateId )) {
		$cateId = '';
	}
	if(!is_numeric($fatherId)){return '';}
	
	$like=array();
	$CI =& get_instance();
	$CI->load->model('Common_Model');
	$CI->Common_Model->table='category';
	$order=' orderNum asc, Id asc ';

	$max=config_item('max_num');

	$str='';

	$where ['fatherId'] = $fatherId;
	$query = $CI->Common_Model->get_last_Num ( $max, $where, $like, $order );
	if (! isNullOrEmpty ( $query )) {
		$str='<ul class="main_left_list">';
		
		$temp='';
		$temp_child='';
		$temp_t='';
		foreach ($query as $key=>$value){
			$Id=@$value->Id;
				
			$cateName=@$value->cateName;
			$linkURL=@$value->linkURL;if(!is_numeric(strpos($linkURL, 'http://'))){$linkURL=site_url().'/home'.$linkURL;}
// 			$target=@$value->target;
// 			$level=@$value->level;
				
			if($Id==$cateId){
				$temp='<li class="hover"><a class="main_nav_left" href="'.$linkURL.'" style="" title="'.$cateName.'"><span class="">&nbsp;&nbsp;</span>'.$cateName.'</a>';
			}else{
				$temp='<li class="link"><a class="main_nav_left" href="'.$linkURL.'" style="" title="'.$cateName.'"><span class="">&nbsp;&nbsp;</span>'.$cateName.'</a>';
			}
			$temp_child=get_left_nav_cate($cateId,$Id);
				
			$temp =$temp.$temp_child.'</li>';
				
			$temp_t.=$temp;
				
		}
		$str.=$temp_t.'</ul>';
		
	}

	return $str;
}

function get_friendlink($cateId,$lang){
	$where=array();
	if(!isNullOrEmpty($cateId)){
		$where['cateId']=array(0,$cateId);
	}else{
		$where['cateId']=0;
	}
	
	if(isNullOrEmpty($lang)){
		$lang=config_item('language');
	}
	
	$where['lang']=$lang;
	$where['isShow']=1;
	
	$like=array();
	$CI =& get_instance();
	$CI->load->model('Common_Model');
	$CI->Common_Model->table='link';
	$order=' orderNum asc, Id asc ';
	
	$max=config_item('max_num');
	$query = $CI->Common_Model->get_last_Num ( $max, $where, $like, $order );
	
	$str='';
	
	if (! isNullOrEmpty ( $query )) {
		$front_common_lang = @lang ( 'front_common_home' );
		$arr_friendlink_lang = @$front_common_lang ['friendlink'];
		$friendLinkTitle=$arr_friendlink_lang['title'];
		$str='<div class="friendlink"><h3>'.$friendLinkTitle.'</h3><div>';
	
		$temp='';
		foreach ($query as $key=>$value){
			$Id=@$value->Id;
			$title=@$value->title;
			$link=@$value->link;
			
			$temp.='<a href="'.$link.'" title="'.$title.'" alt="'.$title.'" target="_blank" >'.$title.'</a>';
		}
		$str.=$temp.'</div><div class="clear"></div></div>';
	
	}
	
	return $str;
	
}

