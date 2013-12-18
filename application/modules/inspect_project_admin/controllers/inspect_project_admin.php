<?php
class Inspect_project_admin extends Inspect_Controller
{
	public $modules_name = "inspect_project_admin";
	public function __construct()
	{
		parent::__construct();
		$this->load->model('inspect_project_management/insp_project_model','insp_project');
		$this->load->model('inspect_project_management/insp_project_detail_model','insp_project_detail');
		$this->load->model('monitor_budget_plan/mt_budget_plan_model','strategy');
		$this->load->model('monitor_budget_plan/mt_project_model','mt_project');
		
		$this->load->model('inspect_save/insp_progress_model','progress');
		$this->load->model('inspect_save/insp_project_risk_save_model','insp_project_save');
		$this->load->model('inspect_project_management/insp_project_main_activity_model','mainactivity');
		$this->load->model('inspect_save/insp_project_sub_activity_model','sub_activity');
		$this->load->model('inspect_save/insp_project_sub_activity_file_model','sub_activity_file');
	}
	function index()
	{
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['byear'] = $this->strategy->get("SELECT DISTINCT MTYEAR byear FROM MT_STRATEGY",TRUE);
		$condition = " WHERE 1=1 ";
		$condition.= @$_GET['budgetyear']>0 ? " AND BUDGETYEAR =".$_GET['budgetyear'] : "";
		$condition.= @$_GET['title']!="" ? " AND IPJ.TITLE LIKE '%".$_GET['title']."%' " : "";
		$sql = " SELECT IPJ.*,cd.TITLE divisiontitle,cdp.TITLE departmenttitle,MPJ.TITLE projecttitle,PYEAR projectyear FROM INSP_PROJECT IPJ";
		$sql.= " LEFT JOIN mt_project MPJ ON IPJ.MTPROJECTID=MPJ.ID ";
		$sql.= " LEFT JOIN cnf_division cd ON MPJ.DIVISIONID=cd.ID ";
		$sql.= " LEFT JOIN cnf_department cdp ON cd.DEPARTMENTID = cdp.ID ";
		$sql.= $condition;
		$sql.= " ORDER BY ID DESC ,IPJ.TITLE ";		
		$data['result'] = $this->insp_project->get($sql);
		$data['pagination']=$this->insp_project->pagination();		
		$this->template->build('inspect_project_admin_index',$data);
	}
	function form($id=FALSE)
	{
		//$this->db->debug=true;				
		if($id > 0)
		{
			$data['url_parameter'] = GetCurrentUrlGetParameter();	
			$data['id'] = $id;
			$condition = " WHERE IPJ.ID=".$id;
			$sql = " SELECT IPJ.*,cd.TITLE divisiontitle,cdp.TITLE departmenttitle,MPJ.TITLE projecttitle,PYEAR projectyear FROM INSP_PROJECT IPJ";
			$sql.= " LEFT JOIN mt_project MPJ ON IPJ.MTPROJECTID=MPJ.ID ";
			$sql.= " LEFT JOIN cnf_division cd ON MPJ.DIVISIONID=cd.ID ";
			$sql.= " LEFT JOIN cnf_department cdp ON cd.DEPARTMENTID = cdp.ID ";
			$sql.= $condition;
			$project = $this->db->getrow($sql);
			dbConvert($project);
			$data['project']=$project;
			$data['detail']=$this->insp_project_detail->where("PID=".$id)->get(FALSE,TRUE);
			
			$action_type = "VIEW";
			$action =" ดูบันทึกโครงการ (KPN) :โครงการ ".$data['project']['title'];
			save_logfile($action_type,$action,$this->modules_name);
		}		
		$this->template->build('inspect_project_admin_form',$data);
	}
	function select_project_from_division()
	{
		if($_POST['budgetyear'] > 0 && $_POST['divisionid']>0)
		{
			$result = $this->mt_project->where("PYEAR=".$_POST['budgetyear']." AND DIVISIONID=".$_POST['divisionid']." AND PID=0")->get(FALSE,TRUE);
			$projectlist ='<select id="projectid" name="projectid" >';
			$projectlist.='<option value="">--เลือกโครงการ--</option>';
			foreach($result as $item):
			$projectlist.='<option value="'.$item['id'].'">'.$item['title']."</option>";
			endforeach;
			$projectlist.='</select>';
			echo $projectlist;
		}
	}
	
	function save($id=FALSE)
	{
		if($_POST){
			$url_parameter = GetCurrentUrlGetParameter();
			$this->insp_project_detail->delete('pid',$id);
			//$this->db->debug = true;
			if(isset($_POST['subq1'])){
				foreach($_POST['subq1'] as $key=>$item){
					if($_POST['subq1'][$key]){
						$this->insp_project_detail->save(array(
							//'id'=>$_POST['hdID'][$key],
							'pid'=>$id,
							'subq1'=>$_POST['subq1'][$key],
							'subq2'=>$_POST['subq2'][$key],
							'subq3'=>$_POST['subq3'][$key],
							'subq4'=>$_POST['subq4'][$key]																
						));
					}
				}	
			}
			
			if($id > 0){
			   	$action_type = "EDIT";
				$action =" แก้ไขบันทึกโครงการ (KPN) :โครงการ ".$_POST['project_title'];
			}else{
			   	$action_type = "ADD";
				$action =" เพิ่มบันทึกโครงการ (KPN) :โครงการ ".$_POST['project_title'];
			}
			save_logfile($action_type,$action,$this->modules_name);
			
			set_notify('success', lang('save_data_complete'));
		}					
		redirect('inspect_project_admin/index'.$url_parameter);
	}
	
	function delete($id=FALSE)
	{
		if($id){
			$url_parameter = GetCurrentUrlGetParameter();
			
			$project_title = $this->insp_project->get_one('title',$id);
			
			$this->insp_project->delete($id);
			$this->progress->delete('projectid',$id);
			$this->insp_project_save->delete('projectid',$id);
			$this->mainactivity->delete('projectid',$id);
			$this->insp_project_detail->delete('pid',$id);
			$this->sub_activity->delete('projectid',$id);
			$this->sub_activity_file->delete('projectid',$id);
			
			$action_type="DELETE";
			$action =" ลบบันทึกโครงการ (KPN) :โครงการ ".$project_title;
			save_logfile($action_type,$action,$this->modules_name);
			
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('inspect_project_admin/index'.$url_parameter);
	}
}
?>