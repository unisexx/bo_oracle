<?php
Class Mds extends  Mdevsys_Controller{
		
	
	function __construct(){
		parent::__construct();
		$this->load->model('c_user/user_model','user');
		
	}
	function index(){
		
		if(!is_login())redirect("home");
		if(is_permit(login_data('id')) == '')redirect("c_front");
		$this->template->build('index');

	}
}
?>