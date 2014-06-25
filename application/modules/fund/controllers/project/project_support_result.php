<?php
/**
 * project_support_result Project
 * กองทุนเด็กรายโครงการ
 */
class project_support_result extends Fund_Controller {
	
	function __construct() {
		parent::__construct();
		
		$this->load->model('fund_project_support_model', 'project_support');
		$this->load->model('fund_project_support_result_model', 'project_support_result');
	}
	
	function index(){
		$data['items'] = $this->project_support->get();
		$data['pagination'] = $this->project_support->pagination();
		$data['no'] = (empty($_GET['page']))?0:($_GET['page']-1)*20;

		$this->template->build('project/project_support_result/index', @$data);
	}
	
	function form($id = false) {
		if($id) {
			$data['rs'] = $this->project_support->get_row($id);
			
			$sql_result_1 = "select * from fund_project_support_result where fund_project_support_id = '".$data['rs']['id']."' and result_type = '1'  order by time asc "; 
			$data['rs_result_1'] = $this->project_support_result->get($sql_result_1,true);
			
			$sql_result_2 = "select * from fund_project_support_result where fund_project_support_id = '".$data['rs']['id']."' and result_type = '2' order by time asc "; 
			$data['rs_result_2'] = $this->project_support_result->get($sql_result_2,true);
			
			$sql_result_3 = "select * from fund_project_support_result where fund_project_support_id = '".$data['rs']['id']."' and result_type = '3' order by time asc "; 
			$data['rs_result_3'] = $this->project_support_result->get($sql_result_3,true);
		}
		
		$this->template->build('project/project_support_result/form', @$data);
	}
	
	function save() {
		if(!empty($_POST)) {
			$update_project['id'] = $_POST['id'];
			$update_project['allocate_type'] = $_POST['allocate_type'];
			$this->project_support->save($update_project);
			set_notify('success', lang('save_data_complete'));
		}

		redirect('fund/project/project_support_result/');
	}

	function delete($id = false ,$project_id = false) {
		if(!$id) {
			set_notify('error', 'ไม่สามารถดำเนินการได้');
			redirect('fund/project/project_support_result');
		}

		$this->project_support_result->delete($id);
		
		set_notify('success', lang('delete_data_complete'));
		redirect('fund/project/project_support_result/form/'.$project_id);
	}
	
	function subform($id = false, $type = false, $budget = false) {
		if ($type) {
			$data['id'] = $id;
			$data['type'] = $type;
			$data['budget'] = $budget;
				$this->load->view('project/project_support_result/allocate_type.php', @$data);
		} 
	}
	
	function save_subform(){
		if ($_POST) {
			if ($_POST['date_appoved'] != ''){
				$_POST['date_appoved'] = date_to_mysql($_POST['date_appoved']);
			}

				if ($_POST['appoved_id'] == '2') {
					$_POST['note'] = $_POST['note2'];
				} else if ($_POST['appoved_id'] == '3') {
					$_POST['note'] = $_POST['note3'];
				} else if ($_POST['appoved_id'] == '4' && $_POST['sub_appoved_id'] == '4') {
					$_POST['sub_appoved_id'] = $_POST['sub_appoved_id_4'];
					$_POST['note'] = $_POST['note4'];
				} else if ($_POST['appoved_id'] == '4') {
					$_POST['sub_appoved_id'] = $_POST['sub_appoved_id_4'];
				} else if ($_POST['appoved_id'] == '5') {
					$_POST['sub_appoved_id'] = $_POST['sub_appoved_id_5'];
				}
				
				if ($_POST['appoved_id'] != '1') {
					$_POST['appoved_bydget'] = '';
				}
				
				if ($_POST['result_type'] == '3' && $_POST['appoved_id'] == '1') {
					$update_project['id'] = $_POST['fund_project_support_id'];
					$update_project['allocate_type'] = '1';
					$this->project_support->save($update_project);
				}
				
			$this->project_support_result->save($_POST);
		}
		
		if (@$_POST['fund_project_support_id'] != '') {
			set_notify('success', lang('delete_data_complete'));
			redirect('fund/project/project_support_result/form/'.@$_POST['fund_project_support_id']);
		} else {
			set_notify('error', "การเข้าถึงข้อมูลผิดพลาด");
			redirect('fund/project/project_support_result/');
		}
		
	}
}
