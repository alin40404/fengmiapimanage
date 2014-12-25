<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Model extends CI_Model {

	var $table='admin';
	var $userName='';
	var $password='';
	var $data = array (
			'gId' => '0',
			'rId' => '0',
			'adminName' => '',
			'adminPwd' => '',
			'realName' => '',
			'sex' => '0',
			'phone' => '',
			'email' => '',
			'isChecked' => '1',
			'bak' => '',
			'power' => '',
			'loginTimes' => '0',
			'lastLoginIP' => '',
			'lastLoginTime' => '',
			'addUserId' => '0',
			'addTime' => '0',
	);
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_count($where=NULL,$like=NULL,$or_like=NULL){
		if(isNullOrEmpty($this->table)){return NULL;}
		if(!isNullOrEmpty($where)){
			if(is_array($where)){
				foreach($where as $key=>$value){
					$this->db->where($key, $value);
				}
			}
		}
		if(!isNullOrEmpty($like)){
			if(is_array($like)){
				foreach($like as $key=>$value){
					$this->db->like($key, $value);
				}
				if(!isNullOrEmpty($or_like)){
					if(is_array($or_like)){
						foreach($or_like as $key=>$value){
							$this->db->or_like($key, $value);
						}
				
					}
				}
			}
		}
		$this->db->from($this->table);
		$count=$this->db->count_all_results();
		return $count;
	}
	function get($offset=0,$num=10,$where=NULL,$like=NULL,$order=NULL,$select=NULL){
		if(isNullOrEmpty($this->table)){return NULL;}
		$offset=is_numeric($offset)?$offset:0;$offset=($offset<0)?0:$offset;
		if(is_numeric($num)){
			$num=$num<1?10:$num;
		}else{
			$num=10;
		}
		if(!isNullOrEmpty($where)){
			if(is_array($where)){
				foreach($where as $key=>$value){
					$this->db->where($key, $value);
				}
			}
		}
		
		if(!isNullOrEmpty($like)){
			if(is_array($like)){
				foreach($like as $key=>$value){
					$this->db->like($key, $value);
				}
			}
		}
		
		if(!isNullOrEmpty($order)){
			if(is_array($order)){
				foreach ($order as $key=>$value){
					$this->db->order_by($key,$value);
				}
			}else if(is_string($order)){
				$this->db->order_by($order);
			}
		}
		if(!isNullOrEmpty($select)){
			if(is_array($select)){
				$str='';
				foreach($select as $value){
					$str.=",".$value;
				}
				$str=trim($str,',');
				$this->db->select($str);
			}else if(is_string($select)){
				$this->db->select($select);
			}
		}
		
		$query = $this->db->get($this->table, $num,$offset);
		return $query->result();
	}
	function get_last_Num($num=1,$where=NULL,$like=NULL,$order=NULL,$select=NULL)
	{
		if(isNullOrEmpty($this->table)){return NULL;}
		$num=(isNullOrEmpty($num))?1:$num;
		$query = $this->get(0,$num,$where,$like,$order,$select);
		return $query;
	}
	
	function insert($field=array())
	{
		if(isNullOrEmpty($this->table)){return NULL;}
		$field=array_merge($this->data,$field);
		if(isNullOrEmpty($field)){return NULL;}
		$result=$this->db->insert($this->table, $field);
		return $result;
	}
	
	function delete($where){
		if(is_array($where)){
			foreach ($where as $key=>$value){
				$this->db->where($key, $value);
			}
		}else{
			$this->db->where_in('id', $where);
		}
		$result=$this->db->delete($this->table);
		return $result;
	}
	
	function update($where,$field)
	{
		if(is_array($where)){
			foreach ($where as $key=>$value){
				$this->db->where($key, $value);
			}
		}else{
			$this->db->where_in ( 'id', $where );
		}
		$field=array_merge($this->data,$field);
		$result=$this->db->update ( $this->table, $field );
		return $result;
	}
}
