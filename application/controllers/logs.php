<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logs extends CI_Controller{
	public $module='logs';
	public function __construct(){
		parent::__construct();
		checkLogin();
		$nav_power=array('module'=>$this->module,'action'=>'lists');
		$moduleMsg='日志';
		checkPower($nav_power,$moduleMsg);
		
		$this->load->model('Common_Model');
		$this->Common_Model->table='log';
	}

	public function index(){
		$module=$this->module;
		$arrLang=lang('common_'.$module);
		$title=$arrLang['title'];
		$data_header['title']=$title;
		$config_sideNavBar=$this->config->item('sideNavBar');
		$data_header['sideNavBar']=get_side_navbar($module,$config_sideNavBar);
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
		                        width : 150,
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
                        display : '管理员',
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
		$page = isset($arr_post['page']) ? $arr_post['page'] : 1;
		$rp = isset($arr_post['rp']) ? $arr_post['rp'] : 10;
		$sortname = isset($arr_post['sortname']) ? $arr_post['sortname'] : 'Id';
		$sortorder = isset($arr_post['sortorder']) ? $arr_post['sortorder'] : 'desc';
		$search = isset($arr_post['qtype']) ? $arr_post['qtype'] : '';
		$keywords = isset($arr_post['query']) ? $arr_post['query'] : '';
// 		$lang = isset($arr_post['lang']) ? $arr_post['lang'] : '';
		
		$where=array();
		$like=array();
		if(!isNullOrEmpty($keywords)){
			$like=array($search=>$keywords);
			switch ($search){
				case 'Id':
				case 'userId':
					$where=$like;
					$like=array();
					break;
				case 'logTime':
					//$time=@time($keywords);
					break;
				default:
					break; 
			}
		}
		$order=$sortname.' '.$sortorder;
		$query=$this->Common_Model->get(($page-1)*$rp,$rp,$where,$like,$order);
		$total=$this->Common_Model->get_count($where,$like);
		
		$site_url=site_url();
		$log_type=config_item('log_type');
		
		header("Content-type: application/json");
		$jsonData = array('page'=>$page,'total'=>@$total,'rows'=>array());
		
		foreach($query AS $key=> $row){
			
			$deal='<a href="javascript:void(0);" class="btn btn-small btn-primary" onclick="deleteOne('.$row->Id.');">删除</a>';
			$entry = array('id'=>$row->Id,
					'cell'=>array(
							'logTime'=>date('Y-m-d H:i:s',$row->logTime),
							'Id'=>$row->Id,
							'logType'=>$log_type[$row->logType],
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
			    $del_where=array('Id'=>$Id);
				$result = $this->Common_Model->delete ( $del_where );
				if ($result) {
					$status = TRUE;
					$message = $title.'成功！';
				} else {
					$status = FALSE;
					$message = $title.'失败！';
				}
				$logType=0;
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
