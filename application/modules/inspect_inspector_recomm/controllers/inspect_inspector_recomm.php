<?php
class Inspect_inspector_recomm extends Inspect_Controller
{
	public $modules_name = "inspect_inspector_recomm";
	public function __construct()
	{
		parent::__construct();
		$this->load->model('insp_inspector_recomm_model','recomm');
		$this->load->model('insp_inspector_recomm_file_model','recomm_file');
		$this->load->model('c_province/province_model','province');
		$this->load->model('c_province_area/province_area_model','province_area');
		$this->load->model('c_workgroup/workgroup_model','workgroup');
		$this->load->model('monitor_budget_plan/mt_budget_plan_model','strategy');
		$this->load->model('inspector_group/inspector_group_model','insp_group');
		$this->load->model('c_division/division_model','division');
	}
	function index()
	{
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['budgetyear'] = @$_GET['budgetyear'];
		$data['provincearea'] = @$_GET['provincearea'];
		$data['provinceid'] = @$_GET['provinceid'];
		$data['divisionid'] = @$_GET['divisionid'];
		
		$data['byear'] = $this->strategy->get("SELECT DISTINCT MTYEAR byear FROM MT_STRATEGY",TRUE);
		$data['provincelist'] = $this->province->get(FALSE,TRUE);
		
		if(login_data('is_inspector') == 'on'){
			if(login_data('insp_access_all') == 'on'){
				$data['provincearealist'] = $this->province_area->get();
			}else{
				$inspect_user = $this->insp_group->get_row('users_id',login_data('id'));
				$sql = "SELECT * FROM CNF_PROVINCE_AREA
where id in (select province_area from insp_group where users_id = ".login_data("id").")";
				$data['provincearealist'] = $this->province_area->get($sql,"true");
			}
		}else{
			if(empty($_GET['provincearea']) and empty($_GET['provinceid'])){
				redirect('inspect_inspector_recomm?budgetyear=&provincearea='.login_data('user_province_area_id').'&provinceid='.login_data('user_province_id').'&divisionid='.login_data('divisionid'));
			}
		}
		
		$condition = " 1=1 ";
		$condition.= $data['budgetyear']!=''? " and budgetyear=".$data['budgetyear'] : "";
		$condition.= $data['provincearea']!=''? " and provincearea_id=".$data['provincearea'] : "";
		$condition.= $data['provinceid']!= 0? " and provinceid=".$data['provinceid'] : "";
		$condition.= $data['divisionid']!= 0? " and divisionid=".$data['divisionid'] : "";
		//$this->db->debug = true;
		if(login_data('is_inspector') == 'on'){
			if(login_data('insp_access_all') != 'on'){
				$condition .= " and provincearea_id in (select province_area from insp_group where users_id = ".login_data("id").")";
			}
			$sql = "SELECT budgetyear,divisionid,provinceid,provincearea_id,
(select title from cnf_division where id = insp1.divisionid)division_title,
(select title from cnf_province_area where id = insp1.provincearea_id)provincearea_title,
(select title from cnf_province where id = insp1.provinceid)province_title,
(select count(*) from INSP_INSPECTOR_RECOMM 
  WHERE budgetyear=insp1.budgetyear and divisionid=insp1.divisionid and provinceid=insp1.provinceid and provincearea_id=insp1.provincearea_id)nsuggestion
,(select count(*) from INSP_INSPECTOR_RECOMM  
  WHERE VARCHAR(OPERATIONRESULT) <> '' and budgetyear=insp1.budgetyear
 and divisionid=insp1.divisionid and provinceid=insp1.provinceid
 and provincearea_id=insp1.provincearea_id
) noperationresult
FROM INSP_INSPECTOR_RECOMM as insp1
where ".$condition."
group by budgetyear,divisionid,provinceid,provincearea_id";
			$data['result'] = $this->recomm->get($sql,TRUE);
		}else{
			$data['result'] = $this->recomm->where($condition)->get(FALSE,TRUE);
		}
		//exit()
		$data['pagination']=$this->recomm->pagination();
		$this->template->build('inspect_inspector_recomm_index',$data);
	}
	
