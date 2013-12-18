<?php
class c_user_permission_report extends Admin_Controller
{
	public $modules_name = "c_user";
	public $modules_title = "ข้อมูลผู้ใช้";
	function __construct()
	{
		parent::__construct();
		$this->load->model('c_user_permission_model','users_permission');
		$this->load->model('c_usergroup/usertype_title_model','usertype_title');
		$this->load->model('c_usergroup/usertype_model','usertype');	
		$this->load->model('c_workgroup/workgroup_model','workgroup');
		$this->load->model('c_division/division_model','division');
		$this->load->model('c_department/department_model','department');								
	}
	
	function index()
	{
		//$this->db->debug=TRUE;
		if(!permission($this->modules_name,'canview'))redirect('c_front');
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$condition =" 1=1 ";		
		$condition .= @$_GET['txtsearch']!='' ? " AND (USERS.USERNAME LIKE '%".$_GET['txtsearch']."%' OR USERS.NAME LIKE '%".$_GET['txtsearch']."%' OR FIRSTNAME LIKE '%".$_GET['txtsearch']."%' OR LASTNAME LIKE '%".$_GET['txtsearch']."%') ": "";
		$condition .= @$_GET['division']!=''? $_GET['division'] > 0 ?  " AND DIVISIONID=".$_GET['division'] : "" :"";
		$condition .= @$_GET['usertype']!=''? $_GET['usertype'] > 0 ? " AND USERTYPE =".$_GET['usertype'] : "" : "";
		$condition .= @$_GET['workgroup']!='' ? $_GET['workgroup'] > 0 ? " AND WORKGROUPID=".$_GET['workgroup'] : "" : "";
		$sql = "SELECT USERS.* FROM USERS 
		LEFT JOIN CNF_DIVISION ON USERS.DIVISIONID = CNF_DIVISION.ID 
		LEFT JOIN CNF_WORKGROUP ON USERS.WORKGROUPID = CNF_WORKGROUP.ID 
		WHERE 1=1".$condition." ORDER BY DIVISIONID, WORKGROUPID ";
		$data['result'] = $this->users_permission->where($condition)->get(FALSE,FALSE,' ORDER BY cnf_division.title, cnf_workgroup.title');		
		$data['pagination'] = $this->users_permission->pagination();	
		
		$nrecord = $this->db->getone("SELECT COUNT(*) FROM USERS");		
	 	$Per_Page = 100;
		if($nrecord<=$Per_Page) 
		{ 				
			$num_part =1; 
		} 
		else if(($nrecord % $Per_Page)==0) 
		{ 
			$num_part =($nrecord/$Per_Page) ; 
		} 
		else
		{ 
			$num_part =($nrecord/$Per_Page)+1; 
			$num_part = (int)$num_part; 
		} 		
		$data['num_part'] = $num_part;
		
		$this->template->build('index',$data);		
	}

	function export()
	{
		header("Content-Disposition: attachment; filename=userpermission_".$_GET['page'].".xls");
		$condition =" 1=1 ";		
		$condition .= @$_GET['txtsearch']!='' ? " AND (USERS.USERNAME LIKE '%".$_GET['txtsearch']."%' OR USERS.NAME LIKE '%".$_GET['txtsearch']."%' OR FIRSTNAME LIKE '%".$_GET['txtsearch']."%' OR LASTNAME LIKE '%".$_GET['txtsearch']."%') ": "";
		$condition .= @$_GET['division']!=''? $_GET['division'] > 0 ?  " AND DIVISIONID=".$_GET['division'] : "" :"";
		$condition .= @$_GET['usertype']!=''? $_GET['usertype'] > 0 ? " AND USERTYPE =".$_GET['usertype'] : "" : "";
		$condition .= @$_GET['workgroup']!='' ? $_GET['workgroup'] > 0 ? " AND WORKGROUPID=".$_GET['workgroup'] : "" : "";
		$data['result'] = $this->users_permission->limit(100)->get(FALSE,FALSE,' ORDER BY cnf_division.title, cnf_workgroup.title');	
		$data['pagination'] = $this->users_permission->pagination();		
		$this->load->view('export',$data);		
	}		
}
?>