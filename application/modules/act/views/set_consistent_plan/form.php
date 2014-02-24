<h3>ตั้งค่า ความสอดคล้องกับนโยบายแผน  (บันทึก / แก้ไข)</h3>

<form method="post" action="act/set_consistent_plan/save">
<table class="tbadd">
<tr>
  <th>ชื่อความสอดคล้องกับนโยบายแผน <span class="Txt_red_12"> *</span></th>
  <td><input name="policy_name" type="text" class="form-control" style="width:500px;" value="<?php echo $consistent['policy_name']?>" /></td>
</tr>
</table>


<div id="btnBoxAdd">
	<input type="hidden" name="created" value="<?php echo $consistent['created']?>">
	<input type="hidden" name="id" value="<?php echo $consistent['id']?>">
  <input type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>