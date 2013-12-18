<?php		
class monitor_suggestion_report extends Monitor_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('monitor_operation_withdraw/mt_project_withdraw_model','mt_project_withdraw');
		$this->load->model('monitor_operation_withdraw/mt_project_withdraw_detail_model','mt_project_withdraw_detail');
		$this->load->model('monitor_operation_withdraw/mt_project_withdraw_history_model','mt_project_withdraw_history');
		$this->load->model('monitor_budget_plan/mt_budget_plan_model','mt_strategy');
		$this->load->model('monitor_budget_plan/mt_strategy_key_model','mt_strategy_key');
		$this->load->model('monitor_budget_plan/mt_project_model','mt_project');
		$this->load->model('monitor_budget_plan/mt_project_detail_model','mt_project_detail');		
		$this->load->model('c_department/department_model','department');
		$this->load->model('c_division/division_model','division');
		$this->load->model('c_province/province_model','province');				
	}
	
	function index()
	{
		//$this->db->debug= true;
		$data='';
		$data['month_value'] = array(10,11,12,1,2,3,4,5,6,7,8,9);
		$data['url_parameter'] = GetCurrentUrlGetParameter();	
		$data['start_date'] = @$_GET['start_date'];
		$data['end_date'] = @$_GET['end_date'];
		$data['provinceid'] = @$_GET['province'];		
		$data['month'] = array('ตุลาคม','พฤศจิกายน','ธันวาคม','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน');
		$data['month_dec'] = array('ต.ค.','พ.ย.','ธ.ค.','ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.');
		$data['month_idx'] = array('10','11','12','1','2','3','4','5','6','7','8','9');		
		$data['department'] = @$_GET['pdepartment_id'] != '' ? $this->department->get_row($_GET['pdepartment_id']) : '';
		$data['province'] = @$_GET['pprovince_id'] != '' ? $this->province->where("title <> 'กรุงเทพมหานคร' and id=".$_GET['pprovince_id'])->get(FALSE,TRUE) : $this->province->where("title <> 'กรุงเทพมหานคร'")->get(FALSE,TRUE);
		$data['province_data'] = @$_GET['pprovince_id'] != '' ? $this->province->get_row($_GET['pprovince_id']) : "";
		$data['select_department'] = $this->department->get_row(@$_GET['pdepartment_id']);

		$data['start_month_idx'] = @$_GET['start_month_idx'];
		$data['end_month_idx'] = @$_GET['end_month_idx'];
		$select_productivity = @$_GET['pproductivity_id'];
		$mtyear = @$_GET['bg_year'];
		$departmentid = @$_GET['pdepartment_id'];
		$divisionid = @$_GET['pdivision_id'];		
		$provinceid = @$_GET['pprovince_id'];
		
		if(@$_GET['bg_year'])$data['data_list'] = $this->get_datalist();
		
		$this->template->build('index',$data);		
	}

function print_page()
	{
		//$this->db->debug= true;
		$data='';
		$data['month_value'] = array(10,11,12,1,2,3,4,5,6,7,8,9);
		$data['url_parameter'] = GetCurrentUrlGetParameter();	
		$data['start_date'] = @$_GET['start_date'];
		$data['end_date'] = @$_GET['end_date'];
		$data['provinceid'] = @$_GET['province'];		
		$data['month'] = array('ตุลาคม','พฤศจิกายน','ธันวาคม','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน');
		$data['month_dec'] = array('ต.ค.','พ.ย.','ธ.ค.','ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.');
		$data['month_idx'] = array('10','11','12','1','2','3','4','5','6','7','8','9');		
		$data['department'] = @$_GET['pdepartment_id'] != '' ? $this->department->get_row($_GET['pdepartment_id']) : '';
		$data['province'] = @$_GET['pprovince_id'] != '' ? $this->province->where("title <> 'กรุงเทพมหานคร' and id=".$_GET['pprovince_id'])->get(FALSE,TRUE) : $this->province->where("title <> 'กรุงเทพมหานคร'")->get(FALSE,TRUE);
		$data['province_data'] = @$_GET['pprovince_id'] != '' ? $this->province->get_row($_GET['pprovince_id']) : "";
		$data['select_department'] = $this->department->get_row(@$_GET['pdepartment_id']);

		$data['start_month_idx'] = @$_GET['start_month_idx'];
		$data['end_month_idx'] = @$_GET['end_month_idx'];
		$select_productivity = @$_GET['pproductivity_id'];
		$mtyear = @$_GET['bg_year'];
		$departmentid = @$_GET['pdepartment_id'];
		$divisionid = @$_GET['pdivision_id'];		
		$provinceid = @$_GET['pprovince_id'];
		
		$data['data_list'] = $this->get_datalist();
		$this->load->view('print',$data);		
	}

