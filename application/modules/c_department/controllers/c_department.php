<?php
class c_department extends Admin_Controller
{
	public $modules_name = "c_department";
	public $modules_title = "กรม";
	function __construct()
	{
		parent::__construct();
		$this->load->model('department_model','department');			
	}
	
	function index()
	{
		if(!permission($this->modules_name,'canview'))redirect('c_front');
		$data['url_parameter'] = GetCurrentUrlGetParameter();				
		$data['result']= isset($_GET['txtsearch'])? $this->department->get("SELEcT * FROM CNF_DEPARTMENT WHERE TITLE LIKE '%".$_GET['txtsearch']."%' ") : $this->department->get();
		$data['pagination'] = $this->department->pagination();		
		$this->template->build('department_index',$data);		
	}
	
	function form($ID=FALSE){
		if(!permission($this->modules_name,'canview'))redirect('c_front');
		$data['url_parameter'] = GetCurrentUrlGetParameter();		
		@$data['row']= $this->department->get_row($ID);		
		if($ID>0){
			new_save_logfile("VIEW",$this->modules_title,$this->department->table,"ID",$ID,"title",$this->modules_name);
		}
		$this->template->build('department_form',$data);
	}
	
	function save($ID=FALSE){
		//$this->db->debug = true;
		$url_parameter = GetCurrentUrlGetParameter();
		$_POST['budgetuse'] = @$_POST['budgetuse']!='' ? $_POST['budgetuse'] : 'off';
		$_POST['financeuse'] = @$_POST['financeuse']!='' ? $_POST['financeuse'] : 'off';
		$_POST['monitoruse'] = @$_POST['monitoruse']!='' ? $_POST['monitoruse'] : 'off';
		$_POST['inspectuse'] = @$_POST['inspectuse']!='' ?  $_POST['inspectuse'] : 'off';	
		
		if($_POST['id']>0)
		{
		   if(!permission($this->modules_name,'canedit'))redirect('c_department');
		}else{		   	   	
		   if(!permission($this->modules_name,'canadd'))redirect('c_department');
		}
		
		if($_POST){			
		   $id = $this->department->save($_POST);
		   set_notify('success', lang('save_data_complete'));		   		   
		   if($_POST['id']>0){
		   		new_save_logfile("EDIT",$this->modules_title,$this->department->table,"ID",$id,"title",$this->modules_name);
		   }else{
		   		new_save_logfile("ADD",$this->modules_title,$this->department->table,"ID",$id,"title",$this->modules_name);
		   }		     
		}
		redirect('c_department/index'.$url_parameter);
	}
	function delete($ID=FALSE){
		$url_parameter = GetCurrentUrlGetParameter();
		if(!permission($this->modules_name,'candelete'))redirect('c_front');						
		new_save_logfile("DELETE",$this->modules_title,$this->department->table,"ID",$ID,"title",$this->modules_name);				
		$this->department->delete($ID);				
		redirect('c_department/index'.$url_parameter);
	}
	
	function ReadDepartmentData($file){
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
		$import[$index]['title']=trim($data->sheets[0]['cells'][$i][2]);					
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
			$file_name = 'import_old_system_department'.date("Y_m_d_H_i_s").'.'.$ext;			
			$uploaddir = 'uploads/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['flimport']['tmp_name'], $fpicname);		
			$data = $this->ReadDepartmentData($uploaddir.$file_name);
			array_walk($data,'dbConvert','TIS-620');
			foreach($data as $item):
				$update['id']  = $item['id'];
				$update['title'] = $item['title'];				
				$sql = " INSERT INTO CNF_DEPARTMENT (ID,TITLE)VALUES(".$update['id'].",'".$update['title']."')";	
				$this->db->Execute($sql);			
			endforeach;			
		}
	}
	function import(){
		$this->load->view("import");
	}

}
?>