	function form($budgetyear=FALSE,$provincearea=FALSE,$provinceid=FALSE,$id=FALSE)
	{
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['budgetyear'] = $budgetyear;
		$data['provincearea'] = $provincearea;
		$data['provinceid'] = $provinceid;
		if($provinceid > 0 ){
			// ถ้ามี id จังหวัด
			$data['provincetitle']= $this->province->get_one("TITLE",$provinceid) ;
		}
		else
		{
			// ถ้าไม่มี id จังหวัด จะแสดงทั้งเขต
			$title='';
			$result = $this->province->where("AREA=".$provincearea)->get(FALSE,TRUE);
			foreach($result as $item):
				$title.= $item['title'].",";
			endforeach;
			$data['provincetitle']=$title;
		}
		$data['provinceareatitle'] = $provincearea > 0 ? $this->province_area->get_one("TITLE",$provincearea) : "";
		
		
		if($provinceid > 0 ){
			$data['workgroup'] = $this->workgroup->get_row(login_data('workgroupid'));
			$data['province_data'] = $this->recomm->get_row($id);
			$this->template->build('inspect_inspector_recomm_form_user',$data);
		}else{
			$sql = "SELECT P.ID ProvinceID,P.TITLE ProvinceTitle
					FROM CNF_PROVINCE P 
					left join insp_inspector_recomm iir
					on P.ID=iir.provinceid
					WHERE AREA = ".$provincearea." and operationresult IS NOT NULL
					group by p.id,p.title";
			$data['province_data'] = $this->province->get($sql,TRUE);	
			$this->template->build('inspect_inspector_recomm_form_examiner',$data);
		}
		
	}

	function workgroup_save($budgetyear=FALSE,$provincearea=FALSE,$provinceid=FALSE){
		//$this->db->debug = true;
		if($_POST){
			$id = $this->recomm->save($_POST);
			
			@fix_file($_FILES["attachdocument"]);
			if(@$_FILES['attachdocument']['name']!=""){							
				$this->recomm->save(array(
				'id'=>$id,
				'attachdocument'=> $this->recomm->upload($_FILES["attachdocument"],'uploads/inspect/recomm/')
				));
			}
			
			set_notify('success', lang('save_data_complete'));
		}
		redirect('inspect_inspector_recomm/index?budgetyear='.$budgetyear.'&provincearea='.$provincearea.'&provinceid='.$provinceid);
	}
	
	function save($budgetyear=FALSE,$provincearea=FALSE,$provinceid=FALSE)
	{
		if($_POST){
			if(isset($_POST['provinceid'])){
				//$this->db->debug = true;
				foreach($_POST['provinceid'] as $key=>$item){
					$sql = "UPDATE insp_inspector_recomm
							SET suggestion='".iconv( 'UTF-8', 'TIS-620', $_POST['suggestion'][$key])."' 
							WHERE provinceid=".$_POST['provinceid'][$key];
					$this->db->execute($sql);
				}
			}
			set_notify('success', lang('save_data_complete'));
		}					
		redirect('inspect_inspector_recomm/index?budgetyear='.$budgetyear.'&provincearea='.$provincearea.'&provinceid='.$provinceid);
	}

	function download($filename=FALSE){			   
	   $this->load->helper('download');        
	   $data = file_get_contents('uploads/inspect/recomm/'.$filename);	   
	   force_download($filename, $data);	   
	} 
	
	function delete_attach()
	{
		if($_POST)
		{
			$this->recomm->delete_file($_POST['id'],'uploads/inspect/recomm/','ATTACHDOCUMENT');
			
			$this->recomm->save(array(
			"id"=>$_POST['id'],
			"attachdocument"=>""
			));
		}
	}
	
