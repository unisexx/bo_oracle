<?php
Class kss extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("kss_data_model","kss");
		$this->load->model("organization_main_model","orgmain");
		$this->load->model("fund_project_model","project");
	}
	
	function index(){
		// $this->db->debug = true;
		$data['years'] =$this->kss->get("SELECT DISTINCT BUDGET_YEAR from ACT_KSS_DATA ORDER BY BUDGET_YEAR DESC");
		
		$condition = @$_GET['search']!='' ? " and act_fund_project.project_name like '%".$_GET['search']."%'" : "";
		$condition .= @$_GET['budget_year']!='' ? " and act_kss_data.budget_year = ".$_GET['budget_year'] : "";
		$condition .= @$_GET['province_code']!='' ? " and act_kss_data.province_code = ".$_GET['province_code'] : "";
		$condition .= @$_GET['under_type']!='' ? " and act_organization_main.under_type = ".$_GET['under_type'] : "";
		
		$sql = "SELECT
		ACT_KSS_DATA.ID,
		ACT_KSS_DATA.PROVINCE_CODE,
		ACT_KSS_DATA.ORG_ID,
		ACT_KSS_DATA.AUDIT_DATE,
		ACT_KSS_DATA.ROUND_NO,
		ACT_FUND_PROJECT.PROJECT_NAME,
		ACT_ORGANIZATION_MAIN.ORGAN_NAME
		FROM ACT_KSS_DATA
		LEFT JOIN ACT_FUND_PROJECT ON ACT_FUND_PROJECT.PROJECT_ID = ACT_KSS_DATA.PROJECT_ID
		LEFT JOIN ACT_ORGANIZATION_MAIN ON ACT_KSS_DATA.ORG_ID = ACT_ORGANIZATION_MAIN.ORGAN_ID
		WHERE 1=1 ".$condition." ORDER BY ACT_KSS_DATA.ID DESC";
		
		$data['kss'] = $this->kss->get($sql,false);
		$data['pagination'] = $this->kss->pagination();
		$this->template->build('kss/index',$data);
	}
	
	function form($id=false){
		$data['kss'] = $this->kss->get_row($id);
		$this->template->build('kss/form',$data);
	}
	
	function save(){
		// $this->db->debug = true;
		if($_POST){
			$_POST['cb_tools'] =  @$_POST['cb_tools_1']!='' ? $_POST['cb_tools_1']."|" : "";
			$_POST['cb_tools'] .=  @$_POST['cb_tools_2']!='' ? $_POST['cb_tools_2']."|" : "";
			$_POST['cb_tools'] .=  @$_POST['cb_tools_3']!='' ? $_POST['cb_tools_3']."|" : "";
			$_POST['cb_tools'] .=  @$_POST['cb_tools_4']!='' ? $_POST['cb_tools_4']."|" : "";
			if(isset($_FILES["UploadFile"]))
			{
			   fix_file($_FILES["UploadFile"]);		    
			   $_POST['file_data'] = isset($_FILES["UploadFile"])!='' ? $this->kss->upload($_FILES["UploadFile"],"uploads/kss") : $_POST['file_data'];
			}
			$this->kss->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/kss');
	}

	function delete($id){
		if($id){
			$this->kss->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
	
	function organ_select(){
		// $this->db->debug = true;
		$condition = @$_GET['search']!='' ? " and L.ORGAN_NAME like '%".$_GET['search']."%'" : "";
		$condition .= @$_GET['budget_year']!='' ? " and F.BUDGET_YEAR = ".$_GET['budget_year'] : "";
		$condition .= @$_GET['province_code']!='' ? " and L.PROVINCE_CODE = ".$_GET['province_code'] : "";
		
		$sql = "SELECT DISTINCT
		L.ORGAN_ID,
		L.ORGAN_NAME,
		L.UNDER_TYPE_SUB,
		L.HOME_NO,
		L.O_NAME,
		L.MOO,
		L.SOI,
		L.ROAD,
		L.TUMBON_CODE,
		L.AMPOR_CODE,
		L.PROVINCE_CODE,
		L.TEL,
		L.FAX
		FROM
		ACT_ORGANIZATION_MAIN L
		LEFT JOIN ( SELECT ORG_ID,BUDGET_YEAR,PROVINCE_CODE FROM ACT_FUND_PROJECT ORDER BY ORG_ID ASC ) F 
		ON L.ORGAN_ID = F.ORG_ID
		WHERE 1=1 ".$condition;
		$data['orgmains'] = $this->orgmain->get($sql,FALSE);
		$data['pagination'] = $this->orgmain->pagination();
		$this->load->view('kss/organ_select',$data);
	}
	
	function project_list(){
		// $this->db->debug = true;
		if($_GET){
			$condition = $_GET['province_code'] !='' ? " AND PROVINCE_CODE = '".$_GET['province_code']."' " : "";
			$condition .= $_GET['org_id'] != '' ? " AND ORG_ID = '".$_GET['org_id']."' " : "";
			$sql = " SELECT  * FROM ACT_FUND_PROJECT WHERE 1=1 ".$condition." ORDER BY PROJECT_NAME ";
			$data['project_lists'] = $this->kss->get($sql,false);
			$this->load->view('kss/project_list',$data);
		}
	}
}
?>