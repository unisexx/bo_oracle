<?php
Class welfare_service extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("customer_main_model","cmain");
		$this->load->model("customer_sub_model","csub");
		$this->load->model("target_group_model","target_group");
	}
	
	function index(){
		$data['cmains'] = $this->cmain->order_by('last_update','desc')->get(false,false);
		$data['pagination'] = $this->cmain->pagination();
		$this->template->build('welfare_service/index',$data);
	}
	
	function form($id=false){
		$data['cmain'] = $this->cmain->get_row($id);
		$data['target_groups'] = $this->target_group->order_by('seq','asc')->get();
		$this->template->build('welfare_service/form',$data);
	}
	
	function save(){
		if($_POST){
			// customer_main save
			if(isset($_FILES["UploadFile"]))
			{
			   fix_file($_FILES["UploadFile"]);		    
			   $_POST['file_data'] = isset($_FILES["UploadFile"])!='' ? $this->cmain->upload($_FILES["UploadFile"],"uploads/welfare_service") : $_POST['file_data'];
			}
			
			$id = $this->cmain->save($_POST);
			
			$this->csub->where("id_card = ".$_POST['id_card']." and question_name = 'target'")->delete();
			
			// remove empty value and reindex of array
			$_POST['other'] = array_values(array_filter($_POST['other']));
			
			$this->db->debug = true;
			if(isset($_POST['answer_id'])){
				foreach($_POST['answer_id'] as $key=>$item){
					if($_POST['answer_id'][$key]){
						$this->csub->save(array(
							'id_card'=>$_POST['id_card'],
							'question_name'=>'target',
							'answer_id'=>$item,
							'other'=>$_POST['other'][$key]
						));
					}
				}
			}
			
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/welfare_service');
	}
	
	function delete($id){
		if($id){
			$this->cmain->where('id_card = '.$id)->delete();
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>