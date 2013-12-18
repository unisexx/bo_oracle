<?php
class budget_plan extends Budget_Controller
{
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('budget_plan_model','budget_plan');
		$this->load->model('budget_plan_detail_model','budget_plan_detail');
	}
	
	public function index()
	{
		if(!is_login())redirect("home.php");
		$data['budgetyear'] = @$_GET['budgetyear'] > 0 ? $_GET['budgetyear'] : 0;	
		$data['budget_level'] = array('','strategy','plan','strategy_target','department_service_target','department_strategy','division_service_target','division_strategy','productivity','budget_policy','main_activity','sub_activity');	
		$this->template->build('index',$data);
	}
	
	public function form($budgetyear=FALSE,$level=FALSE,$pid=FALSE,$id=FALSE){
		if(!is_login())redirect("home.php");
		$data['budgetyear']=$budgetyear;
		$data['budget_level'] = array('','strategy','plan','strategy_target','department_service_target','department_strategy','division_service_target','division_strategy','productivity','budget_policy','main_activity','sub_activity');
		$data['lv_title'] = array('','ยุทธศาสตร์การจัดสรรงบประมาณ','แผนงาน','เป้าหมายเชิงยุทธศาสตร์','เป้าหมายการให้บริการกระทรวง','ยุทธศาสตร์กระทรวง','เป้าหมายการให้บริการหน่วยงาน','กลยุทธ์หน่วยงาน','ผลผลิต','นโยบายการจัดสรรงบประมาณ','กิจกรรมหลัก','กิจกรรมย่อย');		
		$data['lv'] = $level;
		$data['pid'] = $pid;
		$data['id'] = $id;		
		$data['row'] = $this->budget_plan->get_row($id);
		$data['prow'] = $this->budget_plan->get_row($pid);				
		$this->template->build($data['budget_level'][$level].'_form',$data);
	}
	public function save(){
		//$this->db->debug=true;
		if(@$_POST['iscopy']>0)
		{
			$exist = $this->db->getone("SELECT COUNT(*) FROM ".$this->budget_plan->table." WHERE SYEAR=".$_POST['syear']);
			if($exist<1){
				$copy_year = $this->db->getone("SELECT MAX(syear) FROM CNF_STRATEGY WHERE SYEAR <".$_POST['syear']);
				$this->copy_plan($_POST['syear'],0,$copy_year,0);				
				redirect('budget_plan/index?budgetyear='.$_POST['syear']);
			}else{
				echo "<script>alert('ไม่สามาร copy แผนงบประมาณมาในปีนี้ได้เนื่องจากมีข้อมูลอยู่แล้ว');window.location='budget_plan/form/".$_POST['syear']."/1//';</script>";	
			}							
		}
		else
		{					
			$_POST['updatedate'] = date("Y-m-d");
			switch($_POST['lv']){
				case 1:
					$_POST['pid'] = 0;
				break;
				case 2:
					$_POST['pid'] = $_POST['budgetstrategyid'];
				break;
				case 3:
					$_POST['pid'] = $_POST['planid'];
				break;
				case 4:
					$_POST['pid'] = $_POST['strategytargetid'];
				break;
				case 5:
					$_POST['pid'] = $_POST['ministrytargetid'];
				break;
				case 6:
					$_POST['pid'] = $_POST['ministrystrategyid'];
				break;
				case 7:
					$_POST['pid'] = $_POST['sectiontargetid'];
				break;
				case 8:
					$_POST['pid'] = $_POST['sectionstrategyid'];
				break;
				case 9:
					$_POST['pid'] = $_POST['productivityid'];
				break;
				case 10:
					$_POST['pid'] = $_POST['budgetpolicyid'];
				break;
				case 11:
					$_POST['pid'] = $_POST['mainactid'];
				break; 
				default:
					$_POST['pid'] = 0;
				break;
			}			
			$id = $this->budget_plan->save($_POST);
			$current_row = $this->budget_plan->get_row($id);
			$db_column = array('','budgetstrategyid', 'planid', 'strategytargetid', 'ministrytargetid', 'ministrystrategyid', 'sectiontargetid', 'sectionstrategyid', 'productivityid', 'budgetpolicyid', 'mainactid');
			$max_lv = $current_row['lv'] == 11 ? 10 : $current_row['lv'];
			if($current_row['lv'] < 11)
			{
				for($i=1;$i<=$max_lv;$i++)$model_value[$i] = $current_row[$db_column[$i]];
				$this->update_key_column($id,$model_value);
			}			
			redirect('budget_plan/index?budgetyear='.$_POST['syear']);
		}
	}		
	public function update_key_column($id=FALSE,$model_value=FALSE){
		//$this->db->debug = true;
		$db_column = array('','budgetstrategyid', 'planid', 'strategytargetid', 'ministrytargetid', 'ministrystrategyid', 'sectiontargetid', 'sectionstrategyid', 'productivityid', 'budgetpolicyid', 'mainactid');
		$current_row = $this->budget_plan->get_row($id);				
		$result = $this->budget_plan->where(" lv > ".$current_row['lv']." AND syear=".$current_row['syear'].' AND (pid='.$current_row['id'].' or '.$db_column[$current_row['lv']].'='.$current_row['id'].')')->order_by('lv','asc')->get(FALSE,TRUE);
		foreach($result as $item):
			for($i=1;$i<=$current_row['lv'];$i++){
				$item[$db_column[$i]] = $i == $current_row['lv'] ? $current_row['id'] : $current_row[$db_column[$i]];	
			}
			$this->budget_plan->save($item);
		endforeach;
	}
	public function delete($id=FALSE)
	{
		$current_row = $this->budget_plan->get_row($id);
		if(@$current_row['id'] >0){
		$this->budget_plan->delete($id);
			if($current_row['lv']<11){
				$db_column = array('','budgetstrategyid', 'planid', 'strategytargetid', 'ministrytargetid', 'ministrystrategyid', 'sectiontargetid', 'sectionstrategyid', 'productivityid', 'budgetpolicyid', 'mainactid');
				$result = $this->budget_plan->where(" lv > ".$current_row['lv']." AND syear=".$current_row['syear'].' AND (pid='.$current_row['id'].' or '.$db_column[$current_row['lv']].'='.$current_row['id'].')')->order_by('lv','asc')->get(FALSE,TRUE);
				foreach($result as $item):			
					$this->budget_plan->delete($item['id']);
				endforeach;
			}
		}
		redirect('budget_plan/index?budgetyear='.$current_row['syear']);
	}
	
	public function copy_plan($syear=FALSE,$pid=FALSE,$copy_year=FALSE,$current_pid=FALSE){
		//$this->db->debug = true;
		$pid_row = $this->budget_plan->get_row($current_pid);
		$db_column = array('','budgetstrategyid', 'planid', 'strategytargetid', 'ministrytargetid', 'ministrystrategyid', 'sectiontargetid', 'sectionstrategyid', 'productivityid', 'budgetpolicyid', 'mainactid');		
		$copy_result = $this->budget_plan->where("PID=".$pid." AND SYEAR=".$copy_year)->get(FALSE,TRUE);
		foreach($copy_result as $item){			
			$save_data = $item;
			$save_data['id'] = '';
			$save_data['pid'] = $current_pid;
			$save_data['syear'] = $syear;
			for($i=1;$i<$item['lv'];$i++){
				$save_data[$db_column[$i]] = $pid_row[$db_column[$i]];
			}
			if($item['lv']<11)$save_data[$db_column[$item['lv']]] = 0;			
				
				$save_data[$db_column[($item['lv']-1)]] = $current_pid;
			
			$save_data['createdate'] = date("Y-m-d");
			$save_data['updatedate'] = date("Y-m-d");
			$id = $this->budget_plan->save($save_data);
			$this->copy_plan($syear,$item['id'],$copy_year,$id);
		}				
	}
	public function reload_list()
	{		
		$lv_title = array('','budgetstrategyid'=>'ยุทธศาสตร์การจัดสรรงบประมาณ','planid'=>'แผนงาน','strategytargetid'=>'เป้าหมายเชิงยุทธศาสตร์','ministrytargetid'=>'เป้าหมายการให้บริการกระทรวง',
		'ministrystrategyid'=>'ยุทธศาสตร์กระทรวง','sectiontargetid'=>'เป้าหมายการให้บริการหน่วยงาน','sectionstrategyid'=>'กลยุทธ์หน่วยงาน','productivityid'=>'ผลผลิต',
		'budgetpolicyid'=>'นโยบายการจัดสรรงบประมาณ','mainactid'=>'กิจกรรมหลัก');			
		$target_lv= $_POST['target_lv'];
		$pid = $_POST['pid'];
		echo @form_dropdown($target_lv,get_option("id","title","cnf_strategy","pid=".$pid." order by title "),'','','-- '.$lv_title[$target_lv].' --');
	}		
}
?>