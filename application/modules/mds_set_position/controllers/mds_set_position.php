<?php
Class Mds_set_position extends  Mdevsys_Controller{
	
		
	
	function __construct(){
		parent::__construct();
		$this->load->model('mds_set_position/mds_set_position_model','position');
		$this->load->model('mds_set_permission/mds_set_permission_model','permission');
		$this->load->model('mds_set_permission/mds_set_permission_dtl_model','permission_dtl');
	}
	
	public $urlpage = "mds_set_position";
	public $modules_name = "mds_set_position";
	public $modules_title = " ตำแหน่งสายบริหาร";
	
	function index(){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		
		$data['option_status'] = array('1'=>'เปิดใช้งาน','0'=>'ปิดใช้งาน','all'=>'แสดงทั้งหมด');
		(@$_GET['sch_status_id'] == '')?$_GET['sch_status_id'] = 1:$_GET['sch_status_id'] = $_GET['sch_status_id'];
		$condition = " 1=1 ";
		if(@$_GET['sch_txt'] != ''){
			$condition .= " and pos_name like '%".@$_GET['sch_txt']."%' ";
		}
		if(@$_GET['sch_status_id'] !='all'){
			$condition .= " and status_id = '".@$_GET['sch_status_id']."' ";
		}
		
		$data['rs'] = $this->position->where($condition)->get();
		$data['pagination']=$this->position->pagination();
		$this->template->build('index',@$data);

	}
	function form($id=null){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		
		if($id != ''){
				$chk_position = "select * from mds_set_permission where mds_set_position_id = '".$id."'";
				$result_chk_position =  $this->permission_dtl->get($chk_position);
				$num_chk = count($result_chk_position);
			if($num_chk == '0'){
				$data['rs'] = $this->position->get_row($id);
			}else{
				set_notify('error', "ไม่สามารถแก้ไขตำแหน่งสายบริหารได้ เนื่องจากมีการใช้ชื่อตำแหน่งสายบริหารนี้อยู่");
				redirect($data['urlpage']);
			}	
		}
		$this->template->build('form',@$data);

	}
	function save(){
		$urlpage = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		
		if($_POST){
						
		   $id = $this->position->save($_POST);
		   set_notify('success', lang('save_data_complete'));		   
		   if($_POST['id']>0){
		   	new_save_logfile("EDIT",$this->modules_title,$this->position->table,"ID",$id,"pos_name",$this->modules_name);
		   }else{
		   	new_save_logfile("ADD",$this->modules_title,$this->position->table,"ID",$id,"pos_name",$this->modules_name);
		   }		   
		}
		redirect($urlpage);

	}
	function delete($ID=FALSE){
		$urlpage = $this->urlpage;		
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		if($ID != ''){
				$chk_permission = "select * from mds_set_permission where mds_set_position_id = '".$ID."'";
				$result_chk_permission =  $this->permission->get($chk_permission);
				$num_chk = count($result_chk_permission);
				if($num_chk == '0'){
					new_save_logfile("DELETE",$this->modules_title,$this->position->table,"ID",$ID,"pos_name",$this->modules_name);					
					$this->position->delete($ID);
					set_notify('error', 'ลบข้อมูลเสร็จสิน');	
				}else{
					set_notify('error', "ไม่สามารถลบตำแหน่งสายบริหารได้ เนื่องจากมีการใช้ชื่อตำแหน่งสายบริหารนี้อยู่");
				}
					
		}
		
		redirect($urlpage);
	}
	function check_pos_name(){
		if(@$_GET['pos_name'] != '' ){
			$sql = "select * 
					from mds_set_position 
					where pos_name = '".@$_GET['pos_name']."' ";
			$chk = $this->position->get($sql);
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
	
	public function change_status(){
		$data = '';
		if(@$_GET['ref_id'] != ''){
			$update_status['id'] = $_GET['ref_id'];
			$update_status['status_id'] = @$_GET['status_id'];
			$id = $this->position->save($update_status);
			new_save_logfile("EDIT สถานะการใช้งาน",$this->modules_title,$this->position->table,"ID",$id,"pos_name",$this->modules_name);
			
			$item = $this->position->get_row($id);
			$id = $item['id'];
			$check = '';
			if($item['status_id'] == '1'){
				$check = 'checked="checked"';
			}
			$data = '<input type="checkbox" name="status_id['.$id.']" value="1" class="change_status" ref_id="'.$id.'"'.$check.'data-on-label="เปิด" data-off-label="ปิด" />';
		}	
		//$this->load->view('mds_set_measure/_status',@$data);
		echo $data;
	}
}
?>