<h3>ตั้งค่า ลักษณะงานที่ปฏิบัติ (นักสังคมสงเคราะห์)  (บันทึก / แก้ไข)</h3>

<form method="post" action="act/set_practice_type/save">
<table class="tbadd">
<tr>
  <th>ชื่อลักษณะงานที่ปฏิบัติ (นักสังคมสงเคราะห์) <span class="Txt_red_12"> *</span></th>
  <td><input name="specific_name" type="text" id="textfield" class="form-control" style="width:500px;" value="<?php echo $practice_type['specific_name']?>" /></td>
</tr>
</table>



<div id="btnBoxAdd">
  <input type="hidden" name="created" value="<?php echo $practice_type['created']?>">
  <input type="hidden" name="id" value="<?php echo $practice_type['id']?>">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>