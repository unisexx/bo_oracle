<?php
class Fund_contract extends Fund_Controller{
	public $modules_name = "fund_contract";
	public function __construct(){
		parent::__construct();
		$this->load->model('fund_contract_model','contract');
		$this->load->model('fund_attach_model','attach');
		$this->load->model('fund_attorney/fund_attorney_model','attorney');
		$this->load->model('inspect_project_management/insp_project_model','insp_project');
	}
	
	function index(){
		$start_date=(@$_GET['start_date'])?strtotime((date_to_mysql(@$_GET['start_date'],TRUE))." 00:00:00"):"0000000000";
		$end_date=(@$_GET['end_date'])?strtotime((date_to_mysql(@$_GET['end_date'],TRUE))." 23:59:59"):"9999999999";
		
		$condition = " 1=1 ";
		$condition .= @$_GET['project']!=""?" and project like '%".@$_GET['project']."%'":"";
		$condition .= @$_GET['type']!=""?" and type = '".@$_GET['type']."'":"";
		$condition .= " and made_date BETWEEN ".$start_date." AND ".$end_date." ";
		
		$data['contract'] = $this->contract->where($condition)->order_by('id','desc')->get();
		$data['pagination'] = $this->contract->pagination();
		$this->template->build('contract_index',$data);
	}
	
	function form($id=false){
		$data['attorney'] = $this->attorney->get();
		$data['contract'] = $this->contract->get_row($id);
		if($id!=""){
			$data['attach'] = $this->attach->where("module = 'fund_contract' and module_id = ".$id)->get();
			
			$action_type = "VIEW";
			$action =" ดูสัญญารับเงินอุดหนุน ". $data['contract']['project'];
			save_logfile($action_type,$action,$this->modules_name);
		}
		$this->template->build('contract_form',$data);
	}
	
	function save(){
		if($_POST){
			$_POST['made_date'] = ($_POST['made_date'] == '')?'':th_to_stamp($_POST['made_date']);
			$_POST['order_date'] = ($_POST['order_date'] == '')?'':th_to_stamp($_POST['order_date']);
			$_POST['approve_date'] = ($_POST['approve_date'] == '')?'':th_to_stamp($_POST['approve_date']);
			
			$id = $this->contract->save($_POST);
			
			// ไฟล์แนบ ------------
			fix_file($_FILES["attach"]);
			foreach($_FILES["attach"] as $key => $item)
			{
				if($item)
				{
					if($_FILES['attach'][$key]['name'])
					{
						$this->attach->save(array('MODULE_ID'=>$id											
												 ,'MODULE'=>'fund_contract'
												,'ATTACH_NAME'=>$this->attach->upload($_FILES["attach"][$key],'uploads/fund_contract/')));
					}		
				}
			}
		
			$attorney_name = $this->attorney->where("name = '".$_POST['funding_name']."'")->get();
			if(empty($attorney_name)){
				$this->attorney->save(array('NAME'=>$_POST['funding_name']));
			}
			
			if($_POST['id'] > 0){
			   	$action_type = "EDIT";
				$action =" แก้ไขสัญญารับเงินอุดหนุน ".$_POST['project'];
			}else{
			   	$action_type = "ADD";
				$action =" เพิ่มสัญญารับเงินอุดหนุน ".$_POST['project'];
			}
			save_logfile($action_type,$action,$this->modules_name);
			
			set_notify('success', lang('delete_data_complete'));
		}
		$url_parameter = GetCurrentUrlGetParameter();
		redirect('fund_contract/'.$url_parameter);
	}
	
