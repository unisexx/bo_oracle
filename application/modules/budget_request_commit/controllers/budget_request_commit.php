<?php
class budget_request_commit extends Budget_Controller
{
	public $step_title = array('','เสนอคำของบประมาณ','ปรับปรุงคำของบประมาณตามมติ สำนักงบประมาณ','ปรับปรุงคำของบประมาณตามมติ ครม.','ปรับปรุงคำของบประมาณตามมติ กระทรวง','แปรญิตติเพิ่ม'
	,'ปรับปรุงคำของบประมาณจากผลการพิารณาของกรรมาธิการ','รายละเอียดงบประมาณตาม พรบ.','ปรับปรุงงบประมาณเพื่อการบริหาร');
	public function __construct()
	{
		parent::__construct();
														
		$this->load->model('c_division/division_model','division');	
		$this->load->model('budget_type/budget_type_model','budget_type');
		$this->load->model('budget_plan/budget_plan_model','budget_plan');
		$this->load->model('budget_time/budget_time_model','budget_time');
		$this->load->model('budget_plan/budget_plan_detail_model','budget_plan_detail');
		$this->load->model('c_province/province_model','province');
		$this->load->model('budget_request/budget_master_model','bg_master');
		$this->load->model('budget_request/budget_process_model','bg_process');	
		$this->load->model('budget_request/budget_operation_area_model','bg_operation_area');		
		$this->load->model('budget_request/budget_current_target_model','bg_current_target');
		$this->load->model('budget_request/budget_area_model','bg_area');
		$this->load->model('budget_request/budget_expense_type_model','bg_expense_type');
		$this->load->model('budget_asset/budget_asset_model','asset');
		$this->load->model('budget_request/budget_type_detail_model','bg_type_detail');
		$this->load->model('budget_request/workgroup_send_confirm_model','workgroup_send_confirm');
		$this->load->model('budget_request/budget_send_remark_model','budget_send_remark');		
		$this->load->model('budget_request/budget_adjust_model','budget_adjust');
	}
	/*
	<li><a href="#tabs-1" title="เสนอคำของบประมาณ" alt="เสนอคำของบประมาณ" class="tip">ขั้นตอนที่ 1</a></li>
      <li><a href="#tabs-2" title="ปรับปรุงคำของบประมาณตามมติ สำนักงบประมาณ" alt="ปรับปรุงคำของบประมาณตามมติ สำนักงบประมาณ" class="tip">ขั้นตอนที่ 2</a></li>
      <li><a href="#tabs-3" title="ปรับปรุงคำของบประมาณตามมติ ครม." alt="ปรับปรุงคำของบประมาณตามมติ ครม." class="tip">ขั้นตอนที่ 3</a></li>
      <li><a href="#tabs-4" title="ปรับปรุงคำของบประมาณตามมติ กระทรวง" alt="ปรับปรุงคำของบประมาณตามมติ กระทรวง" class="tip">ขั้นตอนที่ 4</a></li>
      <li><a href="#tabs-5" title="แปรญิตติเพิ่ม" alt="แปรญิตติเพิ่ม" class="tip">ขั้นตอนที่ 5</a></li>
      <li><a href="#tabs-6" title="ปรับปรุงคำของบประมาณจากผลการพิารณาของกรรมาธิการ" alt="ปรับปรุงคำของบประมาณจากผลการพิารณาของกรรมาธิการ" class="tip">ขั้นตอนที่ 6</a></li>
      <li><a href="#tabs-7" title="รายละเอียดงบประมาณตาม พรบ." alt="รายละเอียดงบประมาณตาม พรบ." class="tip">ขั้นตอนที่ 7</a></li>
    <li><a href="#tabs-8" title="ปรับปรุงงบประมาณเพื่อการบริหาร" alt="ปรับปรุงงบประมาณเพื่อการบริหาร" class="tip">ขั้นตอนที่ 8</a></li>	 
	 */	
	public function index()
	{
		//$this->db->debug = true;
		if(!is_login())redirect("home.php");
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['step_title'] = $this->step_title;		
		if(@$_GET['budgetyear']>0){			
			$tcondition  =login_data('budgetcanaccessall') != 'on' ? " AND WORKGROUP_ID=".login_data('workgroupid') : '';
	  		$sql = "SELECT MAX(STEP)STEP FROM WORKGROUP_SEND_CONFIRM WHERE BUDGET_YEAR=".@$_GET['budgetyear'].$tcondition;
			$data['maxround'] = $this->db->getone($sql);		
			$data['budgetyear'] = @$_GET['budgetyear'];
			$data['divisionid'] = @$_GET['divisionid'];
			$data['workgroupid'] = @$_GET['workgroupid'];										
		}
		$this->template->build('index',$data);
	}
	
