<?php
class Mdevsys_Controller extends Controller
{
	
	function __construct()
	{
		parent::__construct();	
		
		// set theme
		$this->template->set_theme('mdevsys');
		
		// set layout
		$this->template->set_layout('layout');
		
		// set title
		$this->template->title('งานพัฒนาระบบบริการ');
		
		// Set js
		$this->template->append_metadata(js_notify());
		
	}
	
}
?>