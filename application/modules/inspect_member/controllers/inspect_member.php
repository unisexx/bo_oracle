<?php
class Inspect_member extends Inspect_Controller
{
	public $modules_name = "inspect_member";
	public function __construct()
	{
		parent::__construct();
		$this->load->model('insp_member_join_index_list_model','memberlist');
		$this->load->model('inspect_project_management/insp_project_model','insp_project');
		$this->load->model('monitor_budget_plan/mt_budget_plan_model','strategy');			
		$this->load->model('c_province/province_model','province');
		$this->load->model('c_province_area/province_area_model','province_area');
		$this->load->model('inspect_risk_subject/insp_risk_subject_model','risk_subject');
		$this->load->model('inspect_project_management/insp_project_main_activity_model','main_activity');
		$this->load->model('inspect_save/insp_progress_model','progress');
		$this->load->model('inspect_save/insp_project_sub_activity_model','sub_activity');
		$this->load->model('inspect_save/insp_project_risk_save_model','insp_project_save');
		$this->load->model('inspect_level/inspect_level_model','level');
		$this->load->model('c_user/user_model','user');
	}
	
	function index()
	{
		$condition = " 1=1 ";
		$condition .= @$_GET['areaid'] > 0 ? " and w_province_area.id = ".$_GET['areaid']:"";
		$condition .= @$_GET['provinceid'] > 0 ? " and cnf_workgroup.wprovinceid = ".$_GET['provinceid']:"";
		$condition .= @$_GET['createuser'] > 0 ? " and createuser = ".$_GET['createuser']:"";
		$condition .= @$_GET['usertype'] > 0 ? " and usertype = ".$_GET['usertype']:"";
		
		$condition2 = " 1=1 ";
		$condition2 .= @$_GET['budgetyear'] > 0 ? " and budgetyear = ".$_GET['budgetyear']:"";
		$condition2 .= @$_GET['projectid'] > 0 ? " and projectid = ".$_GET['projectid']:"";
		
		$data['members'] = $this->memberlist->having($condition)->order_by('name','asc')->get();
		$sql = "SELECT users.id id,USERS.name name,users.workgroupid,CNF_WORKGROUP.title workgroup,users.divisionid,cnf_division.title division_name,user_type_title.title usertype,
case 
when users.workgroupid > 0 then cnf_workgroup.wprovinceid 
when users.divisionid > 0 then	cnf_division.provinceid 
end as provinceid,
case 
when users.workgroupid > 0 then w_province.title
when users.divisionid > 0 then	d_province.title
end as province,
case 
when users.workgroupid > 0 then w_province_area.title
when users.divisionid > 0 then	d_province_area.title
end as area
FROM USERS
LEFT JOIN CNF_WORKGROUP ON USERS.WORKGROUPID=CNF_WORKGROUP.ID
LEFT JOIN CNF_DIVISION ON USERS.DIVISIONID=CNF_DIVISION.ID
left join user_type_title on users.usertype = user_type_title.id
left join cnf_province w_province on cnf_workgroup.wprovinceid = w_province.id
left join cnf_province_area w_province_area on w_province.area = w_province_area.id
left join cnf_province d_province on cnf_division.provinceid = d_province.id
left join cnf_province_area d_province_area on d_province.area = d_province_area.id
where
(
USERS.id in (SELECT createuser from insp_project_risk_save where ".$condition2.")
or
USERS.id in (SELECT approveuser from insp_project_risk_save where ".$condition2.")
) and ".$condition;

		$data['users'] = $this->user->get($sql);
		$data['pagination'] = $this->user->pagination();
		$this->template->build('inspect_member_index',$data);
	}
	
