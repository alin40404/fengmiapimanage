<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminRole extends CI_Controller{
	public $module='adminRole';
	public function __construct(){
		parent::__construct();
		checkLogin();
		$nav_power=array('module'=>$this->module,'action'=>'lists');
		
		$arrLang=lang('common_'.$this->module);
		$title=$arrLang['title'];
		checkPower($nav_power,$title);
		
		
		$this->load->model('Common_Model');
		$this->Common_Model->table='role';
		$this->load->helper('category_helper');
	}

	public function index(){
		$module=$this->module;
		$arrLang=lang('common_'.$module);
		$title=$arrLang['title'];
		$data_header['title']=$title;
		//$config_sideNavBar=$this->config->item('sideNavBar');
		$data_header['sideNavBar']=get_side_navbar($module);
		$lang=$this->config->item("language");
		$base_url=$this->config->base_url();
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
		                    }, {
								display : 'ID',
			                    name : 'Id',
			                    width : 50,
			                    sortable : true,
			                    align : 'center'
		                    }, {
		                        display : '角色名',
		                        name : 'rName',
		                        width : 150,
		                        sortable : true,
		                        align : 'center'
		                    }, {
		                        display : '所属组名',
		                        name : 'gName',
		                        width : 150,
		                        sortable : true,
		                        align : 'center'
		                    },{
		                        display : '属此角色的管理员数',
		                        name : 'adminCount',
		                        width : 150,
		                        sortable : false,
		                        align : 'center'
		                    }, {
		                        display : '添加时间',
		                        name : 'addTime',
		                        width : 150,
		                        sortable : true,
		                        align : 'center',
		                    }, {
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
                    }, {
                        display : '角色名',
                        name : 'rName',
                        isdefault : true,
				} ]
