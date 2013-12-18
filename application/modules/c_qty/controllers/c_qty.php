<?php
class c_qty extends Admin_Controller
{
	public $modules_name = "c_qty";	
	public $modules_title = "หน่วยนับ";
	function __construct()
	{
		parent::__construct();
		$this->load->model('c_qty_model','c_qty');		
	}
	
	function index()
	{
		//$this->db->debug=true;
		if(!permission('c_qty','canview'))redirect('c_front');
		$data['url_parameter'] = GetCurrentUrlGetParameter();			
		$condition = "  1=1 ";
		$condition .= isset($_GET['txtsearch'])? " AND TITLE LIKE '%".$_GET['txtsearch']."%'" : "";		
		$condition .= @$_GET['isassetunit']!='' ? " AND ISASSETUNIT <> '' " : "";
		$condition .= @$_GET['iskeyunit']!='' ? " AND ISKEYUNIT <> '' " : "";
		$data['result']= $this->c_qty->where($condition)->get();
		$data['pagination'] = $this->c_qty->pagination();		
		$this->template->build('index',$data);	
	}
	
	function form($ID=FALSE){
		//$this->db->debug=true;
		if(!permission('c_qty','canview'))redirect('c_front');
		$data['url_parameter'] = GetCurrentUrlGetParameter();	
		@$data['row']= $this->c_qty->get_row($ID);				
		if($ID>0){
			new_save_logfile("VIEW",$this->modules_title,$this->c_qty->table,"ID",$ID,"title",$this->modules_name);			
		}
		$this->template->build('form',$data);
	}
	
	function save(){
		//$this->db->debug = true;
		$url_parameter = GetCurrentUrlGetParameter();	
		if($_POST){
			if($_POST['id']>0)
			{
			   if(!permission($this->modules_name,'canedit'))redirect('c_qty');
			}else{		   	   	
			   if(!permission($this->modules_name,'canadd'))redirect('c_qty');
			}
						
		   $id = $this->c_qty->save($_POST);		   
		   if($_POST['id']>0){
		   		new_save_logfile("EDIT",$this->modules_title,$this->c_qty->table,"ID",$id,"title",$this->modules_name);
		   }else{
		   		new_save_logfile("ADD",$this->modules_title,$this->c_qty->table,"ID",$id,"title",$this->modules_name);
		   }		   
		}
		set_notify('success', lang('save_data_complete'));
		redirect('c_qty/index'.$url_parameter);
	}
	function delete($ID=FALSE,$PAGE=FALSE){
		$url_parameter = GetCurrentUrlGetParameter();
		if(!permission($this->modules_name,'candelete'))redirect('c_qty');
		new_save_logfile("DELETE",$this->modules_title,$this->c_qty->table,"ID",$ID,"title",$this->modules_name);								
		$this->c_qty->delete($ID);			
		redirect('c_qty/index'.$url_parameter);
	}

}
?>