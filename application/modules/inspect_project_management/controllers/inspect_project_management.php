<?php
class Inspect_project_management extends Inspect_Controller
{
	public $modules_name = "inspect_project_management";
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('insp_project_model','insp_project');
		$this->load->model('insp_custom_project_model','insp_custom_project');
		$this->load->model('insp_custom_project2_model','insp_custom_project2');
		$this->load->model('monitor_budget_plan/mt_budget_plan_model','strategy');
		$this->load->model('monitor_budget_plan/mt_project_model','mt_project');
		$this->load->model('insp_project_main_activity_model','mainactivity');
		$this->load->model('insp_project_detail_model','project_detail');
		$this->load->model('inspect_save/insp_progress_model','progress');
		$this->load->model('inspect_save/insp_project_risk_save_model','insp_project_save');
		$this->load->model('inspect_save/insp_project_sub_activity_model','sub_activity');
		$this->load->model('inspect_save/insp_project_sub_activity_file_model','sub_activity_file');
		$this->load->model('c_province/province_model','province');
		$this->load->model('c_division/division_model','division');
		$this->load->model('insp_project_record_model','insp_project_record');
	}
	function index()
	{
		//$this->db->debug = true;
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['byear'] = $this->strategy->get("SELECT DISTINCT MTYEAR byear FROM MT_STRATEGY",TRUE);
		$condition = "  1=1 ";		
		$condition.= @$_GET['budgetyear']>0 ? " AND BUDGETYEAR =".$_GET['budgetyear'] : "";
		$condition.= @$_GET['title']!="" ? " AND TITLE LIKE '%".$_GET['title']."%' " : "";
		$condition.= @$_GET['provinceid']>0 ? " AND provinceid =".$_GET['provinceid'] : "";
		$data['result'] = $this->insp_custom_project2->where($condition)->get();
		$data['pagination']=$this->insp_custom_project2->pagination();
		$this->template->build('inspect_project_management_index',$data);
	}
	function form($id=FALSE)
	{
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		if($id > 0)
		{
			$data['id'] = $id;
			$condition = " WHERE IPJ.ID=".$id;
			$sql = " SELECT IPJ.*,PYEAR projectyear FROM INSP_PROJECT IPJ";
			$sql.= " LEFT JOIN mt_project MPJ ON IPJ.MTPROJECTID=MPJ.ID ";
			$sql.= " LEFT JOIN cnf_division cd ON MPJ.DIVISIONID=cd.ID ";
			$sql.= " LEFT JOIN cnf_department cdp ON cd.DEPARTMENTID = cdp.ID ";
			$sql.= $condition;
			$detail = $this->db->getrow($sql);
			dbConvert($detail);
			$data['detail']=$detail;
			
			$action_type = "VIEW";
			$action =" ดูรายละเอียดการตั้งค่าจัดการโครงการและวัตถุประสงค์ ID :".$data['id']." โครงการ ".@$data['detail']['title'];
			save_logfile($action_type,$action,$this->modules_name);
		
			$data['mainactivity'] = $this->mainactivity->where("projectid = ".$id)->get();
			$data['central_division'] = $this->division->where("PROVINCEID=2 AND DEPARTMENTID=".$data['detail']['departmentid']." and id not in(select divisionid from insp_project_record where insp_project_id = ".$id." and divisionid IS NOT NULL)")->order_by("title","asc")->get(FALSE,TRUE);
			
			$sql = "SELECT insp_project_record.divisionid id,cnf_division.title title FROM insp_project_record left join cnf_division on insp_project_record.divisionid = cnf_division.id where insp_project_id = ".$id." and insp_project_record.provinceid = 2";
			$data['division_selected'] = $this->insp_project_record->get($sql,TRUE);
			
			//-- ถ้าเป็นกรมพัฒนาสังคมและสวัสดิการ 
			//-- ให้ดึงจังหวัดของหน่วยงานของ ศูนย์พัฒนาสังคม กับ บ้านพักเด็กและครอบครัว มาโชว์แทน 
			if($data['detail']['departmentid'] == 4){
				//จังหวัดของหน่วยงานของ บ้านพักเด็กและครอบครัว
				$sql = "SELECT insp_project_record.home_provinceid id,cnf_province.title title FROM insp_project_record left join cnf_province on insp_project_record.home_provinceid = cnf_province.id where insp_project_id = ".$id."  and home_provinceid <> 2";
				$data['home_province_selected'] = $this->insp_project_record->get($sql,TRUE);
				$data['home_province'] = $this->province->where("id <> 2 and id not in(select home_provinceid from insp_project_record where insp_project_id = ".$id." and home_provinceid is not null)")->order_by("title","asc")->get(FALSE,TRUE);
				
				//จังหวัดของหน่วยงานของ ศูนย์พัฒนาสังคม
				$sql = "SELECT insp_project_record.social_provinceid id,cnf_province.title title FROM insp_project_record left join cnf_province on insp_project_record.social_provinceid = cnf_province.id where insp_project_id = ".$id." and social_provinceid <> 2";
				$data['social_province_selected'] = $this->insp_project_record->get($sql,TRUE);
				$data['social_province'] = $this->province->where("id <> 2 and id not in(select social_provinceid from insp_project_record where insp_project_id = ".$id." and social_provinceid is not null)")->order_by("title","asc")->get(FALSE,TRUE);
			
			}else{
				$sql = "SELECT insp_project_record.provinceid id,cnf_province.title title FROM insp_project_record left join cnf_province on insp_project_record.provinceid = cnf_province.id where insp_project_id = ".$id." and provinceid <> 2";
				$data['province_selected'] = $this->insp_project_record->get($sql,TRUE);
				$data['province'] = $this->province->where("id <> 2 and id not in(select provinceid from insp_project_record where insp_project_id = ".$id." and provinceid is not null)")->order_by("title","asc")->get(FALSE,TRUE);
			}
		}else{
			$data['id'] = 0;
		}
		$data['byear'] = $this->strategy->get("SELECT DISTINCT MTYEAR byear FROM MT_STRATEGY",TRUE);
		$this->template->build('inspect_project_management_form',$data);
	}
	
	function select_project_from_division()
	{
		$projectids = $this->insp_project->get();
		if($_POST['budgetyear'] > 0 && $_POST['divisionid']>0)
		{
			$option = $_POST['curr_project'] > 0 ? " OR ID=".$_POST['curr_project'] : ""; 
			$result = $this->mt_project->where("(PYEAR=".$_POST['budgetyear']." AND DIVISIONID=".$_POST['divisionid']." AND PID=0) AND (ID NOT IN(SELECT MTPROJECTID FROM INSP_PROJECT)".$option." )")->get(FALSE,TRUE);
			$projectlist ='<select id="projectid" name="projectid" >';
			$projectlist.='<option value="">--เลือกโครงการ--</option>';
			foreach($result as $item):
			$projectlist.='<option value="'.$item['id'].'">'.$item['title']."</option>";
			endforeach;
			$projectlist.='</select>';
			echo $projectlist;
		}
	}
	
	function select_department_from_year(){
		echo @form_dropdown('departmentid',get_option("id","title","cnf_department"),'','','-- เลือกกรม --','0');
	}
	
	function save($id=FALSE)
	{
		$url_parameter = GetCurrentUrlGetParameter();
		if($_POST){
			$_POST['projectid'] = $_POST['projectid'] == ''?"0":$_POST['projectid'];
			@$_POST['workgroupid'] = $_POST['workgroupid'] == ''?"0":$_POST['workgroupid'];
			
			if($id > 0){
			   	$action_type = "EDIT";
				$action =" แก้ไขการตั้งค่าจัดการโครงการและวัตถุประสงค์ ID :".$id." โครงการ ".$_POST['title'];
			}else{
			   	$action_type = "ADD";
				$action =" เพิ่มการตั้งค่าจัดการโครงการและวัตถุประสงค์ ID :".$id." โครงการ ".$_POST['title'];
			}
			save_logfile($action_type,$action,$this->modules_name);
			
			$id = $this->insp_project->save(array(
				"id"=>$id,
				"mtprojectid"=>$_POST['projectid'],
				"objective"=>$_POST['objective'],
				"title"=>$_POST['title'],
				"budgetyear"=>$_POST['budgetyear'],
				"departmentid"=>$_POST['departmentid'],
				"divisionid"=>$_POST['divisionid'],
				"workgroupid"=>$_POST['workgroupid']
			));
			
			if(@$_POST['actitle']){
				$this->mainactivity->delete("projectid",$id);
				foreach($_POST['actitle'] as $key=>$item){
					if(!empty($_POST['actitle'][$key])){
						$mainacid = $this->mainactivity->save(array(
							"projectid"=>$id,
							"actitle"=>$_POST['actitle'][$key]
						));
					}
				}
			}else{
				$this->mainactivity->delete('projectid',$id);
			}
			
			set_notify('success', lang('save_data_complete'));
		}
		//echo "xxx = " .$this->uri->segment(3);
		if(@$this->uri->segment(3) == 0 ){
			redirect('inspect_project_management/form/'.$id.$url_parameter);
		}else{
			redirect('inspect_project_management/index'.$url_parameter);
		}
	}
	function delete($id=FALSE)
	{
		if($id){
			$url_parameter = GetCurrentUrlGetParameter();
			$result = $this->insp_project->get_row($id);
			
			$this->insp_project->delete($id);
			$this->progress->delete('projectid',$id);
			$this->insp_project_save->delete('projectid',$id);
			$this->mainactivity->delete('projectid',$id);
			$this->project_detail->delete('pid',$id);
			$this->sub_activity->delete('projectid',$id);
			$this->sub_activity_file->delete('projectid',$id);
			$this->insp_project_record->delete('insp_project_id',$id);
			
			$action_type="DELETE";
			$action =" ลบรายละเอียดการตั้งค่าจัดการโครงการและวัตถุประสงค์ ID :".$id." โครงการ ".$result['title'];
			save_logfile($action_type,$action,$this->modules_name);
			
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('inspect_project_management/index'.$url_parameter);
	}
	
	function ajax_find_project_from_departmentid(){
		$_POST['departmentid'];
		echo form_dropdown('projectid',get_option('id','title','mt_project where departmentid = '.$_POST['departmentid']),'','','-- เลือกโครงการ --','0');
	}
	
	function refresh_central_division_form(){
		$_POST['departmentid'];
		$data['central_division'] = $this->division->where("PROVINCEID=2 AND DEPARTMENTID=".$_POST['departmentid'])->order_by("title","asc")->get(FALSE,TRUE);
		
		$this->load->view('newCentrelDivisionForm',$data);
	}
	
	function save_subdetail(){
		if(@$_POST['provinceid']!= ""){
			$province = explode("|",$_POST['provinceid']);
			foreach($province as $item){
				$condition = "1=1";
				$condition .= $_POST['insp_project_id'] > 0 ? " AND insp_project_id=".$_POST['insp_project_id']."" : "";
				$condition .= $item > 0 ? " AND provinceid=".$item."" : "";					
				$result = $this->db->getone("SELECT ID from INSP_PROJECT_RECORD WHERE ".$condition);
				$_POST['provinceid'] = $item;
				if(@$result<1){
					$this->insp_project_record->save($_POST);
				}
			}
		}
		
		if(@$_POST['divisionid']!= ""){
			$division = explode("|",$_POST['divisionid']);
			foreach($division as $item){
				$condition = "1=1";
				$condition .= $_POST['insp_project_id'] > 0 ? " AND insp_project_id=".$_POST['insp_project_id']."" : "";
				$condition .= $item > 0 ? " AND divisionid=".$item."" : "";					
				$result = $this->db->getone("SELECT ID from INSP_PROJECT_RECORD WHERE ".$condition);
				$_POST['divisionid'] = $item;
				$_POST['provinceid'] = 2;
				if(@$result<1){
					$this->insp_project_record->save($_POST);
				}
			}
		}

		if(@$_POST['home_provinceid']!= ""){
			$province = explode("|",$_POST['home_provinceid']);
			foreach($province as $item){
				$condition = "1=1";
				$condition .= $_POST['insp_project_id'] > 0 ? " AND insp_project_id=".$_POST['insp_project_id']."" : "";
				$condition .= $item > 0 ? " AND home_provinceid=".$item."" : "";					
				$result = $this->db->getone("SELECT ID from INSP_PROJECT_RECORD WHERE ".$condition);
				$_POST['home_provinceid'] = $item;
				if(@$result<1){
					$this->insp_project_record->save($_POST);
				}
			}
		}
		
		if(@$_POST['social_provinceid']!= ""){
			$province = explode("|",$_POST['social_provinceid']);
			foreach($province as $item){
				$condition = "1=1";
				$condition .= $_POST['insp_project_id'] > 0 ? " AND insp_project_id=".$_POST['insp_project_id']."" : "";
				$condition .= $item > 0 ? " AND social_provinceid=".$item."" : "";					
				$result = $this->db->getone("SELECT ID from INSP_PROJECT_RECORD WHERE ".$condition);
				$_POST['social_provinceid'] = $item;
				if(@$result<1){
					$this->insp_project_record->save($_POST);
				}
			}
		}
	}

	function delSbudget_fromDivision(){
		$this->db->debug = true;
		$_POST['divisionid'] = str_replace("|",",",$_POST['divisionid']);
		
		$this->insp_project_record->where("divisionid IN (".$_POST['divisionid'].") and insp_project_id = ".$_POST['insp_project_id'])->delete();
	}
	
	function delSbudget_fromProvince(){
		$_POST['provinceid'] = str_replace("|",",",$_POST['provinceid']);
		
		$this->insp_project_record->where("provinceid IN (".$_POST['provinceid'].") and insp_project_id = ".$_POST['insp_project_id'])->delete();
	}
	
	function delSbudget_fromProvinceHome(){
		$_POST['home_provinceid'] = str_replace("|",",",$_POST['home_provinceid']);
		
		$this->insp_project_record->where("home_provinceid IN (".$_POST['home_provinceid'].") and insp_project_id = ".$_POST['insp_project_id'])->delete();
	}
	
	function delSbudget_fromProvinceSocial(){
		$_POST['social_provinceid'] = str_replace("|",",",$_POST['social_provinceid']);
		
		$this->insp_project_record->where("social_provinceid IN (".$_POST['social_provinceid'].") and insp_project_id = ".$_POST['insp_project_id'])->delete();
	}
}
?>