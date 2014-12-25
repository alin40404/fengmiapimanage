<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CommonCate extends CI_Controller{
	public $module='commonCate';
	public function __construct(){
		parent::__construct();
		checkLogin();
		
		
		$this->load->helper('category_helper');
		$this->load->model('Common_Model');
		$this->Common_Model->table='common_cate';
	}

	public function index(){
		$nav_power=array('module'=>$this->module,'action'=>'lists');
		$arrLang=lang('common_'.$this->module);
		$title=$arrLang['title'];
		checkPower($nav_power,$title);
		
		
		$module=$this->module;
		$arrLang=lang('common_'.$module);
		$title=$arrLang['title'];
		$data_header['title']=$title;
		//$config_sideNavBar=config_item('sideNavBar');
		$data_header['sideNavBar']=get_side_navbar($module);
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
		                        display : '排序',
		                        name : 'orderNum',
		                        width : 50,
		                        sortable : true,
		                        align : 'center'
		                    },{
		                        display : '所属父类别',
		                        name : 'fatherName',
		                        width : 100,
		                        sortable : false,
		                        align : 'left'
		                    },{
					  			display : 'ID',
			                    name : 'Id',
			                    width : 40,
			                    sortable : true,
			                    align : 'center'
		                    },{
		                        display : '类别名称',
		                        name : 'cateName',
		                        width : 200,
		                        sortable : true,
		                        align : 'left'
		                    },{
		                        display : '类别路径',
		                        name : 'catePath',
		                        width : 150,
		                        sortable : true,
		                        align : 'center',
		                    }, {
		                        display : '类别级数',
		                        name : 'level',
		                        width : 70,
		                        sortable : true,
		                        align : 'center',
		                    },{
		                        display : '添加时间',
		                        name : 'addTime',
		                        width : 150,
		                        sortable : true,
		                        align : 'center',
		                    },{
		                        display : '<i class="icon-pencil">操作</i>',
		                        name : 'deal',
		                        width : 150,
		                        sortable : false,
		                        align : 'center'
	              		  } ]
HTML;
		$searchitems=<<<HTML
					[ {
	                    display : 'ID',
	                    name : 'Id'
                    },{
                        display : '类别名称',
                        name : 'cateName',
						isdefault : true,
                    },{
                        display : '类别路径',
                        name : 'catePath',
                    }, {
                        display : '类别级数',
                        name : 'level',
                    }]
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
			}]
