<?php
/**
 * Support Project
 * กองทุนเด็กรายโครงการ
 */
class list_request extends Fund_Controller {
	
	function __construct() {
		parent::__construct();
		
		$this->load->model('fund_project_list_request_model', 'list_request');
		#$this->load->model('fund_project_direction_set_model', 'list_request');
	}
	
	public function index() {
		$where = '1=1 ';
			if(!empty($_GET['keyword'])) { $where .= "AND TITLE LIKE '%".$_GET['keyword']."%'"; }
		
		$data['items'] = $this->list_request->where($where)->get();
		$data['pagination'] = $this->list_request->pagination;
		
		$_GET['page'] = (empty($_GET['page']))?0:$_GET['page']-1;
		$data['no'] = $_GET['page']*20;
		
		$this->template->build("project/list_request/index", @$data);
	}
	
	
	public function form($id=false) {
		if($id) {
			$data['rs'] = $this->list_request->get_row($id);
		} else {
			$data['rs']['status'] = 1;
		}
		
		$this->template->build('project/list_request/form', @$data);
	}
	
	function save() {
		if($_POST) {
			$_POST['status'] = (empty($_POST['status']))?0:$_POST['status'];
			$this->list_request->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		
		redirect('fund/project/list_request');
	}
	
	function delete($id = false) {
		if($id) {
			$this->list_request->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		
		redirect('fund/project/list_request');
	}
}
