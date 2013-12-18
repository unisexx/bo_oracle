<?php
class c_usergroup extends Admin_Controller
{
	public $modules_name = "c_usergroup";
	public $modules_title = "สิทธิ์การใช้งาน";
	function __construct()
	{
		parent::__construct();
		$this->load->model('usertype_title_model','usertype_title');
		$this->load->model('usertype_model','usertype');		
	}
	
	function index()
	{
		if(!permission($this->modules_name,'canview'))redirect('c_front');
		$condition = "WHERE 1=1 ";
		$condition .= isset($_GET['txtsearch']) ? " AND TITLE LIKE '%".$_GET['txtsearch']."%' " : "";
		$condition .= @$_GET['division']!=''? $_GET['division'] > 0 ?  " AND DIVISIONID=".$_GET['division'] : "" :"";
		$condition .= @$_GET['workgroup']!='' ? $_GET['workgroup'] > 0 ? " AND WORKGROUPID=".$_GET['workgroup'] : "" : "";
		$sql = "SELECT * FROM USERS INNER JOIN USER_TYPE_TITLE ON USERS.ID = USER_TYPE_TITLE.USER_ID ".$condition." ORDER BY TITLE ASC";
		
		$data['result'] = $this->usertype_title->get($sql);
		$data['pagination'] = $this->usertype_title->pagination();
		$pos = strrpos($_SERVER['REQUEST_URI'],'?');
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$this->template->build('usergroup_index',$data);		
	}
	
	function form($ID=FALSE){
		if(!permission($this->modules_name,'canview'))redirect('c_front');
		$data['url_parameter'] = GetCurrentUrlGetParameter();	
		@$data['result']= $this->usertype_title->get_row($ID);
		
		if($ID>0){
			new_save_logfile("VIEW",$this->modules_title,$this->usertype_title->table,"ID",$ID,"title",$this->modules_name);			
		}
		
		$this->template->build('usergroup_form',$data);
	}
	
