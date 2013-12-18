<?php
class import_data extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('monitor_questionair/monitor_questionair_model','question');
		$this->load->model('c_department/department_model','department');
		$this->load->model('c_division/division_model','division');
		$this->load->model('c_workgroup/workgroup_model','workgroup');
		$this->load->model('c_province/province_model','province');
		$this->load->model('c_user/user_model','user');
		$this->load->model('c_usergroup/usertype_model','usertype');
		$this->load->model('c_usergroup/usertype_title_model','usertype_title');
	}
	
	function index()
	{
		$data='';
		
		$file = "uploads/mt_questionair_all.sql";
		$lines = count(file($file));
		$data['lines']=$lines;
		
		$round = $lines / 10000;
		$round =  number_format($round,0);		
		
		$data['part']='';
		
		$i=1;
		
		while($i<=$round){			
			$data['part'].='<li><a href="import_data/import/'.$i.'" target="_blank"> Part'.$i.'</a></li>';
			$i++;
		}
		
		$data['permission'] = "<h4>กำหนดสิทธิ์</h4>";
		$data['permission'] .="<ul>
			<li><a href=\"import_data/user_set_permission/108\" target=\"_blank\">ศูนย์พัฒนา</a></li>
			<li><a href=\"import_data/user_set_permission/110\" target=\"_blank\">บ้านพักเด็กและครอบครัว</a></li>
			<li><a href=\"import_data/user_set_permission/105\" target=\"_blank\">พมจ.76 จังหวัด</a></li>
		</ul>";
		
		$this->template->build("index",$data);
	}
	function import($part=FALSE){		
		if($part > 0){
		$i=0;
		$strFileName = "uploads/mt_questionair".$part.".sql";
		$objFopen = fopen($strFileName, 'r');
		if ($objFopen) {
			while (!feof($objFopen)) {
				 $file = iconv('WINDOWS-874','UTF-8',fgets($objFopen, 10000));
				 $file = str_replace(';','',$file);
				 echo $file."<br/>";
				 $this->db->Execute( iconv('UTF-8','TIS-620//IGNORE',$file));
				 //$this->db->Execute($file);
				//echo $file."<br>";
				$i++;
			}
			fclose($objFopen);
		}
	  	echo "Complete : ".$i." Records";
		}	  					
	}
	
	function user_set_permission($division_id=false){
		if($division_id > 0){
			$b=0;
			$user = $this->user->where("divisionid=".$division_id)->get(FALSE,TRUE);
			foreach($user as $uitem){
			//if($b>1)exit(); else $b++;
			$usertype_title = $this->usertype_title->where("user_id=".$uitem['id'])->get(FALSE,TRUE);
			foreach($usertype_title as $item)
			{
				$this->db->Execute("DELETE FROM USERTYPE WHERE USERTYPETITLEID=".$item['id']);
				$this->db->Execute("DELETE FROM USER_TYPE_TITLE WHERE ID=".$item['id']);
			}
			$data['title'] = $uitem['name'];
			$data['budgetadmin'] = 'off';
			$data['budgetcanaccessall'] = 'off';
			$data['lv'] = 1;
			$data['is_inspector'] = 'off';
			$data['insp_access_all'] = 'off';
			$data['mt_access_all'] = 'off';
			$data['fn_access_all'] = 'off';
			$data['user_id'] = $uitem['id'];				
			
			$usertype_title_id = $this->usertype_title->save($data);					
			
		$module_1 = array('','c_usergroup','c_user','c_document','c_department','c_division','c_workgroup','c_province_zone_type','c_province_zone','c_province_area','c_province','c_qty','budget','finance','monitor','inspect');											
		for($i=1;$i<=15;$i++){				
			$view_stat = $i==14 || $i==15 ? "on" : "off";
			$add_stat = "off";
			$edit_stat = "off";
			$delete_stat = "off";
			$system_id = 1;
			$system_name = "bo";
			
			
			$sql = "INSERT INTO USERTYPE VALUES("
			.$usertype_title_id.","
			.$i.",'"
			.$view_stat."','"
			.$add_stat."','"
			.$edit_stat."','"
			.$delete_stat."',"
			.$system_id.",(select COALESCE(max(ID),0)+1 from USERTYPE ),'"
			.$system_name."','"
			.$module_1[$i]."')";
			$this->db->Execute($sql);
			/*
			INSERT INTO USERTYPE VALUES(96,1,'off','off','off','off',1,9981,'bo','c_usergroup'); 			
			INSERT INTO USERTYPE VALUES(96,2,'off','off','off','off',1,9982,'bo','c_user'); 
			INSERT INTO USERTYPE VALUES(96,3,'off','off','off','off',1,9983,'bo','c_document'); 
			INSERT INTO USERTYPE VALUES(96,4,'off','off','off','off',1,9984,'bo','c_department'); 
			INSERT INTO USERTYPE VALUES(96,5,'off','off','off','off',1,9985,'bo','c_division'); 
			INSERT INTO USERTYPE VALUES(96,6,'off','off','off','off',1,9986,'bo','c_workgroup'); 
			INSERT INTO USERTYPE VALUES(96,7,'off','off','off','off',1,9987,'bo','c_province_zone_type'); 
			INSERT INTO USERTYPE VALUES(96,8,'off','off','off','off',1,9988,'bo','c_province_zone'); 
			INSERT INTO USERTYPE VALUES(96,9,'off','off','off','off',1,9989,'bo','c_province_area'); 
			INSERT INTO USERTYPE VALUES(96,10,'off','off','off','off',1,9990,'bo','c_province'); 
			INSERT INTO USERTYPE VALUES(96,11,'off','off','off','off',1,9991,'bo','c_qty'); 
			INSERT INTO USERTYPE VALUES(96,12,'off','off','off','off',1,9992,'bo','budget'); 
			INSERT INTO USERTYPE VALUES(96,13,'off','off','off','off',1,9993,'bo','finance'); 
			INSERT INTO USERTYPE VALUES(96,14,'off','off','off','off',1,9994,'bo','monitor'); 
			INSERT INTO USERTYPE VALUES(96,15,'on','off','off','off',1,9995,'bo','inspect'); 
			*/
		}
		
		$module_2 = array('','budgeting','streategy','budgettype','asset','countunit','time','province','report','logfile');
		for($i=1;$i<=9;$i++){				
			$view_stat = "off";
			$add_stat = "off";
			$edit_stat = "off";
			$delete_stat = "off";
			$system_id = 2;
			$system_name = "budget";
			
			
			$sql = "INSERT INTO USERTYPE VALUES("
			.$usertype_title_id.","
			.$i.",'"
			.$view_stat."','"
			.$add_stat."','"
			.$edit_stat."','"
			.$delete_stat."',"
			.$system_id.",(select COALESCE(max(ID),0)+1 from USERTYPE ),'"
			.$system_name."','"
			.$module_2[$i]."')";
			$this->db->Execute($sql);
			
			/*
			INSERT INTO USERTYPE VALUES(96,1,'off','off','off','off',2,9996,'budget','budgeting'); 
			INSERT INTO USERTYPE VALUES(96,2,'off','off','off','off',2,9997,'budget','streategy'); 
			INSERT INTO USERTYPE VALUES(96,3,'off','off','off','off',2,9998,'budget','budgettype'); 
			INSERT INTO USERTYPE VALUES(96,4,'off','off','off','off',2,9999,'budget','asset'); 
			INSERT INTO USERTYPE VALUES(96,5,'off','off','off','off',2,10000,'budget','countunit'); 
			INSERT INTO USERTYPE VALUES(96,6,'off','off','off','off',2,10001,'budget','time'); 
			INSERT INTO USERTYPE VALUES(96,7,'off','off','off','off',2,10002,'budget','province'); 
			INSERT INTO USERTYPE VALUES(96,8,'off','off','off','off',2,10003,'budget','report'); 
			INSERT INTO USERTYPE VALUES(96,9,'off','off','off','off',2,10004,'budget','logfile'); 
			 */
		}
		
		
		$module_3 = array('','finance_budget_plan','finance_budget_id','finance_money_during_year','finance_budget_related','finance_approve_withdraw','finance_budget_return','finance_approve_withdraw_replace','finance_budget_percent','finance_report','finance_log');
		for($i=1;$i<=10;$i++){				
			$view_stat = "off";
			$add_stat = "off";
			$edit_stat = "off";
			$delete_stat = "off";
			$system_id = 3;
			$system_name = "finance";
			
			
			$sql = "INSERT INTO USERTYPE VALUES("
			.$usertype_title_id.","
			.$i.",'"
			.$view_stat."','"
			.$add_stat."','"
			.$edit_stat."','"
			.$delete_stat."',"
			.$system_id.",(select COALESCE(max(ID),0)+1 from USERTYPE ),'"
			.$system_name."','"
			.$module_3[$i]."')";
			$this->db->Execute($sql);
			
			/*
			INSERT INTO USERTYPE VALUES(96,1,'off','off','off','off',3,10005,'finance','finance_budget_plan'); 
			INSERT INTO USERTYPE VALUES(96,2,'off','off','off','off',3,10006,'finance','finance_budget_id'); 
			INSERT INTO USERTYPE VALUES(96,3,'off','off','off','off',3,10007,'finance','finance_money_during_year'); 
			INSERT INTO USERTYPE VALUES(96,4,'off','off','off','off',3,10008,'finance','finance_budget_related'); 
			INSERT INTO USERTYPE VALUES(96,5,'off','off','off','off',3,10009,'finance','finance_approve_withdraw'); 
			INSERT INTO USERTYPE VALUES(96,6,'off','off','off','off',3,10010,'finance','finance_budget_return'); 
			INSERT INTO USERTYPE VALUES(96,7,'off','off','off','off',3,10011,'finance','finance_approve_withdraw_replace'); 
			INSERT INTO USERTYPE VALUES(96,8,'off','off','off','off',3,10012,'finance','finance_budget_percent'); 
			INSERT INTO USERTYPE VALUES(96,9,'off','off','off','off',3,10013,'finance','finance_report'); 
			INSERT INTO USERTYPE VALUES(96,10,'off','off','off','off',3,10014,'finance','finance_log'); 
			*/
		}
		
		
		$module_4 = array('','monitor_operation_withdraw','monitor_questionair','monitor_input_report','monitor_questionair_report','monitor_input_province','','monitor_input_center_dept','monitor_budget_plan','monitor_target_ministry_set','monitor_strategy_ministry_set','monitor_production_set','monitor_report','monitor_log');
		for($i=1;$i<=13;$i++){				
			$view_stat = $i == 1 || $i==2 || $i==3 || $i==4 || $i == 5 || $i==12 ? "on" : "off";
			$add_stat = $i == 1 || $i==2 || $i==3 || $i==4 || $i == 5  ? "on" : "off";
			$edit_stat = $i == 1 || $i==2 || $i==3 || $i==4 || $i == 5 ? "on" : "off";
			$delete_stat = $i == 1 || $i==2 || $i==3 || $i==4 || $i == 5 ? "on" : "off";
			$system_id = 4;
			$system_name = "monitor";
			
			
			$sql = "INSERT INTO USERTYPE VALUES("
			.$usertype_title_id.","
			.$i.",'"
			.$view_stat."','"
			.$add_stat."','"
			.$edit_stat."','"
			.$delete_stat."',"
			.$system_id.",(select COALESCE(max(ID),0)+1 from USERTYPE ),'"
			.$system_name."','"
			.$module_4[$i]."')";
			$this->db->Execute($sql);
			
			/*
			INSERT INTO USERTYPE VALUES(96,1,'off','off','off','off',4,10015,'monitor','monitor_operation_withdraw'); 
			INSERT INTO USERTYPE VALUES(96,2,'off','off','off','off',4,10016,'monitor','monitor_questionair'); 
			INSERT INTO USERTYPE VALUES(96,3,'off','off','off','off',4,10017,'monitor','monitor_input_report'); 
			INSERT INTO USERTYPE VALUES(96,4,'off','off','off','off',4,10018,'monitor','monitor_questionair_report'); 
			INSERT INTO USERTYPE VALUES(96,5,'off','off','off','off',4,10019,'monitor','monitor_input_province'); 
			INSERT INTO USERTYPE VALUES(96,6,'off','off','off','off',4,10020,'monitor',''); 
			INSERT INTO USERTYPE VALUES(96,7,'off','off','off','off',4,10021,'monitor','monitor_input_center_dept'); 
			INSERT INTO USERTYPE VALUES(96,8,'off','off','off','off',4,10022,'monitor','monitor_budget_plan'); 
			INSERT INTO USERTYPE VALUES(96,9,'off','off','off','off',4,10023,'monitor','monitor_target_ministry_set'); 
			INSERT INTO USERTYPE VALUES(96,10,'off','off','off','off',4,10024,'monitor','monitor_strategy_ministry_set'); 
			INSERT INTO USERTYPE VALUES(96,11,'off','off','off','off',4,10025,'monitor','monitor_production_set'); 
			INSERT INTO USERTYPE VALUES(96,12,'off','off','off','off',4,10026,'monitor','monitor_report'); 
			INSERT INTO USERTYPE VALUES(96,13,'off','off','off','off',4,10027,'monitor','monitor_log'); 
			*/
		}
		
		$module_5= array('',
		'inspect_save',
		'inspect_inspector_recomm',
		'inspect_project_admin',
		'inspect_member',
		'inspector_group',
		'inspect_risk_subject',
		'inspect_project_management',
		'inspect_round',
		'inspect_level',
		'inspect_report_risk',
		'inspect_log',
		'inspect_budget',
		'inspect_alert',
		'inspect_report_recomm');		
		for($i=1;$i<=14;$i++){				
			$view_stat = $i==1 || $i==2  || $i==12 || $i==14 ? "on" : "off";
			$add_stat = $i==1 || $i==2  || $i==12 ? "on" : "off";
			$edit_stat = $i==1 || $i==2  || $i==12 ? "on" : "off";
			$delete_stat = $i==1 || $i==2  || $i==12  ? "on" : "off";
			$system_id = 5;
			$system_name = "inspect";
			
			
			$sql = "INSERT INTO USERTYPE VALUES("
			.$usertype_title_id.","
			.$i.",'"
			.$view_stat."','"
			.$add_stat."','"
			.$edit_stat."','"
			.$delete_stat."',"
			.$system_id.",(select COALESCE(max(ID),0)+1 from USERTYPE ),'"
			.$system_name."','"
			.$module_5[$i]."')";
			$this->db->Execute($sql);
			
			/*
			INSERT INTO USERTYPE VALUES(96,1,'on','on','on','on',5,10028,'inspect','inspect_save'); 
			INSERT INTO USERTYPE VALUES(96,2,'on','on','on','on',5,10029,'inspect','inspect_inspector_recomm'); 
			INSERT INTO USERTYPE VALUES(96,3,'on','on','on','on',5,10030,'inspect','inspect_project_admin'); 
			INSERT INTO USERTYPE VALUES(96,4,'off','off','off','off',5,10031,'inspect','inspect_member'); 
			INSERT INTO USERTYPE VALUES(96,5,'off','off','off','off',5,10032,'inspect','inspector_group'); 
			INSERT INTO USERTYPE VALUES(96,6,'off','off','off','off',5,10033,'inspect','inspect_risk_subject'); 
			INSERT INTO USERTYPE VALUES(96,7,'off','off','off','off',5,10034,'inspect','inspect_project_management'); 
			INSERT INTO USERTYPE VALUES(96,8,'off','off','off','off',5,10035,'inspect','inspect_round'); 
			INSERT INTO USERTYPE VALUES(96,9,'off','off','off','off',5,10036,'inspect','inspect_level'); 
			INSERT INTO USERTYPE VALUES(96,10,'on','off','off','off',5,10037,'inspect','inspect_report'); 
			INSERT INTO USERTYPE VALUES(96,11,'off','off','off','off',5,10038,'inspect','inspect_log'); 
			INSERT INTO USERTYPE VALUES(96,12,'off','off','off','off',5,10039,'inspect','inspect_budget'); 
			INSERT INTO USERTYPE VALUES(96,13,'off','off','off','off',5,10040,'inspect','inspect_alert');
			*/
		}
			
			
			
			
			
			
			
			
			
			}
		}
	}
	
	
}