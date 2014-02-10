<?php
Class Welfare extends  Act_Controller{
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
	}
	
	function index(){
		// Report all PHP errors
		// error_reporting(-1);
		$sql = "SELECT
		ACT_ORGANIZATION_MAIN.ORGAN_ID,
		ACT_ORGANIZATION_MAIN.ORGAN_NAME,
		ACT_ORGANIZATION_MAIN.UNDER_TYPE_SUB,
		ACT_ORGANIZATION_MAIN.O_NAME,
		ACT_ORGANIZATION_MAIN.HOME_NO,
		ACT_ORGANIZATION_MAIN.MOO,
		ACT_ORGANIZATION_MAIN.SOI,
		ACT_ORGANIZATION_MAIN.ROAD,
		ACT_PROVINCE.PROVINCE_NAME,
		ACT_AMPOR.AMPOR_NAME,
		ACT_TUMBON.TUMBON_NAME,
		ACT_ORGANIZATION_MAIN.TEL,
		ACT_ORGANIZATION_MAIN.FAX
		FROM
		ACT_ORGANIZATION_MAIN
		INNER JOIN ACT_PROVINCE ON ACT_ORGANIZATION_MAIN.PROVINCE_CODE = ACT_PROVINCE.PROVINCE_CODE
		INNER JOIN ACT_AMPOR ON ACT_ORGANIZATION_MAIN.AMPOR_CODE = ACT_AMPOR.AMPOR_CODE AND ACT_PROVINCE.PROVINCE_CODE = ACT_AMPOR.PROVINCE_CODE
		INNER JOIN ACT_TUMBON ON ACT_ORGANIZATION_MAIN.TUMBON_CODE = ACT_TUMBON.TUMBON_CODE AND ACT_PROVINCE.PROVINCE_CODE = ACT_TUMBON.PROVINCE_CODE AND ACT_AMPOR.AMPOR_CODE = ACT_TUMBON.AMPOR_CODE
		ORDER BY
		ACT_ORGANIZATION_MAIN.ORGAN_ID DESC";
		$data['orgmains'] = $this->orgmain->get($sql,FALSE);
		$data['pagination'] = $this->orgmain->pagination();
		$this->template->build('welfare/index',$data);
	}
	
	function form($id=false){
		$data['services'] = $this->service->order_by('service_id','asc')->get(FALSE,TRUE);
		$data['target_groups'] = $this->target_group->order_by('target_id','asc')->get(FALSE,TRUE);
		$data['processes'] = $this->process->order_by('process_id','asc')->get(FALSE,TRUE);
		$data['formats'] = $this->format->order_by('format_id','asc')->get(FALSE,TRUE);
		$data['methods'] = $this->method->order_by('method_id','asc')->get(FALSE,TRUE);
		$data['service_types'] = $this->service_type->order_by('service_type_id','asc')->get(FALSE,TRUE);
		$data['promotes'] = $this->promote->order_by('promote_id','asc')->get(FALSE,TRUE);
		$data['promote_gets'] = $this->promote_get->order_by('promote_get_id','asc')->get(FALSE,TRUE);
		$data['pcommunities'] = $this->pcommunity->order_by('pcommunity_id','asc')->get(FALSE,TRUE);
		$data['scommunities'] = $this->scommunity->order_by('scommunity_id','asc')->get(FALSE,TRUE);
		$this->template->build('welfare/form',$data);
	}
	
	function save(){
		if($_POST){
			$this->db->debug = true;
			$_POST['create_date'] = date("Y-m-d H:i:s");
			$this->orgmain->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/welfare');
	}
	
	// function delete($id){
		// if($id){
			// $this->affiliate->delete($id);
			// set_notify('success', lang('delete_data_complete'));
		// }
		// redirect($_SERVER["HTTP_REFERER"]);
	// }
	
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
		$result = $this->db->GetArray('select tumbon_code,tumbon_name as text from act_tumbon where ampor_code = ?',$_GET['q']);
		dbConvert($result);
        if($type == 'report' and !empty($_GET['q'])) array_unshift($result, array('tumbon_code' => '', 'text' => $text));
		echo $result ? json_encode($result) : '[{"id":"","text":"'.$text.'"}]';
	}
}
?>