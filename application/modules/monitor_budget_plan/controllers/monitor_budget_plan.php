<?php
class Monitor_budget_plan extends Monitor_Controller
{
	public $modules_name = "monitor_budget_plan";
	public $modules_title ="แผนงบประมาณ";
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mt_budget_plan_model','mt_strategy');
		$this->load->model('mt_strategy_key_model','mt_strategy_key');
		$this->load->model('mt_project_model','mt_project');
		$this->load->model('mt_project_detail_model','mt_project_detail');
		$this->load->model('mt_project_subdetail_model','mt_project_subdetail');
		$this->load->model('mt_budget_record_model','budget_record');
		$this->load->model('finance_budget_plan/fn_budget_plan_model','fn_strategy');	
		$this->load->model('c_department/department_model','department');
		$this->load->model('c_division/division_model','division');		
		$this->load->model('finance_budget_plan/fn_budget_type_model','fn_budget_type');
		$this->load->model('c_province/province_model','province');
	}
	
	function index()
	{
		//$this->db->debug = true;		
		if(!permission($this->modules_name,'canview'))redirect('monitor');	
		$data['budget_level'] = array('','department_service_target','department_strategy','department_target_year','division_service_target','division_strategy','productivity','mainactivity','subactivity','project','subproject');
		db_connect(BUDGET_DSN,BUDGET_DBUSER,BUDGET_DBPASSWORD);
		$sql = "SELECT DISTINCT BUDGETYEAR FROM BUDGET_MASTER ORDER BY BUDGETYEAR DESC ";
		$result = db_query($sql,BUDGET_DSN);
		while($srow = db_fetch_array($result,0)){            
    	$option = '<option value="'.$srow['BUDGETYEAR'].'">'.($srow['BUDGETYEAR']+543).'</option>';             
		}
    	db_close(BUDGET_DSN);
		$data['option'] = $option;
		$data['mtyear'] = isset($_GET['mtyear']) ? $_GET['mtyear'] : "";
		$data['mtdepartment'] = isset($_GET['mtdepartment']) ? $_GET['mtdepartment'] : ""; 
		$data['fnyear'] = $this->fn_strategy->get("SELECT DISTINCT FNYEAR FROM ".$this->fn_strategy->table,TRUE);
		$data['dept_opt'] = $this->department->get(FALSE,TRUE);
		if($data['mtyear']>0){
		$condition = $data['mtdepartment']!='' ? " AND DepartmentID=".$data['mtdepartment'] : ""; 		
		$data['st_department'] = $this->department->where("id IN (SELECT DISTINCT departmentid FROM mt_strategy WHERE PID=0 and mtyear=".$data['mtyear'].$condition.')')->get(FALSE,TRUE);
		}				
		$this->template->build('monitor_budget_plan_index',$data);		
	}
	
	function form($lv=FALSE,$pid=FALSE,$id=FALSE)
	{
		//$this->db->debug=true;
		if(!permission($this->modules_name,'canview'))redirect('monitor');
		if($id>0)new_save_logfile("VIEW",$this->modules_title,$this->mt_strategy->table,"ID",$id,"title",$this->modules_name);
		$data['budget_level'] = array('','department_service_target','department_strategy','department_target_year','division_service_target','division_strategy','productivity','mainactivity','subactivity','project','subproject');
		$data['lv'] = $lv;
		$data['pid']=$pid == FALSE ? 0 : $pid;
		$data['id']=$id  == FALSE ? 0 : $id;	
		$nlv = array_search($lv, $data['budget_level']);
		
		if($nlv<9){
			$data['parent']	= $pid > 0 ? $this->mt_strategy->get_row($pid) : array();
			$data['current'] = $id > 0 ? $this->mt_strategy->get_row($id) : array();
		}
		else if($nlv==9)
		{
			$data['parent'] = $this->mt_strategy->get_row($pid);
			$data['current'] = $this->mt_project->get_row($id);
		}
		else if($nlv==10)
		{
			$data['project'] = $this->mt_project->get_row($pid);
			$data['parent']	=  $this->mt_strategy->get_row($data['project']['subactid']);
			$data['current'] = $this->mt_project->get_row($id);	
		}				
		if($nlv==6 && $id > 0)
		{
			$data['strategy_key'] = $this->mt_strategy_key->where("PID=".$id)->get(FALSE,TRUE);
		}
		else
		{
			//$data['strategy_key'] = array('');	
		}
		$data['year_opt'] = $this->fn_strategy->get("SELECT DISTINCT FNYEAR FROM ".$this->fn_strategy->table,TRUE);
		$data['dept_opt'] = $this->department->get(FALSE,TRUE);
		$data['result'] = $this->mt_strategy->get_row($id);
		$data['division'] = @$data['parent']['departmentid'] > 0 ?  $this->division->where("departmentid = ".$data['parent']['departmentid'])->get(FALSE,TRUE) : '';
		$this->template->build('monitor_budget_plan_form',$data);
	}
	
	function project_form($lv=FALSE,$pid=FALSE,$id=FALSE)
	{
		//$this->db->debug = true;		
		if(!permission($this->modules_name,'canview'))redirect('monitor');	
		if($id>0)new_save_logfile("VIEW",$this->modules_title,$this->mt_project->table,"ID",$id,"title",$this->modules_name);			
		$data['budget_level'] = array('','department_service_target','department_strategy','department_target_year','division_service_target','division_strategy','productivity','mainactivity','subactivity','project','subproject');
		$data['lv'] = $lv;
		$data['pid']=$pid == FALSE ? 0 : $pid;
		$data['id']=$id  == FALSE ? 0 : $id;	
		$nlv = array_search($lv, $data['budget_level']);
		
		if($nlv<9){
			$data['parent']	= $pid > 0 ? $this->mt_strategy->get_row($pid) : array();
			$data['current'] = $id > 0 ? $this->mt_strategy->get_row($id) : array();
		}
		else if($nlv==9)
		{
			$data['parent'] = $this->mt_strategy->get_row($pid);
			$data['current'] = $this->mt_project->get_row($id);
		}
		else if($nlv==10)
		{
			$data['project'] = $this->mt_project->get_row($pid);
			$data['parent']	=  $this->mt_strategy->get_row($data['project']['subactid']);
			$data['current'] = $this->mt_project->get_row($id);	
		}				
		if($nlv==6 && $id > 0)
		{
			$data['strategy_key'] = $this->mt_strategy_key->where("PID=".$id)->get(FALSE,TRUE);
		}
		else
		{
			$data['strategy_key'] = array('');	
		}

		if($id>0){
		$sql = "SELECT mt_budget_record.provinceid id,cnf_province.title title FROM MT_BUDGET_RECORD left join cnf_province on mt_budget_record.provinceid = cnf_province.id where masterid = ".$id." and mainprojectid = ".$pid." and provinceid <> 2";
		$data['province_selected'] = $this->budget_record->get($sql,TRUE);
		
		$sql = "SELECT mt_budget_record.divisionid id,cnf_division.title title FROM MT_BUDGET_RECORD left join cnf_division on mt_budget_record.divisionid = cnf_division.id where masterid = ".$id." and mainprojectid = ".$pid." and mt_budget_record.provinceid = 2";
		$data['division_selected'] = $this->budget_record->get($sql,TRUE);
		
		$sql = "SELECT * from CNF_PROVINCE where id not in (select provinceid from mt_budget_record where mainprojectid = ".$pid." and masterid = ".$id.") AND id <> 2";
		$data['province'] = $this->province->get($sql,TRUE);		
		
		$sql = "SELECT * from CNF_DIVISION where id not in (select divisionid from mt_budget_record where mainprojectid = ".$pid." and masterid = ".$id." and divisionid > 0) AND departmentid=".$data['parent']['departmentid']." AND PROVINCEID =2 ";		
		$data['central_division'] = $this->division->get($sql,TRUE);			
		}else{		
			$data['province'] = $this->province->where("id <> 2")->order_by("id","asc")->get(FALSE,TRUE);		
			$data['central_division'] = $this->division->where("PROVINCEID=2 AND DEPARTMENTID=".$data['parent']['departmentid'])->order_by("id","asc")->get(FALSE,TRUE);	
		}
		
		$data['year_opt'] = $this->fn_strategy->get("SELECT DISTINCT FNYEAR FROM ".$this->fn_strategy->table,TRUE);
		$data['dept_opt'] = $this->department->get(FALSE,TRUE);
		$data['result'] = $this->mt_strategy->get_row($id);
		$data['division'] = @$data['parent']['departmentid'] > 0 ?  $this->division->where("departmentid = ".$data['parent']['departmentid'])->get(FALSE,TRUE) : '';
		$this->template->build('project_form',$data);
	}

	function sub_project_form($lv=FALSE,$pid=FALSE,$id=FALSE)
	{
		//$this->db->debug=true;
		if(!permission($this->modules_name,'canview'))redirect('monitor');		
		if($id>0)new_save_logfile("VIEW",$this->modules_title,$this->mt_project->table,"ID",$id,"title",$this->modules_name);
		$data['budget_level'] = array('','department_service_target','department_strategy','department_target_year','division_service_target','division_strategy','productivity','mainactivity','subactivity','project','subproject');
		$data['lv'] = $lv;
		$data['pid']=$pid == FALSE ? 0 : $pid;
		$data['id']=$id  == FALSE ? 0 : $id;	
		$nlv = array_search($lv, $data['budget_level']);
		
		if($nlv<9){
			$data['parent']	= $pid > 0 ? $this->mt_strategy->get_row($pid) : array();
			$data['current'] = $id > 0 ? $this->mt_strategy->get_row($id) : array();
		}
		else if($nlv==9)
		{
			$data['parent'] = $this->mt_strategy->get_row($pid);
			$data['current'] = $this->mt_project->get_row($id);
		}
		else if($nlv==10)
		{
			$data['project'] = $this->mt_project->get_row($pid);
			$data['parent']	=  $this->mt_strategy->get_row($data['project']['subactid']);
			$data['current'] = $this->mt_project->get_row($id);	
		}				
		if($nlv==6 && $id > 0)
		{
			$data['strategy_key'] = $this->mt_strategy_key->where("PID=".$id)->get(FALSE,TRUE);
		}
		else
		{
			$data['strategy_key'] = array('');	
		}


		if($id>0){
		$sql = "SELECT * from CNF_PROVINCE where id not in (select provinceid from mt_budget_record where mainprojectid = ".$pid." and masterid = ".$id.") and id <> 2";
		$data['province'] = $this->province->get($sql,TRUE);				
		
		$sql = "SELECT mt_budget_record.provinceid id,cnf_province.title title FROM MT_BUDGET_RECORD left join cnf_province on mt_budget_record.provinceid = cnf_province.id where masterid = ".$id." and mainprojectid = ".$pid." AND provinceid <> 2 ";
		$data['province_selected'] = $this->budget_record->get($sql,TRUE);
		
		$sql = "SELECT mt_budget_record.divisionid id,cnf_division.title title FROM MT_BUDGET_RECORD left join cnf_division on mt_budget_record.divisionid = cnf_division.id where masterid = ".$id." and mainprojectid = ".$pid." and mt_budget_record.provinceid = 2";
		$data['division_selected'] = $this->budget_record->get($sql,TRUE);
		
		$sql = " SELECT * FROM CNF_DIVISION WHERE ID NOT IN (SELECT DIVISIONID FROM mt_budget_record where  masterid = ".$id." and divisionid > 0) AND DEPARTMENTID = ".$data['parent']['departmentid']." AND PROVINCEID=2 ORDER BY TITLE ";
		$data['central_division'] = $this->division->get($sql,TRUE);
		
		}else{						
			$data['province'] = $this->province->where("id <> 2 ")->order_by("title","asc")->get(FALSE,TRUE);				
			$data['central_division'] = $this->division->where('provinceid=2 AND departmentid='.$data['parent']['departmentid'])->order_by("title","desc")->get(FALSE,TRUE);			
		}

		$data['year_opt'] = $this->fn_strategy->get("SELECT DISTINCT FNYEAR FROM ".$this->fn_strategy->table,TRUE);
		$data['dept_opt'] = $this->department->get(FALSE,TRUE);
		$data['result'] = $this->mt_strategy->get_row($id);
		$data['division'] = @$data['parent']['departmentid'] > 0 ?  $this->division->where("departmentid = ".$data['parent']['departmentid'])->get(FALSE,TRUE) : '';
		
		$this->template->build('sub_project_form',$data);
	}

	function save($lv=FALSE,$pid=FALSE,$id=FALSE){
		$this->db->debug = false;
		if($_POST){
				
			if($id>0)
			{
			   if(!permission($this->modules_name,'canedit'))redirect('monitor_budget_plan');
			}else{		   	   	
			   if(!permission($this->modules_name,'canadd'))redirect('monitor_budget_plan');
			}
				
			
			
				
			$action_type = "ADD";
			if($id>0)
			{
				$_POST['id']=$id;
				$action_type = "EDIT";
			}
			$data['budget_level'] = array('','department_service_target','department_strategy','department_target_year','division_service_target','division_strategy','productivity','mainactivity','subactivity','project','subproject');
			$lv = array_search($lv, $data['budget_level']);
			if($lv < 9){
				$_POST['pid']=$pid;
				$_POST['ministrytargetid'] = @$_POST['ministrytargetid']=="" ? 0 : $_POST['ministrytargetid'];
				$_POST['ministrystrategyid']= @$_POST['ministrystrategyid']=="" ? 0 : $_POST['ministrystrategyid'];
				$_POST['ministrytargetyear'] = @$_POST['ministrytargetyear']=="" ? 0 : $_POST['ministrytargetyear'];  
				$_POST['sectiontargetid'] = @$_POST['sectiontargetid']=="" ? 0 : $_POST['sectiontargetid'];
				$_POST['sectionstrategyid'] = @$_POST['sectionstrategyid']=="" ? 0 : $_POST['sectionstrategyid'];
				$_POST['productivityid'] = @$_POST['productivityid']=="" ? 0 : $_POST['productivityid'];
				$_POST['mainactid'] = @$_POST['mainactid']=="" ? 0 : $_POST['mainactid'];
				$pid = $this->mt_strategy->save($_POST);
				new_save_logfile($action_type,$this->modules_title,$this->mt_strategy->table,"ID",$id,"title",$this->modules_name);								
			}
			else
			{
				$_POST['target'] = str_replace(',','',$_POST['target']);						
				$projectID = $this->mt_project->save(				
					array('id'=>$id,
					'PID'=>$_POST['mainprojectid'],
					'subactid'=>$_POST['subactid'],
					'departmentid'=>$_POST['departmentid'],
					'divisionid'=>$_POST['divisionid'],
					'title'=>$_POST['title'],
					'pyear'=>$_POST['mtyear'],
					'target'=>$_POST['target'],
					'targettype'=>$_POST['targettype']
					)
				);
				new_save_logfile($action_type,$this->modules_title,$this->mt_project->table,"ID",$id,"title",$this->modules_name);			
				/*
				$this->mt_project_detail->delete('masterid',$projectID);
				if($_POST['budgettypeid']){
					foreach($_POST['budgettypeid'] as $key=>$item){
						if($_POST['budgettypeid'][$key]){
							$this->mt_project_detail->save(
								array('masterid'=>$projectID,
								'budgettypeid'=>$_POST['budgettypeid'][$key],
								'budget'=>$_POST['budget'][$key]
								)
							);
						}
					}
				}*/					
			}
			
			if($lv==6){
				$this->mt_strategy_key->delete('pid',$pid);
				if(@$_POST['pKeyName']){
					foreach($_POST['pKeyName'] as $key=>$item){
						if($_POST['pKeyName'][$key]){
							$this->mt_strategy_key->save(
								array('pid'=>$pid,
								'title'=>$_POST['pKeyName'][$key],
								'keytype'=>$_POST['pKeyType'][$key],
								'qty'=>$_POST['pKeyNo'][$key],
								'unittypeid'=>$_POST['pKeyUnitType'][$key]
								)
							);
						}
					}
				}	
			}
			set_notify('success', lang('save_data_complete'));
		}


		if($lv==10 && $id < 1){
			redirect('monitor_budget_plan/sub_project_form/subproject/'.$pid.'/'.$projectID);
		}elseif($lv==9 && $id < 1){
			redirect('monitor_budget_plan/project_form/project/'.$pid.'/'.$projectID);
		}else{
			redirect('monitor_budget_plan/index?mtyear='.$_POST['mtyear']."&mtdepartment=".$_POST['departmentid']);
		}

	}

	function delete($id=FALSE,$type=FALSE){
		//$this->db->debug = true;
		if($id){
			if($type!=FALSE){
				new_save_logfile("DELETE",$this->modules_title,$this->mt_project->table,"ID",$id,"title",$this->modules_name);			
				$this->mt_project->delete($id);
				$this->db->Execute("DELETE FROM MT_BUDGET_RECORD WHERE MASTERID=".$id);
				$this->db->Execute("DELETE FROM MT_PROJECT_SUBDETAIL WHERE MASTERID=".$id);
			}
			else{
				new_save_logfile("DELETE",$this->modules_title,$this->mt_strategy->table,"ID",$id,"title",$this->modules_name);
				$this->mt_strategy->delete($id);
			}
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	function genbudgetdata($id=FALSE)
	{
		$result = $this->withdraw_replace_detail->where("MASTERID=".$id)->get("",TRUE);		
	}
	
	function show_expense_detail($id=FALSE,$projectID=FALSE)
	{
		$script = '';			
		$projectID = @$_POST['projectid']> 0 ? @$_POST['projectid'] : $projectID;
		$data='<table id="tblist2" class="tblist2">
		<tr>
	  		<th style="text-align:left">หมวดงบประมาณ</th>
	  		<th style="text-align:center">เลือก</th>
	  		<th style="text-align:left">หมวดค่าใช้จ่าย </th>
	  		<th style="text-align:right">เงินงบประมาณทั้งหมด</th>
	  		<th style="text-align:right">เงินงบประมาณคงเหลือ</th>
	  		<th style="text-align:center">ขอผูกพันงบประมาณจำนวน</th>
	  	</tr>';
		//$this->db->debug = true;		
		$result = $this->budget_type->where("PID=0")->get();
		foreach($result as $item):							
			$data .= '<tr class="odd">';
			  $data .= '<td height="36" nowrap="nowrap">'.$item['title'].'</td>';
			  $data .= '<td align="center">&nbsp;</td>';
			  $data .= '<td>&nbsp;</td>';
			  $data .= '<td align="right">'.number_format(summary_expense_type($projectID,$item['id'],0),2).'</td>';
			  $data .= '<td align="right"><span id="sp'.$item['id'].'net">0.00</span></td>';
			  $data .= '<td align="center">&nbsp;</td>';
		    $data .= '</tr>';
			$sresult =  $this->budget_type->where("PID=".$item['id'])->get(); 
			foreach($sresult as $sitem):
				if($id > 0 )
				{
					$tmp = $this->withdraw_replace_detail->where("MASTERID=".$id." AND BUDGETTYPEID=".$sitem['id'])->get();
					$expenseCharge = $tmp[0]['charge'];
					$script .= 'calculateExpenseTotal(\''.$sitem['id'].'\',\''.$item['id'].'\');';					
				}
				else
				{
					$expenseCharge = 0;
				}					
				$data .='<tr>';
				  $data .='<td>&nbsp;</td>';
				  $data .='<td align="center">&nbsp;</td>';
				  $data .='<td>'.$sitem['title'].'</td>';
				  $data .='<td align="right"><input type="hidden" id="hd'.$sitem['id'].'total" value="'.number_format(summary_expense_type($projectID,$item['id'],$sitem['id']),2).'"><span id="sp'.$sitem['id'].'total">'.number_format(summary_expense_type($projectID,$item['id'],$sitem['id']),2).'</span></td>';
				  $data .= '<td align="right">					  			 
				  <span id="sp'.$sitem['id'].'net" >0.00</span>
				  <input type="hidden" id="hd'.$sitem['id'].'net" rel="hd'.$item['id'].'net" value="0">
				  </td>';
				  $data .='<td align="center">
				  <input type="hidden" id="charge'.$item['id'].'" name="charge'.$item['id'].'" rel="hd'.$sitem['id'].'" value="0" style="display:none" >
				  <input type="hidden" id="budgettype[]" name="budgettype[]" value="'.$sitem['id'].'">
				  <input type="text" id="charge[]" name="charge[]" rel="tb'.$sitem['id'].'" alt="decimal" value="'.$expenseCharge.'" onkeyup="calculateExpenseTotal(\''.$sitem['id'].'\',\''.$item['id'].'\');">&nbsp;
				  </td>';
				$data .='</tr>';				
			endforeach;
		endforeach;
		$data .= '</table>';
		if($id>0)
		{
			$sdata = array($data,$script);			
			return $sdata;
		}			
		else
		{
			echo $data;
		}		
	}

		function feed(){
		$this->db->debug = true;		
		 $budgetfeed = isset($_POST['budgetfeed'])?  $_POST['budgetfeed'] : "";
		if($budgetfeed !='')
		{
			/*			
			$this->fn_strategy->delete('',FALSE,TRUE);
			$this->fn_budget_area->delete('',FALSE,TRUE);
			$this->fn_budget_current_target->delete('',FALSE,TRUE);
			$this->fn_budget_expense_type->delete('',FALSE,TRUE);
			$this->fn_budget_master->delete('',FALSE,TRUE);
			$this->fn_budget_operation_area->delete('',FALSE,TRUE);
			$this->fn_budget_process->delete('',FALSE,TRUE);
			$this->fn_budget_productivity_key->delete('',FALSE,TRUE);
			$this->fn_budget_type_detail->delete('',FALSE,TRUE);
			 * */	
					
			$exist = $this->fn_strategy->get_one("ID","FNYEAR",$budgetfeed);
			if($exist < 1)
				{
					db_connect(BUDGET_DSN, BUDGET_DBUSER, BUDGET_DBPASSWORD);
				  	$this->transferData($budgetfeed);
					db_close(BUDGET_DSN);		
				}	
			else
				{
					Alert("มีแผนงบประมาณนี้อยู่ในระบบแล้วไม่สามารถนำเข้าได้");
				}	
		}
		redirect('finance_budget_plan/index');
	}

	function transferData($budgetfeedyear=FALSE)
		{
			$this->db->debug = true;				
			$data['pid'] = 0;
			$data['fnyear'] = $budgetfeedyear;
			$data['title'] = "แผนงบประมาณต้นปี ";//แผนงบประมาณต้นปี  || แผนงบประมาณระหว่างปี
			$data['createdate'] = date("Y-m-d");	
			$data['budgetplantype'] = 0;
			$data['budgetyeartype'] = 0;					
			$budgetPlanType = $this->fn_strategy->save($data);
			
			$data['pid'] = 0;
			$data['fnyear'] = $budgetfeedyear;
			$data['title'] = "แผนงบประมาณระหว่างปี ";//แผนงบประมาณต้นปี  || แผนงบประมาณระหว่างปี
			$data['createdate'] = date("Y-m-d");	
			$data['budgetplantype'] = 0;
			$data['budgetyeartype'] = 0;
			$this->fn_strategy->save($data);
			
			$data['pid'] = $budgetPlanType;
			$data['fnyear'] = $budgetfeedyear;
			$data['title'] = "งบประมาณต้นปี ";
			$data['createdate'] = date("Y-m-d");	
			$data['budgetplantype'] = $budgetPlanType;
			$data['budgetyeartype'] = 0;			
			$budgetYearType = $this->fn_strategy->save($data);
			
			
			$sql =" SELECT DISTINCT SUBACTIVITYID,PLANID,PRODUCTIVITYID,MAINACTID
			FROM BUDGET_MASTER BM LEFT JOIN CNF_STRATEGY CS	ON BM.SUBACTIVITYID = CS.ID	WHERE BUDGETYEAR=".$budgetfeedyear." AND STEP=8 
			ORDER BY PLANID,PRODUCTIVITYID,MAINACTID,SUBACTIVITYID ";
			$mainresult = db_query($sql,BUDGET_DSN);
			$tmpPlanID = 0;
			$tmpProductivityID = 0;
			$tmpMainActID = 0;
			$tmpSubActivityID = 0;
			while($row = db_fetch_array($mainresult,0))
			{		
				if($tmpPlanID != $row['PLANID'])
				{
				$tmpdata = Selectdata(" CNF_STRATEGY "," WHERE ID=".$row['PLANID'],BUDGET_DSN);
				$tmpPlanID = $row['PLANID'];
				$data = null;
				$data['pid'] = $budgetYearType;
				$data['fnyear'] = $budgetfeedyear;
				$data['title'] = $tmpdata['TITLE'];
				$data['createdate'] = date("Y-m-d");	
				$data['budgetplantype'] = $budgetPlanType;
				$data['budgetyeartype'] = $budgetYearType;			
			    $planID = $this->fn_strategy->save($data);				
												
				}	
				if($tmpProductivityID != $row['PRODUCTIVITYID'])
				{
				$tmpdata = Selectdata(" CNF_STRATEGY "," WHERE ID=".$row['PRODUCTIVITYID'],BUDGET_DSN);
				$tmpProductivityID = $row['PRODUCTIVITYID'];
				$data = null;
			   	$data['pid'] = $planID;
				$data['fnyear'] = $budgetfeedyear;
				$data['title'] = $tmpdata['TITLE'];
				$data['createdate'] = date("Y-m-d");	
				$data['budgetplantype'] = $budgetPlanType;
				$data['budgetyeartype'] = $budgetYearType;
				$data['planid'] = $planID;		
														
				$productivityID = $this->fn_strategy->save($data);				
				}
				if($tmpMainActID != $row['MAINACTID'])
				{
				$tmpdata = Selectdata(" CNF_STRATEGY "," WHERE ID=".$row['MAINACTID'],BUDGET_DSN);			
				$tmpMainActID = $row['MAINACTID'];		
				$data = null;				
				$data['pid'] = $productivityID;
				$data['fnyear'] = $budgetfeedyear;
				$data['title'] = $tmpdata['TITLE'];
				$data['createdate'] = date("Y-m-d");	
				$data['budgetplantype'] = $budgetPlanType;
				$data['budgetyeartype'] = $budgetYearType;
				$data['planid'] = $planID;
				$data['productivityid']=$productivityID;
				$mainactID = $this->fn_strategy->save($data);	
				}		
				
				if($tmpSubActivityID != $row['SUBACTIVITYID'])
				{
				$tmpdata = Selectdata(" CNF_STRATEGY "," WHERE ID=".$row['SUBACTIVITYID'],BUDGET_DSN);
				$tmpSubActivityID = $row['SUBACTIVITYID'];			
			  	$data = null;
				$data['pid'] = $mainactID;
				$data['fnyear'] = $budgetfeedyear;
				$data['title'] = $tmpdata['TITLE'];
				$data['createdate'] = date("Y-m-d");	
				$data['budgetplantype'] = $budgetPlanType;
				$data['budgetyeartype'] = $budgetYearType;
				$data['planid'] = $planID;
				$data['productivityid']=$productivityID;
				$data['mainactid'] = $mainactID;
				$subactivityID = $this->fn_strategy->save($data);				
				$this->feedBudget($tmpSubActivityID,$subactivityID, $budgetfeedyear);															
				}			
			}
					
		}

		function feedBudget($tmpSubactivityID,$subactivityID, $budgetfeedyear){			
				$sql = " SELECT * FROM BUDGET_MASTER WHERE SUBACTIVITYID=".$tmpSubactivityID;
				$sresult = db_query($sql,BUDGET_DSN);
				while($bMaster = db_fetch_array($sresult,0))
				{
					$data = null;
					$data['budgetyear'] = $budgetfeedyear;
					$data['subactivityid'] = $subactivityID;
					$data['projecttitle'] = $bMaster['PROJECTTITLE'];
					$data['policyaccord'] = $bMaster['POLICYACCORD'];
					$data['policyactivity'] = $bMaster['POLICYACTIVITY'];
					$data['objective'] = $bMaster['OBJECTIVE'];
					$data['targetgroup'] =$bMaster['TARGETGROUP'];
					$data['estimateresult']= $bMaster['ESTIMATERESULT'];
					
					for($i=1;$i<=3;$i++)
					{
						$data['estimateqty_y'.$i] = $bMaster['ESTIMATEQTY_Y'.$i];
						$data['estimateunittypeid_y'.$i] = $bMaster['ESTIMATEUNITTYPEID_Y'.$i];
						$data['estimatebudget_y'.$i] = $bMaster['ESTIMATEBUDGET_Y'.$i];
					}
					
					$data['chkoperationcentral'] = $bMaster['CHKOPERATIONCENTRAL'];
					$data['chkoperationregion'] = $bMaster['CHKOPERATIONREGION'];
					$data['chksummarycentralbudget'] = $bMaster['CHKSUMMARYCENTRALBUDGET'];
					$data['chksummaryregionbudget'] = $bMaster['CHKSUMMARYREGIONBUDGET'];
					$data['summarycentralbudget'] = $bMaster['SUMMARYCENTRALBUDGET'];
					$data['createdate'] = $bMaster['CREATEDATE'];
					$data['lastmodify'] =$bMaster['LASTMODIFY'];
					$data['createby'] =$bMaster['CREATEBY'];
					$data['lastmodifyby'] =$bMaster['LASTMODIFYBY'];
					$data['status'] = $bMaster['STATUS'];
					$data['workgroup_id'] = $bMaster['WORKGROUP_ID'];
					$data['bminexpense'] = $bMaster['BMINEXPENSE'];
					$data['botherexpense'] = $bMaster['BOTHEREXPENSE'];
					for($i=1;$i<=2;$i++)
					{
						$data['lastestimateqty_y'.$i] = $bMaster['LASTESTIMATEQTY_Y'.$i];
						$data['lastestimateunittypeid_y'.$i] = $bMaster['LASTESTIMATEUNITTYPEID_Y'.$i];
						$data['lastestimatebudget_y'.$i] = $bMaster['LASTESTIMATEBUDGET_Y'.$i];		
					}
					$data['principles'] = $bMaster['PRINCIPLES'];	
					$budgetID = $this->fn_budget_master->save($data);					
																							
					$sql = " SELECT * FROM BUDGET_CURRENT_TARGET WHERE BUDGETID=".$bMaster['ID'];
					$mresult = db_query($sql,BUDGET_DSN);
					while($bCurrentTarget = db_fetch_array($mresult,0)){										
						$data=null;
						$data['budgetid'] = $budgetID;
						$data['summaryunit'] = $bCurrentTarget['SUMMARYUNIT'];
						$data['unitid'] = $bCurrentTarget['UNITID'];
						$data['productivitykeyid'] = $bCurrentTarget['PRODUCTIVITYKEYID'];
						for($i=1;$i<=12;$i++)
						{
							$data['m'.$i] = $bCurrentTarget['M'.$i];
						}			
						for($i=1;$i<=4;$i++)
						{
							$data['q'.$i] = $bCurrentTarget['Q'.$i];	
						}									
						$this->fn_budget_current_target->save($data);																			
					}
									
					$sql = "SELECT * FROM BUDGET_OPERATION_AREA WHERE BUDGETID=".$bMaster['ID'];
					$mresult = db_query($sql,BUDGET_DSN);
					while($bOperationArea = db_fetch_array($mresult,0)){
						$data=null;
						$data['budgetid'] = $budgetID;
						$data['provinceid'] = $bOperationArea['PROVINCEID'];
					 	$this->fn_budget_operation_area->save($data);
					}

					$sql = "SELECT * FROM BUDGET_AREA WHERE BUDGETID=".$bMaster['ID'];
					$mresult = db_query($sql,BUDGET_DSN);
					while($bArea = db_fetch_array($mresult,0)){
						$data = null;
						$data['budgetid'] = $budgetID;
						$data['provinceid'] = $bArea['PROVINCEID'];
						$data['budget'] = $bArea['BUDGET'];
						$this->fn_budget_area->save($data);						
					}
				
					$sql = "SELECT * FROM BUDGET_EXPENSE_TYPE WHERE BUDGETID=".$bMaster['ID'];
					$mresult = db_query($sql,BUDGET_DSN);
					while($bExpenseType = db_fetch_array($mresult,0)){
						$data = null;
						$data['budgetid'] = $budgetID;
						$data['expensetypeid'] = $bExpenseType['EXPENSETYPEID'];
						$this->fn_budget_expense_type->save($data);					  	
					}
									
					$sql = "SELECT * FROM BUDGET_PRODUCTIVITY_KEY WHERE BUDGETID=".$bMaster['ID'];	
					$mresult = db_query($sql,BUDGET_DSN);
					while($bProductivityKey = db_fetch_array($mresult,0)){
						$data = null;
						$data['budgetid'] = $budgetID;
						$data['prodkeyid'] = $bProductivityKey['PRODKEYID'];											
						for($i=1;$i<=12;$i++)
						{
							$data['m'.$i] = $bProductivityKey['M'.$i];
						}
						$data['chkworkplan'] = $bProductivityKey['CHKWORKPLAN'];
						$this->fn_budget_productivity_key->save($data);					
					}

					$sql = " SELECT * FROM BUDGET_PROCESS WHERE BUDGETID=".$bMaster['ID'];
					$mresult = db_query($sql,BUDGET_DSN);
					while($bProcess = db_fetch_array($mresult,0)){
						$data = null;
						$data['budgetid'] =$budgetID;
						$data['description'] = $bProcess['DESCRIPTION'];					
				   		$this->fn_budget_process->save($data);				   		
					}
							
					$sql = " SELECT * FROM BUDGET_TYPE_DETAIL WHERE BUDGETID=".$bMaster['ID'];
					$mresult = db_query($sql,BUDGET_DSN);
					while($bTypeDetail = db_fetch_array($mresult,0)){
						$data = null;
						$data['budgetid'] =$budgetID;
						$data['budgetyear']=$budgetfeedyear;
						$data['budgettypeid'] = $bTypeDetail['BUDGETTYPEID'];
						
						for($i=1;$i<=12;$i++)
							$data['budget_m'.$i] = $bTypeDetail['BUDGET_M'.$i];
						
						$data['remark'] = $bTypeDetail['REMARK'];
						$data['allowanceremark'] = $bTypeDetail['ALLOWANCEREMARK'];
						$data['accomodationremark'] = $bTypeDetail['ACCOMODATIONREMARK'];
						$data['vehicleremark'] = $bTypeDetail['VEHICLEREMARK'];
						$data['documentremark'] = $bTypeDetail['DOCUMENTREMARK'];
						$data['humanremark'] = $bTypeDetail['HUMANREMARK'];
						$data['serviceremark'] = $bTypeDetail['SERVICEREMARK'];
						$data['qty'] = $bTypeDetail['QTY'];
						$data['rqty'] = $bTypeDetail['RQTY'];
						$data['nqty'] = $bTypeDetail['NQTY'];
						$data['fotnhuman'] = $bTypeDetail['FOTNHUMAN'];
						$data['fotnday'] = $bTypeDetail['FOTNDAY'];
						$data['fodperday'] = $bTypeDetail['FODPERDAY'];
						$data['chkcalculatedetail']= $bTypeDetail['CHKCALCULATEDETAIL'];
						$data['assetid']=$bTypeDetail['ASSETID'];
						$data['budget_ny1'] = $bTypeDetail['BUDGET_NY1'];
						$data['budget_ny2'] = $bTypeDetail['BUDGET_NY2'];
						$data['budget_ny3'] = $bTypeDetail['BUDGET_NY3'];
						$data['assetvalue'] = $bTypeDetail['ASSETVALUE']== '' ? 0 : $bTypeDetail['ASSETVALUE'];
						$this->fn_budget_type_detail->save($data);
					}					
				}			
		}

		function subdetail_ajax(){
			//$this->db->debug=true;
			$_POST = $_POST['value'];
			if($_POST['alldivisionid']=='' && $_POST['allprovinceid']==''){
				$divisionid = @$_POST['sub_divisionid'] > 0 ? $_POST['sub_divisionid'] : 0; 
				$_POST['provinceid'] = @$_POST['provinceid'] > 0 ? $_POST['provinceid'] : 2; 
				// echo "<pre>";
					// var_dump($_POST);
				// echo "</pre>";
				
				$off_budget = str_replace(",","",$_POST['off_budget']);
				 $id = $this->budget_record->save(array(
					'id'=>$_POST['id'],
					'provinceid'=>$_POST['provinceid'],
					'target_value'=>$_POST['target_value'],
					'targettype_id'=>$_POST['targettype_id'],
					'off_budget'=>$off_budget,
					'masterid'=>$_POST['masterid'],
					'mainprojectid'=>$_POST['mainprojectid'],
					'divisionid'=>$divisionid
				 ));
	
				foreach($_POST['sbudgettypeid'] as $key=>$item){
					if($_POST['sbudgettypeid'][$key]){
						// echo $_POST['sbudgettypeid'][$key]."<br>";
						$this->mt_project_subdetail->save(array(
							'id'=>$_POST['subdetail_id'][$key],
							'provinceid'=>$_POST['provinceid'],
							'masterid'=>$_POST['masterid'],
							'sbudgettypeid'=>$_POST['sbudgettypeid'][$key],
							'sbudget'=>str_replace(",",'',$_POST['sbudget'][$key]),
							//'rate'=>$_POST['rate'][$key],
							'mt_project_detail_id'=>$_POST['mt_project_detail_id'][$key],
							'mainprojectid'=>$_POST['mainprojectid'],
							'mt_budget_record_id'=>$id,
							'divisionid'=>$divisionid
						));
					}
				}
			}else if($_POST['alldivisionid']!=''){
				$_POST['provinceid']=2;
				$division = explode("|",$_POST['alldivisionid']);
				foreach($division as $division_id){
					
					$sql = " SELECT ID FROM MT_BUDGET_RECORD WHERE MASTERID=".$_POST['masterid']." AND DIVISIONID=".$division_id;
					$id = $this->db->getone($sql);
					$off_budget = str_replace(",","",$_POST['off_budget']);
					$id = $this->budget_record->save(array(
						'id'=>$id,
						'provinceid'=>$_POST['provinceid'],
						'target_value'=>$_POST['target_value'],
						'targettype_id'=>$_POST['targettype_id'],
						'off_budget'=>$off_budget,
						'masterid'=>$_POST['masterid'],
						'mainprojectid'=>$_POST['mainprojectid'],
						'divisionid'=>$division_id
					 ));
					 
					 foreach($_POST['sbudgettypeid'] as $key=>$item){
						if($_POST['sbudgettypeid'][$key]){
							// echo $_POST['sbudgettypeid'][$key]."<br>";
							$sql = " SELECT ID FROM MT_PROJECT_SUBDETAIL WHERE MASTERID=".$_POST['masterid']." AND SBUDGETTYPEID=".$_POST['sbudgettypeid'][$key]." AND DIVISIONID=".$division_id;
							$subdetail_id = $this->db->getone($sql);
							
							$this->mt_project_subdetail->save(array(
								'id'=>$subdetail_id,
								'provinceid'=>$_POST['provinceid'],
								'masterid'=>$_POST['masterid'],
								'sbudgettypeid'=>$_POST['sbudgettypeid'][$key],
								'sbudget'=>str_replace(",",'',$_POST['sbudget'][$key]),
								//'rate'=>$_POST['rate'][$key],
								'mt_project_detail_id'=>$_POST['mt_project_detail_id'][$key],
								'mainprojectid'=>$_POST['mainprojectid'],
								'mt_budget_record_id'=>$id,
								'divisionid'=>$division_id
							));
						}
					}
				}
				
				
			}else if($_POST['allprovinceid']!=''){
				
				$division_id = 0;
				$province = explode("|",$_POST['allprovinceid']);
				foreach($province as $province_id){
					
					$sql = " SELECT ID FROM MT_BUDGET_RECORD WHERE MASTERID=".$_POST['masterid']." AND PROVINCEID=".$province_id;
					$id = $this->db->getone($sql);
					$off_budget = str_replace(",","",$_POST['off_budget']);
					$id = $this->budget_record->save(array(
						'id'=>$id,
						'provinceid'=>$province_id,
						'target_value'=>$_POST['target_value'],
						'targettype_id'=>$_POST['targettype_id'],
						'off_budget'=>$off_budget,
						'masterid'=>$_POST['masterid'],
						'mainprojectid'=>$_POST['mainprojectid'],
						'divisionid'=>$division_id
					 ));
					 
					 foreach($_POST['sbudgettypeid'] as $key=>$item){
						if($_POST['sbudgettypeid'][$key]){
							// echo $_POST['sbudgettypeid'][$key]."<br>";
							$sql = " SELECT ID FROM MT_PROJECT_SUBDETAIL WHERE MASTERID=".$_POST['masterid']." AND SBUDGETTYPEID=".$_POST['sbudgettypeid'][$key]." AND PROVINCEID=".$province_id;
							$subdetail_id = $this->db->getone($sql);
							
							$this->mt_project_subdetail->save(array(
								'id'=>$subdetail_id,
								'provinceid'=>$province_id,
								'masterid'=>$_POST['masterid'],
								'sbudgettypeid'=>$_POST['sbudgettypeid'][$key],
								'sbudget'=>str_replace(",",'',$_POST['sbudget'][$key]),
								//'rate'=>$_POST['rate'][$key],
								'mt_project_detail_id'=>$_POST['mt_project_detail_id'][$key],
								'mainprojectid'=>$_POST['mainprojectid'],
								'mt_budget_record_id'=>$id,
								'divisionid'=>$division_id
							));
						}
					}
				}
				
			}
		}

		function subdetail_form_ajax(){
			$budget_type_result =  $this->fn_budget_type->where("pid=0")->get(FALSE,TRUE);			
			$budget_record = $this->budget_record->where("provinceid = ".$_POST['provinceid']." and masterid = ".$_POST['masterid']." and mainprojectid = ".$_POST['mainprojectid'])->get_row();
			$targettype =  $budget_record['targettype_id'] > 0 ? $budget_record['targettype_id'] : $_POST['targettype']; 
			echo'
				<table id="subdetail-tb" >
				    		<tr>
				    			<td>เป้าหมาย</td>
				    			<td>
				    				<input type="text" name="target_value" value="'.@$budget_record['target_value'].'" size="15" maxlength="32">
					             '. form_dropdown('targettype_id',get_option('id','title','cnf_count_unit'),@$targettype,'','-- เลือกหน่วยนับ --').'
					             <input type="hidden" name="alldivisionid" value="'.@$_POST['alldivisionid'].'">
					             <input type="hidden" name="allprovinceid" value="'.@$_POST['allprovinceid'].'">
				            	</td>
				    		</tr>
				<tr>
    			<td colspan="2" style="vertical-align: top;">แผนงบประมาณ</td>
    			</tr>
    			<tr>
    			<td colspan="2">
    				<table class="tblist2">
    					<tr>
    						<th>ประเภทงบประมาณ</th>
    						<th>จำนวนเงิน</th>
    					</tr>
    			';
						foreach($budget_type_result as $budget_type){
						$condition = @$_POST['divisionid'] != '' ? " AND divisionid=".$_POST['divisionid'] : "";
						@$subdetail = $this->mt_project_subdetail->where("provinceid = ".$_POST['provinceid']." and masterid = ".$_POST['masterid']." and mainprojectid = ".$_POST['mainprojectid']." and mt_project_detail_id = ".$budget_type['id']." and sbudgettypeid = ".$budget_type['id'].$condition)->get_row();
							echo '<tr>
								<td>'.$budget_type['title'].'</td>
								<td>									
									<input type="hidden" name="mt_project_detail_id[]" value="'.@$budget_type['id'].'">
									<input type="hidden" name="subdetail_id[]" value="'.@$subdetail['id'].'">
									<input type="hidden" name="sbudgettypeid[]" value="'.@$budget_type['id'].'">
									<input type="text" class="subbudget_inform_'.$budget_type['id'].' usethis" name="sbudget[]" value="'.@$subdetail['sbudget'].'" alt="decimal"> บาท
								</td>
							</tr>';								
						}	
    			echo '</table>';

		    echo'
		    		</ul>
    			</td>
    		</tr>';
    		echo'<tr>
    			<td>เงินนอกงบประมาณ</td>
    			<td><input type="text" name="off_budget" value="'.@$budget_record['off_budget'].'" alt="decimal"> บาท</td>
    		</tr>
    		<tr>
    			<td></td>
    			<td class="btn_zone">
    				<input type="hidden" name="id" value="'.@$budget_record['id'].'">
    				<input type="hidden" name="mainprojectid" value="'.$_POST['mainprojectid'].'">
    				<input type="hidden" name="masterid" value="'.$_POST['masterid'].'">
    				<input id="submit-btn" type="button" value="บันทึก">
    				<input type="button" value="ยกเลิก">
    			</td>
    		</tr>
    		</table>
	</fieldset>
</form>
</div>
</div>
</div>
    		';
			
			echo'<script type="text/javascript">
					$("input:text").setMask();
					$(".rate-style").each(function(){
						var title = $(this).closest(".subdetail-ul").prev(".detail-title").text();
						if(title != "งบบุคลากร"){
							$(this).hide();
						}
					});
				</script>';
		}

	function refresh_table($id){
		$data['id'] = $id;
		$this->load->view("table",$data);
	}

	function refresh_target($id){
		$sql = " SELECT SUM(TARGET_VALUE) FROM MT_BUDGET_RECORD WHERE MASTERID=".$id;
		$target_value = $this->db->getone($sql);
		echo '<input type="text" id="target" name="target" value="'.@$target_value.'">';
	}

	function delSbudget_fromProvince(){
		$_POST['provinceid'] = str_replace("|",",",$_POST['provinceid']);
		
		$this->budget_record->where("provinceid IN (".$_POST['provinceid'].") and masterid = ".$_POST['masterid']." and mainprojectid = ".$_POST['mainprojectid'])->delete();
		
		$this->mt_project_subdetail->where("provinceid IN (".$_POST['provinceid'].") and masterid = ".$_POST['masterid']." and mainprojectid = ".$_POST['mainprojectid'])->delete();
	}

	function delSbudget_fromDivision(){
		$_POST['divisionid'] = str_replace("|",",",$_POST['divisionid']);
		
		$this->budget_record->where("divisionid IN (".$_POST['divisionid'].") and masterid = ".$_POST['masterid']." and mainprojectid = ".$_POST['mainprojectid'])->delete();
		
		$this->mt_project_subdetail->where("divisionid IN (".$_POST['divisionid'].") and masterid = ".$_POST['masterid']." and mainprojectid = ".$_POST['mainprojectid'])->delete();
	}

	function save_subdetail(){
		$this->db->debug=true;
		if(@$_POST['provinceid']!= ""){
			$province = explode("|",$_POST['provinceid']);
			foreach($province as $item){
				$condition = "1=1";
				$condition .= $_POST['masterid'] > 0 ? " AND masterid=".$_POST['masterid']."" : "";		
				$condition .= $_POST['mainprojectid'] > 0 ? " AND mainprojectid=".$_POST['mainprojectid']."" : "";
				$condition .= $item > 0 ? " AND provinceid=".$item."" : "";					
				$result = $this->db->getone("SELECT ID from MT_BUDGET_RECORD WHERE ".$condition);
				$_POST['provinceid'] = $item;
				if(@$result<1){
					$this->budget_record->save($_POST);
				}
			}
		}
		if(@$_POST['divisionid']!= ""){
			$division = explode("|",$_POST['divisionid']);
			foreach($division as $item){
				$condition = "1=1";
				$condition .= $_POST['masterid'] > 0 ? " AND masterid=".$_POST['masterid']."" : "";		
				$condition .= $_POST['mainprojectid'] > 0 ? " AND mainprojectid=".$_POST['mainprojectid']."" : "";
				$condition .= $item > 0 ? " AND divisionid=".$item."" : "";					
				$result = $this->db->getone("SELECT ID from MT_BUDGET_RECORD WHERE ".$condition);
				$_POST['divisionid'] = $item;
				$_POST['provinceid'] = 2;
				if(@$result<1){
					$this->budget_record->save($_POST);
				}
			}
		}
	}
}
?>