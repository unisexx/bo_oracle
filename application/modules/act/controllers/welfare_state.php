<?php
Class Welfare_state extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("target_group_model","target_group");
		$this->load->model("service_model","service");
		$this->load->model("process_model","process");
		$this->load->model("format_model","format");
		$this->load->model("method_model","method");
		$this->load->model("service_type_model","service_type");
		$this->load->model("promote_model","promote");
		$this->load->model("promote_get_model","promote_get");
		$this->load->model("process_community_model","pcommunity");
		$this->load->model("service_community_model","scommunity");
		$this->load->model("organization_main_model","orgmain");
		$this->load->model("organization_sub_model","orgsub");
	}
	
	function index(){
		// Report all PHP errors
		// error_reporting(-1);
		
		@$condition .= @$_GET['organ_name']!='' ? " and ACT_ORGANIZATION_MAIN.ORGAN_NAME like '%".$_GET['organ_name']."%'" : "";
		@$condition .= @$_GET['province_code']!='' ? " and ACT_ORGANIZATION_MAIN.PROVINCE_CODE = ".$_GET['province_code'] : "";
		@$condition .= @$_GET['step_status']!='' ? " and ACT_ORGANIZATION_MAIN.STEP_STATUS = ".$_GET['step_status'] : "";
		
		$sql = "SELECT
		ACT_ORGANIZATION_MAIN.ORGAN_ID,
		ACT_ORGANIZATION_MAIN.ORGAN_NAME,
		ACT_ORGANIZATION_MAIN.UNDER_TYPE_SUB,
		ACT_ORGANIZATION_MAIN.O_NAME,
		ACT_ORGANIZATION_MAIN.HOME_NO,
		ACT_ORGANIZATION_MAIN.MOO,
		ACT_ORGANIZATION_MAIN.SOI,
		ACT_ORGANIZATION_MAIN.ROAD,
		ACT_ORGANIZATION_MAIN.STEP_STATUS,
		ACT_PROVINCE.PROVINCE_NAME,
		ACT_AMPOR.AMPOR_NAME,
		ACT_TUMBON.TUMBON_NAME,
		ACT_ORGANIZATION_MAIN.TEL,
		ACT_ORGANIZATION_MAIN.FAX
		FROM
		ACT_ORGANIZATION_MAIN
		LEFT JOIN ACT_PROVINCE ON ACT_ORGANIZATION_MAIN.PROVINCE_CODE = ACT_PROVINCE.PROVINCE_CODE
		LEFT JOIN ACT_AMPOR ON ACT_ORGANIZATION_MAIN.AMPOR_CODE = ACT_AMPOR.AMPOR_CODE AND ACT_PROVINCE.PROVINCE_CODE = ACT_AMPOR.PROVINCE_CODE
		LEFT JOIN ACT_TUMBON ON ACT_ORGANIZATION_MAIN.TUMBON_CODE = ACT_TUMBON.TUMBON_CODE AND ACT_PROVINCE.PROVINCE_CODE = ACT_TUMBON.PROVINCE_CODE AND ACT_AMPOR.AMPOR_CODE = ACT_TUMBON.AMPOR_CODE
		WHERE ACT_ORGANIZATION_MAIN.UNDER_TYPE = 1 ".@$condition." 
		ORDER BY ACT_ORGANIZATION_MAIN.CREATE_DATE DESC"; // select หาเฉพาะหน่วยงานของรัฐ
		
		// echo $sql;
		$data['orgmains'] = $this->orgmain->get($sql,FALSE);
		$data['pagination'] = $this->orgmain->pagination();
		$this->template->build('welfare_state/index',$data);
	}
	
	function form($id=false){
		// $this->db->debug = true;
		$data['orgmain'] = $this->orgmain->get_row('organ_id',$id);
		$data['services'] = $this->service->order_by('service_id','asc')->get(FALSE,TRUE);
		
		// หน่วยงานของรัฐ
		$data['target_groups'] = $this->target_group->order_by('target_id','asc')->get(FALSE,TRUE);
		$data['processes'] = $this->process->order_by('process_id','asc')->get(FALSE,TRUE);
		
		if($id != ""){
			$data['targetgroup_select'] = $this->orgsub->where("question_name = 'target' and organ_id = ".$id)->get(FALSE,TRUE);
			$data['service_select'] = $this->orgsub->where("question_name = 'service' and organ_id = ".$id)->get(FALSE,TRUE);
			$data['process_select'] = $this->orgsub->where("question_name = 'process' and organ_id = ".$id)->get(FALSE,TRUE);	
		}
		
		// องค์กรสาธารณะประโยชน์
		// $data['formats'] = $this->format->order_by('format_id','asc')->get(FALSE,TRUE);
		// $data['methods'] = $this->method->order_by('method_id','asc')->get(FALSE,TRUE);
		// $data['service_types'] = $this->service_type->order_by('service_type_id','asc')->get(FALSE,TRUE);
		// $data['promotes'] = $this->promote->order_by('promote_id','asc')->get(FALSE,TRUE);
		// $data['promote_gets'] = $this->promote_get->order_by('promote_get_id','asc')->get(FALSE,TRUE);
		
		// องค์กรสวัสดิการชุมชน
		// $data['pcommunities'] = $this->pcommunity->order_by('pcommunity_id','asc')->get(FALSE,TRUE);
		// $data['scommunities'] = $this->scommunity->order_by('scommunity_id','asc')->get(FALSE,TRUE);
		$this->template->build('welfare_state/form',$data);
	}
	
	function save(){
		if($_POST){
			// $this->db->debug = true;
			// $_POST['create_date'] = date("Y-m-d H:i:s");
			if(@!$_POST['organ_id']){
				$sql = "SELECT MAX(ORGAN_MAX_ID) AS CNT FROM ACT_ORGANIZATION_MAIN WHERE PROVINCE_CODE='".$_POST['province_code']."' ";
				$organ_max_id = $this->db->getone($sql);
				$_POST['ORGAN_MAX_ID'] = $organ_max_id+1;
				
				// echo $sql.'<br>';
				// echo 'organ_max_id = '.$_POST['ORGAN_MAX_ID'].'<br>';
				// echo 'province_code = '.$_POST['province_code'].'<br>';
				// echo 'under_type = '.$_POST['UNDER_TYPE'].'<br>';
				// echo 'under_type_sub = '.$_POST['UNDER_TYPE_SUB'].'<br>';
				// echo 'substr_organ = '.substr("0000".$_POST['ORGAN_MAX_ID'],-5).'<br>';
			
				$_POST['organ_id'] = $_POST['province_code'].$_POST['UNDER_TYPE'].$_POST['UNDER_TYPE_SUB'].substr("0000".$organ_max_id,-5);
			}
			
			$this->orgmain->save($_POST);
			
			$this->orgsub->delete('organ_id',$_POST['organ_id']);
			if(isset($_POST['answer_id'])){
				foreach($_POST['answer_id'] as $key=>$item){
					$this->orgsub->save(array(
						'organ_id'=>$_POST['organ_id'],
						'question_name'=>@$_POST['question_name'][$key],
						'answer_id'=>$item,
						'other'=>$_POST['other'][$key]																
					));
				}
			}
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/welfare_state');
	}
	
	function delete($id){
		if($id){
			$this->orgmain->delete('organ_id',$id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
	
	function ajax_ampor($type = NULL)
	{
		$text = ($type == 'report') ? '-- ทุกอำเภอ --' : '- เลือกอำเภอ -';
		$result = $this->db->GetArray('select ampor_code,ampor_name as text from act_ampor where province_code = ? order by ampor_name',$_GET['q']);
        dbConvert($result);
		
        if($type == 'report' and !empty($_GET['q'])) array_unshift($result, array('ampor_code' => '', 'text' => $text));
		echo $result ? json_encode($result) : '[{"id":"","text":"'.$text.'"}]';
	}
	
	function ajax_tumbon($type=NULL)
	{
		$text = ($type == 'report') ? '-- ทุกตำบล --' : '- เลือกตำบล -';
		$result = $this->db->GetArray('select tumbon_code,tumbon_name as text from act_tumbon where province_code = ? and ampor_code = ?',array($_GET['p'],$_GET['q']));
		dbConvert($result);
        if($type == 'report' and !empty($_GET['q'])) array_unshift($result, array('tumbon_code' => '', 'text' => $text));
		echo $result ? json_encode($result) : '[{"id":"","text":"'.$text.'"}]';
	}
	
	function organ_select(){
		$data['orgmains'] = $this->orgmain->order_by('organ_id','desc')->get(FALSE,FALSE);
		$data['pagination'] = $this->orgmain->pagination();
		$this->load->view('welfare_state/organ_select',$data);
	}
}
?>