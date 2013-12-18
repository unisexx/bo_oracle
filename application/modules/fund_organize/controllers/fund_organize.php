<?php
class Fund_organize extends Fund_Controller{
	public $modules_name = "fund_organize";
	
	public function __construct(){
		parent::__construct();
		$this->load->model('fund_organize_model','organize');
	}
	
	function index(){
		//$this->db->debug = true;
		$condition = " 1=1 ";
		$condition .= @$_GET['name']!=""?" and name like '%".$_GET['name']."%'":"";
		$condition .= @$_GET['province']!=0?" and province = ".$_GET['province']:"";
		$condition .= @$_GET['district']!=0?" and district = ".$_GET['district']:"";
		
		$total_record = 0;
		$current_page = @$_GET['page'] == '' ? 1 : $_GET['page'];
		$name = @$_GET['name'];
		$province_code = @$_GET['province_code'];
		$ampor_code = @$_GET['ampor_code'];
		$request_url = "http://app4.m-society.go.th/law/fund_org_service.php?page=".$current_page.'&name='.$name.'&province_code='.$province_code.'&ampor_code='.$ampor_code; 
		$xml = simplexml_load_file($request_url) or die("feed not loading");
		$data['xml'] = $xml;		
		if(count($xml)>0)$total_record = $xml->orgdata[0]->total_record;						
		$this->load->library('pagination');
		$page = new pagination();
		$page->target('fund_organize/index?name='.$name.'&province_code='.$province_code.'&ampor_code='.$ampor_code);
		$page->limit(20);
		@$page->currentPage($current_page);			
		$page->Items($total_record);			
		$this->pagination = $page->show();
		$data['pagination'] = $this->pagination;
		
		// --- select จังหวัด ---
		$request_url = "http://app4.m-society.go.th/law/province_code.php"; 
		$p_xml = simplexml_load_file($request_url) or die("feed not loading");
		$province_list = '<select name="province_code" id="province_code"><option value="">เลือกจังหวัด</option>';
		foreach($p_xml as $province):
			$selected = $province_code == $province->province_code ? 'selected="selected" ' : "";
			$province_list .='<option value="'.$province->province_code.'" '.$selected.'>'.$province->province_name.'</option>';
		endforeach;
		$province_list.= "</select>";
		$data['province_list'] = $province_list;
		
		// --- select อำเภอ ---
		$request_url = "http://app4.m-society.go.th/law/ampor_code.php?province_code=".$province_code; 
		$a_xml = simplexml_load_file($request_url) or die("feed not loading");
		$ampor_list = '<select name="ampor_code" id="ampor_code"><option value="">เลือกเขต/อำเภอ</option>';
		foreach($a_xml as $ampor):
			$selected = $ampor_code == $ampor->ampor_code ? 'selected="selected" ' : "";
			$ampor_list .='<option value="'.$ampor->ampor_code.'" '.$selected.'>'.$ampor->ampor_name.'</option>';
		endforeach;
		$ampor_list.= "</select>";
		$data['ampor_list'] = $ampor_list;
		
		$this->template->build('organize_index',$data);
	}

	function reload_ampor(){
		$province_code = $_POST['province_code'] ;
		$request_url = "http://app4.m-society.go.th/law/ampor_code.php?province_code=".$province_code; 
		$a_xml = simplexml_load_file($request_url) or die("feed not loading");
		$ampor_list = '<select name="ampor_code" id="ampor_code"><option value="">เลือกเขต/อำเภอ</option>';
		foreach($a_xml as $ampor):
			$ampor_list .='<option value="'.$ampor->ampor_code.'">'.$ampor->ampor_name.'</option>';
		endforeach;
		$ampor_list.= "</select>";
		echo $ampor_list;
	}
	
	function form($id=false){
		$request_url = "http://app4.m-society.go.th/law/fund_org_service.php?id=".$id; 
		$xml = simplexml_load_file($request_url) or die("feed not loading");
		//$data['organize'] = $this->organize->get_row($id);
		$data['organize'] = $xml->orgdata;
		
		$action_type = "VIEW";
		$action =" ดูรายละเอียดองค์กร ". $data['organize']->org_name;
		save_logfile($action_type,$action,$this->modules_name);
			
		$this->template->build('organize_form',$data);
	}
	
	function save(){
		if($_POST){
			$url_parameter = GetCurrentUrlGetParameter();
			$this->organize->save($_POST);
		 	set_notify('success', lang('save_data_complete'));
		}
		redirect('fund_organize/index'.$url_parameter);
	}
	
	function delete($id=false){
		if($id){
			$url_parameter = GetCurrentUrlGetParameter();
			$this->organize->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('fund_organize/index'.$url_parameter);
	}
	
	function select_district_ajax(){
		if($_POST){
			echo form_dropdown("district",get_option('id', 'title', 'cnf_district where province_id = '.$_POST['province_id']),'','','-- เลือกอำเภอ/เขต --','0');
			echo'<div class="loadingicon" style="display: inline;"></div>';
		}
	}
	
	function select_sub_ajax(){
		if($_POST){
			echo form_dropdown("subdistrict",get_option('id', 'title', 'cnf_subdistrict where district_id = '.$_POST['district_id']),'','','-- เลือกตำบล/แขวง --','0');
		}
	}
}
?>