	function delete($id){
		if($id){
			$this->contract->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('fund_contract/index'.$url_parameter);
	}
	
	function download_file($id)
	{
		$this->load->helper('download');	
		$file= $this->attach->get_one('attach_name',$id);	
		$data =file_get_contents("uploads/fund_contract/".$file);	
		$name =$file;	
		
		force_download($name, $data); 
	}
	
	function delete_file(){
			$attach_id = $_GET['attach_id'];
			$this->attach->delete_file('id','uploads/fund_contract/','attach_name',$attach_id);	
			$this->attach->delete($attach_id);
	}
	
	function ajax_search_project(){
		if($_GET){
			$data['project'] = $this->insp_project->where("insp_project.title like '%".$_GET['projectName']."%'")->order_by('insp_project.budgetyear','desc')->get();
			$this->load->view('projectlist',$data);
		}
	}
	
	function ajax_search_organize(){
		if($_GET){
			$request_url = "http://app4.m-society.go.th/law/fund_org_service.php?name=".$_GET['organizeName']; 
			$xml = simplexml_load_file($request_url) or die("feed not loading");
			$data['xml'] = $xml;
			$this->load->view('organizelist',$data);
		}
	}
	
	function printdoc($id){
		$data['contract'] = $this->contract->get_row($id);
		$sql = "SELECT users.id,users.workgroupid,cnf_workgroup.title,cnf_workgroup.number,cnf_workgroup.district,cnf_workgroup.subdistrict,cnf_province.title provincetitle FROM USERS
left join cnf_workgroup on users.workgroupid=cnf_workgroup.id
left join cnf_province on cnf_workgroup.wprovinceid = cnf_province.id
where users.id = ".$data['contract']['user_id'];
		$data['user_data'] = $this->contract->get($sql);
		$data['made_date'] = explode(" ", stamp_to_th_fulldate($data['contract']['made_date']));
		$data['order_date'] = explode(" ", stamp_to_th_fulldate($data['contract']['order_date']));
		$data['approve_date'] = explode(" ", stamp_to_th_fulldate($data['contract']['approve_date']));
		$request_url = "http://app4.m-society.go.th/law/fund_org_service.php?id=".$data['contract']['organize_id'];
			$xml = simplexml_load_file($request_url) or die("feed not loading");
			$data['xml'] = $xml;
			$data['organize'] = $xml->orgdata;

		$data['th_read'] = '(<span>- '.$this->convert(number_format($data['contract']['amount'],2)).' -</span>)';
		$this->template->build('print',$data);
	}

	function convert($number){ 
		$txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ'); 
		$txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน'); 
		$number = str_replace(",","",$number); 
		$number = str_replace(" ","",$number); 
		$number = str_replace("บาท","",$number); 
		$number = explode(".",$number); 
		if(sizeof($number)>2){ 
		return 'ทศนิยมหลายตัวนะจ๊ะ'; 
		exit; 
		} 
		$strlen = strlen($number[0]); 
		$convert = ''; 
		for($i=0;$i<$strlen;$i++){ 
			$n = substr($number[0], $i,1); 
			if($n!=0){ 
				if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; } 
				elseif($i==($strlen-2) AND $n==2){  $convert .= 'ยี่'; } 
				elseif($i==($strlen-2) AND $n==1){ $convert .= ''; } 
				else{ $convert .= $txtnum1[$n]; } 
				$convert .= $txtnum2[$strlen-$i-1]; 
			} 
		} 
		
		$convert .= 'บาท'; 
		if($number[1]=='0' OR $number[1]=='00' OR 
		$number[1]==''){ 
		$convert .= 'ถ้วน'; 
		}else{ 
		$strlen = strlen($number[1]); 
		for($i=0;$i<$strlen;$i++){ 
		$n = substr($number[1], $i,1); 
			if($n!=0){ 
			if($i==($strlen-1) AND $n==1){$convert 
			.= 'เอ็ด';} 
			elseif($i==($strlen-2) AND 
			$n==2){$convert .= 'ยี่';} 
			elseif($i==($strlen-2) AND 
			$n==1){$convert .= '';} 
			else{ $convert .= $txtnum1[$n];} 
			$convert .= $txtnum2[$strlen-$i-1]; 
			} 
		} 
		$convert .= 'สตางค์'; 
		} 
		return $convert;
	}
}
?>