	public function adjust_budget($step,$divisionid,$budgetyear){
		$data['step'] = $step;
		$data['budgetyear'] = $budgetyear;
		$data['divisionid'] = $divisionid;
		$data['division'] = $this->division->get_row($divisionid);
		$budgetMonth = '';
		 for($m=1;$m<=12;$m++)
		 {
			 	if($budgetMonth != '') $budgetMonth .=" + ";
			 	$budgetMonth .=" BUDGET_M".$m;
		 }
		$i = 0;
		$ColID = array(-1);
		$ColTitle = array(-1);
	    $ColParent = array(-1);
	    $ColParent2 = array(-1);
		
		$condition  = "SELECT DISTINCT CNF_BUDGET_TYPE.BUDGETTYPEID FROM BUDGET_MASTER 
		LEFT JOIN BUDGET_EXPENSE_TYPE ON BUDGET_MASTER.ID = BUDGET_EXPENSE_TYPE.BUDGETID 
		LEFT JOIN CNF_BUDGET_TYPE ON BUDGET_EXPENSE_TYPE.EXPENSETYPEID = CNF_BUDGET_TYPE.ID 
		WHERE BUDGET_MASTER.BUDGETYEAR=".$budgetyear." AND BUDGET_MASTER.WORKGROUP_ID IN (SELECT ID FROM CNF_WORKGROUP WHERE DIVISIONID=".$divisionid.") ";
			
		$sql = "SELECT CNF_BUDGET_TYPE.* FROM CNF_BUDGET_TYPE LEFT JOIN BUDGET_EXPENSE_TYPE ON CNF_BUDGET_TYPE.ID = BUDGET_EXPENSE_TYPE.EXPENSETYPEID WHERE CNF_BUDGET_TYPE.ID IN (".$condition.") ORDER BY TITLE ";
		$result = $this->db->getarray($sql);
		dbConvert($result);
		foreach($result as $BudgetType_1)	
		{		
				 array_push($ColID,$BudgetType_1['id']);
				 array_push($ColTitle,$BudgetType_1['title']);
				 array_push($ColParent,0);
				 array_push($ColParent2,-1);							 
	
						$ncolumn1 = 0;
						$sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE PID=".$BudgetType_1['id']." AND (SELECT COUNT(*) FROM CNF_BUDGET_TYPE S3 WHERE PID = CNF_BUDGET_TYPE.ID)>0 ORDER BY TITLE ";
						$sresult = $this->db->getarray($sql);
						dbConvert($sresult);
						foreach($sresult as $BudgetType_2)					
						{
								 array_push($ColID,$BudgetType_2['id']);
								 array_push($ColTitle,$BudgetType_2['title']);
								 array_push($ColParent,$BudgetType_1['id']);
								 array_push($ColParent2,-1);						
	
								$sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE PID=".$BudgetType_2['id']." ORDER BY TITLE ";
	                            $ssresult = $this->db->getarray($sql);
	                            dbConvert($ssresult);
	                            foreach($ssresult as $BudgetType_3)                            
	                            {
									 array_push($ColID,$BudgetType_3['id']);
									 array_push($ColTitle,$BudgetType_3['title']);
									 array_push($ColParent,$BudgetType_1['id']);
									 array_push($ColParent2,$BudgetType_2['id']);
								 }
	
						}							
		}
		 
		$data['totalColumn'] = 0;
		$data['nextstep'] = $step+1;
		$data['steptitle'] = array('',	'เสนอคำของบประมาณ','ปรับปรุงคำของบประมาณตามมติ สำนักงบประมาณ','ปรับปรุงคำของบประมาณตามมติ ครม.','ปรับปรุงคำของบประมาณตามมติ กระทรวง','แปรญิตติเพิ่ม','ปรับปรุงคำของบประมาณจากผลการพิารณาของกรรมาธิการ','รายละเอียดงบประมาณตาม พรบ.','ปรับปรุงงบประมาณเพื่อการบริหาร');	

		$data['ColID'] = $ColID;
		$data['ColTitle'] = $ColTitle;
		$data['ColParent']= $ColParent;
		$data['ColParent2'] = $ColParent2;	
		$data['budgetMonth'] = $budgetMonth;	
		$this->template->build('adjust_form',$data);
	}
	public function load_remark(){
		$data['act'] = $_POST['act'];
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['budgetyear'] = $_POST['budgetyear'];
		$data['divisionid'] = $_POST['divisionid']; 
		$data['step'] = $_POST['step'];
		$data['division'] = $this->division->get_row($data['divisionid']);
		$data['comment'] = $this->budget_send_remark->where(' budgetyear='.$data['budgetyear']." AND SECTION_ID=".$data['divisionid']." AND STEP=".$data['step'])->get_row();
		$this->load->view('remark_form',$data);
	}	
	public function print_remark($step,$budgetyear,$divisionid){
		$data['act'] = "print";		
		$data['budgetyear'] = $budgetyear;
		$data['divisionid'] = $divisionid; 
		$data['step'] = $step;
		$data['division'] = $this->division->get_row($data['divisionid']);
		$data['comment'] = $this->budget_send_remark->where(' budgetyear='.$data['budgetyear']." AND SECTION_ID=".$data['divisionid']." AND STEP=".$data['step'])->get_row();
		$this->load->view('remark_form',$data);
	}
	public function send_back(){
		//$this->db->debug = true;
		$url_parameter = GetCurrentUrlGetParameter();		
		$modifyDate = date("Y-m-d H:i:s");
		$modifyDate = strtotime($modifyDate);
		$budgetyear = @$_POST['budgetyear'];
		$step = @$_POST['step'];
		$divisionid = @$_POST['divisionid'];		
		$remark = @$_POST['remark'];
		$workgroupid = @$_POST['workgroupid'];
		$sql = " SELECT ID FROM BUDGET_SEND_REMARK WHERE SECTION_ID=".$divisionid." AND BUDGETYEAR=".$budgetyear." AND STEP=".$step;
		$id = $this->db->getone($sql);
		
		$this->budget_send_remark->save(array('id'=>$id,'budgetyear'=>$budgetyear,'step'=>$step,'remark'=>$remark,'userid'=>login_data('id'),'commentdate'=>strtotime(date("Y-m-d H:i:s")),'section_id'=>$divisionid));

		$sql = "UPDATE BUDGET_MASTER SET STATUS=1 WHERE WORKGROUP_ID IN (SELECT ID FROM CNF_WORKGROUP WHERE DIVISIONID=".$divisionid.") AND BUDGETYEAR=".$budgetyear." AND STEP=".$step;
		$this->db->Execute($sql);

		$sql = "UPDATE WORKGROUP_SEND_CONFIRM SET STATUS=1 WHERE WORKGROUP_ID IN (SELECT ID FROM CNF_WORKGROUP WHERE DIVISIONID=".$divisionid.") AND BUDGET_YEAR=".$budgetyear." AND STEP=".$step;
		$this->db->Execute($sql);		
		
		redirect('budget_request_commit/index'.$url_parameter);
	}

