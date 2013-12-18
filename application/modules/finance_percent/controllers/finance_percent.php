<?php
class finance_percent extends Finance_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('fn_percent_model','fn_percent');						
		$this->load->model('finance_budget_plan/fn_budget_type_model','budget_type');
	}
	
	function index()
	{
		$data['url_parameter'] = GetCurrentUrlGetParameter();				                	    			
    	db_connect(BUDGET_DSN,BUDGET_DBUSER,BUDGET_DBPASSWORD);
		$sql = "SELECT DISTINCT BUDGETYEAR FROM BUDGET_MASTER ORDER BY BUDGETYEAR DESC ";
		$result = db_query($sql,BUDGET_DSN);
		$option = '';
		while($srow = db_fetch_array($result,0)){            
    	$selected = @$srow['BUDGETYEAR'] == @$_GET['budget_year'] ? 'selected="selected"' : "";            
    	$option .= '<option '.$selected.' value="'.$srow['BUDGETYEAR'].'">'.($srow['BUDGETYEAR']+543).'</option>';             
		}
    	db_close(BUDGET_DSN);
		$data['option'] = $option;
		
		
		$condition = " 1=1 ";	
		$condition.= @$_GET['budget_year'] > 0 ? " AND budget_year=".$_GET['budget_year'] : "";
		$condition.= @$_GET['budget_type'] > 0 ? " and budget_type_id=".$_GET['budget_type'] : "";
		$condition.= @$_GET['expense_type'] > 0 ? " and expense_type_id=".$_GET['expense_type'] : "";
		$data['result'] = $this->fn_percent->where($condition)->get();
		$data['pagination'] = $this->fn_percent->pagination();
		$this->template->build('index',$data);
	}
	
	function form($id=false){
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['rs'] = $this->fn_percent->get_row($id);
		db_connect(BUDGET_DSN,BUDGET_DBUSER,BUDGET_DBPASSWORD);
		$sql = "SELECT DISTINCT BUDGETYEAR FROM BUDGET_MASTER ORDER BY BUDGETYEAR DESC ";
		$result = db_query($sql,BUDGET_DSN);
		$option = '';
		while($srow = db_fetch_array($result,0)){
			$selected = @$srow['BUDGETYEAR'] == @$data['rs']['budget_year'] ? 'selected="selected"' : "";            
    	$option .= '<option '.$selected.' value="'.$srow['BUDGETYEAR'].'">'.($srow['BUDGETYEAR']+543).'</option>';             
		}
    	db_close(BUDGET_DSN);
		$data['option'] = $option;				
		$this->template->build('form',$data);
	}
	
	
	
	function save(){
		$url_parameter = GetCurrentUrlGetParameter();		
		//$this->db->debug = true;
		if($_POST){					
			$id = $this->fn_percent->save($_POST);						
			set_notify('success', lang('save_data_complete'));
		}
		redirect('finance_percent/index'.$url_parameter);
	}
	
	function delete($id=false){
		$url_parameter = GetCurrentUrlGetParameter();
		if($id){
			$this->fcr->delete($id);
			$this->fcrd->delete('fn_cost_related_id',$id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect("finance_percent/index".$url_parameter);
	}
		
}
?>