<?php

class Volunteer extends Act_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("volunteer_main_model","volunteer");
	}
	
	public function index()
	{
		$sql = "SELECT 
		M.V_ID,
		T.TITLE_NAME || M.FNAME || ' ' || M.LNAME AS FULLNAME,
		M.HOME_NO || ' หมู่ที่ ' || M.MOO || ' ' || M.SOI || ' ' || M.ROAD || ' ต.' || B.TUMBON_NAME || ' อ.' || A.AMPOR_NAME || ' จ.' || P.PROVINCE_NAME AS ADDRESS, 
		M.TEL,
		M.FAX,
		M.EMAIL
		FROM ACT_VOLUNTEER_MAIN M 
		JOIN ACT_TITLE_NAME T ON T.TITLE_ID = M.TITLE_ID
		JOIN ACT_PROVINCE P ON P.PROVINCE_CODE = M.PROVINCE_CODE
		JOIN ACT_AMPOR A ON A.AMPOR_CODE = M.AMPOR_CODE AND A.PROVINCE_CODE = M.PROVINCE_CODE
		JOIN ACT_TUMBON B ON B.TUMBON_CODE = M.TUMBON_CODE AND B.PROVINCE_CODE = M.PROVINCE_CODE AND B.AMPOR_CODE = M.AMPOR_CODE";
		$data['result'] = $this->volunteer->get_page($sql);
		$data['pagination'] = $this->volunteer->pagination;
		$this->template->build('report/volunteer/index', $data);
	}
	
	public function view($id)
	{
		
	}
	
	
	
}