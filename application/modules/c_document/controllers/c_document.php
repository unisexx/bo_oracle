<?php
class c_document extends Admin_Controller
{
	public $modules_name = "c_document";
	public $modules_title = "อัพโหลดเอกสาร";
	function __construct()
	{
		parent::__construct();
		$this->load->model('document_model','document');			
	}
	
	function index()
	{
		if(!permission($this->modules_name,'canview'))redirect('c_front');
		$data['url_parameter'] = GetCurrentUrlGetParameter();		
		$data['result']= isset($_GET['txtsearch'])? $this->document->get("SELEcT * FROM DOCUMENTUPLOAD WHERE TITLE LIKE '%".$_GET['txtsearch']."%' ") : $this->document->get();
		$data['pagination'] = $this->document->pagination();		
		$this->template->build('document_index',$data);		
	}
	
	function form($ID=FALSE){
		if(!permission($this->modules_name,'canview'))redirect('c_front');
		$data['url_parameter'] = GetCurrentUrlGetParameter();		
		@$data['result']= $this->document->get_row($ID);		
		if($ID > 0){
			new_save_logfile("VIEW",$this->modules_title,$this->document->table,"ID",$ID,"title",$this->modules_name);
		}
		$this->template->build('document_form',$data);
	}
	function delete_file($ID=FALSE){
		//$this->db->debug = true;		
		$url_parameter = GetCurrentUrlGetParameter();		
		$this->document->delete_file_update($ID,"uploads/","FILENAME",'');
		redirect('c_document/form/'.$ID.$url_parameter);
	}
	function save(){
		//$this->db->debug = true;
		if($_POST['id']>0)
		{
		   if(!permission($this->modules_name,'canedit'))redirect('c_document');
		}else{		   	   	
		   if(!permission($this->modules_name,'canadd'))redirect('c_document');
		}
		$url_parameter = GetCurrentUrlGetParameter();
		if($_POST){
			
		   $data['id'] = $_POST['id'];
		   $data['title'] = $_POST['title'];
		   $data['remark'] = $_POST['remark'];	
		   $data['userid'] = isset($_SESSION['userID']) ? $_SESSION['userID'] : 0;				   
			   if(isset($_FILES["UploadFile"]))
			   {
				   fix_file($_FILES["UploadFile"]);		    
				   $data['filename'] =isset($_FILES["UploadFile"])!='' ? $this->document->upload($_FILES["UploadFile"],"uploads/") : $_POST['hdfilename'];
			   }
			   else
			   {
			   		$data['filename'] = $_POST['hdfilename'];
			   }		   		   		   					
		   $id = $this->document->save($data);
		   if($_POST['id']>0){
		   	new_save_logfile("EDIT",$this->modules_title,$this->document->table,"ID",$id,"title",$this->modules_name);
		   }else{
		   	new_save_logfile("ADD",$this->modules_title,$this->document->table,"ID",$id,"title",$this->modules_name);
		   }		  		  
		   set_notify('success', lang('save_data_complete'));
		}
		redirect('c_document/index'.$url_parameter);
	}
	function delete($ID=FALSE,$PAGE=FALSE){
		$url_parameter = GetCurrentUrlGetParameter();		
		if(!permission($this->modules_name,'candelete'))redirect('c_front');
		new_save_logfile("DELETE",$this->modules_title,$this->document->table,"ID",$ID,"title",$this->modules_name);							
		$this->document->delete_file($ID,"uploads/","FILENAME",'');					
		$this->document->delete($ID);							
		redirect('c_document/index'.$url_parameter);
	}

}
?>