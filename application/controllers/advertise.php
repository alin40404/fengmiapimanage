<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Advertise extends CI_Controller{
	public $module='advertise';
	public function __construct(){
		parent::__construct();
		checkLogin();
		$nav_power=array('module'=>$this->module,'action'=>'lists');
		$arrLang=lang('common_'.$this->module);
		$title=$arrLang['title'];
		checkPower($nav_power,$title);
		
		$this->load->helper('category_helper');
		$this->load->model('Common_Model');
		$this->Common_Model->table='advertise';
	}

	public function index(){
		$module=$this->module;
		$arrLang=lang('common_'.$module);
		$title=$arrLang['title'];
		$data_header['title']=$title;
		$config_sideNavBar=config_item('sideNavBar');
		$data_header['sideNavBar']=get_side_navbar($module,$config_sideNavBar);
		$lang=config_item("language");
		$base_url=base_url();
		$site_url=site_url();
		$data['lang']=$lang;
		$data['module']=$module;
		$data['barTitle']=$title;
		$data['base_url']=$base_url;
		$data['add_url']=$site_url.'/'.$module.'/add';
		
		$jsonUrl=$site_url.'/'.$module.'/listsJson';
		$colModel=<<<HTML
						  [ {
		                        display : '添加时间',
		                        name : 'addTime',
		                        width : 150,
		                        sortable : true,
		                        align : 'center',
		                    },{
		                        display : '所属语言',
		                        name : 'lang',
		                        width : 80,
		                        sortable : true,
		                        align : 'center'
		                    },{
					  			display : 'ID',
			                    name : 'Id',
			                    width : 40,
			                    sortable : true,
			                    align : 'center'
		                    },{
		                        display : '所属类别',
		                        name : 'cateName',
		                        width : 100,
		                        sortable : false,
		                        align : 'center'
		                    },{
		                        display : '广告名称',
		                        name : 'advName',
		                        width : 100,
		                        sortable : true,
		                        align : 'left' 
		                    },{
		                        display : '广告链接',
		                        name : 'advLink',
		                        width : 200,
		                        sortable : true,
		                        align : 'left' 
		                    },{
		                        display : '是否显示',
		                        name : 'isShow',
		                        width : 50,
		                        sortable : true,
		                        align : 'center' 
		                    },{
		                        display : '管理员',
		                        name : 'adminName',
		                        width : 100,
		                        sortable : true,
		                        align : 'center',
		                    }, {
		                        display : '<i class="icon-pencil">操作</i>',
		                        name : 'deal',
		                        width : 100,
		                        sortable : false,
		                        align : 'center'
	              		  } ]
HTML;
		$searchitems=<<<HTML
					[ {
	                    display : 'ID',
	                    name : 'Id'
                    },{
                        display : '广告名称',
                        name : 'advName',
						isdefault : true,
                    } ]
HTML;
	$button=<<<HTML
	 		[{
				name : "全选/反选",
				bclass : "allSelected",
				onpress : btnCB
			},{
				name : "删除",
				bclass : "delete",
				onpress : btnCB
			},{
				name : "所有语言",
				bclass : "lang",
				onpress : selectLang,
			},<{BUTTON_LANG}>{
				separator : true
			}]
HTML;
		$langBtn=get_lang_button();
		$button=str_replace('<{BUTTON_LANG}>', $langBtn, $button);
		
		$flexigridData= array (
				'url' => $jsonUrl,
				'colModel' => $colModel,
				'buttons' => $button,
				'searchitems' => $searchitems,
				'sortname' => 'addTime',
				'sortorder' => 'desc',
				'rp' => 10,
		);
		$data['flexigrid']=get_flexigrid($flexigridData);
		$this->load->view('common/header',$data_header);
		$this->load->view ( 'common/lists',$data);
		$this->load->view('common/footer');
	}
	
	public function lists(){
		$module=$this->module;
		redirect ( $module.'/index' );
	}

	public function listsJson(){
		if(!isPost()){
			$msg='输入的链接不正确！';
			showErrorMsg($msg);
		}
		$arr_post=$this->input->post();
		$arr_post=setForm($arr_post);
		
		$page = isset($arr_post['page']) ? $arr_post['page'] : 1;
		$rp = isset($arr_post['rp']) ? $arr_post['rp'] : 10;
		$offset=($page-1)*$rp;
		
		$sortname = isset($arr_post['sortname']) ? $arr_post['sortname'] : 'Id';
		$sortorder = isset($arr_post['sortorder']) ? $arr_post['sortorder'] : 'desc';
		$search = isset($arr_post['qtype']) ? $arr_post['qtype'] : '';
		$keywords = isset($arr_post['query']) ? $arr_post['query'] : '';
 		$lang = isset($arr_post['lang']) ? $arr_post['lang'] : '';
 		
 		$arr_lang=config_item('lang');
 		
 		$where=array();
 		$like=array();
		
		$order=$sortname.' '.$sortorder;
		
		$subclass_prefix=strtolower(config_item('subclass_prefix'));
		$table=$subclass_prefix.($this->Common_Model->table);
		$table_category=$subclass_prefix.'category';
		$table_admin=$subclass_prefix.'admin';
		
		$sql = 'SELECT a.Id,a.cateId,a.lang,a.advName,a.advLink,a.isShow,a.addTime,c.cateName,admin.adminName FROM '.$table.' AS a LEFT JOIN '.$table_category.' AS c ON a.cateId=c.Id left join '.$table_admin.' as admin on admin.Id=a.addUserId WHERE 1=1';
		if(!isNullOrEmpty($lang)){
			$lang=getKeyFromValue($arr_lang,$lang);
			if(!isNullOrEmpty($lang)){
				$where['lang']=$lang;
				$sql .= " AND a.lang='".$lang."' ";
			}
				
		}
		
		if(!isNullOrEmpty($keywords)){
// 			var_dump($arr_post);exit;
			$like=array($search=>$keywords);
			switch ($search){
				case 'Id':
					$where[$search]=$keywords;
					$like=array();
					$sql .= " AND a.$search = '".$keywords."' ";
					break;
				default:
					$sql .= " AND a.$search LIKE '%".$keywords."%' ";
					break;
			}
		}
		
		$total=$this->Common_Model->get_count($where,$like);
		
		$sql .= " ORDER BY $order";
		$query=$this->Common_Model->query($sql,$rp,$offset);
		
// 		$query=$this->Common_Model->get($offset,$rp,$where,$like,$order);
// 		$total=$this->Common_Model->get_count($where,$like);
		
		$site_url=site_url();
		$is=@config_item('is');
		$jsonData = array('page'=>$page,'total'=>@$total,'rows'=>array());
		
		foreach($query AS $key=> $row){
			$deal='<a href="javascript:void(0);" class="btn btn-small btn-primary" onclick="deleteOne('.$row->Id.');">删除</a> <a class="btn btn-small " href="'.$site_url.'/'.$this->module.'/update/'.$row->Id.'">修改</a>';
			
			$advName=toStriForHtmlSpeChar($row->advName);
			//$keywords=toStriForHtmlSpeChar($row->keywords);
			
			$entry = array('id'=>$row->Id,
					'cell'=>array(
							
							'addTime'=>date('Y-m-d H:i:s',$row->addTime),
							'lang'=>@$arr_lang[$row->lang],
							'Id'=>$row->Id,
							'cateName'=>$row->cateName,
							'advName'=> $advName,
							'advLink'=>$row->advLink,
							'isShow'=>@$is[$row->isShow],
// 							'linkURL'=>$row->linkURL,
// 							'hitsNums'=>$row->hitsNums.'次',
							'adminName'=>$row->adminName,
							'deal'=>$deal,
					),
			);
			$jsonData['rows'][] = $entry;
		}
		
		header("Content-type: application/json");
		echo json_encode($jsonData);
	}
	
	public function add(){
// 		header("Content-type: text/html;charset=utf-8");
		
// 		foreach($_SERVER as $key=>$value){
// 			echo $key,' => ';var_dump($value);echo '<br />';
// 		}
// 		exit;

		$module=$this->module;
		$action='add';
		$arrLang=lang('common_'.$module);
		$title=$arrLang[$action];
		$nav_power=array('module'=>$this->module,'action'=>$action);
		checkPower($nav_power,$title);
				
		$data_header['title']=$title;
		$config_sideNavBar=$this->config->item('sideNavBar');
		$data_header['sideNavBar']=get_side_navbar($module,$config_sideNavBar);
		$lang=$this->config->item("language");
		$base_url=$this->config->base_url();
		$site_url=site_url();
		$data['lang']=$lang;
		$data['title']=$arrLang['title'];
		$data['barTitle']=$title;
		$data['base_url']=$base_url;
		$data['add_url']=$site_url.'/'.$module.'/add';
		$data['lists_url']=$site_url.'/'.$module.'/index';
		$formEle['dealUrl']=$site_url.'/'.$module.'/deal';
		$formEle['module']=$module;
		$orderNum=0;
		$formEle['orderNum']=$orderNum;
		
// 		$isDisabled=FALSE;
// 		$disabled='';
		$advLink='#';
		
// 		$formEle['isDisabled']=$isDisabled;
// 		$formEle['disabled']=$disabled;
		
		$formEle['advLink']=$advLink;
		
// 		$this->load->helper('category_helper');
// 		var_dump($module);exit;
		
// 		$obj=array('orderNum'=>0,'advLink'=>'#');
// 		$formEle['obj']=$obj;
		
		
		$formTable=$this->load->view ( $module.'/form',$formEle,true);
		$data['formTable']=$formTable;
		$this->load->view('common/header',$data_header);
		$this->load->view('common/add',$data);
		$this->load->view('common/footer');
	}
	
	public function deal(){
		// 处理表单
		if (! isPost ()) {
			$msg='输入的链接不正确！';
			showErrorMsg($msg);
		}
		$arr_post=$this->input->post();
		$arr_post=setForm($arr_post);
		$Id=@$arr_post['Id'];
		
		$module=$this->module;
		$arrLang=lang('common_'.$module);
		$logType=0;//数据操作
		
// 		header("Content-type: text/html;charset=utf-8");

// 		foreach($arr_post as $key=>$value){
// 			echo $key,' => ';var_dump($value);echo '<br />';
// 		}
// 		exit;
// 		var_dump($arr_post);
		
		$imageSingle=@$arr_post['imagesingle'];
// 		$imageList=@$arr_post['imagelist'];
		unset($arr_post['imagesingle']);
// 		unset($arr_post['imagelist']);
		
		if (isNullOrEmpty ( $Id )) { // 添加
			$action='add';
			$title=$arrLang[$action];
			unset($arr_post['Id']);
			
			$no=$module.date('YmdHis',time()).rand(1000, 9999);
			
			$arr_post['no']=$no;
			$arr_post['addUserId']=session('adminId');
			$arr_post['addTime']=time();
			$result = $this->Common_Model->insert ( $arr_post );
			
// 			$result=true;
// 			var_dump($result);exit;
// 			var_dump($arr_post);
			
			if ($result) {
				$msg =  $title.'成功！';
				$icon = "succeed";
			} else {
				$msg =  $title.'失败！';
				$icon = "error";
			}
		}else{
// 			header ( "Content-type: text/html;charset=utf-8" );
			
// 			foreach ( $arr_post as $key => $value ) {
// 				echo $key, ' => ';
// 				var_dump ( $value );
// 				echo '<br />';
// 			}
// 			exit ();
			
			$no=@$arr_post['no'];
			unset($arr_post['no']);//编号自动生成 ，不能修改
			
			$action='update';
			$title=$arrLang[$action];
			$result = $this->Common_Model->update ($Id, $arr_post );
			if ($result) {
				$table=$this->Common_Model->table;
				$tableTemp='relefile';
				$this->Common_Model->table=$tableTemp;
				$where=array(
						'no'=>$no,
						'cTable'=>$table,
						'cType'=>'image',
						);
				$this->Common_Model->delete($where);
				removeImageFile($module,$no);
				$msg = $title.'成功！';
				$icon = "succeed";
				$this->Common_Model->table=$table;
			} else {
				$msg = $title.'失败！';
				$icon = "error";
			}
		}
		
		if ($result) {
			$table=$this->Common_Model->table;
			$arr_tmp=array(
					'no'=>$no,
					'cTable'=>$table,
					'cType'=>'image',
					'addUserId'=>session('adminId'),
					'addTime'=>time(),
			);
			$tableTemp='relefile';
			$this->Common_Model->table=$tableTemp;
			
			$cSign=@config_item('cSign');$cSign=@$cSign[$module];
			
			if(!isNullOrEmpty($imageSingle)){
				if(is_array($imageSingle)){
					$relefileData=array();
					foreach($imageSingle as $key =>$value){
						if(!isNullOrEmpty($value)){
							$url=copyImageFile(@$value['url'],$module,$no);
							if(!is_bool($url)){
								$value['url']=$url;
								$relefileData=$value;
								$relefileData['cSign']=@$cSign[0];
								$relefileData=array_merge($arr_tmp,$relefileData);
								$result = $this->Common_Model->insert ( $relefileData );
							}
						}
							
					}
				}
			}
			
// 			if(!isNullOrEmpty($imageList)){
// 				if(is_array($imageList)){
// 					$relefileData=array();
// 					foreach($imageList as $key =>$value){
// 						if(!isNullOrEmpty($value)){
// 							$url=copyImageFile(@$value['url'],$module,$no);
// 							if(!is_bool($url)){
// 								$value['url']=$url;
// 								$relefileData=$value;
// 								$relefileData['cSign']=@$cSign[1];
// 								$relefileData=array_merge($arr_tmp,$relefileData);
// 								$result = $this->Common_Model->insert ( $relefileData );
// 							}
// 						}
		
// 					}
// 				}
// 			}
			$this->Common_Model->table=$table;
		}
		
		writeLog($msg,$logType);
		
		showDialog ( $msg, NULL, 3000, $icon );
		exit ();
	}
	
	public function update($Id=''){
		$module=$this->module;
		$action='update';
		$arrLang=lang('common_'.$module);
		$title=$arrLang[$action];
		
		$nav_power=array('module'=>$this->module,'action'=>$action);
		checkPower($nav_power,$title);
		
		if(isNullOrEmpty(@$Id)){
			$msg='输入的链接不正确！';
			showErrorMsg($msg);
		}
		$query=$this->Common_Model->get_last_Num(1,array('id'=>$Id));
		if (isNullOrEmpty ( $query )) {
			$msg = '单页面不存在或已删除！';
			showErrorMsg($msg);
		}
		
		$obj=$query[0];
		
		$obj->advName=toStriForHtmlSpeChar(@$obj->advName);
// 		$obj->keywords=toStriForHtmlSpeChar(@$obj->keywords);
		$obj->bak=toStriForHtmlSpeChar(@$obj->bak);
// 		$obj->content=toStripslashes(@$obj->content);
		
		$formEle['module']=$module;
		$formEle['obj']=$obj;
		
// 		if(($obj->fatherId)==0){
// 			 $isDisabled=FALSE;
// 		}else{
// 			$isDisabled=TRUE;
// 		}
// 		$formEle['isDisabled']=$isDisabled;
// 		$disabled='disabled="disabled"';
		$orderNum=@$obj->orderNum;
		$advLink=@$obj->advLink;
// 		$formEle['disabled']=$disabled;
		$formEle['orderNum']=$orderNum;
		$formEle['advLink']=$advLink;
		
		$data_header['title']=$title;
		$config_sideNavBar=$this->config->item('sideNavBar');
		$data_header['sideNavBar']=get_side_navbar($module,$config_sideNavBar);
		
		$base_url=$this->config->base_url();
		$site_url=site_url();
		
		$data['title']=$arrLang['title'];
		$data['barTitle']=$title;
		$data['base_url']=$base_url;
		$data['add_url']=$site_url.'/'.$module.'/add';
		$data['lists_url']=$site_url.'/'.$module.'/index';
		$formEle['dealUrl']=$site_url.'/'.$module.'/deal';
		$no=$obj->no;
		$table=$this->Common_Model->table;
		$cSign=@config_item('cSign');$cSign=@$cSign[$module];
		$formEle['imageSingleHtml']=getImageFileHtml(@$cSign[0],$where=array(
						'no'=>$no,
						'cTable'=>$table,
						'cType'=>'image',
						'cSign'=>@$cSign[0],
						));
		$formEle['imageListHtml']=getImageFileHtml(@$cSign[1],$where=array(
				'no'=>$no,
				'cTable'=>$table,
				'cType'=>'image',
				'cSign'=>@$cSign[1],
		));
		
// 		$this->load->helper('category_helper');
		
		$formTable=$this->load->view ( $module.'/form',$formEle,true);
		$data['formTable']=$formTable;
		$this->load->view('common/header',$data_header);
		$this->load->view('common/add',$data);
		$this->load->view('common/footer');
			
	}
	
	public function delete(){
		if (! isPost ()) {
			$msg='输入的链接不正确！';
			showErrorMsg($msg);
		}
		$action='delete';
		$module=$this->module;
		$arrLang=lang('common_'.$module);
		$title=$arrLang[$action];
		
		$nav_power=array('module'=>$this->module,'action'=>$action);
		if(isHavePower($nav_power)){
		
			$arr_post=$this->input->post();
			$arr_post=setForm($arr_post);
			$Id=@$arr_post['Id'];
			
	// 		var_dump($Id);exit;
			$status=FALSE;
			$logType=0;
			
			if(!isNullOrEmpty($Id)){
				if(is_array($Id)){
					$del_id='';$del_fail_id='';$del_none_id='';
					foreach($Id as $key => $value){
						$where=array('Id'=>$value);
						$query=$this->Common_Model->get_last_Num (1, $where );
						if(!isNullOrEmpty($query)){
							$obj=$query[0];
							$no=$obj->no;
							$result = $this->Common_Model->delete ( $where );
							if (@$result) {
								$del_id .=$value.',';
								$table=$this->Common_Model->table;
								$tableTemp='relefile';
								$this->Common_Model->table=$tableTemp;
								$where=array(
										'no'=>$no,
										'cTable'=>$table,
										'cType'=>'image',
								);
								$this->Common_Model->delete($where);
								$this->Common_Model->table=$table;
								removeImageFile($module,$no,TRUE);
							} else {
								$del_fail_id .=$value.',';
							}
						}else{
							$del_none_id .=$value.',';
						}
					}
					$message='';
					if(!isNullOrEmpty($del_id)){
						$status = TRUE;
						$message ='ID号：'.$del_id.$title.'成功！';
					}
					if(!isNullOrEmpty($del_fail_id)){
						$status = FALSE;
						$message .='ID号：'.$del_fail_id.$title.'失败！';
					}
					if(!isNullOrEmpty($del_none_id)){
						$status = FALSE;
						$message .='ID号：'.$del_none_id.'不存在或已删除！'.$title.'失败！';
						$logType=3;
					}
					
				}else{
					$where=array('Id'=>$Id);
					$query=$this->Common_Model->get_last_Num (1, $where );
					if(!isNullOrEmpty($query)){
						$obj=$query[0];
						$no=$obj->no;
					
						$result = $this->Common_Model->delete ( $where );
							
						if (@$result) {
							$table=$this->Common_Model->table;
							$tableTemp='relefile';
							$this->Common_Model->table=$tableTemp;
							$where=array(
									'no'=>$no,
									'cTable'=>$table,
									'cType'=>'image',
							);
							$this->Common_Model->delete($where);
							$this->Common_Model->table=$table;
							removeImageFile($module,$no,TRUE);
							$status = TRUE;
							$message =$title.'成功！';
						} else {
							$message = $title.'失败！';
							$status = FALSE;
						}
					}else{
						$logType=3;
						$message ='ID号：'.$Id.'不存在或已删除！'. $title.'失败！';
						$status = FALSE;
					}
				}
				
				
			}else{
				$status=FALSE;
				$message=$title.'出错！';
				$logType=3;
			}
		
		}else{
			$status=FALSE;
			$message='无'.$title.'操作权限！';
			$logType=1;
		}
		
		writeLog($message,$logType);
		
		$jsonData['status']=$status;
		$jsonData['message']=$message;
		header("Content-type: application/json");
		echo json_encode($jsonData);
	}
	
}
