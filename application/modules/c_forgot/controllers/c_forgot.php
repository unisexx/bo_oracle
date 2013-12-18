<?
class C_forgot extends Admin_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('c_user/user_model','user');
	}
	
	public function index()
	{
		$this->load->view('index');
	}
	
	public function send_password()
	{
		if(@$_POST['email']!=''){
			$user = $this->user->where("email='".$_POST['email']."'")->get_row();
			if(@$user['email']!=''){
				
			}else
			{				
				$data['message'] = 'ไม่พบอีเมล์ของท่านในระบบกรุณาตรวจสอบอีกครั้ง';
				$this->load->view('index',$data);	
			}
		}
	}
}
?>