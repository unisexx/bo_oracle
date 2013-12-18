<?php		
class Monitor_stp06 extends Monitor_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mt_topics_model','topic');
		$this->load->model('mt_maintitle_model','maintitle');
		$this->load->model('mt_subtitle_model','subtitle');
		$this->load->model('mt_question_result_1_model','r1');
		$this->load->model('mt_question_result_2_model','r2');
		$this->load->model('c_province/province_model','province');
	}
	
	function index()
	{
		$data['topics'] = $this->topic->order_by('id','desc')->get();
		$data['pagination'] = $this->topic->pagination();
		$this->template->build('index',$data);
	}
	
	function form($id=false){
		$data['mt_topic_id'] = $id;
		$data['topic'] = $this->topic->get_row($id);
		if($id){
			$data['maintitled'] = $this->maintitle->where("mt_topic_id = ".$id)->get();
		}
		$this->template->build('form',$data);
	}
	
	function save(){
		if($_POST){
			
			$topic_id = $this->topic->save($_POST);
			
			if($_POST['maintitle']){
				foreach($_POST['maintitle'] as $key=>$item){
					if($_POST['maintitle'][$key]){
						$main_id = $this->maintitle->save(array(
							'id'=>@$_POST['maintitle_id'][$key],
							'mt_topic_id'=>$topic_id,
							'maintitle'=>$_POST['maintitle'][$key],
							'form_type'=>$_POST['form_type'][$key]
						));
						
						$subid = $key;
						if(@$_POST['subtitle_'.$subid]){
							foreach($_POST['subtitle_'.$subid] as $key=>$item){
								$this->subtitle->save(array(
									'id'=>@$_POST['subtitle_id_'.$subid][$key],
									'mt_maintitle_id'=>$main_id,
									'subtitle'=>$_POST['subtitle_'.$subid][$key]
								));
							}
						}
					}
				}
			}
		set_notify('success', lang('save_data_complete'));
		}
	redirect('monitor_stp06/index');
	}
	
	function delete($id){
		if($id){
			$this->topic->delete($id);
			$maintitled = $this->maintitle->where("mt_topic_id = ".$id)->get();
			foreach($maintitled as $maintitle){
				$this->subtitle->where('mt_maintitle_id = '.$maintitle['id'])->delete();
			}
			$this->maintitle->where('mt_topic_id = '.$id)->delete();
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('monitor_stp06/index');
	}
	
	function delSub(){
		if($_GET){
			$this->subtitle->delete($_GET['id']);
		}
	}
	
	function delMain(){
		if($_GET){
			$this->maintitle->delete($_GET['id']);
			$this->subtitle->where('mt_maintitle_id = '.$_GET['id'])->delete();
		}
	}
	
	function exform($topic_id,$id=false){
		$data['topic'] = $this->topic->get_row($topic_id);
		$data['maintitled'] = $this->maintitle->where("mt_topic_id = ".$topic_id)->get();
		$data['r1'] = $this->r1->get_row($id);
		$this->template->build('exform',$data);
	}
	
	function save_question(){
		if($_POST){
			$_POST['workgroup_id'] = login_data('workgroupid');
			$_POST['province_id'] = login_data('workgroup_provinceid');
			$_POST['user_id'] = login_data('id');
			$r1_id = $this->r1->save($_POST);
			if($_POST['mt_subtitle_id']){
				foreach($_POST['mt_subtitle_id'] as $key=>$subtitle_id){
					(@$_POST['choice5'][$key] == "")?@$_POST['choice5'][$key]=0:"";
					(@$subtitle_id == "")?@$subtitle_id=0:"";
					
					$this->r2->save(array(
						'id'=>@$_POST['r2_id'][$key],
						'mt_topic_id'=>$_POST['mt_topic_id'],
						'province_id'=>$_POST['province_id'],
						'mt_question_result_1_id'=>$r1_id,
						'mt_maintitle_id'=>$_POST['mt_maintitle_id'][$key],
						'mt_subtitle_id'=>$subtitle_id,
						'choice5'=>@$_POST['choice5'][$key],
						'choice5_comment'=>@$_POST['choice5_comment'][$key],
						'choice2'=>@$_POST['choice2'][$key],
						'choice2_comment'=>@$_POST['choice2_comment'][$key],
						'textbox_comment'=>@$_POST['textbox_comment'][$key],
						'workgroup_id'=>$_POST['workgroup_id'],
						'province_id'=>$_POST['province_id'],
						'user_id'=>$_POST['user_id']
					));
				}
			}
			set_notify('success', lang('save_data_complete'));
		}
		redirect('monitor_stp06/user_form/'.$_POST['mt_topic_id'].'/'.$r1_id);
	}

	function user_index(){
		$data['topics'] = $this->topic->where('status = 1')->order_by('id','desc')->get();
		$data['pagination'] = $this->topic->pagination();
		$this->template->build('user_index',$data);
	}
	
	function user_form($topic_id,$id=false){
		$data['topic'] = $this->topic->get_row($topic_id);
		$data['maintitled'] = $this->maintitle->where("mt_topic_id = ".$topic_id)->get();
		$data['r1'] = $this->r1->get_row($id);
		$this->template->build('user_form',$data);
	}
	
	function result_index(){
		$data['topics'] = $this->topic->where('status = 1')->order_by('id','desc')->get();
		$data['pagination'] = $this->topic->pagination();
		$this->template->build('result_index',$data);
	}
	
	function result_workgroup($id){
		$data['topic'] = $this->topic->get_row($id);
		$sql = "SELECT MT_QUESTION_RESULT_1.id,MT_QUESTION_RESULT_1.workgroup_id,cnf_workgroup.id wgid,cnf_workgroup.title FROM MT_QUESTION_RESULT_1
left join cnf_workgroup on MT_QUESTION_RESULT_1.workgroup_id = cnf_workgroup.id where MT_QUESTION_RESULT_1.mt_topic_id = ".$id;
		$data['workgroups'] = $this->r1->get($sql);
		$data['pagination'] = $this->r1->pagination();
		$this->template->build('result_workgroup',$data);
	}
	
	function result_form($topic_id,$id=false){
		$data['topic'] = $this->topic->get_row($topic_id);
		$data['maintitled'] = $this->maintitle->where("mt_topic_id = ".$topic_id)->get();
		$data['r1'] = $this->r1->get_row($id);
		$data['province'] = $this->province->get_one('title',$data['r1']['province_id']);
		$this->template->build('result_form',$data);
	}
}
?>