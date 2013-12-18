<?php
class c_province_zone extends Admin_Controller
{
	public $modules_name = "c_province_zone";
	function __construct()
	{
		parent::__construct();
		$this->load->model('province_zone_model','province_zone');
		$this->load->model('c_province_zone_type/province_zone_type_model','province_zone_type');
		$this->load->model('c_province/province_model','province');
		$this->load->model('c_province_area/province_area_model','province_area');		
		$this->load->model('c_province_group/province_group_model','province_group');
					
	}
	
	function index()
	{
		//$condition = " WHERE 1=1 ";
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$condition = @$_GET['zone_type_id'] > 0 ? " zone_type_id =".$_GET['zone_type_id'] : "";			
		$data['result']= $this->province_zone->where($condition)->get();
		$data['pagination'] = $this->province_zone->pagination();		
		$this->template->build('province_zone_index',$data);		
	}
	
	function form($ID=FALSE){
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['row']= $this->province_zone->get_row($ID);
		if($ID>0){
			$action_type = "VIEW";
			$action = " ดูรายละเอียดข้อมูลภาค ID:".$ID." ".$data['row']['title'];
			save_logfile($action_type,$action,$this->modules_name);
		}
		   
		$data['zone_type'] = $this->province_zone_type->get(FALSE,TRUE);		
		
		$this->template->build('province_zone_form',$data);
	}
	
	function save($ID=FALSE){
		//$this->db->debug = true;
		$url_parameter = GetCurrentUrlGetParameter();
		if($_POST){		
		   $id = $this->province_zone->save($_POST);
			
			if($_POST['id']>0){
		   		$action_type = "EDIT";
			    $action = " แก้ไขข้อมูลภาค ID:".$id." ".$_POST['title'];
		   }else{
		   		$action_type = "ADD";
				$action = " เพิ่มข้อมูลภาค ID:".$id." ".$_POST['title'];
		   }
		   save_logfile($action_type,$action,$this->modules_name);			
		   set_notify('success', lang('save_data_complete'));
		}
		redirect('c_province_zone/index'.$url_parameter);
	}
	function delete($ID=FALSE){
		$url_parameter = GetCurrentUrlGetParameter();						
		$result = $this->province_zone->get_row($ID);
		$this->province_zone->delete($ID);		
		$action_type = "DELETE";
		$action = " ลบข้อมูลภาค ID:".$ID." ".$result['title'];
		save_logfile($action_type,$action,$this->modules_name);
		redirect('c_province_zone/index'.$url_parameter);
	}

}
?>