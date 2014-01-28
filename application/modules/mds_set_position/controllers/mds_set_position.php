<?php
Class Mds_set_position extends  Mdevsys_Controller{
	
		
	
	function __construct(){
		parent::__construct();
		$this->load->model('mds_set_position/Mds_set_position_model','position');
		
	}
	
	public $urlpage = "mds_set_position";
	public $modules_name = "mds_set_position";
	public $modules_title = " ตำแหน่งสายบริหาร";
	
	function index(){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		
		$condition = " 1=1 ";
		if(@$_GET['sch_txt'] != ''){
			$condition .= " and pos_name like '%".@$_GET['sch_txt']."%' ";
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
			$data['rs'] = $this->position->get_row($id);
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
		
		new_save_logfile("DELETE",$this->modules_title,$this->position->table,"ID",$ID,"pos_name",$this->modules_name);					
		$this->position->delete($ID);		
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
}
?>