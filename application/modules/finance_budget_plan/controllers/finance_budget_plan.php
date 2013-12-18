<?php
class finance_budget_plan extends Finance_Controller
{

	public $budgetkey = array("budgetplantype","budgetyeartype","plan","productivity","mainactivity","subactivity","department","division","project");
	public $icon = array("budgetplantype"=>"budget_plan.png","budgetyeartype"=>"budget_type.png","plan"=>"plan_ico.png","productivity"=>"asterisk.png","mainactivity"=>"layout_sidebar.png","subactivity"=>"file.gif","department"=>"department.png","division"=>"division.gif","project"=>"folder.gif");
	function __construct()
	{
		parent::__construct();
		$this->load->model('fn_budget_plan_model','fn_strategy');	
		$this->load->model('fn_budget_area_model','fn_budget_area');
		$this->load->model('fn_budget_current_target_model','fn_budget_current_target');
		$this->load->model('fn_budget_expense_type_model','fn_budget_expense_type');
		$this->load->model('fn_budget_master_model','fn_budget_master');
		$this->load->model('fn_budget_operation_area_model','fn_budget_operation_area');		
		$this->load->model('fn_budget_process_model','fn_budget_process');
		$this->load->model('fn_budget_productivity_key_model','fn_budget_productivity_key');
		$this->load->model('fn_budget_type_detail_model','fn_budget_type_detail');		
		$this->load->model('fn_budget_type_model','budgettype');
		$this->load->model('fn_division_budget_amount_model','divisionamount');
		$this->load->model('fn_division_budget_amount_detail_model','divisionamount_detail');	
		$this->load->model('c_division/division_model','division');
		$this->load->model('finance_percent/fn_percent_model','fn_percent');
		//$this->load->model('finance_budget_code_model','fn_budget_code');
	}
	
	function index($budgetyear=FALSE)
	{
		//$data['budget_codes'] = $this->fn_budget_code->get();			
		$data['url_parameter'] = GetCurrentUrlGetParameter();		                	    			
    	db_connect(BUDGET_DSN,BUDGET_DBUSER,BUDGET_DBPASSWORD);
		$sql = "SELECT DISTINCT BUDGETYEAR FROM BUDGET_MASTER ORDER BY BUDGETYEAR DESC ";
		$result = db_query($sql,BUDGET_DSN);
		$option = '';
		while($srow = db_fetch_array($result,0)){            
    	$option .= '<option value="'.$srow['BUDGETYEAR'].'">'.($srow['BUDGETYEAR']+543).'</option>';             
		}
    	db_close(BUDGET_DSN);
		$data['option'] = $option;
		
		$sql = " SELECT DISTINCT FNYEAR FROM FN_STRATEGY ";		
		$fnyear = $this->fn_strategy->get($sql,TRUE);
		$data['fnyear'] = $fnyear;
		
		$data['budgetyear'] = $budgetyear;
		
		
		$strategy = $budgetyear != '' ?  $this->fn_strategy->get("SELECT * FROM ".$this->fn_strategy->table." WHERE FNYEAR=".$budgetyear,TRUE) : "";
		$data['strategy'] = $strategy;		
		if($budgetyear > 0){
		$data['dataList'] = $this->GetStrategyTree($budgetyear,"budgetplantype",0);
			/*	
		$budgetPlanType = $this->GetStrategy($strategy,'budgetplantype');
		$data['budgetplantype'] = $budgetPlanType;
					
		$budgetYearType = $this->GetStrategy($strategy,'budgetyeartype');		
		$data['budgetyeartype'] = $budgetYearType;
		
		$plan = $this->GetStrategy($strategy,'planid');		
		$data['plan'] = $plan;							
					
		$productivity = $this->GetStrategy($strategy,'productivityid');		
		$data['productivity'] = $productivity;
		
		$mainactivity = $this->GetStrategy($strategy,'mainactid');		
		$data['mainactivity'] = $mainactivity;		
		
		$subactivity = $this->GetStrategy($strategy,'subactivityid');		
		$data['subactivity'] = $subactivity;
		//$this->db->debug = true;
		$workgroup = $this->GetBudgetData("DISTINCT cw.ID id, cw.TITLE,cdv.ID divisionid , SUBACTIVITYID ",$budgetyear);
		$data['workgroup'] =$workgroup;
		
		$sql = " SELECT FD.*, CD.TITLE,CD.DEPARTMENTID FROM FN_DIVISION_BUDGET_AMOUNT FD LEFT JOIN CNF_DIVISION CD ON FD.DIVISIONID = CD.ID
		LEFT JOIN CNF_DEPARTMENT CDP ON CD.DEPARTMENTID = CDP.ID 
		WHERE FNYEAR=".$budgetyear;		
		$division = $this->db->getarray($sql);
		dbConvert($division);		
		$data['division'] =$division;
						
		$sql = " SELECT DISTINCT SUBACTIVITYID,FNYEAR,CDP.ID DEPARTMENTID CDP.TITLE FROM FN_DIVISION_BUDGET_AMOUNT FD 
		LEFT JOIN CNF_DIVISION CD ON FD.DIVISIONID = CD.ID
		LEFT JOIN CNF_DEPARTMENT CDP ON CD.DEPARTMENTID = CDP.ID  
		WHERE FNYEAR=".$budgetyear;	
		$department = $this->GetBudgetData("DISTINCT cd.ID, cd.TITLE, SUBACTIVITYID",$budgetyear);
		$data['department'] =$department;	

		$sql = "SELECT FBM.ID,CW.DIVISIONID,FBM.ProjectTitle,FBM.SUBACTIVITYID FROM FN_BUDGET_MASTER FBM ";
		$sql.= " LEFT JOIN CNF_WORKGROUP CW ON FBM.WORKGROUP_ID = CW.ID";
		$sql.=" WHERE BUDGETYEAR=".$budgetyear;		
		$project = $this->db->getarray($sql);						
		dbConvert($project);
		$data['project']=$project;
			 * */
		}		
		$this->template->build('finance_budget_plan_index',$data);		
	}
	
