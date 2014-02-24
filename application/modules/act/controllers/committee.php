<?php
Class committee extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("subcommittee_main_model","cmain");
		$this->load->model("subcommittee_sub_model","csub");
	}
	
	function index(){
		$condition =" 1=1 ";		
		$condition .= @$_GET['search']!='' ? " and headline like '%".$_GET['search']."%' " : "";
		$condition .= @$_GET['province_code']!='' ? ' and province_code = '.$_GET['province_code'] : '';
		$condition .= @$_GET['status']!='' ? ' and status = '.$_GET['status'] : '';
		
		$data['subcommittee_mains'] = $this->cmain->where($condition)->order_by('id','desc')->get(FALSE,FALSE);
		$data['pagination'] = $this->cmain->pagination();
		$this->template->build('committee/index',$data);
	}
	
	function form($id=false){
		$data['main'] = $this->cmain->get_row($id);
		if($id){$data['subs'] = $this->csub->where('subcommittee_id = '.$id)->order_by('id','desc')->get(FALSE,TRUE);}
		$this->template->build('committee/form',$data);
	}
	
	function save(){
		if($_POST){
			$_POST['id'] = $_POST['subcommittee_id'];
			$id = $this->cmain->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/committee/form/'.$id);
	}
	
	function delete($id){
		if($id){
			$this->cmain->delete($id);
			$this->csub->where('subcommittee_id ='.$id)->delete();
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
	
	function subcommittee_save(){
		if($_POST){
			$this->csub->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
	
	function subcommittee_delete($id){
		if($id){
			$this->csub->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
	
	function ajax_subcommittee_edit(){
		$data['sub'] = $this->csub->get_row(@$_GET['id']);
		$this->load->view('committee/ajax_subcommittee_form',$data);
	}
}
?>