<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (! function_exists ( 'getStatInfo' )) {
	function getStatInfo(){
		$str=<<<HTML
			<div class="block span6">
				<div class="block-heading">
					<span class="block-icon pull-right"> <a href="#"
						class="demo-cancel-click" rel="tooltip" title="刷新"><i
							class="icon-refresh"></i></a>
					</span> <a href="#widget2container" data-toggle="collapse">统计信息</a>
				</div>
				<div id="widget2container" class="block-body collapse in">
					<{TABLE}>
				</div>
			</div>
HTML;
		$table='<table class="table list">
					<tbody>
						<tr>
							<td>
								<p>
									暂无
								</p>
							</td>
							<td>
								暂无
							</td>
						</tr>
					</tbody>
				</table>';
		
		$str=str_replace('<{TABLE}>', $table, $str);
		return $str;
	}
}


if (! function_exists ( 'getAdminNotice' )) {
	function getAdminNotice(){
		$loginStatus=session('loginStatus');
		$str='<div class="block span6">
					<a href="#client_news_container" class="block-heading"
						data-toggle="collapse">后台公告</a>
					<div id="client_news_container" class="block-body collapse in">
						<h2>公告</h2>
						<div class="alert  alert-'.$loginStatus['status'].'">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  '.$loginStatus['message'].'
						</div>
					</div>
				</div>';
		return $str;
	}
}


if (! function_exists ( 'geAdminBaseInfo' )) {
	function getServerInfo(){
		$server_softwore=$_SERVER['SERVER_SOFTWARE'];
		$server_name=$_SERVER['SERVER_NAME'];
		$server_addr=$_SERVER['SERVER_ADDR'];
		$remote_addr=$_SERVER['REMOTE_ADDR'];
		$server_port=$_SERVER['SERVER_PORT'];
		$doc_root=$_SERVER['DOCUMENT_ROOT'];
		$server_protocol=$_SERVER['SERVER_PROTOCOL'];
		$gateway_interface=$_SERVER['GATEWAY_INTERFACE'];
		$server_admin=$_SERVER['SERVER_ADMIN'];
		$request_time=$_SERVER['REQUEST_TIME'];$request_time=date('Y-m-d H:i:s',$request_time);
		$str='<div class="block span6">
						<a href="#serverInfowidget" class="block-heading" data-toggle="collapse">服务器信息<span
							class="label label-warning">+10</span></a>
						<div id="serverInfowidget" class="block-body collapse in">
							<table class="table">
							    <thead>
									<tr>
										<th>服务器版本：</th>
										<th>'.$server_softwore.'</th>
									</tr>
								</thead>
								<tbody>
									<tr class="info">
										<td>服务器：</td>
										<td>'.$server_name.'</td>
									</tr>
									<tr class="">
										<td>服务器IP地址：</td>
										<td>'.$server_addr.'</td>
									</tr>
									<tr class="info">
										<td>服务器端口：</td>
										<td>'.$server_port.'</td>
									</tr>
									<tr class="">
										<td>IP地址：</td>
										<td>'.$remote_addr.'</td>
									</tr>
									<tr class="info">
										<td>服务器文件路径：</td>
										<td>'.$doc_root.'</td>
									</tr>
									<tr class="">
										<td>服务器协议：</td>
										<td>'.$server_protocol.'</td>
									</tr>
								 	 <tr class="info">
										<td>服务器网关接口：</td>
										<td>'.$gateway_interface.'</td>
									</tr>
									<tr class="">
										<td>服务器管理员：</td>
										<td>'.$server_admin.'</td>
									</tr>
									<tr class="info">
										<td>服务器请求时间：</td>
										<td>'.$request_time.'</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>';
		return $str;
	}
}

