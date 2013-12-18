<?php
class budget_asset extends Budget_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('budget_asset_model','asset');		
	}
	
	public function index()
	{
		//$this->db->debug = true;
		if(!is_login())redirect("home.php");
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$condition = @$_GET['txtsearch']!='' ? " assetname LIKE '%".$_GET['txtsearch']."%' " : "1=1";
		$data['result'] = $this->asset->where($condition)->get();
		$data['pagination'] = $this->asset->pagination();
		$this->template->build('index',$data);
	}
	public function form($id=FALSE){
		if(!is_login())redirect("home.php");
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['row'] = $this->asset->get_row($id);
		$this->template->build('form',$data);
	}
	public function search_asset(){		
		$data['result'] = $this->asset->where(" assetname like '%".@$_POST['txt_search']."%'")->get(FALSE,TRUE);
		$this->load->view('ajax_asset_list',$data);		 
	}
	public function save(){
		if(!is_login())redirect("home.php");
		$url_parameter = GetCurrentUrlGetParameter();
		$_POST['used'] = @$_POST['used']> 0 ? $_POST['used'] : 0;
		$this->asset->save($_POST);
		redirect('budget_asset'.$url_parameter);
	}
	
	public function delete($id){
		if(!is_login())redirect("home.php");
		$url_parameter = GetCurrentUrlGetParameter();
		$this->asset->delete($id);
		redirect('budget_asset'.$url_parameter);
	}
	
	public function update_status(){
		$this->db->debug=true;
		$this->asset->save($_POST);
	}
		
}
?>