HTML;
		//$langBtn=get_lang_button();
		//$button=str_replace('<{BUTTON_LANG}>', $langBtn, $button);
		
		$flexigridData= array (
				'url' => $jsonUrl,
				'colModel' => $colModel,
				'buttons' => $button,
				'searchitems' => $searchitems,
				'sortname' => 'orderNum',
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
		$page = isset($arr_post['page']) ? $arr_post['page'] : 1;
		$rp = isset($arr_post['rp']) ? $arr_post['rp'] : 10;
		$sortname = isset($arr_post['sortname']) ? $arr_post['sortname'] : 'Id';
		$sortorder = isset($arr_post['sortorder']) ? $arr_post['sortorder'] : 'asc';
		$search = isset($arr_post['qtype']) ? $arr_post['qtype'] : '';
		$keywords = isset($arr_post['query']) ? $arr_post['query'] : '';
 		$lang = isset($arr_post['lang']) ? $arr_post['lang'] : '';
 		
 		$arr_lang=config_item('lang');
 		
 		$where=array();
		if(!isNullOrEmpty($lang)){
			$lang=getKeyFromValue($arr_lang,$lang);
			if(!isNullOrEmpty($lang)){
				$where['lang']=$lang;
			}
			
		}
		
		$like=array();
		if(!isNullOrEmpty($keywords)){
			$like=array($search=>$keywords);
			switch ($search){
				case 'Id':
					$where[$search]=$keywords;
					$like=array();
					break;
				default:
					break;
			}
		}
		
		$module=$this->module;
		$where['forPlugin']=$module;
		
		$subclass_prefix=strtolower(config_item('subclass_prefix'));
		$table=$subclass_prefix.$this->Common_Model->table;
		
		$sql=' SELECT c.*,f.cateName AS fatherName FROM '.$table.' AS c LEFT JOIN '.$table.' AS f ON c.fatherId=f.Id ';
		$sql.=' where 1=1 ';
		if(!isNullOrEmpty($where)){
			$sqlTemp='';
			foreach($where as $key => $value){
				$sqlTemp.=" and c.$key = '$value' ";
			}
			$sql.=$sqlTemp;
		}
		
		if(!isNullOrEmpty($like)){
			$sqlTemp='';
			foreach($like as $key => $value){
				$sqlTemp.=" and c.$key like '%$value%' ";
			}
			$sql.=$sqlTemp;
		}
		
		
		$order=' c.lang DESC, c.cateIdentifier asc, c.'.$sortname.' '.$sortorder.', c.Id asc ' ;
		
		$sql.=" order by ".$order;
		
		//$query=$this->Common_Model->get(($page-1)*$rp,$rp,$where,$like,$order);
		$query=$this->Common_Model->query($sql,$rp,($page-1)*$rp);
		
		$total=$this->Common_Model->get_count($where,$like);
		
		
		$site_url=site_url();
		$is=config_item('is');
		$jsonData = array('page'=>$page,'total'=>@$total,'rows'=>array());
		
		
		foreach($query AS $key=> $row){
			if($row->fatherId==0){
				$deal='<a disabled="disabled" title="不允许删除顶级类别" href="javascript:void(0);" class="btn btn-small btn-primary" >删除</a> <a class="btn btn-small " href="'.$site_url.'/'.$this->module.'/update/'.$row->Id.'">修改</a>';
			}else{
				$deal='<a href="javascript:void(0);" class="btn btn-small btn-primary" onclick="deleteOne('.$row->Id.');">删除</a> <a class="btn btn-small " href="'.$site_url.'/'.$this->module.'/update/'.$row->Id.'">修改</a>';
			}
			$Id=@$row->Id;
			$orderNum='<input onchange="changeOrderNum('.$Id.',this.value,'."'".$site_url."/category/changeOrderNum'".');" Id="'.$Id.'" class="" style="width:30px;" name="orderNum" type="text" value="'.$row->orderNum.'" />';
			$fatherName=$row->fatherName;$fatherName=(isNullOrEmpty($fatherName))?"0":$fatherName;
			
			$entry = array('id'=>$Id,
					'cell'=>array(
							'orderNum'=>$orderNum,
							'Id'=>$Id,
							//'lang'=>@$arr_lang[$row->lang],
							'cateName'=>getLine($row->level).$row->cateName,
							'fatherId'=>$row->fatherId,
							'fatherName'=>$fatherName,
							'catePath'=>$row->catePath,
							'level'=>$row->level.' 级',
							//'isNav'=>@$is[$row->isNav],
							//'linkURL'=>$row->linkURL,
							//'forPlugin'=>$row->forPlugin,
							'addTime'=>date('Y-m-d H:i:s',$row->addTime),
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
		//$config_sideNavBar=$this->config->item('sideNavBar');
		$data_header['sideNavBar']=get_side_navbar($module);
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

		$orderNum=0;
// 		$formEle['isDisabled']=$isDisabled;
// 		$formEle['disabled']=$disabled;
		$formEle['orderNum']=$orderNum;
// 		$formEle['linkURL']=$linkURL;
		
	
		$formEle['forPlugin']=$module; 
		
		$obj=array('orde?rNum'=>0,'linkURL'=>'#');
		
		$formEle['obj']=$obj;
		$formTable=$this->load->view ( 'commonCate/form',$formEle,true);
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
		

		//$arr_post['cateName']=$arr_post['keywords'];
		
		if (isNullOrEmpty ( $Id )) { // 添加
			$action='add';
			$title=$arrLang[$action];
			unset($arr_post['Id']);
			
			$fatherId=@$arr_post['fatherId'];
			if(isNullOrEmpty($fatherId)){$fatherId=0;}
			
			if($fatherId!=0){
				$query=$this->Common_Model->get_last_Num(1,array('Id'=>$fatherId));
				$obj=@$query[0];
				$arr_post['level']=(@$obj->level)+1;
				$arr_post['catePath']=(@$obj->catePath).','.$fatherId;
			}else{
				$arr_post['level']=1;
				$arr_post['catePath']='0';
			}
			
			
			$arr_post['forPlugin']=$module;
			
			$arr_post['addUserId']=session('adminId');
			$arr_post['addTime']=time();
			$result = $this->Common_Model->insertBackId ( $arr_post );
			if (is_numeric($result)) {
				$Id=$result;
				$cateIdentifier=$arr_post['catePath'].','.$Id;
				$cateIdentifier=ltrim($cateIdentifier,'0');
				$cateIdentifier=ltrim($cateIdentifier,',');
				
				$this->Common_Model->update ($Id, array('cateIdentifier'=>$cateIdentifier) );
				
				$msg =  $title.'成功！';
				$icon = "succeed";
			} else {
				$msg =  $title.'失败！';
				$icon = "error";
			}
		}else{
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
			$msg = '类别名称不存在或已删除！';
			showErrorMsg($msg);
		}
		
		$obj=$query[0];
		$formEle['obj']=$obj;
		if(($obj->fatherId)==0){
			 $isDisabled=FALSE;
		}else{
			$isDisabled=TRUE;
		}
		$formEle['isDisabled']=$isDisabled;
		$disabled='disabled="disabled"';
		$orderNum=@$obj->orderNum;
// 		$linkURL=@$obj->linkURL;
		$formEle['disabled']=$disabled;
		$formEle['orderNum']=$orderNum;
// 		$formEle['linkURL']=$linkURL;
		
		$data_header['title']=$title;
		//$config_sideNavBar=$this->config->item('sideNavBar');
		$data_header['sideNavBar']=get_side_navbar($module);
		
		$base_url=$this->config->base_url();
		$site_url=site_url();
		
		$data['title']=$arrLang['title'];
		$data['barTitle']=$title;
		$data['base_url']=$base_url;
		$data['add_url']=$site_url.'/'.$module.'/add';
		$data['lists_url']=$site_url.'/'.$module.'/index';
		$formEle['dealUrl']=$site_url.'/'.$module.'/deal';
		
		
		$formTable=$this->load->view ( 'commonCate/form',$formEle,true);
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
				$MAX_NUM=@config_item('max_num');
				$query=$this->Common_Model->get_last_Num($MAX_NUM,$where);
				
				if (!isNullOrEmpty ( $query )) {
					$del_id='';;$del_fail_level='';$del_fail_child='';
					foreach ($query as $key=>$obj){
	// 					$obj=$query[0];
						$fatherId=$obj->fatherId;
						$t_Id=$obj->Id;
						if($fatherId!=0){
							
							$query=$this->Common_Model->get_last_Num(1,array('fatherId'=>$t_Id));
							if(isNullOrEmpty($query)){
								$del_id.=$t_Id.',';
								
							}else{
// 								$status = FALSE;
								$del_fail_child.=$t_Id.',';
// 								$message = $title.'失败！不允许删除顶级类别！';
							}
						}else{
// 							$status = FALSE;
							$del_fail_level.=$t_Id.',';
							
						}
					}
					$message='';
					if(!isNullOrEmpty($del_fail_level)){
						$message = '帐号：'.$del_fail_level.$title.'失败！不允许删除顶级类别！<br />';
					}
					if(!isNullOrEmpty($del_fail_child)){
						$message .= '帐号：'.$del_fail_child.$title.'失败！存在子类别！<br />';
					}
					if(!isNullOrEmpty($message)){
						$status = FALSE;
					}else{
						$status = TRUE;
					}
					if(!isNullOrEmpty($del_id)){
						$temp='帐号：'.$del_id;
						
						$del_id=trim($del_id,',');
						$del_where=array('Id'=>$del_id);
						$result = $this->Common_Model->delete ( $del_where );
						
						if (@$result) {
							if($status){
								$temp='';
							}
							$status = TRUE;
							$message .=$temp.$title.'成功！';
						} else {
							$message .= $temp.$title.'失败！';
							$status = FALSE;
						}
					}
					
					
				} else {
					$status = FALSE;
					$message = $title.'失败！'.$title.'不存在或已删除！';
					$logType=3;
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
	
	public function changeOrderNum(){
		if (! isPost ()) {
			$msg='输入的链接不正确！';
			showErrorMsg($msg);
		}
		
		$module=$this->module;
		$action='update';
		$arrLang=lang('common_'.$module);
		$title=$arrLang[$action];
		
		$logType=0;//数据操作
		$status=0;
		
		$arr_post=$this->input->post();
		$Id=@$arr_post['Id'];
		$json=array();
		if (isNullOrEmpty ( $Id )) {
			$status=0;
			$msg='Id号不能为空！';
		} else {
			$orderNum=$arr_post['orderNum'];
			if(!is_numeric($orderNum)){
				$status=0;
				$msg='排序号不是数字！';
			}else{
				$arr_post=array();
				$arr_post['orderNum']=$orderNum;
				$result = $this->Common_Model->update ($Id, $arr_post );
				if ($result) {
					$status=1;
					$msg = $title.'Id为'.$Id.'的排序号成功！';
					
				} else {
					$status=0;
					$msg = $title.'Id为'.$Id.'失败！';
					
				}
			}
		}
		
		$jsonData['status']=$status;
		$jsonData['msg']=$msg;
		writeLog($msg,$logType);
		
		header("Content-type: application/json");
		echo json_encode($jsonData);
	}
	
	public function getCommonCate(){
		if (! isPost ()) {
			$msg='输入的链接不正确！';
			showErrorMsg($msg);
		}
		$arr_post=$this->input->post();
	
		$cateId=@$arr_post['cateId'];
		$fatherId=@$arr_post['fatherId'];
		$lang=@$arr_post['lang'];
		$forPlugin=@$arr_post['forPlugin'];
		//$forPlugin=config_item('forPlugin');
	
	
		$where=array();
		$like=array();
		if(!isNullOrEmpty($forPlugin)){
			$like=$forPlugin;
		}
	
		if(!isNullOrEmpty($lang)){
			$str=get_common_cate_html($cateId,$lang,$fatherId,$like);
		}else{
			$str='';
		}
		$str='<option value="">请选择</option>'.$str;
		header("Content-type: text/html; charset=utf-8");
		echo $str;
	}
	
	public function getCommonCateField(){
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
