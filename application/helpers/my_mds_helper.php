<?php
function is_permit($users_id = null,$permit = null){
	$data = '';	
	if($users_id != ''){
			$CI =& get_instance();
			$condition = '';
		if($permit != ''){
			$condition = "AND MDS_SET_PERMISSION.MDS_SET_PERMIT_TYPE_ID = '".$permit."'";
		}
		
			$sql = "SELECT MDS_SET_PERMIT_TYPE.PERMIT_NAME 
					FROM  MDS_SET_PERMISSION
					LEFT JOIN MDS_SET_PERMIT_TYPE ON MDS_SET_PERMISSION.MDS_SET_PERMIT_TYPE_ID =  MDS_SET_PERMIT_TYPE.ID
					WHERE MDS_SET_PERMISSION.USERS_ID = '".$users_id."' 
					$condition ";
			$result = $CI->db->getarray($sql); 
			dbConvert($result);
			$result=@$result['0'];
			//print_r($result);
			return @$result['permit_name'];
			
	}else{
		return $data;
	}
}
?>