	public function save_adjust($step,$divisionid,$budgetyear){
	//$this->db->debug= true;
	$division = $this->division->get_row($divisionid);	
	$i = 0;
	$ColID = array(-1);
	$ColTitle = array(-1);
    $ColParent = array(-1);
    $ColParent2 = array(-1);
	$condition  = "SELECT DISTINCT CNF_BUDGET_TYPE.BUDGETTYPEID FROM BUDGET_MASTER 
		LEFT JOIN BUDGET_EXPENSE_TYPE ON BUDGET_MASTER.ID = BUDGET_EXPENSE_TYPE.BUDGETID 
		LEFT JOIN CNF_BUDGET_TYPE ON BUDGET_EXPENSE_TYPE.EXPENSETYPEID = CNF_BUDGET_TYPE.ID 
		WHERE BUDGET_MASTER.BUDGETYEAR=".$budgetyear." AND BUDGET_MASTER.WORKGROUP_ID IN (SELECT ID FROM CNF_WORKGROUP WHERE DIVISIONID=".$divisionid.") ";
			
	$sql = "SELECT CNF_BUDGET_TYPE.* FROM CNF_BUDGET_TYPE LEFT JOIN BUDGET_EXPENSE_TYPE ON CNF_BUDGET_TYPE.ID = BUDGET_EXPENSE_TYPE.EXPENSETYPEID WHERE CNF_BUDGET_TYPE.ID IN (".$condition.") ORDER BY TITLE ";
	$result = $this->db->getarray($sql);
	dbConvert($result);
	foreach($result as $BudgetType_1)	
	{		
			 array_push($ColID,$BudgetType_1['id']);
			 array_push($ColTitle,$BudgetType_1['title']);
			 array_push($ColParent,0);
			 array_push($ColParent2,-1);							 

					$ncolumn1 = 0;
					$sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE PID=".$BudgetType_1['id']." AND (SELECT COUNT(*) FROM CNF_BUDGET_TYPE S3 WHERE PID = CNF_BUDGET_TYPE.ID)>0 ORDER BY TITLE ";
					$sresult = $this->db->getarray($sql);
					dbConvert($sresult);
					foreach($sresult as $BudgetType_2)					
					{
							 array_push($ColID,$BudgetType_2['id']);
							 array_push($ColTitle,$BudgetType_2['title']);
							 array_push($ColParent,$BudgetType_1['id']);
							 array_push($ColParent2,-1);						

							$sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE PID=".$BudgetType_2['id']." ORDER BY TITLE ";
                            $ssresult = $this->db->getarray($sql);
                            dbConvert($ssresult);
                            foreach($ssresult as $BudgetType_3)                            
                            {
								 array_push($ColID,$BudgetType_3['id']);
								 array_push($ColTitle,$BudgetType_3['title']);
								 array_push($ColParent,$BudgetType_1['id']);
								 array_push($ColParent2,$BudgetType_2['id']);
							 }

					}							
	}			
	$adjust_step = $step;
	$sql = " DELETE FROM BUDGET_ADJUST WHERE  BUDGET_YEAR=".$budgetyear." AND SECTION_ID=".$divisionid." AND ADJUST_STEP=".$adjust_step;
	$this->db->Execute($sql);
    $typeNo = 0;		
	$workgroup = 0;
		
		
		if(@$_POST['chkfollow']!='')
		{			
			$result = $this->budget_adjust->where(" BUDGET_YEAR=".$budgetyear." AND SECTION_ID=".$divisionid." AND ADJUST_STEP=".($step-1))->get(FALSE,TRUE);
			foreach($result as $row){
				$data = $row;
				$data['id'] = '';				
				$data['adjust_step'] = $step;				
				$this->budget_adjust->save($data);
				$data = '';
			}
		}
		else
		{
			$sql = "SELECT DISTINCT SUBACTIVITYID  FROM BUDGET_MASTER WHERE BUDGETYEAR=".$budgetyear." AND WORKGROUP_ID IN (SELECT ID FROM CNF_WORKGROUP WHERE divisionid=".$divisionid.") AND STEP = ".$step;
			$result = $this->bg_master->get($sql,TRUE);			
			foreach($result as $row)
			{
				 $typeNo ++;
				 $budgetStrategy = $this->budget_plan->get_row($row['subactivityid']);
				 
				  for($i=0;$i<count($ColID);$i++)
				  {
					  if($ColParent[$i] > 0 && $ColParent2[$i] > 0)
					  {
						  $ncolumn =0;
						  $budget = @$_POST[$row['subactivityid']."_".$ColID[$i]];
						  //$sql = " INSERT INTO BUDGET_ADJUST (ID,SUBACTIVITY_ID , BUDGET_TYPE_ID, BUDGET_YEAR, SECTION_ID, WORKGROUP_ID, ADJUST_STEP, BUDGET_VALUE )
						  //VALUES(".GenMaxID("BUDGET_ADJUST").", ".$row['SUBACTIVITYID'].", ".$ColID[$i].",".$year.",".$sectionID.",".$workgroup.",".$step.",".$budget.")";
						  $data['id'] = '';
						  $data['subactivity_id'] = $row['subactivityid'];
						  $data['budget_type_id'] = $ColID[$i];
						  $data['budget_year'] = $budgetyear;
						  $data['section_id'] = $divisionid;
						  $data['adjust_step'] = $step;
						  $data['budget_value'] = $budget;				  
						  $this->budget_adjust->save($data);
						  $data='';
					  }
				  }
			}
		}
		
		$scondition = " AND WORKGROUP_ID IN (SELECT ID FROM CNF_WORKGROUP WHERE divisionid=".$divisionid.") ";
		$this->db->Execute("DELETE FROM BUDGET_MASTER WHERE BUDGETYEAR=".$budgetyear.$scondition." AND STEP=".($step+1));
		$sql = "SELECT count(*) FROM BUDGET_MASTER WHERE BUDGETYEAR=".$budgetyear.$scondition." AND STEP=".($step+1);
		$exist = $this->db->getone($sql);				
		if($exist<1)
		{
				$createDate = date("Y-m-d H:i:s");
				$createDate = strtotime($createDate);
				$modifyDate = $createDate; 			
				$result = $this->bg_master->where(" BUDGETYEAR=".$budgetyear.$scondition." AND STEP=".$step)->get(FALSE,TRUE);
				foreach($result as $row)
				{
				$bid = $row['id'];
				$data = $row;
				$data['id'] = '';
				$data['createdate'] = $createDate;
				$data['lastmodify'] = $modifyDate;
				$data['step'] = $step+1;
				$nbid = $this->bg_master->save($data);
				
				$this->bg_area->delete('budgetid',$nbid);
				
					$sresult = $this->bg_area->select('*')->join('')->where("budgetid = ".$bid)->get(FALSE,TRUE);
					foreach($sresult as $srow)
					{						
						$data = $srow;
						$data['id'] = 0;
						$data['budgetid'] = $nbid;
						$this->bg_area->save($data);
						$data = '';
					}
					
					$this->bg_expense_type->delete('budgetid',$nbid);					
					$sresult = $this->bg_expense_type->where("budgetid=".$bid)->get(FALSE,TRUE);							
					foreach($sresult as $srow)
					{						
						$data = $srow;
						$data['id'] = 0 ;
						$data['budgetid'] = $nbid;						
						$this->bg_expense_type->save($data);
						$data='';
					}
					
					$this->bg_operation_area->delete('budgetid',$nbid);
					$sresult = $this->bg_operation_area->select('*')->join('')->where("budgetid=".$bid)->get(FALSE,TRUE);															
					foreach($sresult as $srow)
					{						
						$data = $srow;
						$data['id'] = '';
						$data['budgetid'] = $nbid;
						$this->bg_operation_area->save($data);
						$data='';
					}	
					
					$this->bg_process->delete('budgetid',$nbid);
					$sresult = $this->bg_process->where("budgetid=".$bid)->get(FALSE,TRUE);																				
					foreach($sresult as $srow)
					{						
						$data = $srow;
						$data['id'] = '';
						$data['budgetid'] = $nbid;
						$this->bg_process->save($data);
						$data='';
					}			
					
					/*
					db_query("DELETE FROM BUDGET_PRODUCTIVITY_KEY WHERE BUDGETID=".$nbid);																				
					$sql = "SELECT * FROM BUDGET_PRODUCTIVITY_KEY WHERE BUDGETID=".$bid;
					$sresult = odbc_exec($_SESSION['ResourceID'],$sql);
					while($srow = db_fetch_array($sresult,0))
					{
						 $sql = "INSERT INTO BUDGET_PRODUCTIVITY_KEY (ID,BUDGETID, PRODKEYID, M1, M2, M3, M4, M5, M6, M7, M8, M9, M10, M11, M12, CHKWORKPLAN)VALUES(".GenMaxID('BUDGET_PRODUCTIVITY').",".$nbid.",".$srow['PRODKEYID'].",".$srow['M1'].",".$srow['M2'].",".$srow['M3'].",".$srow['M4'].",".$srow['M5'].",".$srow['M6'].",".$srow['M7'].",".$srow['M8'].",".$srow['M9'].",".$srow['M10'].",".$srow['M11'].",".$srow['M12'].",'".$srow['CHKWORKPLAN']."')";
						odbc_exec($_SESSION['ResourceID'],ConvertCommand($sql));
					}*/	
					
					$this->bg_type_detail->delete('budgetid',$nbid);					
					$sresult = $this->bg_type_detail->where("budgetid=".$bid)->get(FALSE,TRUE);					
					foreach($sresult as $srow)
					{						
						$data = $srow;
						$data['id'] = '';
						$data['budgetid'] = $nbid;
						$this->bg_type_detail->save($data);
						$data = '';
					}			
					
					$this->bg_current_target->delete("budgetid",$nbid);
					
					$sresult = $this->bg_current_target->where("budgetid=".$bid)->get(FALSE,TRUE);
					foreach($sresult as $srow)
					{
						$data = $srow;
						$data['id'] = '';
						$data['budgetid'] = $nbid;						
						$this->bg_current_target->save($data);
						$data = '';
					}					
				}				
		}
		$sql = "UPDATE BUDGET_MASTER SET STATUS=3 WHERE   BUDGETYEAR=".$budgetyear.$scondition." AND STEP=".$step;
		$this->db->Execute($sql);
		$sql = "UPDATE WORKGROUP_SEND_CONFIRM SET STATUS=3 WHERE   BUDGET_YEAR=".$budgetyear.$scondition." AND STEP=".$step;
		$this->db->Execute($sql);		
		
		$sql = " DELETE FROM WORKGROUP_SEND_CONFIRM WHERE BUDGET_YEAR=".$budgetyear." AND STEP=".($step+1);
		$this->db->Execute($sql);						
		
		$sql = "SELECT ID FROM CNF_WORKGROUP WHERE divisionid=".$divisionid;
		$result = $this->db->getarray($sql);
		foreach($result as $row){
			$data['workgroup_id'] = $row['ID'];
			$data['budget_year'] = $budgetyear;
			$data['step'] = $step+1;
			$data['status'] = 1;
			$this->workgroup_send_confirm->save($data);
			$data = '';				
		}
		redirect('budget_request_commit/index?budgetyear='.$budgetyear."&divisionid=".$divisionid);
	}
}
?>