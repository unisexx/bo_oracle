<?php
class Inspect_report extends Inspect_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('insp_project_risk_save_model','risk');
		$this->load->model('inspect_project_management/insp_project_model','project');
		$this->load->model('inspect_project_management/insp_project_main_activity_model','main_activity');
		$this->load->model('inspect_save/insp_project_sub_activity_model','sub_activity');
		$this->load->model('inspect_save/insp_progress_model','progress');
		$this->load->model('inspect_round/insp_round_detail_model','round');
		$this->load->model('c_province/province_model','province');
		$this->load->model('inspect_level/inspect_level_model','level');
	}
	
	function index($budgetyear,$projectid,$provincearea,$provinceid,$roundno){
		//$this->db->debug = true;
		$data['budgetyear'] = $budgetyear;
		$data['projectid'] = $projectid;
		$data['provincearea'] = $provincearea;
		$data['provinceid'] = $provinceid;
		$data['roundno'] = $roundno;
		$data['type_name'] = array(
			'1'=>'<p><strong>( 1 ) Key Risk area</strong></p>',
			'2'=>'<p><strong>( 2 ) Political Risk</strong></p>',
			'3'=>'<p><strong>( 3 ) Negotiation Risk</strong></p>',
			'4'=>'<p><strong>( 4 ) Ohter (อื่นๆ)</strong></p>'
		);
		$data['type_id'] = array('1'=>'K','2'=>'P','3'=>'N','4'=>'O');
		$data['risktype'] = $this->risk->where("provinceareaid = ".$provincearea." and provinceid = ".$provinceid." and roundno = ".$roundno." and projectid = ".$projectid." and insp_project_risk_save.budgetyear = ".$budgetyear)->order_by('insp_project_risk_save.subjectid','asc')->get();
		
		$data['project'] = $this->project->get_row($projectid);
		$data['main_activity'] = $this->main_activity->where("projectid = ".$projectid)->get();		
		$i=1;
		foreach($data['main_activity'] as $item):			
			$data_list[$i]['mid'] = $item['id'];
			$data_list[$i]['title'] =  $item['actitle'];
			
			@$progress = $this->progress->where("budgetyear = $budgetyear and projectid = $projectid and provincearea = $provincearea and province = $provinceid and mainacid = ".$item['id'])->get_row();
			@$data_list[$i]['problem'] = $progress['problem'];
			@$data_list[$i]['solution'] = $progress['solution'];
			$i++;
		endforeach;
		@$data['row_span'] = count($data_list)>1? 'rowspan="'.count($data_list).'"' : "";		
		@$data['data_list'] = $data_list;
		
		$data['approvemain'] = count($this->progress->where("budgetyear = $budgetyear and projectid = $projectid and provincearea = $provincearea and province = $provinceid and status = 1")->get());
		$data['totalmain'] = count($this->main_activity->where("projectid = $projectid")->get());
		@$data['percentage'] = ($data['approvemain']/$data['totalmain'])*100;
		
		$data['round'] = $this->round->get_row($roundno);
		$data['province'] = $this->province->get_row($provinceid);
		
		$sql = "select cnf_province.title,cnf_province.area,provinceid,budgetyear FROM INSP_PROJECT_RISK_SAVE
left join cnf_province on cnf_province.id = INSP_PROJECT_RISK_SAVE.provinceid
where projectid = $projectid and budgetyear = $budgetyear 
group by provinceid,budgetyear,title,area having provinceid <> $provinceid;";
		$data['otherprovince'] = $this->risk->get($sql);

		$data['p_area'] = $this->province->where("area = $provincearea")->get();
		
		$data['level'] = $this->level->where("budgetyear = ".$budgetyear)->order_by('range_start','desc')->get();
		//$this->db->debug = true;
		$data['default_color'] = $this->db->getOne("select color from insp_level where budgetyear = $budgetyear and range_start = 0");
		$this->template->build('inspect_report_index',$data);
	}
	
	function project_review($budgetyear,$projectid,$provincearea,$provinceid,$roundno){
		$data['roundno'] = $roundno;
		$data['projectname'] = $this->project->get_one("title","id",$projectid);
		$data['keyRiskDataList'] = $this->fn_key_risk_data($budgetyear,$projectid,$provincearea,$provinceid,$roundno,1);
		$data['politicalRiskDataList'] = $this->fn_key_risk_data($budgetyear,$projectid,$provincearea,$provinceid,$roundno,2);
		$data['negotiationRiskDataList'] = $this->fn_key_risk_data($budgetyear,$projectid,$provincearea,$provinceid,$roundno,3);
		$data['otherRiskDataList'] = $this->fn_key_risk_data($budgetyear,$projectid,$provincearea,$provinceid,$roundno,4); 
		$this->template->build('inspect_project_review',$data);
	}
	
	function fn_key_risk_data($budgetyear,$projectid,$provincearea,$provinceid,$roundno,$risktype)
	{
		$sql = "select insp_project_risk_save.budgetyear bgyear,insp_project_risk_save.remark,insp_project_risk_save.cremark,insp_project_risk_save.chancelevel,insp_project_risk_save.effectlevel,insp_risk_subject.risktype,insp_risk_subject.title from insp_project_risk_save
left join insp_risk_subject
on insp_project_risk_save.subjectid = insp_risk_subject.id
where insp_project_risk_save.budgetyear = ".$budgetyear." and projectid = ".$projectid." and provinceareaid = ".$provincearea." and provinceid = ".$provinceid." and roundno = ".$roundno." and risktype = ".$risktype;
		
		$risk = $this->risk->get($sql);
		foreach($risk as $item){
			@$dataList .='<tr>';
			$dataList .='<td></td>';
			$dataList .='<td>'.$item['title'].'<br>ความเสี่ยง : (โอกาส : '.$item['chancelevel'].', ผลกระทบ : '.$item['effectlevel'].', รวม = '.$item['chancelevel']*$item['effectlevel'].')<br>เนื่องจาก : '.$item['remark'].'</td>';
			$dataList .='<td>'.$item['cremark'].'</td>';
			$dataList .='</tr>';
		}
		return @$dataList;
	}
}
?>