	function GetStrategyTree($pBudgetYear,$step,$pid)
	{
		$data['url_parameter'] = GetCurrentUrlGetParameter();		
		$keyindex = array_search($step, $this->budgetkey);		
		$dataList = '';		
		$result = $this->fn_strategy->where("PID=".$pid." AND FNYEAR=".$pBudgetYear)->get(FALSE,TRUE);
		$dataList .= $keyindex>0 ? "<ul>" : ''; 
		foreach($result as $row):		
		$dataList .= '<li>';
		$dataList .='<img src="images/tree/'.$this->icon[$step].'" />'.$row['title'];
		
		if(permission('finance_budget_plan', 'canadd')){
			$dataList .='<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location=\'finance_budget_plan/form/'.$this->budgetkey[($keyindex+1)].'/'.$row['id'].'\'"/>';
		}
		if(permission('finance_budget_plan', 'canedit')){
		$dataList .='<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" onclick="window.location=\'finance_budget_plan/form/'.$this->budgetkey[($keyindex)].'/'.$row['pid'].'/'.$row['id'].'\';"/>';
		}
		if(permission('finance_budget_plan', 'candelete')){
		$dataList .='<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" title="ลบรายการนี้" onclick="window.location=\'finance_budget_plan/delete/'.$this->budgetkey[($keyindex)].'/'.$row['id'].'\'"/>';
		}
		if(($keyindex+1)<count($this->budgetkey))
		{
			switch($this->budgetkey[($keyindex+1)]){
				case "department":
				$dataList .= $this->GetDepartmentTree($pBudgetYear,$this->budgetkey[($keyindex + 1)],$row['id']);	
				break;
				default:
				$dataList .= $this->GetStrategyTree($pBudgetYear,$this->budgetkey[($keyindex + 1)],$row['id']);
				break;
			}
		}
		$dataList .='</li>';	
		endforeach;
		$dataList .= $keyindex>0 ? "</ul>" : '';
		return $dataList;				
	}

