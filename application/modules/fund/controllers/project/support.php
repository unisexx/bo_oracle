<?php
/**
 * Support Project
 * กองทุนเด็กรายโครงการ
 */
class Support extends Fund_Controller {
	
	function __construct() {
		parent::__construct();
		
		$this->load->model('fund_project_support_model', 'project_support');
	}
	
	function index(){
		$data['items'] = $this->project_support->get();
		$data['pagination'] = $this->project_support->pagination();
		$data['no'] = (empty($_GET['page']))?0:($_GET['page']-1)*20;

		$this->template->build('project/support/index', @$data);
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
		
		$this->template->build('project/support/form', @$data);
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
			$province = $this->db->getOne("SELECT TITLE FROM CNF_PROVINCE WHERE ID = '".$_POST['province_id']."'");
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
				
			$this->project_support->save($_POST);
			
			set_notify('success', 'บันทึกข้อมูลเสร็จสิ้น');
		}

		redirect('fund/project/support/');
	}



	function gen_projectno($project_code) {
		$tmp = $this->project_support->get("SELECT PROJECT_CODE FROM FUND_PROJECT_SUPPORT WHERE PROJECT_CODE LIKE '".$project_code."%' ORDER BY PROJECT_CODE DESC");
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
