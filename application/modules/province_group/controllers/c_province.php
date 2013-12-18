<?php
class c_province extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Province_model','province');			
		$this->load->model('c_province_area/Province_area_model','province_area');
		$this->load->model('c_province_zone/Province_zone_model','province_zone');
		$this->load->model('c_province_group/Province_group_model','province_group');		
	}
	
	function index()
	{
		$condition = " WHERE 1=1 ";
		$excondition ='';
		$excondition .= isset($_GET['txtsearch'])? " AND TITLE LIKE '%".$_GET['txtsearch']."%'" : "";
		$excondition .= isset($_GET['zone'])? $_GET['zone'] != '' ? " AND zone ='".$_GET['zone']."'" : "" : "";
		$excondition .= isset($_GET['area'])? $_GET['area'] > 0 ? " AND area =".$_GET['area']."" : "" : "";
		$excondition .= isset($_GET['group'])? $_GET['group'] > 0 ?  " AND pgroup =".$_GET['group']."" : "" : "";
		$data['result']= $excondition !='' ? $this->province->get("SELEcT * FROM CNF_PROVINCE ".$condition.$excondition) : $this->province->get();
		$data['pagination'] = $this->province->pagination();		
		$this->template->build('province_index',$data);		
	}
	
	function form($ID=FALSE){
		@$data['row']= $this->province->get_row($ID);		
		$this->template->build('province_form',$data);
	}
	
	function save($ID=FALSE){
		//$this->db->debug = true;
		if($_POST){
			$_POST['id']=$ID;
		   $id = $this->province->save($_POST);
		   set_notify('success', lang('save_data_complete'));
		}
		redirect('c_province/index');
	}
	function delete($ID=FALSE,$PAGE=FALSE){						
		$this->province->delete($ID);		
		redirect('c_province/index?page='.$PAGE);
	}

}
?>