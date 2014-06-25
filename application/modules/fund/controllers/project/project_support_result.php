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
			
			if(!empty($data['rs']['budget_other_type'])) {
				$tmp = explode(',', $data['rs']['budget_other_type']);
				unset($data['rs']['budget_other_type']);
				foreach($tmp as $key=>$item) {
					$item = trim($item);
					$data['rs']['budget_other_type'][$item] = $item;
				}
			}
		}
		
		$this->template->build('project/project_support_result/form', @$data);
	}
	
	function save() {
		if(!empty($_POST)) {
			
			//Setting value budget other_type
			if(!empty($_POST['budget_other_type'])) {
				$tmp = '';
				foreach($_POST['budget_other_type'] as $key=>$item) {
					if($key != 0) {
						$tmp .= ', ';
					}
					$tmp .= $item;
				}
				$_POST['budget_other_type'] = $tmp;
			}
			
			
			if(empty($_POST['child_checked'])) {
				$_POST['child_unit'] = $_POST['child_checked'] = '';
			}
			
			if(empty($_POST['family_checked'])) {
				$_POST['family_checked'] = $_POST['family_unit'] = '';
			}
			
			if(empty($_POST['officer_checked'])) {
				$_POST['officer_unit'] = $_POST['officer_checked'] = '';
			}
			
			if(empty($_POST['leader_checked'])) {
				$_POST['leader_unit'] = $_POST['leader_checked'] = '';
			}
			
			//Set project code 
			$province = $this->db->getOne("SELECT TITLE FROM fund_province WHERE ID = '".$_POST['province_id']."'");
			dbConvert($province);
			
			
			$tmp = $_POST['project_name'].'/'.$_POST['budget_year'].'/'.$province.'/';
				
			//Gen new project code
			if(empty($_POST['id'])) {
				$_POST['project_code'] = $this->gen_projectno($tmp);
				
			} else {
				$tmp3 = '';
				$tmp2 = explode('/', $_POST['project_code']);
				foreach($tmp2 as $key => $item) {
					if($key != (count($tmp2)-1)) {
						$tmp3 .= $item.'/';
					}
				}

				if($tmp3 != $tmp) {
					$_POST['project_code'] = $this->gen_projectno($tmp);
				}
				
			}

			$_POST['id'] = $this->project_support_result->save($_POST);

			//--Upload file field "project_attachment"
			if($_FILES['project_attachment']['error'] == 0 || $_FILES['project_pay_attachment']['error'] == 0) {
				$dir = 'uploads/fund/project/project_support_result/'.$_POST['id'].'/';
	
				if(!file_exists($dir)) {
					mkdir($dir);
				}
				
				$old_file = $this->project_support_result->select('project_attachment, project_pay_attachment')->get_row($_POST['id']);
				
				$field = 'project_attachment';
				if($_FILES[$field]['error'] == 0) {
					if(file_exists($dir)) {
						//--Gen filename
						$filename = uniqid().".".pathinfo($_FILES[$field]["name"], PATHINFO_EXTENSION);
						
						//--Upload file
						if(move_uploaded_file($_FILES[$field]['tmp_name'], $dir.$filename)) {
							$_POST[$field] = $filename;
							
							unlink($dir.$old_file[$field]);
						}
					}
				}
	
				$field = 'project_pay_attachment';
				if($_FILES[$field]['error'] == 0) {
					if(file_exists($dir)) {
						//--Gen filename
						$filename = uniqid().".".pathinfo($_FILES[$field]["name"], PATHINFO_EXTENSION);
						
						//--Upload file
						if(move_uploaded_file($_FILES[$field]['tmp_name'], $dir.$filename)) {
							$_POST[$field] = $filename;
							
							unlink($dir.$old_file[$field]);
						}
					}
				}
			}

			
			$this->project_support_result->save($_POST);
			
			set_notify('success', lang('save_data_complete'));
		}

		redirect('fund/project/project_support_result/');
	}

	function delete_file() {
		if(empty($_GET['id']) || empty($_GET['type'])) {
			set_notify('error', 'ไม่สามารถดำเนินการได้กรุณาตรวจสอบ');
			redirect('fund/project/project_support_result/');
		}
		
		$dir = 'uploads/fund/project/project_support_result/'.$_GET['id'].'/';
		$tmp = $this->project_support_result->get_row($_GET['id']);
		if(empty($tmp[$_GET['type']])) {
			set_notify('error', 'ไม่พบไฟล์กรุณาตรวจสอบ');
		} else {
			unlink($dir.$tmp[$_GET['type']]);
			$tmp[$_GET['type']] = '';
			$this->project_support_result->save($tmp);
			set_notify('error', lang('delete_data_complete'));
		}
		
		redirect('fund/project/project_support_result/form/'.$_GET['id']);
	}

	function delete($id = false) {
		if(!$id) {
			set_notify('error', 'ไม่สามารถดำเนินการได้');
			redirect('fund/project/project_support_result');
		}
		

		$tmp = $this->project_support_result->get_row($id);
		
		//Clear attachment files
		$dir = 'uploads/fund/project/project_support_result/'.$id.'/';

		if(!empty($tmp['project_attachment'])) {
			@unlink($dir.$tmp['project_attachment']);
		}
		
		if(!empty($tmp['project_pay_attachment'])) {
			@unlink($dir.$tmp['project_pay_attachment']);
		}
		
		rmdir($dir);

		$this->project_support_result->delete($id);
		
		set_notify('success', lang('delete_data_complete'));
		redirect('fund/project/project_support_result/');
	}

	function gen_projectno($project_code) {
		$tmp = $this->project_support_result->get("SELECT PROJECT_CODE FROM FUND_project_support_result WHERE PROJECT_CODE LIKE '".$project_code."%' ORDER BY PROJECT_CODE DESC");
		$tmp = @$tmp[0]['project_code'];
		
		if(empty($tmp)) {
			$project_code .= '0001';
		} else {
			$tmp2 = explode('/', $tmp);
			$project_code .= substr('000'.(($tmp2[(count($tmp2)-1)]*1)+1), -4,4);
		}
		
		return $project_code;
	}
	
}