	function GetDepartmentTree($pBudgetYear,$step,$pSubactivityID)
	{
		$data['url_parameter'] = GetCurrentUrlGetParameter();		
		$keyindex = array_search($step, $this->budgetkey);		
		$dataList = '';		
		$sql = " SELECT DISTINCT SUBACTIVITYID,FNYEAR,CDP.ID DEPARTMENTID, CDP.TITLE FROM FN_DIVISION_BUDGET_AMOUNT FD 
		LEFT JOIN CNF_DIVISION CD ON FD.DIVISIONID = CD.ID
		LEFT JOIN CNF_DEPARTMENT CDP ON CD.DEPARTMENTID = CDP.ID  
		WHERE FNYEAR=".$pBudgetYear." AND FD.SUBACTIVITYID=".$pSubactivityID;		
		$result = $this->db->getarray($sql);
		dbConvert($result);
		$dataList .= "<ul>"; 
		foreach($result as $row):		
		$dataList .= '<li>';
		$dataList .='<img src="images/tree/'.$this->icon[$step].'" />'.$row['title'];						
		$dataList .= $this->GetDivisionTree($pBudgetYear,$this->budgetkey[($keyindex + 1)],$pSubactivityID,$row['departmentid']);											
		$dataList .='</li>';				
		endforeach;
		$dataList .="</ul>";
		return $dataList;
	}
	function GetDivisionTree($pBudgetYear,$step,$pSubactivityID,$pDepartmentID)
	{
		$data['url_parameter'] = GetCurrentUrlGetParameter();		
		$keyindex = array_search($step, $this->budgetkey);		
		$dataList = '';		
		$sql = " SELECT FD.*, CD.TITLE,CD.DEPARTMENTID FROM FN_DIVISION_BUDGET_AMOUNT FD LEFT JOIN CNF_DIVISION CD ON FD.DIVISIONID = CD.ID
		LEFT JOIN CNF_DEPARTMENT CDP ON CD.DEPARTMENTID = CDP.ID 				
		WHERE FNYEAR=".$pBudgetYear." AND SUBACTIVITYID=".$pSubactivityID." AND DEPARTMENTID=".$pDepartmentID;		
		$result = $this->db->getarray($sql);
		dbConvert($result);
		$dataList .= "<ul>"; 
		foreach($result as $row):		
		$dataList .= '<li>';
		$dataList .='<img src="images/tree/'.$this->icon[$step].'" />'.$row['title'];
		$dataList .=' (<span style="color:#F92C2C;" title="เงินงบประมาณ" class="vtip">'.number_format(GetSectionBudget($pBudgetYear,$pSubactivityID,$row['divisionid']),2).' บาท</span>)';
		
		if(permission('finance_budget_plan', 'canadd')){
		$dataList .='<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location=\'finance_budget_plan/form/'.$this->budgetkey[($keyindex+1)].'/'.$row['id'].'\'"/>';
		}
		
		if(permission('finance_budget_plan', 'canedit')){
		$dataList .='<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" onclick="window.location=\'finance_budget_plan/form/'.$this->budgetkey[($keyindex)].'/'.$row['subactivityid'].'/'.$row['id'].'\'"/>';
		}
		
		if(permission('finance_budget_plan', 'candelete')){
		$dataList .='<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location=\'finance_budget_plan/delete/'.$this->budgetkey[($keyindex)].'/'.$row['subactivityid'].'/'.$row['id'].'\'" />';	
		}
		
		$dataList .= $this->GetProjectTree($pBudgetYear,$this->budgetkey[($keyindex + 1)],$pSubactivityID,$row['divisionid']);											
		$dataList .='</li>';				
		endforeach;
		$dataList .="</ul>";
		return $dataList;
	}
	function GetProjectTree($pBudgetYear,$step,$pSubactivityID,$pDivisionID)
	{
		$data['url_parameter'] = GetCurrentUrlGetParameter();		
		$keyindex = array_search($step, $this->budgetkey);		
		$dataList = '';		
		$sql = "SELECT FBM.ID,CW.DIVISIONID,FBM.ProjectTitle title,FBM.SUBACTIVITYID FROM FN_BUDGET_MASTER FBM 
		LEFT JOIN CNF_WORKGROUP CW ON FBM.WORKGROUP_ID = CW.ID
		WHERE FBM.BUDGETYEAR=".$pBudgetYear." AND FBM.SUBACTIVITYID=".$pSubactivityID." AND DIVISIONID=".$pDivisionID;		
		$result = $this->db->getarray($sql);
		dbConvert($result);
		$dataList .= "<ul>"; 
		foreach($result as $row):		
		$dataList .= '<li>';
		$dataList .='<img src="images/tree/'.$this->icon[$step].'" />'.$row['title'];
		$dataList .=' (<span style="color:#F92C2C;" title="เงินงบประมาณ" class="vtip">'.number_format(GetProjectBudget($row['id']),2).' บาท</span>)';
		
		if(permission('finance_budget_plan', 'canedit')){
		$dataList .='<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" onclick="window.location=\'finance_budget_plan/form/'.$this->budgetkey[($keyindex)].'/'.$row['divisionid'].'/'.$row['id'].'/'.$row['subactivityid'].'\'"/>';
		}
		
		if(permission('finance_budget_plan', 'candelete')){
		$dataList .='<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้"onclick="window.location=\'finance_budget_plan/delete/'.$this->budgetkey[($keyindex)].'/'.$row['id'].'\'"/>';
		}
																			
		$dataList .='</li>';				
		endforeach;
		$dataList .="</ul>";
		return $dataList;
	}

