<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artonce extends CI_Controller{
	public $module='artonce';
	public function __construct(){
		parent::__construct();
		checkLogin();
		$nav_power=array('module'=>$this->module,'action'=>'lists');
		$arrLang=lang('common_'.$this->module);
		$title=$arrLang['title'];
		checkPower($nav_power,$title);
		
		$this->load->helper('category_helper');
		$this->load->model('Common_Model');
		$this->Common_Model->table='artonce';
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
		                        display : '所属语言',
		                        name : 'lang',
		                        width : 80,
		                        sortable : true,
		                        align : 'center'
		                    },{
		                        display : '所属类别',
		                        name : 'cateName',
		                        width : 100,
		                        sortable : false,
		                        align : 'center'
		                    },{
					  			display : 'ID',
			                    name : 'Id',
			                    width : 40,
			                    sortable : true,
			                    align : 'center'
		                    },{
		                        display : '标题',
		                        name : 'title',
		                        width : 200,
		                        sortable : true,
		                        align : 'left' 
		                    },{
		                        display : '关键字',
		                        name : 'keywords',
		                        width : 100,
		                        sortable : true,
		                        align : 'center',
		                    },{
		                        display : '点击量',
		                        name : 'hitsNums',
		                        width : 50,
		                        sortable : true,
		                        align : 'center',
		                    },{
		                        display : '添加时间',
		                        name : 'addTime',
		                        width : 100,
		                        sortable : true,
		                        align : 'center',
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
                        display : '标题',
                        name : 'title',
                    },{
                        display : '关键字',
                        name : 'keywords',
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
				'sortorder' => 'asc',
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
		
		$sql = 'SELECT a.Id,a.cateId,a.lang,a.title,a.keywords,a.hitsNums,a.addTime,c.cateName,a.addUserId,admin.adminName FROM '.$table.' AS a LEFT JOIN '.$table_category.' AS c ON a.cateId=c.Id left join '.$table_admin.' as admin on admin.Id=a.addUserId WHERE 1=1';
		if(!isNullOrEmpty($lang)){
			$lang=getKeyFromValue($arr_lang,$lang);
			if(!isNullOrEmpty($lang)){
				$where['lang']=$lang;
				$sql .= " AND a.lang='".$lang."'";
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
		
		$jsonData = array('page'=>$page,'total'=>@$total,'rows'=>array());
		
		foreach($query AS $key=> $row){
			$deal='<a href="javascript:void(0);" class="btn btn-small btn-primary" onclick="deleteOne('.$row->Id.');">删除</a> <a class="btn btn-small " href="'.$site_url.'/'.$this->module.'/update/'.$row->Id.'">修改</a>';
			
			$title=toStriForHtmlSpeChar($row->title);
			$keywords=toStriForHtmlSpeChar($row->keywords);
			
			$entry = array('id'=>$row->Id,
					'cell'=>array(
							'lang'=>@$arr_lang[$row->lang],
							'cateName'=>$row->cateName,
							'Id'=>$row->Id,
							'title'=> $title,
							'keywords'=>$keywords,
// 							'linkURL'=>$row->linkURL,
							'hitsNums'=>$row->hitsNums.'次',
							'addTime'=>date('Y-m-d H:i:s',$row->addTime),
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
		
// 		$isDisabled=FALSE;
// 		$disabled='';
// 		$linkURL='#';$orderNum=0;
// 		$formEle['isDisabled']=$isDisabled;
// 		$formEle['disabled']=$disabled;
// 		$formEle['orderNum']=$orderNum;
// 		$formEle['linkURL']=$linkURL;
		
// 		$this->load->helper('category_helper');
// 		var_dump($module);exit;
		
		$obj=array('orderNum'=>0,'linkURL'=>'#');
		$formEle['obj']=$obj;
		
		
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
		
// 		var_dump($_POST);exit;
		$arr_post=$this->input->post();
		$arr_post=setForm($arr_post);
		$Id=@$arr_post['Id'];
		
		$module=$this->module;
		$arrLang=lang('common_'.$module);
		$logType=0;//数据操作
		
// 		var_dump($arr_post);exit;
// 		if(isNullOrEmpty(@$arr_post['forPlugin'])){
// 			$arr_post['forPlugin']='none';
// 		}
		
		if (isNullOrEmpty ( $Id )) { // 添加
			$action='add';
			$title=$arrLang[$action];
			unset($arr_post['Id']);
			
// 			$fatherId=@$arr_post['fatherId'];
// 			if(isNullOrEmpty($fatherId)){$fatherId=0;}
			
// 			if($fatherId!=0){
// 				$query=$this->Common_Model->get_last_Num(1,array('Id'=>$fatherId));
// 				$obj=@$query[0];
// 				$arr_post['level']=(@$obj->level)+1;
// 				$arr_post['catePath']=(@$obj->catePath).','.$fatherId;
// 			}else{
// 				$arr_post['level']=1;
// 				$arr_post['catePath']='0';
// 			}
			
			
			$arr_post['addUserId']=session('adminId');
			$arr_post['addTime']=time();
			$result = $this->Common_Model->insert ( $arr_post );
			
// 			var_dump($result);
// 			var_dump($arr_post);exit;
			
			if ($result) {
				$msg =  $title.'成功！';
				$icon = "succeed";
			} else {
				$msg =  $title.'失败！';
				$icon = "error";
			}
		}else{
			
// 			var_dump($arr_post);exit;
			
			$action='update';
			$title=$arrLang[$action];
			$result = $this->Common_Model->update ($Id, $arr_post );
			if ($result) {
				$msg = $title.'成功！';
				$icon = "succeed";
			} else {
				$msg = $title.'失败！';
				$icon = "error";
			}
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
		
		$obj->title=toStriForHtmlSpeChar(@$obj->title);
		$obj->keywords=toStriForHtmlSpeChar(@$obj->keywords);
		$obj->description=toStriForHtmlSpeChar(@$obj->description);
		$obj->content=toStripslashes(@$obj->content);
		
		$formEle['module']=$module;
		$formEle['obj']=$obj;
		
// 		if(($obj->fatherId)==0){
// 			 $isDisabled=FALSE;
// 		}else{
// 			$isDisabled=TRUE;
// 		}
// 		$formEle['isDisabled']=$isDisabled;
// 		$disabled='disabled="disabled"';
// 		$orderNum=@$obj->orderNum;
// 		$linkURL=@$obj->linkURL;
// 		$formEle['disabled']=$disabled;
// 		$formEle['orderNum']=$orderNum;
// 		$formEle['linkURL']=$linkURL;
		
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
				
				$where=array('Id'=>$Id);
				$result = $this->Common_Model->delete ( $where );
					
				if (@$result) {
					
					$status = TRUE;
					$message =$title.'成功！';
				} else {
					$message = $title.'失败！';
					$status = FALSE;
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
	
	public function getCategory(){
		if (! isPost ()) {
			$msg='输入的链接不正确！';
			showErrorMsg($msg);
		}
		$arr_post=$this->input->post();
		$fatherId=@$arr_post['fatherId'];
		$lang=@$arr_post['lang'];
		$where=array();
		$like=array();
		if(!isNullOrEmpty($lang)){
			$str=get_category_html('',$lang,$fatherId);
		}else{
			$str='';
		}
		$str='<option value="">请选择</option>'.$str;
		header("Content-type: text/html; charset=utf-8");
		echo $str;
	}
	public function getCategoryField(){
		if (! isPost ()) {
			$msg='输入的链接不正确！';
			showErrorMsg($msg);
		}
		$arr_post=$this->input->post();
		$Id=@$arr_post['fatherId'];
		$isDisabled=TRUE;
		if (isNullOrEmpty ( $Id )||$Id==0) {
			$str=get_category_module_html();
		} else {
			$query = $this->Common_Model->get_last_Num ( 1, array (
					'id' => $Id 
			) );
			if (isNullOrEmpty ( $query )) {
				$str = '';
			} else {
				$obj=$query[0];
				$forPlugin=$obj->forPlugin;
				$level=$obj->level;
				if(is_numeric($level)){
					$isDisabled=($level>0)?TRUE:FALSE;
				}else{
					$isDisabled=FALSE;
				}
				$str=get_category_module_html($forPlugin,$isDisabled);
			}
		}
		header("Content-type: text/html; charset=utf-8");
		echo $str;
	}
}
