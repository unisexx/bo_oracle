<?php
class c_division extends Admin_Controller
{
	public $modules_name = "c_division";
	public $modules_title = "หน่วยงาน";
	function __construct()
	{
		parent::__construct();
		$this->load->model('division_model','division');	
		$this->load->model('c_department/department_model','department');
		$this->load->model('c_province/province_model','province');
		$this->load->model('c_workgroup/workgroup_model','workgroup');		
	}
	
	function index()
	{
		if(!permission($this->modules_name,'canview'))redirect('c_front');
		$data['url_parameter'] = GetCurrentUrlGetParameter();	
		$condition = " WHERE 1=1 ";
		$condition .= isset($_GET['txtsearch'])? " AND TITLE LIKE '%".$_GET['txtsearch']."%'" : "";
		$condition .= isset($_GET['department']) && $_GET['department']!='' ? " AND DEPARTMENTID =".$_GET['department']."" : "";
		$data['result']= isset($_GET['txtsearch'])? $this->division->get("SELEcT * FROM CNF_DIVISION ".$condition) : $this->division->get();
		$data['pagination'] = $this->division->pagination();		
		$this->template->build('division_index',$data);		
	}
	
	function form($ID=FALSE){
		if(!permission($this->modules_name,'canview'))redirect('c_front');
		$data['url_parameter'] = GetCurrentUrlGetParameter();	
		@$data['row']= $this->division->get_row($ID);	
		if($ID>0){
			new_save_logfile("VIEW",$this->modules_title,$this->division->table,"ID",$ID,"title",$this->modules_name);
		}	
		$this->template->build('division_form',$data);
	}
	
	function save(){
		//$this->db->debug = true;
		$url_parameter = GetCurrentUrlGetParameter();
			
		if($_POST){
						
			if($_POST['id']>0)
			{
			   if(!permission($this->modules_name,'canedit'))redirect('c_division');
			}else{		   	   	
			   if(!permission($this->modules_name,'canadd'))redirect('c_division');
			}	
						
		   $id = $this->division->save($_POST);
		   set_notify('success', lang('save_data_complete'));		   
		   if($_POST['id']>0){
		   	new_save_logfile("EDIT",$this->modules_title,$this->division->table,"ID",$id,"title",$this->modules_name);
		   }else{
		   	new_save_logfile("ADD",$this->modules_title,$this->division->table,"ID",$id,"title",$this->modules_name);
		   }		   
		}
		redirect('c_division/index'.$url_parameter);
	}
	function delete($ID=FALSE){
		$url_parameter = GetCurrentUrlGetParameter();		
		if(!permission($this->modules_name,'candelete'))redirect('c_division');
		new_save_logfile("EDIT",$this->modules_title,$this->division->table,"ID",$ID,"title",$this->modules_name);					
		$this->division->delete($ID);		
		redirect('c_division/index'.$url_parameter);
	}
	
	function ReadDivisionData($file){
	require_once 'include/Excel/reader.php';
	// ExcelFile($filename, $encoding);
	$data = new Spreadsheet_Excel_Reader();
	// Set output Encoding.
	//$data->setOutputEncoding('CP1251');
	$data->setOutputEncoding('UTF-8');
	/***
	* if you want you can change 'iconv' to mb_convert_encoding:
	* $data->setUTFEncoder('mb');
	*
	**/
	/***
	* By default rows & cols indeces start with 1
	* For change initial index use:
	* $data->setRowColOffset(0);
	*
	**/
	/***
	*  Some function for formatting output.
	* $data->setDefaultFormat('%.2f');
	* setDefaultFormat - set format for columns with unknown formatting
	*
	* $data->setColumnFormat(4, '%.3f');
	* setColumnFormat - set format for column (apply only to number fields)
	*
	**/
	$data->read($file);
	/*
	 $data->sheets[0]['numRows'] - count rows
	 $data->sheets[0]['numCols'] - count columns
	 $data->sheets[0]['cells'][$i][$j] - data from $i-row $j-column
	
	 $data->sheets[0]['cellsInfo'][$i][$j] - extended info about cell
	    
	    $data->sheets[0]['cellsInfo'][$i][$j]['type'] = "date" | "number" | "unknown"
	        if 'type' == "unknown" - use 'raw' value, because  cell contain value with format '0.00';
	    $data->sheets[0]['cellsInfo'][$i][$j]['raw'] = value if cell without format 
	    $data->sheets[0]['cellsInfo'][$i][$j]['colspan'] 
	    $data->sheets[0]['cellsInfo'][$i][$j]['rowspan'] 
	*/
	
	error_reporting(E_ALL ^ E_NOTICE);
	$index=0;
	for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
				
		$import[$index]['departmentid']=trim($data->sheets[0]['cells'][$i][1]);
		$import[$index]['sub_unit_id']=trim($data->sheets[0]['cells'][$i][2]);
		$import[$index]['title']=trim($data->sheets[0]['cells'][$i][3]);				
		$index++;								
	}
	
	return $import;
	//print_r($data);
	//print_r($data->formatRecords);
}
	function do_import(){
		$this->db->debug = true;
		if($_FILES['flimport']['name']!=''){
			$ext = pathinfo($_FILES['flimport']['name'], PATHINFO_EXTENSION);
			$file_name = 'import_old_system_division'.date("Y_m_d_H_i_s").'.'.$ext;			
			$uploaddir = 'uploads/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['flimport']['tmp_name'], $fpicname);		
			$data = $this->ReadDivisionData($uploaddir.$file_name);			
			foreach($data as $item):				
				$update['departmentid'] = $item['departmentid']== "" ? 0 : $item['departmentid'];
				$update['sub_unit_id'] = $item['sub_unit_id'];
				$update['title'] = $item['title'];										
				$this->division->save($update);			
			endforeach;			
		}
	}
	function import(){
		$this->load->view("import");
	}
	function add_workgroup_province($division_id=FALSE){
		//$this->db->debug=true;
		$division_id = @$_POST['division_id'];
		if($division_id >0){
			$province = $this->province->where("id <> 2")->get(FALSE,TRUE);
			$division = $this->division->get_row($division_id);
			foreach($province as $item):
				$update['divisionid'] = $division['id'];
				$update['title'] = $division['title']." จังหวัด".$item['title'];
				$update['wprovinceid'] = $item['id'];
				$exist = $this->db->getrow("select * from cnf_workgroup where wprovinceid=".$update['wprovinceid']." AND divisionid=".$update['divisionid']);
				dbConvert($exist);
				if(@$exist['id']<1)
					$this->workgroup->save($update);
				//print_r($update);
				//echo "<br>";
			endforeach;
		}
	}
}
?>