	function GetBudgetData($field=FALSE,$budgetyear=FALSE){
		$sql =  " SELECT $field FROM FN_BUDGET_MASTER fbm
		LEFT JOIN  CNF_WORKGROUP cw ON fbm.WORKGROUP_ID = cw.ID 
		LEFT JOIN CNF_DIVISION cdv ON cw.DIVISIONID = cdv.ID 
		LEFT JOIN CNF_DEPARTMENT cd ON cdv.DEPARTMENTID = cd.ID
		WHERE BUDGETYEAR=".$budgetyear." AND SUBACTIVITYID IN (SELECT DISTINCT SUBACTIVITYID
		FROM FN_BUDGET_MASTER  
		WHERE BUDGETYEAR=".$budgetyear.")";
		$result = $this->fn_strategy->get($sql,TRUE);
		return $result;				
	} 
	
	 
	
	function GetStrategy($strategy = false, $lvname){
		$keys = findKeys($strategy,$lvname,'<','1');
		for($i=0;$i<count($keys);$i++)
		{
				$data[$i] = $strategy[$keys[$i]];
		}
		return $data;
	}

	
	
	function feed(){
		//$this->db->debug = true;		
		$url_parameter = GetCurrentUrlGetParameter();
		 $budgetfeed = isset($_POST['budgetfeed'])?  $_POST['budgetfeed'] : "";
		 
		if($budgetfeed !='')
		{
			$exist = $this->db->getone("SELECT COUNT(*) FROM FN_STRATEGY WHERE FNYEAR=".$budgetfeed);
			if($exist>0){
				//Alert("มีแผนงบประมาณนี้อยู่ในระบบแล้วไม่สามารถนำเข้าได้");
				 set_notify('success', "มีแผนงบประมาณนี้อยู่ในระบบแล้วไม่สามารถนำเข้าได้");
				//echo "<script>windows.location='finance_budget_plan'</script>";
			}else{			
			$this->fn_strategy->delete('',FALSE,TRUE);
			$this->fn_budget_area->delete('',FALSE,TRUE);
			$this->fn_budget_current_target->delete('',FALSE,TRUE);
			$this->fn_budget_expense_type->delete('',FALSE,TRUE);
			$this->fn_budget_master->delete('',FALSE,TRUE);
			$this->fn_budget_operation_area->delete('',FALSE,TRUE);
			$this->fn_budget_process->delete('',FALSE,TRUE);
			$this->fn_budget_productivity_key->delete('',FALSE,TRUE);
			$this->fn_budget_type_detail->delete('',FALSE,TRUE);
			$this->divisionamount->delete('',FALSE,TRUE);
			$this->divisionamount_detail->delete('',FALSE,TRUE);
					
			$exist = $this->fn_strategy->get_one("ID","FNYEAR",$budgetfeed);
			if($exist < 1)
				{
					db_connect(BUDGET_DSN, BUDGET_DBUSER, BUDGET_DBPASSWORD);
				  	$this->transferData($budgetfeed);
					$this->getdivisionsummary($budgetfeed);
					db_close(BUDGET_DSN);		
				}	
			else
				{
					set_notify('success', "มีแผนงบประมาณนี้อยู่ในระบบแล้วไม่สามารถนำเข้าได้");
				}
			}	
		}
		redirect('finance_budget_plan/index'.$url_parameter);
	}

