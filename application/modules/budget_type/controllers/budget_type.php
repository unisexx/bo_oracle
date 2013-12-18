<?php
class budget_type extends Budget_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("budget_type_model","budget_type");
		$this->load->model("budget_asset/budget_asset_model",'asset');
	}
	
	public function index()
	{
		if(!is_login())redirect("home.php");
		$data='';
		$this->template->build('index',$data);
	}
	
	public function budgettype_form($pid=FALSE,$id=FALSE){
		if(!is_login())redirect("home.php");		
		$data['prow'] = $this->budget_type->get_row($pid);		
		$data['row'] = $this->budget_type->get_row($id);		
		$this->template->build('budgettype_form',$data);
	}
	public function expensetype_form($pid=FALSE,$id=FALSE){
		if(!is_login())redirect("home.php");		
		$data['prow'] = $this->budget_type->get_row($pid);		
		$data['row'] = $this->budget_type->get_row($id);		
		$this->template->build('expensetype_form',$data);
	}
	public function form($pid=FALSE,$id=FALSE){
		if(!is_login())redirect("home.php");		
		$data['prow'] = $this->budget_type->get_row($pid);		
		$data['row'] = $this->budget_type->get_row($id);		
		$this->template->build('form',$data);
	}
	public function asset_form($pid=FALSE,$id=FALSE){
		if(!is_login())redirect("home.php");		
		$data['prow'] = $this->budget_type->get_row($pid);		
		$data['row'] = $this->budget_type->get_row($id);		
		$this->template->build('assettype_form',$data);
	}
	
	
	public function save(){
		$_POST['isasset'] = @$_POST['isasset'] == '' ? 0 : $_POST['isasset'];
		$this->budget_type->save($_POST);
		redirect('budget_type');
	}	 
	
	public function delete($ID=FALSE){					
		$this->budget_type->delete($ID);
		redirect('budget_type');
	}
}
?>