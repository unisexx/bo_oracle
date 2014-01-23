<?php
Class Mds_set_permission extends  Mdevsys_Controller{
	
		
	
	function __construct(){
		parent::__construct();
		$this->load->model('mds_set_permission/Mds_set_permission_model','permission');
		$this->load->model('mds_set_permission/users_model','users');
		
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
			$condition .= " and ( users.name like '%".@$_GET['sch_txt']."%' 
						    or users.username like '%".@$_GET['sch_txt']."%' )";
		}
		if(@$_GET['permit_type'] != ''){
			$condition .= " and permission.mds_set_permit_id = '".@$_GET['permit_type']."' ";
		}
		
		//$this->db->debug = true;
		$sql = "select permission.* , users.name , users.email , users.tel , users.username 
				,mds_set_position.pos_name , cnf_department.title , mds_set_permit_type.permit_name
				from mds_set_permission permission
				left join users on permission.users_id = users.id
				left join mds_set_position on permission.mds_set_position_id = mds_set_position.id
				left join mds_set_permit_type on permission.mds_set_permit_type_id = mds_set_permit_type.id  
				left join cnf_department on users.departmentid = cnf_department.id 
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
			
			$sql = "select permission.* , users.name , users.email , users.tel , users.username 
				,mds_set_position.pos_name , cnf_department.title , mds_set_permit_type.permit_name
				from mds_set_permission permission
				left join users on permission.users_id = users.id
				left join mds_set_position on permission.mds_set_position_id = mds_set_position.id
				left join mds_set_permit_type on permission.mds_set_permit_type_id = mds_set_permit_type.id  
				left join cnf_department on users.departmentid = cnf_department.id 
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
		   
		   if($_POST['id']>0){
		   		$_POST['UPDATE_DATE'] = date("Y-m-d");
		   		$_POST['UPDATE_BY'] = login_data('name');
		   }else{
		   		$_POST['CREATE_DATE'] = date("Y-m-d");
		   		$_POST['CREATE_BY'] = login_data('name');
		   }
		   $id = $this->permission->save($_POST);
		   
		   $update_user['id'] = $_POST['users_id'];
		   $update_user['tel'] = $_POST['tel'];
		   $update_user['email'] = $_POST['email'];
		   if($update_user['id'] != ''){
		   		$this->users->save($update_user);
		   }
		   
		   set_notify('success', lang('save_data_complete'));		   
		   if($_POST['id']>0){
		   	new_save_logfile("EDIT",$this->modules_title,$this->permission->table,"ID",$id,"pos_name",$this->modules_name);
		   	new_save_logfile("EDIT",$this->modules_title2,$this->users->table,"ID",$_POST['users_id'],"name",$this->modules_name2);
		   }else{
		   	new_save_logfile("ADD",$this->modules_title,$this->permission->table,"ID",$id,"pos_name",$this->modules_name);
		   }		   
		}
		redirect($urlpage);

	}
	function delete($ID=FALSE){
		$urlpage = $this->urlpage;		
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		
		new_save_logfile("DELETE",$this->modules_title,$this->permission->table,"ID",$ID,"pos_name",$this->modules_name);					
		$this->permission->delete($ID);		
		redirect($urlpage);
	}
	function cbox_users(){
		if(@$_GET['sch_txt'] != ''){
			$sql = "select users.* 
					from users 
					where name like '%".@$_GET['sch_txt']."%' 
					or username like '%".@$_GET['sch_txt']."%' order by id asc ";
			$data['rs_users'] = $this->users->get($sql);
			$data['pagination'] = $this->users->pagination();	
		}
		$this->load->view('_users', @$data);
	}
	function check_users(){
		if(@$_GET['permit_id'] != '' && @$_GET['users_id'] != ''){
			$sql = "select * 
					from mds_set_permission 
					where mds_set_permit_type_id = '".@$_GET['permit_id']."' 
					and users_id = '".@$_GET['users_id']."' ";
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