if (! function_exists ( 'geAdminBaseInfo' )) {
	function geAdminBaseInfo(){
		$str=<<<HTML
				<div class="block span6">
					<a href="#baseInfowidget" class="block-heading" data-toggle="collapse">基本信息</a>
					<div id="baseInfowidget" class="block-body collapse in">
						<{TABLE}>
					</div>
				</div>
HTML;
		$adminId=session('adminId');
		$site_url=site_url();
		$logout=$site_url.'/admin/logout';
		if(!isNullOrEmpty($adminId)){
			$where=array();
			$like=array();//if(!isNullOrEmpty($keywords)){$like=array($search=>$keywords);}
			$order='';
			
			$CI =& get_instance();
			$CI->load->model('Common_Model');
			$CI->Common_Model->table='admin';
			
			$db_prefix=get_db_prefix();
			$table_admin=$db_prefix.($CI->Common_Model->table);
			$table_role=$db_prefix.'role';
			$table_group=$db_prefix.'group';
			$offset=0;$rp=1;
			
			$sql = 'SELECT a.Id,a.adminName,a.realName,a.sex,a.phone,a.email,a.loginTimes,a.lastLoginIP,a.lastLoginTime,g.gName,r.rName FROM '.$table_admin.' AS a LEFT JOIN '.$table_role.' AS r ON a.rId=r.Id LEFT JOIN '.$table_group.' AS g  ON r.gId = g.Id WHERE 1=1 and a.Id ='."'$adminId' ";
			$query=$CI->Common_Model->query($sql,$rp,$offset);
			if(!isNullOrEmpty($query)){
				$obj=$query[0];
				$adminId=$obj->Id;
				$adminName=$obj->adminName;
				$realName=$obj->realName;
				$arr_sex=config_item('sex');
				$sex=@$arr_sex[$obj->sex];
				$gName=$obj->gName;
				$rName=$obj->rName;
				$phone=$obj->phone;$email=$obj->email;
				$loginTimes=$obj->loginTimes;
				$loginTimes=is_numeric($loginTimes)?$loginTimes:1;
				
				$isFirstLogin=session('isFirstLogin');
				if(!isNullOrEmpty($isFirstLogin)){
					if($isFirstLogin){
						//$loginTimes++;
						$data=array();
						//$data['loginTimes']=$loginTimes;
						$data['lastLoginTime']=time();
						$data['lastLoginIP']=$_SERVER['REMOTE_ADDR'];;
						$result = $CI->Common_Model->update ($adminId, $data );
						session('isFirstLogin',FALSE);
					}
				}
				
				$lastLoginIP=@session('lastLoginIP');
				$lastLoginTime=@session('lastLoginTime');
				
				$table='<table class="table">
							<thead>
								<tr>
						            <th>管理员：</th>
									<th>
									<i class="icon-user"></i>&nbsp;<span class="label label-success">'.$adminName.'</span>&nbsp;
									<a href="'.$logout.'">退出登陆 </a>
									<a href="'.$site_url.'/adminUser/update/'.$adminId.'">修改个人资料</a>
									</th>
								</tr>
							</thead>
							<tbody>
							 <!--
								<tr class="info">
									<td>真实姓名：</td><td>'.$realName.'</td>
								</tr>
								<tr class="">
									<td>性别：</td><td>'.$sex.'</td>
								</tr>
								<tr class="info">
									<td>邮箱：</td><td>'.$email.'</td>
								</tr>
								<tr class="">
									<td>电话：</td><td>'.$phone.'</td>
								</tr>
							-->
								<tr class="info">
									<td>所属组 ：</td><td>'.$gName.'</td>
								</tr>
								<tr class="">
									<td>所属角色：</td><td>'.$rName.'</td>
								</tr>
								<tr class="info">
								 	<td>登陆次数：</td><td><span class="label label-info">'.$loginTimes.'次</span></td>
								</tr>
								<tr class="warning">
									<td>最后登陆时间：</td><td><span class="label label-warning">'.$lastLoginTime.'</span></td>
								</tr>
								<tr class="warning">
									<td>最后登录IP：</td><td><span class="label label-important">'.$lastLoginIP.'</span></td>
								</tr>
							</tbody>
						</table>';
				
			}else{
				$table='<span class="label label-warning">登陆失败！</span>请重新<a href="'.$logout.'">登录</a>';
			}
				
		}else{
			$table='<span class="label label-warning">登陆失败！</span>请重新<a href="'.$logout.'">登录</a>';
		}
		
		$str=str_replace('<{TABLE}>', $table, $str);
		return $str;
	}
}