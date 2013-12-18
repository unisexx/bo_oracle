<?php
class c_province_zone_type extends Admin_Controller
{
	public $modules_name = "c_province_zone_type";
	function __construct()
	{
		parent::__construct();
		$this->load->model('province_zone_type_model','province_zone_type');
		$this->load->model('c_province/province_model','province');
		$this->load->model('c_province_area/province_area_model','province_area');
		$this->load->model('c_province_zone/province_zone_model','province_zone');
		$this->load->model('c_province_group/province_group_model','province_group');
					
	}
	
	function index()
	{
		//$condition = " WHERE 1=1 ";
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		if(!permission('c_province_zone_type','canview'))redirect('c_front');
		$condition = isset($_GET['txtsearch'])? " title LIKE '%".$_GET['txtsearch']."%'" : "";		
		$data['result']= $this->province_zone_type->where($condition)->get();
		$data['pagination'] = $this->province_zone_type->pagination();		
		$this->template->build('province_zone_type_index',$data);		
	}
	
	function form($ID=FALSE){
		$data['url_parameter'] = GetCurrentUrlGetParameter();					
		@$data['row']= $this->province_zone_type->get_row($ID);		
		if($ID>0){
			$action_type = "VIEW";
			$action =" ดูรายละเอียดข้อมูลกลุ่มภาค ID:".$ID." ".$data['row']['title'];			
			save_logfile($action_type,$action,$this->modules_name);
		}
		$this->template->build('province_zone_type_form',$data);
	}
	
	function save(){
		//$this->db->debug = true;
		$url_parameter = GetCurrentUrlGetParameter();
		if($_POST){			
		   $id = $this->province_zone_type->save($_POST);
		   if($_POST['id']>0){
		   		$action_type = "EDIT";
			    $action = " แก้ไขข้อมูลกลุ่มภาค ID:".$id." ".$_POST['title'];
		   }else{
		   		$action_type = "ADD";
				$action = " เพิ่มข้อมูลกลุ่มภาค ID:".$id." ".$_POST['title'];
		   }
		   save_logfile($action_type,$action,$this->modules_name);
		   set_notify('success', lang('save_data_complete'));
		}
		redirect('c_province_zone_type/index'.$url_parameter);
	}
	function delete($ID=FALSE){
		$url_parameter = GetCurrentUrlGetParameter();
		if(!permission('c_province_zone_type','candelete'))redirect('c_front');
		$result = $this->province_zone_type->get_row($ID);						
		$this->province_zone_type->delete($ID);		
		$action_type = "EDIT";
		$action = " ลบข้อมูลกลุ่มภาค ID:".$ID." ".$result['title'];
		save_logfile($action_type,$action,$this->modules_name);
		redirect('c_province_zone_type/index'.$url_parameter);
	}

}
?>