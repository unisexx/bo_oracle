<?php
class c_workgroup extends Admin_Controller
{
	public $modules_name = "c_workgroup";	
	public $modules_title = "กลุ่มงาน";
	function __construct()
	{
		parent::__construct();
		$this->load->model('workgroup_model','workgroup');
		$this->load->model('c_department/department_model','department');			
		$this->load->model('c_division/division_model','division');
		$this->load->model('c_province/province_model','province');
	}
	
	function index()
	{
		//$this->db->debug=TRUE;
		if(!permission($this->modules_name,'canview'))redirect('c_front');
		$data['url_parameter'] = GetCurrentUrlGetParameter();			
		$condition = "  1=1 ";
		$condition .= @$_GET['txtsearch']!=""? " AND CNF_WORKGROUP.TITLE LIKE '%".$_GET['txtsearch']."%'" : "";
		$condition .= @$_GET['department']>0 ? " AND DEPARTMENTID =".$_GET['department']."" : "";
		$condition .= @$_GET['division'] > 0 ? " AND DIVISIONID=".$_GET['division'] : "";
		$data['result']=  $this->workgroup->where($condition)->get();
		$data['pagination'] = $this->workgroup->pagination();		
		$this->template->build('workgroup_index',$data);	
	}
	
	function form($ID=FALSE){
		if(!permission($this->modules_name,'canview'))redirect('c_front');
		$data['url_parameter'] = GetCurrentUrlGetParameter();	
		@$data['row']= $this->workgroup->get_row($ID);		
		@$data['department'] = $this->department->get(FALSE,TRUE);
		@$data['division'] = $data['row']['departmentid'] > 0 ?  $this->division->where("departmentid=".$data['row']['departmentid'])->get(FALSE,TRUE) : $this->division->get(FALSE,TRUE);
		@$data['province'] = $this->province->get(FALSE,TRUE);
		if($ID>0){
			new_save_logfile("VIEW",$this->modules_title,$this->workgroup->table,"ID",$ID,"title",$this->modules_name);
		}
		$this->template->build('workgroup_form',$data);
	}
	
	function save(){
		//$this->db->debug = true;
		$url_parameter = GetCurrentUrlGetParameter();	
		if($_POST){
		
			if($_POST['id']>0)
			{
			   if(!permission($this->modules_name,'canedit'))redirect('c_workgroup');
			}else{		   	   	
			   if(!permission($this->modules_name,'canadd'))redirect('c_workgroup');
			}
					
		   $id = $this->workgroup->save($_POST);
		   set_notify('success', lang('save_data_complete'));
		   if($_POST['id']>0){
		   		new_save_logfile("EDIT",$this->modules_title,$this->workgroup->table,"ID",$id,"title",$this->modules_name);
		   }else{
		   		new_save_logfile("ADD",$this->modules_title,$this->workgroup->table,"ID",$id,"title",$this->modules_name);
		   }		   
		}
		redirect('c_workgroup/index'.$url_parameter);
	}
	function delete($ID=FALSE,$PAGE=FALSE){
		$url_parameter = GetCurrentUrlGetParameter();	
		if(!permission($this->modules_name,'candelete'))redirect('c_workgroup');	
		new_save_logfile("DELETE",$this->modules_title,$this->workgroup->table,"ID",$ID,"title",$this->modules_name);							
		$this->workgroup->delete($ID);			
		redirect('c_workgroup/index'.$url_parameter);
	}
	function ReadUserData($file){
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
				
		$import[$index]['id']=trim($data->sheets[0]['cells'][$i][1]);
		$import[$index]['unit_id']=trim($data->sheets[0]['cells'][$i][2]);
		$import[$index]['sub_unit_id']=trim($data->sheets[0]['cells'][$i][3]);
		$import[$index]['title']=trim($data->sheets[0]['cells'][$i][4]);
				
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
			$file_name = 'import_old_system_workgroup'.date("Y_m_d_H_i_s").'.'.$ext;			
			$uploaddir = 'uploads/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['flimport']['tmp_name'], $fpicname);		
			$data = $this->ReadUserData($uploaddir.$file_name);
			array_walk($data,'dbConvert','TIS-620');
			foreach($data as $item):
				$update['id']  = $item['id'];
				$update['unit_id'] = $item['unit_id']=='' ? 0 : $item['unit_id'];
				$update['sub_unit_id'] = $item['sub_unit_id']== "" ? 0 : $item['sub_unit_id'];
				$update['title'] = $item['title'];
					
				$sql = " INSERT INTO CNF_WORKGROUP (ID,UNIT_ID,SUB_UNIT_ID,TITLE)VALUES(".$update['id'].",".$update['unit_id'].",".$update['sub_unit_id'].",'".$update['title']."')";	
				$this->db->Execute($sql);
				
				$edit['id'] = $item['id'];
				$edit['divisionid'] = $this->db->getone("SELECT ID FROM CNF_DIVISION WHERE DEPARTMENTID=".$update['unit_id']." AND SUB_UNIT_ID=".$update['sub_unit_id']);
				$this->workgroup->save($edit);			
			endforeach;			
		}
	}
	function import(){
		$this->load->view("import");
	}

}
?>