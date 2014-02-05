<h3>ตั้งค่า ตำแหน่งในคณะอนุกรรมการ (บันทึก / แก้ไข)</h3>

<form method="post" action="act/set_position_committee/save">
<table class="tbadd">
<tr>
  <th>ชื่อตำแหน่งในคณะอนุกรรมการ<span class="Txt_red_12"> *</span></th>
  <td><input name="position_committee_name" type="text" class="form-control" style="width:500px;" value="<?php echo $pc['position_committee_name']?>" /></td>
</tr>
</table>


<div id="btnBoxAdd">
  <input type="hidden" name="id" value="<?php echo $pc['id']?>">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>