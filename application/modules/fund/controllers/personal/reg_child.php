<?php
/**
 * Reg Child
 * ทะเบียนข้อมูลเด็ก
 */
class Reg_Child extends Fund_Controller {
	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('fund_child_model',"fund_child");
		$this->load->model("fund_province","province");
		$this->load->model("fund_district","district");
		$this->load->model("fund_amphur","amphur");
	}
	
	public function index() 
	{
		$data['variable'] = $this->fund_child->get();
		$data['pagination'] = $this->fund_child->pagination();
		$this->template->build("personal/reg_child/index", $data);
	}
	
	public function form($id = null)
	{
		$data["value"] = $this->fund_child->get_row($id);
		$this->template->build('personal/reg_child/form',$data);
	}
	
	public function save($id=null)
	{
		if($_POST) {
			
			if($id) {
				$_POST["id"] = $id;
				$_POST["birthday"] = date_to_mysql($_POST["birthday"],TRUE);
				$this->fund_child->save($_POST);
			} else {
				$_POST["birthday"] = date_to_mysql($_POST["birthday"],TRUE);				
				$this->fund_child->save($_POST);
			}
			
		}
		redirect("fund/personal/reg_child");
	}
	
	public function delete($id)
	{
		
	}
	
}