HTML;
		$flexigridData= array (
				'url' => $jsonUrl,
				'colModel' => $colModel,
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
		$offset=($page-1)*$rp;
		
		$sortname = isset($arr_post['sortname']) ? $arr_post['sortname'] : 'Id';
		$sortorder = isset($arr_post['sortorder']) ? $arr_post['sortorder'] : 'desc';
		$search = isset($arr_post['qtype']) ? $arr_post['qtype'] : '';
		$keywords = isset($arr_post['query']) ? $arr_post['query'] : '';
// 		$lang = isset($arr_post['lang']) ? $arr_post['lang'] : '';
		
		$where=array();
		$like=array();//if(!isNullOrEmpty($keywords)){$like=array($search=>$keywords);}
		$order=$sortname.' '.$sortorder;
		
		$subclass_prefix=strtolower(config_item('subclass_prefix'));
		$table=$subclass_prefix.($this->Common_Model->table);
		$table_f=$subclass_prefix.'common_cate';
		
		$sql=$table.'.Id,'.$table.'.rName,'.$table_f.'.cateName,'.$table.'.orderNum,'.$table.'.addTime';
		$sql='select '.$sql." from `$table` left JOIN  `$table_f` ON  `$table_f`.`Id` =  `$table`.`gId` WHERE 1=1 ";
		if(!isNullOrEmpty($keywords)){
			$like=array($search=>$keywords);
			switch ($search){
				case 'Id':
					$where=$like;
					$like=array();
					$sql .= " AND $table.$search = '".$keywords."' ";
					break;
				default:
					$sql .= " AND $table.$search LIKE '%".$keywords."%' ";
					break;
			}
		}
		
		$total=$this->Common_Model->get_count($where,$like);
		
		$sql .= " ORDER BY ".$order;
		$query=$this->Common_Model->query($sql,$rp,$offset);
		
		$site_url=site_url();
		header("Content-type: application/json");
		$jsonData = array('page'=>$page,'total'=>@$total,'rows'=>array());
		
		$tmpTable=$this->Common_Model->table;
		$this->Common_Model->table='admin';
		
		foreach($query AS $key=> $row){
			$where=array('rId'=>$row->Id);$like=NULL;
			$adminCount=$this->Common_Model->get_count($where,$like);$adminCount=is_numeric($adminCount)?$adminCount:0;
			$deal='<a href="javascript:void(0);" class="btn btn-small btn-primary" onclick="deleteOne('.$row->Id.');">删除</a> <a class="btn btn-small " href="'.$site_url.'/'.$this->module.'/update/'.$row->Id.'">修改</a>';
			$entry = array('id'=>$row->Id,
					'cell'=>array(
							'Id'=>$row->Id,
							'rName'=>$row->rName,
							'gName'=>$row->cateName,
							'adminCount'=>$adminCount,
							'orderNum'=>$row->orderNum,
							'addTime'=>date('Y-m-d H:i:s',$row->addTime),
							'deal'=>$deal,
					),
			);
			$jsonData['rows'][] = $entry;
		}
		$this->Common_Model->table=$tmpTable;
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
		
		$formEle['forPlugin']='adminGroup';
// 		$this->load->config('config_power');
		$config_power=$this->config->item('power');
		$formEle['power']=get_power_html($config_power);
		
		$obj=array('orderNum'=>0);
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
		$arr_post=$this->input->post();
		$arr_post=setForm($arr_post);
		$Id=@$arr_post['Id'];
		
		$module=$this->module;
		$arrLang=lang('common_'.$module);
		$logType=0;
		
		if (isNullOrEmpty ( $Id )) { // 添加
			$action='add';
			$title=$arrLang[$action];
			
// 			$rName=$arr_post['rName'];
// 			$query=$this->Common_Model->get_last_Num(1,array('rName'=>$rName));
// 			if (!isNullOrEmpty ( $query )) {
// 				$msg = '添加失败,角色名已存在！';
// 				$icon = "error";
// 			}else{
				unset($arr_post['Id']);
				$arr_post['addUserId']=session('adminId');
				$arr_post['addTime']=time();
				$result = $this->Common_Model->insert ( $arr_post );
				if ($result) {
					$msg = $title.'成功！';
					$icon = "succeed";
				} else {
					$msg = $title.'失败！';
					$icon = "error";
				}
// 			}
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
			$msg = '角色不存在或已删除！';
			showErrorMsg($msg);
		}
		
		$obj=$query[0];
		$formEle['obj']=$obj;
		//var_dump($obj);exit;
		
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
		
		$formEle['forPlugin']='adminGroup';
		$formEle['lang']=$lang;
		
// 		$this->load->config('config_power');
		$config_power=$this->config->item('power');
		$isDisabledCB=FALSE;
		$formEle['power']=get_power_html($config_power,$obj->power,$isDisabledCB);
		
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
			$status=FALSE;
			$logType=0;
			
			if(!isNullOrEmpty($Id)){
				$tmpTable=$this->Common_Model->table;
				$this->Common_Model->table='admin';
				$where=array('rId'=>$Id);
	// 			var_dump($Id);exit;
				$MAX_NUM=@config_item('max_num');
				$query=$this->Common_Model->get_last_Num($MAX_NUM,$where);
				$this->Common_Model->table=$tmpTable;
				if (isNullOrEmpty ( $query )) {
					$del_where=array('Id'=>$Id);
					$result = $this->Common_Model->delete ( $del_where );
					if ($result) {
						$status = TRUE;
						$message =  $title.'成功！';
					} else {
						$status = FALSE;
						$message =  $title.'失败！';
					}
				} else {
					$status = FALSE;
					$message = '该角色组下存在管理员帐号，不能直接删除，请先删除管理员帐号！';
					$logType=3;
				}
				
			}else{
				$status=FALSE;
				$message= $title.'出错！';
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
	
	public function getRoleIdName(){
		if (! isPost ()) {
			$msg='输入的链接不正确！';
			showErrorMsg($msg);
		}
		$arr_post=$this->input->post();
		$gId=@$arr_post['gId'];
		$where=array('gId'=>$gId);
		$like=array();
		$order='';
		$total=$this->Common_Model->get_count($where,$like);
		$query=$this->Common_Model->get(0,$total+1,$where,$like,$order);
		$jsonData=array();
		foreach($query as $key=>$value){
			$jsonData[]=array('rId'=>$value->Id,'rName'=>$value->rName);
		}
		header("Content-type: application/json");
		echo json_encode($jsonData);
	}
	
	public function getRolePower(){
		if (! isPost ()) {
			$msg='输入的链接不正确！';
			showErrorMsg($msg);
		}
		$arr_post=$this->input->post();
		$Id=@$arr_post['Id'];
		$isDisabledCB=@$arr_post['isDisabledCB'];
		
		if(!isNullOrEmpty($isDisabledCB)){$isDisabledCB=true;}
		
		$this->load->config ( 'config_power' );
		$config_power = $this->config->item ( 'power' );
		if (isNullOrEmpty ( $Id )) {
			//$str = get_power_html ( $config_power);
			$str='请选择角色组';
		} else {
			$query = $this->Common_Model->get_last_Num ( 1, array (
					'id' => $Id
			) );
			if (isNullOrEmpty ( $query )) {
				$str = '角色组已删除！';
			} else {
				$obj = $query [0];
	
				$str = get_power_html ( $config_power, $obj->power ,$isDisabledCB);
			}
		}
		header("Content-type: text/html; charset=utf-8");
		echo $str;
	}
	
}
