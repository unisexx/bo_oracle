<?php
class Inspect_risk_subject extends Inspect_Controller
{
	public $modules_name = "inspect_risk_subject";
	public function __construct()
	{
		parent::__construct();
		$this->load->model('insp_risk_subject_model','risk_subject');	
		$this->load->model('monitor_budget_plan/mt_budget_plan_model','strategy');
		$this->load->model('inspect_save/insp_project_risk_save_model','risk_save');
	}
	
	function index()
	{
		//$this->db->debug = true;
		$condition = " WHERE  1=1 ";
		$data='';
		$condition .= @$_GET['budgetyear'] > 0 ? " AND BUDGETYEAR = ".@$_GET['budgetyear'] : "";
		$condition .= @$_GET['title'] != "" ? " AND TITLE LIKE '%".@$_GET['title']."%' " : "";
		$data['byear'] = $this->strategy->get("SELECT DISTINCT MTYEAR byear FROM MT_STRATEGY",TRUE);
		$data['risksubject'] = $this->risk_subject->get("SELECT DISTINCT BUDGETYEAR FROM ".$this->risk_subject->table.$condition,FALSE);
		$data['pagination'] = $this->risk_subject->pagination();
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$this->template->build('inspect_risk_subject_index',$data);		
	}
	
	function form($budgetyear=FALSE)
	{
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['budgetyear'] = $budgetyear;
		if($budgetyear > 0)
		{
			$data['riskdetail'] = $this->risk_subject->where("BUDGETYEAR=".$budgetyear)->get();	
			$condition = " where budgetyear <> ".$budgetyear;
			
			$action_type = "VIEW";
			$action =" ดูรายละเอียดการตั้งค่าหัวข้อความเสี่ยง ปี :".($budgetyear+543);
			save_logfile($action_type,$action,$this->modules_name);
		}
		$data['byear'] = $this->strategy->get("SELECT DISTINCT MTYEAR byear FROM MT_STRATEGY where MTYEAR not in (select budgetyear from insp_risk_subject".@$condition.")",TRUE);
		
		$this->template->build('inspect_risk_subject_form',$data);
	}

	function save($id=FALSE){
		//$this->db->debug = true;
		if($_POST){
			$url_parameter = GetCurrentUrlGetParameter();
			@$this->risk_subject->delete('budgetyear',$_POST['budgetyear']);				
			//$this->risk_subject->delete('budgetyear',$_POST['budgetyear']);
			if(isset($_POST['title'])){
				foreach($_POST['title'] as $key=>$item){
					if($_POST['title'][$key]){
						$this->risk_subject->save(array(
							'budgetyear'=>$_POST['budgetyear'],
							'title'=>$_POST['title'][$key],
							'risktype'=>$_POST['risktype'][$key]													
						));
					}
				}
			}
			
			if($_POST['budgetyear'] > 0){
			   	$action_type = "EDIT";
				$action =" แก้ไขรายละเอียดการตั้งค่าหัวข้อความเสี่ยง ปี :".($_POST['budgetyear']+543);
			}else{
			   	$action_type = "ADD";
				$action =" เพิ่มรายละเอียดการตั้งค่าหัวข้อความเสี่ยง ปี :".($_POST['budgetyear']+543);
			}
			save_logfile($action_type,$action,$this->modules_name);
			
			set_notify('success', lang('save_data_complete'));
		}
		redirect('inspect_risk_subject/index'.$url_parameter);
	}
	
	function delete($id=FALSE){
		if($id){
			$url_parameter = GetCurrentUrlGetParameter();
			$this->risk_subject->delete("BUDGETYEAR",$id);
			
			$action_type="DELETE";
			$action =" ลบรายละเอียดการตั้งค่าหัวข้อความเสี่ยง ปี :".($id+543);
			save_logfile($action_type,$action,$this->modules_name);
			
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('inspect_risk_subject/index'.$url_parameter);
	}
}
?>