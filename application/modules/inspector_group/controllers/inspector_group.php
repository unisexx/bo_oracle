<?php
class Inspector_group extends Inspect_Controller
{
	public $modules_name = "inspector_group";
	public function __construct()
	{
		parent::__construct();
		$this->load->model('inspector_group_model','inspg');
		$this->load->model('c_province_area/province_area_model','pa');
		$this->load->model('c_user/user_model','user');
		$this->load->model('c_usergroup/usertype_model','usertype');
		$this->load->model('c_usergroup/usertype_title_model','usertype_title');
	}
	
	function index()
	{
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$condition = " 1=1 ";
		$condition .= @$_GET['insp_name'] != '' ? " AND users.name LIKE '%".$_GET['insp_name']."%'": "";
		$sql = "select group.users_id,group.year,users.name from insp_group group left join users on group.users_id = users.id where ".$condition." group by year,users_id,name order by year desc";
		$data['inspectors'] = $this->inspg->get($sql,'true');
		$data['pagination'] = $this->inspg->pagination();
		$this->template->build('inspector_group_index',$data);
	}
	
	function form($id=false,$year=false){
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		
		if($id > 0){
			$data['users_id'] = $id;
			$data['insp_group'] = $this->inspg->get('select distinct(year) from insp_group where users_id = 2',TRUE);
			$data['user_id'] = $id;
			$data['user_name'] = $this->user->get_one('name',$id);
			
			$data['year'] = $year;
			
			$action_type = "VIEW";
			$action =" ดูรายละเอียดการตั้งค่ากลุ่มผู้ตรวจ ID :".$id." ".$data['user_name'];
			save_logfile($action_type,$action,$this->modules_name);
		}
		
		$this->template->build('inspector_group_form',$data);
	}
	
	function save($id=false){
		$url_parameter = GetCurrentUrlGetParameter();
		if($_POST){
			
			$user_name = $this->user->get_one('name','id',$_POST['users_id']);
			
			if($id > 0){
			   	$action_type = "EDIT";
				$action =" แก้ไขรายละเอียดการตั้งค่ากลุ่มผู้ตรวจ ID :".$_POST['users_id']." ".$user_name;
			}else{
			   	$action_type = "ADD";
				$action =" เพิ่มรายละเอียดการตั้งค่ากลุ่มผู้ตรวจ ID :".$_POST['users_id']." ".$user_name;
			}
			save_logfile($action_type,$action,$this->modules_name);
			
			if($_POST['users_id'] != 2 ){ //ภ้าไม่ใข่ administrator ไม่ต้องตั้งค่าสิทธิ์การใช้งานใหม่
				$user_type_title_id = $this->usertype_title->get_one("ID","USER_ID",$_POST['users_id']);
				if($user_type_title_id >0){					
					$data['id'] = $user_type_title_id;
					$data['title'] = $user_name;
					$data['lv'] = 1;
					$data['is_inspector'] = 'on';																
					$data['user_id'] = $_POST['users_id'];
				}else{
					$data['id'] = 0;
					$data['title'] = $user_name;
					$data['budgetadmin'] = 'off';
					$data['budgetcanaccessall'] = 'off';
					$data['lv'] = 1;
					$data['is_inspector'] = 'on';
					$data['insp_access_all'] = 'off';
					$data['mt_access_all'] = 'off';
					$data['fn_access_all'] = 'off';
					$data['user_id'] = $_POST['users_id'];
				}
					$user_type_title_id = $this->usertype_title->save($data);
					$this->db->Execute("DELETE FROM USERTYPE WHERE USERTYPETITLEID=".$user_type_title_id." AND systemname='inspect'");
					$module_5= array('',
					'inspect_save',
					'inspect_inspector_recomm',
					'inspect_project_admin',
					'inspect_member',
					'inspector_group',
					'inspect_risk_subject',
					'inspect_project_management',
					'inspect_round',
					'inspect_level',
					'inspect_report_risk',
					'inspect_log',
					'inspect_budget',
					'inspect_alert',
					'inspect_report_recomm');		
					for($i=1;$i<=14;$i++){				
						$view_stat = $i==1 || $i==2  || $i==12 || $i==14 ? "on" : "off";
						$add_stat = $i==1 || $i==2  || $i==12 ? "on" : "off";
						$edit_stat = $i==1 || $i==2  || $i==12 ? "on" : "off";
						$delete_stat = $i==1 || $i==2  || $i==12  ? "on" : "off";
						$system_id = 5;
						$system_name = "inspect";
						
						
						$sql = "INSERT INTO USERTYPE VALUES("
						.$user_type_title_id.","
						.$i.",'"
						.$view_stat."','"
						.$add_stat."','"
						.$edit_stat."','"
						.$delete_stat."',"
						.$system_id.",(select COALESCE(max(ID),0)+1 from USERTYPE ),'"
						.$system_name."','"
						.$module_5[$i]."')";
						$this->db->Execute($sql);
						}
	
						$user_type_id = $this->db->getone("SELECT ID FROM USERTYPE WHERE USERTYPETITLEID=".$user_type_title_id." AND SYSTEMNAME='bo' AND MODULENAME='inspect' ");
						
						$data = '';
						$data['usertypetitleid'] = $user_type_title_id;
						$data['id'] = $user_type_id > 0 ? $user_type_id : 0;
						$data['menuid'] = 15;
						$data['canview'] = "on" ;
						$data['canadd'] = "off";
						$data['canedit'] = "off";
						$data['candelete'] = "off";
						$data['systemid'] = 1;
						$data['systemname'] = "bo";
						$data['modulename'] = "inspect";
						$this->usertype->save($data);
				}
					
			set_notify('success', lang('save_data_complete'));
		}
		redirect('inspector_group/index'.$url_parameter);
	}
	
