<?php
class Finance_budget_id extends Finance_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('fn_strategy_model','fn_strategy');
		$this->load->model('fn_budget_code_model','fn_budget_code');
	}
	
	function index()
	{
		//$this->db->debug = true;
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$budgetyear=(@$_GET['budgetyear']!="")?  " and budgetyear LIKE'%".@$_GET['budgetyear']."%'":"";
		$budgedplantypeid=(@$_GET['budgedplantypeid']!="")?  " and budgedplantype_id LIKE'%".@$_GET['budgedplantypeid']."%'":"";
		$planid=(@$_GET['planid']!="")?  " and plan_id LIKE'%".@$_GET['planid']."%'":"";
		$productivityid=(@$_GET['productivityid']!="")?  " and productivity_id LIKE'%".@$_GET['productivityid']."%'":"";
		
		$data['budget_codes'] = $this->fn_budget_code->where("1=1 ".$budgetyear.$budgedplantypeid.$planid.$productivityid)->order_by('id','desc')->get();
		
		$data['pagination'] = $this->fn_budget_code->pagination();
		$this->template->build('finance_budget_id_index',$data);
	}
	
	function form($id=FALSE){
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		if($id){
			$data['budget_code'] = $this->fn_budget_code->get_row($id);
		}
		$data['fn_years'] = $this->fn_strategy->get("select distinct fnyear from fn_strategy");
		$this->template->build('finance_budget_id_form',$data);
	}
	
	function save(){
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		if($_POST){
			
			foreach($_POST['code'] as $key=>$item){
				if($_POST['code'][$key]){
					$this->fn_budget_code->save(array(
						'id'			=>$_POST['id'],
						'budgetyear'	=>$_POST['budgetyear'],
						'productivity_id'=>$_POST['productivityid'],
						'code'			=>$_POST['code'][$key],
						'description'	=>$_POST['description'][$key],
						'budgetplantype_id'=>$_POST['budgetplantypeid'],
						'plan_id'=>$_POST['planid']
					));
				}
			}
			set_notify('success', lang('save_data_complete'));
		}
		redirect('finance_budget_id/index'.$data['url_parameter']);
	}
	
	function delete($id=FALSE){
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		if($id){
			$this->fn_budget_code->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('finance_budget_id/index'.$data['url_parameter']);
	}
	
	function select_fnyear_2_find_bgplantype(){
		if($_POST['fnyear']){
			$fnyear = $_POST['fnyear'];
			
			echo form_dropdown('budgetplantypeid',get_option('id','title',"fn_strategy where fnyear = $fnyear and budgetplantype = 0"),'','','-- เลือกช่วงแผนงบประมาณ  --');
			}
	}

	function select_budgetplantype_2_find_plan(){
		if($_POST['budgetplantypeid']){
			$budgetplantype = $_POST['budgetplantypeid'];
			
			echo form_dropdown('planid',get_option('id','title',"fn_strategy where planid < 1 and budgetplantype = $budgetplantype"),'','','-- เลือกแผนงาน --');
		}
	}

	function select_plan_2_find_product(){
		if($_POST['planid']){
			$plan = $_POST['planid'];
			
			echo form_dropdown('productivityid',get_option('id','title',"fn_strategy where productivityid < 1 and planid = $plan"),'','','-- เลือกผลผลิต --');
		}
	}
}
?>