<?php
class Fund_attorney extends Fund_Controller{
	public $modules_name = "fund_attorney";
	public function __construct(){
		parent::__construct();
		$this->load->model('fund_attorney_model','attorney');
	}
	
	function index(){
		$data['attorney'] = $this->attorney->order_by('id','desc')->get();
		$data['pagination'] = $this->attorney->pagination();
		$this->template->build('attorney_index',@$data);
	}
	
	function save_ajax(){
		if($_GET){
			$this->attorney->save($_GET);
			
			if($_GET['idEdit'] > 0){
				$action_type = "ADD";
				$action =" เพิ่มผู้รับมอบอำนาจ ". $_GET['name'];
			}else{
				$action_type = "EDIT";
				$action =" แก้ไขผู้รับมอบอำนาจ ". $_GET['name'];
			}
			save_logfile($action_type,$action,$this->modules_name);
			
			$this->attorneyList();
		}
	}
	
	function delete($id=false){
		if($id){
			$url_parameter = GetCurrentUrlGetParameter();
			$result = $this->attorney->get_row($id);
			
			$action_type = "DELETE";
			$action =" ลบผู้รับมอบอำนาจ ". $result['name'];
			save_logfile($action_type,$action,$this->modules_name);
			
			$this->attorney->delete($id);
			
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('fund_attorney/'.$url_parameter);
	}
	
	function attorneyList($searchName=false){
		$condition = " 1=1 ";
		$condition .= $searchName != ""?" and name like '%".$searchName."%'":"";
		$data['attorney'] = $this->attorney->where($condition)->order_by('id','desc')->get();
		$data['pagination'] = $this->attorney->pagination();
		$this->load->view('attorney_list',$data);
	}
	
	function search(){
		if($_GET){
			$this->attorneyList($_GET['name']);
		}
	}
}
?>