<h3>ตั้งค่า สิทธิ์การใช้ระบบ SAR CARD (บันทึก / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ประเภทสิทธิ์ <span class="Txt_red_12">*</span></th>
  <td><select name="select">
    <option>-- เลือกประเภทสิทธิ์การใช้งาน --</option>
    <option>กพร.</option>
    <option>ผู้กำกับดูแลตัวชี้วัด</option>
    <option>ผู้จัดเก็บข้อมูล</option>
    </select></td>
</tr>
<tr>
  <th>บุคลากร<span class="Txt_red_12"> *</span></th>
  <td><input name="textfield2" type="text" id="textfield2" class="form-control" style="width:400px;" />
    <img src="images/search_user.png" width="32" height="32" /></td>
</tr>
<tr>
  <th>อีเมล์</th>
  <td><input name="textfield" type="text" class="form-control" id="textfield" style="width:300px;" placeholder="auto สามารถแก้ไขแล้วบันทึกกลับไปได้" /></td>
</tr>
<tr>
  <th>เบอร์โทร</th>
  <td><input name="textfield3" type="text" class="form-control" id="textfield3" style="width:200px;" placeholder="auto สามารถแก้ไขแล้วบันทึกกลับไปได้"  /></td>
</tr>
<tr>
  <th>ตำแหน่งสายบริหาร</th>
  <td><select name="select2">
    <option>-- เลือกตำแหน่งสายบริหาร --</option>
  </select></td>
</tr>
</table>


<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>