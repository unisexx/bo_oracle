<?php
Class Mds_set_permission extends  Mdevsys_Controller{
	
		
	
	function __construct(){
		parent::__construct();
		$this->load->model('mds_set_permission/Mds_set_permission_model','permission');
		$this->load->model('mds_set_permission/Mds_permission_id_model','permission_id');
		$this->load->model('mds_set_permission/Mds_set_permission_type_model','permission_type');
		$this->load->model('mds_set_permission/Mds_set_permission_dtl_model','permission_dtl');
		$this->load->model('mds_set_permission/users_model','users');
		
		$this->load->model('mds_set_indicator/Mds_set_metrics_kpr_model','kpr');
		$this->load->model('mds_set_indicator/Mds_set_metrics_keyer_model','keyer');
		
	}
	
	public $urlpage = "mds_set_permission";
	public $modules_name = "mds_set_permission";
	public $modules_title = " สิทธิ์การใช้ระบบ SAR CARD";
	
	public $modules_name2 = "users";
	public $modules_title2 = " ละเอียดข้อมูลผู้ใช้ ";
	
	function index(){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		$condition = " 1=1 ";
		if(@$_GET['sch_txt'] != ''){
			$condition .= " and ( permission.name like '%".@$_GET['sch_txt']."%' 
						    or permission.username like '%".@$_GET['sch_txt']."%' )";
		}
		if(@$_GET['permit_type'] != ''){
			$condition .= " and permission.mds_set_permit_id = '".@$_GET['permit_type']."' ";
		}
		
		//$this->db->debug = true;
		$sql = "select permission.users_id,permission.id, 
				mds_set_permission_dtl.name,mds_set_permission_dtl.username
				,mds_set_position.pos_name , cnf_division.title 
				from mds_set_permission permission
				left join mds_set_permission_dtl on permission.id = mds_set_permission_dtl.mds_set_permission_id
				left join mds_set_position on mds_set_permission_dtl.mds_set_position_id = mds_set_position.id
				left join cnf_division on mds_set_permission_dtl.divisionid = cnf_division.id 
				where $condition order by permission.id asc ";
		
		$data['rs'] = $this->permission->get($sql);
		$data['pagination']=$this->permission->pagination();
		$this->template->build('index',@$data);

	}
	function form($id=null){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		if($id != ''){
			
			$sql = "select permission.users_id as permission_users_id,permission.id as permission_id 
				,mds_set_permission_dtl.*
				,mds_set_position.pos_name  
				from mds_set_permission permission
				left join mds_set_permission_dtl on permission.id = mds_set_permission_dtl.mds_set_permission_id
				left join mds_set_position on mds_set_permission_dtl.mds_set_position_id = mds_set_position.id
				where permission.id = '".$id."' order by permission.id asc ";
			
			$data['rs'] = $this->permission->get($sql);
			$data['rs'] = @$data['rs']['0'];
		}
		$this->template->build('form',@$data);

	}
	function save(){
		
		$urlpage = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		if($_POST){
		   
		   if($_POST['id'] > '0'){
		   		$_POST['UPDATE_DATE'] = date("Y-m-d");
		   		$_POST['UPDATE_BY'] = login_data('name');
				$id = $this->permission->save($_POST);
		   }else{
		   	
		   		$_POST['CREATE_DATE'] = date("Y-m-d");
		   		$_POST['CREATE_BY'] = login_data('name');
		   		$_POST['id'] = ($this->db->getone("SELECT MAX(NUM_ID) FROM MDS_PERMISSION_ID"))+1;
		   		$update_id['id'] = 1;
		   		$update_id['num_id'] = $_POST['id'];
		   		$this->permission_id->save($update_id);
		   		
		   		$id = $this->permission->save($_POST,true);
		   }
		 
		   
		   
		   $permit_dtl['id'] = $_POST['dtl_id'];
		   $permit_dtl['mds_set_permission_id'] = $id;
		   $permit_dtl['name'] = $_POST['name'];
		   $permit_dtl['username'] = $_POST['username'];
		   $permit_dtl['firstname'] = $_POST['firstname'];
		   $permit_dtl['lastname'] = $_POST['lastname'];
		   $permit_dtl['departmentid'] = $_POST['departmentid'];
		   $permit_dtl['divisionid'] = $_POST['divisionid'];
		   $permit_dtl['department_name'] = $_POST['department_name'];
		   $permit_dtl['division_name'] = $_POST['division_name'];
		   $permit_dtl['email'] = $_POST['email'];
		   $permit_dtl['tel'] = $_POST['tel'];
		   $permit_dtl['mds_set_position_id'] = $_POST['mds_set_position_id'];
		   $this->permission_dtl->save($permit_dtl);
		   
		   $this->permission_type->where("mds_set_permission_id = '".$id."'")->delete();
		   for ($i=0; $i <= count(@$_POST['mds_set_permit_type_id']); $i++) { 
			   if(@$_POST['mds_set_permit_type_id'][$i] != ''){
			   		$permit['MDS_SET_PERMISSION_ID'] = $id;
			   		$permit['MDS_SET_PERMIT_TYPE_ID'] = $_POST['mds_set_permit_type_id'][$i];
			   		$this->permission_type->save($permit);
			   }
		   }
		   
		   set_notify('success', lang('save_data_complete'));		   
		   if($_POST['id']>0){
		    save_logfile("EDIT","แก้ไข ".$this->modules_title." ID : ".$id." ".get_one('name', $this->modules_name2,'id',$_POST['users_id']),$this->modules_name);
		   	//new_save_logfile("EDIT",$this->modules_title,$this->permission->table,"ID",$id,$_POST['users_id'],"name",$this->modules_name2);
		   	//new_save_logfile("EDIT",$this->modules_title2,$this->users->table,"ID",$_POST['users_id'],"name",$this->modules_name2);
		   }else{
		   	save_logfile("ADD","เพิ่ม ".$this->modules_title." ID : ".$id." ".get_one('name', $this->modules_name2,'id',$_POST['users_id']),$this->modules_name);
		   	//new_save_logfile("ADD",$this->modules_title,$this->permission->table,"ID",$id,$_POST['users_id'],"name",$this->modules_name2);
		   }		   
		}
		redirect($urlpage);

	}
	function delete($ID=FALSE){
		$urlpage = $this->urlpage;		
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		
		if($ID != ''){		
				set_notify('error', "ลบข้อมูลเสร็จสิน");
				save_logfile("DELETE","ลบ ".$this->modules_title." ID : ".$ID." ".get_one('name', $this->modules_name2,'id',$users_id),$this->modules_name);				
				$this->permission->delete($ID);	
				$this->permission_type->where("mds_set_permission_id = '".$ID."'")->delete();		
		}
		
		redirect($urlpage);
	}
	function cbox_users(){
		$condition = '';
		if(@$_GET['sch_txt'] != ''){
			$condition = " AND ( name like '%".@$_GET['sch_txt']."%' 
					or username like '%".@$_GET['sch_txt']."%' )";
		}
			$sql = "select users.* ,cnf_division.title as division_name ,cnf_department.title as department_name
					from users 
					left join cnf_division on users.divisionid = cnf_division.id 
					left join cnf_department on users.departmentid = cnf_department.id
					where 1=1 $condition  order by id asc";
			$data['rs_users'] = $this->users->get($sql);
			$data['pagination'] = $this->users->pagination();	
		$_GET['page'] = (empty($_GET['page']))?0:($_GET['page']-1)*20;
		$this->load->view('_users', @$data);
	}
	function check_users(){
		if(@$_GET['users_id'] != ''){
			$sql = "select * 
					from mds_set_permission   
					where users_id = '".@$_GET['users_id']."' ";
			$chk = $this->permission->get($sql);
			$num_row = count($chk);
			if($num_row > 0){
				if(@$_GET['id'] == @$chk['0']['id']){
					echo 'true';
				}else{
					echo 'false';
				}
				
			}else{
				echo 'true';
			}
		}else{
			echo 'true';
		}
		
	}
	
	
}
?>