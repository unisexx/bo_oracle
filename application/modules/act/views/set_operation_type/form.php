<h3>ตั้งค่า ลักษณะการดำเนินงาน (บันทึก / แก้ไข)</h3>

<form method="post" action="act/set_operation_type/save">
<table class="tbadd">
<tr>
  <th>ชื่อลักษณะการดำเนินงาน<span class="Txt_red_12"> *</span></th>
  <td><input name="pcommunity_name" type="text" class="form-control" style="width:500px;" value="<?php echo $operation_type['pcommunity_name']?>" /></td>
</tr>
</table>


<div id="btnBoxAdd">
	<input type="hidden" name="id" value="<?php echo $operation_type['id']?>">
  <input type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>