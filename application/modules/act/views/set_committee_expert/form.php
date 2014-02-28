<h3>ตั้งค่า กรรมการผู้ทรงคุณวุฒิด้าน (บันทึก / แก้ไข)</h3>

<form method="post" action="act/set_committee_expert/save">
<table class="tbadd">
<tr>
  <th>ชื่อกรรมการผู้ทรงคุณวุฒิด้าน<span class="Txt_red_12"> *</span></th>
  <td><input name="ability_name" type="text" class="form-control" style="width:500px;" value="<?php echo $committee_expert['ability_name']?>" /></td>
</tr>
</table>


<div id="btnBoxAdd">
  <input type="hidden" name="created" value="<?php echo $committee_expert['created']?>">
  <input type="hidden" name="id" value="<?php echo $committee_expert['id']?>">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>