	function transferData($budgetfeedyear=FALSE)
		{
			//$this->db->debug = true;				
			$data['pid'] = 0;
			$data['fnyear'] = $budgetfeedyear;
			$data['title'] = "แผนงบประมาณต้นปี ";//แผนงบประมาณต้นปี   || แผนงบประมาณระหว่างปี
			$data['createdate'] = date("Y-m-d");	
			$data['budgetplantype'] = 0;
			$data['budgetyeartype'] = 0;					
			$budgetPlanType = $this->fn_strategy->save($data);
			
			$data['pid'] = 0;
			$data['fnyear'] = $budgetfeedyear;
			$data['title'] = "แผนงบประมาณระหว่างปี ";//budgetplantype || แผนงบประมาณต้นปี  || แผนงบประมาณระหว่างปี
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
			$budgetYearType = $this->fn_strategy->save($data);//budgetyeartype || ประเภทแผนงบประมาณ
			
			
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
			    $planID = $this->fn_strategy->save($data);//PlanID || แผน			
												
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
														
				$productivityID = $this->fn_strategy->save($data);//ProductivityID || ผลผลิต		
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
				$mainactID = $this->fn_strategy->save($data);	 //MainAct || กิจกรรมหลัก
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
				$subactivityID = $this->fn_strategy->save($data); //SubActivity || กิจกรรมย่อย
				
				$this->feedBudget($tmpSubActivityID,$subactivityID, $budgetfeedyear);															
				}			
			}
					
		}

		function feedBudget($tmpSubactivityID,$subactivityID, $budgetfeedyear){			    
			    $this->db->debug = true;
				$sql = " SELECT * FROM BUDGET_MASTER WHERE SUBACTIVITYID=".$tmpSubactivityID." AND BUDGETYEAR=".$budgetfeedyear;
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
					/*															
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
						*/
						
					$expense_result = $this->budgettype->where("PID > 0 AND EXPENSETYPEID =0 ")->get(FALSE,TRUE);
					foreach($expense_result as $expense):
						$budgetm="";
						for($i=1;$i<=12;$i++)$budgetm.= $budgetm != "" ? " + BUDGET_M".$i : " BUDGET_M".$i;
						$sql = " SELECT SUM(".$budgetm.")TOTAL FROM BUDGET_TYPE_DETAIL 
						LEFT JOIN CNF_BUDGET_TYPE ON BUDGET_TYPE_DETAIL.BUDGETTYPEID = CNF_BUDGET_TYPE.ID WHERE BUDGETID=".$budgetID." AND EXPENSETYPEID=".$expense['id'];
						$mresult = db_query($sql,BUDGET_DSN);
						$bTypeDetail = db_fetch_array($mresult,0);
							$data = null;
							$data['budgetid'] =$budgetID;
							$data['budgetyear']=$budgetfeedyear;
							$data['budgettypeid'] = $expense['id'];
							$data['budget']=$bTypeDetail['TOTAL'];							 											
							$this->fn_budget_type_detail->save($data);											
					endforeach;
				}			
		}

	function getdivisionsummary($pBudgetYear)
	{
		//$this->db->debug = true;
		$sql = " SELECT DISTINCT DIVISIONID FROM FN_BUDGET_MASTER fbm LEFT JOIN CNF_WORKGROUP cw ON fbm.WORKGROUP_ID = cw.ID WHERE BUDGETYEAR=".$pBudgetYear;
		$division = $this->db->getarray($sql);
		foreach($division as $division_row):
			$sql = " SELECT DISTINCT SUBACTIVITYID FROM FN_BUDGET_MASTER fbm LEFT JOIN CNF_WORKGROUP cw ON fbm.WORKGROUP_ID = cw.ID WHERE BUDGETYEAR=".$pBudgetYear." AND DIVISIONID=".$division_row['DIVISIONID'];
			$subact = $this->db->getarray($sql);
			foreach($subact as $subact_row):
					$pid = $this->divisionamount->save(array(
					"fnyear"=>$pBudgetYear,
					"divisionid"=>$division_row['DIVISIONID'],
					"subactivityid"=>$subact_row['SUBACTIVITYID']
					));													
					$expense = $this->budgettype->where("budgettypeid > 0 AND expensetypeid = 0")->get(FALSE,TRUE);
					foreach($expense as $exp_row):
						
						$sql ="SELECT SUM(BUDGET) 
						FROM FN_BUDGET_MASTER FBM 
						LEFT JOIN FN_BUDGET_TYPE_DETAIL FBD ON FBM.ID = FBD.BUDGETID 
						LEFT JOIN CNF_WORKGROUP CWG ON FBM.WORKGROUP_ID = CWG.ID 
						WHERE DIVISIONID=".$division_row['DIVISIONID']." AND FBM.BUDGETYEAR=".$pBudgetYear."  AND FBD.BUDGETTYPEID=".$exp_row['id']." 
						AND FBM.SUBACTIVITYID=".$subact_row['SUBACTIVITYID'];						
						$total = $this->db->getone($sql);						
						$this->divisionamount_detail->save(array(
						"pid"=>$pid,
						"budgettypeid"=>$exp_row['id'],
						"budget"=>number_format($total,2)
						));						
					endforeach;
				
			endforeach;
		endforeach;
		
	}

	
	function delete($budgettype,$id=FALSE){
		if($id){
			switch($budgettype){
				case "project":
				$this->fn_budget_master->delete($id);
				$this->fn_budget_type_detail->delete("BUDGETID",$id);
				break;
				default:
				$this->fn_strategy->delete($id);
				break;
			}
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	function form($formtype,$pid,$id=false,$subactivityid=FALSE){
		$data['formtype'] = $formtype;		
		$data['parent'] = $this->fn_strategy->get_row($pid);
		if($formtype=="division" || $formtype=="department")
		{
			if($id>0)
			{			
			$datai = $this->db->getrow("SELECT FN.*,CD.DEPARTMENTID FROM FN_DIVISION_BUDGET_AMOUNT FN LEFT JOIN CNF_DIVISION CD ON FN.DIVISIONID=CD.ID  WHERE FN.ID=".$id);			
			dbConvert($datai);
			}
			$data['self']=@$datai;
			
			$data['divisionBudgetDatalist'] =  $this->GetDivisionBudgetDatalist($data['parent']['fnyear'],$data['self']['divisionid'],$data['self']['subactivityid']);
		}
		else if($formtype=="project")
		{
			$budgetamount = $this->divisionamount->get_row($pid);
			$data['parent'] = $this->fn_strategy->get_row(@$budgetamount['subactivityid']);
			$data['division'] = $this->division->get_row(@$budgetamount['divisionid']);
			
			if($id>0){
				$project = $this->fn_budget_master->get_row($id);				
				$data['parent'] = $this->fn_strategy->get_row($project['subactivityid']);
				$division = $this->db->getrow("SELECT CNF_DIVISION.* FROM CNF_WORKGROUP LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID=CNF_DIVISION.ID WHERE CNF_WORKGROUP.ID=".$project['workgroup_id']);
				dbConvert($division);
				$data['division'] = $division;
				$data['project'] = $project;								
			}			
			$data['projectBudgetDatalist'] = $this->GetProjectBudgetDatatList($id);
		}
		else
		{
			$data['self'] = $this->fn_strategy->get_row($id);			
		}
		$this->template->build($formtype."_form",$data);
	}
	
	function save($formtype=FALSE){
		if($_POST){
			switch($formtype){
				case "department":
					$pid = $this->divisionamount->save(array(
					"id"=>$_POST['id'],
					"divisionid"=>$_POST['divisionid'],
					"fnyear"=>$_POST['fnyear'],
					"subactivityid"=>$_POST['subactivityid']
					));
					if(isset($_POST['eptotal'])){
					foreach($_POST['eptotal'] as $key=>$item){
							if($_POST['eptotal'][$key]){
								$this->divisionamount_detail->save(array(
									'id'=>$_POST['rid'][$key],									
									'pid'=>$pid,
									'budgettypeid'=>$_POST['expenseid'][$key],
									'budget'=>str_replace(',','',$_POST['eptotal'][$key])							
								));
							}
						}	
					}
					break;
				case "division":					
					$pid = $this->divisionamount->save(array(
					"id"=>$_POST['id'],
					"divisionid"=>$_POST['divisionid'],
					"fnyear"=>$_POST['fnyear'],
					"subactivityid"=>$_POST['subactivityid']
					));
					if(isset($_POST['eptotal'])){
					foreach($_POST['eptotal'] as $key=>$item){
							if($_POST['eptotal'][$key]){
								$this->divisionamount_detail->save(array(
									'id'=>$_POST['rid'][$key],									
									'pid'=>$pid,
									'budgettypeid'=>$_POST['expenseid'][$key],
									'budget'=>str_replace(',','',$_POST['eptotal'][$key])							
								));
							}
						}	
					}
					break;
				case "project":
					//$this->db->debug=true;
					$pid = $this->fn_budget_master->save(array(
					"id"=>$_POST['id'],
					"budgetyear"=>$_POST['fnyear'],
					"projecttitle"=>$_POST['projecttitle'],
					"subactivityid"=>$_POST['subactivityid'],
					"workgroup_id"=>$_POST['workgroupid'],					
					));
					if(isset($_POST['eptotal'])){
					foreach($_POST['eptotal'] as $key=>$item){
							if($_POST['eptotal'][$key]){
								$this->fn_budget_type_detail->save(array(
									'id'=>$_POST['rid'][$key],									
									'budgetid'=>$pid,
									'budgetyear'=>$_POST['fnyear'],
									'budgettypeid'=>$_POST['expenseid'][$key],
									'budget'=>str_replace(',','',$_POST['eptotal'][$key])							
								));
							}
						}	
					}
				break;
				default:
				$this->fn_strategy->save($_POST);
				break;
			}
			set_notify('success', lang('save_data_complete'));
		}
		redirect('finance_budget_plan/index/'.$_POST['fnyear']);
	}
	
	//--- dear edit user'n finance_budget_plan ajax ---
	function select_budgetyeartype_find_plan(){
		if($_POST['budgetyeartype']){
			$budgetyeartype_id = $_POST['budgetyeartype'];
			$parent = $this->fn_strategy->get_row($budgetyeartype_id);
			
			echo @form_dropdown('planid',get_option('id','title',"fn_strategy where pid=".@$parent['id']." and budgetyeartype > 0 and planid = 0 and fnyear = ".$parent['fnyear']),'','','-- เลือกแผนงาน --');
		}
	}
	
	function select_plan_find_product(){
		if($_POST['planid']){
			$planid = $_POST['planid'];
			$parent = $this->fn_strategy->get_row($planid);
			
			echo @form_dropdown('productivityid',get_option('id','title',"fn_strategy where pid = ".@$parent['id']." AND productivityid=0 AND fnyear=".$parent['fnyear']),'','','-- เลือกผลผลิต --');
		}
	}
	
	function select_product_find_mainact(){
		if($_POST['productivityid']){
			$productivityid = $_POST['productivityid'];
			$parent = $this->fn_strategy->get_row($productivityid);
			
			echo @form_dropdown('mainactid',get_option('id','title',"fn_strategy where pid = ".@$parent['id']." and mainactid = 0 and fnyear = ".$parent['fnyear']),'','','-- เลือกกิจกรรมหลัก --');
		}
	}
	
	function GetDivisionBudgetDatalist($pFNYear=FALSE,$pDivisionID=FALSE,$pSubActivityID=FALSE){
		$dataList = '';
		$amount=0;
		if($pFNYear!="")
		{
			$budgettype = $this->budgettype->where("PID=0")->get();			
			foreach($budgettype as $bgrow):
				$sql = " SELECT SUM(BUDGET) FROM FN_DIVISION_BUDGET_AMOUNT fda 
				LEFT JOIN FN_DIVISION_BUDGET_AMOUNT_DETAIL fdad 
				ON fda.ID=fdad.PID 
				 WHERE fdad.BUDGETTYPEID IN (SELECT ID FROM FN_BUDGET_TYPE WHERE PID=".$bgrow['id']." AND EXPENSETYPEID=0) "." AND FNYEAR=".$pFNYear." AND SUBACTIVITYID=".$pSubActivityID." AND DIVISIONID=".$pDivisionID."";
				$totalbgtype = $this->db->getone($sql);
				$dataList.='<tr class="odd">';
				$dataList.='<td>'.$bgrow['title'].'</td>';
				$dataList.='<td>&nbsp;</td>';
				$dataList.='<td class="tdbgtotal'.$bgrow['id'].'" align="right">'.number_format($totalbgtype,2).'</td>';
				$dataList.='</tr>';				
				$expensetype = $this->budgettype->where("PID=".$bgrow['id'])->get();
				foreach($expensetype as $eprow):
				
				$sql = " SELECT fdad.* FROM FN_DIVISION_BUDGET_AMOUNT fda 
				LEFT JOIN FN_DIVISION_BUDGET_AMOUNT_DETAIL fdad ON fda.ID=fdad.PID 
 			    WHERE fdad.BUDGETTYPEID =".$eprow['id']." AND FNYEAR=".$pFNYear." AND SUBACTIVITYID=".$pSubActivityID." AND DIVISIONID=".$pDivisionID;
				$damount = $this->db->getrow($sql);		
				
				$amount+= @$damount['BUDGET'];				
				$dataList.='<tr>';				
				$dataList.='<td>&nbsp;</td>';
				$dataList.='<td>'.$eprow['title'].'</td>';
				$dataList.='<td class="tdexp" align="right">';				
				$dataList.='<input type="text" name="eptotal[]" id="eptotal" class="eptotal eptotal'.$bgrow['id'].'" value="'.number_format(@$damount['BUDGET'],2).'" alt="decimal" onkeyup="CalculateSummary(\''.$bgrow['id'].'\')">';
				$dataList.='<input type="hidden" name="expenseid[]" id="epid" value="'.$eprow['id'].'"><input type="hidden" name="rid[]" value="'.$damount['ID'].'">';
				$dataList.='</td>';
				$dataList.='</tr>';				
				endforeach;
			endforeach;
			$dataList.='<tr class="total">';
			$dataList.='<td colspan="2" align="right"><strong>รวมงบประมาณ</strong></td>';
			$dataList.='<td align="right" id="summary" style="color:#F92C2C"><strong>'.number_format($amount,2).'</strong></td>';  
			$dataList.='</tr>';
		}
		return $dataList;
	}
	
	function GetProjectBudgetDatatList($pProjectID){
		$dataList = '';
		$amount=0;
			$budgettype = $this->budgettype->where("PID=0")->get();			
			$project = $this->fn_budget_master->get_row($pProjectID);
			foreach($budgettype as $bgrow):
				$list_bgtype = @$list_bgtype !='' ? $list_bgtype."|".$bgrow['id'] : $bgrow['id'];
				$sql = " SELECT SUM(BUDGET) FROM FN_BUDGET_TYPE_DETAIL FBD ";				
				$sql.= " WHERE FBD.BUDGETID=".$pProjectID." AND  FBD.BUDGETTYPEID IN (SELECT ID FROM FN_BUDGET_TYPE WHERE PID=".$bgrow['id']." AND EXPENSETYPEID = 0)";
				$totalbgtype = $this->db->getone($sql);
				$dataList.='<tr class="odd">';
				$dataList.='<td>'.$bgrow['title'].'</td>';
				$dataList.='<td>&nbsp;</td>';
				$dataList.='<td class="tdbgtotal'.$bgrow['id'].'" align="right">'.number_format($totalbgtype,2).'</td>';
				$dataList.='<td class="tdbg_percent_total'.$bgrow['id'].'" align="right">'.number_format(@$totalbg_percent_type,2).'</td>';
				$dataList.='<td class="tdbg_net_total'.$bgrow['id'].'" align="right">'.number_format(@$totalbg_net_type,2).'</td>';
				$dataList.='</tr>';				
				$expensetype = $this->budgettype->where("PID=".$bgrow['id'])->get();
				foreach($expensetype as $eprow):								
									
				$percent = $this->fn_percent->where("budget_year=".$project['budgetyear']." AND division_id=".$project['divisionid']."  AND expense_type_id=".$eprow['id'])->get_row();
				
				$sql = " SELECT * FROM FN_BUDGET_TYPE_DETAIL 
 			    WHERE BUDGETID=".$pProjectID." AND BUDGETTYPEID=".$eprow['id'];
				$damount = $this->db->getrow($sql);		
				
				$amount+= @$damount['BUDGET'];				
				$dataList.='<tr>';				
				$dataList.='<td>&nbsp;</td>';
				$dataList.='<td>'.$eprow['title'].'</td>';
				$dataList.='<td class="tdexp" align="right">';				
				$dataList.='<input type="text" name="eptotal[]" id="eptotal" class="eptotal  eptotal'.$bgrow['id'].'" value="'.number_format(@$damount['BUDGET'],2).'" alt="decimal"  onkeyup="CalculateSummary(\''.$bgrow['id'].'\')">';
				$dataList.='<input type="hidden" name="expenseid[]" id="epid" value="'.$eprow['id'].'"><input type="hidden" name="rid[]" value="'.$damount['ID'].'" />';
				$dataList.='</td>';
				$dataList.='<td class="tdexp_percent" align="right">';
				$dataList.= @$percent['percent_value'] > 0 ? '<input type="hidden" class="ep" value="'.$percent['percent_value'].'"><span>หักตามนโยบาย'.number_format(@$percent['percent_value'],2).'% </span>' : '<input type="hidden" class="ep" value="0"><span class="ep"></span>';
				
				$ep_percent = @$percent['percent_value'] > 0 && $damount['BUDGET'] > 0 ? $damount['BUDGET']*($percent['percent_value']/100) : 0; 
				
				$dataList.=' <input type="text" name="ep_percent[]" id="ep_percent" class="ep_percent_total  ep_percent_total'.$bgrow['id'].'"  value="'.number_format($ep_percent,2).'" alt="decimal">';
				$dataList.='</td>';
				$dataList.='<td class="tdexp_net" align="right">';
				
				$ep_amount = $damount['BUDGET'] - $ep_percent;
				
				$dataList.='<input type="text" name="ep_net[]" id="ep_net" class="ep_net_total  ep_net_total'.$bgrow['id'].'"  value="'.number_format($ep_amount,2).'" alt="decimal">';
				$dataList.='</td>';
				$dataList.='</tr>';				
				endforeach;
			endforeach;
			$dataList.='<tr class="total">';
			$dataList.='<td colspan="2" align="right"><input type="hidden" id="list_bgtype" name="list_bgtype" value="'.$list_bgtype.'"><strong>รวมงบประมาณ</strong></td>';
			$dataList.='<td align="right" id="summary" style="color:#F92C2C"><strong>'.number_format($amount,2).'</strong></td>';
			$dataList.='<td align="right" id="percent_summary" style="color:#F92C2C"><strong>'.number_format(@$amount_percent,2).'</strong></td>';
			$dataList.='<td align="right" id="net_summary" style="color:#F92C2C"><strong>'.number_format(@$amount_net,2).'</strong></td>';  
			$dataList.='</tr>';		
		return $dataList;
	}
	
}
?>