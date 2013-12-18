<?php
class Monitor_operation_withdraw extends Monitor_Controller
{
	public $modules_name = "monitor_operation_withdraw";
	public $modules_title = "บันทึกผลการดำเนินงานและเบิกจ่าย";
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mt_project_withdraw_model','mt_project_withdraw');
		$this->load->model('mt_project_withdraw_detail_model','mt_project_withdraw_detail');
		$this->load->model('mt_project_withdraw_history_model','mt_project_withdraw_history');
		$this->load->model('monitor_budget_plan/mt_budget_plan_model','mt_strategy');
		$this->load->model('monitor_budget_plan/mt_strategy_key_model','mt_strategy_key');
		$this->load->model('monitor_budget_plan/mt_project_model','mt_project');
		$this->load->model('monitor_budget_plan/mt_project_detail_model','mt_project_detail');
		$this->load->model('monitor_budget_plan/mt_project_subdetail_model','mt_project_subdetail');
		$this->load->model('monitor_budget_plan/mt_budget_record_model','mt_budget_record');		
		$this->load->model('c_department/department_model','department');
		$this->load->model('c_division/division_model','division');
		$this->load->model('c_province/province_model','province');				
		$this->load->model('finance_budget_plan/fn_budget_type_model','fn_budget_type');
	}
	
	function index()
	{
		//$this->db->debug = true;			
		if(!permission($this->modules_name,'canview'))redirect('monitor');
		$data['mtyear'] = $this->mt_strategy->get("SELECT DISTINCT MTYEAR FROM ".$this->mt_strategy->table,TRUE);			
		if(@$_GET['pdepartment_id']>0 && @$_GET['pdivision_id'] > 0 && @$_GET['pprovince_id'] && @$_GET['mtyear'] > 0){			
		$mtyear = @$_GET['mtyear'];
		$departmentid = @$_GET['pdepartment_id'];
		$divisionid = @$_GET['pdivision_id'];
		$provinceid = @$_GET['pprovince_id'];
					
			
			$sql = "SELECT count(*) FROM MT_STRATEGY
			WHERE 
			ID IN(
			SELECT PRODUCTIVITYID FROM MT_PROJECT 
			LEFT JOIN MT_BUDGET_RECORD ON MT_PROJECT.ID = MT_BUDGET_RECORD.MASTERID
			LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID=MT_STRATEGY.ID  
			WHERE 1=1 ";
			$sql .= $mtyear > 0 ? " AND MTYEAR=".$mtyear : "";		
			
			$sql .= $provinceid > 0 ? " AND MT_BUDGET_RECORD.PROVINCEID=".$provinceid : "";
			
			if($provinceid==2)
			{
				$sql .= $divisionid > 0 ? " AND MT_BUDGET_RECORD.DIVISIONID=".$divisionid : "";			
				$sql .= $departmentid > 0 ? " AND MT_STRATEGY.DEPARTMENTID=".$departmentid : "";
			}
			$sql .=")";
			
			$nrow = $this->db->getone($sql);
			
			 $sql = "SELECT title FROM MT_STRATEGY
			WHERE 
			ID IN(
			SELECT PRODUCTIVITYID FROM MT_PROJECT 
			LEFT JOIN MT_BUDGET_RECORD ON MT_PROJECT.ID = MT_BUDGET_RECORD.MASTERID
			LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID=MT_STRATEGY.ID  WHERE 1=1 ";
			$sql .= $mtyear > 0 ? " AND MTYEAR=".$mtyear : "";		
	
			$sql .= $provinceid > 0 ? " AND MT_BUDGET_RECORD.PROVINCEID=".$provinceid : "";
			
			if($provinceid==2)
			{
				$sql .= $divisionid > 0 ? " AND MT_BUDGET_RECORD.DIVISIONID=".$divisionid : "";				
				$sql .= $departmentid > 0 ? " AND MT_STRATEGY.DEPARTMENTID=".$departmentid : "";
			}
			$sql .=") group by title";
					
			
			//$this->db->debug = true;
			$productivity_result = $this->db->getarray($sql);
			dbConvert($productivity_result);
			$data['productivity_result'] = $productivity_result;
		
		}
			
		if(@$_GET['pdepartment_id']>0 && @$_GET['mtyear']>0 && @$_GET['pproductivity_id'] !='' &&@$_GET['month']>0)
		{
			$data['listData'] = $this->GetDataList(@$_GET['mtyear'],@$_GET['month'],@$_GET['pdepartmentid'],@$_GET['pdivision_id'],@$_GET['pproductivity_id'],@$_GET['pprovince_id']);
		}		
		$this->template->build('monitor_operation_withdraw_index',$data);		
	}
	function form($lv=FALSE,$pid=FALSE,$id=FALSE)
	{
		//$this->db->debug=true;
		if(!permission($this->modules_name,'canview'))redirect('monitor');
		$data['url'] = "txtsearch=".@$_GET['txtsearch'].'&pdepartment_id='.@$_GET['pdepartment_id'].'&pdivision_id='.@$_GET['pdivision_id'].'&pprovince_id='.@$_GET['pprovince_id'].'&mtyear='.@$_GET['mtyear'].'&pproductivity_id='.@$_GET['pproductivity_id'].'&month='.@$_GET['month'].'&projectid='.@$_GET['projectid'];		
		$sql = " SELECT mt_project.*, cnf_count_unit.title targettitle FROM mt_project LEFT JOIN cnf_count_unit ON mt_project.targettype = cnf_count_unit.id "; 		
		$data['project'] = $this->db->getrow($sql." where mt_project.ID=".@$_GET['projectid']);
		dbConvert($data['project']);
		//$data['projectDetail'] = $this->mt_project_detail->where("MASTERID=".@$data['project']['id'])->get(FALSE,TRUE);
		$data['provinceid']=@$_GET['pprovince_id'];
		
		$sql = "SELECT MT_PROJECT_SUBDETAIL.*,FN_BUDGET_TYPE.TITLE AS budgettypetitle FROM MT_PROJECT_SUBDETAIL 
		LEFT JOIN FN_BUDGET_TYPE ON MT_PROJECT_SUBDETAIL.SBUDGETTYPEID = FN_BUDGET_TYPE.ID 
		WHERE MT_PROJECT_SUBDETAIL.MASTERID=".@$_GET['projectid']." AND PROVINCEID=".@$_GET['pprovince_id'];
		if($_GET['pprovince_id']=='2')$sql.=" AND MT_PROJECT_SUBDETAIL.DIVISIONID=".@$_GET['pdivision_id'];
		$data['projectDetail'] = $this->db->getarray($sql);
		dbConvert($data['projectDetail']);
		
		$sql = "SELECT MAX(PID) FROM MT_PROJECT 		
		WHERE ID=".@$_GET['projectid'];
		$mainprojectid = $this->db->getone($sql);
		
		if($mainprojectid >0){
		$sql = " SELECT mt_project.*, cnf_count_unit.title targettitle FROM mt_project LEFT JOIN cnf_count_unit ON mt_project.targettype = cnf_count_unit.id "; 					
		$data['mainProject'] = $this->db->getrow($sql." where mt_project.ID=".$mainprojectid);
		dbConvert($data['mainProject']);
		}else{
			$data['mainProject']=$data['project'];
		}
		$data['subProject'] = $data['project']['pid']>0 ? $data['project'] : '';
		$data['division'] = $this->division->where("ID=".$data['project']['divisionid'])->get_row();
		$data['province'] = $this->province->where("ID=".@$_GET['pprovince_id'])->get_row();
		$data['wdproject'] = $this->mt_project_withdraw->where("WMONTH=".@$_GET['month']." AND WYEAR=".@$_GET['mtyear']." AND PROJECTID=".@$_GET['projectid']." AND PROVINCEID=".$_GET['pprovince_id'])->get_row();
		$wddetail = array();
		if(@$data['wdproject']['id']>0){
		$result = $this->mt_project_withdraw_detail->where("PID=".$data['wdproject']['id'])->get(FALSE,TRUE);		
		foreach($result as $detail){
				$wddetail[$detail['budgettypeid']] = $detail['budget'];			
		}
		}
		
		$data['project_record'] = $this->mt_budget_record->where("MASTERID=".$data['project']['id']." AND PROVINCEID=".$_GET['pprovince_id'])->get_row();
		
		$data['wddetail'] = $wddetail;
		$data['subactivity'] = $this->mt_strategy->where("ID=".$data['project']['subactid'])->get_row();
		$month_name = get_month();
		new_save_logfile("VIEW",$this->modules_title,$this->mt_project->table,"ID",@$_GET['projectid'],"title",$this->modules_name," ปี ".(@$_GET['mtyear']+543)." เดือน ".$month_name[@$_GET['month']]." จังหวัด ".$data['province']['title']);
		$this->template->build('monitor_operation_withdraw_form',$data);
	}
	function save($lv=FALSE,$pid=FALSE,$id=FALSE){
		//$this->db->debug = true;
		$url = "txtsearch=".@$_GET['txtsearch'].'&pdepartment_id='.@$_GET['pdepartment_id'].'&pdivision_id='.@$_GET['pdivision_id'].'&pprovince_id='.@$_GET['pprovince_id'].'&mtyear='.@$_GET['mtyear'].'&pproductivity_id='.@$_GET['pproductivity_id'].'&month='.@$_GET['month'].'&projectid='.@$_GET['projectid'];
		if($_POST){
			$currentThaiDate = date("d-m-").(date("Y")+543).' '.date("H:i:s"); 
			$_POST['update_date'] = th_to_stamp($currentThaiDate,TRUE);
			$this->db->Execute(" DELETE FROM MT_PROJECT_WITHDRAW WHERE WMONTH=".@$_GET['month']." AND WYEAR=".@$_GET['mtyear']." AND PROJECTID=".@$_GET['projectid']." AND PROVINCEID=".@$_GET['pprovince_id']);
			$this->db->Execute(" DELETE FROM MT_PROJECT_WITHDRAW_DETAIL WHERE WMONTH=".@$_GET['month']." AND WYEAR=".@$_GET['mtyear']." AND PROJECTID=".@$_GET['projectid']." AND PROVINCEID=".@$_GET['pprovince_id']);
			$id="";			 														    
				$wdID = $this->mt_project_withdraw->save(				
					array('id'=>$id,
					'projectid'=>@$_GET['projectid'],
					'provinceid'=>@$_GET['pprovince_id'],
					'divisionid'=>login_data('divisionid'),
					'wmonth'=>$_GET['month'],
					'wyear'=>$_GET['mtyear'],
					'supportvalue'=>str_replace(',','',$_POST['supportvalue']),
					'supportunit'=>$_POST['supportunit'],					
					'reporter'=>$_POST['reporter'],
					'contactno'=>$_POST['contactno'],
					'suggestion'=>$_POST['suggestion'],
					'targetresult'=>$_POST['targetresult'],
					'update_date'=>$_POST['update_date']
					)
				);
				$this->mt_project_withdraw_detail->delete('pid',$wdID);
				if($_POST['budgettypeid']){
					foreach($_POST['budgettypeid'] as $key=>$item){
						if($_POST['budgettypeid'][$key]){
							$this->mt_project_withdraw_detail->save(
								array('pid'=>$wdID,
								'budgettypeid'=>$_POST['budgettypeid'][$key],
								'budget'=>$_POST['withdraw'][$key],
								'wmonth'=>$_GET['month'],
								'wyear'=>$_GET['mtyear'],
								'projectid'=>@$_GET['projectid'],
								'provinceid'=>@$_GET['pprovince_id'],
								'divisionid'=>login_data('divisionid'),
								)
							);
						}
					}
				}
				
				$this->mt_project_withdraw_history->save(
					array('pid'=>$wdID,
					'userid'=>login_data('id'),
					'savedate'=>$_POST['update_date']
					)
				);
			$month_name = get_month();
			$province = $this->province->get_row(@$_GET['pprovince_id']);
			new_save_logfile("EDIT",$this->modules_title,$this->mt_project->table,"ID",@$_GET['projectid'],"title",$this->modules_name," ปี ".(@$_GET['mtyear']+543)." เดือน ".$month_name[@$_GET['month']]." จังหวัด ".$province['title']);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('monitor_operation_withdraw/index?'.$url);
	}
	function delete($id=FALSE){
		if($id){
			$this->mt_strategy->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	function GetDataList($mtyear=FALSE,$mtmonth=FALSE,$departmentid=FALSE,$divisionid=FALSE,$productivityid=FALSE,$provinceid=FALSE)
	{
		//$this->db->debug = true;
		
		$condition = "1=1";
		$condition .= $mtyear > 0 ? " AND mtyear=".$mtyear : "";
		$condition .= $departmentid > 0 ? " AND departmentid=".$departmentid :"";
		$condition .= $divisionid > 0 ? " AND divisionid=".$divisionid : "";
		
		 $sql = "SELECT * FROM MT_STRATEGY
		WHERE 
		ID IN(
		SELECT MT_STRATEGY.MAINACTID FROM MT_PROJECT 
		LEFT JOIN MT_PROJECT_SUBDETAIL ON MT_PROJECT.ID = MT_PROJECT_SUBDETAIL.MASTERID
		LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID=MT_STRATEGY.ID
		LEFT JOIN MT_STRATEGY PRODUCTIVITY_TBL ON MT_STRATEGY.PRODUCTIVITYID = PRODUCTIVITY_TBL.ID
		LEFT JOIN CNF_DIVISION ON MT_PROJECT.DIVISIONID = CNF_DIVISION.ID  
		WHERE 1=1 ";
		$sql .= $mtyear > 0 ? " AND MT_STRATEGY.MTYEAR=".$mtyear : "";		
		if($provinceid == 2){
		$sql .= $divisionid > 0 ? " AND MT_PROJECT_SUBDETAIL.DIVISIONID=".$divisionid : "";
		}
		$sql .= $departmentid > 0 ? " AND DEPARTMENTID=".$departmentid : "";
		//$sql .= $productivityid >0 ? " AND PRODUCTIVITYID=".$productivityid : "";
		$sql .= $productivityid != '' ? " AND PRODUCTIVITY_TBL.TITLE='".iconv('utf-8','tis620',$productivityid)."'" : "";
		$sql .= $provinceid > 0 ? " AND MT_PROJECT_SUBDETAIL.PROVINCEID=".$provinceid : "";		
		$sql .=")";
		$main_idx=1;
		//echo $sql;				
	
		$mainresult = $this->db->getarray($sql);
		dbConvert($mainresult);
		$dataList = '';
		foreach($mainresult as $main_item){
			
			$mainTotal = GetMainActTotal($mtyear,$main_item['id'],$departmentid,$divisionid,$provinceid);
			//echo $mtyear." / ".$mtmonth;
			$mainwdTotal = GetMainActWithdraw($mtyear,$mtmonth,$main_item['id'],$departmentid,$divisionid,$provinceid);
			$mainAllwdTotal = GetMainActWithdraw($mtyear,'',$main_item['id'],$departmentid,$divisionid,$provinceid);
			$mainAllwdPercent = $mainAllwdTotal > 0  && $mainTotal > 0 ? ($mainAllwdTotal / $mainTotal) *100 : 0;
			
			$mainTotals=$mainTotal-$mainAllwdTotal;
			$dataList .= '<tr style="background:#CCC" >';
			$dataList .= '<td > '.$main_idx.'</td>';
			$dataList .= '<td>'.$main_item['title'].'</td>';
			$dataList .= '<td>'.number_format($mainTotal,2).'</td>';
			$dataList .= '<td>'.number_format($mainwdTotal,2).'</td>';
			$dataList .= '<td>'.number_format($mainAllwdTotal,2).'</td>';
			$dataList .= '<td>'.number_format($mainTotals,2).'</td>';
			$dataList .= '<td>'.number_format($mainAllwdPercent,2).'</td>';
			$dataList .= '<td>&nbsp;</td>';
			$dataList .= '</tr>';		
			
			$sql = "SELECT * FROM MT_STRATEGY
			WHERE 
			ID IN(
			SELECT SUBACTID FROM MT_PROJECT 
			LEFT JOIN MT_PROJECT_SUBDETAIL ON MT_PROJECT.ID = MT_PROJECT_SUBDETAIL.MASTERID
			LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID=MT_STRATEGY.ID  WHERE 1=1 ";
			$sql .= " AND MAINACTID=".$main_item['id'];
			$sql .= $mtyear > 0 ? " AND MTYEAR=".$mtyear : "";		
			if($provinceid == 2){
			$sql .= $divisionid > 0 ? " AND MT_PROJECT_SUBDETAIL.DIVISIONID=".$divisionid : "";
			}
			$sql .= $departmentid > 0 ? " AND DEPARTMENTID=".$departmentid : "";			
			$sql .=")";
			
			$sub_idx = 1;
			$subresult = $this->db->getarray($sql);
			dbConvert($subresult);		
			foreach($subresult as $sub_item){
				
				$subTotal = GetSubActTotal($mtyear,$sub_item['id'],$departmentid,$divisionid,$provinceid);
				$subwdTotal = GetSubActWithdraw($mtyear,$mtmonth,$sub_item['id'],$departmentid,$divisionid,$provinceid);
				$subAllwdTotal = GetSubActWithdraw($mtyear,'',$sub_item['id'],$departmentid,$divisionid,$provinceid);
				$subAllwdPercent = $subAllwdTotal > 0 && $subTotal > 0 ?  ($subAllwdTotal / $subTotal )*100 : 0;
				
				$subTotals=$subTotal-$subAllwdTotal;
				$dataList .= '<tr style="background:#FFFFCC;">';
				$dataList .= '<td>'.$main_idx.".".$sub_idx.'</td>';
				$dataList .= '<td>&nbsp;&nbsp;'.$sub_item['title'].'</td>';				
				$dataList .= '<td>'.number_format($subTotal,2).'</td>';
				$dataList .= '<td>'.number_format($subwdTotal,2).'</td>';
				$dataList .= '<td>'.number_format($subAllwdTotal,2).'</td>';
				$dataList .= '<td>'.number_format($subTotals,2).'</td>';
				$dataList .= '<td>'.number_format($subAllwdPercent,2).'</td>';
				$dataList .= '<td>&nbsp;</td>';
				$dataList .= '</tr>';
				
				
				$main_project_idx=1;
				$sql =  "SELECT DISTINCT MT_PROJECT.ID, MT_PROJECT.PID, MT_PROJECT.TITLE, MT_PROJECT.DEPARTMENTID, 
				MT_PROJECT.DIVISIONID, MT_PROJECT.WORKGROUPID, MT_PROJECT.PYEAR, MT_PROJECT.SUBACTID, 
				MT_PROJECT.TARGET, MT_PROJECT.TARGETTYPE 
				FROM MT_PROJECT 
				LEFT JOIN CNF_DIVISION ON MT_PROJECT.DIVISIONID = CNF_DIVISION.ID
				LEFT JOIN MT_BUDGET_RECORD ON MT_PROJECT.ID = MT_BUDGET_RECORD.MASTERID
				LEFT JOIN MT_PROJECT_SUBDETAIL ON MT_PROJECT.ID = MT_PROJECT_SUBDETAIL.MASTERID
				WHERE SUBACTID=".$sub_item['id']." AND MT_PROJECT.PID=0 AND MT_BUDGET_RECORD.PROVINCEID=".$provinceid;
				if($provinceid == 2 ){
					$sql.= " AND MT_PROJECT_SUBDETAIL.DIVISIONID=".$divisionid;
				}
				//echo $sql;
				$main_project_result = $this->db->getarray($sql);
				dbConvert($main_project_result);
				foreach($main_project_result as $main_project_item){
						
					$mainprojectTotal = GetProjectTotal($mtyear,$sub_item['id'],$main_project_item['id'],0,$departmentid,$divisionid,$provinceid);
					$mainprojectwdTotal = GetProjectWithdraw($mtyear,$mtmonth,$sub_item['id'],$main_project_item['id'],0,$departmentid,$divisionid,$provinceid);
					$mainprojectAllwdTotal = GetProjectWithdraw($mtyear,'',$sub_item['id'],$main_project_item['id'],0,$departmentid,$divisionid,$provinceid);
					$mainprojectAllwdPercent = $mainprojectAllwdTotal > 0 && $mainprojectTotal > 0  ? ($mainprojectAllwdTotal / $mainprojectTotal	 )*100 : 0;	
					
					$mainprojectTotals=$mainprojectTotal-$mainprojectAllwdTotal;
					
					$dataList .= '<tr>';
					$dataList .= '<td>'.$main_idx.".".$sub_idx.".".$main_project_idx.'</td>';
					$dataList .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;'.$main_project_item['title'].'</td>';				
					$dataList .= '<td>'.number_format($mainprojectTotal,2).'</td>';
					$dataList .= '<td>'.number_format($mainprojectwdTotal,2).'</td>';
					$dataList .= '<td>'.number_format($mainprojectAllwdTotal,2).'</td>';
					$dataList .= '<td>'.number_format($mainprojectTotals,2).'</td>';
					$dataList .= '<td>'.number_format($mainprojectAllwdPercent,2).'</td>';					
					$url = 'monitor_operation_withdraw/form?txtsearch='.@$_GET['txtsearch'].'&pdepartment_id='.@$_GET['pdepartment_id'].'&pdivision_id='.@$_GET['pdivision_id'].'&pprovince_id='.@$_GET['pprovince_id'].'&mtyear='.@$_GET['mtyear'].'&pproductivity_id='.@$_GET['pproductivity_id'].'&month='.@$_GET['month'];
					if(CountSubProject($main_project_item['id'])==0)
						$dataList .= '<td><input type="submit" name="button5" id="button5" value=" " title="บันทึกแบบฟอร์ม" class="btn_saveform vtip" onclick="window.location=\''.$url.'&projectid='.$main_project_item['id'].'\'" /></td>';
					else
						$dataList .= '<td>&nbsp;</td>';
					$dataList .= '</tr>';
					$main_project_idx++;
					
					$sub_project_idx=1;
					$sql =  "SELECT * FROM MT_PROJECT WHERE SUBACTID=".$sub_item['id']." AND PID=".$main_project_item['id'];
					$sub_project_result = $this->db->getarray($sql);
					dbConvert($sub_project_result);
					foreach($sub_project_result as $sub_project_item){
							
						$subprojectTotal = GetProjectTotal($mtyear,$sub_item['id'],$sub_project_item['id'],$main_project_item['id'],$departmentid,$divisionid,$provinceid);
						$subprojectwdTotal = GetProjectWithdraw($mtyear,$mtmonth,$sub_item['id'],$sub_project_item['id'],$main_project_item['id'],$departmentid,$divisionid,$provinceid);						
						$subprojectAllwdTotal = GetProjectWithdraw($mtyear,'',$sub_item['id'],$sub_project_item['id'],$main_project_item['id'],$departmentid,$divisionid,$provinceid);
						$subprojectAllwdPercent = $subprojectAllwdTotal > 0 && $subprojectTotal > 0 ? ($subprojectAllwdTotal / $subprojectTotal	 )*100 : 0;	
						
						$subprojectTotals=$subprojectTotal-$subprojectAllwdTotal;
						
						$dataList .= '<tr>';
						$dataList .= '<td>'.$main_idx.".".$sub_idx.".".$main_project_idx.".".$sub_project_idx.'</td>';
						$dataList .= '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$sub_project_item['title'].'</td>';				
						$dataList .= '<td>'.number_format($subprojectTotal,2).'</td>';
						$dataList .= '<td>'.number_format($subprojectwdTotal,2).'</td>';
						$dataList .= '<td>'.number_format($subprojectAllwdTotal,2).'</td>';
						$dataList .= '<td>'.number_format($subprojectTotals,2).'</td>';
						$dataList .= '<td>'.number_format($subprojectAllwdPercent,2).'</td>';
						$dataList .= '<td><input type="button" name="button5" id="button5" value=" " title="บันทึกแบบฟอร์ม" class="btn_saveform vtip" onclick="window.location=\''.$url.'&projectid='.$sub_project_item['id'].'\'" /></td>';
						$dataList .= '</tr>';
						$sub_project_idx++;
					}
				}
				$sub_idx++;
			}
			$main_idx++;							 
		}
		
		
		
		return $dataList;
	}
	
	function select_productivity_list($mtyear=FALSE,$departmentid=FALSE,$divisionid=FALSE)
	{
		$mtyear = @$_POST['mtyear'];
		$departmentid = @$_POST['departmentid'];
		$divisionid = @$_POST['divisionid'];
		$provinceid = @$_POST['provinceid'];
		
		$sql = "SELECT count(*) FROM MT_STRATEGY
		WHERE 
		ID IN(
		SELECT PRODUCTIVITYID FROM MT_PROJECT 
		LEFT JOIN MT_BUDGET_RECORD ON MT_PROJECT.ID = MT_BUDGET_RECORD.MASTERID
		LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID=MT_STRATEGY.ID  
		WHERE 1=1 ";
		$sql .= $mtyear > 0 ? " AND MTYEAR=".$mtyear : "";		
		
		$sql .= $provinceid > 0 ? " AND MT_BUDGET_RECORD.PROVINCEID=".$provinceid : "";
		
		if($provinceid==2)
		{
			$sql .= $divisionid > 0 ? " AND MT_BUDGET_RECORD.DIVISIONID=".$divisionid : "";			
			$sql .= $departmentid > 0 ? " AND MT_STRATEGY.DEPARTMENTID=".$departmentid : "";
		}
		$sql .=")";
		
		$nrow = $this->db->getone($sql);
		
		 $sql = "SELECT title FROM MT_STRATEGY
		WHERE 
		ID IN(
		SELECT PRODUCTIVITYID FROM MT_PROJECT 
		LEFT JOIN MT_BUDGET_RECORD ON MT_PROJECT.ID = MT_BUDGET_RECORD.MASTERID
		LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID=MT_STRATEGY.ID  WHERE 1=1 ";
		$sql .= $mtyear > 0 ? " AND MTYEAR=".$mtyear : "";		

		$sql .= $provinceid > 0 ? " AND MT_BUDGET_RECORD.PROVINCEID=".$provinceid : "";
		
		if($provinceid==2)
		{
		$sql .= $divisionid > 0 ? " AND MT_BUDGET_RECORD.DIVISIONID=".$divisionid : "";		
		$sql .= $departmentid > 0 ? " AND MT_STRATEGY.DEPARTMENTID=".$departmentid : "";
		}
		$sql .=") group by title";
				
		//echo $sql;
		//$this->db->debug = true;
		$result = $this->db->getarray($sql);
		dbConvert($result);
		
		echo '<select name="pproductivity_id" id="pproductivity_id">';
		echo '<option value="0">--เลือกผลผลิต--</optionv>';
		if($nrow > 0){
			foreach($result as $item):
				echo '<option value="'.$item['title'].'">'.$item['title'].'</option>';
			endforeach;
		}
		echo '</select>';
		
	}	
	
	
	function export(){
			
		 $strSQL = "SELECT * FROM ".$this->mt_project_withdraw->table." LIMIT 1;";
    	 $data['column'] = $this->db->getarray($strSQL);  
		 $data['result'] = $this->mt_project_withdraw->limit(0,2)->get(FALSE,TRUE);
		 $this->template->build('export',$data);
	}
}
?>