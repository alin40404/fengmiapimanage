<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public $module='home';
	public $cateId='';
	public $Id='';
	public $currLang='';
	public function __construct(){
		parent::__construct();
		
		$lang=@session('lang');
		if(isNullOrEmpty($lang)){
			$lang=config_item('language');
			session('lang',$lang);
			$this->currLang=$lang;
		}else{
			$this->currLang=$lang;
		}
		
		$arr_get=$this->input->get();
		$arr_get=setForm($arr_get);
		
		if(!isNullOrEmpty($arr_get)){
			$cateId=@$arr_get['cateId'];
			$Id=@$arr_get['Id'];
			$lang=@$arr_get['lang'];
			
			$this->cateId=$cateId;
			$this->Id=$Id;
			
			if(!isNullOrEmpty($lang)){
				$arr_lang=config_item('lang');
				$temp=@$arr_lang[$lang];
				if(isNullOrEmpty($temp)){
					$lang=config_item('language');
				}
				session('lang',$lang);
				$this->currLang=$lang;
			}else{
				$lang=$this->currLang;
			}
			
/* 			if(isNullOrEmpty($cateId)){
				show_404();
			}else if(!is_numeric($cateId)){
				show_404();
			}else{
				$this->cateId=$cateId;
				$this->Id=$Id;
			} */
		}

		$this->lang->load('front_common', $lang);
		$this->load->helper('home_helper');
	}
	
	public function index()
	{	
		$lang=$this->currLang;
		$config_cateId=array('zh_cn'=>1,
				'english'=>30);
		
		// $cateId=$config_cateId[$lang];
		// $this->cateId=$cateId;
		
		$module=$this->module;
		$cateId=$this->cateId;
		
		$this->load->library('encrypt');
		
		
		$title=get_website_title($cateId);
		
		$data_header['cateId']=$cateId;
		$data_header['title']=$title;
		$data_header['lang']=$lang;
		
		$data['cateId']=$cateId;
		$data['lang']=$lang;
		
		$data_footer['cateId']=$cateId;
		$data_footer['lang']=$lang;
		
		$data = array_merge($data,$data_header);
		
		//$this->load->view('homeCommon/header',@$data_header);
		$this->load->view ( $module.'/index',@$data);
		//$this->load->view('homeCommon/footer',@$data_footer);
	}

}

