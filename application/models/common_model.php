<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_Model extends CI_Model {

	public $table='';
	public $data = array ();
	
	function __construct()
	{
		parent::__construct();
	}
	function query($sql=NULL,$num=10,$offset=0){
		if(isNullOrEmpty($sql)){return NULL;};
		$num=is_numeric($num)?$num:10;$num=($num<1)?10:$num;
		$offset=is_numeric($offset)?$offset:0;$offset=($offset<0)?0:$offset;
		$sql.=" LIMIT $offset, $num ";
		$query=$this->db->query($sql);
		$result=$query->result();
		return $result;
	}
	function get_count($where=NULL,$like=NULL,$or_like=NULL){
		if(isNullOrEmpty($this->table)){return NULL;}
		if(!isNullOrEmpty($where)){
			if(is_array($where)){
				foreach($where as $key=>$value){
				if(is_array($value)){
						$this->db->where_in($key, @$value[0]);
					}else{
						$this->db->where($key, $value);
					}
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
					if(is_array($value)){
						$this->db->where_in($key, $value);
					}else{
						$this->db->where($key, $value);
					}
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
	
	function insertBackId($field=array())
	{
		if(isNullOrEmpty($this->table)){return NULL;}
		$field=array_merge($this->data,$field);
		if(isNullOrEmpty($field)){return NULL;}
		$result=$this->db->insert($this->table, $field);
		$id=(mysql_insert_id());
		
		$result=$id;
		
		return $result;
	}
	
	function delete($where){
		if(is_array($where)){
			foreach ($where as $key=>$value){
				if (is_array ( $value )) {
					$this->db->where_in ( $key, $value );
				} else {
					$this->db->where ( $key, $value );
				}
			}
		}else{
			if(is_numeric(strpos($where, ','))){
				$where=explode(',', $where);
			}else{
				$where=array($where);
			}
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

