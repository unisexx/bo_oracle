<?php
class Inspect_disbursement extends Inspect_Controller
{
	public $modules_name = "inspect_disbursement";
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('inspect_disbursement_model','insp_disburse');
		$this->load->model('inspect_round/insp_round_model','round');
		$this->load->model('inspect_round/insp_round_detail_model','round_detail');
		$this->load->model('inspector_group/inspector_group_model','insp_group');
		$this->load->model('c_province_area/province_area_model','province_area');
	}
	
	function index()
	{
		// echo 'user_province_id'.login_data('user_province_id').'<br>';
		// echo 'divisionid'.login_data('divisionid');
		// $this->db->debug = true;
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$condition =(@$_GET['mt_year']==0 || isset($_GET['mt_year'])==FALSE)? "":" and mt_year =".@$_GET['mt_year'];
		$condition .=(@$_GET['province_id']==0 || isset($_GET['province_id'])==FALSE)? "":" and province_id =".@$_GET['province_id'];
		$condition .=(@$_GET['division_id']==0 || isset($_GET['division_id'])==FALSE)? "":" and division_id =".@$_GET['division_id'];
		$condition .=(@$_GET['provincearea_id']==0 || isset($_GET['provincearea_id'])==FALSE)? "":" and cnf_province_area.id =".@$_GET['provincearea_id'];
		
		if(login_data('is_inspector') == 'on'){
			if(login_data('insp_access_all') == 'on'){
				//$data['provincearealist'] = $this->province_area->get();
			}else{
				$inspect_user = $this->insp_group->get_row('users_id',login_data('id'));
				$sql = "SELECT * FROM CNF_PROVINCE_AREA
where id in (select province_area from insp_group where users_id = ".login_data("id").")";
				//$data['provincearealist'] = $this->province_area->get($sql,"true");
				$condition .= " and cnf_province_area.id in (select province_area from insp_group where users_id = ".login_data('id').")";
			}
		}else{
			$condition .= " and province_id = ".login_data('user_province_id');
			$condition .= " and division_id = ".login_data('divisionid');
		}
		
		$sql = "SELECT INSP_DISBURSEMENT.id,INSP_DISBURSEMENT.mt_year,cnf_division.title division_title,cnf_province.title province_title,insp_round_detail.round_name,cnf_province_area.id provincearea_id 
FROM INSP_DISBURSEMENT
left join cnf_division on INSP_DISBURSEMENT.division_id = cnf_division.id
left join cnf_province on INSP_DISBURSEMENT.province_id = cnf_province.id
left join cnf_province_area on cnf_province.area = cnf_province_area.id
left join insp_round_detail on INSP_DISBURSEMENT.insp_round_detail_id = insp_round_detail.id where 1=1 ".$condition.' order by id desc';
		$data['disbursement'] = $this->insp_disburse->get($sql);
		$data['pagination'] = $this->insp_disburse->pagination();
		$this->template->build('inspect_disbursement_index',$data);
	}
	
	function form($id=false){
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		if($id){
			$data['disbursement'] = $this->insp_disburse->get_row($id);
			$action_type = "VIEW";
			$action =" ดูรายละเอียดผลการเบิกจ่ายงบประมาณ ID :".$id." ".$data['disbursement']['division_title']." (จังหวัด".$data['disbursement']['province_title'].")";
			save_logfile($action_type,$action,$this->modules_name);
		}
		$data['round'] = $this->round->get(False,True);
		$this->template->build('inspect_disbursement_form',$data);
	}
	
	function select_round_ajax(){
		echo form_dropdown('insp_round_detail_id',get_option("id","round_name","insp_round_detail where round_id = ".$_POST['round_id']),'','','-- เลือกรอบการบันทึก --','0');
		echo "<span class='loading-icon2'></span>";
	}
	
	function save(){
		$url_parameter = GetCurrentUrlGetParameter();
		if($_POST){
			$_POST['budget']  = str_replace(",",'',$_POST['budget']);
			$_POST['statement']  = str_replace(",",'',$_POST['statement']);
			$_POST['subsidy']  = str_replace(",",'',$_POST['subsidy']);
			$_POST['investment']  = str_replace(",",'',$_POST['investment']);
			$_POST['other']  = str_replace(",",'',$_POST['other']);
			$_POST['target_1']  = str_replace(",",'',$_POST['target_1']);
			$_POST['total_1']  = str_replace(",",'',$_POST['total_1']);
			$_POST['percent_1']  = str_replace(",",'',$_POST['percent_1']);
			$_POST['target_2']  = str_replace(",",'',$_POST['target_2']);
			$_POST['total_2']  = str_replace(",",'',$_POST['total_2']);
			$_POST['percent_2']  = str_replace(",",'',$_POST['percent_2']);
			$_POST['target_3']  = str_replace(",",'',$_POST['target_3']);
			$_POST['total_3']  = str_replace(",",'',$_POST['total_3']);
			$_POST['percent_3']  = str_replace(",",'',$_POST['percent_3']);
			$_POST['target_4']  = str_replace(",",'',$_POST['target_4']);
			$_POST['total_4']  = str_replace(",",'',$_POST['total_4']);
			$_POST['percent_4']  = str_replace(",",'',$_POST['percent_4']);
			
			$_POST['division_id'] = ($_POST['division_id'] == "")?login_data("divisionid"):$_POST['division_id'];
			$_POST['province_id'] = ($_POST['province_id'] == "")?login_data("user_province_id"):$_POST['province_id'];
			$_POST['create_date'] = ($_POST['create_date'] == "")?now():$_POST['create_date'];
			
			$id = $this->insp_disburse->save($_POST);
			
			$result = $this->insp_disburse->get_row($id);
			if($_POST['id'] > 0){
			   	$action_type = "EDIT";
				$action = " แก้ไขข้อมูลหน่วยงาน ID :".$result['id']." ".$result['division_title']." (จังหวัด".$result['province_title'].")";
			}else{
			   	$action_type = "ADD";
				$action = " เพิ่มข้อมูลหน่วยงาน ID :".$result['id']." ".$result['division_title']." (จังหวัด".$result['province_title'].")";
			}
			save_logfile($action_type,$action,$this->modules_name);
			
			set_notify('success', lang('save_data_complete'));
		}
		redirect('inspect_disbursement/index'.$url_parameter);
	}
	
	function refresh_form(){
		//$this->db->debug = true;
		$data['disbursement'] = $this->insp_disburse->where("mt_year = ".$_POST['mt_year']." and division_id = ".$_POST['division_id']." and province_id = ".$_POST['province_id']." and insp_round_detail_id = ".$_POST['round_id'])->get_row();
		
		$data['mt_year'] = $_POST['mt_year'];
		
		$this->load->view("newForm",$data);
	}
	
	function delete($id=FALSE)
	{
		if($id){
			$url_parameter = GetCurrentUrlGetParameter();
			$result = $this->insp_disburse->get_row($id);		
			$this->insp_disburse->delete($id);
			
			$action_type="DELETE";
			$action = " ลบข้อมูลหน่วยงาน ID:".$result['id']." ".$result['division_title']." (จังหวัด".$result['province_title'].")";
			save_logfile($action_type,$action,$this->modules_name);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('inspect_disbursement/index'.$url_parameter);
	}
}
?>