<?php
class c_user extends Admin_Controller
{
	public $modules_name = "c_user";
	public $modules_title = "ข้อมูลผู้ใช้";
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model','users');
		$this->load->model('c_usergroup/usertype_title_model','usertype_title');
		$this->load->model('c_usergroup/usertype_model','usertype');	
		$this->load->model('c_workgroup/workgroup_model','workgroup');
		$this->load->model('c_division/division_model','division');
		$this->load->model('c_department/department_model','department');	
		$this->load->model('type_human_model','type_human');
					
	}
	
	function index()
	{
		//$this->db->debug=TRUE;
		if(!permission($this->modules_name,'canview'))redirect('c_front');
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$condition =" 1=1 ";		
		$condition .= @$_GET['txtsearch']!='' ? " AND (USERS.USERNAME LIKE '%".$_GET['txtsearch']."%' OR USERS.NAME LIKE '%".$_GET['txtsearch']."%' OR FIRSTNAME LIKE '%".$_GET['txtsearch']."%' OR LASTNAME LIKE '%".$_GET['txtsearch']."%') ": "";
		$condition .= @$_GET['division']!=''? $_GET['division'] > 0 ?  " AND DIVISIONID=".$_GET['division'] : "" :"";
		$condition .= @$_GET['usertype']!=''? $_GET['usertype'] > 0 ? " AND USERTYPE =".$_GET['usertype'] : "" : "";
		$condition .= @$_GET['workgroup']!='' ? $_GET['workgroup'] > 0 ? " AND WORKGROUPID=".$_GET['workgroup'] : "" : "";
		$data['result']=  $this->users->where($condition)->order_by('name','asc')->get();
		$data['pagination'] = $this->users->pagination();		
		$this->template->build('user_index',$data);		
	}
	
	function form($ID=FALSE){
		//$this->db->debug=TRUE;
		if(!permission($this->modules_name,'canview'))redirect('c_front');
		$data='';
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$usertype_title = $this->usertype_title->get(FALSE,TRUE);		
		if($ID>0){
			$data['result']= $this->users->get_row($ID);
			new_save_logfile("VIEW",$this->modules_title,"USERS","ID",$ID,"name",$this->modules_name);		
		}
		$data['usertype_title'] = $this->usertype_title->get(FALSE,TRUE);
		$data['type_human'] = $this->type_human->get(FALSE,TRUE);
		$data['department'] = $this->department->get(FALSE,TRUE);
		$data['division'] = @$data['result']['departmentid'] > 0 ?  $this->division->where("departmentid=".$data['result']['departmentid'])->get(FALSE,TRUE): $this->division->get(FALSE,TRUE);
		$data['workgroup'] = @$data['result']['workgroupid'] > 0 ?  $this->workgroup->where("divisionid=".$data['result']['divisionid'])->get(FALSE,TRUE): $this->workgroup->get(FALSE,TRUE);
		 
		$this->template->build('user_form',$data);
	}
	
	function profile(){
		//$this->db->debug=TRUE;
		$data['result']= $this->users->get_row(login_data('id'));
		$data['url_parameter'] = GetCurrentUrlGetParameter();	
		$usertype_title = $this->usertype_title->get(FALSE,TRUE);		
		$data['usertype_title'] = $this->usertype_title->get(FALSE,TRUE);
		$data['type_human'] = $this->type_human->get(FALSE,TRUE);
		$data['department'] = $this->department->get(FALSE,TRUE);
		$data['division'] = @$data['result']['departmentid'] > 0 ?  $this->division->where("departmentid=".$data['result']['departmentid'])->get(FALSE,TRUE): $this->division->get(FALSE,TRUE);
		$data['workgroup'] = @$data['result']['workgroupid'] > 0 ?  $this->workgroup->where("divisionid=".$data['result']['divisionid'])->get(FALSE,TRUE): $this->workgroup->get(FALSE,TRUE);
							
		new_save_logfile("VIEW",$this->modules_title,"USERS","ID",login_data('id'),"name","profile");						 
		$this->template->build('profile_form',$data);
	}
	
	function ajax_division_list($ID=FALSE){
		$result = $ID == FALSE ? $this->division->get(FALSE,TRUE) : $this->division->get("SELECT * FROM CNF_DIVISION WHERE DEPARTMENTID=".$ID,TRUE) ;
		echo '<select name="division" id="division" onchange="ReloadWorkgroup(this.value);">';
			    echo '<option value="">เลือกกอง/สำนักงาน</option>';
		foreach($result as $row):			  			    
			    echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';			    
		endforeach;
		echo '</select>';
	}
	function ajax_workgroup_list($DepartmentID=FALSE,$DivisionID=FALSE){
		$result = $DepartmentID==FALSE && $DivisionID==FALSE? $this->workgroup->get(FALSE,TRUE) : 
		$DepartmentID!= FALSE ? $this->workgroup->get("SELECT CW.* FROM CNF_WORKGROUP CW LEFT JOIN CNF_DIVISION CD ON CW.DIVISIONID = CD.ID WHERE DEPARTMENTID=".$DepartmentID,TRUE) :
		$this->workgroup->get("SELECT CW.* FROM CNF_WORKGROUP CW LEFT JOIN CNF_DIVISION CD ON CW.DIVISIONID = CD.ID WHERE DIVISIONID=".$DivisionID,TRUE);
		echo '<select name="workgroupid" id="workgroupid" >';
			    echo '<option value="">เลือกกลุ่มงาน</option>';
		foreach($result as $row):			  			    
			    echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';			    
		endforeach;
		echo '</select>';
	}
	function save($ID=FALSE){
		//$this->db->debug = true;
		if($_POST['id']>0)
		{
		   if(!permission($this->modules_name,'canedit'))redirect('c_user');
		}else{		   	   	
		   if(!permission($this->modules_name,'canadd'))redirect('c_user');
		}
		
		$url_parameter = GetCurrentUrlGetParameter();	
		if($_POST){
		   $_POST['password'] = $_POST['password'] !='' ? $_POST['password'] :$_POST['hdpassword']; 		   
		   $_POST['registerdate'] =  $_POST['registerdate']=='' ? th_to_stamp(date("d-m-Y H:i:s"),TRUE) : $_POST['registerdate'];
		   $_POST['updatedate'] = th_to_stamp(date("d-m-Y H:i:s"),TRUE);
		   $data['status']= 1;		   		   		   				
		   $id = $this->users->save($_POST);
		   
		   set_notify('success', lang('save_data_complete'));
		   
		   	if($_POST['id']>0){
		   	new_save_logfile("EDIT",$this->modules_title,"USERS","ID",$id,"name","profile");	
		   	}else{
			new_save_logfile("ADD",$this->modules_title,"USERS","ID",$id,"name","profile");		   		
		   	}		   					
		}
		redirect('c_user/index'.$url_parameter);
	}
	function save_profile($ID=FALSE){
		//$this->db->debug = true;
		$url_parameter = GetCurrentUrlGetParameter();	
		if($_POST){
		   $_POST['password'] = $_POST['password'] !='' ? $_POST['password'] :$_POST['hdpassword']; 		   
		   $_POST['registerdate'] =  $_POST['registerdate']=='' ? th_to_stamp(date("d-m-Y H:i:s"),TRUE) : $_POST['registerdate'];
		   $_POST['updatedate'] = th_to_stamp(date("d-m-Y H:i:s"),TRUE);
		   $data['status']= 1;		   		   		   				
		   $id = $this->users->save($_POST);
		   $usergroup_id = $this->usertype_title->get_one('id','user_id',$id);
		   $update['id'] = $usergroup_id;
		   $update['title'] = $_POST['name'];
		   $this->usertype_title->save($update);
		   		   		
		   new_save_logfile("EDIT",$this->modules_title,"USERS","ID",$id,"name","profile");				   
		   
		   set_notify('success', lang('save_data_complete'));
		}
		redirect('c_user/profile');
	}
	function delete($ID=FALSE){
		$url_parameter = GetCurrentUrlGetParameter();
		if(!permission($this->modules_name,'canedit'))redirect('c_user');
		new_save_logfile("DELETE",$this->modules_title,"USERS","ID",$ID,"name","profile");		
		$this->users->delete($ID);				
		redirect('c_user/index'.$url_parameter);
	}
	
	function update_users_division(){
		$data = $this->users->get(FALSE,TRUE);
		foreach($data as $item){
			$workgroup = $this->workgroup->get_row($item['workgroupid']);
			$user['divisionid'] = $workgroup['divisionid'];
			$user['id'] = $item['id'];
			$this->users->save($user);
		}
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
		$import[$index]['departmentid']=trim($data->sheets[0]['cells'][$i][2]);
		$import[$index]['divisionid']=trim($data->sheets[0]['cells'][$i][3]);
		$import[$index]['username']=trim($data->sheets[0]['cells'][$i][4]);
		$import[$index]['password']=$data->sheets[0]['cells'][$i][5];
		$import[$index]['firstname']=$data->sheets[0]['cells'][$i][6];
		$import[$index]['lastname']=$data->sheets[0]['cells'][$i][7];
		$import[$index]['workgroupid']=$data->sheets[0]['cells'][$i][11];
		$import[$index]['status']='1';
		
		$index++;								
	}
	
	return $import;
	//print_r($data);
	//print_r($data->formatRecords);
}
	function do_import(){
		//$this->db->debug = true;
		if($_FILES['flimport']['name']!=''){
			$ext = pathinfo($_FILES['flimport']['name'], PATHINFO_EXTENSION);
			$file_name = 'import_old_system_member'.date("Y_m_d_H_i_s").'.'.$ext;			
			$uploaddir = 'uploads/';
			$fpicname = $uploaddir.$file_name;
			move_uploaded_file($_FILES['flimport']['tmp_name'], $fpicname);		
			$data = $this->ReadUserData($uploaddir.$file_name);
			array_walk($data,'dbConvert','TIS-620');
			foreach($data as $item):
				$update['id']  = $item['id'];
				$update['departmentid'] = $item['departmentid']=='' ? 0 : $item['departmentid'];
				$update['old_divisionid'] = $item['divisionid']== "" ? 0 : $item['divisionid'];
				$update['username'] = $item['username'];
				$update['password'] = $item['password'];
				$update['name'] = $item['firstname']." ".$item['lastname'];
				$update['firstname'] = $item['firstname'];
				$update['lastname'] = $item['lastname'];	
				$update['workgroupid'] = $item['workgroupid']== "" ? 0 : $item['workgroupid'];
				$update['status'] = $item['status'];		
				$update['usertype'] = 6;
				$sql = " INSERT INTO USERS (ID,DEPARTMENTID,OLD_DIVISIONID,NAME,USERNAME,PASSWORD,FIRSTNAME,LASTNAME,STATUS,WORKGROUPID,USERTYPE)VALUES(".$update['id'].",".$update['departmentid'].",".$update['old_divisionid'].",'".$update['name']."','".$update['username']."','".$update['password']."','".$update['firstname']."','".$update['lastname']."','".$update['status']."',".$update['workgroupid'].",".$update['usertype'].")";	
				$this->db->Execute($sql);
				
				$edit['id'] = $item['id'];
				$edit['divisionid'] = $this->db->getone("SELECT ID FROM CNF_DIVISION WHERE DEPARTMENTID=".$update['departmentid']." AND SUB_UNIT_ID=".$update['old_divisionid']);
				$this->users->save($edit);			
			endforeach;			
		}
	}
	function import(){
		$this->load->view("import");
	}
	public function search_users(){
		$condition =" 1=1 ";		
		$condition .= @$_POST['txt_search']!='' ? " AND (USERS.NAME LIKE '%".$_POST['txt_search']."%' OR FIRSTNAME LIKE '%".$_POST['txt_search']."%' OR LASTNAME LIKE '%".$_POST['txt_search']."%') ": "";
		$condition .= @$_GET['division']!=''? $_GET['division'] > 0 ?  " AND DIVISIONID=".$_GET['division'] : "" :"";
		$condition .= @$_GET['usertype']!=''? $_GET['usertype'] > 0 ? " AND USERTYPE =".$_GET['usertype'] : "" : "";
		$condition .= @$_GET['workgroup']!='' ? $_GET['workgroup'] > 0 ? " AND WORKGROUPID=".$_GET['workgroup'] : "" : "";
		$data['result']=  $this->users->where($condition)->get();
		$data['pagination'] = $this->users->pagination();		
		$this->load->view('user_ajax',$data);		
	}
	
	function export(){
		if(!permission($this->modules_name,'canview'))redirect('c_front');
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$condition =" 1=1 ";		
		$condition .= @$_GET['txtsearch']!='' ? " AND (USERS.USERNAME LIKE '%".$_GET['txtsearch']."%' OR USERS.NAME LIKE '%".$_GET['txtsearch']."%' OR FIRSTNAME LIKE '%".$_GET['txtsearch']."%' OR LASTNAME LIKE '%".$_GET['txtsearch']."%') ": "";
		$condition .= @$_GET['division']!=''? $_GET['division'] > 0 ?  " AND DIVISIONID=".$_GET['division'] : "" :"";
		$condition .= @$_GET['usertype']!=''? $_GET['usertype'] > 0 ? " AND USERTYPE =".$_GET['usertype'] : "" : "";
		$condition .= @$_GET['workgroup']!='' ? $_GET['workgroup'] > 0 ? " AND WORKGROUPID=".$_GET['workgroup'] : "" : "";
		$data['result']=  $this->users->where($condition)->get(false,true);	
		$this->load->view('export',$data);
	}
}
?>