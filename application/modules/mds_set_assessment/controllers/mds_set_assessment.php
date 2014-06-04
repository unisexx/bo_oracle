<?php
Class Mds_set_assessment extends  Mdevsys_Controller{
	
		
	
	function __construct(){
		parent::__construct();
		$this->load->model('mds_set_assessment/mds_set_assessment_model','assessment');
		$this->load->model('mds_set_indicator/mds_set_metrics_model','metrics');
	}
	
	public $urlpage = "mds_set_assessment";
	public $modules_name = "mds_set_assessment";
	public $modules_title = " หัวข้อประเด็นการประเมินผล";
	
	function index(){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		
		$data['option_status'] = array('1'=>'เปิดใช้งาน','0'=>'ปิดใช้งาน','all'=>'แสดงทั้งหมด');
		(@$_GET['sch_status_id'] == '')?$_GET['sch_status_id'] = 1:$_GET['sch_status_id'] = $_GET['sch_status_id'];
		$condition = " 1=1 ";
		if(@$_GET['sch_txt'] != ''){
			$condition .= " and ass_name like '%".@$_GET['sch_txt']."%' ";
		}
		if(@$_GET['sch_status_id'] !='all'){
			$condition .= " and status_id = '".@$_GET['sch_status_id']."' ";
		}
		
		$data['rs'] = $this->assessment->where($condition)->get();
		$data['pagination']=$this->assessment->pagination();
		$this->template->build('index',@$data);

	}
	function form($id=null){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		if($id != ''){
			$chk_metrics = "select * from mds_set_metrics where mds_set_assessment_id = '".$id."'";
			$result_chk_metrics =  $this->metrics->get($chk_metrics);
			$num_chk = count($result_chk_metrics);
			if($num_chk == '0'){
				$data['rs'] = $this->assessment->get_row($id);
			}else{
				set_notify('error', "ไม่สามารถแก้ไขหัวข้อประเด็นการประเมินผลได้ เนื่องจากมีการใช้หัวข้อประเด็นการประเมินผลนี้อยู่");
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
		   $id = $this->assessment->save($_POST);
		   set_notify('success', lang('save_data_complete'));		   
		   if($_POST['id']>0){
		    
		   	new_save_logfile("EDIT",$this->modules_title,$this->assessment->table,"ID",$id,"ass_name",$this->modules_name);
		   }else{
		   	new_save_logfile("ADD",$this->modules_title,$this->assessment->table,"ID",$id,"ass_name",$this->modules_name);
		   }		   
		}
		redirect($urlpage);

	}
	function delete($ID=FALSE){
		$urlpage = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		if($ID != ''){
				$chk_metrics = "select * from mds_set_metrics where mds_set_assessment_id = '".$ID."'";
				$result_chk_metrics =  $this->metrics->get($chk_metrics);
				echo $num_chk = count($result_chk_metrics);
			if($num_chk == '0'){
				new_save_logfile("DELETE",$this->modules_title,$this->assessment->table,"ID",$ID,"ass_name",$this->modules_name);					
				$this->assessment->delete($ID);	
				set_notify('error', 'ลบข้อมูลเสร็จสิน');		
			}else{
			    set_notify('error', "ไม่สามารถลบหัวข้อประเด็นการประเมินผลได้ เนื่องจากมีการใช้หัวข้อประเด็นการประเมินผลนี้อยู่");
			}
		}	
		redirect($urlpage);
	}
	function check_ass_name(){
		if(@$_GET['ass_name'] != '' ){
			$sql = "select * 
					from mds_set_assessment 
					where ass_name = '".@$_GET['ass_name']."' ";
			$chk = $this->assessment->get($sql);
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
			$id = $this->assessment->save($update_status);
			new_save_logfile("EDIT สถานะการใช้งาน",$this->modules_title,$this->assessment->table,"ID",$id,"ass_name",$this->modules_name);
			
			$item = $this->assessment->get_row($id);
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