<?php
class c_province extends Admin_Controller
{
	public $modules_name = "c_province";
	public $modules_title = "ข้อมูลจังหวัด";
	function __construct()
	{
		parent::__construct();
		$this->load->model('province_model','province');
		$this->load->model('province_detail_zone_model','province_detail_zone');
		$this->load->model('c_province_zone/province_zone_model','province_zone');
		$this->load->model('c_province_group/province_group_model','province_group');
		$this->load->model('c_province_area/province_area_model','province_area');
		$this->load->model('c_province_zone_type/province_zone_type_model','province_zone_type');			
	}
	
	function index()
	{
		//$this->db->debug = true;
		if(!permission($this->modules_name,'canview'))redirect('c_front');
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$condition = "1=1";	
		$condition .= @$_GET['txtsearch']!='' ? " AND TITLE LIKE '%".$_GET['txtsearch']."%' " : "";
		$condition .= @$_GET['group']>0 ? " AND PGROUP=".$_GET['group'] : "";
		$condition .= @$_GET['area']>0 ? " AND AREA=".$_GET['area'] : "";
		$sql = @$_GET['zone']!='' ?  "SELECT * FROM CNF_PROVINCE WHERE ID IN (SELECT PROVINCEID FROM CNF_PROVINCE_DETAIL_ZONE WHERE zoneid=".$_GET['zone'].") AND ".$condition : FALSE;	
		$data['result']= $this->province->where($condition)->get($sql);
		$data['pagination'] = $this->province->pagination();		
		$data['zonetype'] = $this->province_zone_type->get(FALSE,TRUE);
		$this->template->build('province_index',$data);		
	}
	
	function form($ID=FALSE){
		//$this->db->debug = true;
		if(!permission($this->modules_name,'canview'))redirect('c_front');
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		@$data['row']= $this->province->get_row($ID);	
		$data['zonetype'] = $this->province_zone_type->get(FALSE,TRUE);	
		
		if($ID>0){
			$action_type = "VIEW";
			$action = get_logaction($action_type).$this->modules_title." ID:".$ID." ".$data['row']['title'];
			save_logfile($action_type,$action,$this->modules_name);
		}
		
		$this->template->build('province_form',$data);
	}
	
	function save(){
		//$this->db->debug = true;
		$url_parameter = GetCurrentUrlGetParameter();
		if($_POST){

			if($_POST['id']>0)
		   {
		   		if(!permission($this->modules_name,'canedit'))redirect('c_front');
				
			   $provinceid = $this->province->save($_POST);		   
			   $this->province_detail_zone->delete('provinceid',$provinceid);
				if(isset($_POST['zoneid'])){
					foreach($_POST['zoneid'] as $key=>$item){
						if($_POST['zoneid'][$key]){
							$this->province_detail_zone->save(array(
								'provinceid'=>$provinceid,
								'zoneid'=>$_POST['zoneid'][$key]							
							));
						}
					}	
				}


				$action_type = "EDIT";
				$action = get_logaction($action_type).$this->modules_title." ID:".$provinceid." ".$_POST['title'];
				save_logfile($action_type,$action,$this->modules_name);				
		   }else{
		   	   	
		   	   if(!permission($this->modules_name,'canadd'))redirect('c_front');
				
			   $provinceid = $this->province->save($_POST);		   
			   $this->province_detail_zone->delete('provinceid',$provinceid);
				if(isset($_POST['zoneid'])){
					foreach($_POST['zoneid'] as $key=>$item){
						if($_POST['zoneid'][$key]){
							$this->province_detail_zone->save(array(
								'provinceid'=>$provinceid,
								'zoneid'=>$_POST['zoneid'][$key]							
							));
						}
					}	
				}
				
				$action_type = "ADD";
				$action = get_logaction($action_type).$this->modules_title." ID:".$provinceid." ".$_POST['title'];
				save_logfile($action_type,$action,$this->modules_name);
		   }							
		   set_notify('success', lang('save_data_complete'));
		}
		redirect('c_province/index'.$url_parameter);
	}
	function delete($ID=FALSE,$PAGE=FALSE){
		$url_parameter = GetCurrentUrlGetParameter();						
		if(!permission($this->modules_name,'candelete'))redirect('c_province');			
		$result = $this->province->get_row($ID);
		$this->province->delete($ID);
		$action_type = "DELETE";
		$action = get_logaction($action_type).$this->modules_title." ID:".$ID." ".$result['title'];		
		redirect('c_province/index'.$url_parameter);
	}
	function select_zone()
	{
		$zone_type_id = @$_POST['zone_type_id'];
		if($zone_type_id>0)
		{
			$result = $this->province_zone->where(" zone_type_id=".$zone_type_id)->get(FALSE,TRUE);
			echo "<select name=\"zone\">";
					echo "<option value=\"\">-- เลือกภาค --</option>";
				foreach($result as $item):
					echo "<option value=\"".$item['id']."\">".$item['title']."</option>";
				endforeach;
			echo "</select>";
		}
	}
	function select_province_from_area(){
		$provincearea = @$_POST['provincearea'];
		$condition = $provincearea>0 ? " AREA =".$provincearea : "";					
		$result = $this->province->where($condition)->get(FALSE,TRUE);
			echo "<select name=\"provinceid\">";
					echo "<option value=\"\">-- เลือกจังหวัด --</option>";
				foreach($result as $item):
					echo "<option value=\"".$item['id']."\">".$item['title']."</option>";
				endforeach;
			echo "</select>";
	}
}
?>