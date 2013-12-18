<?php
class budget_time extends Budget_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("budget_time_model","budget_time");
	}
	
	public function index()
	{
		//$this->db->debug=true;
		if(!is_login())redirect("home.php");
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['result'] = $this->budget_time->get();
		$data['pagination'] = $this->budget_time->pagination();
		$this->template->build('index',$data);
	}
	
	public function form($id=FALSE){
		if(!is_login())redirect("home.php");		
		$data['url_parameter'] = GetCurrentUrlGetParameter();		
		$data['row'] = $this->budget_time->get_row($id);		
		$this->template->build('form',$data);
	}

	public function save(){
		//$this->db->debug = true;
		$id = $this->budget_time->get_one("ID","byear",$_POST['byear']);
		$_POST['id'] = $id;
		$_POST['status'] = @$_POST['status'] > 0 ? 1 : 0;
		for($i=1;$i<=8;$i++){
			$_POST['bdate_'.$i]  = $_POST['bdate_'.$i] != "" ? date_to_mysql($_POST['bdate_'.$i],TRUE) : "NULL";
		}		
		$this->budget_time->save($_POST);
		redirect('budget_time');
	}	 
	
	public function delete($ID=FALSE){					
		$this->budget_time->delete($ID);
		redirect('budget_time');
	}
	
	public function update_status(){
		$this->db->debug=true;
		$this->asset->save($_POST);
	}
}
?>