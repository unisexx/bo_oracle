<?php
class c_province_area extends Admin_Controller
{
	public $modules_name = "c_province_area";
	public $modules_title = "ข้อมูลเขต";
	function __construct()
	{
		parent::__construct();
		$this->load->model('c_province/province_model','province');
		$this->load->model('province_area_model','province_area');
		$this->load->model('c_province_zone/province_zone_model','province_zone');
		$this->load->model('c_province_group/province_group_model','province_group');			
	}
	
	function index()
	{
		//$this->db->debug = true;
		if(!permission($this->modules_name,'canview'))redirect('c_front');
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$condition = @$_GET['txtsearch']!='' ? "  title LIKE '%".$_GET['txtsearch']."%'" : "";		
		$data['result']= $this->province_area->where($condition)->get();
		$data['pagination'] = $this->province_area->pagination();				
		$this->template->build('province_area_index',$data);		
	}
	
	function form($ID=FALSE){
		if(!permission($this->modules_name,'canview'))redirect('c_front');	
		$data['url_parameter'] = GetCurrentUrlGetParameter();			
		@$data['row']= $this->province_area->get_row($ID);		
		if($ID>0){
			$action_type = "VIEW";
			$action = get_logaction($action_type).$this->modules_title." ID:".$ID." ".$data['row']['title'];
			save_logfile($action_type,$action,$this->modules_name);
		}
		$this->template->build('province_area_form',$data);
	}
	
	function save($ID=FALSE){
		//$this->db->debug = true;
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		if($_POST){
		   if($_POST['id']>0)
		   {
		   		if(!permission($this->modules_name,'canedit'))redirect('c_front');
				$id = $this->province_area->save($_POST);
				$action_type = "EDIT";
				$action = get_logaction($action_type).$this->modules_title." ID:".$id." ".$_POST['title'];
				save_logfile($action_type,$action,$this->modules_name);				
		   }else{
		   		if(!permission($this->modules_name,'canadd'))redirect('c_front');
				$id = $this->province_area->save($_POST);
				$action_type = "ADD";
				$action = get_logaction($action_type).$this->modules_title." ID:".$id." ".$_POST['title'];
				save_logfile($action_type,$action,$this->modules_name);
		   }
		   		   
		   set_notify('success', lang('save_data_complete'));
		}
		redirect('c_province_area/index'.$data['url_parameter']);
	}
	function delete($ID=FALSE){
		$data['url_parameter'] = GetCurrentUrlGetParameter();			
		if(!permission($this->modules_name,'candelete'))redirect('c_province_area');			
		$result = $this->province_area->get_row($ID);
		$this->province_area->delete($ID);
		$action_type = "DELETE";
		$action = get_logaction($action_type).$this->modules_title." ID:".$ID." ".$result['title'];		
		redirect('c_province_area/index'.$data['url_parameter']);
	}

}
?>