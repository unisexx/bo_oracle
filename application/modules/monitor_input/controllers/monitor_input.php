<?php
class Monitor_input extends Monitor_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('monitor_budget_plan/mt_budget_plan_model','mt_strategy');
		$this->load->model('monitor_budget_plan/mt_strategy_key_model','mt_strategy_key');
		$this->load->model('monitor_budget_plan/mt_project_model','mt_project');
		$this->load->model('monitor_budget_plan/mt_project_detail_model','mt_project_detail');
		$this->load->model('finance_budget_plan/fn_budget_plan_model','fn_strategy');	
		$this->load->model('c_department/department_model','department');
		$this->load->model('c_division/division_model','division');		
		$this->load->model('finance_budget_plan/fn_budget_type_model','fn_budget_type');
		$this->load->model('c_province/province_model','province');		
	}
	
	function index()
	{
		//$this->db->debug = true;	
		$data['mtyear'] = $this->mt_strategy->get("SELECT DISTINCT MTYEAR FROM ".$this->mt_strategy->table,TRUE);		
			
		$dataList ='';
		if(@$_GET['mode']!='' && @$_GET['mtyear']>0 && @$_GET['month']>0 && @$_GET['departmentid'] > 0)
		{									
			if($_GET['mode']=='province'){
				$condition = login_data('mt_access_all')=='on' ? " ID <>2" : " ID <> 2 AND ID=".login_data('user_province_id');
				$data['result'] = $this->province->where($condition)->get(FALSE,TRUE);		
			}			
			else{
				$data['result'] = $this->division->where("departmentid=".$_GET['departmentid'])->get(FALSE,TRUE);
			}
		}		
		$data['dataList'] = $dataList;
		$this->template->build('monitor_input_index',$data);		
	}
	function detail()
	{
		//$this->db->debug = true;
		$month_list = array('','มกราคม','กุมพาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'); 
		$data='';$head='';
		$department = $this->department->where("ID=".@$_GET['departmentid'])->get_row();			
		if(@$_GET['mode']=='province')
		{
			$provinceID = @$_GET['itemid'];			
			$province = $this->province->where("ID=".$provinceID)->get_row();			
			$head = "<h3>สอบถาม การกรอกข้อมูลแต่ละจังหวัด [".$province['title']." ".$department['title']."] เดือน".$month_list[$_GET['month']]." ปี".(@$_GET['mtyear']+543)." (รายละเอียด)</h3>";
		}
		else
		{
			$divisionID = @$_GET['itemid'];			
			$division = $this->division->where("ID=".$divisionID)->get_row();
			$head = "<h3>สอบถาม การกรอกข้อมูลแต่ละหน่วยงาน [<span style=\"color:blue\">".$division['title']." ".$department['title']."</span>] เดือน".$month_list[$_GET['month']]." ปี".(@$_GET['mtyear']+543)." (รายละเอียด)</h3>";
		}
		$data['head'] = $head;
		$data['dataList'] = $this->GetDataListDetail();
		$this->template->build('monitor_input_detail',$data);
	}
	function GetDataList($result){
		  $dataList = '';
		  $rowStyle = '';
		  $page = (isset($_GET['page']))? $_GET['page']:1;
		  $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1;
		  foreach($result as $item):	  	   		  
			  if(@$_GET['mode']=='province')
			  {
			  	$status = CheckInputStatus(@$_GET['mtyear'],@$_GET['month'],@$_GET['departmentid'],$item['id'],0);
				$inputDetail = GetInputDetail(@$_GET['mtyear'],@$_GET['month'],@$_GET['departmentid'],@$item['id'],0);				
			  }
			  else
			  {
				$status = CheckInputStatus(@$_GET['mtyear'],@$_GET['month'],@$_GET['departmentid'],0,$item['id']);
				$inputDetail = GetInputDetail(@$_GET['mtyear'],@$_GET['month'],@$_GET['departmentid'],0,$item['id']);
			  }	
			  
			  $url = "monitor_input/detail?mode=".@$_GET['mode']."&mtyear=".@$_GET['mtyear']."&month=".@$_GET['month']."&status=".@$_GET['status']."&departmentid=".@$_GET['departmentid']."&itemid=".$item['id'];
			  if(@$_GET['status']=="yes")
			  {
			  	if($status>0)
				{					   		  
					$dataList .='<tr>';
					$dataList .='<td>'.$i.'</td>';
					$dataList .='<td nowrap="nowrap">'.$item['title'].'</td>';
					$dataList .='<td>';		  	      		  
				  	$dataList .= $status > 0 ? '<img src="images/ico_input_ok.png" width="24" height="24" title="กรอกข้อมูลแล้ว" class="vtip" style="cursor:pointer;" onclick="window.location=\''.$url.'\';" />' : '<img src="images/ico_input_no.png" width="24" height="24" title="ยังไม่ได้กรอกข้อมูล" class="vtip" />';				
					$dataList .='</td>';
				    $dataList .='<td>';
					$dataList .=@$inputDetail['maxsavedate'] > 0 ? stamp_to_th_fulldate($inputDetail['maxsavedate']) : "";
					$dataList .='</td>';
					$dataList .='</tr>';
					$i++;
				}
			  }
			  else if(@$_GET['status']=="no")
			  {
			  	if($status==0)
				{					   		  
					$dataList .='<tr>';
					$dataList .='<td>'.$i.'</td>';
					$dataList .='<td nowrap="nowrap">'.$item['title'].'</td>';
					$dataList .='<td>';		  	      		  
				  	$dataList .= $status > 0 ? '<img src="images/ico_input_ok.png" width="24" height="24" title="กรอกข้อมูลแล้ว" class="vtip" style="cursor:pointer;" onclick="window.location=\''.$url.'\';" />' : '<img src="images/ico_input_no.png" width="24" height="24" title="ยังไม่ได้กรอกข้อมูล" class="vtip" />';				
					$dataList .='</td>';
				    $dataList .='<td>';
					$dataList .=@$inputDetail['maxsavedate'] > 0 ? stamp_to_th_fulldate($inputDetail['maxsavedate']) : "";
					$dataList .='</td>';
					$dataList .='</tr>';
					$i++;
				}
			  }
			  else
			  {			  						   		  
					$dataList .='<tr>';
					$dataList .='<td>'.$i.'</td>';
					$dataList .='<td nowrap="nowrap">'.$item['title'].'</td>';
					$dataList .='<td>';		  	      		  
				  	$dataList .= $status > 0 ? '<img src="images/ico_input_ok.png" width="24" height="24" title="กรอกข้อมูลแล้ว" class="vtip" style="cursor:pointer;" onclick="window.location=\''.$url.'\';" />' : '<img src="images/ico_input_no.png" width="24" height="24" title="ยังไม่ได้กรอกข้อมูล" class="vtip" />';				
					$dataList .='</td>';
				    $dataList .='<td>';
					$dataList .=@$inputDetail['maxsavedate'] > 0 ? stamp_to_th_fulldate($inputDetail['maxsavedate']) : "";
					$dataList .='</td>';
					$dataList .='</tr>';
					$i++;				
			  }	  		 
			  
		  endforeach; 		
		  return $dataList;
	}
	function GetDataListDetail()
	{
		//$this->db->debug = true;
		$provinceID = FALSE;
		$divisionID = FALSE;
		$dataList = '';
		$select = "SELECT DISTINCT PRODUCTIVITYID AS id ";
		$sql=" FROM MT_STRATEGY 
			LEFT JOIN MT_PROJECT ON MT_STRATEGY.ID = MT_PROJECT.SUBACTID
			LEFT JOIN MT_PROJECT_SUBDETAIL ON MT_PROJECT.ID = MT_PROJECT_SUBDETAIL.MASTERID 
			LEFT JOIN CNF_DIVISION ON MT_PROJECT.DIVISIONID = CNF_DIVISION.ID			
			WHERE 1=1 ";
		if(@$_GET['mode']=='province')
		{
			$provinceID = @$_GET['itemid'];
			$condition =" AND MT_PROJECT_SUBDETAIL.PROVINCEID=".@$_GET['itemid']; 
			$productivity_result = $this->mt_strategy->get($select.$sql.$condition,TRUE);			
		}
		else
		{
			$divisionID = @$_GET['itemid'];			
			$condition = " MT_STRATEGY.DEPARTMENTID=".@$_GET['departmentid']." AND MT_PROJECT_SUBDETAIL.DIVISIONID=".@$_GET['itemid'];			
			$productivity_result = $this->mt_strategy->get($select.$sql.$condition,TRUE);			
		}
		
		foreach($productivity_result as $product_item)
		{
			$mainidx = 1;
			$subactidx = 1;
			$product = GetStrategyDetail($product_item['id']);			
			$dataList .='<tr class="topic">';
		    $dataList .='<td colspan="6"><strong>'.$product['title'].'</strong></td>';
			$dataList .='</tr>';
			
			$select = "SELECT DISTINCT MAINACTID AS id ";
			$opt =' AND PRODUCTIVITYID='.$product_item['id'];
			$mainact_result = $this->mt_strategy->get($select.$sql.$condition.$opt,TRUE);
			foreach($mainact_result as $mainact_item)
			{
			$mainact = GetStrategyDetail($mainact_item['id']);
			$dataList .='<tr class="odd">';
			$dataList .='<td>'.$mainidx.'</td>';
			$dataList .='<td nowrap="nowrap">'.@$mainact['title'].'</td>';
			$dataList .='<td>&nbsp;</td>';
			$dataList .='<td>&nbsp;</td>';
			$dataList .='<td>&nbsp;</td>';
			$dataList .='<td>&nbsp;</td>';
			$dataList .='</tr>';
							
				$select = "SELECT DISTINCT SUBACTID AS id ";
				$opt =' AND PRODUCTIVITYID='.$product_item['id'].' AND MAINACTID='.$mainact_item['id'];;
				$subact_result = $this->mt_strategy->get($select.$sql.$condition.$opt,TRUE);			
				foreach($subact_result as $subact_item)
				{
				$subact = GetStrategyDetail($subact_item['id']);
				$status = CheckInputStatus(@$_GET['mtyear'],@$_GET['month'],@$_GET['departmentid'],$provinceID,$divisionID,$subact['id']);
				$inputDetail = GetInputDetail(@$_GET['mtyear'],@$_GET['month'],@$_GET['departmentid'],$provinceID,$divisionID,$subact['id']);
				$contactno = @$inputDetail['contactno']!=''?  '('.@$inputDetail['contactno'].')' : '';
				$icon = $status > 0 ? '<img src="images/ico_input_ok.png" width="24" height="24" title="กรอกข้อมูลแล้ว" class="vtip" style="" />' : '<img src="images/ico_input_no.png" width="24" height="24" title="ยังไม่ได้กรอกข้อมูล" class="vtip" />';
				$dataList .='<tr>';
				$dataList .='<td>'.$mainidx.'.'.$subactidx.'</td>';
				$dataList .='<td nowrap="nowrap">'.$subact['title'].'</td>';
				$dataList .='<td>'.$icon.'</td>';
				$dataList .='<td>'.stamp_to_th_fulldate(@$inputDetail['maxsavedate']).'</td>';
				$dataList .='<td>'.@$inputDetail['reporter'].$contactno.'</td>';				
				$dataList .='<td>'.@$inputDetail['suggestion'].'</td>';
				$dataList .='</tr>';
				$subactidx++;
				}
				$mainidx++;
			}
		}
		return $dataList;		  
	} 
}