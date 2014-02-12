<?php
Class Mds_set_permission extends  Mdevsys_Controller{
	
		
	
	function __construct(){
		parent::__construct();
		$this->load->model('mds_set_permission/Mds_set_permission_model','permission');
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
			$condition .= " and ( users.name like '%".@$_GET['sch_txt']."%' 
						    or users.username like '%".@$_GET['sch_txt']."%' )";
		}
		if(@$_GET['permit_type'] != ''){
			$condition .= " and permission.mds_set_permit_id = '".@$_GET['permit_type']."' ";
		}
		
		//$this->db->debug = true;
		$sql = "select permission.* , users.name , users.email , users.tel , users.username 
				,mds_set_position.pos_name , cnf_division.title , mds_set_permit_type.permit_name
				from mds_set_permission permission
				left join users on permission.users_id = users.id
				left join mds_set_position on permission.mds_set_position_id = mds_set_position.id
				left join mds_set_permit_type on permission.mds_set_permit_type_id = mds_set_permit_type.id  
				left join cnf_division on users.divisionid = cnf_division.id 
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
			$users_id = get_one('users_id',$this->modules_name,'id',$ID);
			$users_type = get_one('mds_set_permit_type_id',$this->modules_name,'id',$ID);
			if($users_type == '1' || $users_type == '2'){
				$chk_users = "select * from mds_set_metrics_kpr where kpr_users_id = '".$users_id."' or control_users_id = '".$users_id."' ";
				$result_kpr =  $this->kpr->get($chk_users);
				$num_chk = count($result_kpr);
			}else if( $users_type == '3'){
				$chk_users = "select * from mds_set_metrics_keyer where keyer_users_id = '".$users_id."' ";
				$result_keyer =  $this->keyer->get($chk_users);
				$num_chk = count($result_keyer);
			}
			if(@$num_chk == 0){
				set_notify('error', "ลบข้อมูลเสร็จสิน");
				save_logfile("DELETE","ลบ ".$this->modules_title." ID : ".$ID." ".get_one('name', $this->modules_name2,'id',$users_id),$this->modules_name);				
				$this->permission->delete($ID);
			}else{
				set_notify('error', "ไม่สามารถลบสิทธิ์ การใช้งานได้ เนื่องจากมีข้อมูลในตั้วชี้วัด");
			}
					
		}
		
		redirect($urlpage);
	}
	function cbox_users(){
		$condition = '';
		if(@$_GET['sch_txt'] != ''){
			$condition = " AND ( name like '%".@$_GET['sch_txt']."%' 
					or username like '%".@$_GET['sch_txt']."%' )";
		}
			$sql = "select users.* 
					from users 
					where 1=1 $condition  order by id asc";
			$data['rs_users'] = $this->users->get($sql);
			$data['pagination'] = $this->users->pagination();	
		$_GET['page'] = (empty($_GET['page']))?0:($_GET['page']-1)*20;
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