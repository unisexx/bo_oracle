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
		$where = " 1=1 ";
		
		if(@$_GET["p"]) {
			$where .= " AND PROVINCE_ID = ".$_GET["p"];
		}
		
		if(@$_GET["keyword"]) {
			$where .= " AND (FIRSTNAME LIKE '%".$_GET["keyword"]."%' OR LASTNAME LIKE '%".$_GET["keyword"]."%')";
		}
		
		$sql = "SELECT * FROM FUND_REG_PERSONAL WHERE ".$where;
		
		$data['variable'] = $this->fund_child->get($sql);
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
		if($id) {
			$chk_used = $this->fund_child->get_row($id);
			
			if(@$chk_used["id"]==false) {
				$delete = $this->fund_child->delete($id);
			} else {
				$this->session->set_flashdata("error",1);
				$this->session->set_flashdata("msg","ไม่สามารถลบได้เนื่องจากได้ลงทะเบียนขอรับเงินสนับสนุนแล้ว");
			}
		}
		@redirect("fund");
	}
	
}