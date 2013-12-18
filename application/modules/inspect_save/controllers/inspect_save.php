<?php
class Inspect_save extends Inspect_Controller
{
	public $modules_name = "inspect_save";
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('insp_project_risk_save_model','insp_project_save');
		$this->load->model('inspect_project_management/insp_project_model','insp_project');
		$this->load->model('inspect_project_management/insp_project_detail_model','insp_project_detail');
		$this->load->model('inspect_risk_subject/insp_risk_subject_model','risk_subject');
		$this->load->model('c_province/province_model','province');
		$this->load->model('c_province_area/province_area_model','province_area');
		$this->load->model('monitor_budget_plan/mt_budget_plan_model','strategy');			
		$this->load->model('monitor_budget_plan/mt_project_model','mt_project');
		$this->load->model('inspect_project_management/insp_project_main_activity_model','main_activity');
		$this->load->model('inspect_project_management/insp_custom_project_model','custom_project');
		$this->load->model('insp_project_main_activity_join_insp_process_model','mp');
		$this->load->model('insp_project_sub_activity_model','sub_activity');
		$this->load->model('insp_project_sub_activity_file_model','file');
		$this->load->model('insp_progress_model','progress');
		$this->load->model('inspect_level/inspect_level_model','level');
		$this->load->model('inspector_group/inspector_group_model','insp_group');
	}
	
	function index()
	{
		// select box ปีงบประมาณ
		$data['byear'] = $this->strategy->get("SELECT DISTINCT MTYEAR byear FROM MT_STRATEGY",TRUE);
		
		//$this->db->debug = true;
		$condition = " WHERE  1=1 ";
		$data['budgetyear'] = @$_GET['budgetyear'];
		$data['projectid'] = @$_GET['projectid'];
		
		$condition = @$_GET['provinceid'] > 0 ? " provinceid = ".@$_GET['provinceid'] : "provinceid <> 0 ";
		if(login_data('is_inspector') != 'on'){
			$condition .= login_data("divisionid") > 0 ? " and divisionid = ". login_data("divisionid") : "";
			$condition .= login_data("workgroupid") > 0 ? " and workgroupid = ". login_data("workgroupid") : "";
		}
		
		// $data['provincelist'] = $this->province->get(FALSE,TRUE);
		// $data['provincearealist'] = $this->province_area->get(FALSE,TRUE);
		
		//----- เช็ค list box สำหรับ user -----
		// if(login_data('is_inspector') == 'on'){  // ถ้าเป้นผู้ตรวจ
			// if(login_data('insp_access_all') == 'on'){ // ถ้าเห็นข้อมูลทั้งหมด
				// $data['provincearealist'] = $this->province_area->get();
			// }else{
				// $inspect_user = $this->insp_group->get_row('users_id',login_data('id'));
				// $sql = "SELECT * FROM CNF_PROVINCE_AREA
// where id in (select province_area from insp_group where users_id = ".login_data("id").")";
				// $data['provincearealist'] = $this->province_area->get($sql,"true");
			// }
		// }else{
				
			// เช็ค user ที่เข้ามาว่าอยู่เขตอะไร จังหวัดไหน ให้ใช้งานได้เฉพาะจังหวัดของตัวเองโดยระบบ จะ redirect แบบส่งพารามิเตอร์เข้าไป
			if(login_data('is_inspector') != 'on'){
				if(empty($_GET['provincearea']) and empty($_GET['provinceid'])){
					$user_province = (login_data("workgroup_provinceid") > 0 or login_data("workgroup_provinceid") != "") ? login_data("workgroup_provinceid") : login_data("division_provinceid");
			 		$user_area = (login_data("workgroup_province_area_id") > 0 or login_data("workgroup_province_area_id") != "") ? login_data("workgroup_province_area_id") : login_data("division_province_area_id");
					redirect('inspect_save?provincearea='.$user_area.'&provinceid='.$user_province);
				}
			}
			
		// }
		
		// if(login_data('is_inspector') == 'on'){ // ถ้าเป็นผู้ตรวจ
			// @$data['projectlist'] = $this->custom_project->get(FALSE,TRUE);
		// }else{
			// if(@$_GET['provinceid'] == 2){
				// @$conn = " and division_id = ".login_data("divisionid");
			// }
			// if(@$_GET['budgetyear']){
				// @$conn.=" AND BUDGETYEAR=".@$_GET['budgetyear'];
			// }
			
			// $sql = "SELECT INSP_PROJECT.*,mt_project.title projecttitle,insp_project_record.provinceid,insp_project_record.divisionid record_divisionid
// from insp_project
// left join mt_project on INSP_PROJECT.mtprojectid = mt_project.id
// left join insp_project_record on INSP_PROJECT.id = insp_project_record.insp_project_id where provinceid = ".$_GET['provinceid'].@$conn;
			
			//-- ถ้าเป็นกรมพัฒนาสังคมและสวัสดิการ 
			//-- ให้ดึงจังหวัดของหน่วยงานของ ศูนย์พัฒนาสังคม กับ บ้านพักเด็กและครอบครัว มาโชว์แทน 
			
			// if(login_data('divisionid') == 108){
				// $data['projectlist'] = $this->custom_project->where("social_provinceid = ".@$_GET['provinceid'].@$conn)->get(FALSE,TRUE);
			// }else if(login_data('divisionid') == 110){
				// @$data['projectlist'] = $this->custom_project->where("home_provinceid = ".@$_GET['provinceid'].@$conn)->get(FALSE,TRUE);
			// }else{				
				// @$data['projectlist'] = $this->custom_project->where("province_id = ".@$_GET['provinceid'].@$conn)->get(FALSE,TRUE);
			// }
		// }
		
		if(@$_GET['budgetyear'] > 0 && @$_GET['projectid'] > 0 && @$_GET['provincearea'] > 0 )
		{
			//หา id ของรอบ ล่าสุด
			$sql = "select MAX(roundno) as m_roundno from insp_project_risk_save where budgetyear = ".$_GET['budgetyear']." and projectid = ".$_GET['projectid']." and provinceareaid = ".$_GET['provincearea']." and provinceid = ".$_GET['provinceid'];
			$roundChk =$this->insp_project_save->get($sql);
			$roundChk = $roundChk[0]['m_roundno'];
			//$roundChk = $roundChk[0]['m_roundno']+1; //--- บวกค่าเพิ่มฟอร์มรอบถัดไป
			
			// หารายละเอียดรอบ
			$sql = " SELECT INSP_ROUND.MT_YEAR,INSP_ROUND_DETAIL.*,INSP_ROUND_DETAIL.ID ROUNDNO FROM INSP_ROUND LEFT JOIN INSP_ROUND_DETAIL ON INSP_ROUND.ID = INSP_ROUND_DETAIL.ROUND_ID WHERE MT_YEAR=".@$_GET['budgetyear']." and insp_round_detail.id <= ".$roundChk;
			$roundresult = $this->db->getarray($sql);
			dbConvert($roundresult);
			$data['roundresult'] = $roundresult;
			
			// รายละเอียด วัตถุประสงค์ของโครงการ
			$sql = " SELECT INP.*,MP.TITLE projecttitle FROM insp_project INP LEFT JOIN MT_PROJECT MP ON INP.MTPROJECTID=MP.ID WHERE INP.ID=".$_GET['projectid'];
			$project =  $this->db->getrow($sql,TRUE);
			dbConvert($project);
			$data['keyRiskDataList'] = $this->fn_key_risk_data($project,1,TRUE);
			$data['politicalRiskDataList'] = $this->fn_key_risk_data($project,2,FALSE);
			$data['negotiationRiskDataList'] = $this->fn_key_risk_data($project,3,FALSE);
			$data['otherRiskDataList'] = $this->fn_key_risk_data($project,4,FALSE); 
			
			// ความคืบหน้าการดำเนินการโครงการ
			$data['mainactivity'] = $this->main_activity->where("projectid = ".$_GET['projectid'])->get();
			
			$data['reason'] = $this->db->getone("select reason from insp_project_risk_save where budgetyear = ".$_GET['budgetyear']." and projectid = ".$_GET['projectid']." and provinceareaid = ".$_GET['provincearea']." and provinceid = ".$_GET['provinceid']." order by id asc");
			dbConvert($data['reason']);
			
			$action_type = "VIEW";
			$action ="ดูบันทึกผลการดำเนินงานโครงการ :".$project['title'];
			save_logfile($action_type,$action,$this->modules_name);
		}
		$this->template->build('inspect_save_index',$data);
	}

	function save(){
		//$this->db->debug = true;
		$budgetyear = $_GET['budgetyear']=='' ? 0 : $_GET['budgetyear'];
		$projectid = $_GET['projectid'] == '' ? 0 : $_GET['projectid'];
		$provinceareaid= $_GET['provincearea'] == "" ? 0 : $_GET['provincearea'];
		$provinceid = $_GET['provinceid'] == "" ? 0 : $_GET['provinceid'];
		$updateuser = $this->session->userdata('id');
		$createdate = now();
		$updatedate = now();
		if($_POST){								
			if(isset($_POST['risksubjectid'])){
				foreach($_POST['risksubjectid'] as $key=>$item){
					if($_POST['risksubjectid'][$key]){
						
						$last_round = $_POST['roundid'][$key];

						if(@$_POST['hdID'][$key] == ""){
							$this->insp_project_save->save(array(
								'id'=>$_POST['hdID'][$key],
								'budgetyear'=>$budgetyear,
								'projectid'=>$projectid,
								'provinceareaid'=>$provinceareaid,
								'provinceid'=>$provinceid,
								'subjectid'=>$_POST['risksubjectid'][$key],
								'roundno'=>$_POST['roundid'][$key],
								'chancelevel'=>$_POST['chancelevel'][$key],
								'effectlevel'=>$_POST['effectlevel'][$key],
								'remark'=>$_POST['remark'][$key],
								'cremark'=>$_POST['cremark'][$key],
								'createuser'=>$this->session->userdata('id'),
								'createdate'=>$createdate
							));
						}else{
							$this->insp_project_save->save(array(
								'id'=>$_POST['hdID'][$key],
								'budgetyear'=>$budgetyear,
								'projectid'=>$projectid,
								'provinceareaid'=>$provinceareaid,
								'provinceid'=>$provinceid,
								'subjectid'=>$_POST['risksubjectid'][$key],
								'roundno'=>$_POST['roundid'][$key],
								'chancelevel'=>$_POST['chancelevel'][$key],
								'effectlevel'=>$_POST['effectlevel'][$key],
								'remark'=>$_POST['remark'][$key],
								'cremark'=>$_POST['cremark'][$key],
								'reason'=>$_POST['reason']
							));
						}
					}
				}
				
				if($_POST['status'] == "ผ่านการตรวจสอบแล้ว"){
					$approvedate = now();
					$approveuser = $this->session->userdata('id');
					$sql = "UPDATE insp_project_risk_save SET status = '".$_POST['status']."', approvedate = ".$approvedate.", approveuser = ".$approveuser." , updatedate = ".$updatedate.", updateuser = ".$updateuser." WHERE roundno = ".$last_round." and provinceid = ".$provinceid." and budgetyear = ".$budgetyear." and projectid = ".$projectid." and provinceareaid = ".$provinceareaid;
				}else{
					$sql = "UPDATE insp_project_risk_save SET status = '".$_POST['status']."', updatedate = ".$updatedate.", updateuser = ".$updateuser." WHERE roundno = ".$last_round." and provinceid = ".$provinceid." and budgetyear = ".$budgetyear." and projectid = ".$projectid." and provinceareaid = ".$provinceareaid;
				}
				$sql = iconv('UTF-8','TIS-620',$sql);
				$this->db->Execute($sql);
				
				$project_title = $this->insp_project->get_one('title',$projectid);
				if($_GET){
				   	$action_type = "EDIT";
					$action ="แก้ไขบันทึกผลการดำเนินงานโครงการ :".$project_title;
				}else{
				   	$action_type = "ADD";
					$action ="เพิ่มบันทึกผลการดำเนินงานโครงการ :".$project_title;
				}
				save_logfile($action_type,$action,$this->modules_name);
			}
			set_notify('success', lang('save_data_complete'));
		}
		redirect('inspect_save/index?budgetyear='.$budgetyear.'&projectid='.$projectid.'&provincearea='.$provinceareaid.'&provinceid='.$provinceid);
	}	

	function fn_key_risk_data($project=FALSE,$pRiskType=FALSE,$showObjective=FALSE)
	{	
		$dataList ='';
		$objective = $showObjective==FALSE ? '' : $project['objective'];
		
		//--- หาจำนวนรอบ ได้  id ของรอบ และ  roundindex ที่มากที่สุด ---
		$sql = "select distinct max(insp_project_risk_save.roundno) as m_roundno, insp_project_risk_save.status, insp_round_detail.roundindex from insp_project_risk_save left join insp_round_detail on insp_project_risk_save.roundno=insp_round_detail.id where budgetyear = ".$_GET['budgetyear']." and projectid = ".$_GET['projectid']." and provinceareaid = ".$_GET['provincearea']." and provinceid = ".$_GET['provinceid']." group by insp_project_risk_save.status, insp_round_detail.roundindex order by roundindex desc";
		$roundChk =$this->db->GetRow($sql);
		//echo $sql.'<br><br>';
		dbConvert($roundChk);

		$status_chk = @$roundChk['status'];

		switch ($status_chk) {
		case "บันทึกข้อมูล":
		case "ระหว่างการตรวจสอบ":
		case "ไม่ผ่านการตรวจสอบ":
		    @$roundChk = $roundChk['roundindex'];
		    break;
		case "ผ่านการตรวจสอบแล้ว":
		    @$roundChk = $roundChk['roundindex']+1;
		    break;
		default:
       		@$roundChk = 1;
		}
		
		  $sql = " SELECT INSP_ROUND.MT_YEAR,INSP_ROUND_DETAIL.round_name,INSP_ROUND_DETAIL.ID ROUNDNO FROM INSP_ROUND LEFT JOIN INSP_ROUND_DETAIL ON INSP_ROUND.ID = INSP_ROUND_DETAIL.ROUND_ID WHERE MT_YEAR=".@$_GET['budgetyear']." and insp_round_detail.roundindex <= ".$roundChk;
		$roundresult = $this->db->getarray($sql);
		//vecho $sql.'<br><br>';
		dbConvert($roundresult);
		
		// echo $pRiskType; // ( B1 ) Key Risk area - ( B4 ) Other (อื่นๆ)
		$result = $this->risk_subject->where('risktype='.$pRiskType.' and budgetyear = '.$_GET['budgetyear'])->get(FALSE,TRUE);
		// echo '<pre>';
		// print_r($result);
		// echo '</pre>';
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
				//echo $sql.'<br><br>';
				dbConvert($data);
				
				switch (@$data['status']) {
				case "บันทึกข้อมูล":
				case "ไม่ผ่านการตรวจสอบ":
					@$disabled = "";
					@$readonly = "";
				    break;
				case "ระหว่างการตรวจสอบ":
				case "ผ่านการตรวจสอบแล้ว":
					@$disabled = "disabled";
					@$readonly = "readonly='readonly'";
				    break;
				default:
					@$disabled = "";
					@$readonly = "";
				}
				
					  $dataList.='<fieldset class="fleft">';
					  $dataList.='<legend>';
			  		  $dataList.='<input '.$readonly.' type="hidden" name="roundid[]" id="roundid" value="'.$round['roundno'].'">';
					  $dataList.=$round['round_name'].'</legend>';
					  $dataList.='<span>ระดับความเสี่ยง : </span> <br />';
					  
					  $dataList.='โอกาส';
					  $dataList.=' <select name="chancelevel[]" '.$disabled.'> ';
					  for($i=1;$i<=5;$i++){
					  	$selected = (@$data['chancelevel'] == $i)?"selected":"";
					  	$dataList.= '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
					  }
					  $dataList.='</select>';
					  
					  
					  $dataList.=' ผลกระทบ';
					  $dataList.=' <select name="effectlevel[]" '.$disabled.'> ';
					  for($i=1;$i<=5;$i++){
					  	$selected = (@$data['effectlevel'] == $i)?"selected":"";
					  	$dataList.= '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
					  }
					  $dataList.='</select>';
					  
					  $dataList.='<br /><span>เนื่องจาก :</span> <br />';	
					  $dataList.='<input type="hidden" name="hdID[]" value="'.@$data['id'].'" '.$readonly.'>';				
					  $dataList.='<textarea '.$readonly.' name="remark[]" id="remark" style="width:100%; height:105px;">'.@$data['remark'].'</textarea>';
					  $dataList.='<input '.$readonly.' type="hidden" name="risksubjectid[]" id="risksubjectid" value="'.$keyRiskSubject['id'].'">';
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
							@$readonly = "";
						    break;
						case "ระหว่างการตรวจสอบ":
							@$disabled = "";
							@$readonly = "";
						    break;
						case "ผ่านการตรวจสอบแล้ว":
							@$disabled = "disabled";
							@$readonly = "readonly='readonly'";
						    break;
						default:
							@$disabled = "";
							@$readonly = "";
						}
						
						$dataList.='<fieldset class="fright">';
						$dataList.='<legend>รอบที่ '.$idx.'</legend>';
						
						$dataList.='<textarea '.$readonly.' name="cremark[]" id="cremark" style="width:100%; height:160px;">'.@$data['cremark'].'</textarea>';
						$dataList.='</fieldset>';
						endforeach;
		$dataList.='</td>';
		$dataList.='</tr>';
		endforeach;		
		return $dataList;
	}

	function progress_form($budgetyear,$projectid,$provincearea,$provinceid,$mainacid){
		$data['mainacid'] = $mainacid;
		$data['budgetyear'] = $budgetyear+543;
		$data['projectid'] = $projectid;
		$data['projectname'] = $this->insp_project->get_one('title',$projectid);
		$data['provincearea'] = $this->province_area->get_one('title',$provincearea);
		$data['provinceareaid'] = $provincearea;
		$data['province'] = $this->province->get_one('title',$provinceid);
		$data['main_activity_title'] = $this->main_activity->get_one('actitle',$mainacid);
		$data['main_activity'] = $this->mp->where("budgetyear = $budgetyear and insp_project_main_activity.projectid = $projectid and provincearea = $provincearea and province = $provinceid and mainacid = $mainacid")->get_row();
		
		$data['sub_activities'] = $this->sub_activity->where("budgetyear = $budgetyear and projectid = $projectid and provincearea = $provincearea and provinceid = $provinceid and mainacid = $mainacid")->get();
		$data['files'] = $this->file->where("insp_project_sub_activity.mainacid = ".$mainacid." and budgetyear = ".$budgetyear." and insp_project_sub_activity.projectid = ".$projectid." and provincearea = ".$provincearea." and provinceid = ".$provinceid)->get();
		
		if($mainacid > 0){
			$action_type = "VIEW";
			$action ="ดูบันทึกความคืบหน้าการดำเนินงานโครงการ ID :".$mainacid." กิจกรรมหลัก :".$data['main_activity_title']." โครงการ".$data['projectname'];
			save_logfile($action_type,$action,$this->modules_name);
		}
		
		$this->template->build('inspect_progress_form',$data);
	}
	
	function progress_save(){
		if($_POST){
			//$this->db->debug = true;
			@$_POST['status'] = $_POST['status'] == 1 ? 1 : 0;
			$id = $this->progress->save($_POST);
			
			$projectname = $this->insp_project->get_one('title',$_POST['projectid']);
			$main_activity_title = $this->main_activity->get_one('actitle',$_POST['mainacid']);
			if($id > 0){
			   	$action_type = "EDIT";
				$action ="แก้ไขบันทึกความคืบหน้าการดำเนินงานโครงการ ID :".$_POST['mainacid']." กิจกรรมหลัก :".$main_activity_title." โครงการ".$projectname;
			}else{
			   	$action_type = "ADD";
				$action ="เพิ่มบันทึกความคืบหน้าการดำเนินงานโครงการ ID :".$_POST['mainacid']." กิจกรรมหลัก :".$main_activity_title." โครงการ".$projectname;
			}
			save_logfile($action_type,$action,$this->modules_name);
			
			set_notify('success', lang('save_data_complete'));
		}
		//redirect($_POST['url']);
		redirect("inspect_save?budgetyear=".$_POST['budgetyear']."&projectid=".$_POST['projectid']."&provincearea=".$_POST['provincearea']."&provinceid=".$_POST['province']."#tabs-2");
	}
	
	function subact_save(){
		if($_POST){
			$budgetyear = $_POST['budgetyear'];
			$projectid = $_POST['projectid'];
			$provincearea = $_POST['provincearea'];
			$provinceid = $_POST['provinceid'];
			$mainacid = $_POST['mainacid'];

			$id = $this->sub_activity->save($_POST);

			$data['id'] = $id;
			$data['dropdown_frm'] = form_dropdown('subactid',get_option("id","title","insp_project_sub_activity where mainacid = $mainacid and budgetyear = $budgetyear and projectid = $projectid and provincearea = $provincearea and provinceid = $provinceid"),'','','-- เลือกกิจกรรมโครงการย่อย --','0');
			
			echo json_encode($data);
		}
	}
	
	function subactivity_del(){
		$id = $_POST['id'];
		
		$subactivity = $this->sub_activity->get_row($id);
		$budgetyear = $subactivity['budgetyear'];
		$projectid = $subactivity['projectid'];
		$provincearea = $subactivity['provincearea'];
		$provinceid = $subactivity['provinceid'];
		$mainacid = $subactivity['mainacid'];
		
		$this->sub_activity->delete($id);
		
		echo form_dropdown('subactid',get_option("id","title","insp_project_sub_activity where mainacid = $mainacid and budgetyear = $budgetyear and projectid = $projectid and provincearea = $provincearea and provinceid = $provinceid"),'','','-- เลือกกิจกรรมโครงการย่อย --','0');
	}
	
	function upload_save(){
		if($_POST){
			fix_file($_FILES["filename"]);
			foreach($_POST['follow'] as $key=>$item){
				if($_POST['follow'][$key] != ""){
					$this->file->save(array(
						//'mainacid'=>$_POST['mainacid'],
						'subactid'=>$_POST['subactid'],
						'follow'=>$_POST['follow'][$key],
						'detail'=>$_POST['detail'][$key],
						'filename'=>$this->file->upload($_FILES["filename"][$key],'uploads/inspect_save/')
						//'projectid'=>$_POST['projectid']
					));
				}
			}
			
			@$_POST['status'] = $_POST['status'] == 1 ? 1 : 0;
			$this->progress->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect($_POST['url']);
	}
	
	function download_file($id)
	{
		$this->load->helper('download');	
		$file= $this->file->get_one('filename',$id);	
		$data =file_get_contents("uploads/inspect_save/".$file);	
		$name =$file;	
		
		force_download($name, $data); 
	}
	
	function file_del(){
		$id = $_POST['fileid'];
		$this->file->delete_file('id','uploads/inspect_save/','filename',$id);	
		$this->file->delete($id);
	}

	function projectlist(){
		//$this->db->debug = true;
		$_POST['provinceid'] = $_POST['provinceid'] != "" ? $_POST['provinceid'] : '0';
		// $sql = "SELECT distinct
	// INSP_PROJECT.id,
	// INSP_PROJECT.title,
	// INSP_PROJECT.budgetyear,
	// mt_project.title as projecttitle,
	// insp_project_record.provinceid province_id,
	// insp_project_record.home_provinceid home_provinceid,
	// insp_project_record.social_provinceid social_provinceid
// FROM INSP_PROJECT
// left join mt_project on insp_project.mtprojectid = mt_project.id 
// left join insp_project_record on INSP_PROJECT.id = insp_project_record.insp_project_id 
// where (insp_project_record.provinceid = ".@$_POST['provinceid']." or insp_project_record.home_provinceid = ".@$_POST['provinceid']." or insp_project_record.social_provinceid = ".@$_POST['provinceid'].") and INSP_PROJECT.budgetyear = ".@$_POST['budgetyear'];

			
			if(@$_POST['provinceid'] == 2){
				@$conn = " and division_id = ".login_data("divisionid");
			}
			// $sql = "SELECT INSP_PROJECT.*,mt_project.title projecttitle,insp_project_record.provinceid,insp_project_record.divisionid record_divisionid
// from insp_project
// left join mt_project on INSP_PROJECT.mtprojectid = mt_project.id
// left join insp_project_record on INSP_PROJECT.id = insp_project_record.insp_project_id where provinceid = ".$_GET['provinceid'].@$conn;
			
			//-- ถ้าเป็นกรมพัฒนาสังคมและสวัสดิการ 
			//-- ให้ดึงจังหวัดของหน่วยงานของ ศูนย์พัฒนาสังคม กับ บ้านพักเด็กและครอบครัว มาโชว์แทน
			@$conn.=" AND BUDGETYEAR=".$_POST['budgetyear']; 
			if(login_data('insp_access_all') == 'on'){
				@$projectlist = $this->custom_project->where("( province_id = ".@$_POST['provinceid']." OR social_provinceid = ".@$_POST['provinceid']." OR home_provinceid = ".@$_POST['provinceid'].") ".@$conn)->get(FALSE,TRUE);
			}else{
				if(login_data('divisionid') == 108){
					$projectlist = $this->custom_project->where("social_provinceid = ".@$_POST['provinceid'].@$conn)->get(FALSE,TRUE);
				}else if(login_data('divisionid') == 110){
					@$projectlist = $this->custom_project->where("home_provinceid = ".@$_POST['provinceid'].@$conn)->get(FALSE,TRUE);
				}else{				
					@$projectlist = $this->custom_project->where("province_id = ".@$_POST['provinceid'].@$conn)->get(FALSE,TRUE);
				}
			}

		
		//$projectlist = $this->custom_project->get($sql,TRUE);
		//$projectlist = $this->custom_project->where("(province_id = ".@$_POST['provinceid']." or home_provinceid = ".@$_POST['provinceid']." or social_provinceid = ".@$_POST['provinceid'].") and budgetyear = ".@$_POST['budgetyear'])->get(FALSE,TRUE);
		//$projectlist = $this->custom_project->get(FALSE,TRUE);
					$message='<select name="projectid" id="projectid">';
							$message.= '<option value="">-- เลือกรายชื่อโครงการ --</option>';
						foreach($projectlist as $item){
				    		$selected = @$_POST['projectid'] == $item['id'] ? ' selected="selected" ' :  '';
					    	$message.='<option value="'.$item['id'].'" '.$selected.' >'.@$item['title'].@$item['projecttitle'].'</option>';
					    }
					$message.="</select>";
					echo $message;
	}
	
	// function del(){
		// $this->db->Execute("delete from INSP_PROJECT_RECORD where insp_project_id = 3 and provinceid is not null");
		// $this->db->Execute("delete from INSP_PROJECT_RECORD where insp_project_id = 5 and provinceid is not null");
	// }
	
	function return_data(){
		if($_GET){
			$lastRound = $this->insp_project_save->where("provinceid = ".$_GET['provinceid']." and budgetyear = ".$_GET['budgetyear']." and projectid = ".$_GET['projectid']." and provinceareaid = ".$_GET['provincearea'])->order_by('id','desc')->get();
			
			$this->db->debug = true;
			
			if($lastRound[0]['status'] != 'ผ่านการตรวจสอบแล้ว'){
				$this->insp_project_save->where("provinceid = ".$_GET['provinceid']." and budgetyear = ".$_GET['budgetyear']." and projectid = ".$_GET['projectid']." and provinceareaid = ".$_GET['provincearea']." and roundno = ".$lastRound[0]['roundno'])->delete();
				
				$preRound = $lastRound[0]['roundno'] - 1;
				$sql = "UPDATE insp_project_risk_save SET status = 'ระหว่างการตรวจสอบ' WHERE provinceid = ".$_GET['provinceid']." and budgetyear = ".$_GET['budgetyear']." and projectid = ".$_GET['projectid']." and provinceareaid = ".$_GET['provincearea']." and roundno = ".$preRound;
				$sql = iconv('UTF-8','TIS-620',$sql);
				$this->db->Execute($sql);
			}else{
				$sql = "UPDATE insp_project_risk_save SET status = 'ระหว่างการตรวจสอบ' WHERE provinceid = ".$_GET['provinceid']." and budgetyear = ".$_GET['budgetyear']." and projectid = ".$_GET['projectid']." and provinceareaid = ".$_GET['provincearea']." and roundno = ".$lastRound[0]['roundno'];
				$sql = iconv('UTF-8','TIS-620',$sql);
				$this->db->Execute($sql);
			}
		}
	}
	
	function get_arealist_for_is_inspector(){
		if($_POST){
			// $this->db->debug = true;
			$sql = "select insp_group.*,cnf_province_area.title from insp_group left join cnf_province_area on insp_group.province_area = cnf_province_area.id  where year = ".$_POST['year']." and users_id = ".login_data('id')." order by province_area asc";
			$area_lists = $this->insp_group->get($sql);
			echo '<select name="provincearea" id="provincearea">';
					echo'<option value="">-- เลือกเขต --</option>';
				foreach($area_lists as $item){
		    		$selected = @$_POST['provincearea'] == $item['province_area'] ? ' selected="selected" ' :  '';
			    	echo '<option value="'.$item['province_area'].'" '.$selected.' >'.@$item['title'].'</option>';
			    }
			echo "</select>";
		}
	}
}
?>