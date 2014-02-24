<? echo @$pagination; ?>
	<table class='tbadd'>
		<tr>
			<th style="width: 50px">ลำดับ</th>
			<th style="width: 400px">Username</th>
			<th style="width: 400px">ชื่อ-สกุล</th>
			<th style="width: 50px">เลือก</th>
		</tr>
		<? 
		
		if(count(@$rs_users) > 0){
		
		$i=1; foreach(@$rs_users as $tmp) {	?>
			<tr>
				<td style="width: 50px"><? echo $i+$_GET['page']; ?></td>
				<td style="width: 400px"><? echo @$tmp['username']; ?></td>
				<td style="width: 400px"><? echo @$tmp['name']; ?></td>
				<td style="width: 50px">
					<input type="button" value="เลือก" class="btn_users_slc" users_id="<?php echo $tmp['id'];?>" usersname="<?php echo $tmp['username']; ?>" 
					name="<?php echo $tmp['name']; ?>" firstname="<?php echo $tmp['firstname']; ?>" lastname="<?php echo $tmp['lastname']; ?>" 
					departmentid="<?php echo $tmp['departmentid']; ?>" divisionid="<?php echo $tmp['divisionid']; ?>"
					division_name="<?php echo $tmp['division_name']; ?>" department_name="<?php echo $tmp['department_name']; ?>"
					users_tel="<?php echo $tmp['tel']; ?>" users_email="<?php echo $tmp['email']; ?>" style="width: 50px" />
				</td>
			</tr>
		<? $i++;} 
		}else{?>
			<tr><td colspan="7"><div align="center"> ไม่พบข้อมูล ผู้ใช้ </div></td></tr>
		<?}?>	
	</table>
<? echo @$pagination; ?>