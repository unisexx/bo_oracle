<?php
Class social_worker extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("supporter_main_model","supporter_main");
		$this->load->model("supporter_sub_model","supporter_sub");
		$this->load->model("specific_model","specific");
		$this->load->model("target_group_model","target_group");
		$this->load->model("organization_main_model","orgmain");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " strategic_name like '%".$_GET['search']."%'" : "";
		$data['supporters'] = $this->supporter_main->where($condition)->order_by('id','desc')->get(false,false);
		$data['pagination'] = $this->supporter_main->pagination();
		$this->template->build('social_worker/index',$data);
	}
	
	function form($id=false){
		$data['supporter'] = $this->supporter_main->get_row($id);
		$data['specifics'] = $this->specific->order_by('seq','asc')->get();
		$data['target_groups'] = $this->target_group->order_by('seq','asc')->get();
		$this->template->build('social_worker/form',$data);
	}
	
	function save(){
		// $this->db->debug = true;
		if($_POST){
			/***** รูปภาพ *****/
			fix_file($_FILES["UploadFile"]);		    
		   $_POST['file_data'] = !empty($_FILES['UploadFile']['name']) ? $this->supporter_main->upload($_FILES["UploadFile"],"uploads/act/social_worker") : $_POST['hdfilename'];
		   
		    /***** เชพฟอร์มหลัก *****/
			$id = $this->supporter_main->save($_POST);
			
			/***** ลักษณะงานที่ปฏิบัติ  *****/
			$this->supporter_sub->where("id_card = ".$_POST['id_card']." and question_name = 'specific'")->delete();
			
			// remove empty value and reindex of array
			$_POST['other'] = array_values(array_filter($_POST['other']));
			
			if(isset($_POST['specific_id'])){
				foreach($_POST['specific_id'] as $key=>$item){
					if($_POST['specific_id'][$key]){
						$this->supporter_sub->save(array(
							'id_card'=>$_POST['id_card'],
							'question_name'=>'specific',
							'answer_id'=>$item,
							'other'=>$_POST['other'][$key]
						));
					}
				}
			}
			
			/***** กลุ่มเป้าหมายที่ปฏิบัติงาน  *****/
			$this->supporter_sub->where("id_card = ".$_POST['id_card']." and question_name = 'target'")->delete();
			
			// remove empty value and reindex of array
			$_POST['other2'] = array_values(array_filter($_POST['other2']));
			
			if(isset($_POST['target_id'])){
				foreach($_POST['target_id'] as $key=>$item){
					if($_POST['target_id'][$key]){
						$this->supporter_sub->save(array(
							'id_card'=>$_POST['id_card'],
							'question_name'=>'target',
							'answer_id'=>$item,
							'other'=>$_POST['other2'][$key]
						));
					}
				}
			}
			
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/social_worker');
	}
	
	function delete($id){
		if($id){
			$this->supporter_main->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
	
	function organ_select(){
		// $this->db->debug = true;
		$condition = @$_GET['search']!='' ? " and L.ORGAN_NAME like '%".$_GET['search']."%'" : "";
		$condition .= @$_GET['budget_year']!='' ? " and F.BUDGET_YEAR = ".$_GET['budget_year'] : "";
		$condition .= @$_GET['province_code']!='' ? " and L.PROVINCE_CODE = ".$_GET['province_code'] : "";
		
		$sql = "SELECT DISTINCT
		L.ORGAN_ID,
		L.ORGAN_NAME,
		L.UNDER_TYPE_SUB,
		L.HOME_NO,
		L.O_NAME,
		L.MOO,
		L.SOI,
		L.ROAD,
		L.TUMBON_CODE,
		L.AMPOR_CODE,
		L.PROVINCE_CODE,
		L.TEL,
		L.FAX
		FROM
		ACT_ORGANIZATION_MAIN L
		LEFT JOIN ( SELECT ORG_ID,BUDGET_YEAR,PROVINCE_CODE FROM ACT_FUND_PROJECT ORDER BY ORG_ID ASC ) F 
		ON L.ORGAN_ID = F.ORG_ID
		WHERE 1=1 ".$condition;
		$data['orgmains'] = $this->orgmain->get($sql,FALSE);
		$data['pagination'] = $this->orgmain->pagination();
		$this->load->view('social_worker/organ_select',$data);
	}
}
?>