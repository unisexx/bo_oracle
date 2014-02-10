<h3>ตั้งค่า ประเภทอนุกรรมการ (บันทึก / แก้ไข)</h3>

<form method="post" action="act/set_committee_type/save">
<table class="tbadd">
<tr>
  <th>ชื่อประเภทอนุกรรมการ<span class="Txt_red_12"> *</span></th>
  <td><input name="committee_type_name" type="text" id="textfield" class="form-control" style="width:500px;" value="<?php echo $committee_type['committee_type_name']?>" /></td>
</tr>
</table>


<div id="btnBoxAdd">
	<input type="hidden" name="id" value="<?php echo $committee_type['id']?>">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>