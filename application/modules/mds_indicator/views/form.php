<style>
	.btn_add_indicator {
						width: 162px;
						height: 28px;
						border: none;
						background: transparent url(images/btn_add_indicator.gif) no-repeat center;
						overflow: hidden;
						line-height: 0px;
						display: inline;
						color: #a63606;
						cursor: pointer;
						cursor: hand;
						margin-top: 5px;
						}
</style>
<h3>บันทึก ตัวชี้วัด (บันทึก / แก้ไข)</h3>
<table class="tbadd">
  <tr>
    <th>ปีงบประมาณ</th>
    <td><input name="budget_year" type="text" id="budget_year" style="width:70px;" value="<?=@$rs_indicator['budget_year']?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <th>หน่วยงานรับผิดชอบ</th>
    <td><input name="textfield" type="text" id="textfield" style="width:500px;" value="สำนักงานปลัดกระทรวง (สป.) - สำนักบริหารงานกลาง (รอถาม)" readonly="readonly"/></td>
  </tr>
  <tr>
    <th>มิติ</th>
    <td><input name="textfield3" type="text" id="textfield3" style="width:500px;" value="มิติที่ <?=@$rs_indicator['indicator_on']?> : <?=@$rs_indicator['indicator_name']?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <th>ชื่อตัวชี้วัด</th>
    <td><input name="textfield2" type="text" id="textfield2" style="width:600px;" value="<?=@$parent_on?> : <?=@$rs_metrics['metrics_name']?>" readonly="readonly"/></td>
  </tr>
</table>
<?
		$premit = is_permit(login_data('id',3));
		if($premit != "")
		{
			$chk_keyer_indicator = chk_keyer_indicator(@$rs_indicator['id'],$rs_metrics['id']);	
			if($chk_keyer_indicator == 'Y'){
					
?>
<div id="btnBox"><input type="button" title="เพิ่มผลปฎิบัติราชการ" value=" " onclick="document.location='<?=$urlpage?>/form_2/<?=$rs_metrics['id']?>'" class="btn_add_indicator vtip"/></div>
<? } }?>
<table class="tblist2">
<tr>
  	<th style="width: 15%">แบบฟอร์มรายงานผล</th>
	<th style="width: 30%">ผู้กำกับดูแล</th>
	<th style="width: 30%">ผู้จัดเก็บข้อมูล</th>
	<th style="width: 5%">วันที่</th>
	<th style="width: 10%">ขั้นตอน</th>
	<th style="width: 10%">สถานะ</th>
	<th style="width: 5%">ลบ </th>
</tr>
<? 	
foreach ($rs as $key => $item_result) { ?>
<tr>
  <td><?=@$item_result['round_month']?> เดือน <img src="images/see.png" alt="" width="24" height="24" /></td>
  <td>
  	<?
  			    $chk_kpr = "select mds_set_metrics_kpr.*, users.name , users.email , users.tel , users.username 
								  ,mds_set_position.pos_name , cnf_division.title , cnf_department.title as department_name
							from 
							mds_set_metrics_kpr 
							left join mds_set_permission permission on mds_set_metrics_kpr.control_users_id = permission.users_id
							left join users on permission.users_id = users.id
							left join mds_set_position on permission.mds_set_position_id = mds_set_position.id 
							left join cnf_division on users.divisionid = cnf_division.id 
							left join cnf_department on users.departmentid = cnf_department.id 
							where mds_set_metrics_kpr.mds_set_metrics_id = '".$item_result['mds_set_metrics_id']."' and mds_set_metrics_kpr.round_month = '".@$item_result['round_month']."' ";
				$result_kpr = $this->kpr->get($chk_kpr);
				$kpr = @$result_kpr['0'];
  	?>
  	<?=@$kpr['name']?> <img src="images/contact.png" alt="" width="22" height="22" class="vtip" title="เบอร์ติดต่อ : <?=(empty($kpr['tel']))?'-':$kpr['tel'];?>&lt;br&gt; อีเมล์ : <?=(empty($kpr['email']))?'-':$kpr['email'];?>" /></td>
  <td><?=@$item_result['name']?> <img src="images/contact.png" alt="" width="22" height="22" class="vtip" title="เบอร์ติดต่อ : <?=(empty($item_result['tel']))?'-':$item_result['tel'];?>&lt;br&gt; อีเมล์ : <?=(empty($item_result['email']))?'-':$item_result['email'];?>" /></td>
  <td>
  	<? 
  		$create = explode('-', @$item_result['create_date']);
		$year =  substr($create['0'],2)+43;
		$date_create = @$create['2'].'/'.@$create['1'].'/'.$year;
		if($item_result['is_save'] == 1){
			$date_2 = " - ";
			$date_3 = " - ";
			$date_4 = " - ";
		}
  	?>
  	<img src="images/date.png" alt="" width="24" height="24" class="vtip" title="บันทึก : <?=@$date_create?> &lt;br&gt; ขออนุมัติส่ง : <?=@$date_2?> &lt;br&gt; พิจารณาส่ง : <?=@$date_3?> &lt;br&gt; กพร.พิจารณาอนุมัติ : <?=@$date_4?> " /></td>
  <td><? 
  		if($item_result['is_save'] == 1){
  			echo "บันทึก";
  		}else{
  			
  		}
  	  ?>
  </td>
  <td><? 
  		if($item_result['is_save'] == 1){
  			echo " - ";
  		}else{
  			
  		}
  	  ?>
  </td>
  <td><input type="submit" name="button" id="button" value="x" class="btn_delete" /></td>
</tr>
<? } ?>

</table>
