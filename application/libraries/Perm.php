<?php 

class Perm {
	
	static public function system_permission($system_id)
	{
		$result = get_instance()->db->getarray('select * from permission where system_id = '.$system_id);
		dbConvert($result);
		return $result;
	}
	
	static public function is_checked($pds, $permission_id, $action)
	{
		if(!empty($pds) && $permission_id && $action)
		{
			return @$pds[$permission_id][$action] ? 'checked' : '';
		}
	}
	
}