function export()
	{
		//$this->db->debug= true;
		$data='';
		$data['month_value'] = array(10,11,12,1,2,3,4,5,6,7,8,9);
		$data['url_parameter'] = GetCurrentUrlGetParameter();	
		$data['start_date'] = @$_GET['start_date'];
		$data['end_date'] = @$_GET['end_date'];
		$data['provinceid'] = @$_GET['province'];		
		$data['month'] = array('ตุลาคม','พฤศจิกายน','ธันวาคม','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน');
		$data['month_dec'] = array('ต.ค.','พ.ย.','ธ.ค.','ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.');
		$data['month_idx'] = array('10','11','12','1','2','3','4','5','6','7','8','9');		
		$data['department'] = @$_GET['pdepartment_id'] != '' ? $this->department->get_row($_GET['pdepartment_id']) : '';
		$data['province'] = @$_GET['pprovince_id'] != '' ? $this->province->where("title <> 'กรุงเทพมหานคร' and id=".$_GET['pprovince_id'])->get(FALSE,TRUE) : $this->province->where("title <> 'กรุงเทพมหานคร'")->get(FALSE,TRUE);
		$data['province_data'] = @$_GET['pprovince_id'] != '' ? $this->province->get_row($_GET['pprovince_id']) : "";
		$data['select_department'] = $this->department->get_row(@$_GET['pdepartment_id']);

		$data['start_month_idx'] = @$_GET['start_month_idx'];
		$data['end_month_idx'] = @$_GET['end_month_idx'];
		$select_productivity = @$_GET['pproductivity_id'];
		$mtyear = @$_GET['bg_year'];
		$departmentid = @$_GET['pdepartment_id'];
		$divisionid = @$_GET['pdivision_id'];		
		$provinceid = @$_GET['pprovince_id'];
		
		$data['data_list'] = $this->get_datalist();
		$filename= "export_report_".date("Y-m-d_H_i_s").".xls";
		header("Content-Disposition: attachment; filename=".$filename);			
		$this->load->view('print',$data);		
	}
	function select_productivity_list($mtyear=FALSE,$departmentid=FALSE,$divisionid=FALSE,$provinceid=FALSE)
	{
		if($mtyear==FALSE){
		$mtyear = @$_POST['mtyear'];
		$departmentid = @$_POST['departmentid'];
		$divisionid = @$_POST['divisionid'];
		$provinceid = @$_POST['provinceid'];
		}
		$sql = "SELECT count(*) FROM MT_STRATEGY
		WHERE 
		ID IN(
		SELECT PRODUCTIVITYID FROM MT_PROJECT 
		LEFT JOIN MT_BUDGET_RECORD ON MT_PROJECT.ID = MT_BUDGET_RECORD.MASTERID
		LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID=MT_STRATEGY.ID  
		WHERE 1=1 ";
		$sql .= $mtyear > 0 ? " AND MTYEAR=".$mtyear : "";		
		
		$sql .= $provinceid > 0 ? " AND MT_BUDGET_RECORD.PROVINCEID=".$provinceid : "";
		$sql .= $departmentid > 0 ? " AND MT_STRATEGY.DEPARTMENTID=".$departmentid : "";
		
		if($provinceid==2)
		{
			$sql .= $divisionid > 0 ? " AND MT_BUDGET_RECORD.DIVISIONID=".$divisionid : "";			
			
		}
		$sql .=")";
		
		$nrow = $this->db->getone($sql);
		
		 $sql = "SELECT * FROM MT_STRATEGY
		WHERE 
		ID IN(
		SELECT PRODUCTIVITYID FROM MT_PROJECT 
		LEFT JOIN MT_BUDGET_RECORD ON MT_PROJECT.ID = MT_BUDGET_RECORD.MASTERID
		LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID=MT_STRATEGY.ID  WHERE 1=1 ";
		$sql .= $mtyear > 0 ? " AND MTYEAR=".$mtyear : "";		

		$sql .= $provinceid > 0 ? " AND MT_BUDGET_RECORD.PROVINCEID=".$provinceid : "";
		$sql .= $departmentid > 0 ? " AND MT_STRATEGY.DEPARTMENTID=".$departmentid : "";
		
		if($provinceid==2)
		{
		$sql .= $divisionid > 0 ? " AND MT_BUDGET_RECORD.DIVISIONID=".$divisionid : "";				
		}
		$sql .=") ORDER BY TITLE ";
				
		//echo $sql;
		//$this->db->debug = true;
		$result = $this->db->getarray($sql);
		dbConvert($result);
		
		return $result;

	}
	function mt_load_activity($pid){
		$result = $this->db->getarray("SELECT * FROM MT_STRATEGY WHERE PID=".$pid);
		dbConvert($result);
		return $result;
	}

	
	function get_datalist(){
		$p_tab = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		$bg_year =@$_GET['bg_year'];
		$departmentid = @$_GET['pdepartment_id'];
		$divisionid = @$_GET['pdivision_id'];		
		$provinceid = @$_GET['pprovince_id'];
		$start_month_idx = @$_GET['start_month_idx'];
		$end_month_idx = @$_GET['end_month_idx'];
		$month_value = array(10,11,12,1,2,3,4,5,6,7,8,9);
		$month = array('ตุลาคม','พฤศจิกายน','ธันวาคม','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน');
		$month_dec = array('ต.ค.','พ.ย.','ธ.ค.','ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.');
		$month_idx = array('10','11','12','1','2','3','4','5','6','7','8','9');
		$url_parameter = GetCurrentUrlGetParameter();
		$message='<table class="tblist2" id="tblist2">	
			<tr rowspan="2">
				<th style="text-align:center;border:1px solid #CCC;" >ผลผลิต/กิจกรรม</th>
				<th style="text-align:center;border:1px solid #CCC;" >ปัญหาอุปสรรคและข้อเสนอแนะ '.$month_dec[$start_month_idx].' - '.$month_dec[$end_month_idx].'</th>						
			</tr>
			';
			$productivity = $this->select_productivity_list($bg_year,$departmentid,$divisionid,$provinceid);
			foreach($productivity as $pitem):
				$mindex=0;
			$message.='<tr style="background:#FFF3FC;">
						<td colspan="2" style="text-align:left;border:1px solid #CCC;">'.$pitem['title'].'</td>
					   </tr>';
				$mainact = $this->mt_load_activity($pitem['id']);
				foreach($mainact as $mitem):
								$mindex++;
								$sindex=0;											
								$message.='<tr style="background:#F6FFD3;">
									<td style="text-align:left;border:1px solid #CCC;">'.$mindex.'. '.$mitem['title'].'</td>
									<td style="text-align:right;border:1px solid #CCC;"></td>									
								</tr>';
					$subact = $this->mt_load_activity($mitem['id']);
					foreach($subact as $sitem):						
						$sindex++;						
						$message.='<tr style="background:#EAF9FF;">
							<td style="text-align:left;border:1px solid #CCC;">'.$p_tab.$mindex.'.'.$sindex.'. '.$sitem['title'].'</td>
							<td style="text-align:left;border:1px solid #CCC;"></td>	
						</tr>';
						$pindex = 0;						
						$project = $this->mt_project->where('SUBACTID='.$sitem['id'])->get(FALSE,TRUE);						
						foreach($project as $pitem):
						$pindex++;	
						$suggestion = '<ul>';					
						
						for($m = $start_month_idx;$m<=$end_month_idx;$m++)
						  {							  							  								
							$sql = "SELECT SUGGESTION FROM MT_PROJECT_WITHDRAW WHERE PROJECTID=".$pitem['id']." AND WYEAR=".$bg_year." AND WMONTH=".$month_value[$m];
							$sug_value = iconv("TIS-620","UTF-8",$this->db->getone($sql));
							if($sug_value!='')
								$suggestion .= '<li>เดือน'.$month[$m].' '.$sug_value.'</li>';										
						  }
						
						$suggestion.='</ul>';
						$message.='<tr>
							<td style="text-align:left;border:1px solid #CCC;">'.$p_tab.$p_tab.$mindex.'.'.$sindex.'.'.$pindex.' '.$pitem['title'].'</td>
							<td style="text-align:left;border:1px solid #CCC;">'.$suggestion.'</td>							
						</tr>';
						endforeach; 	//endloop project					
					endforeach;//endloop subact
				endforeach;//endloop mainact
			endforeach;//endloop productivity			
		//</table>	
		return $message;
	} 
		
}