<?php
class new_c_usergroup extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('usertype_title_model','usertype_title');
		$this->load->model('usertype_model','usertype');		
	}
	
	function index()
	{
		$condition = "WHERE 1=1 ";
		$condition .= isset($_GET['txtsearch']) ? " AND TITLE LIKE '%".$_GET['txtsearch']."%' " : "";
		$data['result']= isset($_GET['txtsearch']) ?  $this->usertype_title->get("SELECT * FROM USER_TYPE_TITLE ".$condition) :  $this->usertype_title->get();
		$data['pagination'] = $this->usertype_title->pagination();
		$pos = strrpos($_SERVER['REQUEST_URI'],'?');
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$this->template->build('usergroup_index',$data);		
	}
	
	function form($ID=FALSE){
		$data['url_parameter'] = GetCurrentUrlGetParameter();	
		@$data['result']= $this->usertype_title->get_row($ID);
		$this->template->build('usergroup_form',$data);
	}
	
	function save($ID=FALSE){
		//$this->db->debug = true;
		$url_parameter = GetCurrentUrlGetParameter();	
		
		$system_menu[1]['menu_title'] = array('','c_usergroup','c_user','c_document','c_department','c_division','c_workgroup','c_province_zone_type','c_province_zone','c_province_area','c_province','c_qty','budget','finance','monitor','inspect');
		$system_menu[1]['nmenu'] = count($system_menu[1]['menu_title'])-1;
		
		$system_menu[2]['menu_title'] = array('','budgeting','streategy','budgettype','asset','countunit','time','province','report','logfile');
		$system_menu[2]['nmenu'] = count($system_menu[2]['menu_title'])-1;
		
		
		$system_menu[3]['menu_title'] = array('','finance_budget_plan','finance_budget_id','finance_money_during_year','finance_budget_related','finance_approve_withdraw','finance_budget_return','finance_approve_withdraw_replace','finance_budget_percent','finance_report','finance_log');
		$system_menu[3]['nmenu'] = count($system_menu[3]['menu_title'])-1;
		
		
		$system_menu[4]['menu_title'] = array('','monitor_operation_withdraw','monitor_questionair','monitor_input_report','monitor_questionair_report','monitor_input_province','','monitor_input_center_dept','monitor_budget_plan','monitor_target_ministry_set','monitor_strategy_ministry_set','monitor_production_set','monitor_report','monitor_log');
		$system_menu[4]['nmenu'] = count($system_menu[4]['menu_title'])-1;
		
		
		$system_menu[5]['menu_title'] = array('','inspect_save','inspect_inspector_recomm','inspect_project_admin','inspect_member','inspector_group','inspect_risk_subject','inspect_project_management','inspect_round','inspect_report','inspect_log');
		$system_menu[5]['nmenu'] = count($system_menu[5]['menu_title'])-1;
		if($_POST){
		   $_POST['is_inspector'] = @$_POST['is_inspector']!='' ? 'on' : 'off';
		   $_POST['insp_access_all']  = @$_POST['insp_access_all']!='' ? 'on' : 'off';
		   $_POST['mt_access_all']  = @$_POST['mt_access_all']!='' ? 'on' : 'off';
		   $_POST['fn_access_all']  = @$_POST['fn_access_all']!='' ? 'on' : 'off';		
		   $_POST['budgetadmin']= @$_POST['budgetadmin']!='' ? 'on' : 'off';
		   $_POST['budgetcanaccessall']= @$_POST['budgetcanaccessall']!='' ? 'on' : 'off';	
		   $id = $this->usertype_title->save($_POST);
			$this->usertype->delete('user_id', $id);		
			$system = array('','bo','budget','finance','monitor','inspect');
			for($systemID=1;$systemID<=5;$systemID++)
			{
			  	for($m=1;$m<=$system_menu[$systemID]['nmenu'];$m++)
				{
					 $data['user_id'] = $id;
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
			//set_notify('success', lang('save_data_complete'));
		}
		redirect('c_usergroup/index'.$url_parameter);
	}
	function delete($ID=FALSE){
		$url_parameter = GetCurrentUrlGetParameter();
		$this->usertype_title->delete($ID);		
		redirect('c_usergroup/index'.$url_parameter);
	}

}
?>