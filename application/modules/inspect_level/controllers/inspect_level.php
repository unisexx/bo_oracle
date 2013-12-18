<?php
class Inspect_level extends Inspect_Controller
{
	public $modules_name = "inspect_level";
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('inspect_level_model','level');
		$this->load->model('monitor_budget_plan/mt_budget_plan_model','strategy');
	}
	
	function index()
	{
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$condition = " WHERE 1=1 ";
		$condition.= @$_GET['budgetyear']!=''? " AND budgetyear=".@$_GET['budgetyear'] : "";
		
		$data['byear'] = $this->strategy->get("SELECT DISTINCT MTYEAR byear FROM MT_STRATEGY",TRUE);
		$sql = "SELECT DISTINCT budgetyear FROM INSP_LEVEL ".$condition." order by budgetyear desc";
		$data['level'] = $this->level->get($sql);
		$this->template->build('inspect_level_index',$data);
	}
	
	function form($budgetyear = FALSE){
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		if($budgetyear){
			$data['budgetyear'] = $budgetyear;
			$data['level'] = $this->level->where("budgetyear = ".$budgetyear)->order_by("range_start","desc")->get();
			$data['condition'] = " where budgetyear <> ".$budgetyear;
			
			$action_type = "VIEW";
			$action =" ดูรายละเอียดการตั้งค่ากำหนดระดับความเสี่ยง ปี :".($budgetyear+543);
			save_logfile($action_type,$action,$this->modules_name);
		}
		$this->template->build('inspect_level_form',@$data);
	}
	
	function save(){
		//$this->db->debug = true;
		$url_parameter = GetCurrentUrlGetParameter();
		if($_POST){
			if(isset($_POST['color'])){
				foreach($_POST['color'] as $key => $item){
					if($_POST['color'][$key]){
												
						$this->level->save(array(
							'id'=>@$_POST['id'][$key],
							'budgetyear'=>$_POST['budgetyear'],
							'color'=>$_POST['color'][$key],
							'color_detail'=>$_POST['color_detail'][$key],
							'orderlist'=>$key,
							'range_start'=>$_POST['range_start'][$key],
							'range_end'=>$_POST['range_end'][$key]
						));
					}
				}
			}
			
			if($_POST['budgetyear'] > 0){
			   	$action_type = "EDIT";
				$action =" แก้ไขรายละเอียดการตั้งค่ากำหนดระดับความเสี่ยง ปี :".($_POST['budgetyear']+543);
			}else{
			   	$action_type = "ADD";
				$action =" เพิ่มรายละเอียดการตั้งค่ากำหนดระดับความเสี่ยง ปี :".($_POST['budgetyear']+543);
			}
			save_logfile($action_type,$action,$this->modules_name);
			
			set_notify('success', lang('save_data_complete'));
		}
		redirect('inspect_level/index'.$url_parameter);
	}
	
	function del_row(){
		$id = $_POST['id'];
		$this->level->delete($id);
	}

	function delete($budgetyear){
		$url_parameter = GetCurrentUrlGetParameter();
		if($budgetyear){
			$this->level->delete("budgetyear",$budgetyear);
			
			$action_type="DELETE";
			$action =" ลขรายละเอียดการตั้งค่ากำหนดระดับความเสี่ยง ปี :".($budgetyear+543);
			save_logfile($action_type,$action,$this->modules_name);
			
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('inspect_level/index'.$url_parameter);
	}
}
?>