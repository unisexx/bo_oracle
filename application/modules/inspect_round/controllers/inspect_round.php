<?php
Class Inspect_round extends Inspect_Controller
{
	public $modules_name = "inspect_round";
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('insp_round_model','round');
		$this->load->model('insp_round_detail_model','detail');
		
	}
	
	function index()
	{
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$round_name=(@$_GET['round_name']!="")? " and round_name LIKE '%".@$_GET['round_name']."%'":"";
		$mtyear=(@$_GET['mtyear']=="0" || isset($_GET['mtyear'])==FALSE)? "":" and mt_year =".@$_GET['mtyear'];	
		$data['result']=$this->round->select("insp_round.mt_year as mt_year,insp_round.id as id,insp_round_detail.round_name as round_name")
									->join("left join insp_round_detail on insp_round.id=insp_round_detail.round_id")->where("1=1".$round_name.$mtyear)->get();	
		$data['pagination']=$this->round->pagination();
		$this->template->build('inspect_round_index',$data);
	}
	
	function form($id=FALSE)
	{
		$data['url_parameter'] = GetCurrentUrlGetParameter();
	    if($id){
	    	$data['mt_year']=$this->round->get_one("mt_year",$id);	    		   	
	    	$data['result']=$this->detail->where("round_id=$id")->get();
			$data['id']=$id;
			$data['condition'] = " where mt_year <> ".$data['mt_year'];
		 }else{
		 	$data['result']="";
		 }
		$data['pagination']=$this->round->pagination();	
		
		$action_type = "VIEW";
		$action =" ดูรายละเอียดการตั้งค่ากำหนดรอบ ID :".$id." ปี ".($data['mt_year']+543);
		save_logfile($action_type,$action,$this->modules_name);
			
		$this->template->build('inspect_round_form',$data);
	}
	
	function save()
	{
		$url_parameter = GetCurrentUrlGetParameter();
		if($_POST)
		{	
			$id=$this->round->save(array('id'=>$_POST['id'],'mt_year'=>$_POST['mtyear']));
			$this->detail->delete("round_id",$id);
			foreach($_POST['round_name'] as $key => $value){
				$this->detail->save(array('round_id'=>$id,'round_name'=>$value,'roundindex'=>$key+1));
			}
			
			if($_POST['id'] > 0){
			   	$action_type = "EDIT";
				$action =" แก้ไขรายละเอียดการตั้งค่ากำหนดรอบ ID :".$id." ปี ".($_POST['mtyear']+543);
			}else{
			   	$action_type = "ADD";
				$action =" เพิ่มรายละเอียดการตั้งค่ากำหนดรอบ ID :".$id." ปี ".($_POST['mtyear']+543);
			}
			save_logfile($action_type,$action,$this->modules_name);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('inspect_round/index'.$url_parameter);
	}
	
	function delete()
	{
		$url_parameter = GetCurrentUrlGetParameter();
		if($_GET['id']){
			$result = $this->detail->get_row($id);		
			
			$this->detail->delete("round_id",$_GET['id']);
			$this->round->delete($_GET['id']);
			
			$action_type="DELETE";
			$action =" ลบรายละเอียดการตั้งค่ากำหนดรอบ ID :".$result['id']." ปี ".($result['mtyear']+543);
			save_logfile($action_type,$action,$this->modules_name);
			
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('inspect_round/index'.$url_parameter);
	}
	
}
?>