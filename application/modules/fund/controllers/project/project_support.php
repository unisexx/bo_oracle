<?php
/**
 * project_support Project
 * กองทุนเด็กรายโครงการ
 */
class project_support extends Fund_Controller {
	
	function __construct() {
		parent::__construct();
		
		$this->load->model('fund_project_support_model', 'project_support');
		$this->load->model('fund_attach_model', 'fund_attach');
	}
	
	function index(){
		$sql = "select * from fund_project_support where 1=1 ";
		if (!empty($_GET['keyword'])) {
			$sql .= " and ( project_code like '%".$_GET['keyword']."%' or project_name like '%".$_GET['keyword']."%' or organization like '%".$_GET['keyword']."%' ) ";
		}
		$data['items'] = $this->project_support->get($sql);
		$data['pagination'] = $this->project_support->pagination();
		$data['no'] = (empty($_GET['page']))?0:($_GET['page']-1)*20;

		$this->template->build('project/project_support/index', @$data);
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

			//--Attach files
			$data['attach_file'] = $this->fund_attach->select('id, attach_name')->where("module = 'project_support_attach' and module_id = '".$id."'")->get(false, true);
			//--Attach pay files
			$data['attach_file_pay'] = $this->fund_attach->select('id, attach_name')->where("module = 'project_support_attach_pay' and module_id = '".$id."'")->get(false, true);
		}

		if(!empty($data['rs']['receive_date'])) {
			$data['rs']['receive_date'] = @db2date($data['rs']['receive_date'], 'datepicker');
		}
		
		if(!empty($data['rs']['center_receive_date'])) {
			$data['rs']['center_receive_date'] = @db2date($data['rs']['center_receive_date'], 'datepicker');
		}
		
		
		if(!empty($rs['center_receive_date'])) {
			 $this->template->build('project/project_support/form', @$data);
		} else {
			$this->template->build('project/project_support/viewer', @$data);
		}
		
	}
		function file_delete($id = false) {
			if(!$id) { return false; }
			
			
			$tmp = $this->fund_attach->get_row($id);
			$dir = 'uploads/fund/project/project_support/'.$tmp['attach_name'];
			
			if(file_exists($dir)) {
				unlink($dir);
			}
			
			$this->fund_attach->delete($id);
		}

		function file_download($id = false) {
			if(!$id) { return false; }
			$dir = 'uploads/';
			$module_dir = array(
				'project_support_attach' => 'fund/project/project_support'
			);

			$tmp = $this->fund_attach->select('attach_name, module')->get_row($id);
			$dir .= $module_dir[$tmp['module']];
			
			
			output_file($dir.'/'.$tmp['attach_name'], $tmp['attach_name']);
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
			
			
			if(!empty($_POST['center_receive_date'])) {
				$tmp = explode('-', $_POST['center_receive_date']);
				$_POST['center_receive_date'] = ($tmp[2]-543).'-'.$tmp[1].'-'.$tmp[0];
			}

			if(!empty($_POST['receive_date'])) {
				$tmp = explode('-', $_POST['receive_date']);
				$_POST['receive_date'] = ($tmp[2]-543).'-'.$tmp[1].'-'.$tmp[0];
			}
				
				
			$_POST['id'] = $this->project_support->save($_POST);


			//-- Upload file 'project_support_attach'
			if(!empty($_FILES['attach_file'])) {
				$dir_ = 'uploads/fund/project/project_support/';
				$data = array( 'module'=>'project_support_attach', 'module_id'=>$_POST['id'] );
				
				for($i=0; $i<count($_FILES['attach_file']['tmp_name']); $i++) {
					$file_title = strtolower(uniqid().".".pathinfo($_FILES["attach_file"]["name"][$i], PATHINFO_EXTENSION));
					$data['attach_name'] = $file_title;
					
					$this->fund_attach->save($data);
					move_uploaded_file($_FILES['attach_file']['tmp_name'][$i], $dir_.$file_title);
				}
			}
			
			//-- Upload file 'project_support_attach_pay'
			if(!empty($_FILES['attach_file_pay'])) {
				$dir_ = 'uploads/fund/project/project_support/';
				$data = array( 'module'=>'project_support_attach_pay', 'module_id'=>$_POST['id'] );

				for($i=0; $i<count($_FILES['attach_file_pay']['tmp_name']); $i++) {
					$file_title = strtolower(uniqid().".".pathinfo($_FILES["attach_file_pay"]["name"][$i], PATHINFO_EXTENSION));
					$data['attach_name'] = $file_title;
					
					$this->fund_attach->save($data);
					move_uploaded_file($_FILES['attach_file_pay']['tmp_name'][$i], $dir_.$file_title);
				}
			}

			set_notify('success', lang('save_data_complete'));
		}

		redirect('fund/project/project_support/');
	}

	function delete_file() {
		if(empty($_GET['id']) || empty($_GET['type'])) {
			set_notify('error', 'ไม่สามารถดำเนินการได้กรุณาตรวจสอบ');
			redirect('fund/project/project_support/');
		}
		
		$dir = 'uploads/fund/project/project_support/'.$_GET['id'].'/';
		$tmp = $this->project_support->get_row($_GET['id']);
		if(empty($tmp[$_GET['type']])) {
			set_notify('error', 'ไม่พบไฟล์กรุณาตรวจสอบ');
		} else {
			unlink($dir.$tmp[$_GET['type']]);
			$tmp[$_GET['type']] = '';
			$this->project_support->save($tmp);
			set_notify('error', lang('delete_data_complete'));
		}
		
		redirect('fund/project/project_support/form/'.$_GET['id']);
	}

	function delete($id = false) {
		if(!$id) {
			set_notify('error', 'ไม่สามารถดำเนินการได้');
			redirect('fund/project/project_support');
		}
		
		if(!empty($data['rs']['center_receive_date'])) {
			set_notify('error', 'ไม่สามารถลบรายการนี้ได้');
			redirect('fund/project/project_support');
		}
		

		$tmp = $this->project_support->get_row($id);
		
		//Clear attachment files
		$dir = 'uploads/fund/project/project_support/'.$id.'/';

		if(!empty($tmp['project_attachment'])) {
			@unlink($dir.$tmp['project_attachment']);
		}
		
		if(!empty($tmp['project_pay_attachment'])) {
			@unlink($dir.$tmp['project_pay_attachment']);
		}
		
		rmdir($dir);

		$this->project_support->delete($id);
		
		set_notify('success', lang('delete_data_complete'));
		redirect('fund/project/project_support/');
	}

	function gen_projectno($project_code) {
		$tmp = $this->project_support->get("SELECT PROJECT_CODE FROM FUND_project_support WHERE PROJECT_CODE LIKE '".$project_code."%' ORDER BY PROJECT_CODE DESC");
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
