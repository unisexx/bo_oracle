<?php
class Public_Controller extends Controller
{
	
	function __construct()
	{
		parent::__construct();	
		
		// check login
		//if(!is_login()) redirect('user/inc_index');
		
		// set theme
		$this->template->set_theme('bo');
		
		// set layout
		$this->template->set_layout('layout');
		
		// set title
		$this->template->title('โปรแกรมระบบสนับสนุนกระบวนการพัฒนากฎหมาย');
		
		// Set js
		$this->template->append_metadata(js_notify());
		
		// set user department
		//$this->department = login_data('dpc_id');
		
	}
	
	function captcha()
	{
		$this->load->library('captcha');
		$captcha = new Captcha();
		$captcha->size = 4;
		$captcha->chars = '0123456789';
		$captcha->session = "captcha";
		$captcha->display();
	}
	
}
?>