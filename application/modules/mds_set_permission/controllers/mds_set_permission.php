<?php
Class Mds_set_permission extends  Mdevsys_Controller{
	
		
	
	function __construct(){
		parent::__construct();
		$this->load->model('mds_set_permission/mds_set_permission_model','permission');
		$this->load->model('mds_set_permission/mds_permission_id_model','permission_id');
		$this->load->model('mds_set_permission/mds_set_permission_type_model','permission_type');
		$this->load->model('mds_set_permission/mds_set_permission_dtl_model','permission_dtl');
		$this->load->model('mds_set_permission/users_model','users');
		
		$this->load->model('mds_set_indicator/mds_set_metrics_kpr_model','kpr');
		$this->load->model('mds_set_indicator/mds_set_metrics_keyer_model','keyer');
		
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
		if(@$_GET['premit_type'] != ''){
			$condition .= " and permission.mds_set_permit_type_id = '".@$_GET['premit_type']."' ";
		}
		
		//$this->db->debug = true;
		$sql = "select permission.users_id,permission.id, 
				users.name,users.username
				,mds_set_position.pos_name , cnf_division.title ,mds_set_permit_type.permit_name
				from mds_set_permission permission
				join users on permission.users_id = users.id
				left join cnf_division on users.divisionid = cnf_division.id 
				left join cnf_department on users.departmentid = cnf_department.id 
				left join mds_set_position on permission.mds_set_position_id = mds_set_position.id
				left join mds_set_permit_type on permission.mds_set_permit_type_id = mds_set_permit_type.id
				where $condition order by permission.id desc ";
		
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
					,permission.mds_set_permit_type_id,permission.mds_set_position_id,users.*,mds_set_position.pos_name  
					from mds_set_permission permission
					left join users on permission.users_id = users.id
					left join mds_set_position on permission.mds_set_position_id = mds_set_position.id
					where permission.id = '".$id."' order by permission.id desc ";
			
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
		   $this->db->debug = true;
		   if($_POST['id'] > '0'){
		   		$_POST['UPDATE_BY'] = login_data('name');
				$id = $this->permission->save($_POST);
		   }else{
		   	
		   		$_POST['CREATE_BY'] = login_data('name');
		   		$id = $this->permission->save($_POST);
		   }
		 /*
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
		   //for ($i=0; $i <= count(@$_POST['mds_set_permit_type_id']); $i++) { 
			   if(@$_POST['mds_set_permit_type_id'] != ''){
			   		$permit['MDS_SET_PERMISSION_ID'] = $id;
			   		$permit['MDS_SET_PERMIT_TYPE_ID'] = $_POST['mds_set_permit_type_id'];
			   		$this->permission_type->save($permit);
			   }
		  // }
		   */
		   if($_POST['email'] != ''){
		   		$users_update_email['id'] = $_POST['users_id'];
				$users_update_email['email'] = $_POST['email'];
				$this->users->save($users_update_email);
		   }else if($_POST['tel'] != ''){
		   		$users_update_tel['id'] = $_POST['users_id'];
				$users_update_tel['tel'] = $_POST['tel'];
				$this->users->save($users_update_tel);
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
		//redirect($urlpage);

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
					left join user_type_title on users.id = user_type_title.user_id
					join usertype on  user_type_title.id = usertype.usertypetitleid 
									   and usertype.systemid = '7' and usertype.menuid = '1'
					where 1=1 $condition  order by users.id asc";
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