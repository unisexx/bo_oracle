<h3>ตั้งค่า หน่วยงานที่สังกัด  (บันทึก / แก้ไข)</h3>

<form method="post" action="act/set_affiliate/save">
<table class="tbadd">
<tr>
  <th>ชื่อหน่วยงานที่สังกัด<span class="Txt_red_12"> *</span></th>
  <td><input name="under_name" type="text" class="form-control" style="width:500px;" value="<?php echo $affiliate['under_name']?>" /></td>
</tr>
</table>


<div id="btnBoxAdd">
  <input type="hidden" name="created" value="<?php echo $affiliate['created']?>">
  <input type="hidden" name="id" value="<?php echo $affiliate['id']?>">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>