	function delete($id){
		if($id){
			$url_parameter = GetCurrentUrlGetParameter();
			$this->db->execute("update user_type_title set is_inspector='off' where user_id = ".$id);
			$this->inspg->where("users_id = ".$id)->delete();
			
			$user_name = $this->user->get_one('name',$id);
			$action_type="DELETE";
			$action =" ลบรายละเอียดการตั้งค่ากลุ่มผู้ตรวจ ID :".$id." ".$user_name;
			save_logfile($action_type,$action,$this->modules_name);
			
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('inspector_group/index'.$url_parameter);
	}
	
	function ajax_user(){
		$workgroupid = $_POST['workgroupid'];
		echo form_dropdown('user',get_option('id', 'name', 'users where workgroupid = '.$workgroupid),'','','--- กรุณาเลือกผู้ตรวจ ---','0');
	}
	
	function del_area_ajax(){
		if($_POST){
			$this->inspg->delete($_POST['id']);
		}
	}

	function save_provincearea(){
		if(@$_POST['province_area']!= ""){
			$this->inspg->where("users_id = ".$_POST['users_id']." and year = ".$_POST['year'])->delete();
			$provincearea = explode("|",$_POST['province_area']);
			foreach($provincearea as $item){
				$condition = "1=1";
				$condition .= $_POST['users_id'] > 0 ? " AND users_id = ".$_POST['users_id']."" : "";
				$condition .= $_POST['year'] > 0 ? " AND year = ".$_POST['year']."" : "";
				$condition .= $item > 0 ? " AND province_area = ".$item."" : "";					
				$result = $this->db->getone("SELECT ID from INSP_GROUP WHERE ".$condition);
				$_POST['province_area'] = $item;
				if(@$result<1){
					$this->inspg->save($_POST);
				}
			}
		}else{
			$this->inspg->where("users_id = ".$_POST['users_id'])->delete();
			$this->db->execute("update user_type_title set is_inspector='off' where user_id = ".$_POST['users_id']);
		}
	}
	
	function delete_provincearea(){
		$_POST['province_area'] = str_replace("|",",",$_POST['province_area']);
		$this->inspg->where("province_area IN (".$_POST['province_area'].") and users_id = ".$_POST['users_id'])->delete();
	}

}
?>