	function form(){
		$condition = " WHERE  1=1 ";
		$data['budgetyear'] = @$_GET['budgetyear'];
		$data['projectid'] = @$_GET['projectid'];
		$condition = $data['budgetyear'] > 0 ? " AND PYEAR=".$data['budgetyear'] : "";
		$sql = " SELECT INP.ID,INP.TITLE,MP.TITLE projecttitle FROM insp_project INP LEFT JOIN MT_PROJECT MP ON INP.MTPROJECTID=MP.ID WHERE 1=1 ".$condition;
		$data['projectlist'] = $this->insp_project->get($sql,TRUE);			
		$data['byear'] = $this->strategy->get("SELECT DISTINCT MTYEAR byear FROM MT_STRATEGY",TRUE);
		$data['provincelist'] = $this->province->get(FALSE,TRUE);
		$data['provincearealist'] = $this->province_area->get(FALSE,TRUE);

		if(@$_GET['budgetyear'] > 0 && @$_GET['projectid'] > 0 && @$_GET['provincearea'] > 0 )
		{
			$sql = " SELECT INSP_ROUND.MT_YEAR,INSP_ROUND_DETAIL.*,INSP_ROUND_DETAIL.ID ROUNDNO FROM INSP_ROUND LEFT JOIN INSP_ROUND_DETAIL ON INSP_ROUND.ID = INSP_ROUND_DETAIL.ROUND_ID WHERE MT_YEAR=".@$_GET['budgetyear'];
			$roundresult = $this->db->getarray($sql);
			dbConvert($roundresult);
			$data['roundresult'] = $roundresult; 
			$sql = " SELECT INP.*,MP.TITLE projecttitle FROM insp_project INP LEFT JOIN MT_PROJECT MP ON INP.MTPROJECTID=MP.ID WHERE INP.ID=".$_GET['projectid'];
			$project =  $this->db->getrow($sql,TRUE);
			dbConvert($project);
			$data['project'] = $project;
			$data['keyRiskDataList'] = $this->fn_key_risk_data($project,1,TRUE);
			$data['politicalRiskDataList'] = $this->fn_key_risk_data($project,2,FALSE);
			$data['negotiationRiskDataList'] = $this->fn_key_risk_data($project,3,FALSE);
			$data['otherRiskDataList'] = $this->fn_key_risk_data($project,4,FALSE); 
			
			$data['mainactivity'] = $this->main_activity->where("projectid = ".$_GET['projectid'])->get();
			
			$sql2 = "select risk.approvedate,risk.createdate,user.name createuser,apuser.name approveuser,area.title area,province.title province from insp_project_risk_save risk
left join users user on risk.createuser = user.id
left join users apuser on risk.approveuser = apuser.id
left join cnf_province_area area on risk.provinceareaid = area.id
left join cnf_province province on risk.provinceid = province.id
where budgetyear = ".$_GET['budgetyear']." and projectid = ".$_GET['projectid']." and provinceareaid = ".$_GET['provincearea']." and provinceid = ".$_GET['provinceid']."
group by risk.approvedate,risk.createdate,user.name,apuser.name,area.title,province.title";
			$data['riskData'] = $this->db->getrow($sql2);
			dbConvert($data['riskData']);
			
			$sql = "SELECT distinct roundno,approvedate from INSP_PROJECT_RISK_SAVE where budgetyear = ".$_GET['budgetyear']." and projectid = ".$_GET['projectid']." and provinceareaid = ".$_GET['provincearea']." and provinceid = ".$_GET['provinceid']."";
			$data['approve_date'] = $this->insp_project_save->get($sql);
		}
		
		$action_type = "VIEW";
		$action =" ดูผู้ดูแล ผู้ตรวจราชการ และสมาชิก :โครงการ ".$project['projecttitle']." (จังหวัด ".$data['riskData']['province'].")";
		save_logfile($action_type,$action,$this->modules_name);
			
		$this->template->build('inspect_member_form',$data);
	}
	
