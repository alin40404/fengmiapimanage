<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Database extends CI_Controller{
	public $module='database';
	public function __construct(){
		parent::__construct();
		checkLogin();
		$nav_power=array('module'=>$this->module,'action'=>'lists');
		$moduleMsg='管理数据库';
		checkPower($nav_power,$moduleMsg);
		
		$this->load->model('Common_Model');
		$this->Common_Model->table='database';
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
		$data['add_url']='';
		
		$jsonUrl=$site_url.'/'.$module.'/listsJson';
		$colModel=<<<HTML
						 [ {
		                        display : '日志时间',
		                        name : 'logTime',
		                        width : 100,
		                        sortable : true,
		                        align : 'center'
		                    }, {
					  			display : 'ID',
			                    name : 'Id',
			                    width : 50,
			                    sortable : true,
			                    align : 'center'
		                    }, {
		                        display : '日志类型',
		                        name : 'logType',
		                        width : 100,
		                        sortable : false,
		                        align : 'center'
		                    },{
		                        display : '日志描述',
		                        name : 'describe',
		                        width : 350,
		                        sortable : true,
		                        align : 'center'
		                    }, {
		                        display : 'IP地址',
		                        name : 'ip',
		                        width : 100,
		                        sortable : true,
		                        align : 'center',
		                    },{
		                        display : 'URL',
		                        name : 'emergeURL',
		                        width : 150,
		                        sortable : true,
		                        align : 'center',
		                    },{
		                        display : '管理员',
		                        name : 'userId',
		                        width : 50,
		                        sortable : true,
		                        align : 'center',
		                    }, {
		                        display : '<i class="icon-pencil">操作</i>',
		                        name : 'deal',
		                        width : 50,
		                        sortable : false,
		                        align : 'center'
	              		  } ]
HTML;
		$searchitems=<<<HTML
				[ {
	                    display : 'ID',
	                    name : 'Id'
                    },{
                        display : 'IP地址',
                        name : 'ip',
                    },{
                        display : 'URL',
                        name : 'emergeURL',
                    },{
                        display : '操作的管理员',
                        name : 'userId',
                    }, {
	                    display : '日志描述',
                        name : 'describe',
	                }, {
                        display : '日志时间',
                        name : 'logTime',
                        isdefault : true,
				} ]
HTML;
		$flexigridData= array (
				'url' => $jsonUrl,
				'colModel' => $colModel,
				'searchitems' => $searchitems,
				'sortname' => 'logTime',
				'sortorder' => 'asc',
				'rp' => 10,
		);
		$data['flexigrid']=get_flexigrid($flexigridData);
		$this->load->view('common/header',$data_header);
		$this->load->view ( 'database/index',$data);
		$this->load->view('common/footer');
	}
	
	public function lists(){
		$module=$this->module;
		redirect ( $module.'/index' );
	}

	public function listsJson(){
		if(!isPost()){
			$msg='请输入正确的链接！';
			showDialog($msg,'错误',3000,"error");
			exit();
		}
		$arr_post=$this->input->post();
		$page = isset($arr_post['page']) ? $arr_post['page'] : 1;
		$rp = isset($arr_post['rp']) ? $arr_post['rp'] : 10;
		$sortname = isset($arr_post['sortname']) ? $arr_post['sortname'] : 'Id';
		$sortorder = isset($arr_post['sortorder']) ? $arr_post['sortorder'] : 'desc';
		$search = isset($arr_post['qtype']) ? $arr_post['qtype'] : '';
		$keywords = isset($arr_post['query']) ? $arr_post['query'] : '';
// 		$lang = isset($arr_post['lang']) ? $arr_post['lang'] : '';
		
		$where=array();
		$like=array();if(!isNullOrEmpty($keywords)){$like=array($search=>$keywords);}
		$order=$sortname.' '.$sortorder;
		$query=$this->Common_Model->get(($page-1)*$rp,$rp,$where,$like,$order);
		$total=$this->Common_Model->get_count($where,$like);
		
		$site_url=site_url();
		header("Content-type: application/json");
		$jsonData = array('page'=>$page,'total'=>@$total,'rows'=>array());
		
		foreach($query AS $key=> $row){
			
			$deal='<a href="javascript:void(0);" class="btn btn-small btn-primary" onclick="deleteOne('.$row->Id.');">删除</a>';
			$entry = array('id'=>$row->Id,
					'cell'=>array(
							'logTime'=>$row->logTime,
							'Id'=>$row->Id,
							'logType'=>$row->logType,
							'describe'=>$row->describe,
							'ip'=>$row->ip,
							'emergeURL'=>$row->emergeURL,
							'userId'=>$row->userId,
							'deal'=>$deal,
					),
			);
			$jsonData['rows'][] = $entry;
		}
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
			$msg = '请输入正确的链接！';
			showDialog ( $msg, '错误', 3000, "error" );
			exit ();
		}
		$arr_post=$this->input->post();
		$arr_post=setForm($arr_post);
		$Id=@$arr_post['Id'];
		$gName=$arr_post['gName'];
		$query=$this->Common_Model->get_last_Num(1,array('gName'=>$gName));
		if (isNullOrEmpty ( $Id )) { // 添加
			
			if (!isNullOrEmpty ( $query )) {
				$msg = '添加失败,组名已存在！';
				$icon = "error";
			}else{
				unset($arr_post['Id']);
				$arr_post['addUserId']=session('adminId');
				$arr_post['addTime']=time();
				$result = $this->Common_Model->insert ( $arr_post );
				if ($result) {
					$msg = '添加成功！';
					$icon = "succeed";
				} else {
					$msg = '添加失败！';
					$icon = "error";
				}
			}
		}else{
			if (!isNullOrEmpty ( $query )) {
				$obj=$query[0];
				$db_gId=$obj->Id;
				if ($db_gId != $Id) {
					$msg = '修改失败,组名已存在！';
					$icon = "error";
				} else {
					$result = $this->Common_Model->update ($Id, $arr_post );
					if ($result) {
						$msg = '修改成功！';
						$icon = "succeed";
					} else {
						$msg = '修改失败！';
						$icon = "error";
					}
				}
			}else{
				$result = $this->Common_Model->update ($Id, $arr_post );
				if ($result) {
					$msg = '修改成功！';
					$icon = "succeed";
				} else {
					$msg = '修改失败！';
					$icon = "error";
				}
			}
		}
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
			$msg='请输入正确的链接！';
			showDialog($msg,'错误',3000,"error");
			exit();
		}
		$query=$this->Common_Model->get_last_Num(1,array('id'=>$Id));
		if (isNullOrEmpty ( $query )) {
			$msg = '用户组不存在或已删除！';
			showDialog ( $msg, '错误', 3000, "error" );
			exit ();
		}
		
		$obj=$query[0];
		$formEle['obj']=$obj;
		
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
// 		$this->load->config('config_power');
		$config_power=$this->config->item('power');
		$formEle['power']=get_power_html($config_power,$obj->power);
		
		$formTable=$this->load->view ( $module.'/form',$formEle,true);
		$data['formTable']=$formTable;
		$this->load->view('common/header',$data_header);
		$this->load->view('common/add',$data);
		$this->load->view('common/footer');
			
	}
	
	public function delete(){
		if (! isPost ()) {
			$msg = '请输入正确的链接！';
			showDialog ( $msg, '错误', 3000, "error" );
			exit ();
		}
		$action='delete';
		$nav_power=array('module'=>$this->module,'action'=>$action);
		if(isHavePower($nav_power)){
		
			$arr_post=$this->input->post();
			$arr_post=setForm($arr_post);
			$Id=@$arr_post['Id'];
			$status=FALSE;
			if(!isNullOrEmpty($Id)){
			    $del_where=array('Id'=>$Id);
				$result = $this->Common_Model->delete ( $del_where );
				if ($result) {
					$status = TRUE;
					$message = '删除成功！';
				} else {
					$status = FALSE;
					$message = '删除失败！';
				}
			}else{
				$status=FALSE;
				$message='删除出错！';
			}
		
		}else{
			$status=FALSE;
			$message='您无删除操作权限！';
		}
		$jsonData['status']=$status;
		$jsonData['message']=$message;
		header("Content-type: application/json");
		echo json_encode($jsonData);
	}
	
}
