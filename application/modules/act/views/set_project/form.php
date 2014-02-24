<h3>ตั้งค่า ลักษณะโครงการ (บันทึก / แก้ไข)</h3>

<form method="post" action="act/set_project/save">
<table class="tbadd">
<tr>
  <th>ชื่อลักษณะโครงการ<span class="Txt_red_12"> *</span></th>
  <td><input name="ps_name" type="text" id="textfield" class="form-control" style="width:500px;" value="<?php echo $project['ps_name']?>" /></td>
</tr>
</table>


<div id="btnBoxAdd">
	<input type="hidden" name="id" value="<?php echo $project['id']?>">
  <input type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>