<?php
Class welfare_service extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("customer_main_model","cmain");
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
			$id = $this->cmain->save($_POST);
			foreach($_POST['answer_id'] as $key=>$item){
				if($item){
					$this->level->save(array(
						'id'=>@$_POST['id'][$key],
						'budgetyear'=>$_POST['budgetyear'],
						'color'=>$_POST['color'][$key],
						'color_detail'=>$_POST['color_detail'][$key],
						'orderlist'=>$key,
						'range_start'=>$_POST['range_start'][$key],
						'range_end'=>$_POST['range_end'][$key]
					));
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