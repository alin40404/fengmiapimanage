<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once 'CommonCate.php';

class AdminGroup extends CommonCate{
	public $module='adminGroup';
	public function __construct(){
		parent::__construct();
	}

	/*
	public function index(){
		parent::index();
	}
	
	public function lists(){
		parent::lists();
	}

	public function listsJson(){
		parent::listsJson();
	}
	
	public function add(){
		parent::add();
	}
	
	public function deal(){
		parent::deal();
	}
	
	public function update($Id=''){
		parent::update($Id);
	}
	
	public function delete(){
		parent::delete();
	}
	*/
}
