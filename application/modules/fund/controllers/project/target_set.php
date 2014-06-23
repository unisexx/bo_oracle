<?php
/**
 * Support Project
 * กองทุนเด็กรายโครงการ
 */
class target_set extends Fund_Controller {
	
	function __construct() {
		parent::__construct();
		
		$this->load->model('fund_project_target_set_model', 'target_set');
	}
	
	public function index() {
		$where = '1=1 ';
			if(!empty($_GET['keyword'])) { $where .= "AND TITLE LIKE '%".$_GET['keyword']."%'"; }
		
		$data['items'] = $this->target_set->where($where)->get();
		$data['pagination'] = $this->target_set->pagination;
		
		$_GET['page'] = (empty($_GET['page']))?0:$_GET['page']-1;
		$data['no'] = $_GET['page']*20;
		
		$this->template->build("project/target_set/index", @$data);
	}
	
	
	public function form($id=false) {
		if($id) {
			$data['rs'] = $this->target_set->get_row($id);
		} else {
			$data['rs']['status'] = 1;
		}
		
		$this->template->build('project/target_set/form', @$data);
	}
	
	function save() {
		if($_POST) {
			$_POST['status'] = (empty($_POST['status']))?0:$_POST['status'];
			$this->target_set->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		
		redirect('fund/project/target_set');
	}
	
	function delete($id = false) {
		if($id) {
			$this->target_set->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		
		redirect('fund/project/target_set');
	}
}