	function delete($id){
		$url_parameter = GetCurrentUrlGetParameter();
		if($id){
			$this->recomm->delete_file('id','uploads/inspect/recomm/','attachdocument',$id);
			$this->recomm->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('inspect_inspector_recomm/index'.$url_parameter);
	}
	
	function newform(){
		if($_GET){
			$data['recomm'] = $this->recomm->where("budgetyear = ".$_GET['budgetyear']." and divisionid = ".$_GET['divisionid']." and provincearea_id = ".$_GET['provincearea_id']." and provinceid = ".$_GET['provinceid'])->get();
			
			$division_title = $this->division->get_one('title',$_GET['divisionid']);
			$province_area_title = $this->province_area->get_one('title',$_GET['provincearea_id']);
			$province_title = $this->province->get_one('title',$_GET['provinceid']);
			$action_type = "VIEW";
			$action =" ดูบันทึกข้อเสนอแนะผู้ตรวจ ปี :".($_GET['budgetyear']+543)." ".$division_title." ".$province_area_title." จังหวัด".$province_title;
			save_logfile($action_type,$action,$this->modules_name);
		}

		$data['byear'] = $this->strategy->get("SELECT DISTINCT MTYEAR byear FROM MT_STRATEGY",TRUE);
		
		$this->template->build('examiner',$data);
	}
	
	function examiner_add_ajax(){
		if($_POST){
			// $this->db->debug = true;
			$this->recomm->save($_POST);
			$this->load_suggestion_ajax();
			
			$division_title = $this->division->get_one('title',$_POST['divisionid']);
			$province_area_title = $this->province_area->get_one('title',$_POST['provincearea_id']);
			$province_title = $this->province->get_one('title',$_POST['provinceid']);
			if($_POST['id'] > 0){
			   	$action_type = "EDIT";
				$action =" แก้ไขบันทึกข้อเสนอแนะผู้ตรวจ ปี :".($_POST['budgetyear']+543)." ".$division_title." ".$province_area_title." จังหวัด".$province_title;
			}else{
			   	$action_type = "ADD";
				$action =" เพิ่มบันทึกข้อเสนอแนะผู้ตรวจ ปี :".($_POST['budgetyear']+543)." ".$division_title." ".$province_area_title." จังหวัด".$province_title;
			}
			save_logfile($action_type,$action,$this->modules_name);
		}
	}
	
	function form_76_province_ajax(){
		echo @form_dropdown('provinceid',get_option("id","title","cnf_province where id <> 2"),'','','-- เลือกจังหวัด --','0');
	}
	
	function load_suggestion_ajax(){
		if($_POST){
			if($_POST['divisionid'] == 105){
				$recomm = $this->recomm->where("budgetyear = ".$_POST['budgetyear']." and divisionid = ".$_POST['divisionid']." and provincearea_id = ".$_POST['provincearea_id']." and provinceid = ".$_POST['provinceid'])->get();
			}else{
				$recomm = $this->recomm->where("budgetyear = ".$_POST['budgetyear']." and divisionid = ".$_POST['divisionid']." and provinceid = ".$_POST['provinceid'])->get();
			}
			
			echo"<table class='tblist2'><tr><th>ลำดับที่</th><th>ข้อเสนอแนะ(ผู้ตรวจราชการ)</th><th>ผลการดำเนินงาน</th><th></th></tr>";
			foreach($recomm as $key=>$row){
				echo"<tr ".cycle($key)."><td width='60' align='center'>".($key+1)."</td><td class='edit' width='421'>".$row['suggestion']."</td><td>".$row['operationresult']."</td><td width='30'><input type='hidden' name='id' value='".$row['id']."'><input type='button' class='btn_delete'></td></tr>";
			}
			echo"<table>";
		}
	}
	
	function suggestion_delete_ajax(){
		if($_POST){
			$this->recomm->delete($_POST['id']);
			$this->load_suggestion_ajax();
		}
	}
	
	function operationresult_save_ajax(){
		if($_POST){
			$this->recomm->save($_POST);
		}
	}
	
	function newdelete($budgetyear,$divisionid,$provincearea_id,$provinceid){
		$url_parameter = GetCurrentUrlGetParameter();
		if($provinceid){
			$this->recomm->where("budgetyear = ".$budgetyear." and divisionid = ".$divisionid." and provincearea_id = ".$provincearea_id." and provinceid =  ".$provinceid)->delete();
			
			$division_title = $this->division->get_one('title',$divisionid);
			$province_area_title = $this->province_area->get_one('title',$provincearea_id);
			$province_title = $this->province->get_one('title',$provinceid);
			$action_type="DELETE";
			$action =" ลบบันทึกข้อเสนอแนะผู้ตรวจ ปี :".($budgetyear+543)." ".$division_title." ".$province_area_title." จังหวัด".$province_title;
			save_logfile($action_type,$action,$this->modules_name);
			
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('inspect_inspector_recomm/index'.$url_parameter);
	}
	
	function operation_save(){
		if($_POST['id']){
			foreach($_POST['id'] as $key=>$item){
				$id = $_POST['id'][$key];
				$operationresult = str_replace("'","\"",$_POST['operationresult'][$key]);
				$this->recomm->save(array(
					"id" => $_POST['id'][$key],
					"operationresult" => $operationresult
				));
				
				// ไฟล์แนบ ------------
					fix_file($_FILES["file_".$id.""]);
					foreach($_FILES["file_".$id.""] as $key => $item)
					{
						if($item)
						{
							if($_FILES["file_".$id.""][$key]['name'])
							{
								$this->recomm_file->save(array('INSP_INSPECTOR_RECOMM_ID'=>$id											
															 ,'CREATE_DATE'=>now()
															 ,'FILE_NAME'=>$this->recomm_file->upload($_FILES["file_".$id.""][$key],'uploads/recomm/')));
							}		
						}
					}
			}
			set_notify('success', lang('save_data_complete'));
		}					
		redirect('inspect_inspector_recomm/index'.$_POST['urlParameter']);
	}

	function download_file($id)
	{
		$this->load->helper('download');	
		$file= $this->recomm_file->get_one('file_name',$id);	
		$data =file_get_contents("uploads/recomm/".$file);	
		$name =$file;	
		
		force_download($name, $data); 
	}
	
	function delFile(){
		$id = $_GET['id'];
		$this->recomm_file->delete_file('id','uploads/recomm/','file_name',$id);	
		$this->recomm_file->delete($id);
	}
	
	function dump(){
		
		$txt1 = iconv( 'UTF-8', 'TIS-620', '<p><span lang="TH"><strong>โครงการส่งเสริมและพัฒนาศักยภาพของครอบครัว</strong><br />&nbsp;</span></p> <p><span lang="TH">&nbsp;&nbsp;&nbsp;&nbsp; ๑) หน่วยรับตรวจควรจัดทำข้อตกลงในการดำเนินงานด้านครอบครัว (</span>MOU<span lang="TH">) ร่วมกับภาคีเครือข่ายที่เกี่ยวข้อง เพื่อให้สามารถดำเนินการป้องกัน แก้ไขปัญหาด้านครอบครัวและสังคมในพื้นที่ได้อย่างแท้จริง<br />&nbsp;</span></p> <span lang="TH">&nbsp;&nbsp;&nbsp;&nbsp; </span><span lang="TH">๒) หน่วยรับตรวจควรจัดทำโปรแกรมสำเร็จรูปเพื่อการจัดเก็บข้อมูลด้านครอบครัว และข้อมูลที่เกี่ยวข้อง เพื่อให้ ศพค. นำข้อมูลดังกล่าว ไปใช้ในการวางแผนดำเนินการป้องกันและแก้ไขปัญหาครอบครัวได้โดยสะดวก รวดเร็ว ประกอบกับการเป็นข้อมูลที่เชื่อถือได้</span>');
		
		$txt2 = iconv( 'UTF-8', 'TIS-620', '<p><span lang="TH"><strong>โครงการสร้างพลังเยาวชนไทยร่วมใจพัฒนาชาติ</strong><br />&nbsp;</span></p> <p><span lang="TH">&nbsp;&nbsp;&nbsp;&nbsp; </span><span lang="TH">๑) ห</span><span lang="AR-SA">น่วยรับตรวจควร</span><span lang="TH">หาวิธีการสร้างระบบพี่เลี้ยง เพื่อให้การดำเนินงานสภาเด็กและเยาวชน ดำเนินงานได้อย่างต่อเนื่อง<br />&nbsp; </span></p> <p><span lang="TH">&nbsp;&nbsp; &nbsp;&nbsp;๒) </span><span lang="TH">ห</span><span lang="AR-SA">น่วยรับตรวจควร</span><span lang="TH">หาสถานที่ให้สภาเด็กและเยาวชน เพื่อใช้ในการทำงาน การประชุม การแลกเปลี่ยนเรียนรู้ และการทำกิจกรรมร่วมกัน<br />&nbsp;</span></p> <span lang="TH">&nbsp;&nbsp;&nbsp;&nbsp; </span><span lang="TH">๓) หน่วยรับตรวจต้องมีการจัดเก็บข้อมูลเกี่ยวกับสถานการณ์ของเด็กและเยาวชนที่ถูกต้องครบถ้วน เพื่อใช้เป็นข้อมูล ตลอดจนต้องมีการปรับเปลี่ยนเทคนิคการทำงานให้มีความสอดคล้องกับสถานการณ์<br /><br /><span lang="TH">&nbsp; &nbsp; &nbsp;๔) หน่วยรับตรวจต้องเพิ่มบทบาทในการเป็นนักประสานที่ดี</span></span><span lang="TH">ในการแสวงหาทรัพยากรสนับสนุนการดำเนินงานของสภาเด็กและเยาวชน</span>');
		
		$txt3 = iconv( 'UTF-8', 'TIS-620', '<p><span lang="TH"><strong>โครงการกองทุนส่งเสริมการจัดสวัสดิการสังคม</strong><br />&nbsp;</span></p> <p><span lang="TH">&nbsp;&nbsp;&nbsp;&nbsp; ๑) หน่วยรับตรวจควรพัฒนาศักยภาพผู้ปฏิบัติงานกองทุนส่งเสริมการจัดสวัสดิการสังคม โดยเพิ่มพูนความรู้ และทักษะให้แก่ผู้รับผิดชอบโครงการ คณะกรรมการบริหารกองทุนฯ และคณะอนุกรรมการพิจารณากลั่นกรองโครงการฯ เพื่อให้มีความรู้ ความเข้าใจในการดำเนินงานกองทุนฯ อย่างถ่องแท้ ชัดเจน<br />&nbsp;</span></p> <p><span lang="TH">&nbsp;&nbsp;&nbsp;&nbsp; ๒) การขับเคลื่อนการดำเนินงานด้านการพัฒนาสังคมและสวัสดิการให้บรรลุผลเป้าหมาย ต้องใช้กลไกเครือข่ายขับเคลื่อนการดำเนินงาน ดังนั้น ควรเพิ่มศักยภาพและสร้างความสัมพันธ์กับเครือข่ายทุกระดับ เพื่อให้การดำเนินงานโครงการตอบสนองความต้องการของกลุ่มเป้าหมายและสามารถแก้ไขปัญหาทางสังคมในพื้นที่ได้อย่างแท้จริง&nbsp;&nbsp;<br />&nbsp; </span></p> <span lang="TH">&nbsp;&nbsp;&nbsp;&nbsp; ๓) การดำเนินงานด้านสังคม ข้อมูล/สถานการณ์ทางสังคมเป็นสิ่งสำคัญ ดังนั้น ควรสร้างฐานข้อมูลสนับสนุนการดำเนินงาน และเผยแพร่ประชาสัมพันธ์ให้ภาคีเครือข่ายสามารถใช้ข้อมูลที่มีได้อย่างทั่วถึง โดยควรเพิ่มช่องทางในการสื่อสารให้หลากหลายมากยิ่งขึ้น</span>');

		$cnf_province = $this->province->get(FALSE,TRUE);

		foreach($cnf_province as $item){
			$province_id = $item['id'];
			$province_area = $item['area'];

			$sql = "INSERT INTO insp_inspector_recomm(ID,BUDGETYEAR,DIVISIONID,PROVINCEAREA_ID,PROVINCEID,SUGGESTION) VALUES ((select COALESCE(max(ID),0)+1 from insp_inspector_recomm),2012,105,$province_area,$province_id,'$txt1')";
			$this->db->execute($sql);
			
			$sql2 = "INSERT INTO insp_inspector_recomm(ID,BUDGETYEAR,DIVISIONID,PROVINCEAREA_ID,PROVINCEID,SUGGESTION) VALUES ((select COALESCE(max(ID),0)+1 from insp_inspector_recomm),2012,105,$province_area,$province_id,'$txt2')";
			$this->db->execute($sql2);
			
			$sql3 = "INSERT INTO insp_inspector_recomm(ID,BUDGETYEAR,DIVISIONID,PROVINCEAREA_ID,PROVINCEID,SUGGESTION) VALUES ((select COALESCE(max(ID),0)+1 from insp_inspector_recomm),2012,105,$province_area,$province_id,'$txt3')";
			$this->db->execute($sql3);
			
			
		}
	}
}
?>