	function save(){
		//$this->db->debug = true;
		$url_parameter = GetCurrentUrlGetParameter();	
		$_POST['lv'] = $_POST['lv']=='' ? 1 : $_POST['lv'];
		if($_POST['id']>0)
		{
		   if(!permission($this->modules_name,'canedit'))redirect('c_usergroup');
		}else{		   	   	
		   if(!permission($this->modules_name,'canadd'))redirect('c_usergroup');
		}
		
		$system_menu[1]['menu_title'] = array('','c_usergroup','c_user','c_document','c_department','c_division','c_workgroup','c_province_zone_type','c_province_zone','c_province_area','c_province','c_qty','budget','finance','monitor','inspect','c_log');
		$system_menu[1]['nmenu'] = count($system_menu[1]['menu_title'])-1;
		
		$system_menu[2]['menu_title'] = array('','budget_request','streategy','budgettype','asset','countunit','time','province','report','logfile');
		$system_menu[2]['nmenu'] = count($system_menu[2]['menu_title'])-1;
		
		
		$system_menu[3]['menu_title'] = array('','finance_budget_plan','finance_budget_id','finance_money_during_year','finance_budget_related','finance_approve_withdraw','finance_budget_return','finance_approve_withdraw_replace','finance_budget_percent','finance_report','finance_log');
		$system_menu[3]['nmenu'] = count($system_menu[3]['menu_title'])-1;
		
		
		$system_menu[4]['menu_title'] = array('','monitor_operation_withdraw','monitor_questionair','monitor_input_report','monitor_questionair_report','monitor_input_province','','monitor_input_center_dept','monitor_budget_plan','monitor_target_ministry_set','monitor_report','monitor_log','monitor_stp06');
		$system_menu[4]['nmenu'] = count($system_menu[4]['menu_title'])-1;
		
		
		$system_menu[5]['menu_title'] = array('','inspect_save','inspect_inspector_recomm','inspect_project_admin','inspect_member','inspector_group','inspect_risk_subject','inspect_project_management','inspect_round','inspect_level','inspect_report_risk','inspect_log','inspect_budget','inspect_alert','inspect_report_recomm');
		$system_menu[5]['nmenu'] = count($system_menu[5]['menu_title'])-1;
		
		$system_menu[6]['menu_title'] = array('','fund_contract','fund_attorney','fund_organize','fund_log');
		$system_menu[6]['nmenu'] = count($system_menu[6]['menu_title'])-1;
		
		if($_POST){
		   $_POST['is_inspector'] = @$_POST['is_inspector']!='' ? 'on' : 'off';
		   $_POST['insp_access_all']  = @$_POST['insp_access_all']!='' ? 'on' : 'off';
		   $_POST['mt_access_all']  = @$_POST['mt_access_all']!='' ? 'on' : 'off';
		   $_POST['fn_access_all']  = @$_POST['fn_access_all']!='' ? 'on' : 'off';		
		   $_POST['budgetadmin']= @$_POST['budgetadmin']!='' ? 'on' : 'off';
		   $_POST['budgetcanaccessall']= @$_POST['budgetcanaccessall']!='' ? 'on' : 'off';	
		   $_POST['fund_access_all']  = @$_POST['fund_access_all']!='' ? 'on' : 'off';
		   $id = $this->usertype_title->save($_POST);
			$this->usertype->delete('USERTYPETITLEID', $id);		
			$system = array('','bo','budget','finance','monitor','inspect','fund');
			for($systemID=1;$systemID<=6;$systemID++)
			{
			  	for($m=1;$m<=$system_menu[$systemID]['nmenu'];$m++)
				{
					 $data['USERTYPETITLEID'] = $id;
					 $data['menuid'] = $m; 
					 $data['canview'] = @$_POST['View_'.$systemID.'_'.$m] != '' ? 'on' : 'off';
					 $data['canadd'] = @$_POST['Add_'.$systemID.'_'.$m] != '' ? 'on' : 'off';
					 $data['canedit'] = @$_POST['Edit_'.$systemID.'_'.$m] != '' ? 'on' : 'off';
					 $data['candelete']= @$_POST['Delete_'.$systemID.'_'.$m] != '' ? 'on' : 'off';
					 $data['systemid'] = $systemID;
					 $data['systemname'] = $system[$systemID];
					 $data['modulename'] = $system_menu[$systemID]['menu_title'][$m];
					 $this->usertype->save($data);					 					 					
				}
			}
			if(@$_POST['id']>0){
				new_save_logfile("EDIT",$this->modules_title,$this->usertype_title->table,"ID",$id,"title",$this->modules_name);		
			}else{				
				new_save_logfile("ADD",$this->modules_title,$this->usertype_title->table,"ID",$id,"title",$this->modules_name);
			}			
			//set_notify('success', lang('save_data_complete'));
		}
		redirect('c_usergroup/index'.$url_parameter);
	}
	function delete($ID=FALSE){
		if(!permission($this->modules_name,'candelete'))redirect('c_usergroup');			
		$url_parameter = GetCurrentUrlGetParameter();
		new_save_logfile("DELETE",$this->modules_title,$this->usertype_title->table,"ID",$ID,"title",$this->modules_name);		
		$this->usertype->delete("usertypetitleid",$ID);		
		$this->usertype_title->delete($ID);		
		redirect('c_usergroup/index'.$url_parameter);
	}

	function export(){
		$condition = "WHERE 1=1 ";
		$condition .= isset($_GET['txtsearch']) ? " AND TITLE LIKE '%".$_GET['txtsearch']."%' " : "";
		$condition .= @$_GET['division']!=''? $_GET['division'] > 0 ?  " AND DIVISIONID=".$_GET['division'] : "" :"";
		$condition .= @$_GET['workgroup']!='' ? $_GET['workgroup'] > 0 ? " AND WORKGROUPID=".$_GET['workgroup'] : "" : "";
		$sql = "SELECT * FROM USERS INNER JOIN USER_TYPE_TITLE ON USERS.ID = USER_TYPE_TITLE.USER_ID ".$condition;
		
		$data['result'] = $this->usertype_title->get($sql);
		$pos = strrpos($_SERVER['REQUEST_URI'],'?');
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$this->load->view('export',$data);	
	}
}
?>