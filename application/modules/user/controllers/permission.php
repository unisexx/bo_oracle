<?php

class Permission extends Admin_Controller {
	
	public $extras = array(
		17 => array(
			'action_extra1' => 'ผู้ดูแลระบบจัดทำคำของบประมาณ',
			'action_extra2' => 'ดูทุกกลุ่มในหน่วยงานตนเอง (ส่งตรวจสอบ)'
		),
		27 => array(
			'action_extra1'	=> 'เข้าถึงข้อมูลทุกหน่วยงาน'
		),
		38 => array(
			'action_extra1'	=> 'เข้าถึงข้อมูลทุกหน่วยงาน'
		),
		51 => array(
			'action_extra1' => 'ผู้ตรวจราชการ',
			'action_extra2' => 'เข้าถึงข้อมูลทุกหน่วยงาน'
		),
	);
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('perm');
		$this->load->model('system_model', 'sys_mdl');
		$this->load->model('permission_group_model', 'pg_mdl');
		$this->load->model('permission_detail_model', 'pd_mdl');
	}
	
	public function index()
	{
		$data['result'] = $this->pg_mdl->get();
		$this->template->build('permission/index', $data);
	}
	
	public function form($id = null)
	{
		$data['rs'] = $this->pg_mdl->get_row($id);
		$data['pds'] = array();
		if($id)
		{
			$pds = $this->pd_mdl->where('permission_group_id = '.$id)->get(FALSE, TRUE);
			foreach($pds as $pd) $data['pds'][$pd['permission_id']] = $pd;	
		}
		$data['system'] = $this->sys_mdl->get();
		$data['extras'] = $this->extras;
		$this->template->build('permission/form', $data);
	}
	
	public function save()
	{
		$group_id = $this->pg_mdl->save($_POST);
		$vals = array();
		$actions = array('action_view', 'action_add', 'action_edit', 'action_delete', 'action_extra1', 'action_extra2', 'action_extra3');
		$this->pd_mdl->delete('permission_group_id', $group_id);
		foreach($actions as $action)
		{
			foreach($_POST[$action] as $system_id => $permissions)
			{
				foreach($permissions as $permission_id => $value)
				{
					$vals[$permission_id]['system_id'] = $system_id;
					$vals[$permission_id]['permission_group_id'] = $group_id;
					$vals[$permission_id]['permission_id'] = $permission_id;
					$vals[$permission_id][$action] = $value;
				}
			}
		}
		foreach($vals as $val)
		{
			$this->pd_mdl->save($val);
		}
		redirect('user/permission');
	}
	
	public function ajax_get($id = null)
	{
		$data['rs'] = $this->pg_mdl->get_row($id);
		$data['pds'] = array();
		if($id)
		{
			$pds = $this->pd_mdl->where('permission_group_id = '.$id)->get(FALSE, TRUE);
			foreach($pds as $pd) $data['pds'][$pd['permission_id']] = $pd;	
		}
		$data['system'] = $this->sys_mdl->get();
		$data['extras'] = $this->extras;
		$this->load->view('permission/ajax_get', $data);
	}
		
}