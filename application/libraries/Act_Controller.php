<?php
class Act_Controller extends Controller
{
	
	function __construct()
	{
		parent::__construct();	
		
		// set theme
		$this->template->set_theme('act');
		
		// set layout
		$this->template->set_layout('layout');
		
		// set title
		$this->template->title('งาน พ.ร.บ. ส่งเสริมการจัดสวัสดิการสังคม กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์');
		
		// Set js
		$this->template->append_metadata(js_notify());
		
	}
	
}
?>