	function fn_key_risk_data($project=FALSE,$pRiskType=FALSE,$showObjective=FALSE)
	{	
		$dataList ='';
		$objective = $showObjective==FALSE ? '' : $project['objective'];
		
		//--- หาจำนวนรอบ ---
		$sql = "select distinct max(roundno) as m_roundno , status from insp_project_risk_save where budgetyear = ".$_GET['budgetyear']." and projectid = ".$_GET['projectid']." and provinceareaid = ".$_GET['provincearea']." and provinceid = ".$_GET['provinceid']." group by status";
		$roundChk =$this->db->GetRow($sql);
		dbConvert($roundChk);

		$status_chk = @$roundChk['status'];

		switch ($status_chk) {
		case "บันทึกข้อมูล":
		case "ระหว่างการตรวจสอบ":
		case "ไม่ผ่านการตรวจสอบ":
		    @$roundChk = $roundChk['m_roundno'];
		    break;
		case "ผ่านการตรวจสอบแล้ว":
		    @$roundChk = $roundChk['m_roundno']+1;
		    break;
		default:
       		@$roundChk = 1;
		}
		
		$sql = " SELECT INSP_ROUND.MT_YEAR,INSP_ROUND_DETAIL.round_name,INSP_ROUND_DETAIL.ID ROUNDNO FROM INSP_ROUND LEFT JOIN INSP_ROUND_DETAIL ON INSP_ROUND.ID = INSP_ROUND_DETAIL.ROUND_ID WHERE MT_YEAR=".@$_GET['budgetyear']." and insp_round_detail.id <= ".$roundChk;
		$roundresult = $this->db->getarray($sql);
		dbConvert($roundresult);
		
		$result = $this->risk_subject->where('risktype='.$pRiskType)->get(FALSE,TRUE);
		
		foreach($result as $keyRiskSubject):
		$dataList.= '<tr>';
		$dataList.= '<td>'.$objective.'</td>';
		$objective = '';
		$dataList.= '<td>'.$keyRiskSubject['title'];
				
				//--- วนตามจำนวนรอบที่หาได้ ---
				foreach($roundresult as $round):
				$condition = $_GET['provinceid']!=''?  " AND PROVINCEID=".$_GET['provinceid'] :" AND PROVINCEAREAID=".$_GET['provincearea'] ;				
				$sql="SELECT * FROM INSP_PROJECT_RISK_SAVE WHERE BUDGETYEAR=".$_GET['budgetyear']." AND PROJECTID=".$_GET['projectid'].$condition;
				$sql.=" AND SUBJECTID=".$keyRiskSubject['id']." AND ROUNDNO=".$round['roundno'];
				$data = $this->db->getrow($sql);
				dbConvert($data);
				
				switch (@$data['status']) {
				case "บันทึกข้อมูล":
				case "ไม่ผ่านการตรวจสอบ":
					@$disabled = "";
				    break;
				case "ระหว่างการตรวจสอบ":
				case "ผ่านการตรวจสอบแล้ว":
					@$disabled = "disabled";
				    break;
				default:
					@$disabled = "";
				}
				
					  $dataList.='<fieldset class="fleft">';
					  $dataList.='<legend>';
					  $dataList.=$round['round_name'].'</legend>';
					  $dataList.='<span>ระดับความเสี่ยง : </span> <br />';
					  
					  $dataList.='โอกาส';
					  $dataList.=' '.@$data['chancelevel'].' ';
					  
					  $dataList.='ผลกระทบ';
					  $dataList.=' '.@$data['effectlevel'].' ';
					  
					  $dataList.='<div style=margin-top:10px;><span>เนื่องจาก :</span></div>';
					  $dataList.=@$data['remark'];
					  $dataList.='</fieldset>';
				endforeach;
				
		$dataList.='</td>';
		
		$dataList.= '<td>'.$keyRiskSubject['title'];
		$idx=0;
						foreach($roundresult as $round):
						$idx++;
							
						$condition = $_GET['provinceid']!=''?  " AND PROVINCEID=".$_GET['provinceid'] :" AND PROVINCEAREAID=".$_GET['provincearea'] ;				
						$sql="SELECT * FROM INSP_PROJECT_RISK_SAVE WHERE BUDGETYEAR=".$_GET['budgetyear']." AND PROJECTID=".$_GET['projectid'].$condition;
						$sql.=" AND SUBJECTID=".$keyRiskSubject['id']." AND ROUNDNO=".$round['roundno'];
						$data = $this->db->getrow($sql);
						dbConvert($data);				
						
						switch (@$data['status']) {
						case "บันทึกข้อมูล":
						case "ไม่ผ่านการตรวจสอบ":
							@$disabled = "";
						    break;
						case "ระหว่างการตรวจสอบ":
						case "ผ่านการตรวจสอบแล้ว":
							@$disabled = "disabled";
						    break;
						default:
							@$disabled = "";
						}
						
						$dataList.='<fieldset class="fright">';
						$dataList.='<legend>รอบที่ '.$idx.'</legend>';
						
						$dataList.=@$data['cremark'];
						$dataList.='</fieldset>';
						endforeach;
		$dataList.='</td>';
		$dataList.='</tr>';
		endforeach;		
		return $dataList;
	}

	function delete_projectround(){
		$roundno = $_POST['roundno'];
		$projectid = $_POST['projectid'];
		$budgetyear = $_POST['budgetyear'];
		$provinceid = $_POST['provinceid'];
		$createuser = $_POST['createuser'];
		$this->db->debug = true;
		$this->insp_project_save->where("roundno = $roundno and projectid = $projectid and budgetyear = $budgetyear and provinceid = $provinceid and createuser = $createuser")->delete();
	}
}
?>