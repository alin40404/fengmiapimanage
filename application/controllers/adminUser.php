<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminUser extends CI_Controller{
	public $module='adminUser';
	public function __construct(){
		parent::__construct();
		checkLogin();
// 		$nav_power=array('module'=>$this->module,'action'=>'lists');
// 		$moduleMsg='管理员';
// 		checkPower($nav_power,$moduleMsg);
		
		$this->load->model('Common_Model');
		$this->Common_Model->table='admin';
	}

	public function index(){
		$module=$this->module;
		$arrLang=lang('common_'.$module);
		$title=$arrLang['title'];
		
		$nav_power=array('module'=>$this->module,'action'=>'lists');
		checkPower($nav_power,$title);
		
		
		$data_header['title']=$title;
		//$config_sideNavBar=$this->config->item('sideNavBar');
		$data_header['sideNavBar']=get_side_navbar($module,'index');
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
		[ {display : 'ID',
			                    name : 'Id',
			                    width : 90,
			                    sortable : true,
			                    align : 'center'
			                    }, {
			                        display : '管理员帐号',
			                        name : 'adminName',
			                        width : 120,
			                        sortable : true,
			                        align : 'center'
			                    }, {
			                        display : '所属管理组',
			                        name : 'gName',
			                        width : 120,
			                        sortable : true,
			                        align : 'center'
			                    }, {
			                        display : '所属角色',
			                        name : 'rName',
			                        width : 80,
			                        sortable : true,
			                        align : 'center',
			                    }, {
			                        display : '真实姓名',
			                        name : 'realName',
			                        width : 80,
			                        sortable : true,
			                        align : 'center'
			                }, {
			                        display : '性别',
			                        name : 'sex',
			                        width : 50,
			                        sortable : false,
			                        align : 'center'
			                }, {
			                        display : '手机号码',
			                        name : 'phone',
			                        width : 150,
			                        sortable : true,
			                        align : 'center'
			                },{
		                        display : '邮箱地址',
		                        name : 'email',
		                        width : 150,
		                        sortable : true,
		                        align : 'center'
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
                    display : '真实姓名',
                    name : 'realName'
                    }, {
                        display : '帐号',
                        name : 'adminName',
                        isdefault : true,
				} ]
HTML;
		$flexigridData= array (
				'url' => $jsonUrl,
				'colModel' => $colModel,
				'searchitems' => $searchitems,
				'sortname' => 'Id',
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
		
		$adminUser=session('adminUser');
		
		$where=array('adminName !='=> $adminUser);
		
		$like=array();//if(!isNullOrEmpty($keywords)){$like=array($search=>$keywords);}
		$order=$sortname.' '.$sortorder;
		
		$subclass_prefix=strtolower(config_item('subclass_prefix'));
		$table_admin=$subclass_prefix.($this->Common_Model->table);
		$table_role=$subclass_prefix.'role';
		$table_group=$subclass_prefix.'common_cate';
		
		$sql = 'SELECT a.Id,a.adminName,a.realName,a.sex,a.phone,a.email,g.cateName as gName,r.rName FROM '.$table_admin.' AS a LEFT JOIN '.$table_role.' AS r ON a.rId=r.Id LEFT JOIN '.$table_group.' AS g  ON r.gId = g.Id WHERE 1=1 and a.adminName !='." '$adminUser' ";
		
		if(!isNullOrEmpty($keywords)){
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
// 		var_dump($_SESSION);exit;
		$query=$this->Common_Model->query($sql,$rp,$offset);
		
		$site_url=site_url();
		$arr_sex=config_item('sex');
		$jsonData = array('page'=>$page,'total'=>@$total,'rows'=>array());
		foreach($query AS $key=> $row){
			$deal='<a href="javascript:void(0);" class="btn btn-small btn-primary" onclick="deleteOne('.$row->Id.');">删除</a> <a class="btn btn-small " href="'.$site_url.'/'.$this->module.'/update/'.$row->Id.'">修改</a>';
			$entry = array('id'=>$row->Id,
					'cell'=>array(
							'Id'=>$row->Id,
							'gName'=>$row->gName,
							'rName'=>$row->rName,
							'adminName'=>$row->adminName,
							'realName'=>$row->realName,
							'sex'=>$arr_sex[$row->sex],
							'phone'=>$row->phone,
							'email'=>$row->email,
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
// 		$this->load->config('config_power');
		$config_power=$this->config->item('power');
		
		$formEle['power']='';//get_power_html($config_power);
		
		$formEle['forPlugin']='adminGroup';
		$formEle['lang']=$lang;
		
		$obj=array('orderNum'=>0);
		$formEle['obj']=$obj;
		$formEle['action']=$action;
		
		$formTable=$this->load->view ( $module.'/form',$formEle,true);
		$data['formTable']=$formTable;
		$this->load->view('common/header',$data_header);
		$this->load->view('common/add',$data);
		$this->load->view ( 'common/footer' );
	}
	public function deal(){
		// 处理表单
		if (! isPost ()) {
			$msg='输入的链接不正确！';
			showErrorMsg($msg);
		}
		$this->load->library('encrypt');
		
		$arr_post=$this->input->post();
		$arr_post=setForm($arr_post);
		$Id=@$arr_post['Id'];
		
		unset($arr_post['Id']);
		unset($arr_post['adminPwd_re']);
		//$nopassword=config_item('no_password');
		
		$adminPwd=@$arr_post['adminPwd'];
		if(!isNullOrEmpty($adminPwd)){
			$adminPwd=$this->encrypt->encode($adminPwd);
			$arr_post['adminPwd']=$adminPwd;
		}else if(isNullOrEmpty($Id)){
			$adminPwd=config_item('default_password');
			$adminPwd=$this->encrypt->encode($adminPwd);//加密
			$arr_post['adminPwd']=$adminPwd;
		}
		
		$adminName=@$arr_post['adminName'];
		if(!isNullOrEmpty($adminName)){
			$query=$this->Common_Model->get_last_Num(1,array('adminName'=>$adminName));
		}else{
			$query=array();
		}
		
		$redirect='';
		
		$module=$this->module;
		$arrLang=lang('common_'.$module);
		$logType=0;
		
		if (isNullOrEmpty ( $Id )) { // 添加
			$action='add';
			$title=$arrLang[$action];
				
			if (!isNullOrEmpty ( $query )) {
				$msg = $title.'失败,管理员帐号已存在！';
				$icon = "error";
			}else{
				
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
			}
		}else{
			
			$action='update';
			$title=$arrLang[$action];
			
			if (!isNullOrEmpty ( $query )) {
				$obj=$query[0];
				$db_adminId=$obj->Id;
				if($db_adminId !=$Id){
					$msg = $title.'失败,管理员帐号已存在！';
					$icon = "error";
				}else{
					$result = $this->Common_Model->update ($Id, $arr_post );
					if ($result) {
						$msg = $title.'成功！';
						$icon = "succeed";
						$str_power=@$arr_post['power'];
						if(!isNullOrEmpty($str_power)){
							if(operatePowerCacheFile('delete','',$adminName)){
								$str_power=$this->encrypt->encode($str_power);//加密
								operatePowerCacheFile('write',$str_power,$adminName);
							}
						}
					} else {
						$msg = $title.'失败！';
						$icon = "error";
					}
				}
			}else{
				
				$result = $this->Common_Model->update ($Id, $arr_post );

				if ($result) {
					$msg = $title.'成功！';
					$icon = "succeed";
					if($Id==session('adminId')){
						writeLog($msg.'修改了用户名!',$logType);
						$msg = $title.'成功！你已修改用户名，请重新登录！';
						$redirect=site_url().'/admin/logout';
					}
				} else {
					$msg = $title.'失败！';
					$icon = "error";
				}
			}
		}
		
		writeLog($msg,$logType);
		
		showDialog ( $msg, NULL, 3000, $icon,$redirect );
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
			$msg = $title.'不存在或已删除！';
			showErrorMsg($msg);
		}
		
		$obj=$query[0];
		$formEle['obj']=$obj;
// 		header("Content-type: text/html;charset=utf-8");
// 		var_dump($obj);exit;

		$data_header['title']=$title;
		//$config_sideNavBar=$this->config->item('sideNavBar');
		$data_header['sideNavBar']=get_side_navbar($module);
		$lang=$this->config->item("language");
		$base_url=$this->config->base_url ();
		$site_url = site_url ();
		$data ['lang'] = $lang;
		$data ['title'] = $arrLang ['title'];
		$data ['barTitle'] = $title;
		$data ['base_url'] = $base_url;
		$data ['add_url'] = $site_url . '/' . $module . '/add';
		$data['lists_url']=$site_url.'/'.$module.'/index';
		$formEle['dealUrl']=$site_url.'/'.$module.'/deal';
		
		$config_power=$this->config->item('power');
		$isDisabledCB=TRUE;
		
		$rId=$obj->rId;
		$table=$this->Common_Model->table;
		$this->Common_Model->table='role';
		$where=array('Id'=>$rId);
		$query=$this->Common_Model->get_last_Num(1,$where);
		
		$obj_role=@$query[0];
		$str_power=@$obj_role->power;
		
		$this->Common_Model->table=$table;
		
		$formEle['power']=get_power_html($config_power,$str_power,$isDisabledCB);
		
		$formEle['forPlugin']='adminGroup';
		$formEle['lang']=$lang;
		
		$nopassword='';//config_item('no_password');
		$formEle['nopassword']=$nopassword;
		
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
				$where=array('id'=>$Id);
				$query=$this->Common_Model->get_last_Num(1,$where);
				if (!isNullOrEmpty ( $query )) {
					$obj=$query[0];
					$db_adminUser=$obj->adminName;
					$adminUser=session('adminUser');
					if($db_adminUser==$adminUser){
						$status = FALSE;
						$message =   $title.'失败,不能删除自身！';
						$logType=3;
					}else{
						$del_where=array('Id'=>$Id);
						$result = $this->Common_Model->delete ( $del_where );
						if ($result) {
							$status = TRUE;
							$message =  $title.'成功！';
						} else {
							$status = FALSE;
							$message =  $title.'失败！';
						}
						$logType=0;
					}
				} else {
					$status = FALSE;
					$message = '管理员不存在或已删除！';
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
	
	public function info(){
		
		$module=$this->module;
		$action='info';
		$arrLang=lang('common_'.$module);
		$title=$arrLang[$action];
		
		$Id=session('adminId');

		$query=$this->Common_Model->get_last_Num(1,array('id'=>$Id));
		
		if (isNullOrEmpty ( $query )) {
			$msg = '信息不存在或已删除！';
			showErrorMsg($msg);
		}
		
		$obj=$query[0];
		$formEle['obj']=$obj;
		
		$data_header['title']=$title;
		//$config_sideNavBar=$this->config->item('sideNavBar');
		$data_header['sideNavBar']=get_side_navbar($module,$action);
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
		$formEle['baseModuleUrl']=$site_url.'/'.$module;
		
		$formEle[$action]='active';
		
		$formTable=$this->load->view ( $module.'/infoForm',$formEle,true);
		$data['formTable']=$formTable;
		$this->load->view('common/header',$data_header);
		$this->load->view($module.'/info',$data);
		$this->load->view('common/footer');
	}
	public function updatePwd() {
		$module = $this->module;
		$action = 'updatePwd';
		$arrLang = lang ( 'common_' . $module );
		$title = $arrLang [$action];
		
		$Id = session ( 'adminId' );
		
		$query = $this->Common_Model->get_last_Num ( 1, array (
				'id' => $Id 
		) );
		
		if (isNullOrEmpty ( $query )) {
			$msg = '信息不存在或已删除！';
			showErrorMsg ( $msg );
		}
	
		$obj=$query[0];
		$formEle['obj']=$obj;
	
		$data_header['title']=$title;
		//$config_sideNavBar=$this->config->item('sideNavBar');
		$data_header['sideNavBar']=get_side_navbar($module,$action);
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
		$formEle['baseModuleUrl']=$site_url.'/'.$module;
		$formEle[$action]='active';
	
		$formTable=$this->load->view ( $module.'/infoForm',$formEle,true);
		$data['formTable']=$formTable;
		$this->load->view('common/header',$data_header);
		$this->load->view($module.'/info',$data);
		$this->load->view('common/footer');
	}
	public function dealnfo() {
		// 处理表单
		if (! isPost ()) {
			$msg = '输入的链接不正确！';
			showErrorMsg ( $msg );
		}
		$this->load->library ( 'encrypt' );
	
		$arr_post = $this->input->post ();
		$arr_post = setForm ( $arr_post );
	
		unset ( $arr_post ['Id'] );
		unset ( $arr_post ['adminName'] );
		
		//var_dump($arr_post);exit;
		$Id = @session ( 'adminId' );
	
		if (! isNullOrEmpty ( $Id )) {
			$query = $this->Common_Model->get_last_Num ( 1, array (
					'Id' => $Id
			) );
		} else {
			$query = array ();
		}
	
		$redirect = '';
	
		$module = $this->module;
		$arrLang = lang ( 'common_' . $module );
		$logType = 0;
	
		$action = 'info';
		$title = $arrLang [$action];
		$title.="修改";
		if (! isNullOrEmpty ( $query )) {
			$result = $this->Common_Model->update ( $Id, $arr_post );
			if ($result) {
				$msg = $title . '成功！';
				$icon = "succeed";
			} else {
				$msg = $title . '失败！';
				$icon = "error";
			}
		} else {
			$msg = $title . '失败！';
			$icon = "error";
		}
	
	
		writeLog ( $msg, $logType );
	
		showDialog ( $msg, NULL, 3000, $icon, $redirect );
		exit ();
	}
	public function dealPwd() {
		// 处理表单
		if (! isPost ()) {
			$msg = '输入的链接不正确！';
			showErrorMsg ( $msg );
		}
		$this->load->library ( 'encrypt' );
		
		$arr_post = $this->input->post ();
		$arr_post = setForm ( $arr_post );
		
		$oldPassword = @$arr_post ['oldPassword'];
		
		unset ( $arr_post ['Id'] );
		unset ( $arr_post ['oldPassword'] );
		unset ( $arr_post ['adminPwd_re'] );
		
		$Id = @session ( 'adminId' );
		$adminPwd = @$arr_post ['adminPwd'];
		
		if (! isNullOrEmpty ( $adminPwd )) {
			$adminPwd = $this->encrypt->encode ( $adminPwd );
			$arr_post ['adminPwd'] = $adminPwd;
		} else {
			$adminPwd = config_item ( 'default_password' );
			$adminPwd = $this->encrypt->encode ( $adminPwd ); // 加密
			$arr_post ['adminPwd'] = $adminPwd;
		}
		
		if (! isNullOrEmpty ( $Id )) {
			$query = $this->Common_Model->get_last_Num ( 1, array (
					'Id' => $Id 
			) );
		} else {
			$query = array ();
		}
		
		$redirect = '';
		
		$module = $this->module;
		$arrLang = lang ( 'common_' . $module );
		$logType = 0;
		
		$action = 'updatePwd';
		$title = $arrLang [$action];
		if (! isNullOrEmpty ( $query )) {
			$obj = $query [0];
			$db_password = $this->encrypt->decode ( $obj->adminPwd );
			if ($oldPassword !== $db_password) { // 密码错误
				$msg = '原密码错误';
				$icon = "error";
			} else {
				$result = $this->Common_Model->update ( $Id, $arr_post );
				if ($result) {
					$msg = $title . '成功！';
					$icon = "succeed";
				} else {
					$msg = $title . '失败！';
					$icon = "error";
				}
			}
		} else {
			$msg = $title . '失败！';
			$icon = "error";
		}
		
		
		writeLog ( $msg, $logType );
		
		showDialog ( $msg, NULL, 3000, $icon, $redirect );
		exit ();
	}
	
}
